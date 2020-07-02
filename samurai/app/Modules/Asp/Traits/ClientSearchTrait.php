<?php 
namespace App\Modules\Asp\Traits;
use App\Modules\Asp\Models\AspClientLog;
use App\Modules\Asp\Models\User;
use App\Modules\Asp\Models\UserLoginInfo;
use App\Modules\Asp\Models\AspCompany;
trait ClientSearchTrait{
    public function companyRequest($request){
        $user = auth('asp_user')->user();
        $companies = AspCompany::countHire()->where([
                    'asp_user_id'=>$user->id
                ])->with([
                    'province','city','loginInfo'
                ]);
        if($request->filled('trade')){
            $companies = $companies->whereHas('trade',function($qr)use($request){
                $qr->whereIn('trade_id',$request->trade);
            });
        } 
        if($request->filled('province')){
            $companies = $companies->where('province_id','=',$request->province);
            if(!empty($request->query('city'))){
                $companies=$companies->where('city_id','=',$request->city);
            }            
        }

        if($request->filled('keyword')){
            $key = strip_tags($request->keyword);
            $companies = $companies->where('name','like',"%${key}%");;
        }                       
        return $companies;
    }
	public function userLoginRequest($request){
		$with = [
			'user'=>function($qr_main)use($request){
				$qr_main = $qr_main->popular()->with(['aspUserLog']);
		        return $qr_main;			
			}
		];
		$clients = UserLoginInfo::with($with);
        if($request->filled('trade')){
            $clients = $clients->whereHas('user.trade',function($qr)use($request){
                $qr->where('trade_id','=',$request->trade);
            });
        }
        if($request->filled('province')){
            $clients = $clients->whereHas('user.userLocation',function($qr)use($request){
                $qr=$qr->where('province_id','=',$request->province);
                if(!empty($request->query('city'))){
                	$qr=$qr->where('city_id','=',$request->city);
                }
            });
        }
        if($request->filled('keyword')){
            $key = strip_tags($request->keyword);
            $clients = $clients->whereHas('user',function($qr)use($key){
                        	$qr->where('company_name','like',"%${key}%");
                        });
        }
        return $clients;		
	}
	public function userLogRequest($request){
		$with=[
			'user'=>function($qr_main)use($request){
				$qr_main = $qr_main->popular()->with(['loginInfo']);
		        return $qr_main;			
			},
            'company'
		];
		$clients = AspClientLog::select(['asp_client_logs.*'])->with($with)->has('company');
        if($request->filled('trade')){
            $clients = $clients->whereHas('user.trade',function($qr)use($request){
                $qr->whereIn('trade_id',$request->trade);
            });
        }
        if($request->filled('province')){
            $clients = $clients->whereHas('user.userLocation',function($qr)use($request){
                $qr=$qr->where('province_id','=',$request->province);
                if(!empty($request->query('city'))){
                	$qr=$qr->where('city_id','=',$request->city);
                }
            });
        }
        if($request->filled('keyword')){
            $key = strip_tags($request->keyword);
            $clients = $clients->whereHas('user',function($qr)use($key){
            	$qr->where('company_name','like',"%${key}%");
            });
        }
        return $clients;		
	}	
	public function userRequest($request){
        $user = auth('asp_user')->user();
		$qr_main = User::popular()->with([
            'aspUserLog',
            'aspCompany'=>function($qr)use($user){
                $qr->select(['id','is_register','sended_at','email','asp_user_id','user_id']);
            },
            'loginInfo'
        ]);
        if($request->filled('trade') && is_array($request->trade)){
            $qr_main = $qr_main->whereHas('trade',function($qr)use($request){
                $qr->whereIn('trade_id',$request->trade);
            });
        }
        if($request->filled('province')){
            $qr_main = $qr_main->whereHas('userLocation',function($qr)use($request){
                $qr=$qr->where('province_id','=',$request->province);
                if(!empty($request->query('city'))){
                	$qr=$qr->where('city_id','=',$request->city);
                }
            });
        }
        if($request->filled('keyword')){
            $key = strip_tags($request->keyword);
            $qr_main = $qr_main->where('company_name','like',"%${key}%");
        }	
        return $qr_main;
	}
}