$('.datepicker').datepicker({
    format: 'yyyy年mm月dd日',
    autoclose: true,
    todayHighlight: true,
    language: 'ja-JP',
    startDate: 'today'
});

$('#reOpenForm').submit(function(event) {
	$.ajax({
		url: base_url + reOpenUrl,
		type: 'POST',
		data: $('#reOpenForm').serialize(),
	})
	.done(function() {
		$('#reOpenJob').modal('hide');
		$('#comModal').modal();
	})
	.fail(function() {
		console.log("error");
	})
	
	return false;
});

$('#comModal').on('hidden.bs.modal', function (e) {
	window.location.reload();
});