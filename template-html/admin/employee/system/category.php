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
		                                <li class="active"><a href="admin/employee/system/category.php">カテゴリー管理</a></li>
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
		                                        <li><a style="width: 200px" href="admin/employee/system/industry.php">業種</a></li>
		                                        <li><a style="width: 200px" href="admin/employee/system/tag.php">タグ</a></li>
		                                        <li><a style="width: 200px" class="active" href="admin/employee/system/category.php">カテゴリー</a></li>
		                                        <li><a style="width: 200px" href="admin/employee/system/question.php">企業情報質問内容</a></li>
		                                    </ul>

		                                </div>
		                            </div>

		                            <fieldset class="scheduler-border">
		                                <legend class="scheduler-border">設定したカテゴリー</legend>

		                                <div class="control-group" style="margin-bottom:20px;">
		                                    <div class="controls">
		                                        <div class="col-sm-6">
		                                            <input type="text" class="form-control ng-pristine ng-untouched ng-valid ng-empty" ng-model="newbigcategory" aria-invalid="false">
		                                        </div>
		                                        <!-- ngIf: editbigcategoryflag==0 -->
		                                        <button type="button" class="submit-blue-left ng-scope" style="width:100px;" ng-click="addnewbigcategory()" ng-if="editbigcategoryflag==0">新規登録</button>
		                                        <!-- end ngIf: editbigcategoryflag==0 -->
		                                        <!-- ngIf: editbigcategoryflag==1 -->
		                                        <button type="button" class="submit-blue-left" style="width:100px; margin-left:30px;" ng-click="clearcontent1()">クリアー</button>
		                                    </div>
		                                </div>

		                                <div class="control-group" style="margin-bottom:20px;">
		                                    <div class="controls">
		                                        <div class="col-sm-4">
		                                            <div class="angularsl">
                                                        <select name="location"> 
                                                            <option value="1">非表示</option>
															<option value="2">削除</option>
															<option value="3">表示</option>
															<option value="4">非表示</option>
                                                        </select>
                                                    </div>
		                                        </div>
		                                        <button type="button" class="submit-blue-left" style="width:100px;" ng-click="changecategorystatus()">適用</button>
		                                    </div>
		                                </div>

		                                <table class="table table-bordered" style="text-align:center;">
		                                    <thead>
		                                        <tr>
		                                            <th width="10%" style="text-align:center;">選択
		                                                <input ng-show="false" type="checkbox" aria-hidden="true" class="ng-hide">
		                                            </th>
		                                            <th width="16%" style="text-align:center;">並び順</th>
		                                            <th style="text-align:center;">カテゴリー</th>
		                                        </tr>
		                                    </thead>
		                                    <tbody>
		                                        <!-- ngRepeat: categoryitem in bigcategoryarray -->
		                                        <tr ng-repeat="categoryitem in bigcategoryarray" ng-click="requestsubcategory(categoryitem.category, $index)" class="ng-scope" role="button" tabindex="0" style="">
		                                            <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                <input type="checkbox" ng-checked="existcategoryitem(categoryitem.category)" ng-click="clickcategoryitem(categoryitem.category)">
		                                            </td>
		                                            <td class="ng-binding">1</td>
		                                            <td class="ng-binding">雇用・人材</td>
		                                        </tr>
		                                        <!-- end ngRepeat: categoryitem in bigcategoryarray -->
		                                        <tr ng-repeat="categoryitem in bigcategoryarray" ng-click="requestsubcategory(categoryitem.category, $index)" class="ng-scope" role="button" tabindex="0">
		                                            <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                <input type="checkbox" ng-checked="existcategoryitem(categoryitem.category)" ng-click="clickcategoryitem(categoryitem.category)">
		                                            </td>
		                                            <td class="ng-binding">2</td>
		                                            <td class="ng-binding">経営改善・販路開拓</td>
		                                        </tr>
		                                        <!-- end ngRepeat: categoryitem in bigcategoryarray -->
		                                        <tr ng-repeat="categoryitem in bigcategoryarray" ng-click="requestsubcategory(categoryitem.category, $index)" class="ng-scope" role="button" tabindex="0">
		                                            <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                <input type="checkbox" ng-checked="existcategoryitem(categoryitem.category)" ng-click="clickcategoryitem(categoryitem.category)">
		                                            </td>
		                                            <td class="ng-binding">3</td>
		                                            <td class="ng-binding">設備導入・研究開発</td>
		                                        </tr>
		                                        <!-- end ngRepeat: categoryitem in bigcategoryarray -->
		                                        <tr ng-repeat="categoryitem in bigcategoryarray" ng-click="requestsubcategory(categoryitem.category, $index)" class="ng-scope" role="button" tabindex="0">
		                                            <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                <input type="checkbox" ng-checked="existcategoryitem(categoryitem.category)" ng-click="clickcategoryitem(categoryitem.category)">
		                                            </td>
		                                            <td class="ng-binding">4</td>
		                                            <td class="ng-binding">創業・起業</td>
		                                        </tr>
		                                        <!-- end ngRepeat: categoryitem in bigcategoryarray -->
		                                        <tr ng-repeat="categoryitem in bigcategoryarray" ng-click="requestsubcategory(categoryitem.category, $index)" class="ng-scope" role="button" tabindex="0">
		                                            <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                <input type="checkbox" ng-checked="existcategoryitem(categoryitem.category)" ng-click="clickcategoryitem(categoryitem.category)">
		                                            </td>
		                                            <td class="ng-binding">5</td>
		                                            <td class="ng-binding">経営環境改善</td>
		                                        </tr>
		                                        <!-- end ngRepeat: categoryitem in bigcategoryarray -->
		                                        <tr ng-repeat="categoryitem in bigcategoryarray" ng-click="requestsubcategory(categoryitem.category, $index)" class="ng-scope" role="button" tabindex="0">
		                                            <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                <input type="checkbox" ng-checked="existcategoryitem(categoryitem.category)" ng-click="clickcategoryitem(categoryitem.category)">
		                                            </td>
		                                            <td class="ng-binding">6</td>
		                                            <td class="ng-binding">特許・知的財産</td>
		                                        </tr>
		                                        <!-- end ngRepeat: categoryitem in bigcategoryarray -->
		                                        <tr ng-repeat="categoryitem in bigcategoryarray" ng-click="requestsubcategory(categoryitem.category, $index)" class="ng-scope" role="button" tabindex="0">
		                                            <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                <input type="checkbox" ng-checked="existcategoryitem(categoryitem.category)" ng-click="clickcategoryitem(categoryitem.category)">
		                                            </td>
		                                            <td class="ng-binding">7</td>
		                                            <td class="ng-binding">誘致関連</td>
		                                        </tr>
		                                        <!-- end ngRepeat: categoryitem in bigcategoryarray -->
		                                    </tbody>
		                                </table>

		                            </fieldset>
		                            <fieldset class="scheduler-border">
		                                <legend class="scheduler-border">設定したカテゴリー詳細</legend>

		                                <div class="control-group" style="margin-bottom:20px;">
		                                    <div class="controls">
		                                        <div class="col-sm-12" style="margin-bottom:20px;">
		                                            <label class="ng-binding">選択しているカテゴリー：雇用・人材</label>
		                                        </div>
		                                    </div>
		                                </div>

		                                <div class="control-group" style="margin-bottom:20px;">
		                                    <div class="controls">
		                                        <div class="col-sm-6">
		                                            <input type="text" class="form-control ng-pristine ng-untouched ng-valid ng-empty" ng-model="newsubcategory" aria-invalid="false">
		                                            <input type="text" class="form-control ng-pristine ng-untouched ng-valid ng-empty" ng-model="newsubcategorydvalue" aria-invalid="false">
		                                        </div>
		                                        <div class="col-sm-6">
		                                            <!-- ngIf: editsubcategoryflag==0 -->
		                                            <button type="button" class="submit-blue-left ng-scope" style="width:100px;" ng-click="addnewsubcategory()" ng-if="editsubcategoryflag==0">新規登録</button>
		                                            <!-- end ngIf: editsubcategoryflag==0 -->
		                                            <!-- ngIf: editsubcategoryflag==1 -->
		                                            <button type="button" class="submit-blue-left" style="width:100px; margin-left:30px;" ng-click="clearcontent2()">クリアー</button>
		                                        </div>
		                                    </div>
		                                </div>
		                                <div class="clearfix"></div>
		                                <div class="control-group" style="margin-bottom:20px;">
		                                    <div class="controls">
		                                        <div class="col-sm-4">
		                                            <div class="angularsl">
                                                        <select name="location"> 
                                                            <option value="1">非表示</option>
															<option value="2">削除</option>
															<option value="3">表示</option>
															<option value="4">非表示</option>
                                                        </select>
                                                    </div>
		                                        </div>
		                                        <button type="button" class="submit-blue-left" style="width:100px;" ng-click="changesubcategorystatus()">適用</button>
		                                    </div>
		                                </div>

		                                <table class="table table-bordered" style="text-align:center;">
		                                    <thead>
		                                        <tr>
		                                            <th width="10%" style="text-align:center;">選択
		                                                <input ng-show="false" type="checkbox" aria-hidden="true" class="ng-hide">
		                                            </th>
		                                            <th width="16%" style="text-align:center;">並び順</th>
		                                            <th style="text-align:center;">カテゴリー</th>
		                                        </tr>
		                                    </thead>
		                                    <tbody>
		                                        <!-- ngRepeat: subcategoryitem in smallcategoryarray -->
		                                        <tr ng-repeat="subcategoryitem in smallcategoryarray" ng-click="clickchangesubcategory(subcategoryitem.detail)" class="ng-scope" role="button" tabindex="0" style="">
		                                            <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                <input type="checkbox" ng-checked="existsubcategoryitem(subcategoryitem.id)" ng-click="clicksubcategoryitem(subcategoryitem.id)">
		                                            </td>
		                                            <td class="ng-binding">1</td>
		                                            <td class="ng-binding">雇用調整助成金</td>
		                                        </tr>
		                                        <!-- end ngRepeat: subcategoryitem in smallcategoryarray -->
		                                        <tr ng-repeat="subcategoryitem in smallcategoryarray" ng-click="clickchangesubcategory(subcategoryitem.detail)" class="ng-scope" role="button" tabindex="0">
		                                            <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                <input type="checkbox" ng-checked="existsubcategoryitem(subcategoryitem.id)" ng-click="clicksubcategoryitem(subcategoryitem.id)">
		                                            </td>
		                                            <td class="ng-binding">2</td>
		                                            <td class="ng-binding">人材確保等支援助成金</td>
		                                        </tr>
		                                        <!-- end ngRepeat: subcategoryitem in smallcategoryarray -->
		                                        <tr ng-repeat="subcategoryitem in smallcategoryarray" ng-click="clickchangesubcategory(subcategoryitem.detail)" class="ng-scope" role="button" tabindex="0">
		                                            <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                <input type="checkbox" ng-checked="existsubcategoryitem(subcategoryitem.id)" ng-click="clicksubcategoryitem(subcategoryitem.id)">
		                                            </td>
		                                            <td class="ng-binding">3</td>
		                                            <td class="ng-binding">障碍者雇用助成金</td>
		                                        </tr>
		                                        <!-- end ngRepeat: subcategoryitem in smallcategoryarray -->
		                                        <tr ng-repeat="subcategoryitem in smallcategoryarray" ng-click="clickchangesubcategory(subcategoryitem.detail)" class="ng-scope" role="button" tabindex="0">
		                                            <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                <input type="checkbox" ng-checked="existsubcategoryitem(subcategoryitem.id)" ng-click="clicksubcategoryitem(subcategoryitem.id)">
		                                            </td>
		                                            <td class="ng-binding">4</td>
		                                            <td class="ng-binding">人材開発支援助成金</td>
		                                        </tr>
		                                        <!-- end ngRepeat: subcategoryitem in smallcategoryarray -->
		                                        <tr ng-repeat="subcategoryitem in smallcategoryarray" ng-click="clickchangesubcategory(subcategoryitem.detail)" class="ng-scope" role="button" tabindex="0">
		                                            <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                <input type="checkbox" ng-checked="existsubcategoryitem(subcategoryitem.id)" ng-click="clicksubcategoryitem(subcategoryitem.id)">
		                                            </td>
		                                            <td class="ng-binding">5</td>
		                                            <td class="ng-binding">キャリアアップ助成金</td>
		                                        </tr>
		                                        <!-- end ngRepeat: subcategoryitem in smallcategoryarray -->
		                                        <tr ng-repeat="subcategoryitem in smallcategoryarray" ng-click="clickchangesubcategory(subcategoryitem.detail)" class="ng-scope" role="button" tabindex="0">
		                                            <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                <input type="checkbox" ng-checked="existsubcategoryitem(subcategoryitem.id)" ng-click="clicksubcategoryitem(subcategoryitem.id)">
		                                            </td>
		                                            <td class="ng-binding">6</td>
		                                            <td class="ng-binding">特定求職者雇用開発助成金</td>
		                                        </tr>
		                                        <!-- end ngRepeat: subcategoryitem in smallcategoryarray -->
		                                        <tr ng-repeat="subcategoryitem in smallcategoryarray" ng-click="clickchangesubcategory(subcategoryitem.detail)" class="ng-scope" role="button" tabindex="0">
		                                            <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                <input type="checkbox" ng-checked="existsubcategoryitem(subcategoryitem.id)" ng-click="clicksubcategoryitem(subcategoryitem.id)">
		                                            </td>
		                                            <td class="ng-binding">7</td>
		                                            <td class="ng-binding">労働移動支援助成金</td>
		                                        </tr>
		                                        <!-- end ngRepeat: subcategoryitem in smallcategoryarray -->
		                                        <tr ng-repeat="subcategoryitem in smallcategoryarray" ng-click="clickchangesubcategory(subcategoryitem.detail)" class="ng-scope" role="button" tabindex="0">
		                                            <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                <input type="checkbox" ng-checked="existsubcategoryitem(subcategoryitem.id)" ng-click="clicksubcategoryitem(subcategoryitem.id)">
		                                            </td>
		                                            <td class="ng-binding">8</td>
		                                            <td class="ng-binding">トライアル雇用助成金</td>
		                                        </tr>
		                                        <!-- end ngRepeat: subcategoryitem in smallcategoryarray -->
		                                        <tr ng-repeat="subcategoryitem in smallcategoryarray" ng-click="clickchangesubcategory(subcategoryitem.detail)" class="ng-scope" role="button" tabindex="0">
		                                            <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                <input type="checkbox" ng-checked="existsubcategoryitem(subcategoryitem.id)" ng-click="clicksubcategoryitem(subcategoryitem.id)">
		                                            </td>
		                                            <td class="ng-binding">9</td>
		                                            <td class="ng-binding">地域雇用開発助成金</td>
		                                        </tr>
		                                        <!-- end ngRepeat: subcategoryitem in smallcategoryarray -->
		                                        <tr ng-repeat="subcategoryitem in smallcategoryarray" ng-click="clickchangesubcategory(subcategoryitem.detail)" class="ng-scope" role="button" tabindex="0">
		                                            <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                <input type="checkbox" ng-checked="existsubcategoryitem(subcategoryitem.id)" ng-click="clicksubcategoryitem(subcategoryitem.id)">
		                                            </td>
		                                            <td class="ng-binding">10</td>
		                                            <td class="ng-binding">生涯現役起業支援助成金</td>
		                                        </tr>
		                                        <!-- end ngRepeat: subcategoryitem in smallcategoryarray -->
		                                        <tr ng-repeat="subcategoryitem in smallcategoryarray" ng-click="clickchangesubcategory(subcategoryitem.detail)" class="ng-scope" role="button" tabindex="0">
		                                            <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                <input type="checkbox" ng-checked="existsubcategoryitem(subcategoryitem.id)" ng-click="clicksubcategoryitem(subcategoryitem.id)">
		                                            </td>
		                                            <td class="ng-binding">11</td>
		                                            <td class="ng-binding">通年雇用助成金</td>
		                                        </tr>
		                                        <!-- end ngRepeat: subcategoryitem in smallcategoryarray -->
		                                        <tr ng-repeat="subcategoryitem in smallcategoryarray" ng-click="clickchangesubcategory(subcategoryitem.detail)" class="ng-scope" role="button" tabindex="0">
		                                            <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                <input type="checkbox" ng-checked="existsubcategoryitem(subcategoryitem.id)" ng-click="clicksubcategoryitem(subcategoryitem.id)">
		                                            </td>
		                                            <td class="ng-binding">12</td>
		                                            <td class="ng-binding">65歳超雇用推進助成金</td>
		                                        </tr>
		                                        <!-- end ngRepeat: subcategoryitem in smallcategoryarray -->
		                                        <tr ng-repeat="subcategoryitem in smallcategoryarray" ng-click="clickchangesubcategory(subcategoryitem.detail)" class="ng-scope" role="button" tabindex="0">
		                                            <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                <input type="checkbox" ng-checked="existsubcategoryitem(subcategoryitem.id)" ng-click="clicksubcategoryitem(subcategoryitem.id)">
		                                            </td>
		                                            <td class="ng-binding">13</td>
		                                            <td class="ng-binding">両立支援等助成金</td>
		                                        </tr>
		                                        <!-- end ngRepeat: subcategoryitem in smallcategoryarray -->
		                                        <tr ng-repeat="subcategoryitem in smallcategoryarray" ng-click="clickchangesubcategory(subcategoryitem.detail)" class="ng-scope" role="button" tabindex="0">
		                                            <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                <input type="checkbox" ng-checked="existsubcategoryitem(subcategoryitem.id)" ng-click="clicksubcategoryitem(subcategoryitem.id)">
		                                            </td>
		                                            <td class="ng-binding">14</td>
		                                            <td class="ng-binding">震災関係の雇用関係助成金</td>
		                                        </tr>
		                                        <!-- end ngRepeat: subcategoryitem in smallcategoryarray -->
		                                        <tr ng-repeat="subcategoryitem in smallcategoryarray" ng-click="clickchangesubcategory(subcategoryitem.detail)" class="ng-scope" role="button" tabindex="0">
		                                            <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                <input type="checkbox" ng-checked="existsubcategoryitem(subcategoryitem.id)" ng-click="clicksubcategoryitem(subcategoryitem.id)">
		                                            </td>
		                                            <td class="ng-binding">15</td>
		                                            <td class="ng-binding">その他の雇用・人材支援</td>
		                                        </tr>
		                                        <!-- end ngRepeat: subcategoryitem in smallcategoryarray -->
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
