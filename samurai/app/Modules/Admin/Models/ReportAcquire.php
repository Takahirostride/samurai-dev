<?php

namespace App\Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
class ReportAcquire extends Model {

    protected $table = 'report_acquire';
    public $timestamps = false;
    //
    public function hire(){
    	return $this->belongsTo('App\Modules\Admin\Models\Hire','hire_id','id');
    }
}