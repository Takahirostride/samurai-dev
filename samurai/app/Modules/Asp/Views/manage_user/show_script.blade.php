<div class="modal fade modal-ntf" id="modal-register-client">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h3 class="client-name"></h3>
                <div class="alert alert-success">
                    <div class="alert-ct">
                        <h3><span class="cp-name"></span>を登録します。<br/>よろしいですか？</h3>
                    </div>                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-gray" data-dismiss="modal">戻る</button>
                <button type="button" class="btn btn-orange ol-save">登録する</button>
            </div>
        </div>
    </div>
</div>
<script>
(function($){
    $(function(){
    $('#status-client').modal('show');        
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
        if(!fr_validator_modal){
            ev.preventDefault();
            var company_name = $('input[name="company_name"]').val();
            $modal_reg.find('.cp-name:first').text(company_name);
            $modal_reg.modal('show');
            return false;
        }
        return true;
    });   
    });    
})(jQuery);	
</script>