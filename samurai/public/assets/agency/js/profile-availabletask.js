var category_json = [];
var province_json = [];
var city_json = [];
var ip = 0;
var sub_selected = [];
var user_subcategory = [];
var user_category = [];
var is_appended = false;
$(document).ready(function() {
	
	//display current
	$.ajax({
		url: base_url + '/agency/mypage/profile-ajax',
		data: {act: 'getAvailable'},
		type: 'POST',
		success: function(json)
		{
			category_json = json.cat;
			user_subcategory = json.user_sub_category;
			user_category = json.user_category;
			province_json = json.province;
			city_json = json.city;

			$('.bigcat').each(function(index, el) {
				if( $.inArray(parseInt($(el).val()), user_category) != -1 )
				{
					$(el).trigger('click');
				}
			});
			$('.check-sub').each(function(index, el) {
				if( $.inArray(parseInt($(el).val()), user_subcategory) != -1 )
				{
					$(el).trigger('click');
				}
			});

			//display address 1
			$.each(json.user_address1, function(index, val) {
				append_bsearch(index, val);
			});

		}
	});


});
var append_bsearch = function(province_id, city_id) {
	//province_html = '<option value="54">全国</option>';
	province_html = '';
	$.each(province_json, function(index, val) {
		//if(index == 54) return;
		selected = '';
		if(province_id == index) selected = ' selected="selected"';
		province_html += '<option value="'+index+'"'+selected+'>'+val+'</option>';
	});

	html = '<div class="row">'+
				'<div class="col-xs-4">'+
						'<div class="angularsl">'+
							'<select class="selectpicker province-select" name="province['+ip+']" data-id="'+ip+'" id="province-select-'+ip+'">'+
								province_html+
							'</select>'+
						'</div> <!-- end .angularsl -->'+
					'</div> <!-- end .col-xs-4 -->'+
					'<div class="col-xs-4">'+
						'<div class="angularsl">'+
							'<select class="form-control" multiple="multiple" name="city['+ip+'][]" id="city-select-'+ip+'">'+
								
							'</select>'+
						'</div>'+
					'</div>';
	if(!is_appended) html += '<div class="col-xs-4"></div>';
	else html += '<div class="col-xs-4"><button type="button" onclick="removeAddRow('+ip+');" class="btn btn-default"><i class="fa fa-remove"></i></button></div>';
			html += '</div>';
	$('.append-bsearch').append(html);
	loadCityByProvince($('#province-select-' + ip).val(), ip, city_id);
	ip += 1;
	setupselect();
	is_appended = true;
}
$(document).on('change', '.province-select', function() {
	dataId = $(this).attr('data-id');
	province_id = $('#province-select-' + dataId).val();
	loadCityByProvince(province_id, dataId, 0);
});
var loadCityByProvince = function(province_id, dataId, selected_value) {
	html = '';
	// if(province_id == 54) {
	// 	$.each(province_json, function(index, val) {
	// 		if(index == 54) return;
	// 		html += '<option value="'+index+'">'+val+'</option>';
	// 	});
	// } else {
		$.each(city_json[province_id], function(index, val) {
			selected = '';
			if( $.inArray(parseInt(index), selected_value) != -1 ) selected = ' selected="selected"';
			html += '<option value="'+index+'"'+selected+'>'+val+'</option>';
		});
	//}
	
	$('#city-select-' + dataId).html(html);
}
//display cate/subcate
var loadCatAll = function(dataLoad, tHeadVal, checkAllId) {
	html = '';
	let c = 0;
	
	$.each(dataLoad, function(index, val) {

		if( c%4 == 0 ) {
			html += '<tr>';
		}
		if( c == 0 ) {
			html += '<td class="dthead" rowspan="'+(Math.round(Object.keys(dataLoad).length/4)+1)+'">'+tHeadVal+'</td>';
		}
		html += '<td><div class="checkbox"><label>';
		selected = '';
		if(sub_selected.indexOf(index) != -1) selected = ' checked="checked"';
		html += '<input type="checkbox" class="'+checkAllId+' check-sub" name="subcat[]" '+selected+' value="'+index+'" id="check_list-'+index+'">' + val +
		'</label></div></td>';
		if( c%4 == 3 ) html += '</tr>';
		c += 1;
	});
	if( c/4 != 0) {
		for(let i = (4-(c%4)); i > 0; i--) {
			html += '<td>&nbsp;</td>';
		}
		html += '</tr>';
	}
	html += '<tr>'+
		'<td colspan="5" class="dright-el dbg-gray">'+
			'<div class="checkbox">'+
				'<label>'+
					'<input type="checkbox" value="'+checkAllId+'" class="check_list_all">全選択'+
				'</label>'+
			'</div>'+
		'</td>'+
	'</tr>';

	return html;
	
}
$(document).on('click', '.check_list_all', function() {
	var status = $(this).is(':checked');
	thisVal = $(this).val();
	var catId = [];
	$('.'+thisVal).each(function(index, el) {
		$(el).prop('checked', status);
		if($(this).is(':checked')) {
			catId.push($(el).val());
		}
		
	});
	if(thisVal=='bigcat') {
		loadSubAjax(catId);
	}
	
});
$(document).on('click', '.bigcat', function() {
	var catId = [];
	thisId = $(this).attr('data-id');
	$('.bigcat').each(function(index, el) {
		if($(this).is(':checked')) {
			catId.push($(el).val());
		}
		
	});
	loadSubAjax(catId);
});

$(document).on('click', '.btnic', function() {
	$(this).closest('.row').remove();
});

loadSubAjax = function(catId) {
	loadSubCat(category_json, catId);
}
var loadSubCat = function(json, catId) {
	html = '<h4 class="pagerow-title" id="sub-cat"><span>カテゴリー詳細</span></h4>';
	for(i = 0; i < catId.length; i++) {
		html += '<table id="subcat-table-'+catId[i]+'" class="table table-bordered dtable table-condensed dcat-table">';
		html += '<tbody>';
		html += loadCatAll(json.sub_category[catId[i]], json.category[catId[i]], 'scatlist-'+catId[i]);
		html += '</tbody>';
		html += '</table>';
	}
	
	$('#subcategory-list').html(html);
}


var removeCatEl = function(catId) {
	$('#subcategory-list').empty();
}
$('#checkall_industry').click(function(event) {
	if($(this).is(':checked'))
	{
		$('.trades').each(function(index, el) {
			$(el).prop('checked', true);
		});
	} else {
		$('.trades').each(function(index, el) {
			$(el).prop('checked', false);
		});
	}
});
var removeAddRow = function(dataId) {
	$('#province-select-' + dataId).parent().parent().parent().remove();
}
$(document).on('click', '.check-sub', function(event) {
	if($(this).is(':checked')) sub_selected.push($(this).val());
	else sub_selected.splice(sub_selected.indexOf($(this).val() ) , 1 );

});