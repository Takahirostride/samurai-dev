<?php 
namespace App\Modules\Agency\Listeners;
use AuthSam;
use App\Modules\Agency\Events\ChangeUserInfoEvent;

class ChangeUserInfoListener {
	public function __construct(){
		
	}
	public function handle(ChangeUserInfoEvent $event){
		AuthSam::reLogin();
		return true;
	}
}