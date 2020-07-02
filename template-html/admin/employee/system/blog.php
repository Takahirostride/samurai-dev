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
	                        <li class="active"><a href="admin/employee/system/advertisement.php">システム管理</a></li>
	                        <li><a href="admin/employee/customerinfo/agencylist.php">顧客情報管理</a></li>
	                        <li><a href="admin/employee/customersupport/inquiry.php">顧客対応管理</a></li>
	                        <li><a href="admin/employee/data/subsidylist.php">施策データ管理</a></li>
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
		                                <li><a href="admin/employee/system/advertisement.php">広告表示管理</a></li>
		                                <li><a href="admin/employee/system/uservoice.php">利用者の声</a></li>
		                                <li><a href="admin/employee/system/alim.php">お知らせ</a></li>
		                                <li><a href="admin/employee/system/suggest.php">おススメの助成金</a></li>
		                                <li><a href="admin/employee/system/industry.php">業種</a></li>
		                                <li><a href="admin/employee/system/tag.php">タグ管理</a></li>
		                                <li><a href="admin/employee/system/category.php">カテゴリー管理</a></li>
		                                <li><a href="admin/employee/system/question.php">企業情報質問内容管理</a></li>
		                                <li><a href="admin/employee/system/payinfo.php">有料情報管理</a></li>
		                                <li><a href="admin/employee/system/notification.php">通知管理</a></li>
		                                <li class="active"><a href="admin/employee/system/blog.php">ブログ管理</a></li>
		                            </ul>
		                        </div>
		                    </div>
		                    <div class="col-md-9 pull-right">
		                        <div class="site-content">
		                            <div class="section-1">
		                                <!-- ngIf: messageflag -->
		                            </div>
		                            <label style="font-size:22px;">ブログ公開管理</label>
		                            <div style="border-bottom:1px solid #000000;margin-bottom:40px;"></div>
		                            <div class="section-2 col-md-12">
		                                <div class="col-md-1">
		                                </div>
		                                <div class="col-md-11">
		                                    <form class="form-horizontal ng-pristine ng-valid">
		                                        <div class="form-group" style="margin-top:30px;">
		                                            <p class="col-sm-2">絞り込み検索</p>
		                                            <div class="col-sm-4">
		                                                <input class="form-control ng-pristine ng-untouched ng-valid ng-empty" id="focusedInput" type="text" placeholder="絞り込み検索" ng-model="searchsetting.keyword" aria-invalid="false">
		                                            </div>
		                                            <div class="col-sm-4">
		                                                <input type="submit" name="submit" class="submit-blue-btn" value="検索する" ng-click="clicksearchblog()">
		                                            </div>
		                                        </div>
		                                    </form>
		                                </div>
		                            </div>
		                            <div class="section-3 col-md-12">
		                                <div class="section3-full">
		                                    <div class="section3-full-scroll">
		                                        <div class="row" style="margin-top:30px;">
		                                            <div class="col-sm-3">
		                                                <div class="angularsl">
	                                                        <select name="location"> 
	                                                            <option value="1">すべて</option>
																<option value="2">士業</option>
																<option value="3">認定士業</option>
																<option value="4">掲載ブログ</option>
	                                                        </select>
	                                                    </div>
		                                            </div>
		                                        </div>
		                                        <div class="row" style="margin-top:30px;">
		                                            <div class="col-sm-3">
		                                                <div class="angularsl">
	                                                        <select name="location"> 
	                                                            <option value="1">掲載</option>
																<option value="2">掲載終了</option>
																<option value="3">削除</option>
	                                                        </select>
	                                                    </div>
		                                            </div>
		                                            <div class="col-sm-2">
		                                                <input type="submit" name="submit" class="submit-blue-btn" value="適用" ng-click="clickchangestatus()">
		                                            </div>
		                                        </div>
		                                    </div>
		                                </div>
		                            </div>
		                            <div class="section-4 col-md-12">
		                                <table>
		                                    <thead>
		                                        <tr>
		                                            <th>
		                                                <input type="checkbox" name="yes" ng-click="headcheckboxclick()" ng-checked="headcheckboxchecked()">
		                                            </th>
		                                            <th style="width:40%">タイトル</th>
		                                            <th>作成者</th>
		                                            <th>カテゴリー</th>
		                                            <th>作成日</th>
		                                            <th>ステータス</th>
		                                        </tr>
		                                    </thead>
		                                    <tbody>
		                                        <!-- ngRepeat: tableitem in tablearray -->
		                                    </tbody>
		                                </table>
		                            </div>
		                            <div class="pagination">
		                                <ul uib-pagination="" total-items="paginationsetting.totalitemcount" max-size="5" ng-model="paginationsetting.currentpage" previous-text="前へ" next-text="次へ" first-text="最初" last-text="最後" direction-links="false" boundary-links="true" items-per-page="paginationsetting.itemperpage" class="pagination-sm ng-pristine ng-untouched ng-valid ng-isolate-scope pagination ng-not-empty" boundary-link-numbers="true" rotate="true" ng-change="paginationchange()" role="menu" aria-invalid="false">
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
