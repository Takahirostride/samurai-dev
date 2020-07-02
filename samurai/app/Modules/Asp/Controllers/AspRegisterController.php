<?php

namespace App\Modules\Asp\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Asp\Models\AspUser;
use App\Modules\Asp\Models\User;
use App\Modules\Asp\Models\Hire;
use App\Modules\Asp\Models\Policy;
use App\Modules\Asp\Models\AspClientLog;
use App\Modules\Asp\Models\AspHireLog;
use App\Modules\Asp\Models\AspClientLogPolicy;
use App\Modules\Asp\Models\AspHireMessage;
use App\Modules\Asp\Models\AspCompany;
//
use App\Modules\Asp\Mail\RegisterClient;
use App\Modules\Asp\Mail\ContactPolicy;
use Validator;
use Event,Mail;

class AspRegisterController extends Controller
{	
	public function sendMailPolicy(Request $request){
		if(!$request->ajax()){abort(404);}
		$valid = Validator::make($request->all(),[
			'policy_id'=>'required',
			'client_id'=>'required',
			'title'=>'required',
			'message'=>'required',			
		]);
		if($valid->fails()){
			return response()->json([
				'error'=>1,
				'message'=>$valid->getMessageBag()
			]);
		}
		$message = strip_tags($request->message);
		$title = strip_tags($request->title);
		$policy_id = $request->policy_id;
		$user = auth('asp_user')->user();
		$policy = Policy::find($policy_id);
		if(!$policy){
			return response()->json([
				'error'=>1,
				'message'=>__('Not found!')
			]);
		}
		$client = $user->getCompany($request->client_id);
		if(!$client){
			return response()->json([
				'error'=>1,
				'message'=>__('Not found!')
			]);			
		}			
		$user_client = AspClientLog::firstOrCreate([
			'asp_user_id'=>$user->id,
			'user_id'=>$client->id
		]);
		$user_client->hireMessage()->create([
			'hire_id'=>$policy_id,
			'title'=>$title,
			'message'=>$message,
		]);	
        AspClientLogPolicy::updateOrCreate(
            [
                'asp_client_log_id'=>$user_client->id,
                'policy_id'=>$policy_id,
                'type'=>1
            ],
            [
                'created_at'=>date('Y-m-d H:i:s')
            ]
        );		
		Mail::to($client->email)->send(new ContactPolicy($title,$message));
		return response()->json([
			'error'=>0,
			'message'=>'Send mail ok!'
		]);	

	}
	public function sendMail(Request $request){
		if($request->ajax()){
			$valid = Validator::make($request->all(),[
				'client_list'=>'required',
			]);
			if($valid->fails()){
				return response()->json([
					'error'=>1,
					'message'=>$valid->getMessageBag()
				]);
			}
			$company_ids = explode(',',$request->client_list);
			$user = auth('asp_user')->user();
			$invation = $user->aspInvation;
			if(!$invation){
				return response()->json([
					'error'=>1,
					'message'=>'No invation is created !. <a href="'.route('asp_manage_clients_invation').'">招待管理</a>'
				]);
			}
			$companies = AspCompany::whereIn('id',$company_ids)->where('email','!=','');
			$emails = $companies->pluck('email');
			foreach($emails as $email){
				if(empty($email)){ continue;}
				Mail::to($email)->send(new RegisterClient($invation));
			}			
			$time = date('Y-m-d H:i:s',time());
			$companies->update([
				'is_register'=>1,
				'sended_at'=>$time
			]);	
			return response()->json([
				'error'=>0,
				'message'=>'Send mail ok!'
			]);			
		}
		abort(404);
	}
	//store
	public function bk_sendMailPolicy(Request $request){
		if(!$request->ajax()){abort(404);}
		$valid = Validator::make($request->all(),[
			'hire_id'=>'required',
			'title'=>'required',
			'message'=>'required',			
		]);
		if($valid->fails()){
			return response()->json([
				'error'=>1,
				'message'=>$valid->getMessageBag()
			]);
		}
		$message = strip_tags($request->message);
		$title = strip_tags($request->title);
		$hire_id = $request->hire_id;
		$user = auth('asp_user')->user();
		$hire = Hire::select(['id','from_id','to_id'])->find($hire_id);
		if(!$hire){
			return response()->json([
				'error'=>1,
				'message'=>__('Not found!')
			]);
		}
		$hire->load(['fromUser','toUser']);
		$client = $hire->getClient();
		if(!$client){
			return response()->json([
				'error'=>1,
				'message'=>__('Not found!')
			]);			
		}			
		$user_client = AspClientLog::firstOrCreate([
			'asp_user_id'=>$user->id,
			'user_id'=>$client->id
		]);
		$user_client->hireMessage()->create([
			'hire_id'=>$hire_id,
			'title'=>$title,
			'message'=>$message,
		]);	
		$cnd = [
			'asp_user_id'=>$user->id,
			'hire_id'=>$hire_id
		];
		AspHireLog::updateOrCreate($cnd,[
			'is_send'=>1
		]);
		Mail::to($client->e_mail)->send(new ContactPolicy($title,$message));
		return response()->json([
			'error'=>0,
			'message'=>'Send mail ok!'
		]);	

	}	
}