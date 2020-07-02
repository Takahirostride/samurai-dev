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
								<li><a title="マイページトップ" href="{{URL::route('client.home')}}"><i class="fa fa-home"></i></a></li>
								<li><a title="プロフィール管理" href="{{URL::route('client.profile')}}"><i class="fa fa-id-card"></i></a></li>
								<li><a title="会員情報管理" href="{{URL::route('client.memberinfo')}}"><i class="fa fa-cog"></i></a></li>
								<li><a title="仕事管理" href="{{URL::route('client.recruitment')}}"><i class="fa fa-tasks"></i></a></li>
								<li><a title="お気に入り" href="{{URL::route('client.checklist')}}"><i class="fa fa-star-o"></i></a></li>
								<li><a title="各種認証管理" href="{{URL::route('client.authentication')}}"><i class="fa fa-check-square-o"></i></a></li>
								<li><a title="支払い管理" href="{{URL::route('client.payment')}}"><i class="fa fa-money"></i></a></li>
								<li><a title="アフィリエイト管理" href="{{URL::route('client.affiliate')}}"><i class="fa fa-group"></i></a></li>
							</ul>
						</div>
						<div class="dleft-list-user">
							@include('Client::include.dleft-user-list')
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
							@include('Client::include.dnavbar')
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
										@include('Client::mypage.recruit.received.policyitem')
									@else
										@include('Client::mypage.recruit.received.jobitem')
									@endif
									</div> <!-- end .dpleft -->
									
								</div> <!-- end .dpolicy-item -->
								
							</div> <!-- end .dpolicy-item-list -->
							<h4>仕業から来た提案</h4>
							<table class="table table-date-policy table-bordered">
								<tbody>
									<tr>
										<td class="left-padding-job">
											<span>予定納期 ： <span class="big-text">{{ddate_string($selectedHire->deli_date)}}</span></span>
										</td>
										<td class="text-center">
											<button data-toggle="modal" data-target="#cancelMatching" type="button" class="btn btn-danger btn-samurai big-button">提案を却下する</button>
										</td>
									</tr>
									<tr>
										<td class="left-padding-job">
											<span>着手金支払い金額 ： <span id="total1_span" class="big-text">{{$selectedHire->deposit_money_format()}} 円</span>+税 </span>
										</td>
										<td rowspan="2" class="button-middle">
											<button data-toggle="modal" data-target="#matchingStep1" type="button" class="btn btn-success btn-samurai big-button">発注する</button>
										</td>
									</tr>
									<tr>
										<td class="left-padding-job">
											<span>後払い金額 ： <span class="big-text"><span id="total2_span">{{$selectedHire->hire_price_2_format()}}</span> 円</span>+税 </span>
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



<div class="modal fade" id="matchingStep1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<p class="modal-title text-center">提案されている金額で仕事の依頼をしますか？</p>
				<table class="table table-date-policy table-bordered">
					<tbody>
						<tr>
							<td width="30%">予定納期</td>
							<td>
								<span class="big-text">{{date('Y年m月d日', strtotime($selectedHire->deli_date() ) )}}</span>
							</td>
						</tr>
						<tr>
							<td>着手金支払い金額</td>
							<td><span class="big-text">{{$selectedHire->deposit_money_format()}} 円</span>+税 </span></td>
						</tr>
						<tr>
							<td>後払い金額</td>
							<td><span class="big-text">{{$selectedHire->hire_price_2_format()}} 円</span>+税 </span></td>
						</tr>
					</tbody>
				</table>
				<div class="text-center">
					
				<button type="button" data-dismiss="modal" class="btn btn-samurai btn-default">閉じる</button>
				<button type="button" id="com_step_2" class="btn btn-samurai btn-warning">この内容で仕事依頼する</button>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="modal com-modal fade" id="matchingStep2">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<div class="com-list">
					<p class="com-head">仕事の発注が完了いたしました。</p>
					<p class="com-p">仕事管理から提案者とSAMURAI内チャットでコンタクトを取ることができます。<br>SAMURAIでは直接のやりとりを禁止しております。予めご了承ください</p>
					<p class="com-p">下記の仕事管理画面から見積もりの状況が確認できます。</p>
					<button type="button" class="btn btn-success btn-samurai com_step_2_btn">進んでいる案件を見る</button>
				</div>
				<div class="text-center">
					<button type="button" data-dismiss="modal" class="btn btn-samurai btn-lg btn-default com_step_2_btn">閉じる</button>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="cancelMatching">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<p class="modal-title text-center">提案されている案件を却下しますか？</p>
				<table class="table table-date-policy table-bordered">
					<tbody>
						<tr>
							<td width="30%">予定納期</td>
							<td>
								<span class="big-text">{{date('Y年m月d日', strtotime($selectedHire->deli_date() ) )}}</span>
							</td>
						</tr>
						<tr>
							<td>着手金支払い金額</td>
							<td><span class="big-text">{{$selectedHire->deposit_money_format()}} 円</span>+税 </span></td>
						</tr>
						<tr>
							<td>後払い金額</td>
							<td><span class="big-text">{{$selectedHire->hire_price_2_format()}} 円</span>+税 </span></td>
						</tr>
					</tbody>
				</table>
				<div class="text-center">
					
				<button type="button" data-dismiss="modal" class="btn btn-samurai btn-default">閉じる</button>
				<button type="button" id="can_step_2" class="btn btn-samurai btn-warning">この提案を却下する</button>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="modal com-modal fade" id="cancelMatching2">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<div class="com-list">
					<p class="com-head">提案されている案件を却下しました。</p>
					<p class="com-p">仕事管理から提案者とSAMURAI内チャットでコンタクトを取ることができます。<br>SAMURAIでは直接のやりとりを禁止しております。予めご了承ください</p>
					<p class="com-p">下記の仕事管理画面から見積もりの状況が確認できます。</p>
					<button type="button" class="btn btn-success btn-samurai can_step_2_btn">却下した案件を見る</button>
				</div>
				<div class="text-center">
					<button type="button" data-dismiss="modal" class="btn btn-samurai btn-lg btn-default can_step_2_btn">閉じる</button>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal com-modal fade" id="estimateModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<div class="com-list">
					<p class="com-head">見積もりの提案が来ました。</p>
					<p class="com-p">仕事管理からSAMURAI内チャットでコンタクトを取ることができます。<br>SAMURAIではとの直接のやりとりを禁止しております。予めご了承ください</p>
					<p class="com-p">下記の仕事管理画面から状況の確認できます。</p>
				</div>
				<div class="text-center">
					<button type="button" data-dismiss="modal" class="btn btn-samurai btn-lg btn-success">見積もりを確認する</button>
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
		var isShow = {{ ( $selectedHire->to_id==session('user_id')?$selectedHire->estimate_notify_to:$selectedHire->estimate_notify_from ) }};
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
		var requestAjax = '/client/mypage/recruitment/requested-ajax';

		var messageAjax = '/client/mypage/jobs/matching-case/message-ajax';

		var taskViewAjax = '/client/mypage/jobs/matching-case/task-view-ajax';
		var setTaskAjax = '/client/mypage/jobs/matching-case/set_task-ajax';

		var matchingAjax = '/client/mypage/recruitment/matching-ajax';
		var cancelAjax = '/client/mypage/recruitment/cancelmatching-ajax';

		
	</script>
	{{HTML::script('assets/client/js/requested.js')}}
	{{HTML::script('assets/common/js/recruit_chat.js')}}
	{{HTML::script('assets/common/js/new_task.js')}}
	{{HTML::script('assets/common/js/send_message.js')}}
@endsection
