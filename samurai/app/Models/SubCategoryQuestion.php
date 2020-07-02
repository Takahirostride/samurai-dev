<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class SubCategoryQuestion extends Model
{
    //
    protected $table = 'sub_category';

    public function question()
    {
        return $this->hasMany('App\Models\Question');
    }
    public function subcategory()
    {
        return $this->hasMany('App\Models\Subcategory');
    }
    
}
