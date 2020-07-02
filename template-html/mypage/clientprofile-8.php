<?php include ('../inc/header.php'); ?>
<div class="mainpage">
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
							<li class="tab-style-grey"><a href="mypage/clientprofile-1.php"> <img src="assets/images/manual.png" alt="">プロフィール</a></li>
							<li class="tab-style-grey"><a href="mypage/clientprofile-3.php"><img src="assets/images/manual.png" alt=""> 希望内容 </a></li>
							<li class="tab-style-grey"><a href="mypage/clientprofile-5.php">評価・実績</a></li>
							<li class="tab-style-grey"><a href="mypage/clientprofile-6.php">募集案件</a></li>
							<li class="tab-style-grey  active"><a href="mypage/clientprofile-7.php"><img src="assets/images/manual.png" alt="">費用</a></li>
						</ul>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<h4 class="pagerow-title">
							<span>代行業務費用</span>
							<a href="mypage/clientprofile-7.php" class="btn-primary btn btn-style-shadow-green btn-success right-title">表示する</a>
						</h4>
					</div>
				</div>
				<div class="row">
					<p class="col-sm-12 p-text1 font16">代行業務費用を設定しておくと、依頼者に費用を伝える際に、登録した費用を呼び出すことができます。<br>
                        代行業務費用が決まっている場合は、設定しておくと、入力の手間を省くことができます。</p>
				</div>
				<div class="row">
                    <div class="col-sm-12">
                        <h4 class="pagerow-title">
                            <span>設定登録費用一覧</span>
                        </h4>
                    </div>
                </div>
                <div class="row clientprofile-8">
                    <div class="col-sm-12">
                    <form method="post" action="#">
                    <table class="table table-hover table-bordered">
                        <tbody>
                            <tr>
                                <td class="div-style-blue2 text-primary">
                                    <select class="form-control ">
                                        <option value="0" class="ng-binding " selected="selected">登録内容1</option>
                                    </select>
                                    <b>&nbsp;</b>
                                    <table>
                                        <tbody><tr>
                                            <td>
                                                <button type="button" id="btn-open-modal" class="btn-danger btn btn-style-shadow-red btn-success">削除する</button>
                                            </td>
                                        </tr>
                                    </tbody></table>
                                </td>
                                <td>
                                    <div class="col-sm-12" align="right">
                                        <font>※受取総額から事務手数料5.5％が差し引かれます</font>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="col-sm-3">
                                            <h5>業務内容</h5>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label>
                                                        <input id="document-surrogate-cost" class="control-label" type="checkbox">書類代行費用 
                                                    </label>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group has-feedback">
                                                        <input id="document-surrogate-cost-text" type="number" class="form-control " placeholder="金額"  disabled="disabled" aria-invalid="false">
                                                        <span class="form-control-feedback">円</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" >
                                                <div class="col-sm-4">
                                                    <label >
                                                        <input id="success-fee" class="control-label" type="checkbox"  aria-invalid="false">成功報酬 
                                                    </label>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group has-feedback">
                                                        <input type="number" id="success-fee-text" class="form-control " placeholder="金額" disabled="disabled" aria-invalid="false">
                                                        <span class="form-control-feedback">%</span>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="col-sm-3">
                                            <h5>着手金</h5>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <h5>着手金</h5>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group has-feedback">
                                                        <input type="number" class="form-control " placeholder="金額" aria-invalid="false">
                                                        <span class="form-control-feedback">円</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="col-sm-3">
                                            <h5>その他費用</h5>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <p class="cost-p">合計</p>
                                                </div>
                                                <div class="col-sm-4">
                                                    <p>
                                                        <span id="show-total" >0</span>円</p>
                                                        <input type="hidden" name="total" id="total">
                                                </div>
                                                <div class="col-sm-4">
                                                </div>
                                            </div>
                                            <div class="row " >
                                                <div class="col-sm-4"><h5 ng-if="$index==0" class="">内訳</h5>
                                                </div>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" placeholder="費用名" aria-invalid="false">
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group has-feedback">
                                                        <input type="number" class="form-control sum" name="other-1" id="other-1" placeholder="金額" value="0">
                                                        <span class="form-control-feedback">円</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row " >
                                                <div class="col-sm-4">
                                                </div>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" placeholder="費用名" aria-invalid="false">
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group has-feedback">
                                                        <input type="number" name="other-2" id="other-2" value="0" class="form-control sum" placeholder="金額" aria-invalid="false">
                                                        <span class="form-control-feedback">円</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row " >
                                                <div class="col-sm-4">
                                                </div>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" placeholder="費用名" aria-invalid="false">
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group has-feedback">
                                                        <input type="number" name="other-3" id="other-3" class="form-control sum" placeholder="金額" aria-invalid="false" value="0">
                                                        <span class="form-control-feedback">円</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row " >
                                                <div class="col-sm-4">
                                                </div>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" placeholder="費用名" aria-invalid="false">
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group has-feedback">
                                                        <input type="number" name="other-4" id="other-4" class="form-control sum" placeholder="金額" aria-invalid="false" value="0">
                                                        <span class="form-control-feedback">円</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row " >
                                                <div class="col-sm-4">
                                                </div>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" placeholder="費用名" aria-invalid="false">
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group has-feedback">
                                                        <input type="number" class="form-control sum" name="other-5" id="other-5"  aria-invalid="false" value="0">
                                                        <span class="form-control-feedback">円</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                </div>
                                                <div class="col-sm-4">
                                                    <submit type="submit" class="btn-primary btn btn-style-shadow-green btn-success">設定を保存</submit>
                                                    <!-- xữ lý xong về clientprofile-7 -->
                                                </div>
                                                <div class="col-sm-4">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    </form>
                    </div>
                </div>
                <div id="myModal" class="modal fade  in">
                  <div class="modal-dialog">
                    <div class="modal-content"> 
                        <p class="modal-header">テンプレートから削除しますか？
                        </p>                     
                      <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-6 col-sm-offset-3">
                                <button type="button" class="btn btn-success btn-style-shadow-green" " data-dismiss="modal">はい</button>
                                <button type="button" id="close-modal" class="btn btn-danger btn-style-shadow-red exit" data-dismiss="modal">いいえ</button>        
                            </div>
                        </div>
                      </div>
                    </div>
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
<script type="text/javascript">
    $(document).ready(function(){
        $(".sum").change(function(){
            var total = $("#total");
            var showtotal = $("#showtotal");
            total.val(parseFloat($('#other-1').val()) + parseFloat($('#other-2').val()) + parseFloat($('#other-3').val()) + parseFloat($('#other-4').val()) + parseFloat($('#other-5').val()));
            $("#show-total").text(total.val());
        });
    })
</script>