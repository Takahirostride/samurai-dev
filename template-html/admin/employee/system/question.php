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
		                                <li class="active"><a href="admin/employee/system/question.php">企業情報質問内容管理</a></li>
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
		                                        <li><a style="width: 200px" href="admin/employee/system/category.php">カテゴリー</a></li>
		                                        <li><a style="width: 200px" class="active" href="admin/employee/system/question.php">企業情報質問内容</a></li>
		                                    </ul>

		                                </div>
		                            </div>

		                            <fieldset class="scheduler-border">
		                                <legend class="scheduler-border">登録する企業情報質問内容</legend>
		                                <div class="control-group" style="margin-bottom:20px;">
		                                    <div class="controls">
		                                        <div class="col-sm-12" style="margin-bottom:10px;">
		                                            <label>質問を表示するカテゴリー</label>
		                                        </div>
		                                        <div class="col-sm-4" style="margin-bottom:20px;">
		                                            <div class="angularsl">
                                                        <select name="location"> 
                                                            <option value="1">雇用・人材</option>
															<option value="2">経営改善・販路開拓</option>
															<option value="3">設備導入・研究開発</option>
															<option value="4">創業・起業</option>
															<option value="5">経営環境改善</option>
															<option value="6">特許・知的財産</option>
															<option value="7">誘致関連</option>
                                                        </select>
                                                    </div>
		                                        </div>
		                                    </div>
		                                </div>

		                                <div class="control-group" style="margin-bottom:20px;">
		                                    <div class="controls">
		                                        <div class="col-sm-12" style="margin-bottom:10px;">
		                                            <label>質問内容</label>
		                                        </div>
		                                        <div class="col-sm-10" style="margin-bottom:20px;">
		                                            <input type="text" class="form-control ng-pristine ng-untouched ng-valid ng-empty" ng-model="questioncontent" aria-invalid="false">
		                                        </div>
		                                    </div>
		                                </div>

		                                <div class="control-group" style="margin-bottom:20px;">
		                                    <div class="controls">
		                                        <div class="col-sm-12" style="margin-bottom:40px;">
		                                            <!-- ngRepeat: subcategory in downedcategoryarray[selectedbigcategoryindex][1] track by $index -->
		                                            <div class="col-sm-2 ng-scope" ng-repeat="subcategory in downedcategoryarray[selectedbigcategoryindex][1] track by $index" style="margin-bottom: 10px;">
		                                                <label class="ng-binding">
		                                                    <input type="checkbox" ng-click="clicksubcategory(subcategory)" ng-checked="existsubcategory(subcategory)">雇用調整助成金</label>
		                                            </div>
		                                            <!-- end ngRepeat: subcategory in downedcategoryarray[selectedbigcategoryindex][1] track by $index -->
		                                            <div class="col-sm-2 ng-scope" ng-repeat="subcategory in downedcategoryarray[selectedbigcategoryindex][1] track by $index" style="margin-bottom:10px;">
		                                                <label class="ng-binding">
		                                                    <input type="checkbox" ng-click="clicksubcategory(subcategory)" ng-checked="existsubcategory(subcategory)">人材確保等支援助成金</label>
		                                            </div>
		                                            <!-- end ngRepeat: subcategory in downedcategoryarray[selectedbigcategoryindex][1] track by $index -->
		                                            <div class="col-sm-2 ng-scope" ng-repeat="subcategory in downedcategoryarray[selectedbigcategoryindex][1] track by $index" style="margin-bottom:10px;">
		                                                <label class="ng-binding">
		                                                    <input type="checkbox" ng-click="clicksubcategory(subcategory)" ng-checked="existsubcategory(subcategory)">障碍者雇用助成金</label>
		                                            </div>
		                                            <!-- end ngRepeat: subcategory in downedcategoryarray[selectedbigcategoryindex][1] track by $index -->
		                                            <div class="col-sm-2 ng-scope" ng-repeat="subcategory in downedcategoryarray[selectedbigcategoryindex][1] track by $index" style="margin-bottom:10px;">
		                                                <label class="ng-binding">
		                                                    <input type="checkbox" ng-click="clicksubcategory(subcategory)" ng-checked="existsubcategory(subcategory)">人材開発支援助成金</label>
		                                            </div>
		                                            <!-- end ngRepeat: subcategory in downedcategoryarray[selectedbigcategoryindex][1] track by $index -->
		                                            <div class="col-sm-2 ng-scope" ng-repeat="subcategory in downedcategoryarray[selectedbigcategoryindex][1] track by $index" style="margin-bottom:10px;">
		                                                <label class="ng-binding">
		                                                    <input type="checkbox" ng-click="clicksubcategory(subcategory)" ng-checked="existsubcategory(subcategory)">キャリアアップ助成金</label>
		                                            </div>
		                                            <!-- end ngRepeat: subcategory in downedcategoryarray[selectedbigcategoryindex][1] track by $index -->
		                                            <div class="col-sm-2 ng-scope" ng-repeat="subcategory in downedcategoryarray[selectedbigcategoryindex][1] track by $index" style="margin-bottom:10px;">
		                                                <label class="ng-binding">
		                                                    <input type="checkbox" ng-click="clicksubcategory(subcategory)" ng-checked="existsubcategory(subcategory)">特定求職者雇用開発助成金</label>
		                                            </div>
		                                            <!-- end ngRepeat: subcategory in downedcategoryarray[selectedbigcategoryindex][1] track by $index -->
		                                            <div class="col-sm-2 ng-scope" ng-repeat="subcategory in downedcategoryarray[selectedbigcategoryindex][1] track by $index" style="margin-bottom:10px;">
		                                                <label class="ng-binding">
		                                                    <input type="checkbox" ng-click="clicksubcategory(subcategory)" ng-checked="existsubcategory(subcategory)">労働移動支援助成金</label>
		                                            </div>
		                                            <!-- end ngRepeat: subcategory in downedcategoryarray[selectedbigcategoryindex][1] track by $index -->
		                                            <div class="col-sm-2 ng-scope" ng-repeat="subcategory in downedcategoryarray[selectedbigcategoryindex][1] track by $index" style="margin-bottom:10px;">
		                                                <label class="ng-binding">
		                                                    <input type="checkbox" ng-click="clicksubcategory(subcategory)" ng-checked="existsubcategory(subcategory)">トライアル雇用助成金</label>
		                                            </div>
		                                            <!-- end ngRepeat: subcategory in downedcategoryarray[selectedbigcategoryindex][1] track by $index -->
		                                            <div class="col-sm-2 ng-scope" ng-repeat="subcategory in downedcategoryarray[selectedbigcategoryindex][1] track by $index" style="margin-bottom:10px;">
		                                                <label class="ng-binding">
		                                                    <input type="checkbox" ng-click="clicksubcategory(subcategory)" ng-checked="existsubcategory(subcategory)">地域雇用開発助成金</label>
		                                            </div>
		                                            <!-- end ngRepeat: subcategory in downedcategoryarray[selectedbigcategoryindex][1] track by $index -->
		                                            <div class="col-sm-2 ng-scope" ng-repeat="subcategory in downedcategoryarray[selectedbigcategoryindex][1] track by $index" style="margin-bottom:10px;">
		                                                <label class="ng-binding">
		                                                    <input type="checkbox" ng-click="clicksubcategory(subcategory)" ng-checked="existsubcategory(subcategory)">生涯現役起業支援助成金</label>
		                                            </div>
		                                            <!-- end ngRepeat: subcategory in downedcategoryarray[selectedbigcategoryindex][1] track by $index -->
		                                            <div class="col-sm-2 ng-scope" ng-repeat="subcategory in downedcategoryarray[selectedbigcategoryindex][1] track by $index" style="margin-bottom:10px;">
		                                                <label class="ng-binding">
		                                                    <input type="checkbox" ng-click="clicksubcategory(subcategory)" ng-checked="existsubcategory(subcategory)">通年雇用助成金</label>
		                                            </div>
		                                            <!-- end ngRepeat: subcategory in downedcategoryarray[selectedbigcategoryindex][1] track by $index -->
		                                            <div class="col-sm-2 ng-scope" ng-repeat="subcategory in downedcategoryarray[selectedbigcategoryindex][1] track by $index" style="margin-bottom:10px;">
		                                                <label class="ng-binding">
		                                                    <input type="checkbox" ng-click="clicksubcategory(subcategory)" ng-checked="existsubcategory(subcategory)">65歳超雇用推進助成金</label>
		                                            </div>
		                                            <!-- end ngRepeat: subcategory in downedcategoryarray[selectedbigcategoryindex][1] track by $index -->
		                                            <div class="col-sm-2 ng-scope" ng-repeat="subcategory in downedcategoryarray[selectedbigcategoryindex][1] track by $index" style="margin-bottom:10px;">
		                                                <label class="ng-binding">
		                                                    <input type="checkbox" ng-click="clicksubcategory(subcategory)" ng-checked="existsubcategory(subcategory)">両立支援等助成金</label>
		                                            </div>
		                                            <!-- end ngRepeat: subcategory in downedcategoryarray[selectedbigcategoryindex][1] track by $index -->
		                                            <div class="col-sm-2 ng-scope" ng-repeat="subcategory in downedcategoryarray[selectedbigcategoryindex][1] track by $index" style="margin-bottom:10px;">
		                                                <label class="ng-binding">
		                                                    <input type="checkbox" ng-click="clicksubcategory(subcategory)" ng-checked="existsubcategory(subcategory)">震災関係の雇用関係助成金</label>
		                                            </div>
		                                            <!-- end ngRepeat: subcategory in downedcategoryarray[selectedbigcategoryindex][1] track by $index -->
		                                            <div class="col-sm-2 ng-scope" ng-repeat="subcategory in downedcategoryarray[selectedbigcategoryindex][1] track by $index" style="margin-bottom:10px;">
		                                                <label class="ng-binding">
		                                                    <input type="checkbox" ng-click="clicksubcategory(subcategory)" ng-checked="existsubcategory(subcategory)">その他の雇用・人材支援</label>
		                                            </div>
		                                            <!-- end ngRepeat: subcategory in downedcategoryarray[selectedbigcategoryindex][1] track by $index -->
		                                        </div>
		                                    </div>
		                                </div>

		                                <div class="control-group" style="margin-bottom:20px;">
		                                    <div class="controls">
		                                        <div class="col-sm-12" style="text-align:center;margin-bottom:20px;">
		                                            <!-- ngIf: editquestionflag==0 -->
		                                            <button type="button" class="submit-blue-left ng-scope" style="width:100px;margin-right:30px;" ng-click="addnewquestion()" ng-if="editquestionflag==0">新規登録</button>
		                                            <!-- end ngIf: editquestionflag==0 -->
		                                            <!-- ngIf: editquestionflag==1 -->
		                                            <button type="button" class="submit-blue-left" style="width:100px;" ng-click="clearcontent()">クリアー</button>
		                                        </div>
		                                    </div>
		                                </div>

		                            </fieldset>
		                            <fieldset class="scheduler-border">
		                                <div class="control-group" style="margin-bottom:20px;margin-top:20px;">
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
		                                        <button type="button" class="submit-blue-left" style="width:100px;" ng-click="changequestionstatus()">適用</button>
		                                    </div>
		                                </div>

		                                <!-- ngRepeat: questionitem in downedquestionarray -->
		                                <div ng-repeat="questionitem in downedquestionarray" class="ng-scope" style="">
		                                    <div class="col-sm-12" style="margin-bottom:10px;">
		                                        <label style="font-size:20px;" class="ng-binding">雇用・人材:</label>
		                                    </div>

		                                    <table class="table table-bordered" style="text-align:center;">
		                                        <thead>
		                                            <tr>
		                                                <th width="10%" style="text-align:center;">選択
		                                                    <input ng-show="false" type="checkbox" aria-hidden="true" class="ng-hide">
		                                                </th>
		                                                <th width="16%" style="text-align:center;">並び順</th>
		                                                <th style="text-align:center;">質問内容</th>
		                                            </tr>
		                                        </thead>
		                                        <tbody>
		                                            <!-- ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">1</td>
		                                                <td class="ng-binding">従業員の雇用維持を図りたい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">2</td>
		                                                <td class="ng-binding">雇用管理改善、生産性向上を図り、職場定着を促進したい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">3</td>
		                                                <td class="ng-binding">障碍者の雇用を行う</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">4</td>
		                                                <td class="ng-binding">人材育成教育の計画立て、職業訓練を行いたい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">5</td>
		                                                <td class="ng-binding">有期契約労働者、パート・アルバイト、派遣労働者の正規転換やスキルアップ、昇給等を行いたい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">6</td>
		                                                <td class="ng-binding">高年齢者や障害者等の就職困難者を継続雇用したい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">7</td>
		                                                <td class="ng-binding">事業規模の縮小などにより離職する労働者の再就職支援を行いたい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">8</td>
		                                                <td class="ng-binding">就職が困難な求職者を一定期間試行雇用する</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">9</td>
		                                                <td class="ng-binding">求人の少ない地域において雇用の場を増やす</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">10</td>
		                                                <td class="ng-binding">40歳以上で起業し、計画届の認定を受け、中高年者を新たに雇用する</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                        </tbody>
		                                    </table>
		                                </div>
		                                <!-- end ngRepeat: questionitem in downedquestionarray -->
		                                <div ng-repeat="questionitem in downedquestionarray" class="ng-scope">
		                                    <div class="col-sm-12" style="margin-bottom:10px;">
		                                        <label style="font-size:20px;" class="ng-binding">経営改善・販路開拓:</label>
		                                    </div>

		                                    <table class="table table-bordered" style="text-align:center;">
		                                        <thead>
		                                            <tr>
		                                                <th width="10%" style="text-align:center;">選択
		                                                    <input ng-show="false" type="checkbox" aria-hidden="true" class="ng-hide">
		                                                </th>
		                                                <th width="16%" style="text-align:center;">並び順</th>
		                                                <th style="text-align:center;">質問内容</th>
		                                            </tr>
		                                        </thead>
		                                        <tbody>
		                                            <!-- ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">1</td>
		                                                <td class="ng-binding">主な経営改善支援を見たい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">2</td>
		                                                <td class="ng-binding">競争力を強化したい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">3</td>
		                                                <td class="ng-binding">経営力を強化したい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">4</td>
		                                                <td class="ng-binding">企業成長支援ファンドを利用したい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">5</td>
		                                                <td class="ng-binding">販路を開拓したい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">6</td>
		                                                <td class="ng-binding">主な事業承継支援を見たい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">7</td>
		                                                <td class="ng-binding">税制優遇措置を受ける</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">8</td>
		                                                <td class="ng-binding">その他の経営改善支援を見たい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">9</td>
		                                                <td class="ng-binding">主な販路・需要開拓支援施策を見たい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">10</td>
		                                                <td class="ng-binding">支援・応援ファンドからの支援を受けたい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">11</td>
		                                                <td class="ng-binding">さまざまな企業と連携したい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">12</td>
		                                                <td class="ng-binding">地域活性化への取り組みを行いたい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">13</td>
		                                                <td class="ng-binding">地域資源を活用した新たな商品・サービスを開発したい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">14</td>
		                                                <td class="ng-binding">新連携、地域資源活用、農商工等連携にチャレンジしたい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">15</td>
		                                                <td class="ng-binding">商店街の活性化に向けた取り組みを行いたい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">16</td>
		                                                <td class="ng-binding">中心市街地を活性化し、にぎわいを取り戻す取り組みを行いたい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">17</td>
		                                                <td class="ng-binding">その他の販路・需要開拓支援施策を見たい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">18</td>
		                                                <td class="ng-binding">主な海外展開支援を見たい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">19</td>
		                                                <td class="ng-binding">海外展開戦略支援を受けたい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">20</td>
		                                                <td class="ng-binding">新興国での市場開拓支援を受けたい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">21</td>
		                                                <td class="ng-binding">保険関連の支援を受けたい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">22</td>
		                                                <td class="ng-binding">その他の海外展開支援を見たい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                        </tbody>
		                                    </table>
		                                </div>
		                                <!-- end ngRepeat: questionitem in downedquestionarray -->
		                                <div ng-repeat="questionitem in downedquestionarray" class="ng-scope">
		                                    <div class="col-sm-12" style="margin-bottom:10px;">
		                                        <label style="font-size:20px;" class="ng-binding">設備導入・研究開発:</label>
		                                    </div>

		                                    <table class="table table-bordered" style="text-align:center;">
		                                        <thead>
		                                            <tr>
		                                                <th width="10%" style="text-align:center;">選択
		                                                    <input ng-show="false" type="checkbox" aria-hidden="true" class="ng-hide">
		                                                </th>
		                                                <th width="16%" style="text-align:center;">並び順</th>
		                                                <th style="text-align:center;">質問内容</th>
		                                            </tr>
		                                        </thead>
		                                        <tbody>
		                                            <!-- ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">1</td>
		                                                <td class="ng-binding">主な技術開発支援を見たい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">2</td>
		                                                <td class="ng-binding">ものづくり支援を受けたい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">3</td>
		                                                <td class="ng-binding">研究開発の優遇税制を受けたい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">4</td>
		                                                <td class="ng-binding">サービスの開発支援を受けたい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">5</td>
		                                                <td class="ng-binding">技術革新制度を利用したい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">6</td>
		                                                <td class="ng-binding">省エネ・新エネ関連設備の支援を受けたい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">7</td>
		                                                <td class="ng-binding">技術高度化のための支援を受けたい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">8</td>
		                                                <td class="ng-binding">IT導入の支援を受けたい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">9</td>
		                                                <td class="ng-binding">事業化への支援を受けたい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">10</td>
		                                                <td class="ng-binding">その他の技術開発支援を見たい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                        </tbody>
		                                    </table>
		                                </div>
		                                <!-- end ngRepeat: questionitem in downedquestionarray -->
		                                <div ng-repeat="questionitem in downedquestionarray" class="ng-scope">
		                                    <div class="col-sm-12" style="margin-bottom:10px;">
		                                        <label style="font-size:20px;" class="ng-binding">創業・起業:</label>
		                                    </div>

		                                    <table class="table table-bordered" style="text-align:center;">
		                                        <thead>
		                                            <tr>
		                                                <th width="10%" style="text-align:center;">選択
		                                                    <input ng-show="false" type="checkbox" aria-hidden="true" class="ng-hide">
		                                                </th>
		                                                <th width="16%" style="text-align:center;">並び順</th>
		                                                <th style="text-align:center;">質問内容</th>
		                                            </tr>
		                                        </thead>
		                                        <tbody>
		                                            <!-- ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">1</td>
		                                                <td class="ng-binding">主な創業・起業支援を見たい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">2</td>
		                                                <td class="ng-binding">女性起業家支援を受けたい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">3</td>
		                                                <td class="ng-binding">若者起業家支援を受けたい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">4</td>
		                                                <td class="ng-binding">シニア起業家支援を受けたい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">5</td>
		                                                <td class="ng-binding">新創業融資を受けたい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">6</td>
		                                                <td class="ng-binding">創業・事業継承支援を受けたい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">7</td>
		                                                <td class="ng-binding">エンジェル税制を利用したい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">8</td>
		                                                <td class="ng-binding">起業支援ファンドを利用したい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">9</td>
		                                                <td class="ng-binding">その他の創業・企業支援を見たい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                        </tbody>
		                                    </table>
		                                </div>
		                                <!-- end ngRepeat: questionitem in downedquestionarray -->
		                                <div ng-repeat="questionitem in downedquestionarray" class="ng-scope">
		                                    <div class="col-sm-12" style="margin-bottom:10px;">
		                                        <label style="font-size:20px;" class="ng-binding">経営環境改善:</label>
		                                    </div>

		                                    <table class="table table-bordered" style="text-align:center;">
		                                        <thead>
		                                            <tr>
		                                                <th width="10%" style="text-align:center;">選択
		                                                    <input ng-show="false" type="checkbox" aria-hidden="true" class="ng-hide">
		                                                </th>
		                                                <th width="16%" style="text-align:center;">並び順</th>
		                                                <th style="text-align:center;">質問内容</th>
		                                            </tr>
		                                        </thead>
		                                        <tbody>
		                                            <!-- ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">1</td>
		                                                <td class="ng-binding">主な事業再生支援を見たい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">2</td>
		                                                <td class="ng-binding">企業再生のための貸付を受けたい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">3</td>
		                                                <td class="ng-binding">事業再生のための支援を受けたい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">4</td>
		                                                <td class="ng-binding">その他の事業再生支援を見たい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">5</td>
		                                                <td class="ng-binding">主な金融・経営環境の変化に適応した支援を見たい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">6</td>
		                                                <td class="ng-binding">災害復旧貸付制度を利用したい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">7</td>
		                                                <td class="ng-binding">保証制度を利用したい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">8</td>
		                                                <td class="ng-binding">補助制度を利用したい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">9</td>
		                                                <td class="ng-binding">特例制度を利用したい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">10</td>
		                                                <td class="ng-binding">環境・エネルギー対策を行いたい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">11</td>
		                                                <td class="ng-binding">保険関連の支援を受けたい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">12</td>
		                                                <td class="ng-binding">融資を受けたい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">13</td>
		                                                <td class="ng-binding">事業用施設の復旧・整備の支援を受けたい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">14</td>
		                                                <td class="ng-binding">連鎖倒産を防止したい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">15</td>
		                                                <td class="ng-binding">返済負担を軽減したい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">16</td>
		                                                <td class="ng-binding">経営の自立化支援を受けたい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">17</td>
		                                                <td class="ng-binding">その他の金融・経営環境の変化に適応して支援を見たい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">18</td>
		                                                <td class="ng-binding">主な活用支援を見たい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">19</td>
		                                                <td class="ng-binding">IT活用促進資金を取得したい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">20</td>
		                                                <td class="ng-binding">IT導入支援事業を見たい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">21</td>
		                                                <td class="ng-binding">土地を活用したい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">22</td>
		                                                <td class="ng-binding">空き店舗を活用したい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">23</td>
		                                                <td class="ng-binding">その他の活用支援を見たい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">24</td>
		                                                <td class="ng-binding">下請取引の相談やあっせんについて知りたい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">25</td>
		                                                <td class="ng-binding">官公庁から受注したい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">26</td>
		                                                <td class="ng-binding">小規模事業者のための支援策を受けたい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">27</td>
		                                                <td class="ng-binding">工場支援関連を見たい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">28</td>
		                                                <td class="ng-binding">農家・農業法人への支援を見たい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">29</td>
		                                                <td class="ng-binding">その他の施策を見たい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                        </tbody>
		                                    </table>
		                                </div>
		                                <!-- end ngRepeat: questionitem in downedquestionarray -->
		                                <div ng-repeat="questionitem in downedquestionarray" class="ng-scope">
		                                    <div class="col-sm-12" style="margin-bottom:10px;">
		                                        <label style="font-size:20px;" class="ng-binding">特許・知的財産:</label>
		                                    </div>

		                                    <table class="table table-bordered" style="text-align:center;">
		                                        <thead>
		                                            <tr>
		                                                <th width="10%" style="text-align:center;">選択
		                                                    <input ng-show="false" type="checkbox" aria-hidden="true" class="ng-hide">
		                                                </th>
		                                                <th width="16%" style="text-align:center;">並び順</th>
		                                                <th style="text-align:center;">質問内容</th>
		                                            </tr>
		                                        </thead>
		                                        <tbody>
		                                            <!-- ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">1</td>
		                                                <td class="ng-binding">主な知的財産関連支援を見たい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">2</td>
		                                                <td class="ng-binding">特許料の軽減をしたい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">3</td>
		                                                <td class="ng-binding">知財金融を促進をしたい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                            <tr ng-repeat="question in questionitem[1] track by $index" ng-click="editquestioncontent(question)" class="ng-scope" role="button" tabindex="0">
		                                                <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
		                                                    <input type="checkbox" ng-checked="existquestionitem($index)" ng-click="clickquestionitem(question)">
		                                                </td>
		                                                <td class="ng-binding">4</td>
		                                                <td class="ng-binding">その他の知的財産関連支援を見たい</td>
		                                            </tr>
		                                            <!-- end ngRepeat: question in questionitem[1] track by $index -->
		                                        </tbody>
		                                    </table>
		                                </div>
		                                <!-- end ngRepeat: questionitem in downedquestionarray -->

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
