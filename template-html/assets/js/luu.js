function setdatadiv(data, option){
	var result="";

	var data_ar = data.split('</option>');
	if(option == 1) {
		data_ar.forEach(function(element) {
			var clas="";
		  	var text = element.split('>')[1];
		  	var value="";
		  	if(element.indexOf('selected') >=0){
		  		clas = "select-d";
		  	}
		  	if(element.indexOf("value='") >=0){
		  		var value1 = element.split("value='")[1];
		  		if(value1) {
		  			value = value1.split("'")[0];
		  		}
		  	}else{
		  		var value1 = element.split('value="')[1];
		  		if(value1) {
		  			value = value1.split('"')[0];
		  		}
		  	}
		  	if(text) {
			  	result += '<div class="setselect '+clas+'" data-value="'+value+'">'+text+'</div>';
			}
		});
		return result; 
	}else{
		data_ar.forEach(function(element) {
			var clas="";
			var clas1="";
		  	var text = element.split('>')[1];
		  	var value="";
		  	if(element.indexOf('selected') >=0){
		  		clas = 'checked="checked"';
		  		clas1 = "select-d";
		  	}
		  	if(element.indexOf("value='") >=0){
		  		var value1 = element.split("value='")[1];
		  		if(value1) {
		  			value = value1.split("'")[0];
		  		}
		  	}else{
		  		var value1 = element.split('value="')[1];
		  		if(value1) {
		  			value = value1.split('"')[0];
		  		}
		  	}
		  	if(text) {
			  	result += '<div class="setselectmt '+clas1+'"><input class="sel hidden" name="lset[]" type="checkbox" value="'+value+'" '+clas+'>'+text+'</div>';
			}
		});
		return result; 
	}
	
}

function setupselect(){
	$( ".angularsl" ).each(function( index ) {
	  	obj = $(this);
	  	var onclselect = obj.find('.onclselect').length;
	  	if (!onclselect) {
	  		obj.append('<div class="onclselect"></div>');
	  	}
	  	var showoption = obj.find('.showoption').length;
	  	if (!showoption) {
	  		obj.append('<div class="showoption"></div>');
	  	}
	  	var text="abc";
	  	var select = obj.find('> select');
		var data = obj.find('> select').html();
		if(select.prop('multiple')) {
			var dl = setdatadiv(data, 0);
			var values = select.val();
			var val_multi = select.val();
			val_multi.forEach(function(element) {
				text += ','+select.find('option[value="'+element+'"]').text();
			});
			text = text.replace('abc,','');
			text = text.replace('abc','');
			// text = val_multi.toString();
		}else{
			var dl = setdatadiv(data, 1);
			var values = select.val();
			text = select.find('option[value="'+values+'"]').text();
		}
		obj.find('.onclselect').html(text);
		obj.find('.showoption').html(dl);
	});
}

$(document).ready(function(){
	// begin select angular
	setupselect();
	// $('.angularsl').click(function(){
	$(document).on('click', '.angularsl', function(){
		var obj = $(this);
		var select = obj.find('> select');
		var values = obj.find('> select').val();
		if(!select.prop('multiple')) {
			obj.find('.showoption > div').removeClass('select-d');
			obj.find('.showoption > div[data-value="'+values+'"]').addClass('select-d');
		}
		var onoff = obj.find('select').is(':disabled');
		if(!onoff) {
			var select = obj.find('> select');
			obj.find('select').focus().select();
			obj.find('.showoption').addClass('active');
		}
	});
	$(document).on('click', '.showoption div.setselect', function(){
		obj = $(this);
		var value = obj.attr('data-value');
		text = obj.closest('.angularsl').find('select').find('option[value="'+value+'"]').text();
		obj.closest('.angularsl').find('select').val(value);
		obj.addClass('active');
		setTimeout(function() {
			obj.removeClass('active');
			obj.closest('.angularsl').find('.showoption').removeClass('active');
			setupselect();
		}, 300);
	});
	$(document).on('click', '.showoption div.setselectmt', function(){
		obj = $(this);
		var checkel = obj.find('input');
		var value_chek = checkel.val();

		if(checkel.prop("checked")) {
			checkel.prop("checked", false);
			obj.closest('.angularsl').find('select option[value="'+value_chek+'"]').attr('selected', false);
		}else{
			checkel.prop("checked", true);
			obj.closest('.angularsl').find('select option[value="'+value_chek+'"]').attr('selected','selected');
		}
		obj.toggleClass('active');
		obj.toggleClass('select-d');

	});
	$(document).mouseup(function(e) {
	    var container = $(".showoption");
	    if (!container.is(e.target) && container.has(e.target).length === 0) 
	    {
	    	$('.showoption').removeClass('active');
	    	setupselect();
	    }
	});
	// end select angular
	// begin datepicker
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
        todayHighlight: true
    });
    // end datepicker
    // begin tog
    $(document).on('click', '.checkdis', function(){
    	var obj = $(this);
    	var id = obj.attr('data-tgdis');
    	var idar = id.split(",");
    	$.each( idar, function( i, val ) {
		  	var isDisabled = $('#'+val).is(':disabled');
	    	if (isDisabled) {
		        $('#'+val).prop('disabled', false);
		    } else {
		        $('#'+val).prop('disabled', true);
		    }
		});
    });
    // end tog
    $(document).on('change', '.hidefile', function(){
    	var obj = $(this);
    	var id = obj.attr('data-showname');
    	var view = obj.attr('data-view');
    	var filename = obj.val().replace(/C:\\fakepath\\/i, '');
    	$('#'+id).val(filename);
    	if (this.files && this.files[0]) {
    		console.log('#'+view);
		    var reader = new FileReader();
		    reader.onload = function(e) {
		      $('#'+view).attr('src', e.target.result);
		    }
		    reader.readAsDataURL(this.files[0]);
		}
    });
    $('.hidefile').on({
	    'dragover dragenter': function(e) {
	        $(this).closest('.dropbox').css('background-color', '#15b86c80');
	    },
	    drop: function(e) {
            $(this).closest('.dropbox').css('background-color', '#fff');
        }
	});
});



