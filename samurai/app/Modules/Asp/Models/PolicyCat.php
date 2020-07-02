<?php

namespace App\Modules\Asp\Models;

use Illuminate\Database\Eloquent\Model;
class PolicyCat extends Model {

    protected $table = 'policy_category';
    public $timestamps = true;
    //
    public function cat(){
    	return $this->belongsTo('App\Modules\Asp\Models\Category','category_id','id');
    }
    public function subCat(){
    	return $this->belongsTo('App\Modules\Asp\Models\SubCategory','sub_category_id','id');
    }

}