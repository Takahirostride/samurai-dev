<?php

namespace App\Modules\Admin\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Modules\Admin\Models\Address;
use App\Modules\Admin\Models\Province;
class AdminController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        return view("Admin::auth.login");
    }
    public function getProvince(Request $request){
        if(!$request->ajax()){ abort(404);}
        $p2c = Address::provinceCity();
        return response()->json($p2c);

    }   
    public function getMinitry(Request $request){
        if(!$request->ajax()){ abort(404);}
        $p2c = Province::listProvince();
        return response()->json($p2c);

    }   
    public function getProvinceMinitry(Request $request){
    	if(!$request->ajax()){ abort(404);}
    	$p2c = Province::listProvinceMinitry();
    	return response()->json($p2c);

    }	

}