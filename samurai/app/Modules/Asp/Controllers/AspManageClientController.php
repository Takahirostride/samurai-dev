<?php 
namespace App\Modules\Asp\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Asp\Models\Trade;
use App\Modules\Asp\Models\User;
use App\Modules\Asp\Models\AspUser;
use App\Modules\Admin\Models\Province;
use App\Modules\Asp\Models\City;
use App\Modules\Asp\Models\AspCompany;
use App\Modules\Asp\Models\AspHireLog;
use App\Modules\Asp\Models\AspClientLog;
use App\Modules\Asp\Models\AspClientLogPolicy;
//
use App\Helpers\Media\UploadCsv;
use App\Modules\Asp\Traits\ClientSearchTrait;
use Csv,Validator,Excel,Storage,Exception;
use Carbon\Carbon;
use DB;
class AspManageClientController extends Controller{
	use ClientSearchTrait;
	private $csv_path = 'assets/asp/files';
	public function index(Request $request)
	{	
		$user = auth('asp_user')->user();
		$order = $request->filled('order') ? $request->query('order'):0;
		$direct = 'desc';
		$sort = 'id';
		$companies = $this->companyRequest($request);
		if($order==1){
			$sort = 'user_login_info.login_day';
			$companies = $companies->joinLogin();
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
		$per_page = $request->filled('per_page') ? max(50,$request->per_page) : 10;
		$companies = $companies->orderBy($sort,$direct)->paginate($per_page);
		$trades = Trade::listAll();		
		//dd($companies);
		return view('Asp::manage_user.index',compact('companies','trades'));
	}
	public function downloadHistory(Request $request){
		$user = auth('asp_user')->user();
        $per_page = $request->filled('per_page') ? max(50,$request->per_page) : 10;
        $p_logs = AspClientLogPolicy::with([
                            'policy'=>function($qr){
                                $qr->select(['id','name']);
                            },
                            'aspClientLog'                            
                        ])
                    ->where([
                    	['type','=',2],
                    ])
                    ->whereHas('aspClientLog',function($qr)use($user){
                    	$qr->where('asp_user_id',$user->id);
                    })
                    ->has('policy')
                    ->orderBy('created_at','desc')->paginate($per_page);	
        //dd($p_logs);            	
		return view('Asp::manage_user.policy_history',compact('p_logs'));
	}	
	public function invationGroup(Request $request){
		$user = auth('asp_user')->user();
		if(!$user->isMod()){abort(404);}
		$invation = $user->aspInvation;
		//
		$companies = false;
		$members = AspUser::select(['asp_users.id','asp_users.role','asp_users.first_name','asp_users.last_name'])
						->where([
							['asp_users.role','=','member'],
							['asp_users.inviter_id','=',$user->id]
						])
						->get();
		//
		if($members):
			$companies = AspCompany::with(['province','city']);
			if($request->filled('member')){
				$member_id = $request->member;
				$companies = $companies->where('asp_user_id','=',$member_id);

			}elseif($members){
				$ids = $members->pluck('id');
				$companies = $companies->whereIn('asp_user_id',$ids);
			}
			$order = $request->filled('order') ? $request->query('order'):0;
			$direct = 'desc';
			$sort = 'id';						
			if($order==1){
				$sort = 'user_login_info.login_day';
				$companies = $companies->joinLogin();
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
			$per_page = $request->filled('per_page') ? max(50,$request->per_page) : 10;
			$companies = $companies->orderBy($sort,$direct)->paginate($per_page);
		endif;
		return view('Asp::manage_user.invation_group',compact('invation','companies','members'));
	}
	public function invation(Request $request){
		$user = auth('asp_user')->user();
		$invation = $user->aspInvation;
		$companies = $user->aspCompany()
						->with(['province','city']);
		$order = $request->filled('order') ? $request->query('order'):0;
		$direct = 'desc';
		$sort = 'id';						
		if($order==1){
			$sort = 'user_login_info.login_day';
			$companies = $companies->joinLogin();
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
		$per_page = $request->filled('per_page') ? max(50,$request->per_page) : 10;						
		$companies = $companies->orderBy($sort,$direct)->paginate($per_page);
		return view('Asp::manage_user.invation',compact('invation','companies'));
	}

	public function storeInvation(Request $request){
		$this->validate($request,[
			'title'=>'required',
			'message'=>'required'
		]);
		$data = [
			'title'=>$request->title,
			'message'=>$request->message
		];
		$user = auth('asp_user')->user();
		$user->aspInvation()->updateOrCreate($data);
		return back()->with('store_invation',1);
	}
	public function favorite(Request $request){
		$user = auth('asp_user')->user();
		$order = $request->filled('order') ? $request->query('order'):0;
		$direct = 'desc';
		$sort = 'id';
		$companies = $this->companyRequest($request);
		$companies = $companies->where('favorite','=',1);
		if($order==1){
			$sort = 'user_login_info.login_day';
			$companies = $companies->joinLogin();
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
		$per_page = $request->filled('per_page') ? max(50,$request->per_page) : 10;
		$companies = $companies->orderBy($sort,$direct)->paginate($per_page);
		$trades = Trade::listAll();		
		//dd($user_clients);
		return view('Asp::manage_user.favorite',compact('companies','trades'));
	}
	public function storeFavorite(Request $request){
        if(!$request->ajax()){abort(404);}
        $valid = Validator::make($request->all(),[
            'status'=>'required|in:0,1',
            'data_id'=>'required'
        ]);
        if($valid->fails()){
            return response()->json(['error'=>1,'message'=>__('Error!')]);
        }
        $company = AspCompany::select('id')->find($request->data_id);
        if(!$company){
            return response()->json(['error'=>1,'message'=>__('Not found!')]);
        }
        $status = $request->status == 1 ? 1 : 0;
        $company->update([
        	'favorite'=> $status
        ]);
        return response()->json(['error'=>0,'message'=>__('Sucessfully!')]);		
	}
	public function register(){
		$trades = Trade::listAll();	
		return view('Asp::manage_user.register',compact('trades'));
	}
	public function clientPreview($client_id){
		$user = auth('asp_user')->user();
		$company = AspCompany::select(['id','asp_user_id','user_id'])->where([
				['asp_user_id','=',$user->id],
				['user_id','=',$client_id],
		])->first();
		if($company){
			return redirect()->route('asp_manage_clients_register_preview',$company);
		}
		$client = User::findOrFail($client_id);
		$client->load([
			'userLocation','trade'
		]);
		$trades = Trade::listAll();	
		//dd($client);
		return view('Asp::manage_user.client_preview',compact('trades','client'));		
	}	
	public function create($client_id){
		$user = auth('asp_user')->user();
		$exist = AspCompany::where([
				['asp_user_id','=',$user->id],
				['user_id','=',$client_id],
		])->exists();
		if($exist){abort(404);}
		$client = User::findOrFail($client_id);
		$client->load([
			'userLocation','trade'
		]);
		$trades = Trade::listAll();	
		//dd($client);
		return view('Asp::manage_user.create',compact('trades','client'));
	}
	public function registerPreview($id){
		$company = AspCompany::findOrFail($id);
		$company->load(['trade','province','city']);
		$trades = Trade::listAll();	
		return view('Asp::manage_user.preview',compact('trades','company'));
	}		
	public function registerEdit($id){
		$company = AspCompany::findOrFail($id);
		$company->load(['trade']);
		$trades = Trade::listAll();	
		return view('Asp::manage_user.edit',compact('trades','company'));
	}
	public function registerDestroy(Request $request,$id){
		$company = AspCompany::findOrFail($id);		
		$name = $company->name;
		$company->trade()->detach();
		$company->delete();
		return back()->with('company_delete',$name );
	}
	public function store(Request $request,$client_id){
		$this->register_valid($request);
		$user = auth('asp_user')->user();
		$exist = AspCompany::where([
				['asp_user_id','=',$user->id],
				['user_id','=',$client_id]
		])->exists();
		if($exist){abort(404);}
		$estable = $this->getEstable($request->estable_date);
		$cap = ol_string2number($request->capital);
		$reg = ol_string2number($request->regular_number);
		$dt=[
			'name'=>$request->company_name,
			'email'=>$request->email,
			'province_id'=>$request->province,
			'city_id'=>$request->city,
			'street_address'=>$request->street_address,
			'apartment'=>$request->apartment,
			'establish_at'=>$estable,
			'capital'=>$cap,
			'staff_number'=>$reg,
			'user_id'=>$client_id,
			'asp_user_id'=> $user->id
		];
		$company = AspCompany::create($dt);	
		if($company){
			$trades = $request->input('trade',[]);
			$company->trade()->sync($trades);
		}				
		return redirect()->route('asp_manage_clients_register_edit',$company)->with([
				'store_company'=>1,
				'client_id'=>$client_id
		]);
	}	
	public function registerStore(Request $request){		
		$this->register_valid($request);
		$user = auth('asp_user')->user();		
		$estable = $this->getEstable($request->estable_date);
		$cap = ol_string2number($request->capital);
		$reg = ol_string2number($request->regular_number);
		$trades = $request->input('trade',[]);		
		$dt=[
			'name'=>$request->company_name,
			'email'=>$request->email,
			'province_id'=>$request->province,
			'city_id'=>$request->city,
			'street_address'=>$request->street_address,
			'apartment'=>$request->apartment,
			'establish_at'=>$estable,
			'capital'=>$cap,
			'staff_number'=>$reg,
			'asp_user_id'=>$user->id
		];
		if(!empty($dt['email'])){
			$location = [
				'province_id'=>$request->province,
				'city_id'=>$request->city,
			];
			$n_client = $this->registerClient($user,$dt,$location,$trades);
			if($n_client){
				$dt['user_id'] = $n_client;
			}
		}				
		$company = AspCompany::create($dt);
		if($company){			
			$company->trade()->sync($trades);
		}		
		return redirect()->route('asp_manage_clients_register_edit',$company)->with('store_custom',1);
	}
	private function getEstable($dt){
		$date = ['year'=>'0000','month'=>'00','day'=>'00'];
		if(!empty($dt['year'])){
			$date['year'] = $dt['year'];
		}
		if(!empty($dt['month'])){
			$date['month'] = $dt['month'];
		}
		if(!empty($dt['day'])){
			$date['day'] = $dt['day'];
		}
		return implode('-',$date);
	}
	public function registerUpdate(Request $request,$id){		
		$this->register_valid($request);
		$company = AspCompany::findOrFail($id);		
		$estable = $this->getEstable($request->estable_date);
		$cap = ol_string2number($request->capital);
		$reg = ol_string2number($request->regular_number);	
		$trades = $request->input('trade',[]);	
		$dt=[
			'name'=>$request->company_name,
			'email'=>$request->email,
			'province_id'=>$request->province,
			'city_id'=>$request->city,
			'street_address'=>$request->street_address,
			'apartment'=>$request->apartment,
			'establish_at'=>$estable,
			'capital'=>$cap,
			'staff_number'=>$reg
		];
		$user = auth('asp_user')->user();
		if(empty($company->user_id)){
			if(!empty($request->email)){
				$location = [
					'province_id'=>$request->province,
					'city_id'=>$request->city,
				];
				$n_client = $this->registerClient($user,$dt,$location,$trades);
				if($n_client){
					$dt['user_id'] = $n_client;
				}
			}			
		}
		$company->update($dt);		
		$company->trade()->sync($trades);		
		return back()->with([
			'update_company'=>1,
		]);
	}	
	public function csv(Request $request){
		set_time_limit(0);
		$user = auth('asp_user')->user();
		$companies = false;
		$provinces = false;
		$trades = false;
		$csv_path = null;
		if($request->filled('filename')){
			$filename = $request->query('filename');
			if(Storage::exists($this->csv_path.'/'.$filename)){
				$f_path = Storage::path($this->csv_path.'/'.$filename);
				$dt_import = Excel::selectSheetsByIndex(0)->load($f_path)->get();
				if($dt_import && !$dt_import->isEmpty()){
					$companies = [];
					$provinces = collect(Province::listProvince());
					$trades = Trade::listAll();
					for($ii = 0; $ii < $dt_import->count(); $ii++) {
						$results = $dt_import->get($ii);
						$values = $results->values()->toArray();
						if(empty($values[1])){ continue;}
						$companies[] = $values;
						$csv_path = $filename;
					}	
				}			
			}															
		}
		//dd($trades);
		return view('Asp::manage_user.csv',compact('companies','provinces','trades','csv_path'));
	}
	public function csvRegister(Request $request){
		$this->validate($request,[
			'csv_path'=>'required'
		]);
		$filename = $request->csv_path;

		if(!Storage::exists($this->csv_path.'/'.$filename)){
			return back()->with('error',__('File not existed!'));
		}
		$f_path = Storage::path($this->csv_path.'/'.$filename);
		$dt_import = Excel::selectSheetsByIndex(0)->load($f_path)->get();
		if(!$dt_import && $dt_import->isEmpty()){
			return back()->with('error',__('Error!'));
		}
		$provinces = collect(Province::listProvince());
		$trades = Trade::listAll();
		$companies = [];
		for($ii = 0; $ii < $dt_import->count(); $ii++) {
			$results = $dt_import->get($ii);
			$values = $results->values()->toArray();
			if(empty($values[1])){ continue;}
			$companies[] = $values;
		}	
		$user = auth('asp_user')->user();
		$count_result = 0;
		foreach($companies as $k=>$company){
			if(count($company)<11){ continue;}
			if(!$this->checkRowcsv($company)){
				continue;
			}
			$dt=[
				'name'=>null,
				'province_id'=>0,
				'other_province'=>null,
				'city_id'=>0,
				'other_city'=>null,
				'street_address'=>null,
				'apartment'=>null,
				'establish_at'=>null,
				'capital'=>0,
				'staff_number'=>0,
				'email'=>null,
			];			
			$establish = $this->convertDate($company[7]);
			$address = $this->csvGetAddress($company[2],$company[3],$provinces);
			//doing
			$dt = array_merge($dt,$address);
			$dt['name'] = $company[1];
			$dt['street_address'] = $company[4];
			$dt['apartment'] = $company[5];
			$dt['establish_at'] = $establish;
			$dt['capital'] = (ol_string2number($company[8])!='')?ol_string2number($company[8]):0 ;
			$dt['staff_number'] = (ol_string2number($company[9])!='')?ol_string2number($company[9]):0 ;
			$dt['email'] = $company[10];	
			$c_exits = $user->aspCompany()->where([
				['name','=',$dt['name']],
				['province_id','=',$dt['province_id']],
				['other_province','=',$dt['other_province']],
				['city_id','=',$dt['city_id']],
				['other_city','=',$dt['other_city']],
				['street_address','=',$dt['street_address']],
				['apartment','=',$dt['apartment']],
			])->exists();
			if($c_exits){
				continue;
			}
			$n_trades = explode(',', $company[6]);
			$trade_dt = [];
			foreach ($n_trades as $tr) {
				$key = $this->csvGetTrade($tr,$trades);
				if($key){
					$trade_dt[] = $key; 
				}
			}
			if(!empty($dt['email'])){
				$location = [
					'province_id'=>$dt['province_id'],
					'province_name'=>$dt['other_province'],
					'city_id'=>$dt['city_id'],
					'city_name'=>$dt['other_city'],
				];
				$n_client = $this->registerClient($user,$dt,$location,$trade_dt);
				if($n_client){
					$dt['user_id']=$n_client;
				}
			}			
			$n_company = $user->aspCompany()->create($dt);
			if($n_company){
				$n_company->trade()->attach($trade_dt);
			}
			$count_result++;
		}
		return back()->with('csv_register',$count_result);				

	}
	public function csvImport(Request $request){
		set_time_limit(0);
		if($request->method('post') && $request->hasFile('company')){
			$company_f = $request->file('company');
			$error = false;
			try {
				$upload_csv = new UploadCsv($company_f);
				$path = $upload_csv->save(); 
			} catch (Exception $e) {
				$error = $e->getMessage();
			}
			if($error){
				return back()->with('error',$error);
			}
			return redirect()->route('asp_manage_clients_csv',['filename'=>$path]);
		}
		abort(404);
	}
	private function csvGetTrade($ele,$dts){
		$res = false;
		foreach($dts as $k_ite=>$ite){
			if(strpos($ele,$ite) !== false){
				$res = $k_ite;
			}
		}
		return $res;
	}
	private function csvGetAddress($prv,$city,$ar){
		$res = [
			'province_id'=>0,
			'other_province'=>null,
			'city_id'=>0,
			'other_city'=>null,
		];
		$cities = [];
		foreach($ar as $ite){
			if(strpos($prv,$ite['ite_name']) !== false){
				$res['province_id'] = $ite['id'];
				$cities = $ite['children'];
				break;
			}
		}
		if(!empty($cities)){
			foreach($cities as $k_ite=>$ite){
				if(strpos($city,$ite) !== false){
					$res['city_id'] = $k_ite; 
				}
			}
		}
		if(empty($res['province_id'])){
			$res['other_province'] = $prv;
		}
		if(empty($res['city_id'])){
			$res['other_city'] = $city;
		}
		return $res;
	}
	private function checkRowcsv($dt){
		if(empty($dt) || !is_array($dt)){
			return false;
		}
		if(empty($dt[1]) || empty($dt[2]) || empty($dt[3])){
			return false;
		}
		return true;
	}
	private function checkCsvHeaing($data){
		$def =['会社名事業所名','都道府県','市区町村','町名番地','マンション名ビル名','業種_業種一覧をご覧ください','設立年月','資本金','従業員数','メールアドレス'];
		return $def==$data;
	}
	private function csvValid($request){
		if($request->filled('date_from')&&$request->filled('date_to')){
			$dt_fr = Carbon::createFromFormat('Y-m-d',$request->date_from);
			$dt_to = Carbon::createFromFormat('Y-m-d',$request->date_to);
			if($dt_fr->gt($dt_to)){
				return __('From date must smaller than to date!');
			}
		}
		return false;
	}
	public function download(Request $request){
		$filename = 'List-clients-'.date('YmdHi');
		$companies = AspCompany::with(['province','city','trade'])->get();
		$data = [];
		foreach($companies as $company){
			$province = $company->province ? $company->province->province_name : '';
			$city = $company->city ? $company->city->city_name : '';
			$establish = empty($company->establish_at) || $company->establish_at == '0000-00-00' ? null : $company->establish_at;
			$trades = $company->trade->implode('trade',',');
			$row =[
				'name'=>$company->name,
				'province'=>$province,
				'city'=>$city,
				'capital'=>$company->capital,
				'establish'=>$establish,
				'staff'=>$company->staff_number,
				'trade'=>$trades,
				'email'=>$company->email,
			];	
			array_push($data,$row);		
		}			
		Csv::downloadCsv($data, $filename);
		return redirect()->route('asp_manage_clients_show',['id'=>$id,'register'=>1]);
	}
	private function register_valid($request){
		$this->validate($request,[
			'company_name'=>'required',
			'province'=>'required',
			'city'=>'required',
			'street_address'=>'required',
			'trade'=>'required',
			'capital'=>'required',
			'regular_number'=>'required',
		]);
	}
	private function registerClient($user,$dt=[],$location=[],$trades=[]){
		$client = User::where('e_mail','=',$dt['email'])->first();
		if($client){
			if($client->manage_flag == 1){
				return false;
			}
			$c_company = AspCompany::where([
				'asp_user_id'=>$user->id,
				'user_id'=>$client->id
			])->exists();
			if($c_company){
				return false;
			}
			return $client->id;
			
		}else{
			$n_client = User::create([
				'username'=>$dt['email'],
				'displayname'=>$dt['name'],
				'e_mail'=>$dt['email'],
				'password'=>md5(rand(100000,999999)),
				'manage_flag'=>0,
				'street_building_name'=>$dt['street_address'],
				'created_at'=>date('Y-m-d'),
			]);
			if(!empty($dt['establish_at']) || !empty($dt['capital']) || !empty($dt['staff_number'])){
				$n_client->data()->create([
					'estable_date'=>$dt['establish_at'],
					'capital'=>$dt['capital'],
					'regular_number'=>$dt['staff_number'],
					'regular_employee_number'=>0,
					'byte_number'=>0,
					'byte_employee_number'=>0,
					'byte_regular_number'=>0,
					'number_over_60'=>0,
					'category_content'=>'[]',
				]);
			}
			if($location){
				$location = array_merge([
					'province_id'=>0,
					'province_name'=>'',
					'city_id'=>0,
					'city_name'=>'',
					'updated_at'=>date('Y-m-d H:i:s')
				],$location);
				$n_client->userLocation()->create($location);
			}
			if(!empty($trades)){
				$n_client->trade()->attach($trades);
			}
			return $n_client->id;
		}
		return false;		
	}
	private function convertDate($dt){
		if(empty($dt) || class_basename($dt) != 'Carbon'){
			return false;
		}
		return $dt->format('Y-m-d');
	}
	//store
	public function bk_hireHistory(Request $request){
		$user = auth('asp_user')->user();
        $per_page = $request->filled('per_page') ? max(50,$request->per_page) : 10;
        $h_hires = AspHireLog::with([
                            'hire'=>function($qr){
                                $qr->select(['id','from_id','to_id','policy_id'])
                                ->with([
                                    'policy'=>function($q_qr){
                                        $q_qr->select(['id','name']);
                                    },
						    		'fromUser'=>function($h_qr){
						    			return $h_qr->where('manage_flag','=',0)->select(['id','manage_flag']);
						    		},
						    		'toUser'=>function($h_qr){
						    			return $h_qr->where('manage_flag','=',0)->select(['id','manage_flag']);
						    		}                                   
                                ]);
                            }                            
                        ])
                    ->where([
                    	['asp_user_id','=',$user->id],
                    	['is_printed','=',1]
                    ])
                    ->has('hire')
                    ->orderBy('id','desc')->paginate($per_page);	
        //dd($h_hires);            	
		return view('Asp::manage_user.hire_history',compact('h_hires'));
	}		
}