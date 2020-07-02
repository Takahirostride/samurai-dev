<?php

namespace App\Modules\Asp\Models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Asp\Models\Policy;
use DB;
class User extends Model
{
    //
    // protected $fillable = ['image'];
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
        'created_at'          => 'date',
    ];
    protected $guarded = ['_token'];
    public $timestamps = false;
    //
    public function clientStatistic(){
        return $this->hasOne('App\Modules\Asp\Models\HireClientStatistic','client_id','id');
    }
    public function aspCompany(){
        $user = auth('asp_user')->user();
        return $this->hasOne('App\Modules\Asp\Models\AspCompany','user_id','id')->where('asp_user_id','=',$user->id);
    }
    public function aspUserLog(){
        $user = auth('asp_user')->user();
        return $this->hasOne('App\Modules\Asp\Models\AspClientLog','user_id','id')->where('asp_user_id','=',$user->id);
    }
    public function follow()
    {
    	return $this->hasMany('App\Modules\Asp\Models\Follow', 'follow_id');
    }
    public function userLocation()
    {
        return $this->hasOne('App\Modules\Asp\Models\UserLocation', 'user_id');
    }
    public function user_agency_type()
    {
        return $this->belongsTo('App\Modules\Asp\Models\AgencyType', 'agency_type_id');
    }
    public function data(){
        return $this->hasOne('App\Modules\Asp\Models\UserClientData', 'user_id');
    }
    public function cats(){
        return $this->belongsToMany('App\Modules\Asp\Models\Category','user_category','user_id','category_id');
    }
    public function subCats(){
        return $this->belongsToMany('App\Modules\Asp\Models\SubCategory','user_category','user_id','sub_category_id');
    }
    public function trade(){
        return $this->belongsToMany('App\Modules\Asp\Models\Trade','user_business','user_id','trade_id');
    }
    public function hireFrom(){
        return $this->hasMany('App\Modules\Asp\Models\Hire','from_id','id');
    } 
    public function hireTo(){
        return $this->hasMany('App\Modules\Asp\Models\Hire','to_id','id');
    } 
    public function loginInfo(){
        return $this->hasOne('App\Modules\Asp\Models\UserLoginInfo','user_id','id');
    }   
    //
    public function scopeJoinRegister($query){
        $user = auth('asp_user')->user();
        return $query->leftJoin('asp_company',function($join)use($user){
                $join->on('users.id','=','asp_company.user_id')
                        ->where('asp_company.asp_user_id','=',$user->id);
            });
    }    
    public function scopeJoinLogin($query){
        return $query->leftJoin('user_login_info','users.id','=','user_login_info.user_id')->groupBy('user_login_info.user_id');
    }  
    public function scopeCountHire($query){
        $sl = ['users.id','users.company_name','users.displayname','users.username','users.phone_number','users.e_mail','users.created_at',
            DB::raw('(SELECT COUNT(*) FROM `hire` WHERE `hire`.`hire_type`=1 AND (`users`.`id` = `hire`.`from_id` OR `users`.`id` = `hire`.`to_id`))as `hire_count`')
        ];
        return $query->select($sl);
    }  
    public function scopeCountHireDoing($query){
        $sl = ['users.id','users.displayname','users.username',
            DB::raw('(SELECT COUNT(*) FROM `hire` WHERE `hire`.`hire_type`=1 AND `hire`.`accept`=1 AND `hire`.`finish_flag`=0 AND (`users`.`id` = `hire`.`from_id` OR `users`.`id` = `hire`.`to_id`))as hire_doing')
        ];
        return $query->select($sl);
    }  

    public function scopePopular($query){
        $user = auth('asp_user')->user();
        $sl = ['users.id','users.company_name','users.displayname','users.username','users.phone_number','users.e_mail','users.created_at',
        ];
        $cnd = [
            ['manage_flag','=',0],
        ];
        return $query->with([
            'data',
            'clientStatistic',
            'userLocation'=>function($qr){
                $qr->with(['province','city']);
            }

        ])
        ->select($sl)
        ->where($cnd)
        ->whereHas('aspCompany',function($qr)use($user){
            $qr->where('asp_user_id','=',$user->id);
        });
    }
    public function scopeInformation($query){
        $sl = ['id','company_name','phone_number','e_mail','created_at',
            'street_building_name','fax',
            DB::raw('(SELECT COUNT(*) FROM `hire` WHERE (`users`.`id` = `hire`.`from_id` OR `users`.`id` = `hire`.`to_id`))as hire_count'),
            DB::raw('(SELECT COUNT(*) FROM `hire` WHERE `hire`.`hire_type`=1 WHERE `hire`.`accept`=1 WHERE `hire`.`finish_flag`=0 AND (`users`.`id` = `hire`.`from_id` OR `users`.`id` = `hire`.`to_id`))as hire_doing')
        ];
        return $query->with([
            'aspUserLog',
            'userLocation'=>function($qr){
                $qr->with(['province','city']);
            }

        ])
        ->select($sl);
    }    
    public function scopeSumary($query){
        $sl = ['id','company_name','phone_number','e_mail','created_at'
        ];
        $cnd = [
            ['manage_flag','=',0],
        ];
        return $query->with([
            'userLocation'=>function($qr){
                $qr->with(['province','city']);
            }

        ])
        ->select($sl)->where($cnd);
    }    
    //
    public function addressName(){
        $out='';
        if($this->userLocation){
            $out.= $this->userLocation->provinceName();
            $out .= $this->userLocation->cityName();
        }
        $out .= $this->street_building_name;
        return $out;
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
    public function userName()
    {
        if($this->displayname == '') return $this->username;
        return $this->displayname;
    } 
    public function countRecommend(){
        if(!$this->userLocation && !$this->data){
            return 0;
        }
        if(empty($this->userLocation->province_id) && empty($this->userLocation->city_id)){
            return 0;
        }
        $results = Policy::recommend($this)->count();
        return $results;                            
    }   
}

