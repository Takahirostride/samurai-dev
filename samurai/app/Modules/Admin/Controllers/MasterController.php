<?php

namespace App\Modules\Admin\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Models\AdminEditInfo;
use DB;
use Log;

class MasterController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getIndex()
    {
        $infos = DB::table('admin_edit_info')->orderBy('edit_time', 'desc')->paginate(1000);
        return view("Admin::master.index", ['infos'=>$infos]);
    }
    /**
    *   Created by  :   vanluuit 30/09/2018 
    *   Description :   get View Search getLoginhistory
    *   @return     :
    */
    public function getLoginhistory(Request $request)
    {
        $search = $request->search;
        $type = ($request->type == '') ? 'logged_time' : $request->type;
        $param['logged_time'] = ($request->logged_time == 1) ? 'asc' : 'desc';
        $param['staff_id'] = ($request->staff_id == 1) ? 'asc' : 'desc';
        $param['staff_name'] = ($request->staff_name == 1) ? 'asc' : 'desc';
        $param['ipaddress'] = ($request->ipaddress == 1) ? 'asc' : 'desc';
        Log::info('Login History.. ');
        $login_infos = DB::table('admin_login_info');
        if (!empty($search))
        {
            $login_infos = $login_infos->where('staff_name', 'like', '%'.$search.'%');
        }
        $login_infos = $login_infos->orderBy($type,  $param[$type])
                        ->orderBy('logged_time',  $param['logged_time'])
                        ->orderBy('staff_id',  $param['staff_id'])
                        ->orderBy('staff_name',  $param['staff_name'])
                        ->orderBy('ipaddress',  $param['ipaddress']);

        $login_infos = $login_infos->paginate(15);
        return view("Admin::master.loginhistory", ['login_infos'=>$login_infos]);
    }
    /**
    *   Created by  :   vanluuit 30/09/2018 
    *   Description :   get View Search getEdithistory
    *   @return     :
    */
    public function getEdithistory(Request $request)
    {
        $search = $request->search;
        $type = ($request->type == '') ? 'edit_time' : $request->type;
        $param['edit_time'] = ($request->edit_time == 1) ? 'asc' : 'desc';
        $param['staff_id'] = ($request->staff_id == 1) ? 'asc' : 'desc';
        $param['staff_name'] = ($request->staff_name == 1) ? 'asc' : 'desc';
        $param['edit_page'] = ($request->edit_page == 1) ? 'asc' : 'desc';
        $param['edit_content'] = ($request->edit_content == 1) ? 'asc' : 'desc';
        Log::info('Login History.. ');
        $edit_infos = DB::table('admin_edit_info');
        if (!empty($search))
        {
            $edit_infos = $edit_infos->where('staff_name', 'like', '%'.$search.'%');
        }
        $edit_infos = $edit_infos->orderBy($type,  $param[$type])
                        ->orderBy('edit_time',  $param['edit_time'])
                        ->orderBy('staff_id',  $param['staff_id'])
                        ->orderBy('staff_name',  $param['staff_name'])
                        ->orderBy('edit_page',  $param['edit_page'])
                        ->orderBy('edit_content',  $param['edit_content']);

        $edit_infos = $edit_infos->paginate(15);
        return view("Admin::master.edithistory", ['edit_infos'=>$edit_infos]);
    }
    /**
    *   Created by  :   vanluuit 30/09/2018 
    *   Description :   get View Search getEmployeeedit
    *   @return     :
    */
    public function getEmployeeedit(Request $request)
    {
        $id = $request->id;
        $search = $request->search;
        $staffs = DB::table('admin')->select('id','staff_id','name','login_id','permission','created_date')->where('usage_flag', 1);
        if (!empty($search))
        {
            $staffs = $staffs->where('name', 'like', '%'.$search.'%');
        }
        $staffs = $staffs->get();
        Log::info('Getting Staffs List: ');
        $data = $request;
        if(!empty($id))
        {
            $data = DB::table('admin')->select('staff_id','name','login_id','permission','created_date')->where('id', $id)->first();
        }
        return view("Admin::master.employeeedit",['staffs'=>$staffs, 'data' => $data]);
        
    }

    /**
    *   Created by  :   vanluuit 30/09/2018 
    *   Description :   get View Search getEmployeeedit
    *   @return     :
    */
    public function staffRegister(Request $request){
        $login_id = $request->login_id;
        $exist_flag = DB::table('admin')->where('login_id', $login_id)->first();
        if ($exist_flag) {
            Log::info('Staffs Already Exist.. Can`t register');
            return back()->withInput()->with('flash',['class'=>'failed-msg', 'mes'=>'ログインidが既に存在します。']);
        }
        $password = $request->password;
        $name  = $request->name;
        $permission = $request->permission - 1;
        $staff_id =  md5_hex_to_dec(md5(date('Y-m-d H:i:s').$login_id));
        $date = date('Y-m-d H:i:s');
        $rs = DB::table('admin')->insert([
            'login_id' => $login_id,
            'password' => md5($password),
            'name' => $name,
            'staff_id' => $staff_id,
            'permission' => $permission,
            'created_date' => $date,
        ]);

        if ($rs){
            Log::info('Staffs Register Success');
            AdminEditInfo::add_info('スタッフの管理画面', '新しい従業員を登録しました。');
            return redirect('/admin/master/employeeedit')->with('flash',['class'=>'failed-msg', 'mes'=>'新規スタッフを登録しました。']);
        }
        else{
            Log::info('Staffs Register Failed');
            return back()->withInput()->with('flash',['class'=>'failed-msg', 'mes'=>'server failed: unknown reason']);
        }
    }
    /**
    *   Created by  :   vanluuit 30/09/2018 
    *   Description :   get View Search getEmployeeedit
    *   @return     :
    */
    public function staffEdit(Request $request){
        $staff_id = $request->staff_id;
        $login_id = $request->login_id;
        $password = $request->password;
        $permission = $request->permission-1;
        $name = $request->name;
        
        $row = DB::table('admin')->where('staff_id', $staff_id);
        if ($row->update(['login_id'=>$login_id,'password'=>md5($password),'permission'=>$permission,'name'=>$name])){
            Log::info('Staffs Edit Success');
            AdminEditInfo::add_info('スタッフの管理画面', $staff_id.'スタッフを編集しました。');
            return redirect('/admin/master/employeeedit')->with('flash',['class'=>'success-msg', 'mes'=>'スタッフ情報を編集しました。']);
        }
        else {
            if ($row->first()) {
                if (($row->first()->login_id == $login_id) && ($row->first()->password == md5($password))&& ($row->first()->name == $name)&& ($row->first()->permission == $permission)){
                    Log::info('Staffs Edit Already Exist.. Does not change');
                    return back()->withInput()->with('flash',['class'=>'failed-msg', 'mes'=>'スタッフ情報を編集しました。']);
                }
            }
            Log::info('Result Failed... What will be the reason?');
            return back()->withInput()->with('flash',['class'=>'failed-msg', 'mes'=>'server failed: unknown reason']);
        }
    }
    /**
    *   Created by  :   vanluuit 30/09/2018 
    *   Description :   get View Search getProfile
    *   @return     :
    */
    public function getProfile()
    {
        return view("Admin::master.profile");
    }
    /**
    *   Created by  :   vanluuit 30/09/2018 
    *   Description :   get View Search getScrape
    *   @return     :
    */
    public function master(Request $request)
    {
        $id = $request->beforeid;
        $password = $request->beforepassword;
        $new_id = $request->nextid;
        $new_password = $request->nextpassword;
        $exist_flag = DB::table('admin')->where('login_id', $new_id)->first();
        if ($exist_flag) {
            Log::info(' Existing ID');
            return back()->withInput()->with('flash',['class'=>'failed-msg', 'mes'=>'新しい管理者IDが既に存在します。']);
        }

        $exist_flag = DB::table('admin')->where('login_id', $id);
        if (!$exist_flag->first()) {
            Log::info(' Master ID not correct');
             return back()->withInput()->with('flash',['class'=>'failed-msg', 'mes'=>'現在の管理者IDが存在しません。']);
        }

        if ($exist_flag->first()->password != md5($password)){
            Log::info(' Master Password not correct');
             return back()->withInput()->with('flash',['class'=>'failed-msg', 'mes'=>'現在の管理者パスワードが一致しません。']);
        }

        if ($exist_flag->first()->permission != 0) {
            Log::info('This is not master...');
             return back()->withInput()->with('flash',['class'=>'failed-msg', 'mes'=>'現在の管理者IDが存在しません。']);
        }
        $exist_flag->update(['login_id'=>$new_id,'password'=>md5($new_password)]);
        Log::info('Master Edit Success');
        return redirect('/admin/master/profile')->with('flash',['class'=>'success-msg', 'mes'=>'ログイン設定を登録しました。']);
    }
}