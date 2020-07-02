@extends('layouts.home')
@section('style')
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/common/plugins/datepicker/css/bootstrap-datepicker.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/client/css/f_search.css?v='.time()) }}">
@endsection
@section('content')
<div class="mainpage client-page">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
			@includeIf('partials.breadcrumb', ['title' => 'お知らせ詳細'])
			</div>
		</div> <!-- end .row -->
		<div class="row">
			<div class="col-sm-9">
				<p class="stitle1">{!! $policy_data->name !!}</p>
				<p class="stitle2">{!! $policy_data->name_serve !!}</p>
			</div>
			<div class="col-sm-3">
				<div class="cli-action text-right">					
					<span class="policy-like">{!! Button::getBookmarkButton($policy_data) !!}</span>
				</div>
			</div>
		</div><!-- end .row -->
		<div class="row">
			<div class="col-sm-12">
				<p class="policy-date tb-contain">
					<span class="tb-cell">登録機関:{!! $policy_data->minitry_text() !!}</span>
					<span class="tb-cell text-center">更新日:{!! $policy_data->update_date !!}</span>
					<span class="tb-cell text-right">掲載終了予定日:{!! ol_get_date_string($policy_data->subscript_duration_detail) !!}</span>
				</p>	
			</div>
			<div class="col-sm-12 mgt-20 mgbt-20">
				<ul class="tag-list">
					@if ($policy_data->tags)
					@foreach($policy_data->tags as $key => $tag)
					<li><span>{{str_limit($tag->tag,10)}}</span></li>
					@endforeach
					@endif
				</ul>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="row">
					<div class="col-sm-12 subsidydetail">
						<div class="row">
							<div class="col-xs-8 left-detail">
								<div class="sdetail">
									<div class="box-text">
										<p class="sdetail-title">目的</p>
										{!! $policy_data->target !!}
									</div>

									<div class="box-text">
										<p class="sdetail-title">支援内容</p>
										{!! $policy_data->support_content !!}
									</div>

									
									@if($policy_data->support_scale)
									<div class="box-text">
										<p class="sdetail-title">支援規模</p>
										{!! $policy_data->support_scale !!}
									</div>
									@endif
									
									
									<div class="box-text">
										<p class="sdetail-title">募集期間</p>
										{!! $policy_data->subscript_duration !!}
									</div>

									
									@if($policy_data->object_duration)
									<div class="box-text">
										<p class="sdetail-title">対象期間</p>
										{!! $policy_data->object_duration !!}
									</div>
									@endif
									

									<div class="box-text">
									<p class="sdetail-title sdetailbd">対象者の詳細</p>
									{!! $policy_data->info !!}
									</div>

									<div class="box-text">
										<p class="sdetail-title sdetailbd">対象地域</p>
										{{$policy_data->region_text()}}
									</div>

									@if($policy_data->adopt_policy_data)
									<div class="box-text">
										<p class="sdetail-title">採択結果</p>
										{!! $policy_data->adopt_policy_data !!}
									</div>
									@endif

									@if(@count(json_decode($policy_data->register_pdf, true)))
										<div class="box-text">
										<p class="sdetail-title">pdfデータ</p>	
									@endif
									
									@if(@count(json_decode($policy_data->register_pdf, true)))
										<p>
										@if(isset(json_decode($policy_data->register_pdf, true)['url']))
											@foreach(json_decode($policy_data->register_pdf, true) as $register_pdf)
												<a href="{{ url('/download/'.$register_pdf['url']) }}" class="aline">{{$register_pdf['name']}}</a>
											@endforeach
										@else
											<a href="{{json_decode($policy_data->register_pdf, true)[0][1]}}" class="aline">{{json_decode($policy_data->register_pdf, true)[0][0]}}</a>
										@endif
										</p>
										@if(count(json_decode($policy_data->register_pdf1, true)))
											@foreach(json_decode($policy_data->register_pdf1, true) as $key => $register_pdf1)
												<a href="{{@$register_pdf1['url']}}" class="aline">{{@$register_pdf1['name']}}</a>
											@endforeach
										@endif
										</div>
									@endif
									

									<div class="box-text">
										<p class="sdetail-title">お問い合せ</p>
										{!! nl2br($policy_data->inquiry) !!}
									</div>
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
												<button type="submit" @if(count($policy_data->hire)) disabled="" @endif class="btn btn-default baskbutton submitbask">見積依頼</button>
											</td>
										</tr>
									</tbody>
								</table>
								@if($matching_users)
								@foreach($matching_users as $key => $val)
								<table class="table table-bordered listuserbid">
									<tbody>
										<tr>
											<td>
												<input type="checkbox" name="usercheck[]" class="usercheck" data-id="check_{{$val->id}}" value="{{$val->id}}">
												</td>
											<td class="create-link-box">
												<a href="{{route('agency.profile.view',[$val->id])}}"></a>
												<div class="subsidylist-item-av">
													<img src="{{url($val->image)}}" alt="">
													<div class="itemav-info">
														<p>事業者名: {{ str_limit($val->displayname, 20) }}</p>
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
									<button type="submit" @if(count($policy_data->hire)) disabled="" @endif class="btn btn-default baskbutton submitbask">見積依頼</button>
								</div>
							</div>
						</div>
					</div> <!-- end .subsidydetail -->
					
				</div> <!-- end .row -->


				
			</div> <!-- .col-sm-12 -->
		</div> <!-- end .row -->
		</div> <!-- end .container -->
</div> <!-- end .mainpage -->
<div class="clearfix"></div>
@endsection
@section('script')
	@if(!$policy_data->matchingUser || $policy_data->matchingUser->isEmpty())	
	@include('Client::Fpage.popup_register',['policy'=>$policy_data])
	@endif
	<script>
		var matching_users_total = {{count($matching_users)}};
	</script>
	<script src="{{ asset('assets/client/js/f_select.js?v='.time()) }}"></script>
@endsection