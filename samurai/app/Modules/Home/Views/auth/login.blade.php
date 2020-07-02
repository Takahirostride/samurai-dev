@extends('layouts.home')
@section('title')
	ログインする
@endsection
@section('content')
	<div class="mainpage">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<h3 class="login-box-title">
						ログインする  
						<small>会員登録がお済みてない方は、<a href="{{URL::to('register')}}">こちら</a>から無料会員登録してください。</small>
					</h3>
					@includeIf('partials.user.notifications')
					<form action="{{ url('/doLogin') }}" method="POST" class="form-horizontal mgb-40">
						@csrf
					  	<div class="form-group mgtb-20">
						    <label class="col-sm-3">メールアドレス</label>
						    <div class="col-sm-5">
						      	<input type="text" name="email" class="form-control email" placeholder="メールアドレス" value="{{ request()->cookie('username') }}">
						      	<span class="text-danger">{{ $errors->first('email') }}</span>
						    </div>
					  	</div>
					  	<div class="clearfix"></div>
					  	<div class="form-group mgtb-20">
						    <label class="col-sm-3">パスワード</label>
						    <div class="col-sm-5">
						      	<input type="password" name="password" class="form-control password" placeholder="パスワード" value="{{ request()->cookie('password') }}">
						      	<span class="text-danger">{{ $errors->first('password') }}</span>
						    </div>
					  	</div>
					  	<div class="clearfix"></div>
						<div class="form-group mgtb-20">
						    <div class="col-sm-offset-3 col-sm-9">
						      <div class="checkbox">
						        <label>
						          	<input type="checkbox" name="remember_me" class="remember_me" {{request()->cookie('username') ? 'checked' : ''}} value="1">次回から自動的にログインする。 
						        </label>
						      </div>
						    </div>
						</div>
						<div class="clearfix"></div>
					  	<div class="form-group mgtb-20">
						    <div class="col-sm-offset-3 col-sm-5">
						      	<button type="submit" class="btn submitbutton btn-block btn-login">ログインする</button>
						    </div>
					  	</div>
					  	<div class="form-group mgtb-20">
						    <div class="col-sm-offset-3 col-sm-5">
						      <strong>パスワードを忘れた方は、<a href="{{URL::to('forgotpass')}}">こちら</a>からパスワードの再設定を行ってください。</strong>
						    </div>
					  	</div>
					</form><!-- end form -->	
				</div>
			</div><!-- end .row -->
		</div> <!-- end .container -->
	</div> <!-- end .mainpage -->
	<div class="clearfix"></div>
@endsection
