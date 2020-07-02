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
		                                <li class="active"><a href="admin/master/employeeedit.php">スタッフ登録</a></li>
		                                <li><a href="admin/master/loginhistory.php">ログイン履歴</a></li>
		                                <li><a href="admin/master/edithistory.php">編集履歴</a></li>
		                            </ul>
		                        </div>
		                    </div>

		                    <div class="col-md-9 pull-right">
		                        <div class="site-content">
		                            <div class="section-1">
		                                <div class="success-msg" style="display:none;">
		                                    <span class="ng-binding">新規スタッフを登録しました。</span>
		                                </div>
		                            </div>
		                            <div class="section-2 col-md-12">
		                                <div class="col-md-1">
		                                </div>
		                                <div class="col-md-11">
		                                    <form class="form-horizontal ng-pristine ng-invalid ng-invalid-required ng-valid-minlength ng-valid-password-verify" name="registerform">
		                                        <div class="form-group" style="margin-top:30px;">
		                                            <p class="col-sm-4">スタッフID</p>
		                                            <p class="col-sm-5 ng-binding">自動で割り当てる</p>
		                                        </div>
		                                        <div class="form-group" style="margin-top:20px;">
		                                            <p class="col-sm-4">氏名</p>
		                                            <div class="col-sm-5">
		                                                <input class="form-control ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required" id="focusedInput" type="text" placeholder="氏名" ng-model="employeename" required="" ng-class="{submitted:registerform.submitted}" aria-invalid="true">
		                                            </div>
		                                        </div>
		                                        <div class="form-group" style="margin-top:20px;">
		                                            <p class="col-sm-4">管理者権限</p>
		                                            <div class="col-sm-6">
		                                                <input type="radio" name="permission" ng-model="employeepermission" value="1" required="" ng-class="{submitted:registerform.submitted}" class="ng-pristine ng-untouched ng-valid ng-not-empty ng-valid-required" aria-invalid="false">master &nbsp; &nbsp; &nbsp;
		                                                <input type="radio" name="permission" ng-model="employeepermission" value="2" required="" ng-class="{submitted:registerform.submitted}" class="ng-pristine ng-untouched ng-valid ng-not-empty ng-valid-required" aria-invalid="false">運営者 &nbsp; &nbsp; &nbsp;
		                                                <input type="radio" name="permission" ng-model="employeepermission" value="3" required="" ng-class="{submitted:registerform.submitted}" class="ng-pristine ng-untouched ng-valid ng-not-empty ng-valid-required" aria-invalid="false">編集者
		                                            </div>
		                                        </div>
		                                        <div class="form-group" style="margin-top:20px;">
		                                            <p class="col-sm-4">ログインID</p>
		                                            <div class="col-sm-5">
		                                                <input class="form-control ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required ng-valid-minlength" id="focusedInput" type="text" placeholder="8文字以上" ng-model="employeeloginid" ng-minlength="8" required="" ng-class="{submitted:registerform.submitted}" aria-invalid="true">
		                                            </div>
		                                        </div>
		                                        <div class="form-group" style="margin-top:20px;">
		                                            <p class="col-sm-4">ログインパスワード</p>
		                                            <div class="col-sm-5">
		                                                <input class="form-control ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required ng-valid-minlength" id="focusedInput" type="password" placeholder="8文字以上" ng-model="employeepassword" ng-minlength="8" required="" ng-class="{submitted:registerform.submitted}" aria-invalid="true">
		                                            </div>
		                                        </div>
		                                        <div class="form-group" style="margin-top:20px;">
		                                            <p class="col-sm-4">(確認)</p>
		                                            <div class="col-sm-5">
		                                                <input class="form-control ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required ng-valid-minlength ng-valid-password-verify" id="focusedInput" type="password" ng-model="employeepasswordverify" ng-minlength="8" required="" password-verify="" ng-class="{submitted:registerform.submitted}" aria-invalid="true">
		                                            </div>
		                                        </div>
		                                    </form>
		                                </div>
		                            </div>

		                            <div style="margin-top:50px;">
		                                <input type="submit" name="submit" class="submit-blue-btn" value="登録する" ng-click="registerform.submitted=true;submitRegister()">
		                            </div>

		                            <h4 style="background-color:#F4F4F4;margin-left:10px;">スタッフ一覧</h4>

		                            <div class="row" style="margin-bottom:20px;">
		                                <div class="col-sm-12">
		                                    <form class="searchPart ng-pristine ng-valid">
		                                        <!-- <i class="glyphicon glyphicon-search"></i> -->
		                                        <button type="button" class="submit-blue-search" style="margin-left:10px;" ng-click="clearsearchbox()">クリア</button>
		                                        <button type="button" class="submit-blue-search" ng-click="clicksearchbutton()">検索</button>
		                                        <input type="text" name="search" placeholder="" ng-model="searchkeyword" class="ng-pristine ng-untouched ng-valid ng-empty" aria-invalid="false">
		                                    </form>
		                                </div>
		                            </div>

		                            <div class="section-4 col-md-12">
		                                <table>
		                                    <thead>
		                                        <tr>
		                                            <th>表示・編集</th>
		                                            <th>登録日</th>
		                                            <th>スタッフID</th>
		                                            <th>名前</th>
		                                            <th>権限</th>
		                                            <th>ログインID</th>
		                                            <th>ログインパスワード</th>
		                                        </tr>
		                                    </thead>
		                                    <tbody>
		                                        <!-- ngRepeat: tableitem in tablearray -->
		                                        <tr class="" ng-repeat="tableitem in tablearray" style="">
		                                            <td>
		                                                <button type="button" class="submit-edit-button" style="margin-right:10px;" ng-click="submitEditEmployee(tableitem.employeeindex)"></button>
		                                                <button type="button" class="submit-delete-button" ng-click="submitDeleteEmployee($event,tableitem.employeeindex)"></button>
		                                            </td>
		                                            <td class="ng-binding">2017-08-03 15:53:15</td>
		                                            <td class="ng-binding">3045559129564403880730188527214968140439</td>
		                                            <td class="ng-binding">John Smith</td>
		                                            <td class="ng-binding">運営者</td>
		                                            <td class="ng-binding">john_smith</td>
		                                            <td class="ng-binding">**********</td>
		                                        </tr>
		                                        <!-- end ngRepeat: tableitem in tablearray -->
		                                        <tr class="odd" ng-repeat="tableitem in tablearray" style="">
		                                            <td>
		                                                <button type="button" class="submit-edit-button" style="margin-right:10px;" ng-click="submitEditEmployee(tableitem.employeeindex)"></button>
		                                                <button type="button" class="submit-delete-button" ng-click="submitDeleteEmployee($event,tableitem.employeeindex)"></button>
		                                            </td>
		                                            <td class="ng-binding">2017-08-05 07:30:27</td>
		                                            <td class="ng-binding">1064725166121193642654425061412914515774</td>
		                                            <td class="ng-binding">administrator</td>
		                                            <td class="ng-binding">master</td>
		                                            <td class="ng-binding">administrator</td>
		                                            <td class="ng-binding">**********</td>
		                                        </tr>
		                                        <!-- end ngRepeat: tableitem in tablearray -->
		                                        <tr class="" ng-repeat="tableitem in tablearray">
		                                            <td>
		                                                <button type="button" class="submit-edit-button" style="margin-right:10px;" ng-click="submitEditEmployee(tableitem.employeeindex)"></button>
		                                                <button type="button" class="submit-delete-button" ng-click="submitDeleteEmployee($event,tableitem.employeeindex)"></button>
		                                            </td>
		                                            <td class="ng-binding">2017-08-05 09:39:58</td>
		                                            <td class="ng-binding">0707239478085081773515532575833908330252</td>
		                                            <td class="ng-binding">granteditor</td>
		                                            <td class="ng-binding">編集者</td>
		                                            <td class="ng-binding">granteditor</td>
		                                            <td class="ng-binding">**********</td>
		                                        </tr>
		                                        <!-- end ngRepeat: tableitem in tablearray -->
		                                        <tr class="odd" ng-repeat="tableitem in tablearray">
		                                            <td>
		                                                <button type="button" class="submit-edit-button" style="margin-right:10px;" ng-click="submitEditEmployee(tableitem.employeeindex)"></button>
		                                                <button type="button" class="submit-delete-button" ng-click="submitDeleteEmployee($event,tableitem.employeeindex)"></button>
		                                            </td>
		                                            <td class="ng-binding">2017-11-14 18:18:47</td>
		                                            <td class="ng-binding">0807912496098656144503907534665822334182</td>
		                                            <td class="ng-binding">出口グラウシオ</td>
		                                            <td class="ng-binding">master</td>
		                                            <td class="ng-binding">gura@grand2.com</td>
		                                            <td class="ng-binding">**********</td>
		                                        </tr>
		                                        <!-- end ngRepeat: tableitem in tablearray -->
		                                        <tr class="" ng-repeat="tableitem in tablearray">
		                                            <td>
		                                                <button type="button" class="submit-edit-button" style="margin-right:10px;" ng-click="submitEditEmployee(tableitem.employeeindex)"></button>
		                                                <button type="button" class="submit-delete-button" ng-click="submitDeleteEmployee($event,tableitem.employeeindex)"></button>
		                                            </td>
		                                            <td class="ng-binding">2017-11-14 18:22:50</td>
		                                            <td class="ng-binding">0011637572092713582133955033473227234583</td>
		                                            <td class="ng-binding">木村玲子</td>
		                                            <td class="ng-binding">運営者</td>
		                                            <td class="ng-binding">kimura@grand2.com</td>
		                                            <td class="ng-binding">**********</td>
		                                        </tr>
		                                        <!-- end ngRepeat: tableitem in tablearray -->
		                                        <tr class="odd" ng-repeat="tableitem in tablearray">
		                                            <td>
		                                                <button type="button" class="submit-edit-button" style="margin-right:10px;" ng-click="submitEditEmployee(tableitem.employeeindex)"></button>
		                                                <button type="button" class="submit-delete-button" ng-click="submitDeleteEmployee($event,tableitem.employeeindex)"></button>
		                                            </td>
		                                            <td class="ng-binding">2017-11-14 18:24:36</td>
		                                            <td class="ng-binding">1086064848536594923154196075304340664624</td>
		                                            <td class="ng-binding">高橋新祐</td>
		                                            <td class="ng-binding">運営者</td>
		                                            <td class="ng-binding">takashi-s@grand2.com</td>
		                                            <td class="ng-binding">**********</td>
		                                        </tr>
		                                        <!-- end ngRepeat: tableitem in tablearray -->
		                                        <tr class="" ng-repeat="tableitem in tablearray">
		                                            <td>
		                                                <button type="button" class="submit-edit-button" style="margin-right:10px;" ng-click="submitEditEmployee(tableitem.employeeindex)"></button>
		                                                <button type="button" class="submit-delete-button" ng-click="submitDeleteEmployee($event,tableitem.employeeindex)"></button>
		                                            </td>
		                                            <td class="ng-binding">2017-11-14 18:25:56</td>
		                                            <td class="ng-binding">2672927920302005042048982520451347707102</td>
		                                            <td class="ng-binding">テスト</td>
		                                            <td class="ng-binding">編集者</td>
		                                            <td class="ng-binding">testtest</td>
		                                            <td class="ng-binding">**********</td>
		                                        </tr>
		                                        <!-- end ngRepeat: tableitem in tablearray -->
		                                        <tr class="odd" ng-repeat="tableitem in tablearray">
		                                            <td>
		                                                <button type="button" class="submit-edit-button" style="margin-right:10px;" ng-click="submitEditEmployee(tableitem.employeeindex)"></button>
		                                                <button type="button" class="submit-delete-button" ng-click="submitDeleteEmployee($event,tableitem.employeeindex)"></button>
		                                            </td>
		                                            <td class="ng-binding">2017-11-27 19:16:15</td>
		                                            <td class="ng-binding">2807664288020385825649778564141324062051</td>
		                                            <td class="ng-binding">木村玲子</td>
		                                            <td class="ng-binding">master</td>
		                                            <td class="ng-binding">kimurareiko</td>
		                                            <td class="ng-binding">**********</td>
		                                        </tr>
		                                        <!-- end ngRepeat: tableitem in tablearray -->
		                                        <tr class="" ng-repeat="tableitem in tablearray">
		                                            <td>
		                                                <button type="button" class="submit-edit-button" style="margin-right:10px;" ng-click="submitEditEmployee(tableitem.employeeindex)"></button>
		                                                <button type="button" class="submit-delete-button" ng-click="submitDeleteEmployee($event,tableitem.employeeindex)"></button>
		                                            </td>
		                                            <td class="ng-binding">2017-12-20 13:03:57</td>
		                                            <td class="ng-binding">2122837894436223444714525602256304034523</td>
		                                            <td class="ng-binding">ST-Test_Admin</td>
		                                            <td class="ng-binding">運営者</td>
		                                            <td class="ng-binding">ST-Test_Admin</td>
		                                            <td class="ng-binding">**********</td>
		                                        </tr>
		                                        <!-- end ngRepeat: tableitem in tablearray -->
		                                        <tr class="odd" ng-repeat="tableitem in tablearray">
		                                            <td>
		                                                <button type="button" class="submit-edit-button" style="margin-right:10px;" ng-click="submitEditEmployee(tableitem.employeeindex)"></button>
		                                                <button type="button" class="submit-delete-button" ng-click="submitDeleteEmployee($event,tableitem.employeeindex)"></button>
		                                            </td>
		                                            <td class="ng-binding">2018-04-02 04:22:53</td>
		                                            <td class="ng-binding">4639142608516140765745216581165615040243</td>
		                                            <td class="ng-binding">tester</td>
		                                            <td class="ng-binding">master</td>
		                                            <td class="ng-binding">tester123</td>
		                                            <td class="ng-binding">**********</td>
		                                        </tr>
		                                        <!-- end ngRepeat: tableitem in tablearray -->
		                                    </tbody>
		                                </table>
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
