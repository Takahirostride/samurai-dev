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
class MatchingController_bk extends Controller
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
                dd($new_subcat);

                $arr_id = ['new_id' => [], 'del_id'=>[]];
                if(!count($old_subcat))
                {
                    $arr_id['new_id'] = $new_subcat;
                } elseif(!count($new_subcat))
                {
                    $arr_id['del_id'] = $old_subcat;
                } else {
                    $arr_id = self::sync_array($old_subcat, $new_subcat);
                }

                if(count($arr_id['new_id']))
                {
                    //agency only
                    $new_user_list = User::
                            with('cat')
                            ->where('manage_flag', 1)
                            ->whereHas('cat',  function($q) use($arr_id) {
                        $q->whereIn('sub_category_id', $arr_id['new_id']);
                    })->get();
                    if(count($new_user_list))
                    {
                        foreach ($new_user_list as $key => $value) {
                            if(!in_array($value->id, $user_insert))
                                $user_insert[] = $value->id;
                        }
                    }
                }

                if(count($arr_id['del_id']))
                {
                    //agency only
                    $del_user_list = User::
                            with('cat')
                            ->where('manage_flag', 1)
                            ->whereHas('cat',  function($q) use($arr_id) {
                        $q->whereIn('sub_category_id', $arr_id['del_id']);
                    })->get();
                    if(count($del_user_list))
                    {
                        foreach ($del_user_list as $key => $value) {
                            if(!in_array($value->id, $user_del))
                                $user_del[] = $value->id;
                        }
                    }
                }
            } //end not null


            //check khu vuc uu tien policy_region
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
                $old_arr_data = [];
                if(count($old_province))
                {
                    foreach ($old_province as $key => $value) {
                        $old_arr_data[] = [(int)$value->province_id, (int)$value->city_id ];
                    }
                }
                $new_arr = self::sync_array_to_array($old_arr_data, $new_arr_data);


                $arr_id = ['new_id' => [], 'del_id'=>[]];
                if(!count($old_arr_data))
                {
                    $arr_id['new_id'] = $new_arr_data;
                } elseif(!count($new_arr_data))
                {
                    $arr_id['del_id'] = $old_arr_data;
                } else {
                    $arr_id = self::sync_array($old_arr_data, $new_arr_data);
                }

                if(count($arr_id['new_id']))
                {
                    //agency
                    $first = true;
                    $new_user_list = UserLocation::with('user')->has('user');
                    foreach ($arr_id['new_id'] as $key => $value) {
                        if($first == true)
                        {
                            $new_user_list = $new_user_list->where(function($q) use($value) {
                                $q->where('province_id', $value[0])
                                    ->where('city_id', $value[1]);
                            });
                        } else {
                            $new_user_list = $new_user_list->orWhere(function($q) use($value) {
                                $q->where('province_id', $value[0])
                                    ->where('city_id', $value[1]);
                            });
                        }
                        $first = false;
                    }
                    $new_user_list = $new_user_list->get();
                    if(count($new_user_list))
                    {
                        foreach ($new_user_list as $key => $value) {
                            if(!in_array($value->user_id, $user_insert))
                                $user_insert[] = $value->user_id;
                        }
                    }
                }
                
                if(count($arr_id['del_id']))
                {
                    //agency
                    $first = true;
                    $new_user_list = UserLocation::with('user')->has('user');
                    foreach ($arr_id['del_id'] as $key => $value) {
                        if($first == true)
                        {
                            $new_user_list = $new_user_list->where(function($q) use($value) {
                                $q->where('province_id', $value[0])
                                    ->where('city_id', $value[1]);
                            });
                        } else {
                            $new_user_list = $new_user_list->orWhere(function($q) use($value) {
                                $q->where('province_id', $value[0])
                                    ->where('city_id', $value[1]);
                            });
                        }
                        $first = false;
                    }
                    $new_user_list = $new_user_list->get();
                    if(count($new_user_list))
                    {
                        foreach ($new_user_list as $key => $value) {
                            if(!in_array($value->user_id, $user_del))
                                $user_del[] = $value->user_id;
                        }
                    }
                }
            } // end not null



            //check user_business - trades
            $old_business = $policy->policy_business->pluck('trade_id')->toArray();
            $new_business = $business;

            if(!count($old_business) && !count($new_business) ) {}
            else {

                $arr_id = ['new_id' => [], 'del_id'=>[]];
                if(!count($old_business))
                {
                    $arr_id['new_id'] = $new_business;
                } elseif(!count($new_business))
                {
                    $arr_id['del_id'] = $old_business;
                } else {
                    $arr_id = self::sync_array($old_business, $new_business);
                }

                if(count($arr_id['new_id']))
                {
                    $new_user_list = DB::table('user_business')->whereIn('trade_id', $arr_id['new_id'])->pluck('user_id')->toArray();
                    if(count($new_user_list))
                    {
                        foreach ($new_user_list as $key => $value) {
                            if(!in_array($value->user_id, $user_insert))
                                $user_insert[] = $value->user_id;
                        }
                    }
                }

                if(count($arr_id['del_id']))
                {
                    $new_user_list = DB::table('user_business')->whereIn('trade_id', $arr_id['del_id'])->pluck('user_id')->toArray();
                    if(count($new_user_list))
                    {
                        foreach ($new_user_list as $key => $value) {
                            if(!in_array($value->user_id, $user_del))
                                $user_del[] = $value->user_id;
                        }
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
                        $user_client = $user_client->where(function($q) {
                            $q->whereRaw("LEFT(estable_date,4) >= ? AND LEFT(estable_date,4) <= ?", [$new_business['founding_year_start'], $new_business['founding_year_end']] );
                        });
                    else
                        $user_client = $user_client->orWhere(function($q) {
                            $q->whereRaw("LEFT(estable_date,4) >= ? AND LEFT(estable_date,4) <= ?", [$new_business['founding_year_start'], $new_business['founding_year_end']] );
                        });
                }
                if($new_business['capital_end'] != 0)
                {
                    if($first)
                        $user_client = $user_client->where(function($q) {
                            $q->whereRaw("capital >= ? AND capital <= ?", [$new_business['capital_start'], $new_business['capital_end']] );
                        });
                    else
                        $user_client = $user_client->orWhere(function($q) {
                            $q->whereRaw("capital >= ? AND capital <= ?", [$new_business['capital_start'], $new_business['capital_end']] );
                        });
                }
                if($new_business['employees_count_end'] != 0)
                {
                    if($first)
                        $user_client = $user_client->where(function($q) {
                            $q->whereRaw("regular_number >= ? AND regular_number <= ?", [$new_business['employees_count_start'], $new_business['employees_count_end']] );
                        });
                    else
                        $user_client = $user_client->orWhere(function($q) {
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


            
            dd($user_insert);
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