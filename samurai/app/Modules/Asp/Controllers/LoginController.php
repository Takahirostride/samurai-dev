<?php
namespace App\Modules\Asp\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use App\Modules\Asp\Models\AspUser;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = '/asp';
    public function __construct()
    {
    }
    public function showLoginForm()
    {
        return view('Asp::auth.login');
    }
    protected function guard(){
        return Auth::guard('asp_user');
    }
    public function username()
    {
        return 'account';
    }           
    protected function attemptLogin(Request $request){
        $user = AspUser::where([
            'account' => $request->account,
            'password' => md5($request->password)
        ])->first();
        
        if ($user) {
            $this->guard()->login($user, $request->has('remember'));

            return true;
        }
        return false;
    }
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect()->route('asp_login');
    }    
}
