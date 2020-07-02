/*
*	Name 	: 	Agency-Bsearch
*	Author 	: 	Common
*	Created : 	10/10/2018
*	Updated: 	 
*/
$(document).ready(function(){
	//cal function here
	init();
});
/*
*	Name 	: 	Initialization Function
*	Author 	: 	Trieunb
*	Created : 	22/09/2018
*	Modify 	: 	
*	Updated : 	 
*/
function init() {
	try {
		$('#example-fontawesome,.datrating').barrating({
			//index page jubotron
            theme: 'fontawesome-stars',
            showSelectedRating: false,
            onSelect: function(value, text, event) {
			    if (typeof(event) !== 'undefined') {
			      // rating was selected by a user
			      console.log(value);
			    } else {
			      // rating was selected programmatically
			      // by calling `set` method
			    }
			  }
        });
        $('.rating-disable').barrating({
			//index page jubotron
            theme: 'fontawesome-stars',
            showSelectedRating: false,
            readonly: true,
            onSelect: function(value, text, event) {
			    if (typeof(event) !== 'undefined') {
			      // rating was selected by a user
			      console.log(value);
			    } else {
			      // rating was selected programmatically
			      // by calling `set` method
			    }
			  }
        });

		//agency/home tooltip
		$(function () {
		  $('[data-toggle="tooltip"]').tooltip()
		});

		var msg_files = [];
		var msg_files_l = 0;
		$('.msg-files-button').click(function() {
			$('#msg-files').trigger('click');
		});
		$(document).on('change', '#msg-files', function() {
			files = $('#msg-files')[0].files;
			html = '';
			st = msg_files.length + 1;
			for(i = 0; i < files.length; i++)
			{
				
				html += '<span class="dmsgfile-item">' + files[i].name + '<button type="button" id="ff_'+msg_files_l+'" class="dmsgfile-item-remove"><i class="fa fa-trash"></i></button></span>';
				msg_files[msg_files_l] = {name: files[i].name, file: files[i]};
				msg_files_l += 1;
				
			}
			$('.dfile-list').append(html);
			console.log(msg_files);
		});
		$(document).on('click', '.dmsgfile-item-remove', function(e) {
			var thisId = $(this).attr('id');
			thisId = thisId.split('_');
			thisId = thisId[1];
			delete msg_files[thisId];
			$(this).parent().remove();
			console.log(msg_files);
		});
		$('#dmsgsubmit').click(function() {
			uploadFileMuli();
		});
		var uploadFileMuli = function() {
			var fd = new FormData();
			//var config = { headers: { 'Content-Type': undefined } };
			for(i = 0; i < msg_files.length; i++)
			{
				if(typeof(msg_files[i]) != 'undefined')
				{
					fd.append("fileToUpload" + i, msg_files[i].file);
				}
			}
			$.ajax({
				url: 'uploadFile',
				data: {files: fd},
				type: 'POST',
				success: function(json) {
					//display results
				}
			});
		}
		$('.dcheck-dis').change(function() {
			var input_parent = $(this).parents('td').next().find('input[type="text"],input[type="number"]');
			if($(this).is(':checked')) {
				input_parent.attr('disabled', false);
			} else {
				input_parent.attr('disabled', true);
			}
			if(input_parent.prop('type') == 'number') input_parent.val('0');
			else input_parent.val('');
			all_cal();
		});
		$('.dask-check').change(function() {
			//check checkall button
			if($(this).hasClass('checkall-btn'))
			{
				s_status = false;
				if($(this).is(':checked')) {
					s_status = true;
				}
				$('.dask-check').each(function(index, el) {
					if(!$(el).hasClass('checkall-btn')) $(el).prop('checked', s_status);
				});
			} else {
				var count_e = 0;
				var count_checked = 0;
				$('.dask-check').each(function(index, el) {
					if(!$(el).hasClass('checkall-btn')) {
						if($(el).is(':checked')) {
							count_checked += 1;
						}
						count_e += 1;
						
					}
				});
				if(count_checked == count_e) {
					$('.checkall-btn').prop('checked', true);
				} else {
					$('.checkall-btn').prop('checked', false);
				}
			}

			//set name
			sss = '&nbsp;';
			$('.dask-check').each(function(index, el) {
				if(!$(el).is(':checked')) return;
				if(!$(el).hasClass('checkall-btn')) {
					name = $(el).parents('td').next().next().find('p').first().text();
					name = name.replace('士業名：', '');
					sss += name + ', ';
				}
				
			});
			$('.dmsg-to p').html(sss);

		});
		$('.dother-cost').keyup(function() {
			all_cal();
		});
		var all_cal = function() {
			var total_val = 0;
			var total_pc = 0;
			$('.dother-cost').each(function(index, el)
			{
				if($(el).val() == '') return;
				total_val += parseInt($(el).val());
			});
			$('#total-value').text(total_val + ' 円');
			if($('#document_business_price').val() != '') {
				total_val += parseInt($('#document_business_price').val());
			}
			if($('#deposit_money').val() != '') {
				total_val += parseInt($('#deposit_money').val());
			}
			$('#total_val_page').text(total_val);
			if($('#request_business_price').val() != '') {
				total_pc = parseInt($('#request_business_price').val());
			}
			$('#total_pc_page').text(total_pc);
			
		}
		$('#document_business_price').keyup(function() {
			all_cal();
		});
		$('#request_business_price').keyup(function() {
			if($(this).val() < 0) $(this).val(0);
			if($(this).val() > 99) $(this).val(100);
			$(this).val(parseInt($(this).val()));
			all_cal();
		});
		$('#deposit_money').keyup(function() {
			all_cal();
		});
		var document_business_type = 1;
		$('#submit-ask').click(function() {
			if(!$('#document_business_flag').is(":checked") && !$('#request_business_flag').is(':checked'))
			{
				alert("費用を正確に入力してください。");
				return;
			}
			if($('#document_business_flag').is(":checked"))
			{
				if($('#document_business_price').val())
				{
					if($('#document_business_price').val() < 0)
					{
						alert("すべての項目を正確に入力してください!");
						return;
					}
					if($('#document_business_price').val() > 100 && document_business_type == 1)
					{
						alert("すべての項目を正確に入力してください!");
						return;
					}
				} else {
					alert("すべての項目を正確に入力してください!");
					return;
				}
			} else {
				request_business_price = 0;
			}
			if($('#deposit_money').val()) {
				if($('#deposit_money').val() == 0) {
					alert("すべての項目を正確に入力してください!");
					return;
				}
			}
			set_modal_value();
			$('#submit-ask-modal').modal();
		});
		var set_modal_value = function() {
			$('#document_business_price_m').text( $('#document_business_price').val() );
			$('#request_business_price_m').text( $('#request_business_price').val() );
			$('#deposit_money_m').text( $('#deposit_money').val() );
			$('#dother-cost-t1_m').text( $('#dother-cost-t1').val() );
			$('#dother-cost-t2_m').text( $('#dother-cost-t2').val() );
			$('#dother-cost-t3_m').text( $('#dother-cost-t3').val() );
			$('#dother-cost-t4_m').text( $('#dother-cost-t4').val() );
			$('#dother-cost-t5_m').text( $('#dother-cost-t5').val() );
			$('#dother-cost-i1_m').text( $('#dother-cost-i1').val() + ' 円' );
			$('#dother-cost-i2_m').text( $('#dother-cost-i2').val() + ' 円' );
			$('#dother-cost-i3_m').text( $('#dother-cost-i3').val() + ' 円' );
			$('#dother-cost-i4_m').text( $('#dother-cost-i4').val() + ' 円' );
			$('#dother-cost-i5_m').text( $('#dother-cost-i5').val() + ' 円' );
			$('#total-value_m').text( $('#total-value').text() );
			$('#total_val_page_m').text( $('#total_val_page').text() );
			$('#total_pc_page_m').text( $('#total_pc_page').text() );
		}
	} catch(err) {
		console.log(err);
	}
}