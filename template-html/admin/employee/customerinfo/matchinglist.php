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
		                                <li><a href="admin/employee/customerinfo/agencylist.php">士業情報一覧</a></li>
		                                <li><a href="admin/employee/customerinfo/clientlist.php">事業者情報一覧</a></li>
		                                <li class="active"><a href="admin/employee/customerinfo/matchinglist.php">マッチング情報一覧</a></li>
		                            </ul>
		                        </div>
		                    </div>
		                    <div class="col-md-9 pull-right">
		                        <div class="site-content">
		                            <div class="blueheading"><span>マッチング管理</span></div>

		                            <div class="section-2 col-md-12">
		                                <div class="row">
		                                    <div class="col-md-1">
		                                    </div>
		                                    <div class="col-md-5">
		                                        <form class="form-horizontal ng-pristine ng-valid">
		                                            <div class="form-group" style="margin-top:20px;">
		                                                <p class="col-sm-7">マッチング日</p>
		                                            </div>
		                                        </form>
		                                    </div>
		                                </div>
		                                <div class="row">
		                                    <div class="col-md-1">
		                                    </div>
		                                    <div class="col-md-5">
		                                        <form class="form-horizontal ng-pristine ng-valid ng-valid-min ng-valid-max">
		                                            <div class="form-group">
		                                                <div class="col-sm-3">
		                                                    <input class="form-control ng-pristine ng-untouched ng-valid ng-not-empty ng-valid-min" id="focusedInput" type="number" min="2017" ng-model="searchcondition.year" aria-invalid="false">
		                                                </div>
		                                                <p class="col-sm-1">年</p>
		                                                <div class="col-sm-3">
		                                                    <input class="form-control ng-pristine ng-untouched ng-valid ng-not-empty ng-valid-min ng-valid-max" id="focusedInput" type="number" min="1" max="12" ng-model="searchcondition.month" aria-invalid="false">
		                                                </div>
		                                                <p class="col-sm-1">月</p>
		                                                <div class="col-sm-3">
		                                                    <input class="form-control ng-pristine ng-untouched ng-valid ng-not-empty ng-valid-min ng-valid-max" id="focusedInput" type="number" min="1" max="31" ng-model="searchcondition.day" aria-invalid="false">
		                                                </div>
		                                                <p class="col-sm-1">日</p>
		                                            </div>
		                                        </form>
		                                    </div>
		                                </div>
		                                <div class="row">
		                                    <div class="col-md-1">
		                                    </div>
		                                    <div class="col-md-1">
		                                        <form class="form-horizontal ng-pristine ng-valid">
		                                            <div class="form-group">
		                                                <p>終了報告</p>
		                                            </div>
		                                        </form>
		                                    </div>
		                                    <div class="col-md-10">
		                                        :&nbsp; &nbsp; &nbsp;
		                                        <input type="checkbox" ng-model="searchcondition.endyes" class="ng-pristine ng-untouched ng-valid ng-not-empty" aria-invalid="false">あり &nbsp; &nbsp; &nbsp;
		                                        <input type="checkbox" ng-model="searchcondition.endno" class="ng-pristine ng-untouched ng-valid ng-not-empty" aria-invalid="false">なし &nbsp; &nbsp; &nbsp;
		                                    </div>
		                                </div>
		                                <div class="row">
		                                    <div class="col-md-1">
		                                    </div>
		                                    <div class="col-md-1">
		                                        <form class="form-horizontal ng-pristine ng-valid">
		                                            <div class="form-group">
		                                                <p>着手金</p>
		                                            </div>
		                                        </form>
		                                    </div>
		                                    <div class="col-md-10">
		                                        :&nbsp; &nbsp; &nbsp;
		                                        <input type="checkbox" ng-checked="existallcondition(0)" ng-click="clickallcondition(0)">すべて &nbsp; &nbsp; &nbsp;
		                                        <input type="checkbox" ng-model="searchcondition.deposit1" class="ng-pristine ng-untouched ng-valid ng-empty" aria-invalid="false">入金あり &nbsp; &nbsp; &nbsp;
		                                        <input type="checkbox" ng-model="searchcondition.deposit2" class="ng-pristine ng-untouched ng-valid ng-empty" aria-invalid="false">入金待ち &nbsp; &nbsp; &nbsp;
		                                        <input type="checkbox" ng-model="searchcondition.deposit3" class="ng-pristine ng-untouched ng-valid ng-empty" aria-invalid="false">なし &nbsp; &nbsp; &nbsp;
		                                    </div>
		                                </div>
		                                <div class="row">
		                                    <div class="col-md-1">
		                                    </div>
		                                    <div class="col-md-1">
		                                        <form class="form-horizontal ng-pristine ng-valid">
		                                            <div class="form-group">
		                                                <p>成功報酬</p>
		                                            </div>
		                                        </form>
		                                    </div>
		                                    <div class="col-md-10">
		                                        :&nbsp; &nbsp; &nbsp;
		                                        <input type="checkbox" ng-checked="existallcondition(1)" ng-click="clickallcondition(1)">すべて &nbsp; &nbsp; &nbsp;
		                                        <input type="checkbox" ng-model="searchcondition.success_pay1" class="ng-pristine ng-untouched ng-valid ng-empty" aria-invalid="false">入金あり &nbsp; &nbsp; &nbsp;
		                                        <input type="checkbox" ng-model="searchcondition.success_pay2" class="ng-pristine ng-untouched ng-valid ng-empty" aria-invalid="false">入金待ち &nbsp; &nbsp; &nbsp;
		                                        <input type="checkbox" ng-model="searchcondition.success_pay3" class="ng-pristine ng-untouched ng-valid ng-empty" aria-invalid="false">なし &nbsp; &nbsp; &nbsp;
		                                    </div>
		                                </div>
		                                <div class="row">
		                                    <div class="col-md-1">
		                                    </div>
		                                    <div class="col-md-1">
		                                        <form class="form-horizontal ng-pristine ng-valid">
		                                            <div class="form-group">
		                                                <p>その他費用</p>
		                                            </div>
		                                        </form>
		                                    </div>
		                                    <div class="col-md-7" style="padding-left:15px;padding-right:0px;padding-top:0px;padding-bottom:0px;">
		                                        :&nbsp; &nbsp; &nbsp;
		                                        <input type="checkbox" ng-checked="existallcondition(2)" ng-click="clickallcondition(2)">すべて &nbsp; &nbsp; &nbsp;
		                                        <input type="checkbox" ng-model="searchcondition.other_money1" class="ng-pristine ng-untouched ng-valid ng-empty" aria-invalid="false">入金あり &nbsp; &nbsp; &nbsp;
		                                        <input type="checkbox" ng-model="searchcondition.other_money2" class="ng-pristine ng-untouched ng-valid ng-empty" aria-invalid="false">入金待ち &nbsp; &nbsp; &nbsp;
		                                        <input type="checkbox" ng-model="searchcondition.other_money3" class="ng-pristine ng-untouched ng-valid ng-empty" aria-invalid="false">なし &nbsp; &nbsp; &nbsp;
		                                    </div>
		                                    <div class="col-md-2">
		                                        <input type="submit" name="submit" class="submit-blue-btn" value="検索" ng-click="clicksearchmatchinlist()">
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
	                                                            <option value="1">マッチング停止</option>
																<option value="2">マッチング停止解除</option>
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

		                            <div class="section-5 col-md-12" style="overflow-x:auto;display:block;">
		                                <table>
		                                    <thead>
		                                        <tr>
		                                            <th>
		                                                <input type="checkbox" name="yes" ng-click="headcheckboxclick()" ng-checked="headcheckboxchecked()" checked="checked">
		                                            </th>
		                                            <th style="min-width:160px;">マッチング日</th>
		                                            <th style="min-width:160px;">終了日</th>
		                                            <th style="min-width:160px;">事業者名</th>
		                                            <th style="min-width:160px;">士業名</th>
		                                            <th style="min-width:180px;">取得補助金額</th>
		                                            <th style="min-width:180px;">着手金</th>
		                                            <th style="min-width:180px;">その他費用</th>
		                                            <th style="min-width:160px;">業務内容</th>
		                                        </tr>
		                                    </thead>
		                                    <tbody>
		                                        <!-- ngRepeat: tableitem in tablearray -->
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
