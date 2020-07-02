<?php

namespace App\Modules\Asp\Models;

use Illuminate\Database\Eloquent\Model;

class CheckListPolicyUser extends Model
{
    //
    protected $table = 'checklist_policy_user';
    //
    public function policy(){
        return $this->belongsTo('App\Modules\Asp\Models\Policy','policy_id');
    }   
    public function user()
    {
    	return $this->beLongsTo('App\Modules\Asp\Models\User', 'user_id');
    }      
}
