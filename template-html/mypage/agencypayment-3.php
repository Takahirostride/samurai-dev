<?php include ('../inc/header.php'); ?>
<div class="mainpage">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<ol class="breadcrumb">
					<li><a class="bg-color" href="#">TOPページ</a></li>
					<li class="active">支払い管理</li>
				</ol>	
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">支払い管理</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-2 sidebar-left">
				<?php include ('../inc/mypage-sidebar-left.php'); ?>
			</div>
			<div class="col-sm-10 mainpage">
                <div class="col-sm-12 clientjob-tab mb20">
                    <div class="row">
                        <ul class="nav nav-tabs tab-1"> 
                            <li class="tab-style-grey">
                                <a href="mypage/agencypayment-1.php">入出金履歴</a>
                            </li>                                     
                            <li class="tab-style-grey active">
                                <a href="mypage/agencypayment-2.php">支払管理</a>
                            </li> 
                            <li class="tab-style-grey">
                                <a href="mypage/agencypayment-3.php">出金管理</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="btn-group">
                            <button type="button" class="btn btn-group-style-blue1 w120px">出金可能額</button>
                            <button type="button" class="btn btn-group-style-blue1 w120px"><span class="ng-binding">0</span>円</button>
                        </div>
                    </div>

                </div>
                <div class="row mgt-20">
                    <div class="col-sm-12">
                        <table class="table table-bordered table-hover">
                            <thead class="div-style-blue2">
                            <tr>
                                <th class="w25">振込日</th>
                                <th class="w15">報酬確定日</th>
                                <th class="w15">報酬金額合計</th>
                                <th class="w15">振込手数料</th>
                                <th class="w15">振込予定額</th>
                                <th class="w15">状態</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                <form action="" method="POST" role="form">
                        <div class="col-sm-12">
                            <h3 class="page-title">振込先口座情報</h3>
                            <p class="mgt-30">※ 獲得した報酬を振り込む銀行口座を登録してください。</p>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-bordered tableformtitle">
                                        <tbody>
                                            <tr>
                                                <th>銀行名</th>
                                                <td>
                                                    <div class="col-sm-4">
                                                        <div class="angularsl">
                                                            <select name="" id="locationselect2">
                                                                <option value="全国">全国</option>
                                                                <option value="北海道">北海道</option>
                                                                <option value="青森県">青森県</option>
                                                                <option value="岩手県">岩手県</option>
                                                                <option value="宮城県">宮城県</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="location" class="form-control" placeholder="" disabled>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>銀行コード</th>
                                                <td>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="location" class="form-control" placeholder="" disabled>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table><!-- end table -->
                                    <table class="table table-bordered tableformtitle">
                                        <tbody>
                                            <tr>
                                                <th>支店名</th>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <input type="text" name="location" class="form-control" placeholder="">
                                                    </div>
                                                </td>
                                                <th>支店コード</th>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <input type="text" name="location" class="form-control" placeholder="">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>口座種別</th>
                                                <td colspan="3">
                                                    <div class="col-sm-2">
                                                        <label class="radio-inline">
                                                            <input type="radio" name="inlineRadioOptions" value="option1"> 普通
                                                        </label>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label class="radio-inline">
                                                            <input type="radio" name="inlineRadioOptions" value="option1"> 当座
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>口座番号</th>
                                                <td colspan="3">
                                                    <div class="col-sm-12">
                                                        <input type="text" name="location" class="form-control" placeholder="">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>口座名義</th>
                                                <td colspan="3">
                                                    <div class="col-sm-12">
                                                        <input type="text" name="location" class="form-control" placeholder="">
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table><!-- end table -->
                                    <p>※ 振込日が土日祝日など弊社定休日の場合は、翌営業日に振込させて頂きます。あらかじめご了承ください。<br>
                                        ※ 着手金・報酬として取得した金額が振込の対象となります。</p>
                                </div><!-- end .col-sm-12 -->
                            </div><!-- end .row -->
                            <h3 class="page-title">振込先口座情報</h3>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-bordered tableformtitle">
                                        <tbody>
                                        <tr>
                                            <td class="div-style-blue2 w15"><h5>出金方式</h5></td>
                                            <td>
                                                <div class="col-sm-2">
                                                    <label class="control-label bold font14">
                                                        <input type="radio" name="46" value="0" aria-invalid="false">自動出金方式
                                                    </label>
                                                </div>
                                                <div class="col-sm-10">
                                                    <p>出金前の報酬額が1000円以上であれば、自動的に出金登録が行われます。</p>
                                                    <p>支払いのタイミングは、月末締め翌月末支払いとなります。</p>
                                                </div>
                                                <div class="col-sm-2">
                                                    <label class="control-label bold font14">
                                                        <input type="radio" name="47" value="1" aria-invalid="false">出金保留
                                                    </label>
                                                </div>
                                                <div class="col-sm-10">
                                                    <p>払出はされません。次月以降に出金を行う場合に選択してください。</p>
                                                    <p>出金を行う場合は「自動出金方式」へ変更してください。 </p>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="div-style-blue2" rowspan="4"><h5>確認事項</h5></td>
                                            <td>
                                                <div class="col-sm-12">
                                                    <label class="control-label bold font14">
                                                        <input type="checkbox" aria-invalid="false"> 口座名義人(カタカナ)と、登録情報の氏名(漢字)が一致している(一致していないと、お振り込みできません)
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="col-sm-12">
                                                    <label class="control-label">
                                                        <input type="checkbox" aria-invalid="false"> 登録情報の住所が、番地まで登録されている(登録されていないと、お振り込みできません)
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="col-sm-12">
                                                    <label class="control-label">
                                                        <input type="checkbox" aria-invalid="false"> 実際に振り込まれる金額は、ご登録口座の振込手数料を差し引いた金額となります。
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="col-sm-12">
                                                    <label class="control-label">
                                                        <input type="checkbox"  aria-invalid="false"> 振込口座にお間違いがあった場合は、組戻手数料648円が必要です。
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div class="text-center mgbt-50 mgt-30">
                                        <button type="submit" class="shadowbuttonsuccess btn btn-success">情報を登録・更新する</button>
                                    </div>
                                </div>
                            </div>
                            
                        </div><!-- end .col-sm-12 -->
                    </form>
                    <!-- end form -->
                    </div>
			</div>
		</div>
        
	</div>
</div>
<?php include ('../inc/footer.php'); ?>
<script type="text/javascript">
    $('#click-btn').click(function(){
        var group_checkbox =  $("input[name='option[]']:checked");
        if(group_checkbox.length == 0){
            alert("一つ以上の士業を選択してください。");
        }else{

        }
    })
</script>