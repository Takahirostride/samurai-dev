<?php

namespace App\Modules\Asp\Models;

use Illuminate\Database\Eloquent\Model;
class HireClientLog extends Model {

	const STATUS_LIST = [
				0 => null,
				1 => 'Register hire',
				2 => 'New task',
				3 => 'Complete task',
				4 => 'Complete hire'
	];
    protected $table = 'hire_client_logs';
    protected $guarded = ['_token'];
    public $timestamps = true;
    //
    public function clientStatistic(){
        return $this->belongsTo('App\Modules\Asp\Models\HireClientStatistic','client_id','client_id');
    }
    public function aspCompany(){
        $user = auth('asp_user')->user();
        return $this->hasOne('App\Modules\Asp\Models\AspCompany','user_id','client_id')->where('asp_user_id','=',$user->id); 
    }
    public function client(){
    	return $this->belongsTo('App\Modules\Asp\Models\User','client_id','id');
    }
    public function hire(){
    	return $this->belongsTo('App\Modules\Asp\Models\Hire','hire_id','id');
    }
    public function workSet(){
    	return $this->belongsTo('App\Modules\Asp\Models\WorkSet','work_set_id','id');
    }
    public function aspClientLog(){
    	return $this->belongsTo('App\Modules\Asp\Models\AspClientLog','client_id','user_id');
    }

    //
    public function getStatusName(){
        if($this->status == 2){
            $out = "<span>「{$this->aspCompany->name }」</span>";
            $out .= '<span>が</span>';
            $out .= '「'.$this->hire->policy->name.'」';
            $out .= '<span>のタスクを更新しました。</span>'; 
            return $out;   
        }
        return null;
    }

}