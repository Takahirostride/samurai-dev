@php
	$atb = array_merge([
		'class'=>'form-control',
		'id'=>'address_sub_minitry',
	],$atb);
	$atb = ol_array_to_attribute($atb);
@endphp
<select {!! $atb !!} name="{{ $name }}" id="address_sub_minitry" value="{{ $value }}"></select>