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
		                    <li class="active">
		                        <a href="{{URL::route('agency.jobs')}}">依頼・提案・募集</a>
		                    </li>
		                    <li>
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
					        <h5 class="font13">1/1</h5>
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
						        <a href="{{ URL::route('agency.jobs') }}">提案中 @if($suggestionCount) <span class="badge"> {{$suggestionCount}}</span> @endif </a>
						    </li>
						    <li class="">
						        <a href="{{ URL::route('agency.jobs.requests') }}">受けた依頼 @if($requestCount) <span class="badge"> {{$requestCount}}</span> @endif </a>
						    </li><!-- 
						    <li>
						        <a href="mypage/agencyjob-1-3.php">募集案件</a>
						    </li> -->
						</ul>
					</div>	<!-- end middle page -->
				</div>
				<div class="div-suggestion-policy">
					<div class="row">
						<div class="col-sm-12">
					    		<div class="form-group col-sm-10">
					    			<label class="lbangularsl" for="">表示年月：</label>
					    			<div class="angularsl pull-left mgl-15 text-left">
					    				{{Form::select('plc_id', $policy_list, request()->plc_id, ['onchange'=>'this.form.submit()', 'id'=>'plc_id'] ) }}
						            </div>
						            
					    		</div>

					    		<!-- <div class="form-group col-sm-2 text-right">
									<a href="#" class="shadowbuttonprimary btn btn-primary">提案一覧を見る</a>
					            </div> -->
					    </div>

					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<table class="table table-bordered table-hover table-myjob">
						    <thead>
							    <tr>
							        <th>日時</th>
							        <th>タイトル</th>
							        <th>事業者名</th>
							        <th>メッセージ</th>
							    </tr>
						    </thead>
						    <tbody>
								@foreach($messageList as $key=>$msg)
							    <tr>
							        <td>{{ date('Y年m月d日', strtotime($msg->update_date)) }}</td>
							        <td class="td-link"><a href="{{URL::route('agency.jobs.detail', [$msg->hire_id] )}}">{{$msg->policy_name}}</a></td>
							        <td class="td-link"><a href="{{URL::route('agency.jobs.com_detail', [$msg->hire_id] )}}">{{$msg->displayname}}</a></td>
							        <td class="td-link"><a href="{{URL::route('agency.jobs.bid_job', [$msg->hire_id] )}}"> @if($msgNote[$key]['unread_message']<=0)依頼送信済み@else 返信あり @endif </a></td>
							    </tr>
							    @endforeach

						    </tbody>
						</table>
						<div class="text-center">
							{{ $messageList->appends(request()->all())->links() }}
						</div>
					</div> <!-- end col-sm-12 -->
				</div>	 <!-- end .row -->
				{{Form::close()}}
				<div class="row">
					<div class="col-sm-12 subsidydetail">
						<p class="stitle1">{{$result->name}}</p>
						<p class="stitle2">{{$result->name_serve}}</p>
						<p class="sdesc">登録機関:{{$result->minitry_text() }}<span>更新日:{{$result->update_date}}</span></p>
						<div class="middle-boxcol2">
							{!! Button::getFollowButtons($result->id) !!}
						</div> <!-- end .middle-boxcol2 -->
						<div class="sdetail">
							<p class="sdetail-title">目的</p>
							<p>{!! $result->target !!}</p>
							<p class="sdetail-title">対象者の詳細</p>
							<p>{!! $result->info !!}</p>
							<p class="sdetail-title">支援内容</p>
							<p>{!! $result->support_content !!}</p>
							<p class="sdetail-title">支援規模</p>
							<table class="table table-bordered support-scale">
								<tbody>
									<tr>
										<td width="33%">下限</td>
										<td width="33%">上限</td>
										<td width="33%">助成率</td>
									</tr>
									<tr>
										<td class="text-center std">
											<span class="fake-input">{{$result->support_scale_lower_limit}}</span>
										</td>
										<td class="text-center std">
											<span class="fake-input">{{$result->support_scale_upper_limit}}</span>
										</td>
										<td class="text-center std">
											<span class="fake-input">{{$result->support_scale_subsidy_duration}}</span>
										</td>
									</tr>
								</tbody>
							</table>
							<p>{!! $result->support_scale !!}</p>
							<p class="sdetail-title">募集期間</p>
							<p>{{$result->subscript_duration}}</p>
							<p class="sdetail-title">対象地域</p>
							<p>{{$result->object_duration}}</p>
							<p class="sdetail-title">採択結果</p>
							<p>{{$result->adopt_result}}</p>
							<p class="sdetail-title">掲載終了日</p>
							<p>{{$result->subscript_duration_detail}}</p>
							<p>{{$result->subscript_duration_option}}</p>
							<p class="sdetail-title">pdfデータ</p>
							<p>
								@foreach(json_decode($result->register_pdf, true) as $val)
								<a href="{{$val['1']}}" class="aline">{{$val['0']}}</a>
								@endforeach
								@foreach(json_decode($result->register_pdf1, true) as $val)
								<a href="{{$val['url']}}" class="aline">{{$val['name']}}</a>
								@endforeach
							</p>
							<p class="sdetail-title">お問い合せ</p>
							<p  style="margin-top: 10px; white-space: pre-wrap">{{$result->inquiry}}</p>
							<div class="text-center">
								<button onclick="window.history.back();" class="btn btn-default sdetail-back-btn btn-style-shadow-grey">戻る</button>
							</div>

						</div><!-- end .sdetail -->
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
		setupselect();
	</script>

@endsection