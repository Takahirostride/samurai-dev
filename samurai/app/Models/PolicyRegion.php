<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PolicyRegion extends Model
{
    //
    protected $table = 'policy_region';

    public function province()
    {
    	return $this->belongsTo('App\Models\Province', 'province_id');
    }
    public function city()
    {
        return $this->belongsTo('App\Models\City', 'city_id');
    }
}
