<?php

namespace App\Modules\Admin\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Admin\Models\User;
use App\Modules\Admin\Models\AccountInfo;
use App\Modules\Admin\Models\Address;
use App\Modules\Admin\Models\Hire;
use App\Modules\Admin\Models\Trade;
use App\Modules\Admin\Models\Tag;
use App\Modules\Admin\Models\ReportAcquire;
use App\Modules\Admin\Models\AdminAgencyType;
use App\Modules\Admin\Models\Feedback;
use App\Modules\Admin\Models\Category;
use App\Modules\Admin\Models\Report;
use App\Modules\Admin\Models\PersonConfirm;
use Carbon\Carbon;
use App\Models\AdminEditInfo;
use Validator,DB,View,Mail;
use App\Modules\Admin\Mail\PersonConfirmMail;
class StaffPolicyController extends Controller
{
    public function getNewUser(Request $request)
    { 
        $sl = ['users.*','person_confirm.id as person_id','person_confirm.files as person_files','person_confirm.allow as person_allow','person_confirm.state'];
        $values = User::select($sl)->with([
            'userLocation'=>function($qr){
                $qr->with(['province']);
            }
        ])
        ->whereDoesntHave('personConfirm',function($qr){
            $qr->where('state','=',1);
        })
        ->leftJoin('person_confirm',function($join){
            $join->on('users.id','=','person_confirm.user_id');
        });
        //extra-condition
        if($request->filled('username')){
            $key = trim($request->username);
            $values = $values->where('username','like',"%{$key}%");
        }        
        if($request->filled('province')){
            $values = $values->whereHas('userLocation',function($qr)use($request){
                $qr->where('province_id','=',$request->province);
            });
        }  
        if($request->filled('manage_flag')){
            $flag = $request->manage_flag == 1 ? 1 : 0 ;
            $values = $values->where('manage_flag','=',$flag);
        }            
        //
        $order = 'person_confirm.id';
        $sort = 'desc';
        $values = $values->orderBy($order,$sort)->orderBy('users.id','desc')->paginate(); 
        //dd($values);              
        return view("Admin::employee.customerinfo.new_user",compact('values'));
    }
    public function personConfirm(Request $request){
        $valid = Validator::make($request->all(),[
            'id'=>'required',
            'value'=>'required'
        ]);
        if($valid->fails()){
            return response()->json([
                'error'=>1,'message'=>__('Error,required!')
            ]);
        }
        $confirm = PersonConfirm::find($request->id);
        if(!$confirm){
            return response()->json([
                'error'=>1,'message'=>__('Not found!')
            ]);
        }
        $allow = ($request->value == 1) ? 1 : 0;
        $result = $confirm->update([
            'allow'=>$allow,
            'state'=>$allow,
            'update_at'=>date('Y-m-d')
        ]);
        $result = 1;
        if($result){
            $user = $confirm->user;
            if($user){
                Mail::to($user->e_mail)->send(new PersonConfirmMail($user));
            }
        }
        return response()->json([
            'error'=>0,'message'=>__('Successfully!')
        ]);

    }
    public function getViolateUser(Request $request){
        $values = Report::with([
                        'userReport'=>function($qr){
                            $qr->with(['userLocation.province']);
                        }
                    ])->has('user')->has('userReport');
        if($request->filled('permission')){
            $values = $values->whereHas('userReport',function($qr)use($request){
                $qr->where('permission','=',0);
            });
        }
        if($request->filled('username')){
            $key = trim($request->username);
            $values = $values->whereHas('userReport',function($qr)use($key){
                $qr->where('username','like',"%{$key}%");
            });            
        }
        if($request->filled('section')){
            $section = $request->section ? 1 : 0;
            $values = $values->whereHas('userReport',function($qr)use($section){
                $qr->where('section','=',$section);
            });            
        }        
        if($request->filled('province')){
            $values = $values->whereHas('userReport',function($qr)use($request){
                $qr->whereHas('userLocation',function($u_qr)use($request){
                    $u_qr->where('province_id','=',$request->province);
                });
            });            
        }
        if($request->filled('state')){
            $values = $values->where('state','=',$request->state);
        }
        $values = $values->orderBy('id','desc')->paginate();        
        return view('Admin::employee.customerinfo.violate_list',compact('values'));
    }

    public function getAgencylist(Request $request)
    {       
        $cnd = [
            ['manage_flag','=',1]
        ];
        $values = User::with([
            'user_agency_type',
            'userLogin',
            'userLocation'=>function($qr){
                $qr->with(['province']);
            }
        ])->where($cnd);
        //extra-condition
        if($request->filled('permission')){
            $values = $values->where('permission','=',0);
        }
        if($request->filled('username')){
            $key = trim($request->username);
            $values = $values->where('username','like',"%{$key}%");
        }
        if($request->filled('province')){
            $values = $values->whereHas('userLocation',function($qr)use($request){
                $qr->where('province_id','=',$request->province);
            });
        }
        if($request->filled('agency_type_id')){
            $ag_type =$request->agency_type_id;
            if($ag_type == -1){
                $ag_types = \App\Modules\Admin\Models\AdminAgencyType::listAll();
                $values= $values->whereNotIn('agency_type_id',$ag_types);
            }else if($ag_type !== 0 && $ag_type !== '0'){
                $values= $values->where('agency_type_id','=',$ag_type);
            }
            
        }
        if($request->query('last_login',false)){
            $tday = Carbon::now();
            $last_login = (int) $request->query('last_login');
            $tday = $tday->subMonths($last_login);            
            $values->whereHas('UserLogin',function($query)use($tday){
                $query->whereDate('login_day', '>=', $tday->format('Y-m-d'));
            });
        }
        //
        $sort = 'id';
        $order = $request->filled('order') ? $request->order : 'desc';
        $values = $values->orderBy($sort,$order)->paginate();
        //dd($values);
        return view("Admin::employee.customerinfo.agencylist",compact('values'));
    }
    // getClientlist
    public function getClientlist(Request $request)
    { 
        $cnd = [
            ['manage_flag','=',0]
        ];
        $values = User::with([
            'userLogin',
            'userLocation'=>function($qr){
                $qr->with(['province']);
            }
        ])->where($cnd);
        //extra-condition
        if($request->filled('permission')){
            $values = $values->where('permission','=',0);
        }
        if($request->filled('username')){
            $key = trim($request->username);
            $values = $values->where('username','like',"%{$key}%");
        }
        if($request->filled('section')){
            $section = $request->section ? 1 : 0;
            $values = $values->where('section','=',$section);
        }        
        if($request->filled('province')){
            $values = $values->whereHas('userLocation',function($qr)use($request){
                $qr->where('province_id','=',$request->province);
            });
        }              
        if($request->query('last_login',false)){
            $tday = Carbon::now();
            $last_login = (int) $request->query('last_login');
            $tday = $tday->subMonths($last_login);            
            $values->whereHas('UserLogin',function($query)use($tday){
                $query->whereDate('login_day', '>=', $tday->format('Y-m-d'));
            });
        }
        //
        $sort = 'id';
        $order = $request->filled('order') ? $request->order : 'desc';
        $values = $values->orderBy($sort,$order)->paginate();               
        return view("Admin::employee.customerinfo.clientlist",compact('values'));
    }
    //detail-agency
    public function edit_agency($id){
            $user = User::where('manage_flag','=',1)->findOrFail($id);
            $profile_completed = $this->sumaryUser($user);
            $user->load([
                'UserClientData','user_agency_type','userLocation.province','userLocation.city'
            ]);
            //dd($user);                             
            return view("Admin::employee.customerinfo.agencydetail",compact('user','profile_completed'));
        }
    public function availabletaskAgency($id)
    {
        $user = User::where('manage_flag','=',1)->findOrFail($id);
        $profile_completed = $this->sumaryUser($user);
        $categories = Category::listCatSub();
        $trades = Trade::listAllDisplay();
        $tags = Tag::listAll();
        $user->load([
                    'tag','trade','userCategory',
                    'userAddress'=>function($qr){
                        $qr->with(['province','city']);
                    }
                    ]);
        $data = compact('user','profile_completed','categories','trades','tags');         
        //dd($tags);                      
        return view('Admin::employee.customerinfo.agencydetail',$data);        
    }   
    public function ratingAgency($id)
    {
        $user = User::where('manage_flag','=',1)->findOrFail($id);
        $profile_completed = $this->sumaryUser($user);
        $rating_info = $this->getRating($user);
        $feedbacks = Feedback::with([
                        'hire'=>function($h_qr){
                            $h_qr->select(['id','policy_id'])->with([
                                  'policy'=>function($q_qr){
                                    $q_qr->select(['id','image_id','name','name_serve','support_content']);
                                  }  
                            ]);
                        }
                    ])
                    ->where('to_id','=',$id)
                    ->orderBy('id','desc')->paginate(5);        
        return view('Admin::employee.customerinfo.agencydetail',compact('user','profile_completed','feedbacks','rating_info'));
    } 
    public function paymentAgency($id){
        $user = User::where('manage_flag','=',1)->findOrFail($id);
        $profile_completed = $this->sumaryUser($user);
        $banking = $user->userBank;
        return view('Admin::employee.customerinfo.agencydetail',compact('user','profile_completed','banking'));
    }   
    public function violationAgency($id){
        $user = User::where('manage_flag','=',1)->findOrFail($id);
        $profile_completed = $this->sumaryUser($user);
        $reports =  $user->reportAdmin()->paginate(20);
        return view('Admin::employee.customerinfo.agencydetail',compact('user','profile_completed','reports'));
    }   
    public function storeViolation(Request $request,$id){
        $this->validate($request,[
            'message'=>'required'
        ]);
        $user = User::findOrFail($id);
        $admin_id = session('id');
        $user->reportAdmin()->create([
            'admin_id'=>$admin_id,
            'message'=>$request->message,
        ]); 
        return back()->with('status',__('Successfully!'));

    }
    public function changePermission(Request $request,$id){
        $user = User::findOrFail($id);
        $this->validate($request,[
            'permission'=>'required'
        ]);
        $permission = $request->permission == 1 ? 1 : 0;
        $user->update([
            'permission'=>$permission
        ]);
        return back()->with('status',__('Successfully'));
    }
    //detailPage
    public function paymentClient($id){
        $user = User::where('manage_flag','=',0)->findOrFail($id);
        $profile_completed = $this->sumaryUser($user);
        $banking = $user->userBank;
        return view('Admin::employee.customerinfo.clientdetail',compact('user','profile_completed','banking'));
    }   
    public function violationClient($id){
        $user = User::where('manage_flag','=',0)->findOrFail($id);
        $profile_completed = $this->sumaryUser($user);
        $reports =  $user->reportAdmin()->paginate(20);
        return view('Admin::employee.customerinfo.clientdetail',compact('user','profile_completed','reports'));
    }    
    public function availabletask($id)
    {
        $user = User::where('manage_flag','=',0)->findOrFail($id);
        $profile_completed = $this->sumaryUser($user);
        $categories = Category::listCatSubDetail();
        $user->load(['userCategory']);
        $data = compact('user','profile_completed','categories');         
        //dd($tags);                      
        return view('Admin::employee.customerinfo.clientdetail',$data);        
    }
    public function ratingUser($id)
    {
        $user = User::where('manage_flag','=',0)->findOrFail($id);
        $profile_completed = $this->sumaryUser($user);
        $rating_info = $this->getRating($user);
        $feedbacks = Feedback::with([
                        'hire'=>function($h_qr){
                            $h_qr->select(['id','policy_id'])->with([
                                  'policy'=>function($q_qr){
                                    $q_qr->select(['id','image_id','name','name_serve','support_content']);
                                  }  
                            ]);
                        }
                    ])
                    ->where('to_id','=',$id)
                    ->orderBy('id','desc')->paginate(5);        
        return view('Admin::employee.customerinfo.clientdetail',compact('user','profile_completed','feedbacks','rating_info'));
    }
    public function edit($id){
        $user = User::where('manage_flag','=',0)->findOrFail($id);
        $profile_completed = $this->sumaryUser($user);
        $user->load([
                'trade','userLocation.province','userLocation.city','UserClientData'
            ]); 
        //dd($user);                             
        return view("Admin::employee.customerinfo.clientdetail",compact('user','profile_completed'));
    }
    private function getRating($user){
        $id = $user->id;
        $rating_info = [];            
        $rating_info['direct_request']= DB::table('hire')->where('from_id', $id)->where('submit_type',0)->where('accept',1)
            ->count(); 
        $rating_info['state_project'] = DB::table('hire')->where('from_id', $id)->where('finish_flag',0)->where('accept',1)
            ->orWhere(function ($query) use ($id)
            {
                $query->where('to_id', $id)->where('finish_flag',0)->where('accept',1);
            })->get()->count(); 
        $current = Carbon::now();
        $today = $current->addMonth(-1);
        $yesterday = $current->subMonths(6);
        $yesterday = $yesterday->year."-".$yesterday->month."-".$yesterday->day;
        $today = $today->year."-".$today->month."-".$today->day;
        $rating_info['result_a_month'] = DB::table('hire')->where('from_id',$id)->where('finish_flag',1)->whereDate('finish_date', '>=', $today)
            ->orWhere(function ($query) use ($id,$today)
            {
                $query->where('to_id', $id)->where('finish_flag',1)->whereDate('finish_date', '>=', $today);
            })->get()->count();

        $rating_info['result_a_half_year'] = DB::table('hire')->where('from_id',$id)->where('finish_flag',1)->whereDate('finish_date', '>=', $yesterday)
            ->orWhere(function ($query) use ($id,$yesterday)
            {
                $query->where('to_id', $id)->where('finish_flag',1)->whereDate('finish_date', '>=', $yesterday);
            })->get()->count(); 
        $evaluate_a_month = DB::table('feedback')->where('to_id',$id)->whereDate('created_date','>=',$today)->avg('eval_total');
        $rating_info['evaluate_a_month'] = $evaluate_a_month===null ? 0 : $evaluate_a_month;
        $evaluate_a_half_year = DB::table('feedback')->where('to_id',$id)->whereDate('created_date','>=',$yesterday)->avg('eval_total');
        $rating_info['evaluate_a_half_year'] = $evaluate_a_half_year===null ? 0 : $evaluate_a_half_year;
        return $rating_info;
    }
    private function checkAuthState($user){
        $auth_state = [];
        $user->load([
            'personConfirm'=>function($qr){
                $qr->select(['id','user_id','allow']);
            },
            'userNda'=>function($qr){
                $qr->select(['id','user_id','allow']);
            },
            'userCheck'=>function($qr){
                $qr->select(['id','user_id','allow']);
            },
            'personPhone'=>function($qr){
                $qr->select(['id','user_id','allow']);
            }            
        ]);
        if (empty($user->personConfirm) || $user->personConfirm->allow != 1) {
            $auth_state['confirm'] = 0;
        } else {
            $auth_state['confirm'] = 1;
        }
        if (empty($user->userNda) || $user->userNda->allow != 1) {
            $auth_state['nda'] = 0;
        } else {
            $auth_state['nda'] = 1;
        }
        if (empty($user->userCheck) || $user->userCheck->allow != 1) {
            $auth_state['check'] = 0;
        } else {
            $auth_state['check'] = 1;
        }
        if (empty($user->personPhone) || $user->personPhone->allow != 1) {
            $auth_state['phone'] = 0;
        } else {
            $auth_state['phone'] = 1;
        } 
        return $auth_state;       
    }
    private function sumaryUser($user){
        $user_id = $user->id;
        $actual_result = [
            'number'=>0,
            'acquire_rate'=>0,
            'acquire_total'=>0
        ];
        $acquire = ReportAcquire::select(['id','hire_id',
                        DB::raw('COUNT(*) as acquire_count'),
                        DB::raw('COUNT(if(acquire_type=1,1,NULL)) as acquire_complete'),
                        DB::raw('SUM(acquire_budget) as acquire_total'),
                        ])
                        ->whereHas('hire',function($qr)use($user_id){
                            $qr->select(['id','from_id','to_id'])->where('from_id','=',$user_id)
                                ->orWhere('to_id','=',$user_id);
                        })
                        ->first(); 
        //dd($acquire);                
        $actual_result['number'] = $acquire->acquire_count;                       
        if(!empty($acquire->acquire_count)){
            $actual_result['acquire_rate'] = round($acquire->acquire_complete/$acquire->acquire_count , 1)*100;
        }      
        $actual_result['acquire_total'] = $acquire->acquire_total;
        //
        $feedback = [
            'count'=>0,
            'result'=>0,
            'good_result_rate'=>0
        ];
        $f_qr = Feedback::select(['id',
                        DB::raw('COUNT(*) as fb_count'),
                        DB::raw('COUNT(if(eval_total > 4,1,NULL)) as good_count'),
                        DB::raw('SUM(eval_total) as eval_sum'),
                        ])
                        ->where('to_id','=',$user_id)
                        ->first(); 
        $feedback['count'] = $f_qr->fb_count;
        if($f_qr->fb_count > 0){
            $feedback['result'] = round($f_qr->eval_sum/$f_qr->fb_count,1);
            $feedback['good_result_rate'] = round($f_qr->good_count/$f_qr->fb_count,1)*100;
        }  
        //
        $user->load([
            'userLogin'=>function($qr){
                $qr->first();
            }
        ]);
        $created_date = date("Y-m-d");
        if (!$user->userLogin->isEmpty()){
            $f_day = $user->userLogin->first()->login_day;
            $last = $this->dateDifference($created_date, $f_day);
        }
        $word_state=[];
        $work_state['last'] = $last;
        $work_state['work_state'] = 1;
        $auth_state = $this->checkAuthState($user);    
        return compact('actual_result','feedback','work_state','auth_state');
    }
    public function getFeedback(Request $request,$id){
        if(!$request->ajax()){abort(404);}
        $feedbacks = Feedback::with([
                        'hire'=>function($h_qr){
                            $h_qr->select(['id','policy_id'])->with([
                                  'policy'=>function($q_qr){
                                    $q_qr->select(['id','image_id','name','name_serve','support_content']);
                                  }  
                            ]);
                        }
                    ])
                    ->where('to_id','=',$id)
                    ->orderBy('id','desc')->paginate(5);
        //dd($feedbacks);            
        return response()->view('Admin::employee.customerinfo.feedback',compact('feedbacks'),200);            
    }
    public function updateFeedback(Request $request){
        if(!$request->ajax()){abort(403);}
        $valid = Validator::make($request->all(),[
            'id'=>'required',
            'display'=>'required'
        ]);
        if($valid->fails()){
            return response()->json(['error'=>1,'msg'=>__('Error!')]);
        }
        $feedback = Feedback::find($request->id);
        if(!$feedback){
            return response()->json(['error'=>1,'msg'=>__('Error!')]);
        }
        $display = $request->display == 1 ? 1 : 0;
        $feedback->update(['display'=>$display]);
        return response()->json(['error'=>0]);
    }
    public function update(Request $request,$id){
        $this->checkRequestUser();
        $has_bank = $this->checkHasBank();
        $user = User::with('accountInfo')->findOrFail($id);
        //update-permiss-payroll
            $data = [];
            switch ($request->sectionuser) {
                case 0:
                    $data=[
                        ['permission','=',1],
                        ['payroll','=',0],
                    ];
                case 1:
                    $data=[
                        ['permission','=',1],
                        ['payroll','=',1],
                    ];
                case 2:
                    $data=[
                        ['permission','=',1],
                        ['payroll','=',1],
                    ];
                    $user->load(['personConfirm','personPhone']);
                    if($user->personConfirm){
                        $user->personConfirm->update(['allow'=>1]);
                    }
                    if($user->personPhone){
                        $user->personPhone->update(['allow'=>1]);
                    }
                    
                case 3:
                    $data=[
                        ['permission','=',0],
                    ];
                    break;                
                default:
                    break;
            }
            $request->request->add($data);
        //
        $user->update($request->all());
        //update-account-info-bank
        if($has_bank){
            $bank = $request->input('bank');
            $user->accountInfo()->updateOrCreate($bank);            
        }else{
            if($user->accountInfo){
                $user->accountInfo->delete();
            }
        }     
        $user->userLocation()->updateOrCreate(
            ['user_id'=>$user->id],
            [
                'province_id'=>$request->input('location_sel',0),
                'province_name'=>$request->input('province_name',''),
                'city_id'=>$request->input('city_sel',0),
                'city_name'=>$request->input('city_name',''),
                //'updated_at'=>date('Y-m-d H:i:s',time()),
            ]
        );
        AdminEditInfo::add_info('顧客情報管理', 'ユーザー：'.$id.'の情報を更新しました。'); 
        return back()->with('status',__('update successfully!'));
    }
    public function checkRequestUser(){
        $request = request();
        $rules = [
            'displayname'=>'required|string',
            'agency_type_id'=>'required',           
        ];
        $msg = [];
        Validator::make($request->all(),$rules,$msg)->validate();        
        return true;        
    }
    public function checkHasBank(){
        $request = request();
        $rules = [
            'bank.bank_name'=>'required',
            'bank.branch_name'=>'required',
            'bank.account_type'=>'required',
            'bank.account_number'=>'required',
            'bank.account_name'=>'required', 
        ];
        if($request->filled('bank.bank_name')||$request->filled('bank.branch_name')||$request->filled('bank.account_type')||$request->filled('bank.account_number')||$request->filled('bank.account_name')){
            Validator::make($request->all(),$rules,[])->validate();
            return true;
        }
        return false;
    }
    // getMatchinglist    
    public function getMatchinglist(Request $request)
    {       
        //
        $values = Hire::popular()
                        ->with([
                            'workSet'=>function($qr){
                                $qr->with('user')->summary();
                            }
                        ]);
        //request-condition
        if($request->filled('s_year')){
            $month = $request->filled('s_month') ? $request->query('s_month') : '00';
            $s_date = [$request->query('s_year'),$month,'00'];
            $s_date_str = implode('-',$s_date);    
            $values=$values->where('created_at','>=',$s_date_str);
        }         
        if($request->filled('e_year')){
            $month = $request->filled('e_month') ? $request->query('e_month') : '00';
            $e_date = [$request->query('e_year'),$month,'00'];
            $e_date_str = implode('-',$e_date);
            $values=$values->where('created_at','<=',$e_date_str);
        }         
        if($request->filled('keyword')){
            $keyword = trim($request->query('keyword'));
            $values = $values->whereHas('policy',function($qr) use($keyword){
                $qr->where('name','like',"%{$keyword}%");
            });
        }
        $finish_flag = $request->query('finish_flag');
        if($finish_flag || $finish_flag === 0 || $finish_flag === '0'){
            $values = $values->where('finish_flag','=',$finish_flag);
        }
        //
        $order = 'id';
        $sort = 'desc';
        $values = $values->orderBy($order,$sort)->paginate(10);
        $fee = 0; 
        $payroll = DB::table('admin_payroll')->first();
        if($payroll){
            $fee = $payroll->site_profit;
        }
        //dd($values);
        return view("Admin::employee.customerinfo.matchinglist",compact('values','fee'));
    }  
    private function changeFinishFlagHire($dt=null,$lst){
        if($dt===null){return false;}
        Hire::whereIn('id',$lst)->update(['finish_flag'=>$dt]);
        AdminEditInfo::add_info('マッチング管理画面', 'マッチング関連資料の編集を行う');
        return true;
    }      
    //
    private function changePermiss($dt=null,$lst){
        if($dt===null){return false;}
        User::whereIn('id',$lst)->update(['permission'=>$dt]);
        return true;
    }    
    private function handleActionQuery($acts = []){
        if(empty($acts)){ return false;}
        $request = request();       
        $act = $request->query('acts',null);
        $p_list = $request->query('posts');
        if(empty($p_list) || !array_key_exists($act, $acts)){ return false;}
        $action = $acts[$act];
        if(empty($action['callback'])){ return false;}
        call_user_func([$this,$action['callback']],$act,$p_list);
        return true;
    } 
    private function getCondition($filter=[],$exc=[]){
        $request = request();
        $out = [];
        foreach($filter as $key=>$ite){
            $value = $request->query($key,null);
            if(is_numeric($key)|| in_array($key,$exc) || empty($value)){
                continue;
            }
            if(empty($ite['query'])){
                $out[]=[$key,'=',$value];
                continue;
            }
            switch ($ite['query']) {
                case 'like':
                    $out[]=[$key,'like',"%{$value}%"];
                    break;
                
                default:
                    break;
             }            
        }
        return $out;
    }  
    private function getConditionPayroll(){
        $request = request();
        $out = 1;
        $p_all = $request->query('payroll_all',false);
        $p_paid = $request->query('payroll_paid',false);
        $p_free = $request->query('payroll_free',false);
        if(!$p_all && !$p_paid && !$p_free){
            return 0;
        }elseif($p_paid && $p_free){
            $out = -1;
        }elseif(!$p_paid && $p_free){
            $out = 0;
        }
        return ($out===1)?1 : 0;
    } 
    private function dateDifference($date_1 , $date_2 , $differenceFormat = '%a' )
    {
        $datetime1 = date_create($date_1);
        $datetime2 = date_create($date_2);

        $interval = date_diff($datetime1, $datetime2);

        return (int)$interval->format($differenceFormat);
    }           
}