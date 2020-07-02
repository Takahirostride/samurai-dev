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
	                        <li><a href="admin/employee/data/subsidylist.php">施策データ管理</a></li>
	                        <li class="active"><a href="admin/employee/other/affiliate.php">その他管理</a></li>
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
		                                <li><a href="admin/employee/other/affiliate.php">アフィリエイター管理</a></li>
		                                <li><a href="admin/employee/other/payment.php">支払管理</a></li>
		                                <li><a href="admin/employee/other/paydata.php">支払管理データ総括</a></li>
		                                <li><a href="admin/employee/other/companies.php">仕事提携可能会社一覧</a></li>
		                                <li><a href="admin/employee/other/data.php">仕事提携可能会社データ総括</a></li>
		                                <li><a href="admin/employee/other/seminardata.php">セミナーデータ一覧</a></li>
		                                <li class="active"><a href="admin/employee/other/seminarapplicant.php">セミナー申込者一覧</a></li>
		                            </ul>
		                        </div>
		                    </div>
		                    <div class="col-md-9 pull-right">
		                        <div class="site-content">
		                            <div class="section-1">
		                                <div class="success-msg">
		                                    <span>新規スタッフを登録しました。</span>
		                                </div>
		                            </div>

		                            <div class="section-2 col-md-12">

		                                <div class="row">
		                                    <div class="col-sm-1" style="margin-top:20px;padding-right:0px;">
		                                        <span class="glyphicon glyphicon-triangle-left" style="font-size:30px;margin-top:80px;float:right;" ng-click="clickprev()" role="button" tabindex="0"></span>
		                                    </div>
		                                    <div class="col-sm-10" style="padding-left:0px;padding-right:0px;">
		                                        <div class="add-container" style "margin-left:0px;margin-right:0px;"="">

		                                            <div class="row" style="height:180px;">
		                                                <div class="col-md-2" style="background:#fff;height:180px;padding-left:0px;padding-right:0px;">
		                                                    <div class="gridcell-left" style="padding-left:0px;">
		                                                        <p style="font-size:18px;margin-top:25px;text-align:center;"><b style="font-size:28px;" class="ng-binding">10.19</b>（月）</p>
		                                                    </div>
		                                                </div>
		                                                <div class="col-md-1" style="background:#fff;padding-left:0px;padding-right:0px;height:180px;">
		                                                    <div class="gridcell-left" style="padding-left:0px;">
		                                                        <p style="font-size:18px;margin-top:70px;text-align:center;" class="ng-binding">Denver</p>
		                                                    </div>
		                                                </div>
		                                                <div class="col-md-9" style="background:#fff;padding-left:0px;height:180px;">
		                                                    <div class="gridcell-right" style="height:180px;">
		                                                        <p style="font-size:18px;margin-top:10px;color:#0E71B5;font-weight:600;" class="ng-binding">Event for test</p>
		                                                        <p style="font-size:16px;margin-top:10px;margin-bottom:0px;" class="ng-binding">
		                                                            場所：Denver&nbsp;Los Angeles
		                                                        </p>
		                                                        <p style="font-size:16px;margin-bottom:0px;" class="ng-binding">
		                                                            時間：12時~15時
		                                                        </p>
		                                                        <p style="font-size:16px;margin-bottom:0px;" class="ng-binding">
		                                                            参加者：2人/25人
		                                                        </p>
		                                                        <p style="font-size:16px;margin-bottom:0px;" class="ng-binding">
		                                                            参加費：50
		                                                        </p>
		                                                    </div>

		                                                </div>
		                                            </div>
		                                        </div>
		                                    </div>
		                                    <div class="col-sm-1" style="margin-top:20px;padding-left:0px;">
		                                        <span class="glyphicon glyphicon-triangle-right" style="font-size:30px;margin-top:80px;" ng-click="clicknext()" role="button" tabindex="0"></span>
		                                    </div>
		                                </div>
		                            </div>

		                            <div class="section-3 col-md-12">
		                                <h4 style="margin-bottom:20px;width:100%;">申込者一覧</h4>
		                                <div class="section3-full">
		                                    <div class="section3-full-scroll" style="padding-top:0px;">
		                                        <div class="row" style="margin-top:30px;">
		                                            <div class="col-sm-3">
		                                            	<div class="angularsl">
	                                                        <select name="location"> 
	                                                            <option value="1">キャンセル</option> 
	                                                            <option value="2">申込中</option> 
	                                                            <option value="3">キャンセル</option> 
	                                                            <option value="4">削除</option> 
	                                                        </select>
	                                                    </div>  
		                                            </div>
		                                            <div class="col-sm-2">
		                                                <input type="submit" name="submit" class="submit-blue-btn" value="適用" ng-click="clickchangestatus()">
		                                            </div>
		                                        </div>
		                                    </div>
		                                    <div class="pos-right ng-binding">件表示 / 件</div>
		                                </div>
		                            </div>

		                            <div class="section-4 col-md-12" style="overflow-x:auto;display:block;">
		                                <table>
		                                    <thead>
		                                        <tr>
		                                            <th>
		                                                <input type="checkbox" name="yes" ng-checked="checkedalltableitem()" ng-click="clickalltableitem()">
		                                            </th>
		                                            <th style="min-width:120px;">ステータス</th>
		                                            <th style="min-width:120px;">氏名</th>
		                                            <th style="min-width:120px;">氏名カナ</th>
		                                            <th style="min-width:120px;">企業名</th>
		                                            <th style="min-width:120px;">企業URL</th>
		                                            <th style="min-width:150px;">役職名</th>
		                                            <th style="min-width:150px;">メールアドレス</th>
		                                            <th style="min-width:120px;">電話番号</th>
		                                            <th style="min-width:220px;">事業内容、自己紹介</th>
		                                            <th style="min-width:360px;">紹介者（社）名・どこで知ったか</th>
		                                        </tr>
		                                    </thead>
		                                    <tbody>
		                                        <!-- ngRepeat: tableitem in tablearray -->
		                                        <tr class="odd" ng-repeat="tableitem in tablearray" ng-click="viewdetailapplicant($index)" role="button" tabindex="0" style="">
		                                            <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                <input type="checkbox" name="yes" ng-checked="existtableitem(tableitem.id)" ng-click="clicktableitem(tableitem.id)">
		                                            </td>
		                                            <td class="ng-binding">申込中</td>
		                                            <td class="ng-binding">adsf&nbsp;ad</td>
		                                            <td class="ng-binding">asdf&nbsp;asfd</td>
		                                            <td class="ng-binding">adsf</td>
		                                            <td class="ng-binding">adfs</td>
		                                            <td class="ng-binding">afd</td>
		                                            <td class="ng-binding">topjobstar@gmail.com</td>
		                                            <td class="ng-binding">243243243</td>
		                                            <td class="ng-binding">adffdsafdsafdsafdsafdsa</td>
		                                            <td class="ng-binding">afasdfsafdsafdsafdsafdsafdsa</td>
		                                        </tr>
		                                        <!-- end ngRepeat: tableitem in tablearray -->
		                                        <tr class="" ng-repeat="tableitem in tablearray" ng-click="viewdetailapplicant($index)" role="button" tabindex="0" style="">
		                                            <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                <input type="checkbox" name="yes" ng-checked="existtableitem(tableitem.id)" ng-click="clicktableitem(tableitem.id)">
		                                            </td>
		                                            <td class="ng-binding">申込中</td>
		                                            <td class="ng-binding">fsd&nbsp;asfd</td>
		                                            <td class="ng-binding">fafd&nbsp;afds</td>
		                                            <td class="ng-binding">afs</td>
		                                            <td class="ng-binding">fads</td>
		                                            <td class="ng-binding">afsd</td>
		                                            <td class="ng-binding">fasd@afd.adsf</td>
		                                            <td class="ng-binding">afds</td>
		                                            <td class="ng-binding">ads</td>
		                                            <td class="ng-binding">afsd</td>
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

		                        </div>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
	</div>
<?php include ('../../inc/footer.php'); ?>
