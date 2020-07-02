$('.addtask-btn').click(function(event) {
	resetForm();
	$('#task-header').text('タスクを追加する');
	$('#taskSettingModal').modal();
});
$.fn.datepicker.dates['ja'] = {
    days: ["日", "月", "火", "水", "木", "金", "土"],
    daysShort: ["日", "月", "火", "水", "木", "金", "土"],
    daysMin: ["日", "月", "火", "水", "木", "金", "土"],
    months: ['1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月'],
    monthsShort: ['1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月'],
    today: "Today",
    clear: "Clear",
    format: "yyyy年mm月dd日",
    titleFormat: "MM yyyy",
    weekStart: 0
};
$('.datepickertoday').datepicker({
    language : 'ja',
    inline: true,
    sideBySide: true,
    autoclose: true,
    startDate: 'today',
    todayHighlight: true
});
var btnCheckbox = function() {
	//checkbox
	$('.button-checkbox').each(function () {
	    // Settings
	    var $widget = $(this),
	        $button = $widget.find('button'),
	        $checkbox = $widget.find('input:checkbox'),
	        color = $button.data('color');
	    $button.on('click', function () {
	        $checkbox.prop('checked', !$checkbox.is(':checked'));
	        $checkbox.triggerHandler('change');
	        updateDisplay();
	    });
	    $checkbox.on('change', function () {
	        updateDisplay();
	    });
	    function updateDisplay() {
	        var isChecked = $checkbox.is(':checked');
	        $button.data('state', (isChecked) ? "on" : "off");
	        if (isChecked) {
	            $button
	                .removeClass('btn-default')
	                .addClass('btn-' + color + ' active');
	        }
	        else {
	            $button
	                .removeClass('btn-' + color + ' active')
	                .addClass('btn-default');
	        }
	    }

	    // Initialization
	    function init() {
	        updateDisplay();
	    }
	    init();
	});
}


var initButtonCheckbox = function() {
	//checkbox
	$('.button-checkbox').each(function () {
	    // Settings
	    var $widget = $(this),
	        $button = $widget.find('button'),
	        $checkbox = $widget.find('input:checkbox'),
	        color = $button.data('color');

	    function updateDisplay() {
	        var isChecked = $checkbox.is(':checked');
	        $button.data('state', (isChecked) ? "on" : "off");
	        if (isChecked) {
	            $button
	                .removeClass('btn-default')
	                .addClass('btn-' + color + ' active');
	        }
	        else {
	            $button
	                .removeClass('btn-' + color + ' active')
	                .addClass('btn-default');
	        }
	    }

	    // Initialization
	    function init() {
	        updateDisplay();
	    }
	    init();
	});

	//radio
	$('.button-radio').each(function () {
	    // Settings
	    var $widget = $(this),
	        $button = $widget.find('button'),
	        $radiobox = $widget.find('input:radio'),
	        color = $button.data('color');
	    $button.on('click', function () {
	    	$buttonName = $button.attr('data-id');

	    	$("button[data-id='"+$buttonName+"']").each(function(index, el) {
	    		// if($button.val() == $(el).val())
	    		// {
	    		// 	$(el).next().prop('checked', true);
	    		// } else {
	    		// 	$(el).next().prop('checked', false);
	    		// }
	    		$(el).next().prop('checked', false);
	    		$(el).next().triggerHandler('change');
	    	});
	    	$button.next().prop('checked', true);
	    	$button.next().triggerHandler('change');
	        
	        //$radiobox.triggerHandler('change');
	        updateDisplay();
	    });
	    $radiobox.on('change', function () {
	        updateDisplay();
	    });
	    function updateDisplay() {
	        var isChecked = $radiobox.is(':checked');
	        $button.data('state', (isChecked) ? "on" : "off");
	        if (isChecked) {
	            $button
	                .removeClass('btn-default')
	                .addClass('btn-' + color + ' active');
	        }
	        else {
	            $button
	                .removeClass('btn-' + color + ' active')
	                .addClass('btn-default');
	        }
	    }

	    // Initialization
	    function init2() {
	        updateDisplay();
	    }
	    init2();
	});
}

//drag drop file 
$('#file-drag').on(
    'dragover',
    function(e) {
        e.preventDefault();
        e.stopPropagation();
    }
)
$('#file-drag').on(
    'dragenter',
    function(e) {
        e.preventDefault();
        e.stopPropagation();
        $('#file-drag').addClass('active');
    }
)
$('#file-drag').on(
    'dragleave',
    function(e) {
        e.preventDefault();
        e.stopPropagation();
        $('#file-drag').removeClass('active');
    }
)
$('#file-drag').on(
    'drop',
    function(e){$('#file-drag').removeClass('active');
        if(e.originalEvent.dataTransfer){
            if(e.originalEvent.dataTransfer.files.length) {
                e.preventDefault();
                e.stopPropagation();
                /*UPLOAD FILES HERE*/
                upload(e.originalEvent.dataTransfer.files);
            }   
        }
    }
);
function upload(files){
    $('#fileName').val(files[0].name);
    tfile = files[0];
}

$('#no_file').click(function(event) {
	if($(this).is(':checked'))
	{
		$('#fileName').prop('disabled', true);
	} else {
		$('#fileName').prop('disabled', false);
	}
});
$('#term_flag').click(function(event) {
	if($(this).is(':checked'))
	{
		$('#term_content').prop('disabled', true);
	} else {
		$('#term_content').prop('disabled', false);
	}
});

var submitForm = function() {
	var form = $('#taskSettingForm');
	var formData = new FormData(form);
	formData.append('taskImage', tfile); 
	formData.append('hireId', hireId); 
	formData.append('formEl', form.serialize()); 
	var work_task = [];
	$.each($(".work_task:checked"), function(){            
        work_task.push($(this).val());
    });
    if(work_task.length == 0 && $('input[name="other_cb"]').val() == '')
    {
    	alert("すべての項目を正確に入力してください!");
		return false;
    }
    if($('#is_checked').is(':checked') == true && $('input[name="other_cb"]').val() == '')
    {
    	alert("すべての項目を正確に入力してください!");
		return false;
    }
    var performer = [];
    $.each($('.cbperformer:checked'), function(index, val) {
    	performer.push($(this).val());
    });
    if(performer.length == 0)
    {
    	alert("すべての項目を正確に入力してください!");
		return false;
    }
    var notify_day = [];
    $.each($('.cbnotify_day:checked'), function(index, val) {
    	notify_day.push($(this).val());
    });
    if(notify_day.length == 0)
    {
    	alert("すべての項目を正確に入力してください!");
		return false;
    }
    $('#go_to_finish').prop('disabled', true);
	$.ajax({
	    url: base_url + taskAjax,
	    data: formData,
	    type: 'POST',
	    contentType: false,
	    processData: false,
	    success: function(json) {
	    	alert('タスクを設定しました。');
	    	$('#go_to_finish').prop('disabled', false);
	    	//window.location.href = '/agency/mypage/recruitment/' + hireId;
	    	//window.location.reload();
	    },
	    error: function() {
	    	alert( 'エラー');
	    	$('#go_to_finish').prop('disabled', false);
	    }
	});
	
	return false;
}
var getNowDate = function() {
	var d = new Date();
	month = ((d.getMonth().length==1)?'0'+d.getMonth():d.getMonth());
	day = ((d.getDate().length==1)?'0'+d.getDate():d.getDate());
	var str = d.getFullYear() + '年' + month + '月' + day + '日';
	return str;
}
var resetForm = function() {
	$('#f_work_id').val(0);
	$('#performer1').attr('checked', false);
	$('#performer2').attr('checked', false);
	$('#performer3').attr('checked', false);
	
	$('#update_date').val(getNowDate());

	$('.work_task').each(function(index, el) {
			$(el).prop('checked', false);
	});

	$('#display_setting1').attr('checked', false);

	$('.work_task_check').prop('checked', false);

	$('.cbnotify_day').each(function(index, el) {
		$(el).prop('checked', false);
	});

	initButtonCheckbox();
}
var ddate_string = function(str)
{
	str_tmp = str.split('-');
	if(str_tmp.length != 3) return '0000年00月00日';
	return str_tmp[0] + '年' + str_tmp[1] + '月' + str_tmp[2] + '日';
}
$(document).ready(function() {
	btnCheckbox();
	//initButtonCheckbox();
	$.ajax({
		url: base_url + workSetAjax,
		type: 'POST',
		data: {act: 'getWorkSet', hire_id: hireId},
		success: function(json) {
			work_set = json.work_set;
		}
	})
});
$('.edit-task').click(function(event) {
	resetForm();
	var $this = $(this);
	var taskId = $(this).data('id');
	var www = [];
	$.each(work_set, function(index, val) {
		if(val.id == taskId)
		{
			www = val;
			return;
		}
	});
	if(www.length == 0)
	{
		alert('エラー');
		return false;
	}
	$('#f_work_id').val(www.id);

	if(www.performer1 == 1) $('#performer1').attr('checked', true);
	if(www.performer2 == 1) $('#performer2').attr('checked', true);
	if(www.performer3 == 1) $('#performer3').attr('checked', true);
	
	$('#update_date').val(ddate_string(www.schedule));

	$('.work_task').each(function(index, el) {
		var thisVal = parseInt($(this).val());
		var contentJson = JSON.parse(www.work_content);

		if(contentJson.indexOf(thisVal) != -1)
		{
			$(this).prop('checked', true);
		}
	});

	if(www.work_content_other_value) {
		$('.work_task_check').prop('checked', true);
	}

	if(www.display_setting == 1) $('#display_setting1').attr('checked', true);
	else $('#display_setting2').attr('checked', true);

	var notifydayar = [www.notify_day1, www.notify_day2, www.notify_day3, www.notify_day4];
	$('.cbnotify_day').each(function(index, el) {
		var thisVal = parseInt($(this).val());
		if(notifydayar[index] == 1)
		{
			$(this).prop('checked', true);
		}
	});

	initButtonCheckbox();
	$('#taskSettingModal').modal();
});

