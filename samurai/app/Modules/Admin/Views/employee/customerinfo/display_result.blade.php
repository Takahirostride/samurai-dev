@php
	if(!isset($values)){ return false;}
@endphp
<div class="list-results text-right">
	<span class="result">{{ $values->count() }}件表示 / {{ $values->total() }}件</span>
</div>