<?php 
namespace App\Helpers\Media;
use App\Helpers\UploadFile;
use Exception;

class UploadPdf{
	private $file;
	private $types = ['application/pdf'];
	private $name,$dir,$dir_rel,$url,$name_display;
	public function __construct($file){
		$this->file = $file;
		$this->validate();
		$this->create_dir();		
 		$this->rename();		
	}
	public function save(){
		$result = UploadFile::upload($this->dir_rel,$this->file,$this->name);
		if(!$result){
			throw new Exception("Error!");
		}
		return [
			'name'=>$this->name_display,
			'path'=>$result
		];
	}
	private function create_dir(){
		$time_path = date('Y').'/'.date('m');
		$this->dir_rel = 'assets/pdf/'.$time_path;
		$this->dir = public_path().'/'.$this->dir_rel;
		$this->url = 'assets/pdf/'.$time_path;
		if(!file_exists($this->dir)){
			mkdir($this->dir,0755,true);
		}
	}
	private function validate(){
		$file = $this->file;
		if(!$file->isValid()){
			throw new Exception( $file->getErrorMessage());
		}
		$fileType = $file->getMimeType();
		if(!in_array($fileType, $this->types)){
			throw new Exception("not allow ".$fileType." file's extension");
		}
		$size = $file->getClientSize();
		$max_size = $file->getMaxFilesize();
		if($size > $max_size){
			throw new Exception("size of file is larger than $max_size");
		}
		return false;
	}
	private function rename(){
		$file = $this->file;
	    $parts = pathinfo($file->getClientOriginalName());
	    $this->name_display = $parts['filename'];
	    $name = str_random(40).'.'.$parts["extension"];
	    while (file_exists($this->dir .'/'. $name)) {
	        $i++;
	        $name = str_random(40).'.'.$parts["extension"];
    	}
    	$this->name = $name ;
    	return ;
	}	
}