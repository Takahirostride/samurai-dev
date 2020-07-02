@extends('layouts.home')

@section('style')
	{{HTML::style('assets/common/plugins/datepicker/css/bootstrap-datepicker3.min.css')}}
	{{HTML::style('assets/common/css/recruit_chat.css')}}
@endsection
@section('content')
<div class="mainpage chat-page-area">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<ol class="breadcrumb">
					<li><a class="bg-color" href="#">TOPページ</a></li>
					<li class="active">仕事管理</li>
				</ol>	
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">仕事管理</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 mainpage chat-page">
				<div class="row">
					<div class="col-sm-3">
						<div class="diconleft">
							<ul class="diconleft-ul">
								<li><a title="マイページトップ" href="{{URL::route('agency.home')}}"><i class="fa fa-home"></i></a></li>
								<li><a title="プロフィール管理" href="{{URL::route('agency.profile')}}"><i class="fa fa-id-card"></i></a></li>
								<li><a title="会員情報管理" href="{{URL::route('agency.memberinfo')}}"><i class="fa fa-cog"></i></a></li>
								<li><a title="仕事管理" href="{{URL::route('agency.recruitment')}}"><i class="fa fa-tasks"></i></a></li>
								<li><a title="お気に入り" href="{{URL::route('agency.checklist')}}"><i class="fa fa-star-o"></i></a></li>
								<li><a title="各種認証管理" href="{{URL::route('agency.authentication')}}"><i class="fa fa-check-square-o"></i></a></li>
								<li><a title="支払い管理" href="{{URL::route('agency.payment')}}"><i class="fa fa-money"></i></a></li>
								<li><a title="アフィリエイト管理" href="{{URL::route('agency.affiliate')}}"><i class="fa fa-group"></i></a></li>
							</ul>
						</div>
						<div class="dleft-list-user">
							@include('Agency::mypage.recruit.include.dleft-user-list')
							@if ($selectedHire->from_id == session('user_id'))
								@php
									$shiff_user = $selectedHire->to;
								@endphp
							@else
								@php
									$shiff_user = $selectedHire->from;
								@endphp
							@endif
						</div> <!-- end .dleft-list-user -->
					</div> <!-- end .col-sm-3 -->
					<div class="col-sm-9">
						<div class="detail-hire">
							@include('Agency::includes.dnavbar')
							<div class="djob-info">
								<p>案件名：{{$selectedHire->hire_title()}}</p>
								<p>士業名：{{$shiff_user->displayname}} </p>
								<button class="btn btn-primary dcollapse-btn" type="button" data-target="collapse1">
								  <i class="fa fa-chevron-down"></i>
								</button>
							</div>
							<div class="dcollapse" id="collapse1">
							<div class="dpolicy-item-list">
								<div class="dpolicy-item">
									@if($selectedHire->hire_type == 1)
										@include('Agency::mypage.recruit.requested.policyitem')
									@else
										@include('Agency::mypage.recruit.requested.jobitem')
									@endif
									
								</div> <!-- end .dpolicy-item -->
								
							</div> <!-- end .dpolicy-item-list -->
							<h4>予算と納期</h4>
							<table class="table table-date-policy table-bordered">
								<tbody>
									<tr>
										<td class="left-padding-job">
											<span>予定納期 ： <span id="deli_date_span" class="text-big">{{ddate_string($selectedHire->deli_date)}}</span></span>
											<button data-toggle="modal" data-target="#changeForm" type="button" class="btn btn-success btn-samurai pull-right big-button">納期を修正する</button>
										</td>

									</tr>
									<tr>
										<td class="left-padding-job">
											<span>着手金 ： <span id="total1_span" class="text-big">{{$selectedHire->deposit_money()}}</span> 円 </span>
										</td>
									</tr>
									<tr>
										<td class="left-padding-job">
											<span>後払い報酬金額 ： <span id="total1_span" class="text-big">{{$selectedHire->agency_estimate()}}</span> 円 </span>
											<button data-toggle="modal" data-target="#cancelForm" type="button" class="btn btn-danger btn-samurai pull-right big-button">キャンセルする</button>
										</td>
									</tr>
									<tr>
										<td class="left-padding-job">
											<span>クライアント支払金額 ： <span id="total2_span" class="text-big">{{$selectedHire->client_pay()}}</span> 円+税</span>
											<button data-toggle="modal" data-target="#matchingForm" type="button" class="btn btn-primary btn-samurai pull-right big-button">この内容で受託する</button>
										</td>
									</tr>
								</tbody>
							</table>
							</div>
							
							<div class="ddetail-msg dmessage-list">
								<ul id="dmsg-result">
									@foreach($messageList as $key=>$msg)
									<li style="width:100%">
										<div class="@if($msg->from_id==session('user_id')) msj-rta @else msj @endif macro">
											<div class="avatar">
												<img class="img-circle" src="{{URL::to($msg->chat_with_user->image)}}">
												<span>{{$msg->chat_with_user->user_name()}}</span>
											</div>
											<div class="text text-l">
												<p>{{$msg->message}}</p>
												@if($msg->file)
												<p class="msg-files">
												@foreach(json_decode($msg->file) as $file)
													<a target="_blank" href="{{URL::route('agency.jobs.matching.download-file', [$file[1], $file[0]] )}}">{{$file[0]}}</a>
												@endforeach
												</p>
												@endif
												<p><small>{{ol_get_datetime_string($msg->created_at)}}</small></p>
											</div>
										</div>
									</li>
									
									@endforeach
								</ul>
								<div class="bottom-input-msg">
								{{Form::open(['method'=>'POST', 'id'=>'sendmsg-form'])}}
									<div class="msg-input">
										<textarea class="form-control mytext" name="message" id="submit-msg" cols="30" rows="3"></textarea>
					                </div>
					                <input type="hidden" name="hire_id" value="{{$hire_id}}">
					                <div class="input-msg-area">
					                    <span class="glyphicon glyphicon-share-alt"></span>
					                </div>
					                <div class="clearfix"></div>
					                <div class="file-sl">
                                    	<label for="files"> <span for="files" class="glyphicon glyphicon-paperclip"></span></label>
                                    	<input class="sr-only" type="file" multiple="multiple" name="file[]" id="files">
                                    	<div id="file-select-list">
                                    	</div>
                                    </div>
                                {{Form::close()}}
								</div>
							</div>
						</div> <!-- end .detail-hire -->
					</div> <!-- end col-sm-9 -->
				</div>	<!-- end .row -->
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="changeForm">
	<div class="modal-dialog">
		<div class="modal-content">
		<div id="modal_step1">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title text-center">納期と金額を提案する</h4>
			</div>
			<div class="modal-body">
				
					{{Form::open(['method'=>'POST', 'class'=>'form-horizontal'])}}
					<input type="hidden" name="hire_id" id="hire_id" value="{{$selectedHire->id}}">
					<table class="table table-bordered">
						<tbody>
							<tr>
								<td class="tdhead" rowspan="3" width="80">見積内容</td>
								<td class="row">
									<div class="form-group">
										<label for="input" class="col-sm-3 control-label">納期:</label>
										<div class="col-sm-7">
											<input type="text" name="deli_date" id="deli_date" class="form-control datepicker" value="{{date('Y年m月d日', strtotime($selectedHire->deli_date() ) )}}" required="required">
										</div>
									</div>
									<div class="form-group">
										<label for="input" class="col-sm-3 control-label">着手金:</label>
										<div class="col-sm-6">
											<input type="number" min="0" name="deposit_money" id="deposit_money" class="form-control" value="{{$selectedHire->deposit_money}}" placeholder="金額を記入してください" required="required">
										</div>
										<div class="col-sm-1 units"><span class="">円</span></div>
										<div class="col-sm-9 col-sm-offset-3"><span class="noti-text">※着手金が必要な場合のみご記入ください。</span></div>
									</div>
									<div class="form-group">
										<label for="input" class="col-sm-3 control-label">報酬金額:</label>
										<div class="col-sm-6">
											<input type="number" min="0" name="agency_estimate" id="agency_estimate" class="form-control" value="{{$selectedHire->agency_estimate}}" placeholder="報酬金額を記入してください" required="required">
										</div>
										<div class="col-sm-1 units"><span class="">円</span></div>
										<div class="col-sm-9 col-sm-offset-3"><span class="noti-text">※報酬金額が必要な場合のみご記入ください。</span></div>
									</div>
								</td>
							</tr>
							<tr>
								<td class="text-center totalbg" colspan="2">報酬金額 : <span id="total1">0</span> 円</td>
							</tr>
							<tr>
								<td class="text-center totalbg" colspan="2">クライアント支払金額 : <span id="total2">0</span> 円　+　税</td>
							</tr>
						</tbody>
					</table>
					{{Form::close()}}
				
			</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn btn-samurai btn-default">戻る</button>
				<button type="button" id="go_to_step2" class="btn btn-samurai btn-warning">内容を確認する</button>
			</div>
		</div> <!-- end modal-step 1 -->
		<div id="modal_step2" class="hide">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title text-center">納期と金額を修正して提案する</h4>
			</div>
			<div class="modal-body">
				
					{{Form::open(['method'=>'POST', 'class'=>'form-horizontal'])}}
					<table class="table table-bordered">
						<tbody>
							<tr>
								<td class="tdhead" rowspan="3" width="80">見積内容</td>
								<td class="row">
									<div class="form-group">
										<label for="input" class="col-sm-6 control-label">納期:</label>
										<div class="col-sm-6">
											<span id="deli_date_step_2"></span>
										</div>
									</div>
									<div class="form-group">
										<label for="input" class="col-sm-6 control-label">着手金:</label>
										<div class="col-sm-6">
											<span id="deposit_money_step_2"></span> 円
										</div>
									</div>
									<div class="form-group">
										<label for="input" class="col-sm-6 control-label">報酬金額:</label>
										<div class="col-sm-6">
											<span id="agency_estimate_step_2"></span> 円
										</div>
									</div>
									<div class="form-group">
										<label for="input" class="col-sm-6 control-label">クライアント支払金額:</label>
										<div class="col-sm-6">
											<span id="client_pay_step_2"></span> 円
										</div>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
					{{Form::close()}}
				
			</div>
			<div class="modal-footer">
				<button type="button" id="go_to_step1" class="btn btn-samurai btn-default">修正する</button>
				<button type="button" id="submitForm" class="btn btn-samurai btn-warning">この内容で提案する</button>
			</div>
		</div>
		<div id="modal_step3" class="hide">
			<div class="modal-body">
				
					<h3 class="text-center">見積もり金額の提案を行いました。</h3>
					<p class="text-center">
						仕事管理から事業者とSAMURAI内チャットでコンタクトを取ることができます。<br>
SAMURAIでは事業者との直接のやりとりを禁止しております。予めご了承ください<br>
着手金がある場合の支払いが完了するまで、事業者は仕事管理の内容を見ることができません。
					</p>
			</div>
			<div class="modal-footer">
				<button type="button" onclick="window.location.reload();" data-dismiss="modal" class="btn btn-samurai btn-default">閉じる</button>
				<button type="button" onclick="window.location.reload();" data-dismiss="modal" class="btn btn-samurai btn-warning">仕事管理を見る</button>
			</div>
		</div>
		</div> <!-- end .modal content -->
	</div>
</div>


<div class="modal fade" id="cancelForm">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body text-center">
				<h4 style="margin-bottom: 30px;">本当に依頼をキャンセルしますか？</h4>
				<button type="button" onclick="window.location.reload();" data-dismiss="modal" class="btn btn-samurai btn-default">閉じる</button>
				<button type="button" id="cancelButton" class="btn btn-samurai btn-danger">キャセルする</button>
			</div>
		</div>
	</div>
</div>

<div class="modal com-modal fade" id="cancelForm2">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<div class="com-list">
					<p class="com-head">案件をキャンセルいたしました。</p>
					<p class="com-p">評価を頂きましてありがとうございました。</p>
					<p class="com-p">案件をキャンセルしました。キャンセルした案件を見る</p>
				</div>
				<div class="text-center">
					<button type="button" data-dismiss="modal" class="btn btn-samurai btn-lg btn-default cancel2_modal_btn">閉じる</button>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="matchingForm">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<h3 class="text-center">納期と金額を修正して提案する</h3>
				<table class="table table-bordered">
					<tbody>
						<tr>
							<td>予定納期</td>
							<td><span class="text-big">{{ ddate_string($selectedHire->deli_date() ) }}</span></td>
						</tr>
						<tr>
							<td>着手金報酬金額</td>
							<td><span class="text-big">{{ $selectedHire->deposit_money() }} </span>円+税</td>
						</tr>
						<tr>
							<td>予定納期</td>
							<td><span class="text-big">{{ $selectedHire->agency_estimate() }} </span>円+税</td>
						</tr>
						<tr>
							<td>予定納期</td>
							<td><span class="text-big">{{ $selectedHire->client_pay() }} </span>円+税</td>
						</tr>
					</tbody>
				</table>
				<p class="text-right">※SAMURAIシステム利用料が含まれています。</p>
				<div class="text-center">
					<button type="button" data-dismiss="modal" class="btn btn-samurai btn-default">修正する</button>
					<button type="button" id="matching_step_2" class="btn btn-samurai btn-warning">この内容で受託する</button>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal com-modal fade" id="matchingForm2">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<div class="com-list">
					<p class="com-head">おめでとうございます！</p>
					<p class="com-head">仕事のマッチングが成立しました。</p>
					<p class="com-head">　事業者とやりとりをしましょう！</p>
					<p class="com-p">仕事管理から事業者とSAMURAI内チャットでコンタクトを取ることができます。<br>SAMURAIでは事業者との直接のやりとりを禁止しております。予めご了承ください</p>
					<p class="com-p">受託した案件を見る</p>
				</div>
				<div class="text-center">
					<button type="button" data-dismiss="modal" class="btn btn-samurai btn-lg btn-default matching_modal_btn">閉じる</button>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('script')
	{{HTML::script('assets/common/plugins/datepicker/js/bootstrap-datepicker.min.js')}}
	{{HTML::script('assets/common/plugins/datepicker/locales/bootstrap-datepicker.ja.min.js')}}
	<script>
		var base_url = '{{URL::to('/')}}';
		var tfile;
		var hireId = {{$hire_id}};
		var me = {};
		me.avatar = '{{URL::to($user->image)}}';
		me.name = '{{$user->user_name()}}';

		var you = {};
		you.avatar = '{{URL::to($shiff_user->image)}}';
		you.name = '{{$shiff_user->user_name()}}';
		$('.datepicker').datepicker({
		    format: 'yyyy年mm月dd日',
		    autoclose: true,
		    todayHighlight: true,
		    language: 'ja-JP',
		    startDate: 'today'
		});
		var sitefee = 5.5;
		var total1;
		var total2;

		var requestAjax = '/agency/mypage/recruitment/requested-ajax';

		var messageAjax = '/agency/mypage/jobs/matching-case/message-ajax';

		var taskViewAjax = '/agency/mypage/jobs/matching-case/task-view-ajax';
		var setTaskAjax = '/agency/mypage/jobs/matching-case/set_task-ajax';

		var cancelAjax = '/agency/mypage/recruitment/requested/cancel-ajax';

		var finishUrl = '/agency/mypage/recruitment/finished/';

		var matchingUrl = '/agency/mypage/recruitment/requested/matching-submit';

		var recruitLink = '/agency/mypage/recruitment/';

		
	</script>
	
	{{HTML::script('assets/agency/js/requested.js')}}
	{{HTML::script('assets/common/js/recruit_chat.js')}}
	{{HTML::script('assets/common/js/new_task.js')}}
	{{HTML::script('assets/common/js/send_message.js')}}
@endsection
