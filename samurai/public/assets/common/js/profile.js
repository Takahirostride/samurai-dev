$(document).on('change', '#file', function() {
	var fileInput = document.getElementById('file');   
	var filename = fileInput.files[0].name;
	$('#fileval').val(filename);
});

$('#fileval').click(function(event) {
	$('#file').trigger('click');
});

$('.av-avatar').click(function(event) {
	$('#file').trigger('click');
});

function addCommas(nStr)
{
	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
	return x1 + x2;
}
$(document).ready(function() {
	changeSep();
});
var changeSep = function() {
	var capital = $('input[name="capital"]').val();
	var regular_number = $('input[name="regular_number"]').val();
	if(capital != 0) {
		capital = addCommas(capital);
	}
	if(regular_number != 0) {
		regular_number = addCommas(regular_number);
	}
	$('input[name="capital"]').val(capital);
	$('input[name="regular_number"]').val(regular_number);
}
$('input[name="capital"]').change(function(event) {
	changeSep();
});
$('input[name="regular_number"]').change(function(event) {
	changeSep();
});
var isChange = 0;
$('#province_id_select').change(function(event) {
	isChange = 1;
});

$(document).on('change', '#city_id_select', function(event) {
	isChange = 1;
});
$(document).on('change', '#province_name', function(event) {
	isChange = 1;
});

$(document).on('change', '#province_name', function(event) {
	isChange = 1;
});
$('#profileForm').submit(function(event) {

	if(isChange)
	{
		if(isAlert == 1) {
			alert("所在地、市区町村、番地の変更は月に一度しか変更が出来ません。\r\n次回変更できる期日は、"+expDate+"です");
			return false;
		} else {
			var cp = confirm('登録住所を変更しますか？');
			if(!cp) {
				window.location.reload();
				return false;
			}
		}
		
	}
});





