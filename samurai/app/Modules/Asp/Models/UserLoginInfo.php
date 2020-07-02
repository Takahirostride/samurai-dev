<?php

namespace App\Modules\Asp\Models;

use Illuminate\Database\Eloquent\Model;

class UserLoginInfo extends Model
{
    //
    protected $table = 'user_login_info';
    protected $casts=[
    	'login_day'=>'date'
    ];
    //
    public function user(){
    	return $this->hasOne('App\Modules\Asp\Models\User','id','user_id');
    }
    public function aspUserLog(){
    	return $this->hasMany('App\Modules\Asp\Models\AspClientLog','user_id','user_id');
    }
    
}
