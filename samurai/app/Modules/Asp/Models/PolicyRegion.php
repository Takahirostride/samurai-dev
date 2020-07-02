<?php

namespace App\Modules\Asp\Models;

use Illuminate\Database\Eloquent\Model;
class PolicyRegion extends Model {

    protected $table = 'policy_region';
    public $timestamps = true;
    //
    public function province(){
    	return $this->belongsTo('App\Modules\Asp\Models\Province','province_id','id');
    }
    public function city(){
    	return $this->belongsTo('App\Modules\Asp\Models\City','city_id','id');
    }
    //
    public function regionName(){
    	$out = '';
    	if($this->province){
    		$out .= $this->province->province_name;
    	}
    	if($this->city){
    		$out .= ' '.$this->city->city_name;
    	}

    	return $out;
    }

}