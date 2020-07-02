<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class UserBusiness extends Model {

    protected $table = 'user_business';
    public $timestamps = false;
    protected $fillable = ['user_id', 'trade_id']; 
}