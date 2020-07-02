<?php

namespace App\Modules\Agency\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Policy extends Model {

    const STATUS_LIST = ["公開","未公開","公開不可","掲載終了","削除"];
    const RECOM_BOUNTY=[0=>'',1=>'おすすめの助成金'];
    protected $table = 'policy';
    public $timestamps = false;
    protected $guarded = ['_token'];
    protected $casts = [
        'register_pdf' => 'array',
        'register_pdf1' => 'array',
        'tag' => 'array',
        'acquire_budget'=>'array',
        'business_type'=>'array',
    ];         
    //
    public function tags(){
        return $this->belongsToMany('App\Modules\Agency\Models\Tag','policy_tag','policy_id','tag_id');
    }
    public function trades(){
        return $this->belongsToMany('App\Modules\Agency\Models\Trade','policy_business','policy_id','trade_id');
    }

    public function cat(){
        return $this->belongsToMany('App\Modules\Agency\Models\Category','policy_category','policy_id','category_id');
    }
    public function subCat(){
        return $this->belongsToMany('App\Modules\Agency\Models\SubCategory','policy_category','policy_id','sub_category_id');
    }

    public function provinces(){
        return $this->belongsToMany('App\Modules\Agency\Models\Province','policy_region','policy_id','province_id');
    } 
    public function cities(){
        return $this->belongsToMany('App\Modules\Agency\Models\City','policy_region','policy_id','city_id');
    } 

    public function policyCat(){
        return $this->hasMany('App\Modules\Agency\Models\PolicyCat','policy_id','id');
    }    
    public function policyReg(){
        return $this->hasMany('App\Modules\Agency\Models\PolicyRegion','policy_id','id');
    }
    public function minitry(){
        return $this->belongsTo('App\Modules\Agency\Models\Province','minitry_id','id');
    }
    public function subMinitry(){
        return $this->belongsTo('App\Modules\Agency\Models\City','sub_minitry_id','id');
    }
    //
    public function setAcquireBudgetAttribute($dt){
        $this->attributes['acquire_budget']= json_encode($dt,JSON_UNESCAPED_UNICODE);
    }    

    public function setRegisterPdfAttribute($dt){
        $this->attributes['register_pdf']= json_encode($dt,JSON_UNESCAPED_UNICODE);
    }    
    public function setRegisterPdf1Attribute($dt){
        $this->attributes['register_pdf1']= json_encode($dt,JSON_UNESCAPED_UNICODE);
    }
    public function setUpdateDateAttribute($dt){        
        $n_dt='';
        if(!empty($dt)){
            $n_dt = $dt['year'].'年'.$dt['month'].'月'.$dt['day'].'日';
        }
        $this->attributes['update_date'] = $n_dt;
    }
    public function setSubscriptDurationDetailAttribute($dt){
        $n_dt='';
        if(!empty($dt)){
            $n_dt = $dt['year'].'-'.$dt['month'].'-'.$dt['day'];
        }
        $this->attributes['subscript_duration_detail'] = $n_dt;
    }    
    //
    public function UpdateDateName(){
        if(empty($this->update_date)){ return null;}
        $dt = str_replace(['年','月','日'],['-','-',''],$this->update_date);
        return Carbon::parse($dt)->format('m/d/Y');

    }
    public function updateRegion($rg){
        $data = [];
        if(!empty($rg)){
            foreach($rg as $ite){
                $data[$ite['city']] = ['province_id'=>$ite['province']];
            }
        }
        $this->cities()->sync($data);
        return true;
    }
    public function updateCat($cats){
        $data = [];
        if(!empty($cats)){
            foreach($cats as $ite){
                $sub_dt = array_fill_keys(
                            $ite['sub'],
                            ['category_id'=>$ite['cat']]
                        );
                $data = $data + $sub_dt;
            }
        }
        $this->subCat()->sync($data);
        return true;
    }    
}