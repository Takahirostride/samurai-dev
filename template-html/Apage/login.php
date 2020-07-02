<?php include ('../inc/header.php'); ?>
<div class="mainpage">
	<div class="container">
		<div class="jumbotron jumbotron-home ng-scope">
			<div class="col-sm-12">
				<div class="land-image float-left animated slideInLeft fast">
					<img src="assets/images/assitance.png" alt="">
				</div>
				<div class="land-top float-left animated slideInRight fast">
					<p class="land-p">日本最大級の助成金・補助金<br>
		自動マッチングサイト「サムライ」</p>
					<button type="button" class="shadowbuttonblue btn btn-primary btn-lg land-btn" ng-click="direct_login()">ログイン</button>
		    		<button type="button" class="shadowbuttonwarm btn btn-warning btn-lg land-btn" ng-click="direct_register()">新規登録</button>
		    		<!-- 20180513 追加 s -->
					<img src="assets/images/manual.png" style="cursor:pointer;" height="40px" data-toggle="modal" data-target="#modal-register">
		      <p class="pinvisible"><br></p>
		      <p class="pinvisible"><br><br><br></p>
			</div>
		  </div>
		</div>
	</div>
</div>
<?php include ('../inc/footer.php'); ?>