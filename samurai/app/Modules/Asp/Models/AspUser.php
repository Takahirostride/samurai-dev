<?php

namespace App\Modules\Asp\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Modules\Asp\Models\FullTextSearch;
use App\Modules\Asp\Mail\ResetPassword;
use Mail;
class AspUser extends Authenticatable {

    use FullTextSearch;
	const ROLE_LIST = ['admin'=>'Admin','mod'=>'Moderator','member'=>'Member'];
    protected $table = 'asp_users';    
    protected $fillable = ['first_name','last_name','avatar','inviter_id','email','account','password','role','created_at','updated_at'];
    public $timestamps = true;
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $searchable = [
        'first_name',
        'last_name'
    ]; 
    public function sendPasswordResetNotification($token)
    {
        $email = $this->getEmailForPasswordReset();
        Mail::to($email)->send(new ResetPassword($token));
    }       
    //
    public function signature(){
        return $this->hasOne('App\Modules\Asp\Models\AspSignature','asp_user_id','id');
    }  
    public function hireLog(){
        return $this->hasMany('App\Modules\Asp\Models\AspHireLog','asp_user_id','id');
    } 
    public function policyLog(){
        return $this->hasMany('App\Modules\Asp\Models\AspPolicyLog','asp_user_id','id');
    }            
    public function inviter(){
        return $this->belongsTo('App\Modules\Asp\Models\AspUser','inviter_id','id');
    }
    public function staff(){
        return $this->hasMany('App\Modules\Asp\Models\AspUser','inviter_id','id');
    }
    public function group(){
        return $this->belongsToMany('App\Modules\Asp\Models\AspGroup','asp_user_groups','user_id','group_id')->withPivot('role');
    }
    public function myGroup(){
        return $this->hasOne('App\Modules\Asp\Models\AspUserGroup','user_id','id');
    }

    public function aspInvation(){
        return $this->hasOne('App\Modules\Asp\Models\AspInvation','asp_user_id','id');
    }
    public function aspCompany(){
        return $this->hasMany('App\Modules\Asp\Models\AspCompany','asp_user_id','id');
    }

    //
    public function getFullNameAttribute(){
        return $this->first_name.' '.$this->last_name;
    }
    public function setPasswordAttribute($pass){
        $this->attributes['password'] = md5($pass);
    }   
    public function isAdmin(){
        return $this->role == 'admin';
    } 
    public function isMod(){
        return $this->role == 'mod';
    }     
    public function isMember(){
        return $this->role == 'member';
    }      
    public function roleName(){
        $roles = static::ROLE_LIST;
        if(!array_key_exists($this->role,$roles)){return null;}
        return $roles[$this->role];
    }
    public function availRole(){
        if($this->role === 'admin'){
            return ['mod'=>'Moderator','member'=>'Member'];
        }
        if($this->role === 'mod'){
            return ['member'=>'Member'];
        }
        if($this->role === 'member'){
            return [];
        }
    }
    public function getCompany($id){
        return $this->aspCompany()->where('id',$id)->first();
    }   
}