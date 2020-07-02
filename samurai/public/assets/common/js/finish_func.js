$('.datrating1').barrating({
			//index page jubotron
		    theme: 'fontawesome-stars',
		    showSelectedRating: false,
		    onSelect: function(value, text, event) {
			    if (typeof(event) !== 'undefined') {
			      // rating was selected by a user
			    	currentVal = value;
			    	$('#'+currentEl).text(value);
			    } else {
			      
			    }
			  }
		});
		$('#reload_page').click( function() {
			window.location.href=base_url + finishRoute + hireId;
		});
		$('#go_to_finish').click( function() {
			window.location.href=base_url + finishRoute + hireId;
		});
		$('.datrating1').change(function(event) {
			currentEl = $(this).data('ids');
		});
		var checkForm = function() {
			// if($('input[name="finishtype"]:checked').val() == undefined)
			// {
			// 	alert('すべての項目を正確に入力してください。');
			// 	return false;
			// }
			if($('#report_message').val() == '')
			{
				alert('メッセージを入力してください。');
				return false;
			}
			submitFinish();
			
			return true;
		}
		var submitFinish = function() {
			$.ajax({
				url: base_url + recruitAjax,
				data: $('#completeForm').serialize(),
				type: 'POST',
				success: function(json) {
					$('#completeModal').modal('hide');
					if(json.success)
					{
						$('#modalConfirm').modal();
					} else {
						alert('エラー');
						window.location.reload();
					}
				},
				error: function() {
					alert('エラー');
					window.location.reload();
				}
			})
		}

$('.cancel2_modal_btn').click(function(event) {
	window.location.href=base_url + finishRoute + hireId;
});
$('#go_to_cancel').click(function(event) {
	$('#cancelModal').modal('hide');
	$.ajax({
		url: base_url + cancelMatchingAjax,
		data: {hire_id: hireId},
		type: 'POST',
		success: function(json) {
			if(json.success)
			{
				$('#cancelModal2').modal();
			} else {
				alert('エラー');
				window.location.reload();
			}
		},
		error: function() {
			alert('エラー');
			window.location.reload();
		}
	});
	
});