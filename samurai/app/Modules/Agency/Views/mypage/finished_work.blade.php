@extends('layouts.home')
@section('style')
	<style type="text/css">
		.table-finish tr th, .table>thead:first-child>tr:first-child>th {
			background: #428edc;
			color: #FFF;
			border-top: 0;
		    font-weight: normal;
		    border-bottom: none;
		    padding: 12px;
		}
	</style>
@endsection
@section('content')
<div class="mainpage clientprofile-1">
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
			<div class="col-sm-2 sidebar-left">
				@if($user->image)
					@php ($profile_image = $user->image) @endphp
				@else
					@php ($profile_image = 'assets/common/images/img-user1.png') @endphp
				@endif
				@include('Agency::includes.sidebar-left')
			</div>
			<div class="col-sm-10 mainpage">
				<div class="row">
					<div class="col-sm-12">
						<ul class="jobTapLink">
		                    <li class="">
		                        <a href="{{URL::route('agency.jobs')}}">依頼・提案・募集</a>
		                    </li>
		                    <li>
		                        <a href="{{URL::route('agency.jobs.matchingcase')}}">マッチング案件</a>
		                    </li>
		                    <li class="active">
		                        <a href="{{URL::route('agency.jobs.finishedwork')}}">終了した案件</a>
		                    </li>
		                </ul>
					</div>
				</div>
				{{Form::open(['method'=>'GET', 'class'=>'form-inline text-right', 'name'=>'myForm'])}}
				<div class="div-style-grey">
					<div class="row">
					    <div class="col-sm-4 text-left">
					        <h5 class="font13">{{ (!json_decode($completedList->toJson())->to?0:json_decode($completedList->toJson())->to) . '/' . $completedList->total() }}</h5>
					    </div>
					</div>
				</div>
				{{Form::close()}}
				<div class="row">
					<div class="col-sm-12">
						@foreach($completedList as $key=>$msg)
						<table class="table table-bordered table-hover table-finish">
						    <thead>
							    <tr>
							        <th>タイトル</th>
							        <th width="15%">事業者名</th>
							        <th width="15%">マッチング日</th>
							        <th width="15%">終了予定日</th>
							    </tr>
						    </thead>
						    <tbody>
							    <tr>
							        <td>{{ $msg->policy_name }}</td>
							        <td>{{$msg->user_name}}</td>
							        <td>{{$msg->matching_date}}</td>
							        <td>{{$msg->finish_date}}</td>
							    </tr>
							    <tr>
							    	<td colspan="2">
							    		<a href="{{URL::route('agency.jobs.finished.rq_view_task', [$msg->hireid] )}}" class="btn btn-success btn-style-shadow-green" style="margin-right: 20px">タスクを見る</a>
							    		<a href="{{URL::route('agency.jobs.finished.rq_msg_task', [$msg->hireid] )}}" class="btn btn-success btn-style-shadow-green">メッセージを見る</a>
							    	</td>
							    	<td colspan="2" class="text-right">
							    		<button type="button" onclick="cancelFinish({{$msg->hireid}});" class="btn-primary btn btn-style-shadow-blue">終了を取り消す</button>
							    	</td>
							    </tr>

						    </tbody>
						</table>
						@endforeach
						<div class="text-center">
							{{ $completedList->appends(request()->all())->links() }}
						</div>
					</div> <!-- end col-sm-12 -->
				</div>	 <!-- end .row -->
			</div> <!-- end .mainpage -->
		</div>
	</div>
</div>

@endsection

@section('script')
	<script>
		var base_url = '{{URL::to('/')}}';
		var cancelFinish = function(hireid)
		{
			$.ajax({
				url: base_url + '/agency/mypage/jobs/finished-work-ajax',
				data: {act: 'cancelFinish', hireid: hireid},
				type: 'POST',
				success: function(json)
				{
					window.location.reload();
				}
			})
		}
	</script>

@endsection