<?php 
namespace App\Helpers;
use ZipArchive;
class ZipFile {
	private $zip;
	private $path_file;
	public function __construct($path){
		$this->zip = new ZipArchive;
		$this->path_file = $path;
	}
	public function open(){
		return $this->zip->open($this->path_file, ZipArchive::CREATE);
	}
	public function close(){
		$this->zip->close();
		return true;
	}
	public function add($path,$name){
		 $this->zip->addFile($path,$name);
		 return true;
	}
}