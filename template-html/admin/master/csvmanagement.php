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
		                                <li class="active"><a href="admin/master/csvmanagement.php">csv管理</a></li>
		                                <li><a href="admin/master/uploaded.php">アップロードファイル管理</a></li>
		                                <li><a href="admin/master/scrape.php">クローリング</a></li>
		                            </ul>
		                        </div>
		                    </div>
		                    <div class="col-md-9 pull-right">
		                        <div class="site-content">
		                            <label style="font-size:22px; margin-left:10px; ">csv読込・出力</label>
		                        </div>
		                        <div class="site-content">
		                            <!-- ngIf: message!='' -->
		                            <div class="section-2 col-md-12">
		                                <div class="col-md-1">
		                                </div>
		                                <div class="col-md-11">
		                                    <form class="form-horizontal ng-pristine ng-valid" name="csvform">
		                                        <div class="form-group" style="margin-top:30px;">
		                                            <p class="col-sm-2">士業一覧</p>
		                                            <div class="col-sm-5">
		                                                <input class="form-control" type="file" ngf-select="select_business($file)">
		                                            </div>
		                                            <button type="button" class="submit-blue-left" style="width:100px;" ng-click="import_busines()">読込</button>
		                                            <a href="csv/down_user/0" class="submit-blue-left" style="width:100px;">出力</a>
		                                        </div>
		                                        <div class="form-group" style="margin-top:30px;">
		                                            <p class="col-sm-2">事業者一覧</p>
		                                            <div class="col-sm-5">
		                                                <input class="form-control" type="file" ngf-select="select_worker($file)">
		                                            </div>
		                                            <button type="button" class="submit-blue-left" style="width:100px;" ng-click="import_worker()">読込</button>
		                                            <a href="csv/down_user/1" class="submit-blue-left" style="width:100px;">出力</a>
		                                        </div>
		                                        <div class="form-group" style="margin-top:30px;">
		                                            <p class="col-sm-2">アフィリエイター一覧</p>
		                                            <div class="col-sm-5">
		                                                <input class="form-control" type="file" ngf-select="select_worker($file)">
		                                            </div>
		                                            <button type="button" class="submit-blue-left" style="width:100px;" ng-click="import_affiliate()">読込</button>
		                                            <a href="csv/down_affiliate" class="submit-blue-left" style="width:100px;">出力</a>
		                                        </div>
		                                        <div class="form-group" style="margin-top:30px;">
		                                            <p class="col-sm-2">仕事提携会社一覧</p>
		                                            <div class="col-sm-5">
		                                                <input class="form-control ng-pristine ng-untouched ng-valid ng-empty" type="file" ng-model="workpartner" aria-invalid="false">
		                                            </div>
		                                            <button type="button" class="submit-blue-left" style="width:100px;" ng-click="inputworkparter()">読込</button>
		                                            <a href="javascript:;" class="submit-blue-left" style="width:100px;">出力</a>
		                                        </div>
		                                        <div class="form-group" style="margin-top:30px;">
		                                            <p class="col-sm-2">マッチング一覧</p>
		                                            <div class="col-sm-5">
		                                                <input class="form-control" type="file" ngf-select="select_matching($file)">
		                                            </div>
		                                            <button type="button" class="submit-blue-left" style="width:100px;" ng-click="import_matching()">読込</button>
		                                            <a href="csv/down_matching" class="submit-blue-left" style="width:100px;">出力</a>
		                                        </div>
		                                        <div class="form-group" style="margin-top:30px;">
		                                            <p class="col-sm-2">助成金データ</p>
		                                            <div class="col-sm-5">
		                                                <input class="form-control" type="file" ngf-select="select_policy($file)">
		                                            </div>
		                                            <button type="button" class="submit-blue-left" style="width:100px;" ng-click="import_policy()">読込</button>
		                                            <a href="csv/down_policy" class="submit-blue-left" style="width:100px;">出力</a>
		                                        </div>
		                                        <div class="form-group" style="margin-top:30px;">
		                                            <p class="col-sm-2">士業登録助成金データ</p>
		                                            <div class="col-sm-5">
		                                                <input class="form-control" type="file" ngf-select="select_agency_policy($file)">
		                                            </div>
		                                            <button type="button" class="submit-blue-left" style="width:100px;" ng-click="import_agency_policy()">読込</button>
		                                            <a href="csv/down_agency_policy" class="submit-blue-left" style="width:100px;">出力</a>
		                                        </div>
		                                    </form>
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
