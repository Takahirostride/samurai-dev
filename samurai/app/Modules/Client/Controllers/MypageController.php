<?php

namespace App\Modules\Client\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use AuthSam;
use App\Models\User, App\Models\Policy, App\Models\CheckListPolicyUser, App\Models\Follow;
use App\Models\City, App\Models\Province;
use App\Models\AgencySearchPost;
use App\Models\UserLocation;
use App\Models\UserTag;
use App\Models\UserAddress;
use App\Models\Matching;
use App\Models\BlockList;
use App\Models\Trade;
use App\Models\UserBusiness;
use App\Models\UserClient;
use App\Models\Category;
use App\Models\SubCategory;
use Storage, DB;
use App\Helpers\UploadFile;
use Carbon\Carbon;
use Log, Validator, URL, Mail;
use Cache;

class MypageController extends Controller
{
    /**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   get View Index
    *   @return     :
    */
   protected $agencyProfile = [];
   public function __construct()
   {
        $this->agencyProfile = new \App\Modules\Agency\Controllers\MypageController;
   }
    public function getIndex()
    {
        return $this->agencyProfile->getIndex('Client::mypage.home');
    }
    public function doAvatarUpload(Request $request)
    {
        return $this->agencyProfile->doAvatarUpload($request, 'client.home');
    }
    public function indexAjax(Request $request)
    {
        return $this->agencyProfile->indexAjax($request);
    }
    public function getProfile()
    {
        $trade = Trade::get()->toArray();
        return self::view('Client::mypage.profile', compact('trade'));
    }
    public function loadCityByProvince(Request $request)
    {
        return $this->agencyProfile->loadCityByProvince($request);
    }
    public function postProfile(Request $request)
    {
        $user_id = session('user_id');
        $currentUser = DB::table('users')->where('id', session('user_id'))->first();
        $insertData  = [
            'displayname'   => $request->displayname,
            'representative'   => $request->representative,
            'performer'   => $request->performer,
            'section'   => $request->section,
            'company_name'   => $request->company_name,
            'tax_number'   => $request->tax_number,
            'zip_code'   => $request->zip_code,
            'street_building_name'   => $request->street_building_name,
            'phone_number'   => $request->phone_number,
            'fax'   => $request->fax,
            'url'   => $request->url,
            'self_intro'   => $request->self_intro
        ];
        if($request->hasFile('profile_image'))
        {
            $uploadedFile = $request->file('profile_image');
            $path = 'assets/photo';
            $fileName = md5(session('user_id')) . '.' . $uploadedFile->getClientOriginalExtension();
            $uploadedFileName = UploadFile::upload($path, $uploadedFile, $fileName);
            if($uploadedFileName) 
            {
                $insertData['image'] = $uploadedFileName;
            }
            unset($insertData['profile_image']);
        }
        $location = array();
        if( strtotime('+30 days',strtotime($currentUser->address_changed_from)) < time() )
        {
            if($request->province_name)
            {
                $location['province_name'] = $request->province_name;
                $location['city_name'] = $request->city_name;
                $location['province_id'] = -1;
                $location['city_id'] = 0;
            } elseif($request->province_id >= 0) {
                $location['province_name'] = '';
                $location['province_id'] = $request->province_id;
                if($request->city_name)
                {
                    $location['city_name'] = $request->city_name;
                    $location['city_id'] = 0;
                } elseif($request->city_id) {
                    $location['city_name'] = '';
                    $location['city_id'] = $request->city_id;
                }
            }
            $userLocation = UserLocation::where('user_id', session('user_id'))->first();
            if($userLocation)
            {
                $checkUpdate = 0;
                if($location['province_name'] != $userLocation['province_name']) $checkUpdate = 1;
                if($location['city_name'] != $userLocation['city_name']) $checkUpdate = 1;
                if($location['province_id'] != $userLocation['province_id']) $checkUpdate = 1;
                if($location['city_id'] != $userLocation['city_id']) $checkUpdate = 1;
                if($checkUpdate)
                {
                    $location['updated_at'] = Carbon::now()->toDateTimeString();
                    UserLocation::where('user_id', session('user_id'))->update($location);
                    $insertData['address_changed_from'] = date('Y-m-d H:i:s');
                }
            } else {
                $location['updated_at'] = Carbon::now()->toDateTimeString();
                UserLocation::where('user_id', session('user_id'))->update($location);
                $insertData['address_changed_from'] = date('Y-m-d H:i:s');
            }
            
        }

        unset($insertData['province_name'], $insertData['province_id'], $insertData['city_name'], $insertData['city_id'], $insertData['_token']);
        DB::table('users')->where('id', session('user_id'))->update($insertData);

        if($request->user_business) {
            $bdata = [];
            foreach($request->user_business as $vv)
            {
                $bdata = ['user_id'=> session('user_id'), 'trade_id'=>(int)$vv];
                UserBusiness::updateOrCreate($bdata);
            }
            UserBusiness::whereNotIn('trade_id', $request->user_business)->where('user_id', session('user_id'))->delete();
        }

        //update client_data
        $estable_date = ($request->estable_date_year?$request->estable_date_year:date('Y')).'-';
        $estable_date .= ($request->estable_date_month?$request->estable_date_month:date('m')).'-';
        $estable_date .= ($request->estable_date_day?$request->estable_date_day:date('d'));
        $client_data = array(
                'estable_date'             =>  date('Y-m-d', strtotime($estable_date) ),
                'capital'                  =>  $request->capital,
                'regular_number'           =>  $request->regular_number
            );
        $exist_flag = DB::table('users_client_data')->where('user_id',session('user_id'))->first();
        $check = 0;
        if($exist_flag) {
            DB::table('users_client_data')->where('user_id', session('user_id'))->update($client_data);
        } else {
            $client_data['user_id'] = session('user_id');
            $check = DB::table('users_client_data')->insert($client_data);
        }
        /*
            // addding policy id to get matching user count. 
            if($check){
                $policy_ids = DB::table('matching_users')->where('user_id', $user_id)->pluck('policy_id')->toArray();
                $policyInsert = Policy::select('*')->where(function($query) use($location, $request) {
                    if($location['province_id'])
                    {
                        if($location['city_id'])
                        {
                            $query->with(['policy_region'=> function($query1) use($location) {
                                $query1->where('province_id', $location['province_id'])->where('city_id', $location['city_id']);
                            }]);
                        } else {
                            $query->with(['policy_region'=> function($query1) {
                                $query1->where('province_id', $location['province_id']);
                            }]);
                        }
                        
                    } else {
                        if($location['city_id'])
                        {
                            $query->with(['policy_region'=> function($query1) {
                                $query1->where('city_id', $location['city_id']);
                            }]);
                        }
                    }
                    if($request->user_business)
                    {
                        $query->with(['policy_business'=>function($query1) use($request) {
                            $query1->whereIn('trade_id', $request->user_business);
                        }]);
                    }
                    if($request->capital > 0){
                        $query->where('capital_start', '<=', $request->capital)->where('capital_end', '>=', $request->capital);
                        
                    }
                    if($request->regular_number > 0){
                        $query->where('employees_count_start', '<=', $request->regular_number)->where('employees_count_end', '>=', $request->regular_number);
                    }
                    if($request->regular_employee_number > 0){
                        $query->where('hiring_count_start', '<=', $request->regular_employee_number)->where('hiring_count_end', '>=', $request->regular_employee_number);
                    }
                    if($request->byte_number > 0){
                        $query->where('employees_part_count_start', '<=', $request->byte_number)->where('employees_part_count_end', '>=', $request->byte_number);
                    }
                    if($request->byte_employee_number > 0){
                        $query->where('hiring_byte_count_start', '<=', $request->byte_employee_number)->where('hiring_byte_count_end', '>=', $request->byte_employee_number);
                    }
                    if($request->byte_regular_number > 0){
                        $query->where('regular_byte_start', '<=', $request->byte_regular_number)->where('regular_byte_end', '>=', $request->byte_regular_number);
                    }
                    if($request->number_over_60 > 0){
                        $query->where('over_60_count_start', '<=', $request->number_over_60)->where('over_60_count_end', '>=', $request->number_over_60);
                    }
                });

                $policyInsert->whereNotIn('id', $policy_ids);
                $policy = $policyInsert->pluck('id')->toArray();
                $insertData = array();
                if(count($policy))
                {
                    foreach($policy as $value)
                    {
                        $insertData[] = array(
                            'policy_id'     =>  $value,
                            'user_id'       =>  $user_id,
                            'order_type'    =>  2,
                            'user_type'     =>  0,
                        );
                    }
                    DB::table('matching_users')->updateOrCreate($insertData);
                }
            } 
            */
            return redirect()->back()->withSuccess('プロフィール情報を保存しました。')->withInput();
    }

    public function getAvailableTask(Request $request)
    {
        $categories = Category::with('subcategory')->where('display',1)->get();
        return self::view('Client::mypage.available_task', compact('categories'));
    }
    public function getAvailableTaskShow(Request $request)
    {
        $categories = Category::with('subcategory')->get();
        return self::view('Client::mypage.available_task_show', compact('categories'));
    }
    public function profileAjax(Request $request)
    {
        $subType = 1;
        return $this->agencyProfile->profileAjax($request, $subType);
    }
    public function postAvailableTask(Request $request)
    {
        
        $sub_request = $request->subcat;
        if(count($sub_request))
        {
            $insertData = array();
            //delete old
            DB::table('user_category')->where('user_id', session('user_id'))->whereNotIn('sub_category_id', $sub_request)->delete();
            //remove duplicate
            $current_sub = DB::table('user_category')->where('user_id', session('user_id'))->pluck('sub_category_id')->toArray();
            foreach($sub_request as $key=>$val)
            {
                if(in_array($val, $current_sub)) unset($sub_request[$key]);
            }
            if(count($sub_request))
            {
                $sub_category = SubCategory::whereIn('id', $sub_request)->get();
                foreach($sub_category as $val)
                {
                    $insertData[] = [
                        'user_id'           =>  session('user_id'),
                        'category_id'       =>  $val->category_id,
                        'sub_category_id'   =>  $val->id
                    ];
                }
                DB::table('user_category')->insert($insertData);
            }
        }
        
        return redirect()->route('client.profile.availabletask')->withSuccess('データを変更しました。')->withInput();
    }
    public function getRating()
    {
        return $this->agencyProfile->getRating('Client::mypage.rating');
    }
    public function ratingAjax(Request $request)
    {
        return $this->agencyProfile->ratingAjax($request);
    }
    public function getMemberInfo()
    {
        return self::view('Client::mypage.member_info');
    }
    public function memberInfoAjax(Request $request)
    {
        return $this->agencyProfile->memberInfoAjax($request);
    }
    public function getMemberInfoMail(Request $request)
    {
        return self::view('Client::mypage.mail_notify');
    }
    public function postMemberInfoMail(Request $request)
    {
        return $this->agencyProfile->postMemberInfoMail($request);
    }
    public function getMemberInfoBlock()
    {
        return $this->agencyProfile->getMemberInfoBlock('Client::mypage.info_block');
    }
    public function memberInfoBlockAjax(Request $request)
    {
        return $this->agencyProfile->memberInfoBlockAjax($request);
    }
    public function postMemberInfoAddBlock(Request $request)
    {
        return $this->agencyProfile->postMemberInfoAddBlock($request);
    }
    public function postMemberInfoRemoveBlock(Request $request)
    {
        return $this->agencyProfile->postMemberInfoRemoveBlock($request);
    }
    public function getMemberInfoRegister(Request $request)
    {
        return self::view('Client::mypage.register_member');
    }
    public function registerMemberAjax(Request $request)
    {
        return $this->agencyProfile->registerMemberAjax($request);
    }
    public function getCheckList()
    {
        return $this->agencyProfile->getCheckList('Client::mypage.checklist');
    }
    public function ajaxtableTaskSetting(Request $request)
    {
        return $this->agencyProfile->ajaxtableTaskSetting($request);
    }
    public function ajaxMessageView(Request $request)
    {
        return $this->agencyProfile->ajaxMessageView($request);
    }
    public function ajaxTaskView(Request $request)
    {
        $update_type = 1; //client set = 1
        return $this->agencyProfile->ajaxTaskView($request, $update_type);
    }
    public function ajaxSetTask(Request $request)
    {
        return $this->agencyProfile->ajaxSetTask($request);
    }


     /**
     * ONCUTHEN
     */
    private function view($blade, $params = [])
    {
        $params['user'] = User::where('id', session('user_id'))->with('user_location', 'user_client', 'user_location', 'user_business', 'subCat')->first();
        //if(in_array($blade, ['Client::mypage.home', 'Client::mypage.profile']))
        //{
            $params['profile_completed'] = self::calculatorProfile(session('user_id'));
        //}
        return view($blade, $params);
    }
    private function calculatorProfile($user_id)
    {
        $result = DB::table('users')->where('id', $user_id)->first();

        $loyalty = 0;
        $require = [];

        $auth_state = [];
         if ($result->manage_flag == 1) {
        //     if (($result->displayname !="") && ($result->username!="") && ($result->performer!="")){
        //         $loyalty = $loyalty + 10;
        //     } else {
        //         $require[] = 0;
        //     }

        //     if ($result->agency_register_number !="") {
        //         $loyalty = $loyalty + 10;
        //     } else {
        //         $require[] = 1;
        //     }

        //     if (strpos( $result->image, 'profile_sample.png') !== false ) {
        //         $require[] = 2;
        //     } else {
        //         $loyalty = $loyalty + 10;
        //     }

        //     if (count(json_decode($result->pro_part,true))> 0) {
        //         $loyalty = $loyalty + 10;
        //     } else {
        //         $require[] = 3;
        //     }

        //     if (count(json_decode($result->category_detail,true))> 0) {
        //         $loyalty = $loyalty + 10;
        //     } else {
        //         $require[] = 4;
        //     }

        //     $cc = DB::table('matching')->where('from_id',$user_id)->count();
        //     if ($cc>0) {
        //         $loyalty = $loyalty + 10;
        //     } else {
        //         $require[] = 5;
        //     }

            if(Cache::has('person_confirm'))
            {
                $first = Cache::get('person_confirm');
            } else {
                $first = DB::table('person_confirm')->where('user_id',$user_id)->first();
                Cache::put('personal_confirm', $first, 600);
            }
            
            if (!$first) {
                $require[] = 6;
                $auth_state[] = 0;
            } else {
                if ((int)$first->allow == 1) {
                    $loyalty = $loyalty + 10;
                    $auth_state[] = 1;
                } else {
                    $require[] = 6;
                    $auth_state[] = 0;
                }
            }

            //기밀 유지 확인 완료
            if(Cache::has('user_nda'))
            {
                $first = Cache::get('user_nda');
            } else {
                $first = DB::table('user_nda')->where('user_id',$user_id)->first();
                Cache::put('user_nda', $first, 600);
            }
            
            if (!$first) {
                $require[] = 7;
                $auth_state[] = 0;
            } else {
                if ((int)$first->allow == 1) {
                    $loyalty = $loyalty + 10;
                    $auth_state[] = 1;
                } else {
                    $require[] = 7;
                    $auth_state[] = 0;
                }
            }

            //선비 검사 완료
            
            if(Cache::has('user_check'))
            {
                $first = Cache::get('user_check');
            } else {
                $first = DB::table('user_check')->where('user_id',$user_id)->first();
                Cache::put('user_check', $first, 600);
            }
            if (!$first) {
                $require[] = 8;
                $auth_state[] = 0;
            } else {
                if ((int)$first->allow == 1) {
                    $loyalty = $loyalty + 10;
                    $auth_state[] = 1;
                } else {
                    $require[] = 8;
                    $auth_state[] = 0;
                }
            }

            //전화 확인 완료
            
            if(Cache::has('person_phone'))
            {
                $first = Cache::get('person_phone');
            } else {
                $first = DB::table('person_phone')->where('user_id',$user_id)->first();
                Cache::put('person_phone', $first, 600);
            }
            if (!$first) {
                $require[] = 9;
                $auth_state[] = 0;
            } else {
                if ((int)$first->allow == 1) {
                    $loyalty = $loyalty + 10;
                    $auth_state[] = 1;
                } else {
                    $require[] = 9;
                    $auth_state[] = 0;
                }
            }
        } else if ($result->manage_flag == 0) {
        //     if (($result->displayname !="") && ($result->username!="") && ($result->performer!="")) {
        //         $loyalty = $loyalty + 10;
        //     } else {
        //         $require[] = 0;
        //     }

        //     if (strpos($result->image, 'profile_sample.png') !== false ) {
        //         $require[] = 1;
        //     } else {
        //         $loyalty = $loyalty + 10;
        //     }

        //     if (count(json_decode($result->pro_part,true))> 0) {
        //         $loyalty = $loyalty + 10;
        //     } else {
        //         $require[] = 2;
        //     }

        //     if (count(json_decode($result->category))> 0) {
        //         $loyalty = $loyalty + 10;
        //     } else {
        //         $require[] = 3;
        //     }

        //     if (count(json_decode($result->category_detail,true))> 0) {
        //         $loyalty = $loyalty + 10;
        //     } else {
        //         $require[] = 4;
        //     }

        //     $require55 = DB::table('users_client_data')->where('user_id',$user_id)->first();
        //     if ($require55) {
        //         $loyalty = $loyalty + 10;
        //     } else {
        //         $require[] = 5;
        //     }

        //     //본인 확인 등록 완료
            
            if(Cache::has('person_confirm'))
            {
                $first = Cache::get('person_confirm');
            } else {
                $first = DB::table('person_confirm')->where('user_id',$user_id)->first();
                Cache::put('person_confirm', $first, 600);
            }
            if (!$first) {
                $require[] = 6;
                $auth_state[] = 0;
            } else {
                if ((int)$first->allow == 1) {
                    $loyalty = $loyalty + 10;
                    $auth_state[] = 1;
                } else {
                    $require[] = 6;
                    $auth_state[] = 0;
                }
            }

            //기밀 유지 확인 완료
            
            if(Cache::has('user_nda'))
            {
                $first = Cache::get('user_nda');
            } else {
                $first = DB::table('user_nda')->where('user_id',$user_id)->first();
                Cache::put('user_nda', $first, 600);
            }
            if (!$first) {
                $require[] = 7;
                $auth_state[] = 0;
            } else {
                if ((int)$first->allow == 1) {
                    $loyalty = $loyalty + 10;
                    $auth_state[] = 1;
                } else {
                    $require[] = 7;
                    $auth_state[] = 0;
                }
            }

            //선비 검사 완료
            if(Cache::has('user_check'))
            {
                $first = Cache::get('user_check');
            } else {
                $first = DB::table('user_check')->where('user_id',$user_id)->first();
                Cache::put('user_check', $first, 600);
            }
            if (!$first) {
                $require[] = 8;
                $auth_state[] = 0;
            } else {
                if ((int)$first->allow == 1) {
                    $loyalty = $loyalty + 10;
                    $auth_state[] = 1;
                } else {
                    $require[] = 8;
                    $auth_state[] = 0;
                }
            }

            //전화 확인 완료
            
            if(Cache::has('person_phone'))
            {
                $first = Cache::get('person_phone');
            } else {
                $first = DB::table('person_phone')->where('user_id',$user_id)->first();
                Cache::put('person_phone', $first, 600);
            }
            if (!$first) {
                $require[] = 9;
                $auth_state[] = 0;
            } else {
                if ((int)$first->allow == 1) {
                    $loyalty = $loyalty + 10;
                    $auth_state[] = 1;
                } else {
                    $require[] = 9;
                    $auth_state[] = 0;
                }
            }
        }

        
        if(Cache::has('user_login_info'))
        {
            $login_info = Cache::get('user_login_info');
        } else {
            $login_info = DB::table('user_login_info')->where('user_id',$user_id)->orderBy('id','desc')->first();
            Cache::put('user_login_info', $login_info, 600);
        }

        $created_date = date("Y-m-d");
        if ($login_info){
            $f_day = $login_info->login_day;
            $last = self::dateDifference($created_date, $f_day);
        }

        $work_state['last'] = $last;
        $work_state['work_state'] = 1;
        $rrequire = -1;
        if (count($require) >0)
            $rrequire = $require[0];

        
        if(Cache::has('c_feedback'))
        {
            $feedback_count = Cache::get('c_feedback');
        } else {
            $feedback_count = DB::table('feedback')->where('to_id',$user_id)->count();
            Cache::put('c_feedback', $feedback_count, 600);
        }
        $feedback_total = 0 ;
        $total = json_decode(DB::table('feedback')
            ->where('to_id',$user_id)->select('eval_total')->get(), true);

        $cc = 0;
        for ($k = 0; $k< count($total); $k++) {
            $feedback_total = $feedback_total + (int) $total[$k]['eval_total'];

            if ((float)$total[$k]['eval_total'] > 4)
                $cc++;
        }

        $feedback['count'] = 0;
        $feedback['result'] = 0;
        $feedback['good_result_rate'] = 0;
        if ($feedback_count>0)
        {
            $feedback['count'] = $feedback_count;
            $feedback['result'] = round($feedback_total/$feedback_count,1);
            $feedback['good_result_rate'] = round($cc/$feedback_count,1)*100;
            DB::table('users')->where('id',$user_id)->update(['result'=>$feedback['count'], 'evaluate'=>$feedback['result']]);
        }

        // $actual_result['number'] = DB::table('report_acquire')
        //     ->join('hire','hire.id','=','report_acquire.hire_id')
        //     ->where('hire.from_id',$user_id)->orWhere('hire.to_id',$user_id)->count();

        $first = DB::table('report_acquire')
            ->join('hire','hire.id','=','report_acquire.hire_id')
            ->where('hire.from_id',$user_id)->orWhere('hire.to_id',$user_id)->count();

        $second = DB::table('report_acquire')
            ->join('hire','hire.id','=','report_acquire.hire_id')
            ->where('hire.from_id',$user_id)->where('report_acquire.acquire_type',1)
            ->orWhere(function ($query) use ($user_id)
            {
                $query->where('hire.from_id', $user_id)->where('report_acquire.acquire_type',1);
            })->count();


        // if ($first == 0)
        //     $actual_result['acquire_rate'] = 0;
        // else
        //     $actual_result['acquire_rate'] = round($second/$first , 1)*100;

        // $total = json_decode(DB::table('report_acquire')->join('hire','hire.id','=','report_acquire.hire_id')
        //     ->where('hire.from_id',$user_id)->where('report_acquire.acquire_type',1)
        //     ->orWhere(function ($query) use ($user_id)
        //     {
        //         $query->where('hire.from_id', $user_id)->where('report_acquire.acquire_type',1);
        //     })->select('acquire_budget')->get(), true);

        // $acquire_total = 0;

        // for ($k = 0; $k< count($total); $k++)
        //     $acquire_total = (int)$total[$k]['acquire_budget'];
        // $actual_result['acquire_total'] = $acquire_total;

        return array('loyalty'=>$loyalty, 'require_first'=>$rrequire, 'require'=>$require,
            'auth_state'=>$auth_state,'work_state'=>$work_state,'feedback'=>$feedback
        );
    }
    private function dateDifference($date_1 , $date_2 , $differenceFormat = '%a' )
    {
        $datetime1 = date_create($date_1);
        $datetime2 = date_create($date_2);

        $interval = date_diff($datetime1, $datetime2);

        return (int)$interval->format($differenceFormat);
    }
     /**
    *   Created by  :   Thắng - 17/10/2018 
    *   Description :   getMessage
    *   @return     :
    */
    public function getMessage()
    {
        
        $user_id = session('user_id');
        $hire_data = DB::table('hire')->where('hire.from_id',$user_id)->where('hire.submit_type','<=',1)
                    ->orWhere(function ($query) use ($user_id)
                    {
                        $query->where('hire.to_id', $user_id)->where('hire.submit_type','<=',1);
                    })->join('users', function($join) use($user_id)
                    {
                        $join->on('users.id','=','hire.from_id')->where('hire.to_id',$user_id);
                        $join->orOn('users.id','=','hire.to_id')->where('hire.from_id',$user_id);
                    })->join('policy','policy.id','=','hire.policy_id')->orderBy('hire.id','desc')
                    ->select('hire.id as hire_id','users.id as user_id','policy.id as policy_id',
                        'users.image as user_image','users.displayname', 'policy.name as policy_name','hire.accept as hire_accept')->get();

        $find_hire_id = 0;
        if (count($hire_data)>0)
            $find_hire_id = $hire_data[0]->hire_id;
        $result = DB::table('message')->where('message.flag','<=',1)->where('message.to_id', $user_id)->where('message.hire_id',$find_hire_id)
            ->orWhere(function ($query) use ($user_id,$find_hire_id)
            {
                $query->where('message.from_id', $user_id)->where('message.flag','<=',1)->where('message.hire_id',$find_hire_id);
            })
            ->join('users', function($join) use($user_id)
            {
                $join->on('users.id','=','message.from_id')->where('message.to_id',$user_id);
                $join->orOn('users.id','=','message.to_id')->where('message.from_id',$user_id);
            })->join('policy','policy.id','=','message.policy_id')->join('hire','hire.id','=','message.hire_id')
            ->select('message.id as message_id','message.from_id','message.to_id',
                'users.displayname','users.image as user_image','policy.name as policy_name',
                'message.message','message.file','message.update_date','message.accept as message_accept',
                'message.flag as message_flag')->get();

        //print_r($hire_data);
        $price = DB::table('hire')->where('id',$find_hire_id)->first();

        $unread_messages = DB::table('message')->select(['hire_id'])->distinct()->where([
            ['to_id', '=', $user_id], 
            ['flag', '<=', 0]
        ])->get()->toArray();

        $unread_messages = array_map(function($message){
            return $message->hire_id;
        }, $unread_messages);

        return self::view("Client::mypage.message",['hire_data'=>$hire_data,'result'=>$result,'user_id'=>$user_id,'unread_messages'=>$unread_messages,'price'=>$price]);
    }  
     /**
    *   Created by  :   Thắng - 17/10/2018 
    *   Description :   get View Index
    *   @return     :
    */
    public function getMessagebyid(Request $request)
    {
        
        $user_id = $request->user_id;
        $hire_id = $request->hire_id;
        $result = DB::table('message')->where('message.flag','<=',1)->where('message.to_id', $user_id)->where('message.hire_id',$hire_id)
            ->orWhere(function ($query) use ($user_id,$hire_id)
            {
                $query->where('message.from_id', $user_id)->where('message.flag','<=',1)->where('message.hire_id',$hire_id);
            })
            ->join('users', function($join) use($user_id)
            {
                $join->on('users.id','=','message.from_id')->where('message.to_id',$user_id);
                $join->orOn('users.id','=','message.to_id')->where('message.from_id',$user_id);
            })->join('policy','policy.id','=','message.policy_id')->join('hire','hire.id','=','message.hire_id')
            ->select('message.id as message_id','message.from_id','message.to_id',
                'users.displayname','users.image as user_image','policy.name as policy_name',
                'message.message','message.file','message.update_date','message.accept as message_accept',
                'message.flag as message_flag')->get();

            $read = DB::table('message')->where([
                        ['to_id', '=', $user_id],
                        ['hire_id', '=', $hire_id]
                    ])->update(['flag' => 1]);
            $count = DB::table('message')->where('hire_id',$hire_id)->where('from_id',$user_id)->count();
            $result = json_decode(json_encode($result, JSON_NUMERIC_CHECK),true);
            
            // get limit accept
            if($count >= 10){
                $result[count($result)] = 1;
            }else{
                $result[count($result)] = 0;
            }       
        return $result; 
    } 
            /**
    *   Created by  :   Quang Thắng 13/10/2018 
    *   Description :   searchMessage
    *   @return     :
    */
    public function searchMessage(Request $request)
    {
        $user_id = session('user_id');
        $keyword = $request->keyword;
            $hire_data = DB::table('hire')->join('users', function($join) use($user_id)
                    {
                        $join->on('users.id','=','hire.from_id')->where('hire.to_id',$user_id);
                        $join->orOn('users.id','=','hire.to_id')->where('hire.from_id',$user_id);
                    })->join('policy','policy.id','=','hire.policy_id')->orderBy('hire.id','desc')
                    ->select('hire.id as hire_id','users.id as user_id','policy.id as policy_id',
                        'users.image as user_image','users.displayname', 'policy.name as policy_name','hire.accept as hire_accept')
                    ->orWhere(function ($query) use ($user_id, $keyword)
                    {
                        $query->where('hire.from_id', $user_id)->where('hire.submit_type','<=',1)->where('users.displayname','like','%'.$keyword.'%');  
                    })
                    ->orWhere(function ($query1) use ($user_id,$keyword)
                    {
                        $query1->where('hire.to_id', $user_id)->where('hire.submit_type','<=',1)->where('policy.name','like','%'.$keyword.'%');
                    })->get();

        $result = json_decode(json_encode($hire_data, JSON_NUMERIC_CHECK),true); 
        $unread_messages = DB::table('message')->select(['hire_id'])->distinct()->where([
            ['to_id', '=', $user_id], 
            ['flag', '<=', 0]
        ])->get()->toArray();

        $unread_messages = array_map(function($message){
            return $message->hire_id;
        }, $unread_messages);
        $result[count($result)] = $unread_messages;
        return $result;
    } 
           /**
    *   Created by  :   Quang Thắng 13/10/2018 
    *   Description :   sendMessage
    *   @return     :
    */
    public function sendMessage(Request $request){
        $from_id = session('user_id');
        $message = $request->message;
        $hire_id = $request->hire_id;

        $first = DB::table('hire')->where('id',$hire_id)->first();
        $policy_id = $first->policy_id;
        $update_date = date("Y-m-d");
        $accept = $first->accept;
        $flag = -1;

        $count_file = $request->count_file;
        $totalArray = [];

        $count = 0;
        if (($accept == 0) || ($accept == 2)){
            $count = DB::table('message')->where('hire_id',$hire_id)->where('from_id',$from_id)->count();
            if ($count >= 10)
                return 'overflow';
        }
        else if ($accept == 1){
            $flag = 0;
        }

        if ($from_id == $first->from_id)
            $to_id = $first->to_id;
        else
            $to_id = $first->from_id;

            // insert message
            $id = DB::table('message')->insertGetId(array('from_id'=>$from_id,'to_id'=>$to_id,'policy_id'=>$policy_id,'hire_id'=>$hire_id,'update_date'=>$update_date,'flag'=>$flag, 'message'=>$message));
            // upload file
            if($count_file !=''){
                for ($k = 0; $k< $count_file; $k++) {
                    $file= $request->file('fileToUpload'.$k);
                    
                    $staticfinish = date('Y_m_d');
                    //Move Uploaded File
                    $expire_date = DB::table('users')->where('id','=',$from_id)->first();
                    $expire_date = $k.$expire_date->expire_date;
                    $destinationPath = 'assets/attach/'.$staticfinish;

                    $filename = md5($expire_date).".".$file->getClientOriginalExtension();
                    $uploadedFileName = UploadFile::upload($destinationPath, $file, $filename);
                    $destinationPath_ = 'assetsAND&attachAND&'.$staticfinish;
                    $destinationPath_ = $destinationPath_."AND&".$filename;
                    $tempArray = [];
                    $tempArray[] = $filename;
                    $tempArray[] = $destinationPath_;
                    $totalArray[] = $tempArray;
                }
                // update file message
                DB::table('message')->where("id", $id)->update(['file'=>json_encode($totalArray,JSON_UNESCAPED_UNICODE)]);
            }
        
        return "success";
    }
         /**
    *   Created by  :   Quang Thắng 4/10/2018 
    *   Description :   downloadurl
    *   @return     :
    */
    public function downloadurl($link, $name)
    {
        Log::info('Download file'.$link.$name);
        $link = str_replace("AND&","/",$link);
        $file = public_path()."/".$link;
        $headers = array(
            'Content-Type: application/pdf',
        );
        return \Response::download($file, $name, $headers);
    }
         /**
    *   Created by  :   Thắng - 18/10/2018 
    *   Description :   messagePer_case
    *   @return     :
    */
    public function messagePer_case()
    {
        
        $user_id = session('user_id');
        $policies = DB::table('message')->join('policy','policy.id','=','message.policy_id')
            ->where('message.from_id',$user_id)->where('message.flag','<=',1)
            ->orWhere(function ($query) use ($user_id)
            {
                $query->where('message.to_id', $user_id)->where('message.flag','<=',1);
            })
            ->orderBy('message.id','desc')->select('message.policy_id','policy.name as policy_name')->distinct()->get();

        $policy_first_id  =0;
        if (count($policies)>0)
        {
            $policy_first_id = $policies[0]->policy_id;
        }
        $hire_data = DB::table('message')
                ->join('users',function($join) use($user_id)
                {
                    $join->on('users.id','=','message.from_id')->where('message.to_id',$user_id);
                    $join->orOn('users.id','=','message.to_id')->where('message.from_id',$user_id);
                })->join('hire','hire.id','=','message.hire_id')
                ->orderBy('message.id','desc')
                ->join('policy','policy.id','=','hire.policy_id')
                ->where('message.policy_id',$policy_first_id)
                ->select('message.hire_id','users.displayname','users.id as user_id',
                    'users.image as user_image', 'policy.name as policy_name','hire.accept as hire_accept')->distinct('hire.id')->get();

        // $hires = array_values(array_unique($hires,SORT_REGULAR));


        $hire_first_id = 0;
        if (count($hire_data)>0) {
            $hire_first_id = $hire_data[0]->hire_id;
        }

        $result = DB::table('message')
            ->where('message.flag','<=',0)
            ->where('message.to_id', $user_id)
            ->where('message.hire_id',$hire_first_id)
            ->orWhere(function ($query) use ($user_id,$hire_first_id)
            {
                $query->where('message.from_id', $user_id)->where('message.flag','<=',1)->where('message.hire_id',$hire_first_id);
            })
            ->join('users', function($join) use($user_id)
            {
                $join->on('users.id','=','message.from_id')->where('message.to_id',$user_id);
                $join->orOn('users.id','=','message.to_id')->where('message.from_id',$user_id);
            })->join('policy','policy.id','=','message.policy_id')->join('hire','hire.id','=','message.hire_id')
            ->select('message.id as message_id','message.from_id','message.to_id','users.displayname',
                'users.image as user_image','policy.name as policy_name','message.message',
                'message.file','message.update_date','message.accept as message_accept',
                'message.flag as message_flag')->get();

        $price = DB::table('hire')->where('id',$hire_first_id)->first();
        $unread_messages = DB::table('message')->select(['hire_id'])->distinct()->where([
            ['to_id', '=', $user_id], 
            ['flag', '<=', 0]
        ])->get()->toArray();

        $unread_messages = array_map(function($message){
            return $message->hire_id;
        }, $unread_messages);
        return self::view("Client::mypage.message_case",['hire_data'=>$hire_data,'result'=>$result,'user_id'=>$user_id,'policies'=>$policies,'price'=>$price,'unread_messages'=>$unread_messages]);
    }  
            /**
    *   Created by  :   Quang Thắng 13/10/2018 
    *   Description :   searchMessage
    *   @return     :
    */
    public function searchMessagePer_case(Request $request)
    {
        $user_id = session('user_id');
        $policy_id = $request->policy_id;
        $keyword = '';
        if(isset($request->keyword)){
           $keyword = $request->keyword;
        }

        $hire_data = DB::table('message')
                ->join('users',function($join) use($user_id)
                {
                    $join->on('users.id','=','message.from_id')->where('message.to_id',$user_id);
                    $join->orOn('users.id','=','message.to_id')->where('message.from_id',$user_id);
                })->join('hire','hire.id','=','message.hire_id')
                ->orderBy('message.id','desc')
                ->join('policy','policy.id','=','hire.policy_id')
                ->orWhere(function ($query) use ($user_id, $keyword,$policy_id)
                {
                    $query->where('hire.from_id', $user_id)->where('hire.submit_type','<=',1)->where('policy.id', $policy_id)
                    ->where('users.displayname','like','%'.$keyword.'%') ;  
                })
                ->orWhere(function ($query1) use ($user_id,$keyword,$policy_id)
                {
                    $query1->where('hire.to_id', $user_id)->where('hire.submit_type','<=',1)->where('policy.id', $policy_id)
                    ->where('policy.name','like','%'.$keyword.'%')
                    ;
                })
                ->select('message.hire_id','users.displayname','users.id as user_id',
                    'users.image as user_image', 'policy.name as policy_name','hire.accept as hire_accept')->distinct('hire.id')->get();
        $result = json_decode(json_encode($hire_data, JSON_NUMERIC_CHECK),true); 
        $unread_messages = DB::table('message')->select(['hire_id'])->distinct()->where([
            ['to_id', '=', $user_id], 
            ['flag', '<=', 0]
        ])->get()->toArray();

        $unread_messages = array_map(function($message){
            return $message->hire_id;
        }, $unread_messages);
        $result[count($result)] = $unread_messages;
        return $result;
    } 
             /**
    *   Created by  :   Quang Thắng 19/10/2018 
    *   Description :   messageEvery_massey
    *   @return     :
    */
    public function messageEvery_massey()
    {
        
        $user_id = session('user_id');

        $clients = DB::table('message')
            ->join('users', function($join) use ($user_id)
            {
                $join->on('users.id','=','message.from_id')->where('message.to_id',$user_id);
                $join->orOn('users.id','=','message.to_id')->where('message.from_id',$user_id);
            })
            ->select('users.displayname','users.id as user_id','users.image as user_image')
            ->orderBy('message.id','desc')->distinct('users.id')->get();

        $client_first_id  =0;
        if (count($clients)>0)
        {
            $client_first_id = $clients[0]->user_id;
        }

        $hire_data = DB::table('message')
            ->where('message.from_id',$client_first_id)->where('message.to_id',$user_id)->where('message.flag','<=',0)
            ->orWhere(function ($query) use ($client_first_id, $user_id)
            {
                $query->where('message.to_id', $client_first_id)->where('message.flag','<=',1)->where('message.from_id',$user_id);
            })->join('policy','policy.id','=','message.policy_id')
            ->join('users', function($join) use ($user_id)
            {
                $join->on('users.id','=','message.from_id')->where('message.to_id',$user_id);
                $join->orOn('users.id','=','message.to_id')->where('message.from_id',$user_id);
            })->join('hire','hire.id','=','message.hire_id')
            ->select('message.hire_id','policy.name as policy_name','users.displayname',
                'users.image as user_image','users.id as user_id','hire.accept as hire_accept')->orderBy('message.id','desc')->distinct('hire.id')->get();

        $hire_first_id = 0;
        if (count($hire_data)>0) {
            $hire_first_id = $hire_data[0]->hire_id;
        }

        $result = DB::table('message')->where('message.flag','<=',0)->where('message.to_id', $user_id)->where('message.hire_id',$hire_first_id)
            ->orWhere(function ($query) use ($user_id,$hire_first_id)
            {
                $query->where('message.from_id', $user_id)->where('message.flag','<=',0)->where('message.hire_id',$hire_first_id);
            })
            ->join('users', function($join) use($user_id)
            {
                $join->on('users.id','=','message.from_id')->where('message.to_id',$user_id);
                $join->orOn('users.id','=','message.to_id')->where('message.from_id',$user_id);
            })->join('policy','policy.id','=','message.policy_id')->join('hire','hire.id','=','message.hire_id')
            ->select('message.id as message_id','message.from_id','message.to_id','users.displayname',
                'users.image as user_image','policy.name as policy_name','message.message',
                'message.file','message.update_date','message.accept as message_accept',
                'message.flag as message_flag')->get();

        $price = DB::table('hire')->where('id',$hire_first_id)->first();

        $unread_messages = DB::table('message')->select(['hire_id'])->distinct()->where([
            ['to_id', '=', $user_id], 
            ['flag', '<=', 0]
        ])->get()->toArray();

        $unread_messages = array_map(function($message){
            return $message->hire_id;
        }, $unread_messages);

        return self::view("Client::mypage.message_every_massey",['hire_data'=>$hire_data,'result'=>$result,'user_id'=>$user_id,'clients'=>$clients,'price'=>$price,'unread_messages'=>$unread_messages]);
    } 
            /**
    *   Created by  :   Quang Thắng 13/10/2018 
    *   Description :   searchmessageEvery_massey
    *   @return     :
    */
    public function searchmessageEvery_massey(Request $request)
    {
        $user_id = session('user_id');
        $client_id = $request->client_id;
        $keyword = '';
        if(isset($request->keyword)){
           $keyword = $request->keyword;
        }

        $hire_data = DB::table('message')
                ->join('users',function($join) use($user_id)
                {
                    $join->on('users.id','=','message.from_id')->where('message.to_id',$user_id);
                    $join->orOn('users.id','=','message.to_id')->where('message.from_id',$user_id);
                })->join('hire','hire.id','=','message.hire_id')
                ->orderBy('message.id','desc')
                ->join('policy','policy.id','=','hire.policy_id')
                ->orWhere(function ($query) use ($user_id, $keyword,$client_id)
                {
                    $query->where('hire.from_id', $user_id)->where('hire.submit_type','<=',1)->where('hire.to_id', $client_id)
                    ->where('users.displayname','like','%'.$keyword.'%') ;  
                })
                ->orWhere(function ($query) use ($user_id, $keyword,$client_id)
                {
                    $query->where('hire.from_id', $user_id)->where('hire.submit_type','<=',1)->where('hire.to_id', $client_id)
                    ->where('policy.name','like','%'.$keyword.'%') ;  
                })
                ->orWhere(function ($query1) use ($user_id,$keyword,$client_id)
                {
                    $query1->where('hire.to_id', $user_id)->where('hire.submit_type','<=',1)->where('hire.from_id', $client_id)
                    ->where('policy.name','like','%'.$keyword.'%')
                    ;
                })
                 ->orWhere(function ($query1) use ($user_id,$keyword,$client_id)
                {
                    $query1->where('hire.to_id', $user_id)->where('hire.submit_type','<=',1)->where('hire.from_id', $client_id)
                    ->where('users.displayname','like','%'.$keyword.'%')
                    ;
                })
                ->select('message.hire_id','users.displayname','users.id as user_id',
                    'users.image as user_image', 'policy.name as policy_name','hire.accept as hire_accept')->distinct('hire.id')->get();
        
        $result = json_decode(json_encode($hire_data, JSON_NUMERIC_CHECK),true); 
        $unread_messages = DB::table('message')->select(['hire_id'])->distinct()->where([
            ['to_id', '=', $user_id], 
            ['flag', '<=', 0]
        ])->get()->toArray();

        $unread_messages = array_map(function($message){
            return $message->hire_id;
        }, $unread_messages);
        $result[count($result)] = $unread_messages;
        return $result;
    } 

      /**
    *   Created by  :   Thắng - 19/10/2018 
    *   Description :   messageDisplay_unread_only
    *   @return     :
    */
    public function messageDisplay_unread_only()
    {
        
        $user_id = session('user_id');

        $hire_data = DB::table('message')
            ->join('policy','policy.id','=','message.policy_id')
            ->join('users', function($join) use($user_id)
            {
                $join->on('users.id','=','message.from_id')->where('message.to_id',$user_id);
                $join->orOn('users.id','=','message.to_id')->where('message.from_id',$user_id);
            })
            ->where('message.from_id',$user_id)->where('message.flag','<=',0)
            ->orWhere(function ($query) use ( $user_id)
            {
                $query->where('message.to_id', $user_id)->where('message.flag','<=',0);
            })->join('hire','hire.id','=','message.hire_id')
            ->where('message.accept',0)
            ->orderBy('message.id','desc')->select('message.hire_id','policy.name as policy_name','users.displayname','users.image as user_image','users.id as user_id',
                'policy.id as policy_id','hire.accept as hire_accept')->distinct('hire.id')->get();

        // print_r($hire_data);
        // die;
        $hire_first_id = 0;
        if (count($hire_data)>0)
            $hire_first_id = $hire_data[0]->hire_id;

        $result = DB::table('message')->where('message.flag','<=',0)->where('message.to_id', $user_id)->where('message.hire_id',$hire_first_id)
            ->orWhere(function ($query) use ($user_id,$hire_first_id)
            {
                $query->where('message.from_id', $user_id)->where('message.flag','<=',0)->where('message.hire_id',$hire_first_id);
            })/*->offset($current_page*$per_page )->limit($per_page)*/
            ->join('users', function($join) use($user_id)
            {
                $join->on('users.id','=','message.from_id')->where('message.to_id',$user_id);
                $join->orOn('users.id','=','message.to_id')->where('message.from_id',$user_id);
            })->join('policy','policy.id','=','message.policy_id')->join('hire','hire.id','=','message.hire_id')
            ->select('message.id as message_id','message.from_id',
                'message.to_id','users.displayname','users.image as user_image',
                'policy.name as policy_name','message.message','message.file',
                'message.update_date','message.accept as message_accept',
                'message.flag as message_flag')->get();

        $price = DB::table('hire')->where('id',$hire_first_id)->first();

        $unread_messages = DB::table('message')->select(['hire_id'])->distinct()->where([
            ['to_id', '=', $user_id], 
            ['flag', '<=', 0]
        ])->get()->toArray();

        $unread_messages = array_map(function($message){
            return $message->hire_id;
        }, $unread_messages);

        // print_r($result);
        // die;
        // print_r($unread_messages);
        // die;
        return self::view("Client::mypage.message_display_unread_only",['hire_data'=>$hire_data,'result'=>$result,'user_id'=>$user_id,'price'=>$price,'unread_messages'=>$unread_messages]);
    }  
       /**
    *   Created by  :   Thắng - 19/10/2018 
    *   Description :   searchMessage_display_unread_only
    *   @return     :
    */
    public function searchMessage_display_unread_only(Request $request)
    {
        $user_id = session('user_id');
        $keyword = $request->keyword;
            $hire_data = DB::table('hire')->join('users', function($join) use($user_id)
                    {
                        $join->on('users.id','=','hire.from_id')->where('hire.to_id',$user_id);
                        $join->orOn('users.id','=','hire.to_id')->where('hire.from_id',$user_id);
                    })->join('policy','policy.id','=','hire.policy_id')->orderBy('hire.id','desc')
                      ->join ('message')->on('hire.id','=','message.hire_id')->where('message.flag','<=',0)
                    ->select('hire.id as hire_id','users.id as user_id','policy.id as policy_id',
                        'users.image as user_image','users.displayname', 'policy.name as policy_name','hire.accept as hire_accept')
                    ->orWhere(function ($query) use ($user_id, $keyword)
                    {
                        $query->where('hire.from_id', $user_id)->where('hire.submit_type','<=',1)->where('users.displayname','like','%'.$keyword.'%');  
                    })
                    ->orWhere(function ($query1) use ($user_id,$keyword)
                    {
                        $query1->where('hire.to_id', $user_id)->where('hire.submit_type','<=',1)->where('policy.name','like','%'.$keyword.'%');
                    })->distinct('hire.id')->get();
        
        // print_r($hire_data);
        // die;
        $result = json_decode(json_encode($hire_data, JSON_NUMERIC_CHECK),true); 
        $unread_messages = DB::table('message')->select(['hire_id'])->distinct()->where([
            ['to_id', '=', $user_id], 
            ['flag', '<=', 0]
        ])->get()->toArray();

        $unread_messages = array_map(function($message){
            return $message->hire_id;
        }, $unread_messages);
        $result[count($result)] = $unread_messages;
        return $result;
    } 
      /**
    *   Created by  :   Thắng - 17/10/2018 
    *   Description :   getMessage_display_unread_only_byid
    *   @return     :
    */
    public function getMessage_display_unread_only_byid(Request $request)
    {
        
        $user_id = $request->user_id;
        $hire_id = $request->hire_id;
        $result = DB::table('message')->where('message.flag','<=',0)->where('message.to_id', $user_id)->where('message.hire_id',$hire_id)
            ->orWhere(function ($query) use ($user_id,$hire_id)
            {
                $query->where('message.from_id', $user_id)->where('message.flag','<=',0)->where('message.hire_id',$hire_id);
            })
            ->join('users', function($join) use($user_id)
            {
                $join->on('users.id','=','message.from_id')->where('message.to_id',$user_id);
                $join->orOn('users.id','=','message.to_id')->where('message.from_id',$user_id);
            })->join('policy','policy.id','=','message.policy_id')->join('hire','hire.id','=','message.hire_id')
            ->select('message.id as message_id','message.from_id','message.to_id',
                'users.displayname','users.image as user_image','policy.name as policy_name',
                'message.message','message.file','message.update_date','message.accept as message_accept',
                'message.flag as message_flag')->get();

            $read = DB::table('message')->where([
                        ['to_id', '=', $user_id],
                        ['hire_id', '=', $hire_id]
                    ])->update(['flag' => 1]);
            $count = DB::table('message')->where('hire_id',$hire_id)->where('from_id',$user_id)->count();
            $result = json_decode(json_encode($result, JSON_NUMERIC_CHECK),true);
            
            // get limit accept
            if($count >= 10){
                $result[count($result)] = 1;
            }else{
                $result[count($result)] = 0;
            }       
        return $result; 
    } 
    // part followList
      /**
    *   Created by  :   Thắng - 20/10/2018 
    *   Description :   getFollowList
    *   @return     :
    */
    public function getFollowList(Request $request){
        $user_id = session('user_id');
        $type = 0;
        $per_page = 10;
        $order = 0;

        if(isset($request->type)){
            $type = $request->type;
        }
        if(isset($request->per_page)){
            $per_page = $request->per_page;
        }
        if(isset($request->order)){
            $order = $request->order;
        }

        $result = DB::table('checklist_policy_user')->select('policy_id')->where('type',$type)->where('user_id',$user_id)->get();

        $temp = [];
        if($result){
            foreach ($result as $key => $value) {
                $temp[] = $value->policy_id;
            }
        }

        $total=[];
        $policy_data = DB::table('policy')->where('publication_setting',0)->whereIn("policy.id", $temp)->paginate($per_page);

        $total = json_decode(json_encode($policy_data), true );
        $total = $total['data'];

        for($k=0; $k<count($total); $k++){
            $total[$k]['count_agency'] = $this->get_matched_count($total[$k]['id']);
        }
        if ($order == 0) {
            $this::sortArrayByKey($total,"id",false,false);
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
            $this::sortArrayByKey($total,"count_agency", false, false);
        }

        $policy = $total ;
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

        $exist_flag = DB::table('users')->where('id', $user_id)->first();
        $payroll = 0;
        if ($exist_flag)
            $payroll = $exist_flag->payroll;
        //print_r($policy);
        //die;
        $link="?order=".$order."&per_page=".$per_page;
        $policy_data->setPath($link);

        return self::view("Client::mypage.followList",['result'=>$policy,'policy_data'=>$policy_data,'payroll'=>$payroll,
            'order'=>$order,'per_page'=>$per_page]);
    }

    public function get_matched_count($policy_id){
        $matched_usercount = 0;
        $result = $this->get_matched_users($policy_id);
        $matched_usercount = count($result);
        return $matched_usercount;
    }

    public function get_matched_users($policy_id){
        $matched_users = [];
        $matched_users = json_decode(DB::table('matching_users')->join('users', 'matching_users.user_id', '=', 'users.id')->where('users.manage_flag', 0)->where('matching_users.policy_id', $policy_id)->select('users.*')->orderBy('matching_users.order_type', 'asc')->distinct()->get(), true);
        return $matched_users;
    }
    function sortArrayByKey(&$array,$key,$string = false,$asc = true){
        if($string){
            usort($array,function ($a, $b) use(&$key,&$asc)
            {
                if($asc) return strcmp(strtolower($a{$key}), strtolower($b{$key}));
                else     return strcmp(strtolower($b{$key}), strtolower($a{$key}));
            });
        }
        else{
            usort($array,function ($a, $b) use(&$key,&$asc)
            {
                if($a[$key] == $b{$key}){return 0;}
                if($asc) return ($a{$key} < $b{$key}) ? -1 : 1;
                else     return ($a{$key} > $b{$key}) ? -1 : 1;
            });
        }
    }

       /**
    *   Created by  :   Thắng - 20/10/2018 
    *   Description :   getInterest
    *   @return     :
    */
    public function getInterest(Request $request){
        $user_id = session('user_id');
        $type = 1;
        $per_page = 10;
        $order = 0;

        if(isset($request->type)){
            $type = $request->type;
        }
        if(isset($request->per_page)){
            $per_page = $request->per_page;
        }
        if(isset($request->order)){
            $order = $request->order;
        }

        $result = DB::table('checklist_policy_user')->select('policy_id')->where('type',$type)->where('user_id',$user_id)->get();

        $temp = [];
        if($result){
            foreach ($result as $key => $value) {
                $temp[] = $value->policy_id;
            }
        }

        $total=[];
        $policy_data = DB::table('policy')->where('publication_setting',0)->whereIn("policy.id", $temp)->paginate($per_page);

        $total = json_decode(json_encode($policy_data), true );
        $total = $total['data'];

        for($k=0; $k<count($total); $k++){
            $total[$k]['count_agency'] = $this->get_matched_count($total[$k]['id']);
        }
        if ($order == 0) {
            $this::sortArrayByKey($total,"id",false,false);
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
            $this::sortArrayByKey($total,"count_agency", false, false);
        }

        $policy = $total ;
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

        $exist_flag = DB::table('users')->where('id', $user_id)->first();
        $payroll = 0;
        if ($exist_flag)
            $payroll = $exist_flag->payroll;
        //print_r($policy);
        //die;
        $link="?order=".$order."&per_page=".$per_page;
        $policy_data->setPath($link);

        return self::view("Client::mypage.interest",['result'=>$policy,'policy_data'=>$policy_data,'payroll'=>$payroll,
            'order'=>$order,'per_page'=>$per_page]);
    }
       /**
    *   Created by  :   Thắng - 20/10/2018 
    *   Description :   getNonrepresentation
    *   @return     :
    */
    public function getNonrepresentation(Request $request){
        $user_id = session('user_id');
        $type = 2;
        $per_page = 10;
        $order = 0;
        if(isset($request->type)){
            $type = $request->type;
        }
        if(isset($request->per_page)){
            $per_page = $request->per_page;
        }
        if(isset($request->order)){
            $order = $request->order;
        }

        $result = DB::table('checklist_policy_user')->select('policy_id')->where('type',$type)->where('user_id',$user_id)->get();

        $temp = [];
        if($result){
            foreach ($result as $key => $value) {
                $temp[] = $value->policy_id;
            }
        }

        $total=[];
        $policy_data = DB::table('policy')->where('publication_setting',0)->whereIn("policy.id", $temp)->paginate($per_page);

        $total = json_decode(json_encode($policy_data), true );
        $total = $total['data'];

        for($k=0; $k<count($total); $k++){
            $total[$k]['count_agency'] = $this->get_matched_count($total[$k]['id']);
        }
        if ($order == 0) {
            $this::sortArrayByKey($total,"id",false,false);
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
            $this::sortArrayByKey($total,"count_agency", false, false);
        }

        $policy = $total ;
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

        $exist_flag = DB::table('users')->where('id', $user_id)->first();
        $payroll = 0;
        if ($exist_flag)
            $payroll = $exist_flag->payroll;
        //print_r($policy);
        //die;
        $link="?order=".$order."&per_page=".$per_page;
        $policy_data->setPath($link);

        return self::view("Client::mypage.hide",['result'=>$policy,'policy_data'=>$policy_data,'payroll'=>$payroll,
            'order'=>$order,'per_page'=>$per_page]);
    }
       /**
    *   Created by  :   Thắng - 20/10/2018 
    *   Description :   getFollow
    *   @return     :
    */
    public function getFollow(Request $request){
        $user_id = session('user_id');
        $per_page = 10;
        $search = false;
        // if (isset($request->search)) {
        //    $search = ;
        // }
        $result = DB::table('users')->join('follow','users.id','=','follow.follow_id')
                                    ->where('follow.user_id', $user_id)->select('users.id', 'users.image', 'users.displayname', 'users.result', 'users.evaluate', 'users.section', 'users.location', 'users.manage_flag')
                                    ->orderBy('users.id', 'desc')->paginate($per_page);
            
            if($result){
                foreach ($result as $key => $value) {
                        $value->is_collect_flag = '募集中';
                        if($value->manage_flag == 0){
                            $first = DB::table('post')->where('user_id', $value->id)->orderBy('id', 'desc')->first();
                            $match_date = '-';
                            if ($first) {
                                $match_date = date('Y年m月d日', strtotime($first->post_date));
                            }
                        }else{
                            $first = DB::table('matching')->where('from_id', $value->id)->orderBy('id', 'desc')->first();
                            $match_date = '-';
                            if ($first) {
                                $match_date = date('Y年m月d日', strtotime($first->start_date));
                            }
                        }
                        $value->final_request_date = $match_date;
                        $value->final_request_content = DB::table('hire')->where('from_id', $value->id)->orWhere('to_id', $value->id)->count();
                }
                //print_r($result);
                // die;
            }

        return self::view("Client::mypage.follow",['result'=>$result]);
    }

       /**
    *   Created by  :   Thắng - 20/10/2018 
    *   Description :   getFollowers
    *   @return     :
    */
    public function getFollowers(Request $request){
        $user_id = session('user_id');
        $per_page = 10;
        $result = DB::table('users')->join('follow','users.id','=','follow.follow_id')
                                    ->where('follow.follow_id', $user_id)->select('users.id', 'users.image', 'users.displayname', 'users.result', 'users.evaluate', 'users.section', 'users.location', 'users.manage_flag')
                                    ->orderBy('users.id', 'desc')->distinct('users.id')->paginate($per_page);
            
            if($result){
                foreach ($result as $key => $value) {
                        $value->is_collect_flag = '募集中';
                        if($value->manage_flag == 0){
                            $first = DB::table('post')->where('user_id', $value->id)->orderBy('id', 'desc')->first();
                            $match_date = '-';
                            if ($first) {
                                $match_date = date('Y年m月d日', strtotime($first->post_date));
                            }
                        }else{
                            $first = DB::table('matching')->where('from_id', $value->id)->orderBy('id', 'desc')->first();
                            $match_date = '-';
                            if ($first) {
                                $match_date = date('Y年m月d日', strtotime($first->start_date));
                            }
                        }
                        $value->final_request_date = $match_date;
                        $value->final_request_content = DB::table('hire')->where('from_id', $value->id)->orWhere('to_id', $value->id)->count();
                }
                //print_r($result);
                // die;
            }

        return self::view("Client::mypage.followers",['result'=>$result]);
    }
       /**
    *   Created by  :   Thắng - 20/10/2018 
    *   Description :   getChoose_the_measures
    *   @return     :
    */
    public function getChoose_the_measures(Request $request){
        $user_id = session('user_id');
        $type = 1;
        $per_page = 10;
        $order = 0;
        $user_id = $request->follow_id;

        if(isset($request->type)){
            $type = $request->type;
        }
        if(isset($request->per_page)){
            $per_page = $request->per_page;
        }
        if(isset($request->order)){
            $order = $request->order;
        }

        $result = DB::table('post')->join('policy', 'policy.id', '=', 'post.policy_id')->where('post.user_id', $user_id)
        ->select('policy.*','post.id as post_id','post.title','post.content','post.main_point','post.pay_option','post.post_date','post.policy_id','post.complete_date','post.document_business_price','post.document_business_type','post.request_business_price','post.request_business_type','post.deposit_money','post.other_money');
        if((int)$order == 0){
            $result = $result->orderBy('post_id','desc')
            ->distinct()->paginate($per_page);
        } else if((int)$order == 1){
            $result = $result->orderBy('policy.acquire_budget_display','desc')
            ->distinct()->paginate($per_page);
        } else {
            $result = $result->orderBy('policy.acquire_budget_display','asc')
            ->distinct()->paginate($per_page);
        }

        //$result = json_decode($result, true);

        foreach ($result as $key => $value) {
            $cc = DB::table('hire')->where('policy_id',$value->policy_id)->count();
            $value->request_count = $cc.'本';

            $date1 = date_create($value->complete_date);
            $cur_date = date('Y-m-d');
            $date2 = date_create($cur_date);
            $remain_time = date_diff($date1, $date2);
            $value->remaining = $remain_time->format('%a日 %h時間');
            $value->service_content = $value->title;

            $document_business_price = 0;
            $request_business_price = 0;
            if ((int) $value->document_business_type == 0)
                $document_business_price = (int)$value->document_business_price;
            else
                $document_business_price = (int)$value->document_business_price * 1000;

            if ((int) $value->request_business_type == 0)
                $request_business_price = (int) $value->request_business_price;
            else
                $request_business_price = (int)$value->request_business_price * 1000;

            $value->calc_business = $document_business_price + $request_business_price;

            if ($value->calc_business == 0)
                $value->calc_business="なし";
            else
                $value->calc_business.="円";

            Log::info($document_business_price.":".$request_business_price);

            $value->document_business_price.="円";
            $businesstype = json_decode($value->business_type, true);
            $value->business_type = $businesstype;
            $register1 = json_decode($value->register_pdf1, true);
            $value->register_pdf1 = $register1;
        }
        //print_r($result);
        //die;
        $link="?order=".$order."&per_page=".$per_page;
        $result->setPath($link);

        return self::view("Client::mypage.choose_the_measures",['result'=>$result,'order'=>$order,'per_page'=>$per_page,'user_id'=>$user_id]);
    }
    
            /**
    *   Created by  :   Thắng - 20/10/2018 
    *   Description :   getAuthentication
    *   @return     :
    */
    public function getAuthentication(Request $request){
        $user_id = session('user_id');

        if(isset($request->submit)){
            $birthday = $request->year.'-'.$request->mon.'-'.$request->day;
            // echo $birthday;
            // die;
            $address = $request->address;
            $name = $request->name;
            $option1 = 0;
            $option2 = 0;
            $update_at = date("Y-m-d");
            if(isset($request->option1))
            $option1 = $request->option1;
            if(isset($request->option2))
            $option2 = $request->option2;

            if($request->edit_type == 0){

                DB::table('person_confirm')->insert(['user_id' => $user_id, 'name' => $name,'address'=>$address,
                                                     'birthday'=>$birthday, 'update_at'=>$update_at,'option1'=>$option1,'option2'=>$option2]);
                if(isset($request->profile)){
                    $list_file = $request->profile;
                    foreach ($list_file as $key => $value) {
                        $file= $value;
                        $staticfinish = date('Y_m_d');
                        //Move Uploaded File
                        $now = date('Y-m-d H:i:s');
                        $expire_date = $now.$user_id;
                        $expire_date = $key.$expire_date;
                        $destinationPath = 'assets/pdf/'.$staticfinish;

                        $filename = md5($expire_date).".".$file->getClientOriginalExtension();
                        $uploadedFileName = UploadFile::upload($destinationPath, $file, $filename);
                        $destinationPath_ = 'assetsAND&attachAND&'.$staticfinish;
                        $destinationPath_ = $destinationPath_."AND&".$filename;
                        $tempArray = [];
                        $tempArray[] = $file->getClientOriginalName();
                        $tempArray[] = $destinationPath_;
                        $totalArray[] = $tempArray;
                    }
                    DB::table('person_confirm')->where("user_id", $user_id)->update(['files'=>json_encode($totalArray,JSON_UNESCAPED_UNICODE)]);
                }
            }else{
                $first = DB::table('person_confirm')->where('user_id', $user_id)->first();
                if ($first) {
                    DB::table('person_confirm')->where('user_id',$user_id)
                        ->update(['name'=>$name,'address'=>$address,'birthday'=>$birthday,'update_at'=>$update_at,'option1'=>$option1,'option2'=>$option2]);
                }
                $list_img_old = json_decode($first->files, true);
                $list_update = [];
                $list_img_old_2 = [];
                if(isset($request->profile_name_edit)){
                    $list_update = $request->profile_name_edit; 

                    foreach ($list_update as $key => $value) {
                        foreach ($list_img_old as $key1 => $value1) {
                            if($value == $value1[0]){
                                $list_img_old_2[$key1] = $value1 ;
                                unset($list_update[$key]);
                                break;
                            }
                        }
    
                    }
                   
                    if(isset($request->profile_edit) && count($list_update) > 0 ){
                        $list_file = $request->profile_edit;
                        foreach ($list_file as $key => $value) {
                            $file = $value;

                            $staticfinish = date('Y_m_d');
                            //Move Uploaded File
                            $now = date('Y-m-d H:i:s');
                            $expire_date = $now.$user_id;
                            $expire_date = $key.$expire_date;
                            $destinationPath = 'assets/pdf/'.$staticfinish;

                            $filename = md5($expire_date).".".$file->getClientOriginalExtension();
                            $uploadedFileName = UploadFile::upload($destinationPath, $file, $filename);
                            $destinationPath_ = 'assetsAND&attachAND&'.$staticfinish;
                            $destinationPath_ = $destinationPath_."AND&".$filename;
                            $tempArray = [];
                            $tempArray[] = $file->getClientOriginalName();
                            $tempArray[] = $destinationPath_;
                            $totalArray[] = $tempArray;
                        }
                        $list_img_old_2  = array_merge($list_img_old_2, $totalArray);
                        // print_r($list_img_old_2);
                        // die;
                        // print_r($totalArray);
                        $totalArray = [];
                    }

                }
                if(isset($request->profile)){
                    $list_file = $request->profile;
                    foreach ($list_file as $key => $value) {
                        $file= $value;
                        $staticfinish = date('Y_m_d');
                        //Move Uploaded File
                        $a = $key+count($list_update);
                        $now = date('Y-m-d H:i:s');
                        $expire_date = $now.$user_id;
                        $expire_date = $a.$expire_date;
                        $destinationPath = 'assets/pdf/'.$staticfinish;

                        $filename = md5($expire_date).".".$file->getClientOriginalExtension();
                        $uploadedFileName = UploadFile::upload($destinationPath, $file, $filename);
                        $destinationPath_ = 'assetsAND&attachAND&'.$staticfinish;
                        $destinationPath_ = $destinationPath_."AND&".$filename;
                        $tempArray = [];
                        $tempArray[] = $file->getClientOriginalName();
                        $tempArray[] = $destinationPath_;
                        $totalArray[] = $tempArray;
                    }

                $list_img_old_2  = array_merge($list_img_old_2, $totalArray);
                }
                DB::table('person_confirm')->where("user_id", $user_id)->update(['files'=>json_encode($list_img_old_2,JSON_UNESCAPED_UNICODE)]);
                $request->session()->flash('status', '本人確認書類を送信しました。');  
            }

        }
        $allow_odc = 0;
        $result = $this::veryAuth($user_id);
       
        if($result['person_confirm']['result'] == 'success'){
           $allow_odc = $result['person_confirm']['data']->allow; 
        }
        return self::view("Client::mypage.authentication",['result'=>$result,'allow_odc'=>$allow_odc]);
    }
   
    public function veryAuth($user_id){
        $person_confirm_ = DB::table('person_confirm')->where('user_id',$user_id)->first();
        
        $person_confirm = array('result'=>'failed');
        if ($person_confirm_) {
            $person_confirm = array('result'=>'success', 'data'=>$person_confirm_);
        }

        $nda = DB::table('user_nda')->where('user_id', $user_id)->first();

        if (!$nda) {
            $user_nda = array('result'=>'failed');
        } else {
             $user_nda = array('result'=>'failed');
            if ((int)$nda->allow == 1) {
                $user_nda = array('result'=>'success');
            }
        }

        $check_ = DB::table('user_check')->where('user_id', $user_id)->first();

        if (!$check_) {
            $user_check = array('result'=>'failed');
        } else {
            $user_check = array('result'=>'failed');
            if ((int)$check_->allow == 1) {
                $user_check = array('result'=>'success');
            }
        }

        $phone_ = DB::table('person_phone')->where('user_id',$user_id)->first();
        if (!$phone_) {
            $user_phone= array('result'=>'failed');
        }
        else {
            $user_phone= array('result'=>'failed');
            if ((int)$phone_->allow == 1) {
                $user_phone= array('result'=>'success');
            }
        }
        return array('person_confirm'=>$person_confirm, 'user_nda'=>$user_nda, 'user_check'=>$user_check,'user_phone'=>$user_phone);
    }
        /**
    *   Created by  :   Thắng - 24/10/2018 
    *   Description :   getConfidentiality_confirmation
    *   @return     :
    */
    public function getConfidentiality_confirmation(Request $request){
        $user_id = session('user_id');

        
        $allow_odc = 0;
        $result = $this::veryAuth($user_id);

        if(isset($request->submit)){
            Log::info("getConfidentiality_confirmation");
            $first = DB::table('user_nda')->where('user_id', $user_id)->first();
            if (!$first){

                DB::table('user_nda')->insert(['user_id' => $user_id, 'allow' => 1]);
            }
            else {
                Log::info('yes');
                DB::table('user_nda')->where('user_id',$user_id)->update(['allow'=>1]);
            }
            return back();
        }
       
        if($result['person_confirm']['result'] == 'success'){
           $allow_odc = $result['person_confirm']['data']->allow; 
        }
        //print_r($result);
        return self::view("Client::mypage.confidentiality_confirmation",['result'=>$result]);
    }
         /**
    *   Created by  :   Thắng - 24/10/2018 
    *   Description :   getSecretariat_confirmation
    *   @return     :
    */
    public function getSecretariat_confirmation(Request $request){
        $user_id = session('user_id');
        $result = $this::veryAuth($user_id);
        
        if(isset($request->submit)){

            $first = DB::table('user_check')->where('user_id', $user_id)->first();
            if (!$first){
                 DB::table('user_check')->insert(['user_id' => $user_id,'allow'=>1]);
            }
            else {
                DB::table('user_check')->where('user_id',$user_id)->update(['allow'=>1]);
            }
            return back();
        }
        //print_r($result);
        return self::view("Client::mypage.secretariat_confirmation",['result'=>$result]);
    }
         /**
    *   Created by  :   Thắng - 25/10/2018 
    *   Description :   getCall_confirmation
    *   @return     :
    */
    public function getCall_confirmation(Request $request){
        $user_id = session('user_id');
        $result = $this::veryAuth($user_id);
        
        if(isset($request->submit) && isset($request->to)){
            $to = $request->to;
            // Connection information
            $base_url = 'https://api.nexmo.com' ;
            $action = '/verify/json';

            // Authentication information
            $api_key = '11155cb2';
            $api_secret = 'E4UOCgtyszOfMEHb';

            // 番号変換
            $number = preg_replace( '/^0/', '+81',$to  );

            // Create the request URL
            $url = $base_url . $action . "?api_key=" . $api_key . "&api_secret=" . $api_secret . "&number=" . $number . "&brand=\"SAMURAI\"";

            // Create the request
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            $response = curl_exec($ch);
            if (!$response) {
                // API呼出しが失敗した場合
                $update = 'failed';
            }

            $response = json_decode($response, true);
            if ($response["status"] == 0) {
                // 戻り値statusが成功だった場合
                $request_id = $response["request_id"];
                // テーブルの確認
                $first = DB::table('person_phone')->where('user_id',$user_id)->first();
                $created_at = date("Y-m-d H:i:s");
                if (!$first) {
                    // 新規登録
                     DB::table('person_phone')
                        ->insert([`user_id`=>$user_id,'phone_number'=>$to, 'verification_code'=>$request_id , 'created_at'=>$created_at]);
                }
                else {
                    // 更新
                    DB::table('person_phone')->where('user_id',$user_id)
                        ->update(['phone_number'=>$to, 'verification_code'=>$request_id , 'created_at'=>$created_at]);
                }
                $update = 'success';
                return self::view("Client::mypage.call_confirmation",['result'=>$result,'update'=>$update]);
            } else {
                $update = 'failed';
            }
            // echo $update;
            // die;//
            

        }else if(isset($request->submit) && isset($request->phone)){
            $code = $request->phone;
            $user_phone = DB::table('person_phone')->where('user_id',$user_id)->first();

            // Connection information
            $base_url = 'https://api.nexmo.com';
            $action = '/verify/check/json';

            // Authentication information
            $api_key = '11155cb2';
            $api_secret = 'E4UOCgtyszOfMEHb';

            // Create the request URL
            $url = $base_url . $action . "?api_key=" . $api_key . "&api_secret=" . $api_secret . "&request_id=". $user_phone->verification_code . "&code=" . $code;

            // Create the request
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            $response = curl_exec($ch);

            Log::info($response);
            if (!$response) {
                // API呼出しが失敗した場合
                
                $update2 = 'failed';
            }

            $response = json_decode($response, true);
                if ($response["status"] == 0) {
                    // 戻り値statusが成功だった場合
                    $updated_at = date("Y-m-d H:i:s");
                    DB::table('person_phone')->where('user_id',$user_id)
                        ->update(['allow'=>1,'created_at'=>$updated_at]);
                    $update2 = 'success';
                    Mail::queue(new \App\Mail\PersonConfirmSuccess($user_phone));
                    return redirect()->route('agency.authentication.call_confirmation')->withSuccess('電話確認が完了しました。');
                } else {
                    $update2 = 'failed';
                    return self::view("Agency::mypage.call_confirmation",['result'=>$result,'update2'=>$update2]);
                }
            
        }
        //print_r($result);
        return self::view("Client::mypage.call_confirmation",['result'=>$result]);
    }
      // payment
          /**
    *   Created by  :   Thắng - 25/10/2018 
    *   Description :   getPayment
    *   @return     :
    */
    public function getPayment(Request $request){

        $user_id = session('user_id');
        $pay_type = 0;
        $year = date('Y');
        $month = 0;
        $per_page = 10;
        $start_date = "";
        $end_date = "";
        if($request->year)
            $year = $request->year;
        if($request->pay_type)
            $pay_type = $request->pay_type;
        if($request->month)
            $month = $request->month;

        $result = DB::table('payment')
            ->join('users', 'users.id', '=', 'payment.user_id')
            ->where('status','<', 4);

        if($month == 0){
            $start_date = date('Y-m-d', strtotime($year."-01-01"));
            $end_date = date('Y-m-d', strtotime($year."-12-31"));
            $result = $result->where('created_time','>=', $start_date);
            $result = $result->where('created_time','<=', $end_date);
            // echo $year;
            // die;

        } else {
            $start_date = date('Y-m-d', strtotime($year."-".$month."-01"));
            $month = $month+1;
            $end_date = date('Y-m-d', strtotime($year."-".$month."-01"));
            $result = $result->where('created_time','>=', $start_date);
            $result = $result->where('created_time','<', $end_date);
            $month--;
        }

        if((int)$pay_type == 0){
            $result = $result->where('user_id', $user_id);
            $result = $result->orWhere(function ($query) use ($start_date, $end_date, $month, $user_id)
            {
                $query->where('to_id', $user_id)->where('status','<', 4);
                if($month == 0){
                    $query->where('created_time','>=', $start_date);
                    $query->where('created_time','<=', $end_date);
                } else {
                    $query->where('created_time','>=', $start_date);
                    $query->where('created_time','<', $end_date);
                }

            });
        } else if((int)$pay_type == 1){
            $result = $result->where('to_id', $user_id);
        } else {
            $result = $result->where('user_id', $user_id);
        }

        // when status less four,  0: fund, 1: processing , 2:release, 3: refund
        $result = $result->select('payment.*','users.remain_balance')->paginate($per_page);

        foreach ($result as $key => $value) {
            if($value->user_id == $user_id){
                $value->output_balance = $value->balance;
                $value->input_balance = 0;
            }else{
                $value->input_balance = $value->balance;
                $value->output_balance = 0;
            }
        }
        $link = '?pay_type='.$pay_type.'&year='.$year.'&month='.$month;
        $result->setPath($link);
        $pay_status=["エスクロー","処理中", "支払済","返金"];
        
        return self::view("Client::mypage.payment",['result'=>$result,'pay_status'=>$pay_status,
                                                    'pay_type'=>$pay_type,'year'=>$year,"month"=>$month ]);
    }
          /**
    *   Created by  :   Thắng - 25/10/2018 
    *   Description :   support_management
    *   @return     :
    */
    public function getSupport_management(Request $request){


        $user_id = session('user_id');
        $status = 0;
        $year = date('Y');
        $month = 0;
        $per_page = 20;
        $start_date = "";
        $end_date = "";
        if($request->year)
            $year = $request->year;
        if($request->status)
            $status = $request->status;
        if($request->month)
            $month = $request->month;

        $result = DB::table('payment')
            ->where('user_id', $user_id)
            ->join('users', 'users.id', '=', 'payment.user_id');

        if((int)$status == 0){
            $ids = ["0","2","4","5","6"];

        } else if((int)$status == 1) {
            $ids = ["4","5"];
        } else {
            $ids = ["0","2"];
        }
        $result = $result->whereIn('status', $ids);
        if($month == 0){
            $start_date = date('Y-m-d', strtotime($year."-01-01"));
            $end_date = date('Y-m-d', strtotime($year."-12-31"));
            $result = $result->where('created_time','>=', $start_date);
            $result = $result->where('created_time','<=', $end_date);

        } else {
            $start_date = date('Y-m-d', strtotime($year."-".$month."-01"));
            $month = $month+1;
            $end_date = date('Y-m-d', strtotime($year."-".$month."-01"));
            $result = $result->where('created_time','>=', $start_date);
            $result = $result->where('created_time','<', $end_date);
            $month--;
        }
        $result = $result->select('payment.*','users.remain_balance')->paginate($per_page);

        // print_r($result);
        // die();
        foreach ($result as $key => $value) {
           if(((int)$value->status==0) || ((int)$value->status==2)){
                $value->paid_status = 1;

            } else if((int)$value->status==6) {
                $value->paid_status = 6;

            } else {
                $value->paid_status = 0;
            }
        }
        // print_r($result);
        // die();
        $getStatus=["未払い","支払済","","","","","銀行振込待"];
        $link = '?status='.$status.'&year='.$year.'&month='.$month;
        $result->setPath($link);

        return self::view("Client::mypage.support_management",['result'=>$result,'getStatus'=>$getStatus,
                                                               'status'=>$status,'year'=>$year,"month"=>$month ]);
    }
    /**
    *   Created by  :   Thắng - 25/10/2018 
    *   Description :   Pay
    *   @return     :
    */
    public function Pay(Request $request){
        if(isset($request->submit)){
            if($request->aid || $request->cod || $request->jb || $request->rt || $request->pn || $request->em || $request->am || $request->tx || $request->sf || $request->pn || $request->nmf || $request->po) {
                  $params = array(
                      'aid' => $request->aid ,
                      'cod' => $request->cod ,
                      'jb' => $request->jb ,
                      'rt' => $request->rt ,
                      'pn' => $request->pn ,
                      'em' => $request->em ,
                      'am' => $request->am ,
                      'tx' => $request->tx ,
                      'sf' => $request->sf ,
                      'pn' => $request->pn,
                      'nmf' => $request->nmf,
                      'po' => $request->po
                  );

                  $url = "https://credit.j-payment.co.jp/gateway/bank.aspx";
                  $ch = curl_init();
                  curl_setopt($ch, CURLOPT_URL, $url);
                  curl_setopt($ch, CURLOPT_POST, 1);
                  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                  curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
                  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
                  curl_setopt($ch, CURLOPT_TIMEOUT, 60);

                  $result = curl_exec($ch);
                  if(curl_errno($ch) !== 0) {
                      error_log('cURL error when connecting to ' . $url . ': ' . curl_error($ch));
                  }

                  curl_close($ch);

                  echo gettype($result);
                  print_r($result); 

               }
        }
        return self::view("Client::mypage.pay");
    }

            /**
    *   Created by  :   Thắng - 25/10/2018 
    *   Description :   withdrawal
    *   @return     :
    */
    public function getWithdrawal(Request $request){


        $user_id = session('user_id');
        $available_amount = 0;
        $current_date = date('Y-m-d');
        $transfer_payment = DB::table('transfer_payment')
            ->where('user_id', $user_id)
            ->where('transfer_time','>=',$current_date)->get();

        foreach ($transfer_payment as $key => $value) {
            if($value->finish_time == "0000-00-00"){
                $value->finish_time = "振込日は、振込確定日の翌日に表示されます。";
            }
            $available_amount += $value->transfer_amount;
        }
        //print_r($transfer_payment);
        // get info bank
        $bank_info = array();
        $bank_info = DB::table('admin_bank')
            ->select('admin_bank.*')
            ->get();

        $card_info = DB::table('admin_card')
            ->select('admin_card.*')
            ->get();
        

        $user = DB::table('users')->where('id',$user_id)->select('company_name',
            'performer','phone_number','fax','location','municipality',
            'street_building_name')->distinct()->get();

        $bank_name = '';
        $branch_name = '';
        $account_type = -1;
        $account_number = '';
        $account_name = '';
        $branch_code ='';
        $bank_code ='';
        $bank_id =0;
        $auto_release_type = 0;
        $bank_data = DB::table('user_bank')->where('user_id',$user_id)->distinct()->get();

        if (count($bank_data)) {
            $bank_name = $bank_data[0]->bank_name;
            $branch_name = $bank_data[0]->branch_name;
            $account_type = $bank_data[0]->account_type;
            $account_number = $bank_data[0]->account_number;
            $account_name = $bank_data[0]->account_name;
            $branch_code = $bank_data[0]->branch_code;
            $bank_code = $bank_data[0]->bank_code;
            $bank_id = $bank_data[0]->bank_id;
            $auto_release_type = $bank_data[0]->auto_release_type;
        }

        $user[0]->bank_name = $bank_name;
        $user[0]->branch_name = $branch_name;
        $user[0]->account_type = $account_type;
        $user[0]->account_number = $account_number;
        $user[0]->account_name = $account_name;
        $user[0]->branch_code = $branch_code;
        $user[0]->bank_code = $bank_code;
        $user[0]->bank_id = $bank_id;
        $user[0]->auto_release_type = $auto_release_type;

        $user_affiliate = DB::table('user_affiliate')->where('user_id',$user_id)->distinct()->get();

        $user[0]->remuneration_notice = 0;
        $user[0]->message_notice = 0;

        if ($user_affiliate) {
            $user[0]->remuneration_notice = $user_affiliate[0]->remuneration_notice;
            $user[0]->message_notice = $user_affiliate[0]->message_notice;
        }
        //print_r($user);
        // die;

        // update acc bank
        if(isset($request->submit)){

            $bank_name = $request->bank_name;
            
            $account_type = $request->account_type;
            $account_number = $request->account_number;
            $account_name = $request->account_name;
            $bank_code = $request->bank_code;
            $bank_id = $request->bank_id;
            $auto_release_type = $request->auto_release_type;
            if(isset($request->bank_name) && isset($request->bank_code)){
                $branch_name = $request->branch_name;
                $branch_code = $request->branch_code;
            }else{
                 
                 // $branch_name = $request->branch_name;
                 // $branch_code = $request->branch_code;
            }
            $bank_data = DB::table('user_bank')->where('user_id',$user_id)->first();
            // echo $request->branch_name;
            // die;
            if ($bank_data) {
                DB::table('user_bank')->where('user_id',$user_id)->update(['bank_id'=>$bank_id, 'bank_name'=>$bank_name, 'bank_code'=>$bank_code, 'branch_name'=>$branch_name, 'account_type'=>$account_type,'account_number'=>$account_number, 'account_name'=>$account_name, 'branch_code'=>$branch_code, 'auto_release_type'=>$auto_release_type]);
            } else {
                DB::table('user_bank')->insert(['user_id'=>$user_id,'bank_id'=>$bank_id, 'bank_name'=>$bank_name,'bank_code'=>$bank_code, 'branch_name'=>$branch_name, 'branch_code'=>$branch_code,'account_type'=>$account_type,'account_number'=>$account_number, 'account_name'=>$account_name, 'auto_release_type'=>$auto_release_type]);
            }
            return back();
        }
        return self::view("Client::mypage.withdrawal",
                            ['available_amount'=>$available_amount,'transfer_payment'=> $transfer_payment, 'bank_info'=>$bank_info, 'card_info'=>$card_info,'user_info'=>$user]);
    }

     // affiliate
    /**
    *   Created by  :   Thắng - 27/10/2018 
    *   Description :   getAffiliate
    *   @return     :
    */
    public function getAffiliate(Request $request){
        $user_id = session('user_id');


        $dirs = "assets/affiliate/business";
        $directorys = array_diff(scandir($dirs ,1), array('..','.'));
        for ($k = 0; $k < count($directorys) ; $k++) {
            $dirpath = $dirs."/" . $directorys[$k];
            $files = array_diff(scandir($dirpath, 1), array('..','.'));
            if (count($files) > 0)
                $results[] = array('dir'=> $directorys[$k], 'sub'=>$files);
        }
        $dirs = "assets/affiliate/agency";
        $directorys = array_diff(scandir($dirs ,1), array('..','.'));
        for ($k = 0; $k < count($directorys) ; $k++) {
            $dirpath = $dirs."/" . $directorys[$k];
            $files = array_diff(scandir($dirpath, 1), array('..','.'));
            if (count($files) > 0)
                $results1[] = array('dir'=> $directorys[$k], 'sub'=>$files);
        }

        $created_at = date("Y-m-d");
        $result  = DB::table('user_affiliate')->where('user_id', $user_id)->first();

        
        $affiliate_url = env('CLIENT_URL', false)."register_affiliate/".$user_id."/";

        if (!$result) DB::table('user_affiliate')->insert(['user_id'=> $user_id, 'created_at'=>$created_at]);

        //print_r($results); die;
        $bannerdirectory = ['mobile', 'rectmid','rectbig','big','half'];
        $sizearray = ['320X100', '300X250','336X280','728X90','300X600'];
        $businessmessagearray = ["助成金・補助金自動マッチングサイト「SAMURAI」","助成金・補助金自動マッチングサイト「SAMURAI」　登録無料","取得できる助成金・補助金がすぐにわかる「SAMURAI」","助成金・補助金マッチングサイト「サムライ」に登録しませんか？"
        ,"助成金・補助金簡単取得","助成金・補助金申請代行者の３者マッチング"   ];
        $agencymessagearray = ["助成金・補助金の簡単検索、申請システム","助成金・補助金を受けたい企業のプラットフォーム","助成金・補助金の簡単申請・管理システム","士業の為の助成金・補助金マッチングサイト","士業の為の助成金・補助金申請企業検索サイト"];
    
        return self::view("Client::mypage.affiliate",['business'=>$results, 
                                                      'agency'=>$results1, 'affiliate_url'=>$affiliate_url,
                                                      'sizearray'=> $sizearray,'bannerdirectory'=>$bannerdirectory,'businessmessagearray'=>$businessmessagearray,'agencymessagearray'=>$agencymessagearray]);
    }
    /**
    *   Created by  :   Thắng - 27/10/2018 
    *   Description :   getResult
    *   @return     :
    */
    public function getResult(Request $request){
        $year = date('Y')-2;
        $month = 0;
        $op = 0;
        $per_page = 10;
        $start_date = "";
        $end_date = "";
        if($request->year)
            $year = $request->year;
        if($request->op)
            $op = $request->op;
        if($request->month)
            $month = $request->month;

        $user_id = session('user_id');


        $sum_result = array();

        if($op == "0"){
            $start = date('Y-m-d', strtotime($year."-01-01"));
            $end = date('Y-m-d', strtotime($year."-12-31"));
            $final_results_arr = DB::select(DB::raw("
            SELECT
                \"総額\" AS date,
                COUNT(*) AS final_result,
                COALESCE(SUM(yearly_payment.balance), 0) AS final_result_amount
            FROM
                payment AS yearly_payment
            LEFT JOIN users AS yearly_from_users
            ON
                yearly_payment.user_id = yearly_from_users.id
            LEFT JOIN users AS yearly_to_users
            ON
                yearly_payment.to_id = yearly_to_users.id
            WHERE
                yearly_payment.order_id != '' AND yearly_payment.created_time BETWEEN \"$start\" AND \"$end\" AND (yearly_from_users.affiliate_id = \"$user_id\" OR yearly_to_users.affiliate_id = \"$user_id\")
            UNION ALL
                (
                SELECT
                    CONCAT(\"\", DATE_FORMAT(
                        monthly_payment.created_time,
                        \"%c\"
                    ), \"月\") AS date,
                    COUNT(*) AS final_result,
                    COALESCE(SUM(monthly_payment.balance), 0) AS final_result_amount
                FROM
                    payment AS monthly_payment
                LEFT JOIN users AS monthly_from_users
                ON
                    monthly_payment.user_id = monthly_from_users.id
                LEFT JOIN users AS monthly_to_users
                ON
                    monthly_payment.to_id = monthly_to_users.id
                WHERE
                    monthly_payment.order_id != '' AND monthly_payment.created_time BETWEEN \"$start\" AND \"$end\" AND (monthly_from_users.affiliate_id = \"$user_id\" OR monthly_to_users.affiliate_id = \"$user_id\")
                GROUP BY
                    DATE_FORMAT(
                        monthly_payment.created_time,
                        \"%c\"
                    )
            )"));

            $user_count_result_arr = DB::select(DB::raw("
            SELECT
                \"総額\" AS date,
                COUNT(*) AS user_count
            FROM
                users
            WHERE
                created_at BETWEEN \"$start\" AND \"$end\" AND affiliate_id = \"$user_id\"
            UNION ALL
                (
                SELECT
                    CONCAT(\"\", DATE_FORMAT(
                        users.created_at,
                        \"%c\"
                    ), \"月\") AS date,
                    COUNT(*) AS user_count
                FROM
                    users
                WHERE
                    created_at BETWEEN \"$start\" AND \"$end\" AND affiliate_id = \"$user_id\"
                GROUP BY
                    DATE_FORMAT(users.created_at, \"%c\")
            )
            "));

            $final_results_arr = json_decode(json_encode($final_results_arr), true);
            $user_count_result_arr = json_decode(json_encode($user_count_result_arr), true);
            $yearly_user_count = $user_count_result_arr[0]['user_count']?: 0;
            $sum_result[0] = array_merge($final_results_arr[0], ['user_count' => $yearly_user_count]);

            for ($i = 1; $i < 13; $i++) {
                $sum_result[$i] = [
                    'date' => $i . '月',
                    'final_result' => 0,
                    'final_result_amount' => 0.0,
                    'user_count' => 0
                ];
            }

            for ($i = 1; $i < 13; $i++) {
                if(array_key_exists($i, $final_results_arr)) {
                    $sum_result[str_replace('月', '', $final_results_arr[$i]['date'])] = array_merge($sum_result[str_replace('月', '', $final_results_arr[$i]['date'])], ($final_results_arr[$i]));
                }
                if(array_key_exists($i, $user_count_result_arr)) {
                    $sum_result[str_replace('月', '', $user_count_result_arr[$i]['date'])] = array_merge($sum_result[str_replace('月', '', $user_count_result_arr[$i]['date'])], $user_count_result_arr[$i]);
                }
            }
        } else {
            $start = new Carbon("$year-$month-01");
            $end = (new Carbon("$year-$month-01"))->addMonth();
            $day_count = $start->daysInMonth;
            $final_results_arr = DB::select(DB::raw("
            SELECT
                \"総額\" AS date,
                COUNT(*) AS final_result,
                COALESCE(SUM(monthly_payment.balance), 0) AS final_result_amount
            FROM
                payment AS monthly_payment
            LEFT JOIN users AS monthly_from_users
            ON
                monthly_payment.user_id = monthly_from_users.id
            LEFT JOIN users AS monthly_to_users
            ON
                monthly_payment.to_id = monthly_to_users.id
            WHERE
                monthly_payment.order_id != '' AND monthly_payment.created_time BETWEEN \"$start\" AND \"$end\" AND monthly_payment.created_time != \"$end\" AND (monthly_from_users.affiliate_id = \"$user_id\" OR monthly_to_users.affiliate_id = \"$user_id\")
            UNION ALL
                (
                SELECT
                    CONCAT(\"\", DATE_FORMAT(
                        daily_payment.created_time,
                        \"%d\"
                    ), \"日\") AS date,
                    COUNT(*) AS final_result,
                    COALESCE(SUM(daily_payment.balance), 0) AS final_result_amount
                FROM
                    payment AS daily_payment
                LEFT JOIN users AS daily_from_users
                ON
                    daily_payment.user_id = daily_from_users.id
                LEFT JOIN users AS daily_to_users
                ON
                    daily_payment.to_id = daily_to_users.id
                WHERE
                    daily_payment.order_id != '' AND daily_payment.created_time BETWEEN \"$start\" AND \"$end\" AND daily_payment.created_time != \"$end\" AND (daily_from_users.affiliate_id = \"$user_id\" OR daily_to_users.affiliate_id = \"$user_id\")
                GROUP BY
                    DATE_FORMAT(
                        daily_payment.created_time,
                        \"%Y%m%d\"
                    )
            )"));

            $user_count_result_arr = DB::select(DB::raw("
            SELECT
                \"総額\" AS date,
                COUNT(*) AS user_count
            FROM
                users
            WHERE
                created_at BETWEEN \"$start\" AND \"$end\" AND created_at != \"$end\" AND affiliate_id = \"$user_id\"
            UNION ALL
                (
                SELECT
                    CONCAT(\"\", DATE_FORMAT(
                        users.created_at,
                        \"%d\"
                    ), \"日\") AS date,
                    COUNT(*) AS user_count
                FROM
                    users
                WHERE
                    created_at BETWEEN \"$start\" AND \"$end\" AND created_at != \"$end\" AND affiliate_id = \"$user_id\"
                GROUP BY
                    DATE_FORMAT(users.created_at, \"%Y%m%d\")
            )
            "));

            $final_results_arr = json_decode(json_encode($final_results_arr), true);
            $user_count_result_arr = json_decode(json_encode($user_count_result_arr), true);
            $monthly_user_count = $user_count_result_arr[0]['user_count']?: 0;
            $sum_result[0] = array_merge($final_results_arr[0], ['user_count' => $monthly_user_count]);

            for ($i = 1; $i < $day_count + 1; $i++) {
                $sum_result[$i] = [
                    'date' => $i . '日',
                    'final_result' => 0,
                    'final_result_amount' => 0.0,
                    'user_count' => 0
                ];
            }

            for ($i = 1; $i < $day_count + 1; $i++) {
                if(array_key_exists($i, $final_results_arr)) {
                    $sum_result[str_replace('日', '', $final_results_arr[$i]['date'])] = array_merge($sum_result[str_replace('日', '', $final_results_arr[$i]['date'])], ($final_results_arr[$i]));
                }
                if(array_key_exists($i, $user_count_result_arr)) {
                    $sum_result[str_replace('日', '', $user_count_result_arr[$i]['date'])] = array_merge($sum_result[str_replace('日', '', $user_count_result_arr[$i]['date'])], $user_count_result_arr[$i]);
                }
            }
        }

        return self::view("Client::mypage.result",['year'=>$year, 'month' => $month, 'op'=>$op, 'result'=>$sum_result]);
    }
    /**
    *   Created by  :   Thắng - 27/10/2018 
    *   Description :   getResult
    *   @return     :
    */
    public function getRegister(Request $request){
        $user_id = session('user_id');

        $location =$this->getLocation();
        // get info bank
        $bank_info = array();
        $bank_info = DB::table('admin_bank')
            ->select('admin_bank.*')
            ->get();

        $card_info = DB::table('admin_card')
            ->select('admin_card.*')
            ->get();
        // get info user
        $user = DB::table('users')->join('user_location','users.id','=','user_location.user_id' )->select('users.company_name',
            'users.performer','users.phone_number','users.fax','users.location','users.municipality',
            'users.street_building_name','user_location.province_id','user_location.province_name','user_location.city_id', 'user_location.city_name')->where('users.id',$user_id)->distinct()->get();

        $bank_name = '';
        $branch_name = '';
        $account_type = -1;
        $account_number = '';
        $account_name = '';
        $branch_code ='';
        $bank_code ='';
        $bank_id =0;
        $auto_release_type = 0;
        $bank_data = DB::table('user_bank')->where('user_id',$user_id)->distinct()->get();

        if (count($bank_data)) {
            $bank_name = $bank_data[0]->bank_name;
            $branch_name = $bank_data[0]->branch_name;
            $account_type = $bank_data[0]->account_type;
            $account_number = $bank_data[0]->account_number;
            $account_name = $bank_data[0]->account_name;
            $branch_code = $bank_data[0]->branch_code;
            $bank_code = $bank_data[0]->bank_code;
            $bank_id = $bank_data[0]->bank_id;
            $auto_release_type = $bank_data[0]->auto_release_type;
        }

        $user[0]->bank_name = $bank_name;
        $user[0]->branch_name = $branch_name;
        $user[0]->account_type = $account_type;
        $user[0]->account_number = $account_number;
        $user[0]->account_name = $account_name;
        $user[0]->branch_code = $branch_code;
        $user[0]->bank_code = $bank_code;
        $user[0]->bank_id = $bank_id;
        $user[0]->auto_release_type = $auto_release_type;

        $user_affiliate = DB::table('user_affiliate')->where('user_id',$user_id)->distinct()->get();

        $user[0]->remuneration_notice = 0;
        $user[0]->message_notice = 0;

        if ($user_affiliate) {
            $user[0]->remuneration_notice = $user_affiliate[0]->remuneration_notice;
            $user[0]->message_notice = $user_affiliate[0]->message_notice;
        }

        // update info
        if(isset($request->submit)){
            $performer = $request->performer;
        $location = $request->location;
        $companyname = $request->company_name;
        $municipality = $request->municipality;
        $street_building_name = $request->street_building_name;
        $phone_number = $request->phone_number;

        $province_id = $request->province;
        $city_id = $request->city;

        $province_name = $request->province_name;
        $city_name = $request->city_name;
        $fax = $request->fax;
        DB::table('users')->where('id', $user_id)
            ->update(['performer'=>$performer,'company_name'=>$companyname,'municipality'=>$municipality,
                'location'=>$location,'street_building_name'=>$street_building_name,
                'phone_number'=>$phone_number,'fax'=>$fax]);

        DB::table('user_location')->where('user_id', $user_id)
            ->update(['province_id'=>$province_id,'province_name'=>$province_name,'city_id'=>$city_id, 'city_name'=>$city_name]);

        $bank_name = $request->bank_name;
        $branch_name = $request->branch_name;
        $branch_code = $request->branch_code;
        $account_type = $request->account_type;
        $account_number = $request->account_number;
        $account_name = $request->account_name;
        $bank_code = $request->bank_code;
        $bank_id = $request->bank_id;
        $auto_release_type = 0;
        if (isset($request->auto_release_type)) {
           $auto_release_type = $request->auto_release_type;
        }
        
        $bank_data = DB::table('user_bank')->where('user_id',$user_id)->first();
        if ($bank_data) {
            DB::table('user_bank')->where('user_id',$user_id)->update(['bank_id'=>$bank_id, 'bank_name'=>$bank_name, 'bank_code'=>$bank_code, 'branch_name'=>$branch_name, 'account_type'=>$account_type,'account_number'=>$account_number, 'account_name'=>$account_name, 'branch_code'=>$branch_code, 'auto_release_type'=>$auto_release_type]);
        } else {
            DB::table('user_bank')->insert(['user_id'=>$user_id,'bank_id'=>$bank_id, 'bank_name'=>$bank_name,'bank_code'=>$bank_code, 'branch_name'=>$branch_name, 'branch_code'=>$branch_code,'account_type'=>$account_type,'account_number'=>$account_number, 'account_name'=>$account_name, 'auto_release_type'=>$auto_release_type]);
        }
        return back();
        }
        //print_r($user);
        return self::view("Client::mypage.register",['location'=>$location,
                                                     'bank_info'=>$bank_info,
                                                     'card_info' =>$card_info,
                                                     'user_info' => $user]);
    }
    private function getLocation(){
        $province = DB::table('provinces')
            ->select('provinces.id','provinces.province_name')
            ->distinct()
            ->get();
        
        $province=  json_decode($province, true);
        return $province;
    }
    public function get_sub_local_ajax(Request $request){
        $id = $request->city_id;
        $province = DB::table('cities')
            ->select('cities.id','cities.city_name')
            ->where('cities.province_id','=',$id)
            ->distinct()
            ->get();
        
        $province=  json_decode($province, true);
        return $province;
    }
    /**
     * END ONCUTHEN
     */
}