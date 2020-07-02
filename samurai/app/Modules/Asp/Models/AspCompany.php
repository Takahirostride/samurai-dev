<?php

namespace App\Modules\Asp\Models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Asp\Models\Policy;
use DB;
class AspCompany extends Model
{
    //
    protected $table = 'asp_company';
    protected $fillable=['name','email','province_id','other_province','city_id','other_city','street_address','apartment','establish_at','capital','staff_number','user_id','asp_user_id','is_register','sended_at','favorite'];
    protected $casts = [
        'sended_at'=>'datetime'
    ];
    public $timestamps = true;
    //
    public function clientStatistic(){
        return $this->hasOne('App\Modules\Asp\Models\HireClientStatistic','client_id','user_id');
    }
    public function clientLog(){
        return $this->hasMany('App\Modules\Asp\Models\HireClientLog','client_id','user_id');
    }    
    public function trade(){
        return $this->belongsToMany('App\Modules\Asp\Models\Trade','asp_company_trades','company_id','trade_id');
    }
    public function province(){
        return $this->belongsTo('App\Modules\Asp\Models\Province','province_id','id');
    }
    public function policyRegOne()
    {
        return $this->hasOne('App\Modules\Asp\Models\PolicyRegion', 'province_id','province_id');
    }     
    public function city(){
        return $this->belongsTo('App\Modules\Asp\Models\City','city_id','id');
    }
    public function user(){
        return $this->belongsTo('App\Modules\Asp\Models\User','user_id','id');
    }
    public function aspUser(){
        return $this->belongsTo('App\Modules\Asp\Models\AspUser','asp_user_id','id');
    }
    public function loginInfo(){
        return $this->hasOne('App\Modules\Asp\Models\UserLoginInfo','user_id','user_id');
    }     
    //
    public function scopeCountHire($query){
        $sl = ['asp_company.*',
        ];
        return $query->with([
            'user'=>function($user){
                $user->popular();
            }
        ])->select($sl);
    }  
    public function scopeJoinLogin($query){
        return $query->leftJoin('user_login_info','asp_company.user_id','=','user_login_info.user_id')->groupBy('user_login_info.user_id');
    }
    public function scopeRecommend($query,$policy){  
        $p_region = $policy->policyReg;
        $cap_start = empty($policy->capital_start) ? 0 : $policy->capital_start/1000;
        $cap_end = empty($policy->capital_end) ? 9999999999 : $policy->capital_end/1000;
        $e_start = empty($policy->employees_count_start) ? 0 : $policy->employees_count_start;
        $e_end = empty($policy->employees_count_end) ? 9999999999 : $policy->employees_count_end;
        $y_start = empty($policy->founding_year_start) || $policy->founding_year_start < 1000 || $policy->founding_year_start > 3000 ? '0000-00-00' : $policy->founding_year_start.'-00-00';
        $y_end = empty($policy->founding_year_end) || $policy->founding_year_end < 1000 || $policy->founding_year_end > 3000? '3000-12-31' : $policy->founding_year_end.'-12-31';
        $user_id = auth('asp_user')->user()->id;
        $query = $query->where('asp_user_id','=', $user_id);
        if(!$p_region->isEmpty()){                         
            $toan_quoc = Province::getIdNationWide();
            if(!$p_region->isEmpty() && !$p_region->contains('province_id',$toan_quoc)){
                $query = $query->where(function($m_query)use($p_region){
                    foreach($p_region as $rg){
                        $m_query = $m_query->orWhere(function($qr)use($rg){
                            $cnd = [];
                            $cnd[] = ['province_id','=',$rg->province_id];
                            if($rg->city && $rg->city->city_name != 'すべて'){
                                $cnd[] = ['city_id','=',$rg->city_id];
                            }
                            $qr->where($cnd);
                        });
                        $m_query = $m_query->orWhere(function($qr)use($rg){
                            $cnd = [];
                            $cnd[] = ['province_id','=',$rg->province_id];
                            $cnd[] = ['city_id','=',0];
                            $qr->where($cnd);
                        });
                        return $m_query;    
                    }                    
                });

            }
        }
        $cnd = [];
        if($cap_start < $cap_end){
            $cnd[] = ['capital','>=',$cap_start];
            $cnd[]=['capital','<=',$cap_end];
        }
        if($e_start < $e_end){
            $cnd[]=['staff_number','>=',$e_start];
            $cnd[]= ['staff_number','<=',$e_end];
        }
        if(!empty($cnd)){
            $query = $query->where($cnd);
        }  
        if($y_start < $y_end){
            $query = $query->where(function($qr)use($y_start,$y_end){
                $qr->where([
                    ['establish_at','>=',$y_start],
                    ['establish_at','<=',$y_end],  
                ])->orWhereNull('establish_at');
            });            
        }             
        return $query;   
    }
    //
    public function countRecommend(){
        if($this->province_id || $this->establish_at ||  $this->capital || $this->staff_number){
            $results = Policy::recommend($this)->count();
            return $results;
        }
        return 0;                            
    }     
    public function userName(){
        return $this->name;
    }      
    public function getCityName(){
        if(!empty($this->city)){
            return $this->city->city_name;
        }
        if($this->province){
            return 'すべて';
        }
        return $this->other_city;
    }
}
