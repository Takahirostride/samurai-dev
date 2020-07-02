<?php

namespace App\Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Cache;
class Address extends Model {

    protected $table = 'address';
    public $timestamps = false;
    protected static function boot(){
        parent::boot();
        static::saving(function($user){
            Cache::forget('samurai_address');
        });
        static::deleting(function($user){
            Cache::forget('samurai_address');
        });

    }    
    //
    static function provinceCity(){
        $cities = Cache::rememberForever('samurai_address',function(){
            $cts = static::select(
                DB::raw("GROUP_CONCAT(city ORDER BY city ASC SEPARATOR '|') AS citys"),
                'province'
                )->groupBy('province')->orderBy('province','asc')->pluck('citys','province');
            $out = $cts->map(function($ite){
                return explode('|',$ite);
            });
            return $out->toArray();
        });
        return $cities;
    }
}