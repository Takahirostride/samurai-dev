<?php

namespace App\Modules\Asp\Models;

use Illuminate\Database\Eloquent\Model;

class AspRegisterClientPolicy extends Model
{
	protected $table = 'asp_register_client_policy';    
    protected $guarded = ['_token'];	
    public $timestamps = true;
    //
    public function policy(){
        return $this->belongsTo('App\Modules\Asp\Models\Policy','policy_id','id');
    }
}