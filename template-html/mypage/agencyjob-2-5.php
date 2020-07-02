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
					</div>	<!-- end middle page -->
				</div>
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
				</div>	
				<div class="row">
					<div class="col-sm-12">
						<h3 class="page-title">進歩状況</h3>
						<ul class="tallList">
							<li>
								<div class="text-center client-status-buttons">
									<a href="#">
									05月 16日
								        <span></span>
								        書類完成日<br>
								    </a>
								    <button type="button" class="shadowbuttonprimary status-buttons btn btn-primary">完了</button>
								</div>
							</li>
							<li>
								<div class="text-center agency-status-buttons">
									<a href="#">
									05月 16日
								        <span></span>
								        書類完成日<br>
								    </a>
								    <button type="button" class="shadowbuttonprimary status-buttons btn btn-primary">完了</button>
								</div>
							</li>
							<li>
								<div class="text-center country-status-buttons">
									<a href="#">
									05月 16日
								        <span></span>
								        書類完成日<br>
								    </a>
								    <button type="button" class="shadowbuttonprimary status-buttons btn btn-primary">完了</button>
								</div>
							</li>
							
							<li>
								<div class="text-center client-status-buttons">
									<a class="active" href="#">
									05月 16日
								        <span></span>
								        書類完成日<br>
								    </a>
								    <button type="button" class="shadowbuttonprimary status-buttons btndisabled btn btn-primary">未完了</button>
								</div>
							</li>
							<li>
								<div class="text-center agency-status-buttons">
									<a class="active" href="#">
									05月 16日
								        <span></span>
								        書類完成日<br>
								    </a>
								    <button type="button" class="shadowbuttonprimary status-buttons btndisabled btn btn-primary">未完了</button>
								</div>
							</li>
							<li>
								<div class="text-center country-status-buttons">
									<a class="active" href="#">
									05月 16日
								        <span></span>
								        書類完成日<br>
								    </a>
								    <button type="button" class="shadowbuttonprimary status-buttons btndisabled btn btn-primary">未完了</button>
								</div>
							</li>

							<li>
								<div class="text-center client-status-buttons">
									<a class="active" href="#">
									05月 16日
								        <span></span>
								        書類完成日<br>
								    </a>
								    <button type="button" class="shadowbuttonprimary status-buttons btndisabled btn btn-primary">未完了</button>
								</div>
							</li>
							<li>
								<div class="text-center agency-status-buttons">
									<a class="active" href="#">
									05月 16日
								        <span></span>
								        書類完成日<br>
								    </a>
								    <button type="button" class="shadowbuttonprimary status-buttons btndisabled btn btn-primary">未完了</button>
								</div>
							</li>
							<li>
								<div class="text-center country-status-buttons">
									<a class="active" href="#">
									05月 16日
								        <span></span>
								        書類完成日<br>
								    </a>
								    <button type="button" class="shadowbuttonprimary status-buttons btndisabled btn btn-primary">未完了</button>
								</div>
							</li>
							<li>
								<div class="text-center country-status-buttons">
								    <button type="button" class="shadowbuttonsuccess btn btn-success tallListend">未完了</button>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<h3 class="page-title">申請状況</h3>
						<table class="table table-bordered table-hover table-tallpro">
						    <thead>
							    <tr>
							        <th>ファイル名</th>
							        <th>更新日</th>
							        <th>返信期日</th>
							        <th>更新ファイル名</th>
							        <th>更新者</th>
							        <th>更新ファイル</th>
							    </tr>
						    </thead>
						    <tbody>
							    <tr>
							        <td>
							        	<p class="mgt-20">○○○○.pdf(ファイル名)</p>
							        	<p class="mgt-20 text-center"><button type="button" class="shadowbuttonprimary btndisabled btn btn-primary">未完了</button></p>
							        </td>
							        <td colspan="4">アップされたファイルはありません。</td>
							        <td>
							        	<form action="" method="POST" class="form-inline" role="form">
							        		<p class="text-center">提出期限</p>
							        		<div class="text-center">
								        		<div class="form-group">
								        			<select class="nopdsl" name="day">
														<option value="--" selected="selected"></option>
													    <option value="1">1</option>
													    <option value="2">2</option>
													    <option value="3">3</option>
													    <option value="4">4</option>
													    <option value="5">5</option>
													    <option value="6">6</option>
													    <option value="7">7</option>
													    <option value="8">8</option>
													    <option value="9">9</option>
													    <option value="10">10</option>
													    <option value="11">11</option>
													    <option value="12">12</option>
													</select>
													<label for="">月</label>
													
								        		</div>
								        		<div class="form-group">
								        			<select class="nopdsl" name="month">
														<option value="--" selected="selected"></option>
													    <option value="1">1</option>
													    <option value="2">2</option>
													    <option value="3">3</option>
													    <option value="4">4</option>
													    <option value="5">5</option>
													    <option value="6">6</option>
													    <option value="7">7</option>
													    <option value="8">8</option>
													    <option value="9">9</option>
													    <option value="10">10</option>
													    <option value="11">11</option>
													    <option value="12">12</option>
													</select>
													<label for="">日</label>
								        		</div>
								        	</div>
								        	<div class="inputfilehide">
								        		<input type="file" name="image">
								        		<span class="glyphicon glyphicon-open-file"></span>
								        	</div>
								        	<p class="text-center">
								        		<button type="submit" class="shadowbuttonprimary btn btn-primary">更新する</button>
								        	</p>
								        	
							        	</form>

							        </td>
							    </tr>
						    </tbody>
						</table>
						<table class="table table-bordered table-hover table-tallpro">
						    <thead>
							    <tr>
							        <th>ファイル名</th>
							        <th>更新日</th>
							        <th>返信期日</th>
							        <th>更新ファイル名</th>
							        <th>更新者</th>
							        <th>更新ファイル</th>
							    </tr>
						    </thead>
						    <tbody>
							    <tr>
							        <td rowspan="4">
							        	<p class="mgt-20">○○○○.pdf(ファイル名)</p>
							        	<p class="mgt-20 text-center"><button type="button" class="shadowbuttonprimary btndisabled btn btn-primary">未完了</button></p>
							        </td>
							        <td>○○年○○月○○日</td>
							        <td>○○年○○月○○日</td>
							        <td>○○○○.pdf(ファイル名)</td>
							        <td><img class="imgcircle" src="assets/images/client.png"></td>
							        <td rowspan="4">
							        	<form action="" method="POST" class="form-inline" role="form">
							        		<p class="text-center">提出期限</p>
							        		<div class="text-center">
								        		<div class="form-group">
								        			<select class="nopdsl" name="day">
														<option value="--" selected="selected"></option>
													    <option value="1">1</option>
													    <option value="2">2</option>
													    <option value="3">3</option>
													    <option value="4">4</option>
													    <option value="5">5</option>
													    <option value="6">6</option>
													    <option value="7">7</option>
													    <option value="8">8</option>
													    <option value="9">9</option>
													    <option value="10">10</option>
													    <option value="11">11</option>
													    <option value="12">12</option>
													</select>
													<label for="">月</label>
													
								        		</div>
								        		<div class="form-group">
								        			<select class="nopdsl" name="month">
														<option value="--" selected="selected"></option>
													    <option value="1">1</option>
													    <option value="2">2</option>
													    <option value="3">3</option>
													    <option value="4">4</option>
													    <option value="5">5</option>
													    <option value="6">6</option>
													    <option value="7">7</option>
													    <option value="8">8</option>
													    <option value="9">9</option>
													    <option value="10">10</option>
													    <option value="11">11</option>
													    <option value="12">12</option>
													</select>
													<label for="">日</label>
								        		</div>
								        	</div>
								        	<div class="inputfilehide">
								        		<input type="file" name="image">
								        		<span class="glyphicon glyphicon-open-file"></span>
								        	</div>
								        	<p class="text-center">
								        		<button type="submit" class="shadowbuttonprimary btn btn-primary">更新する</button>
								        	</p>
								        	
							        	</form>

							        </td>
							    </tr>
							    <tr>
							    	<td>○○年○○月○○日</td>
							        <td>○○年○○月○○日</td>
							        <td>○○○○.pdf(ファイル名)</td>
							        <td><img class="imgcircle" src="assets/images/client.png"></td>
							    </tr>
							    <tr>
							    	<td>○○年○○月○○日</td>
							        <td>○○年○○月○○日</td>
							        <td>○○○○.pdf(ファイル名)</td>
							        <td><img class="imgcircle" src="assets/images/client.png"></td>
							    </tr>
							    <tr>
							    	<td>○○年○○月○○日</td>
							        <td>○○年○○月○○日</td>
							        <td>○○○○.pdf(ファイル名)</td>
							        <td><img class="imgcircle deactive" src="assets/images/clientgrey.png"></td>
							    </tr>
						    </tbody>
						</table>
						<table class="table table-bordered table-hover table-tallpro">
						    <thead>
							    <tr>
							        <th>ファイル名</th>
							        <th>更新日</th>
							        <th>返信期日</th>
							        <th>更新ファイル名</th>
							        <th>更新者</th>
							        <th>更新ファイル</th>
							    </tr>
						    </thead>
						    <tbody>
							    <tr>
							        <td rowspan="4">
							        	<p class="mgt-20">○○○○.pdf(ファイル名)</p>
							        	<p class="mgt-20 text-center"><button type="button" class="shadowbuttonprimary btn btn-primary">完了</button></p>
							        </td>
							        <td>○○年○○月○○日</td>
							        <td>○○年○○月○○日</td>
							        <td>○○○○.pdf(ファイル名)</td>
							        <td><img class="imgcircle" src="assets/images/client.png"></td>
							        <td rowspan="4">
							        	<div class="checksuccess">
							        		<i class="fa fa-check" style="color: #0abc03"></i>完了
							        	</div>
							        </td>
							    </tr>
							    <tr>
							    	<td>○○年○○月○○日</td>
							        <td>○○年○○月○○日</td>
							        <td>○○○○.pdf(ファイル名)</td>
							        <td><img class="imgcircle" src="assets/images/client.png"></td>
							    </tr>
							    <tr>
							    	<td>○○年○○月○○日</td>
							        <td>○○年○○月○○日</td>
							        <td>○○○○.pdf(ファイル名)</td>
							        <td><img class="imgcircle" src="assets/images/client.png"></td>
							    </tr>
							    <tr>
							    	<td>○○年○○月○○日</td>
							        <td>○○年○○月○○日</td>
							        <td>○○○○.pdf(ファイル名)</td>
							        <td><img class="imgcircle deactive" src="assets/images/clientgrey.png"></td>
							    </tr>
						    </tbody>
						</table>
						
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include ('../inc/footer.php'); ?>