<?php include ('../inc/header.php'); ?>
<div class="mainpage">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<ol class="breadcrumb">
					<li><a class="bg-color" href="#">TOPページ</a></li>
					<li class="active">会員情報管理</li>
				</ol>	
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">会員情報管理</h1> 
			</div>
		</div>
		<div class="row">
			<div class="col-sm-2 sidebar-left">
			<div class="text-center">
				<div class="div-style-blue">
					<div	class="imagecenter">
						<img src="assets/images/img1.jpg" class="img-thumbnail">
					</div>
					<h3 class="ng-binding">○○（<b>表示名</b>）</h3>
					<h3 class="ng-binding">○○（<strong>ユーザー名</strong>）</h3>
				</div>
				<p><button type="button" class="btn btn-default sidebar-btn btn-grad">
						<strong>マイページトップ</strong>
					</button></p>
				<p><button type="button" class="btn btn-default btn-grad sidebar-btn">
						<strong>プロフィール管理</strong>
					</button></p>
				<p><button type="button" class="btn btn-default btn-grad sidebar-btn active">
						<strong>会員情報管理</strong>
					</button></p>
				<p><button type="button" class="btn btn-default btn-grad sidebar-btn">
						<strong>仕事管理</strong>
					</button></p>
				<p><button type="button" class="btn btn-default btn-grad sidebar-btn">
						<strong>メッセージ</strong>
					</button></p>
				<p><button type="button" class="btn btn-default btn-grad sidebar-btn">
						<strong>保存リスト</strong>
					</button></p>
				<p><button type="button" class="btn btn-default btn-grad sidebar-btn">
						<strong>各種認証設定</strong>
					</button></p>
				<p><button type="button" class="btn btn-default btn-grad sidebar-btn">
						<strong>支払い管理</strong>
					</button></p>
				<p><button type="button" class="btn btn-default btn-grad sidebar-btn">
						<strong>アフィリエイト管理</strong>
					</button></p>
				<p><button type="button" class="btn btn-default btn-grad sidebar-btn">
					<strong>仕事提携管理</strong>
				</button></p>
			</div>
			</div>
			<div class="col-sm-10 mainpage">
				 <div class="col-sm-12"> 
					<div class="row">
						<div class="tab-memberinfo">
							<ul class="tab-memberinfo nav nav-tabs nav-justified">
								<li class="tab-style-grey"><a href="mypage/memberinfo-1.php"><img src="assets/images/manual.png" alt="">ログイン情報設定</a></li>
								<li class="tab-style-grey"><a href="mypage/memberinfo-2.php"><img src="assets/images/manual.png" alt="">メール通知設定</a></li>
								<li class="tab-style-grey"><a href="mypage/memberinfo-3.php"><img src="assets/images/manual.png" alt="">外部通知設定</a></li>
								<li class="tab-style-grey"><a href="mypage/memberinfo-4.php"><img src="assets/images/manual.png" alt="">ブロック</a></li>
								<li class="tab-style-grey active"><a href="mypage/memberinfo-5.php"><img src="assets/images/manual.png" alt="">会員登録・退会</a></li>
							</ul>
						</div>
						<div class="alert alert-success">
						    <span class="glyphicon glyphicon-ok"></span> ログイン情報を変更しました。
						</div>
						 <div class="alert alert-warning">
						    <strong>Warning!</strong> This alert box could indicate a warning that might need attention.
						</div>
						  <div class="alert alert-danger">
						    <strong>Danger!</strong> This alert box could indicate a dangerous or potentially negative action.
						</div>
						<div class="col-sm-12 form-memberinfo memberinfo5">
							<form action=""> 
								<div class="col-sm-3">
									<p>会員情報</p>
								</div>
								<div class="col-sm-9">
									<p>会員情報表示会員情報表示会員情報表示会員情報表示</p>
								</div>
								<div class="col-sm-3">
									<p></p>
								</div>  
							    <div class="col-sm-9">
							      	<div class="col-sm-3 btn-member left">
										<button type="button" class="boxshadowbuttonblue btn btn-primary btn-lg land-btn">有料会員になる</button>
									</div>
									<div class="col-sm-3 btn-member left">
										<a href="#">有料会員とは？</a>
									</div>
							    </div>
							  	<div class="col-sm-3">
									<p></p>
								</div>  
							    <div class="col-sm-9">
							      	<div class="col-sm-12 btn-member left">
										<button type="button" class="boxshadowbuttonblue btn btn-primary btn-grey btn-lg land-btn">退会する</button>
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
<?php include ('../inc/footer.php'); ?>