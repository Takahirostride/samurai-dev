<?php 
namespace App\Modules\Asp\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Asp\Models\AspGroup;
use App\Modules\Asp\Models\AspUser;
use Validator;
use App\Modules\Asp\Mail\RegisterUser;
use Mail;
class AspUserController extends Controller
{
	public function index(Request $request)
	{
		$mods = AspUser::where([
			['role','=','mod']
		])->paginate(15);
		return view('Asp::user.index',compact('mods'));
	}
	public function create()
	{		
		return view('Asp::user.create');
	}
	public function store(Request $request)
	{
		$valid = $this->checkRequest($request);
		if($valid->fails()){
			return back()->withErrors($valid)->withInput();
		}
		$user = auth('asp_user')->user();
		$request->request->add([
			'inviter_id'=>$user->id,
			'role'=>'mod'
		]);
		$mem = AspUser::create($request->all());
		if($mem){
			AspGroup::create([
				'title'=>'デフォルトグループ',
				'mod_id'=>$mem->id,
				'type'=>1
			]);
		}
		if($request->filled('email')){
			Mail::to($request->email)->send(new RegisterUser($mem));
		}
		return redirect()->route('asp.users.edit',$mem)->with('modal_notify','アカウント情報を保存しました。');
	}
	public function show()
	{

	}
	public function edit($id)
	{				
		$member = AspUser::findOrFail($id);
		return view('Asp::user.edit',compact('member'));
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
		$mem->update($request->except($exc));
		return back()->with('modal_notify','アカウント情報を保存しました。');
	}
	public function destroy($id)
	{
		abort(404);
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