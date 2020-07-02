var modalCalculator = function() {
			var deposit_money = $('#deposit_money').val();
			var agency_estimate = $('#agency_estimate').val();
			if(deposit_money != '' ) deposit_money = parseInt(deposit_money);
			if(agency_estimate != '' ) agency_estimate = parseInt(agency_estimate);
			total1 = Math.ceil(agency_estimate);
			total2 = Math.ceil(agency_estimate + ((agency_estimate*sitefee)/100));
			$('#total1').text(total1);
			$('#total2').text(total2);
		}
		$('#deposit_money').change(function(event) {
			modalCalculator();
		});
		$('#agency_estimate').change(function(event) {
			modalCalculator();
		});
		$(document).ready(function() {
			modalCalculator();
			readNotify();
		});
		function format1(n) {
			return n.toFixed(0).replace(/./g, function(c, i, a) {
				return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c;
			});
		}

		var loadStep2 = function() {
			$('.modal-content').css({height: $('.modal-content').height()});
			$('#modal_step1').animate({height: 0}, 300, function() {
				$('#modal_step1').addClass('hide');
				$('#modal_step2').removeClass('hide');
				$('.modal-content').css({height: 'auto'});
				$('#modal_step2').removeAttr('style');
			});
		}
		var loadStep1 = function() {
			$('.modal-content').css({height: $('.modal-content').height()});
			$('#modal_step2').animate({height: 0}, 300, function() {
				$('#modal_step1').removeClass('hide');
				$('#modal_step2').addClass('hide');
				$('.modal-content').css({height: 'auto'});
				$('#modal_step1').removeAttr('style');
			});
		}
		var loadStep3 = function() {
			$('.modal-content').css({height: $('.modal-content').height()});
			$('#modal_step2').animate({height: 0}, 300, function() {
				$('#modal_step3').removeClass('hide');
				$('#modal_step2').addClass('hide');
				$('.modal-content').css({height: 'auto'});
			});
		}
		$('#go_to_step1').click(function(event) {
			loadStep1();
		});
		$('#go_to_step2').click(function(event) {
			$('#deli_date_step_2').text( $('#deli_date').val() );
			$('#deposit_money_step_2').text( $('#deposit_money').val() );
			$('#agency_estimate_step_2').text( $('#agency_estimate').val() );
			$('#client_pay_step_2').text( Math.ceil( $('#agency_estimate').val() * 1.055 ) );
			loadStep2();
		});
		$('#submitForm').click(function(event) {
			var deli_date = $('#deli_date').val();
			var deposit_money = $('#deposit_money').val();
			var agency_estimate = $('#agency_estimate').val();
			var hire_id = $('#hire_id').val();
			$.ajax({
				url: base_url + requestAjax,
				data: {agency_estimate: agency_estimate, deposit_money: deposit_money, deli_date: deli_date, hire_id: hire_id},
				type: 'POST',
				success: function(json) {
					// $('#total1_span').text(format1(total1));
					// $('#total2_span').text(format1(total2));
					// $('#deli_date_span').text(deli_date);
					loadStep3();
				}
			});

		});

$('#cancelButton').click(function(event) {
	$('#cancelForm').modal('hide');
	$.ajax({
		url: base_url + cancelAjax,
		data: {hire_id: hireId},
		type: 'POST',
		success: function(json) {
			if(json.success)
			{
				$('#cancelForm2').modal();
			} else {
				alert('error');
			}
			
		}
	})
	
});

$('.cancel2_modal_btn').click(function(event) {
	window.location.href = base_url + finishUrl + hireId;
});

$('#matching_step_2').click(function(event) {
	$('#matchingForm').modal('hide');
	$.ajax({
		url: base_url + matchingUrl,
		data: {hire_id: hireId},
		type: 'POST',
		success: function(json) {
			if(json.success)
			{
				$('#matchingForm2').modal();
			} else {
				alert('error');
			}
			
		}
	})
	
	
});

$('.matching_modal_btn').click(function(event) {
	window.location.href = base_url + recruitLink + hireId;
});