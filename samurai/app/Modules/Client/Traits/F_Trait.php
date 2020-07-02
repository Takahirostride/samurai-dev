<?php 
namespace App\Modules\Client\Traits;
use App\Models\VisitPolicy;
use App\Models\Policy;
use App\Models\Hire;
trait F_Trait{
    public function getBookmark($user){
        $p_sel = ['id','acquire_budget','image_id','name','name_serve','minitry_id','sub_minitry_id','subscript_duration','support_content','support_scale','acquire_budget_first','acquire_budget_display','subscript_duration_detail'];
        $values = Policy::select($p_sel)->with([
            'tags','minitry','sub_minitry',
            'policy_region.province',
            'checklist_policy_user'=>function($qr)use($user){
                $qr->where('user_id','=',@$user->id);
            },
            'matchingUser'=>function($qr)use($user){
                        $qr->where([
                            ['user_id','=',@$user->id]
                        ]);
                    }           
        ]);  
        $values = $values->whereHas('checklist_policy_user',function($qr)use($user){
            $qr->where([
                ['user_id','=',@$user->id]
            ]);
        }); 
        return $values;        
    }
	public function getHirePolicy($user){
        $sel=['id','from_id','to_id','policy_id'];
        $results = Hire::select($sel)->with([
            'policy'=>function($qr)use($user){
                $p_sel = ['id','acquire_budget','image_id','name','name_serve','minitry_id','sub_minitry_id','subscript_duration','support_content','support_scale','acquire_budget_first','acquire_budget_display','subscript_duration_detail'];
                $with = ['tags','minitry','sub_minitry','policy_region.province']; 
                $qr = $qr->select($p_sel)->with($with); 
                return $qr;                      
            }
        ]);
        $results = $results->where(function($qr)use($user){
                        $qr->where('from_id','=',@$user->id)
                            ->orWhere('to_id','=',@$user->id);
                        })
                        ->has('policy'); 
        return $results;                    
    }
    public function getPolicyHire($user){
        $p_sel = ['id','acquire_budget','image_id','name','name_serve','minitry_id','sub_minitry_id','subscript_duration','support_content','support_scale','acquire_budget_first','acquire_budget_display','subscript_duration_detail'];
        $with = ['tags','minitry','sub_minitry','policy_region.province',
                    'checklist_policy_user'=>function($qr)use($user){
                        $qr->where('user_id','=',@$user->id);
                    },
                'matchingUser'=>function($qr)use($user){
                            $qr->where([
                                ['user_id','=',@$user->id]
                            ]);
                        }                    
                ]; 
        $results = Policy::select($p_sel)
                    ->with($with)
                    ->whereHas('hire',function($qr)use($user){
                        $qr->where('from_id','=',@$user->id)
                            ->orWhere('to_id','=',@$user->id);
                    }); 
        return $results; 
    }
    public function getVisitPolicy($user){
        $results = VisitPolicy::with([
            'policy'=>function($qr)use($user){
                $p_sel = ['id','acquire_budget','image_id','name','name_serve','minitry_id','sub_minitry_id','subscript_duration','support_content','support_scale','acquire_budget_first','acquire_budget_display','subscript_duration_detail'];
                $with = ['tags','minitry','sub_minitry','policy_region.province',
                            'checklist_policy_user'=>function($qr)use($user){
                                $qr->where('user_id','=',@$user->id);
                            },
							'matchingUser'=>function($qr)use($user){
							            $qr->where([
							                ['user_id','=',@$user->id]
							            ]);
							        }                            
                        ]; 
                $qr = $qr->select($p_sel)->with($with); 
                return $qr;                      
            }
        ]);
        $results = $results->where('user_id','=',@$user->id)
                    ->has('policy'); 
        return $results;            		
	}
	public function getPolicyVisit($user){
        $p_sel = ['id','acquire_budget','image_id','name','name_serve','minitry_id','sub_minitry_id','subscript_duration','support_content','support_scale','acquire_budget_first','acquire_budget_display','subscript_duration_detail'];
        $with = ['tags','minitry','sub_minitry','policy_region.province',
                    'checklist_policy_user'=>function($qr)use($user){
                        $qr->where('user_id','=',@$user->id);
                    },
				'matchingUser'=>function($qr)use($user){
				            $qr->where([
				                ['user_id','=',@$user->id]
				            ]);
				        }                    
                ]; 
        $results = Policy::select($p_sel)
	        		->with($with)
	        		->whereHas('visits',function($qr)use($user){
	        			$qr->where('user_id','=',@$user->id);
	        		}); 
        return $results; 
	}

}