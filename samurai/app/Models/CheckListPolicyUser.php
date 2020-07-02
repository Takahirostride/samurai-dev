<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class CheckListPolicyUser extends Model
{
    //
    protected $table = 'checklist_policy_user';

    public function user()
    {
    	return $this->beLongsTo('App\Models\User', 'user_id');
    }
    public function policy()
    {
        return $this->belongsTo('App\Models\Policy', 'policy_id');
    }
    public function user_checklist()
    {
        return "123";
    }

    public function getInterestPolicyAtHome($user_id) {
    	$result = DB::table('checklist_policy_user')
                    ->where('checklist_policy_user.user_id', $user_id)
                    ->where('checklist_policy_user.type','<',2)
                    ->where('policy_id','>',0)
                    ->orderBy('checklist_policy_user.id','desc')
                    ->join('policy','policy.id','=','checklist_policy_user.policy_id')
                    ->select('policy.*');
        return $result;
    }
}
