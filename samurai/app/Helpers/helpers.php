<?php

if (! function_exists('createDate')) {
    function createDate($year, $month, $date)
    {	
    	$create_date	=	'';
        if($year > 0 && $month > 0 && $date > 0) {
            $create_date = $year.'-'.$month.'-'.$date;
        }
        return $create_date;
    }
    
    function md5_hex_to_dec($hex_str)
    {
        $arr = str_split($hex_str, 4);
        foreach ($arr as $grp) {
            $dec[] = str_pad(hexdec($grp), 5, '0', STR_PAD_LEFT);
        }
        return implode('', $dec);
    }    
}
function ol_number_display($dt){
  if(empty($dt)){ return null;}
  return number_format($dt);
}
function ol_string2number($dt){
  if(empty($dt)){ return null;}
  $dt = preg_replace('/[^0-9\.]+/i','', $dt);
  return intval($dt);
}
function ol_array_to_attribute($ars,$exc=[]){
    if(empty($ars)){ return '';}
    $atts = array_map(function($key,$ite) use($exc){
        if(is_numeric($key)){ return $ite;}
        if(in_array($key,$exc)){ return '';}        
        return "{$key}='{$ite}'";
    },array_keys($ars),$ars);
    return implode(' ',$atts);
}
function ol_get_sort_link($title,$tit_dis=null){
    $cur_sort = request()->query('sort');
    $cur_order = request()->query('order');
    $order = 'asc';
    $class = 'sort';
    if($cur_sort == $title){
        $order = ($cur_order == 'desc') ? 'asc' : 'desc';
        $class = ($cur_order == 'desc') ? 'table-arrow-top' : 'table-arrow';
    }
    $url = request()->fullUrlWithQuery(['sort'=>$title,'order'=>$order]);
    $output = '<a href="'.$url.'" class="lnk-sort">'.$tit_dis.'<span class="'.$class.'"></span></a>';
    return $output;
}
function ol_get_link_file($dt){
        $link = str_replace("AND&","/",$dt);
        $file = asset($link); 
        return $file;    
}
function ol_get_date_string($dt){
    if(empty($dt) || $dt==='0000-00-00'){return null;}
    if(is_string($dt)){
        $dt = Carbon\Carbon::createFromFormat('Y-m-d',$dt);
    }
    return $dt->format('Y年m月d日');
}
function ol_get_date_string_time($dt){
    if(empty($dt) || $dt==='0000-00-00 00:00:00'){return null;}
    if(is_string($dt)){
        $dt = Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$dt);
    }
    return $dt->format('Y年m月d日');
}

function ol_get_date_string_step($dt,$sep='/'){
    if(empty($dt) || $dt==='0000-00-00'){return null;}
    if(is_string($dt)){
        $dt = Carbon\Carbon::createFromFormat('Y-m-d',$dt);
    }
    return $dt->format("Y{$sep}m{$sep}d");
}
function ol_get_date_html($dt){
    if(empty($dt) || $dt==='0000-00-00'){return null;}
    if(is_string($dt)){
        $dt = Carbon\Carbon::createFromFormat('Y-m-d',$dt);
    }
    return "{$dt->year}<span>年</span>{$dt->month}<span>月</span>{$dt->day}<span>日</span>";
}
function ol_get_month_day_string($dt){
    if(empty($dt) || $dt==='0000-00-00'){return null;}
    if(is_string($dt)){
        $dt = Carbon\Carbon::createFromFormat('Y-m-d',$dt);
    }
    return $dt->format('m月d日');
}
function ol_get_datetime_string($dt){
    if(empty($dt) || $dt==='0000-00-00'){return null;}
    if(is_string($dt)){
        $dt = Carbon\Carbon::createFromFormat('Y-m-d-H-i',$dt);
    }
    return $dt->format('Y年m月d日 H:i');
}
function ol_replace_unicode_escape_sequence($match) {
    return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UCS-2BE');
}
function ol_unicode_decode($str) {
    return preg_replace_callback('/u([0-9a-f]{4})/i', 'ol_replace_unicode_escape_sequence', $str);
}
function date_string($date, $format = 'Y-m-d')
{
    if(empty($date) || $date==='0000-00-00' || $date==='0000-00-00 00:00:00' ){return '0000年00月00日';}
    if(is_string($date)){
        $date = Carbon\Carbon::createFromFormat($format,$date);
    }
    return $date->format('Y年m月d日');
}
function ddate_string($date)
{
    if(empty($date) || $date==='0000-00-00' || $date==='0000-00-00 00:00:00' ){return '0000年00月00日';}
    if(is_string($date)){
        $date = date('Y年m月d日', strtotime($date) );
    }
    return $date;
}
function dstring_to_date($string)
{
  return str_replace(['年', '月', '日'], ['-', '-', ''], $string);
}
function year_date_string($date, $format = 'Y-m-d')
{
    if(empty($date) || $date==='0000-00-00'){return '00月00日';}
    if(is_string($date)){
        $date = Carbon\Carbon::createFromFormat($format,$date);
    }
    return $date->format('m月d日');
}
function WorkSetString($contents, $otherFlag, $otherString)
{
    $tempstr = '';
    $savedstring = ['書類完成日','提出書類','本申請','採択日','受給申請','受給','確定通知書','支払'];

    $contentarr = @json_decode($contents);
    for($i = 0; $i < count($contentarr); $i++){
        $tempstr .= $savedstring[$contentarr[$i]];
        if($i+1 != count($contentarr) )
            $tempstr .= ' , ';
    }
        if($otherFlag == 1)
            $tempstr .= " , " . $otherString;
        return $tempstr;
}
function getAcquireStatus($index = 0)
{
    if($index == null) $index = 0;
    $arr = ["未請求","請求中","再請求依頼","請求済み"];
    return @$arr[$index];
}
function estable_date_to_array($date)
{
    if($date == '0000-00-00') return [date('Y'), date('m'), date('d')];
    $dateS = explode('-', $date);
    return $dateS;
}
function NotificationString($notifications) {
        $tempstr = '';
        for($i = 0; $i < count($notifications); $i++){
            $tempstr .= $notifications[$i];
            if( ($i + 1) != count($notifications) ) 
                $tempstr += ' , ';
        }
        return $tempstr;
    }
// beginthen
function getifmosaicsubsidy($json_arr,$value){
        $temp = json_decode($json_arr, true);
        if ($value == 0) {
            if (array_search(0,$temp) == false)
                return 1;
            else
                return 0;
        }
        else
            return 1;
}
function get_year_select(){
    $year = date('Y');
    $arr_year = [];
    for ( $i= $year-2 ; $i <= $year + 8  ; $i++) { 
        $arr_year[] = $i;
    }
    return $arr_year;
}
function get_mon_select(){
    $arr_mon = [];
    for ( $i= 1 ; $i <= 12  ; $i++) { 
        $arr_mon[] = $i;
    }
    return $arr_mon;
}
function pay($params){
    if($params["aid"] || $params["cod"] || $params["jb"] || $params["rt"] || $params["pn"] || $params["em"] || $params["am"] || $params["tx"] || $params["sf"] || $params["pn"] || $params["nmf"] || $params["po"]) {


      $params = array(
          'aid' => $params["aid"] ,
          'cod' => $params["cod"] ,
          'jb' => $params["jb"] ,
          'rt' => $params["rt"] ,
          'pn' => $params["pn"] ,
          'em' => $params["em"] ,
          'am' => $params["am"] ,
          'tx' => $params["tx"] ,
          'sf' => $params["sf"] ,
          'pn' => $params["pn"],
          'nmf' => $params["nmf"],
          'po' => $params["po"]
      );

      $url = "https://credit.j-payment.co.jp/gateway/bank.aspx";
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
      curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
      curl_setopt($ch, CURLOPT_TIMEOUT, 60);

      $result = curl_exec($ch);
      if(curl_errno($ch) !== 0) {
          error_log('cURL error when connecting to ' . $url . ': ' . curl_error($ch));
      }

      curl_close($ch);

      echo gettype($result);
      print_r($result); 

   }
}
// beginend
// beginluu
function existquestioncheck($ar, $content ,$index) {
  if(!empty($ar)) {
    foreach ($ar as $key => $value) {
        if($value[1] === $content){
            return $value[$index];
        }
    }
  }
  return false;
}
function strdatecover($str) {
  if(!empty($str)) {
    $str = str_replace('年', '-', $str);
    $str = str_replace('月', '-', $str);
    $str = str_replace('日', '', $str);
  }else{
    $str=date('Y-m-d');
  }
  return $str;
}

function city_id($str, $ar) {
  foreach ($ar as $key => $value) {
    if(strpos('ccc'.$str, $value)) {
      return $key;
    }
  }
  return 0;
}
function province_id($str, $ar) {

  foreach ($ar as $key => $value) {
    if(strpos('ccc'.$str, $value)) {
      return $key;
    }
  }
  return 0;
}

function get_pdf_scraping($path, $url_pdf) {
    $output_filename = $path;
    $userAgent = 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0';
    $ch = curl_init();
    curl_setopt( $ch, CURLOPT_USERAGENT, $userAgent );
    curl_setopt($ch, CURLOPT_URL, $url_pdf);
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_AUTOREFERER, false);
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $result = curl_exec($ch);
    curl_close($ch);
    $fp = fopen($output_filename, 'w');
    fwrite($fp, $result);
    fclose($fp);
} 
