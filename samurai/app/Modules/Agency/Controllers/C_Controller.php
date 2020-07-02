<?php

namespace App\Modules\Agency\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category, App\Models\SubCategory, DB, AuthSam, Log;
use App\Models\User;
use App\Models\Policy;
use App\Models\CSubsidyList;
use App\Models\Matching;
use App\Models\MatchingUser;
use App\Models\Post;
use App\Models\Bask;
use Carbon\Carbon;
use Redirect;
use App\Helpers\UploadFile;
use Illuminate\Support\Facades\URL;

class C_Controller extends Controller
{
    /**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   get View Index
    *   @return     :
    */
    public function getCpart()
    {
    	$categorys = Category::with(['subcategory'])->get();
        $stdu = 4 - (count($categorys) % 4);
        for ($i=0; $i <$stdu ; $i++) { 
            $categorys[] = [];
        }
        foreach ($categorys as $key => $category) {
            if(@$category->subcategory) {
                $countsub = count($category->subcategory);
                $stdu = 4 - ($countsub % 4);
                for ($i=0; $i <$stdu ; $i++) { 
                    $categorys[$key]->subcategory[] = [];
                }
            }
        }
        $regions = DB::table('provinces')->select('id','province_name' )->get();
        return view("Agency::Cpage.part", ['categorys'=>$categorys, 'regions'=>$regions]);
    }
    /**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   get View Index
    *   @return     :
    */
    public function getCsubsidylist(Request $request)
    {
        $user_id = AuthSam::getUser()->id;
        $current_date = date('Y-m-d');
        (!empty($request->order)) ? $order = $request->order : $order = 0;
        (!empty($request->per_page)) ? $per_page = $request->per_page : $per_page = 20;
        

        if(!isset($request->type)) { //Bsearch
            $categorys = $request->category;
            $categorysubs = $request->categorysub;
            $regions = $request->region;
            $cities = $request->cities;
            $keyword = $request->keyword;
            $results = Policy::with(['subCat','provinces','User','policy_business', 'matching_user_search'])
            ->where('policy.publication_setting','=', 0);
            if(!in_array('全国', $regions)) {
                $results = $results->whereHas('provinces',function($qr)use($regions){
                    return $qr->whereIn('province_id',$regions);
                });
                if($cities) {
                    $results = $results->whereHas('provinces',function($qr)use($cities){
                        return $qr->whereIn('city_id',$cities);
                    });
                }
            }
            if($keyword) {
                $results = $results->where('policy.name', 'LIKE', '%'.$keyword.'%');
            }
            if($categorysubs) {
                $results = $results->whereHas('subCat',function($qr)use($categorysubs){
                    return $qr->whereIn('sub_category_id',$categorysubs);
                });
            }

            $check = [];
            $checklists = DB::table('checklist_policy_user')->select('policy_id')->where('user_id','=',$user_id)->where('type','=','2')->get();
            foreach ($checklists as $key => $checklist) {
                $check[] = $checklist->policy_id;
            }

            $results = $results->whereNotIn('id',$check);
            if($order == 0){
                $results = $results->orderBy('policy.created_date','desc')->orderBy('policy.id','desc');
            } else if ($order == 1) {
                $results = $results->orderBy('policy.acquire_budget_display','desc')->orderBy('policy.id','desc'); 
            } else if($order == 2){
                $results = $results->orderBy('policy.acquire_budget_display','asc')->orderBy('policy.id','desc');
            } else {
                $results = $results->orderBy('policy.id','desc');
            }
            $results = $results->orderBy('id','desc')->paginate($per_page);
        }else{//auto search
            $results = CSubsidyList::getPolicyByType($user_id, $request->type, 0, 20 );
        }
        return view("Agency::Cpage.subsidylist", ["results" => $results]);
    }
    /**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   get View Index
    *   @return     :
    */
    public function getCadd()
    {
        return view("Agency::Cpage.cadd");
    }
    /**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   get View Index
    *   @return     :
    */
    public function getCsetbalance(Request $request)
    {
        // dd($request->subsidyid);
        $user_id = AuthSam::getUser()->id;
        $policy_ids = $request->subsidyid;
        if(!$policy_ids) return back();
        $results = Policy::with(['matching'=>function($qr)use($user_id){
            $qr->where('from_id','=', $user_id);
        }])->where('policy.publication_setting','=', 0)->whereIn('id', $policy_ids)->get();
        $saved_budgets = json_decode(DB::table('users')->select('set_cost')->where('id', $user_id)->first()->set_cost, true);
        $url = URL::signedRoute('agency.csetbalance', ['subsidyid'=>$policy_ids]);
        $param = explode('?', $url)[1];
        return view("Agency::Cpage.csetbalance", ['saved_budgets'=>$saved_budgets, 'results'=>$results, 'param'=>$param]);
    }

    public function postSaveMatching(Request $request) {
        $user_id = AuthSam::getUser()->id;
        $data['document_business_price'] = @$request->document_business_price;
        $data['document_business_type'] = @$request->document_business_type;
        $data['request_business_price'] = @$request->request_business_price;
        $data['request_business_type'] = @$request->request_business_type;
        $data['deposit_setting'] = @$request->deposit_setting;
        if(!$data['deposit_setting']) $data['deposit_setting']=0;
        $data['deposit_money'] = @$request->deposit_money;
    
        $data['other_money'] = @$request->other_money;
        $other_money_sub[1]['moneyname'] = @$request->dother_cost_t1;
        $other_money_sub[1]['moneyvalue'] = @$request->dother_cost_i1;
        $other_money_sub[2]['moneyname'] = @$request->dother_cost_t2;
        $other_money_sub[2]['moneyvalue'] = @$request->dother_cost_i2;
        $other_money_sub[3]['moneyname'] = @$request->dother_cost_t3;
        $other_money_sub[3]['moneyvalue'] = @$request->dother_cost_i3;
        $other_money_sub[4]['moneyname'] = @$request->dother_cost_t4;
        $other_money_sub[4]['moneyvalue'] = @$request->dother_cost_i4;
        $other_money_sub[5]['moneyname'] = @$request->dother_cost_t5;
        $other_money_sub[5]['moneyvalue'] = @$request->dother_cost_i5;
        $data['other_money_sub'] = json_encode($other_money_sub,JSON_UNESCAPED_UNICODE);
        $data['from'] = '1';
        $data['from_id'] = $user_id;
        $policy_ids = $request->subsidyid;


        $exist_ = DB::table('matching')->select('to_id')->where('from',1)->where('from_id',$user_id)->get();
        $exist = [];
        foreach ($exist_ as $key => $exis) {
            $exist[] = $exis->to_id;
        }
            
        foreach ($policy_ids as $key => $policy_id) {
            if (!in_array($policy_id, $exist)) {
                $data['start_date'] = date("Y-m-d");
                $data['to_id'] = $policy_id;
                DB::table('matching')->insert($data);

                // delete and insert to matching users

                $exit = DB::table('matching_users')->where('policy_id',$policy_id)->where('user_id',$user_id)->first();
                if($exit) {
                    DB::table('matching_users')->where('id','=',$exit->id)->update(
                        ['policy_id' => $policy_id,
                         'user_id' => $user_id,
                         'order_type'=> '1',
                         'user_type'=> '1']
                    );
                }else{
                    DB::table('matching_users')->insert(
                        ['policy_id' => $policy_id,
                         'user_id' => $user_id,
                         'order_type'=> '1',
                         'user_type'=> '1']
                    );
                }
                
            }
        }
        $url = URL::signedRoute('agency.csetbalance', ['subsidyid'=>$request->policy_ids]);
        return redirect($url);
    }

    public function getApplicableMeasuresList(Request $request) {
        $user_id = AuthSam::getUser()->id;
        $policy_ids = $request->subsidyid;
        $url = URL::signedRoute('agency.csetbalance', ['subsidyid'=>$policy_ids]);
        $param = explode('?', $url)[1];
        $results = Matching::with(['policy'=>function($qr)use($user_id){
            $qr->where('policy.publication_setting','=', 0);
        }])->where('from_id','=', $user_id)->where('matching.from', 1 )->has('policy');

        $saved_budgets = json_decode(DB::table('users')->select('set_cost')->where('id', $user_id)->first()->set_cost, true);
        return view("Agency::Cpage.applicablemeasureslist", ['saved_budgets'=>$saved_budgets, 'results'=>$rs, 'param'=>$param]);
    }
    public function postEditMatching(Request $request) {
        $user_id = AuthSam::getUser()->id;
        $policy_id = $request->subsidyid;
        // dd($user_id);
        $data['document_business_price'] = @$request->document_business_price;
        $data['document_business_type'] = @$request->document_business_type;
        $data['request_business_price'] = @$request->request_business_price;
        $data['request_business_type'] = @$request->request_business_type;
        $data['deposit_setting'] = @$request->deposit_setting;
        if(!$data['deposit_setting']) $data['deposit_setting']=0;
        $data['deposit_money'] = @$request->deposit_money;
        $data['other_money'] = @$request->other_money;
        $other_money_sub[1]['moneyname'] = @$request->dother_cost_t1;
        $other_money_sub[1]['moneyvalue'] = @$request->dother_cost_i1;
        $other_money_sub[2]['moneyname'] = @$request->dother_cost_t2;
        $other_money_sub[2]['moneyvalue'] = @$request->dother_cost_i2;
        $other_money_sub[3]['moneyname'] = @$request->dother_cost_t3;
        $other_money_sub[3]['moneyvalue'] = @$request->dother_cost_i3;
        $other_money_sub[4]['moneyname'] = @$request->dother_cost_t4;
        $other_money_sub[4]['moneyvalue'] = @$request->dother_cost_i4;
        $other_money_sub[5]['moneyname'] = @$request->dother_cost_t5;
        $other_money_sub[5]['moneyvalue'] = @$request->dother_cost_i5;
        $data['other_money_sub'] = json_encode($other_money_sub,JSON_UNESCAPED_UNICODE);

        $data['package_name'] = @$request->package;
        Log::info('Edit Policy Related'.$policy_id);
        DB::table('matching')->where('from_id', $user_id)->where('to_id',$policy_id)->update($data);
        return redirect(route('agency.ApplicableMeasuresList'));
    }
    public function getDeleteMatching(Request $request) {
        $user_id = AuthSam::getUser()->id;
        $policy_id = $request->policy_id;
        Log::info('delete Policy Related'.$policy_id);
        DB::table('matching')->where('from_id', $user_id)->where('to_id',$policy_id)->delete();
        return redirect(route('agency.ApplicableMeasuresList'));
    }
    public function getCselect(Request $request) {
        $user_id = AuthSam::getUser()->id;
        $policy_id = $request->policy_id;
        if(!$policy_id) return back();
        $results = Policy::with(['matching'=>function($qr)use($user_id){
            $qr->where('from_id','=', $user_id);
        }])->where('id', $policy_id)->first();
        return view("Agency::Cpage.cselect", ['policy_data'=>$results]);
    }

}