<?php

namespace App\Modules\Agency\Models;

use Illuminate\Database\Eloquent\Model;
class Trade extends Model {

    protected $table = 'trades';
    public $timestamps = false;
    protected $dates = [
        'created_at'
    ];    
    //
    static public function listAll(){
        return static::select(['id','trade','order'])->orderBy('order','asc')->pluck('trade','id');
    }
}