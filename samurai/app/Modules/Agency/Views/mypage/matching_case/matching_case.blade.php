@extends('layouts.home')
@section('style')
	<style type="text/css">

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
		                    <li class="active">
		                        <a href="{{URL::route('agency.jobs.matchingcase')}}">マッチング案件</a>
		                    </li>
		                    <li>
		                        <a href="{{URL::route('agency.jobs.finishedwork')}}">終了した案件</a>
		                    </li>
		                </ul>
					</div>
				</div>
				{{Form::open(['method'=>'GET', 'class'=>'form-inline text-right', 'name'=>'myForm'])}}
				<div class="div-style-grey">
					<div class="row">
					    <div class="col-sm-4 text-left">
					        <h5 class="font13">{{ (!json_decode($matchingList->toJson())->to?0:json_decode($matchingList->toJson())->to) . '/' . $matchingList->total() }}</h5>
					    </div>
					    <div class="col-sm-8">
					    	
					    		<div class="form-group col-sm-7">
					    			<label class="fw500" for="">表示年月：</label>
					    			{{Form::select('filteryear', $yearList, request()->filteryear, ['class'=>'form-control min-w100 mgr-15', 'onchange'=>'this.form.submit()'] ) }}
					    			{{Form::select('filtermonth', [0=>'すべて',1=>'1月',2=>'2月',3=>'3月',4=>'4月',5=>'5月',6=>'6月',7=>'7月',8=>'8月',9=>'9月',10=>'10月',11=>'11月',12=>'12月'], request()->filtermonth, ['class'=>'form-control min-w100', 'onchange'=>'this.form.submit()'] ) }}
						            
					    		</div>
					    		<div class="form-group col-sm-5">
					    			<label class="fw500" for="">表示件数：</label>
					    			{{Form::select('filterdisplay', [10=>'10',20=>'20',50=>'50'], request()->filterdisplay, ['class'=>'form-control min-w150', 'onchange'=>'this.form.submit()'] ) }}
					    		</div>

					    </div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<ul class="nav nav-tabs tablinksub">
						    <li class="active">
						        <a href="{{ URL::route('agency.jobs.matchingcase') }}">案件一覧 </a>
						    </li>
						    <li class="">
						        <a href="{{ URL::route('agency.jobs.matching.book') }}">スケジュール </a>
						    </li><!-- 
						    <li>
						        <a href="mypage/agencyjob-1-3.php">募集案件</a>
						    </li> -->
						</ul>
					</div>	<!-- end middle page -->
				</div>
				{{Form::close()}}
				<div class="row">
					<div class="col-sm-12">
		                    <div class="boxpdbg mgt-20">
		                    	@foreach($matchingList as $key=>$item)
		                        <table class="table table-bordered table-hover pdtdbold">
		                            <thead>
		                                <tr>
		                                    <th>タイトル</th>
		                                    <th width="13%">事業者名</th>
		                                    <th width="13%">マッチング日</th>
		                                    <th width="13%">締切日</th>
		                                </tr>
		                            </thead>
		                            <tbody>
		                                <tr>
		                                    <td>{{$item->policy_name}}（施策名）</td>
		                                    <td>{{$item->user_name}}</td>
		                                    <td>{{ date_string($item->matching_date) }}</td>
		                                    <td>{{ date_string($item->finish_date) }}</td>
		                                </tr>
		                            </tbody>
		                        </table>
		                        <table class="table table-bordered table-hover pdtdbold">
		                            <tbody>
		                                <tr>
		                                    <td>
		                                        <div class="pull-left">
		                                            <a href="{{URL::route('agency.jobs.matching.setting_task', [$item->hireid] )}}" class="shadowbuttonsuccess btn btn-success mgr-8">タスク設定</a>
		                                            <a href="{{URL::route('agency.jobs.matching.view_task', [$item->hireid] )}}" class="shadowbuttonsuccess btn btn-success mgr-8">タスクを見る</a>
		                                            <a href="{{URL::route('agency.jobs.matching.view_message', [$item->hireid] )}}" class="shadowbuttonsuccess btn btn-success">メッセージを見る</a>
		                                        </div>
		                                        <div class="pull-right">
		                                            <a href="{{URL::route('agency.jobs.matching.report', [$item->hireid] )}}" class="shadowbuttonprimary btn btn-primary mgr-8">請求</a>
		                                            <a href="{{URL::route('agency.jobs.matching.complete', [$item->hireid] )}}" class="shadowbuttonprimary btn btn-primary">完了・キャンセル</a>
		                                        </div>
		                                    </td>
		                                </tr>
		                                @foreach($matchingWork[$key]['work_set'] as $mwItem)
		                                <tr>
		                                	<td class="text-muted font12"><span class="col-sm-2">{{date_string($mwItem['schedule'])}}</span>
		                                        <span class="col-sm-10 ng-binding">タスク：{{ WorkSetString($mwItem['work_content'], $mwItem['work_content_other_value'], $mwItem['work_content_other']) }}</span>
		                                    </td>
		                                </tr>
		                                @endforeach
		                                <tr>
		                                	<td class="text-muted font12"><span class="col-sm-2">お知らせ</span>
		                                        <span class="col-sm-10 ng-binding color-red">{{ @NotificationString($matchingWork[$key]['notifications']) }}</span>
		                                    </td>
		                                </tr>
		                            </tbody>
		                        </table>
		                        @endforeach
		                    </div> <!-- end .boxpdbg mgt-20 -->
		                    <div class="col-xs-12">
		                    	<div class="text-center">
		                    		{{ $matchingList->appends(request()->all())->links() }}
		                    	</div>
		                    </div>
                	</div><!-- end col-sm-12 -->
				</div>	 <!-- end .row -->
			</div> <!-- end .mainpage -->
		</div>
	</div>
</div>

@endsection

@section('script')
	<script>
		var base_url = '{{URL::to('/')}}';
		setupselect();
	</script>

@endsection