@extends('layouts.home')
@section('style')
	<link rel="stylesheet" href="/assets/user/agency/css/m_search.css">
@endsection
@section('content')
<div class="mainpage">
			<div class="page-fullwidth">
				<div class="jumbotron jumbotron-home">
					<div class="jumbotron-button-list">
						<p class="jumbotron-text">助成金・補助金検索</p>
						<img src="/assets/common/images/manual.png" style="cursor:pointer;" height="40px" data-toggle="modal" data-target="#modal-auto-search-menu">
						<a href="#" class="btn btn-success shadowbutton">
							<span class="tbig">企業自動検索 </span>
							<span class="tsmall">施策と事業者を検索 </span>
						</a>
						<a href="#" class="btn btn-success shadowbutton">
							<span class="tbig">手動検索 </span>
							<span class="tsmall">助成金・補助金を<br>手動で検索</span>
						</a>
						<a href="#" class="btn btn-success shadowbutton">
							<span class="tbig">事業者検索 </span>
							<span class="tsmall">サイトに登録している<br>事業者を検索</span>
						</a>
						<p class="jumbotron-text">仕事を増やす</p>
						<a href="#myModal" data-toggle="modal" data-target="#myModal"><img src="/assets/common/images/manual.png" style="cursor:pointer;" height="40px"></a>
						<a href="#" class="btn btn-primary shadowbuttonblue">
							<span class="tbig">施策登録 </span>
							<span class="tsmall">対応できる施策を登録</span>
						</a>
						<a href="#" class="btn btn-primary shadowbuttonblue">
							<span class="tbig">協業案件 </span>
							<span class="tsmall">他の士業の人が出し<br>ている仕事一覧</span>
						</a>
					</div>
				</div> <!-- end .jumbotron -->
		</div> <!-- end .col-sm-12 -->
		<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h3 class="index-box-title">
					お知らせ
				</h3>
				<a href="#" class="notify-list-a">すべてのお知らせを見る</a>
				<div class="row">
					<div class="col-sm-12">
						<div class="notify-list">
							<p class="nf1">スキルセットを登録しましょう！
								<a href="#myModal" data-toggle="modal" data-target="#myModal"><img src="/assets/common/images/manual.png" style="cursor:pointer;" height="40px"></a>
							</p>
							<p class="nf2">能力をアピールして自分に合った仕事を探しましょう！</p>
							<p class="nf3">過去の実績や得意分野を登録しておくことで、企業からの仕事依頼が格段に増えます。 出来るだけ細かく得意分野、受注できる仕事を書いておきましょう！</p>
							<a href="#" class="btn btn-primary shadowbuttonblue">士業情報を登録する</a>
						</div><!-- end .notify-list -->
					</div><!-- end .col-sm-12 -->
				</div> <!-- end .row -->


				<div class="clearfix"></div>

				<h3 class="index-box-title">
					最近見た助成金・補助金<small>様々なタイプの案件があります。</small>
				</h3>
				<div class="row">
					<div class="col-sm-6 index-boxcol2">
						<div class="row">
							<div class="col-sm-12">
								<div class="index-boxcol2-sub">
									<div class="create-link-box">
										<a href="#"></a>
										<div class="left-boxcol2">
											<img src="/assets/common/images/agency-list-01.jpg" alt="">
										</div>
										<div class="right-boxcol2">

											<p>
												<a href="#">機能性表示食品届出支援事業費補助金<br>登録機関:佐賀県  / 募集時期:平成30年5月...</a>
												<span>機能性・健康食品の事業化において、県内事業者が機能性表示食品の届出をする際に必要な費用の一部を補...</span>
											</p>
										</div>
									</div> <!-- end .create-link-box -->
									
									<div class="middle-boxcol2">
										<ul>
											<li><button type="button" class="btn btn-default btn-style-grey" data-toggle="tooltip" data-placement="bottom" title="お気に入りボタンの１つで、興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。">提案を検討</button></li>
											<li><button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="お気に入りボタンの１つで、興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。">興味あり</button></li>
											<li><button type="button" class="btn btn-default btn-style-grey" data-toggle="tooltip" data-placement="bottom" title="必要がない、自分に関係がない施策が表示された場合は、非表示としてください。非表示とすることで自動検索であなたに関連しない施策が表示されなくなります。">非表示</button></li>
										</ul>
										<p class="jprice">融資支援</p>
									</div> <!-- end .middle-boxcol2 -->
								</div> <!-- end .index-boxcol2-sub -->
								<div class="index-boxcol2-sub">
									<div class="create-link-box">
										<a href="#"></a>
										<div class="left-boxcol2">
											<img src="/assets/common/images/agency-list-02.jpg" alt="">
										</div>
										<div class="right-boxcol2">

											<p>
												<a href="#">機能性表示食品届出支援事業費補助金<br>登録機関:佐賀県  / 募集時期:平成30年5月...</a>
												<span>機能性・健康食品の事業化において、県内事業者が機能性表示食品の届出をする際に必要な費用の一部を補...</span>
											</p>
										</div>
									</div> <!-- end .create-link-box -->
									
									<div class="middle-boxcol2">
										<ul>
											<li><button type="button" class="btn btn-default btn-style-grey" data-toggle="tooltip" data-placement="bottom" title="お気に入りボタンの１つで、興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。">提案を検討</button></li>
											<li><button type="button" class="btn btn-default btn-style-grey" data-toggle="tooltip" data-placement="bottom" title="お気に入りボタンの１つで、興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。">興味あり</button></li>
											<li><button type="button" class="btn btn-default btn-style-grey" data-toggle="tooltip" data-placement="bottom" title="お気に入りボタンの１つで、興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。">非表示</button></li>
										</ul>
										<p class="jprice">取得可能金額:57万円</p>
									</div> <!-- end .middle-boxcol2 -->
								</div> <!-- end .index-boxcol2-sub -->

							</div> <!-- end .col-sm-12 -->
						</div> <!-- end .row -->
					</div> <!-- end .index-boxcol2 -->
					<div class="col-sm-6 index-boxcol2">
						<div class="row">
							<div class="col-sm-12">
								<div class="index-boxcol2-sub">
									<div class="create-link-box">
										<a href="#"></a>
										<div class="left-boxcol2">
											<img src="/assets/common/images/agency-list-03.jpg" alt="">
										</div>
										<div class="right-boxcol2">

											<p>
												<a href="#">機能性表示食品届出支援事業費補助金<br>登録機関:佐賀県  / 募集時期:平成30年5月...</a>
												<span>機能性・健康食品の事業化において、県内事業者が機能性表示食品の届出をする際に必要な費用の一部を補...</span>
											</p>
										</div>
									</div> <!-- end .create-link-box -->
									
									<div class="middle-boxcol2">
										<ul>
											<li><button type="button" class="btn btn-default btn-style-grey" data-toggle="tooltip" data-placement="bottom" title="お気に入りボタンの１つで、興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。">提案を検討</button></li>
											<li><button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="お気に入りボタンの１つで、興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。">興味あり</button></li>
											<li><button type="button" class="btn btn-default btn-style-grey" data-toggle="tooltip" data-placement="bottom" title="お気に入りボタンの１つで、興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。">非表示</button></li>
										</ul>
										<p class="jprice">融資支援</p>
									</div> <!-- end .middle-boxcol2 -->
								</div> <!-- end .index-boxcol2-sub -->
								<div class="index-boxcol2-sub">
									<div class="create-link-box">
										<a href="#"></a>
										<div class="left-boxcol2">
											<img src="/assets/common/images/agency-list-04.jpg" alt="">
										</div>
										<div class="right-boxcol2">

											<p>
												<a href="#">機能性表示食品届出支援事業費補助金<br>登録機関:佐賀県  / 募集時期:平成30年5月...</a>
												<span>機能性・健康食品の事業化において、県内事業者が機能性表示食品の届出をする際に必要な費用の一部を補...</span>
											</p>
										</div>
									</div> <!-- end .create-link-box -->
									
									<div class="middle-boxcol2">
										<ul>
											<li><button type="button" class="btn btn-default btn-style-grey" data-toggle="tooltip" data-placement="bottom" title="お気に入りボタンの１つで、興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。">提案を検討</button></li>
											<li><button type="button" class="btn btn-default btn-style-grey" data-toggle="tooltip" data-placement="bottom" title="お気に入りボタンの１つで、興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。">興味あり</button></li>
											<li><button type="button" class="btn btn-default btn-style-grey" data-toggle="tooltip" data-placement="bottom" title="お気に入りボタンの１つで、興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。">非表示</button></li>
										</ul>
										<p class="jprice">取得可能金額:57万円</p>
									</div> <!-- end .middle-boxcol2 -->
								</div> <!-- end .index-boxcol2-sub -->

							</div> <!-- end .col-sm-12 -->
						</div>
					</div> <!-- end .index-boxcol2 -->
					<div class="clearfix"></div>
					<a href="#" class="btn shadowbutton btn-success index-big-button">助成金・補助金をもっと見る</a>
				</div> <!-- end .row -->


				<h3 class="index-box-title">
					お気に入りの助成金・補助金<small>様々なタイプの案件があります。</small>
				</h3>
				<div class="row">
					<div class="col-sm-6 index-boxcol2">
						<div class="row">
							<div class="col-sm-12">
								<div class="index-boxcol2-sub">
									<div class="create-link-box">
										<a href="#"></a>
										<div class="left-boxcol2">
											<img src="/assets/common/images/agency-list-01.jpg" alt="">
										</div>
										<div class="right-boxcol2">

											<p>
												<a href="#">機能性表示食品届出支援事業費補助金<br>登録機関:佐賀県  / 募集時期:平成30年5月...</a>
												<span>機能性・健康食品の事業化において、県内事業者が機能性表示食品の届出をする際に必要な費用の一部を補...</span>
											</p>
										</div>
									</div> <!-- end .create-link-box -->
									
									<div class="middle-boxcol2">
										<ul>
											<li><button type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="お気に入りボタンの１つで、興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。">提案を検討</button></li>
											<li><button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="お気に入りボタンの１つで、興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。">興味あり</button></li>
											<li><button type="button" class="btn btn-default btn-style-grey" data-toggle="tooltip" data-placement="bottom" title="お気に入りボタンの１つで、興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。">非表示</button></li>
										</ul>
										<p class="jprice">融資支援</p>
									</div> <!-- end .middle-boxcol2 -->
								</div> <!-- end .index-boxcol2-sub -->
								<div class="index-boxcol2-sub">
									<div class="create-link-box">
										<a href="#"></a>
										<div class="left-boxcol2">
											<img src="/assets/common/images/agency-list-02.jpg" alt="">
										</div>
										<div class="right-boxcol2">

											<p>
												<a href="#">機能性表示食品届出支援事業費補助金<br>登録機関:佐賀県  / 募集時期:平成30年5月...</a>
												<span>機能性・健康食品の事業化において、県内事業者が機能性表示食品の届出をする際に必要な費用の一部を補...</span>
											</p>
										</div>
									</div> <!-- end .create-link-box -->
									
									<div class="middle-boxcol2">
										<ul>
											<li><button type="button" class="btn btn-default btn-style-grey" data-toggle="tooltip" data-placement="bottom" title="お気に入りボタンの１つで、興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。">提案を検討</button></li>
											<li><button type="button" class="btn btn-default btn-style-grey" data-toggle="tooltip" data-placement="bottom" title="お気に入りボタンの１つで、興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。">興味あり</button></li>
											<li><button type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="お気に入りボタンの１つで、興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。">非表示</button></li>
										</ul>
										<p class="jprice">取得可能金額:57万円</p>
									</div> <!-- end .middle-boxcol2 -->
								</div> <!-- end .index-boxcol2-sub -->

							</div> <!-- end .col-sm-12 -->
						</div> <!-- end .row -->
					</div> <!-- end .index-boxcol2 -->
					<div class="col-sm-6 index-boxcol2">
						<div class="row">
							<div class="col-sm-12">
								<div class="index-boxcol2-sub">
									<div class="create-link-box">
										<a href="#"></a>
										<div class="left-boxcol2">
											<img src="/assets/common/images/agency-list-03.jpg" alt="">
										</div>
										<div class="right-boxcol2">

											<p>
												<a href="#">機能性表示食品届出支援事業費補助金<br>登録機関:佐賀県  / 募集時期:平成30年5月...</a>
												<span>機能性・健康食品の事業化において、県内事業者が機能性表示食品の届出をする際に必要な費用の一部を補...</span>
											</p>
										</div>
									</div> <!-- end .create-link-box -->
									
									<div class="middle-boxcol2">
										<ul>
											<li><button type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="お気に入りボタンの１つで、興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。">提案を検討</button></li>
											<li><button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="お気に入りボタンの１つで、興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。">興味あり</button></li>
											<li><button type="button" class="btn btn-default btn-style-grey" data-toggle="tooltip" data-placement="bottom" title="お気に入りボタンの１つで、興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。">非表示</button></li>
										</ul>
										<p class="jprice">融資支援</p>
									</div> <!-- end .middle-boxcol2 -->
								</div> <!-- end .index-boxcol2-sub -->
								<div class="index-boxcol2-sub">
									<div class="create-link-box">
										<a href="#"></a>
										<div class="left-boxcol2">
											<img src="/assets/common/images/agency-list-04.jpg" alt="">
										</div>
										<div class="right-boxcol2">

											<p>
												<a href="#">機能性表示食品届出支援事業費補助金<br>登録機関:佐賀県  / 募集時期:平成30年5月...</a>
												<span>機能性・健康食品の事業化において、県内事業者が機能性表示食品の届出をする際に必要な費用の一部を補...</span>
											</p>
										</div>
									</div> <!-- end .create-link-box -->
									
									<div class="middle-boxcol2">
										<ul>
											<li><button type="button" class="btn btn-default btn-style-grey" data-toggle="tooltip" data-placement="bottom" title="お気に入りボタンの１つで、興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。">提案を検討</button></li>
											<li><button type="button" class="btn btn-default btn-style-grey" data-toggle="tooltip" data-placement="bottom" title="お気に入りボタンの１つで、興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。">興味あり</button></li>
											<li><button type="button" class="btn btn-default btn-style-grey" data-toggle="tooltip" data-placement="bottom" title="お気に入りボタンの１つで、興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。">非表示</button></li>
										</ul>
										<p class="jprice">取得可能金額:57万円</p>
									</div> <!-- end .middle-boxcol2 -->
								</div> <!-- end .index-boxcol2-sub -->

							</div> <!-- end .col-sm-12 -->
						</div>
					</div> <!-- end .index-boxcol2 -->
					<div class="clearfix"></div>
					<a href="#" class="btn shadowbutton btn-success index-big-button">助成金・補助金をもっと見る</a>
				</div> <!-- end .row -->


				<h3 class="index-box-title">
					現在進んでいる案件一覧<small>様々なタイプの案件があります。</small>
				</h3>
				<div class="row">
					<div class="col-sm-6 index-boxcol2">
						<div class="row">
							<div class="col-sm-12">
								<div class="index-boxcol2-sub">
									<div class="create-link-box">
										<a href="#"></a>
										<div class="left-boxcol2">
											<img src="/assets/common/images/agency-list-01.jpg" alt="">
										</div>
										<div class="right-boxcol2">

											<p>
												<a href="#">機能性表示食品届出支援事業費補助金<br>登録機関:佐賀県  / 募集時期:平成30年5月...</a>
												<span>機能性・健康食品の事業化において、県内事業者が機能性表示食品の届出をする際に必要な費用の一部を補...</span>
											</p>
										</div>
									</div> <!-- end .create-link-box -->
									
									<div class="middle-boxcol2">
										<ul>
											<li><button type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="お気に入りボタンの１つで、興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。">提案を検討</button></li>
											<li><button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="お気に入りボタンの１つで、興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。">興味あり</button></li>
											<li><button type="button" class="btn btn-default btn-style-grey" data-toggle="tooltip" data-placement="bottom" title="お気に入りボタンの１つで、興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。">非表示</button></li>
										</ul>
										<p class="jprice">融資支援</p>
									</div> <!-- end .middle-boxcol2 -->
								</div> <!-- end .index-boxcol2-sub -->
								<div class="index-boxcol2-sub">
									<div class="create-link-box">
										<a href="#"></a>
										<div class="left-boxcol2">
											<img src="/assets/common/images/agency-list-02.jpg" alt="">
										</div>
										<div class="right-boxcol2">

											<p>
												<a href="#">機能性表示食品届出支援事業費補助金<br>登録機関:佐賀県  / 募集時期:平成30年5月...</a>
												<span>機能性・健康食品の事業化において、県内事業者が機能性表示食品の届出をする際に必要な費用の一部を補...</span>
											</p>
										</div>
									</div> <!-- end .create-link-box -->
									
									<div class="middle-boxcol2">
										<ul>
											<li><button type="button" class="btn btn-default btn-style-grey" data-toggle="tooltip" data-placement="bottom" title="お気に入りボタンの１つで、興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。">提案を検討</button></li>
											<li><button type="button" class="btn btn-default btn-style-grey" data-toggle="tooltip" data-placement="bottom" title="お気に入りボタンの１つで、興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。">興味あり</button></li>
											<li><button type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="お気に入りボタンの１つで、興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。">非表示</button></li>
										</ul>
										<p class="jprice">取得可能金額:57万円</p>
									</div> <!-- end .middle-boxcol2 -->
								</div> <!-- end .index-boxcol2-sub -->

							</div> <!-- end .col-sm-12 -->
						</div> <!-- end .row -->
					</div> <!-- end .index-boxcol2 -->
					<div class="col-sm-6 index-boxcol2">
						<div class="row">
							<div class="col-sm-12">
								<div class="index-boxcol2-sub">
									<div class="create-link-box">
										<a href="#"></a>
										<div class="left-boxcol2">
											<img src="/assets/common/images/agency-list-03.jpg" alt="">
										</div>
										<div class="right-boxcol2">

											<p>
												<a href="#">機能性表示食品届出支援事業費補助金<br>登録機関:佐賀県  / 募集時期:平成30年5月...</a>
												<span>機能性・健康食品の事業化において、県内事業者が機能性表示食品の届出をする際に必要な費用の一部を補...</span>
											</p>
										</div>
									</div> <!-- end .create-link-box -->
									
									<div class="middle-boxcol2">
										<ul>
											<li><button type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="お気に入りボタンの１つで、興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。">提案を検討</button></li>
											<li><button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="お気に入りボタンの１つで、興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。">興味あり</button></li>
											<li><button type="button" class="btn btn-default btn-style-grey" data-toggle="tooltip" data-placement="bottom" title="お気に入りボタンの１つで、興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。">非表示</button></li>
										</ul>
										<p class="jprice">融資支援</p>
									</div> <!-- end .middle-boxcol2 -->
								</div> <!-- end .index-boxcol2-sub -->
								<div class="index-boxcol2-sub">
									<div class="create-link-box">
										<a href="#"></a>
										<div class="left-boxcol2">
											<img src="/assets/common/images/agency-list-04.jpg" alt="">
										</div>
										<div class="right-boxcol2">

											<p>
												<a href="#">機能性表示食品届出支援事業費補助金<br>登録機関:佐賀県  / 募集時期:平成30年5月...</a>
												<span>機能性・健康食品の事業化において、県内事業者が機能性表示食品の届出をする際に必要な費用の一部を補...</span>
											</p>
										</div>
									</div> <!-- end .create-link-box -->
									
									<div class="middle-boxcol2">
										<ul>
											<li><button type="button" class="btn btn-default btn-style-grey" data-toggle="tooltip" data-placement="bottom" title="お気に入りボタンの１つで、興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。">提案を検討</button></li>
											<li><button type="button" class="btn btn-default btn-style-grey" data-toggle="tooltip" data-placement="bottom" title="お気に入りボタンの１つで、興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。">興味あり</button></li>
											<li><button type="button" class="btn btn-default btn-style-grey" data-toggle="tooltip" data-placement="bottom" title="お気に入りボタンの１つで、興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。">非表示</button></li>
										</ul>
										<p class="jprice">取得可能金額:57万円</p>
									</div> <!-- end .middle-boxcol2 -->
								</div> <!-- end .index-boxcol2-sub -->

							</div> <!-- end .col-sm-12 -->
						</div>
					</div> <!-- end .index-boxcol2 -->
					<div class="clearfix"></div>
					<a href="#" class="btn shadowbutton btn-success index-big-button">現在進んでいる案件をもっと見る</a>
				</div> <!-- end .row -->
				



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
				
				<div class="clearfix"></div>

				<h3 class="index-box-title">
					士業のブログ
				</h3>
				<a href="#" class="btn shadowbutton btn-success index-big-button">士業のブログをもっと見る</a>

				<div class="clearfix"></div>

				
			</div> <!-- end .col-xs-12 -->
		</div> <!-- end .row -->
		</div> <!-- end .container -->
		<div class="page-fullwidth">
			<div class="project-info">
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
			<!-- <div class="modal-body">
				<iframe width="100%" height="100%" src="static-page/operationlecture.html" frameborder="0"></iframe>
			</div> -->
		</div>
	</div>
</div>
@endsection
@section('script')
	<script src="/assets/user/agency/js/m_search.js"></script>
@endsection