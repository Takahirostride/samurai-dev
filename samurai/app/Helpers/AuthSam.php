<?php

namespace App\Helpers;
use Session, Cookie, DB;
use App\Models\User;

class AuthSam {
	/********************* AUTH USER *********************/
	public static function login($param = [], $remember = false) {
		$user = DB::table('users')
					->where(function($query) use ($param){
						$query->where('username', $param['email'])
							->orWhere('e_mail', $param['email']);
					})
                  	->where('password', md5($param['password']))
                  	->first();
		if ($user) {
			if ($remember) {
				$minutes = time()+60*60*24*30; //30 day
				Cookie::queue(Cookie::make('username', $param['email'], $minutes));
				Cookie::queue(Cookie::make('password', $param['password'], $minutes));
			} else {
				Cookie::queue(Cookie::forget('username'));
				Cookie::queue(Cookie::forget('password'));
			}
			session(['is_login'=>true, 'user_id'=>$user->id, 'permission'=>$user->manage_flag, 'permission_lock'=>$user->permission]);
			return true;
		}
		return false;
	}
	public static function getSubsidychecklist() {
		if (session('is_login')) {
			if (!session('subsidy_check_list')) {
				$checklist_data = json_decode(DB::table('checklist_policy_user')->where('user_id',session('user_id'))->select('policy_id','type')->get(), true);
				$checklist0 = [];
				$checklist1 = [];
				$checklist2 = [];

				for ($k = 0; $k< count($checklist_data); $k++) {
					if ((int)$checklist_data[$k]['type'] == 0)
						$checklist0[] = (int)$checklist_data[$k]['policy_id'];
					else if ((int)$checklist_data[$k]['type'] == 1)
						$checklist1[] = (int) $checklist_data[$k]['policy_id'];
					else if ((int)$checklist_data[$k]['type'] == 2)
						$checklist2[] = (int) $checklist_data[$k]['policy_id'];
				}
				$subsidy_check_list = [$checklist0, $checklist1, $checklist2];
				session(['subsidy_check_list' => $subsidy_check_list]);
			} else {
				$subsidy_check_list = session('subsidy_check_list');
			}
			return $subsidy_check_list;
		}
		return null;
	}
	public static function getFollowlist() {
		if (session('is_login')) {
			if (!session('follow_list')) {
				$follow_list = json_decode(DB::table('follow')->where('user_id', session('user_id'))->select('follow_id')->distinct()->get(), true);
			    $followlist = [];
				for ($k = 0; $k< count($follow_list); $k++) {
					$followlist[] = (int)$follow_list[$k]['follow_id'];
				}
				session(['follow_list' => $followlist]);
			} else {
				$followlist = session('follow_list');
			}
			return $followlist;
		}
		return [];
	}
	public static function loginToken($token) {
		if ($token) {
			$user = DB::table('users')
					->where('api_token', $token)
                  	->first();
			if ($user) {
				session(['is_login'=>true, 'user_id'=>$user->id, 'permission'=>$user->manage_flag]);
				return true;
			}
		}
		return false;
	}

	public static function isLogin() {
		if (session('is_login')) {
			return true;
		}
		return false;
	}

	public static function permission() {
		return session('permission');
	}

	public static function permission_lock() {
		return session('permission_lock');
	}

	public static function logout() {
		return session()->forget(['is_login', 'user_id', 'permission','permission_lock', 'subsidy_check_list', 'follow_list']);
	}

	public static function getUser() {
		$user = null;
		if (session('is_login')) {
			$user = User::where('id', session('user_id'))
                  	->first();
		}
		return $user;
	}
	/********************* AUTH ADMIN *********************/
}