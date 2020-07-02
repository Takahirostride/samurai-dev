@extends('layouts.home')
@section('style')
	{{HTML::style('assets/home/css/home.css')}}
@endsection
@section('content')
<div class="mainpage">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<ol class="breadcrumb">
					<li><a class="bg-color" href="#">TOPページ</a></li>
					<li class="active">お問い合わせ</li>
				</ol>	
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">お問い合わせ</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 mainpage">
				<div class="row">
					<div class="col-sm-12">
		            <p style="font-size: 23px">
		                お問い合わせはこちらのフォームから承っております。<br>
						下記の内容をご入力いただき、よろしければ「確認する」ボタンを押してください。<br>
						折り返し、担当者よりご連絡いたします。
		            </p>
		        	</div>
			    </div>
			    <div class="row">
			    	<div class="form_inquiry">
			        {{ Form::open(array('url' => 'inquiry', 'method' =>'POST')) }}
			        <div class="col-sm-12 nhap">
			        	<div >
			        		<dl>
			        			<dt>お名前<span class="bb">必須</span></dt>
			        			<dd>{{Form::text('name','',array('class'=>'max400'))}}</dd>
			        		</dl>
			        		<dl>
			        			<dt>ふりがな<span class="bb">必須</span></dt>
			        			<dd>{{Form::text('phonetic','',array('class'=>'max400'))}}</dd>
			        		</dl>
			        		<dl>
			        			<dt>電話番号</dt>
			        			<dd>{{Form::text('phone','',array('class'=>'max400'))}}</dd>
			        		</dl>
			        		<dl>
			        			<dt>メールアドレス<span class="bb">必須</span></dt>
			        			<dd>{{Form::text('email','',array('class'=>'max400'))}}</dd>
			        		</dl>
			        		<dl>
			        			<dt>お問い合わせ種別<span class="bb">必須</span></dt>
			        			<dd>
			        				<select name="inquiry_type" id="get_inquiry_type">
			        					<option value="会員登録・ログインについて" selected="">会員登録・ログインについて</option>
			        					<option value="依頼について">依頼について</option>
			        					<option value="提案について">提案について</option>
			        					<option value="本人確認書類について">本人確認書類について</option>
			        					<option value="規約・NDAについて">規約・NDAについて</option>
			        					<option value="マッチングについて">マッチングについて</option>
			        					<option value="タスクについて">タスクについて</option>
			        					<option value="支払いについて">支払いについて</option>
			        					<option value="マイページについて">マイページについて</option>
			        					<option value="アフィリエイトについて">アフィリエイトについて</option>
			        					<option value="仕事提携管理について">仕事提携管理について</option>
			        					<option value="その他">その他</option>


			        				</select>
			        			</dd>
			        		</dl>
			        		<dl>
			        			<dt>お問い合わせ件名</dt>
			        			<dd>{{Form::text('inquiry_subject')}}</dd>
			        		</dl>
			        		<dl>
			        			<dt>お問い合わせ内容<span class="bb">必須</span></dt>
			        			<dd>{{Form::textarea('inquiry_content')}}</dd>
			        		</dl>
			        	</div>
			            <div class="row" style="text-align: center; margin-bottom: 20px">
			                <button type="button" class="btn btn-success  btn-style-shadow-green" style="width:150px;" onclick="return sendInquiry()" >確認する</button>
			               
			            </div>
			        </div>
			        <div class="confirm">
			        	<div >
			        		<dl>
			        			<dt>お名前</dt>
			        			<dd><p id="name"></p></dd>
			        		</dl>
			        		<dl>
			        			<dt>ふりがな</dt>
			        			<dd><p id="phonetic"></p></dd>
			        		</dl>
			        		<dl>
			        			<dt>電話番号</dt>
			        			<dd><p id="phone"></p></dd>
			        		</dl>
			        		<dl>
			        			<dt>メールアドレス</dt>
			        			<dd><p id="email"></p></dd>
			        		</dl>
			        		<dl>
			        			<dt>お問い合わせ種別</dt>
			        			<dd><p id="inquiry_type"></p></dd>
			        		</dl>
			        		<dl>
			        			<dt>お問い合わせ件名</dt>
			        			<dd><p id="inquiry_subject"></p></dd>
			        		</dl>
			        		<dl>
			        			<dt>お問い合わせ内容</dt>
			        			<dd><p id="inquiry_content"></p></dd>
			        		</dl>
			        	</div>
			        	<div class="row" style="text-align: center; margin-bottom: 20px">
			                <input type="submit" name="submit" class="btn btn-success1" style="width:150px;" value="送信する">
			                <button type="button" class="btn btn-cancel" style="width:150px;" >修正する</button>
			               
			            </div>
			        </div>
			        {{ Form::close() }}
			        </div>
			    </div>
			</div>
		</div>
        
	</div>
</div>

@endsection
@section('script')
<script>
	$('.confirm').hide();
	function sendInquiry(){
		console.log($("#get_inquiry_type").val());
		if ($('input[name=name]').val() == "" || $('input[name=phonetic]').val() == "" || $('input[name=email]').val() == "" || $('textarea[name=inquiry_content]').val() == ""  ||  $("#get_inquiry_type").val() =='') {
            alert("お問い合わせ内容を入力してください");
            return false;
        }
        if(!validateEmail($('input[name=email]').val()) ){
        	alert("お問い合わせ内容を入力してください");
            return false;
        }
        $('.confirm').show();
        $('.nhap').hide();
        $('#name').text($('input[name=name]').val());
        $('#phonetic').text($('input[name=phonetic]').val());
        $('#phone').text($('input[name=phone]').val());
        $('#email').text($('input[name=email]').val());
        $('#inquiry_type').text($('#get_inquiry_type').val());
        $('#inquiry_subject').text($('input[name=inquiry_subject]').val());
        $('#inquiry_content').text($('textarea[name=inquiry_content]').val());
        return true;
	}
	$('.btn-cancel').click(function(){
		$('.confirm').hide();
        $('.nhap').show();
	})
	function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
	}
</script>

@endsection