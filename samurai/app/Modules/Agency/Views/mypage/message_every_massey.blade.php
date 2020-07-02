@extends('layouts.home')

@section('content')
<div class="mainpage clientprofile-1">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<ol class="breadcrumb">
					<li><a class="bg-color" href="#">TOPページ</a></li>
					<li class="active">メッセージ</li>
				</ol>	
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">メッセージ</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-2 sidebar-left">
				@if($user->image)
            		@php ($profile_image = $user->image)
            	@else
            		@php ($profile_image = 'assets/common/images/img-user1.png')
            	@endif
				@include('Agency::includes.sidebar-left')
			</div>
			<div class="col-sm-10 mainpage">
				<div class="row">
					<div class="col-sm-12">
						<ul class="nav nav-tabs tablinksub bordernone">
						    <li >
						        <a href="{{URL::route('agency.message')}}">すべて</a>
						    </li>
						    <li >
						        <a href="{{URL::route('agency.message_per_case')}}">案件ごと</a>
						    </li>
						    <li class="active">
						        <a href="{{URL::route('agency.message_every_massey')}}">士業ごと</a>
						    </li>
						    <li>
						        <a href="{{URL::route('agency.message_display_unread_only')}}">未読のみ表示</a>
						    </li>
						</ul><!-- end .tablinksub -->
						<div class="row" style="margin-top:10px;" ng-if="toptabflag==2">
			                <h5 class="text-primary" style="display:initial;float:left;"><b>クライアント名 : </b></h5>
			                <div class="col-sm-7">
			                	<div class="angularsl" id="clients_change" >
			                		<select id="clients">
			                		@if($clients)
									@foreach ($clients as $key => $value)
									<option value="{{$value->user_id}}">{{$value->displayname}}</option>
									@endforeach
									@endif
									</select>
			                	</div>
			                </div>
			            </div>
						<div class="row">

							<div class="col-sm-3 pdr-0">
								<table class="table table-bordered">
									<tbody>
										<tr>
											<td>
												<div class="searchPart">
				                                    <input type="text" name="search" id="search">
				                                </div>
											</td>
										</tr>
										<tr>
											<td class="paddingnone">
												<div class="div-message-left">
													<table class="table table-bordered mgbt-0">
														<tbody id="update_mes">
															@if($hire_data)
															@foreach ($hire_data as $key => $value)
															<tr  class=" tr_click @if($key == 0 )active @endif" id="{{$value->hire_id}}" data-user-id="{{$user_id}}" policy_name="{{$value->policy_name}}"  displayname="{{$value->displayname}}">
																<td>
																	<div class="col-xs-4 paddingnone">
																		<img src="{{URL::to('/')}}/{{$value->user_image}}" alt="">
																	</div>
																	<div class="col-xs-8">
																	<h6>{{$value->displayname}}</h6>
                                            						<h6>{{$value->policy_name}}</h6>
																	</div>
																	@if(array_search($value->hire_id, $unread_messages))
																		<div class="col-sm-1" style="width:11%;padding:0;">
								                                            <img src="{{URL::to('/')}}/assets/common/images/messagecheck.png" style="width:100%;margin-top:20px;">
								                                        </div>
							                                        @endif
																</td>
															</tr><!-- end tr -->
															@endforeach
															@endif
														</tbody>
													</table>
												</div>
											</td>
										</tr>
									</tbody>
								</table><!-- end table -->
							</div><!-- end .col-sm-3 -->
							<div class="col-sm-9 pdl-0">
								<div id="update_table_mes">
								<table class="table table-bordered mgbt-0">
									<tbody>
										<tr>
											<td>
												<h5 class="text-primary" id="policy_name_update"><b>@if(isset($hire_data[0])){{$hire_data[0]->policy_name}}@endif（案件名）</b></h5>
											</td>
										</tr>
										<tr>
											<td class="paddingnone">
												<div class="showmesscontent">
													<table class="full-width">
													    <tbody>
													    	@if($result)
															@foreach ($result as $value)
													        <tr>
													            <td>
													                <div class="row">
													                    <div class="col-sm-4">
													                        <hr>
													                    </div>
													                    <h5 class="text-center col-sm-4">
													                        <b>{{ date('Y年m月d日', strtotime($value->update_date)) }}</b>
													                    </h5>
													                    <div class="col-sm-4">
													                        <hr>
													                    </div>
													                </div>
													                <h5>@if($user->id == $value->from_id)
													                	{{$user->name}}
													                	@else
													                	{{$value->displayname}}
													                	@endif
													                :</h5>
													                <p>{{$value->message}}</p>
													                <div>
													                	@if($value->file !='')
													                	@php ($arr_file =  json_decode($value->file, true))
													                	
													                	@foreach ($arr_file as $value1)
													                	<p><a onclick="return downloaddocfile('{{$value1[1]}}','{{$value1[0]}}')" >{{$value1[0]}}</a></p>
													                	@endforeach
													                	@endif
													                </div>
													            </td>
													        </tr>
													        @endforeach
															@endif
													    </tbody>
													</table><!-- end table -->
												</div><!-- end .showmesscontent -->
											</td>
										</tr>
									</tbody>
								</table><!-- end table -->
								</div>
								{{ Form::open(array('url' => '/agency/mypage/send_message', 'method' =>'POST','id'=>'form','enctype'=>'multipart/form-data')) }}
								<table class="table table-bordered mgbt-0">
									<tbody>
										<tr>
											<td>
												<div class="row">
								                    <div class="col-sm-4">
								                        <hr>
								                    </div>
								                    <h5 class="text-center col-sm-4">
								                        <b>{{date('Y年m月d日')}}</b>
								                    </h5>
								                    <div class="col-sm-4">
								                        <hr>
								                    </div>
								                </div>
								                <div class="subjectmes">
								                	<label class="control-label">
	                                                    <img src="{{URL::to('/')}}/assets/common/images/messagesend.png">
	                                                </label>
	                                                <b class="update_display_name">@if(isset($hire_data[0])){{$hire_data[0]->displayname}}@endif</b>
		                                            <div class="pull-right">
		                                            	<label for="file" id="get_file"><span class="glyphicon glyphicon-paperclip"  ></span>
                                                        </label>
		                                            	<input id="file" name="file[]" onclick="return hide_tab_bottom()"  type="file" style="display: none;" onchange="return selectresumefile()" multiple="multiple"/>
		                                            </div>
								                </div>
                                                <textarea class="form-control messtextinput"  required="required" disabled="" rows="6" id="message" name="message"></textarea>
					                            {{Form::hidden('hire_id','',array('id'=>'hire_id'))}}
					                            {{Form::hidden('count_file','',array('id'=>"count_file"))}}
											</td>
										</tr>
									</tbody>
								</table><!-- end table -->
								
								<ul class="nav nav-tabs tablinksub bordernone marginnone">
								    <li class="active">
								        <a data-toggle="tab" onclick="hide_tab_bottom()">添付ファイル></a>
								    </li>
								</ul><!-- end .tablinksub -->
								<table class="table table-bordered" id="bottomtab">
									<tbody>
										<tr>
											<td>
												<div class="col-sm-7" id="list_file">
                                                    <!-- add file list upload -->
				                                </div>
				                                <div class="col-sm-5">
				                                   <div id="dropbox1" class="dropbox">
			                                            <img class="drop-image1" src="{{URL::to('/')}}/assets/common/images/fileupload.png">
			                                            <p class="drop-p1-1">アップロードする場合は、</p>
			                                            <p class="drop-p2-1">ここにドラッグ＆ドロップしてください。</p>
			                                        </div>
				                                </div>
												
											</td>
										</tr>
										<tr>
											<td>
												<button class="shadowbuttondanger btn btn-danger"  onclick="return deletefiles()">削除する</button>
											</td>
										</tr>
									</tbody>
								</table><!-- end table -->
								<div class="text-center mgt-30 mgbt-50">
									<input type="submit" class="btn btn-style-shadow-green btn-success" style="width:150px;margin-top:50px;margin-bottom:20px;" id="send_mes" value="送信する" disabled="" onclick="return sendmessage()"/>
								</div>
								{{ Form::close() }}
							</div><!-- end .col-sm-9 -->
						</div><!-- end .row -->
					</div><!-- end .col-sm-12 -->
				</div>	<!-- end .row -->
			</div>
		</div>
	</div>
</div>
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog box-in contact-modal">
        <div class="modal-content box-out">
            <div class="col-sm-12">
                <div class="box-modal">
                    <p class="">アップロードできるファイルは５個までです。</p>
                    <button class="md-primary md-button md-default-theme right modal-btn-close">確認</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('style')
<style type="text/css">
	.dropbox{
		font-size: 14px;
		border: none;
	}
	.tr_click{
		cursor: pointer;
	}
	.font20 {
        font-size:20px;
    }
    .box-modal {
        padding: 20px;
        height: 100%;
        max-width: 169px;
        width: 100%;
        max-width: 470px;
        background: #fff;
        border-radius: 10px;
        margin: auto;
        display: table;
    }
    .modal-content.box-out{
    	max-width: 450px;
    }
    .contact-modal {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 0;
    }
    .right{
        float: right;
    }
    .modal-btn-close {
        display: inline-block;
        position: relative;
        cursor: pointer;
        min-height: 36px;
        min-width: 88px;
        line-height: 36px;
        vertical-align: middle;
        -webkit-box-align: center;
        -webkit-align-items: center;
        -ms-grid-row-align: center;
        align-items: center;
        text-align: center;
        border-radius: 3px;
        box-sizing: border-box;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        border: 0;
        padding: 0 6px;
        margin: 6px 8px;
        background: transparent;
        color: currentColor;
        white-space: nowrap;
        text-transform: uppercase;
        font-weight: 500;
        font-size: 14px;
        font-style: inherit;
        font-variant: inherit;
        font-family: inherit;
        text-decoration: none;
        overflow: hidden;
        -webkit-transition: box-shadow .4s cubic-bezier(.25,.8,.25,1),background-color .4s cubic-bezier(.25,.8,.25,1);
        transition: box-shadow .4s cubic-bezier(.25,.8,.25,1),background-color .4s cubic-bezier(.25,.8,.25,1);
    }
    .modal-btn-close:hover {
        background-color: rgba(158,158,158,0.2);
        color: rgb(63,81,181);
    }
</style>
@endsection
@section('script')
	<script>
		var selectedfilearray = new Array();
    	var bottomtab = 1;
    	listneradded=0;
		$(document).on('click','.tr_click', function(){
			$('.tr_click').removeClass('active');
			$(this).addClass('active');

			var hire_id = $(this).attr('id');
			var user_id = $(this).attr('data-user-id');
			var policy_name = $(this).attr('policy_name');
			var displayname = $(this).attr('displayname');

			console.log(hire_id);
			$.ajax({
                url: '/agency/mypage/getmessagebyid?user_id='+user_id+'&hire_id='+hire_id,
                dataType: 'JSON',
                success: function(json) {
                	html_mes_table = '<table class="full-width">'
                	html_mes_table +='<tbody>';
                	for (var i = 0; i < json.length - 1; i++) {
                		
                		var ds_name ="";
                		var arr_img = new Array();  
                		arr_img = JSON.parse(json[i].file);
                		var file = ""
                		
                		if(arr_img.length >0){
                			for (var j = 0 ; j <= arr_img.length - 1; j++) {
                				var sub_arr_file = arr_img[i]
                				file +="<p><a onclick=\"return downloaddocfile('"+arr_img[j][1]+"','"+arr_img[j][0]+"')\" >"+arr_img[j][0]+"</a></p>";
                			}
                		}
                		
                		if(user_id == json[i].from_id){
                			ds_name = '{{$user->name}}';
                		}else{
                			ds_name = json[i].displayname;
                		}
                		html_mes_table +='<tr>';
				        html_mes_table +='<td>';
				        html_mes_table +='<div class="row">';
				        html_mes_table +='<div class="col-sm-4">';
				        html_mes_table +='<hr>';
				        html_mes_table +='</div>';
				        html_mes_table +='<h5 class="text-center col-sm-4"><b>'+getformateddatestring(json[i].update_date)+'</b>';
				        html_mes_table +='</h5>';
				        html_mes_table +='<div class="col-sm-4">';
				        html_mes_table +='<hr>';
				        html_mes_table +='</div>';
				        html_mes_table +='</div>';
				        html_mes_table +='<h5>'+ds_name;
				        html_mes_table +=':</h5>';
				        html_mes_table +='<p>'+json[i].message+'</p>';
				        html_mes_table +='<div>';
				        html_mes_table +=file;
						html_mes_table +='</div>';
				        html_mes_table += '</td>';
				        html_mes_table +='</tr>';
                	}
                    html_mes_table += '</tbody>';
					html_mes_table +='</table>';
					$('#policy_name_update').text(policy_name+'（案件名）');
					$('.update_display_name').text(displayname);
					$('.showmesscontent').html(html_mes_table);
					if(json[json.length-1] == 1){
						$("#message").attr("disabled", true);
						$("#send_mes").attr("disabled", true);
					}else{
						$("#message").removeAttr("disabled");
						$("#send_mes").removeAttr("disabled");
					}
					$('#hire_id').val(hire_id);
                }

            });
		});

		function getformateddatestring(datestr){
			var temparray=datestr.split("-");
			return ""+temparray[0]+"年"+temparray[1]+"月"+temparray[2]+"日";
		}

		
		$(document).ready(function(){
			$(document).on('click', '#clients_change .showoption div', function(){
		        var parent_id = $(this).parent().parent().attr('id');
		        var client_id = $('#'+parent_id).find('select').val();
		        var key = $('#search').val();
		        search(client_id,key);

		    })

			$('#search').keyup(function(){
				var key = $(this).val();
				var client_id = $('#clients').val();
				search(client_id,key);
			})
			function search(client_id,key){

				html_mes_table = "";
				$.ajax({
	                url: '/agency/mypage/searchmessage_every_massey?client_id='+client_id+'&keyword='+key,
	                dataType: 'JSON',
	                success: function(json) {
	                	var checkicon =  '<div class="col-sm-1" style="width:11%;padding:0;">';
                            checkicon +='<img src="{{URL::to('/')}}/assets/common/images/messagecheck.png"' ;
                            checkicon +=' style="width:100%;margin-top:20px;">';
                            checkicon +='</div>';
	                	for (var i = 0; i < json.length -1; i++) {
	                		
					        html_mes_table +='<tr class="tr_click" id="'+json[i].hire_id+'" data-user-id="{{$user_id}}"  policy_name="'+json[i].policy_name+'">';
							html_mes_table +='	<td>';
							html_mes_table +='		<div class="col-xs-4 paddingnone">';
							html_mes_table +='			<img src="{{URL::to('/')}}/'+json[i].user_image+'" alt="">';
							html_mes_table +='		</div>';
							html_mes_table +='		<div class="col-xs-8">';
							html_mes_table +='		<h6>'+json[i].displayname+'</h6>';
	        				html_mes_table +='		<h6>'+json[i].policy_name+'</h6>';
							html_mes_table +='		</div>';
							var unread_messages = json[json.length-1];
							if(unread_messages.indexOf(json[i].hire_id) >= 0)
							html_mes_table +='	</td>';
							html_mes_table +='</tr><!-- end tr -->';
							
	                	}
	                	console.log(json);
	                	setupselect();
	                	$('#update_mes').html(html_mes_table);


	                }

	            });
			}
		})
		
        function deleteimagefile1(id){
            console.log(id);
           $('#image_name'+id).val('');
           $('#image_url'+id).attr( "src", "" );
        }
        
        function downloaddocfile(filepath,filename){
            window.open("/agency/mypage/downloadfile/"+filepath+"/"+filename);
        }

        function selectresumefile() {
            var files = document.getElementById("file");
            var files = files.files;
            console.log(files);
            for(var i=0;i<files.length;i++){
                if(selectedfilearray.length<5){
                    selectedfilearray.push({name:files[i].name,file:files[i]});
                }
                else{
                     $('#myModal').modal("show");
                    return;
                }
            }
            showfileUload();
        };
	    function showfileUload(){
	        var html ="";
	        //console.log(selectedfilearray);
	        for (var i = 0; i <= selectedfilearray.length - 1; i++) {
	           html +='<p><label><input class="control-label" type="checkbox" value="'+i+'" name="del_group[]" >'+selectedfilearray[i]['name']+'</label></p>';
	        }
	        $('#list_file').html(html);
	    }
	    // get file drag/drop
	    var dropbox1 = document.getElementById("dropbox1");
	    dropbox1.addEventListener("dragenter", dragEnterLeave, true);
	    dropbox1.addEventListener("dragleave", dragEnterLeave, true);
	    dropbox1.addEventListener("dragover", dragOver, true);
	    dropbox1.addEventListener("drop", dropEvent, true);
	    // init event handlers
	    function dragEnterLeave(evt) {
	        evt.stopPropagation();
	        evt.preventDefault();
	    }

	    function dragOver(evt) {
	        evt.stopPropagation();
	        evt.preventDefault();
	        var clazz = 'not-available';
	        var ok = evt.dataTransfer && evt.dataTransfer.types && evt.dataTransfer.types.indexOf('Files') >= 0;
	        $('.dropbox').css('background-color', '#15b86c80');
	    }

	    function dropEvent(evt) {
	        console.log('drop evt:', JSON.parse(JSON.stringify(evt.dataTransfer)))
	        evt.stopPropagation();
	        evt.preventDefault();
	        $('.dropbox').css('background-color', '#fff');
	        var files = evt.dataTransfer.files;
	        
	        //console.log(files);
	        if (files.length > 0) {
	            for(var i=0; i<files.length; i++){
	                if(selectedfilearray.length<5){

	                    if(files[i].size<8388608){
	                        console.log('xxx');
	                        selectedfilearray.push({name:files[i].name,file:files[i]});
	                    }
	                    else{
	                        alert("アップロードするファイルサイズが大きいです。");
	                    }

	                }else{
	                    $('#myModal').modal("show");
	                    return;
	                }
	            }
	            showfileUload();
	        }
	    }
	    // end get file drag/drop
	    function deletefiles() {

	        ids = new Array();
	        $('input[name="del_group[]"]:checked').each(function() {
	           ids.push(this.value); 
	           
	        });
	        if(ids.length >0){
	            for(i=0; i<ids.length; i++){
	                selectedfilearray.splice((ids[i]-i),1);
	            }
	            showfileUload();
	        }
	        return false;
	    };

	    $('.modal-btn-close').click( function(){
	        $('#myModal').modal("hide");
	    });

	    function hide_tab_bottom(){
	        $('#bottomtab').hide();
	    } 
    
	    function sendmessage(){
	        var input = $('#message');
	        if(input.val()==""){
	            alert("メッセージを入力してください。");
	            return false;
	        }
	        let fd = new FormData($('form#form')[0]);
	        var file_ar = $('#file');
	        
	        if(selectedfilearray.length > 0){
	            for (var i = 0; i < selectedfilearray.length; i++) {
	                fd.append("fileToUpload"+i, selectedfilearray[i].file);
	            }
	             fd.append("count_file", selectedfilearray.length);
	        }
	        $.ajax({
	            url: '/agency/mypage/send_message',
	            type: 'POST',
	            data: fd,
	            async: false,
	            success: function (data) {
	                console.log(data);
	                if(data = "success"){
	                	var onload =  fd.get('hire_id');
	                	console.log(onload);
	                	$('#'+onload).trigger('click');
	                	$("#message").val("");
	                	selectedfilearray = [];
	                	showfileUload();
	                }
	            },
	            cache: false,
	            contentType: false,
	            processData: false
	        });
	        return false; 
	    }
	</script>
@endsection