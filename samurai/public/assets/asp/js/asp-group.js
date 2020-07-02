(function($){
$(function(){
	$('.olGroupEdit').olGroupEdit();
	$('#olGroupEditModal').olGroupEditModal();
	//
    $('#olGroupAdd').olGroupAdd();
	$('.olDelGroup').olDelGroup();
	//

});
$.fn.olDelGroup = function(opts){
    var sets = $.extend({},$.fn.olDelGroup.defaults,opts);
        return this.each(function(){
        var $element = $(this);     
        var mod = (function(){
            var exp = {};
            var $modal_del;
            exp.init = function(){
                $modal_del = $('#olGroupDelModal');
                $modal_del.modal({
                    show:false
                });                
                listend();
            }
            var listend = function(){
                $element.on('click',handleShowDel);
            }
            var handleShowDel = function(ev){
                ev.preventDefault();
                resetModalDel();
                $modal_del.modal('show');                
                return true;
            }
            var resetModalDel = function(){
                var href = $element.attr('href');
                var title = $element.data('title');
                $modal_del.find('.group-tit:first').text(title);
                $modal_del.find('.olBtnDel:first').attr({
                    'href': href
                });
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
$.fn.olDelGroup.defaults = {
}
$.fn.olGroupAdd = function(opts){
    var sets = $.extend({},$.fn.olGroupAdd.defaults,opts);
    return this.each(function(){
        var $element = $(this);
        var mod = (function(){
            var exp = {};
            var $result,$bt_add,$ip_title,$bt_save,$bt_del;
            var $modal;
            exp.init = function(){     	
                $modal = $('#olGroupAddModal');                
                if($modal.length == 0){return false;}
                $result = $element.find('.lst-group:first');
                $bt_add = $element.find('#olGroupAddBtn');
                $form = $modal.find('form:first');
                $ip_title = $modal.find('input[name="title"]');
                $bt_save = $modal.find('.ol-save:first');                
                $modal.modal({
                    show:false
                });
                listend();
            }
            var listend = function(){
                $bt_add.on('click',handleShow);
				$form.on('submit',handleSubmit);
            }
            var handleShow = function(ev){
            	ev.preventDefault();
            	resetForm();
            	$modal.modal('show');
            	return true;
            }
            var resetForm = function(){
            	$ip_title.val('');
            	return true;
            }
            var handleSubmit = function(ev){
            	ev.preventDefault();
            	var dt = $form.serialize();
            	$('body').css('cursor','wait');
            	$.ajax({
            		url: $form.attr('action'),
            		type: 'POST',
            		data: dt,
            	})
            	.done(function(res) {
            		if(typeof res !== 'object'){
            			res = JSON.parse(res);
            		}
            		if(res.error){
            			alert(res.message);
            			return false;
            		}
            		handleSave(res.data);
            	})
            	.fail(function() {
            		console.log("error");
            	})
            	.always(function() {
            		$('body').css('cursor','default');
            	});
            	var handleSave = function(dt){
            		var ele = getElement(dt);
            		$result.append(ele);
                    var $l_child = $result.children(':last-child')
            		$l_child.olGroupEdit();
                    $l_child.find('.olDelGroup').olDelGroup();
            		$modal.modal('hide');
            		return true;
            	}
            	var getElement = function(dt){
            		var out='';
					out += '<h4 class="left-border olGroupEdit" data-id="'+dt.id+'">';
					out += '<a href="'+getLinkGroupEdit(dt)+'" class="ol-name">'+dt.title+'</a>';
					out += '</h4>';
                    out += '<div class="row accounts">';
                    out += '<div class="actions">';
                    out += '<a href="'+getLinkCreateUser(dt)+'" class="btn-add"><i class="fa fa-plus"></i><span>追加する</span></a>';
                    out += '<a href="'+getLinkDestroy(dt)+'" class="btn btn-red olDelGroup" data-title="'+dt.title+'">グループ削除</a>'
                    out += '</div>';
                    out += '</div>';
            		return out;
            	}
                var getLinkGroupEdit = function(dt){
                    out = '/asp/manager-account/group/'+dt.id;
                    return out;
                }
                var getLinkCreateUser = function(dt){
                    out = '/asp/manager-account/create?group_id='+dt.id;
                    return out;
                }
                var getLinkDestroy = function(dt){
                    var out = '/asp/mamnager-account/group/destroy/'+dt.id;
                    return out;
                }
            	return true;
            }
            return exp;
        })();
        return mod.init();
    });
}
$.fn.olGroupAdd.defaults = {
}            
$.fn.olGroupEdit = function(opts){
    var sets = $.extend({},$.fn.olGroupEdit.defaults,opts);
    return this.each(function(){
        var $element = $(this);
        var mod = (function(){
            var exp = {};
            var $btn_edit,$modal,ip_id,$ip_title;
            exp.init = function(){
                $modal = $(sets.modal);
                if($modal.length==0){return false;}
                ip_id = $element.data('id');
                $ip_title = $element.find('.ol-name:first');
                listend();
            }
            var listend = function(){
				$ip_title.on('click',handleEdit);
				$element.on('olGroupEditSuccess',handleSuccess);
            }
            var handleEdit = function(ev){
            	ev.preventDefault();
            	var dt = {
            		id : ip_id,
            		title : $ip_title.text()
            	}
            	$modal.trigger('showModal',dt);
            	return true;
            }
            var handleSuccess = function(ev,dt){
            	console.log(dt);
            	if(typeof dt !== 'object'){ return false;}
            	$ip_title.text(dt.title);
				return true;	
            }
            return exp;
        })();
        return mod.init();
    });
}
$.fn.olGroupEdit.defaults = {
	modal : '#olGroupEditModal'
}  
$.fn.olGroupEditModal = function(opts){
	var sets = $.extend({},$.fn.olGroupEditModal.defaults,opts);
	return this.each(function(){
	  var $element = $(this);
	  var mod = (function(){
	      var exp = {};
	      var $ip_id,$ip_title,$bt_save,$form;
	      exp.init = function(){
	          $element.modal({
	          	show:false
	          });
	          $body = $('body');
	          $ip_id = $element.find('input[name="group_id"]');
	          $ip_title = $element.find('input[name="title"]');
	          $bt_save = $element.find('.ol-save:first');
	          $form = $element.find('form:first');
	          listend();
	      }
	      var listend = function(){
				$element.on('showModal',handleShow);
				$form.on('submit',handleSubmit);
	      }
	      var handleShow = function(ev,dt){
	      	ev.preventDefault();
	      	if(typeof dt !== 'object'){ return false;}
	      	updateForm(dt);
	      	$element.modal('show');
	      	return true;
	      }
	      var updateForm = function(dt){
	      	$ip_id.val(dt.id);
	      	$ip_title.val(dt.title);
	      	return true;
	      }
	      var handleSubmit = function(ev){
	      	ev.preventDefault();
	      	var dt = $form.serialize();
	      	$body.css('cusor','wait');
	      	$.ajax({
	      		url: $form.attr('action'),
	      		type: 'POST',
	      		data: dt,
	      	})
	      	.done(function(res) {
	      		if(typeof res !== 'object'){ res = JSON.parse(res);}
	      		if(res.error == 1){
	      			alert(res.error);return false;
	      		}
	      		handleSuccess();
	      	})
	      	.fail(function() {
	      		console.log("error");
	      	})
	      	.always(function() {
	      		$body.css('cusor','default');
	      	});
	      	
	      	return true;
	      }
	      var handleSuccess = function(){
	      	var dt = {
	      		title : $ip_title.val()
	      	}
	      	var $cr_ele = $body.find('.olGroupEdit[data-id="'+$ip_id.val()+'"]');
	      	$cr_ele.trigger('olGroupEditSuccess',dt);
			$element.modal('hide');
			return true;
	      }
	      return exp;
	  })();
	  return mod.init();
	});
	}
	$.fn.olGroupEditModal.defaults = {
	}                      
})(jQuery);