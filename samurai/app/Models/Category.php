<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Category extends Model
{
    //
    protected $table = 'categories';
    
    public function subcategory()
    {
        return $this->hasMany('App\Models\SubCategory', 'category_id', 'id');
    }
    public function question()
    {
        return $this->hasMany('App\Models\SubCategory', 'category_id', 'id')->where('detail_question','<>','');
    }
}
