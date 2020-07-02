<?php

namespace App\Modules\Home\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CheckListPolicyUser;
use App\Models\VisitPolicy;
use App\Models\Hire;
use App\Models\Policy;
use DB, AuthSam;
use Log;
use Mail;
use Carbon\Carbon;

class A_Controller extends Controller
{
    private $checkListPolicyUser;
    private $visitPolicy;
    private $hire;
    function __construct(CheckListPolicyUser $checkListPolicyUser, 
                        VisitPolicy $visitPolicy,
                        hire $hire) {

        $this->checkListPolicyUser  =   $checkListPolicyUser;
        $this->visitPolicy          =   $visitPolicy;
        $this->hire                 =   $hire;

    }
    /**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   get View Index
    *   @return     :
    */
    public function getHome()
    {
        if(AuthSam::isLogin())
        {
            if(AuthSam::permission() == 1) return redirect()->route('agency.index');
            return redirect()->route('client.index');
        }
        // $matching_policy =  $this->hire
        //                     ->getMatchingPolicyAtHome()
        //                     ->take(4)->get();
        // $matching_policy = Hire::with(['policy'=>function($qr){
        //     $qr->where('publication_setting', 0)->where('recom_bounty',1);
        // }])
        // ->orderBy('id','desc')
        // ->has('policy')->with('policy.tags')->paginate(4);

        $policys = Policy::with(['tags'])
        ->where('publication_setting', 0)->where('recom_bounty',1)
        ->orderBy('id','desc')->paginate(4);
        $voices = DB::table('admin_user_sound')->orderBy('order','asc')->paginate(3);
        return view("Home::home", ['policys'  =>  $policys, 'voices'=>$voices]);
    }
    /**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   get View Index
    *   @return     :
    */
    public function getSubsidylist(Request $request)
    {
        $result = [];
        $subsidy_id     =   $request->id;
        if (AuthSam::isLogin()) {
            $user_id    =   AuthSam::getUser()->id;
            if ($subsidy_id == '2') {
                $result   = $this->visitPolicy
                            ->getVisitPolicyAtHome($user_id)
                            ->paginate(20);
            }
            if($subsidy_id == '1') {
                $result   = $this->checkListPolicyUser
                                ->getInterestPolicyAtHome($user_id)
                                ->paginate(20);
            }
        }
        if ($subsidy_id == '0') {
            $result     =   Policy::with(['tags'])
            ->where('publication_setting', 0)->where('recom_bounty',1)
            ->orderBy('id','desc')->paginate(20);
        }
        return view("Home::subsidylist", ['result' => $result]);
    }
    /**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   get View Index
    *   @return     :
    */
    public function getHowtomatching()
    {
        return view("Home::howtomatching");
    }
    /**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   get View Index
    *   @return     :
    */
    public function getUservoicelist()
    {
        $result = DB::table('admin_user_sound')->orderBy('order','asc')->paginate(10);
        return view("Home::uservoicelist",['result'=>$result]); 
    }
    /**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   get View Index
    *   @return     :
    */
    public function getUservoicelistdetail(Request $request)
    {
        $detail = DB::table('admin_user_sound')->where('id', $request->id)->first();
        $result = DB::table('admin_user_sound')->whereNotIn('id', [$request->id])->orderBy('order','asc')->paginate(3);
        return view("Home::uservoicelistdetail",['result'=>$result, 'detail'=>$detail]); 
    }
    /**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   get View Index
    *   @return     :
    */
    public function getSubsidydetail(Request $request)
    {
        $policy_id = $request->id;
        $result = Policy::where('id', $policy_id)->first();
        return view("Home::subsidy_detail", ['result'   =>  $result]);
    }
    /**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   get View Index
    *   @return     :
    */
    public function getBloglist()
    {
        return view("Home::bloglist");
    }
    /**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   get View Index
    *   @return     :
    */
    public function getWhatissamurai()
    {
        return view("Home::whatissamurai");
    }
    /**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   get View Index
    *   @return     :
    */
    public function getSeminarinfo()
    {
        return view("Home::seminarinfo");
    }
    /**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   get View Index
    *   @return     :
    */
    public function getHowtouse()
    {
        return view("Home::howtouse");
    }
    /**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   get View Index
    *   @return     :
    */
    public function getHowtouse2()
    {
        return view("Home::howtouse_2");
    }
    /**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   get View Index
    *   @return     :
    */
    public function getHowtouse3()
    {
        return view("Home::howtouse_3");
    }
    /**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   get View Index
    *   @return     :
    */
    public function getHowtouse4()
    {
        return view("Home::howtouse_4");
    }
    /**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   get View Index
    *   @return     :
    */
    public function getHowtouse5()
    {
        return view("Home::howtouse_5");
    }
    /**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   get View Index
    *   @return     :
    */
    public function getHowtouse6()
    {
        return view("Home::howtouse_6");
    }
    /**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   get View Index
    *   @return     :
    */
    public function getTermservice()
    {
        return view("Home::termservice");
    }
    /**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   get View Index
    *   @return     :
    */
    public function getTransactionraw()
    {
        return view("Home::transactionraw");
    }
    /**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   get View Index
    *   @return     :
    */
    public function getGuideLine()
    {
        return view("Home::guide_line");
    }
    /**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   get View Index
    *   @return     :
    */
    public function getPrivacyPolicy()
    {
        return view("Home::privacy_policy");
    }
    /**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   get View Index
    *   @return     :
    */
    public function getCompanyAbout()
    {
        return view("Home::companyabout");
    }
    public function pageNotFound()
    {
        return view('Home::page_not_found');
    }

    /**
    *   Created by  :   Thắng - 20/08/2018 
    *   Description :   getPay
    *   @return     :
    */
    public function getPay(Request $request)
    {
        $money_total = 0;
        $back_page_name = ""; 
        $back_link ="";
        $user_id = session('user_id');
        //print_r($request->payment_id); die;

        if(isset($request->money_total)){
           $money_total = $request->money_total; 
        }
        if(isset($request->back_link)){
           $back_link = $request->back_link; 
        }
        if(isset($request->back_page_name)){
           $back_page_name = $request->back_page_name; 
        }
        $payment_id = '';
        if(isset($request->payment_id)){
            $money_total = DB::table('payment')->whereIn('id', $request->payment_id)->sum('balance');
            $payment_id = json_encode($request->payment_id);
        }
        $insert_payment = array('user_id' => "" ,
                                'hire_id' => "" ,
                                'to_id' => "" , 
                                'summary' => "",
                                'summary_sub' => "",
                                'summary_id' => "",
                                'balance' => "",
                                'status' => "",
                                'created_time' => date('Y-m-d'),
                                'pay_type' => "",
                                'user_type' => ""
                                 );

        if(isset($request->user_id)){
            $insert_payment['user_id'] = $request->user_id;
        }
        if(isset($request->hire_id)){
            $insert_payment['hire_id'] = $request->hire_id;
        }
        if(isset($request->to_id)){
            $insert_payment['to_id'] = $request->to_id;
        }
        if(isset($request->summary)){
            $insert_payment['summary'] = $request->summary;
        }
        if(isset($request->summary_sub)){
            $insert_payment['summary_sub'] = $request->summary_sub;
        }
        if(isset($request->summary_id)){
            $insert_payment['summary_id'] = $request->summary_id;
        }
        if(isset($request->balance)){
            $insert_payment['balance'] = $request->balance;
            $money_total = $request->balance;
        }
        if(isset($request->status)){
            $insert_payment['status'] = $request->status;
        }
        if(isset($request->pay_type)){
            $insert_payment['pay_type'] = $request->pay_type;
        }
        if(isset($request->user_type)){
            $insert_payment['user_type'] = $request->user_type;
        }
        
        $insert_payment = json_encode($insert_payment);
        $consumption_tax_rate = DB::table('admin_payroll')->first()->consumption_tax_rate;

        // get info bank
        $bank_info = DB::table('admin_bank')
            ->select('admin_bank.*')
            ->get();

        $card_info = DB::table('admin_card')
            ->select('admin_card.*')
            ->get();
        //print_r($insert_payment) ; die;
        session([
            'pay_money_total'=>$money_total,
            'pay_back_link'=>$back_link,
        ]);
        return view("Home::pay",['consumption_tax_rate'=>$consumption_tax_rate,
                                 "bank_info"=>$bank_info, "card_info"=>$card_info,'money_total'=>$money_total, 
                                 'back_link'=> $back_link,'payment_id'=>$payment_id,
                                 'insert_payment'=> $insert_payment, 'user_id'=>$user_id, 'back_page_name'=>$back_page_name]);
    }

    public function getPayNew(Request $request, $hire_id = false)
    {
        $hire = Hire::where('id', $hire_id)
                ->where(function($query) {
                    $query->where('from_id', session('user_id'))
                        ->orWhere('to_id', session('user_id'));
                })
                ->first();
        if(!$hire) return redirect('/');
        if($hire->is_payment()) return redirect('/');

        $bank_info = DB::table('admin_bank')
            ->get();

        return view('Home::new_pay', compact('hire', 'bank_info') );
    }
    public function postPayNew(Request $request, $hire_id = false)
    {
        $hire = Hire::where('id', $hire_id)
                ->where(function($query) {
                    $query->where('from_id', session('user_id'))
                        ->orWhere('to_id', session('user_id'));
                })
                ->first();
        if(!$hire) return redirect('/');
        if($hire->is_payment()) return redirect('/');

        $to_id = ($hire->from_id==session('user_id')?$hire->to_id:$hire->from_id);
        $summary = $hire->hire_title();

        do {
            $order_id = '115' . date('YmdHis');
            $is_exist = DB::table('payment')->where('order_id', $order_id)->first();
        } while (count($is_exist));

        $insertData = [
            'order_id'      =>  $order_id,
            'user_id'       =>  session('user_id'),
            'hire_id'       =>  $hire->id,
            'to_id'         =>  $to_id,
            'summary'       =>  $summary,
            'summary_sub'   =>  '着手金',
            'sumary_id'    =>  7,
            'balance'       =>  $hire->client_pay,
            'status'        =>  6,
            'created_time'  =>  date('Y-m-d H:i:s'),
            'pay_type'      =>  2,
            'user_type'     =>  1

        ];

        session(['transfereename'=>$request->transfereename]);
        $billing = $this->billing_bulk_upsert($request);
        if($billing['result'] == 'Failed')
        {
            session(['fail_msg' => $billing['billing']['error_message']]);
            return redirect('/pay-fail/' . $hire->id);
        }

        //DB::table('payment')->insert($insertData);
        //
        $demand = $this->demand_bulk_upsert(json_decode(json_encode($billing['billing']), true), $hire->client_pay);
        if (isset($demand) && $demand["result"] == "Success") {
            Log::Info("success demand_bulk_upsert.");
            DB::table('payment')->insert($insertData);

            return redirect('/pay-success/' . $hire->id);

        } else {
            return redirect('/pay-failed/' . $hire->id);
        }

    }

    public function getPaySuccess(Request $request, $hire_id = false)
    {
        $hire = Hire::where('id', $hire_id)
                ->where(function($query) {
                    $query->where('from_id', session('user_id'))
                        ->orWhere('to_id', session('user_id'));
                })
                ->first();
        if(!$hire) return redirect('/');
        if(!$hire->is_payment()) return redirect('/');
        return view('Home::pay_success', compact('hire', 'bank_info'));
    }
    public function getPayFail(Request $request, $hire_id = false)
    {
        $hire = Hire::where('id', $hire_id)
                ->where(function($query) {
                    $query->where('from_id', session('user_id'))
                        ->orWhere('to_id', session('user_id'));
                })
                ->first();
        if(!$hire) return redirect('/');
        
        return view('Home::pay_failed', compact('hire'));
    }

    // quản lý thanh toán
    public function billing_bulk_upsert(Request $request)
    {
        
        $user_id = session('user_id');
        Log::info("billing_bulk_upsert");

        // ユーザー情報取得
        $user = DB::table('users')->where('id', $user_id)->first();
        
        $payment_method = $request->payment_method ? 1 : 2;
        // 決済情報コード

        $payment_method_code = $user->displayname . ' ' . ((string)Carbon::now());
        Log::info($payment_method_code);
        
        $params =
        [
            "user_id" => env("PAYMENT_USER_ID", 'gura@grand2.com'),
            "access_key" => env("PAYMENT_ACCESS_KEY", '9d5e7d6dda5100c7'),   
            
            "billing" => [
                [
                    "code" => $user->id,
                    "name" => $user->displayname,
                    "individual" => [
                        [
                            "code" => $user->id,
                            "name" => $user->displayname,
                            "address1" => $user->displayname,
                            //"zip_code" => 123,
                            //"zip_code" => $user->zipcode,
                            //"pref" => $user->location,
                            //"city_address" => $user->municipality,
                            "email" => $user->e_mail,
                            "tel" => str_replace('-', '', $user->phone_number)
                        ]
                    ],
                    "payment" => [
                        [
                            "code" => $user->id.Carbon::now()->format('YmdHis'),
                            "name" => $payment_method_code,
                            "source_bank_account_name" => "",
                            "payment_method" => $payment_method
                        ]
                    ]
                ]
            ]
        ];

        Log::info($params);
        //print_r($params); die;
        $url = "https://billing-robo.jp/api/v1.0/billing/bulk_upsert";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120);
        curl_setopt($ch, CURLOPT_TIMEOUT, 120);
        if(\App::environment('local')) {
            curl_setopt($ch, CURLOPT_PROXY, '127.0.0.1:1080');
            curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
        }

        $result = json_decode(curl_exec($ch), true);

        $result = $result["billing"][0];
        // エラー情報の確認

        if (isset($result)
            && is_null($result["error_code"])
            && is_null($result["individual"][0]["error_code"])
            && is_null($result["payment"][0]["error_code"])) {

            return array('result' => "Success", 'billing' => $result);
        } else {
            return array('result' => "Failed", 'billing' => $result);
        }
    }
    public function payDevelop(Request $request)
    {
        $url = "https://credit.j-payment.co.jp/gateway/checkout_result.aspx";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded'] );
        curl_setopt($ch, CURLOPT_POSTFIELDS, $request->ddd);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120);
        curl_setopt($ch, CURLOPT_TIMEOUT, 120);
        if(\App::environment('local')) {
            curl_setopt($ch, CURLOPT_PROXY, '127.0.0.1:1080');
            curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
        }

        $result = curl_exec($ch);
        return response()->json( json_decode($result) );
    }
    // 請求情報登録更新
    private function demand_bulk_upsert($billing, $price) {
        Log::info("demand_bulk_upsert");

        $goodsName = "SAMURAI決済_".Carbon::now()->format('YmdHis');
        $params = [
            "user_id" => env("PAYMENT_USER_ID", 'gura@grand2.com'),
            "access_key" => env("PAYMENT_ACCESS_KEY", '9d5e7d6dda5100c7'),
            "demand" => [
                [
                    "billing_code" => $billing['code'],
                    "billing_individual_number" => $billing['individual'][0]['number'],
                    "payment_method_code" =>$billing['payment'][0]['code'],
                    "type" => "0",
                    "goods_name" => $goodsName,
                    "price" => $price,
                    "quantity" => 1,
                    "tax_category" => "1",
                    "tax" => intval(DB::table('admin_payroll')->first()->consumption_tax_rate),
                    "billing_method" => "0",//メール送信方法
                    "start_date" => Carbon::now()->format('Y/m/d'), // サービス開始日時
                    "period_format" => 1, // 日時フォーマット
                    "issue_month" => 0,
                    "issue_day" => 99,
                    "sending_month" => 0,
                    "sending_day" => 99,
                    "deadline_month" => 1,
                    "deadline_day" => 99,
                    "bill_template_code" => 10000,
                ]
            ]
        ];
        Log::info($params);

        $url = "https://billing-robo.jp/api/v1.0/demand/bulk_upsert";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120);
        curl_setopt($ch, CURLOPT_TIMEOUT, 120);
        if(\App::environment('local')) {
            curl_setopt($ch, CURLOPT_PROXY, '127.0.0.1:1080');
            curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
        }
        $result = json_decode(curl_exec($ch), true);
        Log::info($result);
        $result = @$result['demand'][0];
        if (is_null(@$result['error_code'])) {
            // 成功の場合
            return array('result' => "Success", 'demand' => $result);

        } else {
            // エラーの場合
            Log::Error($result['error_code']);
            Log::Error($result['error_message']);
            return array('result' => "Failed", 'demand' => $result);
        }
    }

    // クレジットカード支払い
    public function pay_with_card(Request $request) {
        Log::info("pay_with_card");

        // 店舗オーダー番号
        $cod = $request->billing['payment'][0]['cod'];
        // トークン
        $token = $request->token;
        // ユーザー情報取得
        $user = DB::table('users')->where('id', $request->user_id)->select('e_mail', 'phone_number')->first();
        // 電話番号
        $pn = '000000000000';
        // メールアドレス
        $em = '';
        if ($user) {
            if (!empty($user->phone_number)) {
                $pn = str_replace('-', '', $user->phone_number);
            }
            if (!empty($user->e_mail)) {
                $em = $user->e_mail;
            }
        }
        // クレジットカード登録
        $return_val = $this->register_cregit_card($cod, $token, $pn, $em);
        if ($return_val["result"] == "Success") {
            // クレジットカード登録が成功した場合
            // 請求情報登録更新
            Log::info("register_cregit_card");
            $demand = $this->demand_bulk_upsert(json_decode(json_encode($request->billing), true), $request->price);
            if (isset($demand) && $demand["result"] == "Success") {
                // 請求情報登録更新が成功した場合
                // DB更新
                Log::Info("success demand_bulk_upsert.");
                $this->insertPayData($request->ids, $request->insert_data, $request->billing['payment'][0]['code'], $request->payment_method);
                // DB更新が成功
                return array('result' => "Success", 'demand' => $demand);

            } else {
                // 請求情報登録更新が失敗した場合
                Log::Error($demand);
                return array('result' => "Failed1");
            }
        } else {
            // クレジットカード登録が失敗した場合
            Log::Error($return_val);
            return array('result' => "Failed2");
        }
    }

    // 口座振替
    public function bank_transfer($billing) {
        Log::info("bank_transfer");
        // 請求情報登録更新
        $demand = $this->demand_bulk_upsert(json_decode(json_encode($request->billing), true), $request->price);
        if (isset($demand) && $demand["result"] == "Success") {
            // 請求情報登録更新が成功した場合
            // DB更新
            Log::Info("success demand_bulk_upsert.");
            $this->insertPayData($request->ids, $request->insert_data, $request->billing['payment'][0]['code'], $request->payment_method);
            // DB更新が成功
            return array('result' => "Success", 'demand' => $demand);

        } else {
            // 請求情報登録更新が失敗した場合
            Log::Error($demand);
            return array('result' => "Failed");
        }
    }

    // クレジットカード登録
    private function register_cregit_card($cod, $token, $pn, $em){
        Log::info("register_cregit_card");

        // リクエストパラメータの設定
        $params = array(
            'aid' => env('PAYMENT_STORE_ID', '113604'), // 店舗ID
            'jb' => 'CHECK', // ジョブタイプ
            'rt' => '1', // 決済結果返信方法
            'cod' => $cod, // 店舗オーダー番号
            'tkn' => $token, // トークン情報
            'pn' => $pn, // 電話番号
            'em' => $em // メールアドレス
        );
        Log::info($params);
        // APIのURL
        $url = "https://credit.j-payment.co.jp/gateway/billgate_token.aspx";
        // curl設定
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120);
        curl_setopt($ch, CURLOPT_TIMEOUT, 120);
        if(\App::environment('local')) {
            curl_setopt($ch, CURLOPT_PROXY, '127.0.0.1:1080');
            curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
        }
        // 実行
        $result = curl_exec($ch);
        if(curl_errno($ch) !== 0) {
            Log::Error('cURL error when connecting to ' . $url . ': ' . curl_error($ch));
        }
        $return_val = explode(',', $result);
        if (strpos($return_val[3],'ER') !== false) {
            // エラーの場合、ログにエラー原因を出力
            Log::Error("failed settlement.");
            Log::Error("ERR_CODE = $return_val[3]");
            return array('result' => "Failed", 'val' => $return_val);
        }
        Log::Info("Success settlement.");
        return array('result' => "Success", 'val' => $return_val);
    }

    // DB更新
    private function insertPayData($ids, $insert_data, $payment_code, $payment_method)
    {
        Log::info("insertPayData");
        $currentDateTime = date('Y-m-d H:i:s');
        $currentDate = date('Y-m-d');
        if ($insert_data == "") {
            for ($i = 0; $i < count($ids); $i++) {
                $record = json_decode(DB::table('payment')->where('id', $ids[$i])->select('status', 'sumary_id')->distinct()->get(), true);
                if ($payment_method) {
                    // クレジットカードの場合
                    if (@$record[0]['status'] == 4) {
                        DB::table('payment')->where('id', $ids[$i])->update(['order_id' => $payment_code, 'status' => '0', 'sumary_id' => '7', 'created_time' => $currentDateTime]);

                    } else {
                        DB::table('payment')->where('id', $ids[$i])->update(['order_id' => $payment_code, 'status' => '2', 'sumary_id' => '8', 'created_time' => $currentDateTime]);
                    }
                } else {
                    // 銀行振込の場合
                    DB::table('payment')->where('id', $ids[$i])->update(['order_id' => $payment_code, 'status' => '6', 'sumary_id' => '7', 'created_time' => $currentDateTime]);
                }
            }
        } else {
            $insert_data = json_decode($insert_data, true);
            DB::table('payment')->insert(['order_id' => $payment_code, 'user_id' => $insert_data['user_id'], 'hire_id' => $insert_data['hire_id'], 'to_id' => $insert_data['to_id'],
                'summary' => $insert_data['summary'], 'summary_sub' => "", 'sumary_id' => $insert_data['summary_id'], 'balance' => $insert_data['balance'],
                'status' => $insert_data['status'], 'created_time' => $currentDateTime, 'pay_type' => $insert_data['pay_type'],
                'user_type' => $insert_data['user_type']]);
            if ($insert_data['summary_id'] == 0) { // paid for user
                $date = strtotime(date("Y-m-d", strtotime($currentDate)) . " +1 month");
                $payroll_date = date("Y-m-d", $date);
                DB::table('users')->where('id', $insert_data['user_id'])->update(['payroll' => 1, 'payroll_sub' => 1, 'payroll_date' => $payroll_date]);
            } else if ($insert_data['summary_id'] == 1) { // paid for policy
                DB::table('post')->where('user_id', $insert_data['user_id'])->where('policy_id', $insert_data['summary'])->update(['paid_flag' => 1]);
            } else if ($insert_data['summary_id'] == 2) { // paid for advertisment

            } else if ($insert_data['summary_id'] == 6) { // refund

            }
        }
    }
    /**
    *   Created by  :   Thắng - 20/08/2018 
    *   Description :   getInquiry
    *   @return     :
    */
    public function getInquiry(Request $request)
    {
        

        
        if(isset($request->submit)){
            
            Log::info('inquiry');
            $user_id = 0;
            $mail_data['email_to'] = $request->email;
            if(session()->has('user_id')){
                $user_id = session('user_id');
                Log::info(DB::table('users')->where('id',$user_id)->get());
                $user = DB::table('users')->where('id',$user_id)->first();
                $email_to = $user->e_mail;
                $mail_data['email_to'] = $email_to;
            }
            Mail::queue(new \App\Mail\MakeInquiry($user ));
            /*
            $mail_data['name'] = "SAMURAI事務局";
            $text = "

            この度は、samuraiへのお問い合わせいただき、誠にありがとうございます。 <br><br>

            お問い合わせ内容を確認の上、2営業日以内ご返信いたしますので、<br>
            今しばらくお待ちいただけますようお願いいたします。<br><br>
            
            なお、本メールへのご返信によるお問い合わせは承っておりませんので、<br>
            ご了承ください。";
            
            Mail::send('mailtemp', ['text' => $text], function($message) use ($mail_data)
            {
                $message->from( env("MAIL_USERNAME", "info@samurai-match.jp"), $mail_data['name']);

                $message->to($mail_data['email_to'], 'Name')->subject('samurai：お問い合わせありがとうございます。');
            });
            */


            DB::table('faq')->insert([
                'user_id'=>$user_id,
                'faq_title'=>$request->inquiry_subject,
                'faq_content'=>$request->inquiry_content,
                'name'=>$request->name,
                'name2'=>$request->phonetic,
                'phone'=>$request->phone,
                'email'=>$request->email,
                'type'=>$request->inquiry_type,
                'state'=> 0,
                'complete'=> 0,
            ]);
            return redirect()->route('inquiry_completed');
        }
        
        return view("Home::inquiry");
    }

     /**
    *   Created by  :   Thắng - 20/08/2018 
    *   Description :   getInquiry_completed
    *   @return     :
    */
    public function getInquiry_completed()
    {
        return view("Home::inquiry_completed");
    }

    
}