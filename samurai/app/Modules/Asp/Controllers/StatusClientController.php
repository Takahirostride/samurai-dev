<?php 
namespace App\Modules\Asp\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Admin\Models\Category;
//use App\Modules\Admin\Models\Province;
use App\Modules\Admin\Models\Trade;
use App\Modules\Asp\Models\User;
use App\Modules\Asp\Models\Hire;
use App\Modules\Asp\Models\Policy;
use App\Modules\Asp\Models\VisitPolicy;
use App\Modules\Asp\Models\CheckListPolicyUser;
use App\Modules\Asp\Models\AspClientLog;
use App\Modules\Asp\Models\AspHireLog;
use App\Modules\Asp\Models\Province;
//
use App\Modules\Asp\Traits\ClientSearchTrait;
//
use DB,Validator;
//
class StatusClientController extends Controller
{
	use ClientSearchTrait;
	public function index(Request $request){
        $companies = false;
        if($request->filled('searchtype')){        
            $companies = $this->companyRequest($request);
            $order = $request->filled('order') ? $request->query('order'):0;
            $sort = 'id';
            $ord = 'desc';
            $per_page = $request->filled('per_page') ? $request->per_page : 10;
            $order = $request->query('order',null);
            if($order==1){
                $sort = 'user_login_info.login_day';
                $companies = $companies->joinLogin();
            }elseif($order==2){
                $sort = 'created_at';
                $ord = 'asc';
            }elseif($order==3){
                $sort = 'sended_at';
                $ord = 'desc';
            }elseif($order==4){
                $sort = 'sended_at';
                $ord = 'asc';
            }
            $companies = $companies->orderBy($sort,$ord)->paginate($per_page);
        }
        $trades = Trade::listAll();     
        //dd($companies);
        return view('Asp::status_client.index',compact('companies','trades'));
	}
    public function recruitment($id){
        $user = auth('asp_user')->user();
        $client = $user->getCompany($id);
        $recruitList = false;
        if($client->user_id){
            $recruitList = Hire::summary()
                            ->where([
                                ['accept','=', 1],
                                ['finish_flag','=', 0],
                                ['hire_type','=', 1]
                            ])
                            ->where(function($query) use($client) {
                                $query->where('from_id', $client->user_id)
                                    ->orWhere('to_id', $client->user_id);
                            })                        
                            ->with([
                                'policy'=>function($qr){
                                    $qr->summary();
                                },
                                'workSet'=>function($qr){
                                    $qr->with('user')->summary();
                                }
                            ])                        
                            ->has('policy')
                            ->orderBy('id', 'desc')
                            ->paginate(5);        
            
        }
        return view('Asp::status_client.recruitment',compact('client','recruitList'));
    }
    public function requestSubsidy($id){
        $user = auth('asp_user')->user();
        $client = $user->getCompany($id);
        $recruitList = false;
        if($client->user_id){
            $recruitList = Hire::summary()
                            ->where([
                                ['accept','=', 0],
                                ['finish_flag','=', 0],
                                ['hire_type','=', 1]
                            ])
                            ->where(function($query) use($client) {
                                $query->where('from_id', $client->user_id)
                                    ->orWhere('to_id', $client->user_id);
                            })
                            ->orderBy('id', 'desc')
                            ->with([
                                'policy'=>function($qr){
                                    $qr->summary();
                                }
                            ])
                            ->has('policy')
                            ->paginate(5);        
            
        }

        return view('Asp::status_client.request',compact('client','recruitList'));        
    }
    public function requestJob($id){
        $user = auth('asp_user')->user();
        $client = $user->getCompany($id);
        $recruitList = false;
        if($client->user_id){
            $recruitList = Hire::select(['id','from_id','accept','finish_flag','hire_type','job_title','job_content'])
                            ->where([
                                ['accept','=', 0],
                                ['finish_flag','=', 0],
                                ['hire_type','=', 2]
                            ])
                            ->where(function($query) use($client) {
                                $query->where('from_id', $client->user_id);
                            })                        
                            ->orderBy('id', 'desc')
                            ->paginate(5);
        }        
        return view('Asp::status_client.request_job',compact('client','recruitList'));        
    }
    public function finish($id){
        $user = auth('asp_user')->user();
        $client = $user->getCompany($id);
        $recruitList = false;
        if($client->user_id){
            $recruitList = Hire::summary()
                            ->where([
                                //['accept','=', 1],
                                ['finish_flag','=', 1],
                                ['hire_type','=', 1]
                            ])
                            ->where(function($query) use($client) {
                                $query->where('from_id', $client->user_id)
                                    ->orWhere('to_id', $client->user_id);
                            })                        
                            ->with([
                                'policy'=>function($qr){
                                    $qr->summary();
                                }
                            ])
                            ->has('policy')
                            ->orderBy('finish_date', 'desc')
                            ->paginate(5);        

        }

        return view('Asp::status_client.finish',compact('client','recruitList'));        
    }
    public function visit($id){
        $user = auth('asp_user')->user();
        $client = $user->getCompany($id);
        $visits = false;
        if($client->user_id){
            $visits = VisitPolicy::where([
                                ['user_id','=',$client->user_id]
                            ])
                            ->with([
                                'policy'=>function($qr){
                                    $qr->summary();
                                }
                            ])
                            ->has('policy')
                            ->orderBy('id','desc')->paginate(5);            
        }
        return view('Asp::status_client.visit',compact('client','visits'));                
    }
    public function favorite($id){
        $user = auth('asp_user')->user();
        $client = $user->getCompany($id);
        $visits = false;
        if($client->user_id){
            $favorites = CheckListPolicyUser::where([
                                ['user_id','=',$client->user_id]
                            ])
                            ->with([
                                'policy'=>function($qr){
                                    $qr->summary();
                                }
                            ])
                            ->has('policy')
                            ->groupBy('policy_id')
                            ->orderBy('id','desc')->paginate(5);            
        }

        return view('Asp::status_client.favorite',compact('client','favorites'));
    }
    public function favoriteHire(Request $request){        
        if(!$request->ajax()){abort(404);}
        $valid = Validator::make($request->all(),[
            'status'=>'required|in:0,1',
            'data_id'=>'required'
        ]);
        if($valid->fails()){
            return response()->json(['error'=>1,'message'=>__('Error!')]);
        }
        $hire_id = $request->data_id;
        $status = $request->status == 1 ? 1 : 0;
        $user = auth('asp_user')->user();
        $is_hire = Hire::where('id','=',$hire_id)->exists();
        if(!$is_hire){
            return response()->json(['error'=>1,'message'=>__('Not found!')]);
        }
        $cnd = [
            'asp_user_id'=>$user->id,
            'hire_id'=>$hire_id
        ];
        AspHireLog::updateOrCreate($cnd,[
            'favorite'=>$status
        ]);
        return response()->json(['error'=>0,'message'=>__('Sucessfully!')]);    
    }
	public function subsidy(Request $request,$id){
        $c_sl = ['id','company_name','displayname','username'];
        $client = User::select($c_sl)->where('manage_flag','=',0)->findOrFail($id);
        $user = auth('asp_user')->user();
        $fav_clients = CheckListPolicyUser::with([
                            'policy'=>function($qr){
                                $qr->select(['id','name']);
                            }
                        ])
                        ->where('user_id','=',$id)
                        ->has('policy')
                        ->orderBy('id','desc')->take(5)->get();
        //
        $recruitList = Hire::summary()
                        ->where([
                            ['accept','=', 1],
                            ['finish_flag','=', 0],
                            ['hire_type','=', 1]
                        ])
                        ->where(function($query) use($id) {
                            $query->where('from_id', $id)
                                ->orWhere('to_id', $id);
                        })
                        ->orderBy('id', 'desc')
                        ->with([
                            'policy'=>function($qr){
                                $qr->select(['id','name','acquire_budget_first','acquire_budget_display']);
                            },
                            'fromUser'=>function($qr){
                                $qr->where('manage_flag','=',0);
                            },
                            'toUser'=>function($qr){
                                $qr->where('manage_flag','=',0);
                            },
                            'workSet'=>function($qr){
                                $qr->summary();
                            }
                        ])
                        ->has('policy')
                        ->paginate(10);                        
        //        
        //dd($fav_clients);        
        return view('Asp::status_client.subsidy',compact('client','fav_clients','recruitList'));
	}
	public function subsidyDetail(Request $request,$id){
        $hire = Hire::summary()->where('accept','=', 1)
                        ->findOrFail($id);
        $hire->load([
                        'policy'=>function($qr){
                            $qr->select(['id','name','acquire_budget_first','acquire_budget_display']);
                        },
                        'fromUser'=>function($qr){
                            $qr->where('manage_flag','=',0);
                        },
                        'toUser'=>function($qr){
                            $qr->where('manage_flag','=',0);
                        },
                        'workSet'=>function($qr){
                            $qr->summary();
                        }
                    ]);    
        //dd($hire);                     
        return view('Asp::status_client.subsidy_detail',compact('hire'));
	}
    public function document(Request $request,$id)
    {        
        $user = auth('asp_user')->user();
        $client = $user->getCompany($id);
        if(!$client){ abort(404);}
        $values = false;
        if($client->province_id || $client->establish_at ||  $client->capital || $client->staff_number){
            $values = Policy::summary()->with('userLog');
            if($request->filled('recom_bounty')){
                $values = $values->where('recom_bounty','=',1);
            }else{
                if($request->filled('cate')){
                    $cate = trim($request->cate);
                    if($request->cate == 'location')
                    {
                        $values = $values->where('location', 1);
                    }else{
                        $values = $values->whereHas('cat',function($qr)use($cate){
                            $qr->where('policy_category.category_id','=',$cate);
                        })->has('cat')
                        ->where('location', 0);
                    }
                }                
            }
            $values = $values->recommend($client);
            //
            (!empty($request->order)) ? $order = $request->order : $order = 4;
            (!empty($request->per_page)) ? $per_page = $request->per_page : $per_page = 10;         
            if($order == 1){
                $values = $values->orderBy('created_date','desc')->orderBy('id','desc');
            } else if ($order == 2) {
                $values = $values->orderBy('acquire_budget','desc')->orderBy('id','desc'); 
            } else if($order == 3){
                $values = $values->orderBy('acquire_budget','asc')->orderBy('id','desc');
            } else {
                $values = $values->orderBy('id','desc');
            }
            $values = $values->paginate($per_page); 
        }          
        //dd($values);
        return view("Asp::status_client.document", [
            "policies" => $values,
            "client" => $client,
        ]);
    }
    // store
    public function document_bk_matching(Request $request,$id)
    {        
        $user = auth('asp_user')->user();
        $client = $user->getCompany($id);
        if(!$client){ abort(404);}
        $values = false;
        if($client->province_id || $client->establish_at ||  $client->capital || $client->staff_number){
            $values = Policy::summary()->with('userLog');
            if($request->filled('recom_bounty')){
                $values = $values->where('publication_setting','=', 0)
                ->where(function($qr){
                    $current_date = date('Y-m-d');
                    $qr->where('subscript_duration_detail','=','0000-00-00')
                        ->orWhere('subscript_duration_detail','>=',$current_date);
                })->where('recom_bounty','=',1);
            }else{
                if($request->filled('cate')){
                    $cate = trim($request->cate);
                    if($request->cate == 'location')
                    {
                        $values = $values->where('location', 1);
                    }else{
                        $values = $values->whereHas('cat',function($qr)use($cate){
                            $qr->where('policy_category.category_id','=',$cate);
                        });
                    }
                }
                $values = $values->recommend($client);
            }
            $toan_quoc = DB::table('provinces')->where('province_name', '全国')->first()->id;
            //$user_location = \App\Models\User::with(['user_location'])->where('id',$client->user_id)->first();
            
            //condition provinces
            if($client->province_id && $toan_quoc)
            {
                $user_province_id = $client->province_id;
                $user_city_id = $client->city_id;
                if($user_province_id != 0)
                {
                    $first_city = DB::table('cities')
                            ->where('province_id', $user_province_id)
                            ->where('city_name', 'すべて')
                            ->first()->id;
                    $values = $values->whereHas('policy_region',function($qr) use ($first_city, $toan_quoc, $user_province_id, $user_city_id){
                    $qr->where(function($q1) use($first_city, $toan_quoc, $user_province_id, $user_city_id) {
                        $q1->where('province_id', $toan_quoc)
                            ->orWhere(function($qq1) use($user_province_id, $user_city_id) {
                                $qq1->where('province_id', $user_province_id)
                                    ->where('city_id', $user_city_id);
                            });
                        if($first_city != $user_city_id)
                        {
                            $q1->orWhere(function($qq2) use($user_province_id, $user_city_id, $first_city) {
                                $qq2->where('province_id', $user_province_id)
                                ->where('city_id', $first_city);
                            });
                        }
                    });
                    })->has('policy_region');
                }
                
            }
            if($client->capital > 0)
            {
                $values = $values->where(function($query) use($client) {
                    $query->where(function($q1) use($client) {
                            $q1->where('capital_start', '<=', ($client->capital*10000) )
                                    ->where('capital_end', '>=', ($client->capital*10000) );
                            })
                        ->orWhere(function($q2) use($client) {
                            $q2->where('employees_count_start', '<=', $client->staff_number)
                                ->where('employees_count_end', '>=', $client->staff_number);
                        });
                    if($client->establish_at != 0)
                    {
                        $yy = date('Y', strtotime($client->establish_at) );
                        if($yy > 0 && $yy <= date('Y') && strlen($yy)==4)
                        {
                            $query->orWhere(function($q3) use($client, $yy) {
                                $q3->where(function($q4) use($client, $yy) {
                                    $q4->where('founding_year_start', '<=', $yy)
                                    ->where('founding_year_end', '>=', $yy);
                                })
                                ->orWhere('subscript_duration_option', 1);
                            });
                        }
                    }
                    
                });
            }
            //
            (!empty($request->order)) ? $order = $request->order : $order = 4;
            (!empty($request->per_page)) ? $per_page = $request->per_page : $per_page = 10;         
            if($order == 1){
                $values = $values->orderBy('created_date','desc')->orderBy('id','desc');
            } else if ($order == 2) {
                $values = $values->orderBy('acquire_budget','desc')->orderBy('id','desc'); 
            } else if($order == 3){
                $values = $values->orderBy('acquire_budget','asc')->orderBy('id','desc');
            } else {
                $values = $values->orderBy('id','desc');
            }
            $values = $values->paginate($per_page); 
        }          
        //dd($values);
        return view("Asp::status_client.document", [
            "policies" => $values,
            "client" => $client,
        ]);
    }    
    public function document_bk(Request $request,$id){
        $c_sl = ['id','company_name','displayname','username'];
        $client = User::select($c_sl)->where('manage_flag','=',0)->findOrFail($id);
        $per_page = $request->filled('per_page') ? max(50,$request->per_page):10;
        $recruitList = Hire::summary();
        //filter-category
          if($request->filled('cat_id')){
            $cat_id = (int)$request->cat_id;
            $recruitList->whereHas('policyCat',function($qr)use($cat_id){
                $qr->where('category_id','=',$cat_id);
            });
          }  
        //sort
            $sort_cond_2 = false;
            $sort = 'id';
            $ord = 'desc';
            $order = $request->query('order',null);
            if($order==1){
                $sort = 'created_at';
            }elseif($order==2){
                $recruitList = $recruitList->joinPolicy();
                $sort = 'policy.subscript_duration_detail';
                $ord = 'desc';              
            }elseif($order == 3){
                $recruitList = $recruitList->joinPolicy();
                $sort = 'policy.acquire_budget';
                $ord = 'desc';
                $sort_cond_2 = true;
                $sort_2 = 'policy.acquire_budget_display';
                $ord_2 = 'desc';                  
            }          
        //  
        $recruitList = $recruitList->where([
                            ['hire_type','=', 1],
                        ])
                        ->where(function($query) use($id) {
                            $query->where('from_id', $id)
                                ->orWhere('to_id', $id);
                        })                        
                        ->with([
                            'userLog',
                            'policy'=>function($qr){
                                $qr->summary()->with('userLog');
                            }
                        ])
                        ->groupBy('policy_id')
                        ->orderBy($sort,$ord);
        if($sort_cond_2){
            $recruitList = $recruitList->orderBy($sort_2,$ord_2);
        }                
        $recruitList = $recruitList->paginate($per_page);
        return view('Asp::status_client.document',compact('client','recruitList'));
    }    
}