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
					</div>	<!-- end middle page -->
				</div>
				<div class="row">
					<div class="col-sm-12">
						<ul class="tab-profile nav nav-tabs nav-justified">
							<li class="tab-style-grey"><a href="mypage/clientprofile-1.php"> <img src="assets/images/manual.png" alt="">プロフィール</a></li>
							<li class="tab-style-grey"><a href="mypage/clientprofile-3.php"><img src="assets/images/manual.png" alt=""> 希望内容 </a></li>
							<li class="tab-style-grey"><a href="mypage/clientprofile-5.php">評価・実績</a></li>
							<li class="tab-style-grey"><a href="mypage/clientprofile-6.php">募集案件</a></li>
							<li class="tab-style-grey  active"><a href="mypage/clientprofile-7.php"><img src="assets/images/manual.png" alt="">費用</a></li>
						</ul>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<h4 class="pagerow-title">
							<span>提案費用のテンプレート</span>
							<a href="mypage/clientprofile-8.php" class="btn-primary btn btn-style-shadow-green btn-success right-title">表示する</a>
						</h4>
					</div>
				</div>
				<div class="row">
					<p class="col-sm-12 p-text1 font16">希望費用を設定しておくと、士業に希望費用を伝える際に登録した費用を呼び出すことができます。<br>
					希望費用が決まっている場合は、設定しておくと、入力の手間を省くことができます。</p>
				</div>
				<div class="row">
					<div class="col-sm-12 desired-cost">
				    <dl>
				    	<dt class="col-sm-3">登録内容1</dt>
				    	<dd class="col-sm-9">
				    		<div class="row">
                        <div class="col-sm-12">
                            <div class="row cost-div">
                                <div class="col-sm-3">
                                    <p class="cost-p-2">書類代行費用</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="cost-p-2"><span >0</span>円</p>
                                </div>
                            </div>
                            <div class="row cost-div">
                                <div class="col-sm-3">
                                    <p class="cost-p-2">成功報酬</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="cost-p-2"><span >0</span>%</p>
                                </div>
                            </div>
                            <div class="row cost-div">
                                <div class="col-sm-3">
                                    <p class="cost-p-2">着手金</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="cost-p-2"><span >0</span>円</p> 
                                </div>
                            </div>
                            <div class="row cost-div " >
                                <div class="col-sm-3">
                                    <p ng-if="$index==0" class="cost-p-2 ">その他費用</p>
                                </div>
                                <div class="col-sm-3">
                                    <p class="cost-p-2"><span ></span>（内訳）</p>
                                </div>
                                <div class="col-sm-6">
                                    <p class="cost-p-2"><span >0</span>円</p>
                                </div>
                            </div>
                            <div class="row cost-div " >
                                <div class="col-sm-3">
                                    
                                </div>
                                <div class="col-sm-3">
                                    <p class="cost-p-2"><span ></span>（内訳）</p>
                                </div>
                                <div class="col-sm-6">
                                    <p class="cost-p-2"><span >0</span>円</p>
                                </div>
                            </div>
                            <div class="row cost-div " >
                                <div class="col-sm-3">
                                    
                                </div>
                                <div class="col-sm-3">
                                    <p class="cost-p-2"><span ></span>（内訳）</p>
                                </div>
                                <div class="col-sm-6">
                                    <p class="cost-p-2"><span >0</span>円</p>
                                </div>
                            </div>
                            <div class="row cost-div " >
                                <div class="col-sm-3">
                                    
                                </div>
                                <div class="col-sm-3">
                                    <p class="cost-p-2"><span ></span>（内訳）</p>
                                </div>
                                <div class="col-sm-6">
                                    <p class="cost-p-2"><span >0</span>円</p>
                                </div>
                            </div>
                            <div class="row cost-div " >
                                <div class="col-sm-3">
                                    
                                </div>
                                <div class="col-sm-3">
                                    <p class="cost-p-2"><span ></span>（内訳）</p>
                                </div>
                                <div class="col-sm-6">
                                    <p class="cost-p-2"><span >0</span>円</p>
                                </div>
                            </div>
                            <div class="row cost-div">
                                <div class="col-sm-3">
                                    <p class="cost-p-2">その他費用合計</p>
                                </div>
                                <div class="col-sm-3">
                                    <p class="cost-p-2"></p>
                                </div>
                                <div class="col-sm-6 ">
                                    <p class="cost-p-2"><span >0</span>円</p>
                                </div>
                            </div>
                        </div>
                    </div>
				    	</dd>
				    </dl>
				    </div>
				</div>
			</div>
			<div class="col-sm-2 sidebar-right">
				<?php include ('../inc/mypage-sidebar-right.php'); ?>
			</div>
		</div>
	</div>
</div>
<?php include ('../inc/footer.php'); ?>