<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkSet extends Model
{
    
    protected $table = 'work_set';
 
    public $timestamps = false;

    public function work_set_sub()
    {
    	return $this->hasMany('App\Models\WorkSetSub', 'work_set_id');
    }
    public function user()
    {
    	return $this->belongsTo('App\Models\User', 'user_id');
    }
    public function hire()
    {
        return $this->belongsTo('App\Models\Hire', 'hire_id');
    }
    public function schedule_text()
    {
        return ddate_string($this->schedule);
    }
    public function getFileLink(){
        if(empty($this->file_path)){ return false;}
        $link = str_replace("AND&","/",$this->file_path);
        $file = asset($link); 
        return $file;         
    }
}
