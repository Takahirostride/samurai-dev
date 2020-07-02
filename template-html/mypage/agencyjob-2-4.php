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
						<h3 class="page-title">タスク設定</h3>
					</div>
				</div>
				<form action="" method="POST" role="form">	
					<div class="row">
						<div class="col-sm-5">
							<div class="datepickertoday" id="datepicker1"></div>
						</div>
						<div class="col-sm-7">
							<table class="">
								<tbody>
									<tr>
										<td><label class="leftlablesm" for="">日程</label></td>
										<td>
											<span id="showday"></span>
											<input id="showdayinput" name="" type="hidden" value="">
										</td>
									</tr>
									<tr>
										<td><label class="leftlablesm" for="">タスク</label></td>
										<td>
											<div class="tagdonate">
												<label class="graybutton"><input type="checkbox" name="toggle"><span>書類完成日</span></label>
											</div>
											<div class="tagdonate">
												<label class="graybutton"><input type="checkbox" name="toggle"><span>提出書類</span></label>
											</div>
											<div class="tagdonate">
												<label class="graybutton"><input type="checkbox" name="toggle"><span>本申請</span></label>
											</div>
											<div class="tagdonate">
												<label class="graybutton"><input type="checkbox" name="toggle"><span>採択日</span></label>
											</div>
										</td>
									</tr>
									<tr>
										<td><label class="leftlablesm" for=""></label></td>
										<td>
											<div class="tagdonate">
												<label class="graybutton"><input type="checkbox" name="toggle"><span>受給申請</span></label>
											</div>
											<div class="tagdonate">
												<label class="graybutton"><input type="checkbox" name="toggle"><span>受給</span></label>
											</div>
											<div class="tagdonate">
												<label class="graybutton"><input type="checkbox" name="toggle"><span>確定通知書</span></label>
											</div>
											<div class="tagdonate">
												<label class="graybutton"><input type="checkbox" name="toggle"><span>支払</span></label>
											</div>
										</td>
									</tr>
									<tr>
										<td><label class="leftlablesm" for=""></label></td>
										<td>
											<div class="tagdonate">
												<label class="graybutton"><input class="checkdis" type="checkbox" name="work_content_other_value" data-tgdis="work_content_other"><span>その他</span></label>
											</div>
											<div class="tagdonate">
												<input id="work_content_other" type="text" name="work_content_other" placeholder="上記以外" disabled="">
											</div>
										</td>
									</tr>
									<tr>
										<td></td>
										<td>
											<div class="div-work-setting">
											    <label class="font12">企業より提出してもらう書類がある場合は、書類名、ファイルを設定してください。</label>
											    <div class="checkbox">
											        <label>
											          <input class="checkdis" data-tgdis="filenamed" type="checkbox"><strong>ファイルを設定しない</strong> 
											        </label>
											    </div>
											    <input id="filenamed" class="full-width" type="text" placeholder="書類名" name="filename">
											    <div class="dropfile">
											        <div id="dropbox" class="dropbox">
											        	<input class="hidefile" type="file" data-showname="filenamed" name="filename">
										                <div class="col-sm-4 full-height">
										                    <img class="drop-image" src="assets/images/fileupload.png">
										                </div>
										                <div class="col-sm-7 full-height">
										                    <p class="drop-p1">アップロードする場合は、</p>
										                    <p class="drop-p2">ここにドラッグ＆ドロップしてください。</p>
										                </div>
											        </div>
												</div>
											    <div class="row">
											        <label class="col-sm-2">提出期限
											        </label>
											        <input type="text" id="file_txt1" class="col-sm-6" placeholder="提出期限を設定できます" name="file_txt1" >
											         <div class="checkbox mgl-15">
												        <label>
												          <input type="checkbox" class="checkdis" data-tgdis="file_txt1" name="none_setting_term"><strong>期限を設定しない</strong> 
												        </label>
												    </div>
											    </div>
											</div>
										</td>
									</tr>
									<tr>
										<td><label class="leftlablesm" for="">表示設定</label></td>
										<td>
											<div class="tagdonate">
												<label class="graybutton"><input type="radio" name="display_setting1"><span>企業</span></label>
											</div>
											<div class="tagdonate">
												<label class="graybutton"><input type="radio" name="display_setting1"><span>士業</span></label>
											</div>
										</td>
									</tr>
									<tr>
										<td><label class="leftlablesm" for="">実行者</label></td>
										<td>
											<div class="tagdonate">
												<label class="graybutton"><input type="radio" name="performer1"><span>企業</span></label>
											</div>
											<div class="tagdonate">
												<label class="graybutton"><input type="radio" name="performer1"><span>士業</span></label>
											</div>
											<div class="tagdonate">
												<label class="graybutton"><input type="radio" name="performer1"><span>省庁・自治体</span></label>
											</div>
										</td>
									</tr>
									<tr>
										<td><label class="leftlablesm" for="">通知日</label></td>
										<td>
											<div class="tagdonate">
												<label class="graybutton"><input type="radio" name="notify_day1"><span>当日</span></label>
											</div>
											<div class="tagdonate">
												<label class="graybutton"><input type="radio" name="notify_day1"><span>1日前</span></label>
											</div>
											<div class="tagdonate">
												<label class="graybutton"><input type="radio" name="notify_day1"><span>2日前</span></label>
											</div>
											<div class="tagdonate">
												<label class="graybutton"><input type="radio" name="notify_day1"><span>なし</span></label>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<p class="text-center mgt-30 mgbt-50">
								<button type="submit" class="shadowbuttonsuccess btn btn-success">追加する</button>
							</p>
						</div>
					</div>
				</form>
				<div class="row">
					<div class="col-sm-12">
						<h3 class="page-title">タスク一覧</h3>
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

<script>
    $('#datepicker1').datepicker({
    	language : 'ja',
        inline: true,
        sideBySide: true,
        todayHighlight: true,
        format: "yyyy年mm月dd日",
    }).on('changeDate', function(){
    	var value = $('#datepicker1').datepicker('getFormattedDate');
    	$('#showday').text(value);
    	$('#showdayinput').val(value);
    });
</script>