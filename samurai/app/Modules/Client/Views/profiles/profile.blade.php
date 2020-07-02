@extends('layouts.home')

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
				<p class="page-description">士業の自己紹介文を表示していります。</p>
			</div>
		</div>
		<div class="row">
			@if($user->image)
        		@php ($profile_image = $user->image)
        	@else
        		@php ($profile_image = 'assets/common/images/img-user1.png')
        	@endif
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
									<!-- <div class="star-rating stars-example-fontawesome-o">
										<select class="recom-rating-disabled" data-current-rating="{{$user->evaluate}}" name="rating" autocomplete="off">
											<option value=""></option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
										</select>
								  </div> -->
								</div>
							</div>
						</div> <!-- end .profile-av -->
					</div>	<!-- end middle page -->
				</div>
				<div class="row">
					<div class="col-sm-12">
						<ul class="nav profile-tab-new nav-tabs">
							<li class="active"><a href="{{ URL::route('client.profile.view', ['agency_id'=> $agency_id]) }}">プロフィール</a></li>
							<li><a href="{{ URL::route('client.profile.view.availabletask', ['agency_id'=> $agency_id]) }}">対応可能業務</a></li>
							<li><a href="{{ URL::route('client.profile.view.rating', ['agency_id'=> $agency_id]) }}">評価・実績</a></li>
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
				@include('Client::profiles.sidebar-right')
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')
	<script src="/assets/agency/js/b_report.js"></script>
@endsection