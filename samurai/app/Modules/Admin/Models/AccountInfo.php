<?php

namespace App\Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
class AccountInfo extends Model {

    protected $table = 'account_info';
    public $timestamps = false;
    protected $fillable = ['user_id','bank_name','branch_name','account_type','account_number','account_name'];
    //
    
}