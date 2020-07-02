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
	    <div class="row form_inquiry_complete text-center">
	        <div style="padding : 40px 20px 40px 20px;">
	            <p style="font-size: 35px;">お問い合わせを受け付けました。</p><br>
	            <p style="text-align: left; font-size: 20px">内容をご確認させていただき、3営業日以内にメールアドレス宛へ返答させていただきます。<br>
					ご意見・ご要望などは、返答を控えさせていただく場合もございます。<br><br>

					この度はお問い合わせをいただき誠にありがとうございました。</p>
	        </div>
	    </div>
        
	</div>
</div>

@endsection
@section('script')
<script>
	function sendInquiry(){
		if ($('#inquirycontent').val() == "" ||  $("input[name=inquirytitle]").is(":checked") == false) {
            alert("お問い合わせ内容を入力してください");
            return false;
        }
        con
        return true;
	}
</script>

@endsection