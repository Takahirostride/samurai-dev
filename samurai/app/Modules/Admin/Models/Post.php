<?php

namespace App\Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
class Post extends Model {
	const DISPLAY_LIST = [0=>"掲載不可",1=>'掲載不可解除',2=>"掲載中"];
    const MAIN_POINT_LIST = ["・予算","・納期","・クオリティ","・柔軟な対応","・こまめな連絡","・業務経験・知識","・実績評価","・認証状況","・その他"];
    protected $table = 'post';
    public $timestamps = false;
    protected $fillable = ['display'];
    protected $dates = [
        'post_date','submit_date','complete_date'
    ];    
    protected $casts = [
        'main_point' => 'array',
        'sub_content' => 'array',
        'file' => 'array',
        'other_money_sub'=>'array',
        'pay_option'=>'array',
    ];     
    //
    public function policy(){
        return $this->belongsTo('App\Modules\Admin\Models\Policy','policy_id','id');
    }
    public function user(){
    	return $this->belongsTo('App\Modules\Admin\Models\User','user_id','id');
    }

    //
    public function displayName(){
    	$dis = static::DISPLAY_LIST;
    	$dt = $this->display;
    	if(!array_key_exists($dt,$dis)){return null;}
    	return $dis[$dt];
    }
    public function mainPointName(){
        if(!is_array($this->main_point)){return null;}
        $out = array_intersect_key(static::MAIN_POINT_LIST,array_flip($this->main_point));
        return implode(' ',$out);
    }
    public function documentBusinessTypeName(){
        return $this->document_business_type==0 ? '円' : '%';
    }
    public function requestBusinessTypeName(){
        return $this->request_business_type==0 ? '円' : '%';
    }

}