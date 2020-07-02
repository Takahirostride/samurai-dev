/*
*	Name 	: 	Agency-Bsearch
*	Author 	: 	Common
*	Created : 	10/10/2018
*	Updated: 	 
*/
$(document).ready(function(){
	//cal function here
	init();
});
/*
*	Name 	: 	Initialization Function
*	Author 	: 	Trieunb
*	Created : 	22/09/2018
*	Modify 	: 	
*	Updated : 	 
*/
function init() {
	try {
		$('#example-fontawesome,.datrating').barrating({
			//index page jubotron
            theme: 'fontawesome-stars',
            showSelectedRating: false,
            onSelect: function(value, text, event) {
			    if (typeof(event) !== 'undefined') {
			      // rating was selected by a user
			      console.log(value);
			    } else {
			      // rating was selected programmatically
			      // by calling `set` method
			    }
			  }
        });
        $('.rating-disable').barrating({
			//index page jubotron
            theme: 'fontawesome-stars',
            showSelectedRating: false,
            readonly: true,
            onSelect: function(value, text, event) {
			    if (typeof(event) !== 'undefined') {
			      // rating was selected by a user
			      console.log(value);
			    } else {
			      // rating was selected programmatically
			      // by calling `set` method
			    }
			  }
        });

		//agency/home tooltip
		$(function () {
		  $('[data-toggle="tooltip"]').tooltip()
		});
		var append_bsearch = function() {
			html = '<div class="row">'+
						'<div class="col-xs-4">'+
								'<div class="angularsl">'+
									'<select class="selectpicker">'+
										'<option value="1">全国</option>'+
										'<option value="2">北海道</option>'+
									'</select>'+
								'</div> <!-- end .angularsl -->'+
							'</div> <!-- end .col-xs-4 -->'+
							'<div class="col-xs-4">'+
								'<div class="angularsl">'+
									'<select class="form-control" multiple="multiple">'+
										'<option value="1">すべて</option>'+
										'<option value="2">1札幌市</option>'+
										'<option value="3" selected="selected">2札幌市</option>'+
										'<option value="4" selected="selected">3札幌市</option>'+
									'</select>'+
								'</div>'+
							'</div>'+
							'<div class="col-xs-4"></div>'+
						'</div>';

			$('.append-bsearch').append(html);
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
				html += '<td><div class="checkbox"><label>'+
				'<input type="checkbox" class="'+checkAllId+'" name="subcat[]" value="'+index+'" id="check_list-'+index+'">' + val
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
			// if(status == 'true') removeCatEl(catId);
			// else 
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
			$.ajax({
				url: 'agency/get_category.json',
				dataType: 'JSON',
				success: function(json) {
					loadSubCat(json, catId);
				}
			});
		}
		var loadSubCat = function(json, catId) {
			// console.log(catId);return;
			html = '<h4 class="pagerow-title" id="sub-cat"><span>カテゴリー詳細</span></h4>';
			for(i = 0; i < catId.length; i++) {
				console.log(json.category[catId[i]]);
				// status = $('.bigcat[data-id="'+catId[i]+'"').is(':checked');
				// if(status == 'false') {
				// 	removeCatEl(catId);
				// }
				html += '<table id="subcat-table-'+catId[i]+'" class="table table-bordered dtable table-condensed dcat-table">';
				html += '<tbody>';
				html += loadCatAll(json.sub_category[catId[i]], json.category[catId[i]], 'scatlist-'+catId[i]);
				html += '</tbody>';
				html += '</table>';
			}
			
			$('#subcategory-list').html(html);
		}


		var removeCatEl = function(catId) {//console.log('#subcat-table-'+catId);
			//$('#subcat-table-'+catId).remove();
			$('#subcategory-list').empty();
			//$('#dat111').html('12');
		}
	} catch(err) {
		console.log(err);
	}
}