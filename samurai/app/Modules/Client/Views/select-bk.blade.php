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
			<div class="col-sm-10">
				<p class="stitle1">{!! $policy_data->name !!}</p>
				<p class="stitle2">{!! $policy_data->name !!}</p>
			</div>
			<div class="col-sm-2">
				<div class="text-right">
					{!! Button::getLikeButtons($policy_data->id) !!}
				</div>
			</div>
		</div><!-- end .row -->
		<div class="row">
			<div class="col-sm-12">
				<p class="sdesc">登録機関:{!! $policy_data->register_insti_detail !!}<span>更新日:{!! $policy_data->update_date !!}</span><span>掲載終了予定日:{!! date('Y年m月d日', strtotime($policy_data->subscript_duration_detail)) !!}</span></p>	
			</div>
			<div class="col-sm-12 mgt-20 mgbt-20">
				<ul class="tag-list">
					{{-- @if (request()->type !== null) --}}
					@foreach(json_decode($policy_data->tag, true) as $key => $tag)
					<li><span>{{str_limit($tag,10)}}</span></li>
					@endforeach
					{{-- @endif --}}
				</ul>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="row">
					<div class="col-sm-12 subsidydetail">
						{{ Form::open(['url' => route('agency.getbask'), 'method' => 'GET', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data']) }}
						{{Form::hidden('searchtype', 1)}}
						<div class="row">
							<div class="col-xs-8 left-detail">
								<div class="sdetail">
									<p class="sdetail-title">目的</p>
									{!! $policy_data->target !!}
									<p class="sdetail-title">対象者の詳細</p>
									{!! $policy_data->info !!}
									<p class="sdetail-title">支援内容</p>
									{!! $policy_data->support_content !!}
									<p class="sdetail-title">支援規模</p>
									<table class="table table-bordered support-scale text-center">
										<tbody>
											<tr>
												<td width="33%">下限</td>
												<td width="33%">上限</td>
												<td width="33%">助成率</td>
											</tr>
											<tr>
												<td class="text-center std"><span class="fake-input">{!! $policy_data->support_scale_lower_limit !!}</span></td>
												<td class="text-center std"><span class="fake-input">{!! $policy_data->support_scale_upper_limit !!}</span></td>
												<td class="text-center std"><span class="fake-input">{!! $policy_data->support_scale_subsidy_duration !!}</span></td>
											</tr>
										</tbody>
									</table>
									{!! $policy_data->support_scale !!}
									@if($policy_data->subscript_duration)
									<p class="sdetail-title">募集期間</p>
									{!! $policy_data->subscript_duration !!}
									@endif
									@if($policy_data->object_duration)
									<p class="sdetail-title">対象期間</p>
									{!! $policy_data->object_duration !!}
									@endif
									<p class="sdetail-title">対象地域</p>
									{!! $policy_data->region !!}
									@if($policy_data->adopt_result)
									<p class="sdetail-title">採択結果</p>
									{!! $policy_data->adopt_result !!}
									@endif

									<p class="sdetail-title">掲載終了日</p>
									@if(!$policy_data->subscript_duration_option)
									{!! $policy_data->subscript_duration_detail !!}
									@endif
									@if(!$policy_data->subscript_duration_option)
									<p>随時</p>
									@endif
									@if(count(json_decode($policy_data->register_pdf, true)) || count(json_decode($policy_data->register_pdf1, true)))
									<p class="sdetail-title">pdfデータ</p>
									@endif
									@if(count(json_decode($policy_data->register_pdf, true)))
									<a href="{{url($policy_data->register_pdf[1])}}" class="aline">{{url($policy_data->register_pdf[0])}}</a>
									@endif

									<p>
									@if(count(json_decode($policy_data->register_pdf1, true)))
										@foreach(json_decode($policy_data->register_pdf1, true) as $key => $register_pdf1)
											<a href="{{$register_pdf1['url']}}" class="aline">{{$register_pdf1['name']}}</a>
										@endforeach
									@endif
									</p>
									<p class="sdetail-title">お問い合せ</p>
									{!! nl2br($policy_data->inquiry) !!}
								</div><!-- end .sdetail -->
							</div><!-- end left-detail -->
							<div class="col-xs-4">
								<table class="table table-bordered text-center listuserbid mgbt-0 mgt-30">
									<tbody>
										<tr>
											<td>
												<input type="checkbox" name="checkall" class="checkall" data-check="usercheck">
												{{Form::hidden('policy_id[]', $policy_data->id)}}
												</td>
											<td>
												<button type="submit"  class="btn btn-default baskbutton">事業者に提案する</button>
											</td>
										</tr>
									</tbody>
								</table>
								@if($results)
								@foreach($results as $key => $val)
								<table class="table table-bordered listuserbid">
									<tbody>
										<tr>
											<td>
												<input type="checkbox" name="usercheck[]" class="usercheck" value="{{$val->id}}">
												</td>
											<td>
												<div class="subsidylist-item-av">
													<img src="{{url($val->image)}}" alt="">
													<div class="itemav-info">
														<p>事業者名{{$val->displayname}}件</p>
														<div class="clearfix">
															<span class="pull-left">実績     ：</span>
															<div class="pull-left star-rating fbrtdiv-{{$key}}">
															    <select class="fbrtsl-{{$key}}" data-current-rating="{{$val->evaluate}}" name="rating" autocomplete="off">
															        <option value=""></option>
															        <option value="1">1</option>
															        <option value="2">2</option>
															        <option value="3">3</option>
															        <option value="4">4</option>
															        <option value="5">5</option>
															    </select>
															</div>
														</div>
														<p>実績：{{$val->result}}件</p>
													</div>
			                                    <div class="clearfix"></div>
												<p>{{$val->self_intro}}</p>
											</div>
											</td>
										</tr>
									</tbody>
								</table>
								@endforeach
								@endif
								
							</div><!-- end .col-xs-4 -->
						</div> <!-- end .row -->
						<div class="row">
							<div class="col-sm-12">
								<div class="text-center mgt-30 mgbt-30">
									<button type="submit" class="btn btn-success sdetail-back-btn btn-style-shadow-green">提案する</button>
								</div>
							</div>
						</div>
						{{ Form::close() }}

					</div> <!-- end .subsidydetail -->
					
				</div> <!-- end .row -->


				
			</div> <!-- .col-sm-12 -->
		</div> <!-- end .row -->
		</div> <!-- end .container -->
</div> <!-- end .mainpage -->
<div class="clearfix"></div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="display: none;">
	<div class="modal-dialog modal-lg modal-dialog-centered text-center" role="document">
		<div class="modal-content" style="height: 676.8px;">
			<div class="modal-header text-center">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
				<h5 class="modal-title">マニュアル</h5>
			</div>
			<div class="modal-body">
				<iframe width="100%" height="100%" src="static-page/operationlecture.html" frameborder="0"></iframe>
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
	<script src="/assets/agency/js/b_select.js"></script>
	<script type="text/javascript">
		var count_fb = {{count($results)}};
		$(document).ready(function() {
			for( i = 0; i < count_fb; i++)
			{
				starRatingInit('.fbrtdiv-'+i, '.fbrtsl-'+i);
			}
		});
	</script>
@endsection