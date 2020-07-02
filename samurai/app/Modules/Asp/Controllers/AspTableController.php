<?php

namespace App\Modules\Asp\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Asp\Models\WorkSet;
use App\Modules\Asp\Models\Hire;
use App\Modules\Asp\Models\Policy;
use App\Modules\Asp\Models\HireClientLog;
use App\Modules\Asp\Models\HireClientStatistic;
use App\Modules\Asp\Events\HireClientEvent;
use App\Modules\Asp\Events\WorksetClientEvent;
use Event;
use DB;
class AspTableController extends Controller
{	
	public function hireClientLog(Request $request){
		return view('Asp::table.hire_client_log');
	}
	public function hireEvent(Request $request){
		if($request->method('post')){
			if($request->filled('create')){
				Event::fire(new HireClientEvent('create',7));
			}
			elseif($request->filled('accept')){
				Event::fire(new HireClientEvent('accept',7));
			}
			elseif($request->filled('finish')){
				Event::fire(new HireClientEvent('finish',7));
			}
			elseif($request->filled('workset')){
				Event::fire(new WorksetClientEvent(76));
			}

			return back()->with('status',__('Check hire event successfully!'));
		}
	}
	public function hireStatisticUpdate(Request $request){
		$data_path = storage_path('app/hire_client_statistic.json');
		if($request->isMethod('post') && $request->filled('save')){
			if(!file_exists($data_path)){
				$request->session()->flash('status',__('File not existed!'));
			}else{
				$data = file_get_contents($data_path);
				$data = json_decode($data,true);
				//dd($data);
				foreach($data as $ite){
					HireClientStatistic::create($ite);	
				}
				$request->session()->flash('status',__('save Successfully!'));
			}
			
		}
		return back()->with('status',__('Successfully!'));
	}
	public function hireStatistic(Request $request){
		$data_path = storage_path('app/hire_client_statistic.json');
		if($request->isMethod('post') && $request->filled('get_json')){
			$hires = Hire::select([
				'hire.id','hire.from_id','hire.to_id','hire.hire_type','hire.finish_flag','hire.policy_id','hire.accept','hire.created_at',
				DB::raw('(SELECT users.id FROM users WHERE users.manage_flag=0 AND (users.id = hire.from_id OR users.id=hire.to_id) LIMIT 1) AS client_id')
			])
						->where('hire.hire_type','=',1)
						->has('policy')
						->get();
			$c_hires = $hires->where('client_id','!=',null);
			$clients = $c_hires->groupBy('client_id');
			$clients = $clients->all();
			//dd($clients);
			$results = [];
			foreach($clients as $client_id=>$ite){
				$data = [];
				$data['client_id'] = $client_id;
				$data['total'] = $ite->count();
				$c_policy = $ite->groupBy('policy_id')->count();
				$data['policy_count'] = $c_policy;
				$finish = $ite->where('finish_flag',1)->where('accept',1)->count();
				$data['finish'] = $finish;
				$accept = $ite->where('accept',1)->count();
				$data['accept'] = $accept;
				$results[]=$data;
			}
			file_put_contents($data_path, json_encode($results));
			$request->session()->flash('status',__('get list Successfully!'));
			return back()->with('status',__('Successfully!'));			
		}
	}

	public function hireWork(Request $request){
		$data_path = storage_path('app/hire_client_log.json');
		if($request->isMethod('post') && $request->filled('get_json')){
			$work_sets = WorkSet::select(['id','hire_id','created_date','schedule'])
						->with([
							'hire'=>function($qr){
								$qr->select(['id','from_id','to_id'])
								 ->with(['fromUser','toUser']);	
							}	
						])->has('hire');
			$work_sets = $work_sets->orderBy('id','asc')->get();
			$data = []; 
			if(file_exists($data_path)){
				$o_dt = file_get_contents($data_path);
				$data = json_decode($o_dt,true);
			}			
			foreach($work_sets as $work){
				$client = $work->hire->getClient();
				if(!$client){ continue;}
				$check = false;
				foreach($data as $k_ele=>$ele){
					if($ele['client_id']==$client->id && $ele['hire_id']==$work->hire_id){
						$data[$k_ele]['status'] = 2;
						$data[$k_ele]['work_set_id'] = $work->id;
						if($work->schedule && $work->schedule != '0000-00-00'){
							$data[$k_ele]['updated_at'] =$work->schedule . '00:00:00';
						}						
						$check = true;
						break;
					}
				}
				if(!$check){
					$ite = [
						'client_id'=>$client->id,
						'hire_id'=>$work->hire->id,
						'policy_id'=>$work->hire->policy_id,
						'work_set_id'=>$work->id,
						'status'=> 2,
						'created_at'=> $work->created_date->format('Y-m-d H:i:s'),
						'updated_at'=> $work->created_date->format('Y-m-d H:i:s')
					];
					$data[]=$ite;					
				}
			}
			file_put_contents($data_path, json_encode($data));
			return back()->with('status',__('Successfully!'));
		}
	}
	public function hirePolicy(Request $request){
		$data_path = storage_path('app/hire_policy.json');
		$data_sql_path = storage_path('app/hire_policy_query.sql');
		if($request->isMethod('post') && $request->filled('get_json')){
			$hires = Hire::select([
				'hire.id','hire.from_id','hire.to_id','hire.policy_id','hire.hire_type','hire.created_at',
				DB::raw('(SELECT users.id FROM users WHERE users.manage_flag=0 AND (users.id = hire.from_id OR users.id=hire.to_id) LIMIT 1) AS client_id')
			])
						->where('hire.hire_type','=',1)
						->has('policy')
						->orderBy('policy_id')
						->get();
			$c_hires = $hires->where('client_id','!=',null);
			$policies = $c_hires->groupBy('policy_id');
			$policies = $policies->all();
			$results = [];
			$sql = '';
			$sql .="SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";\n";
			$sql .="SET AUTOCOMMIT = 0;\n";
			$sql .="START TRANSACTION;\n";
			$sql .="SET time_zone = \"+00:00\";\n";			
			foreach($policies as $policy_id=>$ite){
				$c_client = $ite->groupBy('client_id')->count();
				$results[]=[
					'policy_id'=>$policy_id,
					'total_hire_client'=>$c_client
				]; 
				$sql .= "UPDATE `policy` SET `total_hire_client`={$c_client} WHERE `id`={$policy_id};\n";
			}
			$sql .= "COMMIT;";
			file_put_contents($data_path, json_encode($results));
			file_put_contents($data_sql_path, $sql);
			$request->session()->flash('status',__('get list Successfully!'));
			return back()->with('status',__('Successfully!'));			
		}
	}
	public function hirePolicyUpdate(Request $request){
		$data_path = storage_path('app/hire_policy.json');
		if($request->isMethod('post') && $request->filled('save')){
			if(!file_exists($data_path)){
				$request->session()->flash('status',__('File not existed!'));
			}else{
				$data = file_get_contents($data_path);
				$data = json_decode($data,true);
				//dd($data);
				foreach($data as $ite){
					$policy = Policy::find($ite['policy_id']);
					if($policy){
						$policy->update([
							'total_hire_client'=>$ite['total_hire_client']
						]);
					}	
				}
				$request->session()->flash('status',__('save Successfully!'));
			}
			
		}
		return back()->with('status',__('Successfully!'));		
	}
	public function hireRegister(Request $request){
		$data_path = storage_path('app/hire_client_log.json');
		if($request->isMethod('post') && $request->filled('save')){
			$hires = Hire::select(['id','from_id','to_id','policy_id','created_at'])
						->with([
							'fromUser','toUser'	
						])
						->has('policy');
			$hires = $hires->orderBy('id','asc')->get();
			$data = []; 
			foreach($hires as $hire){
				$client = $hire->getClient();
				if(!$client){ continue;}
				$ite = [
					'client_id'=>$client->id,
					'hire_id'=>$hire->id,
					'policy_id'=>$hire->policy_id,	
					'work_set_id'=>0,
					'status'=> 1,
					'created_at'=> $hire->created_at->format('Y-m-d H:i:s'),
					'updated_at'=> $hire->created_at->format('Y-m-d H:i:s')
				];
				$data[]=$ite;
			}
			if(file_exists($data_path)){
				$o_dt = file_get_contents($data_path);
				$o_data = json_decode($o_dt,true);
				$data = array_merge($o_data,$data);
				$collect = collect($data);
				$sort = $collect->sortBy('created_at');
				$n_data = $sort->values()->toJson();
				file_put_contents($data_path, $n_data);
			}else{
				file_put_contents($data_path, json_encode($data));
			}
			
			return back()->with('status',__('Successfully!'));
		}		
	}
	public function hireClientSave(Request $request){
		$data_path = storage_path('app/hire_client_log.json');
		if($request->isMethod('post') && $request->filled('save')){
			if(!file_exists($data_path)){
				$request->session()->flash('status',__('File not existed!'));
			}else{
				$data = file_get_contents($data_path);
				$data = json_decode($data,true);
				//dd($data);
				foreach($data as $ite){
					HireClientLog::create($ite);	
				}
				$request->session()->flash('status',__('save Successfully!'));
			}
			
		}
		return back()->with('status',__('Successfully!'));
	}
}