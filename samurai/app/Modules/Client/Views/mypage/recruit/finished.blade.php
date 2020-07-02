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
								<p>士業名：{{$selectedHire->user->displayname}} </p>
								<button class="btn btn-primary dcollapse-btn" type="button" data-target="collapse1">
								  <i class="fa fa-chevron-down"></i>
								</button>
							</div>
							<div class="dcollapse" id="collapse1">
							<div class="dpolicy-item-list">
								<div class="dpolicy-item">
									@if($selectedHire->hire_type == 1)
										@include('Client::mypage.recruit.finished.policyitem')
									@else
										@include('Client::mypage.recruit.finished.jobitem')
									@endif
									
								</div> <!-- end .dpolicy-item -->
								
							</div> <!-- end .dpolicy-item-list -->
							<h4>予算と納期</h4>
							@if($selectedHire->hire_type == 1)
								@include('Client::mypage.recruit.finished.tableprice')
							@else
								@include('Client::mypage.recruit.finished.tableprice-job')
							@endif
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
	</script>
	
	{{HTML::script('assets/common/js/recruit_chat.js')}}
	{{HTML::script('assets/common/js/new_task.js')}}
	{{HTML::script('assets/common/js/send_message.js')}}
@endsection
