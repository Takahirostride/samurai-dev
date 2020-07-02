<?php include ('./inc/header_nologin.php'); ?>
	<div class="mainpage">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<h3 class="login-box-title">
						会員登録をする 
						<small>すでに登録済みの方か、 <a href="#">こちら</a>からログインしてください。</small>
					</h3>
					<form class="form-horizontal">
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
						    <div class="col-sm-4">
						    	<span class="info-val">半角英数字　8文字以上</span>
						    </div>
					  	</div>
					  	<div class="clearfix"></div>
					  	<div class="form-group mgtb-20">
						    <label class="col-sm-3">ユーザー名</label>
						    <div class="col-sm-5">
						      <input type="text" class="form-control" placeholder="ユーザー名">
						    </div>
						    <div class="col-sm-4">
						    	<span class="info-val">半角英数字　4文字以上</span>
						    </div>
					  	</div>
					  	<div class="clearfix"></div>
					  	<div class="form-group mgtb-20">
						    <label class="col-sm-3"></label>
						    <div class="col-sm-5">
						      <strong>このユーザー名は既に使われています</strong>
						    </div>
					  	</div>
					  	<div class="clearfix"></div>
					  	<div class="form-group mgtb-20">
						    <label class="col-sm-3"></label>
						    <div class="col-sm-5">
						      <strong>利用可能なユーザー名 agency0913 , y-agency</strong>
						    </div>
					  	</div>
					  	<div class="clearfix"></div>
					  	<div class="form-group mgtb-20">
						    <label class="col-sm-3">表示名</label>
						    <div class="col-sm-5">
						      <input type="text" class="form-control" placeholder="表示名">
						    </div>
						    <div class="col-sm-4">
						        <img src="assets/images/register-img01.jpg">
						    </div>
					  	</div>
					  	<div class="clearfix"></div>
						<div class="form-group mgtb-20">
						    <label class="col-sm-3">利用方法</label>
						    <div class="col-sm-5">
						      	<div id="donate">
						          <div class="row">
						            <div class="col-xs-6">
						              	<label class="graybutton btn-block">
						                	<input type="radio" name="toggle">
						                	<span>事業者の方</span>
						              	</label>
						            </div>
						            <div class="col-xs-6">
						              	<label class="graybutton btn-block">
						                	<input type="radio" name="toggle">
						                	<span>士業の方</span>
						              	</label>
						            </div>
						          	</div>
						        </div>
						    </div>
					  	</div>
					  	<div class="clearfix"></div>
						<div class="form-group mgtb-20">
						    <div class="col-sm-offset-3 col-sm-9">
						      <div class="checkbox">
						        <label>
						          <input type="checkbox"><a href="#">利用規約</a>に同意する 
						        </label>
						      </div>
						    </div>
						</div>
						<div class="clearfix"></div>
					  	<div class="form-group mgtb-20">
						    <div class="col-sm-offset-3 col-sm-5">
						      <button type="submit" class="btn submitbutton form-control ">アカウントを登録する(無料)</button>
						    </div>
					  	</div>
					</form><!-- end form -->

					<p class="line-title font20 mgtb-20">
						<strong>別のアカウントより登録をする</strong>
					</p>
					<div class="social-login">
					    <label class="col-sm-1"></label>
					    <div class="col-sm-4">
					      	<button type="button" class="btn btn-primary btn-block">facebookで登録する（無料）</button>
					    </div>
					    <div class="col-sm-4">
					      	<button type="button" class="btn btn-danger btn-block">googleで登録する（無料）</button>
					    </div>
				  	</div>
				</div>
			</div><!-- end .row -->
		</div> <!-- end .container -->
	</div> <!-- end .mainpage -->
	<div class="clearfix"></div>
<?php include ('./inc/footer.php'); ?>
