<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlockList extends Model
{
    //
    protected $table = 'block_list';
    public function user()
    {
    	return $this->beLongsTo('App\Models\User', 'user_id');
    }
    public function block()
    {
    	return $this->beLongsTo('App\Models\User', 'block_id');
    }

}
