<?php

namespace App\Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Cache;
class Trade extends Model {
    protected static function boot(){
        parent::boot();
        static::saving(function($user){
            Cache::forget('samurai_list_trade_display');
        });
        static::deleting(function($user){
            Cache::forget('samurai_list_trade_display');
        });

    }
    protected $table = 'trades';
    public $timestamps = false;
    protected $dates = [
        'created_at'
    ];    
    //
    static public function listAll(){
        return static::select(['id','trade','order'])->orderBy('order','asc')->pluck('trade','id');
    }
    static public function listAllDisplay(){
        $values = Cache::rememberForever('samurai_list_trade_display',function(){
            $out = static::select(['id','trade','order'])->where('display',1)->orderBy('order','asc')->pluck('trade','id');
            return $out;
        });
        return $values;
    }

}