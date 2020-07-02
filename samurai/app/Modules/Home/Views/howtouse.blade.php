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
				<p class="howtouse-content-title">①依頼しよう</p>
				<div class="howtouse-step">
					<h3 class="page-title">プロフィールを入力しよう</h3>
					
					<p class="howtouse-desc">
						プロフィールを入力すると、プロフィール内容から、自動であなたに合った助成金・補助金を表示します。<br>
						また、士業からの提案を受けることができるようになるので、助成金・補助金の取得がよりしやすくなります。
					</p>
					<table class="table-howtouse">
						<tbody>
							<tr>
								<td class="td-max">
									<img class="img-full" src="/assets/common/images/howtouse_img1_1.jpg">
								</td>
								<td>
									<label class="useredcirclenumber">1</label>
									<span> 「マイページ」の「プロフィール管理」よりプロフィールの設定を行います。
									</span><br><br>
									<label class="useredcirclenumber">2</label>
									<span> ・プロフィール<br>
										あなたの企業情報をご入力ください。<br>
										・評価、実績<br>
										あなたの助成金の取得依頼の評価、実績が表示されます。<br>
										・希望内容<br>
										あなたが取得したい助成金・補助金の内容をご入力ください。入力内容により、自動であなたに適切な助成金・補助金内容を表示します。<br>
										また、士業の方より、あなたの希望に合った、助成金・補助金の提案が受けることができます。<br>
										・募集案件<br>
										あなたが士業の方に向けて募集をしている助成金・補助金の内容が記載されています。<br>
										※詳細は、「②募集をしよう」の項目をご覧ください
									</span><br><br>
									<label class="useredcirclenumber">3</label>
									<span> あなたが希望する費用の目安を記載します。<br>
										この金額で決定ではなく、最終的な金額は、士業の方と交渉し、金額を決定します。
									</span><br><br>
									<label class="useredcirclenumber">4</label>
									<span> あなたが取得した助成金の詳細な内容を記載します。<br>
										カテゴリーや、あなたの会社の規模など、質問に回答をすることで、あなたに最適な助成金・補助金が表示されます。<br>
										不明な項目や、関係のない項目は空欄にしておいてください。
									</span><br>
								</td>
							</tr>
						</tbody>
					</table>
					<p class="howtouse-point">
						<span>ここがポイント！</span>
						・希望内容を入力することで、検索条件の入力がいらない自動検索が利用できて簡単検索！！<br>
						・士業からの提案も受けることができるようになります！！
					</p>
				</div>
				<div class="text-center">
					<span class="glyphicon glyphicon-triangle-bottom"></span>
				</div>
				<div class="howtouse-step">
					<h3 class="page-title">検索をしよう</h3>
					
					<p class="howtouse-desc">
						自動検索、もしくは検索項目を入力して助成金・補助金を検索することができます。<br>
						取得したい助成金・補助金の金額、地域、内容、業種などを設定し検索できます。
					</p>
					<table class="table-howtouse">
						<tbody>
							<tr>
								<td class="td-max">
									<img class="img-full" src="/assets/common/images/howtouse_img1_2.jpg">
								</td>
								<td>
									<label class="useredcirclenumber">1</label>
									<span>
									　　	手動検索<br>
										取得したい、助成金・補助金の内容を選択してください。<br><br>

										自動検索<br>
										プロフィールを入力している場合は、自動検索ボタンで簡単ワンクリック検索が可能です！！
									</span>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="text-center">
					<span class="glyphicon glyphicon-triangle-bottom"></span>
				</div>
				<div class="howtouse-step">
					<h3 class="page-title">助成金・補助金 / 士業を選ぼう</h3>
					
					<p class="howtouse-desc">
						自動検索、もしくは検索項目を入力して助成金・補助金を検索することができます。<br>
						取得したい助成金・補助金の金額、地域、内容、業種などを設定し検索できます。
					</p>
					<p>
						<img class="img-full" src="/assets/common/images/howtouse_img1_3.jpg">
					</p>
					<p class="mgt-30">
						<label class="useredcirclenumber">1</label>
						<span class="font20"> あなたの入力した条件に一致した助成金・補助金の一覧が表示されます。<br>
							施策名　：　助成金・補助金の名称<br>
							登録機関：　助成金・補助金の監督省庁<br>
							募集期間：　取得可能な時期<br>
							施策内容：　助成金・補助金の内容が表示されます。<br>
							取得可能金額：　あなたの申請内容により取得可能金額が変わりますが、目安を記載しています。<br><br>

							お気に入り登録（非表示）設定<br>
							提案を検討：　すぐに取得したい、また、取得に向けて具体的に話を聞きたい、場合に選択します。<br>
							　　　　　　　この項目にチェックをいれていると、士業より提案を受けやすくなります。<br>
							興味あり　：　再度確認したい場合など、興味のある助成金・補助金として保存しておくことができます。<br>
							非表示　　：　必要のない助成金・補助金、また既に取得している助成金・補助金などの場合、この項目にチェックを入れると非表示となります。<br>
						</span>
					</p>
					<p class="mgt-30">
						<label class="useredcirclenumber">2</label>
						<span class="font20">
							<label class="useredcirclenumbersmall">1</label>
							に表示されている助成金・補助金に、「対応可能な士業の方の人数」と、「おススメの士業の方」が表示されています。<br>
							士業の方をチェックして、実績、料金、連絡方法などさまざまな条件を確認してみましょう。<br>
							また、おススメの士業の下には、それぞれの助成金・補助金取得時におススメの「人材、設備、備品」が表示されています。<br>
							助成金・補助金取得に対応している「人材、設備、備品」の詳細が知りたい場合にご覧ください。<br>
						</span>
					</p>
					<p class="howtouse-point">
						<span>ここがポイント！</span>
						・お気に入り登録をして、あなたが助成金・補助金取得に興味があることを伝えましょう！！<br>
						・取得に必要な情報がすべて掲載されています。
					</p>
				</div>
				<div class="text-center">
					<span class="glyphicon glyphicon-triangle-bottom"></span>
				</div>
				<div class="howtouse-step mgbt-30">
					<h3 class="page-title">依頼をしよう</h3>
					
					<p class="howtouse-desc">
						士業を選択して、希望条件を設定し、依頼を送信しましょう<br>
						複数人に依頼内容を送信することが可能です
					</p>
					<p>
						<img class="img-full" src="/assets/common/images/howtouse_img1_4.jpg">
					</p>
					<p class="mgt-30">
						<label class="useredcirclenumber">1</label>
						<span class="font20"> 依頼内容を入力しましょう	<br>
							複数人に依頼内容を送信することも可能です。<br>
						</span>
					</p>
					<p class="mgt-30">
						<label class="useredcirclenumber">2</label>
						<span class="font20">
							希望の依頼業務内容と金額を記入しましょう<br>
							依頼内容、金額を登録しておくと便利です。<br>
						</span>
					</p>
					<p class="mgt-30">
						<label class="useredcirclenumber">3</label>
						<span class="font20">
							 依頼したい士業の方が表示されます<br>
							チェックされている士業の方に依頼内容が送信されます。 <br>
						</span>
					</p>
				</div>
			</div>
		</div><!-- end .row -->
	</div><!-- end .container -->
</div> <!-- end .mainpage -->
@endsection
@section('script')
	<script src="/assets/home/js/howtouse.js"></script>
@endsection