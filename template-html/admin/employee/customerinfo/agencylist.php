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
	                        <li class="active"><a href="admin/employee/customerinfo/agencylist.php">顧客情報管理</a></li>
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
		                                <li class="active"><a href="admin/employee/customerinfo/agencylist.php">士業情報一覧</a></li>
		                                <li><a href="admin/employee/customerinfo/clientlist.php">事業者情報一覧</a></li>
		                                <li><a href="admin/employee/customerinfo/matchinglist.php">マッチング情報一覧</a></li>
		                            </ul>
		                        </div>
		                    </div>
		                    <div class="col-md-9 pull-right">
		                        <div class="site-content">
		                            <div class="blueheading"><span>士業情報一覧</span></div>

		                            <div class="section-2 col-md-12">
		                                <div class="row">
		                                    <div class="col-md-1">
		                                    </div>
		                                    <div class="col-md-5">
		                                        <form class="form-horizontal ng-pristine ng-valid">
		                                            <div class="form-group" style="margin-top:20px;">
		                                                <p class="col-sm-4">士業名</p>
		                                                <div class="col-sm-7">
		                                                    <input class="form-control ng-pristine ng-untouched ng-valid ng-empty" id="focusedInput" type="text" placeholder="士業名" ng-model="searchsetting.name" aria-invalid="false">
		                                                </div>
		                                            </div>
		                                        </form>
		                                    </div>
		                                    <div class="col-md-5">
		                                        <form class="form-horizontal ng-pristine ng-valid">
		                                            <div class="form-group" style="margin-top:20px;">
		                                                <p class="col-sm-4">都道府県</p>
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
		                                </div>
		                                <div class="row">
		                                    <div class="col-md-1">
		                                    </div>
		                                    <div class="col-md-11">
		                                        <input type="checkbox" ng-checked="allpayrollchecked()" ng-click="allpayrollclick()" checked="checked">すべて &nbsp; &nbsp; &nbsp;
		                                        <input type="checkbox" ng-model="searchsetting.paidflag" class="ng-pristine ng-untouched ng-valid ng-not-empty" aria-invalid="false">有料会員のみ &nbsp; &nbsp; &nbsp;
		                                        <input type="checkbox" ng-model="searchsetting.freeflag" class="ng-pristine ng-untouched ng-valid ng-not-empty" aria-invalid="false">無料会員のみ &nbsp; &nbsp; &nbsp; (
		                                        <input type="checkbox" ng-model="searchsetting.stopflag" class="ng-pristine ng-untouched ng-valid ng-empty" aria-invalid="false">アカウント停止を表示) &nbsp; &nbsp; &nbsp;
		                                    </div>
		                                </div>
		                                <div class="row" style="margin-top:15px;">
		                                    <div class="col-md-1">
		                                    </div>
		                                    <div class="col-md-11">
		                                        <input type="checkbox" ng-checked="agencytypechecked(0)" ng-click="agencytypeclick(0)">税理士 &nbsp; &nbsp; &nbsp;
		                                        <input type="checkbox" ng-checked="agencytypechecked(1)" ng-click="agencytypeclick(1)">司法書士 &nbsp; &nbsp; &nbsp;
		                                        <input type="checkbox" ng-checked="agencytypechecked(2)" ng-click="agencytypeclick(2)">行政書士 &nbsp; &nbsp; &nbsp;
		                                        <input type="checkbox" ng-checked="agencytypechecked(3)" ng-click="agencytypeclick(3)">社労士 &nbsp; &nbsp; &nbsp;
		                                        <input type="checkbox" ng-checked="agencytypechecked(4)" ng-click="agencytypeclick(4)">弁護士 &nbsp; &nbsp; &nbsp;
		                                        <input type="checkbox" ng-checked="agencytypechecked(5)" ng-click="agencytypeclick(5)">弁理士 &nbsp; &nbsp; &nbsp;
		                                        <input type="checkbox" ng-checked="agencytypechecked(6)" ng-click="agencytypeclick(6)">中小企業診断士 &nbsp; &nbsp; &nbsp;
		                                        <input type="checkbox" ng-checked="agencytypechecked(-1)" ng-click="agencytypeclick(-1)">その他 &nbsp; &nbsp; &nbsp;
		                                    </div>
		                                </div>
		                                <div class="row">
		                                    <div class="col-md-1">
		                                    </div>
		                                    <div class="col-md-5">
		                                        <form class="form-horizontal ng-pristine ng-valid">
		                                            <div class="form-group" style="margin-top:20px;">
		                                                <p class="col-sm-4">最終ログイン</p>
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
		                                </div>
		                                <div class="row" style="margin-top:10px;">
		                                    <div class="col-md-1">
		                                    </div>
		                                    <div class="col-md-8">
		                                        <!--<input type="checkbox" ng-model="searchsetting.pay_option">有料オプション &nbsp; &nbsp; &nbsp; -->
		                                    </div>
		                                    <div class="col-md-3">
		                                        <input type="submit" name="submit" class="submit-blue-btn" value="検索" ng-click="clicksearchagency()">
		                                    </div>
		                                </div>
		                            </div>
		                            <div class="section-3 col-md-12">
		                                <div class="section3-full">
		                                    <div class="section3-full-scroll">
		                                        <div class="row" style="margin-top:30px;">
		                                            <div class="col-sm-3">
		                                            	<div class="angularsl">
	                                                        <select name="location"> 
	                                                            <option value="1">アカウントの停止</option> 
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
		                            <div class="section-5 col-md-12" style="overflow-x:auto;display:block;">
		                                <table>
		                                    <thead>
		                                        <tr>
		                                            <th>
		                                                <input type="checkbox" name="yes" ng-click="headcheckboxclick()" ng-checked="headcheckboxchecked()">
		                                            </th>
		                                            <th style="min-width:160px;">登録日</th>
		                                            <th style="min-width:120px;">ユーザーID</th>
		                                            <th style="min-width:120px;">表示名</th>
		                                            <th style="min-width:120px;">登録者名</th>
		                                            <th style="min-width:180px;">区分</th>
		                                            <th style="min-width:180px;">都道府県</th>
		                                            <th style="min-width:180px;">市区町村</th>
		                                            <th style="min-width:120px;">住所</th>
		                                            <th style="min-width:120px;">電話番号</th>
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