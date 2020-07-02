@php
	$is_like = isset($is_like) ? $is_like: $element->isLike();
@endphp
<button data-uid="{{ $user->id }}" data-pid="{{ $element->id }}" data-like="{{ $is_like }}" type="button" class="btn btn-default btn-start"><span></span>お気に入り</button>