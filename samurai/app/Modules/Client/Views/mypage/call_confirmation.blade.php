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
						    <li >
						        <a href="{{URL::route('client.authentication.confidentiality_confirmation')}}">機密保持確認</a>
						    </li>
						    <li>
						        <a href="{{URL::route('client.authentication.secretariat_confirmation')}}">事務局確認</a>
						    </li>
						    <li class="active">
						        <a href="{{URL::route('client.authentication.call_confirmation')}}">電話確認</a>
						    </li>
						    <li class="not-text">
						        <a id="show_manual" data-toggle="modal" data-target="#modal-certification-conf" ><img src="{{URL::to('/')}}/assets/common/images/manual.png" alt=""></a>
						    </li>
						   
						</ul><!-- end .tablinksub -->
						@if($result['user_phone']['result'] == 'success')
							<div class="row">
			                    <div class="col-sm-12">
			                    <h3>電話確認</h3>
			                    </div>
			                </div>
			                <div class="row auth">
			                    <div class="col-sm-12">
			                        <div class="div-style-green">
			                            <h4 class="bold"><i class="fa fa-check"></i>電話確認が完了しました。</h4>
			                            <p>SAMURAI事業部による電話確認が完了した場合、グリーンになります。完了までしばらくお待ちください。</p>
			                            
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
			            <div class="row">
		                    <div class="col-sm-12">
		                    <h3>事務局確認</h3>
		                    
		                    </div>
		                </div>
		                <div class="row">
		                    <div class="col-sm-12">
		                    <h3 class="page-title">電話確認とは</h3>
		                    </div>
		                </div>
		                <div class="row">
		                    <div class="col-sm-12">
		                        <p>
		                            電話番号の確認が取れているユーザとして、アイコンが付与されます。電話確認は、クライアント・ランサー双方共に信頼度が大きく向上します。
		                            電話確認が完了している士業のみが、完全非公開案件の閲覧が可能となります。
		                        </p>
		                        <h3 class="page-title">電話確認の流れ</h3>
		                        <div class="step-1">
		                            <div class="col-sm-3"><p class="step-tit">申請</p><p class="step-text">ページ下の申請フォームにて、ご担当者様のsmsが受信可能な「電話番号」を入力し、申請してください。</p></div>
		                            <div class="col-sm-3"><p class="step-tit">電話確認</p><p class="step-text">申請後に、smsに認証番号が通知されます。その番号を下記の認証番号入力欄に記入し、認証ボタンをおしてください。</p></div>
		                            <div class="col-sm-3"><p class="step-tit">完了</p><p class="step-text">認証番号に問題がない場合は、認証が完了し、電話確認が完了されます。</p></div>
		                        </div>
		                        <form method="post" action="call_confirmation">
		                        	{{ csrf_field() }}
		                            <h3 class="page-title">電話確認申請</h3>
		                            <div class="box-br-blue">
		                                <h5 class="text-primary font15">SMSを受信可能な電話番号を入力してください。</h5>
		                                <p>入力された電話番号にsamuraiより認証番号を送信いたします。固定電話などSMSを受信できない番号はご利用いただけません。
		                                    ※電話番号の入力は、お間違いがないか、再度ご確認いただきますようよろしくお願いいたします。</p>
		                            </div>
		                            <div class="row mgt-20 mb20">
		                                <div class="col-sm-2 text-center"><p>電話番号</p></div>
		                                <div class="col-sm-10"><input type="text" name="to" class="form-control"></div>
		                                <div class="col-sm-12 text-center mgt-20">
		                                    <input type="submit" name="submit" class="btn-primary btn btn-style-shadow-green btn-success" value="申請する">
		                                </div>
		                            </div>
		                         </form>
		                         <form method="post" action="call_confirmation">
		                         	{{ csrf_field() }}
		                            <h3 class="page-title">認証番号入力</h3>
		                            <div class="box-br-blue">
		                                <h5 class="text-primary font15">受信したSMSに記載されている認証番号を入力してください。</h5>
		                                <p>SMSに記載されている番号を、下記フォームに正確に入力の上、「認証する」ボタンをクリックしてください。
		                                    認証ボタンを押すと、電話確認が完了いたします。</p>
		                            </div>
		                            <div class="row mgt-20 mb20 ">
		                                <div class="col-sm-2 text-center"><p>認証番号</p></div>
		                                <div class="col-sm-10"><input type="text" name="phone" class="form-control"></div>
		                                <div class="col-sm-12 text-center mgt-20">
		                                    <input type="submit" name="submit" class="btn-primary btn btn-style-shadow-green btn-success" value="認証する">
		                                </div>
		                            </div>
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
	@if(isset($update))
	<script type="text/javascript">
		window.onload = innit;
    	function innit(){
    		alert('入力された電話番号にSMSが送信されました。ご確認の上、認証番号を入力ください。');
    	}
	</script>
	@endif
	@if(isset($update2))
	<script type="text/javascript">
		window.onload = innit;
		function innit(){
    	alert('認証に失敗しました。申し訳ありませんが、コードを再確認してお試しください。');
    	}
	</script>
	@endif
@endsection