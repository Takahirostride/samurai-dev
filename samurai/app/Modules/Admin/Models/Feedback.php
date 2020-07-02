<?php

namespace App\Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
class Feedback extends Model {

    protected $table = 'feedback';
    public $timestamps = false;
    protected $fillable = ['display'];
    protected $casts = [
    	'created_date'=>'date',
    ];
    //
    public function hire(){
    	return $this->belongsTo('App\Modules\Admin\Models\Hire','hire_id','id');
    }
    public function toUser(){
    	return $this->belongsTo('App\Modules\Admin\Models\User','to_id','id');
    }

    
}