@extends('layouts.home')
@section('title')
	会員登録をする
@endsection
@section('content')
<div class="mainpage">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h3 class="login-box-title">
					会員登録をする 
					<small>すでに登録済みの方か、 <a href="{{url('login')}}">こちら</a>からログインしてください。</small>
				</h3>
				@includeIf('partials.user.notifications')
				<form  action="{{ url('/doRegister') }}" method="POST" class="form-horizontal">
					@csrf
				  	<div class="form-group mgtb-20">
					    <label class="col-sm-3">メールアドレス</label>
					    <div class="col-sm-5">
					      <input type="email" name="e_mail" class="form-control" placeholder="メールアドレス" value="{{session('user') ? session('user')['email'] : ''}}">
					      <span class="text-danger">{{ $errors->first('e_mail') }}</span>
					    </div>
				  	</div>
				  	<div class="clearfix"></div>
				  	<div class="form-group mgtb-20">
					    <label class="col-sm-3">パスワード</label>
					    <div class="col-sm-5">
					      <input type="password" name="password" class="form-control" placeholder="半角英数字　8文字以上">
					      <span class="text-danger">{{ $errors->first('password') }}</span>
					    </div>
					    <div class="col-sm-4">
					    	<span class="info-val"></span>
					    </div>
				  	</div>
				  	<div class="clearfix"></div>
				  	<div class="form-group mgtb-20">
					    <label class="col-sm-3">ユーザー名</label>
					    <div class="col-sm-5">
					      <input type="text" name="username" class="form-control" placeholder="半角英数字　4文字以上" value="{{session('user') ? session('user')['name'] : ''}}">
					      <span class="text-danger">{{ $errors->first('username') }}</span>
					    </div>
					    <div class="col-sm-4">
					    	<span class="info-val"></span>
					    </div>
				  	</div>
				  	
				  	<div class="clearfix"></div>
				  	<div class="form-group mgtb-20">
					    <label class="col-sm-2"></label>
					    <div class="col-sm-8">
					      <strong>助成金の申請を行いたい方は「企業の方」を、企業のお手伝いをしていただく方は「士業の方」お選びください。
</strong>
					    </div>
				  	</div>
				  	<div class="clearfix"></div>
				  	
					<div class="form-group mgtb-20">
					    <label class="col-sm-3">利用方法</label>
					    <div class="col-sm-5">
					      	<div id="donate">
					          	<div class="row">
						            <div class="col-xs-6">
						              	<label class="graybutton btn-block">
						                	<input type="radio" name="manage_flag" value="0" checked="checked">
						                	<span>事業者の方</span>
						              	</label>
						            <span class="text-danger">{{ $errors->first('manage_flag') }}</span>
						            </div>
						            <div class="col-xs-6">
						              	<label class="graybutton btn-block">
						                	<input type="radio" name="manage_flag" value="1">
						                	<span>士業の方</span>
						              	</label>
						            </div>
					          	</div>
					        </div>
					    </div>
				  	</div>
				  	<div class="clearfix"></div>
					<div class="form-group mgtb-20">
					    <div class="col-sm-offset-3 col-sm-9">
					      <div class="checkbox">
					        <label>
					        	<input type="checkbox" name="agrement" value="1"><a href="/termservice">利用規約</a>の内容を確認し、これに同意します。 
					        </label>
					      </div>
					      <span class="text-danger">{{ $errors->first('agrement') }}</span>
					    </div>
					</div>
					<div class="clearfix"></div>
				  	<div class="form-group mgtb-20">
					    <div class="col-sm-offset-3 col-sm-5">
					      	<button type="submit" class="btn submitbutton form-control ">アカウントを登録する(無料)</button>
					    </div>
				  	</div>
				</form><!-- end form -->

			</div>
		</div><!-- end .row -->
	</div> <!-- end .container -->
</div> <!-- end .mainpage -->
@endsection