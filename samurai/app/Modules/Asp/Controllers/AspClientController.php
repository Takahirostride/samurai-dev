<?php

namespace App\Modules\Asp\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Asp\Models\User;
use App\Modules\Asp\Models\Hire;
use App\Modules\Asp\Models\WorkSet;
use App\Modules\Asp\Models\Policy;
use App\Modules\Asp\Models\AspClientLog;
use App\Modules\Asp\Models\AspPolicyLog;
use App\Modules\Asp\Models\AspClientLogPolicy;
use App\Helpers\ZipFile;
use Event;
use Validator;
use App\Modules\Asp\Events\AspClientEvent;
class AspClientController extends Controller
{
    public function policyPreview($id,$policy_id){
    {
        $policy = Policy::findOrFail($policy_id);
        $user = auth('asp_user')->user();
        $client = $user->getCompany($id);
        if(!$client){ abort(404);}
        return view("Asp::client.client_policy",compact('client','policy'));
    }
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
        $client = User::select('id')->find($request->data_id);
        if(!$client){
            return response()->json(['error'=>1,'message'=>__('Not found!')]);
        }
        $type = $request->status == 0 ? 'dis_favorite' : 'favorite';
        Event::fire(new AspClientEvent($type,$client));
        return response()->json(['error'=>0,'message'=>__('Sucessfully!')]);
    }   
    public function downloadPreview(Request $request,$id){
        $policy_ids = $request->query('ids',[]);
        if(empty($policy_ids) || !is_array($policy_ids)){
            abort(404);
        }
        $user = auth('asp_user')->user();
        $client = $user->getCompany($id);
        if(!$client){ abort(404);}
        $policies = Policy::with(['tags','policyReg.province','policyReg.city']) 
                       ->whereIn('id',$policy_ids)
                       ->get();
        $user_client = AspClientLog::firstOrCreate([
            'asp_user_id'=>$user->id,
            'user_id'=>$client->id
        ]); 
        $time = date('Y-m-d H:i:s');                      
        foreach($policies as $pl){
            $data= ['policy_id'=>$pl->id,'is_print'=>1];
            AspClientLogPolicy::updateOrCreate(
                [
                    'asp_client_log_id'=>$user_client->id,
                    'policy_id'=>$pl->id,
                    'type'=>2
                ],
                [
                    'created_at'=>$time
                ]
            );
        }        
        return view('Asp::client.download_preview',compact('policies','client'));                           
    }
    //store
    public function bk_downloadPreview(Request $request,$id){
        $hire_ids = $request->query('hire_id',[]);
        if(empty($hire_ids) || !is_array($hire_ids)){
            abort(404);
        }
        $user = auth('asp_user')->user();
        $client = User::select(['id','displayname','username'])->where('manage_flag','=',0)->findOrFail($id);
        $hires = Hire::select(['id','from_id','to_id','policy_id'])
                       ->with([
                            'policy'=>function($qr){
                                $qr->with(['tags','policyReg.province','policyReg.city']);
                            }
                       ]) 
                       ->whereIn('id',$hire_ids)
                       ->where(function($qr)use($id){
                         $qr->where('from_id','=',$id)
                            ->orWhere('to_id','=',$id);
                       })
                       ->has('policy')
                       ->get();
        foreach($hires as $hire){
            $data= ['hire_id'=>$hire->id,'is_printed'=>1];
            $user->hireLog()->updateOrCreate($data);
        }        
        return view('Asp::client.download_preview',compact('hires','client'));                           
    }    
    public function client_recruitment($hire_id)
    {
        $hire = Hire::select(['id','from_id','to_id','policy_id'])->findOrFail($hire_id);
        $hire->load([
            'policy'=>function($qr){
                $qr->with(['tags','policyReg.province','policyReg.city']);
            },
            'fromUser'=>function($qr){
                $qr->select(['id','company_name','manage_flag'])->where('manage_flag','=',0);
            },
            'toUser'=>function($qr){
                $qr->select(['id','company_name','manage_flag'])->where('manage_flag','=',0);
            },

        ]);
        $policy = $hire->policy;
        $client = $hire->getClient();
        if(!$policy || !$client){abort(404);}               
        return view("Asp::client.client_hire",compact('hire','client','policy'));
    }    
}