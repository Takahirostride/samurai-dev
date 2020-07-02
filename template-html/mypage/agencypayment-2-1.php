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
			<div class="col-sm-3 sidebar-left">
                <p>金額</p>
				<p>支払方法</p>
			</div>
			<div class="col-sm-9 mainpage">
                <form method="post" action="">
                <div class="row">
                    <div class="col-sm-12 mgt-20">
                        <p>0円（うち、消費税8%を含む）</p>
                        <p class="color-0f7cc9 bold font14"><label><input type="radio" id="option1" checked="" name="option">クレジットカード</label><img src="assets/images/cardstyles.png" alt=""></p>
                        <div id="pay1">
                            <table class="table table-bordered table-hover">                            
                                <tbody>
                                    <tr>
                                        <td class="div-style-blue2"><h5>カード種類</h5></td>
                                        <td>
                                            <div class="col-sm-4">
                                                <div class="angularsl">
                                                    <select class="form-control form-select">
                                                        <option value="VISA">VISA</option>
                                                        <option value="MasterCard">MasterCard</option>
                                                        <option value="JCB">JCB</option>
                                                        <option value="アメリカン・エキスプレス">アメリカン・エキスプレス</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="div-style-blue2"><h5>カード番号</h5></td>
                                        <td colspan="3">
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" aria-invalid="false">
                                            </div>
                                            <div class="col-sm-12">
                                                <p>※半角入力（ハイフンなし）　　　例：　1234123412341234</p>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="div-style-blue2"><h5>有効期限</h5></td>
                                        <td colspan="3">
                                            <div class="col-sm-12">
                                                <div class="col-sm-5" >
                                                    <input class="form-control" type="text" maxlength="2" placeholder="月(2桁)" aria-invalid="false">
                                                </div>
                                                <div class="col-sm-2">
                                                    <p>/</p>
                                                </div>
                                                <div class="col-sm-5" >
                                                    <input class="form-control" type="text" maxlength="2" placeholder="年(2桁)" aria-invalid="false">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <p>※カードの有効期限は通常（月/年（西暦下2桁）で刻印されています。</p>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="div-style-blue2"><h5>カード名義人</h5></td>
                                        <td colspan="3">
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" placeholder="名" aria-invalid="false">
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" placeholder="姓" aria-invalid="false">
                                            </div>
                                            <div class="col-sm-12">
                                                <p>※半角英字入力　（例　TARO YAMADA)</p>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="div-style-blue2"><h5>支払い回数</h5></td>
                                        <td colspan="1">
                                            <div class="col-sm-12">
                                                <p>一括</p>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="div-style-blue2"><h5>セキュリティコード</h5></td>
                                        <td colspan="3">
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" aria-invalid="false">
                                            </div>
                                            <div class="col-sm-12">
                                                <p>主にカード裏面のご署名欄に印刷されている末尾3桁～4桁の7数字です。</p>
                                                <input type="hidden" id="tkn" autocomplete="off">
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                            </table>
                        </div>
                        <p class="color-0f7cc9 bold font14"><label><input type="radio" id="option2" name="option">銀行振込</label></p>
                        <div id="pay2">
                        <div class="col-sm-12">
                            <p>入金の確認までに１営業日程度いただきます。</p>
                            <p>お急ぎの場合は、クレジットカードをご利用ください</p>
                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-4">
                                <p>振込先をお選びください：</p>
                            </div>
                            <div class="btn-group col-sm-6">
                                <div class="col-sm-12">
                                    <div class="angularsl">
                                        <select class="form-control form-select">
                                            <option value="楽天銀行">楽天銀行</option>
                                            <option value="ジャパンネット銀行">ジャパンネット銀行</option>
                                            <option value="三菱東京UFJ銀行">三菱東京UFJ銀行</option>
                                            <option value="三井住友銀行">三井住友銀行</option>
                                            <option value="りそな銀行">りそな銀行</option>
                                            <option value="みずほ銀行">みずほ銀行</option>
                                            <option value="その他">その他</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <p>※振込先口座番号は、完了画面で表示されます</p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <p>振込み人名義（全角カナ）：</p>
                            </div>
                            <div class="btn-group col-sm-6">
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" aria-invalid="false">
                                </div>
                                <div class="col-sm-12">
                                    <p>※ご自身の口座名義をご入力ください<br>（法人名義の口座からお振込みの場合は、法人名義をご入力ください）</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 mb20 text-center">
                            <a href="mypage/agencypayment-2.php" class="btn btn-default btn-style-grey w120px mgr-15">戻る</a>
                            <input type="submit" name="submit" class="btn btn-danger btn-style-shadow-red w120px" value="完了する">
                        </div>
                    </div>
                    </div>
                </div>
                </form>
			</div>
		</div>
        
	</div>
</div>
<?php include ('../inc/footer.php'); ?>
<script type="text/javascript">
    $("#option1").click(function(){
        $("#pay1").show();
        $("#pay2").hide();
    });
    $("#option2").click(function(){
        $("#pay2").show();
        $("#pay1").hide();
    });
</script>
