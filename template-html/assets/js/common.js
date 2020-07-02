$(document).ready( function(){
	$(".tooltips").hover(function(){
		$(".tooltips").removeClass("active");
        $(this).toggleClass('active');
	});
	
	$('.tooltips').mouseleave(function(){
	    $(this).removeClass('active');
	});

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
    });
	
} )