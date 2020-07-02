<?php

namespace App\Modules\Asp\Models;

use Illuminate\Database\Eloquent\Model;
class AspClientLogPolicy extends Model {

	const TYPE_LIST = [
		1 =>  'SendMail',
		2 => 'Print'
	];
    protected $table = 'asp_client_policy';    
    protected $fillable = ['asp_client_log_id','policy_id','type','created_at'];
    protected $casts =[
    	'created_at'=>'datetime',
    ];    
    public $timestamps = false;
    //
    public function policy(){
        return $this->belongsTo('App\Modules\Asp\Models\Policy','policy_id','id');
    }    
    public function aspClientLog(){
        return $this->belongsTo('App\Modules\Asp\Models\AspClientLog','asp_client_log_id','id');
    }    

}