@php
        $categories = App\Modules\Admin\Models\Category::listCatSub();
@endphp
<script>
var categories = {!! json_encode($categories) !!} ;	
$("#option1").click(function(){
	window.location="agency/Cpart.php";
})
$("#option2").click(function(){
	window.location="agency/Cadd.php";
})
$("#file").on('change' , function(){
	var name = $(this)[0].files[0]["name"];
	$("#img-name").val(name);
})
function ramdom(min, max){
	return Math.floor(Math.random() * (max - min)) + min;
}
$(document).on('click', '.btnic', function() {
	$(this).closest('.gridcell-right').remove();
	var id = $(this).attr('set-data');
	$('#'+id).remove();
});

$(document).on('click', '.btnic2', function() {
	$(this).closest('.gridcell').remove();
});
var loadSubCat = function(json, catId, pos) {
	json = json.sub_category[catId];
	var html ="";
	$.each(json, function(index, val) {

		html += '<div class="col-sm-3"><div class="tagdonate"><label class="graybutton">'+
		'<input type="checkbox" class="checkbox" name="subcat[]" value="'+index+'" id="check_list-'+index+'"><span>' + val+
		'</span></label></div></div>';

	});
	$('#'+pos).html(html);
}
var target_area = function(){
	var html ="";
	html+= '<div class="gridcell">'+
            '<div class="row">'+
				'<div class="col-md-4">'+
					'<div class="angularsl">'+
						'<select class=" selectpicker" >'+
							'<option value="徳島県">徳島県</option>'+
							'<option value="香川県">香川県</option>'+
							'<option value="愛媛県">愛媛県</option>'+
							'<option value="高知県">高知県</option>'+
						'</select>'+
					'</div> <!-- end .angularsl -->'+
				'</div> <!-- end .col-md-4 -->'+
				'<div class="col-md-4">'+
					'<div class="angularsl">'+
						'<select class="form-control" multiple="multiple">'+
							'<option value="鹿屋市">鹿屋市</option>'+
							'<option value="枕崎市">枕崎市</option>'+
						'</select>'+
					'</div> <!-- end .angularsl -->'+
				'</div> <!-- end .col-md-4 -->'+
				'<div class="col-md-2">'+
                    '<button class="btnic2"><i class="fa fa-close"></i></button>'+
               ' </div> '+ 
            '</div>'+
       ' </div>';
       $('.box_target_area').append(html);
}

$(".check-option").click(function(){
var pos = $(this).attr("pos");
pos = pos * 50;
console.log(pos);
$(".change-pos").css('margin-top', pos+"px" );
})

$('.checkdis1').click(function(){
    var isDisabled = $('.other2').is(':disabled');
        if (isDisabled) {
            $('.other2').prop('disabled', false);
        } else {
            $('.other2').prop('disabled', true);
        }
});
$(".other4").click(function(){
    var check = $(this).attr("id");
    if(check == "op3"){
       $('#other4').prop('disabled', false);
    } else {
        $('#other4').prop('disabled', true);
    }
})
$('.submit-delete-button').click(function(){
        var id_del = $(this).attr("data-del");
        $("#"+id_del).val("");
})

$(document).on('change', '.hidefile1', function(){
    var obj = $(this);
    //console.log(obj['0'].files);
    var count = obj['0'].files.length;
    if(count > 5){
        alert("アップロードできるファイルは５個までです。");
    }
    for (var i = 0; i < 5; i++) {
        for (var j = 1; j <= 5; j++) {
           if($("#focusedInput"+j).val() == ""){
                //console.log(obj['0'].files);
                $("#focusedInput"+j).val(obj['0'].files[i]["name"]);
                //$("#filename"+j).val(obj['0'].files[i]);
                //console.log($("#filename"+j).val());
                //console.log(obj['0'].files[i]);
                break;
           }
        }
    }
});
$('.hidefile1').on({
    'dragover dragenter': function(e) {
        $(this).closest('.dropbox').css('background-color', '#15b86c80');
    },
    drop: function(e) {
        $(this).closest('.dropbox').css('background-color', '#fff');
    }
});

$(document).ready(function(){
	console.log("xxx");
 //$('#myModal').modal("show");
});
(function($){
$(function(){
    var $address_mintry = $('.select_minitry');
    if($address_mintry.length > 0){
       $.ajax({
            url: '/agency/resource/provinces',
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
    //category-select
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
    //region-select
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
            if(isNull($op_prv.val()) || isNull($op_city.val())){
                alert('province and city is required!');
                return false;
            }
            var item = get_item($op_prv,$op_city);
            $results.append(item);
            return true;
        }
        var get_item = function($prv,$city){
            var out = '';
            var id= $results.children().length;
            out+='<div class="ol_item gridcell-right">';
            out+='<div class="row">';
            out+='<div class="col-md-4">';
            out+='<input type="hidden" name="region['+id+'][province]" value="'+$prv.val()+'">';
            out+='<span class="name">'+$prv.text()+'</span>';
            out+='</div>';
            out+='<div class="col-md-1"></div>';
            out+='<div class="col-md-4">';
            out+='<input type="hidden" name="region['+id+'][city]" value="'+$city.val()+'">';
            out+='<span class="name">'+$city.text()+'</span>';
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
    //submit-validate
    var $fr_validator = $('.fr-validator:first');
    $fr_validator.validator({ 
        disable:false   
    });
    var $element_error = false;
    function check_extra_validator(){
        var error = false; 
        $element_error = false;   
        var display_error = function($el){
            $element_error = $el.siblings('.with-errors:first');
            $element_error.text('必須');
        }
        var remove_error = function($el){
            $el.siblings('.with-errors').text('');
        }
        var $tags = $fr_validator.find('input[name="tags[]"]');
        var $inputs = $fr_validator.find('input[name="image_name"]');
        var $sub_cat = $('#cat_sel').find('.ol_item');
        remove_error($('.bl_tags'));
        remove_error($inputs);
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
        }
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
                display_error($('.bl_tags'));
            }
        }
        if($inputs.length > 0){
            $inputs.each(function(){
                var $el = $(this);
                var el_val = $el.val();
                if(typeof el_val==='undefined' || el_val===null || el_val ==''){
                     error = true;
                     display_error($el);   
                }
            });
        }
        return error;
    }
    $fr_validator.on('submit',function(ev){
        var error = check_extra_validator();
        if(ev.isDefaultPrevented()){
            console.log('validator error!');
        }else if(error){
            ev.preventDefault();
            console.log($element_error);
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
    $.fn.olSelectMinitry = function(opts){
        var sets = $.extend({},$.fn.olSelectMinitry.defaults,opts);
        return this.each(function(){
            var $element = $(this);
            var mod = (function(){
                var exp = {};
                var p2c;
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
                    if(typeof p2c[prv]['children'] !== 'object'){ return [];}
                    return p2c[prv]['children'];

                }
                var init_mod = function(res){
                        p2c = res;
                        initProvince();
                        listend();
                        $cities.removeAttr('disabled');
                        $element.removeAttr('disabled');                
                }
                var initProvince = function(){
                    var opts = '<option value="">すべて</option>';
                    $.each(p2c,function(key,ite){
                        opts += '<option value="'+key+'">'+ite.ite_name+'</option>';
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
    $.fn.olSelectMinitry.defaults = {
            children : '',
            source_url :''    
    }
})(jQuery);		
</script>