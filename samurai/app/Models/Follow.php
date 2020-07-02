<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    //
    protected $table = 'follow';

    public $timestamps = false;
    
    public function user()
    {
    	return $this->beLongsTo('App\Models\User', 'user_id');
    }
    public function agency()
    {
        return $this->beLongsTo('App\Models\User', 'follow_id');
    }
    
}
