<?php

namespace App\Modules\Asp\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;
class Hire extends Model {

    protected $table = 'hire';
    public $timestamps = true;
    //
    public function userLog(){
        $user = auth('asp_user')->user();
        return $this->hasOne('App\Modules\Asp\Models\AspHireLog','hire_id','id')->where('asp_user_id','=',$user->id);
    }
    public function policy(){
    	return $this->belongsTo('App\Modules\Asp\Models\Policy','policy_id','id');
    }
    public function fromUser(){
    	return $this->belongsTo('App\Modules\Asp\Models\User','from_id','id');
    }
    public function toUser(){
    	return $this->belongsTo('App\Modules\Asp\Models\User','to_id','id');
    }
    public function workSet(){
        return $this->hasMany('App\Modules\Asp\Models\WorkSet','hire_id','id');
    }
    public function policyCat(){
        return $this->hasMany('App\Modules\Asp\Models\PolicyCat','policy_id','policy_id');
    } 
    //
    public function scopeJoinPolicy($query){
        return $query->leftJoin('policy',function($join){
                $join->on('hire.policy_id','=','policy.id');
            });        
    }
    public function scopePopular($query){
        $fields = ['id','policy_id','from_id','to_id','id as hire_id','finish_date','deposit_money','other_money','matching_date','document_business_price',
                'document_business_type','request_business_price','request_business_type','content_type'];
    	return $query->select($fields)->with([
    		'policy'=>function($qr){
    			return $qr->select(['id','acquire_budget']);
    		},
    		'fromUser'=>function($qr){
    			return $qr->select(['id','displayname','username','manage_flag']);
    		},
    		'toUser'=>function($qr){
    			return $qr->select(['id','displayname','manage_flag']);
    		},

    	]);
    }
    public function scopeSummary($qr){
        $sl = ['hire.id','hire.from_id','hire.to_id','hire.policy_id','hire.finish_flag','hire.deli_date','hire.deposit_money','hire.deposit_setting','hire.finish_date','hire.hire_type'];
        return $qr->select($sl);
    }
    //
    public function finishName(){
        return $this->finish_flag == 1 ? 'Complete' : 'Not complete';
    }
    public function matchingDateName(){
        if(empty($this->matching_date)){ return null;}
        if(is_object($this->matching_date)){ 
            return $this->matching_date->format('Y年m月d日');
        }
        if($this->matching_date=='0000-00-00'){ return '0000年00月00日';}
        return Carbon::parse($this->matching_date)->format('Y年m月d日');        
    }
    public function finishDateName(){
        if(empty($this->finish_date)){ return null;}
        if(is_object($this->finish_date)){ 
            return $this->finish_date->format('Y年m月d日');
        }
        if($this->finish_date=='0000-00-00'){ return '0000年00月00日';}
        return Carbon::parse($this->finish_date)->format('Y年m月d日');        
    }
    public function getClient(){
        if($this->fromUser && $this->fromUser->manage_flag === 0){
            return $this->fromUser;
        }elseif($this->toUser && $this->toUser->manage_flag === 0){
            return $this->toUser;
        }
        return false;
    }
    public function statusName(){
        if($this->finish_flag == 1){
            return 'の最終手続きに進みました。';
        }
        return 'の申請手続きに入りました。';
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
    public function sitefee()
    {
        return DB::table('admin_payroll')->first()->site_profit;
    }
    public function deposit_money_format()
    {
        return number_format( $this->deposit_money , 0, '.', ',');
    }        
}