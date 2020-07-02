@extends('layouts.home')
@section('style')
	<style type="text/css">
		.desired-cost .col-sm-9:hover {
			background: #eee;
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
				<p class="page-description">プロフィールを詳細に記載していると、通常より申請が4倍通りやすくなる傾向があります。</p>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-2 sidebar-left">
				@if($user->image)
            		@php ($profile_image = $user->image)
            	@else
            		@php ($profile_image = 'assets/common/images/img-user1.png')
            	@endif
				@include('Agency::includes.sidebar-left')
			</div>
			<div class="col-sm-8 mainpage">
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
									<div class="star-rating stars-example-fontawesome-o">
										<select class="recom-rating-disabled" data-current-rating="{{$user->evaluate}}" name="rating" autocomplete="off">
											<option value=""></option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
										</select>
								  </div>
								</div>
							</div>
						</div> <!-- end .profile-av -->
					</div>	<!-- end middle page -->
				</div>
				<div class="row">
					<div class="col-sm-12">
						<ul class="tab-profile nav nav-tabs nav-justified">
							<li class="tab-style-grey"><a href="{{ URL::route('agency.profile') }}"> <img src="{{URL::to('assets/common/images/manual.png')}}" alt="">プロフィール</a></li>
							<li class="tab-style-grey"><a href="{{ URL::route('agency.profile.availabletask') }}"><img src="{{URL::to('assets/common/images/manual.png')}}" alt=""> 興味ある内容 </a></li>
							<li class="tab-style-grey"><a href="{{ URL::route('agency.profile.availablesubsidy') }}">対応可能施策</a></li>
							<li class="tab-style-grey"><a href="{{ URL::route('agency.profile.rating') }}">評価・実績</a></li>
							<li class="tab-style-grey active"><a href="{{ URL::route('agency.profile.cost') }}"><img src="{{URL::to('assets/common/images/manual.png')}}" alt="">費用</a></li>
						</ul>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<h4 class="pagerow-title">
							<span>提案費用のテンプレート</span>
							<a href="{{URL::route('agency.profile.editCost')}}" class="btn-primary btn btn-style-shadow-green btn-success right-title">編集する</a>
						</h4>
					</div>
				</div>
				<div class="row">
					<p class="col-sm-12 p-text1 font16">希望費用を設定しておくと、士業に希望費用を伝える際に登録した費用を呼び出すことができます。<br>
					希望費用が決まっている場合は、設定しておくと、入力の手間を省くことができます。</p>
				</div>
				<div class="row">
					
					<div class="col-sm-12 desired-cost">
						@foreach($user->set_cost as $index=>$cost)
					    <dl class="cost-item">
					    	<dt class="col-sm-3">登録内容{{$index+1}}</dt>
					    	<dd class="col-sm-9">
					    		<div class="row">
			                        <div class="col-sm-12">
			                            <div class="row cost-div">
			                                <div class="col-sm-3">
			                                    <p class="cost-p-2">書類代行費用</p>
			                                </div>
			                                <div class="col-sm-9">
			                                    <p class="cost-p-2"><span >{{$cost['document_business_price']}}</span>円</p>
			                                </div>
			                            </div>
			                            <div class="row cost-div">
			                                <div class="col-sm-3">
			                                    <p class="cost-p-2">成功報酬</p>
			                                </div>
			                                <div class="col-sm-9">
			                                    <p class="cost-p-2"><span >{{$cost['request_business_price']}}</span>%</p>
			                                </div>
			                            </div>
			                            <div class="row cost-div">
			                                <div class="col-sm-3">
			                                    <p class="cost-p-2">着手金</p>
			                                </div>
			                                <div class="col-sm-9">
			                                    <p class="cost-p-2"><span >{{$cost['deposit_money']}}</span>円</p> 
			                                </div>
			                            </div>
			                            @foreach($cost['content_type'] as $ii=>$ctype)
			                            <div class="row cost-div " >
			                                <div class="col-sm-3">
			                                    @if($ii == 0) <p class="cost-p-2 ">その他費用</p> @endif
			                                </div>
			                                <div class="col-sm-3">
			                                    <p class="cost-p-2"><span>{{$ctype['moneyname']}}</span>（内訳）</p>
			                                </div>
			                                <div class="col-sm-6">
			                                    <p class="cost-p-2"><span >{{$ctype['moneyvalue']}}</span>円</p>
			                                </div>
			                            </div> <!-- end .cost-div -->
			                            @endforeach
			                            <div class="row cost-div " >
			                                <div class="col-sm-3">
			                                    <p class="cost-p-2 ">その他費用合計</p>
			                                </div>
			                                <div class="col-sm-3">
			                                    <p class="cost-p-2"></p>
			                                </div>
			                                <div class="col-sm-6">
			                                    <p class="cost-p-2"><span >{{$cost['other_money']}}</span>円</p>
			                                </div>
			                            </div> <!-- end .cost-div -->

			                        </div>
			                    </div>
					    	</dd> <!-- end .col-sm-9 -->
					    </dl> <!-- end .cost-item -->
						@endforeach
				    </div>
				</div> <!-- end .row -->
			</div> <!-- end .mainpage -->
			<div class="col-sm-2 sidebar-right">
				@include('Agency::includes.sidebar-right')
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')


@endsection