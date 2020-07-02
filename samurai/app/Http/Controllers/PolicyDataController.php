<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Api\Users\Services\UserService;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Input;

class PolicyDataController extends Controller
{
    //
	
	public function scrape(Request $request){
		$totalArray = json_decode($request->scrape_data, true);
		$con = DBOpen();
		
		$cc = [];
		$cc[] = "すべて";
			
		for ($kk = 0; $kk < count($totalArray); $kk++) {
			$sub = $totalArray[$kk];
			
			$register_pdf_ = array();
			if ($sub[16] !='') {
				$subarray = array();
				$subarray[] = "PRチラシ・パンフレット";
				$subarray[] = $sub[16];
				$register_pdf_[] = $subarray;
			}
			$register_pdf = json_encode($register_pdf_,JSON_UNESCAPED_UNICODE);

			$bb = explode("AND" , $sub[3]);
			$gg1 = [];
			for ($k1 = 0; $k1< count($bb); $k1++) {
				$gg = [];
				$gg[] = $bb[$k1];
				$gg[] = $cc;
				
				$gg1[] = $gg;
			}
			$gg1 = json_encode($gg1, JSON_UNESCAPED_UNICODE);
			
			
			$region = $sub[4];
			$bb =  $region;
			
			$fff = [];
			$gg12 = [];
			$gg12[] = $bb;
			$gg12[] = "";
			$fff[] =$gg12;
			$fff = json_encode($fff, JSON_UNESCAPED_UNICODE);
			
			
			$string = implode(' ', $sub[18]);
			$query = "insert into policy(image_id, category_detail,region_detail,register_insti,register_insti_detail,
			category,`tag`,region,update_date,name,name_serve,target,info,support_content,
			support_scale,subscript_duration,object_duration,adopt_result,register_pdf,
			inquiry,scraping_url, scraping_content) values ('assets/img/policy_sample.jpg','".$gg1."','".$fff."','".$sub[0]."',
			'".$sub[1]."','".$sub[3]."','0','".$sub[4]."','".$sub[6]."','".$sub[7]."','".$sub[8]."',
			'".$sub[9]."','".$sub[10]."','".$sub[11]."','".$sub[11]."','".$sub[12]."','".$sub[13]."','".$sub[14]."',
			'".$register_pdf."','".$sub[15]."','".$sub[17]."','".$string."');";

			$data = [
                'image_id'=>'assets/img/policy_sample.jpg',
                'category_detail'=>$gg1,
                'region_detail'=>$fff,
                'region_detail'=>$sub[0],
                'register_insti'=>$sub[1],
                'register_insti_detail'=>$sub[3],
                'category'=>'0',
                'tag'=>$sub[4],
                'region'=>$sub[6],
                'update_date'=>$sub[7],
                'name'=>$sub[8],
                'name_serve'=>$sub[9],
                'info'=>$sub[10],
                'support_content'=>$sub[11],
                'support_scale'=>$sub[11],
                'subscript_duration'=>$sub[12],
                'object_duration'=>$sub[13],
                'adopt_result'=>$sub[14],
                'register_pdf'=>$register_pdf,
                'inquiry'=>$sub[15],
                'scraping_url'=>$sub[17],
                'scraping_content'=>$string,
            ];
            DB::table('policy')->insert($data);
		}
		sleep(2);
		
		return array('result'=>$totalArray);
	}

	
	public function scrape2() {
		$result= DB::table('policy')->select('id','category','register_insti_detail')->where('id','<','1300')->get();
		
		$result = json_decode($result,true);
		$total = [];
		$cc = [];
		$cc[] = "すべて";
			
		for ($k= 0 ; $k< count($result); $k++) {
			$bb = explode("AND" , $result[$k]['category']);
			
			$gg1 = [];
			for ($k1 = 0; $k1< count($bb); $k1++) {
				$gg = [];
				$gg[] = $bb[$k1];
				$gg[] = $cc;
				
				$gg1[] = $gg;
			}
			
			DB::table('policy')->where('id',$k+1)->update(['category_detail'=>json_encode($gg1)]);
			
			//$total[] = $gg1;
		}
		return array('result'=>$total);
	}
	
	public function scrape1() {
		$result= DB::table('policy')->select('id','category','region')->where('id','<','1300')->get();
		$result = json_decode($result,true);
		$total = [];
		for ($k= 0 ; $k< count($result); $k++) {
			$bb =  $result[$k]['region'];
			$fff = [];
			$gg1 = [];
			$gg1[] = $bb;
			$gg1[] = "";
			$fff[] =$gg1;
			DB::table('policy')->where('id',$k+1)->update(['region_detail'=>json_encode($fff)]);
			//$total[] = $gg1;
		}
		return array('result'=>$total);
	}
}
