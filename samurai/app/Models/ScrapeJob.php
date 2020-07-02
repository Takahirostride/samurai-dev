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

class ScrapeJob implements ShouldQueue
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
    public function __construct( $data)
    {
        //
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        Log::info('queued for scratch scraping...');
        $data = $this->data;
        $page_count = $data['page_count'];
        DB::table('policy')->truncate();

        for ($page_count = 1; $page_count < 100000; $page_count++) {
            if ($this->flag) break;
            $result = ScrapeJob::file_get_contents_curl("https://map.mirasapo.jp/search/?&page=".$page_count,$page_count);

            Log::info("초기스크래핑페지:".$page_count);
        }
    }

    public function file_get_contents_curl($scrape_url, $page_count) {
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
        $childElements = $xpath->query('//tr[@class="subsidy-row"]');

        $count = 0;
        $scrape_flag = false;
        $policy_lists = [];
        for($i = 0; $i < $childElements->length; $i++){
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
                for ($k = 0; $k<count($categories); $k++){
                    if ($category_flag)
                        $category.= "AND".$categories[$k]->nodeValue;
                    else
                        $category.= $categories[$k]->nodeValue;
                    $category_flag = true;

                    $temp_category_detail2= [];
                    $temp_category_detail2[] = $categories[$k]->nodeValue;
                    $temp_category_detail2[]= array("すべて");
                    $temp_category_detail1[] = $temp_category_detail2;
                }
                $temp['category'] = $category;
                $temp['category_detail'] = json_encode($temp_category_detail1,JSON_UNESCAPED_UNICODE);

                $region = $xpath->query(".//td[contains(@class, 'text')]", $child);
                $temp['region'] = $region[1]->nodeValue;
                $temp['region'] = preg_replace('/\s+/', '', $temp['region']);
                $temp_region1 = [];
                $temp_region2 = [];
                $temp_region2[] = $temp['region'];
                $temp_region2[] = "";
                $temp_region1[] = $temp_region2;
                $temp['region_detail'] = json_encode($temp_region1, JSON_UNESCAPED_UNICODE);

                $temp['subscript_duration'] = $region[2]->nodeValue;

                $policy_lists[] = $temp;
            }
        }
        if (!$scrape_flag)
            $this->flag = true;

        $policy_lists_temp = [];
        for ($k = 0; $k< count($policy_lists); $k++) {
            if (!DB::table('policy')->where('scraping_url',$policy_lists[$k]['url'])->first()) {
                $policy_lists_temp[] = $policy_lists[$k];
            }
        }
        dd($temp);
        ScrapeJob::get_page_detail($policy_lists_temp);

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

            //Log::info("현재 스크래핑하는 시책NO:".$this->total_count);

            /*echo '<div style="font-size:20px;font-weight:bold;color:red;">No'.$this->total_count.':</div>
            Policy Name: '.$policy_lists[$k]['name'].' <br/> Register_insti:'.
            $policy_lists[$k]['register_insti'].'<br /> URL:'
            .$policy_lists[$k]['url']
            .' <br /> Category:'.$policy_lists[$k]['category']
            .' <br/> Region:'.$policy_lists[$k]['region']
            .' <br/> Subscript Duration:'.$policy_lists[$k]['subscript_duration']
            .'</br>	target:'.$policy_lists[$k]['target']
            .'</br>	info:'.$policy_lists[$k]['info']
            .'</br>	support_content:'.$policy_lists[$k]['support_content']
            .'</br>	support_scale:'.$policy_lists[$k]['support_scale']
            .'</br>	subscript_duration:'.$policy_lists[$k]['subscript_duration']
            .'</br>	object_duration:'.$policy_lists[$k]['object_duration']
            .'</br>	adopt_result:'.$policy_lists[$k]['adopt_result']
            .'</br>	inquiry:'.$policy_lists[$k]['inquiry']
            .'</br>	register_pdf:'.$policy_lists[$k]['register_pdf']
            .' <br/><br/>';*/
            $this->total_count++;

            $query = "insert into policy(image_id, category_detail,region_detail,register_insti,register_insti_detail,
			category,`tag`,region,update_date,name,name_serve,target,info,support_content,
			support_scale,subscript_duration,object_duration,adopt_result,register_pdf,
			inquiry,scraping_url, scraping_content) values ('assets/img/policy_sample.jpg','".$policy_lists[$k]['category_detail']."','".$policy_lists[$k]['region_detail']."',
			'".$policy_lists[$k]['register_insti']."','".$policy_lists[$k]['register_insti']."','".$policy_lists[$k]['category']."','[]','".$policy_lists[$k]['region']."',
			'2017-11-24','".$policy_lists[$k]['name']."','".$policy_lists[$k]['name_serve']."',
			'".$policy_lists[$k]['target']."','".$policy_lists[$k]['info']."','".$policy_lists[$k]['support_content']."',
			'".$policy_lists[$k]['support_scale']."','".$policy_lists[$k]['subscript_duration']."','".$policy_lists[$k]['object_duration']."',
			'".$policy_lists[$k]['adopt_result']."','".$policy_lists[$k]['register_pdf']."','".$policy_lists[$k]['inquiry']."',
			'".$policy_lists[$k]['url']."','".$policy_lists[$k]['scraping_content']."');";

            mysqli_query(DBOpen(), $query);

        }
    }
}
