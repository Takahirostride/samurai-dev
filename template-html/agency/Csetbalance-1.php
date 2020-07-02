<?php include ('../inc/header.php'); ?>
<div class="mainpage">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
			<?php include ('../inc/breadcrumb.php'); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 mainpage">
				<div class="row">
			        <div class="col-sm-12">
			            <p class="text-step "><b><span>STEP1</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;対応可能施策情報の選択</b></p>
			        </div>
			    </div>
			    <div class="col-sm-12">
			    	<div class="row">
			    		<ul class="nav nav-tabs tab-1"> 
                            <li class="tab-style-grey">
                                <a href="agency/Csetbalance.php">対応可能施策の登録</a>
                            </li>                                     
                            <li class="tab-style-grey active">
                                <a href="agency/Csetbalance-1.php">対応可能施策一覧</a>
                            </li> 
                        </ul>
			    	</div>
			    </div>
				<div class="row subsidy-list">
					<div class="col-sm-12">
						<div class="subsidy-list-item">
							<div class="row">
								<div class="col-sm-10">
									<div class="index-boxcol2-sub">
											<div class="create-link-box">
												<div class="col-sm-1">
													<label><input type="radio" name=""></label>
												</div>
												<div class="col-sm-2">
													<img src="assets/images/agency-list-01.jpg" alt="">
												</div>
												<div class="col-sm-9">

													<p>
														<a href="#" class="boxcol2-a-2"><span class="sidy-tbig">タイトルタイトルタイトルタイトルタイトル</span><br><strong>登録期関:</strong>神奈川県 横浜市   /   <strong>募集時期:</strong>毎年4月1日から3月31日まで</a>
														<span>テキストテキストテキストテキストテキテキストテキストテキストテキストテキストテキストテキストテキストテキテキストテキストテキストテキストテキテキストテキストテキストテキストテキストテキストテキストテキストテキ...</span>
													</p>
												</div>
											</div> <!-- end .create-link-box -->
											
											<div class="middle-boxcol2">
												<ul>
													<li><button type="button" class="btn btn-default btn-style-grey" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="お気に入りボタンの１つで、興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。">提案を検討</button></li>
													<li><button type="button" class="btn btn-default btn-style-grey" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="お気に入りボタンの１つで、興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。">興味あり</button></li>
													<li><button type="button" class="btn btn-default btn-style-grey" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="必要がない、自分に関係がない施策が表示された場合は、非表示としてください。非表示とすることで自動検索であなたに関連しない施策が表示されなくなります。">非表示</button></li>
												</ul>
											</div> <!-- end .middle-boxcol2 -->
									</div> <!-- end item index-boxcol2 -->


								</div>	<!-- end col-sm-8 -->
								<div class="col-sm-2 text-center">
									<div class="box-yelow3">
										<p>書類代行　<strong>○○○円</strong></p>
										<p>着手金　　<strong>○○○円</strong></p>
										<p>その他　　　<strong>○○○円</strong></p>
									</div>
								</div><!-- end col-sm-1 -->
							</div> <!-- end .row -->
						</div> <!-- end .sidylist-item -->
						<div class="clearfix"></div>
						<div class="text-center">
							<ul class="pagination">
								<li class="disabled"><a href="#">最初</a></li>
								<li><a href="#">1</a></li>
								<li class="active"><a href="#">2</a></li>
								<li><a href="#">3</a></li>
								<li><a href="#">4</a></li>
								<li><a href="#">5</a></li>
								<li><a href="#">最後</a></li>
							</ul>
						</div>
						 <div class="text-center bsearch-btn-s">
		                    <button type="submit" class="btn btn-success btn-style-shadow-green mgr-15 w120px">編集する</button>
		                    <button class="btn btn-default btn-style-shadow-grey w120px" type="button">削除する</button>
		                </div>
					</div> <!-- end .div.col-sm-12 -->

				</div> <!-- end .row -->
			</div> <!-- end .mainpage -->
		</div> <!-- end .row -->
	</div> <!-- end .container -->
</div> <!-- end .mainpage -->
<div class="clearfix"></div>
<div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg modal-dialog-centered text-center" role="document">
	    <div class="modal-content" style="height: 491.4px;">
	        <div class="modal-header text-center">
	            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                <span aria-hidden="true">×</span>
	            </button>
	            <h5 class="modal-title">マニュアル</h5>
	        </div>
	        <div class="modal-body">
	            <iframe width="100%" height="100%" src="manuals/registration_policy3/operationlecture.html" frameborder="0"></iframe>
	        </div>
	    </div>
	</div>
</div>
<?php include ('../inc/footer.php'); ?>