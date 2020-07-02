<?php

namespace App\Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class User extends Model {

    const SECTION_OPTIONS = [0=>'個人',1=>'法人'];
    const MANAGER_FLAG_OPTIONS = [0=>'事業者',1=>'士業'];
    protected $table = 'users';
    public $timestamps = false;
    protected $perPage = 10;
    protected $fillable = ['displayname','performer','agency_type','agency_type_id','agency_register_number','location','municipality','street_building_name','phone_number','fax','url','self_intro','section','permission','payroll'];
    //
    public function getMemberSectionAttribute(){
        if($this->permission == 0){ return 3;}
        if($this->payroll == 0){ return 0;}
        if($this->evaluate >= 3.5 && $this->personConfirm && $this->personPhone){
            return 2;    
        }
        return 1;
    }
    //
    public function userLogin(){
        return $this->hasMany('App\Modules\Admin\Models\UserLoginInfo','user_id','id');
    }
    public function accountInfo(){
        return $this->hasOne('App\Modules\Admin\Models\AccountInfo','user_id','id');
    }
    public function personConfirm(){
        return $this->hasOne('App\Modules\Admin\Models\PersonConfirm','user_id','id');
    }
    public function userNda(){
        return $this->hasOne('App\Modules\Admin\Models\UserNda','user_id','id');
    }
    public function userCheck(){
        return $this->hasOne('App\Modules\Admin\Models\UserCheck','user_id','id');
    }   
    public function personPhone(){
        return $this->hasOne('App\Modules\Admin\Models\PersonPhone','user_id','id');
    }
    public function userClientData(){
        return $this->hasOne('App\Modules\Admin\Models\UserClientData','user_id','id');
    }

    public function trade(){
        return $this->belongsToMany('App\Modules\Admin\Models\Trade','user_business','user_id','trade_id');
    }
    public function user_agency_type()
    {
        return $this->belongsTo('App\Modules\Admin\Models\AdminAgencyType', 'agency_type_id');
    }
    public function userLocation()
    {
        return $this->hasOne('App\Modules\Admin\Models\UserLocation', 'user_id');
    }   
    public function userAddress()
    {
        return $this->hasMany('App\Modules\Admin\Models\UserAddress', 'user_id');
    }   

    public function tag(){
        return $this->belongsToMany('App\Modules\Admin\Models\Tag','user_pro_part','user_id','tag_id');
    }  
    public function matchingFrom(){
        return $this->hasMany('App\Modules\Admin\Models\Matching','from_id','id');
    }   
    public function userCategory(){
        return $this->hasMany('App\Modules\Admin\Models\UserCategory','user_id','id');
    }
    public function userBank(){
        return $this->hasOne('App\Modules\Admin\Models\UserBank','user_id','id');
    }
    public function reportAdmin(){
        return $this->hasMany('App\Modules\Admin\Models\ReportAdmin','user_id','id');
    }

    //
    public function sectionName(){   
        $secs = static::SECTION_OPTIONS;
    	if(empty($secs[$this->section])){ return '';}
    	return $secs[$this->section];
    }
    public function CreatedAtName(){
        if(empty($this->created_at)){ return null;}
        if(is_object($this->created_at)){ 
            return $this->created_at->format('Y年m月d日');
        }
        return Carbon::parse($this->created_at)->format('Y年m月d日');
    } 
    public function manageFlagName(){
        $secs = static::MANAGER_FLAG_OPTIONS;
        if(empty($secs[$this->manage_flag])){ return '';}
        return $secs[$this->manage_flag];        
    }   
    public function getLoginDate(){
        if($this->userLogin->isEmpty()){return null;}
        $dt = $this->userLogin->first();
        return ol_get_date_string($dt->login_day);
    }
    public function statusName(){
        $permission = $this->permission;
        $payroll = $this->payroll;
        $confirm = $this->personConfirm;
        $personphone = $this->personPhone;
        if(empty($permission)){
            return 'アカウント停止';
        }
        if(empty($payroll)){
            return '無料会員';
        }
        if(empty($confirm)||empty($this->confirm->allow)
            || empty($personphone)||empty($this->personphone->allow)
            ){
            return '特別有料会員';
        }
        return '無料会員';
    }
    public function getImageUrl(){
        if($this->image){ return $this->image;}
        return asset('assets/common/images/img-user1.png');
    }
    public function user_avatar_name()
    {
        if(!$this->image) return '';
        return str_replace('assets/photo/', '', $this->image);

    }  
    public function permissionName(){
        if(empty($this->permission)){
            return 'アカウントの停止';
        }
        return 'アカウントの停止解除';
    } 
    public function userName()
    {
        if($this->displayname == '') return $this->username;
        return $this->displayname;
    }       
}