<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //
    protected $fillable = ['image'];
    protected $table = 'users';

    protected $casts = [
        'category'          => 'array',
        'category_detail'   => 'array',
        'acquire_budget'    => 'array',
        'address1'          => 'array',
        'address2'          => 'array',
        'set_cost'          => 'array',
        'business_type'     => 'array',
        'pro_part'          => 'array',
    ];

    public function follow()
    {
    	return $this->hasMany('App\Models\Follow', 'follow_id');
    }
    public function checkFollow()
    {
    	if(!count($this->follow)) return false;
    	foreach($this->follow as $val)
    	{
    		if($val->user_id == session('user_id')) return true;
    	}
    	return false;
    }
    public function user_name()
    {
        if($this->displayname == '') return $this->username;
        return $this->displayname;
    }
    public function user_location()
    {
        return $this->hasOne('App\Models\UserLocation', 'user_id');
    }
    public function user_agency_type()
    {
        return $this->beLongsTo('App\Models\AgencyType', 'agency_type_id');
    }
    public function user_client()
    {
        return $this->hasOne('App\Models\UserClient', 'user_id');
    }
    public function user_avatar_name()
    {
        if(!$this->image) return '';
        return str_replace('assets/photo/', '', $this->image);

    }
    public function user_business(){
        return $this->hasMany('App\Models\UserBusiness','user_id');
    }
    public function cat(){
        return $this->belongsToMany('App\Models\Category','user_category','user_id','category_id');
    }
    public function subCat(){
        return $this->belongsToMany('App\Models\SubCategory','user_category','user_id','sub_category_id');
    }
    public function user_address()
    {
        return $this->hasMany('App\Models\UserAddress', 'user_id');
    }
    
}

