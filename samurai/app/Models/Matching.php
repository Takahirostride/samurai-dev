<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matching extends Model
{
    //
    protected $table = 'matching';
    public $timestamps = false;
    protected $fillable = ['from_id','to_id', 'end_date','deposit_money'];
    public function policy()
    {
    	return $this->beLongsTo('App\Models\Policy', 'to_id');
    }
    public function user()
    {
    	return $this->beLongsTo('App\Models\User', 'from_id');
    }
}
