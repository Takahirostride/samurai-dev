<?php

namespace App\Modules\Asp\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use Validator;
class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function sendResetLinkEmail(Request $request)
    {
        $validate = $this->validateEmail($request);
        if($validate->fails()){
            $error= [
                'error'=>1,
                'message'=>$validate->getMessageBag()
            ];
            return response()->json($error);
        }        
        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );
        if($response == Password::RESET_LINK_SENT){
            return response()->json([
                'error'=>0
            ]);
        }
        return response()->json([
            'error'=>1,
            'message'=>trans($response)
        ]);
    }
    protected function validateEmail(Request $request)
    {
        $validate = Validator::make($request->all(), ['email' => 'required|email']);
        return $validate;
    } 
    public function broker()
    {
        return Password::broker('asp_users');
    }             
}
