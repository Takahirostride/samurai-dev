@extends('layouts.home')
@section('style')
	<style type="text/css">
		.table-trades>tbody>tr>td {
			padding: 0;
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
					<li class="active">対応可能業務</li>
				</ol>	
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">対応可能業務</h1>
				<p class="page-description">士業が得意な業務を表示しています。</p>
			</div>
		</div>
		<div class="row">
				@if($user->image)
            		@php ($profile_image = $user->image) @endphp
            	@else
            		@php ($profile_image = 'assets/common/images/img-user1.png') @endphp
            	@endif
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
							<li class=""><a href="{{ URL::route('client.profile.view', ['agency_id'=> $agency_id]) }}">プロフィール</a></li>
							<li class="active"><a href="{{ URL::route('client.profile.view.availabletask', ['agency_id'=> $agency_id]) }}">対応可能業務</a></li>
							<li><a href="{{ URL::route('client.profile.view.rating', ['agency_id'=> $agency_id]) }}">評価・実績</a></li>
						</ul>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						@include('partials.user.notifications')
						<h4 class="pagerow-title">
							<span>対応可能業務</span>
						</h4>
						<div id="subcategory-list">
							@if($categories)
							@foreach($categories as $index => $category)
							@if(@$category->subcategory)
							@php
								$nume = count($category->subcategory) % 4;

								if(count($category->subcategory) == 0) {
									$nume = 4;
								}else{
									if($nume > 0) {
										$nume = 4 - $nume;
									}
								}
							@endphp
							<table id="sub_{{$category->id}}" class="table table-bordered dtable table-condensed dcat-table">
								<tbody>
									<tr>
										<td class="dthead" rowspan="{{ceil(count($category->subcategory)/4)}}">{{$category->category_name}}</td>
									@if(@$category->subcategory)
										@foreach($category->subcategory as $index => $categorysub)
										@php
										$is_check = $user->subCat->contains('id',$categorysub->id);
										@endphp

										<td>
											@if(@$categorysub->id)
											<div class="checkbox"><label><input type="checkbox" class="subcat" name="categorysubs[]" value="{{$categorysub->id}}" id="check_list_bigcat-1" {{ $is_check ? 'checked':'' }} disabled="" >{{$categorysub->sub_name}}</label></div>
											@endif
										</td>
										@php $num = $index+1 @endphp
										@if($num % 4 == 0) </tr><tr> @endif	
										@endforeach
									@endif
										@for($i=0; $i<$nume; $i++)
											<td></td>
										@endfor
									</tr>
								</tbody>
							</table> <!-- end table category -->
							@endif
							@endforeach
							@endif
						</div> <!-- end .subcat-disp -->

						<!-- table sub category -->
						
						<div class="clearfix"></div>
						<h4 class="pagerow-title">
							<span>対象地域</span>
						</h4>
						<div class="append-bsearch">
							@foreach ($user->user_address as $address)
							
								<div class="row">
									<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
										<p class="address-name">{{ $address->province->province_name }}</p>
									</div>
									<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
										<p class="address-name">{{ @$address->city->city_name }}</p>
									</div>

								</div>
							@endforeach
						</div>
						<div class="clearfix"></div>
					</div> <!-- end .col-sm-12 -->
				</div> <!-- end .row -->
				
			</div> <!-- end .mainpage -->
			<div class="col-sm-2 sidebar-right">
				@include('Client::profiles.sidebar-right')
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')
	<script>
		var base_url = '{{URL::to('/')}}';
	</script>
	{{ HTML::script('assets/agency/js/profile-availabletask.js') }}
	<script src="/assets/agency/js/b_report.js"></script>
@endsection