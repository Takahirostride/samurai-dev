<?php

namespace App\Modules\Admin\Models;

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
    protected $dates = [
        'created_date'
    ];       
    //
    public function tags(){
        return $this->belongsToMany('App\Modules\Admin\Models\Tag','policy_tag','policy_id','tag_id');
    }
    public function trades(){
        return $this->belongsToMany('App\Modules\Admin\Models\Trade','policy_business','policy_id','trade_id');
    }

    public function cat(){
        return $this->belongsToMany('App\Modules\Admin\Models\Category','policy_category','policy_id','category_id');
    }
    public function subCat(){
        return $this->belongsToMany('App\Modules\Admin\Models\SubCategory','policy_category','policy_id','sub_category_id');
    }

    public function provinces(){
        return $this->belongsToMany('App\Modules\Admin\Models\Province','policy_region','policy_id','province_id');
    } 
    public function cities(){
        return $this->belongsToMany('App\Modules\Admin\Models\City','policy_region','policy_id','city_id');
    } 

    public function policyCat(){
        return $this->hasMany('App\Modules\Admin\Models\PolicyCat','policy_id','id');
    }    
    public function policyReg(){
        return $this->hasMany('App\Modules\Admin\Models\PolicyRegion','policy_id','id');
    }
    public function minitry(){
        return $this->belongsTo('App\Modules\Admin\Models\Province','minitry_id','id');
    }
    public function subMinitry(){
        return $this->belongsTo('App\Modules\Admin\Models\City','sub_minitry_id','id');
    }
    //
    public function setBusinessTypeAttribute($dt){
        $this->attributes['business_type']= json_encode($dt,JSON_UNESCAPED_UNICODE);
    }
    public function setAcquireBudgetAttribute($dt){
        $this->attributes['acquire_budget']= json_encode($dt,JSON_UNESCAPED_UNICODE);
    }    
    public function setTagAttribute($dt){
        $this->attributes['tag']= json_encode($dt,JSON_UNESCAPED_UNICODE);
    }

    public function setRegisterPdfAttribute($dt){
        $this->attributes['register_pdf']= json_encode($dt,JSON_UNESCAPED_UNICODE);
    }    
    public function setRegisterPdf1Attribute($dt){
        $this->attributes['register_pdf1']= json_encode($dt,JSON_UNESCAPED_UNICODE);
    }
/*    public function setSubscriptDurationDetailAttribute($dt){        
        if(is_array($dt)){
            $value_ar = array_merge(['year'=>'','month'=>'','day'=>''],$dt);
            $value = "{$value_ar['year']}-{$value_ar['month']}-{$value_ar['day']}";
        }else{
           $value = empty($dt)?'':Carbon::createFromFormat('m/d/Y',$dt)->format('Y-m-d'); 
        }
        
        $this->attributes['subscript_duration_detail'] = $value;
    }*/    
    public function getSubscriptDurationDetailAttribute($dt){
        if(empty($dt) || $dt==='0000-00-00'){ return null;}
        return Carbon::parse($dt);
    }
    public function getNormalFlagAttribute(){
        return $this->display_option == 2 ? false : true;
    }
    public function getCustomerFlagAttribute(){
        return in_array($this->display_option,[1,2]) ? true : false;
    }

    //
    public function UpdateDateName(){
        if(empty($this->update_date)){ return null;}
        $dt = str_replace(['年','月','日'],['-','-',''],$this->update_date);
        return Carbon::parse($dt)->format('Y-m-d');

    }
    public function updateRegion($rg){
        $data = [];
        if(!empty($rg)){
            foreach($rg as $ite){
                $city = empty($ite['city']) ? 0 : $ite['city'];
                $data[$ite['province']] = ['city_id'=>$city];
            }
        }
        $this->provinces()->sync($data);
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

    //
    public function acquireBudgetName(){
    	$bd = $this->acquire_budget;
    	if(empty($bd)){return null;}
    	if(!is_array($bd)){$bd = json_decode($bd,true);}
    	$amounts = config('policy.amount_list');
    	$out = array_intersect_key($amounts, array_flip($bd));
    	return implode(',',$out);
    }
    public function statusName(){
        $status = static::STATUS_LIST;
        if(!is_numeric($this->publication_setting)){ return null;}
        $stt = (int)$this->publication_setting;
        if(!array_key_exists($stt,$status)){return null;}
        return $status[$stt];
    }
    public function recomBountyName(){
        $recom = empty($this->recom_bounty) ? 0 : 1;
        return static::RECOM_BOUNTY[$recom];
    }
    public function categoryName(){
        if(!$this->cat){ return null;}
        $cats = $this->cat->unique('id')->values();
        return $cats->implode('category_name','');
    }
    public function regionName(){
        if(!$this->provinces){ return null;}
        return $this->provinces->implode('province_name',',');
    
    }    
    public function companyName(){
        $out ='';
        if($this->minitry){
            $out .= $this->minitry->province_name;
        }
        if($this->subMinitry){
            $out .= $this->subMinitry->city_name;
        }
        return $out;
    }     
}