<?php 
namespace App\Modules\Asp\Listeners;

use App\Modules\Asp\Events\HireClientEvent;
use App\Modules\Asp\Models\Hire;
use App\Modules\Asp\Models\Policy;
use App\Modules\Asp\Models\HireClientLog;
use App\Modules\Asp\Models\HireClientStatistic;

class HireClientListener{
	private $hire;
	private $client;
	private $policy_exist = null;
	public function __construct(){
		
	}
	public function handle(HireClientEvent $event){
		$type = $event->type;
		$hire_id = $event->hire_id;
		$hire = Hire::find($hire_id);
		if(!$hire || $hire->hire_type != 1){
			return false;
		}
		$hire->load(['fromUser','toUser']);
		$client = $hire->getClient();
		if(!$client){
			return false;
		}
		$this->hire = $hire;
		$this->client = $client;
		switch ($type) {
			case 'create':
				$this->createHireLog();
				$this->updatePolicy();
				$this->updateStatisticTotal();
				break;
			case 'accept':
				$this->updateStatisticAccept();
				break;
			case 'finish':
				$this->updateStatisticFinish();
				break;
			default:
				break;
		}
		return true;
	}
	private function updateStatisticAccept(){
		$stt = HireClientStatistic::where('client_id',$this->client->id)->first();
		if($stt){
			$stt->increment('accept');
		}
		return true;
	}
	private function updateStatisticFinish(){
		$stt = HireClientStatistic::where('client_id',$this->client->id)->first();
		if($stt){
			$stt->increment('finish');
		}
		return true;
	}
	private function createHireLog(){
		$data = [
			'client_id'=>$this->client->id,
			'hire_id'=>$this->hire->id,
			'policy_id'=>$this->hire->policy_id,
			'status'=>1,
		];
		HireClientLog::create($data);
	}
	private function updatePolicy(){
		if(!$this->checkPolicyExist()){
			$policy = Policy::find($this->hire->policy_id);
			if($policy){
				$policy->increment('total_hire_client');
			}
		}
		return true;
	}
	private function updateStatisticTotal(){
		$stt = HireClientStatistic::where('client_id',$this->client->id)->first();
		if($stt){
			$dt=[];
			$dt['total'] = $stt->total + 1;
			if(!$this->checkPolicyExist()){
				$dt['policy_count'] = $stt->policy_count + 1;
			}
			if($this->hire->accept == 1){
				$dt['accept'] = $stt->accept + 1;
			}			
			if($this->hire->finish_flag == 1){
				$dt['finish'] = $stt->finish + 1;
			}			
			$stt->update($dt);
		}else{
			$dt=[
				'client_id'=>$this->client->id,
				'total'=>1,
				'policy_count'=>1,
			];
			$dt['accept'] = $this->hire->accept == 1 ? 1 : 0;
			$dt['finish'] = $this->hire->finish_flag == 1 ? 1 : 0;
			HireClientStatistic::create($dt);
		}
		return true;
	}
	private function checkPolicyExist(){
		if($this->policy_exist !== null){
			return $this->policy_exist;
		}
		$cnd = [
			['id','!=',$this->hire->id],
			['policy_id','=',$this->hire->policy_id]
		];
		$client = $this->client;
		$check = Hire::where($cnd)
					->where(function($qr) use($client){
						$qr->where('from_id',$client->id)->orWhere('to_id',$client->id);
					})		
					->exists();
		$this->policy_exist = $check;			
		return $check;			
	}
}