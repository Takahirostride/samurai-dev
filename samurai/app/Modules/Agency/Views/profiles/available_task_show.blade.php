@extends('layouts.home')
@section('style')
	<style type="text/css">
		.table-trades>tbody>tr>td {
			padding: 0;
		}
		#subcategory-list thead {
			background: #dce9f6;
			border: 1px solid #b1d6df;
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
					<li class="active">希望内容</li>
				</ol>	
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">希望内容</h1>
				<p class="page-description">事業を行う上で企業が希望している内容を表示しています。</p>
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
			<div class="col-sm-10 mainpage">
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
						<ul class="nav profile-tab-new nav-tabs">
							<li class=""><a href="{{ URL::route('agency.profile.view', ['client_id'=>$client_id]) }}">プロフィール</a></li>
							<li class="active"><a href="{{ URL::route('agency.profile.view.availabletask', ['client_id'=>$client_id]) }}">興味ある内容</a></li>
							<li class=""><a href="{{ URL::route('agency.profile.view.rating', ['client_id'=>$client_id]) }}">評価・実績</a></li>
						</ul>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						@include('partials.user.notifications')
						@php
							$cat_list = @array_unique(@$user->cat->pluck('id')->toArray());
							$sub_list = @$user->subCat->pluck('id')->toArray();
						@endphp
						<div class="dpheading"><span>興味のある内容</span></div>
						<p class="dphead-p">該当する項目にのみチェックを入れてください。興味のある内容にチェックをしていると、その内容にあった助成金・補助金のお知らせが届きます。</p>
						<div id="subcategory-list">
							@foreach($categories as $cat)
								@if(!in_array($cat->id, $cat_list) ) @continue @endif
								<table class="table table-hover table-bordered">
									<thead>
										<tr>
											<th colspan="2" class="text-center">{{$cat->category_name}}</th>
											<th class="text-center" width="10%"></th>
										</tr>
									</thead>
									<tbody>
										@foreach($cat->subcategory as $sub)
										@if($sub->detail_question == '') @continue @endif
										<tr>
											<td>Q</td>
											<td>{{$sub->detail_question}}</td>
											<td class="text-center"> @if(in_array($sub->id, $sub_list)) <i class="fa fa-square cl_0082EE"></i> @endif </td>
										</tr>
										@endforeach
									</tbody>
								</table>
							@endforeach
						</div> <!-- end .subcat-disp -->

						<!-- table sub category -->
						
						<div class="clearfix"></div>

						
					</div> <!-- end .col-sm-12 -->
				</div> <!-- end .row -->
				
			</div> <!-- end .mainpage -->
			<div class="col-sm-2 sidebar-right">
				@include('Agency::profiles.sidebar-right')
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')
	<script>
		var base_url = '{{URL::to('/')}}';
	</script>
	{{ HTML::script('assets/client/js/profile-availabletask.js') }}
	<script src="/assets/agency/js/b_report.js"></script>
@endsection