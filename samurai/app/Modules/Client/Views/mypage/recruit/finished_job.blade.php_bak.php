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
				@include('partials.user.notifications')
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
							@foreach($recruitList as $key=>$recruit)
							<div class="dleft-item @if($recruit->id == request()->hire_id)active @endif">
								<a href="{{URL::route(Route::currentRouteName(), [$recruit->id] )}}"></a>
								<div class="dleft-avatar">
									<img src="{{URL::to($recruit->user->image)}}" alt="">
								</div>
								<div class="dleft-uinfo">
									<p class="dleft-uname">{{$recruit->user->user_name()}}</p>
									<p class="dleft-pname">案件名：{{$recruit->hire_title()}}</p>
									<p class="dleft-price">提案額：{{$recruit->deposit_money_format() . ' 円'}}</p>
								</div>
							</div> <!-- end .dleft-item -->
							@endforeach
						</div> <!-- end .dleft-list-user -->
					</div> <!-- end .col-sm-3 -->
					<div class="col-sm-9">
						<div class="detail-hire">
							@include('Client::include.dnavbar')
							<div class="djob-info">
								<p>案件名：{{$selectedHire->hire_title()}}</p>
								<p>士業名：{{$selectedHire->user->displayname}} </p>
								<button class="btn btn-primary dcollapse-btn" type="button" data-target="collapse1">
								  <i class="fa fa-chevron-down"></i>
								</button>
							</div>
							<div class="dcollapse" id="collapse1">
							<div class="djob-item-list">
								<div class="djob-item">
									<table class="table table-bordered">
										<tbody>
											<tr>
												<td width="20%">タイトル</td>
												<td>{{$selectedHire->hire_title()}}</td>
											</tr>
											<tr>
												<td>依頼詳細</td>
												<td>{{$selectedHire->job_content}}</td>
											</tr>
										</tbody>
									</table>
									
								</div> <!-- end .dpolicy-item -->
								
							</div> <!-- end .dpolicy-item-list -->
							<h4>仕業から来た提案</h4>
							<table class="table table-date-policy table-bordered">
								<tbody>
									<tr>
										<td class="text-center">予定納期 ：<span class="big-text">{{ddate_string($selectedHire->deli_date )}}</span>

										<td class="text-center" style="vertical-align: middle"><button id="complete_recruit"  data-toggle="modal" data-target="#reOpenJob" type="button" class="btn btn-samurai btn-success">再投稿する</button></td>
										</td>
									</tr>
									<tr>
										<td class="text-center" colspan="2">
											<span>着手金支払い金額 ： <span class="big-text">{{$selectedHire->deposit_money_format()}}円</span>+税 </span>
										</td>
									</tr>
									<tr>
										<td class="text-center" colspan="2">
											<span>後払い金額 ： <span class="big-text">{{$selectedHire->deposit_money_fee()}}円</span>+税</span>
										</td>
									</tr>
									<tr>
										<td class="text-center" colspan="2">
											<span>終了日 ： <span class="big-text">{{ ddate_string($selectedHire->finish_date) }}</span></span>
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
										<textarea class="form-control mytext" disabled="disabled" name="message" id="submit-msg" cols="30" rows="3"></textarea>
					                </div>
					                <input type="hidden" name="hire_id" value="{{$hire_id}}">
					                
					                <div class="clearfix"></div>
					                
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

<div class="modal fade" id="reOpenJob">
	<div class="modal-dialog">
		<div class="modal-content">
			{{Form::open(['method'=>'POST', 'id'=>'reOpenForm', 'class'=>'form-horizontal'])}}
			<div class="modal-body">
				<input type="hidden" name="hire_id" value="{{$selectedHire->id}}">
					<div class="form-group">
						<label for="input" class="col-sm-12 control-label">タイトル:</label>
						<div class="col-sm-12">
							<input type="text" name="job_title" id="job_title" class="form-control" value="{{$selectedHire->job_title}}" required="required">
						</div>
					</div>
					<div class="form-group">
						<label for="input" class="col-sm-12 control-label">依頼詳細:</label>
						<div class="col-sm-12">
							<input type="text" name="job_content" id="job_content" class="form-control" value="{{$selectedHire->job_content}}" required="required">
						</div>
					</div>
					<div class="form-group">
						<label for="input" class="col-sm-12 control-label">募集の締め切り:</label>
						<div class="col-sm-12">
							<input type="text" name="deli_date" id="deli_date" class="form-control datepicker" value="{{ ddate_string($selectedHire->deli_date) }}" required="required">
						</div>
					</div>
					<div class="form-group">
						<label for="input" class="col-sm-12 control-label">予算を設定する:</label>
						<div class="col-sm-12">
							{{Form::select('budget', config('site_config.client_budget_list'), $selectedHire->budget, ['class'=>'form-control', 'id'=>'budget'] ) }}
						</div>
					</div>
				

			</div>
			<div class="text-center">
					
				<button type="button" onclick="window.location.href='{{URL::route('client.recruitment.submitrq', ['hire_id'=>$selectedHire->id] ) }}';" class="btn btn-samurai btn-default">変更する</button>
				<button type="submit" class="btn btn-samurai btn-warning">この内容で仕事依頼する</button>
			</div>
			{{Form::close()}}
		</div>
	</div>
</div>

<div class="modal com-modal fade" id="comModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<div class="com-list">
					<p class="com-head">仕事の発注が完了いたしました。</p>
					<p class="com-p">仕事管理から提案者とSAMURAI内チャットでコンタクトを取ることができます。<br>SAMURAIでは直接のやりとりを禁止しております。予めご了承ください</p>
					<p class="com-p">下記の仕事管理画面から見積もりの状況が確認できます。</p>
				</div>
				<div class="text-center">
					<button type="button" data-dismiss="modal" class="btn btn-samurai btn-lg btn-default com_step_2_btn">閉じる</button>
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
		you.avatar = '{{URL::to($selectedHire->user->image)}}';
		you.name = '{{$selectedHire->user->user_name()}}';

		var messageAjax = '/client/mypage/jobs/matching-case/message-ajax';

		var taskViewAjax = '/client/mypage/jobs/matching-case/task-view-ajax';
		var setTaskAjax = '/client/mypage/jobs/matching-case/set_task-ajax';

		var reOpenUrl = '/client/mypage/recruitment/finished/reopen';
		var afterReOpenUrl = '{{URL::route('client.recruitment', [$selectedHire->id] )}}';
	</script>
	
	{{HTML::script('assets/client/js/finished.js')}}
	{{HTML::script('assets/common/js/recruit_chat.js')}}
	{{HTML::script('assets/common/js/new_task.js')}}
	{{HTML::script('assets/common/js/send_message.js')}}
@endsection
