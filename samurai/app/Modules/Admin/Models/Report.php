<?php

namespace App\Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
class Report extends Model {

    const STATE_LIST = [0 => "未承認" , 1=> "承認" ];
    protected $table = 'report';
    public $timestamps = false;
    protected $casts = [
    	'created_date'=>'datetime'
    ];
    //
    public function user(){
    	return $this->belongsTo('App\Modules\Admin\Models\User','user_id','id');
    }
    public function userReport(){
    	return $this->belongsTo('App\Modules\Admin\Models\User','report_id','id');
    }
    //
    public function stateName(){
        $states = static::STATE_LIST;
        if(!array_key_exists($this->state,$states)){ return null;}
        return $states[$this->state];
    }
    
}