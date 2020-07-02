		var currentIndex = 0;
		$(document).ready(function() {
			starRatingInit('.fbrtdiv', '.fbrtsl');
			$('#table-msg').scrollTop($('#table-msg table').height());
			loadSetCost(0);
			
		});
		$('#files').change(function(event) {
			var fileInput = document.getElementById('files');   
			html = '';
			for(i = 0; i < fileInput.files.length; i++)
			{
				html += '<span class="file_select_name">' + fileInput.files[i].name + '</span>';
			}
			var filename = fileInput.files[0].name;
			$('#file-select-list').html(html);
		});
		$('#submit_btn_msg').click(function(event) {
			$(this).prop('disabled', true);
			if( $('#submit_msg').val().length < 15)
			{
				alert('メッセージを入力してください');
				$('#submit_btn_msg').prop('disabled', false);
				return false;
			}
			var form = $('#sendmsg-form');
    		var formdata = new FormData(form[0]);
			$.ajax({
				url: base_url + '/agency/mypage/jobs/matching-case/message-ajax',
				data: formdata,
				type: 'POST',
				processData: false,
    			contentType: false,
				success: function(json) {
					if(json.success) {
						$('#submit_msg').val('');
						$('#files').val('');
						$('#file-select-list').html('');
						html = '<tr style=""><td><div class="row"><div class="col-sm-4"><hr></div>'+
												                    '<h5 class="text-center col-sm-4">'+
												                        '<b>'+json.message.update_date+'</b>'+
												                    '</h5>'+
												                    '<div class="col-sm-4">'+
												                        '<hr>'+
												                    '</div>'+
												                '</div>'+
												                '<h5>'+user_displayname+' :</h5>'+
												                '<p>'+json.message.message+'</p>';
							for(i=0; i < json.message.files.length;i++) {
								html += '<div class="col-sm-12">'+
								    '<span>&bull;</span><a style="margin-top:8px;cursor:pointer;" target="_blank" href="'+json.message.files[i][0]+'">'+json.message.files[i][1]+'</a></div>';
							}
								html += '</td></tr>';

						$('#msg_table').append(html);
					}
					$('#submit_btn_msg').prop('disabled', false);
					$('#table-msg').scrollTop($('#table-msg table').height());
				},
				error: function() {
					$('#submit_btn_msg').prop('disabled', false);
				}
			})
		});
		$('.sub-table-btn').click(function(event) {
			if($(this).next().hasClass('hide'))
			{
				$(this).next().removeClass('hide');
			} else {
				$(this).next().addClass('hide');
			}
		});


		var loadSetCost = function(current_select) {
			$.ajax({
				url: base_url + '/agency/mypage/profile/edit-cost-ajax',
				data: {act: 'getUserCost'},
				type: 'POST',
				success: function(json) {
					set_cost = json.set_cost;//console.log(set_cost);
					loadFormData(current_select);
				}
			});
		}
		var loadFormData = function(current_select) {
			var html = '';
			$.each(set_cost, function(index, val) {
                selected = '';
                if(index == current_select) selected = ' selected="selected"';
				html += '<option value="'+index+'"'+selected+'>登録内容'+(index+1)+'</option>';
			});
			$('#current-cost-select').html(html);
			$('#current-select').val(current_select);
			fillFormData();
		}
		$(document).on('change', '#current-cost-select', function() {
			$('#current-select').val( $('#current-cost-select').val() );
			fillFormData();
		});
		var fillFormData = function() {
			currentIndex = $('#current-select').val();
			var currentVal = set_cost[currentIndex];
			if(currentVal.document_price_flag)
			{
				if(!$('#document_business_flag').is(':checked')) $('#document_business_flag').trigger('click');
			} else {
				if($('#document_business_flag').is(':checked')) $('#document_business_flag').trigger('click');
			}
			$('#document_business_price').val(currentVal.document_business_price);
			if(currentVal.request_price_flag)
			{
				if(!$('#request_price_flag').is(':checked')) $('#request_price_flag').trigger('click');
			} else {
				if($('#request_price_flag').is(':checked')) $('#request_price_flag').trigger('click');
			}
			$('#request_business_price').val(currentVal.request_business_price);
			$('#deposit_money').val(currentVal.deposit_money);
			html = '';
			for(i = 0; i < currentVal.content_type.length; i++)
			{
				moneyname = currentVal.content_type[i].moneyname;
				if(moneyname == null) moneyname = '';
				moneyvalue =currentVal.content_type[i].moneyvalue
				$('#moneyname-'+i).val( moneyname );
				$('#cmoneyvalue-'+i).val( moneyvalue );
			}
			sumTotal();
			
		}
		var sumTotal = function() {
			total = 0;
			$('.has-feedback .sum').each(function(index, el) {
				total += parseInt( ($(el).val()!='')?$(el).val():0 );
			});
			$('#show-total').text(total + ' 円');
			$('#total').val(total);
			sumReceived();
		}
		var sumReceived = function() {
			var moneyvalue = parseInt($('#total').val());console.log($('#total').val());
			moneyvalue += parseInt( ($('#deposit_money').val()!='')?$('#deposit_money').val():0 );
			moneyvalue += parseInt( ($('#document_business_price').val()!='')?$('#document_business_price').val():0 );
			
			$('#total-received').text(moneyvalue);
			$('#total-received_m').text(moneyvalue);
			$('#percent-select').text( $('#request_business_price').val() );
			$('#percent-select_m').text( $('#request_business_price').val() );
		}
		$(document).on('change', '.has-feedback .sum', function() {
			sumTotal();
		});
		$(document).on('change', '#document_business_price', function() {
			sumTotal();
		});
		$(document).on('change', '#request_business_price', function() {
			sumTotal();
		});
		$(document).on('change', '#deposit_money', function() {
			sumTotal();
		});
		$(document).on('click', '#document_business_flag', function() {
			if(!$('#document_business_flag').is(':checked')) {
				$('#document_business_price').prop('disabled', true);
				$('#document_business_price').val(0);
				sumTotal();
			} else $('#document_business_price').prop('disabled', false);
		});
		$(document).on('click', '#request_price_flag', function() {
			if(!$('#request_price_flag').is(':checked')) {
				$('#request_business_price').prop('disabled', true);
				$('#request_business_price').val(0);
				sumTotal();
			} else $('#request_business_price').prop('disabled', false);
		});

		$('#ask-matching').click(function(event) {
			var currentVal = set_cost[currentIndex];
			//sumModal();
			$('#document_business_price_m').text( $('#document_business_price').val() );
			$('#document_business_price_f').val( $('#document_business_price').val() );
			$('#document_business_type_f').val( currentVal.document_business_type );

			$('#request_business_price_m').text( $('#request_business_price').val() );
			$('#request_business_price_f').val( $('#request_business_price').val() );
			$('#request_business_type_f').val( currentVal.request_business_type );

			$('#deposit_money_m').text( $('#deposit_money').val() );
			$('#deposit_money_f').val( $('#deposit_money').val() );
			
			for(ii = 0; ii <= 4; ii++)
			{
				$('#moneyname_m-'+ii).text( $('#moneyname-'+ii).val() );
				$('#moneyvalue_m-'+ii).text( $('#moneyvalue-'+ii).val() );

				$('#moneyname_f-'+ii).val( $('#moneyname-'+ii).val() );
				$('#moneyvalue_f-'+ii).val( $('#moneyvalue-'+ii).val() );
			}
			$('#total_m').text( $('#total').val() );
			$('#other_money_f').val($('#total').val());
			$('#show-total_m').text( $('#show-total').val() );
			$('#total-received_m').text( $('#total-received').text() );
			$('#percent-select_m').text( $('#percent-select').text() );


			$('#matchingModal').modal();
		});

		var submitHireForm = function() {
			$.ajax({
				url: base_url + '/agency/mypage/jobs/submit-hire',
				data: $('#hireForm').serialize(),
				type: 'POST',
				success: function(json) {
					$('#completedAllModal').modal();
				}
			})
		}
