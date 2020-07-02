<?php

namespace App\Modules\Asp\Models;

use Illuminate\Database\Eloquent\Model;
class AspGroup extends Model {

	const TYPE_LIST = [
		0 =>  'Normal',
		1 => 'Default'
	];
    const ROLE_LIST = [
        0 =>'Member group',
        1 => 'Manager group'
    ];
    protected $table = 'asp_groups';
    protected $fillable = ['title','mod_id','type'];
    public $timestamps = true;   
    //
    public function member(){
        return $this->belongsToMany('App\Modules\Asp\Models\AspUser','asp_user_groups','group_id','user_id')->withPivot('role');
    }
    public function moderator(){
        return $this->belongsTo('App\Modules\Asp\Models\AspUser','mod_id','id');
    }

}