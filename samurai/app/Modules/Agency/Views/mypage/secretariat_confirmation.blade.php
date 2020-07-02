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
						    <li >
						        <a href="{{URL::route('agency.authentication')}}">本人確認書類</a>
						    </li>
						    <li >
						        <a href="{{URL::route('agency.authentication.confidentiality_confirmation')}}">機密保持確認</a>
						    </li>
						    <li class="active">
						        <a href="{{URL::route('agency.authentication.secretariat_confirmation')}}">事務局確認</a>
						    </li>
						    <li>
						        <a href="{{URL::route('agency.authentication.call_confirmation')}}">電話確認</a>
						    </li>
						    <li class="not-text">
						        <a id="show_manual" data-toggle="modal" data-target="#modal-certification-conf" ><img src="{{URL::to('/')}}/assets/common/images/manual.png" alt=""></a>
						    </li>
						   
						</ul><!-- end .tablinksub -->
						@if($result['user_check']['result'] == 'success')
							<div class="row">
			                    <div class="col-sm-12">
			                    <h3>SAMURAIチェック</h3>
			                    </div>
			                </div>
			                <div class="row auth">
			                    <div class="col-sm-12">
			                        <div class="div-style-green">
			                            <h4 class="bold"><i class="fa fa-check"></i>SAMURAIチェックが完了しました。</h4>
			                            <p>SAMURAIチェックの項目がグリーンになっている方は、引き続き当サイトをご利用ください。 SAMURAIチェックの項目がグレーのままになっている方は、SAMURAI利用のための体制を整え、再度SAMURAIチェックをお受けください</p>
			                            <p class="right-link"><a href="">再度SAMURAIチェックを受ける</a></p>
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
			                                    <div class="box-au-icon ">
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
			            		<form method="post" action="secretariat_confirmation" >
			            		<div class="row">
				                    <div class="col-sm-12">
				                    <h3>SAMURAIチェック</h3>
				                    </div>
				                </div>
				                <div class="row hide_option" id="op0">
				                    <div class="col-sm-12">
				                        <p>
				                            SAMURAIチェックでは、利用者の皆様に、業務を依頼、請負ために必要な環境が整っているか、また、利用規約および各種法令に遵守していただいてい<br>るかを、再度、確認させていただいております。<br>
				                            質問に「はい」「いいえ」でお答えいただくもので、1分程度で完了します。<br>
				                            SAMURAIチェックを確認いただくことで、より多くの士業・事業者の方から提案や依頼を受けることができます。

				                        </p>
				                        
				                    </div>
				                    <div class="col-sm-12 text-center mgt-20">
				                        <a href="#" class="btn-primary btn btn-style-shadow-green btn-success op_click1" data-click="op1">はじめる</a>
				                    </div>
				                </div>
				                <div class="col-sm-12 box-auth-radio hide_option" id="op1">
				                    <p>１、作業をするパソコンは、ウィルス対策が行なわれていますか？</p>
				                    <p class="pdl-20"><label><input type="radio" value="0" name="option1">はい</label></p>
				                    <p class="pdl-20"><label><input type="radio" value="1" name="option1">いいえ</label></p>
				                    <p class="text-center mgt-20 mb20"><a href="#" class="btn-primary btn btn-style-shadow-green btn-success op_click" data-click="op2" data-note="option1">次へ</a></p>
				                </div>
				                <div class="col-sm-12 box-auth-radio hide_option" id="op2">
				                    <p>２、作業をするパソコンは、パスワード設定など個人情報の管理が適切に行われていますか？</p>
				                    <p class="pdl-20"><label><input type="radio" value="0" name="option2">はい</label></p>
				                    <p class="pdl-20"><label><input type="radio" value="1" name="option2">いいえ</label></p>
				                    <p class="text-center mgt-20 mb20"><a href="#" class="btn-primary btn btn-style-shadow-green btn-success op_click" data-click="op3" data-note="option2">次へ</a></p>
				                </div>
				                <div class="col-sm-12 box-auth-radio hide_option" id="op3">
				                    <p>3、法律及び関係諸法令等を遵守し、業務を行っていますか？</p>
				                    <p class="pdl-20"><label><input type="radio" value="0" name="option3">はい</label></p>
				                    <p class="pdl-20"><label><input type="radio" value="1" name="option3">いいえ</label></p>
				                    <p class="text-center mgt-20 mb20"><a href="#" class="btn-primary btn btn-style-shadow-green btn-success op_click" data-click="op4" data-note="option3">次へ</a></p>
				                </div>
				                <div class="col-sm-12 box-auth-radio hide_option" id="op4">
				                    <p>4、業務を遂行する体制は整っていますか？</p>
				                    <p class="pdl-20"><label><input type="radio"  value="0" name="option4">はい</label></p>
				                    <p class="pdl-20"><label><input type="radio" value="1" name="option4">いいえ</label></p>
				                    <p class="text-center mgt-20 mb20"><a href="#" class="btn-primary btn btn-style-shadow-green btn-success op_click" data-click="op5" data-note="option4">次へ</a></p>
				                </div>
				                <div class="col-sm-12 box-auth-radio hide_option" id="op5">
				                    <p>5、SAMURAIに登録いただいた、各種情報に虚偽の記載はありませんか？</p>
				                    <p class="pdl-20"><label><input type="radio" value="0" name="option5">はい</label></p>
				                    <p class="pdl-20"><label><input type="radio" value="1" name="option5">いいえ</label></p>
				                    <p class="text-center mgt-20 mb20"><a href="#" class="btn-primary btn btn-style-shadow-green btn-success op_click" data-click="op6" data-note="option5">次へ</a></p>
				                </div>
				                <div class="col-sm-12 box-auth-radio hide_option" id="op6">
				                    <p>6、SAMURAIの利用規約や各種ルールを理解していますか？</p>
				                    <p class="pdl-20"><label><input type="radio" value="0" name="option6">はい</label></p>
				                    <p class="pdl-20"><label><input type="radio" value="1" name="option6">いいえ</label></p>
				                    <p class="text-center mgt-20 mb20">
				                    	
				                    	{{ csrf_field() }}
				                    	<input type="submit" name="submit" class="btn-primary btn btn-style-shadow-green btn-success" onclick="return check_radio_submit()" value="次へ" >
				                    	
				                    </p>
				                </div>
				                </form>
			               	
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
.hide_option{
	display: none;
}
#op0{
	display: block;
}
</style>
@endsection
@section('script')
	<script type="text/javascript">
		$('.op_click').on('click', function(){
			var show = $(this).attr('data-click');
			var check = $(this).attr('data-note');
			if($('input:radio[name="'+check+'"]').is(':checked')){
				$('.hide_option').hide();
				$('#'+show).show();
			}else{
				 alert('正確に答えてください。');
			}
			
		})
		$('.op_click1').on('click', function(){
			var show = $(this).attr('data-click');
			$('.hide_option').hide();
			$('#'+show).show();
			
		})
		function check_radio_submit(){
			if($('input:radio[name="option6"]').is(':checked')&& 
			   $('input:radio[name="option5"]').is(':checked')&&
			   $('input:radio[name="option4"]').is(':checked')&& 
			   $('input:radio[name="option3"]').is(':checked')&& 
			   $('input:radio[name="option2"]').is(':checked') && 
			   $('input:radio[name="option1"]').is(':checked')){
				return true
			}else{
				 alert('正確に答えてください。');
				 return false;
			}
			
		}
	</script>
@endsection