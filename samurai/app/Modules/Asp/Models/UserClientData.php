<?php

namespace App\Modules\Asp\Models;

use Illuminate\Database\Eloquent\Model;

class UserClientData extends Model
{
    //
    protected $table = 'users_client_data';
    protected $casts = [
    	'estable_date'=>'date'
    ];
    protected $guarded = ['_token'];
    public $timestamps = false;

}
