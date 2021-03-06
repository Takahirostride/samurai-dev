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
		</div>
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">仕事管理</h1>
			</div>
		</div>
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
				</div>
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
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<ul class="nav nav-tabs tablinksub">
						    <li>
						        <a href="mypage/agencyjob-2.php">提案中</a>
						    </li>
						    <li class="active">
						        <a href="mypage/agencyjob-2-2.php">受けた依頼</a>
						    </li>
						    <li>
						        <a href="mypage/agencyjob-2-3.php">募集案件</a>
						    </li>
						</ul>
					</div>	<!-- end middle page -->
				</div>
				<div class="row">
					<div class="col-sm-12">
						<table class="table table-bordered table-hover table-myjob">
						    <thead>
							    <tr>
							        <th>日時</th>
							        <th>タイトル</th>
							        <th>事業者名</th>
							        <th>メッセージ</th>
							    </tr>
						    </thead>
						    <tbody>
							    <tr>
							        <td>2018年08月21日</td>
							        <td class="td-link"><a href="#">平成３０年度創業セミナー</a></td>
							        <td class="td-link"><a href="#">株式会社グランドツー</a></td>
							        <td class="td-link"><a href="#">依頼送信済み</a></td>
							    </tr>
							    <tr>
							        <td>2018年08月21日</td>
							        <td class="td-link"><a href="#">平成３０年度創業セミナー</a></td>
							        <td class="td-link"><a href="#">株式会社グランドツー</a></td>
							        <td class="td-link"><a href="#">依頼送信済み</a></td>
							    </tr>
							   <tr>
							        <td>2018年08月21日</td>
							        <td class="td-link"><a href="#">平成３０年度創業セミナー</a></td>
							        <td class="td-link"><a href="#">株式会社グランドツー</a></td>
							        <td class="td-link"><a href="#">依頼送信済み</a></td>
							    </tr>
							    <tr>
							        <td>2018年08月21日</td>
							        <td class="td-link"><a href="#">平成３０年度創業セミナー</a></td>
							        <td class="td-link"><a href="#">株式会社グランドツー</a></td>
							        <td class="td-link"><a href="#">依頼送信済み</a></td>
							    </tr>
							    <tr>
							        <td>2018年08月21日</td>
							        <td class="td-link"><a href="#">平成３０年度創業セミナー</a></td>
							        <td class="td-link"><a href="#">株式会社グランドツー</a></td>
							        <td class="td-link"><a href="#">依頼送信済み</a></td>
							    </tr>
							    <tr>
							        <td>2018年08月21日</td>
							        <td class="td-link"><a href="#">平成３０年度創業セミナー</a></td>
							        <td class="td-link"><a href="#">株式会社グランドツー</a></td>
							        <td class="td-link"><a href="#">依頼送信済み</a></td>
							    </tr>
							    <tr>
							        <td>2018年08月21日</td>
							        <td class="td-link"><a href="#">平成３０年度創業セミナー</a></td>
							        <td class="td-link"><a href="#">株式会社グランドツー</a></td>
							        <td class="td-link"><a href="#">依頼送信済み</a></td>
							    </tr>
							    <tr>
							        <td>2018年08月21日</td>
							        <td class="td-link"><a href="#">平成３０年度創業セミナー</a></td>
							        <td class="td-link"><a href="#">株式会社グランドツー</a></td>
							        <td class="td-link"><a href="#">依頼送信済み</a></td>
							    </tr>
							    <tr>
							        <td>2018年08月21日</td>
							        <td class="td-link"><a href="#">平成３０年度創業セミナー</a></td>
							        <td class="td-link"><a href="#">株式会社グランドツー</a></td>
							        <td class="td-link"><a href="#">依頼送信済み</a></td>
							    </tr>
							    <tr>
							        <td>2018年08月21日</td>
							        <td class="td-link"><a href="#">平成３０年度創業セミナー</a></td>
							        <td class="td-link"><a href="#">株式会社グランドツー</a></td>
							        <td class="td-link"><a href="#">依頼送信済み</a></td>
							    </tr>

						    </tbody>
						</table>
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
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include ('../inc/footer.php'); ?>