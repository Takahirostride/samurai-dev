<?php

namespace App\Modules\Client\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CheckListPolicyUser;
use App\Models\VisitPolicy;
use App\Models\Hire;
use DB, AuthSam;
use App\Modules\Client\Traits\F_Trait;
class ClientController extends Controller
{
    use F_Trait;
    public function getIndex()
    {
    	$user    =   AuthSam::getUser();        
        //doing-policy
        $p_hires = $this->getHirePolicy($user);
        $p_hires = $p_hires->orderBy('created_at','desc')->take(4)->get();
        //bookmark-policy
        $p_bookmarks = $this->getBookmark($user);  
        $p_bookmarks = $p_bookmarks->orderBy('id','desc')->take(4)->get();
        //visit-policy
        $p_visits = $this->getVisitPolicy($user);
        $p_visits = $p_visits->orderBy('created_at','desc')->take(4)->get();
    	//
        $notification = DB::table('admin_alim')->where('publication_setting',1)->orderBy('id','desc')->take(5)->get();
        return view("Client::home", ['p_hires'  =>  $p_hires,
        							'p_bookmarks'  	=>  $p_bookmarks,
        							'p_visits'  	=>  $p_visits,
                                    'notification'      =>  $notification,
                                    'user'      =>  $user,
        						]);
    }
    public function getNotifyById($no_id = false)
    {
        if(!$no_id) return redirect()->route('client.home');
        $notify = DB::table('admin_alim')->where('publication_setting', 1)->where('id', $no_id)->first();
        if(!$notify) return redirect()->route('client.home');

        return view('Client::Gpage.notify', compact('notify'));
    }
    public function getNotifyList()
    {
        $notify = DB::table('admin_alim')->where('publication_setting', 1)->paginate(30);
        return view('Client::Gpage.notifylist', compact('notify'));
    }
}