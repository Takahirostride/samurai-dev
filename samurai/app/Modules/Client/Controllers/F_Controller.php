<?php

namespace App\Modules\Client\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB, AuthSam,Log,Validator;
use App\Modules\Client\Models\FSubsidyList;
use App\Modules\Admin\Models\Category;
use App\Modules\Admin\Models\Province;
use App\Modules\Admin\Models\Trade;
use App\Models\SubCategory;
use App\Models\Tag;
use App\Models\Policy;
use App\Models\User;
use App\Models\VisitPolicy;
use App\Models\MatchingUser;
use App\Models\Post;
use App\Models\Hire;

class F_Controller extends Controller
{
    /**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   get View subsidylist
    *   @return     :
    */    
    public function getSubsidylist(Request $request)
    {
        $categories = Category::listCat();
        $user = AuthSam::getUser();
        $user_location = User::with(['user_location'])->where('id',$user->id)->first();
        $toan_quoc = DB::table('provinces')->where('province_name', '全国')->first()->id;
        $client_data = DB::table('users_client_data')->where('user_id', $user->id)->first();
        if($user_location)
        {
            $user_province_id = $user_location->user_location->province_id;
            $user_city_id = $user_location->user_location->city_id;
            $first_city = DB::table('cities')
                        ->where('province_id', $user_province_id)
                        ->where('city_name', 'すべて')
                        ->first()->id;
        }
        // dd($user_location);
        $p_sel = ['id','acquire_budget','image_id','name','name_serve','minitry_id','sub_minitry_id','subscript_duration','support_content','support_scale','acquire_budget_first','acquire_budget_display','subscript_duration_detail'];
        $values = Policy::select($p_sel)->with(['tags','minitry','sub_minitry', 'cat', 'checklist_policy_user', 'hire', 'policy_region_many', 'policy_region_many.province', 'policy_region_many.city',
            'hire'  => function($qr) use ($user) {
                $qr->where('from_id', $user->id);
                $qr->orWhere('to_id', $user->id);
            }
            // 'matchingUser'=>function($qr)use($user){
            //     $qr->where('user_id','=',$user->id);
            // }
        ])
        ->where('publication_setting','=', 0)
        ->where(function($qr){
            $current_date = date('Y-m-d');
            $qr->where('subscript_duration_detail','=','0000-00-00')
                ->orWhere('subscript_duration_detail','>=',$current_date);
        });
        // $values = $values->with([
        //     'policy_region.province',
        //     'checklist_policy_user'=>function($qr)use($user){
        //         $qr->where('user_id','=',$user->id);
        //     }                           
        // ]);   
        // $values = $values->whereHas('checklist_policy_user',function($qr)use($user){
        //     $qr->where([
        //         ['user_id','=',$user->id]            
        //     ]);
        // });
        // $values = $values->whereDoesntHave('matchingUser',function($qr)use($user){
        //     $qr->where([
        //         ['user_id','=',$user->id]
        //     ]);
        // });        
        //request

        $checkRegion = true;
        if($request->cate){
            if($request->cate != 'all'){
                if($request->cate == 'location')
                {
                    $values = $values->where('location', 1);//->whereDoesntHave('cat');
                    $checkRegion = false;
                } else {
                    $cate = trim($request->cate);
                    // dd($cate);
                    $values = $values->whereHas('cat',function($qr)use($cate){
                        $qr->where('policy_category.category_id','=',$cate);
                    })->has('cat')
                    ->where('location', 0);
                }
                
            }
            //dat fix new toan quoc
            
            if($user_location && $checkRegion)
            {
                $values = $values->whereHas('policy_region',function($qr) use ($user_location, $first_city, $toan_quoc){
                    $qr->where(function($q1) use($user_location, $first_city, $toan_quoc) {
                        $q1->where('province_id', $toan_quoc)
                            ->orWhere(function($qq1) use($user_location) {
                                $qq1->where('province_id', $user_location->user_location->province_id)
                                    ->where('city_id', $user_location->user_location->city_id);
                            });
                        if($first_city != $user_location->user_location->city_id)
                        {
                            $q1->orWhere(function($qq2) use($user_location, $first_city) {
                                $qq2->where('province_id', $user_location->user_location->province_id)
                                ->where('city_id', $first_city);
                            });
                        }
                    });
                })->has('policy_region');
            }
            if($client_data)
            {
                $values = $values->where(function($query) use($client_data) {
                    $query->where(function($q1) use($client_data) {
                            $q1->where('capital_start', '<=', ($client_data->capital*10000) )
                                    ->where('capital_end', '>=', ($client_data->capital*10000) );
                            })
                        ->orWhere(function($q2) use($client_data) {
                            $q2->where('employees_count_start', '<=', $client_data->regular_number)
                                ->where('employees_count_end', '>=', $client_data->regular_number);
                        });
                    if($client_data->estable_date != 0)
                    {
                        $yy = date('Y', strtotime($client_data->estable_date) );
                        if($yy > 0 && $yy <= date('Y') && strlen($yy)==4)
                        {
                            $query->orWhere(function($q3) use($client_data, $yy) {
                                $q3->where(function($q4) use($client_data, $yy) {
                                    $q4->where('founding_year_start', '<=', $yy)
                                    ->where('founding_year_end', '>=', $yy);
                                })
                                ->orWhere('subscript_duration_option', 1);
                            });
                        }
                    }
                    
                });
            }


            // $values = $values->whereHas('policy_region',function($qr)use($user_location){
            //     $qr->where('province_id', $user_location->user_location->province_id)
            //     ->where('city_id', $user_location->user_location->city_id);
            // })->has('policy_region');
        }else{
            $values = $values->where('recom_bounty','=',1);
        }    
        //
        (!empty($request->order)) ? $order = $request->order : $order = 3;
        (!empty($request->per_page)) ? $per_page = $request->per_page : $per_page = 10;         
        if($order == 0){
            $values = $values->orderBy('created_date','desc')->orderBy('id','desc');
        } else if ($order == 1) {
            $values = $values->orderBy('acquire_budget','desc')->orderBy('id','desc'); 
        } else if($order == 2){
            $values = $values->orderBy('acquire_budget','asc')->orderBy('id','desc');
        } else {
            $values = $values->orderBy('id','desc');
        }
        $values = $values->paginate($per_page);           
        //dd($values);
        return view("Client::Fpage.subsidylist", [
            "results" => $values,
            "user" => $user,
            "categories" => $categories,
        ]);
    }
    /**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   get View search
    *   @return     :
    */
    public function getSearch(Request $request)
    {
        $categorys = Category::listCatSub();
        $regions = Province::listAllProvince();
        $trades = Trade::listAllDisplay();
        // dd($regions);
        $user = AuthSam::getUser();
        
        (!empty($request->order)) ? $order = $request->order : $order = 3;
        (!empty($request->per_page)) ? $per_page = $request->per_page : $per_page = 10;              
        $results = [];
        if($request->has('searchtype')) {
            $contents = @$request->contents;
            $category = @$request->category;
            $categorysubs = @$request->categorysubs;
            $region = @$request->region;
            $cities = @$request->cities;
            $keyword = @$request->keyword;
            $business_type = $request->trades;
            $q_tag = $request->query('tags',[]);
            $p_sel = ['id','acquire_budget','image_id','name','name_serve','minitry_id','sub_minitry_id','subscript_duration','support_content','support_scale','acquire_budget_first','acquire_budget_display','subscript_duration_detail'];
            $values = Policy::select($p_sel)->with(['tags','minitry','sub_minitry'])
            ->where('publication_setting','=', 0)
            ->where(function($qr){
                $current_date = date('Y-m-d');
                $qr->where('subscript_duration_detail','=','0000-00-00')
                    ->orWhere('subscript_duration_detail','>=',$current_date);
            });
            // $values = $values->with([
            //     'policy_region.province',
            //     'checklist_policy_user'=>function($qr)use($user){
            //         $qr->where([
            //             ['user_id','=',$user->id]                    
            //         ]);
            //     }               
            // ]);
            // $values = $values->whereDoesntHave('matchingUser',function($qr)use($user){
            //     $qr->where([
            //         ['user_id','=',$user->id]
            //     ]);
            // });            
            if(!empty($q_tag) && !in_array('その他',$q_tag)){
                $values = $values->whereHas('tags',function($qr)use($q_tag){
                    $qr->whereIn('tags.tag',$q_tag);
                });
            }
            if($region) {
                $values = $values->whereHas('provinces',function($qr)use($region){
                    return $qr->where('province_id',$region);
                });
            }
            if($cities) {
                $values = $values->whereHas('provinces',function($qr)use($cities){
                    return $qr->whereIn('city_id',$cities);
                });
            }
            if($request->filled('location')){
                $values = $values->whereIn('location',$request->query('location'));
            }
            if($keyword) {
                $values = $values->where('name', 'LIKE', '%'.$keyword.'%');
            }
            if($category) {
                $values = $values->whereHas('cat',function($qr)use($category){
                    return $qr->whereIn('category_id',$category);
                });
            }
            if($categorysubs) {
                $values = $values->whereHas('subCat',function($qr)use($categorysubs){
                    return $qr->whereIn('sub_category_id',$categorysubs);
                });
            }

            if($business_type) {
                $values = $values->whereHas('policy_business',function($qr)use($business_type){
                    return $qr->whereIn('trade_id',$business_type);
                });
            }
            if($order == 0){
                $values = $values->orderBy('created_date','desc')->orderBy('id','desc');
            } else if ($order == 1) {
                $values = $values->orderBy('acquire_budget','desc')->orderBy('id','desc'); 
            } else if($order == 2){
                $values = $values->orderBy('acquire_budget','asc')->orderBy('id','desc');
            } else {
                $values = $values->orderBy('id','desc');
            }
            $results = $values->paginate($per_page);
        }    
        //dd($results);
        return view("Client::Fpage.search",[
            'user'=>$user,
            'categorys'=>$categorys, 
            'regions'=>$regions, 
            'trades'=>$trades, 
            'results'=>$results
        ]
        );
    }
    /**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   get View Search
    *   @return     :
    */
    public function getSelect(Request $request,$id)
    {
        $user = AuthSam::getUser();
        $policy_data = Policy::findOrFail($id);
        $policy_data->load([
            'tags','minitry','sub_minitry',
            'checklist_policy_user'=>function($qr)use($user){
                $qr->where('user_id','=',$user->id);
            },
            'hire'=>function($qr)use($user){
                $qr->where('from_id', $user->id);
                $qr->orWhere('to_id', $user->id);
            }
            // 'matchingUser'=>function($qr)use($user){
            //     $qr->where('user_id','=',$user->id);
            // }
        ]);
        if ($user) {
                Log::info("session users_id:".$user->id."aa");
                $dt = [
                    'user_id'=>$user->id,
                    'policy_id'=>(int)$id
                ];
                $result=VisitPolicy::updateOrCreate($dt,['created_at'=>date('Y-m-d H:i:s',time())]);
                //dd($result);
        }
        $B = new \App\Modules\Agency\Controllers\B_Controller;
        $matching_users = $B->get_matched_users($id, 1);    //1: agency
        
        return view("Client::Fpage.select", [
            'policy_data'=>$policy_data,
            'matching_users'=>$matching_users,
            'user'=>$user
        ]);
    }
    public function storePost(Request $request){
        if(!$request->ajax()){ abort(404);}
        $user_id = session('user_id');
        $valid = Validator::make($request->all(),[
            'policy_id'=>'required|exists:policy,id',
            'complete_date'=>'required',
            'title'=>'required',
        ]);
        $dt = [
            'user_id'=>$user_id,
            'policy_id'=>$request->policy_id
        ];
        $ex_dt = [
            'order_type'=>1,
            'user_type'=>0
        ];
        $match_user = MatchingUser::updateOrCreate($dt,$ex_dt);
        if(!$match_user){
            return response()->json(['error'=>1,'message'=>__('Error!')]);
        }

        $dt = [
            'from_id'=>$user_id,
            'policy_id'=>$request->policy_id
        ];
        $ex_dt = [
            'budget' => $request->budget,
            'deli_date' => str_replace(['年','月','日'] , ['-','-',''] ,$request->complete_date),
            'update_date' => date('Y-m-d')
        ];
        //$hire = Hire::updateOrCreate($dt,$ex_dt);
        return response()->json(['error'=>0]);
    }
    public function storePost_bak(Request $request){
        // backup send agency with category of policy
        if(!$request->ajax()){ abort(404);}
        $user_id = session('user_id');
        $valid = Validator::make($request->all(),[
            'policy_id'=>'required|exists:policy,id',
            'complete_date'=>'required',
            'title'=>'required',
        ]);
        $dt = [
            'user_id'=>$user_id,
            'policy_id'=>$request->policy_id
        ];
        $ex_dt = [
            'order_type'=>1,
            'user_type'=>0
        ];
        $policy = Policy::with('subCat')->where('id', $request->policy_id)->first();
        $sub_cate = [];
        foreach ($policy->subCat as $key => $value) {
            $sub_cate[] = $value->id;
        }
        $user_send=[];
        if($sub_cate) {
            $user_send = User::with(['subCat'=>function($qr)use($sub_cate){
                $qr->whereIn('sub_category_id', $sub_cate);
            }])->where('manage_flag', 1)->has('subCat')->get();
        }
        $a = [];
        if($user_send) {
            foreach ($user_send as $keys => $values) {
                // $a[] = $values->id;
                $dt = [
                    'from_id'=>$user_id,
                    'to_id'=>$values->id,
                    'policy_id'=>$request->policy_id
                ];
                $ex_dt = [
                    'budget' => $request->budget,
                    'deli_date' => str_replace(['年','月','日'] , ['-','-',''] ,$request->complete_date),
                    'update_date' => date('Y-m-d')
                ];
                $hire = Hire::updateOrCreate($dt,$ex_dt);
            }
        }
        return response()->json(['error'=>0]);
    }
}