<?php include ('../inc/header.php'); ?>
<div class="mainpage">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
			<?php include ('../inc/breadcrumb.php'); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 mainpage">
				<div class="row">
			        <div class="col-sm-12">
			            <p class="text-step "><b><span>STEP1</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;対応可能施策情報の選択</b></p>
			        </div>
			    </div>
			    <div class="col-sm-12">
			    	<div class="row">
			    		<ul class="nav nav-tabs tab-1"> 
                            <li class="tab-style-grey">
                                <a href="agency/Csetbalance.php">対応可能施策の登録</a>
                            </li>                                     
                            <li class="tab-style-grey active">
                                <a href="agency/Csetbalance-1.php">対応可能施策一覧</a>
                            </li> 
                        </ul>
			    	</div>
			    </div>
			    <div class="row">
		            <div class="col-sm-3 mgt-20 pdl-45">
		                <input class="control-label" type="checkbox">一括チェック
		            </div>
		            <div class="col-sm-9 text-right mgt-20">
		            	<button  class="btn btn-default btn-style-shadow-grey" type="button">すべて削除</button>
		                <button class="btn btn-default btn-style-shadow-grey" type="button">設定した施策を非表示</button>
		                
		            </div>
		        </div>
				<div class="row subsidy-list">
					<div class="col-sm-12">
						<div class="subsidy-list-item">
							<div class="row">
								<div class="col-sm-10">
									<div class="index-boxcol2-sub">
											<div class="create-link-box">
												<div class="col-sm-1 mgt-20">
													<label><input type="checkbox" name=""></label>
												</div>
												<div class="col-sm-2">
													<img src="assets/images/agency-list-01.jpg" alt="">
												</div>
												<div class="col-sm-9">

													<p>
														<a href="#" class="boxcol2-a-2"><span class="sidy-tbig">タイトルタイトルタイトルタイトルタイトル</span><br><strong>登録期関:</strong>神奈川県 横浜市   /   <strong>募集時期:</strong>毎年4月1日から3月31日まで</a>
														<span>テキストテキストテキストテキストテキテキストテキストテキストテキストテキストテキストテキストテキストテキテキストテキストテキストテキストテキテキストテキストテキストテキストテキストテキストテキストテキストテキ...</span>
													</p>
													<div class="middle-boxcol2">
														<ul>
															<li><button type="button" class="btn btn-default btn-style-grey" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="お気に入りボタンの１つで、興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。">提案を検討</button></li>
															<li><button type="button" class="btn btn-default btn-style-grey" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="お気に入りボタンの１つで、興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。">興味あり</button></li>
															<li><button type="button" class="btn btn-default btn-style-grey" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="必要がない、自分に関係がない施策が表示された場合は、非表示としてください。非表示とすることで自動検索であなたに関連しない施策が表示されなくなります。">非表示</button></li>
														</ul>
													</div> <!-- end .middle-boxcol2 -->
												</div>
											</div> <!-- end .create-link-box -->
											
											
									</div> <!-- end item index-boxcol2 -->


								</div>	<!-- end col-sm-10 -->
							</div> <!-- end .row -->
						</div> <!-- end .sidylist-item -->
						<div class="clearfix"></div>
						 <div class="text-center bsearch-btn-s">
		                    <button class="btn btn-default btn-style-shadow-grey w120px" type="button">検索に戻る</button>
		                </div>
					</div> <!-- end .div.col-sm-12 -->

				</div> <!-- end .row -->
				<div class="row">
			        <div class="col-sm-12">
			            <p class="text-step "><b>施策対応費用の設定</b></p>
			        </div>
			    </div>
			    <div class="row">
                        <div class="col-sm-8 clientjob-1-9">
                            <table class="table table-hover none-over-table table-bordered">
                                <tbody>
                                    <tr>
                                        <td class="div-style-blue2 text-primary tit">
                                            <select class="form-control " aria-invalid="false">
                                                <option ng-repeat="savedbudget in savedbudgetarray" value="0" class="ng-binding " selected="selected">登録内容1</option>
                                            </select>
                                            <b>&nbsp;</b>
                                        </td>
                                        <td class="pd0">
                                            <div class="col-sm-12 mgt-20">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <h5>業務内容</h5>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label><input class="control-label checkdis" type="checkbox" data-tgdis="document-surrogate-cost" id="checkbox-document-surrogate-cost" aria-invalid="false"> 書類代行費用</label>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group has-feedback">
                                                                <input min="0" id="document-surrogate-cost" data-s="s-document-surrogate-cost" class="form-control   sum" placeholder="金額" disabled="disabled" aria-invalid="false" value="0">
                                                                <span class="form-control-feedback">円</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label><input class="control-label checkdis" type="checkbox" aria-invalid="false" data-tgdis="success-fee" id="checkbox-success-fee"> 成功報酬</label>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group has-feedback">
                                                                <input min="0" max="100" id="success-fee" class="form-control" placeholder="金額" disabled="disabled" value="0" aria-invalid="false">
                                                                <span class="form-control-feedback">%</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="row">
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
                                                                <input min="0" type="number" id="starting-money" name="starting-money" class="form-control sum" data-s="s-starting-money" placeholder="金額" value="0">
                                                                <span class="form-control-feedback">円</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <h5>その他費用</h5>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <input type="text" name="name-other1" data-s="name-other1" class="form-control set-name" placeholder="費用名" aria-invalid="false">
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group has-feedback">
                                                                <input min="0" class="form-control sum" placeholder="金額" aria-invalid="false" name="other-1" data-s="s-other1" id="other-1" value="0">
                                                                <span class="form-control-feedback">円</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <input type="text" name="name-other2" data-s="name-other2" class="form-control set-name" placeholder="費用名" aria-invalid="false">
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group has-feedback">
                                                                <input min="0" class="form-control sum" placeholder="金額" aria-invalid="false" name="other-2" id="other-2" data-s="s-other2" value="0">
                                                                <span class="form-control-feedback">円</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <input type="text" name="name-other3" data-s="name-other3" class="form-control set-name" placeholder="費用名" aria-invalid="false">
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group has-feedback">
                                                                <input min="0" class="form-control sum" placeholder="金額" aria-invalid="false" name="other-3" id="other-3" data-s="s-other3" value="0">
                                                                <span class="form-control-feedback">円</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <input type="text" name="name-other4" data-s="name-other4" class="form-control set-name" placeholder="費用名" aria-invalid="false">
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group has-feedback">
                                                                <input min="0" class="form-control sum" placeholder="金額" aria-invalid="false" name="other-4" id="other-4" data-s="s-other4" value="0">
                                                                <span class="form-control-feedback">円</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <input type="text" name="name-other5" data-s="name-other5" class="form-control set-name" placeholder="費用名" aria-invalid="false">
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group has-feedback">
                                                                <input min="0" class="form-control sum" placeholder="金額" aria-invalid="false" name="other-5" id="other-5" data-s="s-other5" value="0">
                                                                <span class="form-control-feedback">円</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <p class="cost-p">合計</p>
                                                        </div>
                                                        <div class="col-sm-4">
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <p class="cost-p-1"><span id="show-total">0</span>
                                                                <t>円</t>
                                                                <input type="hidden" value="0" name="total" id="total">
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                            	<p class="text-right color-red font12">※受取総額から事務手数料5.5％が差し引かれます</p>
                                            </div>
                                            <div class="col-sm-12 div-style-light-brown">
                                                <div class="col-sm-3">
                                                    <h5>支払総額</h5>
                                                </div>
                                                <div class="col-sm-9 center-div">
                                                    <p class="cost-p-1">
                                                        <span class="showtotal-all">0</span> 円 + (取得助成金・補助金総額の）&nbsp;
                                                        <span class="show-pencent">0</span>％
                                                        <input type="hidden" value="0" name="all-total" id="all-total">
                                                        <input type="hidden" value="0" name="pencent" id="pencent">
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
			</div> <!-- end .mainpage -->
		</div> <!-- end .row -->
	</div> <!-- end .container -->
</div> <!-- end .mainpage -->
<div class="clearfix"></div>
<div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg modal-dialog-centered text-center" role="document">
	    <div class="modal-content" style="height: 491.4px;">
	        <div class="modal-header text-center">
	            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                <span aria-hidden="true">×</span>
	            </button>
	            <h5 class="modal-title">マニュアル</h5>
	        </div>
	        <div class="modal-body">
	            <iframe width="100%" height="100%" src="manuals/registration_policy3/operationlecture.html" frameborder="0"></iframe>
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
            $('#total2').text(total.val());
            if($("#document-surrogate-cost").attr('disabled') != "disabled"){
                $("#all-total").val(parseFloat(total.val()) + parseFloat($('#document-surrogate-cost').val()) + parseFloat($("#starting-money").val()));
            }else{
                $("#all-total").val(parseFloat(total.val()) + parseFloat($("#starting-money").val()));
            }
            $(".showtotal-all").text($("#all-total").val());
            var s_modal = $(this).attr('data-s');
            $("#"+s_modal).text($(this).val());
        });

        $('#success-fee').change(function(){
            $(".show-pencent").text($("#success-fee").val()); 
            $("#s-success-fee").text($("#success-fee").val()); 
        }) 

        $("#checkbox-success-fee").click(function(){
                if($("#success-fee").attr('disabled') == "disabled"){ 
                    $(".show-pencent").text($("#success-fee").val()); 
                    $("#s-success-fee").text($("#success-fee").val()); 

                }else{
                  $(".show-pencent").text("0");   
                  $("#s-success-fee").text("0");     
                } 
        })

        $("#checkbox-document-surrogate-cost").click(function(){
                var total = $("#total");
                if($("#document-surrogate-cost").attr('disabled') == "disabled"){ 
                   $("#all-total").val(parseFloat(total.val()) + parseFloat($('#document-surrogate-cost').val()) + 
                    parseFloat($("#starting-money").val()));
                }else{
                    $("#all-total").val(parseFloat(total.val()) + parseFloat($("#starting-money").val()));  
                }
                $(".showtotal-all").text($("#all-total").val());    
        })

        $(".set-name").change(function(){
             var s_modal = $(this).attr('data-s');
            $("#"+s_modal).text($(this).val());
        })

        
    })
</script>