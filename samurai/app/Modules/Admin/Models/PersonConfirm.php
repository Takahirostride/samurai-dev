<?php

namespace App\Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
class PersonConfirm extends Model {

    protected $table = 'person_confirm';
    protected $fillable = ['allow','state','update_at'];
    protected $casts = [
    	'files'=>'array'
    ];
    public $timestamps = false;
    //
    public function user(){
    	return $this->belongsTo('App\Modules\Admin\Models\User','user_id','id');
    }
}