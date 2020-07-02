@extends('layouts.home')
@section('title')
	パスワードの再設定
@endsection
@section('content')
<div class="mainpage">
	<div class="container">
		<div class="row" style="margin-top:40px;">
	       <strong style="font-size: 26px;">パスワードの再設定</strong>
	    </div>
	    <div class="row" style="margin-top:10px;margin-bottom:50px;">
	        <div align="center">
	            <div class="subtitle_small" style="width: 100%;border-bottom: 1px solid #CCCCCC;"></div>
	        </div>
	    </div>
		<div class="row" style="text-align:center;">
	        <h1><strong>登録メールアドレスにパスワードを送信しました</strong></h1>
	    </div> 
	    <div class="row" style="margin-top:40px;">
	      <div class="col-sm-1"></div>
	        <div class="col-sm-3">
	            <div style="margin-left:2px; margin-right:2px;">
	                <div>
	                    <img src="/assets/common/images/third.png" style="width:100%;">
	                </div>
	                <div>
	                    <p class="service_title" style="text-align:center;">
	                        どうやって使うの？
	                    </p>
	                </div>
	            </div>
	        </div>
	        <div class="col-sm-8" style="font-size:16px;padding-top:30px;">
	            <p>
	                登録メールアドレスに新しいパスワードを送信いたします。</br></br>

	                パスワードをご自身で設定する方法</br>
	                送信するメールアドレスでログインし、「マイページ」→「会員情報管理」→「ログイン情報設定」より、パスワードをご自身で再設定可能です。
	            </p>
	        </div>
	    </div> 
	    <div class="row text-center" style="margin-bottom: 50px;margin-top: 20px; ">
	        <a class="shadowbuttonblue btn btn-default" style="margin-right :10px;width:20%;padding:10px 30px;" href="/login">ログイン</a>
	        <a class="btn btn-default btn-style-shadow-grey" style="padding:10px 30px;border:none;width:20%;" href="/">トップへ</a>
	    </div>
	</div> <!-- end .container -->
</div> <!-- end .mainpage -->
@endsection