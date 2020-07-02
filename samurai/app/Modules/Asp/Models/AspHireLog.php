<?php

namespace App\Modules\Asp\Models;

use Illuminate\Database\Eloquent\Model;

class AspHireLog extends Model
{
    //
    protected $table = 'asp_hire_logs';
    protected $fillable = ['asp_user_id','hire_id','is_printed','is_send','favorite'];
    public $timestamps = true;
    //
    public function aspUser(){
    	return $this->belongsTo('App\Modules\Asp\Models\AspUser','asp_user_id','id');
    }
    public function hire(){
    	return $this->belongsTo('App\Modules\Asp\Models\Hire','hire_id','id');
    }
}
