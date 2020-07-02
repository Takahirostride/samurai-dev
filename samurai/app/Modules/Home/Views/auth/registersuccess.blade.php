@extends('layouts.home')
@section('title')
	新規会員登録
@endsection
@section('content')
<div class="mainpage">
	<div class="container">
		<div class="row" style="margin-top:40px;">
	       <strong style="font-size: 26px;">新規会員登録</strong>
	    </div>

	    <div class="row" style="margin-top:10px;margin-bottom:50px;">
	        <div align="center">
	            <div class="subtitle_small" style="width: 100%;border-bottom: 1px solid #CCCCCC;"></div>
	        </div>
	    </div>
		<div class="row" style="text-align:center;">
	        <br>
	            <div align="center">
	                <div style="border-style: solid; padding: 10px 10px 10px 10px;
	                border-color:#1E90FF; background-color:#F0F8FF; width: 800px;">
	                <h3><strong>まだご登録が完了しておりません。</strong></h3>
	                <br>
	                <p><strong>お客様の登録メールアドレスに会員本登録手続き用のURLをお送りいたしました。</strong></p>
	                <p><strong>本登録手続き用のURLをクリックして頂きますと、会員登録が完了いたします。</strong></p>
	                <br>
	                <br>
	                </div>
	            </div>               
	        <br>
	        <br>
	        <br>
	        <br>
	        <br>
	    </div> 
	     
	    <div class="row text-center" style="margin-bottom: 50px;margin-top: 20px; ">
	        <a class="shadowbuttonblue btn btn-default" style="margin-right :10px;width:20%;padding:10px 30px;" href="/login">ログイン</a>
	        <a class="btn btn-default btn-style-shadow-grey" style="padding:10px 30px;border:none;width:20%;" href="/">トップへ</a>
	    </div>
	</div> <!-- end .container -->
</div> <!-- end .mainpage -->
@endsection