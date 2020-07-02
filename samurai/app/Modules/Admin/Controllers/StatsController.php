<?php

namespace App\Modules\Admin\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use DB;

class StatsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    protected function round($number)
    {
        return round($number, 3);
    }

    protected function search($request, $table, $column)
    {
        // from ~ to
        $from  =   createDate($request->from_year, $request->from_month, $request->from_day);
        $to    =   createDate($request->to_year, $request->to_month, $request->to_day);

        if (!empty($column))
        {
            if (!empty($from))
                $table = $table->whereDate($column, ">=", $from);
            if (!empty($to))
                $table = $table->whereDate($column, "<=", $to);
        }
        return $table;
    }
    /**
    *   Created by  :   01/10/2018 
    *   Description :   get balancedataArray
    *   @return     :
    */
    protected function balancedataArray(Request $request)
    {
        $hire_accept_count = $this->search(
                $request,
                DB::table('hire')
                    ->where("accept", 1),
                "matching_date"
            )->count();

        $deposit_count = $this->search(
                $request,
                DB::table('payment')
                    ->whereIn("status", array(0, 4)),
                "created_time"
            )->count();

        $deposit_amount = $this->round(
            $this->search(
                $request,
                DB::table('payment')
                    ->whereIn("status", array(0, 4)),
                "created_time"
            )->sum('balance')
        );

        $deposit_nonpay_amount = $this->round(
            $this->search(
                $request,
                DB::table('payment')
                    ->where("status", 4),
                "created_time"
            )->sum('balance')
        );

        $deposit_payed_amount = $this->round(
            $this->search(
                $request,
                DB::table('payment')
                    ->where("status", 0),
                "created_time"
            )->sum('balance')
        );

        if ($deposit_amount)
            $deposit_pay_rate = $this->round($deposit_payed_amount / $deposit_amount * 100);
        else
            $deposit_pay_rate = 0;

        $subsidy_count = $this->search(
            $request,
            DB::table('payment')
                ->whereIn("status", array(2, 5)),
            "created_time"
        )->count();

        $subsidy_amount = $this->round(
            $this->search(
                $request,
                DB::table('payment')
                    ->whereIn("status", array(2, 5)),
                "created_time"
            )->sum('balance')
        );

        $subsidy_nonpay_amount = $this->round(
            $this->search(
                $request,
                DB::table('payment')
                    ->where("status", 5),
                "created_time"
            )->sum('balance')
        );

        $subsidy_payed_amount = $this->round(
            $this->search(
                $request,
                DB::table('payment')
                    ->where("status", 2),
                "created_time"
            )->sum('balance')
        );

        if ($subsidy_amount)
            $subsidy_pay_rate = $this->round($subsidy_payed_amount / $subsidy_amount * 100);
        else
            $subsidy_pay_rate = 0;

        $freeuser_count = $this->search(
                $request,
                DB::table('users')
                    ->where("payroll", 0),
                "created_at"
            )->count();

        $payuser_count = $this->search(
                $request,
                DB::table('users')
                    ->where("payroll", 1),
                "created_at"
            )->count();

        $payuser_fee_amount = $this->round(
            $this->search(
                $request,
                DB::table('payment')
                    ->where("sumary_id", 0)
                    ->where("status", 1),
                "created_time"
            )->sum('balance')
        );

        $payoption_count = $this->search(
                $request,
                DB::table('payment')
                    ->where("sumary_id", 1)
                    ->where("status", 1),
                "created_time"
            )->count();

        $payoption_amount = $this->round(
            $this->search(
                $request,
                DB::table('payment')
                    ->where("sumary_id", 1)
                    ->where("status", 1),
                "created_time"
            )->sum('balance')
        );

        $advert_use_count = $this->search(
                $request,
                DB::table('payment')
                    ->where("sumary_id", 2)
                    ->where("status", 1),
                "created_time"
            )->count();

        $advert_use_amount = $this->round(
            $this->search(
                $request,
                DB::table('payment')
                    ->where("sumary_id", 2)
                    ->where("status", 1),
                "created_time"
            )->sum('balance')
        );

        return array(
            "hire_accept_count" => $hire_accept_count,

            "deposit_count" => $deposit_count,
            "deposit_amount" => $deposit_amount,
            "deposit_nonpay_amount" => $deposit_nonpay_amount,
            "deposit_payed_amount" => $deposit_payed_amount,
            "deposit_pay_rate" => $deposit_pay_rate,

            "subsidy_count" => $subsidy_count,
            "subsidy_amount" => $subsidy_amount,
            "subsidy_nonpay_amount" => $subsidy_nonpay_amount,
            "subsidy_payed_amount" => $subsidy_payed_amount,
            "subsidy_pay_rate" => $subsidy_pay_rate,

            "freeuser_count" => $freeuser_count,
            "payuser_count" => $payuser_count,
            "payuser_fee_amount" => $payuser_fee_amount,

            "payoption_count" => $payoption_count,
            "payoption_amount" => $payoption_amount,

            "advert_use_count" => $advert_use_count,
            "advert_use_amount" => $advert_use_amount,
        );
    }
    /**
    *   Created by  :   01/10/2018 
    *   Description :   get View getBalancedata
    *   @return     :
    */
    public function getBalancedata(Request $request)
    {
        $data = $this->balancedataArray($request);
        return view("Admin::master.balancedata", ['data'=>$data]);
    }

    /**
    *   Created by  :   01/10/2018 
    *   Description :   get View ajaxBalancedata
    *   @return     :
    */
    public function ajaxBalancedata(Request $request)
    {
        $data = $this->balancedataArray($request);
        echo json_encode($data);die();
    }
   
}