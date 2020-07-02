<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class CSubsidyList extends Model {

    public static function getPolicyByType($user_id, $type, $order = 0, $per_page = 20) {
        $results = DB::table('checklist_policy_user')
            ->select('policy_id')
            ->where('type',$type)
            ->where('user_id',$user_id)->get();
        $temp = [];
        foreach ($results as $key => $result) {
            $temp[] = $result->policy_id;
        } 
        $exist_ = DB::table('matching')->select('to_id')->where('from_id',$user_id)->where('from',1)->get();
        $exist = [];

        foreach ($exist_ as $key => $value) {
            $exist[] = $value->to_id;
        }
            

        for ($k = 0; $k< count($temp); $k++) {
            if (in_array($temp[$k], $exist)) {
                unset($temp[$k]);
                $temp = array_values($temp); $k--;
            }
        }

        $temp = array_values(array_unique($temp,SORT_REGULAR));
        $policy = [];
        $policy = DB::table('policy')->where('publication_setting',0)->whereIn("policy.id", $temp)->paginate($per_page);
        return $policy;

    }
}