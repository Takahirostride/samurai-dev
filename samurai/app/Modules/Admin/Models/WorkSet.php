<?php

namespace App\Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
class WorkSet extends Model {

    protected $table = 'work_set';
    public $timestamps = false;
    protected $dates = [
    ];    
    //
    public function hire(){
    	return $this->belongsTo('App\Modules\Admin\Models\Hire','hire_id','id');
    }
    public function user(){
    	return $this->belongsTo('App\Modules\Admin\Models\User','user_id','id');
    }
    public function workSub(){
        return $this->hasMany('App\Modules\Admin\Models\WorkSetSub','work_set_id','id');
    }
    //
    public function scopeSummary($qr){
        $sl = ['id','user_id','hire_id','schedule','complete_flag','performer2','performer3','work_content','work_content_other_value','work_content_other','file_name','file_ext','file_path'];
        return $qr->select($sl);
    }
    //
    public function getFilePath(){
        return ol_get_link_file($this->file_path);       
    }
    public function getFileLink(){
        if(empty($this->file_path)){ return false;}
        $link = str_replace("AND&","/",$this->file_path);
        $file = asset($link); 
        return $file;         
    }
    public function imageUrl(){
        $imgName = 'grey';
        if($this->complete_flag){ $imgName = '';}
        $imgSrc = asset('/assets/common/images/client'.$imgName.'.png');
        if($this->performer2 == 1) {
            $imgSrc = asset('/assets/common/images/agency'.$imgName.'.png');
        }
        if($this->performer3 == 1){ 
            $imgSrc = asset('/assets/common/images/money'.$imgName.'.png');
        }        
        return $imgSrc;
    }
}