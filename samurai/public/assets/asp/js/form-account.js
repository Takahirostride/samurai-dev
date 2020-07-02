(function($){
$(function(){
	$('#form-account').olAccountValidation();
	$('#form-account-edit').olAccountValidation({
		edit : true
	});
});
$.fn.olAccountValidation = function(opts){
	    var sets = $.extend({},$.fn.olAccountValidation.defaults,opts);
	        return this.each(function(){
	        var $element = $(this);     
	        var mod = (function(){
	            var exp = {};
	            var $account,$element_error=false;
	            exp.init = function(){
	            	$account = $element.find('input[name="account"]');
	            	initValid();
	                listend();
	            }
	            var listend = function(){
	            }
	            var initValid = function(){
	            	var rules = {
					    first_name: "required",
					    last_name: "required",
					    group_id: "required",
					    role_group: "required",
					    email:{
					    	email:true
					    },
					    account : {
					    	required : true,
					    	minlength : 4
					    },
					    password :{
					    	required : true,
					    	rangelength : [8,20]
					    },
					    password_confirmation : {
					    	equalTo : 'input[name="password"]'
					    }	

					};
					if(sets.edit){
						rules.password.required = false;
					}
					$element.validate({
					  rules: rules,
					  messages :{
					  	account :{
					  		minlength : '半角英数字4文字以上の入力をさせます。'
					  	},
					  	password :{
					  		rangelength : '半角英数字8文字以上20文字以内'
					  	}
					  },
					  submitHandler:function(form){
					  	form.submit();
					  }
					});
	            }
	            var checkExtraValid = function(){
	            	$element_error = false;
	            	removeError();
	            	var error = false;
	            	if(checkAccount()){
	            		error = true;
	            		displayError($account,'半角英数字4文字以上の入力をさせます。');
	            		$element_error = $account;

	            	}
	            	return error;
	            }
	            var checkAccount = function(){
	            	var dt = $account.val();
	            	if(dt.length < 4){
	            		return true;
	            	}
	            	return false;
	            }
	            var displayError = function($ele,msg){
	                $ele.after('<p class="error olerror">'+msg+'</p>');
	                return true;
	            }
	            var removeError = function(){
	            	$element.find('.olerror').remove();
	            }	            
	            var handleError = function(){
	            	if(!$element_error){ return false;}
	            	$('html,body').stop().animate({
	            		scrollTop: $element_error.offset().top,
	            		},
	            		500);
	            	return true
	            }
	            var isNull = function(dt){
	                if(typeof dt === 'undefined' || dt===null || dt==''){
	                    return true;
	                }
	                return false;
	            }            
	            return exp;
	        })();
	        return mod.init();
	    });
	}
	$.fn.olAccountValidation.defaults = {
		edit : false
	}	
})(jQuery);