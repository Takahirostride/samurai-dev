@php
	if(!isset($element)){ return false;}
    $fav_status = 1;
    $fav_cls = 'far fa-star';
    if($element->userLog && $element->userLog->favorite==1){
        $fav_status =0;
        $fav_cls = 'fas fa-star';
    }
@endphp
<button type="button" class="bt-fav bt-fav-text olFavoriteSub" data-id="{{ $element->id }}" data-status="{{ $fav_status }}">
	<span class="{{ $fav_cls }}"></span>
	<span>お気に入り</span>
</button>