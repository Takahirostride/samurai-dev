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
		                                <li><a href="">サイトへ</a></li>
		                            </ul>
		                        </div>
		                        <div class="sidebar-left">
		                            <ul>
		                                <li><a href="admin/master/csvmanagement.php">csv管理</a></li>
		                                <li><a href="admin/master/uploaded.php">アップロードファイル管理</a></li>
		                                <li class="active"><a href="admin/master/scrape.php">クローリング</a></li>
		                            </ul>
		                        </div>
		                    </div>
		                    <div class="col-md-9 pull-right">
		                        <div class="site-content">
		                            <div class="section-news">
		                                <div style="font-weight:bold;font-size:18px;"> 廃棄の更新 </div>
		                                <hr style="color:black;">
		                                <!-- ngIf: flag_scrape -->
		                                <label style="font-size:25px">下の&lt;アップデート&gt;ボタンを押して、米ラサフォーの施策の点検を進めて更新されているか、新たに追加された施策を呼び込むください。</label>
		                                <br>
		                                <br>
		                                <br>
		                                <div style="text-align:center;">
		                                    <button class="btn btn-success" style="padding:10px 20px;font-size:20px;" ng-click="scrape_update()">アップデート</button>
		                                </div>
		                            </div>
		                        </div>

		                        <div class="site-content" style="margin-top:30px;">
		                            <div class="section-news">
		                                <div style="font-weight:bold;font-size:18px;"> 再び廃棄する </div>
		                                <hr style="color:black;">
		                                <!-- ngIf: flag_scrape_format -->
		                                <label style="font-size:25px">現在の施策をすべて削除しますので、再廃棄する前に、もう一度ご覧ください。</label>
		                                <br>
		                                <br>
		                                <br>
		                                <div style="text-align:center;">
		                                    <button class="btn btn-success" style="padding:10px 20px;font-size:20px;" ng-click="scrape_format()">初期化と再廃棄</button>
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
