(function($){
$(function(){
    $('#sendmail-modal').modal({show:false});
    $('#sendmail-modal-notify').modal({show:false});
	$('#cli-reg-form').olaspSendMailCheck();
    $('#sendmail-modal').olaspSendMailModal();
    //sendmail-policy
    $('#sendmail-modal-policy').olaspSendMailPolicyModal();
});	            
$.fn.olaspSendMailBtn = function(opts){
    var sets = $.extend({},$.fn.olaspSendMailBtn.defaults,opts);
    return this.each(function(){
        var $element = $(this);
        var mod = (function(){
            var exp = {};
            var $modal;
            exp.init = function(){
                $modal = $('#sendmail-modal-client');
                listend();
            }
            var listend = function(){
                $element.on('click',handleClick);
            }
            var handleClick = function(ev){
                ev.preventDefault();
                $modal.trigger('handleShow');
                return true;
            }
            return exp;
        })();
        return mod.init();
    });
}
$.fn.olaspSendMailBtn.defaults = {
} 
$.fn.olaspSendMailPolicyModal = function(opts){
    var sets = $.extend({},$.fn.olaspSendMailPolicyModal.defaults,opts);
    return this.each(function(){
        var $element = $(this);
        var mod = (function(){
            var exp = {};
            var $btn_send,$form,$message,$title;
            exp.init = function(){
                $element.modal({show:false});
                $form = $element.find('form:first');  
                $message = $form.find('textarea:first');              
                $title = $form.find('input[name="title"]');
                $btn_send = $('.btn-sendmail_policy');              
                listend();
            }
            var listend = function(){
                $form.on('submit',handleSubmit);
                $btn_send.on('click',handleShow);
            }
            var handleShow = function(ev){
                var $ele = $(this);
                var policy_id = $ele.data('policy');
                var client_id = $ele.data('client');
                if(!policy_id || !client_id){ return false;}
                $element.find('input[name="policy_id"]').val(policy_id);
                $element.find('input[name="client_id"]').val(client_id);
                $title.val('');
                $message.val('');
                $element.removeClass('sendOk');
                $element.modal('show');
                return true;
            }
            var handleSubmit = function(ev){
                ev.preventDefault();
                $('body').css('cursor','wait');
                var dt = $form.serialize();
                $.ajax({
                    url: $form.attr('action'),
                    type: 'POST',
                    data: dt,
                })
                .done(function(res) {
                    if(typeof res !== 'object'){ res = JSON.parse(res);}
                    if(res.error == 1){
                        alert(res.message); return false;
                    }
                    handleSendSuccess();
                    return true;
                })
                .fail(function() {
                    console.log("error");
                })
                .always(function() {
                    $('body').css('cursor','default');
                });                             
                return true;
            }
            var handleSendSuccess =function(){
                $element.addClass('sendOk');                
                if(sets.refesh){
                    setTimeout(function(){
                        window.location.reload();
                    },1000)
                    
                }
                return true;
            }
            return exp;
        })();
        return mod.init();
    });
}
$.fn.olaspSendMailPolicyModal.defaults = {
    refesh : false
}            
$.fn.olaspSendMailModal = function(opts){
    var sets = $.extend({},$.fn.olaspSendMailModal.defaults,opts);
    return this.each(function(){
        var $element = $(this);
        var mod = (function(){
            var exp = {};
            var $form,$message,$bl_error;
            exp.init = function(){
                $form = $element.find('form:first');
                $bl_error = $element.find('.alert-warning:first');  
                listend();
            }
            var listend = function(){
				$form.on('submit',handleSubmit);
				$element.on('handleShow',handleShow);
            }
            var handleShow = function(ev){
                $element.removeClass('sendOk');
                $element.removeClass('error');
            	$element.modal('show');
            	return true;
            }
            var handleSubmit = function(ev){
            	ev.preventDefault();
            	var dt = $form.serialize();
                $('body').css({cursor:'wait'});
            	$.ajax({
            		url: $form.attr('action'),
            		type: 'POST',
            		data: dt,
            	})
            	.done(function(res) {
            		if(typeof res !== 'object'){ res = JSON.parse(res);}
            		if(res.error == 1){
            			$bl_error.html(res.message);
                        $element.addClass('error'); 
                        return false;
            		}
            		handleSendSuccess();
            		return true;
            	})
            	.fail(function() {
            		console.log("error");
            	})
            	.always(function() {
                    $('body').css({cursor:'default'});
            	});            	            	
            	return true;
            }
            var handleSendSuccess =function(){
            	$element.addClass('sendOk');                
                if(sets.refesh){
                    setTimeout(function(){
                        window.location.reload();
                    },1000)
                    
                }else{
                    $element.trigger('sendMailSuccess');
                }
            	return true;
            }
            return exp;
        })();
        return mod.init();
    });
}
$.fn.olaspSendMailModal.defaults = {
    refesh : false
}            
$.fn.olaspSendMailCheck = function(opts){
    var sets = $.extend({},$.fn.olaspSendMailCheck.defaults,opts);
    return this.each(function(){
        var $element = $(this);
        var mod = (function(){
            var exp = {};
            var $check_all,$clients,$modal,$modal_client,$modal_ntf;
            exp.init = function(){
                $check_all = $element.find('#checkall');
                $modal = $('#sendmail-modal');
                $modal_ntf = $('#sendmail-modal-notify');
                $modal_client = $modal.find('input[name="client_list"]');   
                listend();
            }
            var listend = function(){				
				$check_all.on('click',handleCheckAll);
                $element.on('click','.btn-send',handleSingle);
				$element.on('click','.btn-popup',handleNotify);
                $modal.on('sendMailSuccess',handleSendSuccess);
            }
            var handleNotify = function(ev){
                ev.preventDefault();
                $modal_ntf.modal('show');
                return true;
            }
            var handleSingle = function(ev){
                ev.preventDefault();
                var $ele = $(this);
                var dt = $ele.data('id');
                if(isNull(dt)){ return false;}
                $modal_client.val(dt);
                $modal.trigger('handleShow');                
                return true;
            }
            var handleSendSuccess = function(){
                var $ele;
                var dt = $modal_client.val();
                if(isNull(dt)){ return false;}
                var dt_ar = dt.split(',');
                dt_ar.forEach(function(ite){
                    $ele = $element.find('.btn-send[data-id="'+ite+'"]');
                    if($ele.length > 0){
                        disableSend($ele);
                    }
                });
                return true;
            }
            var disableSend = function($ele){
                /*$ele.removeClass('btn-send');
                $ele.addClass('btn-popupmail');
                var $par = $ele.closest('tr');
                $par.find('.btn-register').removeClass('hidden');
                $par.find('.btn-email').remove();*/
                var cur_date = currentDate();
                $ele.parent().html(cur_date);
                return true;
            }
            var handleCheckAll = function(ev){
            	ev.preventDefault();
            	ch_clients=[];
                $btns = $element.find('.btn-send');
            	$btns.each(function(){
            		var $ele = $(this);
						ch_clients.push($ele.data('id'));
            	});
            	if(ch_clients.length == 0){
					alert('No company!');
            		return false;
            	}
            	ch_clients = ch_clients.join(',');
				$modal_client.val(ch_clients);
				$modal.trigger('handleShow');
            	return true;
            }
            var currentDate = function(){
                var today = new Date();
                var dd = today.getDate();
                var mm = today.getMonth()+1; //January is 0!
                var yyyy = today.getFullYear();
                if(dd<10) {
                    dd = '0'+dd
                } 
                if(mm<10) {
                    mm = '0'+mm
                } 
                today = yyyy + '/' + mm + '/' + dd;     
                return today;           
            }
            var isNull= function(dt){
                if(typeof dt === 'undefined'||dt===null||dt==''){
                    return true;
                }
                return false;
            }
            return exp;
        })();
        return mod.init();
    });
}
$.fn.olaspSendMailCheck.defaults = {
}            
})(jQuery)