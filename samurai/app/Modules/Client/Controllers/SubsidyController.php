<?php 
namespace App\Modules\Client\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use AuthSam,Log,Validator;
use App\Models\Policy;
use App\Models\VisitPolicy;
use App\Modules\Client\Traits\F_Trait;
class SubsidyController extends Controller{
	use F_Trait;
    public function visit(Request $request){
        $user = AuthSam::getUser();

        $per_page = $request->filled('per_page')?$request->per_page : 10;        
        $order = $request->filled('order')?$request->order : 0;        
        if($order==0){
            $results = $this->getVisitPolicy($user);
        }else{
            $results = $this->getPolicyVisit($user);
        }
        if($order == 0){
            $results = $results->orderBy('created_at','desc')->orderBy('id','desc');
        } else if ($order == 1) {
            $results = $results->orderBy('acquire_budget','desc')->orderBy('id','desc'); 
        } else if($order == 2){
            $results = $results->orderBy('acquire_budget','asc')->orderBy('id','desc');
        } else {
            $results = $results->orderBy('id','desc');
        }    
        $results = $results->paginate($per_page); 
        //dd($results);  
        return view("Client::Fpage.list_visit", [
            "results" => $results,
            "user" => $user,
        ]);               
    }
    public function bookmark(Request $request){
        $user = AuthSam::getUser();
        $values = $this->getBookmark($user);       
        //request  
        $per_page = $request->filled('per_page')?$request->per_page : 10;        
        $order = $request->filled('order')?$request->order : 3;         
        if($order == 0){
            $values = $values->orderBy('created_date','desc')->orderBy('id','desc');
        } else if ($order == 1) {
            $values = $values->orderBy('acquire_budget','desc')->orderBy('id','desc'); 
        } else if($order == 2){
            $values = $values->orderBy('acquire_budget','asc')->orderBy('id','desc');
        } else {
            $values = $values->orderBy('id','desc');
        }
        $values = $values->paginate($per_page);           
        //dd($values);
        return view("Client::Fpage.bookmark", [
            "results" => $values,
            "user" => $user,
        ]);        
    }	
    public function doing(Request $request){
        $user = AuthSam::getUser();

        $per_page = $request->filled('per_page')?$request->per_page : 10;        
        $order = $request->filled('order')?$request->order : 0;        
        if($order==0){
            $results = $this->getHirePolicy($user);
        }else{
            $results = $this->getPolicyHire($user);
        }
        if($order == 0){
            $results = $results->orderBy('created_at','desc')->orderBy('id','desc');
        } else if ($order == 1) {
            $results = $results->orderBy('acquire_budget','desc')->orderBy('id','desc'); 
        } else if($order == 2){
            $results = $results->orderBy('acquire_budget','asc')->orderBy('id','desc');
        } else {
            $results = $results->orderBy('id','desc');
        }    
        $results = $results->paginate($per_page); 
        //dd($results);  
        return view("Client::Fpage.doing", [
            "results" => $results,
            "user" => $user,
        ]);         
    }	
    public function detail(Request $request,$id)
    {
        $user = AuthSam::getUser();
        $policy = Policy::findOrFail($id);
        $policy->load([
            'tags','minitry','sub_minitry'
        ]);
        if ($user) {
                Log::info("session users_id:".$user->id."aa");
                $dt = [
                    'user_id'=>$user->id,
                    'policy_id'=>(int)$id
                ];
                $result=VisitPolicy::updateOrCreate($dt,['created_at'=>date('Y-m-d H:i:s',time())]);
                //dd($result);
        }     
        // dd($policy);      
        return view("Client::Fpage.subsidy_detail", [
            'policy_data'=>$policy,
            'user'=>$user
        ]);
    }
}