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
							@include('Client::include.dleft-user-list-jobrq')
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
								<p>案件名：{{$selectedHire->job_title}}</p>
								<button class="btn btn-primary dcollapse-btn" type="button" data-target="collapse1">
								  <i class="fa fa-chevron-down"></i>
								</button>
							</div>
							<div class="dcollapse" id="collapse1">
							<div class="dpolicy-item-list">
								<div class="dpolicy-item">
									
									<div class="dpleft no-dpright">
										<div class="dpleft-top">
											<table class="table table-bordered">
												<tbody>
													<tr>
														<td width="25%">
															タイトル
														</td>
														<td>
															{{$selectedHire->job_title}}
														</td>
													</tr>
													<tr>
														<td>依頼詳細</td>
														<td>{{$selectedHire->job_content}}</td>
													</tr>
												</tbody>
											</table>
										</div> <!-- end .dpleft-top -->
									</div> <!-- end .dpleft -->
									
									
								</div> <!-- end .dpolicy-item -->
								
							</div> <!-- end .dpolicy-item-list -->

							<h4>あなたが依頼した内容</h4>
							<table class="table table-date-policy table-bordered">
								<tbody>
									<tr>
										<td class="left-padding-job">
											<span>予算 : <span class="big-text"><span id="total1_span">{{ $selectedHire->budget_format() }}</span></span>+税</span>
										</td>
										<td>
											<span>希望納期 : <span class="big-text">{{ddate_string( $selectedHire->created_at )}}</span></span>
										</td>
									</tr>
									<tr>
										<td class="left-padding-job" colspan="2">
											<span>見積の締め切り : <span class="big-text">{{ddate_string($selectedHire->deli_date)}}</span></span>
											<button data-toggle="modal" data-target="#cancelMatching" type="button" class="btn btn-danger btn-samurai pull-right big-button">依頼した案件を削除</button>
											<button data-toggle="modal" data-target="#changeForm" type="button" class="btn btn-success btn-samurai pull-right big-button">締切を延長する</button>
											
										</td>
									</tr>
								</tbody>
							</table>

							<div class="title-blue"><span class="text">士業名：</span></div>
							<table class="table table-date-policy table-bordered">
								<tbody>
									<tr>
										<td class="left-padding-job">
											<span>予定納期 ： <span id="deli_date_span" class="big-text">{{ddate_string($selectedHire->deli_date)}}</span></span>
										</td>
										<td rowspan="2" class="button-middle" width="150">
											
										</td>
									</tr>
									<tr>
										<td class="left-padding-job">
											<span>着手金支払い金額 ： <span id="total1_span" class="big-text"> 円</span>+税 </span>
											<br><br>
											<span>後払い金額 ： <span class="big-text"><span id="total2_span"></span> 円</span>+税 </span>
										</td>
									</tr>
								</tbody>
							</table>
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

			<div class="modal-body">
				<p class="modal-title text-center">見積の締め切りを提案する</p>
					{{Form::open(['method'=>'POST', 'class'=>'form-horizontal'])}}
					<input type="hidden" name="hire_id" id="hire_id" value="{{$selectedHire->id}}">
					<table class="table table-bordered">
						<tbody>
							<tr>
								<td class="row">
									<div class="form-group">
										<label for="input" class="col-sm-4 control-label">予定納期:</label>
										<div class="col-sm-4">
											<input type="text" name="deli_date" id="deli_date" class="form-control datepicker" value="{{date('Y年m月d日', strtotime($selectedHire->deli_date() ) )}}" required="required">
										</div>
									</div>
									<div class="form-group">
										<label for="input" class="col-sm-4 control-label">予算:</label>
										<div class="col-sm-6">
											{{Form::select('budget', config('site_config.client_budget_list'), @$selectedHire->budget, ['class'=>'form-control', 'required', 'id'=>'budget1'])}}
										</div>
									</div>
								</td>
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
				<h4 class="modal-title text-center">提案されている金額で仕事の依頼をしますか？</h4>
			</div>
			<div class="modal-body">
				
					{{Form::open(['method'=>'POST', 'class'=>'form-horizontal'])}}
					<table class="table table-bordered">
						<tbody>
							<tr>
								<td class="row">
									<div class="form-group">
										<label for="input" class="col-sm-4 control-label">予定納期:</label>
										<div class="col-sm-6">
											<span id="deli_date_step_2"></span>
										</div>
									</div>
									<div class="form-group">
										<label for="input" class="col-sm-4 control-label">予算:</label>
										<div class="col-sm-6">
											<span id="budget1_step2"></span>
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
				<button type="button" id="submitForm" class="btn btn-samurai btn-warning">この内容で仕事発注する</button>
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
				<button type="button" data-dismiss="modal" onclick="window.location.reload();" class="btn btn-samurai btn-default">閉じる</button>
				<button type="button" data-dismiss="modal" onclick="window.location.reload();" class="btn btn-samurai btn-warning">仕事管理を見る</button>
			</div>
		</div>
		</div> <!-- end .modal content -->
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
							<td><span class="big-text"> 円</span>+税 </span></td>
						</tr>
						<tr>
							<td>後払い金額</td>
							<td><span class="big-text"> 円</span>+税 </span></td>
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
			<div class="modal-body text-center">
				<h4>本当に仕事依頼を削除しますか？</h4>
				<div class="text-center" style="margin-top: 50px;">
					<button type="button" class="btn btn-default btn-samurai" data-dismiss="modal">戻る</button>
                	<button type="submit" class="btn btn-danger btn-samurai btn-style-shadow-green" id="can_step_2">削除する</button>
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
					<p class="com-head">依頼した案件を削除しました。</p>
					<p class="com-p">仕事管理から提案者とSAMURAI内チャットでコンタクトを取ることができます。<br>SAMURAIでは直接のやりとりを禁止しております。予めご了承ください</p>
					<p class="com-p">下記のボタンから削除した案件を確認できます。</p>
					<button type="button" data-dismiss="modal" class="btn btn-success btn-samurai can_step_2_btn" style="width: 220px">削除した案件を見る</button>
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
		
		$('.datepicker').datepicker({
		    format: 'yyyy年mm月dd日',
		    autoclose: true,
		    todayHighlight: true,
		    language: 'ja-JP',
		    startDate: 'today'
		});
		var rqNoneAjax = '{{URL::route('client.recruitment.jobrqnone')}}';
		var jobrqCancelAjax = '{{URL::route('client.recruitment.jobrqnonecancel')}}';
		var other_job_id = {{$selectedHire->id}};
	</script>
	{{HTML::script('assets/common/js/recruit_chat.js')}}
	{{HTML::script('assets/client/js/jobrq_view.js')}}
@endsection
