<?php

namespace App\Modules\Asp\Models;

use Illuminate\Database\Eloquent\Model;

class AspPolicyLog extends Model
{
    //
    protected $table = 'asp_policy_logs';
    protected $fillable=['policy_id','asp_user_id','favorite','is_send','is_print','created_at'];
    public $timestamps = false;
    protected $casts =[
        'favorite'=>'boolean',
        'is_send'=>'boolean',
    	'is_print'=>'boolean',
    	'created_at'=>'datetime',
    ];
    public function policy(){
        return $this->belongsTo('App\Modules\Asp\Models\Policy','policy_id','id');
    }
}
