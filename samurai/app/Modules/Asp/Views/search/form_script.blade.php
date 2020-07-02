	<script>
		//agency/home tooltip
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
		$('input.bigcat').filter(':checked').trigger('change');
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
			var obj_val = obj.val();
			if(typeof obj_val === 'undefined' || obj_val === null || obj_val==''){
				$('#cities_checkbox').empty();
				return false;
			}
			var url = '{{URL::to("/asp/ajaxGetCity")}}'+'/'+obj_val;
			$.get(url, function(data, status){
                var ar = JSON.parse(data);
                var str = '';
                var all_city=false;
                for(key in ar){
                	all_city = ar[key] == 'すべて' ? 'allCity' : '';
                    str += '<div class="col-sm-4">\
								<div class="checkbox"><label><input type="checkbox" name="cities[]" value="'+key+'" class="'+all_city+'">'+ar[key]+'</label></div>\
							</div>';
                }
                $('#cities_checkbox').html(str);
            });
		});
		$('body').on('change','.allCity',function(ev){
			var $ele = $(this);
			var $r_cities = $('input[name="cities[]"]:not(".allCity")');
			console.log($r_cities );
			if($ele.is(':checked')){
				$r_cities.prop('checked', true);
			}else{
				$r_cities.prop('checked', false);
			}
		});		
		//initial region
		var $selectregion = $('.selectregion');
		if($selectregion.length > 0){
			var $selectregion_opt = $selectregion.find('option:selected');
			var selectregion_val = $selectregion_opt.val();
			if(selectregion_val !== null && selectregion_val!=''){
				var selectregion_url = '{{URL::to("/asp/ajaxGetCity")}}'+'/'+selectregion_val;
				var selectregion_def = $selectregion.data('cities').toString().split(',');
				$.get(selectregion_url, function(data, status){					
	                var ar = JSON.parse(data);
	                var str = '';
	                var str_chk;
	                var all_city;
	                for(key in ar){
	                	all_city = ar[key] == 'すべて' ? 'allCity' : '';
	                	str_chk = selectregion_def.indexOf(key) >= 0 ? 'checked':'';
	                    str += '<div class="col-sm-4">\
									<div class="checkbox"><label><input type="checkbox" name="cities[]" value="'+key+'" '+str_chk+' class="'+all_city+'">'+ar[key]+'</label></div>\
								</div>';
	                }
	                $('#cities_checkbox').html(str);
	            });				
			}
		}
		//
		$(document).on('click', '#checksearch', function() {
			var ar = $('input.bigcat:checked').map(function(c, el) {
			    return $(el).val();
			}).get();
			for(key in ar){
				if(!$('#sub_'+ar[key]+' input.subcat:checked').length) {
                    // alert("すべての項目を正確に入力してください");
                    dialog('','すべての項目を正確に入力してください', '確認');
                    return false;
                }
			}
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