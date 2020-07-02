@extends('Asp::layouts.asp_noheader')
@push('style')
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/asp/css/subsidy-print.css') }}">
@endpush
@section('content')
	<div class="container" id="preview-page">
		<div class="wr-prev" id="print-content">
			<div class="pre_hd">
				<p class="client-name txt-16">{{ $client->name }}<span>御中</span></p>
			</div>
			<div class="prev_ct">
				@php
					$hire_ip = '';
				@endphp
				@foreach ($policies as $policy)
				    <div class="subsidydetail">
				         @include('Asp::client.content_subsidy_preview',['policy'=>$policy])
				    </div>
				@endforeach
			</div>
		    <div class="prev_footer text-right">
		    	@php
		    		$user = auth('asp_user')->user();
		    		$signature = $user->signature;
		    	@endphp
		    	@if($signature)
		    		<div class="signature txt-12">
		    			<p>{{ $signature->company }}</p>
		    			<p><span>{{ $signature->position }}</span><span class="pl15">{{ $signature->name }}</span></p>
		    			<p>{{ $signature->address_1 }}</p>
		    			<p>{{ $signature->address_2 }}</p>
		    			<p>
		    				@if($signature->tel)
		    				<span>TEL:{{ $signature->tel }}</span>
		    				@endif
		    				@if($signature->fax)
		    				<span class="pl15">FAX:{{ $signature->fax }}</span>
		    				@endif		    				
		    			</p>
		    			@if($signature->email)
		    			<p>MAIL:{{ $signature->email }}</p>
		    			@endif
		    		</div>
		    	@endif
		    </div>
		</div>
	    {!! Form::open(['class'=>'no-print']) !!}
	    <input type="hidden" name="client_id" value="{{ $client->id }}">
	    {!! $hire_ip !!}
	    <div class="text-center prev_submit">
	    	<button type="button" class="btn btn-white" onClick="window.history.back();">戻る</button>
	    	<button type="submit" class="btn btn-orange" id="btn-print">印刷する</button>
	    </div>
	    {!! Form::close() !!}		    
	</div> 	
@endsection
@push('script')
<script>
(function($){
	$(function(){
		$('#btn-print').on('click',function(ev){
			ev.preventDefault();
			window.print();			
			return true;
		});
	})	
})(jQuery)
</script>
@endpush