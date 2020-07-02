<?php

namespace App\Modules\Asp\Models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Asp\Models\Province;
use App\Modules\Asp\Models\AspCompany;
use Carbon\Carbon;
use DB,Cache;
class Policy extends Model {

    const STATUS_LIST = ["公開","未公開","公開不可","掲載終了","削除"];
    const RECOM_BOUNTY=[0=>'',1=>'おすすめの助成金'];
    protected $table = 'policy';
    public $timestamps = false;
    protected $guarded = ['_token'];
    protected $casts = [
        'register_pdf' => 'array',
        'register_pdf1' => 'array',
        'tag' => 'array',
        'acquire_budget'=>'array',
        'business_type'=>'array'
    ];  
    protected $dates = [
        'created_date'
    ];       
    //
    public function userLog(){
        $asp_user = auth('asp_user')->user();
        return $this->hasOne('App\Modules\Asp\Models\AspPolicyLog','policy_id','id')->where('asp_user_id','=',$asp_user->id);
    }
    public function cat(){
        return $this->belongsToMany('App\Modules\Asp\Models\Category','policy_category','policy_id','category_id');
    }
    public function subCat(){
        return $this->belongsToMany('App\Modules\Asp\Models\SubCategory','policy_category','policy_id','sub_category_id');
    }

    public function provinces(){
        return $this->belongsToMany('App\Modules\Asp\Models\Province','policy_region','policy_id','province_id');
    } 
    public function cities(){
        return $this->belongsToMany('App\Modules\Asp\Models\City','policy_region','policy_id','city_id');
    } 
    public function policy_region()
    {
        return $this->hasOne('App\Models\PolicyRegion', 'policy_id');
    }

    public function policyCat(){
        return $this->hasMany('App\Modules\Asp\Models\PolicyCat','policy_id','id');
    }    
    public function policyReg(){
        return $this->hasMany('App\Modules\Asp\Models\PolicyRegion','policy_id','id');
    }
    public function policyRegOne()
    {
        return $this->hasOne('App\Modules\Asp\Models\PolicyRegion', 'policy_id');
    }    
    public function minitry(){
        return $this->belongsTo('App\Modules\Asp\Models\Province','minitry_id','id');
    }
    public function subMinitry(){
        return $this->belongsTo('App\Modules\Asp\Models\City','sub_minitry_id','id');
    }
    public function tags(){
        return $this->belongsToMany('App\Modules\Asp\Models\Tag','policy_tag','policy_id','tag_id');
    } 
    public function policy_business(){
        return $this->hasMany('App\Modules\Asp\Models\PolicyBusiness','policy_id');
    }      
    //
    public function scopeRecommend($query,$client){      
        $query = $query->where('publication_setting','=', 0)
                ->where(function($qr){
                    $current_date = date('Y-m-d');
                    $qr->where('subscript_duration_detail','=','0000-00-00')
                        ->orWhere('subscript_duration_detail','>=',$current_date);
                });   
        if(!empty($client->province_id))
        {
            $toan_quoc = Province::getIdNationWide();
            $first_city = false;
            $first_city_check = DB::table('cities')
                        ->where('province_id', $client->province_id)
                        ->where('city_name', 'すべて')
                        ->first();
            if($first_city_check){
                $first_city  = $first_city_check->id;
            }                                    
            $query = $query->whereHas('policyRegOne',function($qr) use ($client, $first_city, $toan_quoc){
                $qr->where(function($q1) use($client, $first_city, $toan_quoc) {
                    $q1->where('province_id', $toan_quoc)
                        ->orWhere(function($qq1) use($client) {
                            $qq1->where('province_id', $client->province_id)
                                ->where('city_id', $client->city_id);
                        });
                    if($first_city != $client->city_id)
                    {
                        $q1->orWhere(function($qq2) use($client, $first_city) {
                            $qq2->where('province_id', $client->province_id)
                            ->where('city_id', $first_city);
                        });
                    }
                });
            });
        } 
        if($client->capital > 0)
        {
            $query = $query->where(function($query) use($client) {
                if($client->capital){
                    $query = $query->where(function($q1) use($client) {
                        $q1->where('capital_start', '<=', ($client->capital*10000) )
                                ->where('capital_end', '>=', ($client->capital*10000) );
                        });
                }
                if($client->staff_number){
                    $query = $query->orWhere(function($q2) use($client) {
                        $q2->where('employees_count_start', '<=', $client->staff_number)
                            ->where('employees_count_end', '>=', $client->staff_number);
                    });
                }
                if($client->establish_at)
                {
                    $yy = date('Y', strtotime($client->establish_at) );
                    if($yy > 0 && $yy <= date('Y') && strlen($yy)==4)
                    {
                        $query->orWhere(function($q3) use($client, $yy) {
                                $q3->where(function($q4) use($client, $yy) {
                                    $q4->where('founding_year_start', '<=', $yy)
                                    ->where('founding_year_end', '>=', $yy);
                                })
                                ->orWhere('subscript_duration_option', 1);
                        });
                    }
                }
                
            });
        }  
        return $query;      
    }
    public function scopePopular($query){
        $sel = ['id','image_id','name','update_date','subscript_duration_detail','acquire_budget','minitry_id','sub_minitry_id','target'];
        $with = ['minitry','subMinitry','cat'];
        return $query->select($sel)->with($with);
    }
    public function scopeSummary($query){
            $p_sel = ['id','acquire_budget','image_id','name','name_serve','minitry_id','sub_minitry_id','subscript_duration','support_content','support_scale','acquire_budget_first','acquire_budget_display','subscript_duration_detail'];
            return $query->select($p_sel)->with([
                'tags','minitry','subMinitry'  
            ]);
    }
    public function scopeNewAsp($query){
        $sl=[
            'id','name','capital_start','capital_end','employees_count_start','employees_count_end','founding_year_start','founding_year_end','update_date'
        ];
        return $query->select($sl)
                ->with([
                    'policyReg','policyReg.city'
                ])
                ->where([
                    ['publication_setting','=',0],
                    ['is_new_asp','=',1]
                    ])
                ->where(function($qr){
                  $current_date = date('Y-m-d');
                  $qr->where('subscript_duration_detail','=','0000-00-00')
                      ->orWhere('subscript_duration_detail','>=',$current_date);
                });        
    }
    public function scopeCountHireMonth($query){
        $today = Carbon::now();
        $today_st = $today->format('Y-m-d');
        $next_month = $today->addMonth(1); 
        $q_date = $next_month->format('Y-m-d');
        $sl = ['id','name','subscript_duration_detail','capital_start','capital_end','employees_count_start','employees_count_end','founding_year_start','founding_year_end','update_date'
            ];
        return $query->select($sl)
                                ->with([
                                    'policyReg','policyReg.city'
                                ])        
                              ->where([
                                ['subscript_duration_detail','>=',$today_st],
                                ['subscript_duration_detail','<=',$q_date],
                                ['publication_setting','=',0]
                              ]);
                              
    }
    public function scopeCountHire($query){
        $today = date('Y-m-d'); 
        $sl = ['id','name','subscript_duration_detail',
                DB::raw('(SELECT COUNT(*) FROM `hire` WHERE `hire`.`policy_id`= `policy`.`id`)as hire_count')
            ];
        return $query->select($sl)
                              ->where([
                                ['subscript_duration_detail','>=',$today],
                                ['publication_setting','=',0]
                              ]);
                              
    }    
    public function scopeNumberHire($query){
        $today = date('Y-m-d'); 
        $sl = ['id','name','subscript_duration_detail',
                DB::raw('(SELECT COUNT(*) FROM `hire` WHERE `hire`.`policy_id`= `policy`.`id`)as hire_count')
            ];
        return $query->select($sl);
                              
    }    
    //
    public function clientRecommend(){
        $result = AspCompany::recommend($this)->count();
        return $result;
    }
    public function acquireBudgetName(){
    	$bd = $this->acquire_budget;
    	if(empty($bd)){return null;}
    	if(!is_array($bd)){$bd = json_decode($bd,true);}
    	$amounts = config('policy.amount_list');
    	$out = array_intersect_key($amounts, array_flip($bd));
    	return implode(',',$out);
    }
    public function statusName(){
        $status = static::STATUS_LIST;
        if(!is_numeric($this->publication_setting)){ return null;}
        $stt = (int)$this->publication_setting;
        if(!array_key_exists($stt,$status)){return null;}
        return $status[$stt];
    }
    public function recomBountyName(){
        $recom = empty($this->recom_bounty) ? 0 : 1;
        return static::RECOM_BOUNTY[$recom];
    }
    public function categoryName(){
        if(!$this->cat){ return null;}
        $cats = $this->cat->unique('id')->values();
        return $cats->implode('category_name','');
    }
    public function regionName(){
        if(!$this->provinces){ return null;}
        return $this->provinces->implode('province_name',',');
    
    }    
    public function companyName(){
        $out ='';
        if($this->minitry){
            $out .= $this->minitry->province_name;
        }
        if($this->subMinitry){
            $out .= $this->subMinitry->city_name;
        }
        return $out;
    } 
    public function acquire_budget_text()
    {
        $text = '';
        if($this->acquire_budget_first) $text .= $this->acquire_budget_first;
        if($this->acquire_budget_first && $this->acquire_budget_display) $text .= ' : ';
        if($this->acquire_budget_display) $text .= $this->acquire_budget_display;
        return $text;

    } 
    public function updateDateName(){
        return str_replace(['年','月','日'],['/','/',''], $this->update_date);
    } 
    public function countCompany(){
        $user = auth('asp_user')->user();
        $policy_id = $this->id;
        $results = AspCompany::where('asp_user_id','=',$user->id)
                               ->whereHas('clientLog',function($qr)use($policy_id){
                                $qr->where('policy_id','=',$policy_id);
                               })
                               ->count();
        return $results;                        

    }       
}