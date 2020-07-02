<?php

namespace App\Modules\Asp\Models;

use Illuminate\Database\Eloquent\Model;
use Cache;
class Province extends Model
{
    //
    protected $table = 'provinces';
    static public function listOnlProvince(){
        /*$prvs = Cache::rememberForever('samurai_list_provinces',function(){
            $out = static::where('is_ministry','=',0)->pluck('province_name','id');
            return $out;
        });*/
        $prvs = static::where('is_ministry','=',0)->pluck('province_name','id');
        return $prvs;
    }
    static function getIdNationWide(){
        $minute = 24*60;        
        $id = Cache::remember('nation_wide_province_id',$minute,function(){
            $out = static::where('province_name', '全国')->first()->id;
            return $out;
        });
        return $id;        
    }    
}
