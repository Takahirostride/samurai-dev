<div class="modal fade" id="user-rating">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">評価設定</h4>
			</div>
			<div class="modal-body">
				<h3 class="rate-title">依頼者からの評価</h3>
				<table class="table oltb tb-rating">
					<tbody>
						<tr>
							<td>
								<p class="rate-lb">実績</p>
								<p>{{ $user['result'] }}</p>
		                        <p>1ヶ月 : {{ $rating_info['result_a_month'] }}件</p>
		                        <p>半年： {{ $rating_info['result_a_half_year'] }}件</p>								
							</td>
							<td>
								<p class="rate-lb">評価</p>
								<p>{{$user['evaluate']}}</p>
		                        <div>
		                            <div class="star-rating total-rating">
										<select class="total-rating-disabled" data-current-rating="{{$user['evaluate']}}" name="rating" autocomplete="off">
											<option value=""></option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
										</select>
									</div>

		                        </div>	
		                        <p>1ヶ月 : {{ $rating_info['evaluate_a_month'] }}件</p>
		                        <p>半年： {{ $rating_info['evaluate_a_half_year'] }}件</p>		                        							
							</td>
							<td>
								<p class="rate-lb">直接依頼</p>
								<p>{{$rating_info['direct_request']}}件</p>
							</td>
							<td>
								<p class="rate-lb">進行案件</p>
								<p>{{$rating_info['state_project']}}件</p>
							</td>
						</tr>
					</tbody>
				</table>
				<div id="wr-feedback"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div> 
<script>
(function($){
$(function(){
	starRatingInit('.total-rating', '.total-rating-disabled');
	$('#wr-feedback').olFeedback({
		ajax_url : '/admin/employee/customerinfo/feedback/{{ $user->id }}',
		ajax_display : '/admin/employee/customerinfo/feedback'
	});

});
$.fn.olFeedback = function(opts){
	    var sets = $.extend({},$.fn.olFeedback.defaults,opts);
	    return this.each(function(){
	        var $element = $(this);
	        var mod = (function(){
	            var exp = {},token;
	            var $body;
	            exp.init = function(){
	            	$body = $('body');
	            	$token = $('meta[name="csrf-token"]').attr('content');
	                getPage(sets.ajax_url);
	                listend();
	            }
	            var listend = function(){
					$element.on('click','.pagination a',handlePaginate);
					$element.on('change','.ip-display',handleSelect);
	            }
	            var handleSelect = function(ev){
	            	ev.preventDefault();
	            	var $ele = $(this);
	            	var id = $ele.data('id');
	            	var value = $ele.children('option:selected').val();
	            	$body.css({cursor:'wait'});
	            	$.ajax({
	            		url: sets.ajax_display,
	            		type: 'POST',
	            		data: {
	            			_token : token,
	            			id : id,
	            			display : value
	            		},
	            	})
	            	.done(function(res) {
	            		if(typeof res !== 'object'){ res = JSON.parse(res);}
	            		if(res.error){
	            			alert('Error!');
	            			return false;
	            		}
	            		return true;
	            	})
	            	.fail(function() {
	            		console.log("error");
	            	})
	            	.always(function() {
	            		$body.css({cursor:'default'});
	            	});
	            	
	            	return true;
	            }
	            var handlePaginate = function(ev){
	            	ev.preventDefault();
	            	var href = $(this).attr('href');
	            	if(!checkLink(href)){return false;}
	            	$body.css({cusor:'wait'});
	            	getPage(href);
	            	return true;
	            }
	            var getPage = function(url){
	            	$.get(url,function(res){
	            		$element.html(res);
	            		initRating();
	            		$body.css({cursor:'default'});
	            	});
	            }
	            var initRating = function(){
	            	var count_fb = $element.find('.info-daily').length;
					for( i = 0; i < count_fb; i++)
					{
						starRatingInit('.fbrtdiv-'+i, '.fbrtsl-'+i);
						starRatingInit('.fbrtdiv1-'+i, '.fbrtsl1-'+i);
						starRatingInit('.fbrtdiv2-'+i, '.fbrtsl2-'+i);
						starRatingInit('.fbrtdiv3-'+i, '.fbrtsl3-'+i);
						starRatingInit('.fbrtdiv4-'+i, '.fbrtsl4-'+i);
						starRatingInit('.fbrtdiv5-'+i, '.fbrtsl5-'+i);
					}
					$element.find('');
					return true;
	            }
	            var checkLink = function(dt){
	            	if(typeof dt==='undefined' || dt===null || dt==''||dt=='#' ){
	            		return false;
	            	}
	            	return true;
	            }
	            return exp;
	        })();
	        return mod.init();
	    });
	}
	$.fn.olFeedback.defaults = {
		ajax_url : '',
		ajax_display : ''
	}            	
})(jQuery)	
</script>