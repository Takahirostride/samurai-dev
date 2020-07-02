(function($){
$(function(){
    $('.olPickDate').datepicker({
        language : 'ja',
        todayHighlight: true,
        format:'yyyy年mm月dd日'        
    }); 
    $('#client-register').modalClientRegister();
    $(".input-group-addon").click(function() {
        $(".olPickDate").datepicker('show')
    });
}); 
var initRating = function()
{
    for(var i = 0; i < matching_users_total; i++) {
        starRatingInit('.star-rating', '.fbrtsl-' + i);
    }
    
}
initRating();

$.fn.modalClientRegister = function(opts){
    var sets = $.extend({},$.fn.modalClientRegister.defaults,opts);
    return this.each(function(){
        var $element = $(this);
        var mod = (function(){
            var exp = {};
            var $body,$fr_data,$ip_date,$ip_price,$ip_date_show,$ip_price_show;
            var $btn_check,$btn_edit,$btn_submit;
            var $step_1,$step_2,$step_3;
            exp.init = function(){
                $body = $('body');
                $element.modal({});                
                $fr_data = $element.find('#fr_reg_data');
                $ip_date = $element.find('.olPickDate:first');
                $ip_date_show = $element.find('#complete_date_show');
                $ip_price = $element.find('select[name="budget"]');
                $ip_price_show = $element.find('#title_show');
                $btn_check = $element.find('.olCheck:first');
                $btn_edit = $element.find('.olEdit:first');
                $btn_submit = $element.find('.olSubmit:first');
                $step_1 = $element.find('#reg-step-1');
                $step_2 = $element.find('#reg-step-2');
                $step_3 = $element.find('#reg-step-3');
                listend();
            }
            var listend = function(){
                $body.on('click','.client-suggest',openModel);
                $btn_check.on('click',handleCheck);
                $btn_edit.on('click',handleEdit);
                $btn_submit.on('click',handleSubmit);
            }
            var handleSubmit = function(ev){
                ev.preventDefault();
                $body.css('cursor','wait');
                $.ajax({
                    url: sets.ajax_url,
                    type: 'POST',
                    data: $fr_data.serialize(),
                })
                .done(function(res) {
                    console.log(res);
                    if(typeof res !== 'object'){
                        res = JSON.parse(res);
                    }
                    if(res.error){
                        alert(res.message);
                        return false;
                    }
                    activeStep($step_3);
                    return true;
                })
                .fail(function() {
                    console.log("error");
                })
                .always(function() {
                    $body.css('cursor','default');
                });
                
                return true;
            }
            var handleEdit =function(ev){
                ev.preventDefault();
                activeStep($step_1)
                return true;
            }
            var handleCheck = function(ev){
                ev.preventDefault();
                var error = checkData();
                if(error){ return false;}
                UpdateShowData();
                activeStep($step_2);
                return true;
            }
            var activeStep = function($step){
                $step_1.removeClass('active');
                $step_2.removeClass('active');
                $step_3.removeClass('active');
                $step.addClass('active');
                return true;
            }
            var UpdateShowData = function(){
                $ip_date_show.html($ip_date.val());
                var price = $ip_price.find('option:selected').text();
                $ip_price_show.html(price);
                return true;    
            }
            var checkData = function(){
                var complete = $ip_date.val();
                if(isNull(complete)){
                    alert('必須項目を入力してください。');
                    return true;
                }
                return false;
            }
            var isNull = function(dt){
                if(typeof dt === 'undefined' || dt===null || dt.trim()==''){
                    return true;
                }
                return false;
            }
            var openModel = function(ev){
                ev.preventDefault();
                $element.modal('show');
                return true;
            }
            return exp;
        })();
        return mod.init();
    });
}
$.fn.modalClientRegister.defaults = {
    'ajax_url':'/client/add-post'
}            
})(jQuery)