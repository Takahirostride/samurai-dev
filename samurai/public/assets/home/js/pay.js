/*
*	Name 	: 	Whatissamurai
*	Author 	: 	Common
*	Created : 	10/10/2018
*	Updated: 	 
*/
$(document).ready(function(){
	//cal function here
	init();
});
// 16桁の数値
	var cardnumber = "[0-9]{16}";
	// 1-12の数字
	var termmonth = "(1[0-2]|0[1-9]|[1-9])";
	// 2桁の数値
	var termyear = "[0-9]{2}";
	// 半角英字
	var cardname = "[a-zA-Z]";
	// 3-4桁の数字
	var cvv = "[0-9]{3}|[0-9]{4}";
	// 全角カナ
	var selectedcard = true;
	var transfereename = "^[\u30A0-\u30FF]+$";
	var billing = [];
	var cardnames = [];
	var banknames = [];
	var cod = "";
	var token = "";
	var payment_id = $('#payment_id').val();
	var insert_payment = $('#insert_payment').val();
	payment_id = JSON.parse(payment_id);

    $("#option1").click(function(){
        $("#pay1").show();
        $("#pay2").hide();
        selectedcard = true;
    });
    $("#option2").click(function(){
        $("#pay2").show();
        $("#pay1").hide();
        selectedcard = false;
    });
    function innit(){
    	$('.hide_part').hide();
    	$('#form_submmit').show();
    }
    innit();
    // 入力値チェック
	function inputCheck() {
		var errMsg = "";
		if ($("#option1").is(":checked")) {
			// 支払方法がクレジットカードの場合

			// カード種類
			if ($('#card_info').val() == "") {
				// カード種類が未選択
				errMsg += "カード種類を選択してください。\n";
			}

			// カード番号
			if ($('#cardnumber').val() == "") {
				// カード番号が未入力
				errMsg += "カード番号を入力してください。\n";

			} else if (!$('#cardnumber').val().match(cardnumber)) {
				// カード番号が16桁の数字ではない
				errMsg += "カード番号は16桁の数字を入力してください。\n";
			}

			// 有効期限（月）
			if ($('#termmonth').val() == "") {
				// 有効期限（月）が未入力
				errMsg += "有効期限（月）を入力してください。\n";

			} else if (!$('#termmonth').val().match(termmonth)) {
				// 有効期限（月）が1～12の数字ではない
				errMsg += "有効期限（月）は1～12までの数字を入力してください。\n";
			}

			// 有効期限（年）
			if ($('#termyear').val() == "") {
				// 有効期限（年）が未入力
				errMsg += "有効期限（年）を入力してください。\n";

			} else if (!$('#termyear').val().match(termyear)) {
				// 有効期限（年）が2桁の数字ではない
				errMsg += "有効期限（年）は2桁の数字を入力してください。\n";
			}

			// カード名義人（名）
			if ($('#fn').val() == "") {
				// カード名義人（名）が未入力
				errMsg += "カード名義人（名）を入力してください。\n";

			} else if (!$('#fn').val().match(cardname)) {
				// カード名義人（名）が半角英字ではない
				errMsg += "カード名義人（名）は半角英字を入力してください。\n";
			}

			// カード名義人（姓）
			if ($('#ln').val() == "") {
				// カード名義人（姓）が未入力
				errMsg += "カード名義人（姓）を入力してください。\n";

			} else if (!$('#ln').val().match(cardname)) {
				// カード名義人（姓）が半角英字ではない
				errMsg += "カード名義人（姓）は半角英字を入力してください。\n";
			}

			// セキュリティコード
			if ($('#cvv').val() == "") {
				// セキュリティコードが未入力の場合
				errMsg += "セキュリティコードを入力してください。\n";

			} else if (!$('#cvv').val().match(cvv)) {
				// セキュリティコードが3-4桁の数値でない場合
				errMsg += "セキュリティコードは3-4桁の数値を入力してください。\n";
			}

		} else {
			// 支払方法が銀行振込の場合
			// 振込先
			if ( $('#selectedcardname').val() == "") {
				// 振込先が未選択
				errMsg += "振込先を選択してください。\n";
			}

			// 振込人名義
			if ($('#transfereename').val() == "") {
				// 振込人名義が未入力
				errMsg += "振込み人名義を入力してください。\n";

			} else if (!$('#transfereename').val().match(transfereename)) {
				// 振込人名義が全角カナ以外で入力されていた場合
				errMsg += "振込み人名義は全角カナで入力してください。\n";
			}
		}

		// 金額
		if($('#money_total').val() == 0) {
			// 金額が0円の場合
			errMsg += "金額が0円となっています。\n";
		}
		return errMsg;
	}
	function dopay() {
		// 入力値チェック
		var errMsg = inputCheck();
		if (errMsg != "") {
			// エラーの場合
			alert(errMsg);
		}else{
		// パラメータの設定
		var data = JSON.stringify({
			user_id: $('#user_id').val(),
			payment_method: selectedcard,
		});
		var token = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			type: 'POST',
			data: data,
			url: base_url +"/billing_bulk_upsert",
			headers: {'Content-Type': 'application/json'}
		}).then(function successCallback(response) {console.log(response);
			if (response["result"] == "Success") {

				// billingの設定
				billing = response["billing"];
				// codの設定
				cod = response["billing"]["payment"][0]["cod"];
				if (selectedcard){
					// クレジットカードの場合
					// トークン生成
					createToken();
				} else {
					// 銀行振込の場合
					var data = JSON.stringify({
						cod: cod,
						ids:payment_id,
						insert_data:insert_payment,
						user_id: $('#user_id').val(),
						billing: billing,
						price: $('#money_total').val() ,
						payment_method: selectedcard,
					});
					// 決済
					$.ajax({
						method: 'post',
						url: base_url +"/bank_transfer",
						data:data,
						headers: {'Content-Type': 'application/json'}
					}).then(function successCallback(response) {
						if(response.result == "Success") {
							// 決済が成功した場合
							console.log("success bank transfer.");
							$('.hide_part').hide();
							$('#payfinished').show();
							//window.location.href = base_url + '/pay-success';
							$('#s2_selectedcard').html('<i class="fa fa-check-circle-o" style="color:#399a5c; font-size: 200px;"></i>');
							$('#s_selectedcard').html('<p style="color:#399a5c; font-size: 15px">お支払いが完了いたしました。</p>');
							     
						} else {
							// 決済が失敗した場合
							$('#s2_selectedcard').html('<i class="fa fa-times-circle-o" style="color:#de2525; font-size: 200px;"></i>');
							$('#s_selectedcard').html('<p style="color:#de2525; font-size: 15px">お支払いが完了できませんでした。</p>');
							console.log("failed bank transfer.");
							$('.hide_part').hide();
							$('#payfailed').show();
						}
						$('.v_cardnumber').val($('#cardnumber').val().slice(11,16));
					});
				}
			} else {
				console.log("failed billing_bulk_upsert.");
			}
		});
		}
		return false;

	}
		// トークン生成
	function createToken() {
		CPToken.TokenCreate (
		{
           aid: $('#storenumber').val(),
           cn: $('#cardnumber').val(),
           ed: $('#termyear').val() + $('#termmonth').val(),
           fn: $('#fn').val(),
           ln: $('#ln').val(),
           cvv: $('#cvv').val(),
           md: '10',
        },
            execPurchase
        );
	}

	var execPurchase = function (resultCode, errMsg) {
		if (resultCode == "Success") {
			// トークン生成API呼出しが成功した場合
			console.log("success create token.");
			var token = $('#tkn').val();
			// パラメータの設定
			var data = JSON.stringify({
				cod: cod,
				token: token,
				ids:payment_id,
				insert_data:insert_payment,
				user_id: $('#user_id').val(),
				billing: billing,
				price: parseInt($('#money_total').val()),
				payment_method: selectedcard,
			});
			// クレジットカード登録
			$.ajax({
				type: 'post',
				url: base_url +"/pay_with_card",
				data:data,
				headers: {'Content-Type': 'application/json'}
			}).then(function successCallback(response) {console.log(response);
				if(response.result == "Success") {
					// 決済が成功した場合
					console.log("success bank transfer.");
					$('.hide_part').hide();
					$('#payfinished').show();
					//window.location.href = base_url + '/pay-success';
					$('#s2_selectedcard').html('<i class="fa fa-check-circle-o" style="color:#399a5c; font-size: 200px;"></i>');
					$('#s_selectedcard').html('<p style="color:#399a5c; font-size: 15px">お支払いが完了いたしました。</p>');
					     
				} else {
					// 決済が失敗した場合
					$('#s2_selectedcard').html('<i class="fa fa-times-circle-o" style="color:#de2525; font-size: 200px;"></i>');
					$('#s_selectedcard').html('<p style="color:#de2525; font-size: 15px">お支払いが完了できませんでした。</p>');
					console.log("failed bank transfer.");
					$('.hide_part').hide();
					$('#payfailed').show();
				}
			});
		} else {
			// トークン生成API呼出しが失敗した場合
			console.log("failed create token.");
			console.log(errMsg);
			$('.hide_part').hide();
			$('#payfailed').show();
		}
		$('.v_cardnumber').val($('#cardnumber').val().slice(11,16));
	}