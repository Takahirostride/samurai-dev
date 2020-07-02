<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class BSubsidyList extends Model {

    public static function getPolicyByType($user_id, $type, $order = 0, $per_page = 10) {
        $current_page = 0;
        $exist_ = DB::table('matching')->select('to_id')->where('from',1)->where('from_id',$user_id)->get();
        $exist_ = json_decode($exist_, true);
        $exist = [];
        for ($k = 0; $k< count($exist_); $k++)
            $exist[] = $exist_[$k]['to_id'];

        $result = DB::table('checklist_policy_user')->select('policy_id')->where('type',$type)->where('user_id',$user_id)->whereNotIn('policy_id', $exist)->get();
        $temp = [];
        foreach ($result as $key => $value) {
            $temp[] = $value->policy_id;
        }
        $policy = DB::table('policy')->select('policy.*')->where('publication_setting',0)->whereIn("policy.id", $temp)->select('policy.*', DB::raw("(select distinct count(*) from `matching_users` inner join `users` on `matching_users`.`user_id` = `users`.`id` where `users`.`manage_flag` = 0 and `matching_users`.`policy_id` = policy.id order by `matching_users`.`order_type` asc) as count"));
        if($order == 0) {
            $policy = $policy->orderBy('id', 'desc');
        }else if ($order == 1){
            $policy = $policy->orderBy('acquire_budget', 'desc');
        }else if ($order == 2){
            $policy = $policy->orderBy('acquire_budget', 'asc');
        }else{
            $policy = $policy->orderBy('count', 'desc');
        }
        $policy = $policy->paginate($per_page);
        return $policy;

    }
}