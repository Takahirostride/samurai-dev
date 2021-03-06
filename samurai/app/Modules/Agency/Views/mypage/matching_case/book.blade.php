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
					        <h5 class="font13">{{ (!json_decode($bookList->toJson())->to?0:json_decode($bookList->toJson())->to) . '/' . $bookList->total() }}</h5>
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
						    <li class="">
						        <a href="{{ URL::route('agency.jobs.matchingcase') }}">案件一覧 </a>
						    </li>
						    <li class="active">
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
		                    	@foreach($bookList as $key=>$item)
		                        <table class="table table-bordered table-hover pdtdbold">
		                            <thead>
		                                <tr>
		                                    <th colspan="3">{{ date_string($item->schedule) }}</th>
		                                </tr>
		                            </thead>
		                            <tbody>
		                            	@foreach($subArr[$key]['return'] as $key1=>$item1)
		                                <tr>
		                                    <td class="td-link" width="40%"><a href="{{URL::route('agency.jobs.matching.view_task', [$item1['hireid']] )}}">{{$item1['policy_name']}}</a></td>
		                                    <td class="td-link" with="20%"><a href="{{URL::route('agency.jobs.matching.view_task', [$item1['hireid']] )}}">{{$item1['user_name']}}</a></td>
		                                    <td class="td-link" width="40%"><a href="{{URL::route('agency.jobs.matching.view_task', [$item1['hireid']] )}}">{{WorkSetString($item1['work_content'], $item1['work_content_other_value'], $item1['work_content_other'])}}</a></td>
		                                </tr>
		                                @endforeach
		                            </tbody>
		                        </table>
		                        
		                        @endforeach
		                    </div> <!-- end .boxpdbg mgt-20 -->
		                    <div class="col-xs-12">
		                    	<div class="text-center">
		                    		{{ $bookList->appends(request()->all())->links() }}
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
	</script>

@endsection