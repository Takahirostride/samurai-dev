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
								<li class="tab-style-grey active"><a href="mypage/memberinfo-2.php"><img src="assets/images/manual.png" alt="">メール通知設定</a></li>
								<li class="tab-style-grey"><a href="mypage/memberinfo-3.php"><img src="assets/images/manual.png" alt="">外部通知設定</a></li>
								<li class="tab-style-grey"><a href="mypage/memberinfo-4.php"><img src="assets/images/manual.png" alt="">ブロック</a></li>
								<li class="tab-style-grey"><a href="mypage/memberinfo-5.php"><img src="assets/images/manual.png" alt="">会員登録・退会</a></li>
							</ul>
						</div> 
						<div class="col-sm-12 form-memberinfo memberinfo-2">
							<form action=""> 
								<div class="form-group mgtb-20">
									<div class="col-sm-3">
										<p>通知メール</p>
									</div>
								    <div class="col-sm-9">
								      <div class="checkbox">
								        <label class="lb-mem">
								          <input class="control-label" type="checkbox" aria-invalid="false" checked="checked">依頼した仕事に関するメールを受け取る 
								        </label>
								      </div>
								    </div>
								    <div class="col-sm-3">
										<p></p>
									</div>
								    <div class="col-sm-9">
								      <div class="checkbox">
								        <label class="lb-mem">
								          <input class="control-label" type="checkbox" aria-invalid="false">提案した仕事に関するメールを受け取る 
								        </label>
								      </div>
								    </div>
								    <div class="col-sm-3">
										<p></p>
									</div>
								    <div class="col-sm-9">
								      <div class="checkbox">
								        <label class="lb-mem">
								          <input class="control-label" type="checkbox" aria-invalid="false" checked="checked">プロジェクト進行に関するメールを受け取る 
								        </label>
								      </div>
								    </div>
								    <div class="col-sm-3">
										<p></p>
									</div>
								    <div class="col-sm-9">
								      <div class="checkbox">
								        <label class="lb-mem">
								          <input class="control-label" type="checkbox" aria-invalid="false">メッセージ受信の関するメールを受け取る 
								        </label>
								      </div>
								    </div>
								    <div class="col-sm-3">
										<p></p>
									</div>
								    <div class="col-sm-9">
								      <div class="checkbox">
								        <label class="lb-mem">
								          <input class="control-label" type="checkbox" aria-invalid="false">提案にお気に入りがあったらメールを受け取る 
								        </label>
								      </div>
								    </div>
								    <div class="col-sm-3">
										<p></p>
									</div>
								    <div class="col-sm-9">
								      <div class="checkbox">
								        <label class="lb-mem">
								          <input class="control-label" type="checkbox" aria-invalid="false">提案の作成や撤回をした時にメールを受け取る 
								        </label>
								      </div>
								    </div>
								    <div class="col-sm-3">
										<p></p>
									</div>
								    <div class="col-sm-9">
								      <div class="checkbox">
								        <label class="lb-mem">
								          <input class="control-label" type="checkbox" aria-invalid="false">相談に関するメールを受け取る 
								        </label>
								      </div>
								    </div>
								    <div class="col-sm-12 break-div"></div>
								    <div class="col-sm-3">
										<p>お知らせ</p>
									</div>
								    <div class="col-sm-9"> 
								        <label class="lb-mem">
								           提案の当選率を向上するコツや活用ガイドなどのお知らせ・情報を発信しています。
								        </label> 
								    </div>
								    <div class="col-sm-3">
										<p></p>
									</div>
								    <div class="col-sm-9"> 
								        <label class="lb-mem control-label col-sm-3" style="padding-left:0px;">
								          <input type="radio" name="group" value="1" class="" aria-invalid="false" checked="checked">受け取らない
								        </label> 
								        <label class="lb-mem control-label col-sm-3" style="padding-left:0px;">
								          <input type="radio" name="group" value="1" class="" aria-invalid="false">受け取らない
								        </label> 
								    </div>  
								    <div class="col-sm-12 break-div"></div>
								    <div class="col-sm-3">
										<p>新着メール</p>
									</div>
								    <div class="col-sm-9"> 
								        <label class="lb-mem">
								        	「新着案件メール」は、選択したカテゴリの新しい案件を通知します。
								        </label> 
								    </div>
								    <div class="col-sm-3">
										<p></p>
									</div>
								    <div class="col-sm-9">
								      <div class="checkbox">
								        <label class="lb-mem">
								          <input class="control-label" type="checkbox" aria-invalid="false" checked="checked">新着案件メール 
								        </label>
								      </div>
								    </div>

								</div>
							  	<div class="col-sm-12 box center btn-member">
									<button type="button" class="boxshadowbuttonblue btn btn-primary btn-lg land-btn">変更する</button>
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