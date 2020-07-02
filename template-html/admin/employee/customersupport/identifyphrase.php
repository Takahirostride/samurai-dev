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
		                                <li><a href="admin/employee/customersupport/identifydoc.php">本人確認書類管理</a></li>
		                                <li class="active"><a href="admin/employee/customersupport/identifyphrase.php">本人確認書類対応設定</a></li>
		                                <li><a href="admin/employee/customersupport/violator.php">違反者管理</a></li>
		                                <li><a href="admin/employee/customersupport/violatorphrase.php">違反者対応設定</a></li>
		                                <li><a href="admin/employee/customersupport/manageadvertise.php">広告掲載管理</a></li>
		                            </ul>
		                        </div>
		                    </div>
		                    <div class="col-md-9 pull-right">
		                        <div class="site-content">
		                            <div class="blueheading"><span>本人確認定型文管理</span></div>
		                            <div class="row" style="margin-left:0px;margin-right:0px;">
		                                <div class="section-5 col-md-12" style="display:block;">
		                                    <table>
		                                        <thead>
		                                            <tr>
		                                                <th>選択</th>
		                                                <th style="max-width:105px;">承認・未承認</th>
		                                                <th style="max-width:60px;">項目名</th>
		                                                <th style="max-width:150px;">件名</th>
		                                                <th style="max-width:150px;">本文</th>
		                                            </tr>
		                                        </thead>
		                                        <tbody>
		                                            <!-- ngRepeat: tableitem in tablearray -->
		                                            <tr ng-repeat="tableitem in tablearray" ng-click="edittemplate($index)" class="ng-scope" role="button" tabindex="0" style="">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" name="yes" ng-click="clickitemcheckbox(tableitem.id)" ng-checked="existitemcheckbox(tableitem.id)">
		                                                </td>
		                                                <td style="max-width:105px;" class="ng-binding">承認</td>
		                                                <td style="max-width:15px;" class="ng-binding">dasfads</td>
		                                                <td style="max-width:60px;" class="ng-binding">adsfasdf</td>
		                                                <td class="overflow-visible ng-binding" style="max-width:250px;">sadfasdfdsf sdfads</td>
		                                            </tr>
		                                            <!-- end ngRepeat: tableitem in tablearray -->
		                                            <tr ng-repeat="tableitem in tablearray" ng-click="edittemplate($index)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" name="yes" ng-click="clickitemcheckbox(tableitem.id)" ng-checked="existitemcheckbox(tableitem.id)">
		                                                </td>
		                                                <td style="max-width:105px;" class="ng-binding">承認</td>
		                                                <td style="max-width:15px;" class="ng-binding">adsfasdf</td>
		                                                <td style="max-width:60px;" class="ng-binding">dfasdfdsa</td>
		                                                <td class="overflow-visible ng-binding" style="max-width:250px;">fsdafds asd fasdfasd dsfasdf sad fsadf sdaf sdafsdafsda sdafsda</td>
		                                            </tr>
		                                            <!-- end ngRepeat: tableitem in tablearray -->
		                                            <tr ng-repeat="tableitem in tablearray" ng-click="edittemplate($index)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" name="yes" ng-click="clickitemcheckbox(tableitem.id)" ng-checked="existitemcheckbox(tableitem.id)">
		                                                </td>
		                                                <td style="max-width:105px;" class="ng-binding">承認</td>
		                                                <td style="max-width:15px;" class="ng-binding">sadfdsaf</td>
		                                                <td style="max-width:60px;" class="ng-binding">dsfsadfdsa sdfdsa fdsa fasd fasd</td>
		                                                <td class="overflow-visible ng-binding" style="max-width:250px;">テスチ</td>
		                                            </tr>
		                                            <!-- end ngRepeat: tableitem in tablearray -->
		                                            <tr ng-repeat="tableitem in tablearray" ng-click="edittemplate($index)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" name="yes" ng-click="clickitemcheckbox(tableitem.id)" ng-checked="existitemcheckbox(tableitem.id)">
		                                                </td>
		                                                <td style="max-width:105px;" class="ng-binding">承認</td>
		                                                <td style="max-width:15px;" class="ng-binding">sdafdsaf</td>
		                                                <td style="max-width:60px;" class="ng-binding">dsafdsafds</td>
		                                                <td class="overflow-visible ng-binding" style="max-width:250px;">afdsafda</td>
		                                            </tr>
		                                            <!-- end ngRepeat: tableitem in tablearray -->
		                                        </tbody>
		                                    </table>
		                                </div>
		                            </div>
		                            <div class="row" style="margin-left:0px;margin-right:0px;">
		                                <div class="col-md-2">
		                                    <input type="submit" style="margin-top:15px;position:absolute;top:23px;z-index: 1;" name="submit" class="submit-blue-btn" value="削除する" ng-click="deletetemplates()">
		                                </div>
		                                <div class="col-md-12">
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
		                            <div class="col-md-12" style="background:#e0dec8;height:18px;margin-top:20px;"></div>
		                            <div class="col-md-12" style="padding-left:50px;padding-right:50px;margin-top:30px;">
		                                <input type="submit" name="submit" style="position:initial;margin-left:0px;" class="submit-blue-btn" value="新規登録" ng-click="newtemplate()">
		                                <div class="add-container" style "margin-left:0px;margin-right:0px;"="">

		                                    <div class="row">
		                                        <div class="col-md-3" style="background:#fff;">
		                                            <div class="gridcell-left">
		                                                <p style="font-size:14px;">承認・未承認</p>
		                                            </div>
		                                        </div>
		                                        <div class="col-md-9">
		                                            <div class="gridcell-right" style="height:40px;">
		                                                <label>
		                                                    <input type="radio" ng-checked="addtemplatedata.complete==2" ng-model="addtemplatedata.complete" value="2" name="amount" class="ng-pristine ng-untouched ng-valid ng-not-empty" checked="checked" aria-invalid="false"> 承認&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
		                                                </label>
		                                                <label>
		                                                    <input type="radio" ng-checked="addtemplatedata.complete==1" ng-model="addtemplatedata.complete" value="1" name="amount" class="ng-pristine ng-untouched ng-valid ng-not-empty" aria-invalid="false"> 未承認&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
		                                                </label>
		                                            </div>

		                                        </div>
		                                    </div>
		                                    <div class="row">
		                                        <div class="col-md-3" style="background:#fff;">
		                                            <div class="gridcell-left">
		                                                <p style="font-size:14px;">項目名</p>
		                                            </div>
		                                        </div>
		                                        <div class="col-md-9">
		                                            <div class="gridcell-right">
		                                                <input class="form-control ng-pristine ng-untouched ng-valid ng-empty" type="text" ng-model="addtemplatedata.item_name" aria-invalid="false">
		                                            </div>

		                                        </div>
		                                    </div>
		                                    <div class="row">
		                                        <div class="col-md-3" style="background:#fff;">
		                                            <div class="gridcell-left">
		                                                <p style="font-size:14px;">件名</p>
		                                            </div>
		                                        </div>
		                                        <div class="col-md-9">
		                                            <div class="gridcell-right">
		                                                <input class="form-control ng-pristine ng-untouched ng-valid ng-empty" type="text" ng-model="addtemplatedata.title" aria-invalid="false">
		                                            </div>

		                                        </div>
		                                    </div>
		                                    <div class="row">
		                                        <div class="col-md-3" style="height:120px;background:#fff;">
		                                            <div class="gridcell-left">
		                                                <p style="font-size:14px;position: relative;top:40%;">本文</p>
		                                            </div>
		                                        </div>
		                                        <div class="col-md-9">
		                                            <div class="gridcell-right">
		                                                <textarea name="Text1" class="form-control ng-pristine ng-untouched ng-valid ng-empty" style="width:100%;" rows="5" ng-model="addtemplatedata.text" aria-invalid="false"></textarea>
		                                            </div>
		                                        </div>
		                                    </div>
		                                </div>

		                                <div style="margin-top:50px;">
		                                    <input type="submit" name="submit" class="submit-blue-btn" value="登録する" ng-click="savetemplatedata()">
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
