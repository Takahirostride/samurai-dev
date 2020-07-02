$.fn.datepicker.dates['ja'] = {
            days: ["日", "月", "火", "水", "木", "金", "土"],
            daysShort: ["日", "月", "火", "水", "木", "金", "土"],
            daysMin: ["日", "月", "火", "水", "木", "金", "土"],
            months: ['1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月'],
            monthsShort: ['1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月'],
            today: "Today",
            clear: "Clear",
            format: "yyyy/mm/dd",
            titleFormat: "MM yyyy",
            weekStart: 0
        };
        $('.datepickertoday').datepicker({
            language : 'ja',
            inline: true,
            sideBySide: true,
            todayHighlight: true
        }).on('changeDate', function(e) {
        	currentSelect = $('#update_date_pick').datepicker("getDate").valueOf()
        	var d = new Date(currentSelect);
        	dateString = d.getFullYear() + '-' + ('0'+(d.getMonth()+1)).slice(-2) + '-' + ('0' + d.getDate()).slice(-2) ;
        	$("#update_date").val(e.date);
        	$("#current-select-date").text(dateString);
        });

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
			// var fd = new FormData();
			// fd.append("#taskfile", $('#taskfile1')[0].files[0]);
			//console.log(files);
		    $('#fileName').val(files[0].name);
		    tfile = files[0];
		}

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
	        function init() {
	            updateDisplay();
	        }
	        init();
	    });
	    
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
	    	var form = $('#settingForm');
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
	    	$.ajax({
			    url: base_url + '/agency/mypage/jobs/matching-case/task-setting-ajax',
			    data: formData,
			    type: 'POST',
			    contentType: false,
			    processData: false,
			    success: function(json) {
			    	window.location.href = '/agency/mypage/jobs/matching-case/task-setting/' + hireId;
			    }
			});
	    	return false;
	    }
	    $(document).ready(function() {
	    	$('#current-select-date').text($('#update_date').val() );
	    });
	    var deleteTask = function(work_set_id)
	    {
	    	if(!confirm('削除しますか？')) return false;
	    	$.ajax({
	    		url: base_url + '/agency/mypage/jobs/matching-case/task-setting-action',
	    		data: {act: 'deleteTask', work_set_id: work_set_id},
	    		type: 'POST',
	    		success: function(json)
	    		{
	    			$('#wtri-'+work_set_id).remove();
	    		}
	    	})
	    }