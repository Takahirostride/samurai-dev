<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MatchingUser extends Model
{
    //
    protected $table = 'matching_users';
    protected $fillable = ['user_id','policy_id','order_type','user_type'];
    public $timestamps = false;
    public function user()
    {
    	return $this->beLongsTo('App\Models\User', 'user_id');
    }
    public function policy()
    {
    	return $this->beLongsTo('App\Models\Policy', 'policy_id');
    }
    public function post(){
		return $this->beLongsTo('App\Models\Post','user_id','user_id')->where('policy_id','=',$this->policy_id);
	}
}
