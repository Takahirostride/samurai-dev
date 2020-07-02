<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class VisitPolicy extends Model
{
    //
    protected $table = 'visit_policy';
    protected $fillable=['user_id','policy_id','created_at'];
    public $timestamps = false;
    protected $casts = [
        'created_ar' => 'datetime',
    ];

    public function getVisitPolicyAtHome($user_id) {
    	$result = DB::table('visit_policy')
                    ->where('visit_policy.user_id', $user_id)
                    ->where('visit_policy.policy_id','>',0)
                    ->orderBy('visit_policy.id','desc')
                    ->join('policy','policy.id','=','visit_policy.policy_id')
                    ->select('policy.*');
        return $result;
    }
    public function policy()
    {
        return $this->belongsTo('App\Models\Policy', 'policy_id');
    }
}
