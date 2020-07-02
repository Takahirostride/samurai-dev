<?php

namespace App\Modules\Client\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class FSubsidyList extends Model {

    public static function getSubsidylist($address1,$all_region_flag, $category,$user_id, $auto_flag, 
    									$order,$recommended_flag, $keyword, $pro_part,$business_type,
    									$founding_year,$employees_count,$employees_part_count,
    									$employees_over_60,$hiring_count,$hiring_part_count,$capital,$user_other_data_flag, $current_page, $per_page)
    {
        $current_page = $current_page - 1;
    	$user_type 		= 1;
        $current_date 	= date('Y-m-d');
        // Optminize sql performance
        $policy_array = DB::table('policy')->leftJoin(DB::raw('
                            (SELECT policy_id, COUNT(user_id) as count_agency FROM matching_users 
                            where user_type = '.$user_type.' GROUP By policy_id) as matching_users_group'
                        ),function($join) use($user_type){
                            $join->on('policy.id', '=', 'matching_users_group.policy_id');
                        })->where('policy.publication_setting','0');
        $policy_array = $policy_array->where('location', 0);
        if($auto_flag){
            if(count($business_type)>0){
                $policy_array = $policy_array->where(function ($query) use ($business_type,$current_date)
                {
                    for ($i=0; $i<count($business_type); $i++){
                            $query->orWhere('policy.business_type', 'LIKE', '%'.$business_type[$i].'%')->where('policy.publication_setting','0')
                            ->where('policy.subscript_duration_detail', '=', '0000-00-00');
                            $query->orWhere('policy.business_type', 'LIKE', '%'.$business_type[$i].'%')->where('policy.publication_setting','0')
                            ->where('policy.subscript_duration_detail', '>=', $current_date);
                    }
                });
            }
        } else {
            if ($keyword != '') {
                $policy_array = $policy_array->where(function ($query) use ($keyword,$current_date)
                {
                        $query->orWhere('policy.name', 'LIKE', '%'.$keyword.'%')->where('policy.publication_setting','0')
                        ->where('policy.subscript_duration_detail', '=', '0000-00-00');
                        $query->orWhere('policy.name', 'LIKE', '%'.$keyword.'%')->where('policy.publication_setting','0')
                        ->where('policy.subscript_duration_detail', '>=', $current_date);
                });
            }
        }
        
        if (!$all_region_flag) {
            $policy_array = $policy_array->where(function ($query) use ($address1,$all_region_flag,$current_date)
            {
                
                for ($i=0; $i<count($address1); $i++){
                    if($address1[$i] == '全国')
                    {
                        $query->orWhere('policy.region', $address1[$i]);
                    } else {
                    
                        $query->orWhere('policy.region_detail', 'LIKE', '%'.$address1[$i].'%')->where('policy.publication_setting','0')
                        ->where('policy.subscript_duration_detail', '=', '0000-00-00');
                        $query->orWhere('policy.region_detail', 'LIKE', '%'.$address1[$i].'%')->where('policy.publication_setting','0')
                        ->where('policy.subscript_duration_detail', '>=', $current_date);
                    
                    }
                }
            });
        }

        if(count($category)>0){
            if($category[0] == '誘致関連') {
                $policy_array = $policy_array->where('recom_bounty', 1);
            } else {
                $policy_array = $policy_array->where(function ($query) use ($category,$current_date)
                {
                    for ($i=0; $i<count($category); $i++){
                        // $query->orWhere('policy.category_detail', 'LIKE', '%'.$category[$i].'%')->where('policy.publication_setting','0')
                        // ->where('policy.subscript_duration_detail', '=', '0000-00-00');
                        // $query->orWhere('policy.category_detail', 'LIKE', '%'.$category[$i].'%')->where('policy.publication_setting','0')
                        // ->where('policy.subscript_duration_detail', '>=', $current_date);
                        $query->orWhere('policy.category', 'LIKE', '%'.$category[$i].'%')->where('policy.publication_setting','0')
                        ->where('policy.subscript_duration_detail', '=', '0000-00-00');
                        $query->orWhere('policy.category', 'LIKE', '%'.$category[$i].'%')->where('policy.publication_setting','0')
                        ->where('policy.subscript_duration_detail', '>=', $current_date);
                    }
                });
            }
        } else {
            if($auto_flag)
            {
                $policy_array = $policy_array->where('recom_bounty', 1);
            }
        }

        if((int)$founding_year>0){
            $policy_array = $policy_array->where(function ($query) use ($founding_year,$current_date)
            {
                $query->orWhere('policy.founding_year_start', '<=', \DB::raw($founding_year))
                    ->where('policy.founding_year_end', '>=', \DB::raw($founding_year))
                    ->where('policy.subscript_duration_detail', '=', '0000-00-00');

                $query->orWhere('policy.founding_year_start', '<=', \DB::raw($founding_year))
                    ->where('policy.founding_year_end', '>=', \DB::raw($founding_year))
                    ->where('policy.subscript_duration_detail', '>=', $current_date);

                $query->orWhere('policy.founding_year_start', '<=', \DB::raw($founding_year))
                    ->whereNull('policy.founding_year_end')
                    ->where('policy.subscript_duration_detail', '=', '0000-00-00');

                $query->orWhere('policy.founding_year_start', '<=', \DB::raw($founding_year))
                    ->whereNull('policy.founding_year_end')
                    ->where('policy.subscript_duration_detail', '>=', $current_date);

                $query->orWhere('policy.subscript_duration_detail', '>=', $current_date)
                    ->whereNull('policy.founding_year_start')
                    ->whereNull('policy.founding_year_end');

                $query->orWhere('policy.subscript_duration_detail', '=', '0000-00-00')
                    ->whereNull('policy.founding_year_start')
                    ->whereNull('policy.founding_year_end');
            });
        }

        if($capital>0) {

            $policy_array = $policy_array->where(function ($query) use ($capital,$current_date)
            {
                $query->orWhere('policy.capital_start', '<=', \DB::raw($capital))
                    ->where('policy.capital_end', '>=', \DB::raw($capital))
                    ->where('policy.subscript_duration_detail', '=', '0000-00-00');

                $query->orWhere('policy.capital_start', '<=', \DB::raw($capital))
                    ->where('policy.capital_end', '>=', \DB::raw($capital))
                    ->where('policy.subscript_duration_detail', '>=', $current_date);

                $query->orWhere('policy.capital_start', '<=', \DB::raw($capital))
                    ->whereNull('policy.capital_end')
                    ->where('policy.subscript_duration_detail', '=', '0000-00-00');

                $query->orWhere('policy.capital_start', '<=', \DB::raw($capital))
                    ->whereNull('policy.capital_end')
                    ->where('policy.subscript_duration_detail', '>=', $current_date);

                $query->orWhere('policy.subscript_duration_detail', '>=', $current_date)
                    ->whereNull('policy.capital_start')
                    ->whereNull('policy.capital_end');

                $query->orWhere('policy.subscript_duration_detail', '=', '0000-00-00')
                    ->whereNull('policy.capital_start')
                    ->whereNull('policy.capital_end');
            });
        }
        
        if($employees_count>0){

            $policy_array = $policy_array->where(function ($query) use ($employees_count,$current_date)
            {
                $query->orWhere('policy.employees_count_start', '<=', \DB::raw($employees_count))
                    ->where('policy.employees_count_end', '>=', \DB::raw($employees_count))
                    ->where('policy.subscript_duration_detail', '=', '0000-00-00');

                $query->orWhere('policy.employees_count_start', '<=', \DB::raw($employees_count))
                    ->where('policy.employees_count_end', '>=', \DB::raw($employees_count))
                    ->where('policy.subscript_duration_detail', '>=', $current_date);

                $query->orWhere('policy.employees_count_start', '<=', \DB::raw($employees_count))
                    ->whereNull('policy.employees_count_end')
                    ->where('policy.subscript_duration_detail', '=', '0000-00-00');

                $query->orWhere('policy.employees_count_start', '<=', \DB::raw($employees_count))
                    ->whereNull('policy.employees_count_end')
                    ->where('policy.subscript_duration_detail', '>=', $current_date);

                $query->orWhere('policy.subscript_duration_detail', '>=', $current_date)
                    ->whereNull('policy.employees_count_start')
                    ->whereNull('policy.employees_count_end');

                $query->orWhere('policy.subscript_duration_detail', '=', '0000-00-00')
                    ->whereNull('policy.employees_count_start')
                    ->whereNull('policy.employees_count_end');
            });
        }

        if($hiring_count>0){

            $policy_array = $policy_array->where(function ($query) use ($hiring_count,$current_date)
            {
                $query->orWhere('policy.hiring_count_start', '<=', \DB::raw($hiring_count))
                    ->where('policy.hiring_count_end', '>=', \DB::raw($hiring_count))
                    ->where('policy.subscript_duration_detail', '=', '0000-00-00');

                $query->orWhere('policy.hiring_count_start', '<=', \DB::raw($hiring_count))
                    ->where('policy.hiring_count_end', '>=', \DB::raw($hiring_count))
                    ->where('policy.subscript_duration_detail', '>=', $current_date);

                $query->orWhere('policy.hiring_count_start', '<=', \DB::raw($hiring_count))
                    ->whereNull('policy.hiring_count_end')
                    ->where('policy.subscript_duration_detail', '=', '0000-00-00');

                $query->orWhere('policy.hiring_count_start', '<=', \DB::raw($hiring_count))
                    ->whereNull('policy.hiring_count_end')
                    ->where('policy.subscript_duration_detail', '>=', $current_date);

                $query->orWhere('policy.subscript_duration_detail', '>=', $current_date)
                    ->whereNull('policy.hiring_count_start')
                    ->whereNull('policy.hiring_count_end');

                $query->orWhere('policy.subscript_duration_detail', '=', '0000-00-00')
                    ->whereNull('policy.hiring_count_start')
                    ->whereNull('policy.hiring_count_end');
            });
        }
        
        if($employees_part_count>0){

            $policy_array = $policy_array->where(function ($query) use ($employees_part_count,$current_date)
            {
                $query->orWhere('policy.employees_part_count_start', '<=', \DB::raw($employees_part_count))
                    ->where('policy.employees_part_count_end', '>=', \DB::raw($employees_part_count))
                    ->where('policy.subscript_duration_detail', '=', '0000-00-00');

                $query->orWhere('policy.employees_part_count_start', '<=', \DB::raw($employees_part_count))
                    ->where('policy.employees_part_count_end', '>=', \DB::raw($employees_part_count))
                    ->where('policy.subscript_duration_detail', '>=', $current_date);

                $query->orWhere('policy.employees_part_count_start', '<=', \DB::raw($employees_part_count))
                    ->whereNull('policy.employees_part_count_end')
                    ->where('policy.subscript_duration_detail', '=', '0000-00-00');

                $query->orWhere('policy.employees_part_count_start', '<=', \DB::raw($employees_part_count))
                    ->whereNull('policy.employees_part_count_end')
                    ->where('policy.subscript_duration_detail', '>=', $current_date);

                $query->orWhere('policy.subscript_duration_detail', '>=', $current_date)
                    ->whereNull('policy.employees_part_count_start')
                    ->whereNull('policy.employees_part_count_end');

                $query->orWhere('policy.subscript_duration_detail', '=', '0000-00-00')
                    ->whereNull('policy.employees_part_count_start')
                    ->whereNull('policy.employees_part_count_end');
            });
        }
        if($hiring_part_count>0){

            $policy_array = $policy_array->where(function ($query) use ($hiring_part_count,$current_date)
            {
                $query->orWhere('policy.hiring_byte_count_start', '<=', \DB::raw($hiring_part_count))
                    ->where('policy.hiring_byte_count_end', '>=', \DB::raw($hiring_part_count))
                    ->where('policy.subscript_duration_detail', '=', '0000-00-00');

                $query->orWhere('policy.hiring_byte_count_start', '<=', \DB::raw($hiring_part_count))
                    ->where('policy.hiring_byte_count_end', '>=', \DB::raw($hiring_part_count))
                    ->where('policy.subscript_duration_detail', '>=', $current_date);

                $query->orWhere('policy.hiring_byte_count_start', '<=', \DB::raw($hiring_part_count))
                    ->whereNull('policy.hiring_byte_count_end')
                    ->where('policy.subscript_duration_detail', '=', '0000-00-00');

                $query->orWhere('policy.hiring_byte_count_start', '<=', \DB::raw($hiring_part_count))
                    ->whereNull('policy.hiring_byte_count_end')
                    ->where('policy.subscript_duration_detail', '>=', $current_date);

                $query->orWhere('policy.subscript_duration_detail', '>=', $current_date)
                    ->whereNull('policy.hiring_byte_count_start')
                    ->whereNull('policy.hiring_byte_count_end');

                $query->orWhere('policy.subscript_duration_detail', '=', '0000-00-00')
                    ->whereNull('policy.hiring_byte_count_start')
                    ->whereNull('policy.hiring_byte_count_end');
            });
        }
        
        if($employees_over_60>0){

            $policy_array = $policy_array->where(function ($query) use ($employees_over_60,$current_date)
            {
                $query->orWhere('policy.over_60_count_start', '<=', \DB::raw($employees_over_60))
                    ->where('policy.over_60_count_end', '>=', \DB::raw($employees_over_60))
                    ->where('policy.subscript_duration_detail', '=', '0000-00-00');

                $query->orWhere('policy.over_60_count_start', '<=', \DB::raw($employees_over_60))
                    ->where('policy.over_60_count_end', '>=', \DB::raw($employees_over_60))
                    ->where('policy.subscript_duration_detail', '>=', $current_date);

                $query->orWhere('policy.over_60_count_start', '<=', \DB::raw($employees_over_60))
                    ->whereNull('policy.over_60_count_end')
                    ->where('policy.subscript_duration_detail', '=', '0000-00-00');

                $query->orWhere('policy.over_60_count_start', '<=', \DB::raw($employees_over_60))
                    ->whereNull('policy.over_60_count_end')
                    ->where('policy.subscript_duration_detail', '>=', $current_date);

                $query->orWhere('policy.subscript_duration_detail', '>=', $current_date)
                    ->whereNull('policy.over_60_count_start')
                    ->whereNull('policy.over_60_count_end');

                $query->orWhere('policy.subscript_duration_detail', '=', '0000-00-00')
                    ->whereNull('policy.over_60_count_start')
                    ->whereNull('policy.over_60_count_end');
            });
        }

        /*$policy_array = $policy_array->whereNotIn('policy.id', function($query) use ($user_id){
            $query->select('policy_id')->from('checklist_policy_user')->where('user_id',$user_id)->where('type','2');
        });*/

        // Optimize sql peformance
        //$policy_array = $policy_array->groupBy('policy.id')->select('policy.*',DB::raw('COUNT(matching_users.user_id) as count_agency'));
        $policy_array = $policy_array->select('policy.*','matching_users_group.count_agency');

        if($order == 0){
            $policy_array = $policy_array->orderBy('policy.created_date', 'desc');
        } else if ($order == 1) {
            $policy_array = $policy_array->orderBy('policy.acquire_budget_display', 'desc');
        } else if($order == 2){
            $policy_array = $policy_array->orderBy('policy.acquire_budget_display', 'asc');
        } else {
            $policy_array = $policy_array->orderBy('count_agency', 'desc');
        }

        $policy_array = $policy_array->orderBy('policy.id', 'desc');

        $policy_array_count = count(json_decode($policy_array->get(),true));

        $policy_array = $policy_array->offset($current_page*$per_page )->limit($per_page)->get();

        $dArray = json_decode($policy_array, true);

        $total_item_number = $policy_array_count;
        
        for ($k = 0; $k< count($dArray); $k++) {
            $policy_id = $dArray[$k]['id'];
            $first = DB::table('seller_policy')->where('policy_id',$policy_id)->where('user_id','<>',$user_id)->inRandomOrder()->first();
            $vv = "failed";
            if ($first){
                $count = count(json_decode(DB::table('seller_policy')->where('policy_id',$policy_id)->where('user_id','<>',$user_id)->groupBy('user_id')->get(),true));
                $vv = "success";
                $seller_id = $first->seller_id;
                $dArray[$k]['seller'] = DB::table('seller')->where('id',$seller_id)->first();
                $dArray[$k]['seller_count'] = $count;
            }
            $dArray[$k]['seller_exist_flag'] = $vv;

            $rand_agency_data = DB::table('matching_users')->join('users','matching_users.user_id', '=', 'users.id')
                ->where('matching_users.policy_id',$policy_id)->where('users.manage_flag',1)
                ->select('users.id','users.image','users.displayname','users.result','users.evaluate','users.payroll')
                ->orderBy('users.payroll', 'desc')
                ->orderBy('users.evaluate', 'desc')
                ->orderBy('matching_users.order_type', 'asc')
                ->first();
            $dArray[$k]['rand_agency'] = $rand_agency_data;
            $dArray[$k]["quick_invitation_option"] = 0;
            $dArray[$k]["featured_option"] = 0;
            $tags = json_decode($dArray[$k]['tag'],true);
            if(is_array($tags)){
                if(count(array_intersect($tags,$pro_part)) > 0){
                    if(count($tags)>6){
                        $dArray[$k]['tags'] = array_splice($tags, 0,6);
                    } else {
                        $dArray[$k]['tags'] = $tags;
                    }
                }
            } else {
                $dArray[$k]['tags'] = array();
            }
            $businesstype = json_decode($dArray[$k]['business_type'], true);
            $register1 = json_decode($dArray[$k]['register_pdf1'], true);
            $dArray[$k]['business_type'] = $businesstype;
            $dArray[$k]['register_pdf1'] = $register1;
        }
        // return $dArray;
        return ['result' => $dArray, 'limit' => $per_page, 'current_page' => $current_page, 'total_page' => $total_item_number];
    }
    public static function getPolicyByType($user_id, $type, $order = 0, $current_page, $per_page) {
  		// $user_id = $request->user_id;
    //     $type = $request->type;
    //     $order = $request->order;
        // $current_page = $request->current_page;
        // $per_page = $request->per_page;
        $result = DB::table('checklist_policy_user')->select('policy_id')->where('type',$type)->where('user_id',$user_id);
        $policies = json_decode($result->get(),true);
        $temp = [];
        for ($k = 0; $k< count($policies); $k++)
            $temp[] = $policies[$k]["policy_id"];
        $policy = [];
        $policy = DB::table('policy')->where('publication_setting',0)->whereIn("policy.id", $temp)->get();
        $total_item_number = count(json_decode(DB::table('policy')->where('publication_setting',0)->whereIn("policy.id", $temp)->get(),true));
        $policy = json_decode($policy, true);
        $total = $policy;

        for($k=0; $k<count($total); $k++){
            $total[$k]['count_agency'] = FSubsidyList::get_matched_count($total[$k]['id']);
        }
        if ($order == 0) {
            FSubsidyList::sortArrayByKey($total,"id",false,false);
        }
        else if ($order == 1) {
            for ($k = 0; $k< count($total) - 1; $k++) {
                for ($k1 = $k + 1; $k1< count($total); $k1++) {
                    $acquire1_array = json_decode($total[$k]['acquire_budget'], true); $acquire1_array[] = 0;
                    $acquire1 = max($acquire1_array);
                    $acquire2_array = json_decode($total[$k1]['acquire_budget'], true); $acquire2_array[] = 0;
                    $acquire2 = max($acquire2_array);
                    if ((int)$acquire1 > (int)$acquire2) {
                        $keyArray = array_keys($total[$k]);
                        $temp = $total[$k];
                        $total[$k] = $total[$k1];
                        $total[$k1] = $temp;
                    }
                }
            }
        }
        else if ($order == 2) {
            for ($k = 0; $k< count($total) - 1; $k++) {
                for ($k1 = $k + 1; $k1< count($total); $k1++) {
                    $acquire1_array = json_decode($total[$k]['acquire_budget'], true); $acquire1_array[] = 0;
                    $acquire1 = max($acquire1_array);
                    $acquire2_array = json_decode($total[$k1]['acquire_budget'], true); $acquire2_array[] = 0;
                    $acquire2 = max($acquire2_array);
                    if ((int)$acquire1 < (int)$acquire2) {
                        $temp = $total[$k];
                        $total[$k] = $total[$k1];
                        $total[$k1] = $temp;
                        $total = array_values($total);
                    }
                }
            }
        }
        else if ($order == 3) {
            FSubsidyList::sortArrayByKey($total,"count_agency", false, false);
        }

        // $current_page = $request->current_page;
        $current_page = $current_page-1;
        // $per_page = $request->per_page;

        $pages = array_chunk($total, $per_page);
        $policy =  $current_page > sizeof($pages)-1 ? [] : $pages[$current_page];

        for ($k = 0; $k< count($policy); $k++) {
            $policy_id = $policy[$k]['id'];
            $first = DB::table('seller_policy')->where('policy_id',$policy_id)->where('user_id','<>',$user_id)->inRandomOrder()->first();
            $vv = "failed";
            if ($first){
                $vv = "success";
                $seller_id = $first->seller_id;
                $policy[$k]['seller'] = DB::table('seller')->where('id',$seller_id)->first();
            }
            $policy[$k]['seller_exist_flag'] = $vv;
            $rand_agency_data = DB::table('matching_users')->join('users','matching_users.user_id', '=', 'users.id')
                ->where('matching_users.policy_id',$policy_id)->where('users.manage_flag',1)
                ->select('users.id','users.image','users.displayname','users.result','users.evaluate','users.payroll')
                ->orderBy('users.payroll', 'desc')
                ->orderBy('users.evaluate', 'desc')
                ->orderBy('matching_users.order_type', 'asc')
                ->first();
            $policy[$k]['rand_agency'] = $rand_agency_data;
            $businesstype = json_decode($policy[$k]['business_type'], true);
            $policy[$k]['business_type'] = $businesstype;
            $tags = json_decode($policy[$k]['tag'],true);
            if(is_array($tags)){
                if(count($tags)>6){
                    $policy[$k]['tags'] = array_splice($tags, 0,6);
                } else {
                    $policy[$k]['tags'] = $tags;
                }
            } else {
                $policy[$k]['tags'] = array();
            }
        }
        return ['result' => $policy, 'limit' => $per_page, 'current_page' => $current_page, 'total_page' => $total_item_number];
    }
    public static function get_matched_count($policy_id){
        $matched_usercount = 0;
        $result = FSubsidyList::get_matched_users($policy_id);
        $matched_usercount = count($result);
        return $matched_usercount;
    }

    public static function get_matched_users($policy_id){
        $matched_users = [];
        $matched_users = json_decode(DB::table('matching_users')->join('users', 'matching_users.user_id', '=', 'users.id')->where('users.manage_flag', 1)->where('matching_users.policy_id', $policy_id)->select('users.*')->orderBy('matching_users.order_type', 'asc')->distinct()->get(), true);
        return $matched_users;
    }

    public static function sortArrayByKey(&$array,$key,$string = false,$asc = true){
        if($string){
            usort($array,function ($a, $b) use(&$key,&$asc)
            {
                if($asc)    return strcmp(strtolower($a{$key}), strtolower($b{$key}));
                else        return strcmp(strtolower($b{$key}), strtolower($a{$key}));
            });
        }else{
            usort($array,function ($a, $b) use(&$key,&$asc)
            {
                if($a[$key] == $b{$key}){return 0;}
                if($asc) return ($a{$key} < $b{$key}) ? -1 : 1;
                else     return ($a{$key} > $b{$key}) ? -1 : 1;
            });
        }
    }
}