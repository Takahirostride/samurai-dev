<?php

namespace App\Modules\Agency\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CheckListPolicyUser;
use App\Models\VisitPolicy;
use App\Models\Hire;
use DB, User, AuthSam;

class AgencyController extends Controller
{
	private $checkListPolicyUser;
    private $visitPolicy;
    private $hire;
    function __construct(CheckListPolicyUser $checkListPolicyUser, 
                        VisitPolicy $visitPolicy,
                        hire $hire) {

        $this->checkListPolicyUser  =   $checkListPolicyUser;
        $this->visitPolicy          =   $visitPolicy;
        $this->hire                 =   $hire;

    }
    /**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   get View Index
    *   @return     :
    */
    public function getIndex()
    {
    	$user_id    =   session('user_id');
        $matching_policy = Hire::with(['policy'=>function($qr){
            return $qr->where('publication_setting', 0);
        }])
        ->where('accept',1)->orderBy('id','desc')
        ->has('policy')->with('policy.tags')->paginate(4);
        $interest_policy = CheckListPolicyUser::with(['policy'=>function($qr){
            $qr->where('publication_setting', 0);
        }])
            ->where('user_id',$user_id)
            ->where('type','<',2)
            ->where('policy_id','>',0)
            ->with('policy.tags')
            ->has('policy')->paginate(4);
        $visit_policy = VisitPolicy::with(['policy'=>function($qr){
            $qr->where('publication_setting', 0);
        }])
            ->where('user_id',$user_id)
            ->where('policy_id','>',0)
            ->with('policy.tags')
            ->has('policy')
            ->inRandomOrder()
            ->orderBy('id','desc')
            ->paginate(4);

        $notification = DB::table('admin_alim')->where('publication_setting',1)->orderBy('id','desc')->take(5)->get();
        
        return view("Agency::home", ['matching_policy'  =>  $matching_policy,
        							'visit_policy'  	=>  $visit_policy,
                                    'interest_policy'   =>  $interest_policy,
        							'notification'  	=>  $notification,
        						]);
    }

    public function getNotifyById($no_id = false)
    {
        if(!$no_id) return redirect()->route('agency.home');
        $notify = DB::table('admin_alim')->where('publication_setting', 1)->where('id', $no_id)->first();
        if(!$notify) return redirect()->route('agency.home');

        return view('Agency::mypage.notify', compact('notify'));
    }
    public function getNotifyList()
    {
        $notify = DB::table('admin_alim')->where('publication_setting', 1)->paginate(30);
        return view('Agency::mypage.notifylist', compact('notify'));
    }
}