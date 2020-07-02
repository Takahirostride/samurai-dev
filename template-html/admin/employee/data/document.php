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
		                                <li class="active"><a href="admin/employee/data/document.php">書類管理</a></li>
		                                <li><a href="admin/employee/data/registration.php">登録募集施策</a></li>
		                            </ul>
		                        </div>
		                    </div>
		                    <div class="col-md-9 pull-right">
		                        <div class="site-content">
		                            <div class="blueheading"><span>アップロード書類管理</span></div>
		                            <div style="padding-left:15px;padding-right:15px;">
		                                <label style="font-size:22px;">アップロード書類一覧</label>
		                                <div style="border-bottom:1px solid #000000;margin-bottom:40px;"></div>

		                                <div class="row" style="margin-bottom:20px;">

		                                    <div class="col-sm-12">
		                                        <form class="searchPart ng-pristine ng-valid">
		                                            <div style="display: inline;margin-left:30px;" class="ng-binding">2件表示 / 13件</div>
		                                            <button type="button" class="submit-blue-search" style="margin-left:10px;" ng-click="clearsearchbox()">クリア</button>
		                                            <button type="button" class="submit-blue-search" ng-click="clicksearchbutton()">検索</button>
		                                            <input type="text" name="search" ng-model="searchkeyword" class="ng-pristine ng-untouched ng-valid ng-empty" aria-invalid="false">
		                                        </form>
		                                    </div>
		                                </div>

		                                <div class="section-4 col-md-12">
		                                    <table>
		                                        <thead>
		                                            <tr>
		                                                <th>削除</th>
		                                                <th>登録日</th>
		                                                <th>施策名</th>
		                                                <th style="width:100px;">登録機関</th>
		                                                <th>士業名</th>
		                                                <th>ファイル名</th>
		                                                <th></th>
		                                            </tr>
		                                        </thead>
		                                        <tbody>
		                                            <!-- ngRepeat: tableitem in tablearray -->
		                                            <tr class="odd" ng-repeat="tableitem in tablearray" style="">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <button type="button" class="submit-delete-button" ng-click="deletedocument(tableitem.work_set_id)"></button>
		                                                </td>
		                                                <td class="ng-binding">2017年09月08日</td>
		                                                <td class="ng-binding">葛飾区雇用関係助成金相談事業</td>
		                                                <td style="min-width:40px;" class="ng-binding"></td>
		                                                <td class="ng-binding">山田太郎（士業1）</td>
		                                                <td align="left">
		                                                    <p style="margin-top: 30px ; "><a ng-click="clickdownloadpdf(tableitem.file_path,tableitem.file_name)" class="ng-binding">9c6aa804492c57ae051e3525bdb1880c--asian-men-fashion-guy-fashion.jpg(119KB)<br></a></p>
		                                                    <p style="margin-top: 30px;  ">
		                                                        <!-- ngRepeat: pdfitem in tableitem.sub_files --><a ng-repeat="pdfitem in tableitem.sub_files" ng-click="clickdownloadpdf(pdfitem.file_path,pdfitem.file_name)" class="ng-binding ng-scope">message.html(14KB)<br></a>
		                                                        <!-- end ngRepeat: pdfitem in tableitem.sub_files -->
		                                                    </p>
		                                                </td>
		                                                <td></td>
		                                            </tr>
		                                            <!-- end ngRepeat: tableitem in tablearray -->
		                                            <tr class="" ng-repeat="tableitem in tablearray" style="">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <button type="button" class="submit-delete-button" ng-click="deletedocument(tableitem.work_set_id)"></button>
		                                                </td>
		                                                <td class="ng-binding">2017年09月08日</td>
		                                                <td class="ng-binding">葛飾区三年以内既卒者等採用定着コース奨励金</td>
		                                                <td style="min-width:40px;" class="ng-binding"></td>
		                                                <td class="ng-binding">山田太郎（士業1）</td>
		                                                <td align="left">
		                                                    <p style="margin-top: 30px ; "><a ng-click="clickdownloadpdf(tableitem.file_path,tableitem.file_name)" class="ng-binding">30-08-2017-10-52-07.png(1MB)<br></a></p>
		                                                    <p style="margin-top: 30px;  ">
		                                                        <!-- ngRepeat: pdfitem in tableitem.sub_files -->
		                                                    </p>
		                                                </td>
		                                                <td></td>
		                                            </tr>
		                                            <!-- end ngRepeat: tableitem in tablearray -->
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
		                                        <li role="menuitem" ng-repeat="page in pages track by $index" ng-class="{active: page.active,disabled: ngDisabled&amp;&amp;!page.active}" class="pagination-page ng-scope" style=""><a href="" ng-click="selectPage(page.number, $event)" ng-disabled="ngDisabled&amp;&amp;!page.active" uib-tabindex-toggle="" class="ng-binding">2</a></li>
		                                        <!-- end ngRepeat: page in pages track by $index -->
		                                        <li role="menuitem" ng-repeat="page in pages track by $index" ng-class="{active: page.active,disabled: ngDisabled&amp;&amp;!page.active}" class="pagination-page ng-scope"><a href="" ng-click="selectPage(page.number, $event)" ng-disabled="ngDisabled&amp;&amp;!page.active" uib-tabindex-toggle="" class="ng-binding">3</a></li>
		                                        <!-- end ngRepeat: page in pages track by $index -->
		                                        <li role="menuitem" ng-repeat="page in pages track by $index" ng-class="{active: page.active,disabled: ngDisabled&amp;&amp;!page.active}" class="pagination-page ng-scope"><a href="" ng-click="selectPage(page.number, $event)" ng-disabled="ngDisabled&amp;&amp;!page.active" uib-tabindex-toggle="" class="ng-binding">4</a></li>
		                                        <!-- end ngRepeat: page in pages track by $index -->
		                                        <li role="menuitem" ng-repeat="page in pages track by $index" ng-class="{active: page.active,disabled: ngDisabled&amp;&amp;!page.active}" class="pagination-page ng-scope"><a href="" ng-click="selectPage(page.number, $event)" ng-disabled="ngDisabled&amp;&amp;!page.active" uib-tabindex-toggle="" class="ng-binding">5</a></li>
		                                        <!-- end ngRepeat: page in pages track by $index -->
		                                        <li role="menuitem" ng-repeat="page in pages track by $index" ng-class="{active: page.active,disabled: ngDisabled&amp;&amp;!page.active}" class="pagination-page ng-scope"><a href="" ng-click="selectPage(page.number, $event)" ng-disabled="ngDisabled&amp;&amp;!page.active" uib-tabindex-toggle="" class="ng-binding">6</a></li>
		                                        <!-- end ngRepeat: page in pages track by $index -->
		                                        <li role="menuitem" ng-repeat="page in pages track by $index" ng-class="{active: page.active,disabled: ngDisabled&amp;&amp;!page.active}" class="pagination-page ng-scope"><a href="" ng-click="selectPage(page.number, $event)" ng-disabled="ngDisabled&amp;&amp;!page.active" uib-tabindex-toggle="" class="ng-binding">7</a></li>
		                                        <!-- end ngRepeat: page in pages track by $index -->
		                                        <!-- ngIf: ::directionLinks -->
		                                        <!-- ngIf: ::boundaryLinks -->
		                                        <li role="menuitem" ng-if="::boundaryLinks" ng-class="{disabled: noNext()||ngDisabled}" class="pagination-last ng-scope" style=""><a href="" ng-click="selectPage(totalPages, $event)" ng-disabled="noNext()||ngDisabled" uib-tabindex-toggle="" class="ng-binding">最後</a></li>
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
	</div>
<?php include ('../../inc/footer.php'); ?>
