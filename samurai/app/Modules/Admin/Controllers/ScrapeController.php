<?php

namespace App\Modules\Admin\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Policy;
use DOMDocument;
use DOMXPath;

class ScrapeController extends Controller
{
    public $category_list;
    public $category_list_ar;
    public $sub_list;
    public $sub_list_ar;
    public $province_list;
    public $province_list_ar;
    public $city_list;
    public $city_list_ar;
    public function __construct()
    {
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
    *   Created by  :   01/10/2018 
    *   Description :   get View getBalancedata
    *   @return     :
    */
    public function getBalancedata(Request $request)
    {
        $data = $this->balancedataArray($request);
        return view("Admin::master.balancedata", ['data'=>$data]);
    }
    /**
    *   Created by  :   vanluuit 30/09/2018 
    *   Description :   get View Search getScrape
    *   @return     :
    */
    public function getScrape(Request $request)
    {
        $scrape_links = DB::table('scrape_links')->get();
        $policys = Policy::with('scrape_links')->where('publication_setting', 1)->has('scrape_links');
        if($request->order) {
            if((int)$request->order == 1) {
                $policys = $policys->orderBy('id', 'desc');
            }
            if((int)$request->order == 2) {
                $policys = $policys->orderBy('id', 'asc');
            }
        }
        $policys = $policys->paginate(20);
        // dd($policys);
        return view("Admin::master.scrape",['scrape_links'=>$scrape_links,'policys'=>$policys]);
    }
    public function postScrape(Request $request)
    {
        $data['name'] = $request->namescrap;
        $data['url'] = $request->url;
        if(empty($data['name']) || empty($data['url'])) {
            return back();
        }
        $parse = parse_url($request->url);
        if($parse['host'] == 'map.mirasapo.jp') {
            $rs = DB::table('scrape_links')->insert($data);
        }
        return redirect('/admin/master/scrape');
    }

    public function getScrapeData(Request $request)
    {
        echo "queued for scratch scraping...";
        $ids = $request->scrape_id;
        foreach ($ids as $key => $id) {
            $scrap = DB::table('scrape_links')->where('id', $id)->first();
            if($scrap) {
                $scrape_url = $scrap->url;
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
                // $resultElements = $xpath->query('//table[@class="table-result"]');
                $childElements = $xpath->query('//tr');
                for($i = 1; $i < $childElements->length; $i++){
                    $data = [];
                    $child = $childElements[$i];
                    $href = $child->getElementsByTagName('a');
                    $url = $href[0]->getAttribute('href');
                    $url = filter_var($url, FILTER_SANITIZE_URL);

                    if(!filter_var($url, FILTER_VALIDATE_URL) === false){
                        $name_serve = $href[0]->nodeValue;
                        $itemchild = $xpath->query(".//td", $child);
                        $minitry = $itemchild[0]->nodeValue;
                        
                        $region = $itemchild[2]->nodeValue;
                        $region = preg_replace('/\s+/', '', $region);

                        $rdate = str_replace("年","-",$itemchild[4]->nodeValue);
                        $rdate = str_replace("月","-",$rdate);
                        $rdate = str_replace("日","",$rdate);
                        $rdate = preg_replace('/\s+/', '', $rdate );
                        $data = $this->get_page_detail($url);
                        $data['update_date'] = $rdate;
                        $data['scraping_url'] = $url;
                        $data['scrape_links_id'] = $scrap->id;
                        $data['name_serve'] = $name_serve;
                        $data['minitry_id'] = province_id($data['register_insti'], $this->province_list_ar);
                        $data['sub_minitry_id'] = city_id($data['register_insti'], $this->city_list_ar);
                        // $dt = [
                        //     'name'=>$data['name'],
                        //     'subscript_duration'=>$data['subscript_duration'],
                        //     'object_duration'=>$data['object_duration'],
                        // ];
                        $check = DB::table('policy')->where('name',$data['name'])->where('subscript_duration',$data['subscript_duration'])->where('object_duration',$data['object_duration'])->first();

                        // unset($data['name']);
                        // unset($data['subscript_duration']);
                        // unset($data['object_duration']);
                        
                        if(!$check) {
                            $data['tag'] = '[]';
                        }
                        $last_id=-1;
                        if(!$check) {
                            $last_id = DB::table('policy')->insertGetId($data);
                        }
                        if($last_id) {
                            DB::table('policy_region')->insert([
                                'policy_id' => $last_id,
                                'province_id' => province_id($region, $this->province_list_ar),
                                'city_id' => city_id($region, $this->city_list_ar),
                                'created_at' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s')
                            ]);
                        }
                        
                    }
                }
            }
        }
        return redirect('/admin/master/scrape');    
    }
    public function innerHTML($el) {
        $doc = new DOMDocument();
        $doc->appendChild($doc->importNode($el, TRUE));
        $html = trim($doc->saveHTML($doc->documentElement));
        $html = html_entity_decode($html,ENT_HTML5, 'UTF-8');
        $tag = $el->nodeName;
        $tag_r = preg_replace('@^<' . $tag . '[^>]*>|</' . $tag . '>$@', '', $html);
        $tagshow = str_replace('<br>', "\r\n", $tag_r);
        $tagshow = str_replace('<br >', "\r\n", $tagshow);
        $tagshow = str_replace('<br/>', "\r\n", $tagshow);
        $tagshow = str_replace('<br />', "\r\n", $tagshow);
        return $tagshow;
    }
    public function get_page_detail($url) {
        $array = [];
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
        $container = $xpath->evaluate("string(//div[contains(@class,'container')])");
        //register_insti
        $register_insti = $xpath->query("//div[contains(@class, 'author')]");
        $register_insti_temp  = $register_insti[0]->nodeValue;
        $register_insti_arr = explode("：", $register_insti_temp);
        if (count($register_insti_arr)>1)
            $array['register_insti'] = $register_insti_arr[1];
        else 
            $array['register_insti'] = $register_insti_temp;

        $array['register_insti_detail']=$array['register_insti'];

        $childElements = $xpath->query('//div[@class="head"]');
        $array['name'] = $childElements[0]->getElementsByTagName('h1')[0]->nodeValue;
        
        $childElements = $xpath->query('//div[@class="ind"]');
        $child_p = $childElements[0]->getElementsByTagName('p');
        $array['target'] = $child_p[0]->nodeValue;
        $array['info'] = $this->innerHTML($child_p[1]);
        $array['support_content'] = $this->innerHTML($child_p[2]);
        $array['support_scale'] = $this->innerHTML($child_p[2]);
        $array['subscript_duration'] = $child_p[3]->nodeValue;
        $array['object_duration'] = $child_p[4]->nodeValue;

        if (count($child_p)==7) {
            $array['adopt_result'] = $child_p[5]->nodeValue;
            $array['inquiry'] = $this->innerHTML($child_p[6]);
        }
        else {
            $array['adopt_result'] = "";
            $array['inquiry'] =$this->innerHTML($child_p[5]);
        }

        $childElements = $xpath->query('//div[contains(@class, "link-nav")]');

        if ($childElements[0]->getElementsByTagName('li')[0]->getElementsByTagName('a')[0]){
            $res_pdf_link = $childElements[0]->getElementsByTagName('li')[0]->getElementsByTagName('a')[0]->getAttribute('href');
        }
        else {
            $res_pdf_link = '';
        }
        if ($res_pdf_link !='') {
            $path = 'assets/pdf/'.date('Y').'/'.date('m').'/';
            // $fileName = $k.md5(date('Y-m-d-his')).'.pdf';
            $fileName = explode('?filename=', $res_pdf_link)[1];
            $fileName = explode('.pdf', $fileName)[0].'.pdf';
            $fileName = urldecode($fileName);
            $url_pdf = $path.$fileName;
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            get_pdf_scraping($url_pdf, $res_pdf_link);
            $ttt = [];
            $ttt['name'] = "PRチラシ・パンフレット";
            $ttt['url'] = $url_pdf;
            $ttt1 = [];
            $ttt1[] = $ttt;
            $array['register_pdf'] = json_encode($ttt1);
        }else{
            $array['register_pdf'] = '';
        }
        
        return $array;
    }
   
}