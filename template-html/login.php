<?php include ('./inc/header_nologin.php'); ?>
	<div class="mainpage">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<h3 class="login-box-title">
						ログインする  
						<small>会員登録がお済みてない方は、<a href="#">こちら</a>から無料会員登録してください。</small>
					</h3>
					<form class="form-horizontal mgb-40">
					  	<div class="form-group mgtb-20">
						    <label class="col-sm-3">メールアドレス</label>
						    <div class="col-sm-5">
						      	<input type="email" class="form-control" placeholder="メールアドレス">
						    </div>
					  	</div>
					  	<div class="clearfix"></div>
					  	<div class="form-group mgtb-20">
						    <label class="col-sm-3">パスワード</label>
						    <div class="col-sm-5">
						      	<input type="password" class="form-control" placeholder="パスワード">
						    </div>
					  	</div>
					  	<div class="clearfix"></div>
						<div class="form-group mgtb-20">
						    <div class="col-sm-offset-3 col-sm-9">
						      <div class="checkbox">
						        <label>
						          	<input type="checkbox">次回から自動的にログインする。 
						        </label>
						      </div>
						    </div>
						</div>
						<div class="clearfix"></div>
					  	<div class="form-group mgtb-20">
						    <div class="col-sm-offset-3 col-sm-5">
						      	<button type="submit" class="btn submitbutton btn-block">ログインする</button>
						    </div>
					  	</div>
					  	<div class="form-group mgtb-20">
						    <div class="col-sm-offset-3 col-sm-5">
						      <strong>パスワードを忘れた方は、<a href="#">こちら</a>からパスワードの再設定を行ってください。</strong>
						    </div>
					  	</div>
					</form><!-- end form -->	
				</div>
			</div><!-- end .row -->
		</div> <!-- end .container -->
	</div> <!-- end .mainpage -->
	<div class="clearfix"></div>
<?php include ('./inc/footer.php'); ?>
