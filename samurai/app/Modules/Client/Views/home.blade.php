@extends('layouts.home')
@section('style')
	<link rel="stylesheet" href="{{ asset('assets/client/css/f_search.css?v='.time()) }}">
@endsection
@section('content')
<div class="mainpage">
	<div class="page-fullwidth">
		<div class="jumbotron jumbotron-home">
			<div class="jumbotron-button-list">
				<div class="row">
					<div class="col-sm-offset-1 col-sm-5">
						<p class="jumbotron-text">助成金・補助金検索</p>
						<a href="{{route('client.Fsubsidylist')}}" class="btn btn-primary shadowbuttonblue bg_green mgt-30"  data-toggle="tooltip" data-placement="bottom" {{-- data-original-title="あなたが対応可能な施策（助成金・補助金）を登録することで、事業者から検索されやすくなります。またSAMURAIに登録されていない施策をあなたが登録すること優先的に仕事依頼が来ます。" --}}>
							<span class="tbig">助成金申請</span>
							<span class="tsmall">プロフィールの情報から<br>自動検索と手動検索できます</span>
						</a>
					</div>
					<div class="col-sm-5">
						<p class="jumbotron-text">企業の依頼を見る</p>
						<a href="{{URL::route('client.recruitment.submitrq')}}" class="btn btn-primary shadowbuttonblue bg_green mgt-30"  data-toggle="tooltip"{{--  data-placement="bottom" data-original-title="あなたが対応可能な施策（助成金・補助金）を登録することで、事業者から検索されやすくなります。またSAMURAIに登録されていない施策をあなたが登録すること優先的に仕事依頼が来ます。" --}}>
							<span class="tbig">その他仕事依頼</span>
							<span class="tsmall">依頼したい仕事を投稿して<br/>連絡を待ちましょう</span>
						</a>
					</div>
				</div>												
			</div>
		</div> <!-- end .jumbotron -->
	</div> <!-- end .col-sm-12 -->
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="bl-notify">
					<h3 class="index-box-title">お知らせ</h3>
					@if($notification)
					<table class="table table-hover table-bordered">
						<tbody>
							@foreach($notification as $no)
							<tr>
								<td width="15%">{{ date('Y年m月d日', strtotime($no->created_date) ) }}</td>
								{{-- <td><a href="{{URL::route('client.notify', [$no->id] )}}">{{ $no->title }}</a></td> --}}
								<td>{{ $no->title }}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					@endif
				</div>								
				<div class="row">
					<div class="col-sm-12">
						<div class="notify-list">
							<p class="nf1">スキルセットを登録しましょう！</p>
							<p class="nf2">能力をアピールして自分に合った仕事を探しましょう！</p>
							<p class="nf3">過去の実績や得意分野を登録しておくことで、企業からの仕事依頼が格段に増えます。 <br>出来るだけ細かく得意分野、受注できる仕事を書いておきましょう！</p>
							<p><a href="{{url('/client/mypage/home')}}" class="btn btn-primary shadowbuttonblue">スキルセットの登録をする</a></p>
							
						</div><!-- end .notify-list -->
					</div><!-- end .col-sm-12 -->
				</div> <!-- end .row -->

				<div class="clearfix"></div>
				<div class="olblocks">
					<h3 class="index-box-title">
						現在進んでいる案件一覧<small>様々なタイプの案件があります。</small>
					</h3>	
					<div class="row flex-contain bl_policy_small">
						@foreach ($p_hires as $hire)
							<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
								@include('Client::Fpage.detail_policy',['val'=>$hire->policy])
							</div>							
						@endforeach
					</div>	
					<div class="row">
						<a href="{{route('client.doing')}}" class="btn shadowbutton btn-success index-big-button">進現在進んでいる案件をもっと見る</a>
					</div>								
				</div>
				<div class="olblocks">
					<h3 class="index-box-title">
						お気に入り
					</h3>	
					<div class="row flex-contain bl_policy_small">
						@foreach ($p_bookmarks as $bmark)
							<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
								@include('Client::Fpage.content_policy',['val'=>$bmark])
							</div>							
						@endforeach
					</div>	
					<div class="row">
						<a href="{{route('client.bookmark')}}" class="btn shadowbutton btn-success index-big-button">お気に入りをもっと見る</a>
					</div>								
				</div>
				<div class="olblocks">
					<h3 class="index-box-title">
						最近見た助成金・補助金
					</h3>	
					<div class="row flex-contain bl_policy_small">
						@foreach ($p_visits as $visit)
							<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
								@include('Client::Fpage.content_policy',['val'=>$visit->policy])
							</div>							
						@endforeach
					</div>
					<div class="row">
						<a href="{{route('client.visit')}}" class="btn shadowbutton btn-success index-big-button">最近見た助成金・補助金をもっと見る</a>
					</div>										
				</div>
				<div class="block_about">
					<h3 class="index-box-title">
						SAMURAI ガイド<small>SAMURAIはこんなサービスを提供しています。</small>
					</h3>
					<div class="row">
						<div class="col-sm-4 index-boxcol">
							<img class="boxcol-image" src="/assets/common/images/first.png" alt="">
							<p class="boxcol-title">SAMURAI とは</p>
							<p class="">SAMURAIとは、施策（助成金、補助金）のマッチングシステムです。助成金、補助金を受けたい企業×施策×士業の三者マッチングにより、中小企業のサポートをしていきます。</p>
							<a class="boxcol-link" href="{{url('/whatissamurai')}}"></a>
						</div>
						<div class="col-sm-4 index-boxcol">
							<img class="boxcol-image" src="/assets/common/images/second.png" alt="">
							<p class="boxcol-title">どうやってマッチングするの?</p>
							<p class="">企業のプロフィールを埋める事で現在受けられそうな施策が自動マッチングし、申請代行して頂ける方も自動マッチングします。あとは、どの士業の方に依頼するかをワンクリックで申請代行がスタートします。</p>
							<a class="boxcol-link" href="{{url('/howtomatching')}}"></a>
						</div>
						<div class="col-sm-4 index-boxcol">
							<img class="boxcol-image" src="/assets/common/images/third.png" alt="">
							<p class="boxcol-title">どうやって使うの？</p>
							<p class="">はじめに、プロフィールを埋めて行きましょう！ <br>プロフィールを埋めたら、そこから申請できそうな助成金・補助金の申請代行業務がスタートします。 <br>集金の代行からも全てお任せ下さい！</p>
							<a class="boxcol-link" href="{{url('/howtouse')}}"></a>
						</div>
					</div> <!-- end .row -->					
				</div>

			</div> <!-- end .col-xs-12 -->
		</div> <!-- end .row -->
		</div> <!-- end .container -->
</div> <!-- end .mainpage -->
<div class="clearfix"></div>
<div class="modal fade" id="lock_Modal" data-toggle="modal" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-dialog-full" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<div class="row">
				    <div class="col-sm-offset-2 col-sm-8">
				        <div class="breportcompletion">
				            <div class="pd40 font25">
				                <p>
									このアカウントは、SAMURAIの利用規約に反する行為、<br>
									またはそのおそれがある行為が確認された為停止されました。<br>
									以下の窓口までお問い合わせください。<br><br>

									SAMURAIサポート係　　ihanhoukoku@samurai-match.jp
								</p>
				            </div>
				        </div>
				    </div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
	<script src="/assets/client/js/home.js"></script>
	@if(\Request::route()->getName() == 'client.F0_lock') {
		<script>
			$(document).ready(function(){
				$('#lock_Modal').modal('show');
				$('#lock_Modal').modal({backdrop: 'static', keyboard: false});
			});
		</script>
	}
	@endif;
@endsection