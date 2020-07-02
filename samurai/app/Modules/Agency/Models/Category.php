<?php

namespace App\Modules\Agency\Models;

use Illuminate\Database\Eloquent\Model;
class Category extends Model {

    protected $table = 'categories';
    public $timestamps = false;
    //
    public function children(){
    	return $this->hasMany('App\Modules\Agency\Models\SubCategory','category_id','id');
    }    
}