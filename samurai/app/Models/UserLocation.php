<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLocation extends Model
{
    //
    // protected $fillable = ['image'];
    protected $table = 'user_location';

    public function province()
    {
    	return $this->beLongsTo('App\Models\Province', 'province_id');
    }
    public function city()
    {
        return $this->beLongsTo('App\Models\City', 'city_id');
    }
    public function user_province()
    {
        if(@$this->province_id == 0) return $this->province_name;
        return $this->province->province_name;
    }
    public function user_city()
    {
        if(@$this->city_id == 0) return $this->city_name;
        return $this->city->city_name;
    }
}
