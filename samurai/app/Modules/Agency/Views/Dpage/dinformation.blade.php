@extends('layouts.home')
@section('style')
	<link rel="stylesheet" href="/assets/agency/css/b_select.css">
@endsection
@section('content')
<div class="mainpage">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
			@includeIf('partials.breadcrumb', ['title' => 'お知らせ詳細'])
			</div>
		</div> <!-- end .row -->
		<div class="row">
			<div class="col-sm-10">
				<p class="stitle1">{!! $results->job_title !!}</p>
			</div>
		</div><!-- end .row -->
		<div class="row">
			<div class="col-sm-12">
				<p class="sdesc">投稿日:{!! date('Y年m月d日', strtotime($results->created_at)) !!}</span></p>	
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="row">
					<div class="col-sm-12 subsidydetail">
						<div class="row">
							<div class="col-xs-9 left-detail">
								<table class="table table-date-policy table-bordered">
									<tbody>
										<tr>
											<td>
												予算　　　　　：<span class="bigtext">{{@config('site_config.client_budget_list')[$results->budget]}}</span>+税　　　　希望納期：<span class="bigtext">{{date('Y',strtotime($results->deli_date))}}</span>年<span class="bigtext">{{date('m',strtotime($results->deli_date))}}</span>月<span class="bigtext">{{date('d',strtotime($results->deli_date))}}</span>日
											</td>
										</tr>
										<tr>
											<td>
												　　見積の締め切り  :　　　　<span class="bigtext">{{date('Y/m/d',strtotime($results->deli_date))}}</span>
											</td>
										</tr>
									</tbody>
								</table>
								<p class="sdetail-title">依頼詳細</p>
								<div class="job_content mgt-20">
									{!! $results->job_content !!}
								</div>

							</div><!-- end left-detail -->
							<div class="col-xs-3">
								<table class="table table-bordered text-center listuserbid mgbt-0">
									<tbody>
										<tr>
											<td>
												<a href="{{route('agency.DclientRequest')}}?register=1&to_id={{$results->from->id}}" class="btn btn-default baskbutton submitbask">事業者に提案する</a>
											</td>
										</tr>
										<tr>
											<td>
												@if($results->from)
												<div class="subsidylist-item-av">
													<img src="{{url($results->from->image)}}" alt="">
													<div class="itemav-info text-center">
														<p>事業者名</p>
														<p>{{$results->from->displayname}}</p>
													</div>
												@endif
											</td>
										</tr>
									</tbody>
								</table>
							</div><!-- end .col-xs-4 -->
						</div> <!-- end .row -->
						<div class="row">
							<div class="col-sm-12">
								<div class="text-center mgt-30 mgbt-30">
									<a href="{{route('agency.DclientRequest')}}?register=1" class="btn btn-default baskbutton submitbask">事業者に提案する</a>
								</div>
							</div>
						</div>
					</div> <!-- end .subsidydetail -->
				</div> <!-- end .row -->
			</div> <!-- .col-sm-12 -->
		</div> <!-- end .row -->
	</div> <!-- end .container -->
</div> <!-- end .mainpage -->
@endsection