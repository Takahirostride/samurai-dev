<?php include ('../inc/header.php'); ?>
<div class="mainpage">
			
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
			<?php include ('../inc/breadcrumb.php'); ?>
			</div>
		</div> <!-- end .row -->
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">依頼する</h1>
			</div>
		</div><!-- end .row -->

		<div class="row">
			<div class="col-sm-12">
				
				<ul class="dtabprofile tab-profile nav nav-tabs">
					<li class="tab-style-grey "><a href="client/Fask-1.php"> 施策詳細</a></li>
					<li class="tab-style-grey active"><a href="client/Fask.php"> 依頼詳細</a></li>
				</ul>
				
				<div class="row">
					<div class="col-sm-12 ">
						<div class="row">
							<div class="col-xs-8 left-detail">
								<p class="stitle1-only">渋谷区の中小企業事業資金融資あっせん制度（運転資金）</p>
								<form method="POST" class="form-horizontal dmsgform" enctype="multipart/form-data">
									<h4 class="pagerow-title">
										<span>依頼内容を入力する</span>
										<button type="button" id="dmsgsubmit" class="btn-primary btn btn-style-shadow-green btn-success right-title">メッセージを送る</button>
									</h4>
									<div class="dmsgbox">
										<div class="dmsg-to">
											<p>鈴木社労士 , アオイ , AAAA</p>
										</div>
										<div class="dmsg-files">
											<button type="button" class="msg-files-button"><i class="glyphicon glyphicon-paperclip"></i></button>
											<input type="file" id="msg-files" multiple>
											<p class="dfile-list"></p>
										</div>
										<div class="dmsg-mess">
											<textarea class="form-control" rows="3" placeholder="ここにメッセージを入力してください"></textarea>
										</div>
									</div> <!-- end .dmsgbox -->
								</form>
								<form type="POST" id="submit-ask-form">
									<h4 class="pagerow-title">
										<span>予算目安を入力する</span>
										<button type="button" id="submit-ask" class="btn-primary btn btn-style-shadow-green btn-success right-title">費用を提案する</button>
									</h4>
									<table class="table table-bordered bask-page">
										<tbody>
											<tr>
												<td width="20%">
													<select class="form-control">
														<option value="">登録内容1</option>
														<option value="">登録内容2</option>
													</select>
												</td>
												<td>
													<table class="table dsubtable table-borderless">
														<tbody class="list-rows">
															<tr>
																<td class="text-right" colspan="4">
																	<div class="checkbox dborder-check">
																		<label>
																			<input type="checkbox">マッチング条件を提案
																		</label>
																	</div>
																</td>
															</tr>
															<tr>
																<td>業務内容</td>
																<td>
																	<div class="checkbox">
																		<label>
																			<input type="checkbox" id="document_business_flag" class="dcheck-dis">書類代行費用
																		</label>
																	</div> <!-- end .checkbox -->
																</td>
																<td>
																	<div class="input-group">
																		<input type="text" value="" class="form-control dother-cost1" placeholder="金額" id="document_business_price" disabled="disabled">
																		<span class="input-group-addon">円</span>
																	</div>
																</td>
																<td>&nbsp;</td>
															</tr>
															<tr>
																<td></td>
																<td>
																	<div class="checkbox">
																		<label>
																			<input type="checkbox" id="request_business_flag" class="dcheck-dis">報酬
																		</label>
																	</div>
																</td>
																<td>
																	<div class="input-group">
																		<input type="number" id="request_business_price" min="0" max="100" value="0" class="form-control dother-cost2" placeholder="金額" disabled="disabled">
																		<span class="input-group-addon">%</span>
																	</div>
																</td>
																<td>&nbsp;</td>
															</tr>
															<tr>
																<td>着手金</td>
																<td>着手金</td>
																<td>
																	<div class="input-group">
																		<input type="text" value="0" class="form-control dother-cost1" id="deposit_money" placeholder="金額">
																		<span class="input-group-addon">円</span>
																	</div>
																</td>
																<td>&nbsp;</td>
															</tr>
															<tr style="border-top: 1px solid #ddd">
																<td>その他費用</td>
																<td></td>
																<td>
																	<input type="text" value="" id="dother-cost-t1" class="form-control" placeholder="費用名">
																</td>
																<td>
																	<div class="input-group">
																		<input type="number" value="0" class="form-control dother-cost" id="dother-cost-i1" placeholder="金額">
																		<span class="input-group-addon">円</span>
																	</div>
																</td>
															</tr>
															<tr>
																<td></td>
																<td></td>
																<td>
																	<input type="text" value="" id="dother-cost-t2" class="form-control" placeholder="費用名">
																</td>
																<td>
																	<div class="input-group">
																		<input type="number" value="0" class="form-control dother-cost" id="dother-cost-i2" placeholder="金額">
																		<span class="input-group-addon">円</span>
																	</div>
																</td>
															</tr>
															<tr>
																<td></td>
																<td></td>
																<td>
																	<input type="text" value="" id="dother-cost-t3" class="form-control" placeholder="費用名">
																</td>
																<td>
																	<div class="input-group">
																		<input type="number" value="0" class="form-control dother-cost" id="dother-cost-i3" placeholder="金額">
																		<span class="input-group-addon">円</span>
																	</div>
																</td>
															</tr>
															<tr>
																<td></td>
																<td></td>
																<td>
																	<input type="text" value="" id="dother-cost-t4" class="form-control" placeholder="費用名">
																</td>
																<td>
																	<div class="input-group">
																		<input type="number" value="0" class="form-control dother-cost" id="dother-cost-i4" placeholder="金額">
																		<span class="input-group-addon">円</span>
																	</div>
																</td>
															</tr>
															<tr>
																<td></td>
																<td></td>
																<td>
																	<input type="text" value="" id="dother-cost-t5" class="form-control" placeholder="費用名">
																</td>
																<td>
																	<div class="input-group">
																		<input type="number" value="0" class="form-control dother-cost" id="dother-cost-i5" placeholder="金額">
																		<span class="input-group-addon">円</span>
																	</div>
																</td>
															</tr>
															<tr>
																<td></td>
																<td><strong>合計</strong></td>
																<td></td>
																<td class="text-right" id="total-value">0 円</td>
															</tr>
															<tr class="tr-bg-pink">
																<td>受取総額</td>
																<td colspan="3" class="text-center"><span id="total_val_page">0</span> 円 + (取得助成金・補助金総額の）  <span id="total_pc_page">0</span>％</td>
															</tr>
														</tbody>
													</table>
												</td>
											</tr>
										</tbody>
									</table> <!-- end table bid price -->
								</form> <!-- end 2nd-form -->
								<div class="dintr">
									<p>・予算目安を送信することで、補助金・助成金取得費用を士業の方に伝えることができます。</p>
									<p>・郵送費、交付手数料等の実費のみ、その他の費用とすることができます。</p>
									<p>・最終条件を提示する場合（マッチング成立）は、 
										<span class="checkbox dinline-el dborder-check">
											<label>
												<input type="checkbox" disabled="disabled">マッチング条件を提案
											</label>
										</span>
										にチェックをいれて提案してください。士業の方が、
										<button type="button" class="btn-primary btn btn-xs btn-style-shadow-green btn-success dsm-button">マッチングする</button>
										をクリックすると、 業務開始されます。

									</p>
								</div>
							</div><!-- end left-detail -->
							<div class="col-xs-4">
								<div class="detail-right-mbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" class="dask-check checkall-btn" checked="checked">次回から自動的にログインする。 
										</label>
									</div> <!-- end .checkbox -->
									<button type="button" onclick="window.location.href='agency/Bask.php';" class="btn-primary btn btn-xs btn-style-shadow-green btn-success">提案する</button>
								</div> <!-- end .detail-right-mbox -->
								<div class="dagency-list-right">
									<div class="dagency-list-item">
										<table class="table table-bordered">
											<tbody>
												<tr>
													<td>
														<div class="checkbox">
															<label>
																<input type="checkbox" class="dask-check" checked="checked">
															</label>
														</div> <!-- end .checkbox -->
													</td>
													<td>
														<img src="assets/images/avatar.png" alt="">
														<button type="button" class="btn btn-primary dcfollow-btn">フォロー</button>
													</td>
													<td>
														<p>士業名：鈴木社労士</p>
														<p>
															<span>実績     ：</span>
															<select class="rating-disable" name="rating" autocomplete="off">
																<option value="1">1</option>
																<option value="2" selected="selected">2</option>
																<option value="3">3</option>
																<option value="4">4</option>
																<option value="5">5</option>
															</select>
														</p>
														<p>評価     ：0件</p>
													</td>
												</tr>
											</tbody>
										</table>
									</div> <!-- end .dagency-list-item -->
									<div class="dagency-list-item">
										<table class="table table-bordered">
											<tbody>
												<tr>
													<td>
														<div class="checkbox">
															<label>
																<input type="checkbox" class="dask-check" checked="checked">
															</label>
														</div> <!-- end .checkbox -->
													</td>
													<td>
														<img src="assets/images/avatar.png" alt="">
														<button type="button" class="btn btn-primary btn-style-grey dcfollow-btn">フォロー</button>
													</td>
													<td>
														<p>士業名：アオイ</p>
														<p>
															<span>実績     ：</span>
															<select class="rating-disable" name="rating" autocomplete="off">
																<option value="1">1</option>
																<option value="2" selected="selected">2</option>
																<option value="3">3</option>
																<option value="4">4</option>
																<option value="5">5</option>
															</select>
														</p>
														<p>評価     ：0件</p>
													</td>
													<td>
														<p>士業名：AAAA</p>
														<p>
															<span>実績     ：</span>
															<select class="rating-disable" name="rating" autocomplete="off">
																<option value="1">1</option>
																<option value="2" selected="selected">2</option>
																<option value="3">3</option>
																<option value="4">4</option>
																<option value="5">5</option>
															</select>
														</p>
														<p>評価     ：0件</p>
													</td>
												</tr>
											</tbody>
										</table>
									</div> <!-- end .dagency-list-item -->

								</div> <!-- end .dagency-list-right -->

							</div><!-- end .col-xs-4 -->
						</div> <!-- end .row -->
						

					</div> <!-- end .subsidydetail -->
					
				</div> <!-- end .row -->


				
			</div> <!-- .col-sm-12 -->
		</div> <!-- end .row -->
		</div> <!-- end .container -->
</div> <!-- end .mainpage -->
<div class="clearfix"></div>

<div class="modal fade bask-modal" id="submit-ask-modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">依頼費用</h4>
			</div>
			<div class="modal-body">
				<div class="dagency-list-right-modal">
						<div class="row">
							<div class="col-xs-4">
								<div class="dagency-list-item">
									<table class="table table-bordered">
										<tbody>
											<tr>
												<td class="vertical-top">
													<div class="checkbox">
														<label>
															<input type="checkbox" class="dask-check" checked="checked">
														</label>
													</div> <!-- end .checkbox -->
												</td>
												<td>
													<img src="assets/images/avatar.png" alt="">
													<button type="button" class="btn btn-primary dcfollow-btn">フォロー</button>
												</td>
												<td>
													<p>士業名：鈴木社労士</p>
													<p>
														<span>実績     ：</span>
														<select class="rating-disable" name="rating" autocomplete="off">
															<option value="1">1</option>
															<option value="2" selected="selected">2</option>
															<option value="3">3</option>
															<option value="4">4</option>
															<option value="5">5</option>
														</select>
													</p>
													<p>評価     ：0件</p>
												</td>
											</tr>
										</tbody>
									</table>
								</div> <!-- end .dagency-list-item -->
							</div> <!-- end .col-xs-4 -->
							<div class="col-xs-4">
								<div class="dagency-list-item">
									<table class="table table-bordered">
										<tbody>
											<tr>
												<td class="vertical-top">
													<div class="checkbox">
														<label>
															<input type="checkbox" class="dask-check" checked="checked">
														</label>
													</div> <!-- end .checkbox -->
												</td>
												<td>
													<img src="assets/images/avatar.png" alt="">
													<button type="button" class="btn btn-primary dcfollow-btn">フォロー</button>
												</td>
												<td>
													<p>士業名：鈴木社労士</p>
													<p>
														<span>実績     ：</span>
														<select class="rating-disable" name="rating" autocomplete="off">
															<option value="1">1</option>
															<option value="2" selected="selected">2</option>
															<option value="3">3</option>
															<option value="4">4</option>
															<option value="5">5</option>
														</select>
													</p>
													<p>評価     ：0件</p>
												</td>
											</tr>
										</tbody>
									</table>
								</div> <!-- end .dagency-list-item -->
							</div> <!-- end .col-xs-4 -->
							<div class="col-xs-4">
								<div class="dagency-list-item">
									<table class="table table-bordered">
										<tbody>
											<tr>
												<td class="vertical-top">
													<div class="checkbox">
														<label>
															<input type="checkbox" class="dask-check" checked="checked">
														</label>
													</div> <!-- end .checkbox -->
												</td>
												<td>
													<img src="assets/images/avatar.png" alt="">
													<button type="button" class="btn btn-primary dcfollow-btn">フォロー</button>
												</td>
												<td>
													<p>士業名：鈴木社労士</p>
													<p>
														<span>実績     ：</span>
														<select class="rating-disable" name="rating" autocomplete="off">
															<option value="1">1</option>
															<option value="2" selected="selected">2</option>
															<option value="3">3</option>
															<option value="4">4</option>
															<option value="5">5</option>
														</select>
													</p>
													<p>評価     ：0件</p>
												</td>
											</tr>
										</tbody>
									</table>
								</div> <!-- end .dagency-list-item -->
							</div> <!-- end .col-xs-4 -->

						</div> <!-- end .row -->
					</div>
						<form type="POST" id="submit-ask-form">
									<table class="table table-bordered bask-page">
										<tbody>
											<tr>
												<td width="20%">
													<div class="miview">
														<p class="text-center">見積もり内容</p>
													</div>
												</td>
												<td>
													<table class="table dsubtable table-borderless">
														<tbody class="list-rows">
															<tr>
																<td class="text-right" colspan="4">
																	<div class="checkbox dborder-check">
																		<label>
																			<input type="checkbox">マッチング条件を提案
																		</label>
																	</div>
																</td>
															</tr>
															<tr>
																<td>業務内容</td>
																<td>書類代行費用</td>
																<td id="document_business_price_m"></td>
																<td>&nbsp;</td>
															</tr>
															<tr>
																<td></td>
																<td>報酬</td>
																<td id="request_business_price_m"></td>
																<td>&nbsp;</td>
															</tr>
															<tr>
																<td>着手金</td>
																<td>着手金</td>
																<td id="deposit_money_m"></td>
																<td>&nbsp;</td>
															</tr>
															<tr style="border-top: 1px solid #ddd">
																<td>その他費用</td>
																<td></td>
																<td id="dother-cost-t1_m"></td>
																<td id="dother-cost-i1_m"></td>
															</tr>
															<tr>
																<td></td>
																<td></td>
																<td id="dother-cost-t2_m"></td>
																<td id="dother-cost-i2_m"></td>
															</tr>
															<tr>
																<td></td>
																<td></td>
																<td id="dother-cost-t3_m"></td>
																<td id="dother-cost-i3_m"></td>
															</tr>
															<tr>
																<td></td>
																<td></td>
																<td id="dother-cost-t4_m"></td>
																<td id="dother-cost-i4_m"></td>
															</tr>
															<tr>
																<td></td>
																<td></td>
																<td id="dother-cost-t5_m"></td>
																<td id="dother-cost-i5_m"></td>
															</tr>
															<tr>
																<td></td>
																<td><strong>合計</strong></td>
																<td></td>
																<td class="text-right" id="total-value_m">0 円</td>
															</tr>
															<tr class="tr-bg-pink">
																<td>受取総額</td>
																<td colspan="3" class="text-center"><span id="total_val_page_m">0</span> 円 + (取得助成金・補助金総額の）  <span id="total_pc_page_m">0</span>％</td>
															</tr>
														</tbody>
													</table>
												</td>
											</tr>
										</tbody>
									</table> <!-- end table bid price -->
								</form> <!-- end 2nd-form -->
			</div> <!-- end .modal-body -->
			<div class="modal-footer">
				<div class="text-center">
					<button type="button" onclick="window.location.href='';" class="btn-primary btn btn-style-shadow-green btn-success">提案する</button>
					<button type="button" data-dismiss="modal" class="btn btn-style-shadow-grey">戻る</button>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade bask-modal" id="modal-completed">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">依頼費用</h4>
			</div>
			<div class="modal-body">
				<div class="dagency-list-right-modal">
						<div class="row">
							<div class="col-xs-4">
								<div class="dagency-list-item">
									<table class="table table-bordered">
										<tbody>
											<tr>
												<td class="vertical-top">
													<div class="checkbox">
														<label>
															<input type="checkbox" class="dask-check" checked="checked">
														</label>
													</div> <!-- end .checkbox -->
												</td>
												<td>
													<img src="assets/images/avatar.png" alt="">
													<button type="button" class="btn btn-primary dcfollow-btn">フォロー</button>
												</td>
												<td>
													<p>士業名：鈴木社労士</p>
													<p>
														<span>実績     ：</span>
														<select class="rating-disable" name="rating" autocomplete="off">
															<option value="1">1</option>
															<option value="2" selected="selected">2</option>
															<option value="3">3</option>
															<option value="4">4</option>
															<option value="5">5</option>
														</select>
													</p>
													<p>評価     ：0件</p>
												</td>
											</tr>
										</tbody>
									</table>
								</div> <!-- end .dagency-list-item -->
							</div> <!-- end .col-xs-4 -->
							<div class="col-xs-4">
								<div class="dagency-list-item">
									<table class="table table-bordered">
										<tbody>
											<tr>
												<td class="vertical-top">
													<div class="checkbox">
														<label>
															<input type="checkbox" class="dask-check" checked="checked">
														</label>
													</div> <!-- end .checkbox -->
												</td>
												<td>
													<img src="assets/images/avatar.png" alt="">
													<button type="button" class="btn btn-primary dcfollow-btn">フォロー</button>
												</td>
												<td>
													<p>士業名：鈴木社労士</p>
													<p>
														<span>実績     ：</span>
														<select class="rating-disable" name="rating" autocomplete="off">
															<option value="1">1</option>
															<option value="2" selected="selected">2</option>
															<option value="3">3</option>
															<option value="4">4</option>
															<option value="5">5</option>
														</select>
													</p>
													<p>評価     ：0件</p>
												</td>
											</tr>
										</tbody>
									</table>
								</div> <!-- end .dagency-list-item -->
							</div> <!-- end .col-xs-4 -->
							<div class="col-xs-4">
								<div class="dagency-list-item">
									<table class="table table-bordered">
										<tbody>
											<tr>
												<td class="vertical-top">
													<div class="checkbox">
														<label>
															<input type="checkbox" class="dask-check" checked="checked">
														</label>
													</div> <!-- end .checkbox -->
												</td>
												<td>
													<img src="assets/images/avatar.png" alt="">
													<button type="button" class="btn btn-primary dcfollow-btn">フォロー</button>
												</td>
												<td>
													<p>士業名：鈴木社労士</p>
													<p>
														<span>実績     ：</span>
														<select class="rating-disable" name="rating" autocomplete="off">
															<option value="1">1</option>
															<option value="2" selected="selected">2</option>
															<option value="3">3</option>
															<option value="4">4</option>
															<option value="5">5</option>
														</select>
													</p>
													<p>評価     ：0件</p>
												</td>
											</tr>
										</tbody>
									</table>
								</div> <!-- end .dagency-list-item -->
							</div> <!-- end .col-xs-4 -->

						</div> <!-- end .row -->
					</div>
					<div class="clearfix"></div>
					<div class="text-center">
						<p class="completed-ask-submit">
							事業者への提案が完了しました。
						</p>
					</div>
			</div>
			<div class="modal-footer">
				<div class="text-center">
					<button type="button" data-dismiss="modal" class="btn-primary btn btn-style-shadow-green btn-success">閉じる</button>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- footer -->
	<footer class="bg-color">
	  <div class="container">
		<div class="row">
		  <div class="col-sm-3 col-xs-6">
			  <div class="item-list">
				<p class="title_list"><i class="fa fa-chevron-circle-down" aria-hidden="true"></i>  企業の皆様へ  </p>
				<ul class="link-list">
				  <li><a href="">士業ブログ</a></li>
				</ul>
			  </div>
		  </div>
		  <div class="col-sm-3 col-xs-6">
			  <div class="item-list">
				<p class="title_list"><i class="fa fa-chevron-circle-down" aria-hidden="true"></i>  士業の皆様へ  </p>
				<ul class="link-list">

				</ul>
			  </div>
		  </div>

		  <div class="col-sm-3 col-xs-6">
			  <div class="item-list">
				<p class="title_list"><i class="fa fa-chevron-circle-down" aria-hidden="true"></i>サポート  </p>
				<ul class="link-list">
				  <li><a href="">利用規約</a></li>
				  <li><a href="">特定商取引法に基づく表記</a></li>
				  <li><a href="">仕事依頼ガイドライン</a></li>
				  <li><a href="">プライバシーポリシー</a></li>
				</ul>
			  </div>
		  </div>
		  <div class="col-sm-3 col-xs-6">
			  <div class="item-list">
				<p class="title_list"><i class="fa fa-chevron-circle-down" aria-hidden="true"></i>会社情報  </p>
				<ul class="link-list">
				  <li><a href="">会社概要</a></li>
				</ul>
			  </div>
		  </div>
		  
		  
		</div>
		<div class="row">
		  <div class="col-sm-12">
			<p class="copyright text-center">&copy; SAMURAI All Rights Reserved. 日本最大級の助成金・補助金マッチング「サムライ」</p>
		  </div>
		</div>
	  </div>
	</footer>
  </div>
	<script src="assets/js/jquery-3.3.1.min.js"></script>
	<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/plugins/datepicker/js/bootstrap-datepicker.min.js"></script>
	<script src="assets/plugins/bar-rating/dist/jquery.barrating.min.js"></script>
	<script src="assets/js/common.js"></script>
	<script src="assets/js/luu.js"></script>
	<script>
		$('#example-fontawesome,.datrating').barrating({
			//index page jubotron
            theme: 'fontawesome-stars',
            showSelectedRating: false,
            onSelect: function(value, text, event) {
			    if (typeof(event) !== 'undefined') {
			      // rating was selected by a user
			      console.log(value);
			    } else {
			      // rating was selected programmatically
			      // by calling `set` method
			    }
			  }
        });
        $('.rating-disable').barrating({
			//index page jubotron
            theme: 'fontawesome-stars',
            showSelectedRating: false,
            readonly: true,
            onSelect: function(value, text, event) {
			    if (typeof(event) !== 'undefined') {
			      // rating was selected by a user
			      console.log(value);
			    } else {
			      // rating was selected programmatically
			      // by calling `set` method
			    }
			  }
        });

		//agency/home tooltip
		$(function () {
		  $('[data-toggle="tooltip"]').tooltip()
		});

		var msg_files = [];
		var msg_files_l = 0;
		$('.msg-files-button').click(function() {
			$('#msg-files').trigger('click');
		});
		$(document).on('change', '#msg-files', function() {
			files = $('#msg-files')[0].files;
			html = '';
			st = msg_files.length + 1;
			for(i = 0; i < files.length; i++)
			{
				
				html += '<span class="dmsgfile-item">' + files[i].name + '<button type="button" id="ff_'+msg_files_l+'" class="dmsgfile-item-remove"><i class="fa fa-trash"></i></button></span>';
				msg_files[msg_files_l] = {name: files[i].name, file: files[i]};
				msg_files_l += 1;
				
			}
			$('.dfile-list').append(html);
			console.log(msg_files);
		});
		$(document).on('click', '.dmsgfile-item-remove', function(e) {
			var thisId = $(this).attr('id');
			thisId = thisId.split('_');
			thisId = thisId[1];
			delete msg_files[thisId];
			$(this).parent().remove();
			console.log(msg_files);
		});
		$('#dmsgsubmit').click(function() {
			uploadFileMuli();
		});
		var uploadFileMuli = function() {
			var fd = new FormData();
			//var config = { headers: { 'Content-Type': undefined } };
			for(i = 0; i < msg_files.length; i++)
			{
				if(typeof(msg_files[i]) != 'undefined')
				{
					fd.append("fileToUpload" + i, msg_files[i].file);
				}
			}
			$.ajax({
				url: 'uploadFile',
				data: {files: fd},
				type: 'POST',
				success: function(json) {
					//display results
				}
			});
		}
		$('.dcheck-dis').change(function() {
			var input_parent = $(this).parents('td').next().find('input[type="text"],input[type="number"]');
			if($(this).is(':checked')) {
				input_parent.attr('disabled', false);
			} else {
				input_parent.attr('disabled', true);
			}
			if(input_parent.prop('type') == 'number') input_parent.val('0');
			else input_parent.val('');
			all_cal();
		});
		$('.dask-check').change(function() {
			//check checkall button
			if($(this).hasClass('checkall-btn'))
			{
				s_status = false;
				if($(this).is(':checked')) {
					s_status = true;
				}
				$('.dask-check').each(function(index, el) {
					if(!$(el).hasClass('checkall-btn')) $(el).prop('checked', s_status);
				});
			} else {
				var count_e = 0;
				var count_checked = 0;
				$('.dask-check').each(function(index, el) {
					if(!$(el).hasClass('checkall-btn')) {
						if($(el).is(':checked')) {
							count_checked += 1;
						}
						count_e += 1;
						
					}
				});
				if(count_checked == count_e) {
					$('.checkall-btn').prop('checked', true);
				} else {
					$('.checkall-btn').prop('checked', false);
				}
			}

			//set name
			sss = '&nbsp;';
			$('.dask-check').each(function(index, el) {
				if(!$(el).is(':checked')) return;
				if(!$(el).hasClass('checkall-btn')) {
					name = $(el).parents('td').next().next().find('p').first().text();
					name = name.replace('士業名：', '');
					sss += name + ', ';
				}
				
			});
			$('.dmsg-to p').html(sss);

		});
		$('.dother-cost').keyup(function() {
			all_cal();
		});
		var all_cal = function() {
			var total_val = 0;
			var total_pc = 0;
			$('.dother-cost').each(function(index, el)
			{
				if($(el).val() == '') return;
				total_val += parseInt($(el).val());
			});
			$('#total-value').text(total_val + ' 円');
			if($('#document_business_price').val() != '') {
				total_val += parseInt($('#document_business_price').val());
			}
			if($('#deposit_money').val() != '') {
				total_val += parseInt($('#deposit_money').val());
			}
			$('#total_val_page').text(total_val);
			if($('#request_business_price').val() != '') {
				total_pc = parseInt($('#request_business_price').val());
			}
			$('#total_pc_page').text(total_pc);
			
		}
		$('#document_business_price').keyup(function() {
			all_cal();
		});
		$('#request_business_price').keyup(function() {
			if($(this).val() < 0) $(this).val(0);
			if($(this).val() > 99) $(this).val(100);
			$(this).val(parseInt($(this).val()));
			all_cal();
		});
		$('#deposit_money').keyup(function() {
			all_cal();
		});
		var document_business_type = 1;
		$('#submit-ask').click(function() {
			if(!$('#document_business_flag').is(":checked") && !$('#request_business_flag').is(':checked'))
			{
				alert("費用を正確に入力してください。");
				return;
			}
			if($('#document_business_flag').is(":checked"))
			{
				if($('#document_business_price').val())
				{
					if($('#document_business_price').val() < 0)
					{
						alert("すべての項目を正確に入力してください!");
						return;
					}
					if($('#document_business_price').val() > 100 && document_business_type == 1)
					{
						alert("すべての項目を正確に入力してください!");
						return;
					}
				} else {
					alert("すべての項目を正確に入力してください!");
					return;
				}
			} else {
				request_business_price = 0;
			}
			if($('#deposit_money').val()) {
				if($('#deposit_money').val() == 0) {
					alert("すべての項目を正確に入力してください!");
					return;
				}
			}
			set_modal_value();
			$('#submit-ask-modal').modal();
		});
		var set_modal_value = function() {
			$('#document_business_price_m').text( $('#document_business_price').val() );
			$('#request_business_price_m').text( $('#request_business_price').val() );
			$('#deposit_money_m').text( $('#deposit_money').val() );
			$('#dother-cost-t1_m').text( $('#dother-cost-t1').val() );
			$('#dother-cost-t2_m').text( $('#dother-cost-t2').val() );
			$('#dother-cost-t3_m').text( $('#dother-cost-t3').val() );
			$('#dother-cost-t4_m').text( $('#dother-cost-t4').val() );
			$('#dother-cost-t5_m').text( $('#dother-cost-t5').val() );
			$('#dother-cost-i1_m').text( $('#dother-cost-i1').val() + ' 円' );
			$('#dother-cost-i2_m').text( $('#dother-cost-i2').val() + ' 円' );
			$('#dother-cost-i3_m').text( $('#dother-cost-i3').val() + ' 円' );
			$('#dother-cost-i4_m').text( $('#dother-cost-i4').val() + ' 円' );
			$('#dother-cost-i5_m').text( $('#dother-cost-i5').val() + ' 円' );
			$('#total-value_m').text( $('#total-value').text() );
			$('#total_val_page_m').text( $('#total_val_page').text() );
			$('#total_pc_page_m').text( $('#total_pc_page').text() );
		}
	</script>
  </body>
</html>