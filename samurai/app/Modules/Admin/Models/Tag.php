<?php

namespace App\Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
class Tag extends Model {

    protected $table = 'tags';
    public $timestamps = false;
    protected $dates = [
        'created_at'
    ];    
    //
    static public function listAll(){
        return static::select(['id','tag','order'])->pluck('tag','id');
    }
}