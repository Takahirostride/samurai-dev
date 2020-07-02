@extends('layouts.home')
@section('style')
	<link rel="stylesheet" href="/assets/user/agency/css/b_subsidylist.css">
	<style type="text/css">
		.removehd .hidden {
			display: none;
		}
	</style>
@endsection
@section('content')
<div class="mainpage">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				@includeIf('partials.breadcrumb', ['title' => '仕事を探す'])
			</div>
		</div>
		<div class="row subsidy-list mgt-20">
			<div class="col-sm-12">
				@if(count($results))
				@foreach($results as $key => $val)
					<table class="table table-bordered dsubsidylist-table">
						<thead>
							<tr>
								<th colspan="3">
									<span class="namepc">案件名：{{$val->job_title}}</span>
									<span class="namepc">企業名：{{$val->from->username}}</span>
									<span class="remove removehd" data-id="{{$val->id}}">-</span>
								</th>
							</tr>
						</thead>
						<tbody id="hd-{{$val->id}}">
							<tr>
								<td class="linktr" data-href="{{route('agency.dinformation', $val->id)}}">タイトル</td>
								<td class="linktr" data-href="{{route('agency.dinformation', $val->id)}}">
									<div class="row">
										<div class="col-sm-12">
											{{str_limit($val->job_title,34)}}
										</div>
									</div>
								</td>
								<td rowspan="4">
									@if($val->from)
									<div class="subsidylist-item-av div-style-grey">
										<img src="{{url($val->from->image)}}" alt="">
										<div class="itemav-info">
											<p>事業者名: {{$val->from->displayname}}</p>
											<div class="clearfix">
												<span class="pull-left">実績     ：</span>
												<div class="pull-left star-rating fbrtdiv-{{$key}}">
												    <select class="fbrtsl-{{$key}}" data-current-rating="{{$val->from->evaluate}}" name="rating" autocomplete="off">
												        <option value=""></option>
												        <option value="1">1</option>
												        <option value="2">2</option>
												        <option value="3">3</option>
												        <option value="4">4</option>
												        <option value="5">5</option>
												    </select>
												</div>
											</div>
											<p>実績：{{$val->from->result}}件</p>
										</div>
	                                    <div class="clearfix"></div>
										<p>{{str_limit($val->from->self_intro,70)}}</p>
									</div>
									@endif
									<p class="text-center">
										<button type="submit" data-uid="{{$val->id}}" class="btn btn-default baskbutton submitbask">事業者に提案する</button>
									</p>
								</td>
							</tr>
							<tr class="linktr" data-href="{{route('agency.dinformation', $val->id)}}">
								<td>依頼詳細</td>
								<td>
								<div class="min-h35" style="word-break: break-word;">
									{{$val->job_content}}
								</div>
									
								</td>
							</tr>
							<tr class="linktr" data-href="{{route('agency.dinformation', $val->id)}}">
								<td colspan="2" class="pd-0">
									<table class="table table-date-policy table-bordered mgbt-0">
										<tbody>
											<tr>
												<td>
													予算　　　　　：<span class="bigtext">{{config('site_config.client_budget_list')[$val->budget]}}</span>+税　　　　希望納期：<span class="bigtext">{{date('Y',strtotime($val->deli_date))}}</span>年<span class="bigtext">{{date('m',strtotime($val->deli_date))}}</span>月<span class="bigtext">{{date('d',strtotime($val->deli_date))}}</span>日
												</td>
											</tr>
											<tr>
												<td>
													　　見積の締め切り  :　　　　<span class="bigtext">{{date('Y/m/d',strtotime($val->deli_date))}}</span>
												</td>
											</tr>
										</tbody>
									</table>
									　　
								</td>
							</tr>
						</tbody>
					</table>
				@endforeach
				<div class="clearfix"></div>
				<div class="text-center">
					{{ $results->appends(request()->query())->links() }}
				</div>
				@else

				<p>依頼がされた案件はありません。</p>

				@endif


			</div> <!-- end .div.col-sm-12 -->

		</div> <!-- end .row -->
	</div> <!-- end .container -->
</div> <!-- end .mainpage -->
<div class="clearfix"></div>
@php
	$show = request()->filled('register') ? '1':'0';
@endphp
<div class="modal fade" id="modal-Bask" data-show="{{ $show }}">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body" id="modal-baskform-content">
				{{ Form::open(['url' => route('agency.dask'), 'method' => 'POST', 'id'=>'formID', 'enctype'=>'multipart/form-data']) }}
				<input type="hidden" name="job_policy_id" id="job_policy_id" value="">
					<div id="formdask">
						<h3 class="text-center">納期と金額を提案する</h3>
						<table class="table table-bordered bask-page">
							<tbody>
								<tr>
									<td width="20%" class="div-style-blue2 text-primary">
										<p class="text-center">見積内容</p>
									</td>
									<td>
										<table class="modal-baskform" id="baskinputtable">
											<tbody>
												<tr>
													<td>納期</td>
													<td>
														{{Form::text('deli_date','', ['id'=>'datepickermodal'])}}<span></span>
													</td>
												</tr>
												<tr>
													<td>着手金</td>
													<td>
														{{Form::number('deposit_money','', ['id'=>'deposit_money'])}}<span> 円</span>
													</td>
												</tr>
												<tr>
													<td>後払い金額<br>(成功報酬等)</td>
													<td>
														{{Form::number('agency_estimate','', ['id'=>'agency_estimate'])}}<span> 円</span>
													</td>
												</tr>
											</tbody>
										</table>
										<p class="cacular">
											<span class="lablep">報酬金額</span>
											<span class="prsh"><span id="total1"></span>円　+　税</span>
										</p>
										<p class="cacular cacular-last">
											<span class="lablep">クライアント支払金額</span>
											<span class="prsh"><span id="total2"></span>円　+　税</span>
										</p>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div id="daskconfirmdiv"></div>
					<p class="text-center" id="allbutbask">
						<button type="button" class="btn btn-default" data-dismiss="modal">戻る</button>
						<button type="button" id="BaskAjaxConfirm" class="btn btn-default baskbutton">内容を確認する</button>
					</p>
				{{ Form::close() }}
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="confirmModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Modal title</h4>
			</div>
			<div class="modal-body">
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
	<script type="text/javascript">
		var count_fb = {{count($results)}};
		var hire_id = 0;
		$(document).ready(function() {
			for( i = 0; i < count_fb; i++)
			{
				starRatingInit('.fbrtdiv-'+i, '.fbrtsl-'+i);
			}
		});
		$(document).on('click' , '.submitbask' , function(){
			var job_id = $(this).attr('data-uid');
			$('#job_policy_id').val(job_id);
			$('#modal-Bask').modal('show');
		});
		$(document).on('click' , '#BaskAjaxSubmit' , function(){
			if(!$('input[name="deli_date"]').val() || !$('input[name="deposit_money"]').val()) {
				alert('一つ以上の事業者を選択してください。');
				return false;
			}else{
				var data = new FormData($('form#formID')[0]);
				$.ajax({
				    url: '{{route('agency.dask')}}',
				    data: data,
				    cache: false,
				    contentType: false,
				    processData: false,
				    method: 'POST',
				    success: function(data){
				    	if(data.success) {
				    		hire_id = data.hire_id;
						    var str = '<div class="basksuccess text-center">\
								<h2>見積もり金額の提案を行いました。</h2>\
								<p>\
									仕事管理から事業者とSAMURAI内チャットでコンタクトを取ることができます。<br>\
									SAMURAIでは事業者との直接のやりとりを禁止しております。予めご了承ください\
								</p>\
								<p>\
									着手金がある場合の支払いが完了するまで、事業者は仕事管理の内容を見ることができません。\
								</p>\
							</div><p class="text-center"><button type="button" id="go_to_hire" class="btn btn-default" data-dismiss="modal">閉じる</button></p>';
						}else{
							var str = '<div class="basksuccess text-center">\
								<h2>ERROR</h2>\
							</div><p class="text-center"><button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button></p>';
						}

						$('#modal-baskform-content').html(str);		      
				    }
				});
				// return false;
				// $('#modal-Bask').modal('show');
			}
		});
		$(document).on('click' , '#BaskAjaxConfirm' , function(){
			if(!$('input[name="deli_date"]').val() || !$('input[name="deposit_money"]').val()) {
				alert('一つ以上の事業者を選択してください。');
				return false;
			}else{
				var deli_date = $('input[name="deli_date"]').val();
				var deposit_money = $('#deposit_money').val();
				var agency_estimate = $('#agency_estimate').val();
				if(deposit_money != '' ) deposit_money = parseInt(deposit_money);
				if(agency_estimate != '' ) agency_estimate = parseInt(agency_estimate);
				total1 = Math.ceil(agency_estimate);
				total2 = Math.ceil(total1 + ((total1*sitefee)/100));
				var str = '<h3 class="text-center">納期と金額を修正して提案する</h3><div class="cf">\
					<div class="headercf">\
						<span class="ttcf">納期</span>\
						<span>\
							<span>:'+deli_date+'</span>\
						</span>\
					</div>\
					<div class="contentcf">\
						<p><span class="ttcf">報酬金額</span>\
						<span>\
							:<span class="boldtext">'+total1+'</span><span> 円+税</span>\
						</span></p>\
						<p><span class="ttcf">受け取り金額</span>\
						<span>\
							:<span class="boldtext">'+total2+'</span><span> 円+税</span>\
						</span></p>\
					</div>\
				</div>';
				var but = '<button type="button" class="btn btn-default" id="Baskformback">修正する</button>\
					<button type="button" id="BaskAjaxSubmit" class="btn btn-default baskbutton">この内容で提案する</button>';

				$('#daskconfirmdiv').html(str);
				$('#daskconfirmdiv').show();
				$('#formdask').hide();
				$('#allbutbask').html(but);
			}
		});
		$(document).on('click' , '#Baskformback' , function(){
			var but = '<button type="button" class="btn btn-default" id="Baskformback"  data-dismiss="modal">戻る</button>\
					<button type="button" id="BaskAjaxConfirm" class="btn btn-default baskbutton">内容を確認する</button>';

				$('#formdask').show();
				$('#daskconfirmdiv').hide();
				$('#allbutbask').html(but);
		});
		var sitefee = 5.5;
		var total1;
		var total2;
		var modalCalculator = function() {
			var deposit_money = $('#deposit_money').val();
			var agency_estimate = $('#agency_estimate').val();
			if(deposit_money != '' ) deposit_money = parseInt(deposit_money);
			if(agency_estimate != '' ) agency_estimate = parseInt(agency_estimate);
			total1 = Math.ceil(agency_estimate);
			total2 = Math.ceil(total1 + ((total1*sitefee)/100));
			$('#total1').text(total1);
			$('#total2').text(total2);
		}
		$('#deposit_money').change(function(event) {
			modalCalculator();
		});
		$('#agency_estimate').change(function(event) {
			modalCalculator();
		});
		$('#deposit_money').keyup(function(event) {
			modalCalculator();
		});
		$('#agency_estimate').keyup(function(event) {
			modalCalculator();
		});
		$(document).ready(function() {
			modalCalculator();
		});
		$('#datepickermodal').datepicker({
	    	language : 'ja-JP',
	        inline: true,
	        sideBySide: true,
	        todayHighlight: true,
	        autoclose: true,
	        startDate: 'today',
	        format: "yyyy年mm月dd日"
	    });
	    // $(document).on('click' , '.remove' , function(){
	    // 	$(this).closest('table').remove();
	    // });
	    $(function(){
			$('#modal-Bask').modal();
		});	
		$(document).on('click', '#go_to_hire', function() {
			window.location.href = '{{URL::to('agency/mypage/recruitment/received/')}}/' + hire_id;
		});
		$('.removehd').click(function(event) {
			var did = $(this).data('id');
			if( $('#hd-' + did).hasClass('hidden') )
			{
				$('#hd-' + did).removeClass('hidden');
			} else {
				$('#hd-' + did).addClass('hidden');
			}
		});
	</script>
@endsection