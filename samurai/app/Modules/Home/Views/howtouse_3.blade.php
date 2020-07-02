@extends('layouts.home')
@section('style')
	<link rel="stylesheet" href="/assets/home/css/howtouse.css">
@endsection
@section('content')
<div class="mainpage">
	<div class="page-fullwidth bg-color mgbt-30">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<p class="howtouse-title">企業の方</p>
				</div>
			</div><!-- end .row -->
		</div><!-- end .container -->
	</div><!-- end .page-fullwidth -->
	<div class="container">
		<div class="row">
			<div class="col-sm-3">
				@includeIf('Home::howtouse_menu')
			</div>
			<div class="col-sm-9">
				<p class="howtouse-content-title">③提案を選ぶ</p>
				<div class="howtouse-step">
					<h3 class="page-title">提案を確認する</h3>
					<p class="howtouse-desc">
						士業の方より提案があった場合、あなたに通知されます。<br>内容を確認して、条件交渉、マッチングを行いましょう！！
					</p>
					<p>
						<img class="img-full" src="/assets/common/images/howtouse_img3_1.jpg">
					</p>
					<p class="mgt-30">
						<label class="useredcirclenumber">1</label>
						<span class="font20"> 「マイページ」　>　「仕事管理」　>　「受けた提案」から確認できます。	<br>
							現在受けている提案の一覧が表示されますので、メッセージを確認し、士業の方と条件を決めましょう確認しましょう。<br>
						</span>
					</p>
				</div>
				<div class="text-center">
					<span class="glyphicon glyphicon-triangle-bottom"></span>
				</div>
				<div class="howtouse-step mgbt-30">
					<h3 class="page-title">提案を確認する</h3>
					<p class="howtouse-desc">
						士業の方より提案があった場合、あなたに通知されます。<br>内容を確認して、条件交渉、マッチングを行いましょう！！
					</p>
					<p>
						<img class="img-full" src="/assets/common/images/howtouse_img3_2.jpg">
					</p>
					<p class="mgt-30">
						<label class="useredcirclenumber">1</label>
						<span class="font20"> 内容を確認し、マッチングを行うにチェックを入れて、返信を行うとマッチング完了となります。<br>
							着手金がある場合は、着手金をお支払いいただき、プロジェクト開始となります。<br>
						</span>
					</p>
				</div>
			</div>
		</div><!-- end .row -->
	</div><!-- end .container -->
</div> <!-- end .mainpage -->

<div class="clearfix"></div>
@endsection
@section('script')
	<script src="/assets/home/js/howtouse.js"></script>
@endsection