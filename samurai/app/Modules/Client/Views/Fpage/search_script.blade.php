	<script>
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
		$(document).on('click', '.btnic', function() {
			$(this).closest('.row').remove();
		});
		
		$(document).on('click', '.check_list_all', function() {
			var status = $(this).is(':checked');
			thisVal = $(this).val();
			var catId = [];
			$('.'+thisVal).each(function(index, el) {
				$(el).prop('checked', status);
				if($(this).is(':checked')) {
					$('.subcat').each(function(index, el) {
						$(el).prop('checked', false);
					});
					$('.subcattable').show();
				}else{
					$('.subcat').each(function(index, el) {
						$(el).prop('checked', false);
					});
					$('.subcattable').hide();
				}
			});
		});

		$(document).on('change', '.bigcat', function() {
			subid = '#'+$(this).attr('sub-id');
			if($(this).is(':checked')) {
				$(subid).show();
			}else{
				$(subid+' .subcat').each(function(index, el) {
					$(el).prop('checked', false);
				});
				$(subid).hide();
			}
		});
		//init-cate
		$('input[name="category[]"]').filter(':checked').trigger('change');
		//
		$(document).on('click', '.check_list_all_sub', function() {
			var status = $(this).is(':checked');
			thisVal = $(this).val();
			$('#'+thisVal+' .subcat').each(function(index, el) {
				$(el).prop('checked', status);
			});
		});
		$(document).on('change', '.selectregion', function() {
			var obj = $(this);
			var url = '{{URL::to("/agency/ajaxGetCity")}}'+'/'+obj.val();
			$.get(url, function(data, status){
                var ar = JSON.parse(data);
                var str = '';
                for(key in ar){
                    str += '<div class="col-sm-4">\
								<div class="checkbox"><label><input type="checkbox" class="cities" name="cities[]" value="'+key+'">'+ar[key]+'</label></div>\
							</div>';
                }
                if(str!='') {
	                str += '<div class="text-right mgbt-20">\
						<button type="button" data-check="cities" class="check_all btn btn-default btn-lg mgr-20">全選択</button>\
						<button type="button" data-check="cities" class="un_check_all btn btn-default btn-lg mgr-20">全解除</button>\
					</div>';
				}
                $('#cities_checkbox').html(str);
            });
		});
		//initial region
		var $selectregion = $('.selectregion');
		if($selectregion.length > 0){
			var $selectregion_opt = $selectregion.find('option:selected');
			var selectregion_val = $selectregion_opt.val();
			if(selectregion_val !== null && selectregion_val!=''){
				var selectregion_url = '{{URL::to("/agency/ajaxGetCity")}}'+'/'+selectregion_val;
				var selectregion_def = $selectregion.data('cities').split(',');
				$.get(selectregion_url, function(data, status){					
	                var ar = JSON.parse(data);
	                var str = '';
	                var str_chk;
	                for(key in ar){
	                	str_chk = selectregion_def.indexOf(key) >= 0 ? 'checked':'';
	                    str += '<div class="col-sm-4">\
									<div class="checkbox"><label><input type="checkbox" name="cities[]" value="'+key+'" '+str_chk+'>'+ar[key]+'</label></div>\
								</div>';
	                }
	                $('#cities_checkbox').html(str);
	            });				
			}
		}
		//
		$(document).on('click', '#checksearch', function() {
			// var ar = $('input.bigcat:checked').map(function(c, el) {
			//     return $(el).val();
			// }).get();
			// for(key in ar){
			// 	if(!$('#sub_'+ar[key]+' input.subcat:checked').length) {
   //                  // alert("すべての項目を正確に入力してください");
   //                  dialog('','すべての項目を正確に入力してください', '確認');
   //                  return false;
   //              }
			// }
			// return false;
		});
		var count_fb = {{count($results)}};
		$(document).ready(function() {
			for( i = 0; i < count_fb; i++)
			{
				starRatingInit('.fbrtdiv-'+i, '.fbrtsl-'+i);
			}
		});
	</script>