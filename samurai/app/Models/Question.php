<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Question extends Model
{
    //
    protected $table = 'question';
    
    public function subcategory()
    {
        return $this->belongsToMany('App\Models\Subcategory');
    }
}
