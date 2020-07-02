<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

//use Api\Users\Requests\CreateUserRequest;
//use Api\Users\Services\UserService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

use DOMDocument;
use DOMXPath;
use DateTime;
use App\Models\Policy;


class ScrapeUpdateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
	 
	protected $data;
	public $flag = false;
	public $total_count = 1;
	public $category_list;
    public $category_list_ar;
    public $sub_list;
    public $sub_list_ar;
    public $province_list;
    public $province_list_ar;
    public $city_list;
    public $city_list_ar;
    public function __construct( $data)
    {
        //
        $this->data = $data;
        $this->category_list = DB::table('categories')->get();
        foreach ($this->category_list as $key => $value) {
             $this->category_list_ar[$value->id] = $value->category_name;
        }
        $this->sub_list = DB::table('sub_category')->groupBy('category_id')->get();
        foreach ($this->sub_list as $key => $value) {
             $this->sub_list_ar[$value->id] = $value->category_id;
        }
        $this->province_list = DB::table('provinces')->get();
        foreach ($this->province_list as $key => $value) {
             $this->province_list_ar[$value->id] = $value->province_name;
        }
        $this->city_list = DB::table('cities')->get();
        foreach ($this->city_list as $key => $value) {
             $this->city_list_ar[$value->id] = $value->city_name;
        }
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
		Log::info('queued for update scraping...');
		$data = $this->data;
		$result = ScrapeUpdateJob::file_get_contents_curl("https://map.mirasapo.jp/new/" );
    }
	
	public function file_get_contents_curl($scrape_url) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $scrape_url);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);       
		
		$data = curl_exec($ch);
		curl_close($ch);
		// parse the html into a DOMDocument
		$dom = new DOMDocument();
		@$dom->loadHTML($data);
		// grab all the on the page
		$xpath = new DOMXPath($dom);
		$childElements = $xpath->query('//table[@class="table-result"]/tr');

		$count = 0;
		$scrape_flag = false;
		$policy_lists = [];
		for($i = 1; $i < $childElements->length; $i++){
			$child = $childElements[$i];
			$href = $child->getElementsByTagName('a');
			$url = $href[0]->getAttribute('href');
			$url = filter_var($url, FILTER_SANITIZE_URL);
			// validate url
			if(!filter_var($url, FILTER_VALIDATE_URL) === false){
				$temp = [];
				$count++;
				$scrape_flag = true;
				
				//url
				$temp['url'] = $url;
				
				//policy name_serve
				$name_serve = $href[0]->nodeValue;
				$temp['name_serve'] = $name_serve;
				
				//category
                $categories = $xpath->query(".//span[contains(@class, 'label-category')]", $child);
                $category = "";
                $category_flag = false;
                $temp_category_detail1 = [];
                // $category_list = DB::table('categories')->select('id','category_name')->get();
                $category_id = array();
                // dd( $category_list);
                for ($k = 0; $k<count($categories); $k++){
                    if(in_array($categories[$k]->nodeValue, $this->category_list_ar)) {
                        $category_id[] = array_search($categories[$k]->nodeValue, $this->category_list_ar);
                    }
                    // if ($category_flag)
                    //     $category.= "AND".$categories[$k]->nodeValue;
                    // else
                    //     $category.= $categories[$k]->nodeValue;
                    // $category_flag = true;

                    // $temp_category_detail2= [];
                    // $temp_category_detail2[] = $categories[$k]->nodeValue;
                    // $temp_category_detail2[]= array("すべて");
                    // $temp_category_detail1[] = $temp_category_detail2;
                }
                $temp['category'] = $category_id;
                // $temp['category_detail'] = json_encode($temp_category_detail1,JSON_UNESCAPED_UNICODE);

                $region = $xpath->query(".//td[contains(@class, 'text')]", $child);
                $temp['region'] = $region[1]->nodeValue;
                $temp['region'] = preg_replace('/\s+/', '', $temp['region']);
                // $temp_region1 = [];
                // $temp_region2 = [];
                // $temp_region2[] = $temp['region'];
                // $temp_region2[] = "";
                // $temp_region1[] = $temp_region2;
                // $temp['region_detail'] = json_encode($temp_region1, JSON_UNESCAPED_UNICODE);

                $temp['subscript_duration'] = $region[2]->nodeValue;
                
				$temp['update_date'] =  preg_replace('/\s+/', '', $region[2]->nodeValue);

				$rdate = str_replace("年","-",$temp['update_date']);
				$rdate = str_replace("月","-",$rdate);
				$rdate = str_replace("日","",$rdate);
				$temp['rdate'] = $rdate;
				
				if($category_id) $policy_lists[] = $temp;
			}
		}
		if (!$scrape_flag)
			$this->flag = true;

		$exist_flag = DB::table('policy_notification')->where('scrape_url',$policy_lists[0]['url'])
		->where('update_date',$policy_lists[0]['update_date'])->first();
		if (!$exist_flag) {
			if (DB::table('policy_notification')->first()) {
				$last_scraped_date = DB::table('policy_notification')->orderBy('id','desc')->first()->rdate;
			}
			else {
				$last_scraped_date = "2000-01-01";
			}
			$policy_lists_temp = [];
			for ($i = 0; $i< count($policy_lists); $i++) {
				$datetime1 = new DateTime($last_scraped_date);
				$datetime2 = new DateTime($policy_lists[$i]['rdate']);
				if ($datetime2<$datetime1)
					break;
				$policy_lists_temp[] = $policy_lists[$i];
				Log::info("Rdate:".$policy_lists[$i]['rdate']);
			}
			$policy_notification = [
				'scrape_url'=>$policy_lists[0]['url'],
				'update_date'=>$policy_lists[0]['update_date'],
				'rdate'=>$policy_lists[0]['rdate'],
			];
			DB::table('policy_notification')->insert($policy_notification);
			ScrapeUpdateJob::get_page_detail($policy_lists_temp);
		}
		else {
			Log::info('업데이트 및 추가없이 끝났습니다.');
		}

		return 0;
	}
    function innerHTML($el) {
        $doc = new DOMDocument();
        $doc->appendChild($doc->importNode($el, TRUE));
        $html = trim($doc->saveHTML($doc->documentElement));
        $html = html_entity_decode($html,ENT_HTML5, 'UTF-8');
//        Log::info(print_r($doc->saveHTML($doc->documentElement), true));
        Log::info("data log" . $html);
        $tag = $el->nodeName;
        return preg_replace('@^<' . $tag . '[^>]*>|</' . $tag . '>$@', '', $html);
    }
	public function get_page_detail($policy_lists) {
		for ($k = 0; $k< count($policy_lists);$k++){
			$url = $policy_lists[$k]['url'];

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
			$data = curl_exec($ch);
			curl_close($ch);
			// parse the html into a DOMDocument
			$dom = new DOMDocument();
			@$dom->loadHTML($data);
			
			// grab all the on the page
			$xpath = new DOMXPath($dom);
			
			$policy_lists[$k]['scraping_content'] = $xpath->evaluate("string(//div[contains(@class,'container')])");

			
			//register_insti
			$register_insti = $xpath->query("//div[contains(@class, 'author')]");
			$register_insti_temp  = $register_insti[0]->nodeValue;
			$register_insti_arr = explode("：", $register_insti_temp);
			if (count($register_insti_arr)>1)
				$policy_lists[$k]['register_insti'] = $register_insti_arr[1];
			else 
				$policy_lists[$k]['register_insti'] = $register_insti_temp;
			
			$childElements = $xpath->query('//div[@class="head"]');
			$policy_lists[$k]['name'] = $childElements[0]->getElementsByTagName('h1')[0]->nodeValue;
			
			$childElements = $xpath->query('//div[@class="ind"]');
			$child_p = $childElements[0]->getElementsByTagName('p');
			$policy_lists[$k]['target'] = $child_p[0]->nodeValue;
            $policy_lists[$k]['info'] = $this->innerHTML($child_p[1]);
            $policy_lists[$k]['support_content'] = $this->innerHTML($child_p[2]);
            $policy_lists[$k]['support_scale'] = $this->innerHTML($child_p[2]);
            $policy_lists[$k]['subscript_duration'] = $child_p[3]->nodeValue;
            $policy_lists[$k]['object_duration'] = $child_p[4]->nodeValue;

            if (count($child_p)==7) {
                $policy_lists[$k]['adopt_result'] = $child_p[5]->nodeValue;
                $policy_lists[$k]['inquiry'] = $this->innerHTML($child_p[6]);
            }
            else {
                $policy_lists[$k]['adopt_result'] = "";
                $policy_lists[$k]['inquiry'] =$this->innerHTML($child_p[5]);
            }

            $childElements = $xpath->query('//div[contains(@class, "link-nav")]');

            if ($childElements[0]->getElementsByTagName('li')[0]->getElementsByTagName('a')[0]){
                $res_pdf_link = $childElements[0]->getElementsByTagName('li')[0]->getElementsByTagName('a')[0]->getAttribute('href');
            }
            else {
                $res_pdf_link = '';
            }
			$ttt = [];
			$ttt[] = "PRチラシ・パンフレット";
			$ttt[] = $res_pdf_link;
            $ttt1 = [];
            if ($res_pdf_link !='')
                $ttt1[] = $ttt;
			
			$policy_lists[$k]['register_pdf'] = json_encode($ttt1, JSON_UNESCAPED_UNICODE);
			$exist_policy = DB::table('policy')->where('scraping_url',$policy_lists[$k]['url']);
			$id = $exist_policy->first()->id;
			if ($exist_policy->first()) {
				$data = [
					// 'category_detail'=>$policy_lists[$k]['category_detail'],
					// 'region_detail'=>$policy_lists[$k]['region_detail'],				
					'register_insti'=>$policy_lists[$k]['register_insti'],
					'register_insti_detail'=>$policy_lists[$k]['register_insti'],
					// 'category'=>$policy_lists[$k]['category'],
					// 'region'=>$policy_lists[$k]['region'],
					'update_date'=>$policy_lists[$k]['update_date'],
					'name'=>$policy_lists[$k]['name'],
					'name_serve'=>$policy_lists[$k]['name_serve'],
					'target'=>$policy_lists[$k]['target'],
					'info'=>$policy_lists[$k]['info'],
					'support_content'=>$policy_lists[$k]['support_content'],
					'support_scale'=>$policy_lists[$k]['support_scale'],
					'subscript_duration'=>$policy_lists[$k]['subscript_duration'],
					'object_duration'=>$policy_lists[$k]['object_duration'],
					'adopt_result'=>$policy_lists[$k]['adopt_result'],
					'register_pdf'=>$policy_lists[$k]['register_pdf'],
					'inquiry'=>$policy_lists[$k]['inquiry'],
					'scraping_content'=>$policy_lists[$k]['scraping_content']
				];
				$exist_policy->update($data);
				Log::info("Update된 시책 번호:".$this->total_count.":  시책id:".$exist_policy->first()->id."가 업데이트되였습니다.");
			}
			else {
				$data = [
					// 'category_detail'=>$policy_lists[$k]['category_detail'],
					// 'region_detail'=>$policy_lists[$k]['region_detail'],
					'register_insti'=>$policy_lists[$k]['register_insti'],
					'register_insti_detail'=>$policy_lists[$k]['register_insti'],
					'category'=>$policy_lists[$k]['category'],
					// 'region'=>$policy_lists[$k]['region'],
					// 'update_date'=>$policy_lists[$k]['update_date'],
					'name'=>$policy_lists[$k]['name'],
					'name_serve'=>$policy_lists[$k]['name_serve'],
					'target'=>$policy_lists[$k]['target'],
					'info'=>$policy_lists[$k]['info'],
					'support_content'=>$policy_lists[$k]['support_content'],
					'support_scale'=>$policy_lists[$k]['support_scale'],
					'subscript_duration'=>$policy_lists[$k]['subscript_duration'],
					'object_duration'=>$policy_lists[$k]['object_duration'],
					'adopt_result'=>$policy_lists[$k]['adopt_result'],
					'register_pdf'=>$policy_lists[$k]['register_pdf'],
					'inquiry'=>$policy_lists[$k]['inquiry'],
					'scraping_content'=>$policy_lists[$k]['scraping_content']
				];
				$id = DB::table('policy')->insertGetId($data);
	            
				Log::info("Update된 시책 번호:".$this->total_count." 가 새로 추가되였습니다.");
			}
			DB::table('policy_category')->where('policy_id',$id)->delete();
			DB::table('policy_region')->where('policy_id',$id)->delete();
			foreach ($policy_lists[$k]['category'] as $key => $value) {
                DB::table('policy_category')->insert([
                    'policy_id' => $id,
                    'category_id' => $value,
                    'sub_category_id' => array_search($value, $this->sub_list_ar),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }
            DB::table('policy_region')->insert([
                'policy_id' => $id,
                'province_id' => province_id($policy_lists[$k]['region'], $this->province_list_ar),
                'city_id' => city_id($policy_lists[$k]['region'], $this->city_list_ar),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
			$this->total_count++;
		}
		Log::info('업데이트 및 추가 진행있이 끝났습니다.');
	}
}
