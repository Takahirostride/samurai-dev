<?php

namespace App\Modules\Asp\Models;

use Illuminate\Database\Eloquent\Model;
class WorkSetSub extends Model {

    protected $table = 'work_set_sub';
    public $timestamps = false;
    //
    public function getFilePath(){
        $link = str_replace("AND&","/",$this->file_path);
        $file = asset($link); 
        return $file;       
    }    
}