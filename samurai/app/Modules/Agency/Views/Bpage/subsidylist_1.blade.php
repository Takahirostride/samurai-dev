@extends('layouts.home')
@section('style')
	<link rel="stylesheet" href="/assets/user/agency/css/b_subsidylist.css">
@endsection
@section('content')
<div class="mainpage">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				{{-- @includeIf('partials.breadcrumb', ['title' => '自動マッチング']) --}}
				<div class="bre">
					<a href="{{route('agency.index')}}">TOPページ</a>＞お知らせ一覧
				</div>
			</div>
		</div>
		<div class="row">
			{{-- <div class="col-sm-12">
				<div class="navi-content">
					<ul class="nav">
						<li class="active">
							<a href="javascript:void()">自動検索</a>
						</li>
						<li>
							<a href="{{route('agency.bsearch')}}">手動検索</a>
						</li>
					</ul>
				</div>
			</div> --}}
			<div class="col-sm-12">
				<table class="table table-bordered mgbt-0">
					<thead>
						<tr>
							<th>
								<span class="page-per-page">検索結果: {{$results->total()}}件</span>
								<div class="float-right">
									<form action="" method="POST" class="form-inline">
										<div class="form-group">
											<label for="">並び替え: </label>
											{!!Form::select('order-by', config('combobox.order_by'), request()->order, ['class' => 'form-control order-by']) !!}
										</div>
										<div class="form-group">
											<label for="">表示件数: </label>
											{!!Form::select('per-page', config('combobox.per_page'), request()->per_page, ['class' => 'form-control per-page']) !!}
										</div>
									</form>
								</div> <!-- end float-right -->
							</th>
						</tr>
					</thead>
				</table>
				@foreach($results as $key => $val)
				@if($payroll==0 && !strpos($result->policy->acquire_budget, '0'))
				<table class="table table-bordered">
					<tbody>
						<tr>
							<td>
								<div class="row" style="margin-left: 15px;background-image: url({{url('/assets/photo/mosaic.png')}});height:200px;background-size: contain;background-repeat: no-repeat;">
			                        <div class="row" style="margin-top: 5px;margin-bottom: 25px;">
			                            <div class="col-sm-12">
			                            	@if($val->policy->acquire_budget_display==1)
			                                <div class="btn-cost">
			                                    <label class="label-cost">{{$val->policy->acquire_budget_display}}</label>
			                                </div>
			                                @endif
			                            </div>
			                        </div>
			                    </div>
							</td>
						</tr>
					</tbody>
				</table>
                @else
                <div class="create-link-box-x">
					<table class="table table-bordered subsidylist">
						<tbody>
							<tr>
								<td rowspan="2">
									@if($val->image_id)
										<img src="{{ asset($val->policy->image_id) }}" alt="{{str_limit($val->policy->name,34)}}">
									@endif	
								</td>
								<td>
									<p><a href="{{route('agency.bselect', ['policy_id' => $val->policy->id])}}"><span class="sidy-tbig">{{str_limit($val->policy->name,34)}}</span></a></p>
									<p class="text-right text-primary">
										<strong>発行機関:</strong><span>{{$val->policy->minitry_text()}}</span>/
										<strong>対象地域:</strong><span>{{$val->policy->region_text()}}</span>
										<strong>募集時期:</strong><span>{{str_limit($val->policy->subscript_duration , 124)}}</span>
									</p>
								</td>
								<td rowspan="3">
									@if($val->policy->paid_user)
									<div class="row">
										<div class="col-xs-9">
											<div class="subsidylist-item-av div-style-grey">
												<img src="{{url($val->policy->paid_user[0]->image)}}" alt="">
												<div class="itemav-info">
													<p>事業者名{{$val->policy->paid_user[0]->displayname}}</p>
													<div class="clearfix">
														<span class="pull-left">実績     ：</span>
														<div class="pull-left star-rating fbrtdiv-{{$key}}">
														    <select class="fbrtsl-{{$key}}" data-current-rating="{{$val->policy->paid_user[0]->evaluate}}" name="rating" autocomplete="off">
														        <option value=""></option>
														        <option value="1">1</option>
														        <option value="2">2</option>
														        <option value="3">3</option>
														        <option value="4">4</option>
														        <option value="5">5</option>
														    </select>
														</div>
													</div>
													<p>実績：{{$val->policy->paid_user[0]->result}}件</p>
												</div>
												@if($val->seller_exist_flag == 'success')
													<div class="div-style-grey">
			                                            <div class="imagecenter">
			                                                <img src="{$val->seller->image_url}}" style="max-width:200px;max-height:105px;">
			                                            </div>
			                                        </div>
			                                    @endif
			                                    <div class="clearfix"></div>
												<p>{{$val->policy->paid_user[0]->self_intro}}</p>
											</div>
										</div>
										<div class="col-xs-3">
											<div class="mgl--20">
												<img class="user_av"  src="{{url('assets/photo/clienticon.png')}}" alt="">
												<p class="count_user">他{{count($val->policy->matchingUser)}}人</p>
												@if(count($val->policy->seller_policy))
												<img class="user_av"  src="{{url('assets/photo/clientgrey.png')}}" alt="">
												<p class="count_user">他{{count($val->policy->seller_policy)}}社</p>
												@endif
											</div>
										</div>
									</div>
									@endif
								</td>
							</tr>
							<tr>
								<td>
									<ul class="tag-list">
									@if($val->policy->tags)
										@foreach($val->policy->tags as $key => $tag)
										<li><span>{{str_limit($tag->tag,10)}}</span></li>
										@endforeach
									@endif
									</ul>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<div class="row">
										<div class="col-sm-9">
											<div class="dpleft-bottom">
												<div class="dp-sp-scale">
													<span class="rounder-sp"><span></span>支援規模</span>
													{!! str_limit($val->policy->support_content, 80) !!}
												</div>
												<div class="dp-sp-scale">
													<span class="rounder-sp"><span></span>支援規模</span>
													{!! str_limit($val->policy->support_scale, 80) !!}
												</div>
												<div class="dp-sp-scale">
													<span class="rounder-sp"><span></span>施策種別</span>
													<p class="dsp-price">{!! str_limit($val->policy->acquire_budget_display, 80) !!}</p>
												</div>
											</div>
										</div>
										@if(!$val->accept && $val->accept!=1)
										<div class="col-sm-3 text-right">
											<a  href="{{route('agency.bselect', ['policy_id' => $val->id])}}" class="btn btn-default btn-suggest">提案する</a>
											<p>{!! Button::getBookmarkButton($val->policy) !!}</p>
											
										</div>
										@endif
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				@endif
				@endforeach
				<div class="text-center">
					{{ $results->appends(request()->query())->links() }}
				</div>
			</div>
		</div> <!-- end .row -->
	</div> <!-- end .container -->
</div> <!-- end .mainpage -->
<div class="clearfix"></div>
@endsection
@section('script')
	<script src="/assets/user/agency/js/b_subsidylist.js"></script>
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