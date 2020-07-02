<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB, AuthSam, Log;

class CommonController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function updateStatusPolicy(Request $request) {

    	Log::info("put_policy_by_type");
		Log::info($request);

		$user_id 	= AuthSam::getUser()->id;
		$policy_id 	= $request->policy_id;
		$type 		= $request->type;

		$subsidychecklist  =   AuthSam::getSubsidychecklist();

		if (in_array((int)$policy_id, $subsidychecklist[$type])) {
			$key = array_search((int)$policy_id, $subsidychecklist[$type]);
			unset($subsidychecklist[$type][$key]);
		} else {
			array_push($subsidychecklist[$type], (int)$policy_id);
		}
		session(['subsidy_check_list' => $subsidychecklist]);
		// dd(session('subsidy_check_list'));

		$exist_flag = DB::table('checklist_policy_user')
			->where('user_id', $user_id)
			->where('policy_id', $policy_id)
			->where('type', $type)->first();

		if ($exist_flag) {
			DB::table('checklist_policy_user')
				->where('user_id',$user_id)
				->where('policy_id', $policy_id)
				->where('type', $type)->delete();

			DB::table('matching_users')
				->where('policy_id',$policy_id)
				->where('user_id',$user_id)
				->where('order_type','2')->delete();
			return array("result"=>"success");
		}

		// if ($type <=2) {
		// 	$data = array('user_id'=>$user_id,'policy_id'=>$policy_id,'type'=>$type);
		// 	$job = (new FavouriteProposal($data))->delay(60);
		// 	$this->dispatch($job);
		// }

		// $query = "insert into checklist_policy_user(user_id, policy_id, type) values('".$user_id."','".$policy_id."','".$type."');";
		$param = [
			'user_id'	=>	$user_id,
			'policy_id'	=>	$policy_id,
			'type'		=>	$type,
		];
		$id = DB::table('checklist_policy_user')->insertGetId($param);
		if ($id) {
			$exist_flag = DB::table('matching_users')
				->where('user_id', $user_id)
				->where('policy_id', $policy_id)->first();
			if (!$exist_flag) {
				$manage_flag = DB::table('users')
					->where('id', $user_id)
					->first()->manage_flag;
				DB::table('matching_users')->insert(
					    ['policy_id' => $policy_id,
					     'user_id' => $user_id,
					     'order_type'=> '3',
					     'user_type'=> $manage_flag]
				);
			}
			return response()->json(['result'	=> 'success']);
		}
		else {
			return response()->json(['result'	=> 'failed']);
		}
    }

    public function updateFollow(Request $request) {

    	$user_id 	= AuthSam::getUser()->id;
		$follow_id 	= $request->follow_id;

		$followlist  =   AuthSam::getFollowlist();

		if (in_array((int)$follow_id, $followlist)) {
			$key = array_search((int)$follow_id, $followlist);
			unset($followlist[$key]);
		} else {
			array_push($followlist, (int)$follow_id);
		}
		session(['follow_list' => $followlist]);
		
		$exist_flag = DB::table('follow')->where('user_id', $user_id)->where('follow_id', $follow_id)->first();
		if ($exist_flag) {
			DB::table('follow')->where('user_id',$user_id)->where('follow_id', $follow_id)->delete();
			return array("result"=>"success");
		}
		//EMail Part...
		// $query = "insert into follow(user_id, follow_id) values('".$user_id."','".$follow_id."');";
		$param = [
			'user_id'	=>	$user_id,
			'follow_id'	=>	$follow_id,
		];
		$id = DB::table('follow')->insertGetId($param);
		if ($id)
			return response()->json(['result'	=> 'success']);
		else
			return response()->json(['result'	=> 'failed']);
    }
    public function checkListPolicy(Request $request)
    {
    	$data['success'] = false;
    	if(AuthSam::isLogin())
    	{
    		if($request->policy_id)
    		{
    			$check = DB::table('checklist_policy_user')->where('policy_id', $request->policy_id)->where('user_id', session('user_id'))->first();
    			if($check)
    			{
    				DB::table('checklist_policy_user')->where('policy_id', $request->policy_id)->where('user_id', session('user_id'))->delete();
    			} else {
    				DB::table('checklist_policy_user')->insert(['user_id'=>session('user_id'), 'policy_id'=>$request->policy_id, 'type'=>1]);
    				$data['success'] = true;
    			}
    		}
    	}
    	return response()->json($data);
    }
}