<?php

namespace App\Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    //
    protected $table = 'user_address';

    public function province()
    {
        return $this->beLongsTo('App\Modules\Admin\Models\Province', 'province_id');
    }
    public function city()
    {
        return $this->beLongsTo('App\Modules\Admin\Models\City', 'city_id');
    }
    public function provinceName()
    {
        if(@$this->province_id == 0) return $this->province_name;
        return $this->province->province_name;
    }
    public function cityName()
    {
        if(@$this->city_id == 0) return $this->city_name;
        return $this->city->city_name;
    }
}
