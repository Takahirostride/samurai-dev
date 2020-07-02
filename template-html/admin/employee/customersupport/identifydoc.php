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
	                        <li class="active"><a href="admin/employee/customersupport/inquiry.php">顧客対応管理</a></li>
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
		                                <li><a href="admin/employee/customersupport/inquiry.php">お問い合わせ管理</a></li>
		                                <li><a href="admin/employee/customersupport/contact.php">お問い合わせ対応設定</a></li>
		                                <li class="active"><a href="admin/employee/customersupport/identifydoc.php">本人確認書類管理</a></li>
		                                <li><a href="admin/employee/customersupport/identifyphrase.php">本人確認書類対応設定</a></li>
		                                <li><a href="admin/employee/customersupport/violator.php">違反者管理</a></li>
		                                <li><a href="admin/employee/customersupport/violatorphrase.php">違反者対応設定</a></li>
		                                <li><a href="admin/employee/customersupport/manageadvertise.php">広告掲載管理</a></li>
		                            </ul>
		                        </div>
		                    </div>
		                    <div class="col-md-9 pull-right">
		                        <div class="site-content">
		                            <div class="blueheading"><span>本人確認書類管理</span></div>
		                            <div class="section-3 col-md-12" style="padding-left:0px;">
		                                <div class="section3-full" style="padding-left:0px;">
		                                    <div class="section3-full-scroll" style="padding-left:8px;">
		                                        <div class="row">
		                                            <div class="col-sm-3">
		                                            	<div class="angularsl">
	                                                        <select name="location"> 
	                                                            <option value="1">すべて</option>
																<option value="2">承認</option>
																<option value="3">未承認</option>
	                                                        </select>
	                                                    </div> 
		                                            </div>
		                                        </div>
		                                    </div>
		                                </div>
		                            </div>

		                            <div class="section-5 col-md-12" style="display:block;">
		                                <table>
		                                    <thead>
		                                        <tr>
		                                            <th style="width:15%;">日時</th>
		                                            <th style="width:15%;">送信者</th>
		                                            <th style="width:15%;">対応者</th>
		                                            <th style="width:20%;">ステータス</th>
		                                            <th style="width:35%;">コメント</th>
		                                        </tr>
		                                    </thead>
		                                    <tbody>
		                                        <!-- ngRepeat: tableitem in tablearray -->
		                                        <tr class="odd tr-selected" ng-class="{'tr-selected': $index == selectedRow}" ng-repeat="tableitem in tablearray" ng-click="clicktableitem($index)" role="button" tabindex="0" style="">
		                                            <td class="ng-binding">2018年09月07日</td>
		                                            <td class="ng-binding">テスト</td>
		                                            <td class="ng-binding">administrator</td>
		                                            <td>
		                                                <!-- ngIf: tableitem.state==1 -->
		                                                <text ng-if="tableitem.state==1" class="ng-scope">承認</text>
		                                                <!-- end ngIf: tableitem.state==1 -->
		                                                <!-- ngIf: tableitem.state==0 -->
		                                            </td>
		                                            <td class="ng-binding">確認いたしました</td>
		                                        </tr>
		                                        <!-- end ngRepeat: tableitem in tablearray -->
		                                        <tr class="" ng-class="{'tr-selected': $index == selectedRow}" ng-repeat="tableitem in tablearray" ng-click="clicktableitem($index)" role="button" tabindex="0" style="">
		                                            <td class="ng-binding">2018年09月10日</td>
		                                            <td class="ng-binding">山田太郎（士業1）</td>
		                                            <td class="ng-binding"></td>
		                                            <td>
		                                                <!-- ngIf: tableitem.state==1 -->
		                                                <!-- ngIf: tableitem.state==0 -->
		                                                <text ng-if="tableitem.state==0" class="ng-scope">未承認</text>
		                                                <!-- end ngIf: tableitem.state==0 -->
		                                            </td>
		                                            <td class="ng-binding"></td>
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
		                                    <!-- ngIf: ::directionLinks -->
		                                    <!-- ngIf: ::boundaryLinks -->
		                                    <li role="menuitem" ng-if="::boundaryLinks" ng-class="{disabled: noNext()||ngDisabled}" class="pagination-last ng-scope disabled"><a href="" ng-click="selectPage(totalPages, $event)" ng-disabled="noNext()||ngDisabled" uib-tabindex-toggle="" class="ng-binding" disabled="disabled" tabindex="-1">最後</a></li>
		                                    <!-- end ngIf: ::boundaryLinks -->
		                                </ul>
		                            </div>

		                            <div class="col-md-12" style="background:#e0dec8;height:18px;margin-top:20px;"></div>
		                            <div class="col-md-12">

		                                <div class="row">
		                                    <div class="col-md-9" style="background:#fff;">
		                                        <div class="gridcell-left">
		                                            <!--<p style="font-size:14px;" ng-bind="bottomleftsetting.id"></p>-->
		                                            <p><span ng-bind="bottomleftsetting.id" class="ng-binding"></span> (送信者 ID) &nbsp; &nbsp; &nbsp; <span ng-bind="bottomleftsetting.displayname" class="ng-binding"></span> (送信者名)</p>
		                                            <div class="row" style="margin-left:-40px;margin-right:-15px;">
		                                                <div class="col-md-5" style="width:38%;border-bottom:#000 1px solid;margin-top:10px;"></div>
		                                                <p class="col-md-2" style="font-size:14px;width:24%;text-align:center;padding-left:0px;padding-right:0px;">本人確認書類</p>
		                                                <div class="col-md-5" style="width:38%;border-bottom:#000 1px solid;margin-top:10px;"></div>
		                                            </div>

		                                            <div class="row" style="margin-left:20px; margin-top: 20px;text-align:left;">
		                                                <!-- ngRepeat: fileitem in bottomleftsetting.files -->
		                                            </div>

		                                            <div class="row" style="margin-left:-40px;margin-right:-15px;margin-top:20px;">
		                                                <div class="col-md-5" style="width:100%;border-bottom:#000 1px solid;margin-top:10px;"></div>
		                                            </div>

		                                            <div class="row" style="margin-left:-40px;margin-right:-15px;">

		                                                <div class="gridcell-left" style="padding-top:2px;">
		                                                    <div class="row" style="margin-left:0px;margin-right:0px;">
		                                                        <div class="col-md-4" style="background:#fff;">
		                                                        	<div class="angularsl">
				                                                        <select name="location"> 
				                                                            <option value="1">dasfads</option>
																			<option value="2">dasfads</option>
																			<option value="3">dasfads</option>
				                                                        </select>
				                                                    </div>  
		                                                        </div>
		                                                    </div>
		                                                </div>

		                                                <div class="gridcell-left">
		                                                    <p style="font-size:14px;">件名　&nbsp; &nbsp;<span ng-bind="templatedata[selectedtemplateindex].title" class="ng-binding">adsfasdf</span></p>
		                                                </div>

		                                                <div class="gridcell-left" style="min-height:202px;border-bottom:0px;">
		                                                    <p class="overflow-visible ng-binding" ng-bind="templatedata[selectedtemplateindex].text">sadfasdfdsf sdfads</p>
		                                                </div>
		                                            </div>

		                                        </div>
		                                        <div class="gridcell-left">
		                                            <input type="submit" name="submit" class="submit-blue-btn" value="送信する" ng-click="sendlefttemplate()">
		                                        </div>
		                                    </div>
		                                    <div class="col-md-3" style="padding-left:15px;padding-top:15px;">
		                                        <p>対応者</p>
		                                        <p class="ng-binding">administrator</p>
		                                        <p>ステータス変更</p>
		                                        <p>
		                                        	<div class="angularsl">
                                                        <select name="location"> 
                                                            <option value="1">承認</option>
															<option value="2">未承認</option> 
                                                        </select>
                                                    </div>   
		                                        </p>
		                                        <p>コメント</p>
		                                        <p>
		                                            <textarea name="Text1" class="form-control ng-pristine ng-untouched ng-valid ng-empty" style="width:100%;" rows="10" ng-model="bottomrightsetting.content" aria-invalid="false"></textarea>
		                                        </p>
		                                        <input type="submit" name="submit" class="submit-blue-btn" value="変更する" ng-click="sendrightcomment()">

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
	</div>
<?php include ('../../inc/footer.php'); ?>
