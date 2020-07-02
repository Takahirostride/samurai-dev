<script>
    (function($){
    $(function(){
        function subsidy_select_post(){
            var $subsidy_cb=$('#subsidy-cbox');
            var $lst_cbox = $('input[name="posts[]"]');
            if($lst_cbox.length == 0){return false;}
                var status_all = [];
                $lst_cbox.each(function(){
                    var value = $(this).data('check');
                    if(status_all.indexOf(value) < 0){
                        status_all.push(value);
                    }
                });
                var $ip_cbox = $subsidy_cb.find('input.check_all');
                $ip_cbox = $ip_cbox.filter(function(){
                    var dt_check = $(this).data('check');
                    if(status_all.indexOf(dt_check) >= 0){
                        return true;
                    }
                    return false;
                });
                $ip_all = $subsidy_cb.find('input.olAll:first');
                $ip_all.on('change',function(){
                    if($ip_all.is(':checked')){
                        $ip_cbox.prop('checked',true);
                    }else{
                       $ip_cbox.prop('checked',false); 
                    }
                    $ip_cbox.trigger('change');
                });
                $ip_cbox.on('change',function(){
                    var c_all = true;
                    $ip_cbox.each(function(){
                        if(!$(this).is(':checked')){
                           c_all = false; 
                        }
                    });
                    if(c_all){
                       $ip_all.prop('checked',true); 
                   }else{
                        $ip_all.prop('checked',false);
                   }
                });                        
        }
        subsidy_select_post();        
    })    
    })(jQuery)    
</script>