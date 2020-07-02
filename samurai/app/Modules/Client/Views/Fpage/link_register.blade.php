@php
	if(!isset($element)){ return false;}
	$cls = 'client-suggest';
	$onclick = 'return true;';
	$link = route('client.fselect',['id'=>$element->id,'register'=>1]);

	// if(array_key_exists('matchingUser', $element->getRelations())&& !$element->matchingUser->isEmpty()){
	if($element->hire && !$element->hire->isEmpty()){
		$cls = 'gray';
		$onclick = 'return false;';
	}

@endphp
<a href="{{ $link }}" onclick="{{$onclick}}" class="btn btn-default btn-suggest {{ $cls }}">見積依頼</a>