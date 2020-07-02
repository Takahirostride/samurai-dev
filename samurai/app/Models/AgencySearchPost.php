<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class AgencySearchPost extends Model
{
    //
    protected $table = 'agency_search_post';

    public function user()
    {
        return $this->beLongsTo('App\Models\User', 'user_id');
    }
    public function post()
    {
        return $this->beLongsTo('App\Models\Post', 'post_id');
    }
    
}
