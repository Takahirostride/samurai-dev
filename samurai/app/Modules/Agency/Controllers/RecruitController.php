<?php 

namespace App\Modules\Agency\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Hire;
use App\Models\WorkSet;
use App\Models\Message;
use DB;
use URL;
use App\Modules\Asp\Events\HireClientEvent;
use App\Modules\Asp\Events\WorksetClientEvent;
use Event;
use Cache;

class RecruitController extends Controller
{
	protected $mypage;
	public $noneLayout = 'Agency::mypage.recruit.finished_none';
	public function __construct()
	{
        $this->mypage = new \App\Modules\Agency\Controllers\MypageController;
	}
	public function getIndex(Request $request, $hire_id = false, $viewLoad = 'Agency::mypage.recruit.index_recruit')
	{
		$user_id = session('user_id');
		list($receiveCount, $requestCount, $receiveList, $requestList) = $this->getRecruitCount($user_id);
		
		$recruitList = $this->getIndexQuery();
		$itemActive = '';
		if(!$hire_id && count($recruitList))
		{
			return redirect()->route( (stristr($viewLoad, 'client')?'client.recruitment':'agency.recruitment'), [$recruitList->first()->id]);
		} else {
			if(!$recruitList) return $this->view($this->noneLayout, compact('receiveCount', 'requestCount', 'receiveList', 'requestList', 'itemActive', 'recruitList', 'hire_id'));
			else {
				foreach ($recruitList as $key => $value) {
					if($value->id == $hire_id)
					{
						$selectedHire = $value;
						break;
					}
				}
			}
			if(empty($selectedHire)) return $this->view($this->noneLayout, compact('receiveCount', 'requestCount', 'receiveList', 'requestList', 'itemActive', 'recruitList', 'hire_id'));
		}
		if(!$recruitList) return $this->view($this->noneLayout, compact('receiveCount', 'requestCount', 'receiveList', 'requestList', 'itemActive', 'recruitList', 'hire_id'));

		$work_set = WorkSet::where('hire_id', $hire_id)->orderBy('id', 'asc')->with('work_set_sub')->get();

        $messageList = $this->getIndexMsg($selectedHire->id);
		return $this->view($viewLoad, compact('receiveCount', 'requestCount', 'requestList', 'receiveList', 'recruitList', 'selectedHire', 'work_set', 'hire_id', 'messageList','user_id'));
	}
	public function postIndexWorkset(Request $request)
	{
		$data = array('success'=>false);
		if($request->hire_id)
		{
			$work_set = WorkSet::where('hire_id', $request->hire_id)
					->with(['hire' => function($query) {
						$query->where('from_id', session('user_id'))
							->orWhere('to_id', session('user_id'));
					}])
					->get()->toArray();
			$data = [
				'success'	=>	true,
				'work_set'	=>	$work_set
			];
		}
		return response()->json($data);
	}
	public function postIndex(Request $request)
	{
		$hire_id = $request->hire_id;
		$userid = session('user_id');
		$ck = DB::table('hire')
			->where('id', $hire_id)
			->where(function($query) use($userid) {
				$query->where('from_id', $userid)
				->orWhere('to_id', $userid);
			})
			->first();
		if(!$ck) return response()->json(['success'=>false]);
        
        

        //feedback
        $result = DB::table('report_acquire')->where('hire_id',$hire_id)->where('manage_flag',1)->first();
        if (!$result) {
            $result = DB::table('report_finish')->where('hireid', $hire_id)->where('content', 'LIKE', '%[1]%')->first();
            if (!$result) {
            	if(!$ck) return response()->json(['success'=>false]);
                //return redirect()->back()->withErrors('請求を入力してください。')->withInput();
                //return array('result'=>'acquire_first');
            }
        }
        if($request->content == 2)
        {
        	$accept_flag = 0;
        	$content = [2];
        	$finish_type = 1;
        } elseif($request->content == 1) {
        	$accept_flag = 0;
        	$content = [1];
        	$finish_type = 0;
        } else {
        	$accept_flag = 0;
        	$content = [0];
        	$finish_type = -1;
        }
        $to_id = DB::table('hire')->where('id', $hire_id)->first()->to_id;
        if ($to_id == $userid) {
            $to_id = DB::table('hire')->where('id', $hire_id)->first()->from_id;
        }
        $date = date('Y-m-d');
        $result = DB::table('report_finish')->where('hireid', $hire_id)->first();
        if ($result) {
            DB::table('report_finish')->where('hireid', $hire_id)->update(['accept_flag' => $accept_flag, 'created_date' => $date,'from'=>$userid, 'to'=>$to_id, 'content'=>json_encode($content)]);
        } else {
            DB::table('report_finish')->insert([
                'hireid'                =>  $hire_id,
                'report_finish.to'      =>  $to_id,
                'report_finish.from'    =>  $userid,
                'report_finish.content' =>  json_encode($content),
                'accept_flag'           =>  $accept_flag,
                'created_date'          =>  $date,
            ]);
        }

        $eval_total= $request->rating1;
        $eval_quality= $request->rating2;
        $eval_delivery= $request->rating3;
        $eval_conf= $request->rating4;
        $eval_price= $request->rating5;
        $eval_ability= $request->rating6;
        $eval_message= $request->report_message;
        $created_date = date("Y-m-d");
        $display = $request->input('no_display', 0);

        $to_id = DB::table('hire')->where('id',$hire_id)->first()->to_id;

        DB::table('feedback')->insert([
            'hire_id'       =>  $hire_id,
            'to_id'         =>  $to_id,
            'eval_total'    =>  $eval_total,
            'eval_conf'     =>  $eval_conf,
            'eval_ability'     =>  $eval_ability,
            'eval_quality'     =>  $eval_quality,
            'eval_delivery'     =>  $eval_delivery,
            'eval_price'     =>  $eval_price,
            'eval_message'     =>  $eval_message,
            'display'     =>  $display,
            'finish_type'     =>  $finish_type,
            'created_date'     =>  $created_date,
        ]);

        //update user eval + result
        $listFB = DB::table('feedback')->where('to_id', $to_id)->get();
        if(count($listFB))
        {
        	$totalRow = 0;
        	$totalEval = 0;
        	foreach ($listFB as $key => $value) {
        		$totalRow += 1;
        		$totalEval += (int)$value->eval_total;
        	}
        	$evaluate = round($totalEval/$totalRow, 1);
        	DB::table('users')->where('id', $to_id)->update([ 'result'=>$totalRow, 'evaluate'=>$evaluate ]);
        }

        DB::table('hire')->where('id',$hire_id)->update(['finish_flag' => 1]);
        Event::fire(new HireClientEvent('finish',$hire_id));

        return response()->json(['success'=>true]);
        //return redirect()->route('agency.recruitment.finished', [$hire_id] )->withSuccess('完成しました。')->withInput();
	}
	public function getRecruitCount($user_id )
	{
		if(Cache::has('agency_receiveColl')) {
			$receiveColl = Cache::get('agency_receiveColl');
		} else {
			$receiveColl = $this->getReceivedQuery();
			Cache::put('agency_receiveColl', $receiveColl);
		}
		
		$receiveList = $receiveSum = [];
		$receiveTotal = 0;
		if(count($receiveColl))
		{
			foreach ($receiveColl as $key => $value) {
				$receiveList[] = $value->id;
				if($value->notify_to_id > 0) {
					$receiveTotal += $value->notify_to_id;
					$receiveSum[$value->id] = $value->notify_to_id;
				}
			}
		}
		$receiveCount = $receiveTotal;

		//requestColl
		if(Cache::has('agency_requestColl')) {
			$requestColl = Cache::get('agency_requestColl');
		} else {
			$requestColl = $this->getRequestedQuery();
			Cache::put('agency_requestColl', $requestColl);
		}
        
		$requestList = $requestSum = [];
		$requestTotal = 0;
		if(count($requestColl))
		{
			foreach ($requestColl as $key => $value) {
				$requestList[] = $value->id;
				if($value->notify_from_id > 0) {
					$requestTotal += $value->notify_from_id;
					$requestSum[$value->id] = $value->notify_from_id;
				}
			}
		}
		$requestCount = $requestTotal;
		return [$receiveCount, $requestCount, $receiveList, $requestList, $receiveSum, $requestSum];
	}

	public function postReadMessage(Request $request)
	{
		$hire = Hire::where('id', $request->hire_id)
			->where(function($q) {
				$q->where('from_id', session('user_id'))
				->orWhere('to_id', session('user_id'));
			})->first();
		if($hire) {
			if($hire->from_id == session('user_id'))
			{
				$colUpdate = 'notify_from_id';
			} else {
				$colUpdate = 'notify_to_id';
			}
			DB::table('hire')->where('id', $hire->id)->update([$colUpdate => 0]);
			Cache::forget('agency_receiveColl');
        	Cache::forget('agency_requestColl');
		}
		return response()->json(['success'=>true]);

	}
	private function getIndexQuery()
	{
		$user_id = session('user_id');
		return Hire::where('finish_flag', 0)
			            ->where('accept', 1)
			            ->where(function($query) use($user_id) {
			            	$query->where('from_id', $user_id)
			            		->orWhere('to_id', $user_id);
			            })
			            ->where(function($query) {
			            	$query->where(function($query1) {
			            		$query1->where('hire_type', 1)
			            			->has('policy');
			            	})
			            	->orWhere(function($query2) {
			            		$query2->where('hire_type', 2)
			            			->where('policy_id', 0);
			            	});
			            })
			            ->orderBy('id', 'desc')
			            ->with(['from', 'to', 'policy', 'user'])
			            ->has('from')
			            ->has('to')
			            ->get();
	}
	private function getReceivedQuery()
	{
		$user_id = session('user_id');
		return Hire::where('finish_flag', 0)
			            ->where('accept', 0)
			            ->where('to_id', $user_id)
			            ->where(function($query) {
			            	$query->where(function($query1) {
			            		$query1->where('hire_type', 1)
			            			->has('policy');
			            	})
			            	->orWhere(function($query2) {
			            		$query2->where('hire_type', 2)
			            			->where('policy_id', 0);
			            	});
			            })
			            ->orderBy('id', 'desc')
			            ->with(['from', 'to', 'policy', 'user'])
			            ->has('from')
			            ->get();
	}
	private function getRequestedQuery()
	{
		$user_id = session('user_id');
		return Hire::where('from_id', $user_id)
			            ->where('finish_flag', 0)
			            ->where('accept', 0)
			            ->where(function($query) {
			            	$query->where(function($query1) {
			            		$query1->where('hire_type', 1)
			            			->has('policy');
			            	})
			            	->orWhere(function($query2) {
			            		$query2->where('hire_type', 2)
			            			->where('policy_id', 0);
			            	});
			            })
			            ->orderBy('id', 'desc')
			            ->orderBy('policy_id', 'desc')
			            ->with(['from', 'to', 'user', 'policy'])
			            ->has('to')
			            ->get();
	}
	private function getFinishedQuery()
	{
		$user_id = session('user_id');
		return Hire::where('finish_flag', 1)
			            ->where(function($query) use($user_id) {
			            	$query->where('from_id', $user_id)
			            		->orWhere('to_id', $user_id);
			            })
			            ->where(function($query) {
			            	$query->where(function($query1) {
			            		$query1->where('hire_type', 1)
			            			->has('policy');
			            	})
			            	->orWhere(function($query2) {
			            		$query2->where('hire_type', 2)
			            			->where('policy_id', 0);
			            	});
			            })
			            ->orderBy('id', 'desc')
			            ->with(['from', 'to', 'policy'])
			            ->has('from')
			            ->has('to')
			            ->get();
	}

	private function getIndexMsg($hire_id)
	{
		$user_id = session('user_id');
		return Message::where('message.flag','<=',1)
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
	}
	private function getReceivedMsg($hire_id)
	{
		$user_id = session('user_id');
		return Message::where('message.flag','<=',1)
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
	}
	private function getRequestedMsg($hire_id)
	{
		$user_id = session('user_id');
		return Message::where('message.flag','<=',1)
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
	}
	private function getFinishedMsg($hire_id)
	{
		$user_id = session('user_id');
		return Message::where('message.flag','<=',1)
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
	}
	public function getReceived(Request $request, $hire_id = false, $viewLoad = 'Agency::mypage.recruit.received')
	{
		$user_id = session('user_id');
		list($receiveCount, $requestCount, $receiveList, $requestList, $receiveSum, $requestSum) = $this->getRecruitCount($user_id);
		$recruitList = $this->getReceivedQuery();

		$itemActive = 'received';
		if(!$hire_id && count($recruitList))
		{
			return redirect()->route( (stristr($viewLoad, 'client')?'client.recruitment.received':'agency.recruitment.received') , [$recruitList->first()->id]);
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
		//update notify
		if($selectedHire->estimate_notify_to > 0) 
		{
			DB::table('hire')->where('id', $selectedHire->id)->update(['estimate_notify_to'=>0]);
		}
		if(!$recruitList) return $this->view($this->noneLayout, compact('receiveCount', 'requestCount', 'receiveList', 'requestList', 'receiveSum', 'requestSum', 'itemActive', 'itemActive', 'recruitList', 'hire_id'));

		$messageList = $this->getReceivedMsg($selectedHire->id);

		return $this->view($viewLoad, compact('receiveCount', 'requestCount', 'receiveList', 'requestList', 'receiveSum', 'requestSum', 'recruitList', 'selectedHire', 'hire_id', 'messageList') );
	}
	public function getRequested(Request $request, $hire_id = false, $viewLoad = 'Agency::mypage.recruit.requested')
	{
		$user_id = session('user_id');
		list($receiveCount, $requestCount, $receiveList, $requestList, $receiveSum, $requestSum) = $this->getRecruitCount($user_id);
		$recruitList = $this->getRequestedQuery();
		$itemActive = 'requested';
		if(!$hire_id && count($recruitList))
		{
			return redirect()->route( (stristr($viewLoad, 'client')?'client.recruitment.requested':'agency.recruitment.requested') , [$recruitList->first()->id]);
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

		$messageList = $this->getRequestedMsg($selectedHire->id);
        return $this->view($viewLoad, compact('receiveCount', 'requestCount', 'receiveList', 'requestList', 'receiveSum', 'requestSum', 'recruitList', 'selectedHire', 'hire_id', 'messageList') );
		
	}
	public function postRequested(Request $request)
	{
		$data['success'] = false;
		if($request->deli_date && $request->deposit_money && $request->agency_estimate && $request->hire_id)
		{
			$hire = DB::table('hire')
				->where('id', $request->hire_id)
				->where(function($query) {
					$query->where('from_id', session('user_id'))
						->orWhere('to_id', session('user_id'));
				})
				
				->first();
			if($hire)
			{
				$insertData = array();
				$insertData['deli_date'] = str_replace( ['年','月','日'], '-', $request->deli_date );
				$insertData['deposit_money'] = $request->deposit_money;
				$insertData['agency_estimate'] = $request->agency_estimate;
				$insertData['client_pay'] = ceil($request->agency_estimate * 1.055);
				$insertData['notify_to_id'] = 1;
				$insertData['estimate_notify_to'] = 1;
				DB::table('hire')
					->where('id', $request->hire_id)
					->update($insertData);
				$data['success'] = true;
			}
			
		}
		return response()->json($data);
	}
	public function getFinished(Request $request, $hire_id = false, $viewLoad = 'Agency::mypage.recruit.finished')
	{
		$user_id = session('user_id');
		list($receiveCount, $requestCount, $receiveList, $requestList) = $this->getRecruitCount($user_id);
		$recruitList = $this->getFinishedQuery();
		$itemActive = 'finished';
		if(!$hire_id && count($recruitList) ) {
			return redirect()->route( (stristr($viewLoad, 'client')?'client.recruitment.finished':'agency.recruitment.finished'), [$recruitList->first()->id] );
		} else {
			if(!$recruitList) return $this->view($this->noneLayout, compact('receiveCount', 'requestCount', 'receiveList', 'requestList', 'itemActive', 'itemActive', 'recruitList', 'hire_id'));
			else {
				foreach ($recruitList as $key => $value) {
					if($value->id == $hire_id)
					{
						$selectedHire = $value;
						break;
					}
				}
			}
			if(empty($selectedHire)) return $this->view($this->noneLayout, compact('receiveCount', 'requestCount', 'receiveList', 'requestList', 'itemActive', 'itemActive', 'recruitList', 'hire_id'));
		}
		if(!$recruitList) return $this->view($this->noneLayout, compact('receiveCount', 'requestCount', 'receiveList', 'requestList', 'itemActive', 'itemActive', 'recruitList', 'hire_id'));

		$messageList = $this->getFinishedMsg($selectedHire->id);

		return $this->view($viewLoad, compact('receiveCount', 'requestCount', 'receiveList', 'requestList', 'recruitList', 'selectedHire', 'hire_id', 'messageList'));
	}
	public function postCancelMatching(Request $request)
    {
        $user_id = session('user_id');
        if(!$request->hire_id) 
        	return response()->json(['success'=>false]);
    	$hire_id = $request->hire_id;
        DB::table('hire')
            ->where('id', $hire_id)
            ->where(function($query) use($user_id) {
                $query->where('from_id', $user_id)
                    ->orWhere('to_id', $user_id);
            })
            ->update(['finish_flag'=>1]);
        Event::fire(new HireClientEvent('finish',$hire_id));
        return response()->json(['success'=>true]);
    }
    public function postRequestedMatching(Request $request)
    {
    	$hire = DB::table('hire')
    		->where('from_id', session('user_id'))
    		->where('id', $request->hire_id)
    		->where('finish_flag', 0)
    		->first();
    	if($hire)
    	{
    		DB::table('hire')
    			->where('id', $hire->id)
    			->update(['accept'=>1]);
    		Event::fire(new HireClientEvent('accept',$hire_id));
    	}
    	return response()->json(['success'=>true]);
    }
	public function view($blade, $params = [])
	{
		$params['user'] = User::where('id', session('user_id'))->with(['user_location'])->first();
        $params['profile_completed'] = $this->mypage->calculatorProfile(session('user_id'));
        return view($blade, $params);
	}

}