<?php 
namespace App\Modules\Agency\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Modules\Agency\Models\Province;
use App\Modules\Agency\Models\Tag;
use App\Modules\Agency\Models\Trade;
use App\Modules\Agency\Models\Policy;
use App\Models\AdminEditInfo;
use App\Helpers\Media\UploadImage;
use Validator;
use Exception;
use AuthSam;
class C_AddController extends Controller{
    public function getCadd()
    {
		$tags = Tag::listAll();
		$trades = Trade::listAll();    	
        return view("Agency::Cpage.cadd",compact('tags','trades'));
    }
    public function storeCadd(Request $request){
        $valid = $this->checkRequestUser();
        if($valid->fails()){
            return back()->withErrors($valid)->withInput();
        }
        if($request->hasFile('file_image_id')){
             try {
                $file = new UploadImage($request->file('file_image_id'));
                $img = $file->save();              
                $img_url = $img['url'];

            } catch (Exception $e) {
                return back()->with('error',$e->getMessage());
            }
        }
        $user = AuthSam::getUser();
        $request->request->add([
            "image_id"=>$img_url,
            'agency_id'=>$user->id,
            'agency_name'=>$user->username,
            'publication_setting'=>1,
            'recom_bounty'=>0,
            'created_date'=>date('Y-m-d',time()),
            'register_pdf'=>[]
        ]);
        $cbox=['subscript_duration_option'];
        $request = $this->handleCheckBox($request,$cbox);
        //
        $fields = ['region','cat_id','image_name','file_image_id','province_name','city_name','cat_list','tags','trades','lset'];
        $data = $request->except($fields);      
        $policy=Policy::create($data);
        //update-relation-table
        if($policy){
            $policy->updateRegion($request->input('region',[]));
            $policy->updateCat($request->input('cat_id',[]));
            if($request->filled('tags')){
                $policy->tags()->attach($request->input('tags'));
            }
            if($request->filled('trades')){
                $policy->trades()->attach($request->input('trades'));
            }                       
        }
        //
        AdminEditInfo::add_info('施策登録画面', '新しい施策を登録しました。');
        return redirect()->back()->with('status',__('create successfully!'));        
    }
    public function getMinitry(Request $request){
    	if(!$request->ajax()){ abort(404);}
    	$p2c = Province::listProvince();
    	return response()->json($p2c);

    }  
    private function checkRequestUser(){
        $request = request();
        $rules = [
            'file_image_id'=>'required|image',
            'tags'=>'required',
            'minitry_id'=>'required',
            'sub_minitry_id'=>'required',
            'update_date.year'=>'required',
            'update_date.month'=>'required',
            'update_date.day'=>'required',
            'acquire_budget_first'=>'required',
            'acquire_budget_display'=>'required',
            'support_scale_lower_limit'=>'required',
            'support_scale_upper_limit'=>'required',
            'subscript_duration_detail.year'=>'required',
            'subscript_duration_detail.month'=>'required',
            'subscript_duration_detail.day'=>'required',
            'inquiry'=>'required',
        ];     
        if($request->has('scraping_content')){
            $rules['scraping_content'] = 'required';
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
    private function handleCheckBox($qr,$fds){
        foreach($fds as $fd){
            if(!$qr->filled($fd)){
                $qr->request->add(["{$fd}"=>0]);                
            }
        }
        return $qr;
    }         	
}