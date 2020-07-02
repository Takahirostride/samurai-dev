<?php

namespace App\Modules\Asp\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Asp\Models\Policy;
use App\Modules\Asp\Models\User;
use App\Modules\Asp\Models\AspCompany;
use App\Modules\Asp\Models\Trade;
use App\Modules\Asp\Models\Hire;
use Event;
use App\Modules\Asp\Events\AspPolicyEvent;
use Validator;

class AspPolicyController extends Controller
{
	public function showClient(Request $request,$id){
		$policy = Policy::findOrFail($id);
		$policy->load(['minitry','subMinitry','cat','cities.province']);
		//clients
        $user = auth('asp_user')->user();
		$clients = AspCompany::recommend($policy)
                    ->with([
                        'loginInfo','province','city'
                    ]);
                   				
        $sort = 'id';
        $ord = 'desc';
        $per_page = $request->filled('per_page') ? $request->per_page : 10;
        $order = $request->query('order',null);
        if($order==1){
            $sort = 'user_login_info.login_day';
            $clients = $clients->joinLogin();
        }elseif($order==2){
            $sort = 'created_at';
            $direct = 'desc';
        }elseif($order==3){
            $sort = 'sended_at';
            $direct = 'desc';
        }
        elseif($order==4){
            $sort = 'sended_at';
            $direct = 'asc';
        }
		$clients = $clients->orderBy($sort,$ord)->paginate($per_page);
        //dd($clients);	
		return view('Asp::policy.show_client',compact('policy','clients'));
	}
    public function show(Request $request,$id){
        $policy = Policy::findOrFail($id);
        $policy->load(['minitry','subMinitry','cat','cities.province']);
        return view('Asp::policy.show',compact('policy'));
    }      
    public function favorite(Request $request){
        if(!$request->ajax()){abort(404);}
        $valid = Validator::make($request->all(),[
            'status'=>'required|in:0,1',
            'data_id'=>'required'
        ]);
        if($valid->fails()){
            return response()->json(['error'=>1,'message'=>__('Error!')]);
        }
        $policy = Policy::select('id')->find($request->data_id);
        if(!$policy){
            return response()->json(['error'=>1,'message'=>__('Not found!')]);
        }
        $type = $request->status == 0 ? 'dis_favorite' : 'favorite';
        Event::fire(new AspPolicyEvent($type,$policy));
        return response()->json(['error'=>0,'message'=>__('Sucessfully!')]);
    }	
}	