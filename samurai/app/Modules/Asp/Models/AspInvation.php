<?php

namespace App\Modules\Asp\Models;

use Illuminate\Database\Eloquent\Model;

class AspInvation extends Model
{
    //
    protected $table = 'asp_invations';
    protected $fillable=['asp_user_id','title','message'];
    public $timestamps = true;
}
