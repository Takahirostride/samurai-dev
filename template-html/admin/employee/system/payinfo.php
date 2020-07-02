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
		                                <li><a href="admin/employee/system/question.php">企業情報質問内容管理</a></li>
		                                <li class="active"><a href="admin/employee/system/payinfo.php">有料情報管理</a></li>
		                                <li><a href="admin/employee/system/notification.php">通知管理</a></li>
		                                <li><a href="admin/employee/system/blog.php">ブログ管理</a></li>
		                            </ul>
		                        </div>
		                    </div>
		                    <div class="col-md-9 pull-right">
		                        <div class="site-content">
		                            <div class="blueheading"><span>有料情報設定管理</span></div>
		                            <form name="payinfo" class="ng-pristine ng-valid ng-valid-min ng-valid-required ng-valid-max">
		                                <fieldset class="scheduler-border">
		                                    <legend class="scheduler-border">有料オプション</legend>
		                                    <div class="row" style="margin-top: 5px;margin-bottom: 5px">
		                                        <div class="col-sm-3">
		                                            <h5>急募オプション</h5>
		                                        </div>
		                                        <div class="col-sm-4">
		                                            <div class="form-group has-feedback">
		                                                <input type="number" class="form-control ng-pristine ng-untouched ng-valid ng-not-empty ng-valid-min ng-valid-required" ng-model="paysetting.quick_invitation_option" required="" min="0" ng-class="{submitted:payinfo.submitted}" aria-invalid="false">
		                                                <span class="form-control-feedback">円</span>
		                                            </div>
		                                        </div>
		                                    </div>
		                                    <div class="row" style="margin-top: 5px;margin-bottom: 5px">
		                                        <div class="col-sm-3">
		                                            <h5>注目オプション</h5>
		                                        </div>
		                                        <div class="col-sm-4">
		                                            <div class="form-group has-feedback">
		                                                <input type="number" class="form-control ng-pristine ng-untouched ng-valid ng-not-empty ng-valid-min ng-valid-required" ng-model="paysetting.featured_option" required="" min="0" ng-class="{submitted:payinfo.submitted}" aria-invalid="false">
		                                                <span class="form-control-feedback">円</span>
		                                            </div>
		                                        </div>
		                                    </div>
		                                    <div class="row" style="margin-top: 5px;margin-bottom: 5px">
		                                        <div class="col-sm-3">
		                                            <h5>非公開オプション</h5>
		                                        </div>
		                                        <div class="col-sm-4">
		                                            <div class="form-group has-feedback">
		                                                <input type="number" class="form-control ng-pristine ng-untouched ng-valid ng-not-empty ng-valid-min ng-valid-required" ng-model="paysetting.private_option" required="" min="0" ng-class="{submitted:payinfo.submitted}" aria-invalid="false">
		                                                <span class="form-control-feedback">円</span>
		                                            </div>
		                                        </div>
		                                    </div>
		                                    <div class="row" style="margin-top: 5px;margin-bottom: 5px">
		                                        <div class="col-sm-3">
		                                            <h5>完全非公開オプション</h5>
		                                        </div>
		                                        <div class="col-sm-4">
		                                            <div class="form-group has-feedback">
		                                                <input type="number" class="form-control ng-pristine ng-untouched ng-valid ng-not-empty ng-valid-min ng-valid-required" ng-model="paysetting.completely_private_option" required="" min="0" ng-class="{submitted:payinfo.submitted}" aria-invalid="false">
		                                                <span class="form-control-feedback">円</span>
		                                            </div>
		                                        </div>
		                                    </div>
		                                    <div class="row" style="margin-top: 5px;margin-bottom: 5px">
		                                        <div class="col-sm-3">
		                                            <h5>士業100人への一斉通知オプション</h5>
		                                        </div>
		                                        <div class="col-sm-4">
		                                            <div class="form-group has-feedback">
		                                                <input type="number" class="form-control ng-pristine ng-untouched ng-valid ng-not-empty ng-valid-min ng-valid-required" ng-model="paysetting.notification_to_100_option" required="" min="0" ng-class="{submitted:payinfo.submitted}" aria-invalid="false">
		                                                <span class="form-control-feedback">円</span>
		                                            </div>
		                                        </div>
		                                    </div>
		                                    <div class="row" style="margin-top: 5px;margin-bottom: 5px">
		                                        <div class="col-sm-3">
		                                            <h5>認定士業への一斉通知オプション</h5>
		                                        </div>
		                                        <div class="col-sm-4">
		                                            <div class="form-group has-feedback">
		                                                <input type="number" class="form-control ng-pristine ng-untouched ng-valid ng-not-empty ng-valid-min ng-valid-required" ng-model="paysetting.notification_to_cert_option" required="" min="0" ng-class="{submitted:payinfo.submitted}" aria-invalid="false">
		                                                <span class="form-control-feedback">円</span>
		                                            </div>
		                                        </div>
		                                    </div>
		                                    <div class="row" style="margin-top: 5px;margin-bottom: 5px">
		                                        <div class="col-sm-3">
		                                            <h5>マイページ表示オプション</h5>
		                                        </div>
		                                        <div class="col-sm-4">
		                                            <div class="form-group has-feedback">
		                                                <input type="number" class="form-control ng-pristine ng-untouched ng-valid ng-not-empty ng-valid-min ng-valid-required" ng-model="paysetting.mypage_display_option" required="" min="0" ng-class="{submitted:payinfo.submitted}" aria-invalid="false">
		                                                <span class="form-control-feedback">円</span>
		                                            </div>
		                                        </div>
		                                    </div>
		                                </fieldset>

		                                <fieldset class="scheduler-border">
		                                    <legend class="scheduler-border">有料会員</legend>
		                                    <div class="row" style="margin-top: 5px;margin-bottom: 5px">
		                                        <div class="col-sm-3">
		                                            <h5>有料会員</h5>
		                                        </div>
		                                        <div class="col-sm-4">
		                                            <div class="form-group has-feedback">
		                                                <input type="number" class="form-control ng-pristine ng-untouched ng-valid ng-not-empty ng-valid-min ng-valid-required" ng-model="paysetting.payroll_money" required="" min="0" ng-class="{submitted:payinfo.submitted}" aria-invalid="false">
		                                                <span class="form-control-feedback">円</span>
		                                            </div>
		                                        </div>
		                                    </div>
		                                    <div class="row" style="margin-top: 5px;margin-bottom: 5px">
		                                        <div class="col-sm-3">
		                                            <h5>無料期間</h5>
		                                        </div>
		                                        <div class="col-sm-4">
		                                            <div class="form-group has-feedback">
		                                                <input type="number" class="form-control ng-pristine ng-untouched ng-valid ng-not-empty ng-valid-min ng-valid-required" ng-model="paysetting.free_charge_duration" required="" min="0" ng-class="{submitted:payinfo.submitted}" aria-invalid="false">
		                                                <span class="form-control-feedback">月</span>
		                                            </div>
		                                        </div>
		                                    </div>
		                                </fieldset>

		                                <fieldset class="scheduler-border">
		                                    <legend class="scheduler-border">販売者料金</legend>
		                                    <div class="row" style="margin-top: 5px;margin-bottom: 5px">
		                                        <div class="col-sm-3">
		                                            <h5>掲載数　１</h5>
		                                        </div>
		                                        <div class="col-sm-4">
		                                            <div class="form-group has-feedback">
		                                                <input type="number" class="form-control ng-pristine ng-untouched ng-valid ng-not-empty ng-valid-min ng-valid-required" ng-model="paysetting.advertise1" required="" min="0" ng-class="{submitted:payinfo.submitted}" aria-invalid="false">
		                                                <span class="form-control-feedback">円</span>
		                                            </div>
		                                        </div>
		                                    </div>
		                                    <div class="row" style="margin-top: 5px;margin-bottom: 5px">
		                                        <div class="col-sm-3">
		                                            <h5>掲載数　3</h5>
		                                        </div>
		                                        <div class="col-sm-4">
		                                            <div class="form-group has-feedback">
		                                                <input type="number" class="form-control ng-pristine ng-untouched ng-valid ng-not-empty ng-valid-min ng-valid-required" ng-model="paysetting.advertise3" required="" min="0" ng-class="{submitted:payinfo.submitted}" aria-invalid="false">
		                                                <span class="form-control-feedback">円</span>
		                                            </div>
		                                        </div>
		                                    </div>
		                                    <div class="row" style="margin-top: 5px;margin-bottom: 5px">
		                                        <div class="col-sm-3">
		                                            <h5>掲載数　5</h5>
		                                        </div>
		                                        <div class="col-sm-4">
		                                            <div class="form-group has-feedback">
		                                                <input type="number" class="form-control ng-pristine ng-untouched ng-valid ng-not-empty ng-valid-min ng-valid-required" ng-model="paysetting.advertise5" required="" min="0" ng-class="{submitted:payinfo.submitted}" aria-invalid="false">
		                                                <span class="form-control-feedback">円</span>
		                                            </div>
		                                        </div>
		                                    </div>
		                                    <div class="row" style="margin-top: 5px;margin-bottom: 5px">
		                                        <div class="col-sm-3">
		                                            <h5>掲載数　10</h5>
		                                        </div>
		                                        <div class="col-sm-4">
		                                            <div class="form-group has-feedback">
		                                                <input type="number" class="form-control ng-pristine ng-untouched ng-valid ng-not-empty ng-valid-min ng-valid-required" ng-model="paysetting.advertise10" required="" min="0" ng-class="{submitted:payinfo.submitted}" aria-invalid="false">
		                                                <span class="form-control-feedback">円</span>
		                                            </div>
		                                        </div>
		                                    </div>
		                                    <div class="row" style="margin-top: 5px;margin-bottom: 5px">
		                                        <div class="col-sm-3">
		                                            <h5>掲載数　20</h5>
		                                        </div>
		                                        <div class="col-sm-4">
		                                            <div class="form-group has-feedback">
		                                                <input type="number" class="form-control ng-pristine ng-untouched ng-valid ng-not-empty ng-valid-min ng-valid-required" ng-model="paysetting.advertise20" required="" min="0" ng-class="{submitted:payinfo.submitted}" aria-invalid="false">
		                                                <span class="form-control-feedback">円</span>
		                                            </div>
		                                        </div>
		                                    </div>
		                                    <div class="row" style="margin-top: 5px;margin-bottom: 5px">
		                                        <div class="col-sm-3">
		                                            <h5>掲載数　30</h5>
		                                        </div>
		                                        <div class="col-sm-4">
		                                            <div class="form-group has-feedback">
		                                                <input type="number" class="form-control ng-pristine ng-untouched ng-valid ng-not-empty ng-valid-min ng-valid-required" ng-model="paysetting.advertise30" required="" min="0" ng-class="{submitted:payinfo.submitted}" aria-invalid="false">
		                                                <span class="form-control-feedback">円</span>
		                                            </div>
		                                        </div>
		                                    </div>
		                                </fieldset>

		                                <fieldset class="scheduler-border">
		                                    <legend class="scheduler-border">アフィリエイト</legend>
		                                    <div class="row" style="margin-top: 5px;margin-bottom: 5px">
		                                        <div class="col-sm-3">
		                                            <h5>利益率</h5>
		                                        </div>
		                                        <div class="col-sm-4">
		                                            <div class="form-group has-feedback">
		                                                <input type="number" class="form-control ng-pristine ng-untouched ng-valid ng-not-empty ng-valid-min ng-valid-max ng-valid-required" ng-model="paysetting.affiliate_profit" required="" min="0" ng-class="{submitted:payinfo.submitted}" max="100" aria-invalid="false">
		                                                <span class="form-control-feedback">%</span>
		                                            </div>
		                                        </div>
		                                    </div>
		                                </fieldset>

		                                <fieldset class="scheduler-border">
		                                    <legend class="scheduler-border">サイト利用料</legend>
		                                    <div class="row" style="margin-top: 5px;margin-bottom: 5px">
		                                        <div class="col-sm-3">
		                                            <h5>利益率</h5>
		                                        </div>
		                                        <div class="col-sm-4">
		                                            <div class="form-group has-feedback">
		                                                <input type="number" class="form-control ng-pristine ng-untouched ng-valid ng-not-empty ng-valid-min ng-valid-max ng-valid-required" ng-model="paysetting.site_profit" required="" min="0" ng-class="{submitted:payinfo.submitted}" max="100" aria-invalid="false">
		                                                <span class="form-control-feedback">%</span>
		                                            </div>
		                                        </div>
		                                    </div>
		                                </fieldset>
		                            </form>
		                            <div style="margin-top:50px;">
		                                <input type="submit" name="submit" class="submit-blue-btn" value="保存する" ng-click="payinfo.submitted= true;submitChange()">
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
