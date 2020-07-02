<?php include ('../inc/header.php'); ?>
<div class="mainpage clientprofile-1">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<ol class="breadcrumb">
					<li><a class="bg-color" href="#">TOPページ</a></li>
					<li class="active">プロフィール</li>
				</ol>	
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">プロフィール</h1>
				<p class="page-description">プロフィールを詳細に記載していると、通常より申請が4倍通りやすくなる傾向があります。</p>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-2 sidebar-left">
				<?php include ('../inc/mypage-sidebar-left.php'); ?>
			</div>
			<div class="col-sm-8 mainpage">
				<div class="row">
					<div class="col-sm-12">
						<div class="profile-av">
							<div class="row">
								<div class="col-sm-4">
									<img class="profile-user-avatar" src="assets/images/avatar.png">
								</div>
								<div class="col-sm-8">
									<h4 class="main-user-name">山田太郎（企業）</h4>
									<p class="main-user-id">ユーザーID：115</p>
									<p class="main-user-total-job">実績：　4件</p>
									<div class="star-rating">
										<select id="example-fontawesome" name="rating" autocomplete="off">
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
										</select>
								  </div>
								</div>
							</div>
						</div> <!-- end .profile-av -->
					</div>	<!-- end middle page -->
				</div>
				<div class="row">
					<div class="col-sm-12">
						<ul class="tab-profile nav nav-tabs nav-justified">
							<li class="tab-style-grey active"><a href="mypage/clientprofile-1.php"> <img src="assets/images/manual.png" alt="">プロフィール</a></li>
							<li class="tab-style-grey"><a href="mypage/clientprofile-3.php"><img src="assets/images/manual.png" alt=""> 希望内容 </a></li>
							<li class="tab-style-grey"><a href="mypage/clientprofile-5.php">評価・実績</a></li>
							<li class="tab-style-grey"><a href="mypage/clientprofile-6.php">募集案件</a></li>
							<li class="tab-style-grey"><a href="mypage/clientprofile-7.php"><img src="assets/images/manual.png" alt="">費用</a></li>
						</ul>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<h4 class="pagerow-title">
							<span>登録者情報</span>
							<a href="mypage/clientprofile-2.php" class="btn-primary btn btn-style-shadow-green btn-success right-title">表示する</a>
						</h4>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<form>
							<div class="profile-reg-form text-center">
							    <dl class="row">
							        <dt class="col-sm-4">
							            <h4>ユーザー名</h4>
							        </dt>
							        <dd class="col-sm-8">
							            <h4 >icestorm（<strong>ユーザー名</strong>）</h4>
							        </dd>
							    </dl>
							    <dl class="row">
							        <dt class="col-sm-4">
							            <h4>表示名</h4>
							        </dt>
							        <dd class="col-sm-8">
							            <input type="text" class="form-control " placeholder="表示名" name=" name">
							        </dd>
							    </dl>
							    <dl class="row">
							        <dt class="col-sm-4">
							            <h4>担当者名</h4>
							        </dt>
							        <dd class="col-sm-8">
							            <input type="text" class="form-control " placeholder="担当者名" name="contact">
							        </dd>
							    </dl>
							</div>
							<h4 class="pagerow-title">
							<span>事業所情報</span>
							</h4>
							<div class="profile-reg-form text-center">

							    <dl class="row">
							        <dt class="col-sm-4">
							            <h4>区分</h4>
							        </dt>
							        <dd class="col-sm-8">
							            <label class="col-sm-4">
							            	<input class="control-label ng-valid ng-not-empty ng-dirty ng-touched ng-valid-parse" type="radio" name="section" value="1" checked="checked">個人
							            </label>
							            <label class="col-sm-4">
							            	<input class="control-label ng-valid ng-not-empty ng-dirty ng-touched" type="radio" name="section" value="2">法人
							            </label>
							        </dd>
							    </dl>
							    <dl class="row">
							        <dt class="col-sm-4">
							            <h4>会社名or事業所名</h4>
							        </dt>
							        <dd class="col-sm-8">
							            <input type="text" class="form-control " placeholder="株式会社サムライ" name="company">
							        </dd>
							    </dl>
							    <dl class="row">
							        <dt class="col-sm-4">
							            <h4>法人番号</h4>
							        </dt>
							        <dd class="col-sm-8">
							            <input type="text" class="form-control " placeholder="法人番号" name="corporate-number">
							        </dd>
							    </dl>
							    <dl class="row">
							        <dt class="col-sm-4">
							            <h4>代表者名</h4>
							        </dt>
							        <dd class="col-sm-8">
							            <input type="text" class="form-control " placeholder="代表者名" name="representative-name">
							        </dd>
							    </dl>
							    <dl class="row">
							        <dt class="col-sm-4">
							            <h4>郵便番号</h4>
							        </dt>
							        <dd class="col-sm-8">
							            <input type="text" class="form-control " placeholder="郵便番号" name="postal-code">
							        </dd>
							    </dl>
							    <dl class="row">
							        <dt class="col-sm-4">
							            <h4>所在地</h4>
							        </dt>
							        <dd class="col-sm-8">
							            <div class="col-sm-4">
							            	<div class="row angularsl">
										        <select class="form-control form-select" id="local-select" name="location">
										            <option value="1">1</option>
										            <option value="2">2</option>
										            <option value="3">3</option>
										            <option value="4">4</option>
										        </select>
									        </div>
									    </div>
									    <div class="col-sm-3">
									    	<label>
									        <input class="control-label" name="location-other" id="location-other" type="checkbox" >その他</label>
									    </div>
									    <div class="col-sm-5">
									    	<div class="row">
										        <input type="text" class="form-control" placeholder="所在地" id="location-other-text" disabled="disabled" aria-invalid="false">
									        </div>
									    </div>
							        </dd>
							    </dl>
							    <dl class="row">
							        <dt class="col-sm-4">
							            <h4>市区町村</h4>
							        </dt>
							        <dd class="col-sm-8">
							            <div class="col-sm-4">
							            	<div class="row angularsl">
										        <select class="form-control form-select" name="Municipality" id="Municipality-select">
										            <option value="1">1</option>
										            <option value="2">2</option>
										            <option value="3">3</option>
										            <option value="4">4</option>
										        </select>
									        </div>
									    </div>
									    <div class="col-sm-3">
									    <label>
									        <input class="control-label" name="municipality-other" id="municipality-other" type="checkbox" >その他</label>
									    </div>
									    <div class="col-sm-5">
									    	<div class="row">
										        <input type="text" id="municipality-other-text" class="form-control" placeholder="所在地" disabled="disabled" class="municipality-other-text" aria-invalid="false">
									        </div>
									    </div>
							        </dd>
							    </dl>
							    <dl class="row">
							        <dt class="col-sm-4">
							            <h4>番地・建物名</h4>
							        </dt>
							        <dd class="col-sm-8">
							            <input type="text" class="form-control " placeholder="プロフィール画像" name="address-building-name">
							        </dd>
							    </dl>
							    <dl class="row">
							        <dt class="col-sm-4">
							            <h4>電話番号</h4>
							        </dt>
							        <dd class="col-sm-8">
							            <input type="text" class="form-control " placeholder="電話番号" name="phone-number">
							        </dd>
							    </dl>
							    <dl class="row">
							        <dt class="col-sm-4">
							            <h4>FAX番号</h4>
							        </dt>
							        <dd class="col-sm-8">
							            <input type="text" class="form-control " placeholder="FAX番号" name="fax">
							        </dd>
							    </dl>
							    <dl class="row">
							        <dt class="col-sm-4">
							            <h4>プロフィール画像</h4>
							        </dt>
							        <dd class="col-sm-8">
							            <div class="input-group" >
							                <input type="text" class="form-control "  aria-invalid="false" name="profile-image">
							                <div class="input-group-btn">
							                    <label for="file" class="btn btn-primary">参照</label>
							                    <input id="file" type="file" name="profile-image" accept="image/*">
							                </div>
							            </div>
							        </dd>
							    </dl>
							    <dl class="row">
							        <dt class="col-sm-4">
							            <h4>URL</h4>
							        </dt>
							        <dd class="col-sm-8">
							            <input type="text" class="form-control " placeholder="URL" name="url">
							        </dd>
							    </dl>
							    <dl class="row">
							        <dt class="col-sm-4">
							            <h4>自己紹介</h4>
							        </dt>
							        <dd class="col-sm-8">
							            <textarea class="form-control " rows="6" aria-invalid="false" name="self-introduction">                
            							</textarea>
							        </dd>
							    </dl>
							    <dl class="row">
							    	<div class="mgt-20">
							        <div class="col-sm-4">
							            <h4>業種</h4>
							        </div>
							        <div class="col-sm-8  text-left">
							                <table class="table table-hover table-bordered">
							                    <tbody>
							                        <tr>
							                            <td>
							                                <label>
							                                    <input class="control-label" type="checkbox" aria-hidden="false">
							                                    農林水産業</label>
							                            </td>
							                            <td>
							                                <label>
							                                    <input class="control-label" type="checkbox" aria-hidden="false" checked="checked">
							                                    運輸業，郵便業</label>
							                            </td>
							                        </tr>
							                        <tr>
							                            <td>
							                                <label>
							                                <input class="control-label" type="checkbox" aria-hidden="false">
							                                    派遣業・有料職業紹介業</label>
							                            </td>
							                            <td>
							                                <label>
							                                <input class="control-label" type="checkbox" aria-hidden="false" checked="checked">
							                                    IT業</label>
							                            </td>
							                        </tr>
							                        <tr>
							                            <td>
							                                <label>
							                                    <input class="control-label" type="checkbox" aria-hidden="false" checked="checked">
							                                    情報通信業</label>
							                            </td>
							                            <td>
							                                <label>
							                                    <input class="control-label" type="checkbox" aria-hidden="false">
							                                    電気・ガス・ 熱供給・水道業</label>
							                            </td>
							                        </tr>
							                        <tr>
							                            <td>
							                                <label>
							                                    <input class="control-label" type="checkbox" aria-hidden="false">
							                                    製造業</label>
							                            </td>
							                            <td>
							                                <label>
							                                    <input class="control-label" type="checkbox" aria-hidden="false">
							                                    建設業</label>
							                            </td>
							                        </tr>
							                        <tr>
							                            <td>
							                                <label>
							                                    <input class="control-label" type="checkbox" aria-hidden="false">
							                                    鉱業，採石業， 砂利採取業</label>
							                            </td>
							                            <td>
							                                <label>
							                                    <input class="control-label" type="checkbox" aria-hidden="false">
							                                    漁業</label>
							                            </td>
							                        </tr>
							                        <tr>
							                            <td>
							                                <label>
							                                    <input class="control-label" type="checkbox" aria-hidden="false" checked="checked">
							                                    卸売業・小売業</label>
							                            </td>
							                            <td>
							                                <label>
							                                    <input class="control-label" type="checkbox" aria-hidden="false">
							                                    金融業・保険業</label>
							                            </td>
							                        </tr>
							                        <tr>
							                            <td>
							                                <label>
							                                    <input class="control-label" type="checkbox" aria-hidden="false" checked="checked">
							                                    不動産業， 物品賃貸業</label>
							                            </td>
							                            <td>
							                                <label>
							                                    <input class="control-label" type="checkbox" aria-hidden="false">
							                                    協同組合</label>
							                            </td>
							                        </tr>
							                        <tr>
							                            <td>
							                                <label>
							                                    <input class="control-label" type="checkbox" aria-hidden="false">
							                                    医療業</label>
							                            </td>
							                            <td>
							                                <label>
							                                    <input class="control-label" type="checkbox" aria-hidden="false">
							                                    福祉業</label>
							                            </td>
							                        </tr>
							                        <tr>
							                            <td>
							                                <label>
							                                    <input class="control-label" type="checkbox" aria-hidden="false">
							                                    飲食サービス業</label>
							                            </td>
							                            <td>
							                                <label>
							                                    <input class="control-label" type="checkbox" aria-hidden="false">
							                                    教育，学習支援業</label>
							                            </td>
							                        </tr>
							                        <tr>
							                            <td>
							                                <label><input class="control-label" type="checkbox" aria-hidden="false">
							                                    娯楽業</label>
							                            </td>
							                            <td>
							                                <label><input class="control-label" type="checkbox" aria-hidden="false">
							                                    生活関連サービス業</label>
							                            </td>
							                        </tr>
							                        <tr>
							                            <td>
							                                <label>
							                                    <input class="control-label" type="checkbox" aria-hidden="false" checked="checked">
							                                    宿泊業</label>
							                            </td>
							                            <td>
							                                <label>
							                                    <input class="control-label" type="checkbox" aria-hidden="false" checked="checked">
							                                    学術研究，専門・ 技術サービス業</label>
							                            </td>
							                        </tr>
							                        <tr>
							                            <td>
							                                <label>
							                                    <input class="control-label" type="checkbox" aria-hidden="false" checked="checked">
							                                    一般家庭</label>
							                            </td>
							                            <td>
							                                <label>
							                                    <input class="control-label" type="checkbox" aria-hidden="false" checked="checked">
							                                    商店街/商工会</label>
							                            </td>
							                        </tr>
							                        <tr>
							                            <td>
							                                <label>
							                                    <input class="control-label" type="checkbox" aria-hidden="false">
							                                    公務</label>
							                            </td>
							                            <td>
							                                <label>
							                                    <input class="control-label ng-hide" type="checkbox" aria-hidden="true">
							                                    </label>
							                            </td>
							                        </tr>
							                    </tbody>
							                </table>
							        	</div>
							        </div>
							    </dl>
							    <dl class="row" >
							        <div class="col-sm-4">
							            <h4>設立年月</h4>
							        </div>
							        <div class="col-sm-3">
							            <div class="form-group has-feedback">
							                <input type="number" class="form-control ng-valid ng-not-empty ng-valid-min ng-dirty ng-valid-number ng-touched" min="1" aria-invalid="false" style="">
							                <span class="form-control-feedback">年</span>
							            </div>
							        </div>
							        <div class="col-sm-2">
							            <div class="form-group has-feedback">
							                <input type="number" class="form-control ng-valid ng-not-empty ng-valid-min ng-valid-max ng-dirty ng-valid-number ng-touched" min="1" max="12" aria-invalid="false" style="">
							                <span class="form-control-feedback">月</span>
							            </div>
							        </div>
							        <div class="col-sm-2">
							            <div class="form-group has-feedback">
							                <input type="number" class="form-control  ng-valid-min ng-valid-max" min="1" max="31" aria-invalid="false">
							                <span class="form-control-feedback">日</span>
							            </div>
							        </div>
							    </dl>
							    <dl class="row">
							        <div class="col-sm-4">
							            <h4>資本金</h4>
							        </div>
							        <div class="col-sm-8">
							            <div class="form-group has-feedback">
							                <input type="number" class="form-control  ng-valid ng-not-empty ng-valid-min ng-touched" placeholder="資本金" min="0" >
							                <span class="form-control-feedback">万円</span>
							            </div>
							        </div>
							    </dl>
							    <dl class="row">
							        <div class="col-sm-4">
							            <h4>社員数</h4>
							        </div>
							        <div class="col-sm-3  text-left">
							            <h4>（正社員）</h4>
							        </div>
							        <div class="col-sm-5">
							            <div class="form-group has-feedback">
							                <input type="number" class="form-control  ng-valid-min" min="0">
							                <span class="form-control-feedback">人</span>
							            </div>
							        </div>
							    </dl>
							    <dl class="row">
							        <div class="col-sm-4">
							            <h4>採用予定数</h4>
							        </div>
							        <div class="col-sm-3  text-left">
							            <h4>（正社員）</h4>
							        </div>
							        <div class="col-sm-5">
							            <div class="form-group has-feedback">
							                <input type="number" class="form-control  ng-valid-min" min="0">
							                <span class="form-control-feedback">人</span>
							            </div>
							        </div>
							    </dl>
							    <dl class="row">
							        <div class="col-sm-4">
							            <h4>社員数</h4>
							        </div>
							        <div class="col-sm-3  text-left">
							            <h4>（バイト・派遣）</h4>
							        </div>
							        <div class="col-sm-5">
							            <div class="form-group has-feedback">
							                <input type="number" class="form-control  ng-valid-min" min="0">
							                <span class="form-control-feedback">人</span>
							            </div>
							        </div>
							    </dl>
							    <dl class="row">
							        <div class="col-sm-4">
							            <h4>採用予定数</h4>
							        </div>
							        <div class="col-sm-3  text-left">
							            <h4>（バイト・派遣）</h4>
							        </div>
							        <div class="col-sm-5">
							            <div class="form-group has-feedback">
							                <input type="number" class="form-control  ng-valid-min" min="0">
							                <span class="form-control-feedback">人</span>
							            </div>
							        </div>
							    </dl>
							    <dl class="row">
							        <div class="col-sm-4">
							            <h4>正社員化の予定数</h4>
							        </div>
							        <div class="col-sm-3  text-left">
							            <h4>（バイト・派遣）</h4>
							        </div>
							        <div class="col-sm-5">
							            <div class="form-group has-feedback">
							                <input type="number" class="form-control  ng-valid-min" min="0">
							                <span class="form-control-feedback">人</span>
							            </div>
							        </div>
							    </dl>
							    <dl class="row">
							        <div class="col-sm-4">
							            <h4>60歳以上の社員数</h4>
							        </div>
							        <div class="col-sm-3  text-left">
							            <h4></h4>
							        </div>
							        <div class="col-sm-5">
							            <div class="form-group has-feedback">
							                <input type="number" class="form-control  ng-valid-min" min="0">
							                <span class="form-control-feedback">人</span>
							            </div>
							        </div>
							    </dl>
							    <div class="row mb20">
							        <input type="submit" name="submit" class="btn-primary btn btn-submit" value="登録する"></input>
							        <!-- xữ lý dữ liệu xong đến page mypage/clientprofile-2.php -->
							    </div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-sm-2 sidebar-right">
				<?php include ('../inc/mypage-sidebar-right.php'); ?>
			</div>
		</div>
	</div>
</div>
<?php include ('../inc/footer.php'); ?>