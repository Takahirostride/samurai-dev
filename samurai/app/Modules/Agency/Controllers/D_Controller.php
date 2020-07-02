<?php

namespace App\Modules\Agency\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category, App\Models\SubCategory, DB, AuthSam, Log;
use App\Models\User;
use App\Models\Policy;
use App\Models\CSubsidyList;
use App\Models\Matching;
use App\Models\MatchingUser;
use App\Models\Post;
use App\Models\Bask;
use App\Models\Hire;
use App\Models\JobPolicy;
use Carbon\Carbon;
use Redirect;
use App\Helpers\UploadFile;
use Illuminate\Support\Facades\URL;
use App\Modules\Asp\Events\HireClientEvent;
use App\Modules\Asp\Events\WorksetClientEvent;
use Event;
class D_Controller extends Controller
{
    /**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   get View Index
    *   @return     :
    */
    public function getDselect()
    {
    	$categorys = Category::with(['subcategory'])->get();
        $stdu = 4 - (count($categorys) % 4);
        for ($i=0; $i <$stdu ; $i++) { 
            $categorys[] = [];
        }
        foreach ($categorys as $key => $category) {
            if(@$category->subcategory) {
                $countsub = count($category->subcategory);
                $stdu = 4 - ($countsub % 4);
                for ($i=0; $i <$stdu ; $i++) { 
                    $categorys[$key]->subcategory[] = [];
                }
            }
        }
        $regions = DB::table('provinces')->select('id','province_name' )->get();
        return view("Agency::Dpage.select", ['categorys'=>$categorys, 'regions'=>$regions]);
    }
    public function getDfollowList(Request $request) {

		$user_id = session('user_id');
		$per_page = $request->per_page;
		if(!$per_page) $per_page = 10;

		$manage_flag = DB::table('users')->where('id', $user_id)->first()->manage_flag;
		Log::info('Follow리스트 자료 얻기.');

		if ($manage_flag == 0){
			$result = DB::table('follow')->where('follow.user_id', $user_id)
			->join('users', 'users.id', '=', 'follow.follow_id')->where('users.manage_flag', '1')->select('users.id', 'users.image', 'users.displayname', 'users.result', 'users.evaluate', 'users.section', 'users.location', 'users.manage_flag')
                                    ->orderBy('users.id', 'desc')->distinct('users.id')
			->paginate($per_page);
		} else {
			$result = DB::table('follow')->where('follow.user_id', $user_id)
			->join('users', 'users.id', '=', 'follow.follow_id')->where('users.manage_flag', '0')->select('users.id', 'users.image', 'users.displayname', 'users.result', 'users.evaluate', 'users.section', 'users.location', 'users.manage_flag')
                                    ->orderBy('users.id', 'desc')->distinct('users.id')
			->paginate($per_page);
		}
		if($result){
            foreach ($result as $key => $value) {
                    $value->is_collect_flag = '募集中';
                    if($value->manage_flag == 0){
                        $first = DB::table('post')->where('user_id', $value->id)->orderBy('id', 'desc')->first();
                        $match_date = '-';
                        if ($first) {
                            $match_date = date('Y年m月d日', strtotime($first->post_date));
                        }
                    }else{
                        $first = DB::table('matching')->where('from_id', $value->id)->orderBy('id', 'desc')->first();
                        $match_date = '-';
                        if ($first) {
                            $match_date = date('Y年m月d日', strtotime($first->start_date));
                        }
                    }
                    $value->final_request_date = $match_date;
                    $value->final_request_content = DB::table('hire')->where('from_id', $value->id)->orWhere('to_id', $value->id)->count();
            }
            //print_r($result);
            // die;
        }
		// dd($result);
		return view("Agency::Dpage.followList", ['result'=>$result]);
	}

    public function getDsearch(Request $request) {
        $user_id = session('user_id');
        $current_date = date('Y-m-d');
        (!empty($request->order)) ? $order = $request->order : $order = 0;
        (!empty($request->per_page)) ? $per_page = $request->per_page : $per_page = 10;
        $categorys = $request->category;
        $categorysubs = $request->categorysub;
        $regions = $request->region;
        $cities = $request->cities;
        // chưa liên kết business
        $values = Policy::with(['subCat','provinces', 'post'=>function($qr){
            $qr->with(['user'=>function($uqr){
                return $uqr->where('manage_flag', 0);
            }]);
        }])->has('user')->has('post')->orderBy('id', 'asc');

        $region_flag = false;
        if(!in_array('全国', $regions)) {
            $region_flag = true;
            $values = $values->whereHas('provinces',function($qr)use($regions){
                return $qr->whereIn('province_id',$regions);
            });
            if($cities) {
                $values = $values->whereHas('provinces',function($qr)use($cities){
                    return $qr->whereIn('city_id',$cities);
                });
            }
        }
        if($categorysubs) {
            $values = $values->whereHas('subCat',function($qr)use($categorysubs){
                return $qr->whereIn('sub_category_id',$categorysubs);
            });
        }
        $check = [];
        $checklists = DB::table('checklist_policy_user')->select('policy_id')->where('user_id','=',$user_id)->where('type','=','2')->get();
        foreach ($checklists as $key => $checklist) {
            $check[] = $checklist->policy_id;
        }

        $values = $values->whereNotIn('id',$check);
        $results = $values->get();
        
        foreach ($results as $key => $result) {
            $policy_ids[]= $result->id;
        }
        
        if($categorysubs && $region_flag){
            $result = DB::table('users')->where('users.manage_flag',0)
                ->select('users.*')->distinct()->paginate(20);
        } else {
            $result = DB::table('post')->join('users', 'users.id', '=', 'post.user_id')->whereIn('post.policy_id',$policy_ids)
                ->where('users.manage_flag', 0 )->where('post.display',1)->select('users.*')->distinct()->paginate(20);
        }
        if($result){
            foreach ($result as $key => $value) {
                    $value->is_collect_flag = '募集中';
                    if($value->manage_flag == 0){
                        $first = DB::table('post')->where('user_id', $value->id)->orderBy('id', 'desc')->first();
                        $match_date = '-';
                        if ($first) {
                            $match_date = date('Y年m月d日', strtotime($first->post_date));
                        }
                    }else{
                        $first = DB::table('matching')->where('from_id', $value->id)->orderBy('id', 'desc')->first();
                        $match_date = '-';
                        if ($first) {
                            $match_date = date('Y年m月d日', strtotime($first->start_date));
                        }
                    }
                    $value->final_request_date = $match_date;
                    $value->final_request_content = DB::table('hire')->where('from_id', $value->id)->orWhere('to_id', $value->id)->count();
            }
        }
        return view("Agency::Dpage.followList", ['result'=>$result]);

    }

	public function getDmatchingpolicy(Request $request) {
        $user_id = session('user_id');
        $per_page = $request->per_page;
        if(!$per_page) $per_page = 10;
        $order = $request->order;
        if(!$order) $order = 0;

        $results = Matching::with(['policy'=>function($qr)use($user_id){
            $qr->where('policy.publication_setting','=', 0);
        }])->where('from_id','=', $user_id)->where('matching.from', 1 )->has('policy');

        if((int)$order == 0){
            $results = $results->orderBy('id','desc');
        } else if((int)$order == 1){
            $results = $results->whereHas('policy',function($qr){
	            return $qr->orderBy('acquire_budget_display','desc');
	        });
        } else {
            $results = $results->whereHas('policy',function($qr){
	            return $qr->orderBy('acquire_budget_display','asc');
	        });
        }
        $results = $results->paginate($per_page);
        return view("Agency::Dpage.dmatchingpolicy", ['results'=>$results]);
    }

    public function getDsubsidylist(Request $request) {
        $user_id = session('user_id');
        $current_date = date('Y-m-d');
        (!empty($request->order)) ? $order = $request->order : $order = 0;
        (!empty($request->per_page)) ? $per_page = $request->per_page : $per_page = 10;
        (!empty($request->order)) ? $order = $request->order : $order = 0;
        $results = Matching::with(['user','policy'=>function($qr)use($user_id){
            $qr->where('policy.publication_setting','=', 0);
        }])->where('from_id','=', $user_id)->where('matching.from', 1 )->has('policy');
        
        if((int)$order == 0){
            $results = $results->orderBy('id','desc');
        } else if((int)$order == 1){
            $results = $results->whereHas('policy',function($qr){
                return $qr->orderBy('acquire_budget_display','desc');
            });
        } else {
            $results = $results->whereHas('policy',function($qr){
                return $qr->orderBy('acquire_budget_display','asc');
            });
        }
        $results = $results->paginate($per_page);
        return view("Agency::Dpage.dsubsidylist", ['results'=>$results]);

    }
    public function postDmatching(Request $request)
    {
        $user_id = session('user_id');
        $policy_id = $request->policy_id;
        $deli_date = strdatecover($request->deli_date);
        $deposit_money = $request->deposit_money;
        $dt = [
            'from_id'=>$user_id,
            'to_id'=>$policy_id
        ];
        $ex_dt = [
            'end_date'=>str_replace(['年','月','日'],['-','-',''],$request->deli_date),
            'deposit_money'=>$deposit_money,
        ];
        $matching = Matching::updateOrCreate($dt,$ex_dt);
        if($matching) echo 'success';
        else echo 'error';
        die();
    }


    public function getDclientRequest(Request $request) {
        $user_id = session('user_id');
        $results = JobPolicy::with('from', 'to')
                    ->where('to_id', $user_id)
                    ->where('deli_date', '>', date('Y-m-d'))
                    ->where('is_display', 1)
                    ->orderBy('id', 'desc')
                    ->paginate(10);
        return view("Agency::Dpage.dclientrequest", ['results'=>$results]);
    }

    public function getDinformation(Request $request) {
        $user_id = session('user_id');
        $id = $request->id;
        $results = JobPolicy::with('from')->where('to_id', $user_id)->where('id', $id)->first();
        return view("Agency::Dpage.dinformation", ['results'=>$results]);
    }
    public function postDask(Request $request)
    {
        $job = DB::table('job_policy')->where('to_id', session('user_id'))->where('id', $request->job_policy_id)->first();
        $rsdata = ['success'=>false];
        if($job)
        {
            $data = [
                'from_id' => $job->from_id,
                'to_id' => session('user_id'),
                'policy_id' => 0,
                'hire_type' => 2,
                'accept' => 0,
                'job_title' => $job->job_title,
                'job_content' => $job->job_content,
                'deposit_money' => $request->deposit_money,
                'agency_estimate' => $request->agency_estimate,
                'deli_date' => str_replace(['年','月','日'] , ['-','-',''] ,$request->deli_date),
                'update_date' => date('Y-m-d'),
                'created_at' => date('Y-m-d h:i:s'),
            ];
            $hire_id = DB::table('hire')->insertGetId($data);
            DB::table('job_policy')->where('id', $job->id)->update(['is_display'=> 0]);
            Event::fire(new HireClientEvent('create',$hire_id));
            $rsdata['success'] = true;
            $rsdata['hire_id'] = $hire_id;
            
        }
        return response()->json($rsdata);
        
        
    }
}