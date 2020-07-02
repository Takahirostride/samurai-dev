<?php include ('../inc/header.php'); ?>
<?php 
$cat = array(
	1 => '雇用・人材',
	2 => '経営改善・販路開拓',
	3 => '設備導入・研究開発',
	4 => '創業・起業',
	5 => '経営環境改善',
	6 => '特許・知的財産',
	7 => '誘致関連',
);
$subcat = array(
	1 => array(
		8 => 'subcat1-1',
		9 => 'subcat1-2',
		10 => 'subcat1-3',
	),
	2 => array(
		11 => 'subcat2-1',
		12 => 'subcat2-2',
	),
	3 => array(
		13 => 'subcat3-1',
		14 => 'subcat3-2',
	),
	4 => array(
		15 => 'subcat4-1',
	),
	5 => array(
		17 => 'subcat5-1',
		18 => 'subcat5-2',
	),
	6 => array(
		19 => 'subcat6-1',
	),
	7 => array(
		21 => 'subcat7-1',
		22 => 'subcat7-2',
	),
);
$data = array(
	'category'	=>	$cat,
	'sub_category'	=>	$subcat
);
//echo json_encode($data);
?>
<div class="mainpage">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
			<?php include ('../inc/breadcrumb.php'); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">助成金・補助金の検索</h1>
				<p class="page-description">各省庁が公開している助成金・補助金の手動検索が行えます。手動検索を行い、対応可能な助成金・補助金を増やすことで、依頼数が増えます。</p>
			</div>
		</div>
		
		<div class="row">
			<div class="col-sm-2 sidebar-left">
				<h3 class="mpage-title">リスト一覧</h3>
				<p><a href="#" class="btn btn-default sidebar-btn btn-grad active">
						<strong>提案を検討リスト</strong>
					</a></p>
				<p><a href="#" class="btn btn-default btn-grad sidebar-btn">
						<strong>興味リスト</strong>
					</a></p>
				<p><a href="#" class="btn btn-default btn-grad sidebar-btn">
						<strong>非表示リスト</strong>
					</a></p>
			</div> <!-- end .sidebar-left -->

			<div class="col-sm-10 mainpage cadd">
			    <div class="col-sm-12 div-style-blue2 ">
			        <div class="row">     
			            <div class="col-sm-11">
			            <label> 
			                <input class="control-label" type="radio" id="option1" name="addway" > 登録されている施策の中から選択する  
			            </label>
			            <br> 
			            <label> 
			                <input class="control-label" type="radio" id="option2" name="addway" checked="" value="2">SAMURAIに登録されていない施策を登録する        
			            </label>
			            </div>
			        </div>
		        </div>
		        <div class="col-sm-12">
		        <div class="row div-style-yellow2">
		            <p><b>SAMURAIに掲載されていない施策を登録していただくと、事業者が閲覧できる、「士業掲示板」に掲載されます。　「士業掲示板」はSAMURAIに掲載されて
		                いない施策情報一覧ですが、その施策情報の士業掲載欄には、御社のみが表示されるため、マッチングの可能性が高くなります。</b></p>
		        </div>
		        </div>
				<div class="row subsidy-list">
					<div class="col-sm-12">
					<form method="post" action="#" enctype="multipart/form-data">
						<table class="table table-bordered dtable table-condensed">
							<tbody>
								<tr>
				                    <td class="div-style-blue2 text-primary vali-icon"><b>登録機関</b></td>
				                    <td >
				                        <div class="row">
				                            <div class="col-md-4">
				                                <div class="angularsl">
													<select class="selectpicker">
														<option value="経済産業省">経済産業省</option>
														<option value="北海道">北海道</option>
													</select>
												</div> <!-- end .angularsl -->
				                            </div>
				                            <div class="col-md-4">
				                               <div class="angularsl">
													<select class="selectpicker">
														<option value="経済産業省">経済産業省</option>
														<option value="北海道">北海道</option>
													</select>
												</div> <!-- end .angularsl -->
				                            </div>
				                        </div>
				                    </td>
				                </tr>
				                <tr>
								    <td class="div-style-blue2 text-primary vali-icon"><b>画像</b></td>
								    <td >
								        <div class="input-group file-group col-md-8">
								            <input type="text" id="img-name" class="form-control" disabled="" aria-invalid="false">
								            <div class="input-group-btn">
								                <label class="btn btn-success btn-style-shadow-green" id="btn-load-file" for="file">参照</label>
								                <input id="file" type="file" accept="image/*">
								            </div>
								        </div>
								    </td>
								</tr>
								<tr>
								    <td rowspan="1" class="div-style-blue2 text-primary">
								        <b>カテゴリー<br><br>
								            （登録施策に該当するカテゴリーを選択してください。1つ以上選択する必要があります。）</b>
								    </td>
								    <td colspan="2">
								        <div class="append_list_cart">
								            <div class="gridcell-right mb20" >
								                <div class="row">
								                    <div class="col-md-4">
								                        <div class="angularsl" id="parent-1">
															<select class="selectpicker" set-data="1" >
																<option value="1">雇用・人材</option>
																<option value="2">経営改善・販路開拓</option>
																<option value="3">設備導入・研究開発</option>
																<option value="4">創業・起業</option>
																<option value="5">経営環境改善</option>
																<option value="6">特許・知的財産</option>
																<option value="7">誘致関連</option>
															</select>
														</div> <!-- end .angularsl -->
								                    </div>
								                    <div class="col-md-8">
								                        <button class="btnic" set-data="1"><i class="fa fa-close"></i></button>
								                    </div>
								                </div>

								            </div>
								            <div class="gridcell-right" id="1">
								                <div class="row">
								                    <div class="col-md-12" >
								                        
								                    </div>
								                </div>

								            </div>
								        </div>
								        <div class="row">
								            <div class="col-md-4">
								                <a href="#" onclick="append_list_cart(); return false;" class="btn btn-success btn-style-shadow-green">新規追加</a>
								            </div>
								        </div>
								    </td>
								</tr>
								<tr>
								  <td class="div-style-blue2 text-primary"><b>タグ</b></td>
								    <td>
								        <div class="row append_list_cart-2">
								        	<div class="col-md-3">
								                <div class="tagdonate">
								                    <label class="graybutton"><input type="checkbox" name="toggle"><span>2次公募</span></label>
								                </div>
								            </div>
								            <div class="col-md-3">
								                <div class="tagdonate">
								                    <label class="graybutton"><input type="checkbox" name="toggle"><span>3次公募</span></label>
								                </div>
								            </div>
								            <div class="col-md-3">
								                <div class="tagdonate">
								                    <label class="graybutton"><input type="checkbox" name="toggle"><span>100%採択</span></label>
								                </div>
								            </div>
								            <div class="col-md-3">
								                <div class="tagdonate">
								                    <label class="graybutton"><input type="checkbox" name="toggle"><span>採択率高め</span></label>
								                </div>
								            </div>
								            <div class="col-md-3">
								                <div class="tagdonate">
								                    <label class="graybutton"><input type="checkbox" name="toggle"><span>提出資料多い</span></label>
								                </div>
								            </div>
								            <div class="col-md-3">
								                <div class="tagdonate">
								                    <label class="graybutton"><input type="checkbox" name="toggle"><span>提出資料少い</span></label>
								                </div>
								            </div>
								            <div class="col-md-3">
								                <div class="tagdonate">
								                    <label class="graybutton"><input type="checkbox" name="toggle"><span>いつでも申請可能</span></label>
								                </div>
								            </div>
								            <div class="col-md-3">
								                <div class="tagdonate">
								                    <label class="graybutton"><input type="checkbox" name="toggle"><span>採択率低め</span></label>
								                </div>
								            </div>
								            <div class="col-md-3">
								                <div class="tagdonate">
								                    <label class="graybutton"><input type="checkbox" name="toggle"><span>1次公募</span></label>
								                </div>
								            </div>
								            <div class="col-md-3">
								                <div class="tagdonate">
								                    <label class="graybutton"><input type="checkbox" name="toggle"><span>申請期間短い</span></label>
								                </div>
								            </div>
								            <div class="col-md-3">
								                <div class="tagdonate">
								                    <label class="graybutton"><input type="checkbox" name="toggle"><span>申請期間長い</span></label>
								                </div>
								            </div>
								            <div class="col-md-3">
								                <div class="tagdonate">
								                    <label class="graybutton"><input type="checkbox" name="toggle"><span>中小企業</span></label>
								                </div>
								            </div>
								            <div class="col-md-3">
								                <div class="tagdonate">
								                    <label class="graybutton"><input type="checkbox" name="toggle"><span>小規模事業者</span></label>
								                </div>
								            </div>
								            <div class="col-md-3">
								                <div class="tagdonate">
								                    <label class="graybutton"><input type="checkbox" name="toggle"><span>中小企業以外</span></label>
								                </div>
								            </div>
								            <div class="col-md-3">
								                <div class="tagdonate">
								                    <label class="graybutton"><input type="checkbox" name="toggle"><span>融資支援</span></label>
								                </div>
								            </div>
								            <div class="col-md-3">
								                <div class="tagdonate">
								                    <label class="graybutton"><input type="checkbox" name="toggle"><span>リース支援</span></label>
								                </div>
								            </div>
								            <div class="col-md-3">
								                <div class="tagdonate">
								                    <label class="graybutton"><input type="checkbox" name="toggle"><span>税制措置</span></label>
								                </div>
								            </div>
								            <div class="col-md-3">
								                <div class="tagdonate">
								                    <label class="graybutton"><input type="checkbox" name="toggle"><span>出資支援</span></label>
								                </div>
								            </div>
								            <div class="col-md-3">
								                <div class="tagdonate">
								                    <label class="graybutton"><input type="checkbox" name="toggle"><span>情報提供支援</span></label>
								                </div>
								            </div>
								            <div class="col-md-3">
								                <div class="tagdonate">
								                    <label class="graybutton"><input type="checkbox" name="toggle"><span>相談支援</span></label>
								                </div>
								            </div>
								            <div class="col-md-3">
								                <div class="tagdonate">
								                    <label class="graybutton"><input type="checkbox" name="toggle"><span>セミナー支援</span></label>
								                </div>
								            </div>
								            <div class="col-md-3">
								                <div class="tagdonate">
								                    <label class="graybutton"><input type="checkbox" name="toggle"><span>研究/開発支援</span></label>
								                </div>
								            </div>
								            <div class="col-md-3">
								                <div class="tagdonate">
								                    <label class="graybutton"><input type="checkbox" name="toggle"><span>イベント支援</span></label>
								                </div>
								            </div>
								            <div class="col-md-3">
								                <div class="tagdonate">
								                    <label class="graybutton"><input type="checkbox" name="toggle"><span>法律等支援</span></label>
								                </div>
								            </div>
								            <div class="col-md-3">
								                <div class="tagdonate">
								                    <label class="graybutton"><input type="checkbox" name="toggle"><span>知的財産支援</span></label>
								                </div>
								            </div>
								            <div class="col-md-3">
								                <div class="tagdonate">
								                    <label class="graybutton"><input type="checkbox" name="toggle"><span>販路拡大支援</span></label>
								                </div>
								            </div>
								        </div>
								    </td>
								</tr>
								<tr>
							    <td class="div-style-blue2 text-primary">
							        <b>業種</b>
							    </td>
							    <td colspan="2">
							        <div class="gridcell-right">
							            <div class="col-md-12">
							                <div>
							                    <div class="tagdonate">
							                        <label class="graybutton"><input type="checkbox" name="toggle"><span>農林水産業</span></label>
							                    </div>
							                </div>
							                <div>
							                    <div class="tagdonate">
							                        <label class="graybutton"><input type="checkbox" name="toggle"><span>運輸業，郵便業</span></label>
							                    </div>
							                </div>
							                <div>
							                    <div class="tagdonate">
							                        <label class="graybutton"><input type="checkbox" name="toggle"><span>派遣業・有料職業紹介業</span></label>
							                    </div>
							                </div>
							                <div>
							                    <div class="tagdonate">
							                        <label class="graybutton"><input type="checkbox" name="toggle"><span>IT業</span></label>
							                    </div>
							                </div>
							                <div>
							                    <div class="tagdonate">
							                        <label class="graybutton"><input type="checkbox" name="toggle"><span>情報通信業</span></label>
							                    </div>
							                </div>
							                <div>
							                    <div class="tagdonate">
							                        <label class="graybutton"><input type="checkbox" name="toggle"><span>電気・ガス・ 熱供給・水道業</span></label>
							                    </div>
							                </div>
							                <div>
							                    <div class="tagdonate">
							                        <label class="graybutton"><input type="checkbox" name="toggle"><span>製造業</span></label>
							                    </div>
							                </div>
							                <div>
							                    <div class="tagdonate">
							                        <label class="graybutton"><input type="checkbox" name="toggle"><span>建設業</span></label>
							                    </div>
							                </div>
							                <div>
							                    <div class="tagdonate">
							                        <label class="graybutton"><input type="checkbox" name="toggle"><span>鉱業，採石業， 砂利採取業</span></label>
							                    </div>
							                </div>
							                <div>
							                    <div class="tagdonate">
							                        <label class="graybutton"><input type="checkbox" name="toggle"><span>漁業</span></label>
							                    </div>
							                </div>
							                <div>
							                    <div class="tagdonate">
							                        <label class="graybutton"><input type="checkbox" name="toggle"><span>卸売業・小売業</span></label>
							                    </div>
							                </div>
							                <div>
							                    <div class="tagdonate">
							                        <label class="graybutton"><input type="checkbox" name="toggle"><span>金融業・保険業</span></label>
							                    </div>
							                </div>
							                <div>
							                    <div class="tagdonate">
							                        <label class="graybutton"><input type="checkbox" name="toggle"><span>不動産業， 物品賃貸業</span></label>
							                    </div>
							                </div>
							                <div>
							                    <div class="tagdonate">
							                        <label class="graybutton"><input type="checkbox" name="toggle"><span>協同組合</span></label>
							                    </div>
							                </div>
							                <div>
							                    <div class="tagdonate">
							                        <label class="graybutton"><input type="checkbox" name="toggle"><span>医療業</span></label>
							                    </div>
							                </div>
							                <div>
							                    <div class="tagdonate">
							                        <label class="graybutton"><input type="checkbox" name="toggle"><span>福祉業</span></label>
							                    </div>
							                </div>
							                <div>
							                    <div class="tagdonate">
							                        <label class="graybutton"><input type="checkbox" name="toggle"><span>飲食サービス業</span></label>
							                    </div>
							                </div>
							                <div>
							                    <div class="tagdonate">
							                        <label class="graybutton"><input type="checkbox" name="toggle"><span>教育，学習支援業</span></label>
							                    </div>
							                </div>
							                <div>
							                    <div class="tagdonate">
							                        <label class="graybutton"><input type="checkbox" name="toggle"><span>娯楽業</span></label>
							                    </div>
							                </div>
							                <div>
							                    <div class="tagdonate">
							                        <label class="graybutton"><input type="checkbox" name="toggle"><span>生活関連サービス業</span></label>
							                    </div>
							                </div>
							                <div>
							                    <div class="tagdonate">
							                        <label class="graybutton"><input type="checkbox" name="toggle"><span>宿泊業</span></label>
							                    </div>
							                </div>
							                <div>
							                    <div class="tagdonate">
							                        <label class="graybutton"><input type="checkbox" name="toggle"><span>学術研究，専門・ 技術サービス業</span></label>
							                    </div>
							                </div>
							                <div>
							                    <div class="tagdonate">
							                        <label class="graybutton"><input type="checkbox" name="toggle"><span>一般家庭</span></label>
							                    </div>
							                </div>
							                <div>
							                    <div class="tagdonate">
							                        <label class="graybutton"><input type="checkbox" name="toggle"><span>商店街/商工会</span></label>
							                    </div>
							                </div>
							                <div>
							                    <div class="tagdonate">
							                        <label class="graybutton"><input type="checkbox" name="toggle"><span>公務</span></label>
							                    </div>
							                </div>

							            </div>
							        </div>
							    </td>
							</tr>
							<tr>
						    <td rowspan="1" class="div-style-blue2 text-primary">
						        <b>対象企業<br><br>
						            （登録施策で必須の場合は入力してください。特に条件がない場合は、空欄で構いません。）</b>
						    </td>
						    <td colspan="2">
						        <div class="row">
						            <div class="col-sm-2">創業年数</div>
						            <div class="col-sm-2"></div>
						            <div class="col-sm-3">
						                <div class="form-group has-feedback">
						                    <input type="number" class="form-control">
						                    <span class="form-control-feedback">年</span>
						                </div>
						            </div>
						            <div class="col-sm-1 text-center">~</div>
						            <div class="col-sm-3">
						                <div class="form-group has-feedback">
						                    <input type="number" class="form-control">
						                    <span class="form-control-feedback">年</span>
						                </div>
						            </div>
						        </div>
						        <div class="row">
						            <div class="col-sm-2">従業員数</div>
						            <div class="col-sm-2">正社員</div>
						            <div class="col-sm-3">
						                <div class="form-group has-feedback">
						                    <input type="number" class="form-control">
						                    <span class="form-control-feedback">人</span>
						                </div>
						            </div>
						            <div class="col-sm-1 text-center">~</div>
						            <div class="col-sm-3">
						                <div class="form-group has-feedback">
						                    <input type="number" class="form-control">
						                    <span class="form-control-feedback">人</span>
						                </div>
						            </div>
						        </div>
						        <div class="row">
						            <div class="col-sm-2"></div>
						            <div class="col-sm-2">アルバイト</div>
						            <div class="col-sm-3">
						                <div class="form-group has-feedback">
						                    <input type="number" class="form-control">
						                    <span class="form-control-feedback">人</span>
						                </div>
						            </div>
						            <div class="col-sm-1 text-center">~</div>
						            <div class="col-sm-3">
						                <div class="form-group has-feedback">
						                    <input type="number" class="form-control">
						                    <span class="form-control-feedback">人</span>
						                </div>
						            </div>
						        </div>
						        <div class="row">
						            <div class="col-sm-2"></div>
						            <div class="col-sm-2">60歳以上</div>
						            <div class="col-sm-3">
						                <div class="form-group has-feedback">
						                    <input type="number" class="form-control">
						                    <span class="form-control-feedback">人</span>
						                </div>
						            </div>
						            <div class="col-sm-1 text-center">~</div>
						            <div class="col-sm-3">
						                <div class="form-group has-feedback">
						                    <input type="number" class="form-control">
						                    <span class="form-control-feedback">人</span>
						                </div>
						            </div>
						        </div>
						        <div class="row">
						            <div class="col-sm-2">採用予定数</div>
						            <div class="col-sm-2">正社員</div>
						            <div class="col-sm-3">
						                <div class="form-group has-feedback">
						                    <input type="number" class="form-control">
						                    <span class="form-control-feedback">人</span>
						                </div>
						            </div>
						            <div class="col-sm-1 text-center">~</div>
						            <div class="col-sm-3">
						                <div class="form-group has-feedback">
						                    <input type="number" class="form-control">
						                    <span class="form-control-feedback">人</span>
						                </div>
						            </div>
						        </div>
						        <div class="row">
						            <div class="col-sm-2"></div>
						            <div class="col-sm-2">アルバイト</div>
						            <div class="col-sm-3">
						                <div class="form-group has-feedback">
						                    <input type="number" class="form-control">
						                    <span class="form-control-feedback">人</span>
						                </div>
						            </div>
						            <div class="col-sm-1 text-center">~</div>
						            <div class="col-sm-3">
						                <div class="form-group has-feedback">
						                    <input type="number" class="form-control">
						                    <span class="form-control-feedback">人</span>
						                </div>
						            </div>
						        </div>
						        <div class="row">
						            <div class="col-sm-2">資本金</div>
						            <div class="col-sm-2"></div>
						            <div class="col-sm-3">
						                <div class="form-group has-feedback">
						                    <input type="number" class="form-control">
						                    <span class="form-control-feedback">円</span>
						                </div>
						            </div>
						            <div class="col-sm-1 text-center">~</div>
						            <div class="col-sm-3">
						                <div class="form-group has-feedback">
						                    <input type="number" class="form-control">
						                    <span class="form-control-feedback">円</span>
						                </div>
						            </div>
						        </div>
						    </td>
						</tr>
						<tr>
						    <td rowspan="1" class="div-style-blue2 text-primary"><b>対象地域</b></td>
						    <td colspan="2">
						    	<div class="box_target_area">
							    	<div class="gridcell">
							            <div class="row">
											<div class="col-md-4">
												<div class="angularsl">
													<select class="selectpicker">
														<option value="徳島県">徳島県</option>
														<option value="香川県">香川県</option>
														<option value="愛媛県">愛媛県</option>
														<option value="高知県">高知県</option>
													</select>
												</div> <!-- end .angularsl -->
											</div> <!-- end .col-xs-4 -->
											<div class="col-md-4">
												<div class="angularsl">
													<select class="form-control" multiple="multiple">
														<option value="鹿屋市">鹿屋市</option>
														<option value="枕崎市">枕崎市</option>
													</select>
												</div> <!-- end .angularsl -->
											</div> <!-- end .col-xs-4 -->
											<div class="col-md-2">
							                    <button class="btnic2"><i class="fa fa-close"></i></button>
							                </div>  
							            </div>
							        </div>
						        </div>
						        <div class="row">
						            <div class="col-md-4">
						                <a href="#" onclick="target_area(); return false;" class="btn mgt-20 button btn-success btn-style-shadow-green">新規追加</a>
						            </div>
						        </div>
						    </td>
						</tr>
						<tr>
					    <td rowspan="1" class="div-style-blue2 text-primary"><b>最終更新日</b></td>
					    <td colspan="2">
					        <div class="row">
					            <div class="col-sm-2">
					                <input class="form-control" type="number" aria-invalid="false">
					            </div>
					            <div class="col-sm-1 pdt-5">年</div>
					            <div class="col-sm-2">
					                <input class="form-control" type="number" aria-invalid="false">
					            </div>
					            <div class="col-sm-1 pdt-5">月</div>
					            <div class="col-sm-2">
					                <input class="form-control" type="number">
					            </div>
					            <div class="col-sm-1 pdt-5">日</div>
					        </div>
						    </td>
						</tr>
						<tr>
						    <td rowspan="1" class="div-style-blue2 text-primary"><b>施策名</b></td>
						    <td colspan="2">
						        <input class="form-control" type="text">
						    </td>
						</tr>
						<tr>
						    <td rowspan="1" class="div-style-blue2 text-primary"><b>施策名（サブ）</b></td>
						    <td colspan="2">
						        <input class="form-control" type="text">
						    </td>
						</tr>
						<tr>
						    <td rowspan="1" class="div-style-blue2 text-primary"><b>対象者の詳細</b></td>
						    <td colspan="2">
						        <textarea name="Text1" class="w100" rows="5"></textarea>
						    </td>
						</tr>
						<tr>
						    <td rowspan="1" class="div-style-blue2 text-primary"><b>対象者の詳細</b></td>
						    <td colspan="2">
						        <textarea name="Text2" class="w100"  rows="5"></textarea>
						    </td>
						</tr>
						<tr>
						    <td rowspan="1" class="div-style-blue2 text-primary"><b>支援内容</b></td>
						    <td colspan="2">
						        <textarea name="Text3" class="w100" rows="5"></textarea>
						    </td>
						</tr>
						<tr>
						    <td rowspan="1" class="div-style-blue2 text-primary"><b>取得可能金額設定</b></td>
						    <td colspan="2">
						        <div class="row">
						            <div class="col-md-5">
						            	<div class="angularsl">
							            	<select multiple="multiple">
							            		<option value="">取得可能金額設定</option>
							            		<option value="">100万円以下</option>
							            		<option value="">100万〜500万円以下</option>
							            		<option value="">500万〜1000円万以下</option>
							            		<option value="">1000万〜5000万以下</option>
							            		<option value="">5000万〜1億円以下</option>
							            		<option value="">1億円以上</option>
							            	</select>
						            	</div>
						            </div>
						            <div class="col-md-4">
						                <input class="form-control" type="text">
						            </div>
						        </div>
						    </td>
						</tr>
						<tr>
						    <td rowspan="1" class="div-style-blue2 text-primary"><b>支援規模</b></td>
						    <td colspan="2">
						        <div class="col-sm-12">
						        	<div class="row">
							            <div class="col-md-4 border-1-a7a7a7">
							                <div class="row">
							                    <p class="text-center">下限</p>
							                </div>
							                <div class="row">
							                    <input class="form-control" type="text" pattern="[0-9]+([\.,][0-9]+)*">
							                </div>
							            </div>
							            <div class="col-md-4 border-1-a7a7a7">
							                <div class="row">
							                    <p class="text-center">上限</p>
							                </div>
							                <div class="row">
							                    <input class="form-control" type="text" pattern="[0-9]+([\.,][0-9]+)*">
							                </div>
							            </div>
							            <div class="col-md-4 border-1-a7a7a7">
							                <div class="row">
							                    <p class="text-center">助成率</p>
							                </div>
							                <div class="row">
							                    <input class="form-control" type="text">
							                </div>
							            </div>
						            </div>
						        </div>
						        <textarea name="Text4" class="w100 mgt-20" rows="5"></textarea>
						    </td>
						</tr>
						<tr>
						    <td rowspan="1" class="div-style-blue2 text-primary"><b>募集期間</b></td>
						    <td colspan="2">
						        <textarea name="Text5" class="w100" rows="5"></textarea>
						    </td>
						</tr>
						<tr>
						    <td rowspan="1" class="div-style-blue2 text-primary"><b>対象期間</b></td>
						    <td colspan="2">
						        <textarea name="Text5" class="w100" rows="5"></textarea>
						    </td>
						</tr>
						<tr>
						    <td rowspan="1" class="div-style-blue2 text-primary"><b>採択結果</b></td>
						    <td colspan="2">
						        <input class="form-control" type="text">
						    </td>
						</tr>
						<tr>
						    <td rowspan="1" class="div-style-blue2 text-primary"><b>掲載終了日　<br>（不明な場合は、随時を選択）</b></td>
						    <td colspan="2">
						        <div class="row">
						            <div class="col-sm-2">
						                <input class="form-control" type="number">
						            </div>
						            <div class="col-sm-1 pdt-5">年</div>
						            <div class="col-sm-2">
						                <input class="form-control" type="number" >
						            </div>
						            <div class="col-sm-1 pdt-5">月</div>
						            <div class="col-sm-2">
						                <input class="form-control" type="number">
						            </div>
						            <div class="col-sm-1 pdt-5">日</div>
						            <div class="col-sm-3 pdt-5">
						            	<label>
						                <input type="checkbox" aria-invalid="false">随時</label>
						            </div>
						        </div>
						    </td>
						</tr>
						<tr>
							<td class="div-style-blue2 text-primary">pdf データ</td>
							<td class="pd0">
								<div class="">
                                <div class="col-md-5">
                                    <div class="row">
                                        <div class="line-btn">
                                            <div class="col-md-10">
                                            <input class="form-control filenamed" id="focusedInput1" value="" type="text" disabled="">
                                            <input class="hidefile1" type="file" data-showname="filenamed" name="filename1" id="filename1">
                                            </div>
                                            <div class="col-md-1">
                                                <button type="button" class="submit-delete-button" data-del="focusedInput1"><i class="fa fa-trash-o"></i></button>
                                            </div>
                                        </div>
                                        <div class="line-btn">
                                            <div class="col-md-10">
                                            <input class="form-control filenamed" id="focusedInput2" value="" type="text" disabled="">
                                            <input class="hidefile1" type="file" data-showname="filenamed" name="filename2" id="filename2">
                                            </div>
                                            <div class="col-md-1">
                                                <button type="button" class="submit-delete-button" data-del="focusedInput2"><i class="fa fa-trash-o"></i></button>
                                            </div>
                                        </div>
                                        <div class="line-btn">
                                            <div class="col-md-10">
                                            <input class="form-control filenamed" id="focusedInput3" value="" type="text" disabled="">
                                            <input class="hidefile1" type="file" data-showname="filenamed" name="filename3" id="filename3">
                                            </div>
                                            <div class="col-md-1">
                                                <button type="button" class="submit-delete-button" data-del="focusedInput3"><i class="fa fa-trash-o"></i></button>
                                            </div>
                                        </div>
                                        <div class="line-btn">
                                            <div class="col-md-10">
                                            <input class="form-control filenamed" id="focusedInput4" value="" type="text" disabled="">
                                            <input class="hidefile1" type="file" data-showname="filenamed" name="filename4" id="filename4">
                                            </div>
                                            <div class="col-md-1">
                                                <button type="button" class="submit-delete-button" data-del="focusedInput4"><i class="fa fa-trash-o"></i></button>
                                            </div>
                                        </div>
                                        <div class="line-btn">
                                            <div class="col-md-10">
                                            <input class="form-control filenamed" id="focusedInput5" value="" type="text" disabled="">
                                            <input class="hidefile1" type="file" data-showname="filenamed" name="filename5" id="filename5">
                                            </div>
                                            <div class="col-md-1">
                                                <button type="button" class="submit-delete-button" data-del="focusedInput5"><i class="fa fa-trash-o"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="row box-drop">
                                        <div id="dropbox" class="dropbox" ng-class="dropClass"><span>
                                        <img src="assets/images/fileupload.png"></span>
                                        <p>アップロードする場合は、ここに ドラッグ＆ドロップしてください。</p>
                                        <input class="hidefile1" type="file" data-showname="filenamed" name="filename" multiple="">
                                    </div>
                                    </div>
                                </div>
                                </div>
                                <div class="row">
	                                <div class="col-sm-12">
	                                	<div class="line-box-2">
		                                	<div class="col-md-5 border-right-ddd pd5">
											    <input class="form-control" placeholder="表示ファイル名" aria-invalid="false">
											</div>
											<div class="col-md-7 pd5">
					                            <input class="form-control" placeholder="登録URL">
					                        </div>
										</div>
	                                </div>
                                </div>
                                <div class="row">
	                                <div class="col-sm-12">
	                                	<div class="line-box-2">
		                                	<div class="col-md-5 border-right-ddd pd5">
											    <input class="form-control" placeholder="表示ファイル名" aria-invalid="false">
											</div>
											<div class="col-md-7 pd5">
					                            <input class="form-control" placeholder="登録URL">
					                        </div>
										</div>
	                                </div>
                                </div>
                                <div class="row">
	                                <div class="col-sm-12">
	                                	<div class="line-box-2">
		                                	<div class="col-md-5 border-right-ddd pd5">
											    <input class="form-control" placeholder="表示ファイル名" aria-invalid="false">
											</div>
											<div class="col-md-7 pd5">
					                            <input class="form-control" placeholder="登録URL">
					                        </div>
										</div>
	                                </div>
                                </div>
                                
                            </td>
						</tr>
						<tr>
						    <td rowspan="1" class="div-style-blue2 text-primary"><b>お問い合わせ<br>
								（当該施策の監督省庁などの情報があれば記載ください）</b></td>
						    <td colspan="2">
						        <textarea name="Text5" class="w100" rows="5"></textarea>
						    </td>
						</tr>
						</tbody>
						</table> <!-- end table category -->
						<div id="subcategory-list">
							
						</div> <!-- end .subcat-disp -->

						<!-- table sub category -->

						<div class="clearfix"></div>
						<div class="text-center bsearch-btn-s">
							<button type="submit" onclick="return check_validate()" class="btn btn-success btn-style-shadow-green mgr-15">適用する</button>
						       <button class="btn btn-default btn-style-shadow-grey" type="button">下書き保存</button>
						</div>

					</form>
					</div> <!-- end .div.col-sm-12 -->

				</div> <!-- end .row -->
				<div id="myModal" class="modal fade" role="dialog">
                  <div class="modal-dialog box-in box-center">
	                  <div class="modal-content box-out">
	                    <div class="row center-div">
	                        <div class="col-sm-12">
	                            <h4>ポップアップ</h4>
	                            <p>
									登録されていない施策を登録する場合には、既に登録されていないかを必ずご確認ください。
									また、登録の際には、本部で確認してから本登録されます。修正、登録、削除をする可能性があります。
									※悪質な登録に関しては、予告なくアカウント停止をさせて頂く場合があります。
	                            </p>
	                            <p class="text-right"><button class="btn btn-style-shadow-grey exit color-bule3" type="button">確認</button></p>
	                        </div>
	                    </div>
	                  </div>
                  </div>
                </div> 

			</div> <!-- end .mainpage -->
		</div> <!-- end .row -->
	</div> <!-- end .container -->
</div> <!-- end .mainpage -->
<div class="clearfix"></div>


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

		$("#option1").click(function(){
			window.location="agency/Cpart.php";
		})
		$("#option2").click(function(){
			window.location="agency/Cadd.php";
		})
		$("#file").on('change' , function(){
			var name = $(this)[0].files[0]["name"];
			$("#img-name").val(name);
		})
		var append_list_cart = function() {
			var id = ramdom(1, 100);
			html = '<div class="gridcell-right mb20" >'+
			                '<div class="row">'+
			                    '<div class="col-md-4">'+
			                        '<div class="angularsl select-click" id="parent'+id+'">'+
										'<select class="selectpicker" set-data="'+id+'">'+
											'<option value="1">雇用・人材</option>'+
											'<option value="2">経営改善・販路開拓</option>'+
											'<option value="3">設備導入・研究開発</option>'+
											'<option value="4">創業・起業</option>'+
											'<option value="5">経営環境改善</option>'+
											'<option value="6">特許・知的財産</option>'+
											'<option value="7">誘致関連</option>'+
										'</select>'+
									'</div> <!-- end .angularsl -->'+
			                    '</div>'+
			                    '<div class="col-md-8">'+
			                        '<button class="btnic" set-data="'+id+'"><i class="fa fa-close"></i></button>'+
			                    '</div>'+
			                '</div>'+
			            '</div>'+
			            '<div class="gridcell-right" id="'+id+'">'+
			                '<div class="row">'+
			                    '<div class="col-md-12" >'+
			                        
			                    '</div>'+
			                '</div>'+
			            '</div>';

			$('.append_list_cart').append(html);
		}
		function ramdom(min, max){
        return Math.floor(Math.random() * (max - min)) + min;
    	}
    	$(document).on('click', '.btnic', function() {
			$(this).closest('.gridcell-right').remove();
			var id = $(this).attr('set-data');
			$('#'+id).remove();
		});

    	$(document).on('click', '.btnic2', function() {
			$(this).closest('.gridcell').remove();
		});

		$(document).on('click', '.showoption div', function(){
			//console.log("xxx");
			var parent_id = $(this).parent().parent().attr('id');
			var cart_id = $('#'+parent_id).find('select').val();
			var id = $('#'+parent_id).find('select').attr("set-data");
			console.log(parent_id);
			loadSubAjax(cart_id, id);
		})
		//display cate/subcate
		loadSubAjax = function(catId, pos) {
			$.ajax({
				url: 'agency/get_category.json',
				dataType: 'JSON',
				success: function(json) {
					loadSubCat(json, catId, pos);
				}
			});
		}
		var loadSubCat = function(json, catId, pos) {
			json = json.sub_category[catId];
			var html ="";
			$.each(json, function(index, val) {

				html += '<div class="col-sm-3"><div class="tagdonate"><label class="graybutton">'+
				'<input type="checkbox" class="checkbox" name="subcat[]" value="'+index+'" id="check_list-'+index+'"><span>' + val+
				'</span></label></div></div>';

			});
			$('#'+pos).html(html);
		}
		var target_area = function(){
			var html ="";
			html+= '<div class="gridcell">'+
		            '<div class="row">'+
						'<div class="col-md-4">'+
							'<div class="angularsl">'+
								'<select class=" selectpicker" >'+
									'<option value="徳島県">徳島県</option>'+
									'<option value="香川県">香川県</option>'+
									'<option value="愛媛県">愛媛県</option>'+
									'<option value="高知県">高知県</option>'+
								'</select>'+
							'</div> <!-- end .angularsl -->'+
						'</div> <!-- end .col-md-4 -->'+
						'<div class="col-md-4">'+
							'<div class="angularsl">'+
								'<select class="form-control" multiple="multiple">'+
									'<option value="鹿屋市">鹿屋市</option>'+
									'<option value="枕崎市">枕崎市</option>'+
								'</select>'+
							'</div> <!-- end .angularsl -->'+
						'</div> <!-- end .col-md-4 -->'+
						'<div class="col-md-2">'+
		                    '<button class="btnic2"><i class="fa fa-close"></i></button>'+
		               ' </div> '+ 
		            '</div>'+
		       ' </div>';
		       $('.box_target_area').append(html);
		}

		$(".check-option").click(function(){
        var pos = $(this).attr("pos");
        pos = pos * 50;
        console.log(pos);
        $(".change-pos").css('margin-top', pos+"px" );
	    })

	    $('.checkdis1').click(function(){
	        var isDisabled = $('.other2').is(':disabled');
	            if (isDisabled) {
	                $('.other2').prop('disabled', false);
	            } else {
	                $('.other2').prop('disabled', true);
	            }
	    });
	    $(".other4").click(function(){
	        var check = $(this).attr("id");
	        if(check == "op3"){
	           $('#other4').prop('disabled', false);
	        } else {
	            $('#other4').prop('disabled', true);
	        }
	    })
	    $('.submit-delete-button').click(function(){
	            var id_del = $(this).attr("data-del");
	            $("#"+id_del).val("");
	    })

	    $(document).on('change', '.hidefile1', function(){
	        var obj = $(this);
	        //console.log(obj['0'].files);
	        var count = obj['0'].files.length;
	        if(count > 5){
	            alert("アップロードできるファイルは５個までです。");
	        }
	        for (var i = 0; i < 5; i++) {
	            for (var j = 1; j <= 5; j++) {
	               if($("#focusedInput"+j).val() == ""){
	                    //console.log(obj['0'].files);
	                    $("#focusedInput"+j).val(obj['0'].files[i]["name"]);
	                    //$("#filename"+j).val(obj['0'].files[i]);
	                    //console.log($("#filename"+j).val());
	                    //console.log(obj['0'].files[i]);
	                    break;
	               }
	            }
	        }
	    });
	    $('.hidefile1').on({
	        'dragover dragenter': function(e) {
	            $(this).closest('.dropbox').css('background-color', '#15b86c80');
	        },
	        drop: function(e) {
	            $(this).closest('.dropbox').css('background-color', '#fff');
	        }
	    });

	    $(document).ready(function(){
	    	console.log("xxx");
		 $('#myModal').modal("show");
		});
		function check_validate(){
			alert("すべての項目を正確に入力してください。");
			return false;
		}
	</script>
  </body>
</html