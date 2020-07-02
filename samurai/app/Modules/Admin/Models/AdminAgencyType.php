<?php

namespace App\Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
class AdminAgencyType extends Model {

    protected $table = 'admin_agency_type';
    public $timestamps = false;
    //
	static function listAll(){
		return static::pluck('agency_type','id');
	}    
}