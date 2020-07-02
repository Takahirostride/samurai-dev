<?php

namespace App\Modules\Asp\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Helpers\Media\UploadImage;
use Exception;
class UploadMediaController extends Controller
{
    protected $sizes = [
                        'full'=>[1920,1920,false],
                        'large' => [1024,1024,false],
                        'medium' => [768,768,false],
                        'thumbnail' => [200,200,true]
                    ];                   
    public function __construct(){
    }   
    public function storePath(Request $request)
    {
        $output = ['error'=>1];       
        if($request->ajax() && $request->hasFile('sgl_image') ){
            $upl_img = $request->file('sgl_image');
            $size = 'medium';
            if($request->has('size') && array_key_exists($request->size, $this->sizes)){
                $size = $request->size;
            }
             try {
                $file = new UploadImage($upl_img);
                $file->validate();
                $img = call_user_func_array([$file,'resize_org'], $this->sizes[$size]);
                if(!$img){
                    $img = $file->save();
                }              
                $output['error'] = 0;
                $output['path'] = $img['url'];

            } catch (Exception $e) {
                $output = ['error'=>1,'message'=>$e->getMessage()];
            }
        }
        return response()->json($output);
    }
}
