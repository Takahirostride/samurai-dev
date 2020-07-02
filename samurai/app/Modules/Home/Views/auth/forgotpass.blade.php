@extends('layouts.home')
@section('title')
	パスワードの再設定
@endsection
@section('content')
<div class="mainpage">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h3 class="login-box-title">
					パスワードの再設定  
					<small>会員登録時に入力したメールアドレスを入力してください。新しいパスワードをお送りいたします。</small>
				</h3>
				<form  action="{{ url('/doForgotPass') }}" method="POST" class="form-horizontal mgb-40 min-height">
					@csrf
				  	<div class="form-group mgtb-20">
					    <label class="col-sm-3" style="font-size: 18px">メールアドレス</label>
					    <div class="col-sm-5">
					      	<input type="email" name="email" class="form-control" placeholder="メールアドレス">
					      	<span class="text-danger">{{ $errors->first('email') }}</span>
					    </div>
				  	</div>
				  	
					<div class="clearfix"></div>
				  	<div class="form-group mgtb-20">
					    <div class="col-sm-offset-3 col-sm-5">
					      	<button type="submit" class="btn submitbutton btn-block">送信する</button>
					    </div>
				  	</div>
				</form><!-- end form -->
			</div>
		</div><!-- end .row -->
	</div> <!-- end .container -->
</div> <!-- end .mainpage -->
@endsection