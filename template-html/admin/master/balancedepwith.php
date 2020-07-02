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
						  <li><a href="admin/master">TOP</a></li>
						  <li class="active"><a href="admin/master/balancesale.php">収支管理</a></li>
						  <li><a href="admin/master/profile.php">システム管理</a></li>
						  <li><a href="">ver1.0 &nbsp; </a></li>
						</ul>
					</div>
					
					<div class="breadcrumb" style="margin-bottom:0px;">
						<ul>
							<li><a href="">マスター管理</a><span>&gt;</span></li>
							<li><a>収支管理</a></li>
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
		                        <div class="sidebar-left">
		                            <ul>
		                                <li><a href="admin/master/balancesale.php">売上管理</a></li>
		                                <li class="active"><a href="admin/master/balancedepwith.php">入出金管理</a></li>
		                                <li><a href="admin/master/balancepayplan.php">支払予定管理</a></li>
		                                <li><a href="admin/master/balancedata.php">データ総括</a></li>
		                            </ul>
		                        </div>
		                    </div>
		                    <div class="col-md-9 pull-right">
		                        <div class="site-content">
		                            <div class="section-2 col-md-12">
		                                <div class="row">
		                                    <div class="col-md-1"></div>
		                                    <div class="col-md-5">
		                                        <form class="form-horizontal ng-pristine ng-valid">
		                                            <div class="form-group">
		                                                <p class="col-sm-3">日付</p>
		                                                <div class="col-sm-3" style="padding-right:0px;">
		                                                    <input class="form-control ng-pristine ng-untouched ng-valid ng-empty" type="text" ng-model="search.created_time_from_year" min="2018" max="2100" aria-invalid="false">
		                                                </div>
		                                                <p class="col-sm-1" style="padding-right:0px;">年</p>
		                                                <div class="col-sm-1" style="padding-left:0px;padding-right:0px;">
		                                                    <input class="form-control ng-pristine ng-untouched ng-valid ng-empty" type="text" ng-model="search.created_time_from_month" min="1" max="12" aria-invalid="false">
		                                                </div>
		                                                <p class="col-sm-1" style="padding-right:0px;">月</p>
		                                                <div class="col-sm-1" style="padding-left:0px;padding-right:0px;">
		                                                    <input class="form-control ng-pristine ng-untouched ng-valid ng-empty" type="text" ng-model="search.created_time_from_day" min="1" max="31" aria-invalid="false">
		                                                </div>
		                                                <p class="col-sm-1" style="padding-right:0px;">日</p>
		                                            </div>
		                                        </form>
		                                    </div>
		                                    <div class="col-md-5">
		                                        <form class="form-horizontal ng-pristine ng-valid">
		                                            <div class="form-group">
		                                                <p class="col-sm-1" style="padding-left:0px;padding-right:0px;">~</p>
		                                                <div class="col-sm-3" style="padding-left:0px;padding-right:0px;">
		                                                    <input class="form-control ng-pristine ng-untouched ng-valid ng-empty" type="text" ng-model="search.created_time_to_year" min="2018" max="2100" aria-invalid="false">
		                                                </div>
		                                                <p class="col-sm-1" style="padding-right:0px;">年</p>
		                                                <div class="col-sm-1" style="padding-left:0px;padding-right:0px;">
		                                                    <input class="form-control ng-pristine ng-untouched ng-valid ng-empty" type="text" ng-model="search.created_time_to_month" min="1" max="12" aria-invalid="false">
		                                                </div>
		                                                <p class="col-sm-1" style="padding-right:0px;">月</p>
		                                                <div class="col-sm-1" style="padding-left:0px;padding-right:0px;">
		                                                    <input class="form-control ng-pristine ng-untouched ng-valid ng-empty" type="text" ng-model="search.created_time_to_day" min="1" max="31" aria-invalid="false">
		                                                </div>
		                                                <p class="col-sm-1" style="padding-right:0px;">日</p>
		                                            </div>
		                                        </form>
		                                    </div>
		                                </div>
		                                <div class="row">
		                                    <div class="col-md-1"></div>
		                                    <div class="col-md-5">
		                                        <form class="form-horizontal ng-pristine ng-valid">
		                                            <div class="form-group" style="margin-top:20px;">
		                                                <p class="col-sm-3">口座名</p>
		                                                <div class="col-sm-7">
		                                                    <input class="form-control ng-pristine ng-untouched ng-valid ng-empty" type="text" placeholder="支払コード" ng-model="search.order_id" aria-invalid="false">
		                                                </div>
		                                            </div>
		                                            <div class="form-group" style="margin-top:20px;">
		                                                <p class="col-sm-3">社名</p>
		                                                <div class="col-sm-7">
		                                                    <input class="form-control ng-pristine ng-untouched ng-valid ng-empty" type="text" placeholder="支払先会社名" ng-model="search.to_user_name" aria-invalid="false">
		                                                </div>
		                                            </div>
		                                            <div class="form-group" style="margin-top:20px;">
		                                                <p class="col-sm-3">科目</p>
		                                                <div class="col-sm-7 balancesale">
		                                                    <div class="angularsl">
                                                                <select name="location"> 
                                                                    <option value="1">すべて</option>
                                                                </select>
                                                            </div>
		                                                </div>
		                                            </div>
		                                            <div class="form-group" style="margin-top:20px;">
		                                                <p class="col-sm-3">摘要</p>
		                                                <div class="col-sm-7 balancesale">
		                                                    <div class="angularsl">
                                                                <select name="location"> 
                                                                    <option value="1">すべて</option>
                                                                </select>
                                                            </div>
		                                                </div>
		                                            </div>
		                                        </form>
		                                    </div>
		                                </div>
		                                <div style="margin-top:50px;">
		                                    <input type="submit" name="submit" class="submit-blue-btn" value="表示する" ng-click="doSearch(true)">
		                                </div>
		                            </div>

		                            <div class="section-3 col-md-12">
		                                <h4 style="margin-bottom:20px;">入出金管理一覧</h4>
		                                <div class="row" style="margin-bottom:20px;margin-top:20px;">

		                                    <div class="col-sm-12">
		                                        <form class="searchPart ng-pristine ng-valid">
		                                            <div style="display: inline;margin-left:30px;" class="ng-binding">件表示 / 件</div>
		                                            <!-- <button type="button" class="submit-blue-searchright" style="margin-left:10px;">入出金印刷</button>   -->
		                                            <a href="csv/down_balance_depwith" class="submit-blue-searchright" style="margin-right:20px;">csv出力</a>
		                                        </form>
		                                    </div>
		                                </div>
		                            </div>

		                            <div class="section-4 col-md-12" style="overflow-x:auto;display:block;">
		                                <table>
		                                    <thead>
		                                        <tr>
		                                            <th style="min-width:120px;">日付</th>
		                                            <th>社名</th>
		                                            <th>科目</th>
		                                            <th>摘要</th>
		                                            <th>入金額</th>
		                                            <th>出金額</th>
		                                            <th>差引残高</th>
		                                            <th>ステータス</th>
		                                        </tr>
		                                    </thead>
		                                    <tbody>
		                                        <!-- ngRepeat: payment in payments -->
		                                    </tbody>
		                                </table>
		                            </div>

		                            <div class="pagination">
		                                <ul uib-pagination="" total-items="total" max-size="5" ng-model="paginationnumber" previous-text="前へ" next-text="次へ" first-text="最初" last-text="最後" direction-links="false" boundary-links="true" items-per-page="tablepageitemcount" class="pagination-sm ng-pristine ng-untouched ng-valid ng-isolate-scope pagination ng-not-empty" boundary-link-numbers="true" rotate="true" ng-change="doSearch()" role="menu" aria-invalid="false">
		                                    <!-- ngIf: ::boundaryLinks -->
		                                    <li role="menuitem" ng-if="::boundaryLinks" ng-class="{disabled: noPrevious()||ngDisabled}" class="pagination-first ng-scope disabled"><a href="" ng-click="selectPage(1, $event)" ng-disabled="noPrevious()||ngDisabled" uib-tabindex-toggle="" class="ng-binding" disabled="disabled" tabindex="-1">最初</a></li>
		                                    <!-- end ngIf: ::boundaryLinks -->
		                                    <!-- ngIf: ::directionLinks -->
		                                    <!-- ngRepeat: page in pages track by $index -->
		                                    <li role="menuitem" ng-repeat="page in pages track by $index" ng-class="{active: page.active,disabled: ngDisabled&amp;&amp;!page.active}" class="pagination-page ng-scope active"><a href="" ng-click="selectPage(page.number, $event)" ng-disabled="ngDisabled&amp;&amp;!page.active" uib-tabindex-toggle="" class="ng-binding">1</a></li>
		                                    <!-- end ngRepeat: page in pages track by $index -->
		                                    <!-- ngIf: ::directionLinks -->
		                                    <!-- ngIf: ::boundaryLinks -->
		                                    <li role="menuitem" ng-if="::boundaryLinks" ng-class="{disabled: noNext()||ngDisabled}" class="pagination-last ng-scope disabled"><a href="" ng-click="selectPage(totalPages, $event)" ng-disabled="noNext()||ngDisabled" uib-tabindex-toggle="" class="ng-binding" disabled="disabled" tabindex="-1">最後</a></li>
		                                    <!-- end ngIf: ::boundaryLinks -->
		                                </ul>
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
