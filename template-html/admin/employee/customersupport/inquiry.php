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
		                                <li class="active"><a href="admin/employee/customersupport/inquiry.php">お問い合わせ管理</a></li>
		                                <li><a href="admin/employee/customersupport/contact.php">お問い合わせ対応設定</a></li>
		                                <li><a href="admin/employee/customersupport/identifydoc.php">本人確認書類管理</a></li>
		                                <li><a href="admin/employee/customersupport/identifyphrase.php">本人確認書類対応設定</a></li>
		                                <li><a href="admin/employee/customersupport/violator.php">違反者管理</a></li>
		                                <li><a href="admin/employee/customersupport/violatorphrase.php">違反者対応設定</a></li>
		                                <li><a href="admin/employee/customersupport/manageadvertise.php">広告掲載管理</a></li>
		                            </ul>
		                        </div>
		                    </div>
		                    <div class="col-md-9 pull-right">
		                        <div class="site-content">
		                            <div class="blueheading"><span>お問い合わせ管理</span></div>
		                            <div class="section-3 col-md-12" style="padding-left:0px;">
		                                <div class="section3-full" style="padding-left:0px;">
		                                    <div class="section3-full-scroll" style="padding-left:8px;">
		                                        <div class="row">
		                                            <div class="col-sm-3">
		                                                <div class="angularsl">
	                                                        <select name="location"> 
	                                                            <option value="1">すべて</option>
																<option value="2">対応済み</option>
																<option value="3">未対応</option>
	                                                        </select>
	                                                    </div>
		                                            </div>
		                                        </div>
		                                    </div>
		                                </div>
		                            </div>
		                            <div class="section-5 col-md-12" style="display:block;overflow:auto;">
		                                <table>
		                                    <thead>
		                                        <tr>
		                                            <th style="min-width:150px;">件名</th>
		                                            <th style="min-width:150px;">送信者</th>
		                                            <th style="min-width:150px;">メールアドレス</th>
		                                            <th style="min-width:150px;">日時</th>
		                                            <th style="min-width:150px;">ステータス</th>
		                                            <th style="min-width:150px;">対応者</th>
		                                            <th style="max-width:250px;">コメント</th>
		                                        </tr>
		                                    </thead>
		                                    <tbody>
		                                        <!-- ngRepeat: tableitem in tablearray -->
		                                        <tr class="odd" ng-repeat="tableitem in tablearray" ng-click="clicktableitem($index)" role="button" tabindex="0" style="">
		                                            <td style="min-width:150px;" class="ng-binding">会員登録・ログインについて</td>
		                                            <td style="min-width:150px;" class="ng-binding">テスト</td>
		                                            <td style="min-width:150px;" class="ng-binding">icestorm2017new@yahoo.com</td>
		                                            <td style="min-width:150px; word-break: keep-all;" class="ng-binding">2018年05月16日 10時13分</td>
		                                            <td style="min-width:150px;" class="ng-binding">答えなし</td>
		                                            <td style="min-width:150px;" class="ng-binding"></td>
		                                            <td style="max-width:150px;" class="ng-binding">test</td>
		                                        </tr>
		                                        <!-- end ngRepeat: tableitem in tablearray -->
		                                        <tr class="" ng-repeat="tableitem in tablearray" ng-click="clicktableitem($index)" role="button" tabindex="0" style="">
		                                            <td style="min-width:150px;" class="ng-binding">その他</td>
		                                            <td style="min-width:150px;" class="ng-binding"></td>
		                                            <td style="min-width:150px;" class="ng-binding">n.matsumoto@hiwell.co.jp</td>
		                                            <td style="min-width:150px; word-break: keep-all;" class="ng-binding">2018年05月18日 17時57分</td>
		                                            <td style="min-width:150px;" class="ng-binding">答えなし</td>
		                                            <td style="min-width:150px;" class="ng-binding"></td>
		                                            <td style="max-width:150px;" class="ng-binding">ご担当各位 ハイウェルの松本と申します。 以下ご相談です。 1.貴サイトの何処かへ下記紹介会社様をご紹介できるバナーを 貼っていただくことは難しいでしょうか（1登録×4-30千円）。 2.セミナーの共同開催などで双方でメリットがでる取り組みのご検討 当方、仕業特化型人材紹介会社（東証1部上場企業G）において 専属に近い形で、広告コンサルティング兼広告代理店事業実施して おり、上記企業様は、公認会計士を登録するためのご予算を そこそこお持ちです。 直近1カ月で、当方の紹介で下記の成約、および成約見込みです。 L 転職口コミサイト　A社、ご契約 L 転職横断型サイト　B社、ご契約検討中 L 外資系ビジネスSNS　C社、ご契約予定 なお、当方は仲介料は一切いただいておりません。同社Gに 知人も多数おり、同社Gの支援の一環、雇用促進の一環として 水先案内人をしております。 ご検討いただけるようでしたら、月曜日以降に ご連絡いただけますと幸いです。 n.matsumoto@hiwell.co.jp 0335684420 08098696075
		                                            </td>
		                                        </tr>
		                                        <!-- end ngRepeat: tableitem in tablearray -->
		                                        <tr class="odd" ng-repeat="tableitem in tablearray" ng-click="clicktableitem($index)" role="button" tabindex="0">
		                                            <td style="min-width:150px;" class="ng-binding">その他</td>
		                                            <td style="min-width:150px;" class="ng-binding">テスト</td>
		                                            <td style="min-width:150px;" class="ng-binding">icestorm2017new@yahoo.com</td>
		                                            <td style="min-width:150px; word-break: keep-all;" class="ng-binding">2018年08月31日 14時37分</td>
		                                            <td style="min-width:150px;" class="ng-binding">答えなし</td>
		                                            <td style="min-width:150px;" class="ng-binding"></td>
		                                            <td style="max-width:150px;" class="ng-binding">テスト</td>
		                                        </tr>
		                                        <!-- end ngRepeat: tableitem in tablearray -->
		                                        <tr class="" ng-repeat="tableitem in tablearray" ng-click="clicktableitem($index)" role="button" tabindex="0">
		                                            <td style="min-width:150px;" class="ng-binding">会員登録・ログインについて</td>
		                                            <td style="min-width:150px;" class="ng-binding"></td>
		                                            <td style="min-width:150px;" class="ng-binding">okada@grand2.com</td>
		                                            <td style="min-width:150px; word-break: keep-all;" class="ng-binding">2018年09月12日 15時25分</td>
		                                            <td style="min-width:150px;" class="ng-binding">答えなし</td>
		                                            <td style="min-width:150px;" class="ng-binding"></td>
		                                            <td style="max-width:150px;" class="ng-binding">test</td>
		                                        </tr>
		                                        <!-- end ngRepeat: tableitem in tablearray -->
		                                        <tr class="odd" ng-repeat="tableitem in tablearray" ng-click="clicktableitem($index)" role="button" tabindex="0">
		                                            <td style="min-width:150px;" class="ng-binding">会員登録・ログインについて</td>
		                                            <td style="min-width:150px;" class="ng-binding"></td>
		                                            <td style="min-width:150px;" class="ng-binding">okada@grand2.com</td>
		                                            <td style="min-width:150px; word-break: keep-all;" class="ng-binding">2018年09月12日 15時25分</td>
		                                            <td style="min-width:150px;" class="ng-binding">答えなし</td>
		                                            <td style="min-width:150px;" class="ng-binding"></td>
		                                            <td style="max-width:150px;" class="ng-binding">test</td>
		                                        </tr>
		                                        <!-- end ngRepeat: tableitem in tablearray -->
		                                        <tr class="" ng-repeat="tableitem in tablearray" ng-click="clicktableitem($index)" role="button" tabindex="0">
		                                            <td style="min-width:150px;" class="ng-binding">会員登録・ログインについて</td>
		                                            <td style="min-width:150px;" class="ng-binding"></td>
		                                            <td style="min-width:150px;" class="ng-binding">okada@grand2.com</td>
		                                            <td style="min-width:150px; word-break: keep-all;" class="ng-binding">2018年09月12日 15時25分</td>
		                                            <td style="min-width:150px;" class="ng-binding">答えなし</td>
		                                            <td style="min-width:150px;" class="ng-binding"></td>
		                                            <td style="max-width:150px;" class="ng-binding">test</td>
		                                        </tr>
		                                        <!-- end ngRepeat: tableitem in tablearray -->
		                                        <tr class="odd" ng-repeat="tableitem in tablearray" ng-click="clicktableitem($index)" role="button" tabindex="0">
		                                            <td style="min-width:150px;" class="ng-binding">会員登録・ログインについて</td>
		                                            <td style="min-width:150px;" class="ng-binding"></td>
		                                            <td style="min-width:150px;" class="ng-binding">okada@grand2.com</td>
		                                            <td style="min-width:150px; word-break: keep-all;" class="ng-binding">2018年09月12日 15時25分</td>
		                                            <td style="min-width:150px;" class="ng-binding">答えなし</td>
		                                            <td style="min-width:150px;" class="ng-binding"></td>
		                                            <td style="max-width:150px;" class="ng-binding">test</td>
		                                        </tr>
		                                        <!-- end ngRepeat: tableitem in tablearray -->
		                                        <tr class="" ng-repeat="tableitem in tablearray" ng-click="clicktableitem($index)" role="button" tabindex="0">
		                                            <td style="min-width:150px;" class="ng-binding">会員登録・ログインについて</td>
		                                            <td style="min-width:150px;" class="ng-binding"></td>
		                                            <td style="min-width:150px;" class="ng-binding">okada@grand2.com</td>
		                                            <td style="min-width:150px; word-break: keep-all;" class="ng-binding">2018年09月12日 15時25分</td>
		                                            <td style="min-width:150px;" class="ng-binding">答えなし</td>
		                                            <td style="min-width:150px;" class="ng-binding"></td>
		                                            <td style="max-width:150px;" class="ng-binding">test</td>
		                                        </tr>
		                                        <!-- end ngRepeat: tableitem in tablearray -->
		                                        <tr class="odd" ng-repeat="tableitem in tablearray" ng-click="clicktableitem($index)" role="button" tabindex="0">
		                                            <td style="min-width:150px;" class="ng-binding">会員登録・ログインについて</td>
		                                            <td style="min-width:150px;" class="ng-binding"></td>
		                                            <td style="min-width:150px;" class="ng-binding">okada@grand2.com</td>
		                                            <td style="min-width:150px; word-break: keep-all;" class="ng-binding">2018年09月12日 15時25分</td>
		                                            <td style="min-width:150px;" class="ng-binding">答えなし</td>
		                                            <td style="min-width:150px;" class="ng-binding"></td>
		                                            <td style="max-width:150px;" class="ng-binding">test</td>
		                                        </tr>
		                                        <!-- end ngRepeat: tableitem in tablearray -->
		                                        <tr class="" ng-repeat="tableitem in tablearray" ng-click="clicktableitem($index)" role="button" tabindex="0">
		                                            <td style="min-width:150px;" class="ng-binding">会員登録・ログインについて</td>
		                                            <td style="min-width:150px;" class="ng-binding"></td>
		                                            <td style="min-width:150px;" class="ng-binding">okada@grand2.com</td>
		                                            <td style="min-width:150px; word-break: keep-all;" class="ng-binding">2018年09月14日 13時51分</td>
		                                            <td style="min-width:150px;" class="ng-binding">答えなし</td>
		                                            <td style="min-width:150px;" class="ng-binding"></td>
		                                            <td style="max-width:150px;" class="ng-binding">test</td>
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
		                                    <!-- ngIf: ::directionLinks -->
		                                    <!-- ngIf: ::boundaryLinks -->
		                                    <li role="menuitem" ng-if="::boundaryLinks" ng-class="{disabled: noNext()||ngDisabled}" class="pagination-last ng-scope" style=""><a href="" ng-click="selectPage(totalPages, $event)" ng-disabled="noNext()||ngDisabled" uib-tabindex-toggle="" class="ng-binding">最後</a></li>
		                                    <!-- end ngIf: ::boundaryLinks -->
		                                </ul>
		                            </div>

		                            <div class="col-md-12" style="background:#e0dec8;height:18px;margin-top:20px;"></div>
		                            <div class="col-md-12">

		                                <div class="row">
		                                    <div class="col-md-9" style="background:#fff;">
		                                        <div class="gridcell-left">
		                                            <div class="row" style="margin-left:0px;margin-right:0px;">
		                                                <div class="col-md-4" style="background:#fff;">
		                                                    <div class="angularsl">
	                                                        <select name="location"> 
	                                                            <option value="1"></option> 
	                                                        </select>
	                                                    </div>
		                                                </div>
		                                            </div>
		                                        </div>
		                                        <div class="gridcell-left">
		                                            <!-- Title -->
		                                            <p style="font-size:14px;"><span ng-bind="bottomsetting.faq_title" class="ng-binding">未選択</span> &nbsp;</p>
		                                            <!-- Date -->
		                                            <div class="row">
		                                                <div class="col-md-5" style="width:38%;border-bottom:#000 1px solid;margin-top:10px;"></div>
		                                                <p class="col-md-2 ng-binding" style="font-size:14px;width:24%;text-align:center;padding-left:0px;padding-right:0px;" ng-bind="getDateString(bottomsetting.datestring)">○○年○○月○○日</p>
		                                                <div class="col-md-5" style="width:38%;border-bottom:#000 1px solid;margin-top:10px;"></div>
		                                            </div>

		                                            <!-- ID -->
		                                            <div class="row">
		                                                <p class="col-md-12" style="font-size:14px;"><span ng-bind="bottomsetting.displayname" class="ng-binding"></span>
		                                                    <span ng-bind="bottomsetting.user_id" class="ng-binding">未選択</span></p>
		                                            </div>

		                                            <!-- time -->
		                                            <div class="row">
		                                                <p style="font-size:14px;width:200px;float:right;text-align:right;padding-left:0px;padding-right:30px;"><span ng-bind="getTimeString(bottomsetting.datestring)" class="ng-binding">○○:○○</span>(時間)</p>
		                                            </div>

		                                            <!-- Content -->
		                                            <div class="row" style="height: 100px;">
		                                                <p class="col-md-12 overflow-visible ng-binding" style="font-size:14px;padding-left:30px; padding-right:30px;" ng-bind="bottomsetting.contents">未選択</p>
		                                            </div>

		                                            <!-- Current Date -->
		                                            <div class="row">
		                                                <div class="col-md-5" style="width:38%;border-bottom:#000 1px solid;margin-top:10px;"></div>
		                                                <p class="col-md-2 ng-binding" style="font-size:14px;width:24%;text-align:center;padding-left:0px;padding-right:0px;" ng-bind="getDateString(currentdatestr)">2018年09月17日</p>
		                                                <div class="col-md-5" style="width:38%;border-bottom:#000 1px solid;margin-top:10px;"></div>
		                                            </div>

		                                            <!-- Content -->
		                                            <div class="row" style="height: 120px;">
		                                                <textarea class="col-md-12 overflow-visible ng-pristine ng-untouched ng-valid ng-empty" ng-model="text" aria-invalid="false"></textarea>
		                                            </div>
		                                        </div>
		                                        <div class="gridcell-left">
		                                            <input type="submit" name="submit" class="submit-blue-btn" value="送信する" ng-click="bottombuttonclick()">
		                                        </div>
		                                    </div>
		                                    <div class="col-md-3" style="padding-left:15px;padding-top:25px;">
		                                        <p>対応者</p>
		                                        <p class="ng-binding">administrator</p>
		                                        <p>ステータス変更</p>
		                                        <p>
		                                            <div class="angularsl">
                                                        <select name="location"> 
                                                            <option value="1">未対応</option>
															<option value="2">対応済み</option>
															<option value="3">未対応</option>
                                                        </select>
                                                    </div>
		                                        </p>
		                                        <p>コメント</p>
		                                        <p>
		                                            <textarea name="Text1" class="form-control ng-pristine ng-untouched ng-valid ng-empty" style="width:100%;" rows="10" ng-model="bottomrightsetting.comment" aria-invalid="false"></textarea>
		                                        </p>
		                                        <input type="submit" name="submit" class="submit-blue-btn" value="変更する" ng-click="bottomrightbuttonclick()">

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
