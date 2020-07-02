<?php

namespace App\Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
class UserCategory extends Model {

    protected $table = 'user_category';
    public $timestamps = false;
    //
	public function category(){
		return $this->belongsTo('App\Modules\Admin\Models\Category','category_id');
	}    
	public function subCategory(){
		return $this->belongsTo('App\Modules\Admin\Models\SubCategory','sub_category_id');
	}    

}