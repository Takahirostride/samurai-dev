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
use App\Models\WorkSet;
use App\Models\Message;
use App\Models\Hire;
use App\Models\VisitPolicy;
use App\Models\FeedBack;
use Storage, DB;
use App\Helpers\UploadFile, App\Helpers\Button, App\Helpers\helpers;
use Carbon\Carbon;
use Log, Validator, URL, Mail;
use App\Modules\Asp\Events\HireClientEvent;
use App\Modules\Asp\Events\WorksetClientEvent;
use Event;
use Cache;

class MypageController extends Controller
{
    /**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   get View Index
    *   @return     :
    */
    protected $user;
    public function getIndex($viewLoad = 'Agency::mypage.home')
    {
        
        $policyHistory = VisitPolicy::where('user_id', session('user_id'))
                        ->with('policy', 'policy.sub_minitry', 'policy.minitry', 'policy.policy_region_many', 'policy.policy_region_many.province', 'policy.policy_region_many.city', 'policy.tags', 'policy.checklist_policy_user', 'policy.matchingUser')
                        ->with(['policy.matchingUser'=>function($qr) {
                            $qr->where('user_id', session('user_id'));
                        }])
                        ->has('policy')
                        ->orderBy('id', 'desc')
                        ->paginate(5, ['*'], 'hpage');
        $notification = DB::table('admin_alim')->where('publication_setting',1)->orderBy('id','desc')->take(5)->get();
        //$homePolicy = self::autoSearch();
        $homePolicy = self::policyRecommendList(5, 'rpage');
        return self::view($viewLoad, compact('notification', 'homePolicy', 'policyHistory'));
    }

    public function indexAjax(Request $request)
    {
        $datass['success'] = false;
        if($request->act == 'setType')
        {
            if($request->policy_id && $request->type_id != '')
            {
                $datass['success'] = true;
                $is_exist = DB::table('checklist_policy_user')->where('policy_id', $request->policy_id)
                        ->where('type', $request->type_id)
                        ->where('user_id', session('user_id'))->first();
                if($is_exist)
                {
                    DB::table('checklist_policy_user')->where('id', $is_exist->id)->delete();
                    $datass['is_insert'] = false;
                } else {
                    DB::table('checklist_policy_user')->insert(['policy_id'=>$request->policy_id, 'user_id'=>session('user_id'), 'type'=>$request->type_id]);
                    $datass['is_insert'] = true;
                }
            }
        }
        if($request->act == 'setFollow') 
        {
            if(@$request->follower_id)
            {
                $datass['success'] = true;
                $datass['is_insert'] = false;
                $is_exist = Follow::where('user_id', session('user_id'))->where('follow_id', $request->follower_id)->first();
                if($is_exist)
                {
                    $is_exist->delete();
                } else {
                    Follow::forceCreate(['user_id'=>session('user_id'), 'follow_id'=>$request->follower_id, 'created_at'=>date('Y-m-d H:i:s')]);
                    $datass['is_insert'] = true;
                }
            }
        }
        return response()->json($datass);
    }
    /**
     * @return [type]
     */
    public function getProfile()
    {
        return self::view("Agency::mypage.profile");
    }
    public function postProfile(Request $request)
    {
        $currentUser = DB::table('users')->where('id', session('user_id'))->first();
        $insertData  = [
            'displayname'   => $request->displayname,
            'representative'   => $request->representative,
            'performer'   => $request->performer,
            'section'   => $request->section,
            'company_name'   => $request->company_name,
            'tax_number'   => $request->input('tax_number', ''),
            'agency_type_id'   => $request->agency_type_id,
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
        $isSuccess = DB::table('users')->where('id', session('user_id'))->update($insertData);

        //update client_data
        $estable_date = ($request->estable_date_year?$request->estable_date_year:date('Y')).'-';
        $estable_date .= ($request->estable_date_month?$request->estable_date_month:date('m')).'-';
        $estable_date .= ($request->estable_date_day?$request->estable_date_day:date('d'));
        $client_data = array(
                'estable_date'             =>  date('Y-m-d', strtotime($estable_date) ),
                'capital'                  =>  (int)str_replace([',', '.'], '', $request->capital),
                'regular_number'           =>  (int)str_replace([',', '.'], '', $request->regular_number)
            );
        $exist_flag = DB::table('users_client_data')->where('user_id',session('user_id'))->first();
        $check = 0;
        if($exist_flag) {
            DB::table('users_client_data')->where('user_id', session('user_id'))->update($client_data);
        } else {
            $client_data['user_id'] = session('user_id');
            $check = DB::table('users_client_data')->insert($client_data);
        }


        return redirect()->back()->withSuccess('保存しました')->withInput();
        return redirect()->back()->withError('保存しませんでした')->withInput();
    }
    public function loadCityByProvince(Request $request)
    {
        if($request->province_id)
        {
            return City::select('id','city_name')->where('province_id', $request->province_id)->get()->toJson();
        }
        return [];
    }
    public function profileAjax(Request $request, $subType = 0) 
    {
        $datass['success'] = false;
        if($request->act == 'getAvailable')
        {
            $datass['cat']['category'] = DB::table('categories')->where('display', 1)->pluck('category_name', 'id')->toArray();
            $sub_category = DB::table('sub_category')->select('id', 'sub_name', 'detail_question', 'category_id')->where('display', 1)->get();
            $tmp = array();
            foreach ($sub_category as $key => $value) {
                if($subType == 1) $tmp[$value->category_id][$value->id] = $value->detail_question;
                else $tmp[$value->category_id][$value->id] = $value->sub_name;
            }
            $datass['cat']['sub_category'] = $tmp;

            $datass['province'] = DB::table('provinces')->where('is_ministry', 0)->orderBy('order_by', 'desc')->orderBy('id', 'asc')->pluck('province_name', 'id')->toArray();
            $cities = DB::table('cities')->select('id', 'city_name', 'province_id')->get();
            $tmp = array();
            foreach ($cities as $key => $value) {
                $tmp[$value->province_id][$value->id] = $value->city_name;
            }
            $datass['city'] = $tmp;

            $datass['user_sub_category'] = DB::table('user_category')->where('user_id', session('user_id'))->pluck('sub_category_id');
            $datass['user_category'] = DB::table('user_category')->where('user_id', session('user_id'))->distinct()->pluck('category_id');
            $user_address1 = DB::table('user_address')->select('province_id', 'city_id')->where('user_id', session('user_id'))->where('address_type', 1)->distinct()->get()->toArray();
            $datass['user_address1'] = array();
            if(count($user_address1))
            {
                $tmp = array();
                foreach($user_address1 as $r)
                {
                    $tmp[$r->province_id][] = $r->city_id;
                }
                $datass['user_address1'] = $tmp;
            }
        }
        //var_dump($datass);
        return response()->json($datass);
    }
    public function getAvailableTask(Request $request, $viewLoad = 'Agency::mypage.available_task')
    {
        $categories = DB::table('categories')->where('display',1)->get();
        $industry = DB::table('trades')->where('display',1)->orderBy('order', 'asc')->get();
        $tags = DB::table('tags')->select('tag', 'id')->distinct()->get();
        
        $user_trade = DB::table('user_business')->where('user_id', session('user_id'))->pluck('trade_id')->toArray();
        $user_tag = DB::table('user_pro_part')->where('user_id', session('user_id'))->pluck('tag_id')->toArray();
        return self::view($viewLoad, compact('industry', 'tags', 'categories', 'user_trade', 'user_tag'));
    }
    public function postAvailableTask(Request $request)
    {
        //dd($request->all());
        if($request->category && $request->subcat)
        {
            $listUpdate = DB::table('sub_category')->whereIn('id', $request->subcat)->get();
            $currentData = DB::table('user_category')->where('user_id', session('user_id'))->pluck('sub_category_id')->toArray();
            $insertData = $deleteData = array();
            foreach ($listUpdate as $key => $value) {
                if(in_array($value->id, $currentData)) continue;
                $insertData[] = array('user_id'=>session('user_id'), 'category_id'=>$value->category_id, 'sub_category_id'=>$value->id, 'updated_at'=>date('Y-m-d H:i:s'));
            }
            foreach($currentData as $value)
            {
                if(in_array($value, $request->subcat)) continue;
                $deleteData[] = $value;
            }
            if(count($insertData)) DB::table('user_category')->insert($insertData);
            if(count($deleteData)) DB::table('user_category')->where('user_id', session('user_id'))->whereIn('sub_category_id', $deleteData)->delete();

        }
        if($request->trades)
        {
            $listUpdate = DB::table('trades')->whereIn('id', $request->trades)->get();
            $currentData = DB::table('user_business')->where('user_id', session('user_id'))->pluck('trade_id')->toArray();
            $insertData = $deleteData = array();
            foreach ($listUpdate as $key => $value) {
                if(in_array($value->id, $currentData)) continue;
                $insertData[] = array('user_id'=>session('user_id'), 'trade_id'=>$value->id, 'updated_at'=>date('Y-m-d H:i:s'));
            }
            foreach($currentData as $value)
            {
                if(in_array($value, $request->trades)) continue;
                $deleteData[] = $value;
            }
            if(count($insertData)) DB::table('user_business')->insert($insertData);
            if(count($deleteData)) DB::table('user_business')->where('user_id', session('user_id'))->whereIn('trade_id', $deleteData)->delete();
        }
        if($request->province)
        {
            $city = $request->city;
            $insertIds = array();
            foreach($request->province as $kpr=>$pr) {
                if(isset($city[$kpr]))
                {
                    foreach($city[$kpr] as $kct=>$ct) {
                        $dCheck = ['user_id'=>session('user_id'), 'province_id'=>$pr, 'city_id'=>$ct, 'address_type'=>1];
                        $obj = UserAddress::updateOrCreate($dCheck);
                        $insertIds[] = $obj->id;
                    }
                } else {
                    $dCheck = ['user_id'=>session('user_id'), 'province_id'=>$pr, 'city_id'=>1, 'address_type'=>1];
                    $obj = UserAddress::updateOrCreate($dCheck);
                    $insertIds[] = $obj->id;
                }
            }
            UserAddress::whereNotIn('id', $insertIds)->delete();
            
        }
        if($request->tags)
        {
            foreach($request->tags as $tag) {
                $dCheck = ['user_id'=>session('user_id'), 'tag_id'=>$tag];
                UserTag::updateOrCreate($dCheck);
            }
            UserTag::whereNotIn('tag_id', $request->tags)->delete();
            
        }
        return redirect()->back()->withSuccess('データを変更しました')->withInput();
    }
    public function getAvailableSubsidy()
    {
        $policy_cat = Matching::where('from_id', session('user_id'))->with('policy.matching_user.user')->paginate(5, ['*'], 'page');
        Log::info($policy_cat);
        return self::view('Agency::mypage.available_subsidy', compact('policy_cat'));
    }
    public function getRating($viewLoad = 'Agency::mypage.rating')
    {
        $user_id = session('user_id');
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

        // $feedback = DB::table('feedback')
        //     ->leftJoin('hire', 'hire.id', '=', 'feedback.hire_id')
        //     ->leftJoin('policy','policy.id','=','hire.policy_id')
        //     ->where('feedback.to_id',$user_id)
        //     ->where('feedback.display',1)
        //     ->select('feedback.*','policy.image_id as image','policy.name','policy.name_serve','policy.support_content','policy.id as policy_id')
        //     ->orderBy('id', 'desc')
        //     ->paginate(5);
        $feedback = FeedBack::
                with('hire', 'hire.policy')
                ->has('hire')
                ->has('hire.from')
                ->has('hire.to')
                ->where('to_id', $user_id)
                ->where('display', 1)
                ->orderBy('id', 'desc')
                ->paginate(5);

        return self::view($viewLoad, compact('rating_info', 'feedback'));
    }
    public function ratingAjax(Request $request)
    {
        $datass['success'] = false;
        if($request->act == 'saveResult')
        {
            if($request->txtresult)
            {
                $datass['success'] = true;
                DB::table('users')->where('id', session('user_id'))->update(['total_result'=>$request->txtresult]);
            }
        }
        return response()->json($datass);
    }
    public function getCost()
    {
        return self::view('Agency::mypage.cost');
    }
    public function getEditCost()
    {
        return self::view('Agency::mypage.edit_cost');
    }
    public function EditCostAjax(Request $request)
    {
        $datass['success'] = false;
        if($request->act == 'getUserCost')
        {
            $user = User::where('id', session('user_id'))->first();
            $datass['set_cost'] = $user->set_cost;
        }
        if($request->act == 'deleteUserCost')
        {
            $user = User::where('id', session('user_id'))->first();
            $set_cost = $user->set_cost;
            if(isset($set_cost[$request->del_id])) unset($set_cost[$request->del_id]);
            $set_cost = array_values($set_cost);
            DB::table('users')->where('id', session('user_id'))->update(['set_cost'=>json_encode($set_cost)] );
            $user = User::where('id', session('user_id'))->first();
            $datass['set_cost'] = $user->set_cost;
        }
        if($request->act == 'updateCost')
        {
            $datass['success'] = true;
            $user = User::where('id', session('user_id'))->first();
            $user_cost = $user->set_cost;
            $set_cost = $user->set_cost;
            if(isset($set_cost[$request->current_cost])) {
                $set_cost[$request->current_cost]['document_price_flag'] = (bool)$request->document_price_flag;
                $set_cost[$request->current_cost]['document_business_price'] = ( ($request->document_price_flag==true)?(int)$request->document_business_price:0);
                $set_cost[$request->current_cost]['request_price_flag'] = (bool)$request->request_price_flag;
                $set_cost[$request->current_cost]['request_business_price'] = ( ($request->request_price_flag==true)?(int)$request->request_business_price:0);
                $set_cost[$request->current_cost]['deposit_money'] = (int)$request->deposit_money;
                $total_money = 0;
                foreach($request->content_type as $key=>$val)
                {
                    $val['$$hashKey'] = $user_cost[$request->current_cost]['content_type'][$key]['$$hashKey'];
                    $val['moneyname'] = (string)$val['moneyname'];
                    $val['moneyvalue'] = (int)$val['moneyvalue'];
                    $set_cost[$request->current_cost]['content_type'][$key] = $val;
                    $total_money += (int)$val['moneyvalue'];
                }
                $set_cost[$request->current_cost]['other_money'] = $total_money;
                DB::table('users')->where('id', session('user_id'))->update(['set_cost'=>json_encode($set_cost)]);
                
            }
        }
        return response()->json($datass);
    }
    public function getMemberInfo()
    {
        return self::view('Agency::mypage.member_info');
    }
    public function memberInfoAjax(Request $request)
    {
        
        return ['success'=>true];
        $datass['success'] = false;
        if($request->act == 'updateMail')
        {
            $rules = array(
                'new_email' => 'required|unique:users,e_mail,'.session('user_id')
            );
            $messages = array(
                'new_email.required'    =>  'メールが必要です',
                'new_email.unique'    =>  ' メールが既に存在します'
            );
            $validator = Validator::make($request->all(), $rules, $messages);
            if($validator->fails())
            {
                $errors = $validator->errors();
                $datass['mess'] = $errors->first('new_email');
            } else {
                $datass['success'] = true;
                $secret_code = md5(time() + rand(0, 9999) );
                $user = DB::table('users')->where('id', session('user_id'))->update(['secret_code'=>$secret_code, 'tmp_field'=>$request->new_email]);
                $url = URL::to('email_verify/' . $secret_code . '/' . urlencode($request->new_email));
                Mail::queue(new \App\Mail\ChangeMail( ['url'=>$url, 'user'=>$user] ));
                //Mail::to($request->new_email)->queue(new \App\Mail\ChangeMail($url));
            }
            
        }
        if($request->act == 'savePass')
        {
            $datass['mess'] = 'パスワードを変更しません';
            if($request->old_pass && $request->new_pass && $request->new_pass_confirm && strlen($request->new_pass)>=8 )
            {
                $user = DB::table('users')->where('id', session('user_id'))->where('password', md5($request->old_pass) )->first();
                if(!$user) $datass['mess'] = '現在のパスワードが一致しません';
                else {
                    DB::table('users')->where('id', session('user_id'))->update(['password'=>md5($request->new_pass)]);
                    $datass['success'] = true;
                    $datass['mess'] = 'パスワードを変更しました';
                    Mail::queue(new \App\Mail\ChangePass($user ));
                }
            }
        }
        return response()->json($datass);
    }
    public function verifyMailChange(Request $request, $code = false, $new_email = false)
    {
        $is_success = false;
        if($code && $new_email)
        {
            $user = DB::table('users')->where('tmp_field', $new_email)->where('secret_code', $code)->first();
            if($user)
            {
                $is = DB::table('users')->where('id', $user->id)->update(['tmp_field'=>'', 'secret_code'=>'', 'e_mail'=>$new_email]);
                if($is) $is_success = true;
            }
        }
        if(AuthSam::isLogin())
        {
            if(AuthSam::permission()) // Agency
            {
                $returnUrl = '/agency/mypage/memberinfo';
            } else {
                $returnUrl = '/client/mypage/memberinfo';
            }
            if($is_success) return redirect($returnUrl)->withSuccess('メールを変更しました');
            else return redirect($returnUrl)->withError('メールを変更しませんでした');
        }
        return redirect('/');
    }
    public function getMemberInfoMail()
    {
        return self::view('Agency::mypage.mail_notify');
    }
    public function postMemberInfoMail(Request $request)
    {
        $requestData = $request->all();
        $newArr = array(
                'jobs_requested' => 0, 
                'proposed_work' => 0, 
                'project_progress' => 0, 
                'receive_message' => 0, 
                'favourite_proposal' => 0, 
                'create_withdraw_proposal' => 0, 
                'consultation' => 0, 
                'proposal_usage' => 0, 
                'new_item_category' => 0
            );
        foreach($newArr as $k=>$val)
        {
            $newArr[$k] = (@$requestData[$k])?$requestData[$k]:0;
        }
        DB::table('users')->where('id', session('user_id'))->update($newArr);
        return redirect()->back()->withSuccess('メール通知設定情報を変更しました。')->withInput();
    }
    public function getMemberInfoBlock($viewLoad = 'Agency::mypage.info_block')
    {
        $blocked_list = BlockList::where('user_id', session('user_id'))->with('block')->has('block')->select('block_id')->get();
        return self::view($viewLoad, compact('blocked_list'));
    }
    public function memberInfoBlockAjax(Request $request)
    {
        $datass['success'] = false;
        if($request->act == 'searchUser')
        {
            $blocked = DB::table('block_list')->where('user_id', session('user_id'))->select('block_id')->pluck('block_id')->toArray();
            $user_list = DB::table('users')->where('id', '<>', session('user_id') )->whereNotIn('id', $blocked)->where('displayname', 'like', '%'.$request->username.'%')->limit(100)->get();
            $datass['user_list'] = $user_list;
            $datass['success'] = true;
        }
        
        return response()->json($datass);
    }
    public function postMemberInfoAddBlock(Request $request)
    {
        if($request->new_block_list)
        {
            $new_bl = array();
            foreach ($request->new_block_list as $key => $value) {
                $new_bl[] = array(
                    'user_id' => session('user_id'),
                    'block_id' => $value,
                    'created_at' => date('Y-m-d H:i:s')
                );
            }
            DB::table('block_list')->insert($new_bl);

        }
        return redirect()->back()->withSuccess('ユーザーをブロックしました。');
    }
    public function postMemberInfoRemoveBlock(Request $request)
    {
        if($request->new_block_list)
        {
            //dd($request->new_block_list);
            DB::table('block_list')->where('user_id', session('user_id'))->whereIn('block_id', $request->new_block_list)->delete();

        }
        return redirect()->back();
    }
    public function getMemberInfoRegister()
    {
        
        return self::view('Agency::mypage.register_member');
    }
    public function getCheckList($viewLoad = 'Agency::mypage.checklist')
    {
        $checkList = CheckListPolicyUser::where('user_id', session('user_id'))
                    ->orderBy('id', 'desc')
                    ->with('policy.policy_region.province')
                    ->with('policy.policy_region.city')
                    ->with('policy.policy_region_many')
                    ->with('policy.policy_region_many.province')
                    ->with('policy.policy_region_many.city')
                    ->with('policy.tags')
                    ->with('policy.matching_user.user')
                    ->with('policy.minitry')
                    ->with('policy.sub_minitry')
                    ->with('policy.checklist_policy_user')
                    ->with(['policy.matchingUser'=>function($qr) {
                            $qr->where('user_id', session('user_id'));
                        }])
                    ->has('policy.policy_region.province')
                    ->has('policy.matching_user.user')
                    ->groupBy('policy_id')
                    ->paginate(5);
        return self::view($viewLoad, compact('checkList'));
    }
    public function postMemberInfoRegister(Request $request)
    {
        $exist = DB::table('hire')->where(function($query) {
            $query->where('from_id', session('user_id'))->orWhere('to_id', session('user_id'));
        })->where('accept',1)->where('finish_flag',0)->first();
        if($exist) return redirect()->back()->withSuccess('現在、マッチングしている案件があるため、退会できません。案件のキャンセルをクライアントに伝え、終了報告を行ってください。')->withInput();
    }
    public function getJobRequests(Request $request)
    {
        $user_id = session('user_id');
        $suggestionCount = DB::table('hire')
            ->where('hire.accept',0)->where('hire.finish_flag',0)
            ->where('hire.submit_type',0)->where('hire.from_id', session('user_id'))
            ->where('hire.notify_from_id',0)->count();
        $requestCount = DB::table('hire')
            ->where('hire.accept',0)->where('hire.finish_flag',0)
            ->where('hire.submit_type',0)->where('hire.to_id', session('user_id'))
            ->where('hire.notify_to_id',0)->count();
        $yearList[] = 'すべて';
        for($i = (date('Y')-1); $i <= (date('Y')+1); $i++ )
            $yearList[$i] = $i.'年';
        $year = $request->input('filteryear', 0);
        $month = $request->input('filtermonth', 0);
        $contains_date = "";
        if ((int)$year > 0) {
            $contains_date.=$year;
        }
        $contains_date.="-";
        if ((int)$month>0) {
            if ($month<=9) {
                $contains_date.="0".$month;
            } else {
                $contains_date.=$month;
            }
        }
        $policy_list = DB::table('hire')
            ->where('hire.to_id', session('user_id'))
            ->where('hire.accept', 0)
            ->where('hire.finish_flag',0)
            ->where('hire.update_date', 'LIKE', '%'.$contains_date.'%')
            ->where('hire.submit_type',0)
            ->join('policy', 'policy.id', '=', 'hire.policy_id')
            ->select('policy.id as policy_id','policy.name as policy_name')
            ->distinct()->pluck('policy_name', 'policy_id')->toArray();
        $policy_list = [0=>'すべて'] + $policy_list;

        //table -list
        $sort_name = 'hire.update_date';
        $sort_type = 'desc';
        $display = ($request->filterdisplay)?$request->filterdisplay:10;

        $policy_id = $request->plc_id;
        if ((int)$policy_id == 0) {
            $result = DB::table('hire')
                ->where('hire.to_id', $user_id)
                ->where('hire.accept',0)
                ->where('hire.finish_flag',0)
                ->where('hire.update_date', 'LIKE', '%'.$contains_date.'%')
                ->where('hire.submit_type',0)
                ->join('policy', 'policy.id', '=', 'hire.policy_id')
                ->join('users', 'users.id', '=', 'hire.from_id')
                ->orderBy($sort_name,$sort_type)
                ->select('hire.id as hire_id','policy.id as policy_id',
                    'policy.name as policy_name', 'users.displayname','hire.accept','hire.update_date')->paginate($display);
        }
        else {
            $result = DB::table('hire')
                ->where('hire.to_id', $user_id)
                ->where('hire.accept',0)
                ->where('hire.finish_flag',0)
                ->where('hire.policy_id',$policy_id)
                ->where('hire.update_date', 'LIKE', '%'.$contains_date.'%')
                ->where('hire.submit_type',0)
                ->orderBy($sort_name,$sort_type)
                ->join('policy', 'policy.id', '=', 'hire.policy_id')
                ->join('users', 'users.id', '=', 'hire.from_id')
                ->select('hire.id as hire_id','policy.id as policy_id',
                    'policy.name as policy_name', 'users.displayname','hire.accept','hire.update_date')->paginate($display);
        }
        $messageList = $result;
        $hire_ids = [];
        $msgNote = [];
        if(count($messageList)) {
            foreach($messageList as $k=>$v) {
                $hire_id = $v->hire_id;
                $hire_ids[] = (int)$hire_id;
                $temp = DB::table('message')->where('flag',-1)->where('from_id', $user_id)->where('hire_id',$hire_id);
                $count = $temp->count();
                $msgNote[$k]['remain_message'] = 10 - $count;
                $msgNote[$k]['unread_message'] = DB::table('message')->where('flag',-1)
                    ->where('to_id', $user_id)->where('hire_id',$hire_id)->where('accept',0)->count();
            }
        }

        DB::table('hire')->whereIn('id', $hire_ids)->update(['hire.notify_from_id'=>1]);

        return self::view('Agency::mypage.jobs_requested', compact('suggestionCount', 'requestCount', 'yearList', 'policy_list', 'messageList', 'msgNote') );
    }
    public function getJobRQDetail(Request $request, $hire_id = false)
    {
        return self::getJobDetail($request, $hire_id, 1);
    }
    public function getJobDetail(Request $request, $hire_id = false, $jobType = 0)
    {
        $user_id = session('user_id');
        $suggestionCount = DB::table('hire')
            ->where('hire.accept',0)->where('hire.finish_flag',0)
            ->where('hire.submit_type',0)->where('hire.from_id', session('user_id'))
            ->where('hire.notify_from_id',0)->count();
        $requestCount = DB::table('hire')
            ->where('hire.accept',0)->where('hire.finish_flag',0)
            ->where('hire.submit_type',0)->where('hire.to_id', session('user_id'))
            ->where('hire.notify_to_id',0)->count();
        $yearList[] = 'すべて';
        for($i = (date('Y')-1); $i <= (date('Y')+1); $i++ )
            $yearList[$i] = $i.'年';
        $year = $request->input('filteryear', 0);
        $month = $request->input('filtermonth', 0);
        $contains_date = "";
        if ((int)$year > 0) {
            $contains_date.=$year;
        }
        $contains_date.="-";
        if ((int)$month>0) {
            if ($month<=9) {
                $contains_date.="0".$month;
            } else {
                $contains_date.=$month;
            }
        }
        $policy_list = DB::table('hire')
            ->where('hire.from_id', session('user_id'))
            ->where('hire.accept','<>', 1)
            ->where('hire.finish_flag',0)
            ->where('hire.update_date', 'LIKE', '%'.$contains_date.'%')
            ->join('policy', 'policy.id', '=', 'hire.policy_id')
            ->select('policy.id as policy_id','policy.name as policy_name')
            ->distinct()->pluck('policy_name', 'policy_id')->toArray();
        $policy_list = [0=>'すべて'] + $policy_list;

        //table -list
        $sort_name = 'hire.update_date';
        $sort_type = 'desc';
        $display = ($request->filterdisplay)?$request->filterdisplay:10;

        $policy_ids = $request->plc_id;
        if ((int)$policy_ids == 0) {
            if($jobType == 1) {
                $result = DB::table('hire')
                    ->where('hire.to_id', session('user_id'))
                    ->where('hire.id', $hire_id)
                    ->where('hire.accept', 0)
                    ->where('hire.finish_flag',0)
                    ->where('hire.update_date', 'LIKE', '%'.$contains_date.'%')
                    ->where('hire.submit_type',0)
                    ->join('policy', 'policy.id', '=', 'hire.policy_id')
                    ->join('users', 'users.id', '=', 'hire.from_id')
                    ->select('hire.id as hire_id','policy.id as policy_id',
                    'policy.name as policy_name', 'users.displayname','hire.accept','hire.update_date','hire.from_id AS to_id')
                    ->paginate($display);
            } else {
                $result = DB::table('hire')
                ->where('hire.from_id', $user_id)
                ->where('hire.accept','<>',1)
                ->where('hire.finish_flag',0)
                ->where('hire.update_date', 'LIKE', '%'.$contains_date.'%')
                ->where('hire.id', $hire_id)
                ->orderBy($sort_name,$sort_type)
                ->join('policy', 'policy.id', '=', 'hire.policy_id')
                ->join('users', 'users.id', '=', 'hire.to_id')
                ->select('hire.id as hire_id','policy.id as policy_id',
                    'policy.name as policy_name', 'users.displayname','hire.accept','hire.update_date','hire.to_id')->paginate($display);
            }
            

        }
        else {
            if($jobType == 1)
            {
                $result = DB::table('hire')
                    ->where('hire.to_id', session('user_id'))
                    ->where('hire.id', $hire_id)
                    ->where('hire.accept', 0)
                    ->where('hire.finish_flag',0)
                    ->where('hire.update_date', 'LIKE', '%'.$contains_date.'%')
                    ->where('hire.submit_type',0)
                    ->join('policy', 'policy.id', '=', 'hire.policy_id')
                    ->join('users', 'users.id', '=', 'hire.from_id')
                    ->select('hire.id as hire_id','policy.id as policy_id',
                    'policy.name as policy_name', 'users.displayname','hire.accept','hire.update_date','hire.from_id AS to_id')
                    ->paginate($display);
                } else {
                    $result = DB::table('hire')
                ->where('hire.from_id', $user_id)
                ->where('hire.accept','<>',1)
                ->where('hire.finish_flag',0)
                ->where('hire.update_date', 'LIKE', '%'.$contains_date.'%')
                ->where('hire.id', $hire_id)
                ->orderBy($sort_name,$sort_type)
                ->join('policy', 'policy.id', '=', 'hire.policy_id')
                ->join('users', 'users.id', '=', 'hire.to_id')
                ->select('hire.id as hire_id','policy.id as policy_id',
                    'policy.name as policy_name', 'users.displayname','hire.accept','hire.update_date','hire.to_id')->paginate($display);
                }
            
        }
        $messageList = $result;
        $hire_ids = [];
        $msgNote = [];
        foreach($messageList as $k=>$v) {
            $hire_id = $v->hire_id;
            $hire_ids[] = (int)$hire_id;
            $temp = DB::table('message')->where('flag',-1)->where('from_id', $user_id)->where('hire_id',$hire_id);
            $count = $temp->count();
            $msgNote[$k]['remain_message'] = 10- $count;
            $msgNote[$k]['unread_message'] = DB::table('message')->where('flag',-1)
                ->where('to_id', $user_id)
                ->where('hire_id',$hire_id)
                ->where('accept',0)->count();
        }

        $result = DB::table('policy')->where('id', $messageList->first()->policy_id)->first();
        return self::view("Agency::mypage.detail", compact('yearList', 'result', 'messageList', 'msgNote', 'policy_list', 'suggestionCount', 'requestCount', 'jobType'));
    }
    public function getCompanyDetail(Request $request, $hire_id = false)
    {
        $user_id = session('user_id');
        $suggestionCount = DB::table('hire')
            ->where('hire.accept',0)->where('hire.finish_flag',0)
            ->where('hire.submit_type',0)->where('hire.from_id', session('user_id'))
            ->where('hire.notify_from_id',0)->count();
        $requestCount = DB::table('hire')
            ->where('hire.accept',0)->where('hire.finish_flag',0)
            ->where('hire.submit_type',0)->where('hire.to_id', session('user_id'))
            ->where('hire.notify_to_id',0)->count();
        $yearList[] = 'すべて';
        for($i = (date('Y')-1); $i <= (date('Y')+1); $i++ )
            $yearList[$i] = $i.'年';
        $year = $request->input('filteryear', 0);
        $month = $request->input('filtermonth', 0);
        $contains_date = "";
        if ((int)$year > 0) {
            $contains_date.=$year;
        }
        $contains_date.="-";
        if ((int)$month>0) {
            if ($month<=9) {
                $contains_date.="0".$month;
            } else {
                $contains_date.=$month;
            }
        }
        $policy_list = DB::table('hire')
            ->where('hire.from_id', session('user_id'))
            ->where('hire.accept','<>', 1)
            ->where('hire.finish_flag',0)
            ->where('hire.update_date', 'LIKE', '%'.$contains_date.'%')
            ->join('policy', 'policy.id', '=', 'hire.policy_id')
            ->select('policy.id as policy_id','policy.name as policy_name')
            ->distinct()->pluck('policy_name', 'policy_id')->toArray();
        $policy_list = [0=>'すべて'] + $policy_list;

        //table -list
        $sort_name = 'hire.update_date';
        $sort_type = 'desc';
        $display = ($request->filterdisplay)?$request->filterdisplay:10;

        $policy_ids = $request->plc_id;
        if ((int)$policy_ids == 0) {
            $result = DB::table('hire')
                ->where('hire.from_id', $user_id)
                ->where('hire.accept','<>',1)
                ->where('hire.finish_flag',0)
                ->where('hire.update_date', 'LIKE', '%'.$contains_date.'%')
                ->where('hire.id', $hire_id)
                ->orderBy($sort_name,$sort_type)
                ->join('policy', 'policy.id', '=', 'hire.policy_id')
                ->join('users', 'users.id', '=', 'hire.to_id')
                ->select('hire.id as hire_id','policy.id as policy_id',
                    'policy.name as policy_name', 'users.displayname','hire.accept','hire.update_date','hire.to_id')->paginate($display);
        }
        else {
            $result = DB::table('hire')
                ->where('hire.from_id', $user_id)
                ->where('hire.accept','<>',1)
                ->where('hire.finish_flag',0)
                ->where('hire.update_date', 'LIKE', '%'.$contains_date.'%')
                ->where('hire.id', $hire_id)
                ->orderBy($sort_name,$sort_type)
                ->join('policy', 'policy.id', '=', 'hire.policy_id')
                ->join('users', 'users.id', '=', 'hire.to_id')
                ->select('hire.id as hire_id','policy.id as policy_id',
                    'policy.name as policy_name', 'users.displayname','hire.accept','hire.update_date','hire.to_id')->paginate($display);
        }
        $messageList = $result;
        $hire_ids = [];
        $msgNote = [];
        foreach($messageList as $k=>$v) {
            $hire_id = $v->hire_id;
            $hire_ids[] = (int)$hire_id;
            $temp = DB::table('message')->where('flag',-1)->where('from_id', $user_id)->where('hire_id',$hire_id);
            $count = $temp->count();
            $msgNote[$k]['remain_message'] = 10- $count;
            $msgNote[$k]['unread_message'] = DB::table('message')->where('flag',-1)
                ->where('to_id', $user_id)
                ->where('hire_id',$hire_id)
                ->where('accept',0)->count();
        }

        $result = DB::table('policy')->where('id', $messageList->first()->policy_id)->first();
        return self::view("Agency::mypage.company_detail", compact('yearList', 'result', 'messageList', 'msgNote', 'policy_list', 'suggestionCount', 'requestCount'));
    }
    public function getJobRQContact(Request $request, $hire_id = false)
    {
        return $this->getJobContact($request, $hire_id, 1);
    }
    public function getJobContact(Request $request, $hire_id = false, $jobType = 0)
    {
        $user_id = session('user_id');
        $suggestionCount = DB::table('hire')
            ->where('hire.accept',0)->where('hire.finish_flag',0)
            ->where('hire.submit_type',0)->where('hire.from_id', session('user_id'))
            ->where('hire.notify_from_id',0)->count();
        $requestCount = DB::table('hire')
            ->where('hire.accept',0)->where('hire.finish_flag',0)
            ->where('hire.submit_type',0)->where('hire.to_id', session('user_id'))
            ->where('hire.notify_to_id',0)->count();
        $yearList[] = 'すべて';
        for($i = (date('Y')-1); $i <= (date('Y')+1); $i++ )
            $yearList[$i] = $i.'年';
        $year = $request->input('filteryear', 0);
        $month = $request->input('filtermonth', 0);
        $contains_date = "";
        if ((int)$year > 0) {
            $contains_date.=$year;
        }
        $contains_date.="-";
        if ((int)$month>0) {
            if ($month<=9) {
                $contains_date.="0".$month;
            } else {
                $contains_date.=$month;
            }
        }

        //table -list
        $sort_name = 'hire.update_date';
        $sort_type = 'desc';
        $display = ($request->filterdisplay)?$request->filterdisplay:10;

        if($jobType == 1)
        {
            $result = DB::table('hire')
                    ->where('hire.to_id', session('user_id'))
                    ->where('hire.id', $hire_id)
                    ->where('hire.accept', 0)
                    ->where('hire.finish_flag',0)
                    ->where('hire.update_date', 'LIKE', '%'.$contains_date.'%')
                    ->where('hire.submit_type',0)
                    ->join('policy', 'policy.id', '=', 'hire.policy_id')
                    ->join('users', 'users.id', '=', 'hire.from_id')
                    ->select('hire.id as hire_id','policy.id as policy_id',
                'policy.name as policy_name', 'users.displayname', 'users.image','users.evaluate','users.result', 'hire.from_id', 'hire.accept','hire.update_date','hire.to_id AS to_id')
                    ->paginate($display);
        } else {
            $result = DB::table('hire')
            ->where('hire.from_id', $user_id)
            ->where('hire.accept','<>',1)
            ->where('hire.finish_flag',0)
            ->where('hire.update_date', 'LIKE', '%'.$contains_date.'%')
            ->where('hire.id', $hire_id)
            ->orderBy($sort_name,$sort_type)
            ->join('policy', 'policy.id', '=', 'hire.policy_id')
            ->join('users', 'users.id', '=', 'hire.to_id')
            ->select('hire.id as hire_id','policy.id as policy_id',
                'policy.name as policy_name', 'users.displayname', 'users.image','users.evaluate','users.result', 'hire.from_id', 'hire.accept','hire.update_date','hire.to_id')->paginate($display);
        }

        
        $hireList = $result;
        $hire_ids = [];
        $msgNote = [];
        foreach($hireList as $k=>$v) {
            $hire_id = $v->hire_id;
            $hire_ids[] = (int)$hire_id;
            $temp = DB::table('message')->where('flag',-1)->where('from_id', $user_id)->where('hire_id',$hire_id);
            $count = $temp->count();
            $msgNote[$k]['remain_message'] = 10- $count;
            $msgNote[$k]['unread_message'] = DB::table('message')->where('flag',-1)
                ->where('to_id', $user_id)
                ->where('hire_id',$hire_id)
                ->where('accept',0)->count();
        }
        $messageList = DB::table('message')
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
        $budgetPrice = DB::table('hire')->where('id',$hire_id)->first();
        $savedBudget = json_decode(DB::table('users')->select('set_cost')->where('id', $user_id)->first()->set_cost, true);
        $result = DB::table('policy')->where('id', $hireList->first()->policy_id)->first();
        return self::view("Agency::mypage.job_contact", compact('yearList', 'result', 'messageList', 'hire_id', 'hireList', 'msgNote', 'policy_list', 'suggestionCount', 'requestCount', 'savedBudget', 'budgetPrice', 'jobType'));
    }
    public function postHireSubmit(Request $request)
    {
        $user_id = session('user_id');
        $policy_ids = $request->policy_ids;
        $to_ids = $request->to_ids;
        $message = $request->message;
        $accept = $request->accept;
        $document_business_price = $request->document_business_price;
        $document_business_type = (bool)$request->document_business_type;
        $request_business_price = $request->request_business_price;
        $request_business_type = (bool)$request->request_business_type;
        $deposit_setting = 2;
        $deposit_money = $request->deposit_money;
        $other_money = $request->other_money;
        $other_money_sub = json_encode($request->other_money_sub, JSON_UNESCAPED_UNICODE);
        $content_type = json_encode([],JSON_UNESCAPED_UNICODE);
        $cost_client = 0;
        $cost_agency = 0;
        $cur_date = date("Y-m-d");
        $flag = 0;
        if($flag){
            $user_type = 0;  // client = user table's manage_flag
        } else {
            $user_type = 1;  // samurai  = user table's manage_flag
        }

        $idsArray = [];
        for ($k = 0; $k< count($to_ids); $k++) {
            for ($kk = 0; $kk< count($policy_ids); $kk++) {
                $to_id =  $to_ids[$k];
                $policy_id = $policy_ids[$kk];
                $exist_flag =DB::table('hire')->where('from_id', $user_id)->where('to_id',$to_id)->where('policy_id', $policy_id)->where('finish_flag',0)
                    ->orWhere(function ($query) use ($user_id, $policy_id , $to_id)
                    {
                        $query->where('to_id', $user_id)->where('from_id',$to_id)->where('policy_id', $policy_id)->where('finish_flag',0);
                    })->first();
                if (!$exist_flag) {
                    if ($accept == 2) {
                        $cost_client = 0;
                        $cost_agency = 0;
                        $hire_id = DB::table('hire')->insertGetId([
                            'from_id'                   =>  $user_id, 
                            'to_id'                     =>  $to_ids[$k], 
                            'policy_id'                 =>  $policy_ids[$kk], 
                            'document_business_price'   =>  $document_business_price, 
                            'document_business_type'    =>  $document_business_type, 
                            'request_business_price'    =>  $request_business_price, 
                            'request_business_type'     =>  $request_business_type, 
                            'deposit_setting'           =>  $deposit_setting, 
                            'deposit_money'             =>  $deposit_money, 
                            'other_money'               =>  $other_money, 
                            'other_money_sub'           =>  $other_money_sub, 
                            'content_type'              =>  $content_type, 
                            'accept'                    =>  $accept, 
                            'cost_agency'               =>  $cost_agency, 
                            'cost_client'               =>  $cost_client, 
                            'update_date'               =>  $cur_date, 
                        ]);

                        $message_id = DB::table('message')->insertGetId([
                            'from_id'       =>  $user_id,
                            'to_id'       =>  $to_id,
                            'policy_id'       =>  $policy_id,
                            'hire_id'       =>  $hire_id,
                            'message'       =>  $message,
                            'update_date'       =>  $cur_date,
                        ]);

                        $idsArray[]= $message_id;

                        $msgFlag = DB::table('message_allow')->where('user_id', $to_ids[$k])->where('to_id',$user_id)->first();

                        if (!$msgFlag) {
                            DB::table('message_allow')->insert([
                                'user_id'       => $to_ids[$k],
                                'to_id'       => $user_id,
                                'allow'       => 1,
                            ]);
                        }
                
                    }

                    if (($flag == 0) && ($accept == 0)) {   // from samurai

                        $cost_client = 0;
                        $hire_id = DB::table('hire')->insertGetId([
                            'from_id'                   =>  $user_id, 
                            'to_id'                     =>  $to_ids[$k], 
                            'policy_id'                 =>  $policy_ids[$kk], 
                            'document_business_price'   =>  $document_business_price, 
                            'document_business_type'    =>  $document_business_type, 
                            'request_business_price'    =>  $request_business_price, 
                            'request_business_type'     =>  $request_business_type, 
                            'deposit_setting'           =>  $deposit_setting, 
                            'deposit_money'             =>  $deposit_money, 
                            'other_money'               =>  $other_money, 
                            'other_money_sub'           =>  $other_money_sub, 
                            'content_type'              =>  $content_type, 
                            'accept'                    =>  $accept, 
                            'cost_agency'               =>  $cost_agency, 
                            'cost_client'               =>  $cost_client, 
                            'update_date'               =>  $cur_date, 
                        ]); 

                    } else if (($flag == 1) && ($accept == 0)) {   // from client
                        $cost_client = 0;
                        $hire_id = DB::table('hire')->insertGetId([
                            'from_id'                   =>  $user_id, 
                            'to_id'                     =>  $to_ids[$k], 
                            'policy_id'                 =>  $policy_ids[$kk], 
                            'document_business_price1'  =>  $document_business_price, 
                            'document_business_type1'   =>  $document_business_type, 
                            'request_business_price1'   =>  $request_business_price, 
                            'request_business_type1'    =>  $request_business_type, 
                            'deposit_setting1'          =>  $deposit_setting, 
                            'deposit_money1'            =>  $deposit_money, 
                            'other_money1'              =>  $other_money, 
                            'other_money_sub1'          =>  $other_money_sub, 
                            'content_type1'             =>  $content_type, 
                            'accept'                    =>  $accept, 
                            'cost_agency'               =>  $cost_agency, 
                            'cost_client'               =>  $cost_client, 
                            'update_date'               =>  $cur_date, 
                        ]);
                    }

                    if($accept != 2){
                        DB::table('hire_cost_history')->insert([
                            'hire_id'                   =>  $hire_id, 
                            'user_id'                   =>  $user_id,
                            'policy_id'                 =>  $policy_ids[$kk], 
                            'document_business_price'   =>  $document_business_price, 
                            'document_business_type'    =>  $document_business_type, 
                            'request_business_price'    =>  $request_business_price, 
                            'request_business_type'     =>  $request_business_type, 
                            'deposit_setting'           =>  $deposit_setting, 
                            'deposit_money'             =>  $deposit_money, 
                            'other_money'               =>  $other_money, 
                            'other_money_sub'           =>  $other_money_sub, 
                            'content_type'              =>  $content_type, 
                            'user_type'                 =>  $user_type,
                        ]);
                    }

                } else {
                    if ($accept == 0) {  //update hire table with cost.
                        if ($flag == 0) {
                            DB::table('hire')->where('id',$exist_flag->id)
                                ->update(['document_business_price' =>  $document_business_price,
                                    'document_business_type'        =>  $document_business_type,
                                    'request_business_price'        =>  $request_business_price,
                                    'request_business_type'         =>  $request_business_type,
                                    'deposit_money'                 =>  $deposit_money,
                                    'other_money'                   =>  $other_money,
                                    'other_money_sub'               =>  $other_money_sub,
                                    'content_type'                  =>  $content_type,
                                    'cost_agency'                   =>  $cost_agency,
                                    'accept'                        =>  $accept,
                                    'deposit_setting'               =>  $deposit_setting]);
                        }
                        else {
                            DB::table('hire')->where('id',$exist_flag->id)
                                ->update(['document_business_price1'    =>  $document_business_price,
                                    'document_business_type1'           =>  $document_business_type,
                                    'request_business_price1'           =>  $request_business_price,
                                    'request_business_type1'            =>  $request_business_type,
                                    'deposit_money1'                    =>  $deposit_money,
                                    'other_money1'                      =>  $other_money,
                                    'other_money_sub1'                  =>  $other_money_sub,
                                    'content_type1'                     =>  $content_type,
                                    'accept'                            =>  $accept,
                                    'cost_client'                       =>  $cost_client,
                                    'deposit_setting'                   =>  $deposit_setting]);
                        }

                        DB::table('hire_cost_history')->insert([
                            'hire_id'                   =>  $exist_flag->id, 
                            'user_id'                   =>  $user_id,
                            'policy_id'                 =>  $policy_ids[$kk], 
                            'document_business_price'   =>  $document_business_price, 
                            'document_business_type'    =>  $document_business_type, 
                            'request_business_price'    =>  $request_business_price, 
                            'request_business_type'     =>  $request_business_type, 
                            'deposit_setting'           =>  $deposit_setting, 
                            'deposit_money'             =>  $deposit_money, 
                            'other_money'               =>  $other_money, 
                            'other_money_sub'           =>  $other_money_sub, 
                            'content_type'              =>  $content_type, 
                            'user_type'                 =>  $user_type,
                        ]);

                    }  else {
                        $output_message_id = DB::table('message')->insertGetId([
                            'from_id'       =>  $user_id,
                            'to_id'         =>  $to_id,
                            'policy_id'     =>  $policy_id,
                            'hire_id'       =>  $exist_flag->id,
                            'message'       =>  $message,
                            'update_date'   =>  $cur_date,
                        ]);

                        $idsArray[]= $output_message_id;

                        $msgFlag = DB::table('message_allow')->where('user_id', $to_ids[$k])->where('to_id',$user_id)->first();

                        if (!$msgFlag) {
                            DB::table('message_allow')->insert([
                                'user_id'   =>  $to_ids[$k],
                                'to_id'   =>  $user_id,
                                'allow'   =>  1,
                            ]);
                        }
                    }
                    $hire_id = $exist_flag->id;
                }
            }
        }
        return array('result'=>'success', 'ids'=>json_encode($idsArray),'hire_id'=>$hire_id);
    }
    public function getFinishedWork(Request $request)
    {
        
        $display = ($request->filterdisplay)?$request->filterdisplay:10;
        $user_id = session('user_id');
        $completedList = DB::table('hire')
            ->where('hire.from_id', $user_id)
            ->where('hire.finish_flag', 1)
            ->orWhere(function ($query) use ($user_id)
            {
                $query->where('hire.to_id', $user_id)
                    ->where('hire.finish_flag', 1);
            })
            ->join('users',function($join) use($user_id)
            {
                $join->on('users.id','=','hire.from_id')
                    ->where('hire.to_id',$user_id);
                $join->orOn('users.id','=','hire.to_id')
                    ->where('hire.from_id',$user_id);
            })
            ->join('policy','policy.id','=','hire.policy_id')
            ->orderBy('hire.matching_date', 'desc')
            ->select('hire.id as hireid', 'hire.matching_date','hire.finish_date', 'users.displayname as user_name', 'policy.name as policy_name')->paginate($display);
        return self::view('Agency::mypage.finished_work', compact('completedList'));
    }
    public function ajaxFinishedWork(Request $request)
    {
        DB::table('hire')->where('from_id', session('user_id'))->where('id', $request->hireid)->update(['finish_flag'=>0]);
        return response()->json(['success'=>true]);
    }
    public function getMatchingCase(Request $request)
    {
        $user_id = session('user_id');
        $yearList[] = 'すべて';
        for($i = (date('Y')-1); $i <= (date('Y')+1); $i++ )
            $yearList[$i] = $i.'年';
        $sort_name = 'hire.update_date';
        $sort_type = 'desc';
        $display = ($request->filterdisplay)?$request->filterdisplay:10;
        $year = $request->input('filteryear', 0);
        $month = $request->input('filtermonth', 0);
        $contains_date = "";
        if ((int)$year > 0) {
            $contains_date.=$year;
        }
        $contains_date.="-";
        if ((int)$month>0) {
            if ($month<=9) {
                $contains_date.="0".$month;
            } else {
                $contains_date.=$month;
            }
        }

        $matchingList = DB::table('hire')
            ->where('hire.from_id', $user_id)
            ->where('hire.finish_flag', 0)
            ->where('hire.accept',1)
            ->where('hire.update_date', 'LIKE', '%'.$contains_date.'%')
            ->orWhere( function ($query) use ($user_id)
            {
                $query->where('hire.to_id', $user_id)
                    ->where('finish_flag', 0)
                    ->where('hire.accept',1);
            })
            ->join('users',function($join) use($user_id)
            {
                $join->on('users.id','=','hire.from_id')
                    ->where('hire.to_id',$user_id);
                $join->orOn('users.id','=','hire.to_id')
                    ->where('hire.from_id',$user_id);
            })
            ->join('policy','policy.id','=','hire.policy_id')
            ->select('hire.id as hireid','hire.matching_date', 'hire.finish_date', 'users.displayname as user_name','policy.name as policy_name', 'hire.document_business_price', 'hire.request_business_price'
                ,'hire.policy_id', 'hire.submit_type' ,'hire.document_business_price1','hire.request_business_price1','hire.matched_by')
            ->orderBy($sort_name,$sort_type)
            ->paginate($display);
        $matchingWork = self::getMatchingWork($matchingList, $user_id);
         
        return self::view('Agency::mypage.matching_case.matching_case', compact('yearList', 'matchingList', 'matchingWork'));
    }
    public function getTaskSetting($id = false)
    {
        if(!$id) return redirect()->route('agency.jobs.matchingcase');
        $user_id = session('user_id');
        $hire = self::getHireMatchingCase($id);
        $work_set = DB::table('work_set')
            ->where('hire_id',$id)
            ->paginate(10);
        return self::view('Agency::mypage.matching_case.task_setting', compact('hire', 'matchingWork', 'work_set'));
    }
    public function getTaskEdit($id = false, $work_set_id = false)
    {
        if(!$id) return redirect()->route('agency.jobs.matchingcase');
        if(!$work_set_id) return redirect()->route('agency.jobs.matching.setting_task', [$id] );

        $user_id = session('user_id');
        $hire = self::getHireMatchingCase($id);
        $work_set = DB::table('work_set')
            ->where('hire_id',$id)
            ->paginate(10);
        $cwork = DB::table('work_set')->where('hire_id', $id)->where('user_id', $user_id)->where('id', $work_set_id)->first();
        return self::view('Agency::mypage.matching_case.task_edit', compact('hire', 'matchingWork', 'work_set', 'cwork'));

    }
    public function postDeleteTask(Request $request)
    {
        if($request->act == 'deleteTask')
        {
            if($request->work_set_id)
            {
                DB::table('work_set')->where('user_id', session('user_id'))->where('id', $request->work_set_id)->delete();
                $data['success'] = true;
            }
        }
        
        return response()->json($data);
    }
    public function ajaxtableTaskSetting(Request $request)
    {
        $data = $request->all();
        $params = array();
        parse_str($request->formEl, $data['form']);
        $insertData = array(
            'user_id'   =>  session('user_id'),
            'hire_id'   =>  $request->hireId
        );
        unset($data['form']['_token']);
        if(@$data['form']['update_date'] == '') {
            $insertData['schedule'] = date('Y-m-d');
            $schedule = date('Y-m-d');
        } else {
            if(stristr($data['form']['update_date'], '年'))
            {
                $data['form']['update_date'] = str_replace(['年','月','日'], ['-', '-', ''], $data['form']['update_date']);
            }
            if(preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $data['form']['update_date']))
            {
                $schedule = $data['form']['update_date'];
                $insertData['schedule'] = $schedule;
            } else {
                $dispatchDate = $data['form']['update_date'];
                $dispatchDate = substr($dispatchDate, 0, strpos($dispatchDate, '('));
                $schedule = date('Y-m-d', strtotime($dispatchDate));  
                $insertData['schedule'] = $schedule;
            }
            
        }
        if(@$data['form']['no_file']) {
            $insertData['file_name'] = '';
            $insertData['file_exist'] = 0;
        } else {
            $insertData['file_name'] = $data['form']['fileName'];
            $insertData['file_exist'] = 1;
        }
        if(@$data['form']['term_flag']) {
            $insertData['term_content'] = $data['form']['term_content'];
            $insertData['term_flag'] = 1;
        } else {
            $insertData['term_content'] = '';
            $insertData['term_flag'] = 0;
        }
        $insertData['display_setting'] = @$data['form']['display_setting'];
        if(count(@$data['form']['work_set_task'])) 
        {
            foreach(@$data['form']['work_set_task'] as $k=>$v)
            {
                $insertData['work_content'][$k] = (int)$v;
            }
            $insertData['work_content'] = json_encode($insertData['work_content']);
        } else {
            $insertData['work_content'] = json_encode([]);
        }
        
        if(@$data['form']['is_checked']) {
            $insertData['work_content_other_value'] = 1;
            $insertData['work_content_other'] = @$data['form']['other_cb'];
        } else {
            $insertData['work_content_other_value'] = 0;
            $insertData['work_content_other'] = '';
        }
        $insertData['performer1'] = $insertData['performer2'] = $insertData['performer3'] = 0;
        $insertData['performer'.@$data['form']['performer']] = 1;

        $insertData['notify_day1'] = $insertData['notify_day2'] = $insertData['notify_day3'] = $insertData['notify_day4'] = 0;
        foreach($data['form']['notify_day'] as $val)
        {
            $insertData['notify_day' . $val ] = 1;
        }
        if(@$data['form']['work_set_id'] > 0)
        {
            //update
            $work_set_id = $data['form']['work_set_id'];
            $hireid = $insertData['hire_id'];
            if(!$data['form']['update_date']) unset($insertData['schedule']);
            if(isset($data['form']['no_file'])) unset($insertData['file_name'], $insertData['file_exist']);
            unset($insertData['hire_id'], $insertData['user_id'] );
            //dd($insertData);
            $is = DB::table('work_set')->where('user_id', session('user_id'))->where('hire_id', $hireid)->where('id', $work_set_id)->update($insertData);
            $wid = $work_set_id;
        } else {
            //insert
            $is = DB::table('work_set')->insertGetId($insertData);
            $wid = $is;
        }
        Event::fire(new WorksetClientEvent($wid));
        if($request->hasFile('taskImage'))
        {
            self::uploadWorkTaskFile($request, $wid);
            
        }
        $datass['success'] = false;
        if($is) {
            $datass['success'] = true;

            $hire_id = $request->hireId;
            $work_set = DB::table('work_set')->where('hire_id', $hire_id)->where('id', $wid)->first();
            $user_id = session('user_id');
            $data = array('hire_id'=>$hire_id,'type'=>1,'work_set_id'=>$request->work_set_id,'schedule'=>$work_set->schedule,'user_id'=>$user_id);
            Mail::queue(new \App\Mail\WorkSetMail($data));
        }
        $request->session()->flash('success', 1);
        return response()->json($datass);

    }
    public function registerMemberAjax(Request $request)
    {
        $user_id = session('user_id');
        $flag = false;
        $exist1 = DB::table('hire')->where('from_id', $user_id)->where('accept', 1)->where('finish_flag',0)->first();
        $exist2 = DB::table('hire')->where('to_id', $user_id)->where('accept', 1)->where('finish_flag',0)->first();
        if ($exist1)
            $flag = true;
        if ($exist2)
            $flag = true;
        if(!$flag)
        {
            //exit euro
            DB::table('users')->where('id', $user_id)->update(['payroll'=>0,'permission'=>0]);
            Mail::queue(new \App\Mail\SetPayRoll());
        }
        return response()->json(['success'=>true, 'flag'=>$flag]);
    }
    private function uploadWorkTaskFile(Request $request, $output_work_set_id)
    {
        $uploadedFile = $request->file('taskImage');
        $staticfinish = date('Y_m_d');
        $path = 'assets/work_set_attach/' . $staticfinish;
        $fileName = md5(session('user_id').$output_work_set_id) . '.' . $uploadedFile->getClientOriginalExtension();
        $fileExt = $uploadedFile->getClientOriginalExtension();
        $uploadedFileName = UploadFile::upload($path, $uploadedFile, $fileName);
        $destinationPath_ = 'assetsAND&work_set_attachAND&'.$staticfinish;
        $destinationPath_.= "AND&".$fileName;
        DB::table('work_set')->where("id", $output_work_set_id)->update(['file_path'=>$destinationPath_, 'file_ext'=>$fileExt]);
    }
    public function postTaskSetting(Request $request)
    {
        $dispatchDate = $request->update_date;
        $dispatchDate = substr($dispatchDate, 0, strpos($dispatchDate, '('));
        echo date('Y-m-d h:i:s', strtotime($dispatchDate));  
        dd($request->all());
    }
    private function getMatchingWork($matchingList = array(), $user_id = false)
    {
        $matchingWork = array();
        if(count($matchingList)) {
            foreach($matchingList as $k=>$item) {
                $matchingWork[$k]['is_client'] = 0;
                $is_client = DB::table('post_agency')
                    ->where('user_id', $user_id)
                    ->where('policy_id', $item->policy_id)
                    ->count();
                if(($item->submit_type == 1) && ($is_client>0)) {
                    $matchingWork[$k]['is_client'] = 1;
                }
                $matchingWork[$k]['work_set'] = json_decode(DB::table('work_set')
                    ->where('hire_id', $item->hireid)
                    ->orderBy('schedule','desc')
                    ->take(3)->get(), true);

                $file_name = DB::table('work_set')
                    ->where('hire_id', $item->hireid)
                    ->select('file_name')
                    ->orderBy('schedule','asc')->first();
                $notifications = array();
                if ($file_name && $file_name->file_name != '') {
                    $notifications[] = '書類がアップロードされました';
                }
                $count = DB::table('report_acquire')
                    ->where('hire_id', $item->hireid)
                    ->where('manage_flag', '2')->count();
                if ($count > 0 ) {
                    $notifications[] = '請求修正依頼が届いています';
                }
                $matchingWork[$k]['notifications'] = $notifications;
            }
        }
        return $matchingWork;
    }
    public function getMatchingBook(Request $request)
    {
        $user_id = session('user_id');
        $yearList[] = 'すべて';
        for($i = (date('Y')-1); $i <= (date('Y')+1); $i++ )
            $yearList[$i] = $i.'年';
        $year = $request->input('filteryear', 0);
        $month = $request->input('filtermonth', 0);
        $contains_date = "";
        if ((int)$year > 0) {
            $contains_date.=$year;
        }
        $contains_date.="-";
        if ((int)$month>0) {
            if ($month<=9) {
                $contains_date.="0".$month;
            } else {
                $contains_date.=$month;
            }
        }

        $bookList = DB::table('work_set')
            ->where('user_id', $user_id)
            ->where('schedule', '>=', date("Y-m-d"))
            ->orderBy('schedule', 'desc')
            ->select('schedule')
            ->distinct()
            ->paginate(20);

        $subArr = array();
        if(count($bookList))
        {
            for ($k = 0; $k< count($bookList); $k++) {
                $schedule = $bookList[$k]->schedule;
                $subArr[$k]['return'] = json_decode(DB::table('work_set')
                    ->where('work_set.user_id', $user_id)
                    ->where('schedule', $schedule)
                    ->where('hire.finish_flag',0)
                    ->join('hire', 'hire.id', '=', 'work_set.hire_id')
                    ->join('users',function($join) use($user_id)
                    {
                        $join->on('users.id','=','hire.from_id')
                            ->where('hire.to_id',$user_id);
                        $join->orOn('users.id','=','hire.to_id')
                            ->where('hire.from_id',$user_id);
                    })
                    ->join('policy', 'policy.id', '=', 'hire.policy_id')
                    ->select('hire.id as hireid','hire.matching_date','hire.finish_date','users.displayname as user_name','policy.name as policy_name','work_set.schedule',
                        'work_set.work_content', 'work_set.id as work_set_id', 'work_set.work_content_other_value','work_set.work_content_other')->get(), true);
            }
        }
        
        return self::view('Agency::mypage.matching_case.book', compact('bookList', 'subArr', 'yearList'));
    }


    /** MINH **/

    public function getMemberJobs(Request $request)
    {
        $user_id = session('user_id');
        $suggestionCount = DB::table('hire')
            ->where('hire.accept',0)->where('hire.finish_flag',0)
            ->where('hire.submit_type',0)->where('hire.from_id', session('user_id'))
            ->where('hire.notify_from_id',0)->count();
        $requestCount = DB::table('hire')
            ->where('hire.accept',0)->where('hire.finish_flag',0)
            ->where('hire.submit_type',0)->where('hire.to_id', session('user_id'))
            ->where('hire.notify_to_id',0)->count();
        $yearList[] = 'すべて';
        for($i = (date('Y')-1); $i <= (date('Y')+1); $i++ )
            $yearList[$i] = $i.'年';
        $year = $request->input('filteryear', 0);
        $month = $request->input('filtermonth', 0);
        $contains_date = "";
        if ((int)$year > 0) {
            $contains_date.=$year;
        }
        $contains_date.="-";
        if ((int)$month>0) {
            if ($month<=9) {
                $contains_date.="0".$month;
            } else {
                $contains_date.=$month;
            }
        }
        $policy_list = DB::table('hire')
            ->where('hire.from_id', session('user_id'))
            ->where('hire.accept','<>', 1)
            ->where('hire.finish_flag',0)
            ->where('hire.update_date', 'LIKE', '%'.$contains_date.'%')
            ->join('policy', 'policy.id', '=', 'hire.policy_id')
            ->select('policy.id as policy_id','policy.name as policy_name')
            ->distinct()->pluck('policy_name', 'policy_id')->toArray();
        $policy_list = [0=>'すべて'] + $policy_list;

        //table -list
        $sort_name = 'hire.update_date';
        $sort_type = 'desc';
        $display = ($request->filterdisplay)?$request->filterdisplay:10;

        $policy_id = $request->plc_id;
        if ((int)$policy_id == 0) {
            $result = DB::table('hire')
                ->where('hire.from_id', $user_id)
                ->where('hire.accept','<>',1)
                ->where('hire.finish_flag',0)
                ->where('hire.update_date', 'LIKE', '%'.$contains_date.'%')
                ->orderBy($sort_name,$sort_type)
                ->join('policy', 'policy.id', '=', 'hire.policy_id')
                ->join('users', 'users.id', '=', 'hire.to_id')
                ->select('hire.id as hire_id','policy.id as policy_id',
                    'policy.name as policy_name', 'users.displayname','hire.accept','hire.update_date','hire.to_id')->paginate($display);
        }
        else {
            $result = DB::table('hire')
                ->where('hire.from_id', $user_id)
                ->where('hire.accept','<>',1)
                ->where('hire.finish_flag',0)
                ->where('hire.update_date', 'LIKE', '%'.$contains_date.'%')
                ->where('hire.policy_id',$policy_id)
                ->orderBy($sort_name,$sort_type)
                ->join('policy', 'policy.id', '=', 'hire.policy_id')
                ->join('users', 'users.id', '=', 'hire.to_id')
                ->select('hire.id as hire_id','policy.id as policy_id',
                    'policy.name as policy_name', 'users.displayname','hire.accept','hire.update_date','hire.to_id')->paginate($display);
        }
        $messageList = $result;
        $hire_ids = [];
        $msgNote = [];
        foreach($messageList as $k=>$v) {
            $hire_id = $v->hire_id;
            $hire_ids[] = (int)$hire_id;
            $temp = DB::table('message')->where('flag',-1)->where('from_id', $user_id)->where('hire_id',$hire_id);
            $count = $temp->count();
            $msgNote[$k]['remain_message'] = 10- $count;
            $msgNote[$k]['unread_message'] = DB::table('message')->where('flag',-1)
                ->where('to_id', $user_id)
                ->where('hire_id',$hire_id)
                ->where('accept',0)->count();
        }

        DB::table('hire')->whereIn('id', $hire_ids)->update(['hire.notify_from_id'=>1]);

        return self::view('Agency::mypage.member_job', compact('suggestionCount', 'requestCount', 'yearList', 'policy_list', 'messageList', 'msgNote') );
    }
    public function getTaskView($id = false)
    {
        if(!$id) return redirect()->route('agency.jobs.matchingcase');
        $user_id = session('user_id');
        $hire = self::getHireMatchingCase($id);

        $work_set = WorkSet::where('hire_id',$id)->orderBy('schedule', 'asc')->with('work_set_sub')->paginate(10);
        $hire_id = $id;
        return self::view('Agency::mypage.matching_case.task_view', compact('hire', 'work_set', 'hire_id'));
    }
    public function getMessageView($hire_id = false)
    {
        $user_id = session('user_id');
        $hire = DB::table('hire')
            ->where('hire.from_id', $user_id)
            ->where('hire.finish_flag', 0)
            ->where('hire.accept',1)
            ->where('hire.id',$hire_id)
            ->orWhere( function ($query) use ($user_id)
            {
                $query->where('hire.to_id', $user_id)
                    ->where('finish_flag', 0)
                    ->where('hire.accept',1);
            })
            ->join('users',function($join) use($user_id)
            {
                $join->on('users.id','=','hire.from_id')
                    ->where('hire.to_id',$user_id);
                $join->orOn('users.id','=','hire.to_id')
                    ->where('hire.from_id',$user_id);
            })
            ->join('policy','policy.id','=','hire.policy_id')
            ->select('hire.id as hireid','hire.from_id', 'hire.accept', 'hire.to_id', 'hire.matching_date', 'hire.finish_date', 'users.displayname as user_name','policy.name as policy_name', 'hire.document_business_price', 'hire.request_business_price'
                ,'hire.policy_id', 'hire.submit_type' ,'hire.document_business_price1','hire.request_business_price1','hire.matched_by')->limit(1)->get();

        $messageList = DB::table('message')
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
        return self::view('Agency::mypage.matching_case.message_view', compact('messageList', 'hire', 'hire_id'));
    }
    public function ajaxMessageView(Request $request)
    {
        $hire = Hire::
                where('id', $request->hire_id)
                ->where(function($q) {
                    $q->where('from_id', session('user_id'))
                        ->orWhere('to_id', session('user_id'));
                })
                ->first();
        if(!$hire) return response()->json(['success'=>false]);
        $fdata = array();
        $flink = array();
        if($request->hasFile('file'))
        {
            foreach($request->file('file') as $file)
            {
                $uploadedFile = $file;
                $staticfinish = date('Y_m_d');
                $path = 'assets/attach/' . $staticfinish;
                $fileName = md5(time() + rand(0,9999) ) . '.' . $uploadedFile->getClientOriginalExtension();
                $fileExt = $uploadedFile->getClientOriginalExtension();
                $showFileName = $uploadedFile->getClientOriginalName();
                $uploadedFileName = UploadFile::upload($path, $uploadedFile, $fileName);

                $destinationPath_ = 'assetsAND&attachAND&'.$staticfinish.'AND&'.$fileName;

                $update_type = 0; //client set = 1
                $schedule = date( 'Y-m-d', strtotime(date('Y').'-'.((int)($request->month)+1).'-'.((int)($request->day)+1) ) );
                $fdata[] = array($fileName, $destinationPath_);
                $flink[] = [URL::route('agency.jobs.matching.download-file', [$destinationPath_, $fileName] ), $fileName];
            }
            
        }
        $fdata = json_encode($fdata);

        $user_id = session('user_id');
        $message = $request->message;
        $hire_id = $request->hire_id;
        //$first = DB::table('hire')->where('id',$hire_id)->first();
        $first = $hire;
        $policy_id = $first->policy_id;
        $update_date = date("Y-m-d H:i:s");
        $accept = $first->accept;
        $flag = -1;

        $count = 0;
        if (($accept == 0) || ($accept == 2)){
            $count = DB::table('message')->where('hire_id',$hire_id)->where('from_id',$user_id)->count();
            if ($count >= 10)
                return array('result'=>'overflow');
            $flag = -1;
        }
        else if ($accept == 1){
            $flag = 0;
        }
        
        if ($user_id == $first->from_id) {
            $to_id = $first->to_id;
            $notify_id = $first->to_id;
            $notify_col = 'notify_to_id';
        }
        else {
            $to_id = $first->from_id;
            $notify_id = $user_id;
            $notify_col = 'notify_from_id';
            
            
        }
        //update notify
        $hire->$notify_col += 1;
        $hire->save();
        Cache::forget('agency_receiveColl');
        Cache::forget('agency_requestColl');

        $insertData = array(
            'from_id'       =>  $user_id,
            'to_id'         =>  $to_id,
            'policy_id'     =>  $policy_id,
            'hire_id'       =>  $hire_id,
            'message'       =>  $message,
            'file'          =>  $fdata,
            'created_at'    =>  $update_date,
            'flag'          =>  $flag,
        );
        $message_id = DB::table('message')->insertGetId($insertData);
        if(!$message_id) return response()->json(['success'=>false]);
        $data = array(
            'user_id'   =>  session('user_id'),
            'hire_id'   =>  $hire_id,
            'message'   =>  $message
        );
        $insertData['update_date'] = ($update_date);
        $insertData['files'] = $flink;
        $when = now()->addSeconds(30);
        Mail::later($when, new \App\Mail\Message($data));



        return response()->json(['success'=>true, 'message'=>$insertData]);
    }
    public function downloadFileFunc($file_path = false, $name = '')
    {
        $file_path = str_replace("AND&","/",$file_path);
        $file = public_path()."/".$file_path;
        if(file_exists($file)) {
            $headers = array(
                'Content-Type: application/pdf',
            );
            return response()->download($file, $name, $headers);
        }
        return view('Home::file_not_found');
    }
    public function ajaxTaskView(Request $request, $update_type = 0)
    {
        if($request->hasFile('image'))
        {
            $uploadedFile = $request->file('image');
            $staticfinish = date('Y_m_d');
            $path = 'assets/work_set_attach/' . $staticfinish;
            $fileName = md5(time() + rand(0,9999) ) . '.' . $uploadedFile->getClientOriginalExtension();
            $fileExt = $uploadedFile->getClientOriginalExtension();
            $showFileName = $uploadedFile->getClientOriginalName();
            $uploadedFileName = UploadFile::upload($path, $uploadedFile, $fileName);

            $destinationPath_ = 'assetsAND&work_set_attachAND&'.$staticfinish.'AND&'.$fileName;

            
            $schedule = date( 'Y-m-d', strtotime(date('Y').'-'.((int)($request->month)+1).'-'.((int)($request->day)+1) ) );
            $insertData = array(
                'work_set_id' => $request->work_set_id,
                'update_date' => date('Y-m-d'),
                'schedule' => $schedule,
                'file_name' => $showFileName,
                'file_ext' => $fileExt,
                'file_path' => $destinationPath_,
                'update_type' => $update_type

            );
            $insertS = DB::table('work_set_sub')->insert($insertData);
            Event::fire(new WorksetClientEvent($request->work_set_id));

            $qr = DB::table('work_set')->where('id',$request->work_set_id)->first();
            $hire_id = $qr->hire_id;
            $user_id = session('user_id');
            $data = array('hire_id'=>$hire_id,'type'=>4,'work_set_id'=>$request->work_set_id,'schedule'=>$schedule,'user_id'=>$user_id);
            $rs = array('schedule'=>$schedule, 'update_date'=>date('Y-m-d'), 'file_name' => $showFileName, 'file_path' => $destinationPath_, 'update_type'=>$update_type);

            $when = now()->addSeconds(30);
            Mail::later($when, new \App\Mail\WorkSetMail($data));
            return response()->json(['success'=>true, 'data'=>$rs]);
        } else {
            return response()->json(['success'=>false]);
        }
        
    }
    private function getHireMatchingCase($id)
    {
        $user_id = session('user_id');
        $hire = DB::table('hire')
            ->where('hire.from_id', $user_id)
            ->where('hire.finish_flag', 0)
            ->where('hire.accept',1)
            ->where('hire.id',$id)
            ->orWhere( function ($query) use ($user_id)
            {
                $query->where('hire.to_id', $user_id)
                    ->where('finish_flag', 0)
                    ->where('hire.accept',1);
            })
            ->join('users',function($join) use($user_id)
            {
                $join->on('users.id','=','hire.from_id')
                    ->where('hire.to_id',$user_id);
                $join->orOn('users.id','=','hire.to_id')
                    ->where('hire.from_id',$user_id);
            })
            ->join('policy','policy.id','=','hire.policy_id')
            ->select('hire.id as hireid','hire.matching_date', 'hire.finish_date', 'users.displayname as user_name','policy.name as policy_name', 'hire.document_business_price', 'hire.request_business_price'
                ,'hire.policy_id', 'hire.submit_type' ,'hire.document_business_price1','hire.request_business_price1','hire.matched_by')->limit(1)->get();
            return $hire;
    }
    public function getViewFinishWork($hire_id)
    {
        $hire = $this->getHireFinished($hire_id);
        $user_id = session('user_id');

        $work_set = WorkSet::where('hire_id',$hire_id)->orderBy('schedule', 'asc')->with('work_set_sub')->get();
        return self::view('Agency::mypage.matching_case.finish_view', compact('hire', 'work_set', 'hire_id'));
    }
    private function getHireFinished($id)
    {
        $user_id = session('user_id');
        $completedList = DB::table('hire')
            ->where('hire.from_id', $user_id)
            ->where('hire.finish_flag', 1)
            ->orWhere(function ($query) use ($user_id)
            {
                $query->where('hire.to_id', $user_id)
                    ->where('hire.finish_flag', 1);
            })
            ->join('users',function($join) use($user_id)
            {
                $join->on('users.id','=','hire.from_id')
                    ->where('hire.to_id',$user_id);
                $join->orOn('users.id','=','hire.to_id')
                    ->where('hire.from_id',$user_id);
            })
            ->join('policy','policy.id','=','hire.policy_id')
            ->orderBy('hire.matching_date', 'desc')
            ->select('hire.id as hireid', 'hire.matching_date','hire.finish_date', 'users.displayname as user_name', 'policy.name as policy_name')->limit(1)->get();;
            return $completedList;
    }
    public function getMsgFinishWork(Request $request, $hire_id = false)
    {
        $user_id = session('user_id');
        $hire = $this->getHireFinished($hire_id);

        $messageList = DB::table('message')
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
        return self::view('Agency::mypage.matching_case.finish_message', compact('messageList', 'hire', 'hire_id'));
    }
    public function ajaxSetTask(Request $request)
    {
        $datass['success'] = false;
        if($request->act == 'setFinish') 
        {
            if($request->work_set_id)
            {
                $work_set = DB::table('work_set')->where('id', $request->work_set_id)->where('user_id', session('user_id'))->first();
                $datass['success'] = true;
                if($work_set->complete_flag == 1)
                {
                    $datass['is_finish'] = 0;
                    $complete_flag = 0;
                } else {
                    $datass['is_finish'] = 1;
                    $complete_flag = 1;
                }
                DB::table('work_set')->where('id', $request->work_set_id)->where('user_id', session('user_id'))->update(['complete_flag'=>$complete_flag]);
            }
        }
        return response()->json($datass);
    }
    public function ajaxGetHire(Request $request)
    {
        $hire = self::getHireMatchingCase($request->hire_id);
        $acquire = self::getAcquire($request->hire_id);
        $hire = $hire[0];
        return response()->json(['hire'=>$hire, 'acquire'=>$acquire]);
    }
    private function getAcquire($hire_id )
    {
        $result = DB::table('report_acquire')->where('hire_id',$hire_id)->orderBy('acquire_type','asc')->get()->toArray();
        if ($result && count($result) > 0){
            $newrs = array();
            for ($k = 0; $k < count($result); $k++) {
                $tmp = (array)$result[$k];
                $key = (int)($tmp['acquire_type'])-1;
                $newrs[$key] = $tmp;
                $newrs[$key]['other_budget_array'] = json_decode($tmp['other_budget_array'], true);
            }
            if(empty($newrs[0])) $newrs[0] = [];
            if(empty($newrs[1])) $newrs[1] = [];
            $result = $newrs;
            $atype = 1;
        }
        else {
            $result = DB::table('hire')
                ->where('id', $hire_id)
                ->select('hire.other_money_sub1 as other_budget_array')->get();
            if ($result){
                $result = json_decode($result, true);
                $result[0]['other_budget_array'] = json_decode($result[0]['other_budget_array'], true);
                if(empty($result[1])) $result[1] = [];
                $atype = 2;
            }
        }
        return [$result, $atype];
    }
    public function getMatchingReport($hire_id = false)
    {
        $hire = self::getHireMatchingCase($hire_id);
        $sitefee = DB::table('admin_payroll')->first()->site_profit;

        list($acquire, $atype) = self::getAcquire($hire_id);
        //dd($acquire);

        foreach($acquire as $key=>$aq)
        {
            if(!isset($aq['other_budget_array']) && $key == 1)
            {
                for($i = 1; $i <= 5; $i++) {
                    $acquire[$key]['other_budget_array'][] = ['moneyname'=>'', 'balance' => 0];
                }
            }
            
        }

        return self::view('Agency::mypage.matching_case.report', compact('hire', 'sitefee', 'acquire', 'atype', 'hire_id'));
    }
    public function postMatchingReport(Request $request, $hire_id = false)
    {
        //申請代行費用の入力内容を保存しました
        $acquire_type = $request->acquire_index;
        $acquire_budget = $request->acquire_budget;
        $other_budget = 0;
        if($request->other_budget_array) {
            foreach ($request->other_budget_array as $key => $value) {
                $other_budget += $value['balance'];
            }
        }
        $hire = DB::table('hire')->where('id', $hire_id)->first();
        $other_budget_array = json_encode($request->input('other_budget_array', array() ),JSON_UNESCAPED_UNICODE);

        $manage_flag = 1;
        $created_date = date("Y-m-d");
        $error_flag = 0;
        $result = DB::table('report_acquire')
            ->where('hire_id',$hire_id)
            ->where('acquire_type',$acquire_type)->first();
        if ($result) {
            DB::table('report_acquire')
                ->where('hire_id',$hire_id)
                ->where('acquire_type',$acquire_type)
                ->update(['acquire_budget'=>$acquire_budget, 'other_budget'=>$other_budget,'manage_flag'=>$manage_flag,'other_budget_array'=>$other_budget_array]);
        }
        else {
            DB::table('report_acquire')->insert([
                'hire_id'   =>  $hire_id,
                'acquire_type'   =>  $acquire_type,
                'acquire_budget'   =>  $acquire_budget,
                'other_budget'   =>  $other_budget,
                'created_date'   =>  $created_date,
                'error_flag'   =>  $error_flag,
                'manage_flag'   =>  $manage_flag,
                'other_budget_array'   =>  $other_budget_array,
            ]);
        }
        return redirect()->back()->withSuccess('申請代行費用の入力内容を保存しました')->withInput();

    }
    public function getCompleteMatching($hire_id = false)
    {
        //
        $hire = self::getHireMatchingCase($hire_id);

        $userid = session('user_id');
        $result = DB::table('report_finish')->where('hireid', $hire_id)->where('to',$userid)->first();
        $mData['result'] = (array)$result;
        if($result) {
            $mData['success'] = true;
            $mData['ioflag'] = 1;
        } else {
            $result = DB::table('report_finish')->where('hireid', $hire_id)->where('from', $userid)->first();
            if ($result) {
                $mData['success'] = true;
                $mData['ioflag'] = 0;
                $mData['result'] = (array)$result;
            } else {
                $mData['success'] = false;
                $mData['ioflag'] = 0;
                $mData['result']['accept_flag'] = 2;
            }
        }
        //dd($mData);
        return self::view('Agency::mypage.matching_case.complete', compact('hire', 'mData'));
    }
    
    public function postCompleteMatching(Request $request, $hire_id)
    {
        $hireid = $hire_id;
        $userid = session('user_id');
        $content = json_encode([0=>(int)$request->finishtype]);
        $to_id = DB::table('hire')->where('id', $hireid)->first()->to_id;
        if ($to_id == $userid) {
            $to_id = DB::table('hire')->where('id', $hireid)->first()->from_id;
        }
        $accept_flag = 0;
        $date = date('Y-m-d');
        $result = DB::table('report_finish')->where('hireid', $hireid)->first();
        if ($result) {
            DB::table('report_finish')->where('hireid', $hireid)->update(['accept_flag' => $accept_flag, 'created_date' => $date,'from'=>$userid, 'to'=>$to_id, 'content'=>$content]);
        } else {
            DB::table('report_finish')->insert([
                'hireid'                =>  $hireid,
                'report_finish.to'      =>  $to_id,
                'report_finish.from'    =>  $userid,
                'report_finish.content' =>  $content,
                'accept_flag'           =>  $accept_flag,
                'created_date'          =>  $date,
            ]);
        }

        //feedback
        $result = DB::table('report_acquire')->where('hire_id',$hire_id)->where('manage_flag',1)->first();
        if (!$result) {
            $result = DB::table('report_finish')->where('hireid', $hire_id)->where('content', 'LIKE', '%[1]%')->first();
            if (!$result) {
                return redirect()->back()->withErrors('請求を入力してください。')->withInput();
                //return array('result'=>'acquire_first');
            }
        }

        $eval_total= $request->rating1;
        $eval_quality= $request->rating2;
        $eval_delivery= $request->rating3;
        $eval_conf= $request->rating4;
        $eval_price= $request->rating5;
        $eval_ability= $request->rating6;
        $eval_message= $request->content;
        $created_date = date("Y-m-d");
        $finish_type = $request->input('finishtype', 0);
        $display = $request->input('no_display', 0);

        $to_id = DB::table('hire')->where('id',$hire_id)->first()->to_id;

        DB::table('feedback')->insert([
            'hire_id'       =>  $hire_id,
            'to_id'         =>  $to_id,
            'eval_total'    =>  $eval_total,
            'eval_conf'     =>  $eval_conf,
            'eval_ability'     =>  $eval_ability,
            'eval_quality'     =>  $eval_quality,
            'eval_delivery'     =>  $eval_delivery,
            'eval_price'     =>  $eval_price,
            'eval_message'     =>  $eval_message,
            'display'     =>  $display,
            'finish_type'     =>  $finish_type,
            'created_date'     =>  $created_date,
        ]);

        DB::table('hire')->where('id',$hire_id)->update(['finish_flag'=>1]);
        Event::fire(new HireClientEvent('finish',$hire_id));

        return redirect()->back()->withSuccess('完成しました。')->withInput();
    }

    /** END MINH **/

    /**
     * @param  Request
     * @return [type]
     */
    public function doAvatarUpload(Request $request, $targetRoute = 'agency.home')
    {
        if(!$request->hasFile('avatar')) return redirect()->route($targetRoute);
        $uploadedFile = $request->file('avatar');
        $path = 'assets/photo';
        $fileName = md5(session('user_id')) . '.' . $uploadedFile->getClientOriginalExtension();
        $uploadedFileName = UploadFile::upload($path, $uploadedFile, $fileName);
        if($uploadedFileName) 
        {
            DB::table('users')->where('id', session('user_id'))->update(['image'=>$uploadedFileName]);
        }
        return redirect()->back()->with('success', 'プロフィール写真を変更しました');
    }
    private function policyRecommendList($numberOfDisplay = 5, $pageName = 'page')
    {
        return Policy::with(['tags','minitry','sub_minitry', 'cat', 'tags', 'checklist_policy_user', 'policy_region_many.city', 'policy_region_many.province', 'matchingUser'])
        ->with(['matchingUser'=>function($qr) {
                            $qr->where('user_id', session('user_id'));
                        }])
        ->where('publication_setting','=', 0)
        ->where(function($qr){
            $current_date = date('Y-m-d');
            $qr->where('subscript_duration_detail','=','0000-00-00')
                ->orWhere('subscript_duration_detail','>=',$current_date);
        })
        ->where('recom_bounty', 1)
        ->orderBy('id', 'desc')
        ->paginate($numberOfDisplay, ['*'], $pageName);

        return Policy::with('policy_region.province')
                ->with('policy_region.city')
                ->with('tags')
                ->with('minitry')
                ->with('sub_minitry')
                ->with('checklist_policy_user')
                ->with('province')
                ->with('city')
                ->with('matchingUser')
                ->has('policy_region.province')
                ->where('recom_bounty', 1)
                ->orderBy('id', 'desc')
                ->paginate($numberOfDisplay, ['*'], $pageName);
    }
    private function autoSearch()
    {
        return [];
        $user_data = json_decode(DB::table('users')->where('manage_flag',1)->where('permission', 1)->where('id',$user_id)->select('users.*')->distinct()->get(), true);
        $all_region_flag = false;
        $category_details = [];
        $temp_business_type = [];
        $temp_pro_part = [];
        $address_details = [];
        $address1 = json_decode($user_data[0]['address1'],true);
        $location = $user_data[0]['location'];
        $municipality = $user_data[0]['municipality'];
        if(count($address1)==0){
            $all_region_flag = true;
        }
        if($location == '全国'){
            $all_region_flag = true;
        } else {//[["京都府","すべて"]]
            $address_details[] = '"'.$location.'","'.$municipality.'"';
            /*if($municipality != 'すべて') {
                $address_details[] = '"'.$location.'","すべて"';
                $address_details[] = '全国';
            }*/
        }

        /*for ($k = 0; $k < count($address1); $k++) {
            if($address1[$k][0] == '全国'){
                $all_region_flag = true;
                break;
            } else {
                //$address_details[] = $address1[$k][0];
                if(is_array($address1[$k][1]) && count($address1[$k][1])>0){
                    for($i=0; $i<count($address1[$k][1]); $i++)
                    {
                         $address_details[] = $address1[$k][1][$i];
                    }
                } else {
                    $address_details[] = $address1[$k][0];
                }
            }
        }*/

        $category = json_decode($user_data[0]['category_detail'],true);
        if(is_array($category)){
           for ($k = 0; $k < count($category); $k++) {
                //$category_details[] = $category[$k][0];
                if(is_array($category[$k][1]) && count($category[$k][1])>0){
                    for($i=0; $i<count($category[$k][1]); $i++)
                    {
                         $category_details[] = $category[$k][1][$i];
                    }
                }
            }
        }

        $business_type = json_decode($user_data[0]['business_type'],true);
        if(is_array($business_type)){
            $temp_business_type = $business_type;
        }
        $pro_part = json_decode($user_data[0]['pro_part'],true);
        if(is_array($pro_part)){
            $temp_pro_part = $pro_part;
        }
        return BController::search_model($address_details,$all_region_flag, $category_details, $current_page,$per_page ,$user_id,1,$order,$recommended_flag,'', $temp_pro_part,$temp_business_type);
    }
    private function searchFunction()
    {
        $user_type = 0;
        $current_date = date('Y-m-d');
        $first_sql = " SELECT A.*
                         FROM `policy` AS A
                         LEFT OUTER JOIN `matching_users`
                           ON A.`id` = `matching_users`.`policy_id`
                          AND `matching_users`.`user_type` = 0
                        WHERE A.`publication_setting` = 0";
        $second_sql = " UNION
                       SELECT `policy`.*
                         FROM `policy`
                         JOIN matching_users
                           ON `policy`.id = `matching_users`.policy_id
                          AND `matching_users`.user_type = 0
                         LEFT OUTER JOIN post
                           ON `matching_users`.policy_id = `post`.policy_id
                          AND `matching_users`.user_id = `post`.user_id
                          AND `post`.display = 1
                        WHERE `policy`.`publication_setting` = 0";
        $policy_array = "";

        if($auto_flag){
            if (!$all_region_flag) {
                if (count($address1) > 0) {
                    $policy_array = $policy_array." AND ((policy.region_detail LIKE '%".$address1[0]."%' AND policy.publication_setting = '0' AND policy.subscript_duration_detail = '0000-00-00' OR policy.region_detail LIKE '%".$address1[0]."%' AND policy.publication_setting = '0' AND policy.subscript_duration_detail >= ".$current_date.")";
                }
                for ($i=1; $i<count($address1); $i++){
                    $policy_array = $policy_array." OR (policy.region_detail LIKE '%".$address1[$i]."%' AND policy.publication_setting = '0' AND policy.subscript_duration_detail = '0000-00-00' OR policy.region_detail LIKE '%".$address1[$i]."%' AND policy.publication_setting = '0' AND policy.subscript_duration_detail >= ".$current_date.")";
                }
                $policy_array = $policy_array." OR policy.region_detail = '全国' AND policy.publication_setting = '0' AND policy.subscript_duration_detail = '0000-00-00'";
                if (count($address1) > 0) {
                    $policy_array = $policy_array.")";
                }
            }
            if(count($business_type) > 0){
                $policy_array = $policy_array." AND ((policy.business_type LIKE '%".$business_type[0]."%' OR policy.business_type LIKE '%".$business_type[0]."%' AND policy.publication_setting = '0' AND policy.subscript_duration_detail = '0000-00-00' OR policy.business_type LIKE '%".$business_type[0]."%' AND policy.publication_setting = '0' AND policy.subscript_duration_detail = ".$current_date.")";
                for ($i=1; $i<count($business_type); $i++){
                    $policy_array = $policy_array." OR (policy.business_type LIKE '%".$business_type[$i]."%' OR policy.business_type LIKE '%".$business_type[$i]."%' AND policy.publication_setting = '0' AND policy.subscript_duration_detail = '0000-00-00' OR policy.business_type LIKE '%".$business_type[$i]."%' AND policy.publication_setting = '0' AND policy.subscript_duration_detail = ".$current_date.")";
                }
                $policy_array = $policy_array.")";
            }
            if(count($category) > 0){
                $policy_array = $policy_array." AND ((policy.category_detail LIKE '%".$category[0]."%' AND policy.publication_setting = '0' AND policy.subscript_duration_detail = '0000-00-00' OR policy.category_detail LIKE '%".$category[0]."%' AND policy.publication_setting = '0' AND policy.subscript_duration_detail = ".$current_date.")";
                for ($i=1; $i<count($category); $i++){
                    $policy_array = $policy_array." OR (policy.category_detail LIKE '%".$category[$i]."%' AND policy.publication_setting = '0' AND policy.subscript_duration_detail = '0000-00-00' OR policy.category_detail LIKE '%".$category[$i]."%' AND policy.publication_setting = '0' AND policy.subscript_duration_detail = ".$current_date.")";
                }
                $policy_array = $policy_array.")";
            }

        } else {
            if ($keyword != '') {
                $policy_array = $policy_array." AND (policy.name LIKE '%".$keyword."%' AND policy.publication_setting = '0' AND policy.subscript_duration_detail = '0000-00-00' OR policy.name LIKE '%".$keyword."%' AND policy.publication_setting = '0' AND policy.subscript_duration_detail >= ".$current_date.")";
            }

            if (!$all_region_flag) {
                if (count($address1) > 0) {
                    $policy_array = $policy_array." AND ((policy.region_detail LIKE '%".$address1[0]."%' AND policy.publication_setting = '0' AND policy.subscript_duration_detail = '0000-00-00' OR policy.region_detail LIKE '%".$address1[0]."%' AND policy.publication_setting = '0' AND policy.subscript_duration_detail >= ".$current_date.")";
                }
                for ($i=1; $i<count($address1); $i++){
                    $policy_array = $policy_array." OR (policy.region_detail LIKE '%".$address1[$i]."%' AND policy.publication_setting = '0' AND policy.subscript_duration_detail = '0000-00-00' OR policy.region_detail LIKE '%".$address1[$i]."%' AND policy.publication_setting = '0' AND policy.subscript_duration_detail >= ".$current_date.")";
                }
                if (count($address1) > 0) {
                    $policy_array = $policy_array." OR (policy.region_detail LIKE '%全国%' AND policy.publication_setting = '0' AND policy.subscript_duration_detail = '0000-00-00' OR policy.region_detail LIKE '%".$address1[0]."%' AND policy.publication_setting = '0' AND policy.subscript_duration_detail >= ".$current_date.")";
                    $policy_array = $policy_array.")";
                }
            }

            if (count($category) >0) {
                $policy_array = $policy_array." AND ((policy.category_detail LIKE '%".$category[0]."%' AND policy.publication_setting = '0' AND policy.subscript_duration_detail = '0000-00-00' OR  policy.category_detail LIKE '%".$category[0]."%' AND policy.publication_setting = '0' AND policy.subscript_duration_detail >= ".$current_date.")";
                for ($i=1; $i<count($category); $i++){
                    $policy_array = $policy_array." OR (policy.category_detail LIKE '%".$category[$i]."%' AND policy.publication_setting = '0' AND policy.subscript_duration_detail = '0000-00-00' OR  policy.category_detail LIKE '%".$category[$i]."%' AND policy.publication_setting = '0' AND policy.subscript_duration_detail >= ".$current_date.")";
                }
                $policy_array = $policy_array.")";
            }
        }

        $policy_array = $policy_array." AND policy.id NOT IN ( SELECT policy_id FROM checklist_policy_user WHERE user_id = ".$user_id." AND type = '2')";
        $policy_array = $policy_array." GROUP BY policy.id";

        $first_sql = $first_sql.str_replace("policy.", "A.", "$policy_array");

        if($order == 0){
            $policy_array = $policy_array." ORDER BY 51 desc, 1 desc"; // policy.created_date
        } else if ($order == 1) {
            $policy_array = $policy_array." ORDER BY 33 desc, 1 desc"; // policy.acquire_budget_display
        } else if($order == 2){
            $policy_array = $policy_array." ORDER BY 33 asc, 1 desc"; // policy.acquire_budget_display
        } else {
            $policy_array = $policy_array."ORDER BY 1 desc"; // policy.id
        }

        $policy_array = $first_sql.$second_sql.$policy_array;
        $policy_array_count = mysqli_query(DBOpen(), $policy_array.";");
        if ($policy_array_count) {
            $policy_array_count = count($policy_array_count->fetch_all());
        } else {
            $policy_array_count = 0;
        }
        $policy_array = mysqli_query(DBOpen(), $policy_array." LIMIT ".($current_page*$per_page).", ".$per_page.";");
        $dArray = $policy_array->fetch_all(MYSQLI_ASSOC);

        $total_item_number = $policy_array_count;

        for ($k = 0; $k< count($dArray); $k++) {
            $dArray[$k]['present'] = 2;
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
            $dArray[$k]['count_general'] = count(json_decode(DB::table('matching_users')->join('users','matching_users.user_id', '=', 'users.id')
                ->where('matching_users.policy_id',$policy_id)->where('users.manage_flag',0)
                ->whereNotExists(function($query)
                    {
                        $query->select(DB::raw(1))
                              ->from('post')
                              ->whereRaw('matching_users.policy_id = post.policy_id')
                              ->whereRaw('matching_users.user_id =  post.user_id')
                              ->whereRaw('post.display != 1');
                    })
                ->select('users.id','users.image','users.displayname','users.result','users.evaluate','users.payroll')
                ->get(),true));
            $paid_user = DB::table('matching_users')->join('users','matching_users.user_id', '=', 'users.id')
                ->where('matching_users.policy_id',$policy_id)->where('users.manage_flag',0)
                ->select('users.id','users.image','users.displayname','users.result','users.evaluate','users.payroll')
                ->orderBy('users.payroll', 'desc')
                ->orderBy('users.evaluate', 'desc')
                ->orderBy('matching_users.order_type', 'asc')
                ->first();
            $paid_user_result = "failed";
            $dArray[$k]["quick_invitation_option"] = 3;
            $dArray[$k]["featured_option"] = 3;
            if ($paid_user) {
                $dArray[$k]['paid_user'] = $paid_user;
                $paid_user_result = "success";
            }
            $dArray[$k]['paid_user_result'] = $paid_user_result;
            $tags = $dArray[$k]['tag'];
            if(is_array($tags)){
                if(count(array_intersect($tags,$pro_part)) > 0){
                    if(count($tags)>6){
                        $dArray[$k]['tag'] = array_splice($tags, 0,6);
                    } else {
                        $dArray[$k]['tag'] = $tags;
                    }
                }
            } else {
                $dArray[$k]['tag'] = array();
            }
        }
        return array("flag"=>"success", "result"=>$dArray,"total_item_number"=>$total_item_number);
    }
    private function view($blade, $params = [])
    {
        $params['user'] = User::where('id', session('user_id'))->with(['user_location'])->first();
        $this->user = $params['user'];
        //if(in_array($blade, ['Agency::mypage.home', 'Agency::mypage.profile']))
        //{
            $params['profile_completed'] = self::calculatorProfile(session('user_id'));
        //}
        return view($blade, $params);
    }
    public function profileCompleted()
    {

    }
    private function dateDifference($date_1 , $date_2 , $differenceFormat = '%a' )
    {
        $datetime1 = date_create($date_1);
        $datetime2 = date_create($date_2);

        $interval = date_diff($datetime1, $datetime2);

        return (int)$interval->format($differenceFormat);
    }
    public function calculatorProfile($user_id)
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
            //DB::table('users')->where('id',$user_id)->update(['result'=>$feedback['count'], 'evaluate'=>$feedback['result']]);
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
    public function calculatorProfile_bak($user_id)
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

        $first = $actual_result['number'];

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

    /**
     * ONCUTHEN
     */
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

        return self::view("Agency::mypage.message",['hire_data'=>$hire_data,'result'=>$result,'user_id'=>$user_id,'unread_messages'=>$unread_messages,'price'=>$price]);
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
        return self::view("Agency::mypage.message_case",['hire_data'=>$hire_data,'result'=>$result,'user_id'=>$user_id,'policies'=>$policies,'price'=>$price,'unread_messages'=>$unread_messages]);
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

        return self::view("Agency::mypage.message_every_massey",['hire_data'=>$hire_data,'result'=>$result,'user_id'=>$user_id,'clients'=>$clients,'price'=>$price,'unread_messages'=>$unread_messages]);
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

        // print_r($unread_messages);
        // die;
        return self::view("Agency::mypage.message_display_unread_only",['hire_data'=>$hire_data,'result'=>$result,'user_id'=>$user_id,'price'=>$price,'unread_messages'=>$unread_messages]);
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

        $exist_ = DB::table('matching')->select('to_id')->where('from',1)->where('from_id',$user_id)->get();
        $exist = [];
        if($exist_){
            foreach ($exist_ as $key => $value) {
               $exist[] = $value->to_id;
            }
        }

        $result = DB::table('checklist_policy_user')->select('policy_id')->where('type',$type)->where('user_id',$user_id)->whereNotIn('policy_id',$exist)->distinct()->get();
        
        $temp = [];
        if($result){
            foreach ($result as $key => $value) {
               $temp[] = $value->policy_id;
            }
        }
       
        $policy_data = DB::table('policy')->where('publication_setting',0)->whereIn("policy.id", $temp)
                        ->select('policy.*')->paginate($per_page);

        if($policy_data){
           foreach ($policy_data as $key => $value) {
                    $policy_data[$key]->count_general = $this->get_matched_count($value->id);
            } 
        }

        $total = json_decode(json_encode($policy_data), true );
        $total = $total['data'];
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
            $this::sortArrayByKey($total,"count_general", false, false);
        }
        $policy = $total;

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
            $paid_user = DB::table('matching_users')->join('users','matching_users.user_id', '=', 'users.id')
                ->where('matching_users.policy_id',$policy_id)->where('users.manage_flag',0)
                ->select('users.id','users.image','users.displayname','users.result','users.evaluate','users.payroll')
                ->orderBy('users.payroll', 'desc')
                ->orderBy('users.evaluate', 'desc')
                ->orderBy('matching_users.order_type', 'asc')
                ->first();
            $paid_user_result = "failed";
            $policy[$k]["quick_invitation_option"] = 0;
            $policy[$k]["featured_option"] = 0;
            if ($paid_user) {
                $policy[$k]['paid_user'] = $paid_user;
                $paid_user_result = "success";
            }
            $businesstype = json_decode($policy[$k]['business_type'], true);
            $policy[$k]['business_type'] = $businesstype;
            $policy[$k]['paid_user_result'] = $paid_user_result;
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
        $link="?order=".$order."&per_page=".$per_page;
        $policy_data->setPath($link);

        return self::view("Agency::mypage.followList",['result'=>$policy,'policy_data'=>$policy_data,
                                                       'payroll' =>$payroll,'order'=>$order,'per_page'=>$per_page]);
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

        $exist_ = DB::table('matching')->select('to_id')->where('from',1)->where('from_id',$user_id)->get();
        $exist = [];
        if($exist_){
            foreach ($exist_ as $key => $value) {
               $exist[] = $value->to_id;
            }
        }

        $result = DB::table('checklist_policy_user')->select('policy_id')->where('type',$type)->where('user_id',$user_id)->whereNotIn('policy_id',$exist)->distinct()->get();
        
        $temp = [];
        if($result){
            foreach ($result as $key => $value) {
               $temp[] = $value->policy_id;
            }
        }
       
        $policy_data = DB::table('policy')->where('publication_setting',0)->whereIn("policy.id", $temp)
                        ->select('policy.*')->paginate($per_page);

        if($policy_data){
           foreach ($policy_data as $key => $value) {
                    $policy_data[$key]->count_general = $this->get_matched_count($value->id);
            } 
        }

        $total = json_decode(json_encode($policy_data), true );
        $total = $total['data'];
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
            $this::sortArrayByKey($total,"count_general", false, false);
        }
        $policy = $total;

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
            $paid_user = DB::table('matching_users')->join('users','matching_users.user_id', '=', 'users.id')
                ->where('matching_users.policy_id',$policy_id)->where('users.manage_flag',0)
                ->select('users.id','users.image','users.displayname','users.result','users.evaluate','users.payroll')
                ->orderBy('users.payroll', 'desc')
                ->orderBy('users.evaluate', 'desc')
                ->orderBy('matching_users.order_type', 'asc')
                ->first();
            $paid_user_result = "failed";
            $policy[$k]["quick_invitation_option"] = 0;
            $policy[$k]["featured_option"] = 0;
            if ($paid_user) {
                $policy[$k]['paid_user'] = $paid_user;
                $paid_user_result = "success";
            }
            $businesstype = json_decode($policy[$k]['business_type'], true);
            $policy[$k]['business_type'] = $businesstype;
            $policy[$k]['paid_user_result'] = $paid_user_result;
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
        $link="?order=".$order."&per_page=".$per_page;
        $policy_data->setPath($link);

        return self::view("Agency::mypage.interest",['result'=>$policy,'policy_data'=>$policy_data,
                                                       'payroll' =>$payroll,'order'=>$order,'per_page'=>$per_page]);
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

        $exist_ = DB::table('matching')->select('to_id')->where('from',1)->where('from_id',$user_id)->get();
        $exist = [];
        if($exist_){
            foreach ($exist_ as $key => $value) {
               $exist[] = $value->to_id;
            }
        }

        $result = DB::table('checklist_policy_user')->select('policy_id')->where('type',$type)->where('user_id',$user_id)->whereNotIn('policy_id',$exist)->distinct()->get();
        
        $temp = [];
        if($result){
            foreach ($result as $key => $value) {
               $temp[] = $value->policy_id;
            }
        }
       
        $policy_data = DB::table('policy')->where('publication_setting',0)->whereIn("policy.id", $temp)
                        ->select('policy.*')->paginate($per_page);

        if($policy_data){
           foreach ($policy_data as $key => $value) {
                    $policy_data[$key]->count_general = $this->get_matched_count($value->id);
            } 
        }

        $total = json_decode(json_encode($policy_data), true );
        $total = $total['data'];
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
            $this::sortArrayByKey($total,"count_general", false, false);
        }
        $policy = $total;

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
            $paid_user = DB::table('matching_users')->join('users','matching_users.user_id', '=', 'users.id')
                ->where('matching_users.policy_id',$policy_id)->where('users.manage_flag',0)
                ->select('users.id','users.image','users.displayname','users.result','users.evaluate','users.payroll')
                ->orderBy('users.payroll', 'desc')
                ->orderBy('users.evaluate', 'desc')
                ->orderBy('matching_users.order_type', 'asc')
                ->first();
            $paid_user_result = "failed";
            $policy[$k]["quick_invitation_option"] = 0;
            $policy[$k]["featured_option"] = 0;
            if ($paid_user) {
                $policy[$k]['paid_user'] = $paid_user;
                $paid_user_result = "success";
            }
            $businesstype = json_decode($policy[$k]['business_type'], true);
            $policy[$k]['business_type'] = $businesstype;
            $policy[$k]['paid_user_result'] = $paid_user_result;
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
        $link="?order=".$order."&per_page=".$per_page;
        $policy_data->setPath($link);

        return self::view("Agency::mypage.hide",['result'=>$policy,'policy_data'=>$policy_data,
                                                       'payroll' =>$payroll,'order'=>$order,'per_page'=>$per_page]);
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

        return self::view("Agency::mypage.follow",['result'=>$result]);
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

        return self::view("Agency::mypage.followers",['result'=>$result]);
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

        return self::view("Agency::mypage.choose_the_measures",['result'=>$result,'order'=>$order,'per_page'=>$per_page,'user_id'=>$user_id]);
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
        return self::view("Agency::mypage.authentication",['result'=>$result,'allow_odc'=>$allow_odc]);
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
        return self::view("Agency::mypage.confidentiality_confirmation",['result'=>$result]);
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
        return self::view("Agency::mypage.secretariat_confirmation",['result'=>$result]);
    }
         /**
    *   Created by  :   Thắng - 25/10/2018 
    *   Description :   getCall_confirmation
    *   @return     :
    */
    public function getCall_confirmation(Request $request){
        $user_id = session('user_id');
        $result = $this::veryAuth($user_id);
        $error = '';
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
                        ->insert(['user_id'=>$user_id,'phone_number'=>$to, 'verification_code'=>$request_id , 'created_at'=>$created_at]);
                }
                else {
                    // 更新
                    DB::table('person_phone')->where('user_id',$user_id)
                        ->update(['phone_number'=>$to, 'verification_code'=>$request_id , 'created_at'=>$created_at]);
                }
                $update = 'success';
                 return self::view("Agency::mypage.call_confirmation",['result'=>$result,'update'=>$update]);
            } else {
                $update = 'failed';
                $error = $response['error_text'];
            }

        }else if(isset($request->submit) && isset($request->phone)){
            $code = $request->phone;
            $user_phone = DB::table('person_phone')->where('user_id',$user_id)->first();
            if(!$user_phone)
            {
                $update2 = 'failed';
                return self::view("Agency::mypage.call_confirmation",['result'=>$result,'update2'=>$update2]);
            } else {

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
            $request->session()->flash('error', $error);
            
        }
        return self::view("Agency::mypage.call_confirmation",['result'=>$result]);
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
        $year = date('Y')-2;
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
        
        return self::view("Agency::mypage.payment",['result'=>$result,'pay_status'=>$pay_status,
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
        $year = date('Y')-2;
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

        return self::view("Agency::mypage.support_management",['result'=>$result,'getStatus'=>$getStatus,
                                                               'status'=>$status,'year'=>$year,"month"=>$month ]);
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
        return self::view("Agency::mypage.withdrawal",
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
    
        return self::view("Agency::mypage.affiliate",['business'=>$results, 
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

        return self::view("Agency::mypage.result",['year'=>$year, 'month' => $month, 'op'=>$op, 'result'=>$sum_result]);
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
        return self::view("Agency::mypage.register",['location'=>$location,
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