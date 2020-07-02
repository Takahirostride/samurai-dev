<?php 
namespace App\Modules\Asp\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Asp\Models\AspGroup;
use Validator;
class AspGroupController extends Controller
{
	public function index(Request $request)
	{
		$user = auth('asp_user')->user();	
		$groups = AspGroup::select();	
		if(!$user->isAdmin()){
			$groups = $groups->whereHas('member',function($qr) use($user){
				$qr->where('user_id','=',$user->id);
			});
		}
		$groups = $groups->orderBy('id','desc')->paginate(20);
		return view('Asp::group.index',compact('groups'));
	}
	public function create()
	{		
		$user = auth('asp_user')->user();
		if($user->cant('create',AspGroup::class)){abort(403);}
		return view('Asp::group.create');
	}
	public function store(Request $request)
	{
		$this->checkRequest();
		$user = auth('asp_user')->user();
		if($user->cant('create',AspGroup::class)){abort(403);}
		$gr = AspGroup::create($request->all());
		return redirect()->route('asp.groups.index')->with('status',__('create successfully!'));
	}
	public function show($id)
	{	
		$group = AspGroup::findOrFail($id);
		$user = auth('asp_user')->user();
		if($user->cant('show',$group)){abort(403);}
		$members = $group->member()->orderBy('id','desc')->paginate();
		return view('Asp::group.show',compact('group','members'));

	}
	public function edit(Request $request,$id)
	{
		$group = AspGroup::with('member')->findOrFail($id);
		$user = auth('asp_user')->user();
		if($user->cant('edit',$group)){ abort(403);}
		$cnd = [['user_id','!=',$user->id]];
		$members = $members = $group->member();
		if($request->filled('keyword')){
			$members = $members->search($request->keyword);
		}
		$members = $members->where($cnd)->orderBy('id','desc')->paginate();
		return view('Asp::group.edit',compact('group','members'));
	}
	public function update(Request $request,$id)
	{
		$this->checkRequest();
		$group = AspGroup::findOrFail($id);
		$user = auth('asp_user')->user();
		if($user->cant('edit',$group)){ abort(403);}
		$group->update($request->all());
		return back()->with('status',__('update successfully!'));
	}
	public function destroy($id)
	{
		$group = AspGroup::findOrFail($id);
		$group->member()->detach();
		$group->delete();
		return back()->with('status',__('remove successfully!'));

	}  
	//ajax
	public function ajaxEdit(Request $request){
		if(!$request->ajax()){abort(404);}
		$valid = Validator::make($request->all(),[
			'group_id'=>'required',
			'title'=>'required'
		]);
		if($valid->fails()){
			return response()->json([
				'error'=>1,
				'message'=>$valid->getMessageBag()
			]);
		}
		$group = AspGroup::find($request->group_id);
		if(!$group){
			return response()->json([
				'error'=>1,
				'message'=>__('Not found!')
			]);			
		}
		$group->update([
			'title'=>$request->title
		]);
		return response()->json(['error'=>0]);
	}
	public function ajaxAdd(Request $request){
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
		$group = AspGroup::create([
			'title'=>$request->title
		]);
		return response()->json([
			'error'=>0,
			'data'=>$group
		]);
	}	
	//
	private function checkRequest(){
		$rules = [
			'title'=>'required'
		];
		$msg =[];
		$this->validate(request(),$rules,$msg);
		return true;
	}
}