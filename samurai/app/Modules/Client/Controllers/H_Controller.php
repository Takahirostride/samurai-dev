<?php

namespace App\Modules\Client\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB, Log, AuthSam;

class H_Controller extends Controller
{
	/**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   get View select
    *   @return     :
    */
   	public function getSelect(Request $request) {
   		// $user_id = $request->user_id;
   		$user_id = AuthSam::getUser()->id;
		$current_page = $request->current_page;
		$per_page = $request->per_page;

		$category = explode(',', $request->category);
		$address1 = explode(',', $request->address1);
		$address2 = explode(',', $request->address2);
		$address_ = '';
		// dd($current_page);
		for ($k = 0; $k< count($address1); $k++)
			$address_ .= $address1[$k];
		for ($k = 0; $k< count($address2); $k++)
			$address_ .= $address2[$k];

		$temp_category = [];
		for ($k = 0; $k< count($category); $k++) {
			$temp_category[] = $category[$k];
		}

		$document_business_price = $request->document_business_price;
		$document_business_type = $request->document_business_type;
		$request_business_price = $request->request_business_price;

		$request_business_type = $request->request_business_type;
		$deposit_money = $request->deposit_money;
		Log::info('HScreen Search... '.$document_business_price.":".$document_business_type.":".$request_business_price.":".$request_business_type.":".$deposit_money);

		$founding_year = $request->founding_year;
		$employees_count = $request->employees_count;
		$employees_part_count = $request->employees_part_count;
		$employees_over_60 = $request->employees_over_60;
		$hiring_count = $request->hiring_count;
		$hiring_part_count = $request->hiring_part_count;
		$capital = $request->capital;
		$keyword = $request->keyword;
		$order = $request->order;


		$result11 =  DB::table('policy')->get();

		$result11 = json_decode($result11, true);
		$total2 = [];

		foreach($result11 as $sub) {
			$region_flag = false;
			for ($k = 0; $k< count($address1); $k++) {
				if ($address1[$k] == '全国') {
					$region_flag = true;
					break;
				}
				if( strpos($sub['region'],$address1[$k] ) !== false ) {
					$region_flag = true;
					break;
				}
			}
			if( $region_flag ) {
				$tt = explode("AND",$sub['category']);
				$rr = array_intersect($temp_category,$tt);
				if (count($rr)>0) {
					$total2[] = $sub;
				}
			}
		}

		$ids = [];
		for ($k = 0; $k< count($total2); $k++) {
			$ids[] = $total2[$k]['id'];
		}

		Log::info('H-Screen-->Agency Search...');

		//대응가능시책에 있는 대행자들을 찾기
		$result = DB::table('users')->where('users.manage_flag',1)
		->select('users.*')->distinct()->get();
		$tcount = count($result);

		//업종비교가 있다.
		//
		$result = array_values(array_unique(json_decode($result, true),SORT_REGULAR));

		for ($k= 0; $k< count($result); $k++) {
			if ($k< $tcount)
				$result[$k]['is_collect_flag'] = '募集中';
			else
				$result[$k]['is_collect_flag'] = 'なし';

			$first = DB::table('matching')->where('from_id',$result[$k]['id'])->orderBy('id','desc')->first();

			if ($first) {
				$match_date = $first->start_date;
				$match_date_sub = explode("-", $match_date);
				$match_date = $match_date_sub[0]."年".$match_date_sub[1]."月".$match_date_sub[2]."日";
			} else {
				$match_date = '-';
			}

			$result[$k]['final_request_date']= $match_date;
			$result[$k]['final_request_content']= DB::table('hire')->where('from_id',$result[$k]['id'])->orWhere('to_id',$result[$k]['id'])->count();
		}

		if ($order == 1)
			H_Controller::sortArrayByKey($result,"id",false,true);
		else if ($order == 2)
			H_Controller::sortArrayByKey($result,"result",false,true);
		else if ($order == 3)
			H_Controller::sortArrayByKey($result,"evaluate",false,true);
		// dd($result['38']);
		$pages = array_chunk($result, $per_page);
		// dd($pages);
		$return_value =  $current_page > sizeof($pages) ? [] : $pages[$current_page-1];

		// $result = array('result'=>$return_value, 'total_item_number'=>count($result));

		$result  = ['result' => $return_value, 'limit' => $per_page, 'current_page' => $current_page, 'total_page' => count($result)];

		// dd($result['result']);

   		return view("Client::Hpage.select", ['result' => $result]);
   	}
   	/**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   follow list
    *   @return     :
    */
   	public function followList(Request $request) {
		// $user_id 		= $request->user_id;
		$user_id 		= AuthSam::getUser()->id;
		$current_page 	= $request->current_page;
		$per_page 		= $request->per_page;

		$manage_flag = DB::table('users')->where('id', $user_id)->first()->manage_flag;
		$total_item_number = 0;

		Log::info('Follow리스트 자료 얻기.');
		if ($manage_flag == 0){
			$result = DB::table('follow')->where('follow.user_id', $user_id)
			->join('users', 'users.id', '=', 'follow.follow_id')->where('users.manage_flag', '1')
			->offset($current_page*$per_page )->limit($per_page)->select('users.*')->get();
			$result = json_decode($result, true);
			$total_item_number = count($result);
		} else {
			$result = DB::table('follow')->where('follow.user_id', $user_id)
			->join('users', 'users.id', '=', 'follow.follow_id')->where('users.manage_flag', '0')
			->offset($current_page*$per_page )->limit($per_page)->select('users.*')->get();
			$result = json_decode($result, true);
			$total_item_number = count($result);
		}
		for ($k= 0; $k< count($result); $k++) {
			//if ($k< $tcount)
			$result[$k]['is_collect_flag'] = '募集中';
			//else
				//$result[$k]['is_collect_flag'] = '';
			$result[$k]['final_request_date']= '2017-09-01';
			$result[$k]['final_request_content']= 'unknown';
		}
		$result = ['result' => $result, 'limit' => $per_page, 'current_page' => $current_page+1, 'total_page' => $total_item_number];
		return view("Client::Hpage.select", ['result' => $result]);
		// return array('result'=>$result, 'total_item_number'=>$total_item_number);
	}
	/**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   matching Policy Lists
    *   @return     :
    */
	public function matchingPolicyLists(Request $request) {
		$user_id = $request->id;
		$per_page   =   10;
        if ($request->per_page !== null) {
            $per_page = $request->per_page;
        }
        $current_page          = 1;
        if ($request->current_page !== null) {
            $current_page = $request->current_page;
        }
		$result = DB::table('matching')->select('package_name')->where('from_id', $user_id)->distinct()->get();

		$result  = json_decode($result, true);
		$total = [];
		for ($k= 0; $k< count($result); $k++) {
			$package_name = $result[$k]['package_name'];
			if ($package_name !=""){
				$detail = DB::table('matching')->join('policy', 'policy.id', '=', 'matching.to_id')->select('policy.*','matching.*')->where('from_id', $user_id)->where('package_name', $package_name)->get();
				$sub['package_name'] = $package_name;
				$sub['detail'] = json_decode($detail,true);
				$total[]= $sub;
			}
		}
		$package_name ="";
		$detail = DB::table('matching')->join('policy', 'policy.id', '=', 'matching.to_id')->select('policy.*','matching.*')->where('from_id', $user_id)->where('package_name', $package_name)->get();
		$sub['package_name'] = $package_name;
		$sub['detail'] = json_decode($detail,true);
		$total[]= $sub;

		for ($k = 0; $k< count($total); $k++) {
			for ($k1 =0 ; $k1< count($total[$k]['detail']); $k1++) {
				if ($total[$k]['detail'][$k1]['document_business_type'] == 0)
					$total[$k]['detail'][$k1]['calc_business'] = $total[$k]['detail'][$k1]['document_business_price'];
				else
					$total[$k]['detail'][$k1]['calc_business'] = $total[$k]['detail'][$k1]['document_business_price'].'%';
			}
		}
		Log::info($total);
		$pages = array_chunk($total[0]['detail'], $per_page);
		$return_value =  $current_page > sizeof($pages) ? [] : $pages[$current_page-1];
		// dd($pages[$current_page-1]);
		// return array("result"=>$total);
		$result = ['result' => $return_value, 'limit' => $per_page, 'current_page' => $current_page+1, 'total_page' => count($return_value)];
		return view("Client::Hpage.policy-list", ['result' => $result]);
	}
	/**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   sort array key
    *   @return     :
    */
   	public static function sortArrayByKey(&$array,$key,$string = false,$asc = true){
		if($string){
			usort($array,function ($a, $b) use(&$key,&$asc)
			{
				if($asc)    return strcmp(strtolower($a{$key}), strtolower($b{$key}));
				else        return strcmp(strtolower($b{$key}), strtolower($a{$key}));
			});
		}else{
			usort($array,function ($a, $b) use(&$key,&$asc)
			{
				if($a[$key] == $b{$key}){return 0;}
				if($asc) return ($a{$key} < $b{$key}) ? -1 : 1;
				else     return ($a{$key} > $b{$key}) ? -1 : 1;
			});
		}
	}
}