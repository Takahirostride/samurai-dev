@extends('layouts.home')
@section('style')
	<style type="text/css">
		.desired-cost .col-sm-9:hover {
			background: #eee;
		}
		.no-hidden {
			display: none;
		}
	</style>
@endsection
@section('content')
<div class="mainpage clientprofile-1">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<ol class="breadcrumb">
					<li><a class="bg-color" href="#">TOPページ</a></li>
					<li class="active">会員情報管理</li>
				</ol>	
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">会員情報管理</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-2 sidebar-left">
				@if($user->image)
            		@php ($profile_image = $user->image)
            	@else
            		@php ($profile_image = 'assets/common/images/img-user1.png')
            	@endif
				@include('Client::include.sidebar-left')
			</div>
			<div class="col-sm-10 mainpage">
				 <div class="col-sm-12"> 
					<div class="row">
						<div class="tab-memberinfo">
							<ul class="nav profile-tab-new nav-tabs">
								<li class="active"><a href="{{URL::route('client.memberinfo')}}">ログイン情報設定</a></li>
								<li><a href="{{ URL::route('client.memberinfo.mail') }}">メール通知設定</a></li>
								<li><a href="{{ URL::route('client.memberinfo.block') }}">ブロック</a></li>
								<li><a href="{{ URL::route('client.memberinfo.regmem') }}">会員登録・退会</a></li>
							</ul>
						</div>
						
						<div class="col-sm-12 form-memberinfo fist">
							{{Form::open(['method'=>'POST', 'class'=>'form-horizontal'])}}
								@include('partials.user.notifications')
								<div class="alert alert-danger no-hidden" id="no-email-error">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<span id="mail-mess-error"></span>
								</div>
								<div class="form-group">
									<label for="input" class="col-sm-3 control-label">ユーザー名</label>
									<div class="col-sm-9">
										{{$user->username}}
									</div>
								</div>
								<div class="form-group">
									<label for="input" class="col-sm-3 control-label">メールアドレス</label>
									<div class="col-sm-9">
										{{$user->e_mail}}
									</div>
								</div>
								<div class="form-group">
									<label for="input" class="col-sm-3 control-label">変更前のメールアドレス</label>
									<div class="col-sm-9">
										{{Form::text('new_email', '', ['class'=>'form-control', 'placeholder'=>'変更後のメールアドレス', 'id'=>'new_email'])}}
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-12 text-center">
										<button type="button" id="save-mail-btn" class="boxshadowbuttonblue btn btn-primary">変更する</button>
									</div>
								</div>
							{{Form::close()}}
						</div>
						<div class="col-sm-12 form-memberinfo last">
							{{Form::open(['method'=>'POST', 'class'=>'form-horizontal'])}}
								<div class="alert alert-success no-hidden" id="no-pass-success">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<span id="pass-mess-success"></span>
								</div>
								<div class="alert alert-danger no-hidden" id="no-pass-error">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<span id="pass-mess-error"></span>
								</div>

								<div class="form-group">
									<label for="input" class="col-sm-3 control-label">現在のメールアドレス</label>
									<div class="col-sm-9">
										{{Form::password('old_pass', ['class'=>'form-control', 'placeholder'=>'半角英数字　8文字以上', 'id'=>'old_pass'])}}
									</div>
								</div>
								<div class="form-group">
									<label for="input" class="col-sm-3 control-label">新しいパスワード</label>
									<div class="col-sm-9">
										{{Form::password('new_pass', ['class'=>'form-control', 'placeholder'=>'半角英数字　8文字以上', 'id'=>'new_pass'])}}
									</div>
								</div>
								<div class="form-group">
									<label for="input" class="col-sm-3 control-label">新しいパスワード</label>
									<div class="col-sm-9">
										{{Form::password('new_pass_confirm', ['class'=>'form-control', 'placeholder'=>'半角英数字　8文字以上', 'id'=>'new_pass_confirm'])}}
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-12 text-center">
										<button type="button" id="save-pass-btn" class="boxshadowbuttonblue btn btn-primary">変更する</button>
									</div>
								</div>
							{{Form::close()}}
						</div>
					</div> <!-- end .row -->
				</div> <!-- end .col-sm-12 -->
			</div> <!-- end .mainpage -->
		</div>
	</div>
</div>
<div class="modal fade" id="confirm-email-modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<h3>メールアドレスを返信しますか？</h3>
			</div>
			<div class="modal-footer text-center">
				<div class="text-center">
					<button type="button" class="btn btn-danger btn-style-shadow-red" data-dismiss="modal">いいえ</button>
					<button type="button" onclick="saveEmail();" data-dismiss="modal" class="btn btn-success btn-style-shadow-green">はい</button>
				</div>
				
			</div>
		</div>
	</div>
</div>
<div id="successModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content"> 
        <div class="modal-header">
            <h3>ご登録のメールアドレスに設定手続きのメールを送信致しました。</h3><br>
            <h3>ご確認の上手続きを行ってください。</h3>
        </div>                     
      <div class="modal-body">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3 text-center">                
                <button type="button" class="btn btn-primary btn-style-shadow-blue" data-dismiss="modal" style="margin-left: 15px;">閉じる</button>        
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
	<script>
		var base_url = '{{URL::to('/')}}';
		$('#save-mail-btn').click(function(event) {
			if($('#new_email').val() == '' || !isEmail($('#new_email').val()) ) {
				alert('メールアドレスを正確に入力してください。');
				return false;
			}
			$('#confirm-email-modal').modal();
		});
		var saveEmail = function() {
			
			$(this).prop('disabled', true);
			$.ajax({
				url: base_url + '/client/mypage/memberinfo-ajax',
				data: {act: 'updateMail', new_email: $('#new_email').val()},
				type: 'POST',
				success: function(json) {
					$(this).prop('disabled', false);
					if(!json.success) {
						$('#mail-mess-error').text(json.mess);
						$('#no-email-error').removeClass('no-hidden');
						setTimeout(function(){ $('#no-email-error').addClass('no-hidden'); }, 5000);
					} else {
						$('#successModal').modal();
					}
				},
				error: function() {
					$(this).prop('disabled', false);
				}
			});
		}
		function isEmail(email) {
			var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			return regex.test(email);
		}
		$('#save-pass-btn').click(function(event) {
			var old_pass = $('#old_pass').val();
			var new_pass = $('#new_pass').val();
			var new_pass_confirm = $('#new_pass_confirm').val();
			if(old_pass == '' || new_pass == '' || new_pass_confirm == '' || new_pass != new_pass_confirm || old_pass.length < 8 || new_pass.length < 8 || new_pass_confirm.length < 8)
			{
				alert('すべての項目を正確に入力してください!');
				return false;
			}
			$.ajax({
				url: base_url + '/client/mypage/memberinfo-ajax',
				data: {act: 'savePass', old_pass: old_pass, new_pass: new_pass, new_pass_confirm: new_pass_confirm},
				type: 'POST',
				success: function(json) {
					if(json.success) {
						$('#pass-mess-success').text(json.mess);
						$('#no-pass-success').removeClass('no-hidden');
						setTimeout(function(){ $('#no-pass-success').addClass('no-hidden'); }, 5000);
						$('#old_pass').val('');
						$('#new_pass').val('');
						$('#new_pass_confirm').val('');
					} else {
						$('#pass-mess-error').text(json.mess);
						$('#no-pass-error').removeClass('no-hidden');
						setTimeout(function(){ $('#no-pass-error').addClass('no-hidden'); }, 5000);
					}
				}
			})
		});
	</script>

@endsection