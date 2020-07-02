<?php include ('../inc/header.php'); ?>
<div class="mainpage">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<ol class="breadcrumb">
					<li><a class="bg-color" href="#">TOPページ</a></li>
					<li class="active">仕事管理</li>
				</ol>	
			</div>
		</div><!-- end .row -->
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">仕事管理</h1>
			</div>
		</div><!-- end .row -->
		<div class="row">
			<div class="col-sm-2 sidebar-left">
				<?php include ('../inc/mypage-sidebar-left.php'); ?>
			</div>
			<div class="col-sm-10 mainpage">
				<div class="row">
					<div class="col-sm-12">
						<ul class="jobTapLink">
		                    <li>
		                        <a href="mypage/agencyjob-1.php">依頼・提案・募集</a>
		                    </li>
		                    <li class="active">
		                        <a href="mypage/agencyjob-2.php">マッチング案件</a>
		                    </li>
		                    <li>
		                        <a href="mypage/agencyjob-3.php">終了した案件</a>
		                    </li>
		                </ul>
					</div>
				</div><!-- end .row -->
				<div class="div-style-grey">
					<div class="row">
					    <div class="col-sm-4">
					        <h5 class="font13">10/12</h5>
					    </div>
					    <div class="col-sm-8">
					    	<form action="" method="POST" class="form-inline text-right">
					    		<div class="form-group col-sm-7">
					    			<label class="fw500" for="">表示年月：</label>
					    			<select class="form-control min-w100 mgr-15" name="filteryear">
						                <option value="0" selected="selected">すべて</option>
						                <option value="2017">2017年</option>
						                <option value="2018">2018年</option>
						                <option value="2019">2019年</option>
						            </select>
						            <select class="form-control min-w100" name="filtermonth">
						                <option value="0" selected="selected">すべて</option>
						                <option value="1">1月</option>
						                <option value="2">2月</option>
						                <option value="3">3月</option>
						                <option value="4">4月</option>
						                <option value="5">5月</option>
						                <option value="6">6月</option>
						                <option value="7">7月</option>
						                <option value="8">8月</option>
						                <option value="9">9月</option>
						                <option value="10">10月</option>
						                <option value="11">11月</option>
						                <option value="12">12月</option>
						            </select>
					    		</div>
					    		<div class="form-group col-sm-5">
					    			<label class="fw500" for="">表示件数：</label>
					    			<select class="form-control min-w150" name="itemperpagestring">
						                <option value="10" selected="selected">10</option>
						                <option value="20">20</option>
						                <option value="50">50</option>
						            </select>
					    		</div>

					    	</form>
					    </div>
					</div><!-- end .row -->
				</div><!-- end .div-style-grey -->
				<div class="row">
					<div class="col-sm-12">
						<ul class="nav nav-tabs tablinksub">
						    <li class="active">
						        <a href="mypage/agencyjob-2.php">提案中</a>
						    </li>
						    <li>
						        <a href="mypage/agencyjob-2-2.php">受けた依頼</a>
						    </li>
						    <li>
						        <a href="mypage/agencyjob-2-3.php">募集案件</a>
						    </li>
						</ul>
					</div>	<!-- end col-sm-12 -->
				</div><!-- end .row -->
				<div class="row">
					<div class="col-sm-12">
						<div class="boxpdbg">
							<table class="table table-bordered table-hover pdtdbold">
							    <thead>
								    <tr>
								        <th>タイトル</th>
								        <th>事業者名</th>
								        <th>マッチング日</th>
								        <th>締切日</th>
								    </tr>
							    </thead>
							    <tbody>
								    <tr>
								        <td>伊勢崎市企業立地促進奨励金（施策名）</td>
								        <td>テスト</td>
								        <td>2018年07月26日</td>
								        <td>0000年00月00日</td>
								    </tr>
							    </tbody>
							</table>
							<table class="table table-bordered table-hover pdtdbold">
							    <tbody>
								    <tr>
								        <td>
								        	<div class="pull-left">
								        		<a href="mypage/agencyjob-2-4.php" class="shadowbuttonsuccess btn btn-success mgr-8">タスク設定</a>
								        		<a href="mypage/agencyjob-2-5.php" class="shadowbuttonsuccess btn btn-success mgr-8">タスクを見る</a>
								        		<a href="mypage/agencyjob-2-6.php" class="shadowbuttonsuccess btn btn-success">メッセージを見る</a>
								        	</div>
								        	<div class="pull-right">
								        		<a href="mypage/agencyjob-2-7.php" class="shadowbuttonprimary btn btn-primary mgr-8">請求</a>
								        		<a href="mypage/agencyjob-2-8.php" class="shadowbuttonprimary btn btn-primary">完了・キャンセル</a>
								        	</div>
								        </td>
								    </tr>
							    </tbody>
							</table>
						</div>
					</div>
				</div><!-- end .row -->	
				<div class="row">
					<div class="col-sm-12">
						<h3 class="page-title">申請代行費用請求詳細</h3>
						<div class="row boxcacular">
							<div class="col-sm-9">
								<form action="" method="POST" role="form">
									<table class="full-table">
										<tbody>
											<tr>
												<td>取得金額</td>
												<td></td>
												<td>
													<div class="form-group has-feedback mgbt-0">
						                            	<input type="number" class="form-control" placeholder="取得金額" name="balance">
						                            	<span class="form-control-feedback">円</span>
						                        	</div>
						                        </td>
											</tr>
											<tr>
												<td>受取成功報酬</td>
												<td>20  %</td>
												<td>
													<div class="text-right">0  円</div>
						                        </td>
											</tr>
											<tr>
												<td>その他費用</td>
												<td>合計</td>
												<td>
													<div class="text-right">0  円</div>
						                        </td>
											</tr>
											<tr>
												<td>合計</td>
												<td></td>
												<td>
													<div class="text-right">0  円</div>
						                        </td>
											</tr>
											<tr>
												<td>事務手数料(5.5%)</td>
												<td></td>
												<td>
													<div class="text-right">0  円</div>
						                        </td>
											</tr>
											<tr class="style-light-brown">
												<td>振込予定金額(内税)</td>
												<td></td>
												<td>
													<div class="text-right">0  円</div>
						                        </td>
											</tr>

										</tbody>
									</table>
									<p class="text-center mgt-30">
										<button type="submit" class="shadowbuttonsuccess btn btn-success">請求する</button>
									</p>
								</form>
							</div>
							<div class="col-sm-3">
								<div class="cacular-desc">
									<p class="text-center mgbt-30">
										<span class="boxred">請求済み</span>
									</p>
									<p>
										取得金額、およびその他費用を入力してください。<br>
										入力した内容は、事業者に通知されます。<br>
										取得した金額・費用を、事業者が確認完了すると、請求金額が確定します。
									</p>
								</div>
							</div>
						</div>
					</div><!-- end .col-sm-12 -->	
					<div class="col-sm-12">
						<h3 class="page-title">書類作成費用請求詳細</h3>
						<div class="row boxcacular">
							<div class="col-sm-9">
								<form action="" method="POST" role="form">
									<table class="full-table">
										<tbody>
											<tr>
												<td>書類作成費用</td>
												<td></td>
												<td></td>
												<td>
													<div class="text-right">0  円</div>
						                        </td>
											</tr>
											<tr>
												<td>その他費用</td>
												<td>内訳</td>
												<td>
													<div class="form-group mgbt-0">
						                            	<input type="text" class="form-control" placeholder="費用名" name="balance">
						                        	</div>
						                        </td>
						                        <td>
													<div class="form-group has-feedback mgbt-0">
						                            	<input type="number" class="form-control" placeholder="金額" name="balance">
						                            	<span class="form-control-feedback">円</span>
						                        	</div>
						                        </td>
											</tr>
											<tr>
												<td></td>
												<td></td>
												<td>
													<div class="form-group mgbt-0">
						                            	<input type="text" class="form-control" placeholder="費用名" name="balance">
						                        	</div>
						                        </td>
						                        <td>
													<div class="form-group has-feedback mgbt-0">
						                            	<input type="number" class="form-control" placeholder="金額" name="balance">
						                            	<span class="form-control-feedback">円</span>
						                        	</div>
						                        </td>
											</tr>
											<tr>
												<td></td>
												<td></td>
												<td>
													<div class="form-group mgbt-0">
						                            	<input type="text" class="form-control" placeholder="費用名" name="balance">
						                        	</div>
						                        </td>
						                        <td>
													<div class="form-group has-feedback mgbt-0">
						                            	<input type="number" class="form-control" placeholder="金額" name="balance">
						                            	<span class="form-control-feedback">円</span>
						                        	</div>
						                        </td>
											</tr>
											<tr>
												<td></td>
												<td></td>
												<td>
													<div class="form-group mgbt-0">
						                            	<input type="text" class="form-control" placeholder="費用名" name="balance">
						                        	</div>
						                        </td>
						                        <td>
													<div class="form-group has-feedback mgbt-0">
						                            	<input type="number" class="form-control" placeholder="金額" name="balance">
						                            	<span class="form-control-feedback">円</span>
						                        	</div>
						                        </td>
											</tr>
											<tr>
												<td></td>
												<td></td>
												<td>
													<div class="form-group mgbt-0">
						                            	<input type="text" class="form-control" placeholder="費用名" name="balance">
						                        	</div>
						                        </td>
						                        <td>
													<div class="form-group has-feedback mgbt-0">
						                            	<input type="number" class="form-control" placeholder="金額" name="balance">
						                            	<span class="form-control-feedback">円</span>
						                        	</div>
						                        </td>
											</tr>
											<tr>
												<td></td>
												<td></td>
												<td>
													<div class="form-group mgbt-0">
						                            	<input type="text" class="form-control" placeholder="費用名" name="balance">
						                        	</div>
						                        </td>
						                        <td>
													<div class="form-group has-feedback mgbt-0">
						                            	<input type="number" class="form-control" placeholder="金額" name="balance">
						                            	<span class="form-control-feedback">円</span>
						                        	</div>
						                        </td>
											</tr>
											<tr>
												<td></td>
												<td>合計</td>
												<td>
						                        </td>
						                        <td>
													<div class="text-right">0  円</div>
						                        </td>
											</tr>
											<tr>
												<td>合計</td>
												<td></td>
												<td>
						                        </td>
						                        <td>
													<div class="text-right">0  円</div>
						                        </td>
											</tr>
											<tr>
												<td>事務手数料(5.5%)</td>
												<td></td>
												<td>
						                        </td>
						                        <td>
													<div class="text-right">0  円</div>
						                        </td>
											</tr>
											<tr class="style-light-brown">
												<td>振込予定金額(内税)</td>
												<td></td>
												<td>
						                        </td>
						                        <td>
													<div class="text-right">0  円</div>
						                        </td>
											</tr>

										</tbody>
									</table>
									<p class="text-center mgt-30">
										<button type="submit" class="shadowbuttonsuccess btn btn-success">請求する</button>
									</p>
								</form>
							</div>
							<div class="col-sm-3">
								<div class="cacular-desc">
									<p class="text-center mgbt-30">
										<span class="boxred">請求済み</span>
									</p>
									<p>
										取得金額、およびその他費用を入力してください。<br>
										入力した内容は、事業者に通知されます。<br>
										取得した金額・費用を、事業者が確認完了すると、請求金額が確定します。
									</p>
								</div>
							</div>
						</div>
					</div><!-- end .col-sm-12 -->	
					<div class="col-sm-12">
						<h3 class="page-title">合計</h3>
						<div class="row boxcacular">
							<div class="col-sm-9">
								<table class="full-table">
									<tbody>
										<tr class="style-light-brown">
											<td>振込予定金額(内税)</td>
											<td></td>
											<td>
					                        </td>
					                        <td>
												<div class="text-right">0  円</div>
					                        </td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div><!-- end .col-sm-12 -->	
				</div><!-- end .row -->	
			</div><!-- end .mainpage -->
		</div><!-- end .row -->
	</div><!-- end .container -->
</div><!-- end .mainpage -->
<?php include ('../inc/footer.php'); ?>