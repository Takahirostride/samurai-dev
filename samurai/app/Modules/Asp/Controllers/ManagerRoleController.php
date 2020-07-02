<?php

namespace App\Modules\Asp\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Asp\Models\AspUser;
use App\Modules\Asp\Models\AspGroup;
use App\Modules\Asp\Mail\RegisterUser;
use Mail;
//
use Validator;
//
class ManagerRoleController extends Controller{
	public function __construct(){

	}
	public function index(Request $request){
		$user = auth('asp_user')->user();
		$group = AspGroup::whereHas('userGroup',function($qr)use($user){
			$qr->where([
				['user_id','=',$user->id],
				['role','=',1],
			]);
		});	
		$group = $group->first();
		if(!$group){
			abort(404);
		}
		$members = $group->member()->where('asp_user_groups.role',0)->orderBy('pivot_role','desc')->paginate(12);
		return view('Asp::manager_role.index',compact('group','members'));		
	}
	public function create()
	{		
		$user = auth('asp_user')->user();
		$groups = $user->group()->get();		
		return view('Asp::manager_role.create',compact('groups'));
	}
	public function store(Request $request)
	{
		$valid = $this->checkRequest($request);
		if($valid->fails()){
			return back()->withErrors($valid)->withInput();
		}
		$user = auth('asp_user')->user();
		$groups = $user->group()->get();
		if($groups->isEmpty()){
			return back()->with('error','No group!')->withInput();
		}
		$request->request->add(
			[
				'inviter_id'=>$user->id,
				'role'=>'member'
			]
		);
		$mem = AspUser::create($request->all());
		if($mem){
			$group_id = $groups->get(0)->id;
			$mem->group()->sync([
				$group_id => [
					'role'=>0
				]
			]);		
		}
		if($request->filled('email')){
			Mail::to($request->email)->send(new RegisterUser($mem));
		}
		return redirect()->route('asp_manager_role_edit',$mem)->with('modal_notify','<h4>新しいアカウントを登録しました。</h4>');;
	}
	public function edit($id)
	{				
		$member = AspUser::findOrFail($id);
		$member->load('myGroup');
		$user = auth('asp_user')->user();
		$groups = $user->group()->get();
		$user_groups = $groups->isEmpty() ? 0 : $groups->get(0);
		if(empty($member->myGroup) || $member->myGroup->group_id != $user_groups->id){
			abort(403);
		}			
		return view('Asp::manager_role.edit',compact('member','groups','user'));
	}
	public function update(Request $request,$id)
	{
		$exc=['account'];
		if(!$request->filled('password')){
			$exc[]='password';
		}				
		$valid = $this->checkRequest($request,$id,$exc);
		if($valid->fails()){
			return back()->withErrors($valid)->withInput();
		}
		$mem = AspUser::findOrFail($id);
		$mem->load('myGroup');
		$user = auth('asp_user')->user();
		$groups = $user->group()->get();
		$user_groups = $groups->isEmpty() ? 0 : $groups->get(0);
		if(empty($mem->myGroup) || $mem->myGroup->group_id != $user_groups->id){
			abort(403);
		}		
		$mem->update($request->except($exc));
		return back()->with('modal_notify','<h4>アカウント情報を保存しました。</h4>');
	}
	public function destroy($id)
	{
		$member = AspUser::find($id);
		if(!$member){ return response()->make(0);}
		$user = auth('asp_user')->user();
		if($member->inviter_id != $user->id){
			return response()->make(0);
		}		
		$member->group()->detach();
		$member->delete();
		request()->session()->flash('status',__('remove successfully!'));
		return response()->make(1);

	}   
	//
	private function checkRequest($request,$id=null,$exc=[]){
		$user = auth('asp_user')->user();
		$rules = [
			'first_name'=>'required',
			'last_name'=>'required',
			'email'=>'nullable|unique:asp_users,email,'.$id.',id',
			'account'=>'required|unique:asp_users,account',
			'password'=>'required|confirmed'
		];
		$rules = array_except($rules,$exc);
		$msg=[];
        $valid = Validator::make($request->all(),$rules,$msg);               
        return $valid;
	}	
}