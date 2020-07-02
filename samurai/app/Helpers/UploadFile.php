<?php 
namespace App\Helpers;
use Storage;
class UploadFile {
	public static function upload($path = '', $file = '', $fileName = '')
	{
		if(!$path || !$file || !$fileName) return false;
		Storage::makeDirectory($path);
		return Storage::disk('local')->putFileAs($path, $file,  $fileName );
	}
	public static function remove($path = '')
	{
		if(!$path) return false;
		Storage::disk('local')->delete($path);
	}
}