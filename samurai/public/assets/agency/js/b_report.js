$(document).on('click' , '#report_sm' , function(){
	if(!$('input[name="reportway"]:checked').length) {
		alert('一つ以上の事業者を選択してください。');
		return false;
	}else{
		var data = new FormData($('form#form_report')[0]);
		var url = $('input[name="url_post"]').val();
		$.ajax({
		    url: url,
		    data: data,
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'json', // For jQuery < 1.9
		    success: function(data){
		    	// console.log(data);
	    		var str = '<div class="row"><div class="col-sm-offset-2 col-sm-8"><div class="breportcompletion"><div class="pd40-20"><p>違反者情報の送信が完了しました。<br>ご協力ありがとうございます。<br>皆さまにご提供いただきました情報を元に、より良いサービスの提供を行ってまいります。</p></div></div><div class="row text-center mgbt-50 mgt-30"><button data-dismiss="modal" class="btn btn-default" style="margin-right:20px;width:150px;">閉じる</button></div></div></div>';
				if(data == 'success') {
					$('#modal-report-content').html(str);	
				}
		    }
		});
	}
});