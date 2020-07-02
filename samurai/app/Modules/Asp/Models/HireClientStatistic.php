<?php

namespace App\Modules\Asp\Models;

use Illuminate\Database\Eloquent\Model;
class HireClientStatistic extends Model {

    protected $table = 'hire_client_statistics';
    protected $guarded = ['_token'];
    public $timestamps = false;
    //
    public function client(){
    	return $this->hasOne('App\Modules\Asp\Models\User','client_id','id');
    }
    //
    public function getDoing(){
    	return max(0,($this->accept - $this->finish));
    }
}