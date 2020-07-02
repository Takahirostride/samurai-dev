<?
echo "server IP=" . $_SERVER['SERVER_ADDR'];

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
 <head>
  <title> New Document </title>
  <meta name="Generator" content="EditPlus">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<script type="text/javascript" src="https://credit.j-payment.co.jp/gateway/js/jquery.js"></script>
<script type="text/javascript" src="https://credit.j-payment.co.jp/gateway/js/CPToken.js"></script>

 </head>

 <body>
  

<form id="mainform" action="pay" method="post">

<input type="text" value="" name="cn" id="cn">
<input type="text" value="" name="ed_year" id="ed_year"> 
<input type="text" value="" name="ed_month" id="ed_month">
<input type="text" value="" name="fn" id="fn">
<input type="text" value="" name="ln" id="ln">

<input id="tkn" name="tkn" type="text" value="">
<input id="aid" name="aid" type="text" value="114763">
<input id="jb" name="jb" type="text" value="CAPTURE">
<input id="rt" name="rt" type="text" value="1">
<input id="cod" name="cod" type="text" value="order01">
<input id="pn" name="pn" type="text" value="0312341234">
<input id="em" name="em" type="text" value="cuiencheng@outlook.com">
<input id="am" name="am" type="text" value="100000">
<input id="tx" name="tx" type="text" value="11">
<input id="sf" name="sf" type="text" value="22">

<input type="submit" value="購入する" onclick="doPurchase()"/>
</form>


 </body>
</html>

<script language=javascript>

// カード情報入力フォーム表示
function doPurchase() {
//CP非同期通信よりカード番号入力画面を表示する

   /// alert($("#ed_year").val() + $("#ed_month").val());
	CPToken.TokenCreate (
	{
		aid: '114763',
		cn: $("#cn").val(),
		ed: $("#ed_year").val() + $("#ed_month").val(),
		fn: $("#fn").val(),
		ln: $("#ln").val()
		},
		execPurchase
	);
}

// コールバック関数
function execPurchase(resultCode, errMsg) {
	
	//if (resultCode != "Success") {
		// 戻り値がSuccess以外の場合はエラーメッセージを表示
	//	window.alert(errMsg);
	//} else {
		$("#mainform").submit();
	//}
}



</script>