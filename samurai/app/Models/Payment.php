<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Payment extends Model {

    protected $table = 'payment';

    /**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   Query get payment
    *   @return     :
    */
    public function searchBalancesale($params)
    {
    	$payments =  $this->whereIn('status', [0,2,4,5]);
    	if(!empty($params['order_id'])) {
            $payments = $payments->where('order_id', 'LIKE', '%'.$params['order_id'].'%');
        }
        if(!empty($params['created_time_from'])) {
            $payments = $payments->whereDate('created_time', '>=', $params['created_time_from']);
        }
        if(!empty($params['created_time_to'])) {
            $payments = $payments->whereDate('created_time', '<=', $params['created_time_to']);
        }
        if($params['status']!='') {
            $payments = $payments->where('status', '=', $params['status']);
        }
        if(!empty($params['summary_id'])) {
            $payments = $payments->where('summary_id', 'LIKE', '%'.$params['summary_id'].'%');
        }
        return $payments;
    }



    public function searchBalancedepwith($params)
    {
        $payments =  DB::table('payment')->whereIn('status', [0,1,2,3]);
        if(!empty($params['order_id'])) {
            $payments = $payments->where('order_id', 'LIKE', '%'.$params['order_id'].'%');
        }
        if(!empty($params['created_time_from'])) {
            $payments = $payments->whereDate('created_time', '>=', $params['created_time_from']);
        }
        if(!empty($params['created_time_to'])) {
            $payments = $payments->whereDate('created_time', '<=', $params['created_time_to']);
        }
        if($params['status']!='') {
            $payments = $payments->where('status', '=', $params['status']);
        }
        if(!empty($params['summary_id'])) {
            $payments = $payments->where('summary_id', 'LIKE', '%'.$params['summary_id'].'%');
        }
        return $payments;
    }

    public function user()
    {
        return $this->beLongsTo('App\Models\User', 'user_id', 'id');
    }
    public function hire()
    {
        return $this->beLongsTo('App\Models\Hire', 'hire_id', 'id');
    }
}