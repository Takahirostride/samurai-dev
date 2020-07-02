<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Hire extends Model
{
    //
    protected $table = 'hire';
    protected $fillable = ['from_id','to_id','policy_id','finish_flag','deli_date','cost_client','cost_agency','update_date','deposit_money','deposit_setting','job_title','job_content','budget','client_pay','agency_estimate','accept','submit_type'];
    const UPDATED_AT = null;
    public function getMatchingPolicyAtHome() {
    	$result = DB::table('hire')
                    ->where('accept',1)
                    ->orderBy('id','desc')
                    ->join('policy','policy.id','=','hire.policy_id')
                    ->select('policy.*');
        return $result;
    }
    public function policy()
    {
        return $this->belongsTo('App\Models\Policy', 'policy_id');
    }
    public function from()
    {
        return $this->belongsTo('App\Models\User', 'from_id');
    }
    public function to()
    {
        return $this->belongsTo('App\Models\User', 'to_id');
    }
    public function deli_date()
    {
        if($this->deli_date == '0000-00-00 00:00:00') return date('Y-m-d');
        return $this->deli_date;
    }
    public function user()
    {
        if($this->from_id == session('user_id')) return $this->to();
        else return $this->from();
    }
    public function shiff_user()
    {
        if($this->from == session('user_id')) return $this->to();
        else return $this->from();
    }
    public function swap_user()
    {
        if($this->from_id == session('user_id')) return $this->from();
        else return $this->to();
    }
    public function deposit_money_format()
    {
        return number_format( $this->deposit_money , 0, '.', ',');
    }
    public function deposit_money_fee()
    {
        $receive_money = (int)str_replace([',', '.'], '', $this->deposit_money_receive());
        $sitefee = $this->sitefee();
        if($receive_money == 0) return 0;
        $receive = (int)$receive_money + (($sitefee*(int)$receive_money)/100);
        return number_format( ceil($receive) , 0, '.', ',');
    }
    public function deposit_money_receive()
    {
        if($this->deposit_money == 0) return 0;
        $receive = $this->deposit_money + (($this->deposit_money*$this->deposit_setting)/100);
        return number_format( ceil($receive) , 0, '.', ',');
    }
    public function deposit_money_receive_new()
    {
        if($this->deposit_money == 0) return 0;
        $receive = $this->deposit_money + ($this->deposit_money * $this->sitefee()/100);
        return number_format( ceil($receive) , 0, '.', ',');
    }
    public function sitefee()
    {
        return DB::table('admin_payroll')->first()->site_profit;
    }
    public function seller_policy()
    {
        return $this->belongsTo('App\Models\SellerPolicy', 'policy_id');
    }
    public function matching_user_count()
    {
        return $this->hasMany('App\Models\MatchingUser', 'policy_id');
    }
    public function hire_title()
    {
        if($this->hire_type == 1) return $this->policy->name;
        return $this->job_title;
    }
    public function image_policy()
    {
        if($this->hire_type == 1) return $this->policy->image_id;
        return '';
    }
    public function hire_minitry()
    {
        if($this->hire_type == 1) return $this->policy->minitry_text();
        return $this->job_title;
    }
    public function hire_region()
    {
        if($this->hire_type == 1) return $this->policy->region_text();
        return $this->job_content;
    }
    public function format_money($number)
    {
        return number_format( (int)$number , 0, '.', ',');
    }
    public function hire_price_2()
    {
        if($this->deposit_money == 0) return 0;
        return ceil($this->deposit_money + (($this->deposit_money * $this->sitefee()/100) ) );
    }
    public function hire_price_2_format()
    {
        return $this->format_money($this->hire_price_2());
    }
    public function deposit_money()
    {
        return $this->format_money($this->deposit_money);
    }
    public function agency_estimate()
    {
        return $this->format_money($this->agency_estimate);
    }
    public function client_pay()
    {
        return $this->format_money($this->client_pay);
    }
    public function invoice()
    {
        return $this->hasOne('App\Models\Payment', 'hire_id');
    }
    public function is_payment()
    {
        if($this->invoice()->count()) return true;
        return false;
    }
    public function workset()
    {
        return $this->hasMany('App\Models\WorkSet', 'hire_id');
    }
    public function fromUser(){
        return $this->belongsTo('App\Modules\Admin\Models\User','from_id','id');
    }
    public function toUser(){
        return $this->belongsTo('App\Modules\Admin\Models\User','to_id','id');
    }
    public function getClient(){
        if($this->fromUser && $this->fromUser->manage_flag==0){
            return $this->fromUser;
        }elseif($this->toUser && $this->toUser->manage_flag==0){
            return $this->toUser;
        }
        return false;
    }
    public function getAgency(){
        if($this->fromUser && $this->fromUser->manage_flag==1){
            return $this->fromUser;
        }elseif($this->toUser && $this->toUser->manage_flag==1){
            return $this->toUser;
        }
        return false;
    }
}
