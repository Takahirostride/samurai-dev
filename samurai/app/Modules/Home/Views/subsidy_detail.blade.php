@extends('layouts.home')
@section('content')
<div class="mainpage">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h3 class="index-box-title">
					現在進んでいる案件一覧<案件詳細
				</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<p class="stitle1">{!! $result->name !!}</p>
				<p class="stitle2">{!! $result->name !!}</p>
			</div>
		</div><!-- end .row -->
		<div class="row">
			<div class="col-sm-12">
				<p class="sdesc">登録機関:{!! $result->minitry_text() !!}<span>更新日:{!! date('Y年m月d日', strtotime($result->update_date)) !!}</span><span>掲載終了予定日:{!! date('Y年m月d日', strtotime($result->subscript_duration_detail)) !!}</span></p>	
			</div>
			<div class="col-sm-12 mgt-20 mgbt-20">
				<ul class="tag-list">
					@if ($result->tags)
					@foreach($result->tags as $key => $tag)
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
										{!! $result->target !!}
									</div>

									<div class="box-text">
										<p class="sdetail-title">支援内容</p>
										{!! $result->support_content !!}
									</div>

									
									@if($result->support_scale)
									<div class="box-text">
										<p class="sdetail-title">支援規模</p>
										{!! $result->support_scale !!}
									</div>
									@endif
									
									
									<div class="box-text">
										<p class="sdetail-title">募集期間</p>
										{!! $result->subscript_duration !!}
									</div>

									
									@if($result->object_duration)
									<div class="box-text">
										<p class="sdetail-title">対象期間</p>
										{!! $result->object_duration !!}
									</div>
									@endif
									

									<div class="box-text">
									<p class="sdetail-title sdetailbd">対象者の詳細</p>
									{!! $result->info !!}
									</div>

									<div class="box-text">
										<p class="sdetail-title sdetailbd">対象地域</p>
										{{$result->region_text()}}
									</div>

									@if($result->adopt_result)
									<div class="box-text">
										<p class="sdetail-title">採択結果</p>
										{!! $result->adopt_result !!}
									</div>
									@endif

									@if(@count(json_decode($result->register_pdf, true)))
										<div class="box-text">
										<p class="sdetail-title">pdfデータ</p>	
									@endif
									
									@if(@count(json_decode($result->register_pdf, true)))
										<p>
										@if(isset(json_decode($result->register_pdf, true)['url']))
											@foreach(json_decode($result->register_pdf, true) as $register_pdf)
												<a href="{{ url('/download/'.$register_pdf['url']) }}" class="aline">{{$register_pdf['name']}}</a>
											@endforeach
										@else
											<a href="{{json_decode($result->register_pdf, true)[0][1]}}" class="aline">{{json_decode($result->register_pdf, true)[0][0]}}</a>
										@endif
										</p>
										@if(count(json_decode($result->register_pdf1, true)))
											@foreach(json_decode($result->register_pdf1, true) as $key => $register_pdf1)
												<a href="{{@$register_pdf1['url']}}" class="aline">{{@$register_pdf1['name']}}</a>
											@endforeach
										@endif
										</div>
									@endif
									
									<div class="box-text">
										<p class="sdetail-title">お問い合せ</p>
										{!! nl2br($result->inquiry) !!}
									</div>
								</div><!-- end .sdetail -->
							</div><!-- end left-detail -->
						</div> <!-- end .row -->
					</div> <!-- end .subsidydetail -->
				</div> <!-- end .row -->
			</div> <!-- .col-sm-12 -->
		</div> <!-- end .row -->
	</div> <!-- end .container -->
</div> <!-- end .mainpage -->
@endsection