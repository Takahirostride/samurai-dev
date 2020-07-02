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
							<li class=""><a href="{{route('agency.RequestDetails', ['policy_id' => request()->policy_id, 'client_id' => $client_id])}}">プロフィール</a></li>
							<li class="active"><a href="{{route('agency.EvaluationAchievements',['policy_id' => request()->policy_id, 'client_id' => $client_id])}}">評価・実績 </a></li>
							<li class=""><a href="{{route('agency.Availablebusiness',['policy_id' => request()->policy_id, 'client_id' => $client_id])}}">興味ある内容</a></li>
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