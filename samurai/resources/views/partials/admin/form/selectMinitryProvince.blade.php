@php
	$atb = array_merge([
		'class'=>'form-control select_minitry_province',
		'id'=>'address_minitry_province',
		'data-children'=>'#address_sub_minitry'
	],$atb);
	$atb = ol_array_to_attribute($atb);
@endphp
<select {!! $atb  !!} name="{{ $name }}" value="{{ $value }}"></select>