var modalCalculator = function() {
	var deposit_money = $('#deposit_money').val();
	var deposit_setting = $('#deposit_setting').val();
	if(deposit_money != '' ) deposit_money = parseInt(deposit_money);
	if(deposit_setting != '' ) deposit_setting = parseInt(deposit_setting);
	total1 = Math.ceil(deposit_money + ((deposit_money*deposit_setting)/100));
	total2 = Math.ceil(total1 + ((total1*sitefee)/100));
	$('#total1').text(total1);
	$('#total2').text(total2);
}
$('#deposit_money').change(function(event) {
	modalCalculator();
});
$('#deposit_setting').change(function(event) {
	modalCalculator();
});
$(document).ready(function() {
	loadFirstModal();
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
	$('#budget_step_2').text( $('#budget_step1').val() );
	loadStep2();
});
$('#submitForm').click(function(event) {
	var deli_date = $('#deli_date').val();
	var deposit_money = $('#deposit_money').val();
	var budget_step1 = $('#budget_step1').val();
	var hire_id = $('#hire_id').val();
	$.ajax({
		url: base_url + requestAjax,
		data: {deli_date: deli_date, hire_id: hire_id},
		type: 'POST',
		success: function(json) {
			loadStep3();
		}
	});

});
$('#com_step_2').click(function(event) {
	$.ajax({
		url: matchingAjax,
		data: {hire_id: hireId},
		type: 'POST',
		success: function(json)
		{
			$('#matchingStep1').modal('hide');
			$('#matchingStep2').modal();

		},
		error: function() {
			$('#matchingStep1').modal('hide');
			$('#matchingStep2').modal();
		}
	});
});

$('#can_step_2').click(function(event) {
	$.ajax({
		url: cancelAjax,
		data: {hire_id: hireId},
		type: 'POST',
		success: function(json)
		{
			$('#cancelMatching').modal('hide');
			$('#cancelMatching2').modal();

		},
		error: function() {
			$('#cancelMatching').modal('hide');
			$('#cancelMatching2').modal();
		}
	});
});

$('.com_step_2_btn').click(function(event) {
	window.location.href = base_url + '/client/mypage/recruitment/' + hireId;
});

$('.can_step_2_btn').click(function(event) {
	window.location.href = base_url + '/client/mypage/recruitment/finished/' + hireId;
});

var loadFirstModal = function() {
	if(isShow > 0) $('#estimateModal').modal();
}


