<?php

namespace App\Modules\Agency\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Agency\Controllers\MypageController;
use App\Models\Category, App\Models\SubCategory, DB, AuthSam, Log;
use App\Models\User;
use App\Models\Policy;
use App\Models\BSubsidyList;
use App\Models\MatchingUser;
use App\Models\Post;
use App\Models\Bask;
use App\Models\Hire;
use App\Models\CheckListPolicyUser;
use App\Models\VisitPolicy;
use Mail;
use App\Modules\Asp\Events\HireClientEvent;
use App\Modules\Asp\Events\WorksetClientEvent;
use Event;


use Carbon\Carbon;
use Redirect;
use App\Helpers\UploadFile;
use Illuminate\Support\Facades\URL;

class B_Controller extends Controller
{

    /**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   get View Index
    *   @return     :
    */
    // private $mypage = new MypageController;
    public function getBsubsidylist(Request $request)
    {
        $user_id = session('user_id');
        $current_date = date('Y-m-d');
        (!empty($request->order)) ? $order = $request->order : $order = 0;
        (!empty($request->per_page)) ? $per_page = $request->per_page : $per_page = 10;
        if(!isset($request->type)) { //Bsearch
            $categorysubs = [];
            $region = '';
            $cities = [];
            $business_type = [];
            $user_data = User::with(['subcat','user_location', 'user_business'])->where('manage_flag',1)->where('permission', 1)->where('id',$user_id)->select('users.*')->first();
            if($user_data->subcat) { 
                foreach ($user_data->subcat as $key => $subcat) {
                    $categorysubs[] = $subcat->id;
                }
            }
            if($user_data->user_business) { 
                foreach ($user_data->user_business as $key => $user_business) {
                    $business_type[] = $user_business->trade_id;
                }
            }
            $regions[]=$user_data->user_location->province_id;
            $cities[]=$user_data->user_location->city_id;

            $values = Policy::with(['subCat','provinces','User','policy_business', 'matching_user_search'])
            ->where('policy.publication_setting','=', 0)
            ->where('policy.subscript_duration_detail','>=', $current_date);

            $values = $values->whereHas('matching_user_search',function($qr){
                return $qr->with(['post']);
            });

            if(!empty($region) && $region != "全国") {
    
                $values = $values->whereHas('provinces',function($qr)use($region){
                    return $qr->where('province_id',$region);
                });
                if($cities) {
                    $values = $values->whereHas('provinces',function($qr)use($cities){
                        return $qr->whereIn('city_id',$cities);
                    });
                }
            }
            // if($keyword) {
            //     $values = $values->where('policy.name', 'LIKE', '%'.$keyword.'%');
            // }
            if($categorysubs) {
                $values = $values->whereHas('subCat',function($qr)use($categorysubs){
                    return $qr->whereIn('sub_category_id',$categorysubs);
                });
            }

            if($business_type) {
                $values = $values->whereHas('policy_business',function($qr)use($business_type){
                    return $qr->whereIn('policy_id',$business_type);
                });
            }
            // $check = [];
            // $checklists = DB::table('checklist_policy_user')->select('policy_id')->where('user_id','=',$user_id)->where('type','=','2')->get();

            // foreach ($checklists as $key => $checklist) {
            //     $check[] = $checklist->policy_id;
            // }

            // $values = $values->whereNotIn('id',$check);
            $results = $values->orderBy('id','desc')
            ->with('tags','minitry','sub_minitry', 'cat', 'checklist_policy_user', 'hire', 'policy_region_many', 'policy_region_many.province', 'policy_region_many.city', 'paid_user')
            ->paginate($per_page);
        }else{
            $results = BSubsidyList::getPolicyByType($user_id, $request->type, $order, $per_page );
        }
        
        $payroll = User::find($user_id)->payroll;
        foreach ($results as $key => $result) {
            $term_display = 1;
            if($payroll==0) {
                if(strpos($result->acquire_budget, '0')) $term_display = 1;
                else $term_display = 0;
            }
            $results[$key]->term_display = $term_display;
            $first = DB::table('seller_policy')->where('policy_id',$result->id)->where('user_id','<>',$user_id)->inRandomOrder()->first();
            $vv = "failed";
            if ($first){
                $vv = "success";
                $results[$key]->seller_count = DB::table('seller_policy')->where('policy_id',$result->id)->where('user_id','<>',$user_id)->groupBy('user_id')->count();
                $results[$key]->seller = DB::table('seller')->where('id',$first->id)->first();
            }
            $results[$key]->seller_exist_flag = $vv;
            $results[$key]->count_general = DB::table('matching_users')->join('users','matching_users.user_id', '=', 'users.id')
                ->where('matching_users.policy_id',$result->id)->where('users.manage_flag',0)
                ->whereNotExists(function($query)
                    {
                        $query->select(DB::raw(1))
                              ->from('post')
                              ->whereRaw('matching_users.policy_id = post.policy_id')
                              ->whereRaw('matching_users.user_id =  post.user_id')
                              ->whereRaw('post.display != 1');
                    })
                ->select('users.id','users.image','users.displayname','users.result','users.evaluate','users.payroll','users.self_intro')
                ->count();
            $paid_user = DB::table('matching_users')->join('users','matching_users.user_id', '=', 'users.id')
                ->where('matching_users.policy_id',$result->id)->where('users.manage_flag',0)
                ->select('users.id','users.image','users.displayname','users.result','users.evaluate','users.payroll','users.self_intro')
                ->orderBy('users.payroll', 'desc')
                ->orderBy('users.evaluate', 'desc')
                ->orderBy('matching_users.order_type', 'asc')
                ->first();
            $paid_user_result = "failed";
            $results[$key]->quick_invitation_option = 3;
            $results[$key]->featured_option = 3;
            if ($paid_user) {
                $results[$key]->paid_user = $paid_user;
                $paid_user_result = "success";
            }
        }
        return view("Agency::Bpage.subsidylist", ["results" => $results]);
    }
    /**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   get View Index
    *   @return     :
    */
    public function getBsubsidylistAction(Request $request)
    {
        $action = $request->action;
        if($action > 2) return back();
        (!empty($request->per_page)) ? $per_page = $request->per_page : $per_page = 10;
        (!empty($request->order)) ? $order = $request->order : $order = 0;
        $user_id    =   session('user_id');
        if($action==2){
            $results = Hire::with(['policy'=>function($qr){
            $qr->where('publication_setting', 0);
        }])
            ->where('accept',1)->orderBy('id','desc')
            ->has('policy')
            ->with('policy.tags')
            ->with('policy.seller_policy')
            ->with(['policy.paid_user'=>function($qr){
                $qr->join('users','matching_users.user_id', '=', 'users.id')
                ->where('users.manage_flag',0)
                ->orderBy('users.payroll', 'desc')
                ->orderBy('users.evaluate', 'desc')
                ->orderBy('matching_users.order_type', 'asc');
            }])
            ->with(['policy.matchingUser'=>function($qr){
                $qr->join('users','matching_users.user_id', '=', 'users.id')
                ->where('users.manage_flag',0)
                ->whereNotExists(function($query)
                    {
                        $query->select(DB::raw(1))
                              ->from('post')
                              ->whereRaw('matching_users.policy_id = post.policy_id')
                              ->whereRaw('matching_users.user_id =  post.user_id')
                              ->whereRaw('post.display != 1');
                    });
            }]);
            
        }else if($action==1){
            $results = CheckListPolicyUser::with(['policy'=>function($qr){
            $qr->where('publication_setting', 0);
        }])
                ->where('user_id',$user_id)
                ->where('type','<',2)
                ->where('policy_id','>',0)
                ->with('policy.tags')
                ->has('policy')->with('policy.seller_policy')
            ->with(['policy.paid_user'=>function($qr){
                $qr->join('users','matching_users.user_id', '=', 'users.id')
                ->where('users.manage_flag',0)
                ->orderBy('users.payroll', 'desc')
                ->orderBy('users.evaluate', 'desc')
                ->orderBy('matching_users.order_type', 'asc');
            }])
            ->with(['policy.matchingUser'=>function($qr){
                $qr->join('users','matching_users.user_id', '=', 'users.id')
                ->where('users.manage_flag',0)
                ->whereNotExists(function($query)
                    {
                        $query->select(DB::raw(1))
                              ->from('post')
                              ->whereRaw('matching_users.policy_id = post.policy_id')
                              ->whereRaw('matching_users.user_id =  post.user_id')
                              ->whereRaw('post.display != 1');
                    });
            }]);
        }else if($action==0){
            $results = VisitPolicy::with(['policy'=>function($qr){
            $qr->where('publication_setting', 0);
        }])
                ->where('user_id',$user_id)
                ->where('policy_id','>',0)
                ->with('policy.tags')
                ->has('policy')->with('policy.seller_policy')
                ->with(['policy.paid_user'=>function($qr){
                    $qr->join('users','matching_users.user_id', '=', 'users.id')
                    ->where('users.manage_flag',0)
                    // ->select('users.image as uname','users.displayname','users.result','users.evaluate','users.payroll','users.self_intro')
                    ->orderBy('users.payroll', 'desc')
                    ->orderBy('users.evaluate', 'desc')
                    ->orderBy('matching_users.order_type', 'asc');
                }])
                ->with(['policy.matchingUser'=>function($qr){
                    $qr->join('users','matching_users.user_id', '=', 'users.id')
                    ->where('users.manage_flag',0)
                    ->whereNotExists(function($query)
                        {
                            $query->select(DB::raw(1))
                                  ->from('post')
                                  ->whereRaw('matching_users.policy_id = post.policy_id')
                                  ->whereRaw('matching_users.user_id =  post.user_id')
                                  ->whereRaw('post.display != 1');
                        });
                }])->orderBy('id','desc');
        }
        if($order == 0){
            $results = $results->whereHas('policy',function($qr){
                return $qr->orderBy('policy.created_date','desc')->orderBy('policy.id','desc');
            });
        } else if ($order == 1) {
            $results = $results->whereHas('policy',function($qr){
                return $qr->orderBy('policy.acquire_budget_display','desc')->orderBy('policy.id','desc');
            }); 
        } else if($order == 2){
            $results = $results->whereHas('policy',function($qr){
                return $qr->orderBy('policy.acquire_budget_display','asc')->orderBy('policy.id','desc');
            }); 
        } else {
            $results = $results->whereHas('policy',function($qr){
                return $qr->orderBy('policy.id','desc');
            });
        }
        $results = $results->orderBy('id','desc')
        ->paginate($per_page);
        $payroll = User::find($user_id)->payroll;
        return view("Agency::Bpage.subsidylist_1", ["results" => $results, 'payroll'=>$payroll]);
    }
    /**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   get View Index
    *   @return     :
    */
    public function getBsearch(Request $request)
    {
        $categorys = Category::with(['subcategory'=>function($qr){
            $qr->where('display', 1);
        }])->get();
        $regions = DB::table('provinces')->where('is_ministry', 0)->select('id','province_name' )->orderBy('is_ministry', 'asc')->orderBy('order_by', 'desc')->orderBy('id', 'asc')->get();
        $address_ministry = DB::table('address_ministry')->select('address_ministry.id', 'address_ministry.province')->get();
        $trades = DB::table('trades')->select('trades.id', 'trades.trade')->where('display',1)->orderBy('order', 'asc')->get();

        $user_id = session('user_id');
        $current_date = date('Y-m-d');
        (!empty($request->order)) ? $order = $request->order : $order = 0;
        (!empty($request->per_page)) ? $per_page = $request->per_page : $per_page = 10;
        $results = [];
        if($request->searchtype) {
            $contents = @$request->contents;
            $category = @$request->category;
            $categorysubs = @$request->categorysubs;
            $region = @$request->region;
            $cities = @$request->cities;
            $keyword = @$request->keyword;
            $business_type = $request->business_type;
            $q_tag = $request->query('tags',[]);
            $values = Policy::with(['cat','subCat','provinces','User','policy_business', 'matching_user_search'])
            ->where('policy.publication_setting','=', 0)
            ->where(function($qr){
                $current_date = date('Y-m-d');
                $qr->where('subscript_duration_detail','=','0000-00-00')
                    ->orWhere('subscript_duration_detail','>=',$current_date);
            })
            ->with('tags')
            ->with('seller_policy')
            ->with(['paid_user'=>function($qr){
                $qr->join('users','matching_users.user_id', '=', 'users.id')
                ->where('users.manage_flag',0)
                ->orderBy('users.payroll', 'desc')
                ->orderBy('users.evaluate', 'desc')
                ->orderBy('matching_users.order_type', 'asc');
            }])
            ->with(['matchingUser'=>function($qr){
                $qr->join('users','matching_users.user_id', '=', 'users.id')
                ->where('users.manage_flag',0)
                ->whereNotExists(function($query)
                    {
                        $query->select(DB::raw(1))
                              ->from('post')
                              ->whereRaw('matching_users.policy_id = post.policy_id')
                              ->whereRaw('matching_users.user_id =  post.user_id')
                              ->whereRaw('post.display != 1');
                    });
            }]);

            $values = $values->whereHas('matching_user_search',function($qr){
                return $qr->with(['post']);
            });
            // dd($values->paginate(10));
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
            if($keyword) {
                $values = $values->where('policy.name', 'LIKE', '%'.$keyword.'%');
            }

                // if($request->location){
                //     $values = $values->whereIn('location',$request->location);
                // }
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
                    return $qr->whereIn('policy_id',$business_type);
                });
            }

            $check = [];
            if($order == 0){
                $values = $values->orderBy('policy.created_date','desc')->orderBy('policy.id','desc');
            } else if ($order == 1) {
                $values = $values->orderBy('policy.acquire_budget_display','desc')->orderBy('policy.id','desc'); 
            } else if($order == 2){
                $values = $values->orderBy('policy.acquire_budget_display','asc')->orderBy('policy.id','desc');
            } else {
                $values = $values->orderBy('policy.id','desc');
            }
            $results = $values->orderBy('id','desc')
            ->with('tags','minitry','sub_minitry', 'cat', 'checklist_policy_user', 'hire', 'policy_region_many', 'policy_region_many.province', 'policy_region_many.city')
            ->paginate($per_page);
        }
        $payroll = User::find($user_id)->payroll;
        // dd($results);
        return view("Agency::Bpage.search", ['categorys'=>$categorys, 'regions'=>$regions, 'address_ministry'=>$address_ministry, 'trades'=>$trades, 'results'=>$results,  'payroll'=>$payroll]);
    }
    /**
    *   Created by  :   vanluuit - 17/10/2018 
    *   Description :   ajax get city in region
    *   @return     :
    */
    public function ajaxGetRegion()
    {
        $rerult = [];
        $regions = DB::table('provinces')->select('id','province_name' )->get();
        foreach ($regions as $key => $region) {
            $rerult[$region->id] = $region->province_name;
        }
        echo json_encode($rerult);die();
    }
    /**
    *   Created by  :   vanluuit - 17/10/2018 
    *   Description :   ajax get city in region
    *   @return     :
    */
    public function ajaxGetCity(Request $request)
    {
        $rerult = [];
        $region = $request->name;
        $cities = DB::table('cities')->select('id', 'city_name')->where('province_id',$region)->get();
        foreach ($cities as $key => $citie) {
            $rerult[$citie->id] = $citie->city_name;
        }
        echo json_encode($rerult);die();
    }
    /**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   get View Index
    *   @return     :
    */
    public function getBselect(Request $request)
    {

        $user_id = session('user_id');
        $searchtype = @$request->searchtype;
        if(!$searchtype) $searchtype = 1;
        $policy_id = $request->policy_id;
        $policy_data = Policy::with(['hire'=>function($qr){
            $qr->where('accept',1);
        }])->where('id',$policy_id)->first();

        $results = [];
        if($searchtype == 1) {
            $results = $this->get_matched_users($policy_id);
        }else{
            $results = DB::table('post_agency')->join('users', 'users.id', '=', 'post_agency.user_id')->where('post_agency.policy_id', $policy_id)->select('users.*')->distinct()->get();
        }
        if ($user_id) {
            if ($policy_id>0) {
                Log::info("session users_id:".$user_id."aa");
                DB::table('visit_policy')->where('user_id',$user_id)->where('policy_id', $policy_id)->delete();
                DB::table('visit_policy')->insert(['user_id'=>$user_id, 'policy_id'=>$policy_id]);
            }
        }
        // dd($results);
        return view("Agency::Bpage.select", ['policy_data'=>$policy_data, 'results'=>$results]);
    }
    /**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   get View Index
    *   @return     :
    */
    public function getRequestDetails(Request $request)
    {
        $user_id = $request->user_id;
        $searchtype = $request->searchtype;
        if(!$searchtype) $searchtype = 1;
        $policy_id = $request->policy_id;
        $policy_data = Policy::where('id',$policy_id)->first();
        if(!$policy_data)  return back();
        $results = [];
        if($searchtype == 1) {
            $results = $this->get_matched_users($policy_id);
        }else{
            $results = DB::table('post_agency')->join('users', 'users.id', '=', 'post_agency.user_id')->where('post_agency.policy_id', $policy_id)->select('users.*')->distinct()->get();
        }

        $user = User::where('id',$user_id)->first();
        if(!$user)  return back();
        $user->user_id = md5($user->id);

        $user->request_count = 3; 
        $user->eval1 = 3;
        $user->eval2 = 3;
        $user->eval_good = 5;
        $user->save_money = 500;  
        $user->request_ratio = 500; 
        $user->money_ratio = 500; 
        $user->auth_state = 'OKAY';  
        $user->state_project = 3; 
        $user->submit_count = 3; 
        $day = strtotime(DB::table('user_login_info')->where('user_id', $user_id)->first()->login_day);
        $current_day = time();
        $diff= $current_day- $day;
        $user->last_login = floor($diff/(60*60*24));


        $feedbacks = DB::table('feedback')
            ->leftJoin('hire', 'hire.id', '=', 'feedback.hire_id')
            ->leftJoin('policy','policy.id','=','hire.policy_id')
            ->where('feedback.to_id',$user_id)
            ->where('feedback.display',1)
            ->select('feedback.*','policy.image_id as image','policy.name','policy.name_serve','policy.support_content','policy.id as policy_id')
            ->paginate(10);
            $mypage = new MypageController;
        $profile_completed = $mypage->calculatorProfile($user_id);
        // dd($profile_completed);
        return view("Agency::Bpage.requestdetails", ['policy_data'=>$policy_data, 'user'=>$user, 'results'=>$results, 'policy_id'=>$policy_id, 'feedbacks'=>$feedbacks, 'profile_completed'=>$profile_completed]);
    }
    /**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   get View Index
    *   @return     :
    */
    public function getEvaluationAchievements(Request $request)
    {
        $user_id = $request->user_id;
        $searchtype = $request->searchtype;
        if(!$searchtype) $searchtype = 1;
        $policy_id = $request->policy_id;
        $policy_data = Policy::where('id',$policy_id)->first();
        if(!$policy_data)  return back();
        $results = [];
        if($searchtype == 1) {
            $results = $this->get_matched_users($policy_id);
        }else{
            $results = DB::table('post_agency')->join('users', 'users.id', '=', 'post_agency.user_id')->where('post_agency.policy_id', $policy_id)->select('users.*')->distinct()->get();
        }
        $user = User::with(['cat'=>function($qr){
            $qr->with(['subcategory' => function($sqr){
                $sqr->where('detail_question','<>','');
            }])->groupBy('category_id');
        }])->where('id',$user_id)->first();
        if(!$user)  return back();
        $user->user_id = md5($user->id);
        $user->request_count = 3; 
        $user->eval1 = 3;
        $user->eval2 = 3;
        $user->eval_good = 5;
        $user->save_money = 500;  
        $user->request_ratio = 500; 
        $user->money_ratio = 500; 
        $user->auth_state = 'OKAY';  
        $user->state_project = 3; 
        $user->submit_count = 3; 
        $day = strtotime(DB::table('user_login_info')->where('user_id', $user_id)->first()->login_day);
        $current_day = time();
        $diff= $current_day- $day;
        $user->last_login = floor($diff/(60*60*24));
        $tags = DB::table('tags')->select('tag')->distinct()->get();
        $client_data = [];
        $client_data_exist = "failed";
        if ($user->manage_flag == 0) {
            $client_data = DB::table('users_client_data')->where('user_id',$user_id)->first();
            if ($client_data) {
                $client_data_exist = "success";
                $client_data = json_decode($client_data->category_content, true);
            }
        }
        $mypage = new MypageController;
        $profile_completed = $mypage->calculatorProfile($user_id);
        // dd($client_data);
        return view("Agency::Bpage.evaluationachievements", ['policy_data'=>$policy_data,'user'=>$user, 'results'=>$results, 'policy_id'=>$policy_id,'tags'=>$tags, "client_data_exist"=>$client_data_exist,"client_data"=>$client_data , 'profile_completed'=>$profile_completed]);
    }
    /**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   get View Index
    *   @return     :
    */
    public function getAvailablebusiness(Request $request)
    {
        $user_id = $request->user_id;
        $searchtype = $request->searchtype;
        if(!$searchtype) $searchtype = 1;
        $policy_id = $request->policy_id;
        $policy_data = Policy::where('id',$policy_id)->first();
        if(!$policy_data)  return back();
        $results = [];
        if($searchtype == 1) {
            $results = $this->get_matched_users($policy_id);
        }else{
            $results = DB::table('post_agency')->join('users', 'users.id', '=', 'post_agency.user_id')->where('post_agency.policy_id', $policy_id)->select('users.*')->distinct()->get();
        }

        $user = User::with(['cat'=>function($qr){
            $qr->with(['subcategory' => function($sqr){
                $sqr->where('detail_question','<>','');
            }])->groupBy('category_id');
        }])->where('id',$user_id)->first();
        if(!$user)  return back();
        $user->user_id = md5($user->id);

        $user->request_count = 3; 
        $user->eval1 = 3;
        $user->eval2 = 3;
        $user->eval_good = 5;
        $user->save_money = 500;  
        $user->request_ratio = 500; 
        $user->money_ratio = 500; 
        $user->auth_state = 'OKAY';  
        $user->state_project = 3; 
        $user->submit_count = 3; 
        $day = strtotime(DB::table('user_login_info')->where('user_id', $user_id)->first()->login_day);
        $current_day = time();
        $diff= $current_day- $day;
        $user->last_login = floor($diff/(60*60*24));

        $a['result'] = $user->result;
        $a['evaluate'] = $user->evaluate;
        $current = date('Y-m-d');
        $today = date('Y-m-d', strtotime("-1 month", strtotime(date('Y-m-d'))));
        $yesterday = date('Y-m-d', strtotime("-6 month", strtotime(date('Y-m-d'))));
        // dd($today);
        $a['state_project'] = DB::table('hire')->where('from_id', $user_id)->where('finish_flag',0)->where('accept',1)
            ->orWhere(function ($query) use ($user_id)
            {
                $query->where('to_id', $user_id)->where('finish_flag',0)->where('accept',1);
            })->get()->count();

        $a['direct_request']= DB::table('hire')->where('from_id', $user_id)->where('submit_type',0)->where('accept',1)
            ->count();

        $a['result_a_month'] = DB::table('hire')->where('from_id',$user_id)->where('finish_flag',1)->whereDate('finish_date', '>=', $today)
            ->orWhere(function ($query) use ($user_id,$today)
            {
                $query->where('to_id', $user_id)->where('finish_flag',1)->whereDate('finish_date', '>=', $today);
            })->get()->count();

        $a['result_a_half_year'] = DB::table('hire')->where('from_id',$user_id)->where('finish_flag',1)->whereDate('finish_date', '>=', $yesterday)
            ->orWhere(function ($query) use ($user_id,$yesterday)
            {
                $query->where('to_id', $user_id)->where('finish_flag',1)->whereDate('finish_date', '>=', $yesterday);
            })->get()->count();

        $a['evaluate_a_month'] = DB::table('feedback')->where('to_id',$user_id)->whereDate('created_date','>=',$today)->select(DB::Raw('SUM(eval_total) as total'))->first()->total;
        $a['evaluate_a_half_year'] = DB::table('feedback')->where('to_id',$user_id)->whereDate('created_date','>=',$yesterday)->select(DB::Raw('SUM(eval_total) as total'))->first()->total;
        if(!$a['evaluate_a_month']) $a['evaluate_a_month'] = 0;
        if(!$a['evaluate_a_half_year']) $a['evaluate_a_half_year'] = 0;
        $mypage = new MypageController;
        $profile_completed = $mypage->calculatorProfile($user_id);
        return view("Agency::Bpage.availablebusiness", ['policy_data'=>$policy_data,'user'=>$user, 'results'=>$results, 'policy_id'=>$policy_id, 'ratingdisplaydata'=>$a, 'profile_completed'=>$profile_completed]);
    }
    /**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   get View Index
    *   @return     :
    */
    public function getApplicableMeasures(Request $request)
    {
        $user_id = $request->user_id;
        $searchtype = $request->searchtype;
        if(!$searchtype) $searchtype = 1;
        $policy_id = $request->policy_id;
        $policy_data = Policy::where('id',$policy_id)->first();
        if(!$policy_data)  return back();
        $results = [];
        if($searchtype == 1) {
            $results = $this->get_matched_users($policy_id);
        }else{
            $results = DB::table('post_agency')->join('users', 'users.id', '=', 'post_agency.user_id')->where('post_agency.policy_id', $policy_id)->select('users.*')->distinct()->get();
        }

        $user = User::with(['cat'=>function($qr){
            $qr->with(['subcategory' => function($sqr){
                $sqr->where('detail_question','<>','');
            }])->groupBy('category_id');
        }])->where('id',$user_id)->first();
        if(!$user)  return back();
        $user->user_id = md5($user->id);

        $user->request_count = 3; 
        $user->eval1 = 3;
        $user->eval2 = 3;
        $user->eval_good = 5;
        $user->save_money = 500;  
        $user->request_ratio = 500; 
        $user->money_ratio = 500; 
        $user->auth_state = 'OKAY';  
        $user->state_project = 3; 
        $user->submit_count = 3; 
        $day = strtotime(DB::table('user_login_info')->where('user_id', $user_id)->first()->login_day);
        $current_day = time();
        $diff= $current_day- $day;
        $user->last_login = floor($diff/(60*60*24));

        $posts = Post::with(['policy','hire'=>function($qr)use($user_id){
            $qr->where('from_id',$user_id)->orWhere('to_id',$user_id);
        }])
            ->where('user_id', $user_id)->has('policy')
            ->paginate(10);
        foreach ($posts as $key => $post) {
            $cc = count($post->hire);
            $posts[$key]->request_count = $cc.'本';
            $date1 = date_create($post->complete_date);
            $cur_date = date('Y-m-d');
            $date2 = date_create(/*$posts->post_date*/$cur_date);
            $remain_time = date_diff($date1, $date2);

            $posts[$key]->remain_time = $remain_time->format('%a日 %h時間');
            $posts[$key]->service_content = $post->title;
            $document_business_price = 0;
            $request_business_price = 0;
            if ((int) $post->document_business_type == 0)
                $document_business_price = (int)$post->document_business_price;
            else
                $document_business_price = (int)$post->document_business_price * 1000;
            if ((int) $post->request_business_type == 0)
                $request_business_price = (int) $post->request_business_price;
            else
                $request_business_price = (int)$post->request_business_price * 1000;
            $posts[$key]->calc_business = $document_business_price + $request_business_price;
            if ($post->calc_business == 0)
                $posts[$key]->calc_business="なし";
            else
                $posts[$key]->calc_business.="円";

            Log::info($post);
        }
        $mypage = new MypageController;
        $profile_completed = $mypage->calculatorProfile($user_id);
            // dd($posts);
        return view("Agency::Bpage.applicablemeasures", ['policy_data'=>$policy_data,'user'=>$user, 'results'=>$results, 'policy_id'=>$policy_id, 'posts'=>$posts, 'profile_completed'=>$profile_completed]);
    }
    /**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   get View Index
    *   @return     :
    */
    // public function getBask()
    // {
    //     return redirect('/agency/');
    //     // return view("Agency::Bpage.bask");
    // }
    /**
    *   Created by  :   vanluuit - 20/08/2018 
    *   Description :   get View Index
    *   @return     :
    */
    public function getBask(Request $request)
    {
        $user_id = session('user_id');
        $ids = $request->usercheck;
        if(!$ids) return back();
        $policy_id = $request->policy_id;
        $searchtype = @$request->searchtype;
        if(!$searchtype) $searchtype = 0;
        $policy_data = Policy::where('id',$policy_id)->first();
        $results = [];

        if($searchtype == 1) {
            $results = DB::table('matching_users')->join('users', 'matching_users.user_id', '=', 'users.id')->where('users.manage_flag', 0 )->whereIn('matching_users.policy_id', $policy_id)                        ->whereNotExists(function($query)
                        {
                            $query->select(DB::raw(1))
                                  ->from('post')
                                  ->whereRaw('matching_users.policy_id = post.policy_id')
                                  ->whereRaw('matching_users.user_id =  post.user_id')
                                  ->whereRaw('post.display != 1');
                        })->whereIn('matching_users.user_id',$ids)
            ->select('users.*')->orderBy('matching_users.order_type', 'asc')->distinct()->get();
            // dd($results);
        }else{
             $results = DB::table('matching_users')->join('users', 'matching_users.user_id', '=', 'users.id')->where('users.manage_flag', 0)->whereIn('matching_users.policy_id', $policy_id)->select('users.*')->orderBy('matching_users.order_type', 'asc')->distinct()->get();
        }
        $to = '';
        $to_id = '';
        foreach ($results as $key => $result) {
            if($key < count($results)-1) { $to .= $result->displayname . ',';  $to_id .= $result->id . '_';}
            else { $to .= $result->displayname; $to_id .= $result->id;}
        }
        $datato['to'] = $to;
        $datato['to_id'] = $to_id;
        // dd($to);
        $user = DB::table('users')->select('set_cost')->where('id', $user_id)->first();
        if(!$user) return back();
        $saved_budgets = json_decode($user->set_cost, true);
        // dd($policy_id);
        $url = URL::signedRoute('agency.csetbalance', ['policy_id'=>$policy_id]);
        $param = explode('?', $url)[1];
        return view("Agency::Bpage.bask", ['saved_budgets'=>$saved_budgets,'results'=>$results, 'policy_id'=>$policy_id, 'datato'=>$datato, 'policy_data'=>$policy_data, 'param'=>$param]);
    }

        /**
    *   Created by  :   vanluuit - 20/08/2018 
    *   Description :   get View Index
    *   @return     :
    */
    public function postBaskMess(Request $request)
    {
        $flag = $request->flag;
        $user_id = session('user_id');
        $user = DB::table('users')->where('id',$user_id)->first();
        $policy_ids = $request->policy_id;
        // echo json_encode($policy_ids);die();
        $to_ids = explode('_', $request->to_ids);
        $submit_type = $request->searchtype;
        $data['message'] = $request->contentmess;
        $data['document_business_price'] = 0;
        $data['document_business_type'] = 0;
        $data['request_business_price'] = 0;
        $data['request_business_type'] = 0;
        $data['deposit_setting'] = 0;
        $data['deposit_money'] = 0;
        $data['other_money'] = 0;
        $data['other_money_sub'] = json_encode([],JSON_UNESCAPED_UNICODE);
        $data['content_type'] = json_encode([],JSON_UNESCAPED_UNICODE);
        $data['accept'] = 2;
        $data['cost_client'] = @$request->cost_client;
        if(!$data['cost_client']) $data['cost_client']=0;
        $data['cost_agency'] = @$request->cost_agency;
        if(!$data['cost_agency']) $data['cost_agency']=0;
        
        Log::info("hire_submit");
        Log::info("request = $request");
        Log::info("flag = $flag");
        $rs = Bask::hire_submit($data, $flag, $user_id, $to_ids, $policy_ids,  $submit_type);
        $files= $request->file('attachment');
        $imgpath = [];
        if($request->hasFile('attachment')) {
            foreach ($files as $key => $file) {
                $uploadedFile = $file;
                $path = 'assets/attach/'.date('Y_m_d');
                $fileName = $key.md5(date('Y-m-d-his')).'.'.$uploadedFile->getClientOriginalExtension();
                $uploadedFileName = UploadFile::upload($path, $uploadedFile, $fileName);
                $imgpath[] = $uploadedFileName;
            }
            foreach ($rs['ids'] as $key => $id_) {
                DB::table('message')->where('id', $id_)->update(['file'=>json_encode($imgpath,JSON_UNESCAPED_UNICODE)]);
            }
        }
        $hire_id = $rs['hire_id'];
        Log::info("k28_message_all_sub");
        Log::info("user_id = $user_id");
        Log::info("hire_id = $hire_id");
        $result = DB::table('message')
            ->where('message.flag','<=',1)
            ->where('message.to_id', $user_id)
            ->where('message.hire_id',$hire_id)
            ->orWhere(function ($query) use ($user_id,$hire_id)
            {
                $query->where('message.from_id', $user_id)
                    ->where('message.flag','<=',1)
                    ->where('message.hire_id',$hire_id);
            })
            ->join('users', function($join) use($user_id)
            {
                $join->on('users.id','=','message.from_id')
                    ->where('message.to_id',$user_id);
                $join->orOn('users.id','=','message.to_id')
                    ->where('message.from_id',$user_id);
            })
            ->join('policy','policy.id','=','message.policy_id')
            ->join('hire','hire.id','=','message.hire_id')
            ->select('message.id as message_id','message.from_id','message.to_id',
                'users.displayname','users.image as user_image','policy.name as policy_name',
                'message.message','message.file','message.update_date','message.accept as message_accept',
                'message.flag as message_flag')->get();
        $read = DB::table('message')->where([
            ['to_id', '=', $user_id],
            ['hire_id', '=', $hire_id]
        ])->update(['flag' => 1]);

        $result = json_encode($result, JSON_NUMERIC_CHECK);
        echo $result;die();
    }
        /**
    *   Created by  :   vanluuit - 20/08/2018 
    *   Description :   get View Index
    *   @return     :
    */
    public function postBaskbutton(Request $request)
    {
        // echo json_encode($request->all());die();
        $flag = @$request->flag;
        $user_id = session('user_id');
        $policy_ids = $request->policy_id;
        $to_ids = $request->usercheck;
        $submit_type = $request->searchtype;
        $message = $request->mess;
        $deli_date = str_replace(['年','月','日'] , ['-','-',''] ,$request->deli_date);
        $deposit_money = $request->deposit_money;
        $agency_estimate = $request->agency_estimate;
        $client_pay = $request->client_pay;
        $cost_client = @$request->cost_client;
        if(!$cost_client) $cost_client=0;
        $cost_agency = @$request->cost_agency;
        if(!$cost_agency) $cost_agency=0;
        $cur_date = date("Y-m-d");
        $idsArray=[];
        $check = (int)$submit_type;
        foreach ($to_ids as $k => $to_id) {
            foreach ($policy_ids as $kk => $policy_id) {
                $dt = [
                    'from_id'=>$to_id,
                    'to_id'=>$user_id,
                    'policy_id'=>$policy_id,
                    'finish_flag'=>0
                ];
                if($check == 1) {
                    $dt['submit_type'] = 1;
                }else{
                    $ex_dt['accept'] = 0;
                }

                $ex_dt = [
                    'deli_date'=>$deli_date,
                    'cost_client'=>$cost_client,
                    'cost_agency'=>$cost_agency,
                    'update_date'=>$cur_date,
                    'deposit_money'=>$deposit_money,
                    'agency_estimate'=>$agency_estimate,
                    'client_pay'=>$client_pay
                ];
                if($check == 1) {
                    $ex_dt['submit_type'] = 1;
                }
                $last_id = Hire::updateOrCreate($dt,$ex_dt);
                Event::fire(new HireClientEvent('create',$last_id->id));
                // echo json_encode($last_id);die();
                if($submit_type==1 && $message){
                    $datames['from_id'] = $user_id;
                    $datames['to_id'] = $to_id;
                    $datames['policy_id'] = $policy_id;
                    $datames['hire_id'] = $last_id->id;
                    $datames['message'] = $message;
                    $datames['update_date'] = $cur_date;
                    $datames['created_at'] = date('Y-m-d h:i:s');
                    $last_id_m = DB::table('message')->insertGetId($datames);
                    $idsArray[]= $last_id_m;

                    if (!DB::table('message_allow')->where('user_id', $to_id)->where('to_id',$user_id)->first()) {
                        DB::table('message_allow')->insert(['user_id'=>$user_id, 'to_id'=>$to_id, 'allow'=>'1']);
                    }
                    if (!DB::table('message_allow')->where('user_id', $to_id)->where('to_id',$user_id)->first()) {
                        DB::table('message_allow')->insert(['user_id'=>$user_id, 'to_id'=>$to_id, 'allow'=>'1']);
                    }
                    $this->mailsend($user_id,$to_id,$policy_id);
                }else{
                    // delete function
                }
            }
        }
        $data['hire_id'] = $last_id->id;
        $data['count'] = count($idsArray);
        echo json_encode($data); die();
    }

    public function ajaxGetUserList(Request $request) {
        $uids = @$request->user_ids;
        if($uids) {
            $list_user = User::whereIn('id', $uids)->select('id','image','displayname','result','self_intro')->get();
        }
        echo json_encode($list_user, true);die();
    }
    public function ajaxGetToName(Request $request) {
        $to = '';
        $uids = @$request->user_ids;

        if($uids) {
            $ids = explode('_', $uids);
            $searchtype = $request->searchtype;
            if($searchtype == 1) {
                $results = DB::table('matching_users')->join('users', 'matching_users.user_id', '=', 'users.id')->where('users.manage_flag', 0 )->whereIn('matching_users.user_id',$ids)
                ->select('users.*')->orderBy('matching_users.order_type', 'asc')->distinct()->get();
            }else{
                $results = DB::table('post_agency')->join('users', 'users.id', '=', 'post_agency.user_id')->whereIn('matching_users.user_id',$ids)->select('users.*')->distinct()->get();
            }
            
            foreach ($results as $key => $result) {
                if($key < count($results)-1) { $to .= $result->displayname . ',';}
                else { $to .= $result->displayname;}
            }
        }
        echo $to;die();
    }

    public function get_matched_users($policy_id, $user_type = 0){
        $matched_users = [];
        $matched_users = DB::table('matching_users')->join('users', 'matching_users.user_id', '=', 'users.id')->where('users.manage_flag', $user_type )->where('matching_users.policy_id', $policy_id)                        ->whereNotExists(function($query)
                        {
                            $query->select(DB::raw(1))
                                  ->from('post')
                                  ->whereRaw('matching_users.policy_id = post.policy_id')
                                  ->whereRaw('matching_users.user_id =  post.user_id')
                                  ->whereRaw('post.display != 1');
                        }) ->select('users.*')->orderBy('matching_users.order_type', 'asc')->distinct()->get();
        return $matched_users;
    }
    public function baskredirect(Request $request){
        return view("Agency::Bpage.baskredirect");
    }

    public function likepolicy(Request $request){
        $user_id = session('user_id');
        if(!$user_id) {echo 'error';die();}
        $policy_id = $request->policy_id;
        $like = $request->like;
        if($like == '1') $like = '0';
        else $like = '1';
        $checklist_data = DB::table('checklist_policy_user')->where('user_id',$user_id)->where('policy_id',$policy_id)->first();
        if($checklist_data) {
            $rs = DB::table('checklist_policy_user')->where('id', $checklist_data->id)->update(['type'=>$like]);
        }else{
            $rs = DB::table('checklist_policy_user')->insert(['type'=>$like]);
        }
        echo $like;die();
    }

    public static function mailsend($from_id, $to_id, $policy_id)
    {
        $from = DB::table('users')->where('id',$from_id)->first();
        $to = DB::table('users')->where('id',$to_id)->first();
        if ($from->manage_flag == 1) {

            $mail_data_from['mail_address_to'] = $from->e_mail;
            $mail_data_from['mail_name_to'] = $from->displayname;
            $mail_data_from['subject'] = 'samurai：新着の提案があります';
            
            $text_from = "
            {$to->displayname}様への提案を受け付けました。<br>
            下記よりログインし、ご確認いただけます。<br><br>
    
            <a href=\"https://samurai-match.jp/\">https://samurai-match.jp/</a>
            ";
            // echo json_encode($text_from, true);die();
            Mail::send('Agency::Bpage.mailtemp', ['text' => $text_from], function ($m) use ($mail_data_from) {
                $m->to($mail_data_from['mail_address_to'], $mail_data_from['mail_name_to'])->subject($mail_data_from['subject']);
            });
            // echo json_encode($policy, true);die();
            $mail_data_to['mail_address_to'] = $to->e_mail;
            $mail_data_to['mail_name_to'] = $to->displayname;
            $mail_data_to['subject'] = 'samurai：新着の提案がありました';
            
            $text_to = "
            {$from->displayname}様から提案が届いております。<br>

            下記よりログインし、ご確認いただけます。<br><br>
    
            <a href=\"https://samurai-match.jp/\">https://samurai-match.jp/</a>
            ";
    
            Mail::send('Agency::Bpage.mailtemp', ['text' => $text_to], function ($m) use ($mail_data_to) {
                $m->to($mail_data_to['mail_address_to'], $mail_data_to['mail_name_to'])->subject($mail_data_to['subject']);
            });
        
        } else {
            $policy = DB::table('policy')->where('id',$policy_id)->first();
            $mail_data_from['mail_address_to'] = $from->e_mail;
            $mail_data_from['mail_name_to'] = $from->displayname;
            $mail_data_from['subject'] = 'samurai：新着の依頼がありました';
            
            $text_from = "
            {$from->displayname}様から{$policy->name}の依頼を受け付けました。<br>

            下記からログインし、案件の進行を行いましょう！<br><br>
    
            <a href=\"https://samurai-match.jp/\">https://samurai-match.jp/</a>
            ";

            Mail::send('Agency::Bpage.mailtemp', ['text' => $text_from], function ($m) use ($mail_data_from) {
                $m->to($mail_data_from['mail_address_to'], $mail_data_from['mail_name_to'])->subject($mail_data_from['subject']);
            });

            $mail_data_to['mail_address_to'] = $to->e_mail;
            $mail_data_to['mail_name_to'] = $to->displayname;
            $mail_data_to['subject'] = 'samurai：新着の依頼があります';
            
            $text_to = "
            {$from->displayname}様から仕事の依頼が届いています。<br><br>

            下記よりログインし、ご確認くださいませ。<br><br>
    
            <a href=\"https://samurai-match.jp/\">https://samurai-match.jp/</a>
            ";
    
            Mail::send('Agency::Bpage.mailtemp', ['text' => $text_to], function ($m) use ($mail_data_to) {
                $m->to($mail_data_to['mail_address_to'], $mail_data_to['mail_name_to'])->subject($mail_data_to['subject']);
            });
        }
    }

    public function getBreport(Request $request){
        return view("Agency::Bpage.breport");
    }
    
    public function postBreport(Request $request){
        $user_id = session('user_id');
        $report_id = $request->report_id;
        $report_option = $request->reportway;
        $message1 = $request->message;
        $user =  DB::table('users')->where('id', session('user_id'))->first();
        $reported_user_name =  DB::table('users')->where('id', $report_id)->first()->displayname;

        // $userdata = DB::table('users')->where('id', $user_id)->first();
        // $mail_data['mail_address_to'] = $userdata->e_mail;
        // $mail_data['mail_name_to'] = $userdata->displayname;
        // $mail_data['subject'] = 'samurai：違反報告の受け付け';
        // $text = "

        // この度は情報のご提供ありがとうございます。<br><br>

        // {$reported_user_name}様への違反報告を受け付けました。<br><br>

        // 違反者通報に関しまして、事務局で内容を確認させていただきます。<br>
        // 違反報告の内容を事務局からお聞きする場合がありますのでよろしくお願いいたします。<br><br>

        // ご協力いただきまして誠にありがとうございます。

        // ";
        // Mail::send('Agency::Bpage.mailtemp', ['text' => $text], function ($m) use ($mail_data_to) {
        //         $m->to($mail_data_to['mail_address_to'], $mail_data_to['mail_name_to'])->subject($mail_data_to['subject']);
        //     });

        Mail::send('Agency::Bpage.mailtemp', ['text' => ""], function ($m) use ($mail_data_to) {
                $m->to('ihanhoukoku@samurai-match.jp', 'SAMURAI')->subject('samurai：違反報告の受け付け');
            });
        Mail::queue(new \App\Mail\SendReportUser($user));
        
        $data = [
            'user_id' => $user_id,
            'report_id' => $report_id,
            'report_option' => $report_option,
            'message' => $message1,
        ];
        $rs = DB::table('report')->insert($data);
        if($rs) echo 'success';
        else echo 'error';
        die();
    }
    public function getBreportcompletion(Request $request){
        return view("Agency::Bpage.breportcompletion");
    }
}