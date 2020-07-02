<?php

namespace App\Modules\Admin\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Modules\Admin\Models\Address;
use App\Modules\Admin\Models\Province;
use App\Models\Policy;
use App\Models\User;
use App\Models\MatchingUser;
use App\Models\UserLocation;
use App\Models\UserAddress;
use App\Models\UserBusiness;
use App\Modules\Admin\Models\UserCategory;
class MatchingController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function update_matching_edit_policy($category = [], $business = [], $region = [], $com_info = [], $policy_id = false)
    {
        if($policy_id)
        {
            $insert_data = $user_insert = $user_del = [];
            $del_data = [];
            $policy = Policy::where('id', $policy_id)->first();
            if(!$policy) return false;
            
            //check category
            $old_subcat = $policy->subCat->pluck('id')->toArray();
            $cat = $category;
            if(!count($old_subcat) && !count($cat) )
            {

            } else {
                $new_subcat = [];
                if(count($cat))
                {
                    foreach ($cat as $key => $value) {
                        if(count($value['sub']))
                        {
                            $new_subcat = array_merge($new_subcat, $value['sub']);
                        }
                    }
                }
                if(count($new_subcat))
                {
                    $cat_db = UserCategory::whereHas('user', function($q) {
                        $q->where('manage_flag', 1);
                    })->whereIn('sub_category_id', $new_subcat)->get();
                    if(count($cat_db))
                    {
                        foreach ($cat_db as $key => $value) {
                            if(!in_array($value->user_id, $user_insert))
                                $user_insert[] = $value->user_id;
                        }
                    }
                }
            } //end not null


            //check khu vuc uu tien policy_region client
            $old_province = DB::table('policy_region')
                            ->where('policy_id', $policy_id)
                            ->get()->toArray();

            $new_province = $region;
            if(!count($old_province) && !count($new_province) ) {}
            else {
                $new_arr_data = [];
                if(count($new_province))
                {
                    foreach ($new_province as $key => $value) {
                        $new_arr_data[] = [(int)@$value['province'], (isset($value['city'])?(int)$value['city']:0) ];
                    }
                }

                $first = true;
                $new_db = UserLocation::select('user_id')->whereHas('user', function($q)
                    {
                        $q->where('manage_flag', 0);
                    });
                foreach ($new_arr_data as $key => $value) {
                    if($first == true)
                    {
                        $new_db = $new_db->where(function($q) use($value) {
                            $q->where('province_id', $value[0])
                                ->where('city_id', $value[1]);
                        });
                    } else {
                        $new_db = $new_db->orWhere(function($q) use($value) {
                            $q->where('province_id', $value[0])
                                ->where('city_id', $value[1]);
                        });
                    }
                    $first = false;
                }
                $new_db = $new_db->pluck('user_id')->toArray();
                if(count($new_db))
                {
                    foreach ($new_db as $key => $value) {
                        if(!in_array($value, $user_insert))
                            $user_insert[] = $value;
                    }
                }
                
            } // end not null


            //check khu vuc uu tien policy_address agency
            $new_province = $region;
            if(!count($old_province) && !count($new_province) ) {}
            else {
                $new_arr_data = [];
                if(count($new_province))
                {
                    foreach ($new_province as $key => $value) {
                        $new_arr_data[] = [(int)@$value['province'], (isset($value['city'])?(int)$value['city']:0) ];
                    }
                }

                $first = true;
                $new_db = UserAddress::select('user_id')->whereHas('user', function($q)
                    {
                        $q->where('manage_flag', 1);
                    });
                foreach ($new_arr_data as $key => $value) {
                    if($first == true)
                    {
                        $new_db = $new_db->where(function($q) use($value) {
                            $q->where('province_id', $value[0])
                                ->where('city_id', $value[1]);
                        });
                    } else {
                        $new_db = $new_db->orWhere(function($q) use($value) {
                            $q->where('province_id', $value[0])
                                ->where('city_id', $value[1]);
                        });
                    }
                    $first = false;
                }
                $new_db = $new_db->pluck('user_id')->toArray();
                if(count($new_db))
                {
                    foreach ($new_db as $key => $value) {
                        if(!in_array($value, $user_insert))
                            $user_insert[] = $value;
                    }
                }
                
            } // end not null



            //check user_business - trades
            $old_business = $policy->policy_business->pluck('trade_id')->toArray();
            $new_business = $business;

            if(!count($old_business) && !count($new_business) ) {}
            elseif($old_business == $new_business) {}
            else {
                $new_user_list = UserBusiness::whereHas('user', function($q) {
                    $q->where('manage_flag', 0);
                })->whereIn('trade_id', $new_business)->pluck('user_id')->toArray();
                if(count($new_user_list))
                    {
                        foreach ($new_user_list as $key => $value) {
                            if(!in_array($value, $user_insert))
                                $user_insert[] = $value;
                        }
                    }
            } //end not null

            //check com_info
            $policy_com = Policy::where('id', $policy_id)->select(['founding_year_start', 'founding_year_end', 'capital_start', 'capital_end', 'employees_count_start', 'employees_count_end'])->first()->toArray();
            $new_business = $com_info;

            if(
                ($policy_com['founding_year_start'] == $new_business['founding_year_start']) &&
                ($policy_com['founding_year_end'] == $new_business['founding_year_end']) &&
                ($policy_com['capital_start'] == $new_business['capital_start']) &&
                ($policy_com['capital_end'] == $new_business['capital_end']) &&
                ($policy_com['employees_count_start'] == $new_business['employees_count_start']) &&
                ($policy_com['employees_count_end'] == $new_business['employees_count_end'])
            ) {}
            else {
                $user_client = DB::table('users_client_data');
                $first = true;
                if($new_business['founding_year_end'] != 0)
                {
                    if($first)
                        $user_client = $user_client->where(function($q) use($new_business) {
                            $q->whereRaw("LEFT(estable_date,4) >= ? AND LEFT(estable_date,4) <= ?", [$new_business['founding_year_start'], $new_business['founding_year_end']] );
                        });
                    else
                        $user_client = $user_client->orWhere(function($q) use($new_business) {
                            $q->whereRaw("LEFT(estable_date,4) >= ? AND LEFT(estable_date,4) <= ?", [$new_business['founding_year_start'], $new_business['founding_year_end']] );
                        });
                }
                if($new_business['capital_end'] != 0)
                {
                    if($first)
                        $user_client = $user_client->where(function($q) use($new_business) {
                            $q->whereRaw("capital >= ? AND capital <= ?", [$new_business['capital_start'], $new_business['capital_end']] );
                        });
                    else
                        $user_client = $user_client->orWhere(function($q) use($new_business) {
                            $q->whereRaw("capital >= ? AND capital <= ?", [$new_business['capital_start'], $new_business['capital_end']] );
                        });
                }
                if($new_business['employees_count_end'] != 0)
                {
                    if($first)
                        $user_client = $user_client->where(function($q) use($new_business) {
                            $q->whereRaw("regular_number >= ? AND regular_number <= ?", [$new_business['employees_count_start'], $new_business['employees_count_end']] );
                        });
                    else
                        $user_client = $user_client->orWhere(function($q) use($new_business) {
                            $q->whereRaw("regular_number >= ? AND regular_number <= ?", [$new_business['employees_count_start'], $new_business['employees_count_end']] );
                        });
                }
                $user_client = $user_client->select('user_id')->get();
                if(count($user_client))
                {
                    foreach ($user_client as $key => $value) {
                        if(!in_array($value->user_id, $user_insert))
                            $user_insert[] = $value->user_id;
                    }
                }
            } //end not null


            
            if(count($user_insert))
            {
                $users = DB::table('users')->whereIn('id', $user_insert)->get();
                $policy_user = DB::table('matching_users')->where('policy_id', $policy_id)->pluck('user_id')->toArray();
                $insert_id_list = [];
                $del_id_list = [];
                if(count($users))
                {
                    foreach ($users as $key => $value) {
                        if(!in_array($value->id, $policy_user))
                        {
                            $insert_id_list[] = $value->id;
                            $insert_data[] = [
                                'policy_id' => $policy_id,
                                'user_id'   => $value->id,
                                'order_type'=> 2,
                                'user_type' => $value->manage_flag
                            ];
                        }
                        
                    }
                    foreach ($policy_user as $key => $value) {
                        if(!in_array($value, $user_insert))
                        {
                            $del_id_list[] = $value;
                        }
                        
                    }
                    if(count($del_id_list)){
                        $l = DB::table('matching_users')->where('policy_id', $policy_id)
                                ->whereIn('user_id', $del_id_list)->delete();
                    }
                    if(count($insert_data)){
                        foreach ($insert_data as $key => $value) {
                            DB::table('matching_users')->insert($value);
                        }
                    }
                }
            }
        }
        return true;


    }
    public static function update_matching_edit_profile($user_id = 0)
    {
        if(!$user_id) return false;
        $user = DB::table('users')->where('id', $user_id)->first();
        if(!$user) return false;

        $new_match_policy = array();

        //user category
        $user_category = DB::table('user_category')->where('user_id', $user_id)->select('category_id', 'sub_category_id')->get()->toArray();
        if(count($user_category))
        {
            $cat = $subcat = [];
            foreach ($user_category as $key => $value) {
                $cat[] = $value->category_id;
                $subcat[] = $value->sub_category_id;
            }
            $new_match_policy = DB::table('policy_category')->whereIn('category_id', $cat)->orWhereIn('sub_category_id', $subcat)->pluck('policy_id')->toArray();
        }

        //user_business
        $user_business = DB::table('user_business')->where('user_id', $user_id)->select('trade_id')->get()->toArray();
        if(count($user_business))
        {
            $trade = [];
            foreach ($user_business as $key => $value) {
                $trade[] = $value->trade_id;
            }
            $tmp = DB::table('policy_business')->whereIn('trade_id', $cat)->pluck('policy_id')->toArray();
            if(count($tmp) && count($new_match_policy))
            {
                foreach ($new_match_policy as $key => $value) {
                    if(!in_array($value, $tmp))
                    {
                        $new_match_policy[] = $value;
                    }
                }
            } else {
                //$new_match_policy = [];
            }
        }

        //user region
        if($user->manage_flag == 1) //agency
        {
            $address = DB::table('user_address')->where('user_id', $user_id)->select('province_id', 'city_id')->get()->toArray();
        } elseif($user->manage_flag == 0) {
            $address = DB::table('user_location')->where('user_id', $user_id)->select('province_id', 'city_id')->get()->toArray();
        }
        if(isset($address)) {
            $province = $city = [];
            if(count($address))
            {
                foreach ($address as $key => $value) {
                    $province[] = $value->province_id;
                    $city[] = $value->city_id;
                }
                
                $tmp = DB::table('policy_region')->whereIn('province_id', $province)->orWhereIn('city_id', $city)->pluck('policy_id')->toArray();
                if(count($tmp) && count($new_match_policy))
                {
                    foreach ($new_match_policy as $key => $value) {
                        if(!in_array($value, $tmp))
                        {
                            $new_match_policy[] = $value;
                        }
                    }
                } else {
                    //$new_match_policy = [];
                }
            }

        }

        //user client data
        $client_data = DB::table('users_client_data')->where('user_id', $user_id)->first();
        if($client_data)
        {
            $policy = DB::table('policy');
            if($client_data->estable_date != 0 || $client_data->capital != 0 || $client_data->regular_number != 0)
            {
                if($client_data->capital != 0)
                {
                    $policy->where(function($q1) use($client_data) {
                        $q1->where(function($q2) use($client_data) {
                            $q2->where('capital_start', '<=', ($client_data->capital) )
                                ->where('capital_end', '>=', ($client_data->capital) )
                                ->whereNotNull('capital_end');
                            })
                        ->orWhereNull('capital_end');
                    });
                }
                if($client_data->regular_number != 0)
                {
                    $policy->where(function($q1) use($client_data) {
                        $q1->where(function($q2) use($client_data) {
                            $q2->where('employees_count_start', '<=', ($client_data->regular_number) )
                                ->where('employees_count_end', '>=', ($client_data->regular_number) )
                                ->whereNotNull('employees_count_end');
                            })
                        ->orWhereNull('employees_count_end');
                    });
                }
                if($client_data->estable_date != 0)
                {
                    $yy = date('Y', strtotime($client_data->estable_date) );
                    if($yy > 0 && $yy <= date('Y') && strlen($yy)==4)
                    {
                        $policy->where(function($q2) use($client_data, $yy) {
                            $q2->where(function($q3) use($client_data, $yy) {
                                $q3->where('founding_year_start', '<=', $yy)
                                ->where('founding_year_end', '>=', $yy);
                            })
                            ->orWhere('subscript_duration_option', 1);
                        });
                    }
                }

                $tmp = $policy->pluck('id')->toArray();
                if(count($tmp) && count($new_match_policy))
                {
                    foreach ($new_match_policy as $key => $value) {
                        if(!in_array($value, $tmp))
                        {
                            $new_match_policy[] = $value;
                        }
                    }
                } else {
                    //$new_match_policy = [];
                }
            }
        }


        //update database
        $insertList = $deleteList = [];
        $oldList = DB::table('matching_users')->where('user_id', $user_id)->pluck('policy_id')->toArray();
        if(!count($oldList))
        {
            $insertList = $new_match_policy;
        } else {
            foreach ($oldList as $key => $value) {
                if(!in_array($value, $new_match_policy))
                {
                    $deleteList[] = $value;
                }
            }
            foreach ($new_match_policy as $key => $value) {
                if(!in_array($value, $oldList))
                {
                    $insertList[] = $value;
                }
            }
        }
        
        if(count($deleteList))
        {
            DB::table('matching_users')->where('user_id', $user_id)->whereIn('policy_id', $deleteList)->delete();
        }
        if(count($insertList))
        {
            $insertUpdate = [];
            foreach ($insertList as $key => $value) {
                $insertUpdate[] = [
                    'policy_id' =>  $value,
                    'user_id' =>  $user_id,
                    'order_type' =>  2,
                    'user_type' =>  $user->manage_flag,
                ];
            }
            DB::table('matching_users')->insert($insertUpdate);
        }
    }
    private static function sync_array($old_array = [], $new_array = [])
    {
        $data = ['new_id' => $new_array, 'del_id'=>[]];
        if(count($old_array))
        {
            foreach ($old_array as $key => $value) {
                if(!in_array($value, $new_array))
                {
                    $data['del_id'][] = $value;
                    foreach ($data['new_id'] as $k => $v) {
                        if($v == $value) {
                            unset($data['new_id'][$k]);
                            break;
                        }
                    }
                } else {
                    foreach ($data['new_id'] as $k => $v) {
                        if($v == $value) {
                            unset($data['new_id'][$k]);
                            break;
                        }
                    }
                }
            }
        }
        return $data;
    }

    private static function sync_array_to_array($old_array = [], $new_array = [])
    {
        $data = ['new_id' => [], 'del_id'=>[]];
        if(count($old_array))
        {
            foreach ($old_array as $key => $value) {
                $ck = false;
                foreach ($new_array as $key1 => $value1) {
                    if($value == $value1)
                    {
                        $ck = true;
                        break;
                    }
                }
                if(!$ck) {
                    $data['del_id'][] = $value;
                }
            }
            foreach ($new_array as $key => $value) {
                $ck = false;
                foreach ($old_array as $key1 => $value1) {
                    if($value == $value1)
                    {
                        $ck = true;
                        break;
                    }
                }
                if(!$ck) {
                    $data['new_id'][] = $value;
                }
            }
        }
        return $data;
    }

}