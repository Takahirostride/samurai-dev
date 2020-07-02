(function($){
    $(function(){
        $('.ip_cbox input[type="checkbox"]').olCusCheckbox();
        $('.olcbBlue input[type="checkbox"]').olCusCheckbox();
        $('.olradBlue input[type="radio"]').olCusCheckbox({radio:true});
        //add text from select
        $('.olCboxTog').olCboxTog(); 
        //add text from select
        $('.olSelControl').olSelControl(); 
        //disable input by checkbox
        $('.olCboxControl').olCboxControl();    
        $('.olCboxDisable').olCboxControl({disable:true});    
        //select-province-city	
        $('#address_province').olSelectCity();
        var $address_mintry = $('.select_minitry');
        if($address_mintry.length > 0){
           $.ajax({
                url: '/admin/resource/minitry',
                type: 'GET'
            })
            .done(function(res) {
                if(!res){ return false;}
                if(typeof res !== 'object'){ res = JSON.parse(res);}
                window.__province = res;
                $('body').trigger('endLoadingProvince');
                $address_mintry.olSelectMinitry({});
                return true;                
            })
            .fail(function(error) {
                console.log(error);
            })
            .always(function() {
            });        
        }
        $('#address_minitry_province').olSelectProvinceMinitry();
        //checkbox-all-list
        $('.olCheckAll').olCheckAll();
        $('.olCheckData').olCheckAll({
            dataCheck : true
        });
        $('.olTogBlock').olTogBlock();
        $('.olTogButton').olTogBlock({
            over:false
        });
        $('.tiny-textarea').olTinymce();
        $('.fr-disable').olFormReadonly();
        $('.olNumber').olNumberDec(); 
    });
$.fn.olNumberDec = function(opts){
    var sets = $.extend({},$.fn.olNumberDec.defaults,opts);
    return this.each(function(){
        var $element = $(this);
        var mod = (function(){
            var exp = {};
            var timeout_cv;
            exp.init = function(){
                number2string();
                listend();
            }
            var listend = function(){
                $element.on('keyup',convertString);
            }
            var convertString = function(){
                clearTimeout(timeout_cv);
                timeout_cv = setTimeout(function() {
                  number2string();
                }, 300);
                return true;
            }
            var number2string = function(){
                    var value = $element.val();
                    if(!value || value == ''){
                        return false;
                    }
                    value = value.replace(/,/g,'');
                    value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    $element.val(value);                  
            }
            return exp;
        })();
        return mod.init();
    });
}
$.fn.olNumberDec.defaults = {
    radio : false
}    
    $.fn.olFormReadonly = function(opts){
        var sets = $.extend({},$.fn.olFormReadonly.defaults,opts);
        return this.each(function(){
            var $element = $(this);
            var mod = (function(){
                var exp = {};
                var $checkbox,$radio;
                exp.init = function(){
                    initInput();
                    $checkbox = $element.find('input[type="checkbox"]');
                    $radio = $element.find('input[type="radio"]');
                    listend();
                }
                var listend = function(){
                    $checkbox.on('click',disableCheckbox);
                    $radio.on('click',disableCheckbox);
                }
                var disableCheckbox = function(ev){
                    ev.preventDefault();
                    return false;
                }
                var initInput = function(){
                    $element.find('input').attr({readonly:true});
                    $element.find('textarea').attr({readonly:true});
                }
                return exp;
            })();
            return mod.init();
        });
    }
    $.fn.olFormReadonly.defaults = {
        radio : false
    }      
    $.fn.olCusCheckbox = function(opts){
        var sets = $.extend({},$.fn.olCusCheckbox.defaults,opts);
        return this.each(function(){
            var $element = $(this);
            var mod = (function(){
                var exp = {};
                exp.init = function(){
                    if($element.hasClass('btn-cb')){ return true;}
                    var cls = sets.radio ? 'olradio':'';
                    $element.wrap('<span class="olcb-blue '+cls+'"></span>');
                    $element.parent().append('<span class="checkmark"><i class="glyphicon glyphicon-ok"></i></span>');
                    listend();
                }
                var listend = function(){
    
                }
                return exp;
            })();
            return mod.init();
        });
    }
    $.fn.olCusCheckbox.defaults = {
        radio : false
    }                
    $.fn.olTinymce = function(opts){
        var sets = $.extend({},$.fn.olTinymce.defaults,opts);
        return this.each(function(){
            var $element = $(this);
            var mod = (function(){
                var moduleOut={};
                moduleOut.init = function(){
                    tinymce.init({
                        selector: '#'+$element.attr('id') ,
                        height: 200,
                        theme: 'modern',
                        branding: false,
                        menubar: false,
                        relative_urls: false,
                        plugins: [
                        'advlist autolink lists link charmap print preview anchor textcolor',
                        'searchreplace visualblocks code fullscreen',
                        'contextmenu paste code wordcount'
                        ],
                        toolbar: 'link | undo redo |  formatselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | removeformat',                  
                    });
                }             
                return moduleOut;            
            })();
            return mod.init();
        });
    }
    $.fn.olTinymce.defaults = {
    };
    $.fn.olTogBlock = function(opts){
        var sets = $.extend({},$.fn.olTogBlock.defaults,opts);
        return this.each(function(){
            var $element = $(this);
            var mod = (function(){
                var m_out = {};
                var cr_block,$cr_block,$body;
                m_out.init = function(){
                    $body=$('body');
                    cr_block = $element.attr('data-block');
                    $cr_block = $(cr_block);
                    if($cr_block.length == 0){ return false;}                
                    listend();
                }
                var listend = function(){
                    if(sets.input){
                        $element.on('change',tog_block_cbox);
                    }else{
                        $element.on('click',tog_block);
                    }
                    $cr_block.on('click','.close',hide_block);
                    return true;
                }
                var tog_block_cbox = function(ev){
                    display_block();
                }
                var tog_block = function(ev){
                    ev.preventDefault();
                    if($element.hasClass('active')){
                        hide_block();
                    }else{
                        show_block();
                    }
                    return true;
                }
                var hide_block = function(){
                    $element.removeClass('active');
                    if(sets.slide){
                        $cr_block.slideUp();
                    }
                    $cr_block.removeClass('active'); 
                    if(sets.over){
                        $body.removeClass('overlay');
                        $body.off('click',listend_close);
                    }                 
                }
                var show_block = function(){
                    $element.addClass('active');
                    if(sets.slide){
                        $cr_block.slideDown();
                    }
                    $cr_block.addClass('active'); 
                    if(sets.over){
                        $body.addClass('overlay');
                        $body.on('click',listend_close);
                    }                 
                }
                var listend_close = function(ev){
                    var $target = $(ev.target);
                    if($target.closest(cr_block).length > 0){return true;}
                    if($target.closest('[data-block="'+cr_block+'"]').length > 0){
                        return false;
                    }
                    hide_block();
                    return false;
                }
                return m_out;
            })();
            return mod.init();
        });
    }
    $.fn.olTogBlock.defaults = {
        slide : false,
        input : false,
        over : true
    };
    $.fn.olCboxTog = function(opts){
        var sets = $.extend({},$.fn.olCboxTog.defaults,opts);
        return this.each(function(){
            var $element = $(this);
            var mod = (function(){
                var moduleOut={};
                var $dt_bl;
                moduleOut.init = function(){
                    var dt_bl = $element.attr('data-block');
                    $dt_bl = $(dt_bl);
                    if($dt_bl.length == 0){ return false;}
                    listend();
                } 
                var listend = function(){
                   $element.on('change',function(){                    
                        if($element.is(':checked')){
                            $dt_bl.slideDown();
                        }else{
                            $dt_bl.slideUp();
                        }               
                   }); 
                }
                var isNull = function(dt){
                    if(typeof dt === 'undefined' || dt === null || dt.trim()== ''){
                        return true;
                    }
                    return false;
                }            
                return moduleOut;            
            })();
            return mod.init();
        });
    }
    $.fn.olCboxTog.defaults = {
    };            
    $.fn.olCboxControl = function(opts){
        var sets = $.extend({},$.fn.olCboxControl.defaults,opts);
        return this.each(function(){
            var $element = $(this);
            var mod = (function(){
                var moduleOut={};
                var $checkbox,$ctr_ele;
                moduleOut.init = function(){
                    var ctr_name = $element.data('box');
                    if(isNull(ctr_name)){ return false;}
                    $ctr_ele = $(ctr_name);
                    if($ctr_ele.length == 0){ return false;}
                    initStatus();
                    listend();
                } 
                var initStatus = function(){
                    if($ctr_ele.is(':checked')){
                        activeStatus();
                    }else{
                        disableStatus();
                    }
                    return true;
                }
                var listend = function(){
                    $ctr_ele.on('change',function(){
                        if($ctr_ele.is(':checked')){
                            activeStatus();
                        }else{
                            disableStatus();
                        }
                    });
                }
                var activeStatus = function(){
                    if(sets.disable){
                        $element.attr('readonly','readonly');
                        if($element.is('input')){
                            $element.val('');
                        }else if($element.is('select')){
                            $element.find('option:selected').removeAttr('selected');
                            $element.trigger('change');
                        }
                    }else{
                        $element.removeAttr('readonly');
                    }
                }
                var disableStatus = function(){
                    if(!sets.disable){
                        $element.attr('readonly','readonly');
                        if($element.is('input')){
                            $element.val('');
                        }else if($element.is('select')){
                            $element.find('option:selected').removeAttr('selected');
                            $element.trigger('change');
                        }
                    }else{
                        $element.removeAttr('readonly');
                    }                    
                }
                var isNull = function(dt){
                    if(typeof dt === 'undefined' || dt === null || dt.trim()== ''){
                        return true;
                    }
                    return false;
                }            
                return moduleOut;            
            })();
            return mod.init();
        });
    }
    $.fn.olCboxControl.defaults = {
        disable : false
    };            
    $.fn.olSelControl = function(opts){
        var sets = $.extend({},$.fn.olSelControl.defaults,opts);
        return this.each(function(){
            var $element = $(this);
            var mod = (function(){
                var moduleOut={};
                var $ctr_ele;
                moduleOut.init = function(){
                    var ctr_name = $element.data('input');
                    if(isNull(ctr_name)){ return false;}
                    $ctr_ele = $('input[name="'+ctr_name+'"]');
                    if($ctr_ele.length == 0){ return false;}
                    listend();
                } 
                var listend = function(){
                    $element.on('change',function(){
                        var $opt = $element.find('option:checked');
                        $ctr_ele.val($opt.val());
                    })
                }
                var isNull = function(dt){
                    if(typeof dt === 'undefined' || dt === null || dt.trim()== ''){
                        return true;
                    }
                    return false;
                }            
                return moduleOut;            
            })();
            return mod.init();
        });
    }
    $.fn.olSelControl.defaults = {
    };            
    $.fn.olCheckAll = function(opts){
    	var sets = $.extend({},$.fn.olCheckAll.defaults,opts);
    		return this.each(function(){
    		var $element = $(this);		
    		var mod = (function(){
    		    var exp = {};
    		    var cb_name,$cboxs,data_check;
    		    exp.init = function(){
    		        cb_name = $element.data('name');
    		        if(isNull(cb_name)){ return false;}
    		        $cboxs = $element.closest('form').find('input[name="'+cb_name+'"]');
    		        if($cboxs.length == 0){ return false;}
                    data_check = $element.data('check');
    		        listend();
    		    }
    		    var listend = function(){
    				$element.on('change',handleChange);
    		    }
    		    var handleChange = function(ev){
                    var $cbox_sel = $cboxs;
                    if(sets.dataCheck){
                        $cbox_sel=$cbox_sel.filter('[data-check="'+data_check+'"]');
                    }
    				if($element.is(':checked')){
                        $cbox_sel.prop('checked',true);					
    				}else{
    					$cbox_sel.prop('checked',false);
    				}		    	
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
    $.fn.olCheckAll.defaults = {
        dataCheck:false
    }            
    $.fn.olSelectProvinceMinitry = function(opts){
        var sets = $.extend({},$.fn.olSelectProvinceMinitry.defaults,opts);
        return this.each(function(){
            var $element = $(this);
            var mod = (function(){
                var exp = {};
                var p2c,default_city={0:''};
                var $cities;
                exp.init = function(){
                    var dt_children = $element.data('children');
                    if(isNull(dt_children)){ return false;}
                    $cities = $(dt_children);
                    if($cities.length == 0){ return false;} 
                    init_mod();                                                   
                }
                var listend = function(){
                    $element.on('change',changeProvince);
                }
                var changeProvince = function(){
                    var prv = $(this).children('option:selected').val();
                    var cts = findCity(prv);
                    changeCity(cts);
                    return true;
                }
                var changeCity = function(cts){
                    if(typeof cts !== 'object'){
                        $cities.empty();return false;
                    }
                    var out = '';
                    var cts_length = Object.keys(cts).length;
                    $.each(cts,function(key,ite){
                        if(cts_length == 1 && ite=='すべて'){

                        }else{
                           out += '<option value="'+key+'">'+ite+'</option>'; 
                       }                        
                    });                
                    $cities.html(out);
                    return true;
                }
                var findCity = function(prv){
                    if(isNull(prv) || typeof p2c[prv] === 'undefined'){ return [];}
                    var s_prv = false;
                    p2c.forEach(function(ite){
                        if(ite.id == prv){
                            s_prv = ite;
                            return;
                        }
                    });
                    if(!s_prv || typeof s_prv['children'] !== 'object'){ return [];}
                    return s_prv['children'];

                }
                var init_mod = function(){
                   $.ajax({
                        url: sets.source_url,
                        type: 'GET'
                    })
                    .done(function(res) {
                        if(!res){ return false;}
                        if(typeof res !== 'object'){ res = JSON.parse(res);}
                        p2c = res;
                        initProvince();
                        listend();
                        $cities.removeAttr('disabled');
                        $element.removeAttr('disabled');
                        return true;                
                    })
                    .fail(function(error) {
                        console.log(error);
                    })
                    .always(function() {
                    });                                    
                }
                var initProvince = function(){
                    var opts = '<option></option>';
                    $.each(p2c,function(key,ite){
                        if(ite.ite_name != '全国'){
                            opts += '<option value="'+ite.id+'">'+ite.ite_name+'</option>';                            
                        }
                    });
                    $element.html(opts);
                    var element_val = $element.attr('value');
                    if(isNull(element_val)){return false;}
                    applyValue($element,element_val);   
                    var cts = findCity(element_val);
                    changeCity(cts);
                    element_val = $cities.attr('value'); 
                    if(isNull(element_val)){return false;}                  
                    applyValue($cities,element_val);                                 
                    return true;
                }
                var applyValue = function($ele,vl){
                    var $opt = $ele.children('option[value="'+vl+'"]');
                    if($opt.length == 0){ return false;}
                    $opt.attr('selected','selected');
                    return true;
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
    $.fn.olSelectProvinceMinitry.defaults = {
            children : '',
            source_url :'/admin/resource/minitry-povince'    
    } 
    $.fn.olSelectMinitry = function(opts){
        var sets = $.extend({},$.fn.olSelectMinitry.defaults,opts);
        return this.each(function(){
            var $element = $(this);
            var mod = (function(){
                var exp = {};
                var p2c,default_city={0:''};
                var $cities;
                exp.init = function(){
                    var dt_children = $element.data('children');
                    if(isNull(dt_children)){ return false;}
                    $cities = $(dt_children);
                    if($cities.length == 0){ return false;} 
                    init_mod(window.__province);                                                   
                }
                var listend = function(){
                    $element.on('change',changeProvince);
                }
                var changeProvince = function(){
                    var prv = $(this).children('option:selected').val();
                    var cts = findCity(prv);
                    changeCity(cts);
                    return true;
                }
                var changeCity = function(cts){
                    var out = '';
                    $.each(cts,function(key,ite){
                        out += '<option value="'+key+'">'+ite+'</option>';
                    });                
                    $cities.html(out);
                    return true;
                }
                var findCity = function(prv){
                    if(isNull(prv) || typeof p2c[prv] === 'undefined'){ return [];}
                    var s_prv = false;
                    p2c.forEach(function(ite){
                        if(ite.id == prv){
                            s_prv = ite;
                            return;
                        }
                    });
                    if(!s_prv || typeof s_prv['children'] !== 'object'){ return [];}
                    return s_prv['children'];

                }
                var init_mod = function(res){
                        p2c = res;
                        initProvince();
                        listend();
                        $cities.removeAttr('disabled');
                        $element.removeAttr('disabled');                
                }
                var initProvince = function(){
                    var opts = '<option></option>';
                    $.each(p2c,function(key,ite){
                        opts += '<option value="'+ite.id+'">'+ite.ite_name+'</option>';
                    });
                    $element.html(opts);
                    var element_val = $element.attr('value');
                    if(isNull(element_val)){return false;}
                    applyValue($element,element_val);   
                    var cts = findCity(element_val);
                    console.log(cts);
                    changeCity(cts);
                    element_val = $cities.attr('value'); 
                    if(isNull(element_val)){return false;}                  
                    applyValue($cities,element_val);                                 
                    return true;
                }
                var applyValue = function($ele,vl){
                    var $opt = $ele.children('option[value="'+vl+'"]');
                    if($opt.length == 0){ return false;}
                    $opt.attr('selected','selected');
                    return true;
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
    $.fn.olSelectMinitry.defaults = {
            children : '',
            source_url :'/admin/resource/minitry'    
    } 

    $.fn.olSelectCity = function(opts){
        var sets = $.extend({},$.fn.olSelectCity.defaults,opts);
        return this.each(function(){
            var $element = $(this);
            var mod = (function(){
                var exp = {};
                var p2c;
                var $cities;
                exp.init = function(){
                    $cities = $('#address_city');
                    if($cities.length == 0){ return false;}            
                    initData();          
                }
                var listend = function(){
        			$element.on('change',changeProvince);
                }
                var changeProvince = function(){
                	var prv = $(this).children('option:selected').val();
                	var cts = findCity(prv);
                	changeCity(cts);
                	return true;
                }
                var changeCity = function(cts){
                	var out = '<option value="">すべて</option>';
                	cts.forEach(function(ite){
                		if(ite != 'すべて' ){
                			out += '<option value="'+ite+'">'+ite+'</option>';
                		}       		
                	});
                	$cities.html(out);
                	return true;
                }
                var findCity = function(prv){
                	if(isNull(prv) || typeof p2c[prv] === 'undefined'){ return [];}
                	return p2c[prv];

                }
                var initData = function(){
                    $cities.attr({disabled:'disabled'});
                    $element.attr({disabled:'disabled'});
                    $.ajax({
                        url: '/admin/resource/address',
                        type: 'GET',
                    })
                    .done(function(res) {
                        if(!res){ return false;}
                        if(typeof res !== 'object'){ res = JSON.parse(res);}
                        p2c = res;
                        initProvince();
                        listend();
                        $cities.removeAttr('disabled');
                        $element.removeAttr('disabled');
                        return true;                
                    })
                    .fail(function(error) {
                        console.log(error);
                    })
                    .always(function() {
                    });
                    
                }
                var initProvince = function(){
                	var opts = '<option value="">すべて</option>';
                	$.each(p2c,function(key,ite){
                		opts += '<option value="'+key+'">'+key+'</option>';
                	});
                	$element.html(opts);
                    var element_val = $element.attr('value');
                    if(isNull(element_val)){return false;}
                    applyValue($element,element_val);   
                    var cts = findCity(element_val);
                    changeCity(cts);
                    element_val = $cities.attr('value'); 
                    if(isNull(element_val)){return false;}   
                    applyValue($cities,element_val);                 
                	return true;
                }
                var applyValue = function($ele,vl){
                    var $opt = $ele.children('option[value="'+vl+'"]');
                    if($opt.length == 0){ return false;}
                    $opt.attr('selected','selected');
                    return true;
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
    $.fn.olSelectCity.defaults = {
    } 

})(jQuery);
//upload
(function($){
    $(function(){
        $('.olSingleImage').olImageUpload({
            url_upload : '/admin/ajax/upload-image',
            img_url : ''
        });
        $('.olSinglePdf').olPdfUpload({
            url_upload : '/admin/ajax/upload-pdf',
            img_url : ''
        });
        $('.olMultiPdf').olPdfUploadMulti({
            url_upload : '/admin/ajax/upload-pdf',
            img_url : ''
        });
        

    }); 
    $.fn.olPdfUploadMulti = function(opts){
         var sets = $.extend({},$.fn.olPdfUploadMulti.defaults,opts);
         return this.each(function(){
             var $element = $(this);
             var mod = (function(){
                 var exp = {};
                 var $results,$ip_file,$form;
                 var file_name,ip_name,children_count;
                 var tk_name='_token',tk_value;
                 exp.init = function(){
                    $form = $element.closest('form');
                    $results = $element.find('.results'); 
                    $ip_file = $element.find('input[type="file"]'); 
                    file_name = $ip_file.attr('name');
                    ip_name = $element.data('name');
                    children_count = $results.children().length;
                    tk_value = $form.find('input[name="'+tk_name+'"]:first').val();

                    listend();
                 }
                 var listend = function(){
                    $ip_file.on('change',handleSelect);
                    $element.on('click','.upl-del',handleDelete);
                 }
                 var handleDelete = function(ev){
                    ev.preventDefault();
                    $(this).closest('.input-group').remove();
                    return true;
                 }
                 var handleSelect = function(ev){
                    ev.preventDefault();
                    var item,id;
                    var $ele = $(this);
                    var fd = new FormData($form[0]);
                    var file_val = fd.getAll(file_name);
                    if(file_val === null || file_val.length == 0 ){
                        return;
                    }   
                    file_val.forEach(function(item,id){
                        children_count += 1;
                        id = children_count;
                        new_ite = gen_pending_item(id,item);
                        $results.append(new_ite);
                        upload_item(id,item);
                    }); 
                    $ip_file.val('');                                    
                    return true;
                 }
                var upload_item = function(id,file){
                    var fd = new FormData();
                    fd.append(sets.file_name_upload,file);
                    if(sets.token){
                        fd.append('_token',tk_value);
                    }                   
                    $.ajax({
                      url: sets.url_upload,
                      type: "POST",
                      data: fd,
                      processData: false,  // tell jQuery not to process the data
                      contentType: false,   // tell jQuery not to set contentType
                      error : function(err){
                        console.log(err);
                      },
                      success : function(res){
                        if(typeof res !== 'object'){ res = JSON.parse(res);}
                        if(res.error==1){
                            return false;
                        }
                        display_result_multi(id,res.data);  
                        return true;                                             
                      }

                    }); 
                }  
                var display_result_multi = function(id,data){
                    var $ele = $results.children('#olpdf-item-'+id);
                    if($ele.length == 0){return false;}
                    $ele.find('.upl-name').val(data.name);
                    $ele.find('.upl-sv').val(data.path);
                    return true;
                }                               
                var gen_pending_item = function(id,ite){    
                    var name = ip_name + '['+id+']';                
                    var out = '';
                        out += '<div class="input-group" id="olpdf-item-'+id+'">';
                        out += '<input type="text" name="'+name+'[name]" class="form-control upl-name" value="" readonly/>';
                        out += '<input type="hidden" name="'+name+'[url]" class="form-control upl-sv" value=""/>';
                        out += '<div class="input-group-btn">';
                        out += '<button type="button" class="submit-delete-button upl-del"></button>';
                        out += '</div>                                                ';
                        out += '</div>';                
                    return out;
                } 

                 return exp;
             })();
             return mod.init();
         });
     }
     $.fn.olPdfUploadMulti.defaults = {
        file_name_upload : 'sgl_pdf'
     }                 
    $.fn.olPdfUpload = function(opts){
        var sets = $.extend({},$.fn.olPdfUpload.defaults,opts);
        return this.each(function(){
            var $element = $(this);
            var mod = (function(){
                var moduleOut={};
                var $ip_sv,$ip_name,$bt_prv,$ip_file,$form,$modal;
                var tk_name='_token',tk_value,fl_name;
                moduleOut.init = function(){
                    $ip_sv = $element.find('.upl-sv:first');
                    $ip_name = $element.find('.upl-name:first');
                    $ip_file = $element.find('.upl-file:first');
                    $form = $element.closest('form');
                    //              
                    fl_name = $ip_file.attr('name');
                    tk_value = $form.find('input[name="'+tk_name+'"]:first').val();
                    //
                    listend();
                } 
                var listend = function(){
                    $ip_file.on('change',handleChange);
                    $element.on('click','.upl-del',handleRemove);
                }
                var handleRemove = function(ev){
                    ev.preventDefault();
                    removeElement();
                    return true;
                }
                var removeElement = function(){
                    $ip_sv.val('');
                    $ip_name.val('');
                    return true;
                }
                var handleChange = function(ev){
                    ev.preventDefault();
                    var frm_dt = new FormData($form[0]);
                    var fl_data = frm_dt.getAll(fl_name);
                    if(fl_data === null || fl_data.length == 0 ){ return false;}
                    postData(fl_data[0]);
                    return true;
                }
                var postData = function(fl_data){
                    handleBeforeRequest();
                    var fd = getParamRequest(fl_data);
                    $.ajax({
                        url: sets.url_upload,
                        type: 'POST',
                        processData: false,  
                        contentType: false,                     
                        data: fd,
                    })
                    .done(function(res) {
                        if(typeof res !== 'object'){ res = JSON.parse(res);}
                        if(res.error){ 
                            alert(res.message);
                            return false;
                        }
                        handleSuccessRequest(res.data);
                        return true;
                    })
                    .fail(function() {
                        console.log("error");
                    })
                    .always(function() {
                        handleAfterRequest();
                    });
                    
                }
                var handleBeforeRequest=function(){
                    $element.addClass('pending');
                    return true;
                }
                var handleAfterRequest=function(){
                    $ip_file.val('');
                    $element.removeClass('pending');
                    return true;
                }
                var handleSuccessRequest = function(dt){
                    updateInput(dt);
                    return true;
                }
                var updateInput = function(dt){
                    var value = dt.path;
                    $ip_sv.val(value);
                    $ip_name.val(dt['name']);
                    return true;
                }
                var getLink = function(url){
                    return sets.img_url + url;
                }
                var getParamRequest = function(fl_data){
                    var out = new FormData();
                    out.append(sets.f_name,fl_data);
                    out.append(tk_name,tk_value);
                    return out;
                }
                var isNull = function(dt){
                    if(typeof dt === 'undefined' || dt === null || dt.trim()== ''){
                        return true;
                    }
                    return false;
                }            
                return moduleOut;            
            })();
            return mod.init();
        });
    }
    $.fn.olPdfUpload.defaults = {
        url_upload : '',
        f_name : 'sgl_pdf',
        img_url : ''
    };             
    $.fn.olImageUpload = function(opts){
        var sets = $.extend({},$.fn.olImageUpload.defaults,opts);
        return this.each(function(){
            var $element = $(this);
            var mod = (function(){
                var moduleOut={};
                var $ip_sv,$bt_prv,$ip_file,$form,$modal;
                var tk_name='_token',tk_value,fl_name;
                moduleOut.init = function(){
                    $ip_sv = $element.find('.upl-sv:first');
                    $ip_file = $element.find('.upl-file:first');
                    $bt_prv = $element.find('.upl-prv:first');
                    $form = $element.closest('form');
                    $modal = $element.find('.modal:first');
                    $modal_bd = $modal.find('.modal-body:first');
                    //              
                    fl_name = $ip_file.attr('name');
                    tk_value = $form.find('input[name="'+tk_name+'"]:first').val();
                    //
                    listend();
                } 
                var listend = function(){
                    $ip_file.on('change',handleChange);
                    $element.on('click','.upl-del',handleRemove);
                    $bt_prv.on('click',handlePreview);
                }
                var handlePreview = function(ev){
                    ev.preventDefault();
                    var img = $ip_sv.val();
                    if(isNull(img)){alert('no image!');return false;}
                    var img_html = '<img src="/'+img+'" class="img-ct">';
                    $modal_bd.html(img_html);
                    $modal.modal('show');
                    return true;
                }
                var handleRemove = function(ev){
                    ev.preventDefault();
                    removeElement();
                    return true;
                }
                var removeElement = function(){
                    $ip_sv.val('');
                    $bl_rs.empty();
                    return true;
                }
                var handleChange = function(ev){
                    ev.preventDefault();
                    var frm_dt = new FormData($form[0]);
                    var fl_data = frm_dt.getAll(fl_name);
                    if(fl_data === null || fl_data.length == 0 ){ return false;}
                    postData(fl_data[0]);
                    return true;
                }
                var postData = function(fl_data){
                    handleBeforeRequest();
                    var fd = getParamRequest(fl_data);
                    $.ajax({
                        url: sets.url_upload,
                        type: 'POST',
                        processData: false,  
                        contentType: false,                     
                        data: fd,
                    })
                    .done(function(res) {
                        if(typeof res !== 'object'){ res = JSON.parse(res);}
                        if(res.error){ return false;}
                        handleSuccessRequest(res);
                        return true;
                    })
                    .fail(function() {
                        console.log("error");
                    })
                    .always(function() {
                        handleAfterRequest();
                    });
                    
                }
                var handleBeforeRequest=function(){
                    $element.addClass('pending');
                    return true;
                }
                var handleAfterRequest=function(){
                    $ip_file.val('');
                    $element.removeClass('pending');
                    return true;
                }
                var handleSuccessRequest = function(dt){
                    updateInput(dt);
                    return true;
                }
                var updateInput = function(dt){
                    var value = dt.path;
                    $ip_sv.val(value);
                    return true;
                }
                var getLink = function(url){
                    return sets.img_url + url;
                }
                var getParamRequest = function(fl_data){
                    var out = new FormData();
                    out.append(sets.f_name,fl_data);
                    out.append(tk_name,tk_value);
                    return out;
                }
                var isNull = function(dt){
                    if(typeof dt === 'undefined' || dt === null || dt.trim()== ''){
                        return true;
                    }
                    return false;
                }            
                return moduleOut;            
            })();
            return mod.init();
        });
    }
    $.fn.olImageUpload.defaults = {
        url_upload : '',
        f_name : 'sgl_image',
        img_url : '',
        img_size : 'thumbnail'
    };                          
})(jQuery);
(function($) {
  $(function(){
    $('.olScrollTop').topScrollbar();
    $('.olRowlink').olRowlink();
  });  
    $.fn.olRowlink = function(opts){
        var sets = $.extend({},$.fn.olRowlink.defaults,opts);
        return this.each(function(){
            var $element = $(this);
            var mod = (function(){
                var exp = {};
                exp.init = function(){
                    
                    listend();
                }
                var listend = function(){
                    $element.on('click','td',handleClick);
                }
                var handleClick = function(ev){
                    console.log('link row');
                    var $ele = $(this);
                    if($ele.hasClass('nolink')){ return true;}
                    ev.preventDefault();
                    var $tr = $ele.parent();
                    var link = $tr.data('link');
                    console.log(link);
                    if(isNull(link)){ return false;}
                    window.location.href = link;
                    return true;
                }
                var isNull  = function(dt){
                    if(typeof dt === 'undefined' || dt===null ||dt==''){
                        return true;
                    }
                    return false;
                }
                return exp;
            })();
            return mod.init();
        });
    }
    $.fn.olRowlink.defaults = {
    }            
  $.fn.topScrollbar = function(activate) {
    if (activate == undefined) activate = true;

    return this.each(function() {
      var self = $(this);

      if (self.prev().hasClass('jquery-top-scrollbar')) self.prev().remove();

      if (!activate) return;

      var tmp = self.clone().css({
        'position': 'fixed',
        'width': 'auto',
        'visibility': 'hidden',
        'overflow-y': 'auto'
      });

      tmp.appendTo('body');

      var innerWidth = tmp.width();

      tmp.remove();

      if (self.width() >= innerWidth) return;

      var outer = $('<div class="jquery-top-scrollbar">');
      outer.css({width: self.width(), height: 15, 'overflow-y': 'hidden'});

      var inner = $('<div>');
      inner.css({width: innerWidth, height: 15});

      self.before(outer.append(inner));

      outer.scroll(function() {
        self.scrollLeft(outer.scrollLeft());
      });

      self.scroll(function() {
        outer.scrollLeft(self.scrollLeft());
      });

      self.scroll();
    });
  };
})(jQuery);
