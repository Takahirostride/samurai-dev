<?php include ('../inc/header.php'); ?>
<div class="mainpage">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<ol class="breadcrumb">
					<li><a class="bg-color" href="#">TOPページ</a></li>
					<li class="active">プロフィール</li>
				</ol>	
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">プロフィール</h1>
				<p class="page-description">プロフィールを詳細に記載していると、通常より申請が4倍通りやすくなる傾向があります。</p>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-2 sidebar-left">
				<?php include ('../inc/mypage-sidebar-left.php'); ?>
			</div>
			<div class="col-sm-8 mainpage">
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
                    <div class="col-sm-12">
                        <ul class="tab-profile nav nav-tabs nav-justified">
                            <li class="tab-style-grey"><a href="mypage/clientprofile-1.php"> <img src="assets/images/manual.png" alt="">プロフィール</a></li>
                            <li class="tab-style-grey  "><a href="mypage/clientprofile-3.php"><img src="assets/images/manual.png" alt=""> 希望内容 </a></li>
                            <li class="tab-style-grey"><a href="mypage/clientprofile-5.php">評価・実績</a></li>
                            <li class="tab-style-grey  active"><a href="mypage/clientprofile-6.php">募集案件</a></li>
                            <li class="tab-style-grey"><a href="mypage/clientprofile-7.php"><img src="assets/images/manual.png" alt="">費用</a></li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="pagerow-title">
                            <span>募集案件</span>
                            <a href="client/Ghome.php" class="btn-primary btn btn-style-shadow-green btn-success right-title first">新規追加</a>
                            <a href="mypage/clientjob-1-3.php" class="btn-primary btn btn-style-shadow-green btn-success right-title">募集編集</a>
                        </h4>
                    </div>
                </div>
                <div class="row">
                    <div class="box-scope recruitment">
                        <div class="">
                            <div class="col-sm-2">
                                <div class="text-center mgt-20">
                                    <img src="assets/images/img1.jpg">
                                </div>
                            </div>
                            <div class="col-sm-10">
                                <h3 class="box-scope-title">タイトルタイトルタイトルタイトル</h3>
                                <p class="measure_text1 ng-binding">登録機関：○○○/募集時期：○○○</p>
                                <p >区内の中小企業者が事業資金を必要とする場合、低利で融資が受けられるように金融機関にあっせんします。
                                中小企業事業資金融資あっせん制...</p>
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
                            <div class="btn-cost2">
                                <label class="label-cost ng-binding">融資視線：1,500万円</label>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="div-hope-yellow mgt-20 box-info-text">
                                <dl>
                                    <dt>依頼内容</dt>
                                    <dd>text</dd>
                                </dl> 
                                <dl>
                                    <dt>業務</dt>
                                    <dd>0</dd>
                                </dl> 
                                <dl>
                                    <dt>提案</dt>
                                    <dd>1本</dd>
                                </dl> 
                                <dl>
                                    <dt>残り</dt>
                                    <dd>&nbsp;:&nbsp;</dd>
                                </dl>  
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="row">
                    <nav class="text-center" aria-label="pagination">
                        <ul class="pagination">
                            <li class="page-item disabled">
                              <a class="page-link" href="#" tabindex="-1">最初</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>

                            <li class="page-item">
                              <a class="page-link" href="#">最後</a>
                            </li>
                        </ul>
                    </nav>
                </div>
			</div>
			<div class="col-sm-2 sidebar-right">
				<?php include ('../inc/mypage-sidebar-right.php'); ?>
			</div>
		</div>
	</div>
</div>
<?php include ('../inc/footer.php'); ?>