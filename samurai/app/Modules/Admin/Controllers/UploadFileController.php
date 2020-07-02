<?php

namespace App\Modules\Admin\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\WorkSet;
use App\Models\Hire;

class UploadFileController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    /**
    *   Created by  :   vnaluuit - 20/08/2018 
    *   Description :   get View master Uploaded
    *   @return     :
    */
    public function getUploaded(Request $request)
    {
        // $work_set = WorkSet::orderBy('id', 'asc')->with('work_set_sub')->with('hire')->has('work_set_sub')->paginate(10);
        $values = Hire::with(['workset','from', 'to', 'policy'])->with('workset.work_set_sub');
        //request-condition
        if($request->filled('s_year')){
            $month = $request->filled('s_month') ? $request->query('s_month') : '00';
            $s_date = [$request->query('s_year'),$month,'00'];
            $s_date_str = implode('-',$s_date);    
            $values=$values->where('created_at','>=',$s_date_str);
        }         
        if($request->filled('e_year')){
            $month = $request->filled('e_month') ? $request->query('e_month') : '00';
            $e_date = [$request->query('e_year'),$month,'00'];
            $e_date_str = implode('-',$e_date);
            $values=$values->where('created_at','<=',$e_date_str);
        }         
        if($request->filled('keyword')){
            $keyword = trim($request->query('keyword'));
            $values = $values->whereHas('policy',function($qr) use($keyword){
                $qr->where('name','like',"%{$keyword}%");
            });
        }
        $finish_flag = $request->query('finish_flag');
        if($finish_flag || $finish_flag === 0 || $finish_flag === '0'){
            $values = $values->where('finish_flag','=',$finish_flag);
        }
        //
        $order = 'id';
        $sort = 'desc';
        $matching_lists = $values->orderBy($order,$sort)->paginate(10);
        // dd($matching_list);
        return view("Admin::master.uploaded",['matching_lists'=>$matching_lists]);
    }	

    /**
    *   Created by  :   vnaluuit - 20/08/2018 
    *   Description :   get View employee Upload file
    *   @return     :
    */
    public function getUploadfile()
    {
        return view("Admin::employee.uploadfile");
    }   
}