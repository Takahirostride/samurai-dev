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
						  <li class="active"><a href="admin/master/balancesale.php">収支管理</a></li>
						  <li><a href="admin/master/profile.php">システム管理</a></li>
						  <li><a href="">ver1.0 &nbsp; </a></li>
						</ul>
					</div>
					
					<div class="breadcrumb" style="margin-bottom:0px;">
						<ul>
							<li><a href="">マスター管理</a><span>&gt;</span></li>
							<li><a>収支管理</a></li>
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
		                                <li><a href="admin/master/balancesale.php">売上管理</a></li>
		                                <li><a href="admin/master/balancedepwith.php">入出金管理</a></li>
		                                <li><a href="admin/master/balancepayplan.php">支払予定管理</a></li>
		                                <li class="active"><a href="master/balancedata.php">データ総括</a></li>
		                            </ul>
		                        </div>
		                    </div>
		                    <div class="col-md-9 pull-right">
		                        <div class="site-content">
		                            <!-- ngIf: success_balancedata -->
		                            <div class="section-1 ng-scope" ng-if="success_balancedata" style="">
		                                <div class="success-msg">
		                                    <span>データ総括データを出力しました。</span>
		                                </div>
		                            </div>
		                            <!-- end ngIf: success_balancedata -->

		                            <div class="section-2 col-md-12">
		                                <div class="row">
		                                    <div class="col-md-1" style="width:5%;"></div>
		                                    <div class="col-md-4">
		                                        <form class="form-horizontal ng-pristine ng-valid ng-valid-min ng-valid-max">
		                                            <div class="form-group">
		                                                <div class="col-sm-3" style="padding-right:0px;">
		                                                    <input class="form-control ng-pristine ng-untouched ng-valid ng-empty ng-valid-min ng-valid-max" type="number" ng-model="from.year" min="2018" max="2100" ng-change="search()" aria-invalid="false">
		                                                </div>
		                                                <p class="col-sm-1" style="padding-right:0px;">年</p>
		                                                <div class="col-sm-2" style="padding-left:0px;padding-right:0px;">
		                                                    <input class="form-control ng-pristine ng-untouched ng-valid ng-empty ng-valid-min ng-valid-max" type="number" ng-model="from.month" min="1" max="12" ng-change="search()" aria-invalid="false">
		                                                </div>
		                                                <p class="col-sm-1" style="padding-right:0px;">月</p>
		                                                <div class="col-sm-2" style="padding-left:0px;padding-right:0px;">
		                                                    <input class="form-control ng-pristine ng-untouched ng-valid ng-empty ng-valid-min ng-valid-max" type="number" ng-model="from.day" min="1" max="31" ng-change="search()" aria-invalid="false">
		                                                </div>
		                                                <p class="col-sm-1" style="padding-right:0px;">日</p>
		                                            </div>
		                                        </form>
		                                    </div>
		                                    <div class="col-md-4">
		                                        <form class="form-horizontal ng-pristine ng-valid ng-valid-min ng-valid-max">
		                                            <div class="form-group">
		                                                <p class="col-sm-1" style="padding-left:0px;padding-right:0px;">~</p>
		                                                <div class="col-sm-3" style="padding-left:0px;padding-right:0px;">
		                                                    <input class="form-control ng-pristine ng-untouched ng-valid ng-empty ng-valid-min ng-valid-max" type="number" ng-model="to.year" min="2018" max="2100" ng-change="search()" aria-invalid="false">
		                                                </div>
		                                                <p class="col-sm-1" style="padding-right:0px;">年</p>
		                                                <div class="col-sm-2" style="padding-left:0px;padding-right:0px;">
		                                                    <input class="form-control ng-pristine ng-untouched ng-valid ng-empty ng-valid-min ng-valid-max" type="number" ng-model="to.month" min="1" max="12" ng-change="search()" aria-invalid="false">
		                                                </div>
		                                                <p class="col-sm-1" style="padding-right:0px;">月</p>
		                                                <div class="col-sm-2" style="padding-left:0px;padding-right:0px;">
		                                                    <input class="form-control ng-pristine ng-untouched ng-valid ng-empty ng-valid-min ng-valid-max" type="number" ng-model="to.day" min="1" max="31" ng-change="search()" aria-invalid="false">
		                                                </div>
		                                                <p class="col-sm-1" style="padding-right:0px;">日</p>
		                                            </div>
		                                        </form>
		                                    </div>
		                                </div>
		                                <div class="row">
		                                    <div class="col-md-1"></div>
		                                    <div class="col-md-7">
		                                        <form class="form-horizontal ng-pristine ng-valid">
		                                            <div class="form-group" style="margin-top:20px;">
		                                                <p class="col-sm-3">全ステータス統計：</p>
		                                            </div>
		                                            <div class="form-group" style="margin-top:20px;">
		                                                <p class="col-sm-3">マッチング：</p>
		                                            </div>
		                                            <div class="add-container" style "margin-left:0px;margin-right:0px;"="">
		                                                <div class="row">
		                                                    <div class="col-md-4" style="background:#fff;">
		                                                        <div class="gridcell-left">
		                                                            <p style="font-size:14px;">マッチング成立件数</p>
		                                                        </div>
		                                                    </div>
		                                                    <div class="col-md-8" style="padding-left:0px;padding-right:0px;">
		                                                        <div class="gridcell-right" style="height:40px;padding-right:15px;">
		                                                            <div class="col-md-12" style="padding-left:15px;">
		                                                                <div class="form-group has-feedback" style="margin-bottom:0px;">
		                                                                    <input type="number" class="form-control ng-pristine ng-untouched ng-valid ng-not-empty" ng-model="hire_accept_count" readonly="" aria-invalid="false" style="">
		                                                                    <span class="form-control-feedback">件</span>
		                                                                </div>
		                                                            </div>
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                            </div>

		                                            <div class="form-group" style="margin-top:20px;">
		                                                <p class="col-sm-3">着手金：</p>
		                                            </div>
		                                            <div class="add-container" style "margin-left:0px;margin-right:0px;"="">
		                                                <div class="row">
		                                                    <div class="col-md-4" style="background:#fff;">
		                                                        <div class="gridcell-left">
		                                                            <p style="font-size:14px;">着手金件数</p>
		                                                        </div>
		                                                    </div>
		                                                    <div class="col-md-8" style="padding-left:0px;padding-right:0px;">
		                                                        <div class="gridcell-right" style="height:40px;padding-right:15px;">
		                                                            <div class="col-md-12" style="padding-left:15px;">
		                                                                <div class="form-group has-feedback" style="margin-bottom:0px;">
		                                                                    <input type="number" class="form-control ng-pristine ng-untouched ng-valid ng-not-empty" ng-model="deposit_count" readonly="" aria-invalid="false" style="">
		                                                                    <span class="form-control-feedback">件</span>
		                                                                </div>
		                                                            </div>
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                                <div class="row">
		                                                    <div class="col-md-4" style="background:#fff;">
		                                                        <div class="gridcell-left">
		                                                            <p style="font-size:14px;">着手金合計金額</p>
		                                                        </div>
		                                                    </div>
		                                                    <div class="col-md-8" style="padding-left:0px;padding-right:0px;">
		                                                        <div class="gridcell-right" style="height:40px;padding-right:15px;">
		                                                            <div class="col-md-12" style="padding-left:15px;">
		                                                                <div class="form-group has-feedback" style="margin-bottom:0px;">
		                                                                    <input type="number" class="form-control ng-pristine ng-untouched ng-valid ng-not-empty" ng-model="deposit_amount" readonly="" aria-invalid="false" style="">
		                                                                    <span class="form-control-feedback">円</span>
		                                                                </div>
		                                                            </div>
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                                <div class="row">
		                                                    <div class="col-md-4" style="background:#fff;">
		                                                        <div class="gridcell-left">
		                                                            <p style="font-size:14px;">未入金金額合計</p>
		                                                        </div>
		                                                    </div>
		                                                    <div class="col-md-8" style="padding-left:0px;padding-right:0px;">
		                                                        <div class="gridcell-right" style="height:40px;padding-right:15px;">
		                                                            <div class="col-md-12" style="padding-left:15px;">
		                                                                <div class="form-group has-feedback" style="margin-bottom:0px;">
		                                                                    <input type="number" class="form-control ng-pristine ng-untouched ng-valid ng-not-empty" ng-model="deposit_nonpay_amount" readonly="" aria-invalid="false" style="">
		                                                                    <span class="form-control-feedback">円</span>
		                                                                </div>
		                                                            </div>
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                                <div class="row">
		                                                    <div class="col-md-4" style="background:#fff;">
		                                                        <div class="gridcell-left">
		                                                            <p style="font-size:14px;">入金済み金額合計</p>
		                                                        </div>
		                                                    </div>
		                                                    <div class="col-md-8" style="padding-left:0px;padding-right:0px;">
		                                                        <div class="gridcell-right" style="height:40px;padding-right:15px;">
		                                                            <div class="col-md-12" style="padding-left:15px;">
		                                                                <div class="form-group has-feedback" style="margin-bottom:0px;">
		                                                                    <input type="number" class="form-control ng-pristine ng-untouched ng-valid ng-not-empty" ng-model="deposit_payed_amount" readonly="" aria-invalid="false" style="">
		                                                                    <span class="form-control-feedback">円</span>
		                                                                </div>
		                                                            </div>
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                                <div class="row">
		                                                    <div class="col-md-4" style="background:#fff;">
		                                                        <div class="gridcell-left">
		                                                            <p style="font-size:14px;">入金率</p>
		                                                        </div>
		                                                    </div>
		                                                    <div class="col-md-8" style="padding-left:0px;padding-right:0px;">
		                                                        <div class="gridcell-right" style="height:40px;padding-right:15px;">
		                                                            <div class="col-md-12" style="padding-left:15px;">
		                                                                <div class="form-group has-feedback" style="margin-bottom:0px;">
		                                                                    <input type="number" class="form-control ng-pristine ng-untouched ng-valid ng-not-empty" ng-model="deposit_pay_rate" readonly="" aria-invalid="false" style="">
		                                                                    <span class="form-control-feedback">%</span>
		                                                                </div>
		                                                            </div>
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                            </div>

		                                            <div class="form-group" style="margin-top:20px;">
		                                                <p class="col-sm-3">成功報酬：</p>
		                                            </div>
		                                            <div class="add-container" style "margin-left:0px;margin-right:0px;"="">
		                                                <div class="row">
		                                                    <div class="col-md-4" style="background:#fff;">
		                                                        <div class="gridcell-left">
		                                                            <p style="font-size:14px;">助成金・補助金取得件数</p>
		                                                        </div>
		                                                    </div>
		                                                    <div class="col-md-8" style="padding-left:0px;padding-right:0px;">
		                                                        <div class="gridcell-right" style="height:40px;padding-right:15px;">
		                                                            <div class="col-md-12" style="padding-left:15px;">
		                                                                <div class="form-group has-feedback" style="margin-bottom:0px;">
		                                                                    <input type="number" class="form-control ng-pristine ng-untouched ng-valid ng-not-empty" ng-model="subsidy_count" readonly="" aria-invalid="false" style="">
		                                                                    <span class="form-control-feedback">件</span>
		                                                                </div>
		                                                            </div>
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                                <div class="row">
		                                                    <div class="col-md-4" style="background:#fff;">
		                                                        <div class="gridcell-left">
		                                                            <p style="font-size:14px;">助成金・補助金取得金額</p>
		                                                        </div>
		                                                    </div>
		                                                    <div class="col-md-8" style="padding-left:0px;padding-right:0px;">
		                                                        <div class="gridcell-right" style="height:40px;padding-right:15px;">
		                                                            <div class="col-md-12" style="padding-left:15px;">
		                                                                <div class="form-group has-feedback" style="margin-bottom:0px;">
		                                                                    <input type="number" class="form-control ng-pristine ng-untouched ng-valid ng-not-empty" ng-model="subsidy_amount" readonly="" aria-invalid="false" style="">
		                                                                    <span class="form-control-feedback">円</span>
		                                                                </div>
		                                                            </div>
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                                <div class="row">
		                                                    <div class="col-md-4" style="background:#fff;">
		                                                        <div class="gridcell-left">
		                                                            <p style="font-size:14px;">未入金金額合計</p>
		                                                        </div>
		                                                    </div>
		                                                    <div class="col-md-8" style="padding-left:0px;padding-right:0px;">
		                                                        <div class="gridcell-right" style="height:40px;padding-right:15px;">
		                                                            <div class="col-md-12" style="padding-left:15px;">
		                                                                <div class="form-group has-feedback" style="margin-bottom:0px;">
		                                                                    <input type="number" class="form-control ng-pristine ng-untouched ng-valid ng-not-empty" ng-model="subsidy_nonpay_amount" readonly="" aria-invalid="false" style="">
		                                                                    <span class="form-control-feedback">円</span>
		                                                                </div>
		                                                            </div>
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                                <div class="row">
		                                                    <div class="col-md-4" style="background:#fff;">
		                                                        <div class="gridcell-left">
		                                                            <p style="font-size:14px;">入金済み金額合計</p>
		                                                        </div>
		                                                    </div>
		                                                    <div class="col-md-8" style="padding-left:0px;padding-right:0px;">
		                                                        <div class="gridcell-right" style="height:40px;padding-right:15px;">
		                                                            <div class="col-md-12" style="padding-left:15px;">
		                                                                <div class="form-group has-feedback" style="margin-bottom:0px;">
		                                                                    <input type="number" class="form-control ng-pristine ng-untouched ng-valid ng-not-empty" ng-model="subsidy_payed_amount" readonly="" aria-invalid="false" style="">
		                                                                    <span class="form-control-feedback">円</span>
		                                                                </div>
		                                                            </div>
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                                <div class="row">
		                                                    <div class="col-md-4" style="background:#fff;">
		                                                        <div class="gridcell-left">
		                                                            <p style="font-size:14px;">入金率</p>
		                                                        </div>
		                                                    </div>
		                                                    <div class="col-md-8" style="padding-left:0px;padding-right:0px;">
		                                                        <div class="gridcell-right" style="height:40px;padding-right:15px;">
		                                                            <div class="col-md-12" style="padding-left:15px;">
		                                                                <div class="form-group has-feedback" style="margin-bottom:0px;">
		                                                                    <input type="number" class="form-control ng-pristine ng-untouched ng-valid ng-not-empty" ng-model="subsidy_pay_rate" readonly="" aria-invalid="false" style="">
		                                                                    <span class="form-control-feedback">%</span>
		                                                                </div>
		                                                            </div>
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                            </div>

		                                            <div class="form-group" style="margin-top:20px;">
		                                                <p class="col-sm-3">無料会員：</p>
		                                            </div>
		                                            <div class="add-container" style "margin-left:0px;margin-right:0px;"="">
		                                                <div class="row">
		                                                    <div class="col-md-4" style="background:#fff;">
		                                                        <div class="gridcell-left">
		                                                            <p style="font-size:14px;">無料会員件数</p>
		                                                        </div>
		                                                    </div>
		                                                    <div class="col-md-8" style="padding-left:0px;padding-right:0px;">
		                                                        <div class="gridcell-right" style="height:40px;padding-right:15px;">
		                                                            <div class="col-md-12" style="padding-left:15px;">
		                                                                <div class="form-group has-feedback" style="margin-bottom:0px;">
		                                                                    <input type="number" class="form-control ng-pristine ng-untouched ng-valid ng-not-empty" ng-model="freeuser_count" readonly="" aria-invalid="false" style="">
		                                                                    <span class="form-control-feedback">件</span>
		                                                                </div>
		                                                            </div>
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                            </div>

		                                            <div class="form-group" style="margin-top:20px;">
		                                                <p class="col-sm-3">有料会員：</p>
		                                            </div>
		                                            <div class="add-container" style "margin-left:0px;margin-right:0px;"="">
		                                                <div class="row">
		                                                    <div class="col-md-4" style="background:#fff;">
		                                                        <div class="gridcell-left">
		                                                            <p style="font-size:14px;">有料会員件数</p>
		                                                        </div>
		                                                    </div>
		                                                    <div class="col-md-8" style="padding-left:0px;padding-right:0px;">
		                                                        <div class="gridcell-right" style="height:40px;padding-right:15px;">
		                                                            <div class="col-md-12" style="padding-left:15px;">
		                                                                <div class="form-group has-feedback" style="margin-bottom:0px;">
		                                                                    <input type="number" class="form-control ng-pristine ng-untouched ng-valid ng-not-empty" ng-model="payuser_count" readonly="" aria-invalid="false" style="">
		                                                                    <span class="form-control-feedback">件</span>
		                                                                </div>
		                                                            </div>
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                                <div class="row">
		                                                    <div class="col-md-4" style="background:#fff;">
		                                                        <div class="gridcell-left">
		                                                            <p style="font-size:14px;">有料会員費合計金額</p>
		                                                        </div>
		                                                    </div>
		                                                    <div class="col-md-8" style="padding-left:0px;padding-right:0px;">
		                                                        <div class="gridcell-right" style="height:40px;padding-right:15px;">
		                                                            <div class="col-md-12" style="padding-left:15px;">
		                                                                <div class="form-group has-feedback" style="margin-bottom:0px;">
		                                                                    <input type="number" class="form-control ng-pristine ng-untouched ng-valid ng-not-empty" ng-model="payuser_fee_amount" readonly="" aria-invalid="false" style="">
		                                                                    <span class="form-control-feedback">円</span>
		                                                                </div>
		                                                            </div>
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                            </div>

		                                            <div class="form-group" style="margin-top:20px;">
		                                                <p class="col-sm-3">有料オプション：</p>
		                                            </div>
		                                            <div class="add-container" style "margin-left:0px;margin-right:0px;"="">
		                                                <div class="row">
		                                                    <div class="col-md-4" style="background:#fff;">
		                                                        <div class="gridcell-left">
		                                                            <p style="font-size:14px;">有料オプション利用件数</p>
		                                                        </div>
		                                                    </div>
		                                                    <div class="col-md-8" style="padding-left:0px;padding-right:0px;">
		                                                        <div class="gridcell-right" style="height:40px;padding-right:15px;">
		                                                            <div class="col-md-12" style="padding-left:15px;">
		                                                                <div class="form-group has-feedback" style="margin-bottom:0px;">
		                                                                    <input type="number" class="form-control ng-pristine ng-untouched ng-valid ng-not-empty" ng-model="payoption_count" readonly="" aria-invalid="false" style="">
		                                                                    <span class="form-control-feedback">件</span>
		                                                                </div>
		                                                            </div>
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                                <div class="row">
		                                                    <div class="col-md-4" style="background:#fff;">
		                                                        <div class="gridcell-left">
		                                                            <p style="font-size:14px;">有料オプション費合計金額</p>
		                                                        </div>
		                                                    </div>
		                                                    <div class="col-md-8" style="padding-left:0px;padding-right:0px;">
		                                                        <div class="gridcell-right" style="height:40px;padding-right:15px;">
		                                                            <div class="col-md-12" style="padding-left:15px;">
		                                                                <div class="form-group has-feedback" style="margin-bottom:0px;">
		                                                                    <input type="number" class="form-control ng-pristine ng-untouched ng-valid ng-not-empty" ng-model="payoption_amount" readonly="" aria-invalid="false" style="">
		                                                                    <span class="form-control-feedback">円</span>
		                                                                </div>
		                                                            </div>
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                            </div>

		                                            <div class="form-group" style="margin-top:20px;">
		                                                <p class="col-sm-3">仕事提携広告：</p>
		                                            </div>
		                                            <div class="add-container" style "margin-left:0px;margin-right:0px;"="">
		                                                <div class="row">
		                                                    <div class="col-md-4" style="background:#fff;">
		                                                        <div class="gridcell-left">
		                                                            <p style="font-size:14px;">仕事提携広告利用件数</p>
		                                                        </div>
		                                                    </div>
		                                                    <div class="col-md-8" style="padding-left:0px;padding-right:0px;">
		                                                        <div class="gridcell-right" style="height:40px;padding-right:15px;">
		                                                            <div class="col-md-12" style="padding-left:15px;">
		                                                                <div class="form-group has-feedback" style="margin-bottom:0px;">
		                                                                    <input type="number" class="form-control ng-pristine ng-untouched ng-valid ng-not-empty" ng-model="advert_use_count" readonly="" aria-invalid="false" style="">
		                                                                    <span class="form-control-feedback">件</span>
		                                                                </div>
		                                                            </div>
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                                <div class="row">
		                                                    <div class="col-md-4" style="background:#fff;">
		                                                        <div class="gridcell-left">
		                                                            <p style="font-size:14px;">仕事提携広告費合計金額</p>
		                                                        </div>
		                                                    </div>
		                                                    <div class="col-md-8" style="padding-left:0px;padding-right:0px;">
		                                                        <div class="gridcell-right" style="height:40px;padding-right:15px;">
		                                                            <div class="col-md-12" style="padding-left:15px;">
		                                                                <div class="form-group has-feedback" style="margin-bottom:0px;">
		                                                                    <input type="number" class="form-control ng-pristine ng-untouched ng-valid ng-not-empty" ng-model="advert_use_amount" readonly="" aria-invalid="false" style="">
		                                                                    <span class="form-control-feedback">円</span>
		                                                                </div>
		                                                            </div>
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                            </div>

		                                        </form>
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
