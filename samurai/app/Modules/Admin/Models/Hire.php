<?php

namespace App\Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Hire extends Model {

    protected $table = 'hire';
    public $timestamps = false;
    //
    public function policy(){
    	return $this->belongsTo('App\Modules\Admin\Models\Policy','policy_id','id');
    }
    public function fromUser(){
    	return $this->belongsTo('App\Modules\Admin\Models\User','from_id','id');
    }
    public function toUser(){
    	return $this->belongsTo('App\Modules\Admin\Models\User','to_id','id');
    }
    public function reportAcquire(){
        return $this->hasMany('App\Modules\Admin\Models\ReportAcquire','hire_id','id');
    }
    public function workSet(){
        return $this->hasMany('App\Modules\Admin\Models\WorkSet','hire_id','id');
    }    
    //
    public function scopePopular($query){
        $fields = ['id','policy_id','from_id','to_id','id as hire_id','finish_date','deposit_money','other_money','matching_date','document_business_price',
                'document_business_type','request_business_price','request_business_type','content_type','created_at'];
    	return $query->select($fields)->with([
    		'policy'=>function($qr){
    			return $qr->select(['id','name']);
    		},
    		'fromUser'=>function($qr){
    			return $qr->select(['id','displayname','username','manage_flag']);
    		},
    		'toUser'=>function($qr){
    			return $qr->select(['id','displayname','username','manage_flag']);
    		},

    	])
        ->has('policy')
        ->has('fromUser')
        ->has('toUser');
    }
    //
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
    public function deposit_money_receive()
    {
        if($this->deposit_money == 0) return 0;
        $receive = $this->deposit_money + (($this->deposit_money*$this->deposit_setting)/100);
        return number_format( ceil($receive) , 0, '.', ',');
    }
    public function deposit_money_fee($sitefee=0)
    {
        $receive_money = (int)str_replace([',', '.'], '', $this->deposit_money_receive());
        if($receive_money == 0) return 0;
        $receive = (int)$receive_money + (($sitefee*(int)$receive_money)/100);
        return number_format( ceil($receive) , 0, '.', ',');
    }
}