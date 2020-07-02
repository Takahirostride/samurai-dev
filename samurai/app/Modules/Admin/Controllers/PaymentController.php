<?php

namespace App\Modules\Admin\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Hire;
use Csv;
use DB;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $payments;
    function __construct(Payment $payments) {
        $this->payments    =   $payments;
    }
    /**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   get View Search Balancesale
    *   @return     :
    */
    public function getBalancesale(Request $request)
    {
        $created_time_from  =   createDate($request->request_year_from, $request->request_month_from, $request->request_day_from);
        $created_time_to    =   createDate($request->request_year_to, $request->request_month_to, $request->request_day_to);

        $params =   [
                        'created_time_from' =>  $created_time_from,
                        'created_time_to'   =>  $created_time_to,
                        'summary_id'        =>  $request->summary_id,
                        'order_id'          =>  $request->order_id,
                        'status'            =>  $request->status,
                        'summary_id'        =>  $request->summary_id
                    ];
        $payments   =   $this->payments->searchBalancesale($params);
        // print_r($payments);die();
        $total = $payments->count();
        $payments = $payments->orderBy('id', 'DESC')->paginate(10);

        $sale_statuses  =   config('combobox.sale_statuses');
        return view("Admin::master.balancesale", [
                                                    'payments'          => $payments, 
                                                    'total'             => $total, 
                                                    'sale_statuses'     => $sale_statuses]);
    }
    /**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   export csv Balancesale
    *   @return     :
    */
    public function downloadCsvBalancesale(Request $request)
    {
        $created_time_from  =   createDate($request->request_year_from, $request->request_month_from, $request->request_day_from);
        $created_time_to    =   createDate($request->request_year_to, $request->request_month_to, $request->request_day_to);
        
        $params =   [
                        'created_time_from' =>  $created_time_from,
                        'created_time_to'   =>  $created_time_to,
                        'summary_id'        =>  $request->summary_id,
                        'order_id'          =>  $request->order_id,
                        'status'            =>  $request->status,
                        'summary_id'        =>  $request->summary_id
                    ];

        $payments = $this->payments->searchBalancesale($params);
        $payments = $payments->orderBy('id', 'ASC')->get();  

        $data   =   json_decode(json_encode($payments), true);
        $filename = "売上管理一覧"."_" . date('YmdHis');
        Csv::downloadCsv($data, $filename);

        return redirect('/admin/master/balancesale'); 
    }
    /**
    *   Created by  :   vanluuit 01/10/2018 
    *   Description :   get View Search Balancedepwith
    *   @return     :
    */
    public function getBalancedepwith(Request $request)
    {
        $created_time_from  =   createDate($request->request_year_from, $request->request_month_from, $request->request_day_from);
        $created_time_to    =   createDate($request->request_year_to, $request->request_month_to, $request->request_day_to);

        $params =   [
                        'created_time_from' =>  $created_time_from,
                        'created_time_to'   =>  $created_time_to,
                        'summary_id'        =>  $request->summary_id,
                        'order_id'          =>  $request->order_id,
                        'status'            =>  $request->status,
                        'summary_id'        =>  $request->summary_id
                    ];
        $payments   =   $this->payments->searchBalancedepwith($params);

        $total = $payments->count();
        $payments = $payments->orderBy('id', 'DESC')->paginate(10);

        $depwith_statuses  =   config('combobox.depwith_statuses');
        return view("Admin::master.balancedepwith", [
                                                    'payments'          => $payments, 
                                                    'total'             => $total, 
                                                    'depwith_statuses'     => $depwith_statuses]);
    }

    /**
    *   Created by  :   vanluuit 01/10/2018 
    *   Description :   export csv Balancedepwith
    *   @return     :
    */
    public function downloadCsvBalancedepwith(Request $request)
    {
        $created_time_from  =   createDate($request->request_year_from, $request->request_month_from, $request->request_day_from);
        $created_time_to    =   createDate($request->request_year_to, $request->request_month_to, $request->request_day_to);
        
        $params =   [
                        'created_time_from' =>  $created_time_from,
                        'created_time_to'   =>  $created_time_to,
                        'summary_id'        =>  $request->summary_id,
                        'order_id'          =>  $request->order_id,
                        'status'            =>  $request->status,
                        'summary_id'        =>  $request->summary_id
                    ];

        $payments = $this->payments->searchBalancedepwith($params);
        $payments = $payments->orderBy('id', 'ASC')->get();  

        $data   =   json_decode(json_encode($payments), true);
        $filename = "入出金管理一覧"."_" . date('YmdHis');
        Csv::downloadCsv($data, $filename);

        return redirect('/admin/master/balancesale'); 
    }
    /**
    *   Created by  :   vanluuit 30/09/2018 
    *   Description :   get View Search getBalancepayplan
    *   @return     :
    */
    public function getBalancepayplan()
    {

        return view("Admin::master.balancepayplan");
    }
    /**
    *   Created by  :   vanluuit 01/10/2018 
    *   Description :   get View Search getBalancedata
    *   @return     :
    */
    public function getBalancedata()
    {
        return view("Admin::master.balancedata");
    }
    /**
    *   Created by  :   vanluuit 01/10/2018 
    *   Description :   get View Search getDepwith
    *   @return     :
    */
    /**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   get View Search Sale
    *   @return     :
    */
    public function getSale(Request $request)
    {
        $values = Hire::with(['policy', 'invoice']);
        $values = $values->whereHas('invoice',function($qr){
            $qr->whereIn('status',[0,2,4,5]);
        }); 
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
        if($request->filled('status')){
            $status = trim($request->query('status'));
            $values = $values->whereHas('invoice',function($qr) use($status){
                $qr->where('status',$status);
            });
        }

        $order = 'id';
        $sort = 'desc';
        $payments = $values->orderBy($order,$sort)->paginate(10);  

        $sale_statuses  =   config('combobox.sale_statuses');
        return view("Admin::employee.balance.sale", [
                                                    'payments'          => $payments,  
                                                    'sale_statuses'     => $sale_statuses]);
    }
    /**
    *   Created by  :   vanluuit 01/10/2018 
    *   Description :   get View Search depwith
    *   @return     :
    */
    public function getDepwith(Request $request)
    {
        $created_time_from  =   createDate($request->request_year_from, $request->request_month_from, $request->request_day_from);
        $created_time_to    =   createDate($request->request_year_to, $request->request_month_to, $request->request_day_to);

        $params =   [
                        'created_time_from' =>  $created_time_from,
                        'created_time_to'   =>  $created_time_to,
                        'summary_id'        =>  $request->summary_id,
                        'order_id'          =>  $request->order_id,
                        'status'            =>  $request->status,
                        'summary_id'        =>  $request->summary_id
                    ];
        $payments   =   $this->payments->searchBalancedepwith($params);

        $total = $payments->count();
        $payments = $payments->orderBy('id', 'DESC')->paginate(10);

        $depwith_statuses  =   config('combobox.depwith_statuses');
        return view("Admin::employee.balance.depwith", [
                                                    'payments'          => $payments, 
                                                    'total'             => $total, 
                                                    'depwith_statuses'     => $depwith_statuses]);
    }


    /**
    *   Created by  :   vanluuit 30/09/2018 
    *   Description :   get View Search getpayplan
    *   @return     :
    */
    public function getPayplan(Request $request)
    {
        $values = Payment::with(['hire', 'hire.policy'])->whereIn('status',[0,2,3]);
        //request-condition
        if($request->filled('s_year')){
            $month = $request->filled('s_month') ? $request->query('s_month') : '00';
            $s_date = [$request->query('s_year'),$month,'00'];
            $s_date_str = implode('-',$s_date);    
            $values=$values->where('created_time','>=',$s_date_str);
        }         
        if($request->filled('e_year')){
            $month = $request->filled('e_month') ? $request->query('e_month') : '00';
            $e_date = [$request->query('e_year'),$month,'00'];
            $e_date_str = implode('-',$e_date);
            $values=$values->where('created_time','<=',$e_date_str);
        }         
        if($request->filled('keyword')){
            $keyword = trim($request->query('keyword'));
            $values = $values->where('summary','like',"%{$keyword}%");
        }
        if($request->filled('status')){
            $status = trim($request->query('status'));
            $values = $values->where('status',$status);
        }
        $order = 'id';
        $sort = 'desc';
        $payments = $values->orderBy($order,$sort)->paginate(10); 
        // dd($payments);
        $payplan_statuses  =   config('combobox.payplan_statuses');
        return view("Admin::employee.balance.payplan", ['payments'=> $payments, 'payplan_statuses'=>$payplan_statuses]);
    }
    public function chang_status(Request $request){
        $status = $request->status;
        $payment_id = $request->payment_id;
        $id = DB::table('payment')->where('id',$payment_id)->update(['status'=>$status]);
        echo json_encode($id);die();
    }
}