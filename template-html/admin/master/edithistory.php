<?php include ('../inc/header.php'); ?>
	<div class="site">
	    <header ng-controller="HeaderCtrl" class="ng-scope">
	        <!-- ngInclude: header_path -->
		    <div ng-include="header_path" class="ng-scope" style="">
			    <div class="header ng-scope">
					<div class="header-top">
						<div class="pull-left">
							<ul>
								<li class="active"><a href="admin/master">マスター管理</a></li>
								<li><a href="admin/employee">施策データ管理</a></li>
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
						  <li><a href="admin/master">TOP</a></li>
						  <li><a href="admin/master/balancesale.php">収支管理</a></li>
						  <li class="active"><a href="admin/master/profile.php">システム管理</a></li>
						  <li><a href="">ver1.0 &nbsp; </a></li>
						</ul>
					</div>
					
					<div class="breadcrumb" style="margin-bottom:0px;">
						<ul>
							<li><a href="">マスター管理</a><span>&gt;</span></li>
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
		                                <li><a href="admin/master/profile.php">システム設定</a></li>
		                                <li><a href="admin/master/employeeedit.php">スタッフ登録</a></li>
		                                <li><a href="admin/master/loginhistory.php">ログイン履歴</a></li>
		                                <li class="active"><a href="admin/master/edithistory.php">編集履歴</a></li>
		                            </ul>
		                        </div>
		                    </div>
		                    <div class="col-md-9 pull-right">
		                        <div class="site-content">
		                            <div class="section-news">
		                                <label style="font-size:20px">編集履歴</label>
		                            </div>
		                            <div class="row" style="margin-bottom:20px;">
		                                <div class="col-sm-1"></div>
		                                <div class="col-sm-10">
		                                    <form class="searchPart ng-pristine ng-valid">
		                                        <!-- <i class="glyphicon glyphicon-search"></i> -->
		                                        <button type="button" class="submit-blue-search" style="margin-left:10px;" ng-click="submitClear()">クリア</button>
		                                        <button type="button" class="submit-blue-search" ng-click="submitSearch()">検索</button>
		                                        <input type="text" name="search" placeholder="" ng-model="searchtext" class="ng-pristine ng-untouched ng-valid ng-empty" aria-invalid="false">
		                                    </form>
		                                </div>
		                            </div>
		                            <div class="section-5 col-md-12">
		                                <table>
		                                    <thead>
		                                        <tr>
		                                            <th ng-click="clickheader(1)" role="button" tabindex="0">編集日時<span class="table-arrow"></span></th>
		                                            <th ng-click="clickheader(2)" role="button" tabindex="0">編集者ID<span class="table-arrow"></span></th>
		                                            <th ng-click="clickheader(3)" role="button" tabindex="0">名前<span class="table-arrow"></span></th>
		                                            <th ng-click="clickheader(4)" role="button" tabindex="0">編集ページ<span class="table-arrow"></span></th>
		                                            <th ng-click="clickheader(5)" role="button" tabindex="0">編集内容<span class="table-arrow"></span></th>
		                                        </tr>
		                                    </thead>
		                                    <tbody>
		                                        <!-- ngRepeat: tableitem in tablearray -->
		                                        <tr class="" ng-repeat="tableitem in tablearray" style="">
		                                            <td class="ng-binding">2018-09-14 13:51:08</td>
		                                            <td class="ng-binding">125</td>
		                                            <td class="ng-binding">agency</td>
		                                            <td class="ng-binding">施策登録画面</td>
		                                            <td class="ng-binding">新しい施策を登録しました。</td>
		                                        </tr>
		                                        <!-- end ngRepeat: tableitem in tablearray -->
		                                        <tr class="odd" ng-repeat="tableitem in tablearray" style="">
		                                            <td class="ng-binding">2018-09-11 17:23:35</td>
		                                            <td class="ng-binding">administrator</td>
		                                            <td class="ng-binding">administrator</td>
		                                            <td class="ng-binding">顧客情報管理</td>
		                                            <td class="ng-binding">ユーザー：322の権限をなくしました。</td>
		                                        </tr>
		                                        <!-- end ngRepeat: tableitem in tablearray -->
		                                        <tr class="" ng-repeat="tableitem in tablearray">
		                                            <td class="ng-binding">2018-09-11 17:15:28</td>
		                                            <td class="ng-binding">administrator</td>
		                                            <td class="ng-binding">administrator</td>
		                                            <td class="ng-binding">広告管理画面</td>
		                                            <td class="ng-binding">広告を編集しました。</td>
		                                        </tr>
		                                        <!-- end ngRepeat: tableitem in tablearray -->
		                                        <tr class="odd" ng-repeat="tableitem in tablearray">
		                                            <td class="ng-binding">2018-09-07 00:10:43</td>
		                                            <td class="ng-binding">administrator</td>
		                                            <td class="ng-binding">administrator</td>
		                                            <td class="ng-binding">システム管理 - &gt;カテゴリー</td>
		                                            <td class="ng-binding">大きな カテゴリー 公開の設定</td>
		                                        </tr>
		                                        <!-- end ngRepeat: tableitem in tablearray -->
		                                        <tr class="" ng-repeat="tableitem in tablearray">
		                                            <td class="ng-binding">2018-09-06 16:03:02</td>
		                                            <td class="ng-binding">administrator</td>
		                                            <td class="ng-binding">administrator</td>
		                                            <td class="ng-binding">システム管理 - &gt;カテゴリー</td>
		                                            <td class="ng-binding">カテゴリー252を削除しました。</td>
		                                        </tr>
		                                        <!-- end ngRepeat: tableitem in tablearray -->
		                                        <tr class="odd" ng-repeat="tableitem in tablearray">
		                                            <td class="ng-binding">2018-09-06 16:03:02</td>
		                                            <td class="ng-binding">administrator</td>
		                                            <td class="ng-binding">administrator</td>
		                                            <td class="ng-binding">システム管理 - &gt;カテゴリー</td>
		                                            <td class="ng-binding">カテゴリー251を削除しました。</td>
		                                        </tr>
		                                        <!-- end ngRepeat: tableitem in tablearray -->
		                                        <tr class="" ng-repeat="tableitem in tablearray">
		                                            <td class="ng-binding">2018-09-06 16:03:02</td>
		                                            <td class="ng-binding">administrator</td>
		                                            <td class="ng-binding">administrator</td>
		                                            <td class="ng-binding">システム管理 - &gt;カテゴリー</td>
		                                            <td class="ng-binding">カテゴリー250を削除しました。</td>
		                                        </tr>
		                                        <!-- end ngRepeat: tableitem in tablearray -->
		                                        <tr class="odd" ng-repeat="tableitem in tablearray">
		                                            <td class="ng-binding">2018-09-06 16:03:02</td>
		                                            <td class="ng-binding">administrator</td>
		                                            <td class="ng-binding">administrator</td>
		                                            <td class="ng-binding">システム管理 - &gt;カテゴリー</td>
		                                            <td class="ng-binding">カテゴリー249を削除しました。</td>
		                                        </tr>
		                                        <!-- end ngRepeat: tableitem in tablearray -->
		                                        <tr class="" ng-repeat="tableitem in tablearray">
		                                            <td class="ng-binding">2018-09-06 16:03:02</td>
		                                            <td class="ng-binding">administrator</td>
		                                            <td class="ng-binding">administrator</td>
		                                            <td class="ng-binding">システム管理 - &gt;カテゴリー</td>
		                                            <td class="ng-binding">カテゴリー248を削除しました。</td>
		                                        </tr>
		                                        <!-- end ngRepeat: tableitem in tablearray -->
		                                        <tr class="odd" ng-repeat="tableitem in tablearray">
		                                            <td class="ng-binding">2018-09-06 16:01:54</td>
		                                            <td class="ng-binding">administrator</td>
		                                            <td class="ng-binding">administrator</td>
		                                            <td class="ng-binding">システム管理 - &gt;カテゴリー</td>
		                                            <td class="ng-binding">大きな カテゴリー222を削除しました。</td>
		                                        </tr>
		                                        <!-- end ngRepeat: tableitem in tablearray -->
		                                        <tr class="" ng-repeat="tableitem in tablearray">
		                                            <td class="ng-binding">2018-09-06 16:01:42</td>
		                                            <td class="ng-binding">administrator</td>
		                                            <td class="ng-binding">administrator</td>
		                                            <td class="ng-binding">システム管理 - &gt;カテゴリー</td>
		                                            <td class="ng-binding">カテゴリー:222新しいカテゴリを追加しました</td>
		                                        </tr>
		                                        <!-- end ngRepeat: tableitem in tablearray -->
		                                        <tr class="odd" ng-repeat="tableitem in tablearray">
		                                            <td class="ng-binding">2018-09-06 16:00:05</td>
		                                            <td class="ng-binding">administrator</td>
		                                            <td class="ng-binding">administrator</td>
		                                            <td class="ng-binding">システム管理 - &gt;カテゴリー</td>
		                                            <td class="ng-binding">カテゴリー:111新しいカテゴリを追加しました</td>
		                                        </tr>
		                                        <!-- end ngRepeat: tableitem in tablearray -->
		                                        <tr class="" ng-repeat="tableitem in tablearray">
		                                            <td class="ng-binding">2018-09-06 15:59:41</td>
		                                            <td class="ng-binding">administrator</td>
		                                            <td class="ng-binding">administrator</td>
		                                            <td class="ng-binding">システム管理 - &gt;カテゴリー</td>
		                                            <td class="ng-binding">カテゴリー:111新しいカテゴリを追加しました</td>
		                                        </tr>
		                                        <!-- end ngRepeat: tableitem in tablearray -->
		                                        <tr class="odd" ng-repeat="tableitem in tablearray">
		                                            <td class="ng-binding">2018-09-06 15:59:06</td>
		                                            <td class="ng-binding">administrator</td>
		                                            <td class="ng-binding">administrator</td>
		                                            <td class="ng-binding">システム管理 - &gt;カテゴリー</td>
		                                            <td class="ng-binding">カテゴリー:111新しいカテゴリを追加しました</td>
		                                        </tr>
		                                        <!-- end ngRepeat: tableitem in tablearray -->
		                                        <tr class="" ng-repeat="tableitem in tablearray">
		                                            <td class="ng-binding">2018-09-06 15:58:58</td>
		                                            <td class="ng-binding">administrator</td>
		                                            <td class="ng-binding">administrator</td>
		                                            <td class="ng-binding">システム管理 - &gt;カテゴリー</td>
		                                            <td class="ng-binding">カテゴリー:111新しいカテゴリを追加しました</td>
		                                        </tr>
		                                        <!-- end ngRepeat: tableitem in tablearray -->
		                                    </tbody>
		                                </table>
		                            </div>

		                            <div class="pagination">
		                                <ul uib-pagination="" total-items="totaltableitem" max-size="5" ng-model="paginationnumber" previous-text="前へ" next-text="次へ" first-text="最初" last-text="最後" direction-links="false" boundary-links="true" items-per-page="tablepageitemcount" class="pagination-sm ng-pristine ng-untouched ng-valid ng-isolate-scope pagination ng-not-empty" boundary-link-numbers="true" rotate="true" ng-change="paginationchange()" role="menu" aria-invalid="false">
		                                    <!-- ngIf: ::boundaryLinks -->
		                                    <li role="menuitem" ng-if="::boundaryLinks" ng-class="{disabled: noPrevious()||ngDisabled}" class="pagination-first ng-scope disabled"><a href="" ng-click="selectPage(1, $event)" ng-disabled="noPrevious()||ngDisabled" uib-tabindex-toggle="" class="ng-binding" disabled="disabled" tabindex="-1">最初</a></li>
		                                    <!-- end ngIf: ::boundaryLinks -->
		                                    <!-- ngIf: ::directionLinks -->
		                                    <!-- ngRepeat: page in pages track by $index -->
		                                    <li role="menuitem" ng-repeat="page in pages track by $index" ng-class="{active: page.active,disabled: ngDisabled&amp;&amp;!page.active}" class="pagination-page ng-scope active"><a href="" ng-click="selectPage(page.number, $event)" ng-disabled="ngDisabled&amp;&amp;!page.active" uib-tabindex-toggle="" class="ng-binding">1</a></li>
		                                    <!-- end ngRepeat: page in pages track by $index -->
		                                    <li role="menuitem" ng-repeat="page in pages track by $index" ng-class="{active: page.active,disabled: ngDisabled&amp;&amp;!page.active}" class="pagination-page ng-scope"><a href="" ng-click="selectPage(page.number, $event)" ng-disabled="ngDisabled&amp;&amp;!page.active" uib-tabindex-toggle="" class="ng-binding">2</a></li>
		                                    <!-- end ngRepeat: page in pages track by $index -->
		                                    <li role="menuitem" ng-repeat="page in pages track by $index" ng-class="{active: page.active,disabled: ngDisabled&amp;&amp;!page.active}" class="pagination-page ng-scope"><a href="" ng-click="selectPage(page.number, $event)" ng-disabled="ngDisabled&amp;&amp;!page.active" uib-tabindex-toggle="" class="ng-binding">3</a></li>
		                                    <!-- end ngRepeat: page in pages track by $index -->
		                                    <li role="menuitem" ng-repeat="page in pages track by $index" ng-class="{active: page.active,disabled: ngDisabled&amp;&amp;!page.active}" class="pagination-page ng-scope" style=""><a href="" ng-click="selectPage(page.number, $event)" ng-disabled="ngDisabled&amp;&amp;!page.active" uib-tabindex-toggle="" class="ng-binding">4</a></li>
		                                    <!-- end ngRepeat: page in pages track by $index -->
		                                    <li role="menuitem" ng-repeat="page in pages track by $index" ng-class="{active: page.active,disabled: ngDisabled&amp;&amp;!page.active}" class="pagination-page ng-scope"><a href="" ng-click="selectPage(page.number, $event)" ng-disabled="ngDisabled&amp;&amp;!page.active" uib-tabindex-toggle="" class="ng-binding">5</a></li>
		                                    <!-- end ngRepeat: page in pages track by $index -->
		                                    <li role="menuitem" ng-repeat="page in pages track by $index" ng-class="{active: page.active,disabled: ngDisabled&amp;&amp;!page.active}" class="pagination-page ng-scope"><a href="" ng-click="selectPage(page.number, $event)" ng-disabled="ngDisabled&amp;&amp;!page.active" uib-tabindex-toggle="" class="ng-binding">...</a></li>
		                                    <!-- end ngRepeat: page in pages track by $index -->
		                                    <li role="menuitem" ng-repeat="page in pages track by $index" ng-class="{active: page.active,disabled: ngDisabled&amp;&amp;!page.active}" class="pagination-page ng-scope"><a href="" ng-click="selectPage(page.number, $event)" ng-disabled="ngDisabled&amp;&amp;!page.active" uib-tabindex-toggle="" class="ng-binding">82</a></li>
		                                    <!-- end ngRepeat: page in pages track by $index -->
		                                    <!-- ngIf: ::directionLinks -->
		                                    <!-- ngIf: ::boundaryLinks -->
		                                    <li role="menuitem" ng-if="::boundaryLinks" ng-class="{disabled: noNext()||ngDisabled}" class="pagination-last ng-scope"><a href="" ng-click="selectPage(totalPages, $event)" ng-disabled="noNext()||ngDisabled" uib-tabindex-toggle="" class="ng-binding">最後</a></li>
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
<?php include ('../inc/footer.php'); ?>
