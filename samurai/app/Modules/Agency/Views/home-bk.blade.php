@extends('layouts.home')
@section('style')
	<link rel="stylesheet" href="/assets/agency/css/home.css">
@endsection
@section('content')
<div class="mainpage">
	<div class="page-fullwidth">
		<div class="jumbotron jumbotron-home">
			<div class="jumbotron-button-list">
				<div class="row">
					<div class="col-sm-offset-1 col-sm-5">
						<p class="jumbotron-text">助成金・補助金検索</p>
						<a href="{{route('agency.bsubsidylist')}}" class="btn btn-primary shadowbuttonblue mgt-30"  data-toggle="tooltip" data-placement="bottom" {{-- data-original-title="あなたが対応可能な施策（助成金・補助金）を登録することで、事業者から検索されやすくなります。またSAMURAIに登録されていない施策をあなたが登録すること優先的に仕事依頼が来ます。" --}}>
							<span class="tbig">助成金検索</span>
							<span class="tsmall">手動検索と自動検索<br>ができます。</span>
						</a>
					</div>
					<div class="col-sm-5">
						<p class="jumbotron-text">企業の依頼を見る</p>
						<a href="{{route('agency.dsubsidylist')}}" class="btn btn-primary shadowbuttonblue mgt-30"  data-toggle="tooltip"{{--  data-placement="bottom" data-original-title="あなたが対応可能な施策（助成金・補助金）を登録することで、事業者から検索されやすくなります。またSAMURAIに登録されていない施策をあなたが登録すること優先的に仕事依頼が来ます。" --}}>
							<span class="tbig">仕事を探す</span>
							<span class="tsmall">企業からの仕事依頼<br>に答えてあげましょう！</span>
						</a>
					</div>
				</div>
				
				
				
			</div>
		</div> <!-- end .jumbotron -->
	</div> <!-- end .col-sm-12 -->
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h3 class="index-box-title">
					お知らせ
				</h3>
				@if($notification)
				<table class="table table-hover table-bordered notification">
					<tbody>
						@foreach($notification as $key=>$nof)
			        	<tr>
			        		<td>
			        			<span class="date">{{date('Y年m月d日', strtotime($nof->created_date) )}}</span>
			        			<span class="nofititle">{{$nof->title}}</span>
			        		</td>
			        		
			        	</tr>
			        	@endforeach
					</tbody>
				</table>
				@endif
				<div class="row">
					<div class="col-sm-12">
						<div class="notify-list">
							<p class="nf1">スキルセットを登録しましょう！
							</p>
							<p class="nf2">能力をアピールして自分に合った仕事を探しましょう！</p>
							<p class="nf3">過去の実績や得意分野を登録しておくことで、企業からの仕事依頼が格段に増えます。 <br>出来るだけ細かく得意分野、受注できる仕事を書いておきましょう！</p>
							<a href="{{url('/agency/mypage/home')}}" class="btn btn-primary shadowbuttonblue">スキルセットの登録をする</a>
						</div><!-- end .notify-list -->
					</div><!-- end .col-sm-12 -->
				</div> <!-- end .row -->

				<div class="clearfix"></div>

				<h3 class="index-box-title">
					現在進んでいる案件一覧<small>様々なタイプの案件があります。</small>
				</h3>
				@foreach ($matching_policy->chunk(2) as $chunk)
				<div class="row">
					@foreach ($chunk as $val)
					<div class="col-sm-6">
						<div class="create-link-box">
		                	<a href="{{route('agency.bselect', ['policy_id' => $val->policy->id])}}"></a>
							<table class="table table-bordered subsidylist subsidylist-2">
								<tbody>
									<tr>
										<td rowspan="2">

										</td>
										<td>
											<p><span class="sidy-tbig">{{str_limit($val->policy->name,34)}}</span></p>
											<p class="text-right text-primary">
												<strong>発行機関:</strong><span>{{str_limit($val->policy->register_insti_detail,18)}}</span>/
												<strong>対象地域:</strong><span>{{str_limit($val->policy->region , 40)}}</span>
												<strong>募集時期:</strong><span>{{str_limit($val->policy->subscript_duration , 8)}}</span>
											</p>
										</td>
									</tr>
									<tr>
										<td>
											<ul class="tag-list">
												{{-- @if (request()->type !== null) --}}
												@foreach(json_decode($val->policy->tag, true) as $key => $tag)
												<li><span>{{str_limit($tag,10)}}</span></li>
												@endforeach
												{{-- @endif --}}
											</ul>
										</td>
									</tr>
									<tr>
										<td style="border-right: none"></td>
										<td style="border-left: none">
											<div class="row">
												<div class="col-sm-12">
													<p>
														{!! str_limit($val->policy->support_content, 80) !!}
													</p>
													<p>
														{!! str_limit($val->policy->support_scale, 80) !!}
													</p>
													<p>
														<span class="price_lable">{{$val->policy->acquire_budget_display}}</span>
													</p>
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
				<div class="row">
					<a href="{{route('agency.bsubsidylistaction', ['action' =>2])}}" class="btn shadowbutton btn-success index-big-button">進現在進んでいる案件をもっと見る</a>
				</div>
				<h3 class="index-box-title">
					お気に入り
				</h3>
				@foreach ($interest_policy->chunk(2) as $chunk)
				<div class="row">
					@foreach ($chunk as $val)
					<div class="col-sm-6">
						<div class="create-link-box">
		                	<a href="{{route('agency.bselect', ['policy_id' => $val->policy->id])}}"></a>
							<table class="table table-bordered subsidylist subsidylist-2">
								<tbody>
									<tr>
										<td rowspan="2">

										</td>
										<td>
											<p><span class="sidy-tbig">{{str_limit($val->policy->name,34)}}</span></p>
											<p class="text-right text-primary">
												<strong>発行機関:</strong><span>{{str_limit($val->policy->register_insti_detail,18)}}</span>/
												<strong>対象地域:</strong><span>{{str_limit($val->policy->region , 40)}}</span>
												<strong>募集時期:</strong><span>{{str_limit($val->policy->subscript_duration , 8)}}</span>
											</p>
										</td>
									</tr>
									<tr>
										<td>
											<ul class="tag-list">
												{{-- @if (request()->type !== null) --}}
												@foreach(json_decode($val->policy->tag, true) as $key => $tag)
												<li><span>{{str_limit($tag,10)}}</span></li>
												@endforeach
												{{-- @endif --}}
											</ul>
										</td>
									</tr>
									<tr>
										<td style="border-right: none"></td>
										<td style="border-left: none">
											<div class="row">
												<div class="col-sm-8">
													<p>
														{!! str_limit($val->policy->support_content, 80) !!}
													</p>
													<p>
														{!! str_limit($val->policy->support_scale, 80) !!}
													</p>
													<p>
														<span class="price_lable">{{$val->policy->acquire_budget_display}}</span>
													</p>
												</div>
												<div class="col-sm-4 text-right">
													<button type="button" class="btn btn-default btn-suggest">提案する</button>
													{!! Button::getBookmarkButton($val->policy) !!}
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
				<div class="row">
					<a href="{{route('agency.bsubsidylistaction', ['action' =>1])}}" class="btn shadowbutton btn-success index-big-button">お気に入りをもっと見る</a>
				</div>
				<h3 class="index-box-title">
					最近見た助成金・補助金
				</h3>
				@foreach ($visit_policy->chunk(2) as $chunk)
				<div class="row">
					@foreach ($chunk as $val)
					<div class="col-sm-6">
						<div class="create-link-box">
		                	<a href="{{route('agency.bselect', ['policy_id' => $val->policy->id])}}"></a>
							<table class="table table-bordered subsidylist subsidylist-2">
								<tbody>
									<tr>
										<td rowspan="2">

										</td>
										<td>
											<p><span class="sidy-tbig">{{str_limit($val->policy->name,34)}}</span></p>
											<p class="text-right text-primary">
												<strong>発行機関:</strong><span>{{str_limit($val->policy->register_insti_detail,18)}}</span>/
												<strong>対象地域:</strong><span>{{str_limit($val->policy->region , 40)}}</span>
												<strong>募集時期:</strong><span>{{str_limit($val->policy->subscript_duration , 8)}}</span>
											</p>
										</td>
									</tr>
									<tr>
										<td>
											<ul class="tag-list">
												{{-- @if (request()->type !== null) --}}
												@foreach(json_decode($val->policy->tag, true) as $key => $tag)
												<li><span>{{str_limit($tag,10)}}</span></li>
												@endforeach
												{{-- @endif --}}
											</ul>
										</td>
									</tr>
									<tr>
										<td style="border-right: none"></td>
										<td style="border-left: none">
											<div class="row">
												<div class="col-sm-8">
													<p>
														{!! str_limit($val->policy->support_content, 80) !!}
													</p>
													<p>
														{!! str_limit($val->policy->support_scale, 80) !!}
													</p>
													<p>
														<span class="price_lable">{{$val->policy->acquire_budget_display}}</span>
													</p>
												</div>
												<div class="col-sm-4 text-right">
													<button type="button" class="btn btn-default btn-suggest">提案する</button>
													{!! Button::getBookmarkButton($val->policy) !!}
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
				<div class="row">
					<a href="{{route('agency.bsubsidylistaction', ['action' =>0])}}" class="btn shadowbutton btn-success index-big-button">最近見た助成金・補助金をもっと見る </a>
				</div>
				<div class="clearfix"></div>
				<h3 class="index-box-title">
					SAMURAI ガイド<small>SAMURAIはこんなサービスを提供しています。</small>
				</h3>
				<div class="row">
					<div class="col-sm-4 index-boxcol">
						<img class="boxcol-image" src="/assets/common/images/first.png" alt="">
						<p class="boxcol-title">SAMURAI とは</p>
						<p class="boxcol-desc">SAMURAIとは、施策（助成金、補助金）のマッチングシステムです。助成金、補助金を受けたい企業×施策×士業の三者マッチングにより、中小企業のサポートをしていきます。</p>
						<a class="boxcol-link" href="#"></a>
					</div>
					<div class="col-sm-4 index-boxcol">
						<img class="boxcol-image" src="/assets/common/images/second.png" alt="">
						<p class="boxcol-title">どうやってマッチングするの?</p>
						<p class="boxcol-desc">企業のプロフィールを埋める事で現在受けられそうな施策が自動マッチングし、申請代行して頂ける方も自動マッチングします。あとは、どの士業の方に依頼するかをワンクリックで申請代行がスタートします。</p>
						<a class="boxcol-link" href="#"></a>
					</div>
					<div class="col-sm-4 index-boxcol">
						<img class="boxcol-image" src="/assets/common/images/third.png" alt="">
						<p class="boxcol-title">どうやって使うの？</p>
						<p class="boxcol-desc">はじめに、プロフィールを埋めて行きましょう！ <br>プロフィールを埋めたら、そこから申請できそうな助成金・補助金の申請代行業務がスタートします。 <br>集金の代行からも全てお任せ下さい！</p>
						<a class="boxcol-link" href="#"></a>
					</div>
				</div> <!-- end .row -->
				
				<!-- <div class="clearfix"></div>

				<h3 class="index-box-title">
					士業のブログ
				</h3>
				<a href="#" class="btn shadowbutton btn-success index-big-button">士業のブログをもっと見る</a>

				<div class="clearfix"></div> -->

				
			</div> <!-- end .col-xs-12 -->
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
				<iframe width="100%" height="100%" src="{{URL::to('/manuals/registration_policy_menu/operationlecture.html')}}" frameborder="0"></iframe>
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
	<script src="/assets/agency/js/home.js"></script>
@endsection