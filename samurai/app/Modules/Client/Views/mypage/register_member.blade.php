@extends('layouts.home')
@section('style')
	<style type="text/css">

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
					@php ($profile_image = $user->image) @endphp
				@else
					@php ($profile_image = 'assets/common/images/img-user1.png') @endphp
				@endif
				@include('Client::include.sidebar-left')
			</div>
			<div class="col-sm-10 mainpage">
				 <div class="col-sm-12"> 
					<div class="row">
						<div class="tab-memberinfo">
							<ul class="nav profile-tab-new nav-tabs">
								<li class=""><a href="{{URL::route('client.memberinfo')}}">ログイン情報設定</a></li>
								<li class=""><a href="{{ URL::route('client.memberinfo.mail') }}">メール通知設定</a></li>
								<li><a href="{{ URL::route('client.memberinfo.block') }}">ブロック</a></li>
								<li class="active"><a href="{{ URL::route('client.memberinfo.regmem') }}">会員登録・退会</a></li>
							</ul>
						</div>
						
						<div class="col-sm-12 form-memberinfo memberinfo5">
							{{Form::open(['method'=>'POST'])}} 
							@include('partials.user.notifications')
								
							      	<div class="col-sm-12 btn-member text-center">
										<button type="button" onclick="checkEuro();" class="boxshadowbuttonblue btn btn-primary btn-grey btn-lg land-btn">退会する</button>
									</div>
							</form>
						</div>

					</div> <!-- end .row -->
				</div> <!-- end .col-sm-12 -->
			</div> <!-- end .mainpage -->
		</div>
	</div>
</div>

@endsection

@section('script')
	<script>
		var base_url = '{{URL::to('/')}}';
		var checkEuro = function() {
			$.ajax({
				url: base_url + '/client/mypage/memberinfo/register-member-ajax',
				type: 'POST',
				success: function(json)
				{
					alert('現在、マッチングしている案件があるため、退会できません。案件のキャンセルをクライアントに伝え、終了報告を行ってください。');
				}
			})
		}
	</script>

@endsection