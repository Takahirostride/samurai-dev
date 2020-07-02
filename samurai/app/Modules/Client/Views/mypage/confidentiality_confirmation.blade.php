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
				@include('Client::include.sidebar-left')
			</div>
			<div class="col-sm-10 mainpage">
				<div class="row">
					<div class="col-sm-12">
						<ul class="nav nav-tabs tablinksub bordernone">
						    <li >
						        <a href="{{URL::route('client.authentication')}}">本人確認書類</a>
						    </li>
						    <li class="active">
						        <a href="{{URL::route('client.authentication.confidentiality_confirmation')}}">機密保持確認</a>
						    </li>
						    <li>
						        <a href="{{URL::route('client.authentication.secretariat_confirmation')}}">事務局確認</a>
						    </li>
						    <li>
						        <a href="{{URL::route('client.authentication.call_confirmation')}}">電話確認</a>
						    </li>
						    <li class="not-text">
						        <a id="show_manual" data-toggle="modal" data-target="#modal-certification-conf" ><img src="{{URL::to('/')}}/assets/common/images/manual.png" alt=""></a>
						    </li>
						   
						</ul><!-- end .tablinksub -->
						@if($result['user_nda']['result'] == 'success')
							<div class="row">
			                    <div class="col-sm-12">
			                    <h3>機密保持契約（NDA)</h3>
			                    </div>
			                </div>
			                <div class="row auth">
			                    <div class="col-sm-12">
			                        <div class="div-style-green">
			                            <h4 class="bold"><i class="fa fa-check"></i>機密保持契約が完了しました。</h4>
			                            <p>機密保持契約の確認を行う場合は、下記よりご覧いただけます。 また、機密保持契約に変更・更新があった場合、再度同意いただく必要があります。</p>
			                            <p class="right-link"><a href="">機密保持契約（NDA）を確認する</a></p>
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
			                                	<a href="{{URL::route('client.authentication')}}">
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
			                                	<a href="{{URL::route('client.authentication.confidentiality_confirmation')}}">
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
			                                	<a href="{{URL::route('client.authentication.secretariat_confirmation')}}">
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
			                                	<a href="{{URL::route('client.authentication.call_confirmation')}}">
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
			                    <h3>機密保持確認</h3>
			                    </div>
			                </div>
			                <div class="row">
			                    <div class="col-sm-12">
			                    <h3 class="page-title">機密保持確認<span class="font16">-機密保持確認をすると何が良いのか</span></h3>
			                    </div>
			                </div>
			                <div class="row">
			                    <div class="col-sm-12">
			                            <p class="font14">「機密保持確認」とは、会員登録時に同意頂いている「士業」下記利用規約「取引における機密保持」について、住所・氏名を表示して、改めて署名頂き、機密保全に努めていることを確認して頂くためのサービスです。</p>

			                            <p class="font14">機密保持確認を行うと、プロフィールに以下の認定マークが表示されます。機密保持確認は任意ですが、機密保持確認有無によって、会員の皆様の責任等に変わりはありません。詳しくは利用規約をご確認ください。</p>

			                            <p class="font14">機密保持確認を行うと、あなたが士業の場合、<b class="color-e56845">信頼性が向上し、選ばれやすくなります。提案される仕事の数も大きく増加します。結果、報酬が得やすくなります。</b>あなたが企業の場合も、<b <b class="color-e56845">信頼性の向上により、士業が安心して積極的に提案がされる</b>ようになり、双方にとって大きなメリットがあります。</p>
			                    </div>
			                </div>
			                <div class="row">
			                    <div class="col-sm-12">
			                    <h3 class="page-title">機密保持確認</h3>
			                    </div>
			                </div>
			                <div class="mgt-20 ds-il-bl">
			                    <div class="col-sm-12 box-blue-border2">
			                        <p class="font20 mb20">利用規約 - 機密保持に関する条項の確認</p>
			                        <p class="font20 mb20">第20条 取引における機密保持</p>
			                        <ol>
			                            <li>
			                                <p>
			                                    会員は、会員間取引又はその成立過程において、取引の相手方たる会員から機密である旨示されて開示される機密情報、タスク方式の依頼に関する一切の情報、非公開オプション又は完全非公開オプションが設定された依頼に関連する一切の情報、会員間取引遂行中に知り得た機密情報、及び、取引の相手方たる会員が保持する個人情報を、すべて機密として保持し、会員間取引の目的以外には一切使用せず、第三者に一切開示、漏えいしないものとします。
			                                </p>
			                            </li>
			                            <li>
			                                <p>
			                                    本条第1項の規定に関わらず、以下のいずれかに該当することを会員が証明したものついては、機密情報から除かれるものとします。ただし、個人情報については第6号のみが適用されるものとします。
			                                </p>
			                                <ol>
			                                    <li>
			                                        <p>
			                                            既に公知、公用の情報
			                                        </p>
			                                    </li>
			                                    <li>
			                                        <p>
			                                            機密情報の開示後に、会員の責によらず公知、公用となった情報
			                                        </p>
			                                    </li>
			                                    <li>
			                                        <p>
			                                            開示を受けた時点で、既に知得していた情報
			                                        </p>
			                                    </li>
			                                    <li>
			                                        <p>
			                                            開示を受けた後、正当な権限を有する第三者から守秘義務を負うことなしに適法に入手した情報
			                                        </p>
			                                    </li>
			                                    <li>
			                                        <p>
			                                            開示者が、第三者に開示することを文書により承諾した情報
			                                        </p>
			                                    </li>
			                                    <li>
			                                        <p>
			                                            法令又は確定判決等により義務付けられた情報
			                                        </p>
			                                    </li>
			                                </ol>
			                            </li>
			                            <li>
			                                <p>
			                                    会員が、機密情報を利用するにあたっては、開示目的を達成するに最小限必要な従業員に限定して開示するものとします。この場合、会員は従業員が機密情報を漏洩もしくは開示目的以外に利用しないよう、監督その他の必要な措置を講ずる義務を負う。
			                                </p>
			                            </li>
			                            <li>
			                                <p>
			                                    会員は、機密情報を極秘にして扱い、全て合理的な安全管理体制及び漏洩防止手段を講じる義務を負うものとします。
			                                </p>
			                            </li>
			                            <li>
			                                <p>
			                                    会員は、会員間取引を開始する前に、必要に応じ、別途機密保持契約を締結し、相互の機密保持に努めるものとします。この別途機密保持契約の締結の有無にかかわらず、本サイト上、本条に同意することを表示した会員間では、会員間取引に関し、相互に本条に定める機密保持義務を負うものとします。
			                                </p>
			                            </li>
			                            <li>
			                                <p>
			                                    弊社は、会員間取引における機密保持につき、何らこれを保証するものではなく、何らの責任を負わないものとします。
			                                </p>
			                            </li>
			                        </ol>
			                        <p class="text-right"><b>(会員の住所です)</b></p>
			                        <p>表示会員：<t>thang</t><b>（会員の会社名です。会社名がない場合は個人名です）</b></p>
			                        <p class="text-center">機密保持事項（リンク） に表示会員として改めて同意する</p>
			                        <div class="row text-center mb20">
			                        	<form method="post" action="confidentiality_confirmation">
			                        		{{ csrf_field() }}
			                            	<input type="submit" name="submit" value="機密保持に同意する" class="btn btn-style-shadow-green btn-success">
			                            </form>
			                        </div>
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