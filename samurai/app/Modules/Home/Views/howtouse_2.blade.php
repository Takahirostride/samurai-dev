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
				<p class="howtouse-content-title">②募集しよう</p>
				<div class="howtouse-step">
					<h3 class="page-title">助成金・補助金を選択しよう</h3>
					<p class="howtouse-desc">
						「お気に入り登録した助成金・補助金」、「自動検索で絞り込んだ助成金・補助金」、「手動検索で絞り込んだ助成金・補助金」から助成金・補助金を選択しましょう
					</p>
					<p>
						<img class="img-full" src="/assets/common/images/howtouse_img2_1.jpg">
					</p>
					<p class="mgt-30">
						<label class="useredcirclenumber">1</label>
						<span class="font20"> 助成金・補助金を選択しましょう	<br>
							選択方法は、「提案を検討リストから」「お気に入り登録したリストから」、「自動検索で絞り込んだ助成金・補助金から」、「手動検索で絞り込んだ助成金・補助金から」選択することができます。<br>
						</span>
					</p>
				</div>
				<div class="text-center">
					<span class="glyphicon glyphicon-triangle-bottom"></span>
				</div>
				<div class="howtouse-step mgbt-30">
					<h3 class="page-title">募集内容を入力しよう</h3>
					<p class="howtouse-desc">
						あなたが、取得したい助成金・補助金の募集内容を入力しましょう。<br>
						詳細な条件を入力した方が、より適切な提案をうけることができます。
					</p>
					<table class="table-howtouse">
						<tbody>
							<tr>
								<td class="td-max">
									<img class="img-full" src="/assets/common/images/howtouse_img2_2.jpg">
								</td>
								<td>
									<label class="useredcirclenumber">1</label>
									<span> 以下の内容を入力して、募集を行います。<br>
									募集タイトル　：　依頼内容が分かるタイトルを記載しましょう<br>
									募集の目的　　：　どのような業務を依頼したいのかを詳細に記載しましょう<br>
									重視する点　　：　評価・実績、価格、などあなたが重視する点を記載しましょう<br>
									補足説明　　　：　登録後、補足が必要な場合に記載します。<br>
									添付ファイル　：　添付ファイルがあれば利用できます。<br>
									募集の締め切り：　募集の締め切り日を設定してください。<br>
									</span><br><br>
									<label class="useredcirclenumber">2</label>
									<span> 希望の費用を設定します。<br>
									</span><br><br>
									<label class="useredcirclenumber">3</label>
									<span> 有料オプションの設定を行います。<br>
									非公開で募集を行いたい方、急ぎの募集の方、士業の方に一斉通知を行いたい方は、別途費用をお支払いいただくことで、設定ができます。<br>
									</span><br><br>
								</td>
							</tr>
						</tbody>
					</table>
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