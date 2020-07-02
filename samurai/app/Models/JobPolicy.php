<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobPolicy extends Model
{
    //
    protected $table = 'job_policy';

    public function from()
    {
    	return $this->belongsTo('App\Models\User', 'from_id');
    }
    public function to()
    {
    	return $this->belongsTo('App\Models\User', 'to_id');
    }
}
