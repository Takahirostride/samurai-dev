<?php

namespace App\Modules\Asp\Models;

use Illuminate\Database\Eloquent\Model;
use Cache;
class Category extends Model
{
    //
    protected $table = 'categories';
    
    public function subcategory()
    {
        return $this->hasMany('App\Modules\Asp\Models\SubCategory', 'category_id', 'id');
    }
    static public function listCat(){
        /*$cats = Cache::rememberForever('samurai_main_category',function(){
            $out = static::pluck('category_name','id');
            return $out;
        });*/
        $cats = static::pluck('category_name','id');
        return $cats;
    }       
}
