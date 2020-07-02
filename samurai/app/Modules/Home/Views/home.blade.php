@extends('layouts.home')
@section('style')
	{{HTML::style('assets/home/css/home.css')}}
@endsection
@section('content')
<div class="mainpage">
	<div class="page-fullwidth">
		<div class="jumbotron jumbotron-home">
			<div class="land-image float-left animated slideInLeft fast">
				{{HTML::image('assets/common/images/assitance.png')}}
			</div>
			<div class="land-top float-left animated slideInRight fast">
				<p class="land-p">日本最大級の助成金・補助金<br>自動マッチングサイト「サムライ」</p>
				<a href="{{URL::to('login')}}" type="button" class="shadowbuttonblue btn btn-primary btn-lg land-btn">ログイン</a>
				<a href="{{URL::to('register')}}" type="button" class="shadowbuttonwarm btn btn-warning btn-lg land-btn">新規登録</a>
				<a href="#">
					<img src="{{URL::to('assets/common/images/manual.png')}}" style="cursor:pointer;" height="40px" data-toggle="modal" data-target="#modal-register">
				</a>
			</div> <!-- end .land-top -->
		</div> <!-- end .jumbotron -->
	</div> <!-- end .page-fullwidth -->
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h3 class="index-box-title">
					初めての方へ
					<small>SAMURAIはこんなサービスを提供しています。</small>
				</h3>
				<div class="row mgbt-50">
					<div class="col-sm-4 index-boxcol">
						{{HTML::image('assets/common/images/first.png', 'boxcol-image', ['class'=>'boxcol-image'])}}
						<p class="boxcol-title">SAMURAI とは</p>
						<p class="boxcol-desc">SAMURAIとは、施策（助成金、補助金）のマッチングシステムです。助成金、補助金を受けたい企業×施策×士業の三者マッチングにより、中小企業のサポートをしていきます。</p>
						{{HTML::link('whatissamurai', '', ['class'=>'boxcol-link'])}}
					</div>
					<div class="col-sm-4 index-boxcol">
						{{HTML::image('assets/common/images/second.png', 'boxcol-image', ['class'=>'boxcol-image'])}}
						<p class="boxcol-title">どうやってマッチングするの?</p>
						<p class="boxcol-desc">企業のプロフィールを埋める事で現在受けられそうな施策が自動マッチングし、申請代行して頂ける方も自動マッチングします。あとは、どの士業の方に依頼するかをワンクリックで申請代行がスタートします。</p>
						{{HTML::link('howtomatching', '', ['class'=>'boxcol-link'])}}
					</div>
					<div class="col-sm-4 index-boxcol">
						{{HTML::image('assets/common/images/third.png', 'boxcol-image', ['class'=>'boxcol-image'])}}
						<p class="boxcol-title">どうやって使うの？</p>
						<p class="boxcol-desc">はじめに、プロフィールを埋めて行きましょう！ <br>プロフィールを埋めたら、そこから申請できそうな助成金・補助金の申請代行業務がスタートします。 <br>集金の代行からも全てお任せ下さい！</p>
						{{HTML::link('howtouse', '', ['class'=>'boxcol-link'])}}
					</div>
				</div> <!-- end .row -->
				
				<div class="clearfix"></div>

				<!-- <h3 class="index-box-title">
					ご利用者様の声
					<small>SAMURAIを活を用頂いたお客様の声を一部紹介します。</small>
				</h3>-->
				{{-- {{HTML::link('uservoicelist', 'ご利用者の声をもっと見る', ['class'=>'btn shadowbutton btn-success index-big-button'])}}  --}}

				{{-- <div class="clearfix"></div> --}}
				<h3 class="index-box-title">
					ご利用者様の声
					<small>SAMURAIを活を用頂いたお客様の声を一部紹介します。</small>
				</h3>
				<div class="row">
					@if($voices)
					@foreach($voices as $index => $val)
					<div class="col-sm-4">
						<div class="box-item">
							<img src="{{$val->image_url}}" alt="">
							<div class="pd-20">
								@if($val->manage_flag==0)
								<p class="voice-tag bg-color"><strong>ご利用者の声（企業）</strong></p>
								@else
								<p class="voice-tag bg-f88146"><strong>ご利用者の声（士業）</strong></p>
								@endif
								<h5 class="blog-title"><a href="{{route('uservoicelistdetail', ['id'=>$val->id])}}"><strong>{{$val->title}}</strong></a></h5>
								{!! str_limit($val->content, 200) !!}
							</div>
						</div>
					</div>
					@php $num = $index+1 @endphp
					@if($num % 3 == 0)
					</div>
					<div class="row">
					@endif
					@endforeach
					@endif
				</div>
				<a href="{{URL::to('uservoicelist')}}" class="btn shadowbutton btn-success index-big-button">ご利用者の声をもっと見る</a>

				<div class="clearfix"></div>

				<h3 class="index-box-title">
					おすすめ
					<small>様々なタイプの案件があります。</small>
				</h3>
				
				@if($policys)
				@foreach ($policys->chunk(2) as $chunk)
				<div class="row">
					@foreach ($chunk as $val)
					<div class="col-sm-6">
						<div class="create-link-box-x">
							<table class="table table-bordered subsidylist subsidylist-2">
								<tbody>
									<tr>
										<td rowspan="2">
											@if($val->image_id)
												<img src="{{ asset($val->image_id) }}" alt="{{str_limit($val->name,34)}}">
											@endif	
										</td>
										<td>
											<p><a href="{{route('subsidydetail', ['id' => $val->id])}}"><span class="sidy-tbig">{{str_limit($val->name,34)}}</span></a></p>
											<p class="text-right text-primary">
												<strong>発行機関:</strong><span>{{str_limit($val->register_insti_detail,18)}}</span>/
												<strong>対象地域:</strong><span>{{str_limit($val->region , 40)}}</span>
												<strong>募集時期:</strong><span>{{str_limit($val->subscript_duration , 8)}}</span>
											</p>
										</td>
									</tr>
									<tr>
										<td>
											<ul class="tag-list">
												@if ($val->tags)
												@foreach($val->tags as $key => $tag)
												<li><span>{{str_limit($tag->tag,10)}}</span></li>
												@endforeach
												@endif
											</ul>
										</td>
									</tr>
									<tr>
										<td style="border-right: none"></td>
										<td style="border-left: none">
											<div class="row">
												<div class="col-sm-12">
													<div class="dpleft-bottom">
														<div class="dp-sp-scale">
															<span class="rounder-sp"><span></span>支援規模</span>
															{!! str_limit($val->support_content, 80) !!}
														</div>
														<div class="dp-sp-scale">
															<span class="rounder-sp"><span></span>支援規模</span>
															{!! str_limit($val->support_scale, 80) !!}
														</div>
														<div class="dp-sp-scale">
															<span class="rounder-sp"><span></span>施策種別</span>
															<p class="dsp-price">{!! str_limit($val->acquire_budget_display, 80) !!}</p>
														</div>
													</div>
												</div>

											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div> <!-- end .index-boxcol2 -->
					@endforeach
				</div> <!-- end .row -->
				@endforeach
				@endif
				<div class="clearfix"></div>
				<div class="row">
					<a href="{{URL::to('subsidylist', 0)}}" class="btn shadowbutton btn-success index-big-button">おすすめの案件をもっと見る</a>
				</div>  <!-- end .row -->
				<!-- <h3 class="index-box-title">
					士業のブログ
				</h3>
				<a href="{{URL::to('bloglist')}}" class="btn shadowbutton btn-success index-big-button">士業のブログをもっと見る</a> -->
			</div> <!-- end .col-xs-12 -->
		</div> <!-- end .row -->
	</div> <!-- end .container -->
	<div class="page-fullwidth">
		<div class="abount-samurai">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
							<h3 class="index-box-title index-subbox">
								SAMURAI とは
							</h3>
							<p class="sb-heading">SAMURAIは、以下の4つの事業により社会貢献を果たしていきます。</p>
							<p class="sb-desc">1、助成金・補助金の有効活用により日本企業の技術やサービスを活性化させる </p>
							<p class="sb-desc">2、助成金・補助金を活用して頂き、日本企業の黒字化後押しする </p>
							<p class="sb-desc">3、日本企業の文化や技術を活性化させ、世界で通用する企業を創出する</p>
							<p class="sb-desc">4、優良企業や団体に的確な助成金・補助金のマッチングを行う</p>
							<p class="sb-heading1">より良い社会実現のために、SAMURAIは尽力して参ります。</p>
					</div> <!-- end .col-xs-12 -->
				</div> <!-- end .row -->
			</div> <!-- end .container -->
		</div> <!-- end .project-info -->
	</div> <!-- .page-fullwidth-->
</div> <!-- end .mainpage -->
<div class="modal fade" id="modal-register" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered text-center" role="document">
      <div class="modal-content">
          <div class="modal-header text-center">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
              <h5 class="modal-title">マニュアル</h5>
          </div>
          <div class="modal-body">
              <iframe width="100%" height="100%" src="/manuals/register/operationlecture.html" frameborder="0"></iframe>
          </div>
      </div>
  </div>
</div>
@endsection
@section('script')
	{{HTML::script('assets/home/js/home.js')}}
@endsection