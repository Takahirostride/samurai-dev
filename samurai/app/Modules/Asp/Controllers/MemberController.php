<?php

namespace App\Modules\Asp\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Asp\Models\AspSignature;
class MemberController extends Controller{
    public function profile(){
    	return view('Asp::member.profile');
    }
    public function update_profile(Request $request){
    	$user = auth('asp_user')->user();
    	$exc = ['account','role','inviter_id'];
		$rules = [
			'first_name'=>'required',
			'last_name'=>'required',
			'email'=>'nullable|unique:asp_users,email,'.$user->id.',id',
		];
		if($request->filled('password')){
			$rules['password'] = 'required|confirmed';
		}else{
			$exc[]='password';
		}
		$this->validate($request,$rules,[]);		
		$user->update($request->except($exc));
		return back()->with('modal_notify','<h3>アカウント情報を保存しました。</h3>');
    }
    public function signature(){
    	$user = auth('asp_user')->user();
    	$signature = $user->signature;
    	if(!$signature){
    		$signature = new AspSignature();
    		$signature->avatar = null;
    		$signature->company = null;
    		$signature->position = null;
    		$signature->name = null;
    		$signature->address_1 = null;
    		$signature->address_2 = null;
    		$signature->tel = null;
    		$signature->fax = null;
    		$signature->email = null;
    	}
    	return view('Asp::member.signature',compact('signature'));
    }
    public function updateSignature(Request $request){
    	$this->validate($request,[
    		'company'=>'required',
    		'name'=>'required',
    		'address_1'=>'required'
    	]);
    	$user = auth('asp_user')->user();
    	$user->load('signature');
    	if($user->signature){
    		$user->signature->update($request->all());
    	}else{
    		$user->signature()->create($request->all());
    	}
    	return back()->with([
            'modal_notify'=>'<h3>署名情報を保存しました。</h3>',
            'prev_link' => $request->input('prev_link')
        ]);
    }

}