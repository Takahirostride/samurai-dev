@php
        $categories = App\Modules\Admin\Models\Category::listCatSub();
@endphp
<script>   
var categories = {!! json_encode($categories) !!} ;
(function($){
    $(function(){    
    var $element_error = false;
    function check_extra_validator($element,valid){
        var error = false; 
        $element_error = false;   
        var display_error = function($el){
            $element_error = $el.siblings('.with-errors:first');
            $element_error.text('※は入力必須項目');
        }
        var display_error_cus = function($el, text){
            $element_error = $el.siblings('.with-errors:first');
            $element_error.text(text);
        }
        var remove_error = function($el){
            $el.siblings('.with-errors').text('');
        } 
        // //valid-year
        // var $year_start = $('#founding_year_start');   
        // remove_error($('#founding_year_start'));
        // if($year_start.val()>0) {
        //     if($year_start.val()<1890 ||$year_start.val()>9999){
        //         error = true;
        //         display_error_cus($('#founding_year_start'));
        //     }
        // }    
        //valid-category
        var $sub_cat = $('#cat_sel').find('.ol_item'); 
        remove_error($('#cat_sel'));
        if($sub_cat.length > 0){
            $sub_cat.each(function(){
                var $el = $(this);
                var el_i = 0;
                var cat_null = false;
                var $el_cat = $el.find('input[type="checkbox"]');
                var $ite_cat;
                while(el_i < $el_cat.length){
                    $ite_cat = $($el_cat[el_i]);
                    if($ite_cat.is(':checked')){
                        cat_null = true;
                        el_i += $el_cat.length;
                    }
                    el_i++;
                }
                if(!cat_null){
                    error = true;
                }
            });
            if(error){
                display_error($('#cat_sel'));
            }
        }else{
            error = true;
            display_error($('#cat_sel'));
        }
        //valid-region
        var $region_block = $element.find('#region_sel');
        var $region_item = $region_block.find('.ol_item');
        if($region_item.length == 0){
            error = true;
            display_error($region_block);
        }
        //valid-update_date
        var $update_date_block = $element.find('#update_date_block');
        var $update_date_option = $element.find('input[name="subscript_duration_option"]');
        var $update_date_input = $update_date_block.find('input');
        var update_error = false;
        if(!$update_date_option.is(':checked')){
            $update_date_input.each(function(){
                var $ele = $(this);
                var ele_val = $ele.val();
                if(ele_val === null || ele_val == ''){
                    update_error = true;
                }
            });            
        }
        if(update_error){ 
            error = true;
            display_error($update_date_block);
        }
        //valid-trades
            var $trades = $element.find('input[name="trades[]"]');
            var $trade_block = $element.find('#checkbox-trade');
            remove_error($trade_block);
            if($trades.length > 0){
                var i = 0;
                var trade_null = false;
                var $ite;    
                while(i<$trades.length){
                    $ite = $($trades[i]);
                    if($ite.is(':checked')){
                        trade_null = true;
                        i += $trades.length;
                    }
                    i++;
                }
                if(!trade_null){
                    error = true;
                    display_error($trade_block);
                }
            } 
        //valid-budget
            /*var $budgets = $element.find('input[name="acquire_budget[]"]');
            var $budget_block = $element.find('#input-acquire-budget');
            remove_error($budget_block);
            if($budgets.length > 0){
                var i = 0;
                var budget_null = false;
                var $ite;    
                while(i<$budgets.length){
                    $ite = $($budgets[i]);
                    if($ite.is(':checked')){
                        budget_null = true;
                        i += $budgets.length;
                    }
                    i++;
                }
                if(!budget_null){
                    error = true;
                    display_error($budget_block);
                }
            } */

        //valid-inputs
        var $inputs = $element.find('input[name="image_id"]');               
        remove_error($inputs);
        if($inputs.length > 0){
            $inputs.each(function(){
                var $el = $(this);
                var el_val = $el.val();
                if(typeof el_val==='undefined' || el_val===null || el_val ==''){
                     error = true;
                     display_error($el.parent());   
                }
            });
        }
        return error;
    }
    function applyDataValidate($block,$form){
        function isNull(dt){
            if(typeof dt === 'undefined' || dt === null || dt==''){
                return true;
            }
            return false;
        } 
        //var $form = $(form_id);       
        var $inputs = $block.find('.oldata');
        $inputs.each(function(){
            var $ele= $(this);
            var dt_text = $ele.data('text');
            var dt_area = $ele.data('area');
            var dt_select = $ele.data('select');
            var dt_tiny = $ele.data('tiny');
            var dt_multi_select = $ele.data('multiselect');
            var dt_multi_checkbox = $ele.data('multicbox');
            var dt_date = $ele.data('date');
            var dt_checkbox = $ele.data('checkbox');
            var dt_pdf = $ele.data('pdf');
            var $value;
            if(!isNull(dt_text)){
                $value = $form.find('input[name="'+dt_text+'"]');
                $ele.text($value.val());
            }else if(!isNull(dt_area)){
                $value = $form.find('textarea[name="'+dt_area+'"]');
                $ele.text($value.val());
            }else if(!isNull(dt_multi_checkbox)){
                $value = $form.find('input[name="'+dt_multi_checkbox+'[]"]');
                var out = '<ul class="lst-inl lst-'+dt_multi_checkbox+'">';
                $value.each(function(){
                    var $ite = $(this);
                    if($ite.is(':checked')){
                        var value1 = $ite.siblings('span').text();
                        out += '<li><span>'+value1+'</span></li>';
                    }

                });
                out += '</ul>';
                $ele.html(out);
            }else if(!isNull(dt_select)){
                $value = $form.find('select[name="'+dt_select+'"]');
                var sl_value = $value.find('option:selected').text();
                $ele.text(sl_value);
            }else if(!isNull(dt_date)){
                var $year = $form.find('input[name="'+dt_date+'[year]"]');
                var $month = $form.find('input[name="'+dt_date+'[month]"]');
                var $day = $form.find('input[name="'+dt_date+'[day]"]');
                var d_value = $year.val()+'-'+$month.val()+'-'+$day.val();
                $ele.text(d_value);
            }else if(!isNull(dt_tiny)){
                var t_value = tinyMCE.get('tiny_'+dt_tiny).getContent();
                $ele.html(t_value);
            }else if(!isNull(dt_multi_select)){
                var $dms_element = $form.find(dt_multi_select);
                var $dms_item = $dms_element.find('.ol_item');
                var dms_out = [];
                $dms_item.each(function(){
                    var $dms_item_1 = $(this);
                    var dms_item_val = $dms_item_1.find('.name-province').text()+' '+$dms_item_1.find('.name-city').text();
                    dms_out.push(dms_item_val);
                });
                $ele.html(dms_out.join(','));
            }else if(!isNull(dt_checkbox)){
                $value = $form.find('input[name="'+dt_checkbox+'"]');
                if($value.is(':checked')){
                    $ele.css({display:'inline-block'});
                }else{
                    $ele.css({display:'none'});
                }
            }else if(!isNull(dt_pdf)){
                var $bl_pdf = $form.find(dt_pdf);
                console.log($bl_pdf);
                var $pdf_input = $bl_pdf.find('.input-group');
                var pdf_out = '';
                $pdf_input.each(function(){
                    var $pdf_item = $(this);
                    var pdf_link = $pdf_item.find('.upl-sv').val();
                    pdf_link = (pdf_link.indexOf('http') >= 0) ? pdf_link : '/'+pdf_link;
                    pdf_out += '<p><a href="'+pdf_link+'" download>'+$pdf_item.find('.upl-name').val()+'</a></p>';
                });
                $ele.html(pdf_out);
            }
            return true;
        });
    }
    var $fr_validator_add = $('#fr-add-policy');
    if($fr_validator_add.length > 0){
        $fr_validator_add.validator({});
        var $fr_blstep1 = $fr_validator_add.find('#blstep1');
        var $fr_blstep2 = $fr_validator_add.find('#blstep2');
        var $fr_valid_btn_2 = $fr_validator_add.find('.btn-step2:first');
        var $fr_valid_btn_1 = $fr_validator_add.find('.btn-step1:first');
        var fr_validator_step = 0;
        $fr_valid_btn_2.on('click',function(ev){
            ev.preventDefault();
            fr_validator_step = 2;
            $fr_validator_add.trigger('submit');
            return true;
        });
        $fr_valid_btn_1.on('click',function(ev){
            ev.preventDefault();
            fr_validator_step = 1;
            $fr_blstep1.addClass('active');
            $fr_blstep2.removeClass('active');
            return true;
        });

        $fr_validator_add.on('submit',function(ev){
            //ev.preventDefault();
            var error_check = check_extra_validator($fr_validator_add,['tags']);
            if(ev.isDefaultPrevented()){
                return false;
            }else if(error_check){
                ev.preventDefault();
                //console.log($element_error);
                if($element_error){
                    $('html,body').stop().animate({
                        scrollTop: $element_error.offset().top,
                    },
                        700
                    );
                }
                return false;
            }
            if(fr_validator_step==2){
                ev.preventDefault();
                $fr_blstep1.removeClass('active');
                $fr_blstep2.addClass('active');
                applyDataValidate($fr_blstep2,$fr_validator_add);
                fr_validator_step = 0;
                return false;
            }
            return true;
        });         
    } 
    var $fr_validator_edit = $('#fr-edit-policy');
    if($fr_validator_edit.length > 0){
        $fr_validator_edit.validator({});
        var $fr_blstep1 = $fr_validator_edit.find('#blstep1');
        var $fr_blstep2 = $fr_validator_edit.find('#blstep2');
        var $fr_valid_btn_2 = $fr_validator_edit.find('.btn-step2:first');
        var $fr_valid_btn_1 = $fr_validator_edit.find('.btn-step1:first');
        var fr_validator_step = 0;
        $fr_valid_btn_2.on('click',function(ev){
            ev.preventDefault();
            fr_validator_step = 2;
            $fr_validator_edit.trigger('submit');
            return true;
        });
        $fr_valid_btn_1.on('click',function(ev){
            ev.preventDefault();
            fr_validator_step = 1;
            $fr_blstep1.addClass('active');
            $fr_blstep2.removeClass('active');
            return true;
        });

        $fr_validator_edit.on('submit',function(ev){
            //ev.preventDefault();
            var error_check = check_extra_validator($fr_validator_edit,['cat','inputs']);
            if(ev.isDefaultPrevented()){
                return false;
            }else if(error_check){
                ev.preventDefault();
                //console.log($element_error);
                if($element_error){
                    $('html,body').stop().animate({
                        scrollTop: $element_error.offset().top,
                    },
                        700
                    );
                }
                return false;
            }
            if(fr_validator_step==2){
                ev.preventDefault();
                $fr_blstep1.removeClass('active');
                $fr_blstep2.addClass('active');
                applyDataValidate($fr_blstep2,$fr_validator_edit);
                fr_validator_step = 0;
                return false;
            }
            return true;
        });         
    } 

    });

})(jQuery);
//subscript-durion-option 
(function($){
$(function(){
    var subscript_option_mod = (function(){
        var $checkbox,$block,$inputs;
        var md_exp = {};
        md_exp.init = function(){
            $checkbox = $('input[name="subscript_duration_option"]');
            $block = $('#update_date_block');
            $inputs = $block.find('input');
            handleChangeState();
            listend();
        }
        var listend = function(){
            $checkbox.on('change',handleChangeState);
        }
        var handleChangeState = function(){
            if($checkbox.is(':checked')){
                disableInputs();
                return true;
            }
            enableInputs();
            return true;
        }
        var disableInputs = function(){
            $inputs.val('').attr({
                'readonly':true
            });
            return true;
        }
        var enableInputs = function(){
           $inputs.removeAttr('readonly');
           return true; 
        }
        return md_exp;
    })();
    subscript_option_mod.init();
});
})(jQuery);     
(function($){
    $(function(){
    //   
     $('.datepickertoday').on('changeDate', function() {
        var $ele = $(this);
        var $ip = $ele.siblings('input[type="hidden"]:first');
        if($ip.length > 0){
            $ip.val($ele.datepicker('getFormattedDate'));
        }
    });
    $(document).on('change','#address_minitry_province', function() {
        var $ele = $(this);
        var img = 'assets/photo/'+ $ele.find('option[value='+$ele.val()+']').text()+'.jpg';
        $('input[name="image_id"]').val(img);
        if($ele.val()>=48 || $ele.val()>=53) {
            $('#sub_minitry_province').hide();
        }else{
            $('#sub_minitry_province').show();
        }
    });
    var cat_sel = (function(){
        var md_exp = {},datas;
        var $element,$results,$sl_item,$sl_city,$ol_add;
        md_exp.init = function(){
            if(isNull(categories)){ return false;}
            $element = $('#cat_sel');
            $results = $element.find('.results:first'); 
            $sl_item = $element.find('.cat-list:first');   
            $ol_add = $element.find('.ol-add:first');        
            datas = categories;
            if(typeof datas !== 'object'){ datas=JSON.parse(datas);}
            initSelect();
            initResults();
            listend();  
        }
        var initResults = function(){
            var $childs = $results.children();
            $childs.each(function(id){
                var $ele = $(this);
                var op_val = $ele.data('cat');
                var op_child = $ele.data('children');
                op_child = isNull(op_child) ? [] : op_child.toString().split(',');
                if(isNull(op_val)){
                    return false;
                }
                var dt_item = datas[op_val];
                if(typeof dt_item !== 'object'){ return false;}
                var item_cat = getItemCat(id,dt_item);
                var item_sub = getItemCatSub(id,dt_item,op_child);
                $ele.html(item_cat + item_sub);
                return true;            
            });
            return true;
        }
        var initSelect = function(){
            var out = '';
            $.each(datas,function(key,ite){
                out += '<option value="'+key+'">'+ite.ite_name+'</option>';
            });
            $sl_item.html(out);
            return true;
        }
        var listend = function(){
            $ol_add.on('click',handleAdd);
            $element.on('click','.ol-del',handleDel);
        }
        var handleDel = function(ev){
            ev.preventDefault();
            $(this).closest('.ol_item').remove();
            return true;
        }
        var handleAdd = function(ev){
            ev.preventDefault();
            var $op_prv = $sl_item.find('option:selected');
            var op_val = $op_prv.val();
            if(isNull(op_val)){
                alert('category is required!');
                return false;
            }
            if( $results.children('[data-cat="'+op_val+'"]').length > 0){
                alert('category is selected!');
                return false;            
            }
            var dt_item = datas[op_val];
            if(typeof dt_item !== 'object'){ return false;}
            var id = $results.children().length;
            var item_cat = getItemCat(id,dt_item);
            var item_sub = getItemCatSub(id,dt_item,[]);
            var item = '<div class="ol_item" data-cat="'+dt_item.id+'">'+item_cat+item_sub+'</div>';
            $results.append(item);
            return true;
        }
        var getItemCat = function(id,dt){
            var out = '';
            out += '<div class="gridcell-right">';
            out += '<div class="row">';
            out += '<div class="col-md-4">';
            out += '<input type="hidden" name="cat_id['+id+'][cat]" value="'+dt.id+'">';
            out += '<span class="name">'+dt.ite_name+'</span>';
            out += '</div>';
            out += '<div class="col-md-8 text-right">';
            out += '<span class="glyphicon glyphicon-remove-circle ol-del"></span>';
            out += '</div>';
            out += '</div>';
            out += '</div>';       
            return out;
        }
        var getItemCatSub = function(id,dt,sels){
            var out = '';
            out += '<div class="gridcell-right tagdonate">';
            out += '<div class="row">';
            out += '<div class="col-md-12 flex-contain">';
            $.each(dt.children,function(key,ite){
                var check = sels.indexOf(key) >= 0 ? 'checked':'';
                out += '<label class="graybutton">';
                out += '<input type="checkbox" name="cat_id['+id+'][sub][]" value="'+key+'" '+check+'>';
                out += '<span class="name">'+ite+'</span>';
                out +='</label>';
            });
            out += '</div>';
            out += '</div>';
            out += '</div>';        
            return out;        
        }
        var isNull = function(dt){
            if(typeof dt === 'undefined' || dt===null || dt==''){
                return true;
            }
            return false;        
        }
        return md_exp;
    })() 
    cat_sel.init(); 
    //
    var region_sel = (function(){
        var md_exp = {},datas,provinces;
        var $element,$results,$sl_prv,$sl_city,$ol_add;
        md_exp.init = function(){
            $element = $('#region_sel');
            $results = $element.find('.results:first'); 
            $sl_prv = $element.find('#province_id_name');   
            $sl_city = $element.find('#city_id_name');   
            $ol_add = $element.find('.ol-add:first');
            listend();  
        }
        var listend = function(){
            $ol_add.on('click',handleAdd);
            $element.on('click','.ol-del',handleDel);
        }
        var handleDel = function(ev){
            ev.preventDefault();
            $(this).closest('.ol_item').remove();
            return true;
        }
        var handleAdd = function(ev){
            ev.preventDefault();
            var $op_prv = $sl_prv.find('option:selected');
            var $op_city = $sl_city.find('option:selected');
            if(isNull($op_prv.val())){
                alert('province and city is required!');
                return false;
            }
            var item = get_item($op_prv,$op_city);
            $results.append(item);
            return true;
        }
        var get_item = function($prv,$city){
            var out = '';
            var ct_value = 0;
            var ct_name = '';
            if($city.length > 0){
                ct_value = $city.val();
                ct_name = $city.text();
            }
            var id= $results.children().length;
            out+='<div class="ol_item gridcell-right">';
            out+='<div class="row">';
            out+='<div class="col-md-4">';
            out+='<input type="hidden" name="region['+id+'][province]" value="'+$prv.val()+'">';
            out+='<span class="name name-province">'+$prv.text()+'</span>';
            out+='</div>';
            out+='<div class="col-md-1"></div>';
            out+='<div class="col-md-4">';
            out+='<input type="hidden" name="region['+id+'][city]" value="'+ct_value+'">';
            out+='<span class="name name-city">'+ct_name+'</span>';
            out+='</div>';
            out+='<div class="col-md-3">';
            out+='<span class="glyphicon glyphicon-remove-circle ol-del"></span>';
            out+='</div>';
            out+='</div>';
            out+='</div>';        
            return out;
        }
        var isNull = function(dt){
            if(typeof dt === 'undefined' || dt===null || dt==''){
                return true;
            }
            return false;        
        }
        return md_exp;
    })() 
    region_sel.init(); 
    //

    });   
})(jQuery)

</script>