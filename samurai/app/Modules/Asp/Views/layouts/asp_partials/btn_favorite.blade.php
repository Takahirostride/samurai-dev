@php
	if(!isset($element)){ return false;}
    $fav_status = 1;
    $fav_cls = 'fa-star';
    if($element->aspUserLog && $element->aspUserLog->favorite==1){
        $fav_status =0;
        $fav_cls = 'fa-star-o';
    }
@endphp
<button type="button" class="btn btn-warning olFavorite}" data-id="{{ $element->id }}" data-status="{{ $fav_status }}">
	<span class="fa {{ $fav_cls }}"></span>
</button>