@php
	$atb = array_merge([
		'class'=>'tiny-textarea form-control',
		'id'=>'tiny_'.$name,
	],$atb);
	$atb = ol_array_to_attribute($atb);
@endphp
<textarea name="{{ $name }}" {!! $atb !!}>{!! $value !!}</textarea>