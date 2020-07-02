@extends('layouts.home')
@section('style')
	<link rel="stylesheet" href="/assets/agency/css/b_select.css">
@endsection
@section('content')
<div class="mainpage">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
			@includeIf('partials.breadcrumb', ['title' => '手動マッチング'])
			</div>
		</div> <!-- end .row -->
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">助成金・補助金自動マッチング</h1>
				<p class="page-description">プロフィールの設定にに対して、マッチングしている助成金・補助金が表示されています。対応可能と思われる、助成金・補助金の設定が行え、企業に直接営業も可能です。</p>
			</div>
		</div>
		<div class="row">
			@if($user->image)
        		@php ($profile_image = $user->image) @endphp
        	@else
        		@php ($profile_image = 'assets/common/images/img-user1.png') @endphp
        	@endif
			<div class="col-sm-12">
				<ul class="nav profile-tab-new nav-tabs">
					<li class=""><a href="{{route('agency.bselect', ['policy_id' => request()->policy_id])}}"> 施策詳細</a></li>
					<li class="active"><a href=""> 依頼詳細</a></li>
				</ul>
			</div> <!-- end .col-sm-12 -->
			<div class="clearfix"></div>
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
							<li class="active"><a href="{{route('agency.RequestDetails', ['policy_id' => request()->policy_id, 'client_id' => $client_id])}}">プロフィール</a></li>
							<li class=""><a href="{{route('agency.EvaluationAchievements',['policy_id' => request()->policy_id, 'client_id' => $client_id])}}">評価・実績 </a></li>
							<li class=""><a href="{{route('agency.Availablebusiness',['policy_id' => request()->policy_id, 'client_id' => $client_id])}}">興味ある内容</a></li>
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
	<script src="/assets/agency/js/b_select.js"></script>
	<script src="/assets/agency/js/b_report.js"></script>
	
@endsection