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
					<p class="howtouse-content-title">②計画の進行</p>
					<div class="howtouse-step mgbt-30">
						<h3 class="page-title">タスクを進めましょう</h3>
						<p class="howtouse-desc">
							「マイページ」　>「マイページ」　>　「仕事管理」　>　「マッチング案件」>　「タスクを見る」に表示されます。<br>士業の方が設定したタスクが表示されていますので、タスクを進めましょう！！
						</p>
						<p>
							<img class="img-full" src="/assets/common/images/howtouse_img5_1.jpg">
						</p>
						<p class="mgt-30">
							<label class="useredcirclenumber">1</label>
							<span class="font20"> 　士業の方が設定したタスクの一覧が表示されます。<br>助成金・補助金を取得するまでの流れを確認することができます。<br>現在の日程は、青いマークで表示されます。<br>
							</span>
						</p>
						<p class="mgt-30">
							<label class="useredcirclenumber">2</label>
							<span class="font20"> 　申請書類の管理を行うことができます。<br>士業の方が、用意した書類に入力して、アップロードを行ってください。<br>
							</span>
						</p>
						<p class="mgt-30">
							<label class="useredcirclenumber">3</label>
							<span class="font20"> 　メール送信を行うことができます。<br>
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