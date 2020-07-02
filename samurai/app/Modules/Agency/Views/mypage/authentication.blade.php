@extends('layouts.home')

@section('content')
<div class="mainpage clientprofile-1">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<ol class="breadcrumb">
					<li><a class="bg-color" href="#">TOPページ</a></li>
					<li class="active">各種認証申請</li>
				</ol>	
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">各種認証申請</h1>
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
						    <li class="active">
						        <a href="{{URL::route('agency.authentication')}}">本人確認書類</a>
						    </li>
						    <li>
						        <a href="{{URL::route('agency.authentication.confidentiality_confirmation')}}">機密保持確認</a>
						    </li>
						    <li>
						        <a href="{{URL::route('agency.authentication.secretariat_confirmation')}}">事務局確認</a>
						    </li>
						    <li>
						        <a href="{{URL::route('agency.authentication.call_confirmation')}}">電話確認</a>
						    </li>
						    <li class="not-text">
						        <a id="show_manual" data-toggle="modal" data-target="#modal-certification-conf" ><img src="{{URL::to('/')}}/assets/common/images/manual.png" alt=""></a>
						    </li>
						   
						</ul><!-- end .tablinksub -->
						@if($result['person_confirm']['result'] == 'success' && $allow_odc == 1 )
							<div class="row">
			                    <div class="col-sm-12">
			                    <h3>本人確認書類</h3>
			                    </div>
			                </div>
			                <div class="row auth">
			                    <div class="col-sm-12">
			                        <div class="div-style-green">
			                            <h4 class="bold"><i class="fa fa-check"></i>本人確認が完了しました。</h4>
			                            <p>SAMURAI事業部による本人確認が完了した場合、グリーンになります。完了までしばらくお待ちください。
			                                提出書類に変更、不備があった場合は、下記より再度SAMURAI事業部に送信ください。</p>
			                            <p class="right-link"><a href="">再度本人確認書類を送信する</a></p>
			                            <div class="row text-center pd30">
			                            	@if($result['person_confirm']['result'] == 'success')
			                                <div class="col-sm-3">
			                                    <div class="box-au-icon">
			                                        <p class="img"><img src="{{URL::to('/')}}/assets/common/images/user-1.png" alt=""></p>
			                                        <p class="text-au">本人確認書類提出</p>
			                                    </div>
			                                </div>
			                                @else
			                                <div class="col-sm-3">
			                                	<a href="{{URL::route('agency.authentication')}}">
				                                    <div class="box-au-icon not-confirm">
				                                        <p class="img"><img src="{{URL::to('/')}}/assets/common/images/user-1.png" alt=""></p>
				                                        <p class="text-au">本人確認書類提出</p>
				                                    </div>
			                                    </a>
			                                </div>
			                                @endif
			                                @if($result['user_nda']['result'] == 'success')
			                                <div class="col-sm-3">
			                                    <div class="box-au-icon">
			                                        <p class="img"><img src="{{URL::to('/')}}/assets/common/images/file-1.png" alt=""></p>
			                                        <p class="text-au">機密保持確認</p>
			                                    </div>
			                                </div>
			                                @else
			                                <div class="col-sm-3">
			                                	<a href="{{URL::route('agency.authentication.confidentiality_confirmation')}}">
			                                    <div class="box-au-icon not-confirm">
			                                        <p class="img"><img src="{{URL::to('/')}}/assets/common/images/file-1.png" alt=""></p>
			                                        <p class="text-au">機密保持確認</p>
			                                    </div>
			                                	</a>
			                                </div>
			                                @endif
			                                @if($result['user_check']['result'] == 'success')
			                                <div class="col-sm-3">
			                                    <div class="box-au-icon ">
			                                        <p class="img"><img src="{{URL::to('/')}}/assets/common/images/check-1.png" alt=""></p>
			                                        <p class="text-au">SAMURAIチェック</p>
			                                    </div>
			                                </div>
			                                @else
			                                <div class="col-sm-3">
			                                	<a href="{{URL::route('agency.authentication.secretariat_confirmation')}}">
			                                    <div class="box-au-icon not-confirm">
			                                        <p class="img"><img src="{{URL::to('/')}}/assets/common/images/check-1.png" alt=""></p>
			                                        <p class="text-au">SAMURAIチェック</p>
			                                    </div>
			                                	</a>
			                                </div>
			                                @endif
			                                @if($result['user_phone']['result'] == 'success')
			                                <div class="col-sm-3">
			                                    <div class="box-au-icon">
			                                        <p class="img"><img src="{{URL::to('/')}}/assets/common/images/phone-1.png" alt=""></p>
			                                        <p class="text-au">電話確認</p>
			                                    </div>
			                                </div>
			                                @else
			                                <div class="col-sm-3">
			                                	<a href="{{URL::route('agency.authentication.call_confirmation')}}">
			                                    <div class="box-au-icon not-confirm">
			                                        <p class="img"><img src="{{URL::to('/')}}/assets/common/images/phone-1.png" alt=""></p>
			                                        <p class="text-au">電話確認</p>
			                                    </div>
			                                	</a>
			                                </div>
			                                @endif
			                            </div>
			                        </div>
			                    </div>
			                </div>
			            @else
			            	@if(session()->has('status'))
			            	<div class="row">
			                    <div class="col-sm-12">
			                        <p class="note-text"><i class="fa fa-check"></i>本人確認書類を送信しました。</p>
			                    </div>
			                </div>
			                @endif
			                <div class="row">
			                    <div class="col-sm-12">
			                    <h3>本人確認書類</h3>
			                    </div>
			                </div>
			                <div class="row">
			                    <div class="col-sm-12">
			                    <h3 class="page-title">本人確認書類</h3>
			                    </div>
			                </div>
			                <div class="row">
			                    <div class="col-sm-12">
			                        <p>本人書類確認をご提出後、SAMURAI事業部より確認作業を行います。確認が完了するまでおお時間がかかる場合がございますが、ご了承願います。
			                        確認が完了次第、メールにてご連絡させていただきます。</p>
			                        <div class="step">
			                            <div class="col-sm-3"><p>プロフィール編集</p></div>
			                            <div class="col-sm-3"><p>資料提出</p></div>
			                            <div class="col-sm-3"><p>資料確認</p></div>
			                            <div class="col-sm-3"><p>資料確認</p></div>
			                        </div>
			                        <form method="post" action="authentication"  enctype="multipart/form-data" >
			                            <table class="table table-bordered">
			                                <tr>
			                                    <td class="div-style-blue2 ">企業名</td>
			                                    <td>

			                                        <input type="text" name="name" id="name"
			                                        value="@if($result['person_confirm']['result'] == 'success' && $allow_odc == 0 ){{$result['person_confirm']['data']->name}} @endif" class="form-control">
			                                        {{ csrf_field() }}
			                                    </td>
			                                </tr>
			                                 <tr>
			                                    <td class="div-style-blue2 ">住所</td>
			                                    <td>
			                                        <input type="text" name="address" id="address"
			                                        value="@if($result['person_confirm']['result'] == 'success' && $allow_odc == 0 ){{$result['person_confirm']['data']->address}} @endif" class="form-control">
			                                        <input type="hidden" name="edit_type" value="@if($result['person_confirm']['result'] == 'failed') 0 @else 1 @endif" >
			                                    </td>
			                                </tr> 
			                                <tr>
			                                    <td class="div-style-blue2 ">事業開始日</td>
			                                    <td class="authentication-1-1">
			                                        
			                                            <div class="col-sm-2 pdl-0 pdlr-sp-0">
			                                                <div class="form-group has-feedback">
			                                                <input type="text" name="year" id="year" value="@if($result['person_confirm']['result'] == 'success' && $allow_odc == 0 ){{date('Y', strtotime($result['person_confirm']['data']->birthday))}}@endif" class="form-control">
			                                                <span class="form-control-feedback">年</span>
			                                                </div>
			                                            </div>
			                                            <div class="col-sm-3 pdlr-sp-0">
			                                                <div class="form-group has-feedback">
			                                                <input type="text" name="day" id="day" value="@if($result['person_confirm']['result'] == 'success' && $allow_odc == 0 ){{date('d', strtotime($result['person_confirm']['data']->birthday))}}@endif" class="form-control">
			                                                <span class="form-control-feedback">日</span>
			                                                </div>
			                                            </div>
			                                            <div class="col-sm-2 pdlr-sp-0">
			                                                <div class="form-group has-feedback">
			                                                <input type="text" name="mon" id="mon" value="@if($result['person_confirm']['result'] == 'success' && $allow_odc == 0 ){{date('m', strtotime($result['person_confirm']['data']->birthday))}}@endif" class="form-control">
			                                                <span class="form-control-feedback">月</span>
			                                                </div>
			                                            </div>
			                                    </td>
			                                </tr> <tr>
			                                    <td class="div-style-blue2 ">添付ファイル</td>
			                                    <td >
			                                        <div id="box-file">
			                                        	@if($result['person_confirm']['result'] == 'success' && $allow_odc == 0 )
			                                        		<?php  $files = json_decode($result['person_confirm']['data']->files, true) ?>
				                                        	@if($files)
				                                        	@foreach ($files as $key => $value)
				                                            <div class="input-group form-group" id="del{{$key}}">
				                                                <input type="text" class="form-control " value="{{$value[0]}}" disabled="" aria-invalid="false" id="ch{{$key}}" name="profile_name_edit{{$key}}">
				                                                <input type="hidden" name="profile_name_edit[]" id="hdch{{$key}}" value="{{$value[0]}}" >
				                                                <div class="input-group-btn">
				                                                    <label class="del-file" data-del="del{{$key}}"><span><i class="fa fa-trash-o"></i></span></label>
				                                                    <label for="attachment{{$key}}" class="btn btn-primary">参照</label>
				                                                    <input id="attachment{{$key}}" type="file" class="ds-none" name="profile_edit[]" data-is="ch{{$key}}" accept="image/*">
				                                                </div>
				                                            </div>
				                                            @endforeach
															@endif
														@elseif($result['person_confirm']['result'] == 'failed')
															<div class="input-group form-group" id="del1">
				                                                <input type="text" class="form-control " disabled="" value="" aria-invalid="false" id="ch1" name="profile_name[]">
				                                                <div class="input-group-btn">
				                                                    <label class="del-file" data-del="del1"><span><i class="fa fa-trash-o"></i></span></label>
				                                                    <label for="attachment1" class="btn btn-primary">参照</label>
				                                                    <input id="attachment1" type="file" class="ds-none" name="profile[]" data-is="ch1" accept="image/*">
				                                                </div>
				                                            </div>
														@endif

			                                        </div>   
			                                        <p class="mgt-20"><span id="add-box-file"><i class="fa fa-plus-circle"></i>ファイルを追加する</span></p>
			                                        <p class="mgt-20"><label><input type="checkbox" @if($result['person_confirm']['result'] == 'success' && $allow_odc == 0 && $result['person_confirm']['data']->option1 == 1 ) checked="" @endif id="option1" name="option1" value="1">登録氏名が漢字・かな・ローマ字表記も含め証明書類と一致している</label></p>
			                                        <p><label><input type="checkbox" @if($result['person_confirm']['result'] == 'success' && $allow_odc == 0 && $result['person_confirm']['data']->option2 == 1 ) checked="" @endif id="option2" name="option2" value="1">登録住所が番地・部屋番号まで証明書類と一致している</label></p>
			                                    </td>
			                                </tr>
			                            </table>
			                            <p class="text-center"><input type="submit" name="submit" class="btn btn-style-shadow-green btn-success" style="margin-top: 40px;margin-bottom: 50px" onclick="return clickverifydocument()" value="送信する" >
                            			</p>
			                        </form>
			                    </div>
			                </div>
						@endif
						
					</div><!-- end .col-sm-12 -->
				</div>	<!-- end .row -->
			</div>
		</div>
	</div>
</div>
<!-- 20180513 追加 s -->
<div class="modal fade" id="modal-certification-conf" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered text-center" role="document">
      <div class="modal-content">
          <div class="modal-header text-center">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
              <h5 class="modal-title">マニュアル</h5>
          </div>
          <div class="modal-body">
              <iframe width="100%" height="100%" src="{{URL::to('/')}}/manuals/certification_conf/operationlecture.html" frameborder="0"></iframe>
          </div>
      </div>
  </div>
</div>
<!-- 20180513 追加 e -->
@endsection
@section('style')
<style type="text/css">
 .nav-tabs>li.not-text {
 	padding: 0;
    border: 0;
 }
.nav-tabs>li.not-text a {
 	padding: 2px;
    border: 0;
    width: 50px;
    height: 50px;
}
</style>
@endsection
@section('script')
	<script type="text/javascript">
    $(document).delegate(".del-file","click", function() {
        var id_del = $(this).attr("data-del");
        console.log("s");
        $("#"+id_del).remove();
    });
    $("#add-box-file").click(function(){
        var id = get_id();
        var text = '<div class="input-group form-group" id="'+id+'"><input type="text" id="ch'+id+'" class="form-control " aria-invalid="false" name="profile-image-text3"><div class="input-group-btn"><label class="del-file" data-del="'+id+'"><span><i class="fa fa-trash-o"></i></span></label><label for="attachment'+id+'" class="btn btn-primary">参照</label><input id="attachment'+id+'" data-is="ch'+id+'" type="file" class="ds-none" name="profile[]" accept="image/*"></div></div>';
        $("#box-file").append(text);

    });
    $(document).delegate(".ds-none","change", function() {
        var files = $(this).prop("files");
        var id_is = $(this).attr("data-is");
	    var names = $.map(files, function(val){
	        return val.name;
	    });
	    console.log(id_is);
	    $('#'+id_is).val(names[0]);
	    $('#hd'+id_is).val(names[0]);
    });


    function ramdom_number(min, max){
        return Math.floor(Math.random() * (max - min)) + min;
    }
    function get_id(){
        number_id = ramdom_number(0, 100);
        if( $('#del'+number_id).length ){
            get_id();
        }else{
            return "del"+number_id;
        }
    }

    function clickverifydocument(){
    	//var sum=0;
    	var total_file = $('input[name="profile[]"]').length;
    	console.log(total_file);
    	if($('#name').val()==""||$('#address').val()==""){
    		alert("すべての項目を正確に入力してください。");
    		return false;
    	}
    	if($('#option2').prop( "checked" )==false){
    		alert("登録アドレスが番地・部屋番号まで証明書類と一致するかを確認してください。");
    		return false;
    	}
    	if($('#year').val()==""||$('#mon').val()==""||$('#day').val()==""){
    		alert("すべての項目を正確に入力してください。");
    		return false;
    	}
    	return true;
	}
	// function init_file_update(){
	// 	var arr_file = JSON.parse('{{ $result['person_confirm']['data']->files }');
	// 	console.log(arr_file);
	// }
	// init_file_update();
</script>
@endsection