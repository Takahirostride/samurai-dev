@extends('layouts.home')
@section('style')
	<style type="text/css">
		.checkbox.no-mgr {
			margin: 0;
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
					<li class="active">プロフィール</li>
				</ol>	
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">プロフィール</h1>
				<p class="page-description">企業の自己紹介文を表示しています。</p>
			</div>
		</div>
		<div class="row">
			<div class="">
				@if($user->image)
            		@php ($profile_image = $user->image) @endphp
            	@else
            		@php ($profile_image = 'assets/common/images/img-user1.png') @endphp
            	@endif
			</div>
			<div class="col-sm-10 mainpage mgbt-50">
				<div class="row">
					<div class="col-sm-12">
						<div class="profile-av">
							<div class="row">
								<div class="col-sm-4">
									{{HTML::image($profile_image, '', ['class'=>'profile-user-avatar'])}}
								</div>
								<div class="col-sm-8">
									<h4 class="main-user-name">{{$user->displayname}} ({{$user->username}})</h4>
									<p class="main-user-id">ユーザーID：{{$user->id}}</p>
									<p class="main-user-total-job">実績：　{{$user->result}}件</p>
									{!! Button::getRatingStar('profile-1', $user->evaluate) !!}
								</div>
							</div>
						</div> <!-- end .profile-av -->
					</div>	<!-- end middle page -->
				</div>
				<div class="row">
					<div class="col-sm-12">
						<ul class="nav profile-tab-new nav-tabs">
							<li class="active"><a href="{{ URL::route('agency.profile.view', ['client_id'=>$client_id]) }}">プロフィール</a></li>
							<li><a href="{{ URL::route('agency.profile.view.availabletask', ['client_id'=>$client_id]) }}">興味ある内容</a></li>
							<li class=""><a href="{{ URL::route('agency.profile.view.rating', ['client_id'=>$client_id]) }}">評価・実績</a></li>
						</ul>
					</div>
				</div>
				<div class="row">
					@include('partials.user.notifications')
					<div class="col-sm-12">
						<p class="title-f">自己紹介</p>
						<div class="profile-intro">
							{{ $user->self_intro }}
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-2 sidebar-right">
				@include('Agency::profiles.sidebar-right')
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')
	<script src="/assets/agency/js/b_report.js"></script>
@endsection
