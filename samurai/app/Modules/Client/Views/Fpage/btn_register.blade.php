@php
	if(!isset($element)){ return false;}
	$cls = 'client-suggest';
	if($element->hire && !$element->hire->isEmpty()){
		$cls = 'gray';
	}
@endphp
<button type="button" class="btn btn-default btn-suggest {{ $cls }}">見積依頼</button>