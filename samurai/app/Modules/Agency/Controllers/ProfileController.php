<?php

namespace App\Modules\Agency\Controllers;

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

class ProfileController extends Controller
{

    public function getProfile(Request $request)
    {
        $client_id = $request->client_id;
        if(!$client_id) return back();
        $trade = Trade::get()->toArray();
        return self::view('Agency::profiles.profile', compact('trade'), $client_id);
    }
    public function getAvailableTaskShow(Request $request)
    {
        $client_id = $request->client_id;
        if(!$client_id) return back();
        $categories = Category::get();
        return self::view('Agency::profiles.available_task_show', compact('categories'), $client_id);
    }
    public function getRating(Request $request,$viewLoad = 'Agency::profiles.rating')
    {
        $viewLoad = 'Agency::profiles.rating';
        $user_id = $request->client_id;
        $result = DB::table('users')->where("id", $user_id)->first();
        $manage_flag = $result->manage_flag;
        $rating_info['result'] = $result->result;
        $rating_info['evaluate'] = $result->evaluate;
        $current = Carbon::now();
        $today = $current->addMonth(-1);
        $yesterday = $current->subMonths(6);
        $yesterday = $yesterday->year."-".$yesterday->month."-".$yesterday->day;
        $today = $today->year."-".$today->month."-".$today->day;


        $rating_info['state_project'] = DB::table('hire')->where('from_id', $user_id)->where('finish_flag',0)->where('accept',1)
            ->orWhere(function ($query) use ($user_id)
            {
                $query->where('to_id', $user_id)->where('finish_flag',0)->where('accept',1);
            })->get()->count();

        $rating_info['direct_request']= DB::table('hire')->where('from_id', $user_id)->where('submit_type',0)->where('accept',1)
            ->count();

        $rating_info['result_a_month'] = DB::table('hire')->where('from_id',$user_id)->where('finish_flag',1)->whereDate('finish_date', '>=', $today)
            ->orWhere(function ($query) use ($user_id,$today)
            {
                $query->where('to_id', $user_id)->where('finish_flag',1)->whereDate('finish_date', '>=', $today);
            })->get()->count();

        $rating_info['result_a_half_year'] = DB::table('hire')->where('from_id',$user_id)->where('finish_flag',1)->whereDate('finish_date', '>=', $yesterday)
            ->orWhere(function ($query) use ($user_id,$yesterday)
            {
                $query->where('to_id', $user_id)->where('finish_flag',1)->whereDate('finish_date', '>=', $yesterday);
            })->get()->count();

        $feedback_a_month = json_decode(DB::table('feedback')->where('to_id',$user_id)->whereDate('created_date','>=',$today)->select('eval_total')->get(), true);
        $feedback_half_year = json_decode(DB::table('feedback')->where('to_id',$user_id)->whereDate('created_date','>=',$yesterday)->select('eval_total')->get(), true);
        $sum1 = 0;$sum2 = 0;

        for ($k = 0; $k< count($feedback_a_month); $k++) {
            $sum1 =$sum1 + $feedback_a_month[$k]['eval_total'];
        }
        for ($k = 0; $k< count($feedback_half_year); $k++) {
            $sum2 =$sum2 + $feedback_half_year[$k]['eval_total'];
        }
        $rating_info['evaluate_a_month'] = 0;
        if (count($feedback_a_month)>0)
            $rating_info['evaluate_a_month'] =number_format((float)$sum1/count($feedback_a_month), 1, '.', '');
        $rating_info['evaluate_a_half_year'] = 0;
        if (count($feedback_half_year)>0)
            $rating_info['evaluate_a_half_year'] =number_format((float)$sum2/count($feedback_half_year), 1, '.', '');

        $feedback = DB::table('feedback')
            ->leftJoin('hire', 'hire.id', '=', 'feedback.hire_id')
            ->leftJoin('policy','policy.id','=','hire.policy_id')
            ->where('feedback.to_id',$user_id)
            ->where('feedback.display',1)
            ->select('feedback.*','policy.image_id as image','policy.name','policy.name_serve','policy.support_content','policy.id as policy_id')->paginate(5);

        return self::view($viewLoad, compact('rating_info', 'feedback'), $user_id);
    }

    private function view($blade, $params = [], $client_id = 0)
    {
        $params['user'] = User::where('id', $client_id)->where('manage_flag','=',0)->with('user_location', 'user_client', 'user_location', 'user_business', 'subCat')->first();
        if(!$params['user']) return back();
        //if(in_array($blade, ['Agency::profiles.home', 'Agency::profiles.profile']))
        //{
            $params['profile_completed'] = self::calculatorProfile($client_id);
            $params['client_id'] = $client_id;
        //}
            // dd($params['user']);
        return view($blade, $params);
    }
    private function calculatorProfile($user_id)
    {
        $result = DB::table('users')->where('id', $user_id)->first();

        $loyalty = 0;
        $require = [];

        $auth_state = [];
        if ($result->manage_flag == 1) {
            if (($result->displayname !="") && ($result->username!="") && ($result->performer!="")){
                $loyalty = $loyalty + 10;
            } else {
                $require[] = 0;
            }

            if ($result->agency_register_number !="") {
                $loyalty = $loyalty + 10;
            } else {
                $require[] = 1;
            }

            if (strpos( $result->image, 'profile_sample.png') !== false ) {
                $require[] = 2;
            } else {
                $loyalty = $loyalty + 10;
            }

            if (count(json_decode($result->pro_part,true))> 0) {
                $loyalty = $loyalty + 10;
            } else {
                $require[] = 3;
            }

            if (count(json_decode($result->category_detail,true))> 0) {
                $loyalty = $loyalty + 10;
            } else {
                $require[] = 4;
            }

            $cc = DB::table('matching')->where('from_id',$user_id)->count();
            if ($cc>0) {
                $loyalty = $loyalty + 10;
            } else {
                $require[] = 5;
            }

            $first = DB::table('person_confirm')->where('user_id',$user_id)->first();
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
            $first = DB::table('user_nda')->where('user_id',$user_id)->first();
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
            $first = DB::table('user_check')->where('user_id',$user_id)->first();
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
            $first = DB::table('person_phone')->where('user_id',$user_id)->first();
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
            if (($result->displayname !="") && ($result->username!="") && ($result->performer!="")) {
                $loyalty = $loyalty + 10;
            } else {
                $require[] = 0;
            }

            if (strpos($result->image, 'profile_sample.png') !== false ) {
                $require[] = 1;
            } else {
                $loyalty = $loyalty + 10;
            }

            if (count(json_decode($result->pro_part,true))> 0) {
                $loyalty = $loyalty + 10;
            } else {
                $require[] = 2;
            }

            if (count(json_decode($result->category))> 0) {
                $loyalty = $loyalty + 10;
            } else {
                $require[] = 3;
            }

            if (count(json_decode($result->category_detail,true))> 0) {
                $loyalty = $loyalty + 10;
            } else {
                $require[] = 4;
            }

            $require55 = DB::table('users_client_data')->where('user_id',$user_id)->first();
            if ($require55) {
                $loyalty = $loyalty + 10;
            } else {
                $require[] = 5;
            }

            //본인 확인 등록 완료
            $first = DB::table('person_confirm')->where('user_id',$user_id)->first();
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
            $first = DB::table('user_nda')->where('user_id',$user_id)->first();
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
            $first = DB::table('user_check')->where('user_id',$user_id)->first();
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
            $first = DB::table('person_phone')->where('user_id',$user_id)->first();
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

        $login_info = DB::table('user_login_info')->where('user_id',$user_id)->orderBy('id','desc')->first();

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

        $feedback_count = DB::table('feedback')->where('to_id',$user_id)->count();
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

        $actual_result['number'] = DB::table('report_acquire')
            ->join('hire','hire.id','=','report_acquire.hire_id')
            ->where('hire.from_id',$user_id)->orWhere('hire.to_id',$user_id)->count();

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


        if ($first == 0)
            $actual_result['acquire_rate'] = 0;
        else
            $actual_result['acquire_rate'] = round($second/$first , 1)*100;

        $total = json_decode(DB::table('report_acquire')->join('hire','hire.id','=','report_acquire.hire_id')
            ->where('hire.from_id',$user_id)->where('report_acquire.acquire_type',1)
            ->orWhere(function ($query) use ($user_id)
            {
                $query->where('hire.from_id', $user_id)->where('report_acquire.acquire_type',1);
            })->select('acquire_budget')->get(), true);

        $acquire_total = 0;

        for ($k = 0; $k< count($total); $k++)
            $acquire_total = (int)$total[$k]['acquire_budget'];
        $actual_result['acquire_total'] = $acquire_total;

        return array('loyalty'=>$loyalty, 'require_first'=>$rrequire, 'require'=>$require,
            'auth_state'=>$auth_state,'work_state'=>$work_state,'feedback'=>$feedback
        ,'actual_result'=>$actual_result);
    }
    private function dateDifference($date_1 , $date_2 , $differenceFormat = '%a' )
    {
        $datetime1 = date_create($date_1);
        $datetime2 = date_create($date_2);

        $interval = date_diff($datetime1, $datetime2);

        return (int)$interval->format($differenceFormat);
    }



    // 


    /**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   get View Index
    *   @return     :
    */
    public function getRequestDetails(Request $request)
    {
        $client_id = $request->client_id;
        if(!$client_id) return back();
        $trade = Trade::get()->toArray();
        return self::view('Agency::profiles.requestdetails', compact('trade'), $client_id);
    }
    public function getEvaluationAchievements(Request $request)
    {
        $client_id = $request->client_id;
        if(!$client_id) return back();
        $categories = Category::get();
        return self::view('Agency::profiles.evaluationachievements', compact('categories'), $client_id);
    }
    public function getAvailablebusiness(Request $request,$viewLoad = 'Agency::profiles.rating')
    {
        $viewLoad = 'Agency::profiles.availablebusiness';
        $user_id = $request->client_id;
        $result = DB::table('users')->where("id", $user_id)->first();
        $manage_flag = $result->manage_flag;
        $rating_info['result'] = $result->result;
        $rating_info['evaluate'] = $result->evaluate;
        $current = Carbon::now();
        $today = $current->addMonth(-1);
        $yesterday = $current->subMonths(6);
        $yesterday = $yesterday->year."-".$yesterday->month."-".$yesterday->day;
        $today = $today->year."-".$today->month."-".$today->day;


        $rating_info['state_project'] = DB::table('hire')->where('from_id', $user_id)->where('finish_flag',0)->where('accept',1)
            ->orWhere(function ($query) use ($user_id)
            {
                $query->where('to_id', $user_id)->where('finish_flag',0)->where('accept',1);
            })->get()->count();

        $rating_info['direct_request']= DB::table('hire')->where('from_id', $user_id)->where('submit_type',0)->where('accept',1)
            ->count();

        $rating_info['result_a_month'] = DB::table('hire')->where('from_id',$user_id)->where('finish_flag',1)->whereDate('finish_date', '>=', $today)
            ->orWhere(function ($query) use ($user_id,$today)
            {
                $query->where('to_id', $user_id)->where('finish_flag',1)->whereDate('finish_date', '>=', $today);
            })->get()->count();

        $rating_info['result_a_half_year'] = DB::table('hire')->where('from_id',$user_id)->where('finish_flag',1)->whereDate('finish_date', '>=', $yesterday)
            ->orWhere(function ($query) use ($user_id,$yesterday)
            {
                $query->where('to_id', $user_id)->where('finish_flag',1)->whereDate('finish_date', '>=', $yesterday);
            })->get()->count();

        $feedback_a_month = json_decode(DB::table('feedback')->where('to_id',$user_id)->whereDate('created_date','>=',$today)->select('eval_total')->get(), true);
        $feedback_half_year = json_decode(DB::table('feedback')->where('to_id',$user_id)->whereDate('created_date','>=',$yesterday)->select('eval_total')->get(), true);
        $sum1 = 0;$sum2 = 0;

        for ($k = 0; $k< count($feedback_a_month); $k++) {
            $sum1 =$sum1 + $feedback_a_month[$k]['eval_total'];
        }
        for ($k = 0; $k< count($feedback_half_year); $k++) {
            $sum2 =$sum2 + $feedback_half_year[$k]['eval_total'];
        }
        $rating_info['evaluate_a_month'] = 0;
        if (count($feedback_a_month)>0)
            $rating_info['evaluate_a_month'] =number_format((float)$sum1/count($feedback_a_month), 1, '.', '');
        $rating_info['evaluate_a_half_year'] = 0;
        if (count($feedback_half_year)>0)
            $rating_info['evaluate_a_half_year'] =number_format((float)$sum2/count($feedback_half_year), 1, '.', '');

        $feedback = DB::table('feedback')
            ->leftJoin('hire', 'hire.id', '=', 'feedback.hire_id')
            ->leftJoin('policy','policy.id','=','hire.policy_id')
            ->where('feedback.to_id',$user_id)
            ->where('feedback.display',1)
            ->select('feedback.*','policy.image_id as image','policy.name','policy.name_serve','policy.support_content','policy.id as policy_id')->paginate(5);

        return self::view($viewLoad, compact('rating_info', 'feedback'), $user_id);
    }

    
    // 
}