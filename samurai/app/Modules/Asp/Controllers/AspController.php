<?php

namespace App\Modules\Asp\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Admin\Models\Province;
use App\Modules\Asp\Models\Policy;
use App\Modules\Asp\Models\AspClientLog;
use App\Modules\Asp\Models\Hire;
use App\Modules\Asp\Models\HireClientLog;
use App\Modules\Asp\Models\AspCompany;

use DB;
class AspController extends Controller
{
    public function indexGeneral()
    {
        $user = auth('asp_user')->user();
        $h_with = [
          'aspCompany'=>function($qr){
            $qr->select(['id','name','user_id','asp_user_id']);
          },
          'hire'=>function($qr){
            $qr->select(['id','policy_id'])
              ->with([
                'policy'=>function($q_qr){
                  $q_qr->select(['id','name']);
                }
              ]);
          }
        ];
        $work_sets = HireClientLog::with($h_with)
                          ->whereHas('aspCompany',function($qr){
                            $qr->where([
                              ['is_register','=',1]
                            ]);
                          })
                          ->where('status','=',2)
                          ->orderBy('updated_at','desc')
                          ->take(5)->get(); 
        //dd($work_sets);
        //                         
        $client_reg = AspCompany::where([
                              ['asp_user_id','=',$user->id],
                              ['is_register','=',1]
                          ])
                          ->orderBy('sended_at','desc')->take(5)->get();                                                              
        //                  
        $new_policies = Policy::newAsp()                            
                          ->orderBy('update_date','desc')->take(5)->get();  
        //                         
        $policies = Policy::countHireMonth()
                              ->orderBy('subscript_duration_detail','asc')
                              ->take(5)->get();                                    
        //dd($new_policies);                                    
        return view("Asp::index",compact(
          'work_sets','new_policies','client_reg','policies'
        ));
    }
    public function index()
    {
        $user = auth('asp_user')->user();
        $h_with = [
          'aspCompany'=>function($qr){
            $qr->select(['id','name','user_id','asp_user_id']);
          },
          'hire'=>function($qr){
            $qr->select(['id','policy_id'])
              ->with([
                'policy'=>function($q_qr){
                  $q_qr->select(['id','name']);
                }
              ]);
          }
        ];
        $work_sets = HireClientLog::with($h_with)
                          ->has('aspCompany')
                          ->where('status','=',2)
                          ->orderBy('updated_at','desc')
                          ->take(5)->get(); 
        //                            
        $client_reg = AspCompany::where([
                              ['asp_user_id','=',$user->id],
                          ])
                          ->orderBy('updated_at','desc')->take(5)->get();
        //dd($client_reg);                                                               
        //                  
        $new_policies = Policy::newAsp()                            
                          ->orderBy('update_date','desc')->take(5)->get();  
        //                         
        $policies = Policy::countHireMonth()
                              ->orderBy('subscript_duration_detail','asc')
                              ->take(5)->get();                                    
        //dd($new_policies);                                    
        return view("Asp::home.general",compact(
          'work_sets','new_policies','client_reg','policies'
        ));
    }

    public function newClient(Request $request){
        $user = auth('asp_user')->user();
        $client_reg = AspCompany::where([
                              ['asp_user_id','=',$user->id],
                          ])
                          ->orderBy('updated_at','desc')
                          ->paginate(20); 
        //dd($client_reg);                  
        return view('Asp::home.new_client',compact('client_reg'));                  
    }
    public function expireSubsidy(Request $request){
        $policies = Policy::countHireMonth()
                              ->orderBy('subscript_duration_detail','asc')
                              ->paginate(20);   
        return view('Asp::home.expire_subsidy',compact('policies'));
    }
    public function taskClient(Request $request){
        $user = auth('asp_user')->user();
        $h_with = [
          'aspCompany'=>function($qr){
            $qr->select(['id','name','user_id','asp_user_id']);
          },
          'hire'=>function($qr){
            $qr->select(['id','policy_id'])
              ->with([
                'policy'=>function($q_qr){
                  $q_qr->select(['id','name']);
                }
              ]);
          }
        ];
        $work_sets = HireClientLog::with($h_with)
                          ->where('status','=',2)
                          ->has('aspCompany')
                          ->orderBy('updated_at','desc')
                          ->paginate(20);
        return view('Asp::home.task_client',compact('work_sets'));                   
    }
    public function newSubsidyAsp(Request $request){
        $new_policies = Policy::newAsp()                            
                          ->orderBy('update_date','desc')->paginate(20);
        return view('Asp::home.new_policy',compact('new_policies'));                  
    }     
    public function address(Request $request){
        if(!$request->ajax()){ abort(404);}
        $p2c = Province::listProvince();
        return response()->json($p2c);

    } 
    public function ajaxGetCity(Request $request)
    {
        $rerult = [];
        $region = $request->name;
        $cities = DB::table('cities')->select('id', 'city_name')->where('province_id',$region)->get();
        foreach ($cities as $key => $citie) {
            $rerult[$citie->id] = $citie->city_name;
        }
        echo json_encode($rerult);die();
    }         
}