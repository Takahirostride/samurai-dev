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
		                                <li class="active"><a href="admin/employee/data/subsidyagency.php">士業登録助成金データ</a></li>
		                                <li><a href="admin/employee/data/subsidyadd.php">助成金データ新規登録</a></li>
		                                <li><a href="admin/employee/data/document.php">書類管理</a></li>
		                                <li><a href="admin/employee/data/registration.php">登録募集施策</a></li>
		                            </ul>
		                        </div>
		                    </div>
		                    <div class="col-md-9 pull-right">
		                        <div class="site-content">
		                            <div class="section-2 col-md-12">
		                                <div class="row">
		                                    <div class="col-md-1"></div>
		                                    <div class="col-md-5">
		                                        <form class="form-horizontal ng-pristine ng-valid ng-valid-min">
		                                            <div class="form-group" style="margin-top:20px;">
		                                                <p class="col-sm-3">案件No</p>
		                                                <div class="col-sm-8">
		                                                    <div class="col-sm-5" style="padding-left:0px;padding-right:0px;">
		                                                        <input class="form-control ng-pristine ng-untouched ng-valid ng-empty ng-valid-min" id="focusedInput" type="number" min="0" ng-model="selectedprojectnostart" aria-invalid="false">
		                                                    </div>
		                                                    <div class="col-sm-2" style="padding-left:0px;padding-right:0px;">
		                                                        <p style="margin:0 auto; width: 50%; text-align: center;">~</p>
		                                                    </div>
		                                                    <div class="col-sm-5" style="padding-left:0px;padding-right:0px;">
		                                                        <input class="form-control ng-pristine ng-untouched ng-valid ng-empty ng-valid-min" id="focusedInput" type="number" min="0" ng-model="selectedprojectnoend" aria-invalid="false">
		                                                    </div>
		                                                </div>
		                                            </div>
		                                            <div class="form-group" style="margin-top:20px;">
		                                                <p class="col-sm-3">登録機関</p>
		                                                <div class="col-sm-8">
		                                                    <div class="col-sm-5" style="padding-left:0px;padding-right:0px;">
		                                                        <div class="angularsl">
			                                                        <select name="location"> 
			                                                            <option value="1">すべて</option>
																		<option value="2">全国</option>
																		<option value="3">北海道すべて</option>
																		<option value="4">北海道札幌市</option>
																	</select>
																</div>
		                                                    </div>
		                                                    <div class="col-sm-2"></div>
		                                                    <div class="col-sm-5" style="padding-left:0px;padding-right:0px;">
		                                                        <div class="angularsl">
			                                                        <select name="location"> 
			                                                            <option value="1">すべて</option> 
			                                                        </select>
			                                                    </div>
		                                                    </div>
		                                                </div>
		                                            </div>
		                                            <div class="form-group" style="margin-top:20px;">
		                                                <p class="col-sm-3">対象地域</p>
		                                                <div class="col-sm-8">
		                                                    <div class="angularsl">
		                                                        <select name="location"> 
		                                                            <option value="1">すべて</option>
																	<option value="2">全国</option>
																	<option value="3">北海道すべて</option>
																	<option value="4">北海道札幌市</option>
																</select>
															</div>
		                                                </div>
		                                            </div>
		                                        </form>
		                                    </div>
		                                    <div class="col-md-5">
		                                        <form class="form-horizontal ng-pristine ng-valid">
		                                            <div class="form-group" style="margin-top:20px;">
		                                                <p class="col-sm-3">ステータス</p>
		                                                <div class="col-sm-8">
		                                                    <div class="angularsl">
		                                                        <select name="location"> 
		                                                            <option value="1">すべて</option>
																	<option value="2">公開</option>
																	<option value="3">未公開</option>
																	<option value="3">公開不可</option>
																	<option value="3">掲載終了</option>
		                                                        </select>
		                                                    </div>
		                                                </div>
		                                            </div>
		                                            <div class="form-group" style="margin-top:20px;">
		                                                <p class="col-sm-3">カテゴリー</p>
		                                                <div class="col-sm-8">
		                                                    <div class="angularsl">
		                                                        <select name="location"> 
		                                                            <option value="1">すべて</option>
																	<option value="2">雇用・人材</option>
																	<option value="3">経営改善・販路開拓</option>
																	<option value="4">設備導入・研究開発</option>
																	<option value="5">創業・起業</option>
																	<option value="6">経営環境改善</option>
																	<option value="7">特許・知的財産</option>
																	<option value="8">誘致関連</option>
		                                                        </select>
		                                                    </div>
		                                                </div>
		                                            </div>
		                                            <div class="form-group" style="margin-top:20px;">
		                                                <p class="col-sm-3">キーワード</p>
		                                                <div class="col-sm-8">
		                                                    <input class="form-control ng-pristine ng-untouched ng-valid ng-empty" id="focusedInput" type="text" placeholder="キーワード" ng-model="subsidykeyword" aria-invalid="false">
		                                                </div>
		                                            </div>
		                                        </form>
		                                    </div>
		                                </div>
		                                <div style="margin-top:50px;">
		                                    <input type="submit" name="submit" class="submit-blue-btn" value="検索する" ng-click="submitSearch($event)">
		                                </div>
		                            </div>

		                            <div class="section-3 col-md-12">
		                                <h4>助成金データ</h4>
		                                <div class="section3-full">
		                                    <div class="section3-full-scroll">
		                                        <div class="row">
		                                            <div class="col-sm-12">
		                                                <input type="checkbox" ng-checked="selectedsubsidyexist(0)" ng-click="selectedsubsidytoggle(0)">すべて &nbsp; &nbsp; &nbsp;
		                                                <input type="checkbox" ng-checked="selectedsubsidyexist(1)" ng-click="selectedsubsidytoggle(1)">公開 &nbsp; &nbsp; &nbsp;
		                                                <input type="checkbox" ng-checked="selectedsubsidyexist(2)" ng-click="selectedsubsidytoggle(2)">未公開 &nbsp; &nbsp; &nbsp;
		                                                <input type="checkbox" ng-checked="selectedsubsidyexist(3)" ng-click="selectedsubsidytoggle(3)">公開不可 &nbsp; &nbsp; &nbsp;
		                                                <input type="checkbox" ng-checked="selectedsubsidyexist(4)" ng-click="selectedsubsidytoggle(4)">掲載終了
		                                            </div>
		                                        </div>
		                                        <div class="row" style="margin-top:30px;">
		                                            <div class="col-sm-3">
		                                                <div class="angularsl">
	                                                        <select name="location"> 
	                                                            <option value="1">公開</option>
																<option value="2">未公開</option>
																<option value="3">公開不可</option>
																<option value="4">掲載終了</option>
																<option value="5">削除</option>
	                                                        </select>
	                                                    </div> 
		                                            </div>
		                                            <div class="col-sm-2">
		                                                <input type="submit" name="submit" class="submit-blue-btn" value="適用" ng-click="clickchangestatus()">
		                                            </div>
		                                        </div>
		                                    </div>
		                                    <div class="pos-right ng-binding">0件表示 / 0件</div>
		                                </div>
		                            </div>

		                            <div class="section-4 col-md-12" style="overflow-x:auto;display:block;">
		                                <table>
		                                    <thead>
		                                        <tr>
		                                            <th></th>
		                                            <th style="min-width:120px;">ステータス</th>
		                                            <th style="min-width:80px;" ng-click="clickheader(1)" role="button" tabindex="0">施策ID <span class="table-arrow"></span></th>
		                                            <th style="min-width:130px;">施策名</th>
		                                            <th style="min-width:130px;">施策名Sub</th>
		                                            <th style="min-width:150px;" ng-click="clickheader(2)" role="button" tabindex="0">登録機関 <span class="table-arrow"></span></th>
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
		                                <ul uib-pagination="" total-items="totaltableitem" max-size="5" ng-model="paginationnumber" previous-text="前へ" next-text="次へ" first-text="最初" last-text="最後" direction-links="false" boundary-links="true" items-per-page="tablepageitemcount" class="pagination-sm ng-pristine ng-untouched ng-valid ng-isolate-scope pagination ng-not-empty" boundary-link-numbers="true" rotate="true" ng-change="paginationchange()" role="menu" aria-invalid="false">
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
