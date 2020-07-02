<?php

namespace App\Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
class AdminSystemNotification extends Model {

    const SOURCE_LIST = ['info@samurai-match.jp'];
    const TOID_LIST = array('2' => '事業者','3'=>'士業', 4=>'すべて');
    protected $table = 'admin_system_notification';
    public $timestamps = false;
    protected $fillable = ['to_id','title','source','item_name','text','created_at'];
    protected $casts =[
        'created_at'=>'datetime'
    ];
}