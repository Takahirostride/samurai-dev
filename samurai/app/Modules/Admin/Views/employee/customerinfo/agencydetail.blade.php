@extends('layouts.admin')
@section('style')
        <link media="all" type="text/css" rel="stylesheet" href="{{ asset('assets/common/plugins/bar-rating/dist/themes/fontawesome-stars.css') }}">
        <link media="all" type="text/css" rel="stylesheet" href="{{ asset('assets/common/plugins/bar-rating/dist/themes/fontawesome-stars-o.css') }}">
        <link media="all" type="text/css" rel="stylesheet" href="{{ asset('assets/common/plugins/bar-rating/yellow.css') }}">

@endsection
@section('header_bottom')
    @includeIf('partials.admin.header_employee')
@endsection
@section('content')
@php
    $rt_name = Route::currentRouteName();
@endphp
<div class="layout-sb">
    <div class="content ng-scope">
        <div class="inner-content">
            <div class="inner-container">
                <div class="row">
                    <div class="col-md-3 pull-left">
                        @include('Admin::employee.customerinfo.sidebar')
                    </div>                   
<div class="col-md-9 full">
<div class="edit_user">
	<div class="row">
		<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9 col-left">
            <div class="profile-av">
                <div class="row">
                    <div class="col-sm-4">
                        {{HTML::image($user->getImageUrl(), '', ['class'=>'profile-user-avatar'])}}
                    </div>
                    <div class="col-sm-8">
                        <h4 class="main-user-name">{{$user->displayname}} ({{$user->username}})</h4>
                        <p class="main-user-id">ユーザーID：{{$user->id}}</p>
                        <p class="main-user-total-job">実績：　{{$user->result}}件</p>
                        {!! Button::getRatingStar('profile-1', $user->evaluate) !!}                        
                    </div>
                </div>
            </div> <!-- end .profile-av -->	
            <div class="profile-ct">
                <ul class="nav profile-tab-new nav-tabs">
                    <li class="{{ $rt_name == 'admin.StaffPolicyController.edit_agency' ? 'active':'' }}">
                        <a href="{{ URL::route('admin.StaffPolicyController.edit_agency',$user) }}">プロフィール</a>
                    </li>
                    <li class="{{ $rt_name == 'admin.agencydetail.availabletask' ? 'active':'' }}"
                    >
                        <a href="{{ URL::route('admin.agencydetail.availabletask',$user) }}">興味ある内容</a>
                    </li>
                    <li class="{{ $rt_name == 'admin.agencydetail.ratingUser' ? 'active':'' }}">
                        <a href="{{ URL::route('admin.agencydetail.ratingUser',$user) }}">評価・実績</a>
                    </li>
                    <li class="{{ $rt_name == 'admin.agencydetail.payment' ? 'active':'' }}">
                        <a href="{{ route('admin.agencydetail.payment',$user) }}">口座情報</a>
                    </li>
                    <li class="{{ $rt_name == 'admin.agencydetail.violation' ? 'active':'' }}">
                        <a href="{{ route('admin.agencydetail.violation',$user) }}">アカウント情報</a>
                    </li>

                </ul>  
                @switch($rt_name)
                    @case('admin.agencydetail.availabletask')
                        @include('Admin::employee.customerinfo.detail.availabletask')
                      @break
                    @case('admin.agencydetail.ratingUser')
                      @include('Admin::employee.customerinfo.detail.user_rating')
                      @break
                    @case('admin.agencydetail.payment')
                      @include('Admin::employee.customerinfo.detail.user_banking')
                      @break
                    @case('admin.agencydetail.violation')
                      @include('Admin::employee.customerinfo.detail.violation_agency')
                      @break
                    
                    @default
                        @include('Admin::employee.customerinfo.detail.profile_agency')                        
                @endswitch
                                            
            </div>		
		</div>
		<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 col-left">
			@include('Admin::employee.customerinfo.sidebar_user')
		</div>

	</div>
</div>
</div>  
                </div>
            </div>
        </div>
    </div>
</div>                  	
@endsection
@section('script')
@endsection