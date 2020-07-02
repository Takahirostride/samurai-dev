<?php

namespace App\Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Cache;
class Province extends Model {
    
    protected static function boot(){
        parent::boot();
        static::saving(function($user){
            Cache::forget('samurai_provinces');
            Cache::forget('samurai_list_provinces');
            Cache::forget('samurai_list_provinces_all');
            Cache::forget('samurai_province_minitries');
        });
        static::deleting(function($user){
            Cache::forget('samurai_provinces');
            Cache::forget('samurai_list_provinces');
            Cache::forget('samurai_list_provinces_all');
            Cache::forget('samurai_province_minitries');
        });

    }
    protected $table = 'provinces';
    public $timestamps = false;
    //
    public function cities(){
    	return $this->hasMany('App\Modules\Admin\Models\City','province_id','id');
    }
    //
    static public function listProvince(){       
       //$prvs = Cache::rememberForever('samurai_provinces',function(){
            $cnd = [
                ['is_ministry','=',0]
            ];
            $qur = static::with(['cities'])->where($cnd)->orderBy('order_by','desc')->get();
            $out = [];
            foreach($qur as $key=>$ite){
                $out[]=[
                    'id'=>$ite->id,
                    'ite_name'=>$ite->province_name,
                    'children'=>$ite->cities->pluck('city_name','id')->toArray()
                ];
            }
            return $out; 
        //});
        //return $prvs;    	
    }
    static public function listProvinceMinitry(){       
       //$prvs = Cache::rememberForever('samurai_province_minitries',function(){
            $qur = static::with(['cities'])->orderBy('order_by','desc')->get();
            $out = [];
            foreach($qur as $key=>$ite){
                $out[]=[
                    'id'=>$ite->id,
                    'ite_name'=>$ite->province_name,
                    'children'=>$ite->cities->pluck('city_name','id')->toArray()
                ];
            }
            return $out; 
        //});
        //return $prvs;       
    }    
    static public function listOnlProvince(){
        //$prvs = Cache::rememberForever('samurai_list_provinces',function(){
            $out = static::where('is_ministry','=',0)->orderBy('order_by','desc')->pluck('province_name','id');
            return $out;
        //});
        //return $prvs;
    }
    static public function listAllProvince(){
        //$prvs = Cache::rememberForever('samurai_list_provinces_all',function(){
            $out = static::where('is_ministry', 0)->orderBy('is_ministry', 'asc')->orderBy('order_by', 'desc')->orderBy('id', 'asc')->pluck('province_name','id');
            return $out;
        //});
        //return $prvs;
    }    

}