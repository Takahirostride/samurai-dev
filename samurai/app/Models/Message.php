<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    protected $table = 'message';

    public function policy()
    {
    	return $this->beLongsTo('App\Models\Policy', 'policy_id');
    }
    public function from()
    {
    	return $this->beLongsTo('App\Models\User', 'from_id');
    }
    public function to()
    {
        return $this->beLongsTo('App\Models\User', 'to_id');
    }
    public function hire()
    {
        return $this->beLongsTo('App\Models\Hire', 'hire_id');
    }
    public function chat_with_user()
    {
        if($this->from_id == session('user_id')) {
            return $this->beLongsTo('App\Models\User', 'to_id');
        }
        return $this->beLongsTo('App\Models\User', 'from_id');
    }
}
