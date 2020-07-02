$('.datepicker').datepicker({
    format: 'yyyy年mm月dd日',
    autoclose: true,
    todayHighlight: true,
    language: 'ja-JP',
    startDate: 'today'
});

$('.step1Form').submit(function(event) {
	$('#inputTitle').val( $('#title1').val() );
	$('#inputContent').val( $('#content1').val() );
	$('#inputSchedule').val( $('#schedule1').val() );
	$('#inputBudget').val( $('#budget1 option:selected').text() );
	$('#confirmModal').modal();
	return false;
});

$('.step2Form').submit(function(event) {
	
	$.ajax({
		url: ajaxUrl,
		type: 'post',
		data: $('.step1Form').serialize(),
		success: function (json) {
			if(json == 'success') {
				$('#confirmModal').modal('hide');
				$('#completeModal').modal();
			}
		}
	});
	return false;
});