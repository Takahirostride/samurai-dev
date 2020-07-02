<?php 
namespace App\Modules\Asp\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Admin\Models\Category;
use App\Modules\Admin\Models\Province;
use App\Modules\Admin\Models\Trade;
use App\Modules\Asp\Models\Policy;
use App\Modules\Asp\Traits\ClientSearchTrait;
class AspSearchController extends Controller
{
    use ClientSearchTrait;
	public function subsidy(Request $request)
    {
        $categorys = Category::listCatSub();
        $regions = Province::listAllProvince();
        $trades = Trade::listAllDisplay();		
        (!empty($request->order)) ? $order = $request->order : $order = 3;
        (!empty($request->per_page)) ? $per_page = $request->per_page : $per_page = 10; 
        $results = [];
        if($request->has('searchtype')) {
            $contents = @$request->contents;
            $category = @$request->category;
            $categorysubs = @$request->categorysubs;
            $region = @$request->region;
            $cities = @$request->cities;
            $keyword = @$request->keyword;
            $business_type = $request->trades;
            $values = Policy::summary()->with(['policyReg.province','userLog'])
            ->where('publication_setting','=', 0)
            ->where(function($qr){
                $current_date = date('Y-m-d');
                $qr->where('subscript_duration_detail','=','0000-00-00')
                    ->orWhere('subscript_duration_detail','>=',$current_date);
            });           
            if(!empty($region)) {
    
                $values = $values->whereHas('provinces',function($qr)use($region){
                    return $qr->where('province_id',$region);
                });
                if($cities) {
                    $values = $values->whereHas('cities',function($qr)use($cities){
                        return $qr->whereIn('city_id',$cities);
                    });
                }
            }
            if($request->filled('location')){
                $values = $values->whereIn('location',$request->query('location'));
            }
            if($keyword) {
                $values = $values->where('name', 'LIKE', '%'.$keyword.'%');
            }
            if($category) {
                $values = $values->whereHas('policyCat',function($qr)use($category,$categorysubs){
                    $cat_cnd = [];
                    $subcat_cnd = [];
                    foreach ($category as $cat) {
                        if(empty($categorysubs[$cat])){
                            $cat_cnd[] = $cat;
                            continue;
                        }
                        $subcat_cnd = array_collapse([$subcat_cnd,$categorysubs[$cat]]);
                    }
                    if(count($cat_cnd) > 0){
                        $qr = $qr->whereIn('category_id',$cat_cnd);
                    }
                    if(count($subcat_cnd) > 0){
                        $qr = $qr->orWhereIn('sub_category_id',$subcat_cnd);
                    }
                    return $qr;
                });
            }            
            if($business_type) {
                $values = $values->whereHas('policy_business',function($qr)use($business_type){
                    return $qr->whereIn('trade_id',$business_type);
                });
            }
            if($order == 0){
                $values = $values->orderBy('created_date','desc')->orderBy('id','desc');
            } else if ($order == 1) {
                $values = $values->orderBy('acquire_budget','desc')->orderBy('id','desc'); 
            } else if($order == 2){
                $values = $values->orderBy('acquire_budget','asc')->orderBy('id','desc');
            } else {
                $values = $values->orderBy('id','desc');
            }
            $results = $values->paginate($per_page);
        } 
        //dd($results);
		return view('Asp::search.subsidy',[
            'categorys'=>$categorys, 
            'regions'=>$regions, 
            'trades'=>$trades, 
            'results'=>$results, 
		]);
	}
	public function clients(Request $request)
    {       
        $user = auth('asp_user')->user();
        $clients = $this->userRequest($request);
        $order = $request->filled('order') ? $request->query('order'):0;
        $sort = 'id';
        $ord = 'desc';
        $per_page = $request->filled('per_page') ? $request->per_page : 10;
        $order = $request->query('order',null);
        if($order==1){
            $sort = 'user_login_info.login_day';
            $clients = $clients->joinLogin();
        }elseif($order==2){
            $sort = 'created_at';
            $ord = 'asc';
        }elseif($order==3){
            $sort = 'asp_user_clients.created_at';
            $ord = 'desc';
            $clients = $clients->joinRegister();
        }elseif($order==4){
            $sort = 'asp_user_clients.created_at';
            $ord = 'asc';
            $clients = $clients->joinRegister();
        }
        $clients = $clients->orderBy($sort,$ord)->paginate($per_page);
        //dd($clients);
        return view('Asp::search.clients',compact('clients'));
    }
}