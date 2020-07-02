<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserViewPolicy extends Model
{
    //
    // protected $fillable = ['image'];
    protected $table = 'user_viewed_policy';

    public function policy()
    {
    	return $this->belongsTo('App\Models\Policy');
    }

}

