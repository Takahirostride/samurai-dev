<?php

namespace App\Modules\Asp\Models;

use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    //
    protected $table = 'trades';
    static public function listAll(){
        return static::select(['id','trade','order'])->orderBy('order','asc')->pluck('trade','id');
    }
}
