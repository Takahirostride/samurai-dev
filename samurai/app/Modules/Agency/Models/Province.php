<?php

namespace App\Modules\Agency\Models;

use Illuminate\Database\Eloquent\Model;
use Cache;
class Province extends Model {
    
    protected $table = 'provinces';
    public $timestamps = false;
    //
    public function cities(){
    	return $this->hasMany('App\Modules\Agency\Models\City','province_id','id');
    }
    static public function listProvince(){
       $prvs = Cache::rememberForever('samurai_provinces',function(){
	    	$cnd = [
	    		['is_ministry','=',0]
	    	];
	    	$qur = static::with(['cities'])->where($cnd)->get();
	    	$out = [];
	    	foreach($qur as $key=>$ite){
	    		$out[$ite->id]=[
	    			'ite_name'=>$ite->province_name,
	    			'children'=>$ite->cities->pluck('city_name','id')->toArray()
	    		];
	    	}
	    	return $out;
        });
        return $prvs;    	
    }    
}