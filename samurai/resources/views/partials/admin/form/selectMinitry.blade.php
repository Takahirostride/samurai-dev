@php
	$atb_ar = array_merge([
		'class'=>'form-control select_minitry',
		'id'=>'address_minitry',
		'data-children'=>'#address_sub_minitry'
	],$atb);
	$atbs = ol_array_to_attribute($atb_ar);
@endphp
<select {!! $atbs  !!} name="{{ $name }}" value="{{ $value }}"></select>