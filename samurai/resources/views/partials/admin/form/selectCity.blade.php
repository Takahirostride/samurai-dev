@php
	$atb = ol_array_to_attribute($atb);
@endphp
<select {!! $atb !!} name="{{ $name }}" id="address_city" value="{{ $value }}"></select>