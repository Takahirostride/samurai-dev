<?php include ('../inc/header.php'); ?>
<div class="mainpage">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<ol class="breadcrumb">
					<li><a class="bg-color" href="#">TOPページ</a></li>
					<li class="active">メッセージ</li>
				</ol>	
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">メッセージ</h1>
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
						        <a href="mypage/followlist-1.php">提案を検討</a>
						    </li>
						    <li>
						        <a href="mypage/followlist-2.php">興味あり</a>
						    </li>
						    <li class="mgr-15">
						        <a href="mypage/followlist-3.php">非表示</a>
						    </li>
						    <li class="active">
						        <a href="mypage/followlist-4.php">フォロー</a>
						    </li>
						    <li>
						        <a href="mypage/followlist-5.php">フォロワー</a>
						    </li>
						</ul><!-- end .tablinksub -->
						<div class="search-value-change">
							<div class="float-right">
								<form action="" method="POST" class="form-inline">
									<div class="form-group">
										<label for="">並び替え: </label>
										<select name="" class="form-control">
											<option value="">新着順</option>
											<option value="">取得金額が高い順</option>
											<option value="">取得金額が低い順</option>
											<option value="">マッチングが多い順（対応可能士業者数）</option>
										</select>
									</div>
									<div class="form-group">
										<label for="">表示件数: </label>
										<select name="" class="form-control">
											<option value="">10</option>
											<option value="">20</option>
											<option value="">50</option>
										</select>
									</div>
								</form>
							</div> <!-- end float-right -->
						</div> <!-- end .search-value-change -->
						<div class="row subsidy-list">
							<div class="col-sm-10">
								<div class="subsidy-list-item custompadding">
									<div class="row">
										<div class="col-sm-8">
											<div class="row">
												<div class="col-sm-3">
													<div class="avatar-100">
														<img class="img-thumbnail" src="assets/images/avatar.png" alt="">
													</div>
												</div>
												<div class="col-sm-9">
													<h3 class="text-primary mgt-0"><b>テスト</b></h3>
													<div class="itemav-info-foll">
														<table class="follow-info-rating">
															<tbody>
																<tr>
																	<th>評価:</th>
																	<td>
																		<div class="star-rating">
																			<select class="datrating" id="example-fontawesome" name="rating" autocomplete="off">
																				<option value="1">1</option>
																				<option value="2">2</option>
																				<option value="3">3</option>
																				<option value="4">4</option>
																				<option value="5">5</option>
																			</select>
																		</div> <!-- end .itemav-info -->
																	</td>
																</tr>
																<tr>
																	<th>実績:</th>
																	<td>4 件</td>
																</tr>
															</tbody>
														</table>
													</div>
												</div>
											</div>
											<div class="row">	
												<div class="col-sm-12">
													<button class="btn-primary btn-follow followcus">フォロー</button>
												</div>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="div-style-yellow3">
											    <table class="">
											        <tbody>
												        <tr>
												            <td class="td-cost-title"><b>最終依頼日 :</b></td>
												            <td class="td-cost-left">
												                <span>2018年06月22日</span>
												            </td>
												        </tr>
												        <tr>
												            <td class="td-cost-title">提案回数 :</td>
												            <td class="td-cost-left">
												                <span>30</span>回</td>
												        </tr>
												        <tr>
												            <td class="td-cost-title">募集状況 :</td>
												            <td class="td-cost-left">
												                <span>募集中</span>
												            </td>
												        </tr>
												    </tbody>
											    </table>
											    <a href="#" class="shadowbuttonsuccess btn btn-success mgt-20">依頼する施策を選ぶ</a>
											</div>
										</div>
									</div> <!-- end .row -->
								</div> <!-- end .sidylist-item -->
								<div class="subsidy-list-item custompadding">
									<div class="row">
										<div class="col-sm-8">
											<div class="row">
												<div class="col-sm-3">
													<div class="avatar-100">
														<img class="img-thumbnail" src="assets/images/avatar.png" alt="">
													</div>
												</div>
												<div class="col-sm-9">
													<h3 class="text-primary mgt-0"><b>テスト</b></h3>
													<div class="itemav-info-foll">
														<table class="follow-info-rating">
															<tbody>
																<tr>
																	<th>評価:</th>
																	<td>
																		<div class="star-rating">
																			<select class="datrating" id="example-fontawesome" name="rating" autocomplete="off">
																				<option value="1">1</option>
																				<option value="2">2</option>
																				<option value="3">3</option>
																				<option value="4">4</option>
																				<option value="5">5</option>
																			</select>
																		</div> <!-- end .itemav-info -->
																	</td>
																</tr>
																<tr>
																	<th>実績:</th>
																	<td>4 件</td>
																</tr>
															</tbody>
														</table>
													</div>
												</div>
											</div>
											<div class="row">	
												<div class="col-sm-12">
													<button class="btn-primary btn-follow followcus">フォロー</button>
												</div>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="div-style-yellow3">
											    <table class="">
											        <tbody>
												        <tr>
												            <td class="td-cost-title"><b>最終依頼日 :</b></td>
												            <td class="td-cost-left">
												                <span>2018年06月22日</span>
												            </td>
												        </tr>
												        <tr>
												            <td class="td-cost-title">提案回数 :</td>
												            <td class="td-cost-left">
												                <span>30</span>回</td>
												        </tr>
												        <tr>
												            <td class="td-cost-title">募集状況 :</td>
												            <td class="td-cost-left">
												                <span>募集中</span>
												            </td>
												        </tr>
												    </tbody>
											    </table>
											    <a href="#" class="shadowbuttonsuccess btn btn-success mgt-20">依頼する施策を選ぶ</a>
											</div>
										</div>
									</div> <!-- end .row -->
								</div> <!-- end .sidylist-item -->
								<div class="subsidy-list-item custompadding">
									<div class="row">
										<div class="col-sm-8">
											<div class="row">
												<div class="col-sm-3">
													<div class="avatar-100">
														<img class="img-thumbnail" src="assets/images/avatar.png" alt="">
													</div>
												</div>
												<div class="col-sm-9">
													<h3 class="text-primary mgt-0"><b>テスト</b></h3>
													<div class="itemav-info-foll">
														<table class="follow-info-rating">
															<tbody>
																<tr>
																	<th>評価:</th>
																	<td>
																		<div class="star-rating">
																			<select class="datrating" id="example-fontawesome" name="rating" autocomplete="off">
																				<option value="1">1</option>
																				<option value="2">2</option>
																				<option value="3">3</option>
																				<option value="4">4</option>
																				<option value="5">5</option>
																			</select>
																		</div> <!-- end .itemav-info -->
																	</td>
																</tr>
																<tr>
																	<th>実績:</th>
																	<td>4 件</td>
																</tr>
															</tbody>
														</table>
													</div>
												</div>
											</div>
											<div class="row">	
												<div class="col-sm-12">
													<button class="btn-primary btn-follow followcus">フォロー</button>
												</div>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="div-style-yellow3">
											    <table class="">
											        <tbody>
												        <tr>
												            <td class="td-cost-title"><b>最終依頼日 :</b></td>
												            <td class="td-cost-left">
												                <span>2018年06月22日</span>
												            </td>
												        </tr>
												        <tr>
												            <td class="td-cost-title">提案回数 :</td>
												            <td class="td-cost-left">
												                <span>30</span>回</td>
												        </tr>
												        <tr>
												            <td class="td-cost-title">募集状況 :</td>
												            <td class="td-cost-left">
												                <span>募集中</span>
												            </td>
												        </tr>
												    </tbody>
											    </table>
											    <a href="#" class="shadowbuttonsuccess btn btn-success mgt-20">依頼する施策を選ぶ</a>
											</div>
										</div>
									</div> <!-- end .row -->
								</div> <!-- end .sidylist-item -->
								<div class="subsidy-list-item custompadding">
									<div class="row">
										<div class="col-sm-8">
											<div class="row">
												<div class="col-sm-3">
													<div class="avatar-100">
														<img class="img-thumbnail" src="assets/images/avatar.png" alt="">
													</div>
												</div>
												<div class="col-sm-9">
													<h3 class="text-primary mgt-0"><b>テスト</b></h3>
													<div class="itemav-info-foll">
														<table class="follow-info-rating">
															<tbody>
																<tr>
																	<th>評価:</th>
																	<td>
																		<div class="star-rating">
																			<select class="datrating" id="example-fontawesome" name="rating" autocomplete="off">
																				<option value="1">1</option>
																				<option value="2">2</option>
																				<option value="3">3</option>
																				<option value="4">4</option>
																				<option value="5">5</option>
																			</select>
																		</div> <!-- end .itemav-info -->
																	</td>
																</tr>
																<tr>
																	<th>実績:</th>
																	<td>4 件</td>
																</tr>
															</tbody>
														</table>
													</div>
												</div>
											</div>
											<div class="row">	
												<div class="col-sm-12">
													<button class="btn-primary btn-follow followcus">フォロー</button>
												</div>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="div-style-yellow3">
											    <table class="">
											        <tbody>
												        <tr>
												            <td class="td-cost-title"><b>最終依頼日 :</b></td>
												            <td class="td-cost-left">
												                <span>2018年06月22日</span>
												            </td>
												        </tr>
												        <tr>
												            <td class="td-cost-title">提案回数 :</td>
												            <td class="td-cost-left">
												                <span>30</span>回</td>
												        </tr>
												        <tr>
												            <td class="td-cost-title">募集状況 :</td>
												            <td class="td-cost-left">
												                <span>募集中</span>
												            </td>
												        </tr>
												    </tbody>
											    </table>
											    <a href="#" class="shadowbuttonsuccess btn btn-success mgt-20">依頼する施策を選ぶ</a>
											</div>
										</div>
									</div> <!-- end .row -->
								</div> <!-- end .sidylist-item -->
								<div class="subsidy-list-item custompadding">
									<div class="row">
										<div class="col-sm-8">
											<div class="row">
												<div class="col-sm-3">
													<div class="avatar-100">
														<img class="img-thumbnail" src="assets/images/avatar.png" alt="">
													</div>
												</div>
												<div class="col-sm-9">
													<h3 class="text-primary mgt-0"><b>テスト</b></h3>
													<div class="itemav-info-foll">
														<table class="follow-info-rating">
															<tbody>
																<tr>
																	<th>評価:</th>
																	<td>
																		<div class="star-rating">
																			<select class="datrating" id="example-fontawesome" name="rating" autocomplete="off">
																				<option value="1">1</option>
																				<option value="2">2</option>
																				<option value="3">3</option>
																				<option value="4">4</option>
																				<option value="5">5</option>
																			</select>
																		</div> <!-- end .itemav-info -->
																	</td>
																</tr>
																<tr>
																	<th>実績:</th>
																	<td>4 件</td>
																</tr>
															</tbody>
														</table>
													</div>
												</div>
											</div>
											<div class="row">	
												<div class="col-sm-12">
													<button class="btn-primary btn-follow followcus">フォロー</button>
												</div>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="div-style-yellow3">
											    <table class="">
											        <tbody>
												        <tr>
												            <td class="td-cost-title"><b>最終依頼日 :</b></td>
												            <td class="td-cost-left">
												                <span>2018年06月22日</span>
												            </td>
												        </tr>
												        <tr>
												            <td class="td-cost-title">提案回数 :</td>
												            <td class="td-cost-left">
												                <span>30</span>回</td>
												        </tr>
												        <tr>
												            <td class="td-cost-title">募集状況 :</td>
												            <td class="td-cost-left">
												                <span>募集中</span>
												            </td>
												        </tr>
												    </tbody>
											    </table>
											    <a href="#" class="shadowbuttonsuccess btn btn-success mgt-20">依頼する施策を選ぶ</a>
											</div>
										</div>
									</div> <!-- end .row -->
								</div> <!-- end .sidylist-item -->
								<div class="subsidy-list-item custompadding">
									<div class="row">
										<div class="col-sm-8">
											<div class="row">
												<div class="col-sm-3">
													<div class="avatar-100">
														<img class="img-thumbnail" src="assets/images/avatar.png" alt="">
													</div>
												</div>
												<div class="col-sm-9">
													<h3 class="text-primary mgt-0"><b>テスト</b></h3>
													<div class="itemav-info-foll">
														<table class="follow-info-rating">
															<tbody>
																<tr>
																	<th>評価:</th>
																	<td>
																		<div class="star-rating">
																			<select class="datrating" id="example-fontawesome" name="rating" autocomplete="off">
																				<option value="1">1</option>
																				<option value="2">2</option>
																				<option value="3">3</option>
																				<option value="4">4</option>
																				<option value="5">5</option>
																			</select>
																		</div> <!-- end .itemav-info -->
																	</td>
																</tr>
																<tr>
																	<th>実績:</th>
																	<td>4 件</td>
																</tr>
															</tbody>
														</table>
													</div>
												</div>
											</div>
											<div class="row">	
												<div class="col-sm-12">
													<button class="btn-primary btn-follow followcus">フォロー</button>
												</div>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="div-style-yellow3">
											    <table class="">
											        <tbody>
												        <tr>
												            <td class="td-cost-title"><b>最終依頼日 :</b></td>
												            <td class="td-cost-left">
												                <span>2018年06月22日</span>
												            </td>
												        </tr>
												        <tr>
												            <td class="td-cost-title">提案回数 :</td>
												            <td class="td-cost-left">
												                <span>30</span>回</td>
												        </tr>
												        <tr>
												            <td class="td-cost-title">募集状況 :</td>
												            <td class="td-cost-left">
												                <span>募集中</span>
												            </td>
												        </tr>
												    </tbody>
											    </table>
											    <a href="#" class="shadowbuttonsuccess btn btn-success mgt-20">依頼する施策を選ぶ</a>
											</div>
										</div>
									</div> <!-- end .row -->
								</div> <!-- end .sidylist-item -->
								<div class="subsidy-list-item custompadding">
									<div class="row">
										<div class="col-sm-8">
											<div class="row">
												<div class="col-sm-3">
													<div class="avatar-100">
														<img class="img-thumbnail" src="assets/images/avatar.png" alt="">
													</div>
												</div>
												<div class="col-sm-9">
													<h3 class="text-primary mgt-0"><b>テスト</b></h3>
													<div class="itemav-info-foll">
														<table class="follow-info-rating">
															<tbody>
																<tr>
																	<th>評価:</th>
																	<td>
																		<div class="star-rating">
																			<select class="datrating" id="example-fontawesome" name="rating" autocomplete="off">
																				<option value="1">1</option>
																				<option value="2">2</option>
																				<option value="3">3</option>
																				<option value="4">4</option>
																				<option value="5">5</option>
																			</select>
																		</div> <!-- end .itemav-info -->
																	</td>
																</tr>
																<tr>
																	<th>実績:</th>
																	<td>4 件</td>
																</tr>
															</tbody>
														</table>
													</div>
												</div>
											</div>
											<div class="row">	
												<div class="col-sm-12">
													<button class="btn-primary btn-follow followcus">フォロー</button>
												</div>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="div-style-yellow3">
											    <table class="">
											        <tbody>
												        <tr>
												            <td class="td-cost-title"><b>最終依頼日 :</b></td>
												            <td class="td-cost-left">
												                <span>2018年06月22日</span>
												            </td>
												        </tr>
												        <tr>
												            <td class="td-cost-title">提案回数 :</td>
												            <td class="td-cost-left">
												                <span>30</span>回</td>
												        </tr>
												        <tr>
												            <td class="td-cost-title">募集状況 :</td>
												            <td class="td-cost-left">
												                <span>募集中</span>
												            </td>
												        </tr>
												    </tbody>
											    </table>
											    <a href="#" class="shadowbuttonsuccess btn btn-success mgt-20">依頼する施策を選ぶ</a>
											</div>
										</div>
									</div> <!-- end .row -->
								</div> <!-- end .sidylist-item -->
								<div class="subsidy-list-item custompadding">
									<div class="row">
										<div class="col-sm-8">
											<div class="row">
												<div class="col-sm-3">
													<div class="avatar-100">
														<img class="img-thumbnail" src="assets/images/avatar.png" alt="">
													</div>
												</div>
												<div class="col-sm-9">
													<h3 class="text-primary mgt-0"><b>テスト</b></h3>
													<div class="itemav-info-foll">
														<table class="follow-info-rating">
															<tbody>
																<tr>
																	<th>評価:</th>
																	<td>
																		<div class="star-rating">
																			<select class="datrating" id="example-fontawesome" name="rating" autocomplete="off">
																				<option value="1">1</option>
																				<option value="2">2</option>
																				<option value="3">3</option>
																				<option value="4">4</option>
																				<option value="5">5</option>
																			</select>
																		</div> <!-- end .itemav-info -->
																	</td>
																</tr>
																<tr>
																	<th>実績:</th>
																	<td>4 件</td>
																</tr>
															</tbody>
														</table>
													</div>
												</div>
											</div>
											<div class="row">	
												<div class="col-sm-12">
													<button class="btn-primary btn-follow followcus">フォロー</button>
												</div>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="div-style-yellow3">
											    <table class="">
											        <tbody>
												        <tr>
												            <td class="td-cost-title"><b>最終依頼日 :</b></td>
												            <td class="td-cost-left">
												                <span>2018年06月22日</span>
												            </td>
												        </tr>
												        <tr>
												            <td class="td-cost-title">提案回数 :</td>
												            <td class="td-cost-left">
												                <span>30</span>回</td>
												        </tr>
												        <tr>
												            <td class="td-cost-title">募集状況 :</td>
												            <td class="td-cost-left">
												                <span>募集中</span>
												            </td>
												        </tr>
												    </tbody>
											    </table>
											    <a href="#" class="shadowbuttonsuccess btn btn-success mgt-20">依頼する施策を選ぶ</a>
											</div>
										</div>
									</div> <!-- end .row -->
								</div> <!-- end .sidylist-item -->
								<div class="subsidy-list-item custompadding">
									<div class="row">
										<div class="col-sm-8">
											<div class="row">
												<div class="col-sm-3">
													<div class="avatar-100">
														<img class="img-thumbnail" src="assets/images/avatar.png" alt="">
													</div>
												</div>
												<div class="col-sm-9">
													<h3 class="text-primary mgt-0"><b>テスト</b></h3>
													<div class="itemav-info-foll">
														<table class="follow-info-rating">
															<tbody>
																<tr>
																	<th>評価:</th>
																	<td>
																		<div class="star-rating">
																			<select class="datrating" id="example-fontawesome" name="rating" autocomplete="off">
																				<option value="1">1</option>
																				<option value="2">2</option>
																				<option value="3">3</option>
																				<option value="4">4</option>
																				<option value="5">5</option>
																			</select>
																		</div> <!-- end .itemav-info -->
																	</td>
																</tr>
																<tr>
																	<th>実績:</th>
																	<td>4 件</td>
																</tr>
															</tbody>
														</table>
													</div>
												</div>
											</div>
											<div class="row">	
												<div class="col-sm-12">
													<button class="btn-primary btn-follow followcus">フォロー</button>
												</div>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="div-style-yellow3">
											    <table class="">
											        <tbody>
												        <tr>
												            <td class="td-cost-title"><b>最終依頼日 :</b></td>
												            <td class="td-cost-left">
												                <span>2018年06月22日</span>
												            </td>
												        </tr>
												        <tr>
												            <td class="td-cost-title">提案回数 :</td>
												            <td class="td-cost-left">
												                <span>30</span>回</td>
												        </tr>
												        <tr>
												            <td class="td-cost-title">募集状況 :</td>
												            <td class="td-cost-left">
												                <span>募集中</span>
												            </td>
												        </tr>
												    </tbody>
											    </table>
											    <a href="#" class="shadowbuttonsuccess btn btn-success mgt-20">依頼する施策を選ぶ</a>
											</div>
										</div>
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
							</div> <!-- end .div.col-sm-12 -->
						</div> <!-- end .row -->
					</div><!-- end .col-sm-12 -->
				</div>	<!-- end .row -->
			</div>
		</div>
	</div>
</div>
<?php include ('../inc/footer.php'); ?>