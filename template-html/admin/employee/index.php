<?php include ('../inc/header.php'); ?>
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
	                        <li class="active"><a href="admin/employee">TOP</a></li>
	                        <li><a href="admin/employee/balance/sale.php">収支管理</a></li>
	                        <li><a href="admin/employee/system/advertisement.php">システム管理</a></li>
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
	                        <li><a>TOP</a></li>
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
	                            <div class="sidebar-left" style="margin-bottom:90px;">
	                                <ul>
	                                    <li><a href="admin/employee">サイトへ</a></li>
	                                </ul>
	                            </div>
	                            <div class="sidebar-left">
	                                <ul>
	                                    <li><a href="admin/employee/csv.php">csv管理</a></li>
	                                    <li><a href="admin/employee/uploadfile.php">アップロードファイル管理</a></li>
	                                    <li><a href="admin/employee/email.php">メール</a></li>
	                                </ul>
	                            </div>
	                        </div>
	                        <div class="col-md-9 pull-right">
	                            <div class="site-content">
	                                <div class="section-news">
	                                    <!-- ngRepeat: newsitem in newsitemlist -->
	                                    <div class="success-msg ng-scope" ng-repeat="newsitem in newsitemlist" style="">
	                                        <span class="ng-binding">2018-09-14 13:51:08&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;新しい施策を登録しました。</span>
	                                    </div>
	                                    <!-- end ngRepeat: newsitem in newsitemlist -->
	                                    <div class="success-msg ng-scope" ng-repeat="newsitem in newsitemlist">
	                                        <span class="ng-binding">2018-09-11 17:23:35&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ユーザー：322の権限をなくしました。</span>
	                                    </div>
	                                    <!-- end ngRepeat: newsitem in newsitemlist -->
	                                    <div class="success-msg ng-scope" ng-repeat="newsitem in newsitemlist">
	                                        <span class="ng-binding">2018-09-11 17:15:28&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;広告を編集しました。</span>
	                                    </div>
	                                    <!-- end ngRepeat: newsitem in newsitemlist -->
	                                    <div class="success-msg ng-scope" ng-repeat="newsitem in newsitemlist">
	                                        <span class="ng-binding">2018-09-07 00:10:43&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;大きな カテゴリー 公開の設定</span>
	                                    </div>
	                                    <!-- end ngRepeat: newsitem in newsitemlist -->
	                                    <div class="success-msg ng-scope" ng-repeat="newsitem in newsitemlist">
	                                        <span class="ng-binding">2018-09-06 16:03:02&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;カテゴリー248を削除しました。</span>
	                                    </div>
	                                    <!-- end ngRepeat: newsitem in newsitemlist -->
	                                </div>
	                            </div>
	                            <div class="site-content" style="margin-top:30px;">
	                                <div class="row" style="margin-left:6px;margin-right:6px;">
	                                    <div class="col-sm-4">
	                                        <div class="home-colmenu-content">
	                                            <strong>■収支管理</strong>
	                                            <div class="home-colmenu-items">
	                                                <p><a href="admin/employee/balance/sale.php">・売上管理</a></p>
	                                                <p><a href="admin/employee/balance/depwith.php">・入出金管理</a></p>
	                                                <p><a href="admin/employee/balance/payplan.php">・支払予定管理</a></p>
	                                                <p><a href="admin/employee/balance/data.php">・データ総括</a></p>
	                                            </div>
	                                        </div>
	                                    </div>
	                                    <div class="col-sm-4">
	                                        <div class="home-colmenu-content">
	                                            <strong>■システム管理</strong>
	                                            <div class="home-colmenu-items">
	                                                <p><a href="admin/employee/system/advertisement.php">・広告表示管理</a></p>
	                                                <p><a href="admin/employee/system/suggest.php">・おススメの補助金・助成金</a></p>
	                                                <p><a href="admin/employee/system/industry.php">・業種</a></p>
	                                                <p><a href="admin/employee/system/tag.php">・タグ管理</a></p>
	                                                <p><a href="admin/employee/system/category.php">・カテゴリー</a></p>
	                                                <p><a href="admin/employee/system/payinfo.php">・有料情報管理</a></p>
	                                                <p><a href="admin/employee/system/notification.php">・通知管理</a></p>
	                                                <p><a href="admin/employee/system/blog.php">・ブログ管理</a></p>
	                                            </div>
	                                        </div>
	                                    </div>
	                                    <div class="col-sm-4">
	                                        <div class="home-colmenu-content">
	                                            <strong>■顧客情報一覧</strong>
	                                            <div class="home-colmenu-items">
	                                                <p><a href="admin/employee/customerinfo/agencylist.php">・士業一覧</a></p>
	                                                <p><a href="admin/employee/customerinfo/clientlist.php">・事業者一覧</a></p>
	                                                <p><a href="admin/employee/customerinfo/matchinglist.php">・マッチング一覧</a></p>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>

	                                <div class="row" style="margin-left:6px;margin-right:6px;">
	                                    <div class="col-sm-4">
	                                        <div class="home-colmenu-content">
	                                            <strong>■顧客対応一覧</strong>
	                                            <div class="home-colmenu-items">
	                                                <p><a href="admin/employee/customersupport/inquiry.php">・お問い合わせ管理</a></p>
	                                                <p><a href="admin/employee/customersupport/contact.php">・お問い合わせ対応設定</a></p>
	                                                <p><a href="admin/employee/customersupport/identifydoc.php">・本人確認書類管理</a></p>
	                                                <p><a href="admin/employee/customersupport/identifyphrase.php">・本人確認書類対応設定</a></p>
	                                                <p><a href="admin/employee/customersupport/violator.php">・違反者管理</a></p>
	                                                <p><a href="admin/employee/customersupport/violatorphrase.php">・違反者対応設定</a></p>
	                                            </div>
	                                        </div>
	                                    </div>
	                                    <div class="col-sm-4">
	                                        <div class="home-colmenu-content">
	                                            <strong>■データ管理情報一覧</strong>
	                                            <div class="home-colmenu-items">
	                                                <p><a href="admin/employee/data/subsidylist.php">・助成金データ</a></p>
	                                                <p><a href="admin/employee/data/subsidyagency.php">・士業登録助成金データ</a></p>
	                                                <p><a href="admin/employee/data/subsidyadd.php">・助成金データ新規登録</a></p>
	                                                <p><a href="admin/employee/data/document.php">・書類管理</a></p>
	                                                <p><a href="admin/employee/data/registration.php">・登録募集施策</a></p>
	                                            </div>
	                                        </div>
	                                    </div>
	                                    <div class="col-sm-4">
	                                        <div class="home-colmenu-content">
	                                            <strong>■その他管理</strong>
	                                            <div class="home-colmenu-items">
	                                                <p><a href="admin/employee/other/affiliate.php">・アフィリエイター管理</a></p>
	                                                <p><a href="admin/employee/other/payment.php">・支払管理</a></p>
	                                                <p><a href="admin/employee/other/companies.php">・仕事提携可能会社一覧</a></p>
	                                                <p><a href="admin/employee/other/data.php">・データ総括</a></p>
	                                                <p><a href="admin/employee/other/seminardata.php">・セミナーデータ一覧</a></p>
	                                                <p><a href="admin/employee/other/seminarapplicant.php">・セミナー申込者一覧</a></p>
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
	</div>
<?php include ('../inc/footer.php'); ?>
