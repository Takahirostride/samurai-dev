<?php

namespace App\Modules\Admin\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Admin\Models\Policy;
use App\Modules\Admin\Models\Province;
use App\Modules\Admin\Models\Category;
use App\Modules\Admin\Models\Tag;
use App\Modules\Admin\Models\Trade;
use App\Modules\Admin\Models\PolicyCat;
use App\Modules\Admin\Models\PolicyRegion;
use App\Modules\Admin\Models\WorkSet;
use App\Modules\Admin\Models\Post;
use DB;
use Validator;
use Exception;
use Carbon\Carbon;
use App\Models\AdminEditInfo;
class EmployeeDataController extends Controller
{

	public function getSubsidylist(Request $request,$type=null){		
		$filters =[
			'id_start'=>['col'=>3,'type'=>'number','label'=>'案件No'],
			['label'=>"~",'col'=>1],
			'id_end'=>['col'=>2,'type'=>'number'],
			'publication_setting'=>['col'=>6,'type'=>'select','options'=>Policy::STATUS_LIST,'label'=>'ステータス','placeholder'=>'すべて'],
			//
			'minitry_id'=>['col'=>3,'type'=>'selectMinitryProvince','label'=>'発行機関'],
			['label'=>'','col'=>1],
			'sub_minitry_id'=>['col'=>2,'type'=>'selectSubMinitryProvince','options'=>[]],
			'cat_id'=>['col'=>6,'type'=>'select','options'=>Category::listCat(),'label'=>'カテゴリー','placeholder'=>'すべて'],
			//
			'province_id'=>['col'=>6,'type'=>'select','options'=>Province::listOnlProvince(),'label'=>'対象地域'],
			'name'=>['col'=>6,'type'=>'text','label'=>'キーワード','query'=>'like']
		];
		$actions = [
			0=>['title'=>'公開','callback'=>[$this,'changePolicyStatus']],
			1=>['title'=>'未公開','callback'=>[$this,'changePolicyStatus']],
			2=>['title'=>'公開不可','callback'=>[$this,'changePolicyStatus']],
			3=>['title'=>'掲載終了','callback'=>[$this,'changePolicyStatus']],
			4=>['title'=>'Show Asp','callback'=>[$this,'changePolicyShowAsp']],
			5=>['title'=>'Donot show Asp','callback'=>[$this,'changePolicyShowAsp']],
		];
        $do_action = $this->handleActionQuery($actions);
        if($do_action){return redirect($request->url())->with('status',__('update successfully!'));}		
		//
        $exc = ['id_start','id_end','cat_id','province_id'];
        $cnd_qr = $this->getCondition($filters,$exc);                		
		$cnd = [];
		if($type=='agency'){
			$cnd_option = ['display_option','>=',1];
		}else{
			$cnd_option = ['display_option','<=',1];
		}
		$cnd[]=$cnd_option;
		$cnd = array_merge($cnd,$cnd_qr);
		//
		$sel = ['id','name','publication_setting','minitry_id','sub_minitry_id','subscript_duration_detail','is_new_asp'];
		$values = Policy::with(['minitry','subMinitry'])->where($cnd);
		//extra-condition
		if($request->filled('cat_id')){
			if($request->cat_id=='location'){
				$values = $values->where('location', 1);
			}else{
				$values = $values->whereHas('cat',function($qr)use($request){
					return $qr->where('category_id','=',(int)$request->cat_id);
				});
			}
			
		}		
		if($request->filled('province_id')){
			$values = $values->whereHas('provinces',function($qr)use($request){
				return $qr->where('province_id','=',(int)$request->province_id);
			});
		}
		if($request->filled('id_start')){
			$values = $values->where('id','>=',(int)$request->query('id_start'));
		}	
		if($request->filled('id_end')){
			$values = $values->where('id','<=',(int)$request->query('id_end'));
		}	

		//
		$sort = $request->query('sort','id');
		$order = $request->query('order','desc');
		$values = $values->orderBy($sort,$order)->paginate();	
		//dd($values);
		return view("Admin::employee.data.subsidylist",compact('values','filters','actions'));
	}
	private function removePolicyStatus($dt=null,$lst){
        if($dt===null){return false;}
        PolicyRegion::whereIn('policy_id',$lst)->delete();
        PolicyCat::whereIn('policy_id',$lst)->delete();
        Policy::whereIn('id',$lst)->delete();
		$count = count($lst);
		AdminEditInfo::add_info('助成金データ', $count.'つの補助金を削除しました。');        
        return true;		
	}
	private function changePolicyShowAsp($dt=null,$lst){
		if($dt===null){return false;}
		$dt = ($dt==4) ? 1 : 0;
		Policy::whereIn('id',$lst)->update(['is_new_asp'=>$dt]);
		return true;

	}
	private function changePolicyStatus($dt=null,$lst){
        if($dt===null){return false;}
        Policy::whereIn('id',$lst)->update(['publication_setting'=>$dt]);
		$count = count($lst);
		switch ($dt) {
			case 0:
				$message = $count."つの補助金を公開設定しました。";
				break;
			case 1:
				$message = $count."つの補助金を未公開設定しました。";
				break;
			case 2:
				$message = $count."つの補助金を公開不可に設定しました。";
				break;
			case 3:
				$message = $count."つの補助金を掲載終了に設定しました。";
				break;
			default:
		}
		AdminEditInfo::add_info('助成金データ', $message);        
        return true;
	}
	//
	public function getsubSidyadd(){
		$trades = Trade::listAll();
		$tags = Tag::listAll();	
		return view("Admin::employee.data.subsidyadd",compact('trades','tags'));
	}
	public function store(Request $request){
		$cbox=['location','subscript_duration_option','recom_bounty','sub_minitry_id'];
		$request = $this->handleCheckBox($request,$cbox);	
		$exc = [];		
		if($request->filled('subscript_duration_option')){
			$exc[]='subscript_duration_detail';
		}					
		$valid = $this->checkRequestUser();
		if($valid->fails()){
			return back()->withErrors($valid)->withInput();
		}
		//
		$fields = ['file_register_pdf','file_image_id','region','customer_flag','normal_flag','cat_id','province_name','city_name','cat_list','tags','trades','olpdf_multi_file'];
		$request->request->add([
			'update_date'=>date('Y年m月d日')
		]);	
		$capital_start=ol_string2number($request->capital_start);	
		$capital_end=ol_string2number($request->capital_end);	
		$employees_count_start=ol_string2number($request->employees_count_start);	
		$employees_count_end=ol_string2number($request->employees_count_end);
		$subscript_duration_detail = $this->getDateArray2String($request->subscript_duration_detail);
		$publication_setting = isset($request->publication_setting) ? $request->publication_setting : 1;
		if(!$request->subscript_duration_option && $this->isExpireDate($subscript_duration_detail)){
			$publication_setting = 3;
		}
		$request->merge([
			'capital_start'=>$capital_start,
			'capital_end'=>$capital_end,
			'employees_count_start'=>$employees_count_start,
			'employees_count_end'=>$employees_count_end,
			'subscript_duration_detail'=>$subscript_duration_detail,
			'publication_setting'=>$publication_setting,
		]);					
		$data = $request->except($fields);		
		$policy=Policy::create($data);
		//update-relation-table
		if($policy){
			$policy->updateRegion($request->input('region',[]));
			$policy->updateCat($request->input('cat_id',[]));
			if($request->filled('trades')){
				$policy->trades()->attach($request->input('trades'));
			}
			if($request->filled('tags')){
				$policy->tags()->attach($request->input('tags'));
			}									
		}
		//
		AdminEditInfo::add_info('施策登録画面', '新しい施策を登録しました。');
		return redirect()->route('admin.employee.data.subsidy_edit',$policy)->with('status',__('create successfully!'));
	}		
	public function edit($id){
		$policy = Policy::findOrFail($id);
		$policy->load([
			'policyReg'=>function($qr){
				$qr->with(['province','city']);
			},
			'policyCat','trades','tags'
		]);
		$tags = Tag::listAll();
		$trades = Trade::listAll();
		//dd($policy);
		return  view("Admin::employee.data.edit",compact('policy','trades','tags'));
	}
	public function update(Request $request,$id){
		$policy = Policy::findOrFail($id);
		$cbox=['location','subscript_duration_option','recom_bounty','sub_minitry_id'];
		$request = $this->handleCheckBox($request,$cbox);
		$exc = ['tags'];		
		if($request->filled('subscript_duration_option')){
			$exc[]='subscript_duration_detail';
		}
		$valid = $this->checkRequestUser($exc);
		if($valid->fails()){
			return back()->withErrors($valid)->withInput();
		}		
		//
		$fields = ['file_register_pdf','file_image_id','region','customer_flag','normal_flag','cat_id','province_name','city_name','cat_list','tags','trades','olpdf_multi_file'];
		$request->request->add([
			'update_date'=>date('Y年m月d日')
		]);	
		$capital_start=ol_string2number($request->capital_start);	
		$capital_end=ol_string2number($request->capital_end);	
		$employees_count_start=ol_string2number($request->employees_count_start);	
		$employees_count_end=ol_string2number($request->employees_count_end);
		$subscript_duration_detail = $this->getDateArray2String($request->subscript_duration_detail);
		$publication_setting = isset($request->publication_setting) ? $request->publication_setting : 1;
		if(!$request->subscript_duration_option && $this->isExpireDate($subscript_duration_detail)){
			$publication_setting = 3;
		}
		if($request->subscript_duration_option){
			$publication_setting = 0;
			// dd($request->subscript_duration_option);	
		}
		$request->merge([
			'capital_start'=>$capital_start,
			'capital_end'=>$capital_end,
			'employees_count_start'=>$employees_count_start,
			'employees_count_end'=>$employees_count_end,
			'subscript_duration_detail'=>$subscript_duration_detail,
			'publication_setting'=>$publication_setting,
		]);
		//dd($request->capital_start);	
		$data = $request->except($fields);
		//dd($data);
		$policy->update($data);
		//update-relation-table
		$policy->updateRegion($request->input('region',[]));
		$policy->updateCat($request->input('cat_id',[]));
		$trades = $request->input('trades',[]);
		$policy->trades()->sync($trades);
		$tags = $request->input('tags',[]);
		$policy->tags()->sync($tags);
		//

		return back()->with('status',__('update successfully!'));
	}
	private function isExpireDate($dt){
		if(empty($dt) || $dt == '0000-00-00'){
			return false;
		}
		$dt = $dt.' 23:59:59';		
		$today = time();
		if(strtotime($dt) < $today){
			return true;
		}
		return false;
	}
	private function getDateArray2String($dt){
        if(is_array($dt)){
            $value_ar = array_merge(['year'=>'0000','month'=>'00','day'=>'00'],$dt);
            $value = "{$value_ar['year']}-{$value_ar['month']}-{$value_ar['day']}";
        }else{
           $value = empty($dt)?'':Carbon::createFromFormat('m/d/Y',$dt)->format('Y-m-d'); 
        }        
        return $value;
	}
	private function getDisplayOption($rq){
	    $opt=0;
    	if($rq->normal_flag && $rq->customer_flag){
    		$opt=1;
    	}else if(!$rq->normal_flag && $rq->customer_flag){
    		$opt=2;	
    	}
    	return $opt;	
	}
	private function handleCheckBox($qr,$fds){
		foreach($fds as $fd){
			if(!$qr->filled($fd)){
				$qr->request->add(["{$fd}"=>0]);				
			}
		}
		return $qr;
	}
    private function checkRequestUser($exc=[]){
        $request = request();
        $rules = [
        	'image_id'=>'required',
        	'name'=>'required',
        	'minitry_id'=>'required',
        	'target'=>'required',
        	'cat_id'=>'required',
        	'info'=>'required',
        	'trades'=>'required',
        	'region'=>'required',
        	'support_content'=>'required',
        	'acquire_budget'=>'required',
        	'acquire_budget_first'=>'required',
        	'subscript_duration'=>'required',
        	'subscript_duration_detail'=>'required',
        ];   
        foreach($exc as $ite){
        	if(array_key_exists($ite, $rules)){
        		unset($rules[$ite]);
        	}        	
        }     
        $msg = [];
        $valid = Validator::make($request->all(),$rules,$msg);
		$valid->after(function($valid)use($request) {
	        if($request->has('cat_id')){
	        	foreach($request->cat_id as $ite){
	        		if(empty($ite['sub'])){
	        			$valid->getMessageBag()->add('cat_id', 'Subcategory is required!');
	        			break;
	        		}
	        	}
	        }
		});               
        return $valid;        
    }
    //
	public function getDocument(Request $request){		
		$cnd = [
			['complete_flag','=',0]
		];
		$with = [
			'user'=>function($qr){ $qr->select(['id','displayname','username']);},
			'hire'=>function($qr){ 
				$qr->with(
					['policy'=>function($p_qr){
						$p_qr->with('minitry')->select(['id','name','minitry_id']);
					}]
				)->select(['id','policy_id']);
			},
			'workSub'=>function($qr){$qr->select(['id','work_set_id','file_name','file_path']);}
		];
		$sel=['id','user_id','hire_id','created_date','file_name','file_path'];
		$values = WorkSet::select($sel)->with($with)->where($cnd);
		if($request->filled('search')){
			$search = strip_tags(trim($request->search));
			$values = $values->whereHas('hire',function($qr)use($search){
				$qr->whereHas('policy',function($p_qr)use($search){
					$p_qr->where('name','like',"%{$search}%");
				});
			});
		}
		$sort = 'id';
		$order = 'desc';		
		$values = $values->orderBy($sort,$order)->paginate();
		//dd($values);
		return view("Admin::employee.data.document",compact('values'));
	}
	public function destroy($id){
		$doc = WorkSet::findOrFail($id);
		$doc->workSub()->delete();
		$doc->delete();
		AdminEditInfo::add_info('タスク管理画面', 'タスク管理id：'.$id.'を削除しました。');
		return back()->with('status',__('remove successfully!'));
	}
	//
	public function editRegistration($id){
		$post = Post::findOrFail($id);
		$post->load(['policy'=>function($qr){
			$qr->with(['cat','provinces','subMinitry']);
		},'user']);
		return view('Admin::employee.data.editRegistration',compact('post'));
	}
	public function updateRegistration(Request $request,$id){
		$post = Post::findOrFail($id);
		$option = $request->has('display') ? 0 : 1;
		$post->update(['display'=>$option]);
		AdminEditInfo::add_info('申請取次画面', '申請代行募集資料を編集しました。');
		return back()->with('status',__('update successfully!'));
	}
	public function getRegistration(Request $request){
		$dis_lst = Post::DISPLAY_LIST;
		$filters = [
			'display'=>['col'=>6,'type'=>'select','options'=>$dis_lst,'placeholder'=>'すべて','label'=>'案件ID'],
			'name'=>['col'=>6,'type'=>'text','label'=>'キーワード','query'=>'like'],
			['col'=>3,'label'=>'更新日'],
            'start_year'=>['col'=>2,'type'=>'year','label'=>'年'],
            'start_month'=>['col'=>2,'type'=>'month','label'=>'月'],
            'start_day'=>['col'=>2,'type'=>'day','label'=>'日'],
            ['col'=>1,'label'=>'~'],
            'end_year'=>['col'=>2,'type'=>'year','label'=>'年'],
            'end_month'=>['col'=>2,'type'=>'month','label'=>'月'],
            'end_day'=>['col'=>2,'type'=>'day','label'=>'日'],            			
		];
		$actions = [
			0=>['title'=>'掲載不可','callback'=>[$this,'changePostStatus']],
			1=>['title'=>'掲載不可解除','callback'=>[$this,'changePostStatus']],
			3=>['title'=>'削除','callback'=>[$this,'removePost']],
		];
        $do_action = $this->handleActionQuery($actions);
        if($do_action){return redirect($request->url())->with('status',__('update successfully!'));}		
		$cnd=[];
		//filters		
		$dt_start = $this->getStartDate();
		$dt_end = $this->getEndDate();
		$error = $this->checkErrorDate($dt_start,$dt_end);
		if($error){
			$request->session()->flash('error',__('time is not valid!'));
		}else{
			if($dt_start){
				$cnd[]=['post_date','>=',$dt_start->format('Y-m-d')];
			}
			if($dt_end){
				$cnd[]=['post_date','<=',$dt_end->format('Y-m-d')];
			}

		}
		if($request->filled('display')){
			$cnd[]=['display','=',$request->display];
		}
		//		
		$with = ['policy'=>function($qr){
			$qr->with(['cat','provinces','subMinitry']);
		}];
		$values = Post::with($with)->where($cnd);
		//filter-extra
		if($request->filled('name')){
			$name = $request->name;
			$values = $values->whereHas('policy',function($p_qr)use($name){
				$p_qr->where('name','like',"%{$name}%");
			});
		}
		//
		$sort = 'id';
		$order = 'desc';	
		$sel = ['id','policy_id','post_date','display'];	
		$values = $values->select($sel)->orderBy($sort,$order)->paginate();
		return view("Admin::employee.data.registration",compact('values','filters','actions'));
	}
	private function changePostStatus($dt=null,$lst){
        if($dt===null){return false;}
        Post::whereIn('id',$lst)->update(['display'=>$dt]);
		AdminEditInfo::add_info('申請取次画面', '申請代行募集資料を編集しました。');        
        return true;
	}	
	private function removePost($dt=null,$lst){
        if($dt===null){return false;}
        Post::whereIn('id',$lst)->delete();
		AdminEditInfo::add_info('申請取次画面', '申請代行募集資料を編集しました。');
        return true;		
	}
	private function checkErrorDate($start,$end){
		if($start === false || $end === false){ return false;}
		return $end->lt($start);
	}
	private function getStartDate(){
		$request = request();
		$out = false;
		if(!$request->filled('start_year')){ return false;}
		return Carbon::createFromDate(
			$request->query('start_year'),
			$request->query('start_month',1),
			$request->query('start_day',1)
		);
	}
	private function getEndDate(){
		$request = request();
		$out = false;
		if(!$request->filled('end_year')){ return false;}
		return Carbon::createFromDate(
			$request->query('end_year'),
			$request->query('end_month',12),
			$request->query('end_day',31)
		);
	}

	//
    private function handleActionQuery($acts = []){
        if(empty($acts)){ return false;}
        $request = request();       
        $act = $request->query('acts',null);
        $p_list = $request->query('posts');
        if(empty($p_list) || !array_key_exists($act, $acts)){ return false;}
        $action = $acts[$act];
        if(empty($action['callback'])){ return false;}
        call_user_func($action['callback'],$act,$p_list);
        return true;
    } 
    private function getCondition($filter=[],$exc=[]){
        $request = request();
        $out = [];
        foreach($filter as $key=>$ite){
            $value = $request->filled($key) ? $request->query($key) : null;
            if(is_numeric($key)|| in_array($key,$exc) || $value === null){
                continue;
            }
            if(empty($ite['query'])){
                $out[]=[$key,'=',$value];
                continue;
            }
            switch ($ite['query']) {
                case 'like':
                    $out[]=[$key,'like',"%{$value}%"];
                    break;
                
                default:
                    break;
             }            
        }
        return $out;
    } 	
}