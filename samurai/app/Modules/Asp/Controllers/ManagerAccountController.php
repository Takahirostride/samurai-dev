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
class ManagerAccountController extends Controller{
	public function myAccount(){
		$user = auth('asp_user')->user();
		$groups = AspGroup::where('mod_id','=',$user->id);	
		$groups = $groups->orderBy('type','desc')->orderBy('id','desc')->paginate(10);
		return view('Asp::manager_account.my_account',compact('groups'));		
	}
	public function create()
	{		
		$user = auth('asp_user')->user();
		$groups = AspGroup::where('mod_id','=',$user->id)->pluck('title','id');		
		$role_group = AspGroup::ROLE_LIST;
		return view('Asp::manager_account.create',compact('groups','role_group'));
	}
	public function store(Request $request)
	{
		$valid = $this->checkRequest($request);
		if($valid->fails()){
			return back()->withErrors($valid)->withInput();
		}
		$user = auth('asp_user')->user();
		$request->request->add(
			[
				'inviter_id'=>$user->id,
				'role'=>'member'
			]
		);
		$mem = AspUser::create($request->all());
		if($mem){
			$role_group = $request->role_group == 1 ? 1 : 0;
			$mem->group()->sync([
				$request->group_id => [
					'role'=>$role_group
				]
			]);		
		}
		if($request->filled('email')){
			Mail::to($request->email)->send(new RegisterUser($mem));
		}
		return redirect()->route('asp_manager_account_edit',$mem)->with('modal_notify','<h4>新しいアカウントを登録しました。</h4>');;
	}
	public function edit($id)
	{				
		$member = AspUser::findOrFail($id);
		$user = auth('asp_user')->user();
		if(!$user->can('edit',$member)){abort(403);}
		$member->load('myGroup');
		$groups =[];
		$groups = AspGroup::where('mod_id','=',$user->id)->pluck('title','id');
		$role_group = AspGroup::ROLE_LIST;	
		return view('Asp::manager_account.edit',compact('member','groups','role_group'));
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
		$user = auth('asp_user')->user();
		$mem = AspUser::findOrFail($id);
		if(!$user->can('edit',$mem)){abort(403);}		
		$mem->update($request->except($exc));
		$role_group = $request->role_group == 1 ? 1 : 0;
		$mem->group()->sync([
			$request->group_id => [
				'role'=>$role_group
			]
		]);
		return back()->with('modal_notify','<h4>アカウント情報を保存しました。</h4>');
	}
	public function destroy($id)
	{
		$member = AspUser::find($id);
		if(!$member){ return response()->make(0);}
		$user = auth('asp_user')->user();	
		if($user->cant('edit',$member)){return response()->make(0);}	
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
			'group_id'=>'required',
			'role_group'=>'required',
			'email'=>'nullable|unique:asp_users,email,'.$id.',id',
			'account'=>'required|unique:asp_users,account',
			'password'=>'required|confirmed'
		];
		$rules = array_except($rules,$exc);
		$msg=[];
        $valid = Validator::make($request->all(),$rules,$msg);
		$valid->after(function($valid)use($user,$request) {
	        	$group = AspGroup::where([
	        		'id'=>$request->group_id,
	        		'mod_id'=>$user->id
	        	]);
	        	if(!$group->exists()){
	        		$valid->getMessageBag()->add('groups', __('No permisson add user in group'));
	        	}
		});               
        return $valid;
	}	
	//-group-
	public function editGroup($id){
		$group = AspGroup::findOrFail($id);
		$user = auth('asp_user')->user();
		if($group->mod_id != $user->id){
			abort(404);
		}
		$members = $group->member()->orderBy('pivot_role','desc')->paginate(12);
		return view('Asp::manager_account.edit_group',compact('members','group'));
	}
	public function updateGroup(Request $request,$id){
		$this->validate($request,[
			'title'=>'required'
		]);
		$group = AspGroup::where('type','=',0)->findOrFail($id);
		$user = auth('asp_user')->user();
		if($group->mod_id != $user->id){
			abort(404);
		}
		$group->update([
			'title'=>$request->title
		]);	
		return back()->with('modal_notify','Update Group successfully!');	
	}
	public function storeGroup(Request $request){
		if(!$request->ajax()){abort(404);}
		$valid = Validator::make($request->all(),[
			'title'=>'required'
		]);
		if($valid->fails()){
			return response()->json([
				'error'=>1,
				'message'=>$valid->getMessageBag()
			]);
		}
		$user = auth('asp_user')->user();
		$group = AspGroup::create([
			'title'=>$request->title,
			'mod_id'=>$user->id,
			'type'=>0
		]);
		return response()->json([
			'error'=>0,
			'data'=>$group
		]);
	}
	public function destroyGroup(Request $request,$id){
		$group = AspGroup::where('type','=',0)->find($id);
		$user = auth('asp_user')->user();
		if(!$group || $group->mod_id != $user->id){ return response()->make(0);}
		$member = $group->member->pluck('id')->toArray();
		//
		$group->member()->detach();
		$group->delete();
		//		
		$d_group = AspGroup::where([
			['mod_id','=',$user->id],
			['type','=',1]
		])->first();
		if($d_group){
			$d_group->member()->attach($member);
		}
		//
		$txt="<h4>{$group->title}グループを削除しました。</h4><p class='txt-small'>（登録アカウントがあった場合はデフォルトグループに移動されています）</p>";
		$request->session()->flash('modal_notify',$txt);
		return response()->make(1);
	}	
}