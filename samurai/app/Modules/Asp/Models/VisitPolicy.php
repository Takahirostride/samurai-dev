<?php

namespace App\Modules\Asp\Models;

use Illuminate\Database\Eloquent\Model;

class VisitPolicy extends Model
{
    //
    protected $table = 'visit_policy';
    //
    public function policy(){
        return $this->belongsTo('App\Modules\Asp\Models\Policy','policy_id');
    }     
}
