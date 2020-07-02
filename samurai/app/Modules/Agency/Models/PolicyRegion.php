<?php

namespace App\Modules\Agency\Models;

use Illuminate\Database\Eloquent\Model;
class PolicyRegion extends Model {

    protected $table = 'policy_region';
    public $timestamps = true;
    //
    public function province(){
    	return $this->belongsTo('App\Modules\Agency\Models\Province','province_id','id');
    }
    public function city(){
    	return $this->belongsTo('App\Modules\Agency\Models\City','city_id','id');
    }

}