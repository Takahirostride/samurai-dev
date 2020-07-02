@php
	if(!isset($element)){ return false;}
	if(!$element->file_ext || !$element->file_name || !$element->file_path){
		return false;
	}	
	switch($element->file_ext):			
	    default :
	        $fa = '<i class="fa fa-file-o"></i>';
	endswitch;
	$icon = "<span class='ico-file {$element->file_ext}'>{$fa}<span>{$element->file_ext}</span></span>";
@endphp
<a href="{{ $element->getFileLink() }}" class="lk-file" download>{!! $icon !!}<span class="filename">{{ $element->file_name }}</span></a>