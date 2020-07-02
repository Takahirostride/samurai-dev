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
			@includeIf('partials.breadcrumb', ['title' => '現在進んでいる案件一覧<案件詳細'])
			</div>
		</div> <!-- end .row -->
		<div class="row">
			<div class="col-sm-12">
				<p class="stitle1">{!! $policy_data->name !!}</p>
				<p class="stitle2">{!! $policy_data->name_serve !!}</p>
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
							<div class="col-xs-12 left-detail">
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
						</div> <!-- end .row -->
						<div class="row">
							<div class="col-sm-12">
								<div class="text-center mgt-30 mgbt-30">
									@include('Client::Fpage.btn_register',['element'=>$policy_data])
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