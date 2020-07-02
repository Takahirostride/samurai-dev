<?php 
namespace App\Modules\Asp\Listeners;

use App\Modules\Asp\Models\WorkSet;
use App\Modules\Asp\Models\HireClientLog;
use App\Modules\Asp\Events\WorksetClientEvent;

class WorkSetClientListener{
	public function __construct(){
		
	}
	public function handle(WorksetClientEvent $event){
		$work_id = $event->work_id;
		$work = WorkSet::find($work_id);
		if(!$work){
			return false;
		}
		$work->load([
			'hire'=>function($qr){
				$qr->with(['fromUser','toUser']);
			}
		]);
		if(!$work->hire){
			return false;
		}
		$client = $work->hire->getClient();
		if(!$client){
			return false;
		}
		$cnd = [
			'client_id'=>$client->id,
			'hire_id'=>$work->hire_id,			
		];
		HireClientLog::updateOrCreate($cnd,[
			'work_set_id'=>$work->id,
			'status'=>2,
			'updated_at'=>date('Y-m-d H:i:s'),
		]);
		return true;
	}
}