<?php

namespace App\Modules\Asp\Models;

use Illuminate\Database\Eloquent\Model;
class AspSignature extends Model
{
    //
    protected $table = 'asp_signatures';
    protected $guarded = ['_token','sgl_image','prev_link'];
}
