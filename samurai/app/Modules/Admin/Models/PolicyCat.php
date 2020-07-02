<?php

namespace App\Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
class PolicyCat extends Model {

    protected $table = 'policy_category';
    public $timestamps = true;
    //
    public function cat(){
    	return $this->belongsTo('App\Modules\Admin\Models\Category','category_id','id');
    }
    public function subCat(){
    	return $this->belongsTo('App\Modules\Admin\Models\SubCategory','sub_category_id','id');
    }

}