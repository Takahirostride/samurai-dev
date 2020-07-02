<?php

namespace App\Modules\Asp\Models;

use Illuminate\Database\Eloquent\Model;

class UserLocation extends Model
{
    //
    // protected $fillable = ['image'];
    protected $table = 'user_location';
    protected $guarded = ['_token'];
    public $timestamps = false;
    public function province()
    {
    	return $this->beLongsTo('App\Modules\Asp\Models\Province', 'province_id');
    }
    public function city()
    {
        return $this->beLongsTo('App\Modules\Asp\Models\City', 'city_id');
    }
    public function provinceName()
    {
        if(@$this->province_id == 0) return $this->province_name;
        $prv = $this->province;
        if(!$prv){ return null;}
        return $prv->province_name;
    }
    public function cityName()
    {
        if(@$this->city_id == 0) return $this->city_name;
        $city = $this->city;
        if(!$city){ return null;}
        return $city->city_name;
    }
}
