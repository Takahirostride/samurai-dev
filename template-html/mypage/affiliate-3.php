<?php include ('../inc/header.php'); ?>
<div class="mainpage">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<ol class="breadcrumb">
					<li><a class="bg-color" href="#">TOPページ</a></li>
					<li class="active">アフィリエイト管理</li>
				</ol>	
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">アフィリエイト管理</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-2 sidebar-left">
				<?php include ('../inc/mypage-sidebar-left.php'); ?>
			</div>
			<div class="col-sm-10 mainpage">
				<div class="row">
					<div class="col-sm-12">
						<ul class="nav nav-tabs tablinksub bordernone">
						    <li>
						        <a href="mypage/affiliate-1.php">リンク作成</a>
						    </li>
						    <li>
						        <a href="mypage/affiliate-2.php">リンク作成</a>
						    </li>
						    <li class="active">
						        <a href="mypage/affiliate-3.php">登録情報</a>
						    </li>
						</ul><!-- end .tablinksub -->
					</div><!-- end .col-sm-12 -->
					<form action="" method="POST" role="form">
						<div class="col-sm-12">
							<h3 class="page-title">基本情報</h3>
							<div class="row">
								<div class="col-sm-10">
									<table class="full-width table-infobas mgt-20">
										<tbody>
											<tr>
												<th>担当者名</th>
												<td>
													<input type="text" class="form-control" placeholder="担当者名">
												</td>
											</tr>
											<tr>
												<th>所在地</th>
												<td>
													<div class="row">
														<div class="col-sm-5">
															<div class="angularsl">
																<select name="" id="locationselect">
																	<option value="全国">全国</option>
																	<option value="北海道">北海道</option>
																	<option value="青森県">青森県</option>
																	<option value="岩手県">岩手県</option>
																	<option value="宮城県">宮城県</option>
																</select>
															</div>
														</div>
														<div class="col-sm-3">
															<div class="checkbox text-right mgt-0">
														        <label>
														          <input type="checkbox" class="checkdis" data-tgdis="locationselect,locationtext"> その他
														        </label>
														      </div>
														</div>
														<div class="col-sm-4">
															<input type="text" name="location" id="locationtext" class="form-control" placeholder="所在地" disabled>
														</div>
													</div>
												</td>
											</tr>
											<tr>
												<th>市区町村</th>
												<td>
													<div class="row">
														<div class="col-sm-5">
															<div class="angularsl">
																<select name="" id="locationselect2">
																	<option value="全国">全国</option>
																	<option value="北海道">北海道</option>
																	<option value="青森県">青森県</option>
																	<option value="岩手県">岩手県</option>
																	<option value="宮城県">宮城県</option>
																</select>
															</div>
														</div>
														<div class="col-sm-3">
															<div class="checkbox text-right mgt-0">
														        <label>
														          <input type="checkbox" class="checkdis" data-tgdis="locationselect2,locationtext2"> その他
														        </label>
														      </div>
														</div>
														<div class="col-sm-4">
															<input type="text" name="location" id="locationtext2" class="form-control" placeholder="所在地" disabled>
														</div>
													</div>
												</td>
											</tr>
											<tr>
												<th>番地・建物名</th>
												<td>
													<input type="text" class="form-control" placeholder="番地・建物名">
												</td>
											</tr>
											<tr>
												<th>電話番号</th>
												<td>
													<input type="text" class="form-control" placeholder="電話番号">
												</td>
											</tr>
											<tr>
												<th>FAX番号</th>
												<td>
													<input type="text" class="form-control" placeholder="FAX番号">
												</td>
											</tr>
										</tbody>
									</table>
								</div><!-- end .col-sm-10 -->
							</div><!-- end .row -->
							<h3 class="page-title">振込先口座情報</h3>
							<p class="mgt-30">※ 獲得した報酬を振り込む銀行口座を登録してください。</p>
							<div class="row">
								<div class="col-sm-10">
									<table class="table table-bordered tableformtitle">
										<tbody>
											<tr>
												<th>銀行名</th>
												<td>
													<div class="col-sm-4">
														<div class="angularsl">
															<select name="" id="locationselect2">
																<option value="全国">全国</option>
																<option value="北海道">北海道</option>
																<option value="青森県">青森県</option>
																<option value="岩手県">岩手県</option>
																<option value="宮城県">宮城県</option>
															</select>
														</div>
													</div>
													<div class="col-sm-8">
														<input type="text" name="location" class="form-control" placeholder="" disabled>
													</div>
												</td>
											</tr>
											<tr>
												<th>銀行コード</th>
												<td>
													<div class="col-sm-8">
														<input type="text" name="location" class="form-control" placeholder="" disabled>
													</div>
												</td>
											</tr>
										</tbody>
									</table><!-- end table -->
									<table class="table table-bordered tableformtitle">
										<tbody>
											<tr>
												<th>支店名</th>
												<td>
													<div class="col-sm-12">
														<input type="text" name="location" class="form-control" placeholder="">
													</div>
												</td>
												<th>支店コード</th>
												<td>
													<div class="col-sm-12">
														<input type="text" name="location" class="form-control" placeholder="">
													</div>
												</td>
											</tr>
											<tr>
												<th>口座種別</th>
												<td colspan="3">
													<div class="col-sm-2">
														<label class="radio-inline">
														  	<input type="radio" name="inlineRadioOptions" value="option1"> 普通
														</label>
													</div>
													<div class="col-sm-2">
														<label class="radio-inline">
														  	<input type="radio" name="inlineRadioOptions" value="option1"> 当座
														</label>
													</div>
												</td>
											</tr>
											<tr>
												<th>口座番号</th>
												<td colspan="3">
													<div class="col-sm-12">
														<input type="text" name="location" class="form-control" placeholder="">
													</div>
												</td>
											</tr>
											<tr>
												<th>口座名義</th>
												<td colspan="3">
													<div class="col-sm-12">
														<input type="text" name="location" class="form-control" placeholder="">
													</div>
												</td>
											</tr>
										</tbody>
									</table><!-- end table -->
									<p>※ 振込日が土日祝日など弊社定休日の場合は、翌営業日に振込させて頂きます。あらかじめご了承ください。</p>
									<div class="text-center mgbt-50 mgt-30">
										<button type="submit" class="shadowbuttonsuccess btn btn-success">登録する</button>
									</div>
								</div><!-- end .col-sm-12 -->
							</div><!-- end .row -->
							
						</div><!-- end .col-sm-12 -->
					</form>
					<!-- end form -->
				</div>	<!-- end .row -->
			</div>
		</div>
	</div>
</div>
<?php include ('../inc/footer.php'); ?>