<?php include ('../inc/header.php'); ?>
<div class="mainpage">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<ol class="breadcrumb">
					<li><a class="bg-color" href="#">TOPページ</a></li>
					<li class="active">仕事管理</li>
				</ol>	
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">仕事管理</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-2 sidebar-left">
				<?php include ('../inc/mypage-sidebar-left.php'); ?>
			</div>
			<div class="col-sm-10 mainpage">
                <div class="text-center">
                    <div class="col-sm-4 clientjob-title"><div class="row"><a class="active" href="mypage/clientjob-1.php">依頼・提案・募集</a></div></div>
                    <div class="col-sm-4 clientjob-title"><div class="row"><a href="mypage/clientjob-2.php">マッチング案件</a></div></div>
                    <div class="col-sm-4 clientjob-title"><div class="row"><a href="mypage/clientjob-3.php">終了した案件</a></div></div>
                </div>
                <div class="div-style-grey col-sm-12">
                    <div class="col-sm-4">
                        <h5 >4/4</h5>
                    </div>
                    <div class="col-sm-8">
                        <div class="col-sm-1"></div>
                        <h5 class="col-sm-2">表示年月：</h5>
                        <div class="col-sm-2" >
                            <select class="form-control" aria-invalid="false">
                                <option value="0" selected="selected">すべて</option>
                                <option value="2017">2017年</option>
                                <option value="2018">2018年</option>
                                <option value="2019">2019年</option>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <select class="form-control ">
                                <option value="0" selected="selected">すべて</option>
                                <option value="1">1月</option>
                                <option value="2">2月</option>
                                <option value="3">3月</option>
                                <option value="4">4月</option>
                                <option value="5">5月</option>
                                <option value="6">6月</option>
                                <option value="7">7月</option>
                                <option value="8">8月</option>
                                <option value="9">9月</option>
                                <option value="10">10月</option>
                                <option value="11">11月</option>
                                <option value="12">12月</option>
                            </select>
                        </div>
                        <h5 class="col-sm-2">表示件数：</h5>
                        <div class="col-sm-3">
                            <select class="form-control ">
                                <option value="10" selected="selected">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 clientjob-tab">
                    <div class="row">
                        <ul class="nav nav-tabs tab-1"> 
                            <li class="tab-style-grey  active">
                                <a href="mypage/clientjob-1.php">依頼中</a>
                            </li>                                     
                            <li class="tab-style-grey">
                                <a href="mypage/clientjob-1-2.php">受けた提案</a>
                            </li> 
                            <li class="tab-style-grey">
                                <a href="mypage/clientjob-1-3.php">募集案件</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="row">
                        <table class="table table-bordered table-hover table-myjob full-table-click">
                            <thead>
                                <tr>
                                    <th>日時</th>
                                    <th>タイトル</th>
                                    <th>募集内容</th>
                                    <th>メッセージ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>

                                    <td>2018年09月06日</td>
                                    <td class="td-link"><a href="mypage/clientjob-1-4.php">帯広市特定事業所、試験研究施設の新設・増設に対する助成</a></td>
                                    <td class="td-link"><a href="mypage/clientjob-1-5.php">山田太郎（士業1）</a></td>
                                    <td class="td-link"><a href="mypage/clientjob-1-9.php">依頼送信済み</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-sm-10 clientjob-1-5">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="profile-av">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <img class="profile-user-avatar" src="assets/images/avatar.png">
                                    </div>
                                    <div class="col-sm-8">
                                        <h4 class="main-user-name">山田太郎（企業）</h4>
                                        <p class="main-user-id">ユーザーID：115</p>
                                        <br><br>
                                        <p class="main-user-total-job">実績：　4件</p>
                                        <div class="star-rating">
                                            <select id="example-fontawesome" name="rating" autocomplete="off">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                      </div>
                                    </div>
                                </div>
                            </div> <!-- end .profile-av -->
                        </div>  <!-- end middle page -->
                    </div>
                    <div class="row">
                        <div class="col-sm-12 clientjob-tab mgt-20 mb20">
                            <ul class="nav nav-tabs tab-1">
                                <li class="tab-style-grey "><a href="mypage/clientjob-1-5.php">プロフィール</a></li>
                                <li class="tab-style-grey"><a href="mypage/clientjob-1-6.php">評価・実績 </a></li>
                                <li class="tab-style-grey  active"><a href="mypage/clientjob-1-7.php">対応可能業務</a></li>
                                <li class="tab-style-grey"><a href="mypage/clientjob-1-8.php">対応可能施策</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <h4 class="pagerow-title"><span>代行業務費用</span>
                            </h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <h4 class="pagerow-title"><span>得意分野</span>
                            </h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="div-style-white">
                            </div>
                        </div>
                    </div>
                     <div class="row">
                        <div class="col-sm-12">
                            <h4 class="pagerow-title"><span>カテゴリー</span>
                            </h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="div-style-white">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <h4 class="pagerow-title"><span>取得可能金額</span>
                            </h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="div-style-white">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <h4 class="pagerow-title"><span>業種</span>
                            </h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="div-style-white"><p>0</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <h4 class="pagerow-title"><span>府省庁</span>
                            </h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="div-style-white">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-sm-2 sidebar-right">
                    <div class="row">
                        <?php include ('../inc/mypage-sidebar-right.php'); ?>
                    </div>
                </div>

			</div>
		</div>
        
	</div>
</div>
<?php include ('../inc/footer.php'); ?>