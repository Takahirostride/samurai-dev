<script>


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
		var append_list_cart = function() {
			var id = ramdom(1, 100);
			html = '<div class="gridcell-right mb20" >'+
			                '<div class="row">'+
			                    '<div class="col-md-4">'+
			                        '<div class="angularsl select-click" id="parent'+id+'">'+
										'<select class="selectpicker" set-data="'+id+'">'+
											'<option value="1">雇用・人材</option>'+
											'<option value="2">経営改善・販路開拓</option>'+
											'<option value="3">設備導入・研究開発</option>'+
											'<option value="4">創業・起業</option>'+
											'<option value="5">経営環境改善</option>'+
											'<option value="6">特許・知的財産</option>'+
											'<option value="7">誘致関連</option>'+
										'</select>'+
									'</div> <!-- end .angularsl -->'+
			                    '</div>'+
			                    '<div class="col-md-8">'+
			                        '<button class="btnic" set-data="'+id+'"><i class="fa fa-close"></i></button>'+
			                    '</div>'+
			                '</div>'+
			            '</div>'+
			            '<div class="gridcell-right" id="'+id+'">'+
			                '<div class="row">'+
			                    '<div class="col-md-12" >'+
			                        
			                    '</div>'+
			                '</div>'+
			            '</div>';

			$('.append_list_cart').append(html);
		}
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

		$(document).on('click', '.showoption div', function(){
			//console.log("xxx");
			var parent_id = $(this).parent().parent().attr('id');
			var cart_id = $('#'+parent_id).find('select').val();
			var id = $('#'+parent_id).find('select').attr("set-data");
			console.log(parent_id);
			loadSubAjax(cart_id, id);
		})
		//display cate/subcate
		loadSubAjax = function(catId, pos) {
			$.ajax({
				url: 'agency/get_category.json',
				dataType: 'JSON',
				success: function(json) {
					loadSubCat(json, catId, pos);
				}
			});
		}
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
		 $('#myModal').modal("show");
		});
		function check_validate(){
			alert("すべての項目を正確に入力してください。");
			return false;
		}	
</script>