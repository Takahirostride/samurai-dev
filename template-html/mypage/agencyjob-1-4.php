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
		                    <li class="active">
		                        <a href="mypage/agencyjob-1.php">依頼・提案・募集</a>
		                    </li>
		                    <li>
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
						        <a href="mypage/agencyjob-1.php">提案中</a>
						    </li>
						    <li>
						        <a href="mypage/agencyjob-1-2.php">受けた依頼</a>
						    </li>
						    <li>
						        <a href="mypage/agencyjob-1-3.php">募集案件</a>
						    </li>
						</ul>
					</div>	<!-- end middle page -->
				</div>
				<div class="div-suggestion-policy">
					<div class="row">
						<div class="col-sm-12">
						    <form action="" method="POST" class="form-inline">
					    		<div class="form-group col-sm-10">
					    			<label class="lbangularsl" for="">表示年月：</label>
					    			<div class="angularsl pull-left">
						    			<select class="mgl-15" name="filteryear">
							                <option value="" selected="selected">すべて</option>
							                <option value="葛飾区三年以内既卒者等採用定着コース奨励金">葛飾区三年以内既卒者等採用定着コース奨励金</option>
							                <option value="横浜市 IoT 導入スタートアップ補助金">横浜市 IoT 導入スタートアップ補助金</option>
							                <option value="新事業育成資金(新企業育成貸付)">新事業育成資金(新企業育成貸付)</option>
							                <option value="中小企業海外展開チャレンジ（終了">中小企業海外展開チャレンジ（終了</option>
							                <option value="トライアルユース補助事業">トライアルユース補助事業</option>
							                <option value="産業立地資金（本社機能・支社機能・ホテル）">産業立地資金（本社機能・支社機能・ホテル）</option>
							                <option value="平成３０年度創業セミナー">平成３０年度創業セミナー</option>
							                <option value="横浜市中小企業融資制度">横浜市中小企業融資制度</option>
							                <option value="山形県元気な６次産業化ステップアップ支援事業（スモールビジネス創出支援事業）２次募集">山形県元気な６次産業化ステップアップ支援事業（スモールビジネス創出支援事業）２次募集</option>
							            </select>
						            </div>
					    		</div>
					    		<div class="form-group col-sm-2 text-right">
									<a href="#" class="shadowbuttonprimary btn btn-primary">提案一覧を見る</a>
					            </div>

					    	</form>
					    </div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<table class="table table-bordered table-hover table-myjob">
						    <thead>
							    <tr class=>
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
						    </tbody>
						</table>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<h4 class="text-primary">タイトルタイトルタイトルタイトルタイトルタイトルタイトルタイトルタイトルタイトルルタイトルルタイトル</h4>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-10">
						<table class="table table-bordered table-myjob-pr">
						    <tbody>
							    <tr>
							        <td>予算目安<span>○○％ <br>○○円</span></td>
							        <td>残り時間 <span>○日○時</span> </td>
							        <td>提案数 <span>○○件</span> </td>
							        <td>お気に入り <span>○○人</span> </td>
							        <td>閲覧数 <span>○○回 </span> </td>
							    </tr>
						    </tbody>
						</table>
						<p>
							<span class="tagshow">○○○○○○○○○（依頼番号）</span>
							<span class="tagshow">○○○○○○○○○○○○○○○○○○○○○○○（重視する点）</span>
							<span class="tagshow bg-fdfade">開始：○○○○年○○月○○日　　終了：○○○○年○○月○○日 　希望納期：○○○○年○○月○○日</span>
						</p>
						<div class="clearfix"></div>
						<table class="table table-list-mes mgt-30 mgbt-50">
						  	<tr>
						  		<th>依頼の目的</th>
						  		<td>テキストテキストテキストテキストテキテキストテキストテキストテキストテキストテキストテキストテキストテキテキストテキストテキス</td>
						  	</tr>
						  	<tr>
						  		<th>重視する点</th>
						  		<td>テキストテキストテキストテキストテキテキストテキストテキストテキストテキストテキストテキストテキストテキテキストテキストテキス</td>
						  	</tr>
						  	<tr>
						  		<th>補足説明</th>
						  		<td>テキストテキストテキストテキストテキテキストテキストテキストテキストテキストテキストテキストテキストテキテキストテキストテキス</td>
						  	</tr>
						</table>
						<form action="" method="POST">
							<table class="table table-bordered table-myjob mgt-30">
							    <thead>
								    <tr class=>
								        <th>補足説明を追加する</th>
								    </tr>
							    </thead>
							    <tbody>
								    <tr >
								        <td>
								        	<textarea name="mes" class="form-control" rows="6"></textarea>
								        </td>
								    </tr>
							    </tbody>
							</table>
							<p class="text-center mgt-30 mgbt-50">
								<button type="submit" class="shadowbuttonsuccess btn btn-success">追加する</button>
							</p>
							
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include ('../inc/footer.php'); ?>