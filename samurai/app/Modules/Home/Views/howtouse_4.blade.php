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
					<p class="howtouse-content-title">①プロジェクトの開始</p>
					<div class="howtouse-step">
						<h3 class="page-title">タスクが作成されます</h3>
						<p class="howtouse-desc">
							マッチングが完了した案件は、「マイページ」　>　「仕事管理」　>　「マッチング案件」に表示されます。<br>士業の方が設定したタスクを行っていきましょう！！
						</p>
						<p>
							<img class="img-full" src="/assets/common/images/howtouse_img4_1.jpg">
						</p>
						<p class="mgt-30">
							<label class="useredcirclenumber">1</label>
							<span class="font20">士業の方がタスクを設定すれば、プロジェクト開始です！！<br>
								タスクに沿って、書類作成や審査を受け、助成金・補助金取得しましょう<br><br>
								着手金が必要な場合は、着手金をお支払いいただくことで、すべての機能をご利用いただけます。<br>
							</span>
						</p>
					</div>
					<div class="text-center">
						<span class="glyphicon glyphicon-triangle-bottom"></span>
					</div>
					<div class="howtouse-step mgbt-30">
						<h3 class="page-title">着手金を支払う</h3>
						<p class="howtouse-desc">
							「マイページ」　>　「支払管理」　よりお支払い内容をご確認いただけます。<br>支払が完了するとプロジェクトが開始となります。
						</p>
						<p>
							<img class="img-full" src="/assets/common/images/howtouse_img4_2.jpg">
						</p>
						<p class="mgt-30">
							<label class="useredcirclenumber">1</label>
							<span class="font20"> お支払い内容が表示されます。 <br>
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