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
		                                <li class="active"><a href="admin/master/profile.php">システム設定</a></li>
		                                <li><a href="admin/master/employeeedit.php">スタッフ登録</a></li>
		                                <li><a href="admin/master/loginhistory.php">ログイン履歴</a></li>
		                                <li><a href="admin/master/edithistory.php">編集履歴</a></li>
		                            </ul>
		                        </div>
		                    </div>

		                    <div class="col-md-9 pull-right">
		                        <div class="site-content">
		                            <label style="font-size:22px;">ログイン設定</label>
		                        </div>
		                        <div class="site-content">
		                            <div class="section-1">
		                                <div class="success-msg" style="display:none;">
		                                    <span class="ng-binding">ログイン設定を登録しました。</span>
		                                </div>
		                            </div>
		                            <div class="section-2 col-md-12">
		                                <div class="col-md-1">
		                                </div>
		                                <div class="col-md-11">
		                                    <form class="form-horizontal ng-invalid ng-invalid-required ng-valid-minlength ng-valid-password-verify ng-dirty ng-valid-parse" name="profileform" style="">
		                                        <div class="form-group" style="margin-top:30px;">
		                                            <p class="col-sm-4">現在の管理者ID</p>
		                                            <div class="col-sm-5">
		                                                <input class="form-control ng-not-empty ng-dirty ng-valid-parse ng-valid ng-valid-required ng-touched" id="focusedInput" type="text" placeholder="現在の管理者ID" ng-model="beforeid" required="" ng-class="{submitted:profileform.submitted}" aria-invalid="false" style="">
		                                            </div>
		                                        </div>
		                                        <div class="form-group" style="margin-top:20px;">
		                                            <p class="col-sm-4">現在の管理者パスワード</p>
		                                            <div class="col-sm-5">
		                                                <input class="form-control ng-valid-minlength ng-not-empty ng-dirty ng-valid-parse ng-valid ng-valid-required ng-touched" id="focusedInput" type="password" placeholder="現在の管理者パスワード" ng-model="beforepassword" ng-minlength="8" required="" ng-class="{submitted:profileform.submitted}" aria-invalid="false" style="">
		                                            </div>
		                                        </div>
		                                        <div class="form-group" style="margin-top:20px;">
		                                            <p class="col-sm-4">新しい管理者ID</p>
		                                            <div class="col-sm-5">
		                                                <input class="form-control ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required ng-valid-minlength" id="focusedInput" type="text" placeholder="8文字以上" ng-model="nextid" ng-minlength="8" required="" ng-class="{submitted:profileform.submitted}" aria-invalid="true">
		                                            </div>
		                                        </div>
		                                        <div class="form-group" style="margin-top:20px;">
		                                            <p class="col-sm-4">新しい管理者パスワード</p>
		                                            <div class="col-sm-5">
		                                                <input class="form-control ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required ng-valid-minlength" id="focusedInput" type="password" placeholder="8文字以上" ng-model="nextpassword" ng-minlength="8" required="" ng-class="{submitted:profileform.submitted}" aria-invalid="true">
		                                                <p style="font-size:12px;margin-left:10px;">確認のため再入力</p>
		                                                <input class="form-control ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required ng-valid-minlength ng-valid-password-verify" id="focusedInput" type="password" ng-model="nextpasswordverify" ng-minlength="8" required="" password-verify="" ng-class="{submitted:profileform.submitted}" aria-invalid="true">
		                                            </div>
		                                        </div>
		                                    </form>
		                                </div>
		                            </div>

		                            <div style="margin-top:50px;">
		                                <input type="submit" class="submit-blue-btn" value="設定変更" ng-click="profileform.submitted= true;submitChange()">
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
