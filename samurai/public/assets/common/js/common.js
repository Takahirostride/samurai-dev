/*
*
*	Created By : Trieunb - 10/10/2018
*	Description: Common js
*	
*/
$(document).ready(function(){
	//cal function here
	init();
	initEvents();
	//activeMenu();
	dRatingInit();
	starRatingInit('.stars-example-fontawesome-o', '.recom-rating-disabled');
	redirectPublic();
});

function init() {
	$(".tooltips").hover(function(){
		$(".tooltips").removeClass("active");
        $(this).toggleClass('active');
	});
	
	$('.tooltips').mouseleave(function(){
	    $(this).removeClass('active');
	});
}
function initEvents() {
	$('#document-surrogate-cost').click( function(){
		if ($('#document-surrogate-cost').is(':checked')) {
			$("#document-surrogate-cost-text").removeAttr( "disabled" );
		}else{
			$("#document-surrogate-cost-text").prop('disabled', true);
		}
	});
	$('#success-fee').click( function(){
		if ($('#success-fee').is(':checked')) {
			$("#success-fee-text").removeAttr( "disabled" );
		}else{
			$("#success-fee-text").prop('disabled', true);
		}
	});

	$('#municipality-other').click( function(){
		if ($('#municipality-other').is(':checked')) {
			$("#municipality-other-text").removeAttr( "disabled" );
			$("#Municipality-select").prop('disabled', true);
		}else{
			$("#municipality-other-text").prop('disabled', true);
			$("#Municipality-select").removeAttr( "disabled" );
		}
	});
	
	$('#location-other').click( function(){
		if ($('#location-other').is(':checked')) {
			$("#location-other-text").removeAttr( "disabled" );
			$("#local-select").prop('disabled', true);
		}else{
			$("#location-other-text").prop('disabled', true);
			$("#local-select").removeAttr( "disabled" );
		}
	});

	// Get the modal
	$('#btn-open-modal').click( function(){
		 $('#myModal').modal("show");
	});
	$('.exit').click( function(){
		 $('#myModal').modal("hide");
	});
	// show read more
	$(document).on('click', '.read-more', function(){
    	var obj = $(this);
    	var id = obj.attr('data-show');
    	var visible = $('#'+id).is(':visible');
    	if (visible) {
	        $('#'+id).css('display', "none");
	    } else {
	        $('#'+id).css('display', 'block');
		}
	})

	$(document).on('click', '.btn-subsidychecklist', function() {
		$active = $(this).data('active');
		$type 	= $(this).data('type');
		if ($active) {
			$(this).data('active', 0);
			$(this).removeClass('btn-warning');
			$(this).removeClass('btn-success');
			$(this).removeClass('btn-default-select');
			$(this).addClass('btn-style-grey');
		} else {
			$(this).data('active', 1);
			$(this).removeClass('btn-style-grey');
			if ($type == '0') {
				$(this).addClass('btn-warning');
			}
			if ($type == '1') {
				$(this).addClass('btn-success');
			}
			if ($type == '2') {
				$(this).addClass('btn-default-select');
			}
		}
		var data = {
			policy_id 	: $(this).data('id'),
			type 		: $type
		};
		$.ajax({
            url: '/common/policy-put',
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function (res) {   // success callback function
            	console.log(res)
		    }
        });
	});
	$(document).on('click', '.btn-follow', function() {
		active = $(this).data('active');
		if (active) {
			$(this).data('active', 0);
			$(this).addClass('btn-style-grey');
		} else {
			$(this).data('active', 1);
			$(this).removeClass('btn-style-grey');
		}

		var data = {
			follow_id 	: $(this).data('id'),
		};
		$.ajax({
            url: '/common/follow',
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function (res) {   // success callback function
            	if(res.success)
            	{

            	}
		    }
        });
	});
	$(document).on('click', '.btn-bookmark', function() {
		var el = $(this).find('i');
		policy_id = $(this).data('policyid');
		if($(this).find('i.fa-star').length){
			$.confirm({
				boxWidth: '320px',
				useBootstrap: false,
			    title: 'お気に入りから削除しますか？',
			    content: false,
			    titleClass: 'font20',
				buttons: {
			        いいえ: {
			            btnClass: 'btn-bookmark-cf',
			            action: function(){
			            	close();
			            }
			        },
			        はい: {
			            btnClass: 'btn-bookmark-cf', 
			            action: function(){
			            	$.ajax({
					            url: '/common/checklist',
					            type: 'POST',
					            dataType: 'json',
					            data: {policy_id: policy_id},
					            success: function (res) { 
					            	if(res.success)
					            	{
					            		$(el).addClass('fa-star');
										$(el).removeClass('fa-star-o');
									} else {
										$(el).removeClass('fa-star');
										$(el).addClass('fa-star-o');
					            	}
							    }
					        });
			            }
			        },
			    }
			});
		}else{
			$.ajax({
	            url: '/common/checklist',
	            type: 'POST',
	            dataType: 'json',
	            data: {policy_id: policy_id},
	            success: function (res) { 
	            	if(res.success)
	            	{
	            		$(el).addClass('fa-star');
						$(el).removeClass('fa-star-o');
					} else {
						$(el).removeClass('fa-star');
						$(el).addClass('fa-star-o');
	            	}
			    }
	        });
		}
		
	});
	$(document).on('change', '.per-page', function() {
		var full_url 	= window.location.href;
		var per_page 	= $(this).val();
		var url 		= '';
		if (GetURLParameter('per_page') == null) {
			if (full_url.indexOf('?') > -1) {
				url = full_url+'&per_page='+per_page
			} else {
				url = full_url+'?per_page='+per_page
			} 
		} else {
			url  =	full_url.replace(GetURLParameter('per_page')[0]+'='+GetURLParameter('per_page')[1], GetURLParameter('per_page')[0]+'='+per_page)
		}
		window.location.href = url;
	});
	$(document).on('change', '.order-by', function() {
		var full_url 	= window.location.href;
		var order 		= $(this).val();
		var url 		= '';
		if (GetURLParameter('order') == null) {
			if (full_url.indexOf('?') > -1) {
				url = full_url+'&order='+order
			} else {
				url = full_url+'?order='+order
			} 
		} else {
			url  =	full_url.replace(GetURLParameter('order')[0]+'='+GetURLParameter('order')[1], GetURLParameter('order')[0]+'='+order)
		}
		window.location.href = url;
	});
	$(document).on('click', '.pagination>li>button', function() {
		var full_url 		= window.location.href;
		var current_page 	= $(this).data('page');
		var url 		= '';
		if (GetURLParameter('current_page') == null) {
			if (full_url.indexOf('?') > -1) {
				url = full_url+'&current_page='+current_page
			} else {
				url = full_url+'?current_page='+current_page
			} 
		} else {
			url  =	full_url.replace(GetURLParameter('current_page')[0]+'='+GetURLParameter('current_page')[1], GetURLParameter('current_page')[0]+'='+current_page)
		}
		window.location.href = url;
	});
}

$('.dcollapse-btn').click(function(index, el) {
	var $this = $(this);
	var thisTarget = $(this).data('target');
	var target = $('#'+thisTarget);
	if(target.hasClass('in'))
	{
		target.removeClass('in');
		$this.find('i').removeClass('fa-chevron-left');
		$this.find('i').addClass('fa-chevron-down');
	} else {
		target.addClass('in');
		$this.find('i').addClass('fa-chevron-left');
		$this.find('i').removeClass('fa-chevron-down');
		
	}
});

function activeMenu() {
	var url 	= window.location.href;
	var lenghtUrl = url.length;
	if (url.slice(-1)	===	'/') {
		url 	= url.substring(0, (lenghtUrl-1));
	}
	$('.nav-item').removeClass('active');
	$('.nav-item').not('.dropdown').each(function() {
		var href = $(this).find('a').attr('href');
		if (href  === url) {
			$(this).addClass('active');
		}
	});
}
function dRatingInit()
{
	if($('body').find('dstar-rating'))
	{
		$('.dstar-rating').each(function(index, el) {
			var thisClass = $(el).data('id');
			var selectClass = $(el).find('select').attr('id');
			starRatingInit('.'+thisClass, '#'+selectClass);
		});
	}
}
function starRatingInit(div_el, select_el) {
	var currentRating = $(select_el).data('current-rating');

    $(div_el + ' .current-rating')
        .find('span')
        .html(currentRating);

    $(div_el + ' .clear-rating').on('click', function(event) {
        event.preventDefault();

        $(select_el)
            .barrating('clear');
    });
	$(select_el).barrating({
        theme: 'fontawesome-stars-o',
        showSelectedRating: false,
        readonly: true,
        initialRating: currentRating,
        onSelect: function(value, text) {
            if (!value) {
                $(select_el)
                    .barrating('clear');
            } else {
                $(div_el + ' .current-rating')
                    .addClass('hidden');

                $(div_el + ' .your-rating')
                    .removeClass('hidden')
                    .find('span')
                    .html(value);
            }
        },
        onClear: function(value, text) {
            $(div_el)
                .find('.current-rating')
                .removeClass('hidden')
                .end()
                .find('.your-rating')
                .addClass('hidden');
        }
    });
}
/**
*   Created by  :   Trieunb - 12/10/2018 
*   Description :   GetURLParameter
*   @return     :
*/
function GetURLParameter(sParam) {
	var sPageURL = window.location.search.substring(1);
	var sURLVariables = sPageURL.split('&');
	for (var i = 0; i < sURLVariables.length; i++)
	{
	    var sParameterName = sURLVariables[i].split('=');
	    if (sParameterName[0] == sParam)
	    {
	        return sParameterName;
	    }
	}
	return null;
}
var redirectPublic = function()
{
	var hr = $(location).attr('pathname');
	if(hr.indexOf('/samurai/public/') !== -1)
	{
		newHr = hr.replace('/samurai/public/', '/');
		window.location.href = newHr;
	}
}