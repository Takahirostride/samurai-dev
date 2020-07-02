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
                                <li class="tab-style-grey"><a href="mypage/clientjob-1-7.php">対応可能業務</a></li>
                                <li class="tab-style-grey   active"><a href="mypage/clientjob-1-8.php">対応可能施策</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="box-2">
                        <div class="box-scope">
                            <div class="">
                                <div class="col-sm-2">
                                    <div class="text-center mgt-20">
                                        <img src="assets/images/img1.jpg">
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <h3 class="box-scope-title">タイトルタイトルタイトルタイトル</h3>
                                    <p class="measure_text1 ng-binding text-primary font18">登録機関：○○○/募集時期：○○○</p>
                                    <p >区内の中小企業者が事業資金を必要とする場合、低利で融資が受けられるように金融機関にあっせんします。
                                    中小企業事業資金融資あっせん制...</p>
                                </div>
                                <div class="col-sm-3">
                                    <div class="div-style-DCE9F6 row text-center">
                                            <p >着手金:100000円</p>
                                            <p >その他：0円</p>
                                           <!-- end .itemav-info -->  
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="tooltips"><button type="button" class="btn btn-default btn-style-grey">
                                    <strong>提案を検討</strong>
                                </button>
                                <p class="customtooltipclass">お気に入りボタンの１つで、より興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。</p>
                                </div>
                                <div class="tooltips"><button type="button" class="btn btn-default btn-success">
                                    <strong>興味あり</strong>
                                    </button>
                                    <p class="customtooltipclass">お気に入りボタンの１つで、興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。</p>
                                </div>
                                <div class="tooltips"><button type="button" class="btn btn-default btn-style-grey">
                                    <strong>非表示</strong>
                                    </button>
                                    <p class="customtooltipclass">必要がない、自分に関係がない施策が表示された場合は、非表示としてください。非表示とすることで自動検索であなたに関連しない施策が表示されなくなります。</p>
                                </div>
                            </div>
                        </div>
                        <div class="box-scope">
                            <div class="">
                                <div class="col-sm-2">
                                    <div class="text-center mgt-20">
                                        <img src="assets/images/img1.jpg">
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <h3 class="box-scope-title">タイトルタイトルタイトルタイトル</h3>
                                    <p class="measure_text1 ng-binding text-primary font18">登録機関：○○○/募集時期：○○○</p>
                                    <p >区内の中小企業者が事業資金を必要とする場合、低利で融資が受けられるように金融機関にあっせんします。
                                    中小企業事業資金融資あっせん制...</p>
                                </div>
                                <div class="col-sm-3">
                                    <div class="div-style-DCE9F6 row text-center">
                                            <p >着手金:100000円</p>
                                            <p >その他：0円</p>
                                           <!-- end .itemav-info -->  
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="tooltips"><button type="button" class="btn btn-default btn-style-grey">
                                    <strong>提案を検討</strong>
                                </button>
                                <p class="customtooltipclass">お気に入りボタンの１つで、より興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。</p>
                                </div>
                                <div class="tooltips"><button type="button" class="btn btn-default btn-success">
                                    <strong>興味あり</strong>
                                    </button>
                                    <p class="customtooltipclass">お気に入りボタンの１つで、興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。</p>
                                </div>
                                <div class="tooltips"><button type="button" class="btn btn-default btn-style-grey">
                                    <strong>非表示</strong>
                                    </button>
                                    <p class="customtooltipclass">必要がない、自分に関係がない施策が表示された場合は、非表示としてください。非表示とすることで自動検索であなたに関連しない施策が表示されなくなります。</p>
                                </div>
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