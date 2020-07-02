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
							    <tr>
							        <th>日時</th>
							        <th>タイトル</th>
							        <th>事業者名</th>
							        <th>メッセージ</th>
							    </tr>
						    </thead>
						    <tbody>
							    <tr>

							        <td>○○年○○月○○日</td>
							        <td>○○○○（施策名）</td>
							        <td>○○件の質問</td>
							        <td class="td-link"><a href="#">設定・編集・掲載終了</a></td>
							    </tr>
						    </tbody>
						</table>
					</div>
				</div><!-- end .row -->
				<div class="row">
					<div class="col-sm-12">
						<table class="table table-bordered table-hover table-myjob">
						    <thead>
							    <tr>
							        <th>設定履歴</th>
							    </tr>
						    </thead>
						    <tbody>
							    <tr>
							        <td><span class="span-date">○○年○○月○○日</span>助け舟を登録しました。</td>
							    </tr>
							    <tr>
							        <td><span class="span-date">○○年○○月○○日</span>助け舟を登録しました。</td>
							    </tr>
							    <tr>
							        <td><span class="span-date">○○年○○月○○日</span>助け舟を登録しました。</td>
							    </tr>
							    <tr>
							        <td><span class="span-date">○○年○○月○○日</span>助け舟を登録しました。</td>
							    </tr>
						    </tbody>
						</table>
					</div>
				</div><!-- end .row -->
				<div class="row">
					<div class="col-sm-12">
						<table class="table table-bordered table-hover table-myjob">
						    <thead>
							    <tr>
							        <th>掲載設定</th>
							    </tr>
						    </thead>
						    <tbody>
							    <tr>
							        <td>
							        	<div class="row">
								        	<div class="col-sm-8">募集の必要がなくなった場合、掲載をキャンセルしてください。</div>
								        	<div class="col-sm-4 text-center"><a href="#" class="shadowbuttonsuccess btn btn-success">新規登録</a></div>
							        	</div>
							        </td>
							    </tr>
							    <tr>
							    	<td>
								    	<div class="row">
								        	<div class="col-sm-8">掲載が終了、掲載をキャンセルした案件を再度募集する場合は、再度掲載を行ってください。</div>
								        	<div class="col-sm-4 text-center"><a href="#" class="shadowbuttonsuccess btn btn-success">再度掲載</a></div>
							        	</div>
							        </td>
							    </tr>
						    </tbody>
						</table>
					</div>
				</div><!-- end .row -->
				<div class="row">
					<div class="col-sm-12">
						<table class="table table-bordered mgt-30">
						    <thead class="div-style-blue2">
							    <tr>
							        <th>ご依頼を不特定多数の方へみられたくない方へ</th>
							    </tr>
						    </thead>
						    <tbody>
							    <tr>
							        <td>
							        	<div class="row">
								        	<div class="col-sm-10">
								        		<div class="checkbox">
								        			<label class="text-primary"><input type="checkbox"><strong>完全非公開オプション</strong></label>
								        		</div>
								        		<p>
								        			依頼を非公開にして提案を募集することができます。<br>
													募集中は士業とクライアント（法人）しか依頼を閲覧することができず、募集終了後には当選ユーザー及び依頼したクライアントのみ閲覧することができます。<br>
													※士業が依頼詳細ページを閲覧するには本人確認と機密保持確認が必須となります。
								        		</p>
								        	</div>
								        	<div class="col-sm-2 text-right">
								        		<span class="pricetext">+10,800円</span>
								        	</div>
							        	</div>
							        </td>
							    </tr>
							    <tr>
							        <td>
							        	<div class="row">
								        	<div class="col-sm-10">
								        		<div class="checkbox">
								        			<label class="text-primary"><input type="checkbox"><strong>非公開オプション</strong></label>
								        		</div>
								        		<p>
								        			依頼を非公開にして提案を募集することができます。（非公開オプションをつけていても、士業にログインすると、表示されてしまいます。予めご了承ください。）
								        		</p>
								        	</div>
								        	<div class="col-sm-2 text-right">
								        		<span class="pricetext">+5,400円</span>
								        	</div>
							        	</div>
							        </td>
							    </tr>
						    </tbody>
						</table><!-- end table -->
						<table class="table table-bordered">
						    <thead class="div-style-blue2">
							    <tr>
							        <th>多くの依頼を提案してほしい方へ</th>
							    </tr>
						    </thead>
						    <tbody>
							    <tr>
							        <td>
							        	<div class="row">
								        	<div class="col-sm-10">
								        		<div class="checkbox">
								        			<label class="text-primary"><input type="checkbox"><strong>完全非公開オプション</strong></label>
								        		</div>
								        		<p>
								        			仕事依頼が急募であることを表示し、どの依頼よりも最優先で上位表示します。
								        		</p>
								        	</div>
								        	<div class="col-sm-2 text-right">
								        		<span class="pricetext">+10,800円</span>
								        	</div>
							        	</div>
							        </td>
							    </tr>
							    <tr>
							        <td>
							        	<div class="row">
								        	<div class="col-sm-10">
								        		<div class="checkbox">
								        			<label class="text-primary"><input type="checkbox"><strong>注目オプション</strong></label>
								        		</div>
								        		<p>
								        			仕事依頼をより多くの士業に見つけてもらえるように表示されます。多くの提案を集めることができます。
								        		</p>
								        	</div>
								        	<div class="col-sm-2 text-right">
								        		<span class="pricetext">+3,240円</span>
								        	</div>
							        	</div>
							        </td>
							    </tr>
						    </tbody>
						</table><!-- end table -->
						<table class="table table-bordered">
						    <thead class="div-style-blue2">
							    <tr>
							        <th>士業の方へダイレクトに通知します</th>
							    </tr>
						    </thead>
						    <tbody>
							    <tr>
							        <td>
							        	<div class="row">
								        	<div class="col-sm-10">
								        		<div class="checkbox">
								        			<label class="text-primary"><input type="checkbox"><strong>マイページ表示オプション</strong></label>
								        		</div>
								        		<p>
								        			士業のマイページに、お客様（法人）の依頼ページリンクが表示されます。
								        		</p>
								        	</div>
								        	<div class="col-sm-2 text-right">
								        		<span class="pricetext">+54,000円</span>
								        	</div>
							        	</div>
							        </td>
							    </tr>
							    <tr>
							        <td>
							        	<div class="row">
								        	<div class="col-sm-10">
								        		<div class="checkbox">
								        			<label class="text-primary"><input type="checkbox"><strong>認定士業への一斉通知オプション</strong></label>
								        		</div>
								        		<p>
								        			依頼内容を認定士業にメールで告知・宣伝ができます。
								        		</p>
								        	</div>
								        	<div class="col-sm-2 text-right">
								        		<span class="pricetext">+16,200円</span>
								        	</div>
							        	</div>
							        </td>
							    </tr>
							    <tr>
							        <td>
							        	<div class="row">
								        	<div class="col-sm-10">
								        		<div class="checkbox">
								        			<label class="text-primary"><input type="checkbox"><strong>士業100人への一斉通知オプション</strong></label>
								        		</div>
								        		<p>
								        			依頼内容を実績ある士業100名にメールで告知・宣伝ができます。
								        		</p>
								        	</div>
								        	<div class="col-sm-2 text-right">
								        		<span class="pricetext">+5,400円</span>
								        	</div>
							        	</div>
							        </td>
							    </tr>
						    </tbody>
						</table><!-- end table -->
					</div>
				</div><!-- end .row -->
				<div class="row">
					<div class="col-sm-12">
						<div class="div-suggestion-policy mgbt-50">
							<div class="row">
								<div class="col-sm-8">掲載中の募集案件に、有料オプションを設定します。</div>
					        	<div class="col-sm-4 text-center"><a href="#" class="shadowbuttonsuccess btn btn-success">有料オプション設定</a></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include ('../inc/footer.php'); ?>