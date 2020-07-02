@extends('Asp::layouts.auth')
@section('content')
<div class="container">
	<div class="bl-middel reset_form">		
        <p class="text-center">
            <a href="{{ url('/') }}"><img src="{{ asset('assets/asp/images/logo-asp.png') }}" class="logo-img" alt="SAMURAI"></a>
        </p>
        @include('Asp::auth.notify')		
		{!! Form::open(['route'=>['asp_password_update'],'id'=>'form-reset']) !!}
		<input type="hidden" name="token" value="{{ $token }}">
		<div class="form-group">
			<p class="control-label">Email</p>
			<input type="email" name="email" class="form-control" value="{{ old('email') }}">
		</div>
		<div class="form-group">
			<p class="control-label">Password</p>
			<input type="password" name="password" class="form-control" value="">
		</div>
		<div class="form-group">
			<p class="control-label">Confirm Password</p>
			<input type="password" name="password_confirmation" class="form-control" value="">
		</div>
		<div class="submit text-center">
			<button type="submit" class="btn btn-orange">Reset Password</button>
		</div>
		{!! Form::close() !!}
	</div>
</div>
@endsection	
@push('script')
<script>
(function($){
	$(function(){
		$('#form-reset').validate({
			rules : {
				    email:{
				    	email:true,
				    	required : true,
				    },
				    password :{
				    	required : true,
				    	rangelength : [8,20]
				    },
				    password_confirmation : {
				    	equalTo : 'input[name="password"]'
				    }
			},
			messages :{
				password :{
					rangelength : '半角英数字8文字以上20文字以内'
				}
			},			
		});
	});
})(jQuery);	
</script>
@endpush