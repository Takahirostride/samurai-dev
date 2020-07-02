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
		                                <li class="active"><a href="admin/employee/system/industry.php">業種</a></li>
		                                <li><a href="admin/employee/system/tag.php">タグ管理</a></li>
		                                <li><a href="admin/employee/system/category.php">カテゴリー管理</a></li>
		                                <li><a href="admin/employee/system/question.php">企業情報質問内容管理</a></li>
		                                <li><a href="admin/employee/system/payinfo.php">有料情報管理</a></li>
		                                <li><a href="admin/employee/system/notification.php">通知管理</a></li>
		                                <li><a href="admin/employee/system/blog.php">ブログ管理</a></li>
		                            </ul>
		                        </div>
		                    </div>
		                    <div class="col-md-9 pull-right">
		                        <div class="site-content">
		                            <div class="blueheading"><span>項目設定管理</span></div>

		                            <div id="content-nav">
		                                <div class="horizontal-menu navbar-collapse collapse ">
		                                    <ul class="nav navbar-nav">
		                                        <li><a style="width: 200px" class="active" href="admin/employee/system/industry.php">業種</a></li>
		                                        <li><a style="width: 200px" href="admin/employee/system/tag.php">タグ</a></li>
		                                        <li><a style="width: 200px" href="admin/employee/system/category.php">カテゴリー</a></li>
		                                        <li><a style="width: 200px" href="admin/employee/system/question.php">企業情報質問内容</a></li>
		                                    </ul>

		                                </div>
		                            </div>

		                            <fieldset class="scheduler-border">
		                                <legend class="scheduler-border">登録した業種</legend>

		                                <div class="control-group" style="margin-bottom:20px;">
		                                    <div class="controls">
		                                        <div class="col-sm-7" style="padding-left: 0px;">
		                                            <div class="col-sm-7" style="margin-top: 2px; padding-left: 0px;">
		                                                <p class="col-sm-3" style="padding-left: 0px;">業種:</p>
		                                                <input class="col-sm-9 ng-pristine ng-untouched ng-valid ng-empty" type="text" ng-model="newindustry" style="margin-left: -25px;" aria-invalid="false">
		                                            </div>
		                                            <div class="col-sm-5" style="margin-top: 2px; margin-left: -30px;">
		                                                <p class="col-sm-6">並び順:</p>
		                                                <input class="col-sm-6 ng-pristine ng-untouched ng-valid ng-not-empty ng-valid-min" type="number" min="1" ng-model="neworder" style="margin-left: -20px;" aria-invalid="false">
		                                            </div>
		                                        </div>
		                                        <!-- ngIf: editindustryflag==0 -->
		                                        <button type="button" class="submit-blue-left ng-scope" style="width:100px;" ng-click="addnewindustry()" ng-if="editindustryflag==0">新規登録</button>
		                                        <!-- end ngIf: editindustryflag==0 -->
		                                        <!-- ngIf: editindustryflag==1 -->
		                                        <button type="button" class="submit-blue-left" style="width:100px; margin-left:30px;" ng-click="clearcontent()">クリアー</button>
		                                    </div>
		                                </div>

		                                <div class="control-group" style="margin-bottom:20px;">
		                                    <div class="controls">
		                                        <div class="col-sm-4" style="padding-left: 0px;">
		                                            <div class="angularsl">
                                                        <select name="location"> 
                                                            <option value="1">非表示</option>
															<option value="2">削除</option>
															<option value="3">表示</option>
															<option value="4">非表示</option>
                                                        </select>
                                                    </div>
		                                        </div>
		                                        <button type="button" class="submit-blue-left" style="width:100px;" ng-click="changestatustop()">適用</button>
		                                    </div>
		                                </div>

		                                <table class="table table-bordered" style="text-align:center;">
		                                    <thead>
		                                        <tr>
		                                            <th width="6%" style="text-align:center;">選択
		                                                <input type="checkbox" ng-show="false" ng-checked="existalltoparray()" ng-click="clickalltoparray()" aria-hidden="true" class="ng-hide">
		                                            </th>
		                                            <th width="16%" style="text-align:center;">並び順</th>
		                                            <th style="text-align:center;">業種</th>
		                                            <th width="20%" style="text-align:center;">表示</th>
		                                        </tr>
		                                    </thead>
		                                    <tbody>
		                                        <!-- ngRepeat: industryitem in toptablearray track by $index -->
		                                        <tr ng-repeat="industryitem in toptablearray track by $index" ng-click="editindustrycontent(industryitem.trade ,industryitem.id, industryitem.order)" class="ng-scope" role="button" tabindex="0" style="">
		                                            <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                <input type="checkbox" ng-checked="existtopitem(industryitem.id)" ng-click="clicktopitem(industryitem.id)">
		                                            </td>
		                                            <td class="ng-binding">1</td>
		                                            <td class="ng-binding">農林水産業</td>
		                                            <td class="ng-binding">1</td>
		                                        </tr>
		                                        <!-- end ngRepeat: industryitem in toptablearray track by $index -->
		                                        <tr ng-repeat="industryitem in toptablearray track by $index" ng-click="editindustrycontent(industryitem.trade ,industryitem.id, industryitem.order)" class="ng-scope" role="button" tabindex="0">
		                                            <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                <input type="checkbox" ng-checked="existtopitem(industryitem.id)" ng-click="clicktopitem(industryitem.id)">
		                                            </td>
		                                            <td class="ng-binding">2</td>
		                                            <td class="ng-binding">運輸業，郵便業</td>
		                                            <td class="ng-binding">1</td>
		                                        </tr>
		                                        <!-- end ngRepeat: industryitem in toptablearray track by $index -->
		                                        <tr ng-repeat="industryitem in toptablearray track by $index" ng-click="editindustrycontent(industryitem.trade ,industryitem.id, industryitem.order)" class="ng-scope" role="button" tabindex="0">
		                                            <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                <input type="checkbox" ng-checked="existtopitem(industryitem.id)" ng-click="clicktopitem(industryitem.id)">
		                                            </td>
		                                            <td class="ng-binding">3</td>
		                                            <td class="ng-binding">派遣業・有料職業紹介業</td>
		                                            <td class="ng-binding">1</td>
		                                        </tr>
		                                        <!-- end ngRepeat: industryitem in toptablearray track by $index -->
		                                        <tr ng-repeat="industryitem in toptablearray track by $index" ng-click="editindustrycontent(industryitem.trade ,industryitem.id, industryitem.order)" class="ng-scope" role="button" tabindex="0">
		                                            <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                <input type="checkbox" ng-checked="existtopitem(industryitem.id)" ng-click="clicktopitem(industryitem.id)">
		                                            </td>
		                                            <td class="ng-binding">4</td>
		                                            <td class="ng-binding">IT業</td>
		                                            <td class="ng-binding">1</td>
		                                        </tr>
		                                        <!-- end ngRepeat: industryitem in toptablearray track by $index -->
		                                        <tr ng-repeat="industryitem in toptablearray track by $index" ng-click="editindustrycontent(industryitem.trade ,industryitem.id, industryitem.order)" class="ng-scope" role="button" tabindex="0">
		                                            <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                <input type="checkbox" ng-checked="existtopitem(industryitem.id)" ng-click="clicktopitem(industryitem.id)">
		                                            </td>
		                                            <td class="ng-binding">5</td>
		                                            <td class="ng-binding">情報通信業</td>
		                                            <td class="ng-binding">1</td>
		                                        </tr>
		                                        <!-- end ngRepeat: industryitem in toptablearray track by $index -->
		                                        <tr ng-repeat="industryitem in toptablearray track by $index" ng-click="editindustrycontent(industryitem.trade ,industryitem.id, industryitem.order)" class="ng-scope" role="button" tabindex="0">
		                                            <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                <input type="checkbox" ng-checked="existtopitem(industryitem.id)" ng-click="clicktopitem(industryitem.id)">
		                                            </td>
		                                            <td class="ng-binding">6</td>
		                                            <td class="ng-binding">電気・ガス・ 熱供給・水道業</td>
		                                            <td class="ng-binding">1</td>
		                                        </tr>
		                                        <!-- end ngRepeat: industryitem in toptablearray track by $index -->
		                                        <tr ng-repeat="industryitem in toptablearray track by $index" ng-click="editindustrycontent(industryitem.trade ,industryitem.id, industryitem.order)" class="ng-scope" role="button" tabindex="0">
		                                            <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                <input type="checkbox" ng-checked="existtopitem(industryitem.id)" ng-click="clicktopitem(industryitem.id)">
		                                            </td>
		                                            <td class="ng-binding">7</td>
		                                            <td class="ng-binding">製造業</td>
		                                            <td class="ng-binding">1</td>
		                                        </tr>
		                                        <!-- end ngRepeat: industryitem in toptablearray track by $index -->
		                                        <tr ng-repeat="industryitem in toptablearray track by $index" ng-click="editindustrycontent(industryitem.trade ,industryitem.id, industryitem.order)" class="ng-scope" role="button" tabindex="0">
		                                            <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                <input type="checkbox" ng-checked="existtopitem(industryitem.id)" ng-click="clicktopitem(industryitem.id)">
		                                            </td>
		                                            <td class="ng-binding">8</td>
		                                            <td class="ng-binding">建設業</td>
		                                            <td class="ng-binding">1</td>
		                                        </tr>
		                                        <!-- end ngRepeat: industryitem in toptablearray track by $index -->
		                                        <tr ng-repeat="industryitem in toptablearray track by $index" ng-click="editindustrycontent(industryitem.trade ,industryitem.id, industryitem.order)" class="ng-scope" role="button" tabindex="0">
		                                            <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                <input type="checkbox" ng-checked="existtopitem(industryitem.id)" ng-click="clicktopitem(industryitem.id)">
		                                            </td>
		                                            <td class="ng-binding">9</td>
		                                            <td class="ng-binding">鉱業，採石業， 砂利採取業</td>
		                                            <td class="ng-binding">1</td>
		                                        </tr>
		                                        <!-- end ngRepeat: industryitem in toptablearray track by $index -->
		                                        <tr ng-repeat="industryitem in toptablearray track by $index" ng-click="editindustrycontent(industryitem.trade ,industryitem.id, industryitem.order)" class="ng-scope" role="button" tabindex="0">
		                                            <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                <input type="checkbox" ng-checked="existtopitem(industryitem.id)" ng-click="clicktopitem(industryitem.id)">
		                                            </td>
		                                            <td class="ng-binding">10</td>
		                                            <td class="ng-binding">漁業</td>
		                                            <td class="ng-binding">1</td>
		                                        </tr>
		                                        <!-- end ngRepeat: industryitem in toptablearray track by $index -->
		                                        <tr ng-repeat="industryitem in toptablearray track by $index" ng-click="editindustrycontent(industryitem.trade ,industryitem.id, industryitem.order)" class="ng-scope" role="button" tabindex="0">
		                                            <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                <input type="checkbox" ng-checked="existtopitem(industryitem.id)" ng-click="clicktopitem(industryitem.id)">
		                                            </td>
		                                            <td class="ng-binding">11</td>
		                                            <td class="ng-binding">卸売業・小売業</td>
		                                            <td class="ng-binding">1</td>
		                                        </tr>
		                                        <!-- end ngRepeat: industryitem in toptablearray track by $index -->
		                                        <tr ng-repeat="industryitem in toptablearray track by $index" ng-click="editindustrycontent(industryitem.trade ,industryitem.id, industryitem.order)" class="ng-scope" role="button" tabindex="0">
		                                            <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                <input type="checkbox" ng-checked="existtopitem(industryitem.id)" ng-click="clicktopitem(industryitem.id)">
		                                            </td>
		                                            <td class="ng-binding">12</td>
		                                            <td class="ng-binding">金融業・保険業</td>
		                                            <td class="ng-binding">1</td>
		                                        </tr>
		                                        <!-- end ngRepeat: industryitem in toptablearray track by $index -->
		                                        <tr ng-repeat="industryitem in toptablearray track by $index" ng-click="editindustrycontent(industryitem.trade ,industryitem.id, industryitem.order)" class="ng-scope" role="button" tabindex="0">
		                                            <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                <input type="checkbox" ng-checked="existtopitem(industryitem.id)" ng-click="clicktopitem(industryitem.id)">
		                                            </td>
		                                            <td class="ng-binding">13</td>
		                                            <td class="ng-binding">不動産業， 物品賃貸業</td>
		                                            <td class="ng-binding">1</td>
		                                        </tr>
		                                        <!-- end ngRepeat: industryitem in toptablearray track by $index -->
		                                        <tr ng-repeat="industryitem in toptablearray track by $index" ng-click="editindustrycontent(industryitem.trade ,industryitem.id, industryitem.order)" class="ng-scope" role="button" tabindex="0">
		                                            <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                <input type="checkbox" ng-checked="existtopitem(industryitem.id)" ng-click="clicktopitem(industryitem.id)">
		                                            </td>
		                                            <td class="ng-binding">14</td>
		                                            <td class="ng-binding">協同組合</td>
		                                            <td class="ng-binding">1</td>
		                                        </tr>
		                                        <!-- end ngRepeat: industryitem in toptablearray track by $index -->
		                                        <tr ng-repeat="industryitem in toptablearray track by $index" ng-click="editindustrycontent(industryitem.trade ,industryitem.id, industryitem.order)" class="ng-scope" role="button" tabindex="0">
		                                            <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                <input type="checkbox" ng-checked="existtopitem(industryitem.id)" ng-click="clicktopitem(industryitem.id)">
		                                            </td>
		                                            <td class="ng-binding">15</td>
		                                            <td class="ng-binding">医療業</td>
		                                            <td class="ng-binding">1</td>
		                                        </tr>
		                                        <!-- end ngRepeat: industryitem in toptablearray track by $index -->
		                                        <tr ng-repeat="industryitem in toptablearray track by $index" ng-click="editindustrycontent(industryitem.trade ,industryitem.id, industryitem.order)" class="ng-scope" role="button" tabindex="0">
		                                            <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                <input type="checkbox" ng-checked="existtopitem(industryitem.id)" ng-click="clicktopitem(industryitem.id)">
		                                            </td>
		                                            <td class="ng-binding">16</td>
		                                            <td class="ng-binding">福祉業</td>
		                                            <td class="ng-binding">1</td>
		                                        </tr>
		                                        <!-- end ngRepeat: industryitem in toptablearray track by $index -->
		                                        <tr ng-repeat="industryitem in toptablearray track by $index" ng-click="editindustrycontent(industryitem.trade ,industryitem.id, industryitem.order)" class="ng-scope" role="button" tabindex="0">
		                                            <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                <input type="checkbox" ng-checked="existtopitem(industryitem.id)" ng-click="clicktopitem(industryitem.id)">
		                                            </td>
		                                            <td class="ng-binding">17</td>
		                                            <td class="ng-binding">飲食サービス業</td>
		                                            <td class="ng-binding">1</td>
		                                        </tr>
		                                        <!-- end ngRepeat: industryitem in toptablearray track by $index -->
		                                        <tr ng-repeat="industryitem in toptablearray track by $index" ng-click="editindustrycontent(industryitem.trade ,industryitem.id, industryitem.order)" class="ng-scope" role="button" tabindex="0">
		                                            <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                <input type="checkbox" ng-checked="existtopitem(industryitem.id)" ng-click="clicktopitem(industryitem.id)">
		                                            </td>
		                                            <td class="ng-binding">18</td>
		                                            <td class="ng-binding">教育，学習支援業</td>
		                                            <td class="ng-binding">1</td>
		                                        </tr>
		                                        <!-- end ngRepeat: industryitem in toptablearray track by $index -->
		                                        <tr ng-repeat="industryitem in toptablearray track by $index" ng-click="editindustrycontent(industryitem.trade ,industryitem.id, industryitem.order)" class="ng-scope" role="button" tabindex="0">
		                                            <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                <input type="checkbox" ng-checked="existtopitem(industryitem.id)" ng-click="clicktopitem(industryitem.id)">
		                                            </td>
		                                            <td class="ng-binding">19</td>
		                                            <td class="ng-binding">娯楽業</td>
		                                            <td class="ng-binding">1</td>
		                                        </tr>
		                                        <!-- end ngRepeat: industryitem in toptablearray track by $index -->
		                                        <tr ng-repeat="industryitem in toptablearray track by $index" ng-click="editindustrycontent(industryitem.trade ,industryitem.id, industryitem.order)" class="ng-scope" role="button" tabindex="0">
		                                            <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                <input type="checkbox" ng-checked="existtopitem(industryitem.id)" ng-click="clicktopitem(industryitem.id)">
		                                            </td>
		                                            <td class="ng-binding">20</td>
		                                            <td class="ng-binding">生活関連サービス業</td>
		                                            <td class="ng-binding">1</td>
		                                        </tr>
		                                        <!-- end ngRepeat: industryitem in toptablearray track by $index -->
		                                        <tr ng-repeat="industryitem in toptablearray track by $index" ng-click="editindustrycontent(industryitem.trade ,industryitem.id, industryitem.order)" class="ng-scope" role="button" tabindex="0">
		                                            <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                <input type="checkbox" ng-checked="existtopitem(industryitem.id)" ng-click="clicktopitem(industryitem.id)">
		                                            </td>
		                                            <td class="ng-binding">21</td>
		                                            <td class="ng-binding">宿泊業</td>
		                                            <td class="ng-binding">1</td>
		                                        </tr>
		                                        <!-- end ngRepeat: industryitem in toptablearray track by $index -->
		                                        <tr ng-repeat="industryitem in toptablearray track by $index" ng-click="editindustrycontent(industryitem.trade ,industryitem.id, industryitem.order)" class="ng-scope" role="button" tabindex="0">
		                                            <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                <input type="checkbox" ng-checked="existtopitem(industryitem.id)" ng-click="clicktopitem(industryitem.id)">
		                                            </td>
		                                            <td class="ng-binding">22</td>
		                                            <td class="ng-binding">学術研究，専門・ 技術サービス業</td>
		                                            <td class="ng-binding">1</td>
		                                        </tr>
		                                        <!-- end ngRepeat: industryitem in toptablearray track by $index -->
		                                        <tr ng-repeat="industryitem in toptablearray track by $index" ng-click="editindustrycontent(industryitem.trade ,industryitem.id, industryitem.order)" class="ng-scope" role="button" tabindex="0">
		                                            <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                <input type="checkbox" ng-checked="existtopitem(industryitem.id)" ng-click="clicktopitem(industryitem.id)">
		                                            </td>
		                                            <td class="ng-binding">23</td>
		                                            <td class="ng-binding">一般家庭</td>
		                                            <td class="ng-binding">1</td>
		                                        </tr>
		                                        <!-- end ngRepeat: industryitem in toptablearray track by $index -->
		                                        <tr ng-repeat="industryitem in toptablearray track by $index" ng-click="editindustrycontent(industryitem.trade ,industryitem.id, industryitem.order)" class="ng-scope" role="button" tabindex="0">
		                                            <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                <input type="checkbox" ng-checked="existtopitem(industryitem.id)" ng-click="clicktopitem(industryitem.id)">
		                                            </td>
		                                            <td class="ng-binding">24</td>
		                                            <td class="ng-binding">商店街/商工会</td>
		                                            <td class="ng-binding">1</td>
		                                        </tr>
		                                        <!-- end ngRepeat: industryitem in toptablearray track by $index -->
		                                        <tr ng-repeat="industryitem in toptablearray track by $index" ng-click="editindustrycontent(industryitem.trade ,industryitem.id, industryitem.order)" class="ng-scope" role="button" tabindex="0">
		                                            <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                <input type="checkbox" ng-checked="existtopitem(industryitem.id)" ng-click="clicktopitem(industryitem.id)">
		                                            </td>
		                                            <td class="ng-binding">25</td>
		                                            <td class="ng-binding">公務</td>
		                                            <td class="ng-binding">1</td>
		                                        </tr>
		                                        <!-- end ngRepeat: industryitem in toptablearray track by $index -->
		                                    </tbody>
		                                </table>
		                            </fieldset> 
		                        </div>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
	</div>
<?php include ('../../inc/footer.php'); ?>
