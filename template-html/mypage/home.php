<?php include ('../inc/header.php'); ?>
<div class="mainpage">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<ol class="breadcrumb">
					<li><a class="bg-color" href="#">TOPページ</a></li>
					<li class="active">マイページ</li>
				</ol>	
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">マイページ</h1>
				<p class="page-description">マイページでは、様々な仕事の管理が可能です。ここの情報を充実させることで、対応頂く方の信頼度も上がり、スムーズに仕事が進みます。</p>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-2 sidebar-left">
			<div class="text-center">
				<div class="div-style-blue">
					<div	class="imagecenter">
						<img src="assets/images/img1.jpg" class="img-thumbnail">
					</div>
					<h3 >○○（<b>表示名</b>）</h3>
					<h3 >○○（<strong>ユーザー名</strong>）</h3>
				</div>
				<p><button type="button" class="btn btn-default sidebar-btn btn-grad active">
						<strong>マイページトップ</strong>
					</button></p>
				<p><button type="button" class="btn btn-default btn-grad sidebar-btn">
						<strong>プロフィール管理</strong>
					</button></p>
				<p><button type="button" class="btn btn-default btn-grad sidebar-btn">
						<strong>会員情報管理</strong>
					</button></p>
				<p><button type="button" class="btn btn-default btn-grad sidebar-btn">
						<strong>仕事管理</strong>
					</button></p>
				<p><button type="button" class="btn btn-default btn-grad sidebar-btn">
						<strong>メッセージ</strong>
					</button></p>
				<p><button type="button" class="btn btn-default btn-grad sidebar-btn">
						<strong>保存リスト</strong>
					</button></p>
				<p><button type="button" class="btn btn-default btn-grad sidebar-btn">
						<strong>各種認証設定</strong>
					</button></p>
				<p><button type="button" class="btn btn-default btn-grad sidebar-btn">
						<strong>支払い管理</strong>
					</button></p>
				<p><button type="button" class="btn btn-default btn-grad sidebar-btn">
						<strong>アフィリエイト管理</strong>
					</button></p>
				<p><button type="button" class="btn btn-default btn-grad sidebar-btn">
					<strong>仕事提携管理</strong>
				</button></p>
			</div>
			</div>
			<div class="col-sm-8 mainpage">
				<div class="well">
		            <div class="col-sm-8" style="padding-left: 20px">
		                <div class="text-center">
		                    <h4 class="text-primary"><b>自分のプロフィール写真を載せてみましょう</b></h4>
		                    <div class="input-group mb20">
		                        <input type="text" class="form-control" ng-model="displayprofileimagetoupload.name" disabled="" aria-invalid="false">
		                        <div class="input-group-btn">
		                            <label class="btn btn-primary" for="file">参照</label>
		                            <input id="file" type="file" accept="image/*" ngf-select="selectNewImage($files)">
		                        </div>
		                    </div>
		                    <button type="button" class="btn-primary btn" ng-click="uploadprofileimage()">保存する</button>
		                </div>
		            </div>
		            <div class="col-sm-4">
		                <div class="text-right">
		                    <div class="text-center">
		                        <img src="assets/images/img-user1.png" class="img-thumbnail">
		                    </div>
		                </div>
		            </div>
		        </div>
		        <div class="box-noti-list">
		        	<h2 class="page-title">お知らせ</h2>
		        	<dl class="bg-ecf8fc">
		        		<dt>○○月○○日</dt>
		        		<dd>テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</dd>
		        	</dl>
		        	<dl>
		        		<dt>○○月○○日</dt>
		        		<dd>テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</dd>
		        	</dl>
		        	<dl class="last">
		        		<dt>○○月○○日</dt>
		        		<dd>テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</dd>
		        	</dl>
		        	<p class="text-right "><a class="link-right" ng-click="directtoviewallnoti()">すべてのお知らせを見る</a></p>
		        </div>
		        <div class="box-2">
		        	<h2 class="page-title">お勧めの案件</h2>
	        		<div class="box-scope">
	        			<div class="">
	        				<div class="col-sm-2">
	        					<div class="text-center mgt-20">
		                        	<img src="assets/images/img1.jpg">
		                    	</div>
	        				</div>
	        				<div class="col-sm-7">
	        					<h3 class="box-scope-title">タイトルタイトルタイトルタイトル</h3>
	        					<p class="measure_text1 ng-binding">登録機関：○○○/募集時期：○○○</p>
                                <p >区内の中小企業者が事業資金を必要とする場合、低利で融資が受けられるように金融機関にあっせんします。
								中小企業事業資金融資あっせん制...</p>
	        				</div>
	        				<div class="col-sm-3">
	        					<div class="div-style-grey row rarting-user">
		                        	<div class="col-sm-4">
		                        		<div class="row">
		                        			<img src="assets/images/img1.jpg">
		                        		</div>
		                        	</div>
		                        	<div class="col-sm-8">
		                        		<p >実績：7件</p>
		                        		<div class="star-rating">
											<select id="example-fontawesome" name="rating" autocomplete="off">
							                	<option value="1">1</option>
							                	<option value="2">2</option>
							                	<option value="3">3</option>
							                	<option value="4">4</option>
							                	<option value="5">5</option>
							                </select>
										</div>
		                        		<p><button type="button" class="btn-primary btn-follow">フォロー</button></p>
		                        	</div>
		                        	
		                    	</div>
	        				</div>
	        			</div>
	        			<div class="col-sm-12">
	        				<div class="tooltips"><button type="button" class="btn btn-default btn-style-grey">
								<strong>提案を検討</strong>
							</button>
							<p class="customtooltipclass">お気に入りボタンの１つで、より興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。</p>
							</div>
							<div class="tooltips"><button type="button" class="btn btn-default btn-success">
								<strong>興味あり</strong>
								</button>
								<p class="customtooltipclass">お気に入りボタンの１つで、興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。</p>
							</div>
							<div class="tooltips"><button type="button" class="btn btn-default btn-style-grey">
								<strong>非表示</strong>
								</button>
								<p class="customtooltipclass">必要がない、自分に関係がない施策が表示された場合は、非表示としてください。非表示とすることで自動検索であなたに関連しない施策が表示されなくなります。</p>
							</div>
							<div class="btn-cost2">
                                <label class="label-cost ng-binding">融資視線：1,500万円</label>
                            </div>
	        			</div>
	        		</div>
	        		<div class="box-scope">
	        			<div class="">
	        				<div class="col-sm-2">
	        					<div class="text-center mgt-20">
		                        	<img src="assets/images/img1.jpg">
		                    	</div>
	        				</div>
	        				<div class="col-sm-7">
	        					<h3 class="box-scope-title">タイトルタイトルタイトルタイトル</h3>
	        					<p class="measure_text1 ng-binding">登録機関：○○○/募集時期：○○○</p>
                                <p >区内の中小企業者が事業資金を必要とする場合、低利で融資が受けられるように金融機関にあっせんします。
								中小企業事業資金融資あっせん制...</p>
	        				</div>
	        				<div class="col-sm-3">
	        					<div class="div-style-grey row rarting-user">
		                        	<div class="col-sm-4">
		                        		<div class="row">
		                        			<img src="assets/images/img1.jpg">
		                        		</div>
		                        	</div>
		                        	<div class="col-sm-8">
		                        		<p >実績：7件</p>
		                        		<div class="star-rating">
												<select class="datrating" id="example-fontawesome" name="rating" autocomplete="off">
													<option value="1">1</option>
													<option value="2">2</option>
													<option value="3">3</option>
													<option value="4">4</option>
													<option value="5">5</option>
												</select>
										</div> <!-- end .itemav-info -->
		                        		<p><button type="button" class="btn-primary btn-follow">フォロー</button></p>
		                        	</div>
		                        	
		                    	</div>
	        				</div>
	        			</div>
	        			<div class="col-sm-12">
	        				<div class="tooltips"><button type="button" class="btn btn-default btn-style-grey">
								<strong>提案を検討</strong>
							</button>
							<p class="customtooltipclass">お気に入りボタンの１つで、より興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。</p>
							</div>
							<div class="tooltips"><button type="button" class="btn btn-default btn-success">
								<strong>興味あり</strong>
								</button>
								<p class="customtooltipclass">お気に入りボタンの１つで、興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。</p>
							</div>
							<div class="tooltips"><button type="button" class="btn btn-default btn-style-grey">
								<strong>非表示</strong>
								</button>
								<p class="customtooltipclass">必要がない、自分に関係がない施策が表示された場合は、非表示としてください。非表示とすることで自動検索であなたに関連しない施策が表示されなくなります。</p>
							</div>
							<div class="btn-cost2">
                                <label class="label-cost ng-binding">融資視線：1,500万円</label>
                            </div>
	        			</div>
	        		</div>
	        		<div class="box-scope">
	        			<div class="">
	        				<div class="col-sm-2">
	        					<div class="text-center mgt-20">
		                        	<img src="assets/images/img1.jpg">
		                    	</div>
	        				</div>
	        				<div class="col-sm-7">
	        					<h3 class="box-scope-title">タイトルタイトルタイトルタイトル</h3>
	        					<p class="measure_text1 ng-binding">登録機関：○○○/募集時期：○○○</p>
                                <p >区内の中小企業者が事業資金を必要とする場合、低利で融資が受けられるように金融機関にあっせんします。
								中小企業事業資金融資あっせん制...</p>
	        				</div>
	        				<div class="col-sm-3">
	        					<div class="div-style-grey row rarting-user">
		                        	<div class="col-sm-4">
		                        		<div class="row">
		                        			<img src="assets/images/img1.jpg">
		                        		</div>
		                        	</div>
		                        	<div class="col-sm-8">
		                        		<p >実績：7件</p>
		                        		<div class="star-rating">
												<select class="datrating" id="example-fontawesome" name="rating" autocomplete="off">
													<option value="1">1</option>
													<option value="2">2</option>
													<option value="3">3</option>
													<option value="4">4</option>
													<option value="5">5</option>
												</select>
										</div> <!-- end .itemav-info -->

		                        		<p><button type="button" class="btn-primary btn-follow">フォロー</button></p>
		                        	</div>
		                        	
		                    	</div>
	        				</div>
	        			</div>
	        			<div class="col-sm-12">
	        				<div class="tooltips"><button type="button" class="btn btn-default btn-style-grey">
								<strong>提案を検討</strong>
							</button>
							<p class="customtooltipclass">お気に入りボタンの１つで、より興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。</p>
							</div>
							<div class="tooltips"><button type="button" class="btn btn-default btn-success">
								<strong>興味あり</strong>
								</button>
								<p class="customtooltipclass">お気に入りボタンの１つで、興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。</p>
							</div>
							<div class="tooltips"><button type="button" class="btn btn-default btn-style-grey">
								<strong>非表示</strong>
								</button>
								<p class="customtooltipclass">必要がない、自分に関係がない施策が表示された場合は、非表示としてください。非表示とすることで自動検索であなたに関連しない施策が表示されなくなります。</p>
							</div>
							<div class="btn-cost2">
                                <label class="label-cost ng-binding">融資視線：1,500万円</label>
                            </div>
	        			</div>
	        		</div>
		        </div>
		        <div class="row text-center">
					<ul class="pagination">
						<li><a href="">最初</a></li>
						<li><a href="">1</a></li>
						<li><a href="">2</a></li>
						<li class="active"><a href="">3</a></li>
						<li><a href="">最後</a></li>
					</ul>
				</div>
				<div class="box-2">
		        	<h2 class="page-title">お勧めの案件</h2>
	        		<div class="box-scope">
	        			<div class="">
	        				<div class="col-sm-2">
	        					<div class="text-center mgt-20">
		                        	<img src="assets/images/img1.jpg">
		                    	</div>
	        				</div>
	        				<div class="col-sm-7">
	        					<h3 class="box-scope-title">タイトルタイトルタイトルタイトル</h3>
	        					<p class="measure_text1 ng-binding">登録機関：○○○/募集時期：○○○</p>
                                <p >区内の中小企業者が事業資金を必要とする場合、低利で融資が受けられるように金融機関にあっせんします。
								中小企業事業資金融資あっせん制...</p>
	        				</div>
	        				<div class="col-sm-3">
	        					<div class="div-style-grey row rarting-user">
		                        	<div class="col-sm-4">
		                        		<div class="row">
		                        			<img src="assets/images/img1.jpg">
		                        		</div>
		                        	</div>
		                        	<div class="col-sm-8">
		                        		<p >実績：7件</p>
		                        		<div class="star-rating">
												<select class="datrating" id="example-fontawesome" name="rating" autocomplete="off">
													<option value="1">1</option>
													<option value="2">2</option>
													<option value="3">3</option>
													<option value="4">4</option>
													<option value="5">5</option>
												</select>
										</div> <!-- end .itemav-info -->
		                        		<p><button type="button" class="btn-primary btn-follow">フォロー</button></p>
		                        	</div>
		                        	
		                    	</div>
	        				</div>
	        			</div>
	        			<div class="col-sm-12">
	        				<div class="tooltips"><button type="button" class="btn btn-default btn-style-grey">
								<strong>提案を検討</strong>
							</button>
							<p class="customtooltipclass">お気に入りボタンの１つで、より興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。</p>
							</div>
							<div class="tooltips"><button type="button" class="btn btn-default btn-success">
								<strong>興味あり</strong>
								</button>
								<p class="customtooltipclass">お気に入りボタンの１つで、興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。</p>
							</div>
							<div class="tooltips"><button type="button" class="btn btn-default btn-style-grey">
								<strong>非表示</strong>
								</button>
								<p class="customtooltipclass">必要がない、自分に関係がない施策が表示された場合は、非表示としてください。非表示とすることで自動検索であなたに関連しない施策が表示されなくなります。</p>
							</div>
							<div class="btn-cost2">
                                <label class="label-cost ng-binding">融資視線：1,500万円</label>
                            </div>
	        			</div>
	        		</div>
	        		<div class="box-scope">
	        			<div class="">
	        				<div class="col-sm-2">
	        					<div class="text-center mgt-20">
		                        	<img src="assets/images/img1.jpg">
		                    	</div>
	        				</div>
	        				<div class="col-sm-7">
	        					<h3 class="box-scope-title">タイトルタイトルタイトルタイトル</h3>
	        					<p class="measure_text1 ng-binding">登録機関：○○○/募集時期：○○○</p>
                                <p >区内の中小企業者が事業資金を必要とする場合、低利で融資が受けられるように金融機関にあっせんします。
								中小企業事業資金融資あっせん制...</p>
	        				</div>
	        				<div class="col-sm-3">
	        					<div class="div-style-grey row rarting-user">
		                        	<div class="col-sm-4">
		                        		<div class="row">
		                        			<img src="assets/images/img1.jpg">
		                        		</div>
		                        	</div>
		                        	<div class="col-sm-8">
		                        		<p >実績：7件</p>
		                        		<div class="star-rating">
												<select class="datrating" id="example-fontawesome" name="rating" autocomplete="off">
													<option value="1">1</option>
													<option value="2">2</option>
													<option value="3">3</option>
													<option value="4">4</option>
													<option value="5">5</option>
												</select>
										</div> <!-- end .itemav-info -->
		                        		<p><button type="button" class="btn-primary btn-follow">フォロー</button></p>
		                        	</div>
		                        	
		                    	</div>
	        				</div>
	        			</div>
	        			<div class="col-sm-12">
	        				<div class="tooltips"><button type="button" class="btn btn-default btn-style-grey">
								<strong>提案を検討</strong>
							</button>
							<p class="customtooltipclass">お気に入りボタンの１つで、より興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。</p>
							</div>
							<div class="tooltips"><button type="button" class="btn btn-default btn-success">
								<strong>興味あり</strong>
								</button>
								<p class="customtooltipclass">お気に入りボタンの１つで、興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。</p>
							</div>
							<div class="tooltips"><button type="button" class="btn btn-default btn-style-grey">
								<strong>非表示</strong>
								</button>
								<p class="customtooltipclass">必要がない、自分に関係がない施策が表示された場合は、非表示としてください。非表示とすることで自動検索であなたに関連しない施策が表示されなくなります。</p>
							</div>
							<div class="btn-cost2">
                                <label class="label-cost ng-binding">融資視線：1,500万円</label>
                            </div>
	        			</div>
	        		</div>
	        		<div class="box-scope">
	        			<div class="">
	        				<div class="col-sm-2">
	        					<div class="text-center mgt-20">
		                        	<img src="assets/images/img1.jpg">
		                    	</div>
	        				</div>
	        				<div class="col-sm-7">
	        					<h3 class="box-scope-title">タイトルタイトルタイトルタイトル</h3>
	        					<p class="measure_text1 ng-binding">登録機関：○○○/募集時期：○○○</p>
                                <p >区内の中小企業者が事業資金を必要とする場合、低利で融資が受けられるように金融機関にあっせんします。
								中小企業事業資金融資あっせん制...</p>
	        				</div>
	        				<div class="col-sm-3">
	        					<div class="div-style-grey row rarting-user">
		                        	<div class="col-sm-4">
		                        		<div class="row">
		                        			<img src="assets/images/img1.jpg">
		                        		</div>
		                        	</div>
		                        	<div class="col-sm-8">
		                        		<p >実績：7件</p>
		                        		<div class="star-rating">
												<select class="datrating" id="example-fontawesome" name="rating" autocomplete="off">
													<option value="1">1</option>
													<option value="2">2</option>
													<option value="3">3</option>
													<option value="4">4</option>
													<option value="5">5</option>
												</select>
										</div> <!-- end .itemav-info -->

		                        		<p><button type="button" class="btn-primary btn-follow">フォロー</button></p>
		                        	</div>
		                    	</div>
	        				</div>
	        			</div>
	        			<div class="col-sm-12">
	        				<div class="tooltips"><button type="button" class="btn btn-warning">
								<strong>提案を検討</strong>
							</button>
							<p class="customtooltipclass">お気に入りボタンの１つで、より興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。</p>
							</div>
							<div class="tooltips"><button type="button" class="btn btn-default btn-success">
								<strong>興味あり</strong>
								</button>
								<p class="customtooltipclass">お気に入りボタンの１つで、興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。</p>
							</div>
							<div class="tooltips"><button type="button" class="btn btn-default btn-deny">
								<strong>非表示</strong>
								</button>
								<p class="customtooltipclass">必要がない、自分に関係がない施策が表示された場合は、非表示としてください。非表示とすることで自動検索であなたに関連しない施策が表示されなくなります。</p>
							</div>
							<div class="btn-cost2">
                                <label class="label-cost ng-binding">融資視線：1,500万円</label>
                            </div>
	        			</div>
	        		</div>
		        </div>
		        <div class="row text-center">
					<ul class="pagination">
						<li><a href="">最初</a></li>
						<li><a href="">1</a></li>
						<li><a href="">2</a></li>
						<li class="active"><a href="">3</a></li>
						<li><a href="">最後</a></li>
					</ul>
				</div>
				<div class="row">
					<h2 class="page-title">案件の閲覧履歴</h2>
				</div>
				<div class="row text-center">
					<ul class="pagination">
						<li><a href="">最初</a></li>
						<li><a href="">1</a></li>
						<li><a href="">2</a></li>
						<li class="active"><a href="">3</a></li>
						<li><a href="">最後</a></li>
					</ul>
				</div>
			</div>
			<div class="col-sm-2 sidebar-right">
			<div class="text-center">
				<div class="div-style-yellow no-mrg-top">
				<p class="text-demo">
					広告枠
				</p>
				</div>
				<div class="div-style-yellow">
				<p class="text-demo">
					広告枠
				</p>
				</div>
				<div class="div-style-grey text-center">
				<h4 class="text-color font14">プロフィール充実度</h4>
				<div class="progress">
					<div role="progressbar" aria-valuenow="profilecompletesetting.loyalty" aria-valuemin="0" aria-valuemax="100" style="width: 70%" class="progress-bar"> 
					</div>
				</div>
				<p><span >70<span>%</span></span></p>
				<p class="font11">プロフィールを充実させるほど、マッチング率が上がります。</p>
				<div class="">
					<div class="div-style-blue ">
						<h6 class="font12"><b class="float-left">プロフィール写真</b><span class="float-right">＋10%</span></h6>
					</div>
				</div>
				<div class="">
					<div class="div-style-blue ">
						<h6 class="font12"><b class="float-left">プロフィール写真</b><span class="float-right">＋10%</span></h6>
					</div>
				</div>
				<div class="">
					<div class="div-style-blue ">
						<h6 class="font12"><b class="float-left">○○○</b><span class="float-right">＋10%</span></h6>
					</div>
				</div>
				</div>
				<h4 class="left-border text-color font16">実績サマリー</h4>
					<div class="sidebar-item div-style-grey text-center">
						<div style="height: 75px;border-bottom:1px solid #ddd;">
							<h6 class="sidebar-subitem-left">
								<b>受託数
									<span class="sidebar-subitem-right">3</span>
								</b>
							</h6>
							<h6 class="sidebar-subitem-left">
								<b>取得率
									<span class="sidebar-subitem-right">0
										<span>%</span>
									</span>
								</b>
							</h6>
							<h6 class="sidebar-subitem-left">
								<b>取得総額
									<span class="sidebar-subitem-right">0
										<span>円</span>
									</span>
								</b>
							</h6>
							<br>
						</div>
						<div>
							<h6 class="sidebar-subitem-left" ng-click="clickviewrating()" role="button" tabindex="0">
								<b>評価
									<span class="sidebar-subitem-right">0</span>
								</b>
							</h6>
							<h6 class="sidebar-subitem-left" ng-click="clickviewrating()" role="button" tabindex="0">
								<b>評価数
									<span class="sidebar-subitem-right">0
										<span>件</span>
									</span>
								</b>
							</h6>
							<h6 class="sidebar-subitem-left" ng-click="clickviewrating()" role="button" tabindex="0">
								<b>良い評価率
									<span class="sidebar-subitem-right">0
										<span>%</span>
									</span>
								</b>
							</h6>
						</div>
					</div>
					<h4 class="left-border text-color font16">認証状況</h4>
					<div class="div-style-grey">
						<p class="left-img-icon"><img src="assets/images/user.png" alt=""><b>本人確認</b></p>
						<p class="left-img-icon"><img src="assets/images/doc.png" alt=""><b>機密保持確認</b></p>
						<p class="left-img-icon"><img src="assets/images/phone.png" alt=""><b>電話確認</b></p>
						<p class="left-img-icon"><img src="assets/images/check.png" alt=""><b>SAMURAIチェック</b></p>
					</div>
					<h4 class="left-border text-color font16">仕事状況</h4>
					<div class="div-style-grey">
						<h6 class="sidebar-subitem-left"><b>仕事状況<span class="sidebar-subitem-right">対応可能</span></b></h6>
						<h6 class="sidebar-subitem-left"><b>最終ログイン<span class="sidebar-subitem-right">0日前</span></b></h6>
					</div>
					<!-- end div.sidebar-item -->
				</div> 
			</div>
		</div>
	</div>
</div>
<?php include ('../inc/footer.php'); ?>