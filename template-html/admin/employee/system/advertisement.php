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
	                        <li class="active"><a href="admin/employee/system/advertisement.php">システム管理</a></li>
	                        <li><a href="admin/employee/customerinfo/agencylist.php">顧客情報管理</a></li>
	                        <li><a href="admin/employee/customersupport/inquiry.php">顧客対応管理</a></li>
	                        <li><a href="admin/employee/data/subsidylist.php">施策データ管理</a></li>
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
		                                <li class="active"><a href="admin/employee/system/advertisement.php">広告表示管理</a></li>
		                                <li><a href="admin/employee/system/uservoice.php">利用者の声</a></li>
		                                <li><a href="admin/employee/system/alim.php">お知らせ</a></li>
		                                <li><a href="admin/employee/system/suggest.php">おススメの助成金</a></li>
		                                <li><a href="admin/employee/system/industry.php">業種</a></li>
		                                <li><a href="admin/employee/system/tag.php">タグ管理</a></li>
		                                <li><a href="admin/employee/system/category.php">カテゴリー管理</a></li>
		                                <li><a href="admin/employee/system/question.php">企業情報質問内容管理</a></li>
		                                <li><a href="admin/employee/system/payinfo.php">有料情報管理</a></li>
		                                <li><a href="admin/employee/system/notification.php">通知管理</a></li>
		                                <li><a href="admin/employee/system/blog.php">ブログ管理</a></li>
		                            </ul>
		                        </div>
		                    </div>
		                    <div class="col-md-9 pull-right">
		                        <div class="site-content">
		                            <div class="blueheading"><span>広告管理</span></div>
		                            <div class="section-3 col-md-12" style="padding-left:0px;">
		                                <div class="section3-full" style="padding-left:0px;">
		                                    <div class="section3-full-scroll" style="padding-left:8px;">
		                                        <div class="row">
		                                            <div class="col-sm-3">
		                                            	<div class="angularsl">
                                                            <select name="location"> 
                                                                <option value="1">トップ広告</option>
                                                                <option value="2">トップ広告fsa</option>
                                                            </select>
                                                        </div> 
		                                            </div>
		                                        </div>
		                                    </div>
		                                </div>
		                            </div>
		                            <div class="section-3 col-md-12">
		                                <h4 style="background-color:#F4F4F4;margin-left:10px;">トップ広告</h4>
		                                <div class="section3-full">
		                                    <div class="section3-full-scroll">
		                                        <!-- ngRepeat: advertitem in advertdata -->
		                                        <div class="row ng-scope" style="margin-bottom: 20px;" ng-repeat="advertitem in advertdata">
		                                            <p class="col-sm-1 ng-binding" style="padding-left:0px;padding-right:0px;">広告1</p>
		                                            <div class="col-sm-11">
		                                                <div class="row" style="margin-bottom:10px;">
		                                                    <p class="col-sm-1" style="padding-left:0px;padding-right:0px;">表示画像</p>
		                                                    <div class="col-sm-10">
		                                                        <div class="input-group" style="margin-bottom: 20px">
		                                                            <div class="form-group has-feedback" style="margin-bottom:0px;">
		                                                                <input type="text" class="form-control ng-pristine ng-untouched ng-valid ng-empty" placeholder="表示画像" ng-model="advertitem.image_name" disabled="" aria-invalid="false">
		                                                                <!-- ngIf: advertitem.image_name -->
		                                                            </div>
		                                                            <div class="input-group-btn">
		                                                                <label for="file0" class="submit-blue-left" style="font-size:18px;text-align:center;padding-top:2px;">参照</label>
		                                                                <input id="file0" type="file" style="display: none;" accept="image/*" ngf-select="selectresumefile($index,$files)">
		                                                            </div>
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                                <div class="row">
		                                                    <p class="col-sm-1" style="padding-left:0px;padding-right:0px;">URL</p>
		                                                    <div class="col-sm-10">
		                                                        <input class="form-control ng-pristine ng-untouched ng-valid ng-empty" id="focusedInput" type="text" placeholder="URL" ng-model="advertitem.url" aria-invalid="false">
		                                                    </div>
		                                                </div>
		                                            </div>
		                                        </div>
		                                        <!-- end ngRepeat: advertitem in advertdata -->
		                                        <div class="row ng-scope" style="margin-bottom:20px;" ng-repeat="advertitem in advertdata">
		                                            <p class="col-sm-1 ng-binding" style="padding-left:0px;padding-right:0px;">広告2</p>
		                                            <div class="col-sm-11">
		                                                <div class="row" style="margin-bottom:10px;">
		                                                    <p class="col-sm-1" style="padding-left:0px;padding-right:0px;">表示画像</p>
		                                                    <div class="col-sm-10">
		                                                        <div class="input-group" style="margin-bottom: 20px">
		                                                            <div class="form-group has-feedback" style="margin-bottom:0px;">
		                                                                <input type="text" class="form-control ng-pristine ng-untouched ng-valid ng-empty" placeholder="表示画像" ng-model="advertitem.image_name" disabled="" aria-invalid="false">
		                                                                <!-- ngIf: advertitem.image_name -->
		                                                            </div>
		                                                            <div class="input-group-btn">
		                                                                <label for="file1" class="submit-blue-left" style="font-size:18px;text-align:center;padding-top:2px;">参照</label>
		                                                                <input id="file1" type="file" style="display: none;" accept="image/*" ngf-select="selectresumefile($index,$files)">
		                                                            </div>
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                                <div class="row">
		                                                    <p class="col-sm-1" style="padding-left:0px;padding-right:0px;">URL</p>
		                                                    <div class="col-sm-10">
		                                                        <input class="form-control ng-pristine ng-untouched ng-valid ng-empty" id="focusedInput" type="text" placeholder="URL" ng-model="advertitem.url" aria-invalid="false">
		                                                    </div>
		                                                </div>
		                                            </div>
		                                        </div>
		                                        <!-- end ngRepeat: advertitem in advertdata -->
		                                        <div class="row ng-scope" style="margin-bottom:20px;" ng-repeat="advertitem in advertdata">
		                                            <p class="col-sm-1 ng-binding" style="padding-left:0px;padding-right:0px;">広告3</p>
		                                            <div class="col-sm-11">
		                                                <div class="row" style="margin-bottom:10px;">
		                                                    <p class="col-sm-1" style="padding-left:0px;padding-right:0px;">表示画像</p>
		                                                    <div class="col-sm-10">
		                                                        <div class="input-group" style="margin-bottom: 20px">
		                                                            <div class="form-group has-feedback" style="margin-bottom:0px;">
		                                                                <input type="text" class="form-control ng-pristine ng-untouched ng-valid ng-empty" placeholder="表示画像" ng-model="advertitem.image_name" disabled="" aria-invalid="false">
		                                                                <!-- ngIf: advertitem.image_name -->
		                                                            </div>
		                                                            <div class="input-group-btn">
		                                                                <label for="file2" class="submit-blue-left" style="font-size:18px;text-align:center;padding-top:2px;">参照</label>
		                                                                <input id="file2" type="file" style="display: none;" accept="image/*" ngf-select="selectresumefile($index,$files)">
		                                                            </div>
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                                <div class="row">
		                                                    <p class="col-sm-1" style="padding-left:0px;padding-right:0px;">URL</p>
		                                                    <div class="col-sm-10">
		                                                        <input class="form-control ng-pristine ng-untouched ng-valid ng-empty" id="focusedInput" type="text" placeholder="URL" ng-model="advertitem.url" aria-invalid="false">
		                                                    </div>
		                                                </div>
		                                            </div>
		                                        </div>
		                                        <!-- end ngRepeat: advertitem in advertdata -->
		                                        <div class="row ng-scope" style="margin-bottom:20px;" ng-repeat="advertitem in advertdata">
		                                            <p class="col-sm-1 ng-binding" style="padding-left:0px;padding-right:0px;">広告4</p>
		                                            <div class="col-sm-11">
		                                                <div class="row" style="margin-bottom:10px;">
		                                                    <p class="col-sm-1" style="padding-left:0px;padding-right:0px;">表示画像</p>
		                                                    <div class="col-sm-10">
		                                                        <div class="input-group" style="margin-bottom: 20px">
		                                                            <div class="form-group has-feedback" style="margin-bottom:0px;">
		                                                                <input type="text" class="form-control ng-pristine ng-untouched ng-valid ng-empty" placeholder="表示画像" ng-model="advertitem.image_name" disabled="" aria-invalid="false">
		                                                                <!-- ngIf: advertitem.image_name -->
		                                                            </div>
		                                                            <div class="input-group-btn">
		                                                                <label for="file3" class="submit-blue-left" style="font-size:18px;text-align:center;padding-top:2px;">参照</label>
		                                                                <input id="file3" type="file" style="display: none;" accept="image/*" ngf-select="selectresumefile($index,$files)">
		                                                            </div>
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                                <div class="row">
		                                                    <p class="col-sm-1" style="padding-left:0px;padding-right:0px;">URL</p>
		                                                    <div class="col-sm-10">
		                                                        <input class="form-control ng-pristine ng-untouched ng-valid ng-empty" id="focusedInput" type="text" placeholder="URL" ng-model="advertitem.url" aria-invalid="false">
		                                                    </div>
		                                                </div>
		                                            </div>
		                                        </div>
		                                        <!-- end ngRepeat: advertitem in advertdata -->
		                                        <div class="row ng-scope" style="margin-bottom:20px;" ng-repeat="advertitem in advertdata">
		                                            <p class="col-sm-1 ng-binding" style="padding-left:0px;padding-right:0px;">広告5</p>
		                                            <div class="col-sm-11">
		                                                <div class="row" style="margin-bottom:10px;">
		                                                    <p class="col-sm-1" style="padding-left:0px;padding-right:0px;">表示画像</p>
		                                                    <div class="col-sm-10">
		                                                        <div class="input-group" style="margin-bottom: 20px">
		                                                            <div class="form-group has-feedback" style="margin-bottom:0px;">
		                                                                <input type="text" class="form-control ng-pristine ng-untouched ng-valid ng-empty" placeholder="表示画像" ng-model="advertitem.image_name" disabled="" aria-invalid="false">
		                                                                <!-- ngIf: advertitem.image_name -->
		                                                            </div>
		                                                            <div class="input-group-btn">
		                                                                <label for="file4" class="submit-blue-left" style="font-size:18px;text-align:center;padding-top:2px;">参照</label>
		                                                                <input id="file4" type="file" style="display: none;" accept="image/*" ngf-select="selectresumefile($index,$files)">
		                                                            </div>
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                                <div class="row">
		                                                    <p class="col-sm-1" style="padding-left:0px;padding-right:0px;">URL</p>
		                                                    <div class="col-sm-10">
		                                                        <input class="form-control ng-pristine ng-untouched ng-valid ng-empty" id="focusedInput" type="text" placeholder="URL" ng-model="advertitem.url" aria-invalid="false">
		                                                    </div>
		                                                </div>
		                                            </div>
		                                        </div>
		                                        <!-- end ngRepeat: advertitem in advertdata -->
		                                        <div class="row ng-scope" style="margin-bottom:20px;" ng-repeat="advertitem in advertdata">
		                                            <p class="col-sm-1 ng-binding" style="padding-left:0px;padding-right:0px;">広告6</p>
		                                            <div class="col-sm-11">
		                                                <div class="row" style="margin-bottom:10px;">
		                                                    <p class="col-sm-1" style="padding-left:0px;padding-right:0px;">表示画像</p>
		                                                    <div class="col-sm-10">
		                                                        <div class="input-group" style="margin-bottom: 20px">
		                                                            <div class="form-group has-feedback" style="margin-bottom:0px;">
		                                                                <input type="text" class="form-control ng-pristine ng-untouched ng-valid ng-empty" placeholder="表示画像" ng-model="advertitem.image_name" disabled="" aria-invalid="false">
		                                                                <!-- ngIf: advertitem.image_name -->
		                                                            </div>
		                                                            <div class="input-group-btn">
		                                                                <label for="file5" class="submit-blue-left" style="font-size:18px;text-align:center;padding-top:2px;">参照</label>
		                                                                <input id="file5" type="file" style="display: none;" accept="image/*" ngf-select="selectresumefile($index,$files)">
		                                                            </div>
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                                <div class="row">
		                                                    <p class="col-sm-1" style="padding-left:0px;padding-right:0px;">URL</p>
		                                                    <div class="col-sm-10">
		                                                        <input class="form-control ng-pristine ng-untouched ng-valid ng-empty" id="focusedInput" type="text" placeholder="URL" ng-model="advertitem.url" aria-invalid="false">
		                                                    </div>
		                                                </div>
		                                            </div>
		                                        </div>
		                                        <!-- end ngRepeat: advertitem in advertdata -->
		                                        <div class="row ng-scope" style="margin-bottom:20px;" ng-repeat="advertitem in advertdata">
		                                            <p class="col-sm-1 ng-binding" style="padding-left:0px;padding-right:0px;">広告7</p>
		                                            <div class="col-sm-11">
		                                                <div class="row" style="margin-bottom:10px;">
		                                                    <p class="col-sm-1" style="padding-left:0px;padding-right:0px;">表示画像</p>
		                                                    <div class="col-sm-10">
		                                                        <div class="input-group" style="margin-bottom: 20px">
		                                                            <div class="form-group has-feedback" style="margin-bottom:0px;">
		                                                                <input type="text" class="form-control ng-pristine ng-untouched ng-valid ng-empty" placeholder="表示画像" ng-model="advertitem.image_name" disabled="" aria-invalid="false">
		                                                                <!-- ngIf: advertitem.image_name -->
		                                                            </div>
		                                                            <div class="input-group-btn">
		                                                                <label for="file6" class="submit-blue-left" style="font-size:18px;text-align:center;padding-top:2px;">参照</label>
		                                                                <input id="file6" type="file" style="display: none;" accept="image/*" ngf-select="selectresumefile($index,$files)">
		                                                            </div>
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                                <div class="row">
		                                                    <p class="col-sm-1" style="padding-left:0px;padding-right:0px;">URL</p>
		                                                    <div class="col-sm-10">
		                                                        <input class="form-control ng-pristine ng-untouched ng-valid ng-empty" id="focusedInput" type="text" placeholder="URL" ng-model="advertitem.url" aria-invalid="false">
		                                                    </div>
		                                                </div>
		                                            </div>
		                                        </div>
		                                        <!-- end ngRepeat: advertitem in advertdata -->
		                                        <div class="row ng-scope" style="margin-bottom:20px;" ng-repeat="advertitem in advertdata">
		                                            <p class="col-sm-1 ng-binding" style="padding-left:0px;padding-right:0px;">広告8</p>
		                                            <div class="col-sm-11">
		                                                <div class="row" style="margin-bottom:10px;">
		                                                    <p class="col-sm-1" style="padding-left:0px;padding-right:0px;">表示画像</p>
		                                                    <div class="col-sm-10">
		                                                        <div class="input-group" style="margin-bottom: 20px">
		                                                            <div class="form-group has-feedback" style="margin-bottom:0px;">
		                                                                <input type="text" class="form-control ng-pristine ng-untouched ng-valid ng-empty" placeholder="表示画像" ng-model="advertitem.image_name" disabled="" aria-invalid="false">
		                                                                <!-- ngIf: advertitem.image_name -->
		                                                            </div>
		                                                            <div class="input-group-btn">
		                                                                <label for="file7" class="submit-blue-left" style="font-size:18px;text-align:center;padding-top:2px;">参照</label>
		                                                                <input id="file7" type="file" style="display: none;" accept="image/*" ngf-select="selectresumefile($index,$files)">
		                                                            </div>
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                                <div class="row">
		                                                    <p class="col-sm-1" style="padding-left:0px;padding-right:0px;">URL</p>
		                                                    <div class="col-sm-10">
		                                                        <input class="form-control ng-pristine ng-untouched ng-valid ng-empty" id="focusedInput" type="text" placeholder="URL" ng-model="advertitem.url" aria-invalid="false">
		                                                    </div>
		                                                </div>
		                                            </div>
		                                        </div>
		                                        <!-- end ngRepeat: advertitem in advertdata -->
		                                        <div class="row ng-scope" style="margin-bottom:20px;" ng-repeat="advertitem in advertdata">
		                                            <p class="col-sm-1 ng-binding" style="padding-left:0px;padding-right:0px;">広告9</p>
		                                            <div class="col-sm-11">
		                                                <div class="row" style="margin-bottom:10px;">
		                                                    <p class="col-sm-1" style="padding-left:0px;padding-right:0px;">表示画像</p>
		                                                    <div class="col-sm-10">
		                                                        <div class="input-group" style="margin-bottom: 20px">
		                                                            <div class="form-group has-feedback" style="margin-bottom:0px;">
		                                                                <input type="text" class="form-control ng-pristine ng-untouched ng-valid ng-empty" placeholder="表示画像" ng-model="advertitem.image_name" disabled="" aria-invalid="false">
		                                                                <!-- ngIf: advertitem.image_name -->
		                                                            </div>
		                                                            <div class="input-group-btn">
		                                                                <label for="file8" class="submit-blue-left" style="font-size:18px;text-align:center;padding-top:2px;">参照</label>
		                                                                <input id="file8" type="file" style="display: none;" accept="image/*" ngf-select="selectresumefile($index,$files)">
		                                                            </div>
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                                <div class="row">
		                                                    <p class="col-sm-1" style="padding-left:0px;padding-right:0px;">URL</p>
		                                                    <div class="col-sm-10">
		                                                        <input class="form-control ng-pristine ng-untouched ng-valid ng-empty" id="focusedInput" type="text" placeholder="URL" ng-model="advertitem.url" aria-invalid="false">
		                                                    </div>
		                                                </div>
		                                            </div>
		                                        </div>
		                                        <!-- end ngRepeat: advertitem in advertdata -->
		                                        <div class="row ng-scope" style="margin-bottom:20px;" ng-repeat="advertitem in advertdata">
		                                            <p class="col-sm-1 ng-binding" style="padding-left:0px;padding-right:0px;">広告10</p>
		                                            <div class="col-sm-11">
		                                                <div class="row" style="margin-bottom:10px;">
		                                                    <p class="col-sm-1" style="padding-left:0px;padding-right:0px;">表示画像</p>
		                                                    <div class="col-sm-10">
		                                                        <div class="input-group" style="margin-bottom: 20px">
		                                                            <div class="form-group has-feedback" style="margin-bottom:0px;">
		                                                                <input type="text" class="form-control ng-pristine ng-untouched ng-valid ng-empty" placeholder="表示画像" ng-model="advertitem.image_name" disabled="" aria-invalid="false">
		                                                                <!-- ngIf: advertitem.image_name -->
		                                                            </div>
		                                                            <div class="input-group-btn">
		                                                                <label for="file9" class="submit-blue-left" style="font-size:18px;text-align:center;padding-top:2px;">参照</label>
		                                                                <input id="file9" type="file" style="display: none;" accept="image/*" ngf-select="selectresumefile($index,$files)">
		                                                            </div>
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                                <div class="row">
		                                                    <p class="col-sm-1" style="padding-left:0px;padding-right:0px;">URL</p>
		                                                    <div class="col-sm-10">
		                                                        <input class="form-control ng-pristine ng-untouched ng-valid ng-empty" id="focusedInput" type="text" placeholder="URL" ng-model="advertitem.url" aria-invalid="false">
		                                                    </div>
		                                                </div>
		                                            </div>
		                                        </div>
		                                        <!-- end ngRepeat: advertitem in advertdata -->
		                                    </div>
		                                </div>
		                            </div>
		                            <div style="margin-top:50px;">
		                                <input type="submit" name="submit" class="submit-blue-btn" value="保存する" ng-click="saveadvertdata()">
		                            </div>
		                        </div>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
	</div>
<?php include ('../../inc/footer.php'); ?>
