@extends('layouts.home')
@section('style')
	{{HTML::style('assets/common/plugins/datepicker/css/bootstrap-datepicker.min.css')}}
	{{HTML::style('assets/common/plugins/ajaxtable/css/ajaxtable.css')}}
	{{HTML::style('assets/agency/css/task.css')}}
	
@endsection
@section('content')
<div class="mainpage clientprofile-11">
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
					        <h5 class="font13">1/1</h5>
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
						@include('partials.user.notifications')
		                    <div class="boxpdbg mgt-20">
		                    	@foreach($hire as $key=>$item)
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
		                            </tbody>
		                        </table>
		                        @endforeach
		                    </div> <!-- end .boxpdbg mgt-20 -->
                	</div><!-- end col-sm-12 -->
					<div class="col-sm-12">
						<h3 class="page-title">申請代行費用請求詳細</h3>
						@include('partials.user.notifications')
						<div class="row boxcacular">
							<div class="col-sm-9">
								{{Form::open(['method'=>'POST'])}}
									<input type="hidden" name="acquire_index" value="1">
									<table class="full-table">
										<tbody>
											<tr>
												<td>取得金額</td>
												<td></td>
												<td colspan="2">
													<div class="form-group has-feedback mgbt-0">
						                            	<input type="number" class="form-control" placeholder="取得金額" name="acquire_budget" id="acquire0_balance" value="{{@$acquire[0]['acquire_budget']}}">
						                            	<span class="form-control-feedback">円</span>
						                        	</div>
						                        </td>
											</tr>
											<tr>
												<td>受取成功報酬</td>
												<td>{{@$hire[0]->request_business_price}}  %</td>
												<td colspan="2">
													<div class="text-right" id="rqpricefee">{{ @ceil($acquire[0]['acquire_budget']*$hire[0]->request_business_price1 / 100) }} 円</div>
													<input type="hidden" id="feesuccessbudget" value="{{@ceil($acquire[0]['acquire_budget']*$hire[0]->request_business_price1 / 100)}}">
						                        </td>
											</tr>
											<tr style="vertical-align: top;">
												<td rowspan="{{@count($acquire[0]['other_budget_array'])+2}}">その他費用</td>
											</tr>
											@if(@count($acquire[0]['other_budget_array']))
											@foreach($acquire[0]['other_budget_array'] as $index=>$aq)
											<tr>
												<td>@if($index == 0) 内訳 @endif </td>
												<td><input type="text" class="form-control" name="other_budget_array[{{$index}}][comment]" placeholder="費用名" value="{{@$aq['comment']}}"></td>
												<td>
													<div class="form-group has-feedback mgbt-0">
						                            	<input type="number" class="form-control snum" placeholder="取得金額" name="other_budget_array[{{$index}}][balance]" value="{{@$aq['balance']}}">
						                            	<span class="form-control-feedback">円</span>
						                        	</div>
						                        </td>
											</tr>
											@endforeach
											@endif
											<tr>
												<td>合計</td>
												<td></td>
												<td>
													<div class="text-right" id="totalaq">  円</div>
						                        </td>
											</tr>
											<tr>
												<td>合計</td>
												<td></td>
												<td></td>
												<td>
													<div class="text-right" id="totalal">  円</div>
						                        </td>
											</tr>
											<tr>
												<td>事務手数料({{$sitefee}}%)</td>
												<td></td>
												<td></td>
												<td>
													<div class="text-right" id="totalsf">  円</div>
						                        </td>
											</tr>
											<tr class="style-light-brown">
												<td>振込予定金額(内税)</td>
												<td></td>
												<td></td>
												<td>
													<div class="text-right" id="expect_budget">  円</div>
						                        </td>
											</tr>

										</tbody>
									</table>
									@if(@acquire[0]['manage_flag'] != 3)
									<p class="text-center mgt-30">
										<button type="submit" class="shadowbuttonsuccess btn btn-success">請求する</button>
									</p>
									@endif
								{{Form::close()}}
							</div>
							<div class="col-sm-3">
								<div class="cacular-desc">
									<p class="text-center mgbt-30">
										<span class="boxred">{{getAcquireStatus(@$acquire[0]['manage_flag'])}}</span>
									</p>
									<p>
										取得金額、およびその他費用を入力してください。<br>
										入力した内容は、事業者に通知されます。<br>
										取得した金額・費用を、事業者が確認完了すると、請求金額が確定します。
									</p>
								</div>
							</div>
						</div>
					</div><!-- end .col-sm-12 -->	
					<div class="col-sm-12">
						<h3 class="page-title">書類作成費用請求詳細</h3>
						<div class="row boxcacular">
							<div class="col-sm-9">
								{{Form::open(['method'=>'POST'])}}
								<input type="hidden" name="acquire_index" value="2">
									<table class="full-table">
										<tbody>
											<tr>
												<td>書類作成費用</td>
												<td></td>
												<td colspan="2">
													<div class="text-right" id="tb2-balance">0  円</div>
													<input type="hidden" name="acquire_budget" value="0" id="acquire_budget1">
						                        </td>
											</tr>
											<tr style="vertical-align: top;">
												<td colspan="1" rowspan="{{@count($acquire[1]['other_budget_array'])+2}}">その他費用</td>
											</tr>
											@if(@count($acquire[1]['other_budget_array']))
											@foreach($acquire[1]['other_budget_array'] as $index=>$aq)
											<tr>
												<td>@if($index == 0) 内訳 @endif </td>
												<td><input type="text" class="form-control" name="other_budget_array[{{$index}}][comment]" placeholder="費用名" value="{{@$aq['comment']}}"></td>
												<td>
													<div class="form-group has-feedback mgbt-0">
						                            	<input type="number" class="form-control snum1" placeholder="取得金額" name="other_budget_array[{{$index}}][balance]" value="{{@$aq['balance']}}">
						                            	<span class="form-control-feedback">円</span>
						                        	</div>
						                        </td>
											</tr>
											@endforeach
											@endif
											<tr>
												<td>合計</td>
												<td></td>
												<td colspan="">
													<div class="text-right" id="totalaq1">  円</div>
						                        </td>
											</tr>
											<tr>
												<td>合計</td>
												<td></td>
												<td colspan="2">
													<div class="text-right" id="totalal1">  円</div>
						                        </td>
											</tr>
											
											<tr>
												<td>事務手数料({{$sitefee}}%)</td>
												<td></td>
												<td></td>
												<td>
													<div class="text-right" id="totalsf1">  円</div>
						                        </td>
											</tr>
											<tr class="style-light-brown">
												<td>振込予定金額(内税)</td>
												<td></td>
												<td></td>
												<td>
													<div class="text-right" id="expect_budget1">  円</div>
						                        </td>
											</tr>

										</tbody>
									</table>
									@if(@$acquire[1]['manage_flag'] == 0 || @$acquire[1]['manage_flag'] == 2)
									<p class="text-center mgt-30">
										<button type="submit" class="shadowbuttonsuccess btn btn-success">請求する</button>
									</p>
									@endif
								{{Form::close()}}
							</div>
							<div class="col-sm-3">
								<div class="cacular-desc">
									<p class="text-center mgbt-30">
										<span class="boxred">{{getAcquireStatus(@$acquire[1]['manage_flag'])}}</span>
									</p>
									<p>
										取得金額、およびその他費用を入力してください。<br>
										入力した内容は、事業者に通知されます。<br>
										取得した金額・費用を、事業者が確認完了すると、請求金額が確定します。
									</p>
								</div>
							</div>
						</div>
					</div><!-- end .col-sm-12 -->	
					<div class="col-sm-12">
						<h3 class="page-title">合計</h3>
						<div class="row boxcacular">
							<div class="col-sm-10">
								<table class="full-table">
									<tbody>
										<tr class="style-light-brown">
											<td>振込予定金額(内税)</td>
											<td></td>
											<td>
					                        </td>
					                        <td>
												<div class="text-right" id="totalbudget">0  円</div>
					                        </td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div><!-- end .col-sm-12 -->	
				</div>	 <!-- end .row -->
			</div> <!-- end .mainpage -->
		</div>
	</div>
</div>

@endsection

@section('script')
{{HTML::script('assets/common/plugins/datepicker/js/bootstrap-datepicker.min.js')}}
{{HTML::script('assets/common/plugins/ajaxtable/js/plugins.js')}}
	<script>
		var totalaq = 0;
		var totalaq1 = 0;
		var totalal = 0;
		var totalal1 = 0;
		var totalsitefee = 0;
		var totalsitefee1 = 0;
		var expect_budget = 0;
		var expect_budget1 = 0;
		var sitefee = {{$sitefee}};
		var hire_id = {{$hire_id}};
		var hire = [];
		var base_url = '{{URL::to('/')}}';
		var acquire = [];
		var acquire0_balance = 0;
		var acquire1_balance = 0;
		var totalbudget = 0;
		var rqpricefee = 0;
		$(document).ready(function() {
			initHire();
		});
		var rqprice = function() {console.log(1);
			acquire0_balance = (!isNaN(parseInt($('#acquire0_balance').val()))?parseInt($('#acquire0_balance').val()):0);
			rqpricefee = Math.ceil( acquire0_balance*hire.request_business_price/ 100 );
			$('#rqpricefee').html(rqpricefee + ' 円');
			sumaq();
		}
		var sumaq = function() {
			var total = 0;
			var tmp = 0;
			
			$('.snum').each(function(index, el) {
				tmp = parseInt($(el).val());
				if(!isNaN(tmp)) total += tmp;
			});
			totalaq = total;
			$('#totalaq').html(totalaq + ' 円');

			sumal();
		}
		var sumal = function() {
			var tmp = 0;
			tmp = parseInt( $('#feesuccessbudget').val() );
			var total = totalaq;
			if(!isNaN(tmp)) total = totalaq + tmp;
			totalal = rqpricefee + total;
			$('#totalal').html(totalal + ' 円');
			
			getsitefee();
		}
		var getsitefee = function() {
			totalsitefee = Math.ceil(totalal * sitefee/100);
			$('#totalsf').html(-totalsitefee + ' 円');
			getexpectbuget();
		}
		var getexpectbuget = function() {
			expect_budget = Math.ceil(totalal - totalsitefee);
			$('#expect_budget').html(expect_budget + ' 円');
			
		}
		var initHire = function() {
			$.ajax({
				url: base_url + '/agency/mypage/jobs/matching-case/report-ajax',
				data: {act: 'getHire', hire_id: hire_id},
				type: 'POST',
				success: function(json) {
					hire = json.hire;
					acquire = json.acquire;
					rqprice();
					initTable2();
				}
			})
		}
		var initTable2 = function() {
			$('#tb2-balance').html(hire.document_business_price + ' 円');
			$('#acquire_budget1').val(hire.document_business_price);
			acquire1_balance = (hire.document_business_price?hire.document_business_price:0);
			sumaq1();
		}
		var sumaq1 = function() {
			var total = 0;
			$('.snum1').each(function(index, el) {
				var tmp = parseInt($(el).val());
				if(!isNaN(tmp)) total += tmp;
			});
			totalaq1 = acquire1_balance + total;
			$('#totalaq1').html(total + ' 円');

			sumal1();
		}
		var sumal1 = function() {
			var total = totalaq1;
			var tmp = parseInt( $('#feesuccessbudget').val() );
			if(!isNaN(tmp))
			{
				total = totalaq1 + tmp;
			}
			$('#totalal1').html(total + ' 円');
			totalal1 = total;
			getsitefee1();
		}
		var getsitefee1 = function() {
			totalsitefee1 = Math.ceil(totalaq1 * sitefee/100);
			$('#totalsf1').html(-totalsitefee1 + ' 円');
			getexpectbuget1();
		}
		var getexpectbuget1 = function() {
			expect_budget1 = Math.ceil(totalaq1 - totalsitefee1);
			$('#expect_budget1').html(expect_budget1 + ' 円');
			gettotalbudget();
			
		}
		var gettotalbudget = function() {
			var total = expect_budget + expect_budget1;
			totalbudget = total;
			$('#totalbudget').html(total + ' 円');
		}
		$('.snum1').change(function() {
			sumaq1();
		});
		$('.snum').change(function() {
			rqprice();
		});
		$('#acquire0_balance').change(function() {
			rqprice();
		});
	</script>
@endsection