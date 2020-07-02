<?php 
namespace App\Modules\Asp\Listeners;

use App\Modules\Asp\Events\AspPolicyEvent;
use App\Modules\Asp\Models\AspPolicyLog;
use Session;
class AspPolicyListener{
	private $policy;
	private $user;
	private $ss_instance = 'asp_policy_viewer';
	public function __construct(){
		$this->user = auth('asp_user')->user();
	}
	public function handle(AspPolicyEvent $event){
		$this->policy = $event->policy;		
		switch ($event->type) {
			case 'favorite':			
				$this->log_add([
					'favorite'=>1,
					'created_at'=>date('Y-m-d H:i:s',time())
				]);
				break;
			case 'dis_favorite':
				$this->log_add(['favorite'=>0]);
				break;					
			default:
				break;
		}
		return true;
	}
	private function log_add($dt){
		$cnd = [
			'policy_id'=>$this->policy->id,
			'asp_user_id'=>$this->user->id,
		];
		AspPolicyLog::updateOrCreate($cnd,$dt);
		return true;		
	}
    public function check_viewer($id){
        $posts = Session::get($this->ss_instance,[]);
        return array_key_exists($id, $posts);
    }
    public function update_ss_viewer($post_id){
        $key = $this->ss_instance . '.' . $post_id;
        Session::put($key,time());
        return true;
    }	
}