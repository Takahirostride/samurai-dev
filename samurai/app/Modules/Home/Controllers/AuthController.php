<?php

namespace App\Modules\Home\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Home\Requests\LoginRequest;
use App\Modules\Home\Requests\RegisterRequest;
use App\Modules\Home\Requests\ForgotPassRequest;
use AuthSam, Socialite, DB, Cache;
use Carbon\Carbon;
use App\Mail\RegisterSuccess;
use App\Mail\ForgotPass;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    /**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   get View Login
    *   @return     :
    */
    public function getLogin()
    {
        return view("Home::auth.login");
    }
    /**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   do login
    *   @return     :
    */
    public function doLogin(LoginRequest $request)
    {   
        try {
            $data = $request->all();

            if (AuthSam::login($data, $request->remember_me)) {
                AuthSam::getSubsidychecklist();
                $user_id    =   AuthSam::getUser()->id;
                $users = DB::table('user_login_info')->where('user_id', $user_id)->get()->count();
                if ($users >= 2)
                        DB::table('user_login_info')->where('user_id', $user_id)->take(1)->delete();
                $dataLog    =   [
                        'user_id'     =>  $user_id,
                        'ipaddress'   =>  $request->ip(),
                        'login_day'   =>  date("Y-m-d"),
                ];
                DB::table('user_login_info')->insert($dataLog);
                Cache::flush();
                if(AuthSam::permission_lock()==1) {
                    if (AuthSam::permission()) {
                        return redirect('/agency/home');
                    } else {
                        return redirect('/client/F0');
                    }
                }else{
                    if (AuthSam::permission()) {
                        $url = '/agency/home_lock';
                    } else {
                        $url = '/client/F0_lock';
                    }
                    session()->forget(['is_login', 'user_id', 'permission', 'subsidy_check_list', 'follow_list']);
                    return redirect($url);
                }
                
            } else {
                return redirect('/login')->with('error', 'ユーザー名とパスワードが違います。');
            }
        } catch(Exception $e) {
            return redirect('/login')->with('error', 'ユーザー名とパスワードが違います。');
        }
        
    }
    /**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   do logout
    *   @return     :
    */
    public function doLogout()
    {
        AuthSam::logout();
        Cache::flush();
        return redirect('/');
        
    }
    /**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   get View register
    *   @return     :
    */
    public function getRegister()
    {
        return view("Home::auth.register");
    }
    /**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   get View register
    *   @return     :
    */
    public function getRegisterSuccess()
    {
        return view("Home::auth.registersuccess");
    }
    /**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   do register
    *   @return     :
    */
    public function doRegister(RegisterRequest $request)
    {
        try {
            $data   = $request->all();
            // $image  = "/assets/photo/no_avatar.jpg";
            //get avatar form account fb or google
            // if ($data['fb_google'] == 1)
            //     $image = DB::table('facebook_temp')->where('facebook_id', $data['facebook_id'])->first()->picture;
            // else if ($data['fb_google'] == 2)
            //     $image = DB::table('google_temp')->where('google_id', $data['google_id'])->first()->avatar;
            $profile_sample = "";
            if ($data['manage_flag'] == 0) {
                $profile_sample = "assets/photo/client_sample.png";
            } else if ($data['manage_flag'] == 1) {
                $profile_sample = "assets/photo/agency_sample.png";
            }
            $expire_date    = date("Y-m-d H:i:s");
            $token          = md5($expire_date).md5($data['e_mail']);
            $created_at     = date('Y-m-d');
            $param  =   [
                'e_mail'        =>  $data['e_mail'],
                'password'      =>  md5($data['password']),
                'username'      =>  $data['username'],
                'displayname'   =>  '',
                'manage_flag'   =>  $data['manage_flag'],
                'fb_google'     =>  0,
                'api_token'     =>  $token,
                'expire_date'   =>  $expire_date,
                'zip_code'      =>  '',
                'created_at'    =>  $created_at,
                'set_cost'      =>  "[]", 
                'image'         =>  $profile_sample
            ];
            $id = DB::table('users')->insertGetId($param);
            if (!empty($id)) {
                $user   =   DB::table('users')->where('id', $id)->first();
                $dataLog    =   [
                        'user_id'     =>  $user->id,
                        'ipaddress'   =>  $request->ip(),
                        'login_day'   =>  date("Y-m-d"),
                ];
                DB::table('user_login_info')->insert($dataLog);
                //send mail
                $data['token'] = $token;
                $this->insertDefaultUserData($id);
                Mail::queue(new \App\Mail\RegisterSuccess($data));
                return redirect('/registersuccess');
            }
            return redirect('/register');
        } catch(Exception $e) {
            return response()->json([
                                'status'    =>  false,
                            ]);
        }
    }
    private function insertDefaultUserData($user_id)
    {
        $location = array();
        $location['province_id'] = 13;
        $location['city_id'] = 291;
        $location['province_name'] = '';
        $location['city_name'] = '';
        $location['user_id'] = $user_id;
        
        $location['updated_at'] = Carbon::now()->toDateTimeString();
        DB::table('user_location')->insert($location);

        //update client_data
        $client_data = array(
                'estable_date'      =>  date('Y-m-d'),
                'capital'           =>  0,
                'regular_number'    =>  0,
                'user_id'           =>  $user_id
            );
        $check = DB::table('users_client_data')->insert($client_data);
    }
    public function verify(Request $request)
    {
        $verification_user = DB::table('users')->where('api_token', $request->api_token)->first();
        if ($verification_user) {
            AuthSam::loginToken($verification_user->api_token);
            DB::table('users')->where('api_token', $request->api_token)->update(['api_token' => 0]);
            Mail::queue(new \App\Mail\RegisterConfirmSuccess($verification_user));
            if($verification_user->manage_flag == 0) {
                return redirect('/agency/home');
            } else if($verification_user->manage_flag == 1) {
                return redirect('/client/F0');
            }
        }
        return redirect('/login');
    }
    /**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   get View Login
    *   @return     :
    */
    public function getForGotPass()
    {
        return view("Home::auth.forgotpass");
    }
    /**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   get View Login
    *   @return     :
    */
    public function getForgotPassSuccess()
    {
        return view("Home::auth.forgotpasssuccess");
    }
    /**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   do login
    *   @return     :
    */
    public function doForgotPass(ForgotPassRequest $request)
    {   
        try {
            $data = $request->all();
            if (!empty($data)) {
                $new_pwd = str_random(16);
                DB::table('users')->where('e_mail', $data['email'])->update(['password' => md5($new_pwd)]);
                //send mail
                Mail::to($data['email'])
                    ->queue(new ForgotPass($new_pwd));
                return redirect('/forgotpasssuccess');
            }
            return redirect('/forgotpass');
        } catch(Exception $e) {
            return redirect('/forgotpass')->with('error', 'ユーザー名とパスワードが違います。');
        }
        
    }
    /**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   Redirect the user to the Facebook authentication page.
    *   @return \Illuminate\Http\Response
    */
    public function redirectToFacebookProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }
    /**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   Obtain the user information from Facebook.
    *   @return \Illuminate\Http\Response
    */
     public function handleProviderFacebookCallback()
    {
        $user = Socialite::driver('facebook')->user(); // Fetch authenticated user
        // dd($user);
        $user = json_decode(json_encode($user), true);
        return redirect('/register')->with('user', $user)->with('fb_google', 1);
    }
    /**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   Redirect the user to the Facebook authentication page.
    *   @return \Illuminate\Http\Response
    */
    public function redirectToGoogleProvider()
    {
        return Socialite::driver('google')->redirect();
    }
    /**
    *   Created by  :   Trieunb - 20/08/2018 
    *   Description :   Obtain the user information from Facebook.
    *   @return \Illuminate\Http\Response
    */
     public function handleProviderGoogleCallback()
    {
        $user = Socialite::driver('google')->user(); // Fetch authenticated user
        $user = json_decode(json_encode($user), true);
        $param  =   [
            'google_id'     =>  $user['id'],
            'name'          =>  $user['name'],
            'e_mail'        =>  $user['email'],
            'avatar'        =>  $user['avatar'],
            'created_at'    =>  Carbon::now()
        ];
        $first = DB::table('google_temp')->where('google_id', $user['id'])->first();
        if ($first) {
            DB::table('google_temp')
                ->where('google_id', $user['id'])
                ->update([
                    'e_mail'   => $user['email'],
                    'avatar'    => $user['avatar'], 
                    'name'      => $user['name']]);
        } else {
            DB::table('google_temp')->insert($param);
        }
        return redirect('/register')->with('user', $user)->with('fb_google', 2)->with('google_id', $user['id']);
    }
}