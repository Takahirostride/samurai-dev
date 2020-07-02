<?php

namespace App\Modules\Asp\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class AspClientLog extends Model
{
    //
    protected $table = 'asp_client_logs';
    protected $fillable=['user_id','asp_user_id','favorite','created_at'];
    public $timestamps = false;
    protected $casts =[
        'favorite'=>'boolean',
    	'created_at'=>'datetime',
    ];
    //
    public function user(){
        return $this->belongsTo('App\Modules\Asp\Models\User','user_id','id');
    } 
    public function hireMessage(){
        return $this->hasMany('App\Modules\Asp\Models\AspHireMessage','asp_client_log_id','id');
    } 
    public function loginInfo(){
        return $this->hasOne('App\Modules\Asp\Models\UserLoginInfo','user_id','user_id');
    }   
    public function policy(){
        return $this->belongsToMany('App\Modules\Asp\Models\Policy','asp_client_policy','asp_client_log_id','policy_id')->withPivot('created_at');
    }    
    //
    public function scopeJoinLogin($query){
        return $query->leftJoin('user_login_info','asp_client_logs.user_id','=','user_login_info.user_id')->groupBy('user_login_info.user_id');
    }
    public function scopeJoinUser($query){
        return $query->leftJoin('users','users.id','=','asp_client_logs.user_id');
    }           
}
