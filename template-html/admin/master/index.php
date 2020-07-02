<?php include ('../inc/header.php'); ?>
	<div class="site">
	    <header ng-controller="HeaderCtrl" class="ng-scope">
	        <!-- ngInclude: header_path -->
		    <div ng-include="header_path" class="ng-scope" style="">
			    <div class="header ng-scope">
					<div class="header-top">
						<div class="pull-left">
							<ul>
								<li class="active"><a href="admin/master">マスター管理</a></li>
								<li><a href="admin/employee">施策データ管理</a></li>
							</ul>
							</div>
							<div class="pull-right">
							<ul>
								<li><a href="" class="ng-binding">ログイン者名 &nbsp; &nbsp; administrator</a></li>
								<li><a ng-click="logoutuser()">ログアウト</a></li>
							</ul>
						</div>
					</div>
					<div class="header-bottom">
						<ul class="navbar" style="margin-bottom:0px;">
						  <li class="active"><a href="admin/master">TOP</a></li>
						  <li><a href="admin/master/balancesale.php">収支管理</a></li>
						  <li><a href="admin/master/profile.php">システム管理</a></li>
						  <li><a href="">ver1.0 &nbsp; </a></li>
						</ul>
					</div>
					
					<div class="breadcrumb" style="margin-bottom:0px;">
						<ul>
							<li><a href="">マスター管理</a><span>&gt;</span></li>
							<li><a>TOP</a></li>
						</ul>
					</div>
				</div>
			</div>
	    </header>
	    <!-- ngView: -->
	    <div ng-view="" class="ng-scope" style="">
		    <div class="content ng-scope">
				<div class="inner-content">
					<div class="inner-container">
						<div class="row">
							<div class="col-md-3 pull-left">
								<div class="sidebar-left" style="margin-bottom:90px;">
									<ul>
										<li><a href="admin/master">サイトへ</a></li>
									</ul>
								</div>
								<div class="sidebar-left">
									<ul>
										<li><a href="admin/master/csvmanagement.php">csv管理</a></li>
										<li><a href="admin/master/uploaded.php">アップロードファイル管理</a></li>
										<li><a href="admin/master/scrape.php">クローリング</a></li>
									</ul>
								</div>
							</div>
							<div class="col-md-9 pull-right">
								<div class="site-content">
									<div class="section-news">
										<!-- ngRepeat: newsitem in newsitemlist --><div class="success-msg ng-scope" ng-repeat="newsitem in newsitemlist" style="">
											<span class="ng-binding">2018-09-14 13:51:08&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;新しい施策を登録しました。</span>
										</div><!-- end ngRepeat: newsitem in newsitemlist --><div class="success-msg ng-scope" ng-repeat="newsitem in newsitemlist">
											<span class="ng-binding">2018-09-11 17:23:35&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ユーザー：322の権限をなくしました。</span>
										</div><!-- end ngRepeat: newsitem in newsitemlist --><div class="success-msg ng-scope" ng-repeat="newsitem in newsitemlist">
											<span class="ng-binding">2018-09-11 17:15:28&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;広告を編集しました。</span>
										</div><!-- end ngRepeat: newsitem in newsitemlist --><div class="success-msg ng-scope" ng-repeat="newsitem in newsitemlist">
											<span class="ng-binding">2018-09-07 00:10:43&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;大きな カテゴリー 公開の設定</span>
										</div><!-- end ngRepeat: newsitem in newsitemlist --><div class="success-msg ng-scope" ng-repeat="newsitem in newsitemlist">
											<span class="ng-binding">2018-09-06 16:03:02&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;カテゴリー248を削除しました。</span>
										</div><!-- end ngRepeat: newsitem in newsitemlist -->
									</div>
								</div>
								<div class="site-content" style="margin-top:30px;">
									<div class="col-sm-4">
										<div class="home-colmenu-content">
											<strong>■収支管理</strong>
											<div class="home-colmenu-items">
												<p><a href="admin/master/balancesale.php">・売上管理</a></p>
												<p><a href="admin/master/balancedepwith.php">・入出金管理</a></p>
												<p><a href="admin/master/balancepayplan.php">・支払予定管理</a></p>
												<p><a href="admin/master/balancedata.php">・データ総括</a></p>
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="home-colmenu-content">
											<strong>■システム管理一覧</strong>
											<div class="home-colmenu-items">
												<p><a href="admin/master/profile.php">・システム設定</a></p>
												<p><a href="admin/master/employeeedit.php">・スタッフ登録</a></p>
												<p><a href="admin/master/loginhistory.php">・ログイン履歴</a></p>
												<p><a href="admin/master/edithistory.php">・編集履歴</a></p>
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="home-colmenu-content">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php include ('../inc/footer.php'); ?>
