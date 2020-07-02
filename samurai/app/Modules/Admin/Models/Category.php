<?php

namespace App\Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Cache;
class Category extends Model {

    protected static function boot(){
        parent::boot();
        static::saving(function($user){
            Cache::forget('samurai_category_sub');
            Cache::forget('samurai_category_sub_detail');
            Cache::forget('samurai_main_category');
        });
        static::deleting(function($user){
            Cache::forget('samurai_category_sub');
            Cache::forget('samurai_category_sub_detail');
            Cache::forget('samurai_main_category');
        });

    }
    protected $table = 'categories';
    public $timestamps = false;
    //
    public function children(){
    	return $this->hasMany('App\Modules\Admin\Models\SubCategory','category_id','id');
    }    
    //
    static public function listCatSub(){
       //$prvs = Cache::rememberForever('samurai_category_sub',function(){
	    	$qur = static::with(['children'=>function($s_qr){
	    			$s_qr->where('display', 1)->select(['id','category_id','sub_name']);
			    	}])->where('display', 1)->get();
	    	$out = [];
	    	foreach($qur as $key=>$ite){
	    		$out[$ite->id]=[
	    			'id'=>$ite->id,
	    			'ite_name'=>$ite->category_name,
	    			'children'=>$ite->children->pluck('sub_name','id')->toArray()	    			
	    		];
	    	}
	    	return $out;
        //});
        //return $prvs;    	
    } 
    static public function listCatSubDetail(){
       //$prvs = Cache::rememberForever('samurai_category_sub_detail',function(){
            $qur = static::with(['children'=>function($s_qr){
                    $s_qr->where('display', 1)->select(['id','category_id','detail_question']);
                    }])->where('display', 1)->get();
            $out = [];
            foreach($qur as $key=>$ite){
                $out[$ite->id]=[
                    'id'=>$ite->id,
                    'ite_name'=>$ite->category_name,
                    'children'=>$ite->children->pluck('detail_question','id')->toArray()                   
                ];
            }
            return $out;
        //});
        //return $prvs;       
    }       
    static public function listCat(){
        //$cats = Cache::rememberForever('samurai_main_category',function(){
            $out = static::where('display', 1)->pluck('category_name','id');
            $out['location'] = '誘致関連';
            // dd($out);
            return $out;
        //});
        //return $cats;
    } 
}