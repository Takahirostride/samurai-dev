@extends('layouts.home')
@section('style')
	<!-- <link rel="stylesheet" href="/assets/client/css/i_subsidylist.css"> -->
@endsection
@section('content')
<div class="mainpage">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
			@includeIf('partials.breadcrumb', ['title' => '助成金・補助金の申請代行募集をする'])
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">助成金・補助金自動マッチング</h1>
				<p class="page-description">プロフィールの設定に対して、マッチングしている助成金・補助金が表示されています。対応可能と思われる、助成金・補助金の設定が行え、企業に直接営業も可能です。</p>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<div class="search-value-change">
					<span class="page-per-page">9件/ 9件</span>
					<div class="float-right">
						<form action="" method="POST" class="form-inline">
							<div class="form-group">
								<label for="">並び替え: </label>
								<select name="" class="form-control">
									<option value="">新着順</option>
									<option value="">取得金額が高い順</option>
									<option value="">取得金額が低い順</option>
									<option value="">マッチングが多い順（対応可能士業者数）</option>
								</select>
							</div>
							<div class="form-group">
								<label for="">表示件数: </label>
								<select name="" class="form-control">
									<option value="">10</option>
									<option value="">20</option>
									<option value="">50</option>
								</select>
							</div>
						</form>
					</div> <!-- end float-right -->
				</div> <!-- end .search-value-change -->
			</div> <!-- end .col-sm-12 -->
		</div> <!-- end .row -->
		
		<div class="row">
			<div class="col-sm-2 sidebar-left">
				<h3 class="mpage-title">リスト一覧</h3>
				<p><a href="#" class="btn btn-default sidebar-btn btn-grad active">
						<strong>提案を検討リスト</strong>
					</a></p>
				<p><a href="#" class="btn btn-default btn-grad sidebar-btn">
						<strong>興味リスト</strong>
					</a></p>
				<p><a href="#" class="btn btn-default btn-grad sidebar-btn">
						<strong>非表示リスト</strong>
					</a></p>

				<h3 class="mpage-title">絞り込み表示</h3>
				<p><a href="#" class="btn btn-default sidebar-btn btn-grad">
						<strong>自動検索で絞り込み</strong>
					</a></p>
			</div> <!-- end .sidebar-left -->

			<div class="col-sm-10 mainpage">
				<div class="row subsidy-list">
					<div class="col-sm-12">
						<div class="subsidy-list-item">
							<div class="row">
								<div class="subsidy-list-col1">
									<div class="index-boxcol2-sub-ct">
										<div class="middle-boxcol2">
											<ul>
												<li><span class="tag-cost4">提案を検討</span></li>
												<li><span class="tag-cost4">提案を検討</span></li>
												<li><span class="tag-cost4">提案を検討</span></li>
											</ul>
										</div> <!-- end .middle-boxcol2 -->
										<div class="create-link-box">
											<a href="#"></a>
											<div class="left-boxcol2">
												<img src="assets/images/agency-list-01.jpg" alt="">
											</div>
											<div class="right-boxcol2">

												<p>
													<a href="agency/Fselect.php" class="boxcol2-a-2"><span class="sidy-tbig">横浜市中小企業融資制度</span><br><strong>登録期関:</strong>神奈川県 横浜市   /   <strong>募集時期:</strong>毎年4月1日から3月31日まで</a>
													<span>横浜市中小企業融資制度は、中小企業の皆様が、事業を行っていく上で必要な運転資金や設備資金を円滑に調達できるよう、横浜市が横浜市信用保証協会及び取扱金融機関と連携して行ってい...</span>
												</p>
											</div>
										</div> <!-- end .create-link-box -->
										
										<div class="middle-boxcol2">
											<ul>
												<li><button type="button" class="btn btn-default bg-444" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="お気に入りボタンの１つで、興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。">提案を検討</button></li>
												<li><button type="button" class="btn btn-default btn-style-grey" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="お気に入りボタンの１つで、興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。">興味あり</button></li>
												<li><button type="button" class="btn btn-default btn-style-grey" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="必要がない、自分に関係がない施策が表示された場合は、非表示としてください。非表示とすることで自動検索であなたに関連しない施策が表示されなくなります。">非表示</button></li>
											</ul>
											<p class="jprice">融資支援：2億8,000万円</p>
										</div> <!-- end .middle-boxcol2 -->
									</div> <!-- end item index-boxcol2 -->
								</div>	<!-- end col-sm-8 -->
								<div class="subsidy-list-col2">
									<div class="subsidylist-item-av div-style-grey">
										<img src="assets/images/avatar.png" alt="">
										<div class="itemav-info">
											<p>実績：4件</p>
											<p>評価：</p>
											<div class="star-rating">
												<select class="datrating" id="example-fontawesome" name="rating" autocomplete="off">
													<option value="1">1</option>
													<option value="2">2</option>
													<option value="3">3</option>
													<option value="4">4</option>
													<option value="5">5</option>
												</select>
										</div> <!-- end .itemav-info -->
										<button class="btn-primary btn-follow">フォロー</button>
										</div>
									</div>
								</div><!-- end col-sm-3 -->
								<div class="subsidy-list-col3">
									<p>申請希望企業</p>
									<img src="assets/images/avatar.png" alt="">
									<a href="#">19人</a>
								</div><!-- end col-sm-1 -->
							</div> <!-- end .row -->
						</div> <!-- end .sidylist-item -->
						<div class="subsidy-list-item">
							<div class="row">
								<div class="subsidy-list-col1">
									<div class="index-boxcol2-sub-ct">
										<div class="middle-boxcol2">
											<ul>
												<li><span class="tag-cost4">提案を検討</span></li>
												<li><span class="tag-cost4">提案を検討</span></li>
												<li><span class="tag-cost4">提案を検討</span></li>
											</ul>
										</div> <!-- end .middle-boxcol2 -->
										<div class="create-link-box">
											<a href="#"></a>
											<div class="left-boxcol2">
												<img src="assets/images/agency-list-01.jpg" alt="">
											</div>
											<div class="right-boxcol2">

												<p>
													<a href="agency/Fselect.php" class="boxcol2-a-2"><span class="sidy-tbig">横浜市中小企業融資制度</span><br><strong>登録期関:</strong>神奈川県 横浜市   /   <strong>募集時期:</strong>毎年4月1日から3月31日まで</a>
													<span>横浜市中小企業融資制度は、中小企業の皆様が、事業を行っていく上で必要な運転資金や設備資金を円滑に調達できるよう、横浜市が横浜市信用保証協会及び取扱金融機関と連携して行ってい...</span>
												</p>
											</div>
										</div> <!-- end .create-link-box -->
										
										<div class="middle-boxcol2">
											<ul>
												<li><button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="お気に入りボタンの１つで、興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。">提案を検討</button></li>
												<li><button type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="お気に入りボタンの１つで、興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。">興味あり</button></li>
												<li><button type="button" class="btn btn-default btn-style-grey" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="必要がない、自分に関係がない施策が表示された場合は、非表示としてください。非表示とすることで自動検索であなたに関連しない施策が表示されなくなります。">非表示</button></li>
											</ul>
											<p class="jprice">融資支援：2億8,000万円</p>
										</div> <!-- end .middle-boxcol2 -->
									</div> <!-- end item index-boxcol2 -->
								</div>	<!-- end col-sm-8 -->
								<div class="subsidy-list-col2">
									<div class="subsidylist-item-av div-style-grey">
										<img src="assets/images/avatar.png" alt="">
										<div class="itemav-info">
											<p>実績：4件</p>
											<p>評価：</p>
											<div class="star-rating">
												<select class="datrating" id="example-fontawesome" name="rating" autocomplete="off">
													<option value="1">1</option>
													<option value="2">2</option>
													<option value="3">3</option>
													<option value="4">4</option>
													<option value="5">5</option>
												</select>
										</div> <!-- end .itemav-info -->
										<button class="btn-primary btn-follow">フォロー</button>
										</div>
									</div>
								</div><!-- end col-sm-3 -->
								<div class="subsidy-list-col3">
									<p>申請希望企業</p>
									<img src="assets/images/avatar.png" alt="">
									<a href="#">19人</a>
								</div><!-- end col-sm-1 -->
							</div> <!-- end .row -->
						</div> <!-- end .sidylist-item -->
						<div class="subsidy-list-item">
							<div class="row">
								<div class="subsidy-list-col1">
									<div class="index-boxcol2-sub-ct">
										<div class="middle-boxcol2">
											<ul>
												<li><span class="tag-cost4">提案を検討</span></li>
												<li><span class="tag-cost4">提案を検討</span></li>
												<li><span class="tag-cost4">提案を検討</span></li>
											</ul>
										</div> <!-- end .middle-boxcol2 -->
										<div class="create-link-box">
											<a href="#"></a>
											<div class="left-boxcol2">
												<img src="assets/images/agency-list-01.jpg" alt="">
											</div>
											<div class="right-boxcol2">

												<p>
													<a href="agency/Fselect.php" class="boxcol2-a-2"><span class="sidy-tbig">横浜市中小企業融資制度</span><br><strong>登録期関:</strong>神奈川県 横浜市   /   <strong>募集時期:</strong>毎年4月1日から3月31日まで</a>
													<span>横浜市中小企業融資制度は、中小企業の皆様が、事業を行っていく上で必要な運転資金や設備資金を円滑に調達できるよう、横浜市が横浜市信用保証協会及び取扱金融機関と連携して行ってい...</span>
												</p>
											</div>
										</div> <!-- end .create-link-box -->
										
										<div class="middle-boxcol2">
											<ul>
												<li><button type="button" class="btn btn-default btn-style-grey" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="お気に入りボタンの１つで、興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。">提案を検討</button></li>
												<li><button type="button" class="btn btn-default btn-style-grey" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="お気に入りボタンの１つで、興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。">興味あり</button></li>
												<li><button type="button" class="btn btn-default btn-style-grey" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="必要がない、自分に関係がない施策が表示された場合は、非表示としてください。非表示とすることで自動検索であなたに関連しない施策が表示されなくなります。">非表示</button></li>
											</ul>
											<p class="jprice">融資支援：2億8,000万円</p>
										</div> <!-- end .middle-boxcol2 -->
									</div> <!-- end item index-boxcol2 -->
								</div>	<!-- end col-sm-8 -->
								<div class="subsidy-list-col2">
									<div class="subsidylist-item-av div-style-grey">
										<img src="assets/images/avatar.png" alt="">
										<div class="itemav-info">
											<p>実績：4件</p>
											<p>評価：</p>
											<div class="star-rating">
												<select class="datrating" id="example-fontawesome" name="rating" autocomplete="off">
													<option value="1">1</option>
													<option value="2">2</option>
													<option value="3">3</option>
													<option value="4">4</option>
													<option value="5">5</option>
												</select>
										</div> <!-- end .itemav-info -->
										<button class="btn-primary btn-follow">フォロー</button>
										</div>
									</div>
								</div><!-- end col-sm-3 -->
								<div class="subsidy-list-col3">
									<p>申請希望企業</p>
									<img src="assets/images/avatar.png" alt="">
									<a href="#">19人</a>
								</div><!-- end col-sm-1 -->
							</div> <!-- end .row -->
						</div> <!-- end .sidylist-item -->
						<div class="clearfix"></div>
						<div class="text-center">
							<ul class="pagination">
								<li class="disabled"><a href="#">最初</a></li>
								<li><a href="#">1</a></li>
								<li class="active"><a href="#">2</a></li>
								<li><a href="#">3</a></li>
								<li><a href="#">4</a></li>
								<li><a href="#">5</a></li>
								<li><a href="#">最後</a></li>
							</ul>
						</div>
					</div> <!-- end .div.col-sm-12 -->

				</div> <!-- end .row -->
			</div> <!-- end .mainpage -->
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
				<iframe width="100%" height="100%" src="static-page/operationlecture.html" frameborder="0"></iframe>
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
	<!-- <script src="/assets/client/js/i_subsidylist.js"></script> -->
@endsection