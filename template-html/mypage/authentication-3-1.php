<?php include ('../inc/header.php'); ?>
<div class="mainpage">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<ol class="breadcrumb">
					<li><a class="bg-color" href="#">TOPページ</a></li>
					<li class="active">各種認証申請</li>
				</ol>	
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">各種認証申請</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-2 sidebar-left">
				<?php include ('../inc/mypage-sidebar-left.php'); ?>
			</div>
			<div class="col-sm-8 mainpage">
                <div class="row">
                    <div class="col-sm-12">
                        <ul class="tab-profile nav nav-tabs nav-justified">
                            <li class="tab-style-grey"><a href="mypage/authentication-1.php">本人確認書類</a></li>
                            <li class="tab-style-grey"><a href="mypage/authentication-2.php">機密保持確認</a></li>
                            <li class="tab-style-grey"><a href="mypage/authentication-3.php">事務局確認</a></li>
                            <li class="tab-style-grey  active"><a href="mypage/authentication-4.php">電話確認</a></li>
                            <li class="tab-style-grey not-text"><a href="mypage/clientprofile-7.php"><img src="assets/images/manual.png" alt=""></a></li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                    <h3>事務局確認</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                    <h3 class="page-title">電話確認とは</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <p>
                            電話番号の確認が取れているユーザとして、アイコンが付与されます。電話確認は、クライアント・ランサー双方共に信頼度が大きく向上します。
                            電話確認が完了している士業のみが、完全非公開案件の閲覧が可能となります。
                        </p>
                        <h3 class="page-title">電話確認の流れ</h3>
                        <div class="step-1">
                            <div class="col-sm-3"><p class="step-tit">申請</p><p class="step-text">ページ下の申請フォームにて、ご担当者様のsmsが受信可能な「電話番号」を入力し、申請してください。</p></div>
                            <div class="col-sm-3"><p class="step-tit">電話確認</p><p class="step-text">申請後に、smsに認証番号が通知されます。その番号を下記の認証番号入力欄に記入し、認証ボタンをおしてください。</p></div>
                            <div class="col-sm-3"><p class="step-tit">完了</p><p class="step-text">認証番号に問題がない場合は、認証が完了し、電話確認が完了されます。</p></div>
                        </div>
                        <form method="post" action="#">
                            <h3 class="page-title">電話確認申請</h3>
                            <div class="box-br-blue">
                                <h5 class="text-primary font15">SMSを受信可能な電話番号を入力してください。</h5>
                                <p>入力された電話番号にsamuraiより認証番号を送信いたします。固定電話などSMSを受信できない番号はご利用いただけません。
                                    ※電話番号の入力は、お間違いがないか、再度ご確認いただきますようよろしくお願いいたします。</p>
                            </div>
                            <div class="row mgt-20 mb20">
                                <div class="col-sm-2 text-center"><p>電話番号</p></div>
                                <div class="col-sm-10"><input type="text" name="phone" class="form-control"></div>
                                <div class="col-sm-12 text-center mgt-20">
                                    <input type="submit" name="submit" class="btn-primary btn btn-style-shadow-green btn-success" value="申請する">
                                </div>
                            </div>
                            <h3 class="page-title">認証番号入力</h3>
                            <div class="box-br-blue">
                                <h5 class="text-primary font15">受信したSMSに記載されている認証番号を入力してください。</h5>
                                <p>SMSに記載されている番号を、下記フォームに正確に入力の上、「認証する」ボタンをクリックしてください。
                                    認証ボタンを押すと、電話確認が完了いたします。</p>
                            </div>
                            <div class="row mgt-20 mb20 ">
                                <div class="col-sm-2 text-center"><p>電話番号</p></div>
                                <div class="col-sm-10"><input type="text" name="phone" class="form-control"></div>
                                <div class="col-sm-12 text-center mgt-20">
                                    <input type="submit" name="submit" class="btn-primary btn btn-style-shadow-green btn-success" value="申請する">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

			</div>
		</div>
        
	</div>
</div>
<?php include ('../inc/footer.php'); ?>
