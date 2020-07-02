<?php include ('../../inc/header.php'); ?>
	<div class="site">
	    <header ng-controller="HeaderCtrl" class="ng-scope">
	        <!-- ngInclude: header_path -->
	        <div ng-include="header_path" class="ng-scope" style="">
	            <div class="header ng-scope">
	                <div class="header-top">
	                    <div class="pull-left">
	                        <ul>
	                            <li><a href="admin/master">マスター管理</a></li>
	                            <li class="active"><a href="admin/employee">施策データ管理</a></li>
	                        </ul>
	                    </div>
	                    <div class="pull-right">
	                        <ul>
	                            <li><a href="" class="ng-binding">ログイン者名 &nbsp; &nbsp; administrator</a></li>
	                            <li><a ng-click="logoutuser()">ログアウト</a></li>
	                        </ul>
	                    </div>
	                </div>
	                <div class="header-bottom">
	                    <ul class="navbar" style="margin-bottom:0px;">
	                        <li><a href="admin/employee">TOP</a></li>
	                        <li><a href="admin/employee/balance/sale.php">収支管理</a></li>
	                        <li><a href="admin/employee/system/advertisement.php">システム管理</a></li>
	                        <li><a href="admin/employee/customerinfo/agencylist.php">顧客情報管理</a></li>
	                        <li><a href="admin/employee/customersupport/inquiry.php">顧客対応管理</a></li>
	                        <li class="active"><a href="admin/employee/data/subsidylist.php">施策データ管理</a></li>
	                        <li><a href="admin/employee/other/affiliate.php">その他管理</a></li>
	                        <li><a href="">ver1.0 &nbsp; </a></li>
	                    </ul>
	                </div>

	                <div class="breadcrumb" style="margin-bottom:0px;">
	                    <ul>
	                        <li><a href="">施策データ管理</a><span>&gt;</span></li>
	                        <li><a>システム管理</a></li>
	                    </ul>
	                </div>
	            </div>
	        </div>
	    </header>

	    <!-- ngView: -->
	    <div ng-view="" class="ng-scope" style="">
		    <div class="content ng-scope">
		        <div class="inner-content">
		            <div class="inner-container">
		                <div class="row">
		                    <div class="col-md-3 pull-left">
		                        <div class="sidebar-left">
		                            <ul>
		                                <li><a href="admin/employee/data/subsidylist.php">助成金データ</a></li>
		                                <li><a href="admin/employee/data/subsidyagency.php">士業登録助成金データ</a></li>
		                                <li class="active"><a href="admin/employee/data/subsidyadd.php">助成金データ新規登録</a></li>
		                                <li><a href="admin/employee/data/document.php">書類管理</a></li>
		                                <li><a href="admin/employee/data/registration.php">登録募集施策</a></li>
		                            </ul>
		                        </div>
		                    </div>
		                    <div class="col-md-9 pull-right" ng-show="previewflag==0" aria-hidden="false">
		                        <div class="site-content">
		                            <label style="font-size:22px;margin-top:30px;">施策詳細データ</label>
		                        </div>

		                        <div class="site-content">

		                            <div class="add-container">
		                                <form name="subsidyform" class="ng-pristine ng-invalid ng-invalid-required ng-valid-min ng-valid-md-multiple ng-valid-pattern ng-valid-maxlength">

		                                    <div class="row">
		                                        <div class="col-md-3" style="height:272px;">
		                                            <div class="gridcell-left">
		                                                <p style="font-size:14px;">更新日</p>
		                                            </div>
		                                        </div>
		                                        <div class="col-md-9">
		                                            <div class="gridcell-right">
		                                                <div class="row">
		                                                    <div class="col-md-7" style="z-index: 0;">
		                                                        <div class="datepickertoday"></div>
		                                                    </div>
		                                                </div>
		                                            </div>
		                                        </div>
		                                    </div>

		                                    <div class="row">
		                                        <div class="col-md-3">
		                                            <div class="gridcell-left">
		                                                <p style="font-size:14px;">施策ID</p>
		                                            </div>
		                                        </div>
		                                        <div class="col-md-9">
		                                            <div class="gridcell-right" style="height:40px;">
		                                                <p style="font-size:14px;    padding-top: 6px; " class="ng-binding">自動で割り当てる</p>
		                                            </div>
		                                        </div>
		                                    </div>

		                                    <!-- ngIf: scarapurldisplayfalg -->

		                                    <div class="row">
		                                        <div class="col-md-3">
		                                            <div class="gridcell-left">
		                                                <p style="font-size:14px;">画像ID</p>
		                                            </div>

		                                        </div>
		                                        <div class="col-md-9">
		                                            <div class="gridcell-right">
		                                                <div class="input-group">
		                                                    <input type="text" class="form-control ng-pristine ng-untouched ng-valid ng-empty" ng-model="displayimagetoupload.name" disabled="" aria-invalid="false">
		                                                    <div class="input-group-btn" style="padding-left: 10px;">
		                                                        <label class="btn submit-blue-left" for="file" style="width: 100px;">参照</label>
		                                                        <input id="file" type="file" style="display: none;" accept="image/*" ngf-select="selectNewImage($files)">
		                                                    </div>
		                                                    <div class="input-group-btn" style="padding-left: 10px;">
		                                                        <label class="btn submit-blue-left" style="width: 100px;" ng-click="showImage()" role="button" tabindex="0">表示</label>
		                                                    </div>
		                                                </div>
		                                            </div>
		                                        </div>
		                                    </div>

		                                    <div class="row">
		                                        <div class="col-md-3">
		                                            <div class="gridcell-left">
		                                                <p style="font-size:14px;">発行機関</p>
		                                            </div>
		                                        </div>
		                                        <div class="col-md-9">
		                                            <div class="gridcell-right" style="height:40px;">
		                                                <div class="row">
		                                                    <div class="col-md-4">
		                                                        <div class="angularsl">
			                                                        <select name="location"> 
			                                                            <option value="1">都道府県</option>
																		<option value="2">中小企業庁</option>
																		<option value="3">総務省</option>
																		<option value="4">厚生労働省</option>
																		<option value="5">農林水産省</option>
																		<option value="6">経済産業省</option>
																		<option value="7">その他</option>
																		<option value="8">北海道</option>
																		<option value="9">青森県</option>
																		<option value="10">岩手県</option>
																		<option value="11">宮城県</option>
																		<option value="12">秋田県</option>
																		<option value="13">山形県</option>
																		<option value="14">福島県</option>
																		<option value="15">茨城県</option>
																		<option value="16">栃木県</option>
																		<option value="17">群馬県</option>
																		<option value="18">埼玉県</option>
																		<option value="19">千葉県</option>
																		<option value="20">東京都</option>
																		<option value="21">神奈川県</option>
																		<option value="22">新潟県</option>
																		<option value="23">富山県</option>
																		<option value="24">石川県</option>
																		<option value="25">福井県</option>
																		<option value="26">山梨県</option>
																		<option value="27">長野県</option>
																		<option value="28">岐阜県</option>
																		<option value="29">静岡県</option>
																		<option value="30">愛知県</option>
																		<option value="31">三重県</option>
																		<option value="32">滋賀県</option>
																		<option value="33">京都府</option>
																		<option value="34">大阪府</option>
																		<option value="35">兵庫県</option>
																		<option value="36">奈良県</option>
																		<option value="37">和歌山県</option>
																		<option value="38">鳥取県</option>
																		<option value="39">島根県</option>
																		<option value="40">岡山県</option>
																		<option value="41">広島県</option>
																		<option value="42">山口県</option>
																		<option value="43">徳島県</option>
																		<option value="44">香川県</option>
																		<option value="45">愛媛県</option>
																		<option value="46">高知県</option>
																		<option value="47">福岡県</option>
																		<option value="48">佐賀県</option>
																		<option value="49">長崎県</option>
																		<option value="50">熊本県</option>
																		<option value="51">大分県</option>
																		<option value="52">宮崎県</option>
																		<option value="53">鹿児島県</option>
																		<option value="54">沖縄県</option>
																	</select>
																</div>
		                                                    </div>
		                                                    <div class="col-md-1"></div>
		                                                    <div class="col-md-4">
		                                                    	<div class="angularsl">
			                                                        <select name="location"> 
			                                                            <option value="1">市区町村</option> 
																	</select>
																</div> 
		                                                    </div>
		                                                </div>
		                                            </div>
		                                        </div>
		                                    </div>

		                                    <div class="row">
		                                        <div class="col-md-3" style="height:160px;">
		                                            <div class="gridcell-left">
		                                                <p style="font-size:14px;position: relative;top:40%;">対象地域</p>
		                                            </div>
		                                        </div>
		                                        <div class="col-md-9" style="height:160px;overflow-y:auto;border-bottom: #000000 1px solid;">
		                                            <!-- ngRepeat: regionitem in regionlist -->
		                                            <div class="gridcell-right ng-scope" ng-repeat="regionitem in regionlist">
		                                                <div class="row">
		                                                    <div class="col-md-4" style="z-index: 1;">
		                                                    	<div class="angularsl">
			                                                        <select name="location"> 
			                                                            <option value="1">全国</option> 
			                                                            <option value="2">北海道</option> 
			                                                            <option value="3">青森県</option> 
			                                                            <option value="4">岩手県</option> 
			                                                            <option value="5">宮城県</option> 
																	</select>
																</div> 
		                                                    </div>
		                                                    <div class="col-md-1"></div>
		                                                    <div class="col-md-4" style="z-index: 1;">
		                                                    	<div class="angularsl">
			                                                        <select name="location"> 
			                                                            <option value="1">市区町村</option>  
																	</select>
																</div>  
		                                                    </div>
		                                                    <!-- ngIf: $index != 0 -->
		                                                </div>
		                                            </div>
		                                            <!-- end ngRepeat: regionitem in regionlist -->
		                                            <div class="row">
		                                                <div class="col-md-4">
		                                                    <button type="button" class="submit-blue-left" style="width:100px;" ng-click="addRegion()">新規追加</button>
		                                                </div>
		                                            </div>
		                                        </div>
		                                    </div>

		                                    <div class="row">
		                                        <div class="col-md-3">
		                                            <div class="gridcell-left">
		                                                <p style="font-size:14px;">立地・誘致関連</p>
		                                            </div>
		                                        </div>
		                                        <div class="col-md-9">
		                                            <div class="gridcell-right" style="height:40px;">
		                                                <input type="checkbox" ng-model="locationsidy" class="ng-pristine ng-untouched ng-valid ng-empty" aria-invalid="false">誘致関連施策 &nbsp; &nbsp; &nbsp;
		                                            </div>
		                                        </div>
		                                    </div>

		                                    <div class="row">
		                                        <div class="col-md-3">
		                                            <div class="gridcell-left">
		                                                <p style="font-size:14px;">施策名</p>
		                                            </div>
		                                        </div>
		                                        <div class="col-md-9">
		                                            <div class="gridcell-right">
		                                                <input class="form-control ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required" id="focusedInput" type="text" ng-model="subsidyname" required="" ng-class="{submitted:subsidyform.submitted}" aria-invalid="true">
		                                            </div>
		                                        </div>
		                                    </div>

		                                    <div class="row">
		                                        <div class="col-md-3">
		                                            <div class="gridcell-left">
		                                                <p style="font-size:14px;">施策名（サブ）</p>
		                                            </div>
		                                        </div>
		                                        <div class="col-md-9">
		                                            <div class="gridcell-right">
		                                                <input class="form-control ng-pristine ng-untouched ng-valid ng-empty" id="focusedInput" type="text" ng-model="subsidynamesub" aria-invalid="false">
		                                            </div>
		                                        </div>
		                                    </div>

		                                    <div class="row">
		                                        <div class="col-md-3" style="height:122px;">
		                                            <div class="gridcell-left">
		                                                <p style="font-size:14px;position: relative;top:40%;">目的</p>
		                                            </div>
		                                        </div>
		                                        <div class="col-md-9">
		                                            <div class="gridcell-right">
		                                                <textarea name="Text1" style="width:100%;" rows="5" ng-model="purpose" required="" ng-class="{submitted:subsidyform.submitted}" class="ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required" aria-invalid="true"></textarea>
		                                            </div>
		                                        </div>
		                                    </div>

		                                    <div class="row">
		                                        <div class="col-md-3" style="height:160px;">
		                                            <div class="gridcell-left">
		                                                <p style="font-size:14px;position: relative;top:40%;">カテゴリー</p>
		                                            </div>
		                                        </div>
		                                        <div class="col-md-9" style="height:160px;overflow-y:auto;border-bottom: #000000 1px solid;">
		                                            <!-- ngRepeat: categoryitem in categoryitemlist -->
		                                            <div ng-repeat="categoryitem in categoryitemlist" class="ng-scope">
		                                                <div class="gridcell-right">
		                                                    <div class="row">
		                                                        <div class="col-md-4">
		                                                            <div class="angularsl">
				                                                        <select name="location"> 
				                                                            <option value="1">雇用・人材</option>
																			<option value="2">経営改善・販路開拓</option>
																			<option value="3">設備導入・研究開発</option>
																			<option value="4">創業・起業</option>
																			<option value="5">経営環境改善</option>
																			<option value="6">特許・知的財産</option>
																			<option value="7">誘致関連</option>
				                                                        </select>
				                                                    </div> 
		                                                        </div>
		                                                        <div class="col-md-8">
		                                                            <span class="glyphicon glyphicon-remove-circle" style="float:right;font-size:24px;" ng-click="removecategoryitem($index)" role="button" tabindex="0"></span>
		                                                        </div>
		                                                    </div>

		                                                </div>
		                                                <div class="gridcell-right">
		                                                    <div class="row">
		                                                        <div class="col-md-12">
		                                                            <!-- ngRepeat: subarrayitem in categoryitem.subarray -->
		                                                        </div>
		                                                    </div>

		                                                </div>
		                                            </div>
		                                            <!-- end ngRepeat: categoryitem in categoryitemlist -->
		                                            <div class="row">
		                                                <div class="col-md-4">
		                                                    <button type="button" class="submit-blue-left" style="width:100px;" ng-click="addCategory()">新規追加</button>
		                                                </div>
		                                            </div>
		                                        </div>
		                                    </div>

		                                    <div class="row">
		                                        <div class="col-md-3" style="height:162px;">
		                                            <div class="gridcell-left">
		                                                <p style="font-size:14px;">タグ</p>
		                                            </div>
		                                        </div>
		                                        <div class="col-md-9">
		                                            <div class="gridcell-right" style="height:162px;overflow:auto;">
		                                                <div class="row">
		                                                    <!-- ngRepeat: tagitem in downedtaglist track by $index -->
		                                                    <div ng-repeat="tagitem in downedtaglist track by $index" class="ng-scope" style="">
		                                                        <div id="tagdonate">
		                                                            <label class="graybutton" style="width:auto;">
		                                                                <input type="checkbox" name="toggle" ng-checked="existhopeparttags(tagitem)" ng-click="clickhopeparttags(tagitem)"><span class="ng-binding">2次公募</span></label>
		                                                        </div> 
		                                                    </div>
		                                                    <!-- end ngRepeat: tagitem in downedtaglist track by $index -->
		                                                    <div ng-repeat="tagitem in downedtaglist track by $index" class="ng-scope">
		                                                        <div id="tagdonate">
		                                                            <label class="graybutton" style="width:auto;">
		                                                                <input type="checkbox" name="toggle" ng-checked="existhopeparttags(tagitem)" ng-click="clickhopeparttags(tagitem)"><span class="ng-binding">3次公募</span></label>
		                                                        </div> 
		                                                    </div>
		                                                    <!-- end ngRepeat: tagitem in downedtaglist track by $index -->
		                                                    <div ng-repeat="tagitem in downedtaglist track by $index" class="ng-scope">
		                                                        <div id="tagdonate">
		                                                            <label class="graybutton" style="width:auto;">
		                                                                <input type="checkbox" name="toggle" ng-checked="existhopeparttags(tagitem)" ng-click="clickhopeparttags(tagitem)"><span class="ng-binding">100%採択</span></label>
		                                                        </div> 
		                                                    </div>
		                                                    <!-- end ngRepeat: tagitem in downedtaglist track by $index -->
		                                                    <div ng-repeat="tagitem in downedtaglist track by $index" class="ng-scope">
		                                                        <div id="tagdonate">
		                                                            <label class="graybutton" style="width:auto;">
		                                                                <input type="checkbox" name="toggle" ng-checked="existhopeparttags(tagitem)" ng-click="clickhopeparttags(tagitem)"><span class="ng-binding">採択率高め</span></label>
		                                                        </div> 
		                                                    </div>
		                                                    <!-- end ngRepeat: tagitem in downedtaglist track by $index -->
		                                                    <div ng-repeat="tagitem in downedtaglist track by $index" class="ng-scope">
		                                                        <div id="tagdonate">
		                                                            <label class="graybutton" style="width:auto;">
		                                                                <input type="checkbox" name="toggle" ng-checked="existhopeparttags(tagitem)" ng-click="clickhopeparttags(tagitem)"><span class="ng-binding">提出資料多い</span></label>
		                                                        </div> 
		                                                    </div>
		                                                    <!-- end ngRepeat: tagitem in downedtaglist track by $index -->
		                                                    <div ng-repeat="tagitem in downedtaglist track by $index" class="ng-scope">
		                                                        <div id="tagdonate">
		                                                            <label class="graybutton" style="width:auto;">
		                                                                <input type="checkbox" name="toggle" ng-checked="existhopeparttags(tagitem)" ng-click="clickhopeparttags(tagitem)"><span class="ng-binding">提出資料少い</span></label>
		                                                        </div>
		                                                        
		                                                    </div>
		                                                    <!-- end ngRepeat: tagitem in downedtaglist track by $index -->
		                                                    <div ng-repeat="tagitem in downedtaglist track by $index" class="ng-scope">
		                                                        <div id="tagdonate">
		                                                            <label class="graybutton" style="width:auto;">
		                                                                <input type="checkbox" name="toggle" ng-checked="existhopeparttags(tagitem)" ng-click="clickhopeparttags(tagitem)"><span class="ng-binding">いつでも申請可能</span></label>
		                                                        </div>
		                                                        
		                                                    </div>
		                                                    <!-- end ngRepeat: tagitem in downedtaglist track by $index -->
		                                                    <div ng-repeat="tagitem in downedtaglist track by $index" class="ng-scope">
		                                                        <div id="tagdonate">
		                                                            <label class="graybutton" style="width:auto;">
		                                                                <input type="checkbox" name="toggle" ng-checked="existhopeparttags(tagitem)" ng-click="clickhopeparttags(tagitem)"><span class="ng-binding">採択率低め</span></label>
		                                                        </div>
		                                                        
		                                                    </div>
		                                                    <!-- end ngRepeat: tagitem in downedtaglist track by $index -->
		                                                    <div ng-repeat="tagitem in downedtaglist track by $index" class="ng-scope">
		                                                        <div id="tagdonate">
		                                                            <label class="graybutton" style="width:auto;">
		                                                                <input type="checkbox" name="toggle" ng-checked="existhopeparttags(tagitem)" ng-click="clickhopeparttags(tagitem)"><span class="ng-binding">1次公募</span></label>
		                                                        </div>
		                                                        
		                                                    </div>
		                                                    <!-- end ngRepeat: tagitem in downedtaglist track by $index -->
		                                                    <div ng-repeat="tagitem in downedtaglist track by $index" class="ng-scope">
		                                                        <div id="tagdonate">
		                                                            <label class="graybutton" style="width:auto;">
		                                                                <input type="checkbox" name="toggle" ng-checked="existhopeparttags(tagitem)" ng-click="clickhopeparttags(tagitem)"><span class="ng-binding">申請期間短い</span></label>
		                                                        </div>
		                                                        
		                                                    </div>
		                                                    <!-- end ngRepeat: tagitem in downedtaglist track by $index -->
		                                                    <div ng-repeat="tagitem in downedtaglist track by $index" class="ng-scope">
		                                                        <div id="tagdonate">
		                                                            <label class="graybutton" style="width:auto;">
		                                                                <input type="checkbox" name="toggle" ng-checked="existhopeparttags(tagitem)" ng-click="clickhopeparttags(tagitem)"><span class="ng-binding">申請期間長い</span></label>
		                                                        </div>
		                                                        
		                                                    </div>
		                                                    <!-- end ngRepeat: tagitem in downedtaglist track by $index -->
		                                                    <div ng-repeat="tagitem in downedtaglist track by $index" class="ng-scope">
		                                                        <div id="tagdonate">
		                                                            <label class="graybutton" style="width:auto;">
		                                                                <input type="checkbox" name="toggle" ng-checked="existhopeparttags(tagitem)" ng-click="clickhopeparttags(tagitem)"><span class="ng-binding">中小企業</span></label>
		                                                        </div>
		                                                        
		                                                    </div>
		                                                    <!-- end ngRepeat: tagitem in downedtaglist track by $index -->
		                                                    <div ng-repeat="tagitem in downedtaglist track by $index" class="ng-scope">
		                                                        <div id="tagdonate">
		                                                            <label class="graybutton" style="width:auto;">
		                                                                <input type="checkbox" name="toggle" ng-checked="existhopeparttags(tagitem)" ng-click="clickhopeparttags(tagitem)"><span class="ng-binding">小規模事業者</span></label>
		                                                        </div>
		                                                        
		                                                    </div>
		                                                    <!-- end ngRepeat: tagitem in downedtaglist track by $index -->
		                                                    <div ng-repeat="tagitem in downedtaglist track by $index" class="ng-scope">
		                                                        <div id="tagdonate">
		                                                            <label class="graybutton" style="width:auto;">
		                                                                <input type="checkbox" name="toggle" ng-checked="existhopeparttags(tagitem)" ng-click="clickhopeparttags(tagitem)"><span class="ng-binding">中小企業以外</span></label>
		                                                        </div>
		                                                        
		                                                    </div>
		                                                    <!-- end ngRepeat: tagitem in downedtaglist track by $index -->
		                                                    <div ng-repeat="tagitem in downedtaglist track by $index" class="ng-scope">
		                                                        <div id="tagdonate">
		                                                            <label class="graybutton" style="width:auto;">
		                                                                <input type="checkbox" name="toggle" ng-checked="existhopeparttags(tagitem)" ng-click="clickhopeparttags(tagitem)"><span class="ng-binding">融資支援</span></label>
		                                                        </div>
		                                                        
		                                                    </div>
		                                                    <!-- end ngRepeat: tagitem in downedtaglist track by $index -->
		                                                    <div ng-repeat="tagitem in downedtaglist track by $index" class="ng-scope">
		                                                        <div id="tagdonate">
		                                                            <label class="graybutton" style="width:auto;">
		                                                                <input type="checkbox" name="toggle" ng-checked="existhopeparttags(tagitem)" ng-click="clickhopeparttags(tagitem)"><span class="ng-binding">リース支援</span></label>
		                                                        </div>
		                                                        
		                                                    </div>
		                                                    <!-- end ngRepeat: tagitem in downedtaglist track by $index -->
		                                                    <div ng-repeat="tagitem in downedtaglist track by $index" class="ng-scope">
		                                                        <div id="tagdonate">
		                                                            <label class="graybutton" style="width:auto;">
		                                                                <input type="checkbox" name="toggle" ng-checked="existhopeparttags(tagitem)" ng-click="clickhopeparttags(tagitem)"><span class="ng-binding">税制措置</span></label>
		                                                        </div> 
		                                                    </div>
		                                                    <!-- end ngRepeat: tagitem in downedtaglist track by $index -->
		                                                    <div ng-repeat="tagitem in downedtaglist track by $index" class="ng-scope">
		                                                        <div id="tagdonate">
		                                                            <label class="graybutton" style="width:auto;">
		                                                                <input type="checkbox" name="toggle" ng-checked="existhopeparttags(tagitem)" ng-click="clickhopeparttags(tagitem)"><span class="ng-binding">出資支援</span></label>
		                                                        </div> 
		                                                    </div>
		                                                    <!-- end ngRepeat: tagitem in downedtaglist track by $index -->
		                                                    <div ng-repeat="tagitem in downedtaglist track by $index" class="ng-scope">
		                                                        <div id="tagdonate">
		                                                            <label class="graybutton" style="width:auto;">
		                                                                <input type="checkbox" name="toggle" ng-checked="existhopeparttags(tagitem)" ng-click="clickhopeparttags(tagitem)"><span class="ng-binding">情報提供支援</span></label>
		                                                        </div>
		                                                        
		                                                    </div>
		                                                    <!-- end ngRepeat: tagitem in downedtaglist track by $index -->
		                                                    <div ng-repeat="tagitem in downedtaglist track by $index" class="ng-scope">
		                                                        <div id="tagdonate">
		                                                            <label class="graybutton" style="width:auto;">
		                                                                <input type="checkbox" name="toggle" ng-checked="existhopeparttags(tagitem)" ng-click="clickhopeparttags(tagitem)"><span class="ng-binding">相談支援</span></label>
		                                                        </div>
		                                                        
		                                                    </div>
		                                                    <!-- end ngRepeat: tagitem in downedtaglist track by $index -->
		                                                    <div ng-repeat="tagitem in downedtaglist track by $index" class="ng-scope">
		                                                        <div id="tagdonate">
		                                                            <label class="graybutton" style="width:auto;">
		                                                                <input type="checkbox" name="toggle" ng-checked="existhopeparttags(tagitem)" ng-click="clickhopeparttags(tagitem)"><span class="ng-binding">セミナー支援</span></label>
		                                                        </div> 
		                                                    </div>
		                                                    <!-- end ngRepeat: tagitem in downedtaglist track by $index -->
		                                                    <div ng-repeat="tagitem in downedtaglist track by $index" class="ng-scope">
		                                                        <div id="tagdonate">
		                                                            <label class="graybutton" style="width:auto;">
		                                                                <input type="checkbox" name="toggle" ng-checked="existhopeparttags(tagitem)" ng-click="clickhopeparttags(tagitem)"><span class="ng-binding">研究/開発支援</span></label>
		                                                        </div> 
		                                                    </div>
		                                                    <!-- end ngRepeat: tagitem in downedtaglist track by $index -->
		                                                    <div ng-repeat="tagitem in downedtaglist track by $index" class="ng-scope">
		                                                        <div id="tagdonate">
		                                                            <label class="graybutton" style="width:auto;">
		                                                                <input type="checkbox" name="toggle" ng-checked="existhopeparttags(tagitem)" ng-click="clickhopeparttags(tagitem)"><span class="ng-binding">イベント支援</span></label>
		                                                        </div> 
		                                                    </div>
		                                                    <!-- end ngRepeat: tagitem in downedtaglist track by $index -->
		                                                    <div ng-repeat="tagitem in downedtaglist track by $index" class="ng-scope">
		                                                        <div id="tagdonate">
		                                                            <label class="graybutton" style="width:auto;">
		                                                                <input type="checkbox" name="toggle" ng-checked="existhopeparttags(tagitem)" ng-click="clickhopeparttags(tagitem)"><span class="ng-binding">法律等支援</span></label>
		                                                        </div> 
		                                                    </div>
		                                                    <!-- end ngRepeat: tagitem in downedtaglist track by $index -->
		                                                    <div ng-repeat="tagitem in downedtaglist track by $index" class="ng-scope">
		                                                        <div id="tagdonate">
		                                                            <label class="graybutton" style="width:auto;">
		                                                                <input type="checkbox" name="toggle" ng-checked="existhopeparttags(tagitem)" ng-click="clickhopeparttags(tagitem)"><span class="ng-binding">知的財産支援</span></label>
		                                                        </div> 
		                                                    </div>
		                                                    <!-- end ngRepeat: tagitem in downedtaglist track by $index -->
		                                                    <div ng-repeat="tagitem in downedtaglist track by $index" class="ng-scope">
		                                                        <div id="tagdonate">
		                                                            <label class="graybutton" style="width:auto;">
		                                                                <input type="checkbox" name="toggle" ng-checked="existhopeparttags(tagitem)" ng-click="clickhopeparttags(tagitem)"><span class="ng-binding">販路拡大支援</span></label>
		                                                        </div> 
		                                                    </div>
		                                                    <!-- end ngRepeat: tagitem in downedtaglist track by $index -->
		                                                </div>
		                                            </div>
		                                        </div>
		                                    </div>

		                                    <div class="row">
		                                        <div class="col-md-3" style="height:122px;">
		                                            <div class="gridcell-left">
		                                                <p style="font-size:14px;position: relative;top:40%;">対象者の詳細</p>
		                                            </div>
		                                        </div>
		                                        <div class="col-md-9">
		                                            <div class="gridcell-right">
		                                                <textarea name="Text1" style="width:100%;" rows="5" ng-model="targetinfo" class="ng-pristine ng-untouched ng-valid ng-empty" aria-invalid="false"></textarea>
		                                            </div>
		                                        </div>
		                                    </div>

		                                    <div class="row">
		                                        <div class="col-md-3" style="height:162px;">
		                                            <div class="gridcell-left">
		                                                <p style="font-size:14px;">業種</p>
		                                                <p>
		                                                    <input class="btn submit-blue-left" type="button" ng-click="checkAllIndustryItems()" value="全選択">
		                                                </p>
		                                            </div>
		                                        </div>
		                                        <div class="col-md-9">
		                                            <div class="gridcell-right" style="height:162px;overflow:auto;">
		                                                <div class="row">
		                                                    <!-- ngRepeat: industryitem in downedindustrylist -->
		                                                    <div ng-repeat="industryitem in downedindustrylist" class="ng-scope" style="">
		                                                        <div id="tagdonate">
		                                                            <label class="graybutton" style="width: auto;">
		                                                                <input type="checkbox" name="toggle" ng-checked="existindustryitems(industryitem.trade)" ng-click="clickindustryitems(industryitem.trade)"><span class="ng-binding">農林水産業</span></label>
		                                                        </div>
		                                                    </div>
		                                                    <!-- end ngRepeat: industryitem in downedindustrylist -->
		                                                    <div ng-repeat="industryitem in downedindustrylist" class="ng-scope">
		                                                        <div id="tagdonate">
		                                                            <label class="graybutton" style="width: auto;">
		                                                                <input type="checkbox" name="toggle" ng-checked="existindustryitems(industryitem.trade)" ng-click="clickindustryitems(industryitem.trade)"><span class="ng-binding">運輸業，郵便業</span></label>
		                                                        </div>
		                                                    </div>
		                                                    <!-- end ngRepeat: industryitem in downedindustrylist -->
		                                                    <div ng-repeat="industryitem in downedindustrylist" class="ng-scope">
		                                                        <div id="tagdonate">
		                                                            <label class="graybutton" style="width: auto;">
		                                                                <input type="checkbox" name="toggle" ng-checked="existindustryitems(industryitem.trade)" ng-click="clickindustryitems(industryitem.trade)"><span class="ng-binding">派遣業・有料職業紹介業</span></label>
		                                                        </div>
		                                                    </div>
		                                                    <!-- end ngRepeat: industryitem in downedindustrylist -->
		                                                    <div ng-repeat="industryitem in downedindustrylist" class="ng-scope">
		                                                        <div id="tagdonate">
		                                                            <label class="graybutton" style="width: auto;">
		                                                                <input type="checkbox" name="toggle" ng-checked="existindustryitems(industryitem.trade)" ng-click="clickindustryitems(industryitem.trade)"><span class="ng-binding">IT業</span></label>
		                                                        </div>
		                                                    </div>
		                                                    <!-- end ngRepeat: industryitem in downedindustrylist -->
		                                                    <div ng-repeat="industryitem in downedindustrylist" class="ng-scope">
		                                                        <div id="tagdonate">
		                                                            <label class="graybutton" style="width: auto;">
		                                                                <input type="checkbox" name="toggle" ng-checked="existindustryitems(industryitem.trade)" ng-click="clickindustryitems(industryitem.trade)"><span class="ng-binding">情報通信業</span></label>
		                                                        </div>
		                                                    </div>
		                                                    <!-- end ngRepeat: industryitem in downedindustrylist -->
		                                                    <div ng-repeat="industryitem in downedindustrylist" class="ng-scope">
		                                                        <div id="tagdonate">
		                                                            <label class="graybutton" style="width: auto;">
		                                                                <input type="checkbox" name="toggle" ng-checked="existindustryitems(industryitem.trade)" ng-click="clickindustryitems(industryitem.trade)"><span class="ng-binding">電気・ガス・ 熱供給・水道業</span></label>
		                                                        </div>
		                                                    </div>
		                                                    <!-- end ngRepeat: industryitem in downedindustrylist -->
		                                                    <div ng-repeat="industryitem in downedindustrylist" class="ng-scope">
		                                                        <div id="tagdonate">
		                                                            <label class="graybutton" style="width: auto;">
		                                                                <input type="checkbox" name="toggle" ng-checked="existindustryitems(industryitem.trade)" ng-click="clickindustryitems(industryitem.trade)"><span class="ng-binding">製造業</span></label>
		                                                        </div>
		                                                    </div>
		                                                    <!-- end ngRepeat: industryitem in downedindustrylist -->
		                                                    <div ng-repeat="industryitem in downedindustrylist" class="ng-scope">
		                                                        <div id="tagdonate">
		                                                            <label class="graybutton" style="width: auto;">
		                                                                <input type="checkbox" name="toggle" ng-checked="existindustryitems(industryitem.trade)" ng-click="clickindustryitems(industryitem.trade)"><span class="ng-binding">建設業</span></label>
		                                                        </div>
		                                                    </div>
		                                                    <!-- end ngRepeat: industryitem in downedindustrylist -->
		                                                    <div ng-repeat="industryitem in downedindustrylist" class="ng-scope">
		                                                        <div id="tagdonate">
		                                                            <label class="graybutton" style="width: auto;">
		                                                                <input type="checkbox" name="toggle" ng-checked="existindustryitems(industryitem.trade)" ng-click="clickindustryitems(industryitem.trade)"><span class="ng-binding">鉱業，採石業， 砂利採取業</span></label>
		                                                        </div>
		                                                    </div>
		                                                    <!-- end ngRepeat: industryitem in downedindustrylist -->
		                                                    <div ng-repeat="industryitem in downedindustrylist" class="ng-scope">
		                                                        <div id="tagdonate">
		                                                            <label class="graybutton" style="width: auto;">
		                                                                <input type="checkbox" name="toggle" ng-checked="existindustryitems(industryitem.trade)" ng-click="clickindustryitems(industryitem.trade)"><span class="ng-binding">漁業</span></label>
		                                                        </div>
		                                                    </div>
		                                                    <!-- end ngRepeat: industryitem in downedindustrylist -->
		                                                    <div ng-repeat="industryitem in downedindustrylist" class="ng-scope">
		                                                        <div id="tagdonate">
		                                                            <label class="graybutton" style="width: auto;">
		                                                                <input type="checkbox" name="toggle" ng-checked="existindustryitems(industryitem.trade)" ng-click="clickindustryitems(industryitem.trade)"><span class="ng-binding">卸売業・小売業</span></label>
		                                                        </div>
		                                                    </div>
		                                                    <!-- end ngRepeat: industryitem in downedindustrylist -->
		                                                    <div ng-repeat="industryitem in downedindustrylist" class="ng-scope">
		                                                        <div id="tagdonate">
		                                                            <label class="graybutton" style="width: auto;">
		                                                                <input type="checkbox" name="toggle" ng-checked="existindustryitems(industryitem.trade)" ng-click="clickindustryitems(industryitem.trade)"><span class="ng-binding">金融業・保険業</span></label>
		                                                        </div>
		                                                    </div>
		                                                    <!-- end ngRepeat: industryitem in downedindustrylist -->
		                                                    <div ng-repeat="industryitem in downedindustrylist" class="ng-scope">
		                                                        <div id="tagdonate">
		                                                            <label class="graybutton" style="width: auto;">
		                                                                <input type="checkbox" name="toggle" ng-checked="existindustryitems(industryitem.trade)" ng-click="clickindustryitems(industryitem.trade)"><span class="ng-binding">不動産業， 物品賃貸業</span></label>
		                                                        </div>
		                                                    </div>
		                                                    <!-- end ngRepeat: industryitem in downedindustrylist -->
		                                                    <div ng-repeat="industryitem in downedindustrylist" class="ng-scope">
		                                                        <div id="tagdonate">
		                                                            <label class="graybutton" style="width: auto;">
		                                                                <input type="checkbox" name="toggle" ng-checked="existindustryitems(industryitem.trade)" ng-click="clickindustryitems(industryitem.trade)"><span class="ng-binding">協同組合</span></label>
		                                                        </div>
		                                                    </div>
		                                                    <!-- end ngRepeat: industryitem in downedindustrylist -->
		                                                    <div ng-repeat="industryitem in downedindustrylist" class="ng-scope">
		                                                        <div id="tagdonate">
		                                                            <label class="graybutton" style="width: auto;">
		                                                                <input type="checkbox" name="toggle" ng-checked="existindustryitems(industryitem.trade)" ng-click="clickindustryitems(industryitem.trade)"><span class="ng-binding">医療業</span></label>
		                                                        </div>
		                                                    </div>
		                                                    <!-- end ngRepeat: industryitem in downedindustrylist -->
		                                                    <div ng-repeat="industryitem in downedindustrylist" class="ng-scope">
		                                                        <div id="tagdonate">
		                                                            <label class="graybutton" style="width: auto;">
		                                                                <input type="checkbox" name="toggle" ng-checked="existindustryitems(industryitem.trade)" ng-click="clickindustryitems(industryitem.trade)"><span class="ng-binding">福祉業</span></label>
		                                                        </div>
		                                                    </div>
		                                                    <!-- end ngRepeat: industryitem in downedindustrylist -->
		                                                    <div ng-repeat="industryitem in downedindustrylist" class="ng-scope">
		                                                        <div id="tagdonate">
		                                                            <label class="graybutton" style="width: auto;">
		                                                                <input type="checkbox" name="toggle" ng-checked="existindustryitems(industryitem.trade)" ng-click="clickindustryitems(industryitem.trade)"><span class="ng-binding">飲食サービス業</span></label>
		                                                        </div>
		                                                    </div>
		                                                    <!-- end ngRepeat: industryitem in downedindustrylist -->
		                                                    <div ng-repeat="industryitem in downedindustrylist" class="ng-scope">
		                                                        <div id="tagdonate">
		                                                            <label class="graybutton" style="width: auto;">
		                                                                <input type="checkbox" name="toggle" ng-checked="existindustryitems(industryitem.trade)" ng-click="clickindustryitems(industryitem.trade)"><span class="ng-binding">教育，学習支援業</span></label>
		                                                        </div>
		                                                    </div>
		                                                    <!-- end ngRepeat: industryitem in downedindustrylist -->
		                                                    <div ng-repeat="industryitem in downedindustrylist" class="ng-scope">
		                                                        <div id="tagdonate">
		                                                            <label class="graybutton" style="width: auto;">
		                                                                <input type="checkbox" name="toggle" ng-checked="existindustryitems(industryitem.trade)" ng-click="clickindustryitems(industryitem.trade)"><span class="ng-binding">娯楽業</span></label>
		                                                        </div>
		                                                    </div>
		                                                    <!-- end ngRepeat: industryitem in downedindustrylist -->
		                                                    <div ng-repeat="industryitem in downedindustrylist" class="ng-scope">
		                                                        <div id="tagdonate">
		                                                            <label class="graybutton" style="width: auto;">
		                                                                <input type="checkbox" name="toggle" ng-checked="existindustryitems(industryitem.trade)" ng-click="clickindustryitems(industryitem.trade)"><span class="ng-binding">生活関連サービス業</span></label>
		                                                        </div>
		                                                    </div>
		                                                    <!-- end ngRepeat: industryitem in downedindustrylist -->
		                                                    <div ng-repeat="industryitem in downedindustrylist" class="ng-scope">
		                                                        <div id="tagdonate">
		                                                            <label class="graybutton" style="width: auto;">
		                                                                <input type="checkbox" name="toggle" ng-checked="existindustryitems(industryitem.trade)" ng-click="clickindustryitems(industryitem.trade)"><span class="ng-binding">宿泊業</span></label>
		                                                        </div>
		                                                    </div>
		                                                    <!-- end ngRepeat: industryitem in downedindustrylist -->
		                                                    <div ng-repeat="industryitem in downedindustrylist" class="ng-scope">
		                                                        <div id="tagdonate">
		                                                            <label class="graybutton" style="width: auto;">
		                                                                <input type="checkbox" name="toggle" ng-checked="existindustryitems(industryitem.trade)" ng-click="clickindustryitems(industryitem.trade)"><span class="ng-binding">学術研究，専門・ 技術サービス業</span></label>
		                                                        </div>
		                                                    </div>
		                                                    <!-- end ngRepeat: industryitem in downedindustrylist -->
		                                                    <div ng-repeat="industryitem in downedindustrylist" class="ng-scope">
		                                                        <div id="tagdonate">
		                                                            <label class="graybutton" style="width: auto;">
		                                                                <input type="checkbox" name="toggle" ng-checked="existindustryitems(industryitem.trade)" ng-click="clickindustryitems(industryitem.trade)"><span class="ng-binding">一般家庭</span></label>
		                                                        </div>
		                                                    </div>
		                                                    <!-- end ngRepeat: industryitem in downedindustrylist -->
		                                                    <div ng-repeat="industryitem in downedindustrylist" class="ng-scope">
		                                                        <div id="tagdonate">
		                                                            <label class="graybutton" style="width: auto;">
		                                                                <input type="checkbox" name="toggle" ng-checked="existindustryitems(industryitem.trade)" ng-click="clickindustryitems(industryitem.trade)"><span class="ng-binding">商店街/商工会</span></label>
		                                                        </div>
		                                                    </div>
		                                                    <!-- end ngRepeat: industryitem in downedindustrylist -->
		                                                    <div ng-repeat="industryitem in downedindustrylist" class="ng-scope">
		                                                        <div id="tagdonate">
		                                                            <label class="graybutton" style="width: auto;">
		                                                                <input type="checkbox" name="toggle" ng-checked="existindustryitems(industryitem.trade)" ng-click="clickindustryitems(industryitem.trade)"><span class="ng-binding">公務</span></label>
		                                                        </div>
		                                                    </div>
		                                                    <!-- end ngRepeat: industryitem in downedindustrylist -->
		                                                </div>
		                                            </div>
		                                        </div>
		                                    </div>

		                                    <div class="row">
		                                        <div class="col-md-3" style="height:320px;">
		                                            <div class="gridcell-left">
		                                                <p style="font-size:14px;position: relative;top:40%;">対象企業条件</p>
		                                            </div>
		                                        </div>
		                                        <div class="col-md-9" style="height:320px;border-bottom: #000000 1px solid;">
		                                            <div class="gridcell-right">
		                                                <div class="row">
		                                                    <div class="col-md-5">創業年数</div>
		                                                    <div class="col-md-3">
		                                                        <input class="form-control ng-pristine ng-untouched ng-valid ng-empty ng-valid-min" id="focusedInput" type="number" ng-model="addtionalsetting.founding_year_start" min="0" placeholder="設定なし" ng-class="{submitted:subsidyform.submitted}" aria-invalid="false">
		                                                    </div>
		                                                    <div class="col-md-1" style="text-align:center">~</div>
		                                                    <div class="col-md-3">
		                                                        <input class="form-control ng-pristine ng-untouched ng-valid ng-empty ng-valid-min" id="focusedInput" type="number" ng-model="addtionalsetting.founding_year_end" min="0" placeholder="設定なし" ng-class="{submitted:subsidyform.submitted}" aria-invalid="false">
		                                                    </div>
		                                                </div>
		                                            </div>
		                                            <div class="gridcell-right">
		                                                <div class="row">
		                                                    <div class="col-md-5">資本金</div>
		                                                    <div class="col-md-3">
		                                                        <input class="form-control ng-pristine ng-untouched ng-valid ng-empty ng-valid-min" id="focusedInput" type="number" ng-model="addtionalsetting.capital_start" min="0" placeholder="設定なし" ng-class="{submitted:subsidyform.submitted}" aria-invalid="false">
		                                                    </div>
		                                                    <div class="col-md-1" style="text-align:center">~</div>
		                                                    <div class="col-md-3">
		                                                        <input class="form-control ng-pristine ng-untouched ng-valid ng-empty ng-valid-min" id="focusedInput" type="number" ng-model="addtionalsetting.capital_end" min="0" placeholder="設定なし" ng-class="{submitted:subsidyform.submitted}" aria-invalid="false">
		                                                    </div>
		                                                </div>
		                                            </div>
		                                            <div class="gridcell-right">
		                                                <div class="row">
		                                                    <div class="col-md-5">従業員数（正社員）</div>
		                                                    <div class="col-md-3">
		                                                        <input class="form-control ng-pristine ng-untouched ng-valid ng-empty ng-valid-min" id="focusedInput" type="number" min="0" ng-model="addtionalsetting.employees_count_start" placeholder="設定なし" ng-class="{submitted:subsidyform.submitted}" aria-invalid="false">
		                                                    </div>
		                                                    <div class="col-md-1" style="text-align:center">~</div>
		                                                    <div class="col-md-3">
		                                                        <input class="form-control ng-pristine ng-untouched ng-valid ng-empty ng-valid-min" id="focusedInput" type="number" min="0" ng-model="addtionalsetting.employees_count_end" placeholder="設定なし" ng-class="{submitted:subsidyform.submitted}" aria-invalid="false">
		                                                    </div>
		                                                </div>
		                                            </div>
		                                            <div class="gridcell-right">
		                                                <div class="row">
		                                                    <div class="col-md-5">採用予定数（正社員）</div>
		                                                    <div class="col-md-3">
		                                                        <input class="form-control ng-pristine ng-untouched ng-valid ng-empty ng-valid-min" id="focusedInput" type="number" min="0" ng-model="addtionalsetting.hiring_count_start" placeholder="設定なし" ng-class="{submitted:subsidyform.submitted}" aria-invalid="false">
		                                                    </div>
		                                                    <div class="col-md-1" style="text-align:center">~</div>
		                                                    <div class="col-md-3">
		                                                        <input class="form-control ng-pristine ng-untouched ng-valid ng-empty ng-valid-min" id="focusedInput" type="number" min="0" ng-model="addtionalsetting.hiring_count_end" placeholder="設定なし" ng-class="{submitted:subsidyform.submitted}" aria-invalid="false">
		                                                    </div>
		                                                </div>
		                                            </div>
		                                            <div class="gridcell-right">
		                                                <div class="row">
		                                                    <div class="col-md-5">従業員数（アルバイト）</div>
		                                                    <div class="col-md-3">
		                                                        <input class="form-control ng-pristine ng-untouched ng-valid ng-empty ng-valid-min" id="focusedInput" type="number" min="0" ng-model="addtionalsetting.employees_part_count_start" placeholder="設定なし" ng-class="{submitted:subsidyform.submitted}" aria-invalid="false">
		                                                    </div>
		                                                    <div class="col-md-1" style="text-align:center">~</div>
		                                                    <div class="col-md-3">
		                                                        <input class="form-control ng-pristine ng-untouched ng-valid ng-empty ng-valid-min" id="focusedInput" type="number" min="0" ng-model="addtionalsetting.employees_part_count_end" placeholder="設定なし" ng-class="{submitted:subsidyform.submitted}" aria-invalid="false">
		                                                    </div>
		                                                </div>
		                                            </div>
		                                            <div class="gridcell-right">
		                                                <div class="row">
		                                                    <div class="col-md-5">採用予定数（アルバイト）</div>
		                                                    <div class="col-md-3">
		                                                        <input class="form-control ng-pristine ng-untouched ng-valid ng-empty ng-valid-min" id="focusedInput" type="number" min="0" ng-model="addtionalsetting.hiring_byte_count_start" placeholder="設定なし" ng-class="{submitted:subsidyform.submitted}" aria-invalid="false">
		                                                    </div>
		                                                    <div class="col-md-1" style="text-align:center">~</div>
		                                                    <div class="col-md-3">
		                                                        <input class="form-control ng-pristine ng-untouched ng-valid ng-empty ng-valid-min" id="focusedInput" type="number" min="0" ng-model="addtionalsetting.hiring_byte_count_end" placeholder="設定なし" ng-class="{submitted:subsidyform.submitted}" aria-invalid="false">
		                                                    </div>
		                                                </div>
		                                            </div>
		                                            <div class="gridcell-right">
		                                                <div class="row">
		                                                    <div class="col-md-5">正社員化の予定数（アルバイト）</div>
		                                                    <div class="col-md-3">
		                                                        <input class="form-control ng-pristine ng-untouched ng-valid ng-empty ng-valid-min" id="focusedInput" type="number" min="0" ng-model="addtionalsetting.regular_byte_start" placeholder="設定なし" ng-class="{submitted:subsidyform.submitted}" aria-invalid="false">
		                                                    </div>
		                                                    <div class="col-md-1" style="text-align:center">~</div>
		                                                    <div class="col-md-3">
		                                                        <input class="form-control ng-pristine ng-untouched ng-valid ng-empty ng-valid-min" id="focusedInput" type="number" min="0" ng-model="addtionalsetting.regular_byte_end" placeholder="設定なし" ng-class="{submitted:subsidyform.submitted}" aria-invalid="false">
		                                                    </div>
		                                                </div>
		                                            </div>
		                                            <div class="gridcell-right">
		                                                <div class="row">
		                                                    <div class="col-md-5">60歳以上の社員数</div>
		                                                    <div class="col-md-3">
		                                                        <input class="form-control ng-pristine ng-untouched ng-valid ng-empty ng-valid-min" id="focusedInput" type="number" min="0" ng-model="addtionalsetting.over_60_count_start" placeholder="設定なし" ng-class="{submitted:subsidyform.submitted}" aria-invalid="false">
		                                                    </div>
		                                                    <div class="col-md-1" style="text-align:center">~</div>
		                                                    <div class="col-md-3">
		                                                        <input class="form-control ng-pristine ng-untouched ng-valid ng-empty ng-valid-min" id="focusedInput" type="number" min="0" ng-model="addtionalsetting.over_60_count_end" placeholder="設定なし" ng-class="{submitted:subsidyform.submitted}" aria-invalid="false">
		                                                    </div>
		                                                </div>
		                                            </div>
		                                        </div>
		                                    </div>

		                                    <div class="row">
		                                        <div class="col-md-3" style="height:122px;">
		                                            <div class="gridcell-left">
		                                                <p style="font-size:14px;position: relative;top:40%;">支援内容</p>
		                                            </div>
		                                        </div>
		                                        <div class="col-md-9">
		                                            <div class="gridcell-right">
		                                                <textarea name="Text1" style="width:100%;" rows="5" ng-model="support" class="ng-pristine ng-untouched ng-valid ng-empty" aria-invalid="false"></textarea>
		                                            </div>
		                                        </div>
		                                    </div>

		                                    <div class="row">
		                                        <div class="col-md-3" style="height:40px;">
		                                            <div class="gridcell-left">
		                                                <p style="font-size:14px;">取得可能金額設定</p>
		                                            </div>
		                                        </div>
		                                        <div class="col-md-9">
		                                            <div class="gridcell-right">
		                                                <div class="row">
		                                                    <div class="col-md-4">
		                                                        <div class="angularsl">
			                                                        <select name="location"> 
			                                                            <option value="1">取得可能金額設定</option>
																		<option value="2">100万円以下</option>
																		<option value="3">100万〜500万円以下</option>
																		<option value="4">500万〜1000円万以下</option>
																		<option value="5">1000万〜5000万以下</option>
																		<option value="6">5000万〜1億円以下</option>
																		<option value="7">1億円以上</option>
			                                                        </select>
			                                                    </div> 
		                                                    </div>
		                                                    <div class="col-md-4" style="padding: 0 5px;">
		                                                        <div class="angularsl">
			                                                        <select name="location"> 
			                                                            <option value="1">公開</option>
																		<option value="2">未公開</option>
																		<option value="3">公開不可</option>
																		<option value="4">掲載終了</option>
																		<option value="5">削除</option>
			                                                        </select>
			                                                    </div> 
		                                                    </div>
		                                                    <div class="col-md-4">
		                                                        <input class="form-control input_md ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required" type="text" ng-model="acquire_budget_display" required="" ng-class="{submitted:subsidyform.submitted}" aria-invalid="true">
		                                                    </div>
		                                                </div>
		                                            </div>
		                                        </div>
		                                    </div>

		                                    <div class="row">
		                                        <div class="col-md-3" style="height:196px;">
		                                            <div class="gridcell-left">
		                                                <p style="font-size:14px;position: relative;top:40%;">支援規模</p>
		                                            </div>
		                                        </div>
		                                        <div class="col-md-9">
		                                            <div class="gridcell-right">
		                                                <div class="row">
		                                                    <div class="col-md-4" style="background:#fff;border:1px solid #999;">
		                                                        <div class="row">
		                                                            <p style="text-align:center;">下限</p>
		                                                        </div>
		                                                        <div class="row">
		                                                            <input class="form-control ng-pristine ng-untouched ng-valid ng-not-empty ng-valid-required ng-valid-pattern ng-valid-maxlength" style="ime-mode: disabled!important;" type="tel" currency-input="" maxlength="15" pattern="[0-9]+([\.,][0-9]+)*" ng-model="addtionalsetting.support_scale_lower_limit" required="" ng-class="{submitted:subsidyform.submitted}" aria-invalid="false">
		                                                        </div>
		                                                    </div>
		                                                    <div class="col-md-4" style="background:#fff;border:1px solid #999;">
		                                                        <div class="row">
		                                                            <p style="text-align:center;">上限</p>
		                                                        </div>
		                                                        <div class="row">
		                                                            <input class="form-control ng-pristine ng-untouched ng-valid ng-not-empty ng-valid-required ng-valid-pattern ng-valid-maxlength" style="ime-mode: disabled!important;" type="tel" currency-input="" maxlength="15" pattern="[0-9]+([\.,][0-9]+)*" ng-model="addtionalsetting.support_scale_upper_limit" required="" ng-class="{submitted:subsidyform.submitted}" aria-invalid="false">
		                                                        </div>
		                                                    </div>
		                                                    <div class="col-md-4" style="background:#fff;border:1px solid #999;">
		                                                        <div class="row">
		                                                            <p style="text-align:center;">助成率</p>
		                                                        </div>
		                                                        <div class="row">
		                                                            <input class="form-control ng-pristine ng-untouched ng-valid ng-empty" type="text" ng-model="addtionalsetting.support_scale_subsidy_duration" ng-class="{submitted:subsidyform.submitted}" aria-invalid="false">
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                            </div>
		                                            <div class="gridcell-right">
		                                                <textarea name="Text1" style="width:100%;" rows="5" ng-model="supportscale" required="" ng-class="{submitted:subsidyform.submitted}" class="ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required" aria-invalid="true"></textarea>
		                                            </div>
		                                        </div>
		                                    </div>

		                                    <div class="row">
		                                        <div class="col-md-3" style="height:122px;">
		                                            <div class="gridcell-left">
		                                                <p style="font-size:14px;position: relative;top:40%;">募集期間</p>
		                                            </div>
		                                        </div>
		                                        <div class="col-md-9">
		                                            <div class="gridcell-right">
		                                                <textarea name="Text1" style="width:100%;" rows="5" ng-model="recruitment" class="ng-pristine ng-untouched ng-valid ng-empty" aria-invalid="false"></textarea>
		                                            </div>
		                                        </div>
		                                    </div>

		                                    <div class="row">
		                                        <div class="col-md-3" style="height:122px;">
		                                            <div class="gridcell-left">
		                                                <p style="font-size:14px;position: relative;top:40%;">対象期間</p>
		                                            </div>
		                                        </div>
		                                        <div class="col-md-9">
		                                            <div class="gridcell-right">
		                                                <textarea name="Text1" style="width:100%;" rows="5" ng-model="period" class="ng-pristine ng-untouched ng-valid ng-empty" aria-invalid="false"></textarea>
		                                            </div>
		                                        </div>
		                                    </div>

		                                    <div class="row">
		                                        <div class="col-md-3" style="height:272px;">
		                                            <div class="gridcell-left">
		                                                <p style="font-size:14px;">掲載終了日</p>
		                                            </div>
		                                        </div>
		                                        <div class="col-md-9">
		                                            <div class="gridcell-right">
		                                                <div class="row">
		                                                    <div class="col-sm-8">
		                                                        <div class="datepickertoday"></div>
		                                                    </div>
		                                                    <div class="col-sm-3">
		                                                        <input type="checkbox" ng-model="addtionalsetting.subscript_duration_option" ng-click="checkstatus()" class="ng-pristine ng-untouched ng-valid ng-not-empty" aria-invalid="false">随時
		                                                    </div>
		                                                </div>
		                                            </div>
		                                        </div>
		                                    </div>

		                                    <div class="row">
		                                        <div class="col-md-3">
		                                            <div class="gridcell-left">
		                                                <p style="font-size:14px;">採択結果</p>
		                                            </div>
		                                        </div>
		                                        <div class="col-md-9">
		                                            <div class="gridcell-right">
		                                                <input class="form-control ng-pristine ng-untouched ng-valid ng-empty" id="focusedInput" type="text" ng-model="adoption" style="fon" aria-invalid="false">
		                                            </div>
		                                        </div>
		                                    </div>

		                                    <div class="row">
		                                        <div class="col-md-3" style="height:122px;">
		                                            <div class="gridcell-left">
		                                                <p style="font-size:14px;position: relative;top:40%;">お問い合わせ</p>
		                                            </div>
		                                        </div>
		                                        <div class="col-md-9">
		                                            <div class="gridcell-right">
		                                                <textarea name="Text1" style="width:100%;" rows="5" ng-model="contact" class="ng-pristine ng-untouched ng-valid ng-empty" aria-invalid="false"></textarea>
		                                            </div>
		                                        </div>
		                                    </div>

		                                    <div class="row">
		                                        <div class="col-md-3" style="height:560px;">
		                                            <div class="gridcell-left">
		                                                <p style="font-size:14px;position: relative;top:40%;">登録PDF</p>
		                                            </div>
		                                        </div>
		                                        <div class="col-md-5">
		                                            <div class="gridcell-right">
		                                                <div class="row">
		                                                    <div class="col-md-11">
		                                                        <input class="form-control" id="focusedInput" value="" type="text" disabled="">
		                                                    </div>
		                                                    <div class="col-md-1" style="padding:0;">
		                                                        <button type="button" class="submit-delete-button" ng-click="deletepdffiledata(0)"></button>
		                                                    </div>
		                                                </div>
		                                            </div>
		                                            <div class="gridcell-right">
		                                                <div class="row">
		                                                    <div class="col-md-11">
		                                                        <input class="form-control" id="focusedInput" value="" type="text" disabled="">
		                                                    </div>
		                                                    <div class="col-md-1" style="padding:0;">
		                                                        <button type="button" class="submit-delete-button" ng-click="deletepdffiledata(1)"></button>
		                                                    </div>
		                                                </div>
		                                            </div>
		                                            <div class="gridcell-right">
		                                                <div class="row">
		                                                    <div class="col-md-11">
		                                                        <input class="form-control" id="focusedInput" value="" type="text" disabled="">
		                                                    </div>
		                                                    <div class="col-md-1" style="padding:0;">
		                                                        <button type="button" class="submit-delete-button" ng-click="deletepdffiledata(2)"></button>
		                                                    </div>
		                                                </div>
		                                            </div>
		                                            <div class="gridcell-right">
		                                                <div class="row">
		                                                    <div class="col-md-11">
		                                                        <input class="form-control" id="focusedInput" value="" type="text" disabled="">
		                                                    </div>
		                                                    <div class="col-md-1" style="padding:0;">
		                                                        <button type="button" class="submit-delete-button" ng-click="deletepdffiledata(3)"></button>
		                                                    </div>
		                                                </div>
		                                            </div>
		                                            <div class="gridcell-right">
		                                                <div class="row">
		                                                    <div class="col-md-11">
		                                                        <input class="form-control" id="focusedInput" value="" type="text" disabled="">
		                                                    </div>
		                                                    <div class="col-md-1" style="padding:0;">
		                                                        <button type="button" class="submit-delete-button" ng-click="deletepdffiledata(4)"></button>
		                                                    </div>
		                                                </div>
		                                            </div>
		                                            <div class="gridcell-right">
		                                                <div class="row">
		                                                    <div class="col-md-11">
		                                                        <input class="form-control" id="focusedInput" value="" type="text" disabled="">
		                                                    </div>
		                                                    <div class="col-md-1" style="padding:0;">
		                                                        <button type="button" class="submit-delete-button" ng-click="deletepdffiledata(5)"></button>
		                                                    </div>
		                                                </div>
		                                            </div>
		                                            <div class="gridcell-right">
		                                                <div class="row">
		                                                    <div class="col-md-11">
		                                                        <input class="form-control" id="focusedInput" value="" type="text" disabled="">
		                                                    </div>
		                                                    <div class="col-md-1" style="padding:0;">
		                                                        <button type="button" class="submit-delete-button" ng-click="deletepdffiledata(6)"></button>
		                                                    </div>
		                                                </div>
		                                            </div>

		                                            <div class="gridcell-right">
		                                                <div class="row">
		                                                    <div class="col-md-11">
		                                                        <input class="form-control ng-pristine ng-untouched ng-valid ng-empty" id="focusedInput" placeholder="表示ファイル名" ng-model="register1[0].name" aria-invalid="false">
		                                                    </div>
		                                                </div>
		                                            </div>
		                                            <div class="gridcell-right">
		                                                <div class="row">
		                                                    <div class="col-md-11">
		                                                        <input class="form-control ng-pristine ng-untouched ng-valid ng-empty" id="focusedInput" placeholder="表示ファイル名" ng-model="register1[1].name" aria-invalid="false">
		                                                    </div>
		                                                </div>
		                                            </div>
		                                            <div class="gridcell-right">
		                                                <div class="row">
		                                                    <div class="col-md-11">
		                                                        <input class="form-control ng-pristine ng-untouched ng-valid ng-empty" id="focusedInput" placeholder="表示ファイル名" ng-model="register1[2].name" aria-invalid="false">
		                                                    </div>
		                                                </div>
		                                            </div>
		                                            <div class="gridcell-right">
		                                                <div class="row">
		                                                    <div class="col-md-11">
		                                                        <input class="form-control ng-pristine ng-untouched ng-valid ng-empty" id="focusedInput" placeholder="表示ファイル名" ng-model="register1[3].name" aria-invalid="false">
		                                                    </div>
		                                                </div>
		                                            </div>
		                                            <div class="gridcell-right">
		                                                <div class="row">
		                                                    <div class="col-md-11">
		                                                        <input class="form-control ng-pristine ng-untouched ng-valid ng-empty" id="focusedInput" placeholder="表示ファイル名" ng-model="register1[4].name" aria-invalid="false">
		                                                    </div>
		                                                </div>
		                                            </div>
		                                            <div class="gridcell-right">
		                                                <div class="row">
		                                                    <div class="col-md-11">
		                                                        <input class="form-control ng-pristine ng-untouched ng-valid ng-empty" id="focusedInput" placeholder="表示ファイル名" ng-model="register1[5].name" aria-invalid="false">
		                                                    </div>
		                                                </div>
		                                            </div>
		                                            <div class="gridcell-right">
		                                                <div class="row">
		                                                    <div class="col-md-11">
		                                                        <input class="form-control ng-pristine ng-untouched ng-valid ng-empty" id="focusedInput" placeholder="表示ファイル名" ng-model="register1[6].name" aria-invalid="false">
		                                                    </div>
		                                                </div>
		                                            </div>
		                                        </div>
		                                        <div class="col-md-4" style="height:560px;">
		                                            <div class="row" style="height:280px;width:100%;">
		                                                <div id="dropbox" class="dropbox" ng-class="dropClass"><span class="glyphicon glyphicon-folder-open" style="position: relative;top:15%;font-size: 50px;"></span>
		                                                    <p style="font-size:14px;position: relative;top:30%;">アップロードする場合は、ここに ドラッグ＆ドロップしてください。</p>
		                                                </div>
		                                            </div>

		                                            <div class="gridcell-right">
		                                                <div class="row">
		                                                    <div class="col-md-12">
		                                                        <input class="form-control ng-pristine ng-untouched ng-valid ng-empty" id="focusedInput" placeholder="登録URL" ng-model="register1[0].url" aria-invalid="false">
		                                                    </div>
		                                                </div>
		                                            </div>
		                                            <div class="gridcell-right">
		                                                <div class="row">
		                                                    <div class="col-md-12">
		                                                        <input class="form-control ng-pristine ng-untouched ng-valid ng-empty" id="focusedInput" placeholder="登録URL" ng-model="register1[1].url" aria-invalid="false">
		                                                    </div>
		                                                </div>
		                                            </div>
		                                            <div class="gridcell-right">
		                                                <div class="row">
		                                                    <div class="col-md-12">
		                                                        <input class="form-control ng-pristine ng-untouched ng-valid ng-empty" id="focusedInput" placeholder="登録URL" ng-model="register1[2].url" aria-invalid="false">
		                                                    </div>
		                                                </div>
		                                            </div>
		                                            <div class="gridcell-right">
		                                                <div class="row">
		                                                    <div class="col-md-12">
		                                                        <input class="form-control ng-pristine ng-untouched ng-valid ng-empty" id="focusedInput" placeholder="登録URL" ng-model="register1[3].url" aria-invalid="false">
		                                                    </div>
		                                                </div>
		                                            </div>
		                                            <div class="gridcell-right">
		                                                <div class="row">
		                                                    <div class="col-md-12">
		                                                        <input class="form-control ng-pristine ng-untouched ng-valid ng-empty" id="focusedInput" placeholder="登録URL" ng-model="register1[4].url" aria-invalid="false">
		                                                    </div>
		                                                </div>
		                                            </div>
		                                            <div class="gridcell-right">
		                                                <div class="row">
		                                                    <div class="col-md-12">
		                                                        <input class="form-control ng-pristine ng-untouched ng-valid ng-empty" id="focusedInput" placeholder="登録URL" ng-model="register1[5].url" aria-invalid="false">
		                                                    </div>
		                                                </div>
		                                            </div>
		                                            <div class="gridcell-right">
		                                                <div class="row">
		                                                    <div class="col-md-12">
		                                                        <input class="form-control ng-pristine ng-untouched ng-valid ng-empty" id="focusedInput" placeholder="登録URL" ng-model="register1[6].url" aria-invalid="false">
		                                                    </div>
		                                                </div>
		                                            </div>
		                                        </div>
		                                    </div>

		                                    <div class="row">
		                                        <div class="col-md-3">
		                                            <div class="gridcell-left">
		                                                <p style="font-size:14px;">おすすめの助成金補助金</p>
		                                            </div>
		                                        </div>
		                                        <div class="col-md-9">
		                                            <div class="gridcell-right" style="height:40px;">
		                                                <input type="checkbox" ng-model="recommandsubsidy" class="ng-pristine ng-untouched ng-valid ng-empty" aria-invalid="false">設定する &nbsp; &nbsp; &nbsp;
		                                            </div>
		                                        </div>
		                                    </div>

		                                    <div class="row">
		                                        <div class="col-md-3">
		                                            <div class="gridcell-left">
		                                                <p style="font-size:14px;">掲載項目</p>
		                                            </div>
		                                        </div>
		                                        <div class="col-md-9">
		                                            <div class="gridcell-right" style="height:40px;">
		                                                <div class="col-sm-7" style="padding-left:0px;">
		                                                    <input type="checkbox" ng-model="normalsubsidyflag" class="ng-pristine ng-untouched ng-valid ng-not-empty" aria-invalid="false">一般施策 &nbsp; &nbsp; &nbsp;
		                                                    <input type="checkbox" ng-model="customersubsidyflag" ng-change="clearcustomerdata()" class="ng-pristine ng-untouched ng-valid ng-empty" aria-invalid="false">士業登録施策 &nbsp; &nbsp; &nbsp;
		                                                </div>
		                                                <div class="col-sm-2" style="padding-left:0px;padding-right:0px;">
		                                                    <input class="form-control ng-pristine ng-untouched ng-valid ng-empty" id="focusedInput" type="text" placeholder="登録した士業のID" ng-disabled="!customersubsidyflag" ng-model="customerid" disabled="disabled" aria-invalid="false">
		                                                </div>
		                                                <div class="col-sm-3" style="padding-left:10px;padding-right:0px;">
		                                                    <input class="form-control ng-pristine ng-untouched ng-valid ng-empty" id="focusedInput" type="text" placeholder="登録した士業の名前" ng-disabled="!customersubsidyflag" ng-model="customername" disabled="disabled" aria-invalid="false">
		                                                </div>
		                                            </div>
		                                        </div>
		                                    </div>

		                                    <div class="row">
		                                        <div class="col-md-3">
		                                            <div class="gridcell-left">
		                                                <p style="font-size:14px;">公開設定</p>
		                                            </div>
		                                        </div>
		                                        <div class="col-md-9">
		                                            <div class="gridcell-right" style="height:40px;">
		                                                <input type="radio" name="status" ng-model="subsidystatus" value="1" ng-checked="subsidystatus==1" class="ng-pristine ng-untouched ng-valid ng-not-empty" aria-invalid="false">公開 &nbsp; &nbsp; &nbsp;
		                                                <input type="radio" name="status" ng-model="subsidystatus" value="2" ng-checked="subsidystatus==2" class="ng-pristine ng-untouched ng-valid ng-not-empty" checked="checked" aria-invalid="false">非公開 &nbsp; &nbsp; &nbsp;
		                                                <input type="radio" name="status" ng-model="subsidystatus" value="3" ng-checked="subsidystatus==3" class="ng-pristine ng-untouched ng-valid ng-not-empty" aria-invalid="false">公開不可 &nbsp; &nbsp; &nbsp;
		                                                <input type="radio" name="status" ng-model="subsidystatus" value="4" ng-checked="subsidystatus==4" class="ng-pristine ng-untouched ng-valid ng-not-empty" aria-invalid="false">掲載終了
		                                            </div>
		                                        </div>
		                                    </div>

		                                    <!-- ngIf: scarapurldisplayfalg -->

		                                </form>
		                            </div>

		                            <div style="margin-top:50px;">
		                                <div class="col-md-3"></div>
		                                <div class="col-md-3" style="margin-bottom: 50px;">
		                                    <input type="submit" name="submit" class="submit-blue-btn" value="プレビュー" ng-click="subsidyform.submitted= true;submitPreview()">
		                                </div>
		                                <div class="col-md-3">
		                                    <button class="submit-blue-btn ng-binding" ng-click="subsidyform.submitted= false;submitClear()">クリアー</button>
		                                </div>
		                                <div class="col-md-3"></div>
		                            </div>

		                        </div>

		                    </div>
		                    <!-- ngIf: previewflag==1 -->
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
	</div>
<?php include ('../../inc/footer.php'); ?>
