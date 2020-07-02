<?php 

namespace App\Modules\Client\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Hire;
use App\Models\WorkSet;
use App\Models\Message;
use DB;
use URL;

class RecruitController extends Controller
{
	protected $agencyRecruit = [];
	protected $noneLayout = 'Client::mypage.recruit.finished_none';
	public function __construct()
	{
	    $this->agencyRecruit = new \App\Modules\Agency\Controllers\RecruitController;
	    $this->agencyRecruit->noneLayout = 'Client::mypage.recruit.finished_none';
	}
	public function getIndex(Request $request, $hire_id = false)
	{
		$viewLoad = 'Client::mypage.recruit.index_recruit';
		return $this->agencyRecruit->getIndex($request, $hire_id, $viewLoad);
	}
	public function postIndex(Request $request, $hire_id = false)
	{
		return $this->agencyRecruit->postIndex($request, $hire_id);
	}
	public function postIndexWorkset(Request $request)
	{
		return $this->agencyRecruit->postIndexWorkset($request);
	}
	public function getReceived(Request $request, $hire_id = false)
	{
		$viewLoad = 'Client::mypage.recruit.received';
		return $this->agencyRecruit->getReceived($request, $hire_id, $viewLoad);
	}
	public function postRequested(Request $request)
	{
		$hire_id = $request->hire_id;
		if(dstring_to_date($request->deli_date) < date('Y-m-d') ) return 1;
		$check = Hire::where('id', $hire_id)
				->where('from_id', session('user_id'))
				->first();
		if($check)
		{
			DB::table('hire')
				->where('id', $hire_id)
				->update(['deli_date'	=>	dstring_to_date($request->deli_date) ] );
		}
		return response()->json(['success'=>true]);
	}
	public function matchingRequested(Request $request)
	{
		$hire_id = $request->hire_id;
		
		$check = Hire::where('id', $hire_id)
				->where(function($query) {
	            	$query->where('from_id', session('user_id') )
	            		->orWhere('to_id', session('user_id') );
	            })
				->first();
		if($check)
		{
			DB::table('hire')
				->where('id', $hire_id)
				->update(['accept'	=>	1 ] );
		}
		return response()->json(['success'=>true]);
	}
	public function cancelRequested(Request $request)
	{
		$hire_id = $request->hire_id;
		
		$check = Hire::where('id', $hire_id)
				->where(function($query) {
	            	$query->where('from_id', session('user_id') )
	            		->orWhere('to_id', session('user_id') );
	            })
				->first();
		if($check)
		{
			DB::table('hire')
				->where('id', $hire_id)
				->update(['finish_flag'	=>	1, 'finish_date' => date('Y-m-d') ] );
		}
		return response()->json(['success'=>true]);
	}
	public function getRequested(Request $request, $hire_id = false)
	{
		$viewLoad = 'Client::mypage.recruit.requested';
		return $this->agencyRecruit->getRequested($request, $hire_id, $viewLoad);
	}
	public function getFinished(Request $request, $hire_id = false)
	{
		$viewLoad = 'Client::mypage.recruit.finished';
		return $this->agencyRecruit->getFinished($request, $hire_id, $viewLoad);
	}
	public function postReadMessage(Request $request)
	{
		return $this->agencyRecruit->postReadMessage($request);
	}
	public function getJobRq(Request $request, $hire_id = false)
	{
		$viewLoad = 'Client::mypage.recruit.jobrq';
		$user_id = session('user_id');
		list($receiveCount, $requestCount, $receiveList, $requestList, $receiveSum, $requestSum) = $this->agencyRecruit->getRecruitCount($user_id);
		$recruitList = Hire::where('finish_flag', 0)
			            ->where('accept', 0)
			            ->where('policy_id', 0)
			            ->where('hire_type', 2)
			            ->where('from_id', $user_id)
			            ->orderBy('id', 'desc')
			            ->with(['from', 'to', 'user'])
			            ->has('from')
			            ->get();
		$itemActive = 'jobrq';
		if(!$hire_id && count($recruitList))
		{
			return redirect()->route('client.recruitment.jobrq', [$recruitList->first()->id]);
		} else {
			if(!$recruitList) return $this->view($this->noneLayout, compact('receiveCount', 'requestCount', 'receiveList', 'requestList', 'receiveSum', 'requestSum', 'itemActive', 'itemActive', 'recruitList', 'hire_id'));
			else {
				foreach ($recruitList as $key => $value) {
					if($value->id == $hire_id)
					{
						$selectedHire = $value;
						break;
					}
				}
			}
			if(empty($selectedHire)) return $this->view($this->noneLayout, compact('receiveCount', 'requestCount', 'receiveList', 'requestList', 'receiveSum', 'requestSum', 'itemActive', 'itemActive', 'recruitList', 'hire_id'));
		}
		if(!$recruitList) return $this->view($this->noneLayout, compact('receiveCount', 'requestCount', 'receiveList', 'requestList', 'receiveSum', 'requestSum', 'itemActive', 'itemActive', 'recruitList', 'hire_id'));

		$messageList = Message::where('message.flag','<=',1)
        	->where('message.to_id', $user_id)
            ->where('message.hire_id',$hire_id)
            ->orWhere(function ($query) use ($user_id, $hire_id)
            {
                $query->where('message.from_id', $user_id)
                    ->where('message.flag','<=',1)
                    ->where('message.hire_id',$hire_id);
            })
            ->with('chat_with_user')
            ->get();

        //update notify
		if($selectedHire->estimate_notify_to > 0) 
		{
			DB::table('hire')->where('id', $selectedHire->id)->update(['estimate_notify_to'=>0]);
		}

		return $this->view($viewLoad, compact('receiveCount', 'requestCount', 'receiveList', 'requestList', 'receiveSum', 'requestSum', 'recruitList', 'selectedHire', 'hire_id', 'messageList') );
	}
	public function submitRequest(Request $request)
	{
		$hire = false;
		$user_id = session('user_id');
		if($request->hire_id)
		{
			$hire = Hire::where('id', $request->hire_id)
					->where(function($query) use($user_id) {
		            	$query->where('from_id', $user_id)
		            		->orWhere('to_id', $user_id);
		            })
					->where('finish_flag', 1)
					->where('hire_type', 2)
					->first();
			if(!$hire) unset($hire);
		}
		return $this->view('Client::mypage.recruit.jobrq_submit', compact('hire'));
	}
	public function postSubmitRequest(Request $request)
	{
		$allAgency = DB::table('users')->where('permission', 1)->where('manage_flag', 1)->get();
		if(count($allAgency))
		{
			foreach ($allAgency as $key => $value) {
				$data = [
					'from_id' 		=> session('user_id'),
					'to_id' 		=> $value->id,
					'job_title' 	=> $request->title,
					'job_content' 	=> $request->content,
					'budget' 		=> $request->budget,
					'deli_date' 	=> str_replace(['年','月','日'] , ['-','-',''] ,$request->schedule),
					'updated_at' 	=> date('Y-m-d h:i:s'),
					'created_at' 	=> date('Y-m-d h:i:s')
				];
				$hire_id = DB::table('job_policy')->insertGetId($data);
			}
		}
		echo 'success';
	}
	public function reOpenHire(Request $request)
	{
		if($request->hire_id)
		{
			$hire = Hire::where('from_id', session('user_id'))
					->where('hire_type', 2)
					->where('id', $request->hire_id)
					->first();
			if($hire)
			{
				$newData = [
					'job_title'		=>	$request->job_title,
					'job_content'	=>	$request->job_content,
					'deli_date'		=>	dstring_to_date($request->deli_date),
					'budget'		=>	$request->budget
				];
				DB::table('hire')->where('id', $hire->id)->update($newData);
			}
			
		}
		return response()->json(['success'=>true]);
	}
	public function postCancelMatching(Request $request)
	{
		return $this->agencyRecruit->postCancelMatching($request);
	}
	public function view($viewLoad = '', $params = [])
	{
		return $this->agencyRecruit->view($viewLoad, $params);
	}

}