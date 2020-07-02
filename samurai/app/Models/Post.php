<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Post extends Model
{
    //
    protected $table = 'post';
    protected $guarded = ['_token'];
    public $timestamps = false;
    public function user()
    {
        return $this->beLongsTo('App\Models\User', 'user_id');
    }
    public function policy()
    {
        return $this->beLongsTo('App\Models\Policy', 'policy_id');
    }   
    public function hire()
    {
        return $this->hasMany('App\Models\Hire', 'policy_id', 'policy_id');
    }  
    
}
