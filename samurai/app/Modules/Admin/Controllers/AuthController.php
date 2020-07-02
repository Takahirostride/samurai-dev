<?php

namespace App\Modules\admin\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session, Cookie, DB, Log;

class AuthController extends Controller
{
    /**
    *   Created by  :   vanluuit 30/09/2018 
    *   Description :   do login
    *   @return     :
    */
    public function doLogin(Request $request){
        $login_id = $request->login_id;
        $password = $request->password;
        $admin = DB::table('admin')->where('login_id', $login_id)->where('password', md5($password))->first();
        if ($admin){
            if ($admin->usage_flag == 0) {
                Log::info($login_id.' User Failed to login.. Recycled user');
                return back()->withInput()->with('flash',['class'=>'failed-msg', 'mes'=>$login_id.' User Failed to login.. Recycled user']);
            }
            else {
                Log::info($login_id.' User Succeed to login.. ');
                $ip_address =  \Request::ip();
                $staff_id = $admin->staff_id;
                $staff_name = $admin->name;
                $rs = DB::table('admin_login_info')->insert([
                    'staff_id' => $staff_id,
                    'staff_name' => $staff_name,
                    'ipaddress' => $ip_address,
                ]);
                Log::info($login_id.' Session');
                session(['admin_logged'=>true, 'id' =>$admin->id , 'admin_name'=>$admin->name, 'admin_id' => $admin->login_id, 'admin_permission'=>$admin->permission]);
                if($admin->permission == 0) {
                    return redirect('/admin/master');
                }else{
                    return redirect('/admin/employee');
                }
            }
        }
        else {
            Log::info($login_id.' User Failed to login.. Recycled user');
            return back()->withInput()->with('flash',['class'=>'failed-msg', 'mes'=>$login_id.' User Failed to login.. Recycled user']);
        }
    }
    /**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   do logout
    *   @return     :
    */
    public function doLogout()
    {
        session()->forget(['admin_logged', 'admin_name', 'admin_id']);
        return redirect('/admin');
        
    }
    /**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   is_admin
    *   @return     :
    */
    public static function is_admin()
    {
        if (session('admin_logged')) {
            return true;
        }
        return false;
    }
    public static function permission()
    {
        if (session('admin_permission')) {
            return session('admin_permission');
        }
        return false;
    }
}