<?php 
namespace App\Helpers\Media;
use App\Helpers\Media\SimpleImage as SimpleImage;
use Exception;
class UploadImage{
	protected $files;
	protected $path='';
	protected $dir;
	protected $url ;
	protected $name;
	protected $thumb_dir = "thumbnail/";
	protected $thumb_size = array(150,150);
	protected $types=array('image/gif', 'image/jpeg', 'image/png');
	public function __construct($image){
		$this->files = $image;
		$this->validate();
		$this->create_dir();		
 		$this->rename();
	}
	public function create_dir(){
		$time_path = date('Y').'/'.date('m');
		$this->dir = public_path().'/assets/photo/'.$time_path;
		$this->url = 'assets/photo/'.$time_path;
		if(!file_exists($this->dir)){
			mkdir($this->dir,0755,true);
		}
	}
	public function validate(){
		$file = $this->files;
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
	public function rename(){
		$file = $this->files;
	    $parts = pathinfo($file->getClientOriginalName());
	    $name = str_random(40).'.'.$parts["extension"];
	    while (file_exists($this->dir .'/'. $name)) {
	        $i++;
	        $name = str_random(40).'.'.$parts["extension"];
    	}
    	$this->name = $name ;
    	return ;
	}
	public function thumbnail(){
		$file=$this->files;
		$p_file = $this->dir.$this->thumb_dir.$this->name;
		$p_dir = $this->dir.$this->thumb_dir;
		if(!is_dir($p_dir)){
			mkdir($p_dir,0777,true);
		}
		$size=$this->thumb_size;
		$img = new abeautifulsite\SimpleImage($file['tmp_name']);
		$img->thumbnail($size[0],$size[1]);
		$img->save($p_file);
		return;
	}
	public function resize($w,$h,$crop=false){
 		$img = new SimpleImage($this->path);
 		$width = $img->get_width();
		$height = $img->get_height();
		if($width < $w && $height < $h){
			return false;
		}
		if(!$crop){
		    $ratio = min($w/$width, $h/$height);
		    $w = $width * $ratio;
		    $h = $height * $ratio;
		    $img->resize($w,$h);
		}else{
			$img->thumbnail($w,$h);
		}
		
		$name_inf = pathinfo($this->name);
		$name = $name_inf['filename'].'-'.(int)$img->get_width().'x'.(int)$img->get_height().'.'.$name_inf['extension'];
		$path = $this->dir . '/'.$name ;
		$url = $this->url . '/'.$name;				
		$img->save($path);
		return ['url'=>$url];
	}
	public function resize_org($w,$h,$crop=false){
 		$img = new SimpleImage($this->path);
 		$width = $img->get_width();
		$height = $img->get_height();
		if($width < $w && $height < $h){
			return false;
		}
		if(!$crop){
		    $ratio = min($w/$width, $h/$height);
		    $w = $width * $ratio;
		    $h = $height * $ratio;
		    $img->resize($w,$h);
		}else{
			$img->thumbnail($w,$h);
		}
		
		$name_inf = pathinfo($this->name);
		$name = $name_inf['filename'].'.'.$name_inf['extension'];
		$path = $this->dir . '/'.$name ;
		$url = $this->url . '/'.$name;				
		$img->save($path);
		return ['url'=>$url];
	}	
	public function save(){
		$this->files->move($this->dir,$this->name);
		$this->path = $this->dir.'/'.$this->name;
		$url = $this->url .'/' . $this->name;
	    return ['url'=>$url];    			
	} 	
}