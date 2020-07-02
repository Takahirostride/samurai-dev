<?php

namespace App\Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
class ReportAdmin extends Model {

    protected $table = 'report_admin';
    public $timestamps = true;
    protected $fillable = ['admin_id','user_id','message'];
    //

    
}