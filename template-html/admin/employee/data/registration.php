<?php include ('../../inc/header.php'); ?>
	<div class="site">
	    <header ng-controller="HeaderCtrl" class="ng-scope">
	        <!-- ngInclude: header_path -->
	        <div ng-include="header_path" class="ng-scope" style="">
	            <div class="header ng-scope">
	                <div class="header-top">
	                    <div class="pull-left">
	                        <ul>
	                            <li><a href="admin/master">マスター管理</a></li>
	                            <li class="active"><a href="admin/employee">施策データ管理</a></li>
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
	                        <li><a href="admin/employee">TOP</a></li>
	                        <li><a href="admin/employee/balance/sale.php">収支管理</a></li>
	                        <li><a href="admin/employee/system/advertisement.php">システム管理</a></li>
	                        <li><a href="admin/employee/customerinfo/agencylist.php">顧客情報管理</a></li>
	                        <li><a href="admin/employee/customersupport/inquiry.php">顧客対応管理</a></li>
	                        <li class="active"><a href="admin/employee/data/subsidylist.php">施策データ管理</a></li>
	                        <li><a href="admin/employee/other/affiliate.php">その他管理</a></li>
	                        <li><a href="">ver1.0 &nbsp; </a></li>
	                    </ul>
	                </div>

	                <div class="breadcrumb" style="margin-bottom:0px;">
	                    <ul>
	                        <li><a href="">施策データ管理</a><span>&gt;</span></li>
	                        <li><a>システム管理</a></li>
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
		                                <li><a href="admin/employee/data/subsidylist.php">助成金データ</a></li>
		                                <li><a href="admin/employee/data/subsidyagency.php">士業登録助成金データ</a></li>
		                                <li><a href="admin/employee/data/subsidyadd.php">助成金データ新規登録</a></li>
		                                <li><a href="admin/employee/data/document.php">書類管理</a></li>
		                                <li class="active"><a href="admin/employee/data/registration.php">登録募集施策</a></li>
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
		                                            <div class="form-group" style="margin-top:20px;">
		                                                <p class="col-sm-3">案件ID</p>
		                                                <div class="col-sm-7">
		                                                	<div class="angularsl">
		                                                        <select name="location"> 
		                                                            <option value="1">すべて</option> 
		                                                        </select>
		                                                    </div> 
		                                                </div>
		                                            </div>
		                                        </form>
		                                    </div>
		                                    <div class="col-md-5">
		                                        <form class="form-horizontal ng-pristine ng-valid">
		                                            <div class="form-group" style="margin-top:20px;">
		                                                <p class="col-sm-3">キーワード</p>
		                                                <div class="col-sm-7">
		                                                    <input class="form-control ng-pristine ng-untouched ng-valid ng-empty" id="focusedInput" type="text" placeholder="キーワード" ng-model="searchsetting.keyword" aria-invalid="false">
		                                                </div>
		                                            </div>
		                                        </form>
		                                    </div>
		                                    <div class="col-md-1"></div>
		                                </div>
		                                <div class="row">
		                                    <div class="col-md-1"></div>
		                                    <div class="col-md-5">
		                                        <form class="form-horizontal ng-pristine ng-valid ng-valid-min ng-valid-max">
		                                            <div class="form-group">
		                                                <p class="col-sm-3">更新日</p>
		                                                <div class="col-sm-3" style="padding-right:0px;">
		                                                    <input class="form-control ng-pristine ng-untouched ng-valid ng-not-empty ng-valid-min" id="focusedInput" type="number" min="2017" ng-model="searchsetting.startyear" aria-invalid="false">
		                                                </div>
		                                                <p class="col-sm-1" style="padding-right:0px;">年</p>
		                                                <div class="col-sm-1" style="padding-left:0px;padding-right:0px;">
		                                                    <input class="form-control ng-pristine ng-untouched ng-valid ng-not-empty ng-valid-min ng-valid-max" id="focusedInput" type="number" min="1" max="12" ng-model="searchsetting.startmonth" style="padding-right:0px;padding-left:4px;" aria-invalid="false">
		                                                </div>
		                                                <p class="col-sm-1" style="padding-right:0px;">月</p>
		                                                <div class="col-sm-1" style="padding-left:0px;padding-right:0px;">
		                                                    <input class="form-control ng-pristine ng-untouched ng-valid ng-not-empty ng-valid-min ng-valid-max" id="focusedInput" type="number" min="1" max="31" ng-model="searchsetting.startday" style="padding-right:0px;padding-left:4px;" aria-invalid="false">
		                                                </div>
		                                                <p class="col-sm-1" style="padding-right:0px;">日</p>
		                                            </div>
		                                        </form>
		                                    </div>
		                                    <div class="col-md-5">
		                                        <form class="form-horizontal ng-pristine ng-valid ng-valid-min ng-valid-max">
		                                            <div class="form-group">
		                                                <p class="col-sm-1" style="padding-left:0px;padding-right:0px;">~</p>
		                                                <div class="col-sm-3" style="padding-left:0px;padding-right:0px;">
		                                                    <input class="form-control ng-pristine ng-untouched ng-valid ng-not-empty ng-valid-min" id="focusedInput" type="number" min="2017" ng-model="searchsetting.endyear" aria-invalid="false">
		                                                </div>
		                                                <p class="col-sm-1" style="padding-right:0px;">年</p>
		                                                <div class="col-sm-1" style="padding-left:0px;padding-right:0px;">
		                                                    <input class="form-control ng-pristine ng-untouched ng-valid ng-not-empty ng-valid-min ng-valid-max" id="focusedInput" type="number" min="1" max="12" ng-model="searchsetting.endmonth" style="padding-right:0px;padding-left:4px;" aria-invalid="false">
		                                                </div>
		                                                <p class="col-sm-1" style="padding-right:0px;">月</p>
		                                                <div class="col-sm-1" style="padding-left:0px;padding-right:0px;">
		                                                    <input class="form-control ng-pristine ng-untouched ng-valid ng-not-empty ng-valid-min ng-valid-max" id="focusedInput" type="number" min="1" max="31" ng-model="searchsetting.endday" style="padding-right:0px;padding-left:4px;" aria-invalid="false">
		                                                </div>
		                                                <p class="col-sm-1" style="padding-right:0px;">日</p>
		                                            </div>
		                                        </form>
		                                    </div>
		                                </div>
		                                <div style="margin-top:50px;">
		                                    <input type="submit" name="submit" class="submit-blue-btn" value="検索する" ng-click="submitSearch()">
		                                </div>
		                            </div>

		                            <div class="section-3 col-md-12">
		                                <h4>登録募集施策データ</h4>
		                                <div class="section3-full">
		                                    <div class="section3-full-scroll">
		                                        <div class="row">
		                                            <div class="col-sm-12">
		                                                <input type="checkbox" ng-checked="selectedsubsidyexist(0)" ng-click="selectedsubsidytoggle(0)">すべて &nbsp; &nbsp; &nbsp;
		                                                <input type="checkbox" ng-checked="selectedsubsidyexist(2)" ng-click="selectedsubsidytoggle(2)">掲載中 &nbsp; &nbsp; &nbsp;
		                                                <input type="checkbox" ng-checked="selectedsubsidyexist(1)" ng-click="selectedsubsidytoggle(1)">掲載不可 &nbsp; &nbsp; &nbsp;
		                                                <input type="checkbox" ng-checked="selectedsubsidyexist(3)" ng-click="selectedsubsidytoggle(3)">掲載終了 &nbsp; &nbsp; &nbsp;
		                                            </div>
		                                        </div>
		                                        <div class="row" style="margin-top:30px;">
		                                            <div class="col-sm-3">
		                                            	<div class="angularsl">
	                                                        <select name="location"> 
	                                                            <option value="1">掲載不可</option> 
	                                                            <option value="2">掲載不可解除</option> 
	                                                            <option value="3">削除</option> 
	                                                        </select>
	                                                    </div>  
		                                            </div>
		                                            <div class="col-sm-2">
		                                                <input type="submit" name="submit" class="submit-blue-btn" value="適用" ng-click="clickchangestatus()">
		                                            </div>
		                                        </div>
		                                    </div>
		                                    <div class="pos-right ng-binding">0件表示 / 件</div>
		                                </div>
		                            </div>

		                            <div class="section-4 col-md-12" style="overflow-x:auto;display:block;">
		                                <table>
		                                    <thead>
		                                        <tr>
		                                            <th></th>
		                                            <th style="min-width:120px;">ステータス</th>
		                                            <th style="min-width:80px;">施策ID</th>
		                                            <th style="min-width:130px;">施策名</th>
		                                            <th style="min-width:130px;">施策名Sub</th>
		                                            <th style="min-width:150px;">登録機関</th>
		                                            <th style="min-width:250px;">分野・カテゴリー</th>
		                                            <th style="min-width:250px;">対象地域</th>
		                                            <th style="min-width:150px;">更新日</th>
		                                            <th style="min-width:550px;">目的</th>
		                                            <th style="min-width:450px;">対象者の詳細</th>
		                                            <th style="min-width:450px;">支援内容</th>
		                                            <th style="min-width:190px;">取得可能金額</th>
		                                            <th style="min-width:450px;">支援規模</th>
		                                            <th style="min-width:250px;">募集期間</th>
		                                            <th style="min-width:250px;">対象期間</th>
		                                            <th style="min-width:80px;">採択結果</th>
		                                            <th style="min-width:80px;">登録PDF</th>
		                                            <th style="min-width:250px;">お問い合わせ</th>
		                                            <th style="min-width:100px;">おすすめの助成金補助金</th>
		                                        </tr>
		                                    </thead>
		                                    <tbody>
		                                        <!-- ngRepeat: tableitem in tableitemarray -->
		                                    </tbody>
		                                </table>
		                            </div>

		                            <div class="pagination">
		                                <ul uib-pagination="" total-items="paginationsetting.totalitem" max-size="5" ng-model="paginationsetting.currentpage" previous-text="前へ" next-text="次へ" first-text="最初" last-text="最後" direction-links="false" boundary-links="true" items-per-page="paginationsetting.itemperpage" class="pagination-sm ng-pristine ng-untouched ng-valid ng-isolate-scope pagination ng-not-empty" boundary-link-numbers="true" rotate="true" ng-change="paginationchange()" role="menu" aria-invalid="false">
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
<?php include ('../../inc/footer.php'); ?>
