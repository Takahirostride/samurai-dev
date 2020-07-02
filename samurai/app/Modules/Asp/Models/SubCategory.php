<?php

namespace App\Modules\Asp\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class SubCategory extends Model
{
    //
    protected $table = 'sub_category';

    public function question()
    {
        return $this->belongsToMany('App\Modules\Asp\Models\Question');
    }
    public function category()
    {
        return $this->belongsTo('App\Modules\Asp\Models\Category');
    }
}
