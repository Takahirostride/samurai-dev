(function($){
$(function(){
    var csrf_token = $('meta[name="csrf-token"]').attr('content');
    $('.modalShow').modal({show:true});
    $('[data-toggle="tooltip"]').tooltip();
    //
	$('.goBack').on('click',function(ev){
		ev.preventDefault();
		window.history.back();
		return true;
	});    
    $('.olBtnDel').on('click',function(ev){
        ev.preventDefault();
        var $ele = $(this);
        document.body.style.cursor = "wait";
        $.ajax({
            url: $ele.attr('href'),
            type: 'POST',
            data: {
                _method: 'delete',
                _token : csrf_token
            },
        })
        .done(function(res) {
            if(res != 1){ alert('Error!');return false;}
            window.location.href=$ele.data('refesh');
            return true;
        })
        .fail(function() {
        })
        .always(function() {
            document.body.style.cursor = 'default';
        });
        
        return true;
    });
    $('.olshow-file').olShowFile();
    $('.olSingleImage').olImageUpload({
        url_upload : '/asp/ajax/upload-image',
        img_url : ''
    });	
    var $address_mintry = $('.select_minitry');
    if($address_mintry.length > 0){
       $.ajax({
            url: '/asp/resource/address',
            type: 'GET',
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
    $('#sidebar-filter').olaspFilter();
    $('.olFavorite').olFavorite({
        url:'/asp/client/favorite'
    });
    $('.companyFavorite').olFavorite({
        url : '/asp/manage-clients/store-favorite'
    });
    $('.olFavoriteSub').olFavorite({
        url : '/asp/policy/favorite'
    });
    $('.olFavoriteHire').olFavorite({
        url : '/asp/status-client/hire/favorite'
    });

    $('.tog-but').ol_tog_block();    
    $('#lst-hires').ol_collap_block();    
    $('.olCheckAll').olCheckAll(); 
    $('.olFormUpload').olFormUpload();   
    $('.olfrView').olFormReadonly();
    $('.olNumber').olNumberDec();   
    $('.tbrow-link').tableLink();   
}); 
$.fn.tableLink = function(opts){
    var sets = $.extend({},$.fn.tableLink.defaults,opts);
    return this.each(function(){
        var $element = $(this);
        var mod = (function(){
            var exp = {};
            exp.init = function(){
                listend();
            }
            var listend = function(){
                $element.on('click','.row-link',handleRowClick);
            }
            var handleRowClick = function(ev){
                var $ele = $(this);
                var link = $ele.data('link');
                if(typeof link === 'undefined' || link === null || link == ''){
                    return true;
                }
                var $target = $(ev.target);
                if($target.hasClass('noLink')){
                    return true;
                }
                var $no_link = $target.closest('.noLink');
                if($no_link.length > 0){
                    return true;
                }
                window.location.href = link;
                return true;
            }
            return exp;
        })();
        return mod.init();
    });
}
$.fn.tableLink.defaults = {
    radio : false
}
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
$.fn.olFormUpload = function(opts){
    var sets = $.extend({},$.fn.olFormUpload.defaults,opts);
        return this.each(function(){
        var $element = $(this);     
        var mod = (function(){
            var exp = {};
            var $ip_file;
            exp.init = function(){
                $ip_file = $element.find('input[type="file"]');
                listend();
            }
            var listend = function(){
                $ip_file.on('change',handleChange);
            }
            var handleChange = function(ev){
                var vl_file = $ip_file.val();
                if(isNull(vl_file)){ return false;}
                $element.trigger('submit');
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
$.fn.olFormUpload.defaults = {
}
$.fn.olCheckAll = function(opts){
    var sets = $.extend({},$.fn.olCheckAll.defaults,opts);
        return this.each(function(){
        var $element = $(this);     
        var mod = (function(){
            var exp = {};
            var cb_name,$cboxs,data_check;
            exp.init = function(){
                var $form;
                cb_name = $element.data('name');
                var cb_form = $element.data('form');
                if(isNull(cb_name)){ return false;}
                if(!isNull(cb_form)){
                    $form = $(cb_form);
                }else{
                    $form = $element.closest('form');
                }
                $cboxs = $form.find('input[name="'+cb_name+'"]');
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
$.fn.ol_collap_block = function(opts){
    var sets = $.extend({},$.fn.ol_collap_block.defaults,opts);
    return this.each(function(){
        var $element = $(this);
        var mod = (function(){
            var m_out = {};
            var $bl_collap;
            m_out.init = function(){
                $bl_collap = $element.find('.olCollap');
                listend();
            }
            var listend = function(){
                $element.on('click','.bt-collap',tog_block);
                return true;
            }
            var tog_block = function(ev){
                ev.preventDefault();  
                var $ele = $(this).closest('.olCollap'); 
                if($ele.length == 0){
                    return false;
                }
                if($ele.hasClass('active')){
                    $ele.removeClass('active');
                    return true;
                }
                disableActive();
                display_block($ele);
                return true;
            }
            var disableActive = function(){
                var $act_bl = $bl_collap.filter('.active');
                if($act_bl.length > 0){
                    $act_bl.removeClass('active');
                }
                return true;
            }
            var display_block = function($ele){
                $ele.addClass('active');                       
                return true;                   
            }
            return m_out;
        })();
        return mod.init();
    });
}
$.fn.ol_collap_block.defaults = {
    slide : true
};
$.fn.ol_tog_block = function(opts){
    var sets = $.extend({},$.fn.ol_tog_block.defaults,opts);
    return this.each(function(){
        var $element = $(this);
        var mod = (function(){
            var m_out = {};
            var cr_block,$cr_block;
            m_out.init = function(){
                listend();
            }
            var listend = function(){
                if(sets.input){
                    $element.on('change',tog_block_cbox);
                }else{
                    $element.on('click',tog_block);
                }
                return true;
            }
            var tog_block_cbox = function(ev){
                display_block($(this));
            }
            var tog_block = function(ev){
                ev.preventDefault();
                display_block($(this));
                return true;
            }
            var display_block = function($ele){
                cr_block = $ele.attr('data-block');
                if(!cr_block){ return false;}
                $cr_block = $(cr_block);
                if($cr_block.length == 0){ return false;}
                $ele.toggleClass('active');
                if(sets.slide){
                    $cr_block.slideToggle();
                }
                $cr_block.toggleClass('active');                     
            }
            return m_out;
        })();
        return mod.init();
    });
}
$.fn.ol_tog_block.defaults = {
    slide : true,
    input : false,
};
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
                    var val_ite;
                    $.each(cts,function(key,ite){
                        val_ite = ite == 'すべて' ? 0 : key;
                        out += '<option value="'+val_ite+'">'+ite+'</option>';
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
                    var opts = '<option value="">選択してください</option>';
                    $.each(p2c,function(key,ite){
                        if(ite.ite_name != '全国'){
                            opts += '<option value="'+ite.id+'">'+ite.ite_name+'</option>';                            
                        }
                    });
                    $element.html(opts);
                    $cities.html('<option value="">選択してください</option>');
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
    $.fn.olSelectMinitry.defaults = {
            children : '',
            source_url :'/admin/resource/minitry'    
    }   
$.fn.olViewClient = function(opts){
    var sets = $.extend({},$.fn.olViewClient.defaults,opts);
    return this.each(function(){
        var $element = $(this);
        var mod = (function(){
            var moduleOut={},token;
            moduleOut.init = function(){
                token = $('meta[name="csrf-token"]').attr('content');
                listend();
            } 
            var listend = function(){
                $element.on('click',handleClick);
            }
            var handleClick = function(ev){
                ev.preventDefault();
                var client_id = $element.data('id');
                if(isNull(client_id)){ return false;}
                $.ajax({
                    url: sets.url,
                    type: 'POST',
                    data: {
                        _token : token,
                        client_id:client_id
                    },
                })
                .done(function() {
                })
                .fail(function() {
                })
                .always(function() {
                    window.location.href=$element.attr('href');
                });                
                return true;
            }
            var isNull = function(dt){
                if(typeof dt === 'undefined' || dt === null || dt== ''){
                    return true;
                }
                return false;
            }            
            return moduleOut;            
        })();
        return mod.init();
    });
}
$.fn.olViewClient.defaults = {
    url : '/asp/client/view-count'
};            
$.fn.olFavorite = function(opts){
    var sets = $.extend({},$.fn.olFavorite.defaults,opts);
    return this.each(function(){
        var $element = $(this);
        var mod = (function(){
            var moduleOut={};
            var data_id,status,token;
            moduleOut.init = function(){
                token = $('meta[name="csrf-token"]').attr('content');
                listend();
            } 
            var listend = function(){
                $element.on('click',handleClick);
            }
            var handleClick = function(ev){
                ev.preventDefault();
                data_id = $element.data('id');
                status = $element.data('status');
                if(isNull(data_id)||isNull(status)){
                    alert('Error!'); return false;                    
                }
                requestData();
                return true;
            }   
            var requestData = function(){
                document.body.style.cursor = "wait";
                $.ajax({
                    url: sets.url,
                    type: 'POST',
                    data: {
                        _token : token,
                        data_id: data_id,
                        status: status,
                    },
                })
                .done(function(res) {
                    if(typeof res !== 'object'){res=JSON.parse(res);}
                    if(res.error){
                        alert(res.message);
                        return false;
                    }
                    handleSuccess();
                })
                .fail(function() {
                    console.log("error");
                })
                .always(function() {
                    document.body.style.cursor = "default";
                });
                
            } 
            var handleSuccess = function(){
                var nw_status = (status == 0) ? 1 : 0;
                $element.data('status',nw_status);
                if(nw_status == 0){
                    $element.html('<span class="fas fa-star"></span>');
                }else{
                    $element.html('<span class="far fa-star"></span>');
                }
                if($element.hasClass('bt-fav-text')){
                    $element.append('<span>お気に入り</span>');
                }
                return true;
            }  
            var isNull = function(dt){
                if(typeof dt === 'undefined' || dt === null){
                    return true;
                }
                return false;
            }                  
            return moduleOut;            
        })();
        return mod.init();
    });
}
$.fn.olFavorite.defaults = {
    url : '/asp/client/favorite'
};            
$.fn.olaspFilter = function(opts){
    var sets = $.extend({},$.fn.olaspFilter.defaults,opts);
    return this.each(function(){
        var $element = $(this);
        var mod = (function(){
            var exp = {};
            var $trades,$provinces,$cats;
            exp.init = function(){
                $trades = $element.find('#fl-trades a');
                $provinces = $element.find('select[name="provinces"]');
                $cats = $element.find('select[name="categories"]');
                listend();
            }
            var listend = function(){
                $trades.on('click',handleTrade);
                $provinces.on('change',handleSubmit);
                $cats.on('change',handleSubmit);
            }
            var handleTrade = function(ev){
                ev.preventDefault();
                $trades.removeClass('selected');
                $(this).addClass('selected');
                handleSubmit();
                return true;
            }
            var handleSubmit = function(){
                var $trade_sl = $trades.filter('.selected:first');
                var trade_dt='';
                if($trade_sl.length > 0){
                    trade_dt = $trade_sl.data('id');
                }
                var prv_dt = $provinces.find('option:selected').val();
                var cat_dt = $cats.find('option:selected').val();
                var qr_st = 'trade='+trade_dt+'&province='+prv_dt+'&cat='+cat_dt;
                window.location.href=$element.attr('action')+'?'+qr_st;
                return true;
            }
            return exp;
        })();
        return mod.init();
    });
}
$.fn.olaspFilter.defaults = {
}
$.fn.olShowFile = function(opts){
    var sets = $.extend({},$.fn.olShowFile.defaults,opts);
    return this.each(function(){
        var $element = $(this);
        var mod = (function(){
            var exp = {};
            exp.init = function(){
                var url = $element.data('url');
                if(typeof url === 'undefined' || url === null || url==''){
                    return false;
                }     
                console.log('init load file');           
                $element.load(url);
                listend();
            }
            var listend = function(){

            }
            return exp;
        })();
        return mod.init();
    });
}
$.fn.olShowFile.defaults = {
}            
$.fn.olImageUpload = function(opts){
    var sets = $.extend({},$.fn.olImageUpload.defaults,opts);
    return this.each(function(){
        var $element = $(this);
        var mod = (function(){
            var moduleOut={};
            var $ip_sv,$ip_file,$form,$imp_prv;
            var tk_name='_token',tk_value,fl_name;
            moduleOut.init = function(){
                $ip_sv = $element.find('.upl-sv:first');
                $ip_file = $element.find('.upl-file:first');
                $img_prv = $element.find('.img-prv:first');
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
            	updateImage(dt);
                updateInput(dt);
                return true;
            }
            var updateInput = function(dt){
                var value = dt.path;
                $ip_sv.val(value);
                return true;
            }
            var updateImage = function(dt){
            	$img_prv.attr('src','/'+dt.path);
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
})(jQuery)