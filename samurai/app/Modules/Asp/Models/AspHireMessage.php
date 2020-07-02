<?php

namespace App\Modules\Asp\Models;

use Illuminate\Database\Eloquent\Model;

class AspHireMessage extends Model
{
    //
    protected $table = 'asp_hire_messages';
    protected $fillable = ['asp_client_log_id','hire_id','title','message'];
    public $timestamps = true;
    //
    public function aspClientLog(){
    	return $this->belongsTo('App\Modules\Asp\Models\AspClientLog','asp_client_log_id','id');
    }
}
