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
            $results = $values->orderBy('id','desc')->paginate($per_page);
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
        (!empty($request->per_page)) ? $per_page = $request->per_page : $per_page = 10;
        (!empty($request->order)) ? $order = $request->order : $order = 0;
        $user_id    =   session('user_id');
        if($action==2){
            $results = Hire::with(['policy'])
            ->where('accept',1)->orderBy('id','desc')
            ->has('policy')->with('policy.tags');
            // dd($results->paginate(10));
        }else if($action==1){
            $results = CheckListPolicyUser::with(['policy'])
                ->where('user_id',$user_id)
                ->where('type','<',2)
                ->where('policy_id','>',0)
                ->with('policy.tags')
                ->has('policy');
        }else if($action==0){
            $results = VisitPolicy::with(['policy'])
                ->where('user_id',$user_id)
                ->where('policy_id','>',0)
                ->with('policy.tags')
                ->has('policy')
                ->orderBy('id','desc');
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
        $results = $results->orderBy('id','desc')->paginate($per_page);
        // dd($results);
        $payroll = User::find($user_id)->payroll;
        foreach ($results as $key => $result) {
            $term_display = 1;
            if($payroll==0) {
                if(strpos($result->policy->acquire_budget, '0')) $term_display = 1;
                else $term_display = 0;
            }
            $results[$key]->term_display = $term_display;
            $first = DB::table('seller_policy')->where('policy_id',$result->policy->id)->where('user_id','<>',$user_id)->inRandomOrder()->first();

            $vv = "failed";
            if ($first){
                $vv = "success";
                $results[$key]->seller_count = DB::table('seller_policy')->where('policy_id',$result->policy->id)->where('user_id','<>',$user_id)->groupBy('user_id')->count();
                // $results[$key]->seller = DB::table('seller')->where('id',$first->id)->first();
            }
            $results[$key]->seller_exist_flag = $vv;
            $results[$key]->count_general = DB::table('matching_users')->join('users','matching_users.user_id', '=', 'users.id')
                ->where('matching_users.policy_id',$result->policy->id)->where('users.manage_flag',0)
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
                ->where('matching_users.policy_id',$result->policy->id)->where('users.manage_flag',0)
                ->select('users.id','users.image','users.displayname','users.result','users.evaluate','users.payroll','users.self_intro')
                ->orderBy('users.payroll', 'desc')
                ->orderBy('users.evaluate', 'desc')
                ->orderBy('matching_users.order_type', 'asc')
                ->first();
            // $paid_user_result = "failed";
            // $results[$key]->quick_invitation_option = 3;
            // $results[$key]->featured_option = 3;
            if ($paid_user) {
                $results[$key]->paid_user = $paid_user;
                // $paid_user_result = "success";
            }
        }
        // dd($results);
        return view("Agency::Bpage.subsidylist1", ["results" => $results]);
    }
    /**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   get View Index
    *   @return     :
    */
    public function getBsearch(Request $request)
    {
        $categorys = Category::with(['subcategory'])->get();
        $regions = DB::table('provinces')->select('id','province_name' )->get();
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
            $categorysubs = @$request->categorysub;
            $region = @$request->region;
            $cities = @$request->cities;
            $keyword = @$request->keyword;
            $business_type = $request->business_type;
            $values = Policy::with(['subCat','provinces','User','policy_business', 'matching_user_search'])
            ->where('policy.publication_setting','=', 0)
            ->where('policy.subscript_duration_detail','>=', $current_date);

            $values = $values->whereHas('matching_user_search',function($qr){
                return $qr->with(['post']);
            });
            // dd($values->paginate(10));
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
            if($keyword) {
                $values = $values->where('policy.name', 'LIKE', '%'.$keyword.'%');
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
            // $checklists = DB::table('checklist_policy_user')->select('policy_id')->where('user_id','=',$user_id)->where('type','=','2')->get();

            // foreach ($checklists as $key => $checklist) {
            //     $check[] = $checklist->policy_id;
            // }

            // $values = $values->whereNotIn('id',$check);

            if($order == 0){
                $values = $values->orderBy('policy.created_date','desc')->orderBy('policy.id','desc');
            } else if ($order == 1) {
                $values = $values->orderBy('policy.acquire_budget_display','desc')->orderBy('policy.id','desc'); 
            } else if($order == 2){
                $values = $values->orderBy('policy.acquire_budget_display','asc')->orderBy('policy.id','desc');
            } else {
                $values = $values->orderBy('policy.id','desc');
            }
            $results = $values->orderBy('id','desc')->paginate($per_page);
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
        }
        // dd($results);
        return view("Agency::Bpage.search", ['categorys'=>$categorys, 'regions'=>$regions, 'address_ministry'=>$address_ministry, 'trades'=>$trades, 'results'=>$results]);
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
        $policy_data = Policy::where('id',$policy_id)->first();
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
        $flag = $request->flag;
        $user_id = session('user_id');
        $policy_ids = $request->policy_id;
        $to_ids = $request->usercheck;
        $submit_type = $request->searchtype;
        $message = $request->mess;
        $deli_date = str_replace(['年','月','日'] , ['-','-',''] ,$request->deli_date);
        $deposit_money = $request->deposit_money;
        $deposit_setting = $request->deposit_setting;
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
                    'from_id'=>$user_id,
                    'to_id'=>$to_id,
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
                    'deposit_setting'=>$deposit_setting,
                ];
                if($check == 1) {
                    $ex_dt['submit_type'] = 1;
                }
                $last_id = Hire::updateOrCreate($dt,$ex_dt);
                if($submit_type==1){
                    $datames['from_id'] = $user_id;
                    $datames['to_id'] = $to_id;
                    $datames['policy_id'] = $policy_id;
                    $datames['hire_id'] = $last_id->id;
                    $datames['message'] = $message;
                    $datames['update_date'] = $cur_date;
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

    public function get_matched_users($policy_id){
        $matched_users = [];
        $matched_users = DB::table('matching_users')->join('users', 'matching_users.user_id', '=', 'users.id')->where('users.manage_flag', 0 )->where('matching_users.policy_id', $policy_id)                        ->whereNotExists(function($query)
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

        dd(session('datas'));
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
}