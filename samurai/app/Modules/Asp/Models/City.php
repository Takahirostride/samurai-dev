<?php

namespace App\Modules\Asp\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    //
    protected $table = 'cities';
    public function province(){
    	return $this->belongsTo('App\Modules\Asp\Models\Province','province_id','id');
    }
    public function getName(){
    	
    }
}
