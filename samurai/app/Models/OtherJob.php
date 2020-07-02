<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OtherJob extends Model
{
    //
    protected $table = 'other_job_policy';

    public function from()
    {
    	return $this->belongsTo('App\Models\User', 'from_id');
    }
    public function job_policy()
    {
        return $this->hasMany('App\Models\JobPolicy', 'other_job_id');
    }
    public function budget_format()
    {
        return config('site_config')['client_budget_list'][@$this->budget];
    }
    public function deli_date()
    {
        return $this->deli_date;
    }
}
