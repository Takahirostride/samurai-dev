@extends('layouts.home')
@section('style')
	<style type="text/css">
		.table-trades>tbody>tr>td {
			padding: 0;
		}
		.e-hidden {
			display: none;
		}
	</style>
	{{HTML::style('assets/common/css/profile.css')}}
@endsection
@section('content')
<div class="mainpage clientprofile-1">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<ol class="breadcrumb">
					<li><a class="bg-color" href="#">TOPページ</a></li>
					<li class="active">評価・実績</li>
				</ol>	
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">評価・実績</h1>
				<p class="page-description">自己紹介は細かく記述しましょう！プロフィールを細かく記載している方の申請が通常の方の４倍違ってきます。</p>
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
			<div class="col-sm-8 mainpage">
				<div class="row">
					<div class="col-sm-12">
						@include('Client::includes.profile-av')
					</div>	<!-- end middle page -->
				</div>
				<div class="row">
					<div class="col-sm-12">
						<ul class="nav profile-tab-new nav-tabs">
							<li class=""><a href="{{ URL::route('client.profile') }}">プロフィール</a></li>
							<li><a href="{{ URL::route('client.profile.availabletask') }}">興味ある内容</a></li>
							<li class="active"><a href="{{ URL::route('client.profile.rating') }}">評価・実績</a></li>
						</ul>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<!-- <h4 class="pagerow-title">
							<span>今までの実績</span>
							<a href="#" onclick="editTotalResult(); return false;" class="btn-primary btn btn-style-shadow-green btn-success right-title">編集する</a>
						</h4>
						<div class="row">
							<div class="col-xs-12">
								<h4 class="rating-text-result" id="rating-text-result">{{ $user->total_result }}</h4>
							</div>
						</div> -->
						<div class="row e-hidden" id="result-form">
							<div class="col-xs-12">
								<form action="" method="POST" role="form">
									<div class="form-group">
										{{ Form::textarea('result-rating', $user->total_result, ['class'=>'form-control', 'id'=>'result-area', 'rows'=>5]) }}
									</div>
									<div class="text-center">
										<button type="button" onclick="saveResult();" class="btn btn-primary">登録する</button>
									</div>
								
									
								
									
								</form>
							</div>
						</div>


						<h4 class="pagerow-title">
							<span>依頼者からの評価</span>
						</h4>

						<!-- <div class="block-evaluation text-center mypageagency">
		                    <div class="col-sm-3 ">
		                        <div class="row evaluation">
		                        <h5 class="text-primary"><b>実績</b></h5>
		                        <p>{{ $rating_info['result'] }}</p>
		                        <p>1ヶ月 : {{ $rating_info['result_a_month'] }}件</p>
		                        <p>半年： {{ $rating_info['result_a_half_year'] }}件</p>
		                        </div>
		                    </div>
		                    <div class="col-sm-3">
		                        <div class="row evaluation">
		                        <h5 class="text-primary"><b>評価</b></h5>
		                        <p>{{$rating_info['evaluate']}}</p>
		                        <div>
		                            <div class="star-rating total-rating">
										<select class="total-rating-disabled" data-current-rating="{{$rating_info['evaluate']}}" name="rating" autocomplete="off">
											<option value=""></option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
										</select>
									</div>

		                        </div>
		                        <p>1ヶ月 : {{ $rating_info['evaluate_a_month'] }}件</p>
		                        <p>半年： {{ $rating_info['evaluate_a_half_year'] }}件</p>
		                        </div>
		                    </div>
		                    <div class="col-sm-3">
		                        <div class="row evaluation">
		                        <h5 class="text-primary"><b>直接依頼</b></h5>
		                        <p>{{$rating_info['direct_request']}}件</p>
		                        
		                        </div>
		                    </div>
		                    <div class="col-sm-3">
		                        <div class="row evaluation">
		                        <h5 class="text-primary"><b>進行案件</b></h5>
		                        <p>{{$rating_info['state_project']}}件</p>
		                        </div>
		                    </div>
		                </div> -->
		                <div class="row evaluation-list">
		                    <div class="col-sm-12" >
		                    	@foreach($feedback as $k=>$fb)
			                    	@if ($fb->hire->from_id == session('user_id'))
										@php
											$shiff_user = $fb->hire->to;
										@endphp
									@else
										@php
											$shiff_user = $fb->hire->from;
										@endphp
									@endif
		                        <div class="div-style-blue info-daily">
		                            <div class="col-sm-2 left-img-daily">
		                                <p class="thums-img">
		                                	{{HTML::image($shiff_user->image)}}
		                                </p>
		                                <p>{{$shiff_user->displayname}}</p>
		                            </div>
		                            <div class="col-sm-7">
		                                <div class="row">
		                                    <div><h4 class="mprating-link">
		                                    	@if($fb->hire->hire_type == 1)
		                                    	<a href="{{URL::route('agency.subsidydetail', [$fb->hire->policy->id ])}}">{{ $fb->hire->hire_title() }}</a>
		                                    	@else 
												{{ $fb->hire->hire_title() }}
		                                    	@endif
		                                    </h4>
		                                        <div class="star-rating fbrtdiv-{{$k}}">
													<select class="fbrtsl-{{$k}}" data-current-rating="{{$fb->eval_total}}" name="rating" autocomplete="off">
														<option value=""></option>
														<option value="1">1</option>
														<option value="2">2</option>
														<option value="3">3</option>
														<option value="4">4</option>
														<option value="5">5</option>
													</select>
												</div>
		                                    </div>
		                                    <div class="clearfix"></div>
		                                    <!-- <b>{{str_limit($fb->support_content, 50)}}</b> -->
		                                    <p>{{$fb->eval_message}}</p>
		                                    </div>
		                                </div>
		                            <div class="col-sm-3 group-raitting">
		                                <div class="text-center list-right-rating">
		                                    <div class="list-rating">
		                                        <p>総合評価</p>
		                                        <div class="star-rating fbrtdiv0-{{$k}}">
													<select class="fbrtsl0-{{$k}}" data-current-rating="{{$fb->eval_total}}" name="rating" autocomplete="off">
														<option value=""></option>
														<option value="1">1</option>
														<option value="2">2</option>
														<option value="3">3</option>
														<option value="4">4</option>
														<option value="5">5</option>
													</select>
												</div>
		                                    </div>
		                                    <div class="list-rating">
		                                        <p>品質</p>
		                                        <div class="star-rating fbrtdiv1-{{$k}}">
													<select class="fbrtsl1-{{$k}}" data-current-rating="{{$fb->eval_quality}}" name="rating" autocomplete="off">
														<option value=""></option>
														<option value="1">1</option>
														<option value="2">2</option>
														<option value="3">3</option>
														<option value="4">4</option>
														<option value="5">5</option>
													</select>
												</div>
		                                    </div>
		                                    <div class="list-rating">
		                                        <p>納期</p>
		                                        <div class="star-rating fbrtdiv2-{{$k}}">
													<select class="fbrtsl2-{{$k}}" data-current-rating="{{$fb->eval_delivery}}" name="rating" autocomplete="off">
														<option value=""></option>
														<option value="1">1</option>
														<option value="2">2</option>
														<option value="3">3</option>
														<option value="4">4</option>
														<option value="5">5</option>
													</select>
												</div>
		                                    </div><div class="list-rating">
		                                        <p>対応</p>
		                                        <div class="star-rating fbrtdiv3-{{$k}}">
													<select class="fbrtsl3-{{$k}}" data-current-rating="{{$fb->eval_conf}}" name="rating" autocomplete="off">
														<option value=""></option>
														<option value="1">1</option>
														<option value="2">2</option>
														<option value="3">3</option>
														<option value="4">4</option>
														<option value="5">5</option>
													</select>
												</div>
		                                    </div><div class="list-rating">
		                                        <p>コスト</p>
		                                        <div class="star-rating fbrtdiv4-{{$k}}">
													<select class="fbrtsl4-{{$k}}" data-current-rating="{{$fb->eval_price}}" name="rating" autocomplete="off">
														<option value=""></option>
														<option value="1">1</option>
														<option value="2">2</option>
														<option value="3">3</option>
														<option value="4">4</option>
														<option value="5">5</option>
													</select>
												</div>
		                                    </div><div class="list-rating">
		                                        <p>能力</p>
		                                        <div class="star-rating fbrtdiv5-{{$k}}">
													<select class="fbrtsl5-{{$k}}" data-current-rating="{{$fb->eval_ability}}" name="rating" autocomplete="off">
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
		                                
		                            </div>
		                            <p class="time-daily col-sm-3">{{ date('Y年m月d日', strtotime($fb->created_date) ) }}</p>
		                        </div> <!-- end .info-daily -->
		                        @endforeach
		                    </div>
		                </div>
		                <div class="row">
		                	<div class="text-center">
		                		{{ $feedback->links() }}
		                	</div>
		                </div>
					</div> <!-- end .col-sm-12 -->
				</div> <!-- end .row -->
			</div> <!-- end .mainpage -->
			<div class="col-sm-2 sidebar-right">
				@include('Client::include.sidebar-right')
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')
{{ HTML::script('assets/client/js/mypage_home.js') }}
{{ HTML::script('assets/common/js/profile.js') }}
	<script>
		var base_url = '{{URL::to('/')}}';
		var count_fb = {{count($feedback)}};
		$(document).ready(function() {
			starRatingInit('.user-rating', '.user-recom-disabled');
			starRatingInit('.total-rating', '.total-rating-disabled');
			for( i = 0; i < count_fb; i++)
			{
				starRatingInit('.fbrtdiv-'+i, '.fbrtsl-'+i);
				starRatingInit('.fbrtdiv0-'+i, '.fbrtsl0-'+i);
				starRatingInit('.fbrtdiv1-'+i, '.fbrtsl1-'+i);
				starRatingInit('.fbrtdiv2-'+i, '.fbrtsl2-'+i);
				starRatingInit('.fbrtdiv3-'+i, '.fbrtsl3-'+i);
				starRatingInit('.fbrtdiv4-'+i, '.fbrtsl4-'+i);
				starRatingInit('.fbrtdiv5-'+i, '.fbrtsl5-'+i);
			}
		});
		var editTotalResult = function() {
			if($('#result-form').hasClass('e-hidden'))
			{
				$('#result-form').removeClass('e-hidden');
			} else {
				$('#result-form').addClass('e-hidden');
			}
			
		}
		var saveResult = function() {
			var txtResult = $('#result-area').val();
			$('#result-form').addClass('e-hidden');
			$.ajax({
				url: base_url + '/client/mypage/profile/rating-ajax',
				data: {act: 'saveResult', txtresult: txtResult},
				type: 'POST',
				success: function(json) {
					$('#rating-text-result').text(txtResult);
				}
			})
		}
	</script>
@endsection