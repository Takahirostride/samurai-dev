<?php

namespace App\Modules\Admin\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Csv;
use DB;

class CSVController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    /**
    *   Created by  :   vanluuit - 20/08/2018 
    *   Description :   get View getCsvmanagement
    *   @return     :
    */
    public function getCsvmanagement()
    {
        return view("Admin::master.csvmanagemen");
    }

    /**
    *   Created by  :   vanluuit - 20/08/2018 
    *   Description :   get View getCsvmanagement
    *   @return     :
    */
    public function getCsv()
    {
        return view("Admin::employee.csv");
    }

    /**
    *   Created by  :   vanluuit - 20/08/2018 
    *   Description :   import user csv
    *   @return     :
    */
    public function importUser(Request $request)
    {
        $file = $request->filecsv->path();
        $ext = $request->filecsv->getClientOriginalExtension();
        if (strtolower($ext) != "csv") {
            return back()->withInput()->with('flash',['class'=>'failed-msg', 'mes'=>'CSVファイルではありません。']);
        }
        $rs = Csv::importCsv($file, 'users', 'id');
        return redirect('/admin/master/csvmanagement')->with('flash',['class'=>'success-msg', 'mes'=>"CSVファイルから" . $rs . "件のデーターを取り込みました。"]);
    }
    /**
    *   Created by  :   vanluuit - 20/08/2018 
    *   Description :   import Affiliate csv
    *   @return     :
    */
    public function importAffiliate(Request $request)
    {
        $file = $request->filecsv->path();
        $ext = $request->filecsv->getClientOriginalExtension();
        if (strtolower($ext) != "csv") {
            return back()->withInput()->with('flash',['class'=>'failed-msg', 'mes'=>'CSVファイルではありません。']);
        }
        $rs = Csv::importCsv($file, 'user_affiliate', 'id');
        return redirect('/admin/master/csvmanagement')->with('flash',['class'=>'success-msg', 'mes'=>"CSVファイルから" . $rs . "件のデーターを取り込みました。"]);
    }
    /**
    *   Created by  :   vanluuit - 20/08/2018 
    *   Description :   import Matching csv
    *   @return     :
    */
    public function importMatching(Request $request)
    {
        $file = $request->filecsv->path();
        $ext = $request->filecsv->getClientOriginalExtension();
        if (strtolower($ext) != "csv") {
            return back()->withInput()->with('flash',['class'=>'failed-msg', 'mes'=>'CSVファイルではありません。']);
        }
        $rs = Csv::importCsv($file, 'matching', 'id');
        return redirect('/admin/master/csvmanagement')->with('flash',['class'=>'success-msg', 'mes'=>"CSVファイルから" . $rs . "件のデーターを取り込みました。"]);
    }
    /**
    *   Created by  :   vanluuit - 20/08/2018 
    *   Description :   import Policy csv
    *   @return     :
    */
    public function importPolicy(Request $request)
    {
        $file = $request->filecsv->path();
        $ext = $request->filecsv->getClientOriginalExtension();
        if (strtolower($ext) != "csv") {
            return back()->withInput()->with('flash',['class'=>'failed-msg', 'mes'=>'CSVファイルではありません。']);
        }
        $rs = Csv::importCsv($file, 'policy', 'id');
        return redirect('/admin/master/csvmanagement')->with('flash',['class'=>'success-msg', 'mes'=>"CSVファイルから" . $rs . "件のデーターを取り込みました。"]);
    }
    /**
    *   Created by  :   vanluuit - 20/08/2018 
    *   Description :   import Agency Policy csv
    *   @return     :
    */
    public function importAgencyPolicy(Request $request)
    {
        $file = $request->filecsv->path();
        $ext = $request->filecsv->getClientOriginalExtension();
        if (strtolower($ext) != "csv") {
            return back()->withInput()->with('flash',['class'=>'failed-msg', 'mes'=>'CSVファイルではありません。']);
        }
        $rs = Csv::importCsv($file, 'policy', 'id');
        return redirect('/admin/master/csvmanagement')->with('flash',['class'=>'success-msg', 'mes'=>"CSVファイルから" . $rs . "件のデーターを取り込みました。"]);
    }
    /**
    *   Created by  :   vanluuit - 20/08/2018 
    *   Description :   download user 0
    *   @return     :
    */
    public function downUser($manage_flag)
    {
        if ($manage_flag == 0)
            $filename = "士業一覧";
        else if ($manage_flag == 1)
            $filename = "事業者一覧";
        else 
            return;
        $filename .=  "_" . date('YmdHis');
        $users = DB::table('users')->where("manage_flag", $manage_flag)->get();
        $data   =   json_decode(json_encode($users), true);
        Csv::downloadCsv($data, $filename);
    }

    /**
    *   Created by  :   vanluuit - 07/10/2018 
    *   Description :   download affiliate
    *   @return     :
    */
    public function downAffiliate()
    {
        $filename =  "アフィリエイター一覧_" . date('YmdHis');
        $user_affiliate = DB::table('user_affiliate')->get();
        $data   =   json_decode(json_encode($user_affiliate), true);
        Csv::downloadCsv($data, $filename);
    }

    /**
    *   Created by  :   vanluuit - 07/10/2018 
    *   Description :   download matching
    *   @return     :
    */
    public function downMatching()
    {
        $filename =  "マッチング一覧_" . date('YmdHis');
        $matching = DB::table('matching')->get();
        $data   =   json_decode(json_encode($matching), true);
        Csv::downloadCsv($data, $filename);
    }

    /**
    *   Created by  :   vanluuit - 07/10/2018 
    *   Description :   download matching
    *   @return     :
    */
    public function downPolicy()
    {
        $filename =  "助成金データ_" . date('YmdHis');
        $policy = DB::table('policy')->where('display_option', '<=', 1)->get();
        $data   =   json_decode(json_encode($policy), true);
        Csv::downloadCsv($data, $filename);
    }

    /**
    *   Created by  :   vanluuit - 07/10/2018 
    *   Description :   download Agency Policy
    *   @return     :
    */
    public function downAgencyPolicy()
    {
        $filename =  "士業登録助成金データ_" . date('YmdHis');
        $policy = DB::table('policy')->where('display_option', '>=', 1)->get();
        $data   =   json_decode(json_encode($policy), true);
        Csv::downloadCsv($data, $filename);
    }
}