<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    //
    // protected $fillable = ['image'];
    protected $table = 'user_address';

    protected $fillable = ['user_id', 'province_id', 'city_id', 'address_type']; 
    public $timestamps = false;

    public function province()
    {
        return $this->beLongsTo('App\Modules\Admin\Models\Province', 'province_id');
    }
    public function city()
    {
        return $this->beLongsTo('App\Modules\Admin\Models\City', 'city_id');
    }
}
