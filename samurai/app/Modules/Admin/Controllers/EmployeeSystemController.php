<?php 
namespace App\Modules\Admin\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Modules\Admin\Models\Policy;
use App\Modules\Admin\Models\Province;
use App\Modules\Admin\Models\Category;

use App\Models\AdminEditInfo;
class EmployeeSystemController extends Controller
{
    public function getSuggest(Request $request)
    {
		$filters =[
			'id_start'=>['col'=>3,'type'=>'number','label'=>'案件No'],
			['label'=>"~",'col'=>1],
			'id_end'=>['col'=>2,'type'=>'number'],
			'publication_setting'=>['col'=>6,'type'=>'select','options'=>Policy::STATUS_LIST,'label'=>'ステータス','placeholder'=>'すべて'],
			//
			'minitry_id'=>['col'=>3,'type'=>'selectMinitry','label'=>'発行機関'],
			['label'=>'','col'=>1],
			'sub_minitry_id'=>['col'=>2,'type'=>'selectSubMinitry','options'=>[]],
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
			4=>['title'=>'削除','callback'=>[$this,'removePolicyStatus']]
		];
        $do_action = $this->handleActionQuery($actions);
        if($do_action){return redirect($request->url())->with('status',__('update successfully!'));}		
		//
    	$cnd=[
    		['display_option','<=',1],
    		['recom_bounty','=',1]
    	];		
        $exc = ['id_start','id_end','cat_id','province_id'];
        $cnd_qr = $this->getCondition($filters,$exc);	
        $cnd = array_merge($cnd,$cnd_qr);	
    	$values = Policy::with(['cat','provinces','subMinitry'])->where($cnd);
		//extra-condition
		if($request->filled('cat_id')){
			$values = $values->whereHas('cat',function($qr)use($request){
				return $qr->where('category_id','=',(int)$request->cat_id);
			});
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
        return view("Admin::employee.system.suggest",compact('values','filters','actions'));
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
            $value = $request->query($key,null);
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