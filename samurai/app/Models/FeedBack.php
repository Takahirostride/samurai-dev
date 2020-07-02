<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeedBack extends Model
{
    //
    protected $table = 'feedback';
    public function hire()
    {
    	return $this->beLongsTo('App\Models\Hire', 'hire_id');
    }

}
