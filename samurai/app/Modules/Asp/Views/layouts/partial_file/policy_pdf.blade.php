@php
	if(!isset($pdfs)){ return false;}
@endphp
<div class="lst-pdf">
    @foreach ($pdfs as $ite)
        @if(!empty($ite['url']) && !empty($ite['name']))
        	<p><a href="{{ $ite['url'] }}" download>{{ $ite['name'] }}</a></p>
        @elseif(!empty($ite[0]) && !empty($ite[1]))
        	<p><a href="{{ $ite[1] }}" download>{{ $ite[0] }}</a></p>
		@endif	
        
    @endforeach	
</div>