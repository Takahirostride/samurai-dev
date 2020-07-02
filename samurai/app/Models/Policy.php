<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Policy extends Model
{
    //
    protected $table = 'policy';
    protected $fillable = ['name','subscript_duration','object_duration','register_insti','register_insti_detail','target','tag','info','support_content','support_scale','adopt_result','inquiry','register_pdf','update_date','name_serve','minitry_id','sub_minitry_id','scraping_url'];
    public $timestamps = false;
    public function matching_user()
    {
    	return $this->hasMany('App\Models\MatchingUser', 'policy_id')->where('user_type','=', 0)->whereHas('user')->with('user');
    }
    public function first_matching_user()
    {
        if($this->matching_user())
        {
            foreach($this->matching_user as $matching)
            {
                if($matching->user) {
                    return $matching->user;
                }
            }
        }
        return (object)[];
    }
    public function checklist_policy_user()
    {
    	return $this->hasMany('App\Models\CheckListPolicyUser', 'policy_id');
    }
    public function policy_region()
    {
        return $this->hasOne('App\Models\PolicyRegion', 'policy_id');
    }
    public function policy_region_many()
    {
        return $this->hasMany('App\Models\PolicyRegion', 'policy_id');
    }
    public function minitry()
    {
        return $this->beLongsTo('App\Models\Province', 'minitry_id');
    }
    public function sub_minitry()
    {
        return $this->beLongsTo('App\Models\City', 'sub_minitry_id');
    }
    public function minitry_text()
    {
        return @$this->minitry->province_name . ' ' . @$this->sub_minitry->city_name;
    }
    public function region_text()
    {
        $text = '';
        if(count($this->policy_region_many)) {
            foreach ($this->policy_region_many as $key => $value) {
                if($value->province_id != 0)
                {
                    $text .= @$value->province->province_name;
                }
                if($value->city)
                {
                    $text .= ' ' . @$value->city->city_name;
                }
                if( ($key+1) < count($this->policy_region_many) )
                {
                    $text .= ', ';
                }
            }
        }
        
        return $text;
    }
    public function acquire_budget_text()
    {
        $text = '';
        if($this->acquire_budget_first) $text .= $this->acquire_budget_first;
        if($this->acquire_budget_first && $this->acquire_budget_display) $text .= ' : ';
        if($this->acquire_budget_display) $text .= $this->acquire_budget_display;
        return $text;

    }
    public function matching_user_search()
    {
        return $this->hasMany('App\Models\MatchingUser', 'policy_id')->where('user_type','=', 0);
    }
    public function policy_business(){
        return $this->hasMany('App\Models\PolicyBusiness','policy_id');
    }
    public function provinces(){
        return $this->belongsToMany('App\Models\Province','policy_region','policy_id','province_id');
    } 
    public function cities(){
        return $this->belongsToMany('App\Models\City','policy_region','policy_id','city_id');
    } 
    public function user(){
        return $this->belongsToMany('App\Models\User','matching_users','policy_id','user_id');
    }
    public function cat(){
        return $this->belongsToMany('App\Models\Category','policy_category','policy_id','category_id');
    }
    public function subCat(){
        return $this->belongsToMany('App\Models\SubCategory','policy_category','policy_id','sub_category_id');
    }
    public function matching()
    {
        return $this->hasOne('App\Models\Matching', 'to_id');
    }
    public function post()
    {
        return $this->hasMany('App\Models\Post', 'policy_id');
    }
    public function seller(){
        return $this->belongsToMany('App\Models\Seller','seller_policy','policy_id','seller_id');
    }
    public function tags(){
        return $this->belongsToMany('App\Models\Tag','policy_tag','policy_id','tag_id');
    }
    public function matchingUser()
    {
        return $this->hasMany('App\Models\MatchingUser', 'policy_id');
    }   
    public function visits()
    {
        return $this->hasMany('App\Models\VisitPolicy', 'policy_id');
    }   
    public function hire()
    {
        return $this->hasMany('App\Models\Hire', 'policy_id');
    }   
    public function check_hire()
    {
        return $this->hasMany('App\Models\Hire', 'policy_id')
        ->where(function($q) {
            $q->where('from_id', session('user_id') )
            ->orWhere('to_id', session('user_id') );
        });
    }  

    //
    public function checkTermDisplay(){
        return strpos($this->acquire_budget, '0');        
    }
    public function isLike(){
        if($this->checklist_policy_user->isEmpty()){
            return 0;
        }
        $ite = $this->checklist_policy_user->first();
        return $ite->type;
    }
    //
    public function seller_policy()
    {
        return $this->hasMany('App\Models\SellerPolicy', 'policy_id');
    }
    public function paid_user()
    {
        return $this->hasMany('App\Models\MatchingUser', 'policy_id');
    } 
    public function scrape_links()
    {
        return $this->hasOne('App\Models\ScrapeLinks', 'id',  'scrape_links_id');
    } 

    public function region_p(){
        return $this->belongsToMany('App\Models\Province','policy_region','policy_id','province_id');
    } 

    public function region_text_mutil()
    {
        $text = '';
        if($this->region_p)
        {
            foreach ($this->region_p as $key => $value) {
                if($key > 0) $text .= ' , ';
                $text .= $value->province_name;
                if($this->cities[$key]->city_name) 
                {
                    $text .= ' ' . $this->cities[$key]->city_name;
                }

            }
            // dd($this->region_p);
            // $text .= $this->policy_region->province->province_name;
            // if($this->policy_region->city) 
            // {
            //     $text .= ' ' . $this->policy_region->city->city_name;
            // }
        }
        return $text;
    }
}
