<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserTag extends Model
{
    //
    // protected $fillable = ['image'];
    protected $table = 'user_pro_part';

    protected $fillable = ['user_id', 'tag_id']; 
    public $timestamps = false;
}
