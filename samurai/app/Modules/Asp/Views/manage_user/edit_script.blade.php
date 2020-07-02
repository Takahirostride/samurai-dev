<script>
(function($){
    $(function(){
    var $fr_validator = $('#fr-csv');
    $fr_validator.validator({   
    	disable:false 
    });
    var $element_error = false;
    function check_extra_validator(){
        var error = false; 
        $element_error = false;   
        var display_error = function($el){
            $element_error = $el.siblings('.with-errors:first');
            $element_error.text('Required');
        }
        var remove_error = function($el){
            $el.siblings('.with-errors').text('');
        }
        var $tags = $fr_validator.find('input[name="trade[]"]');
        remove_error($('.box-trade'));
        if($tags.length > 0){
            var i = 0;
            var tag_null = false;
            var $ite;    
            while(i<$tags.length){
                $ite = $($tags[i]);
                if($ite.is(':checked')){
                    tag_null = true;
                    i += $tags.length;
                }
                i++;
            }
            if(!tag_null){
                error = true;
                display_error($('.box-trade'));
            }
        }
        return error;
    }
    var $modal_reg = $('#modal-register-client');
    $modal_reg.modal({show:false});
    var fr_validator_modal = false;
    $modal_reg.on('click','.ol-save',function(ev){
        ev.preventDefault();
        fr_validator_modal = true;
        $fr_validator.trigger('submit');
        return true;
    })
    $fr_validator.on('submit',function(ev){
        var error = check_extra_validator();
        if(ev.isDefaultPrevented()){
            ev.preventDefault();return false;
        }else if(error){
            ev.preventDefault();
            if($element_error){
                $('html,body').stop().animate({
                    scrollTop: $element_error.offset().top,
                },
                    700
                );
            }
            return false;
        }
        return true;
    });   
    });    
})(jQuery);	
	
</script>