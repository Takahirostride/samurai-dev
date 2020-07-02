<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserClient extends Model
{
    //
    // protected $fillable = ['image'];
    protected $table = 'users_client_data';
    public $timestamps = false;
    protected $fillable = ['estable_date','capital','regular_number' ,'regular_employee_number','byte_number','byte_employee_number' ,'byte_regular_number','number_over_60'];

}
