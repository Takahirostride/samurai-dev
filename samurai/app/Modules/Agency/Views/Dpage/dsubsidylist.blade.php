@extends('layouts.home')
@section('style')
	<link rel="stylesheet" href="/assets/user/agency/css/b_subsidylist.css">
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
				@foreach($results as $key => $val)
					<table class="table table-bordered dsubsidylist-table">
						<thead>
							<tr>
								<th colspan="3">
									<span class="namepc">案件名：ものづくり補助金</span>
									<span class="namepc">士業名：agency</span>
									<span class="remove">-</span>
								</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>タイトル</td>
								<td>{{str_limit($val->policy->name,34)}}</td>
								<td rowspan="4">
									@if($val->user)
									<div class="subsidylist-item-av div-style-grey">
										<img src="{{url($val->user->image)}}" alt="">
										<div class="itemav-info">
											<p>事業者名: {{$val->user->displayname}}</p>
											<div class="clearfix">
												<span class="pull-left">実績     ：</span>
												<div class="pull-left star-rating fbrtdiv-{{$key}}">
												    <select class="fbrtsl-{{$key}}" data-current-rating="{{$val->user->evaluate}}" name="rating" autocomplete="off">
												        <option value=""></option>
												        <option value="1">1</option>
												        <option value="2">2</option>
												        <option value="3">3</option>
												        <option value="4">4</option>
												        <option value="5">5</option>
												    </select>
												</div>
											</div>
											<p>実績：{{$val->user->result}}件</p>
										</div>
	                                    <div class="clearfix"></div>
										<p>{{str_limit($val->user->self_intro,70)}}</p>
									</div>
									@endif
									<p class="text-center">
										<button type="submit" data-pid="{{$val->policy->id}}" class="btn btn-default baskbutton submitbask">事業者に提案する</button>
									</p>
								</td>
							</tr>
							<tr>
								<td>依頼詳細</td>
								<td>
									{{$val->policy->target}}
								</td>
							</tr>
							<tr>
								<td colspan="2">
									　　予算　　　　　：<span class="bigtext">{{$val->deposit_money}}円</span>+税　　　　希望納期：<span class="bigtext">2018</span>年<span class="bigtext">10</span>月<span class="bigtext">31</span>日
								</td>
							</tr>
							<tr>
								<td colspan="2">
									　　見積の締め切り  :　　　　<span class="bigtext">2018/11/11</span>
								</td>
							</tr>
						</tbody>
					</table>
				@endforeach
				<div class="clearfix"></div>
				<div class="text-center">
					{{ $results->appends(request()->query())->links() }}
				</div>
			</div> <!-- end .div.col-sm-12 -->

		</div> <!-- end .row -->
	</div> <!-- end .container -->
</div> <!-- end .mainpage -->
<div class="clearfix"></div>
<div class="modal fade" id="modal-Bask">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body" id="modal-baskform-content">
				{{ Form::open(['url' => route('agency.dmatching'), 'method' => 'POST', 'id'=>'formID', 'enctype'=>'multipart/form-data']) }}
					{{Form::hidden('policy_id')}}
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
													<td>報酬金額</td>
													<td>
														{{Form::number('deposit_money')}}<span> 円</span>
													</td>
												</tr>
											</tbody>
										</table>
										<p class="cacular">
											<span class="lablep">報酬金額</span>
											<span class="prsh"><span id="price1">○○○○○</span>円　+　税</span>
										</p>
										<p class="cacular cacular-last">
											<span class="lablep">クライアント支払金額</span>
											<span class="prsh"><span id="price2">○○○○○</span>円　+　税</span>
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
@endsection
@section('script')
	<script type="text/javascript">
		var count_fb = {{count($results)}};
		$(document).ready(function() {
			for( i = 0; i < count_fb; i++)
			{
				starRatingInit('.fbrtdiv-'+i, '.fbrtsl-'+i);
			}
		});
		$(document).on('click' , '.submitbask' , function(){
			var policy_id = $(this).attr('data-pid');
			$('#modal-Bask').find('input[name="policy_id"]').val(policy_id);
			$('#modal-Bask').modal('show');
		});
		$(document).on('click' , '#BaskAjaxSubmit' , function(){
			if(!$('input[name="deli_date"]').val() || !$('input[name="deposit_money"]').val()) {
				alert('一つ以上の事業者を選択してください。');
				return false;
			}else{
				var data = new FormData($('form#formID')[0]);
				$.ajax({
				    url: '{{route('agency.dmatching')}}',
				    data: data,
				    cache: false,
				    contentType: false,
				    processData: false,
				    method: 'POST',
				    type: 'json', // For jQuery < 1.9
				    success: function(data){
				    	console.log(data);
				    	if(data == 'success') {
						    var str = '<div class="basksuccess text-center">\
								<h2>見積もり金額の提案を行いました。</h2>\
								<p>\
									仕事管理から事業者とSAMURAI内チャットでコンタクトを取ることができます。<br>\
									SAMURAIでは事業者との直接のやりとりを禁止しております。予めご了承ください\
								</p>\
								<p>\
									着手金がある場合の支払いが完了するまで、事業者は仕事管理の内容を見ることができません。\
								</p>\
								<p >\
									<a href="" class="btn btn-success">仕事管理を見る</a>\
								</p>\
							</div><p class="text-center"><button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button></p>';
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
				var deposit_money = $('input[name="deposit_money"]').val();
				var price1 = deposit_money;
				var price2 = parseFloat(deposit_money) + (parseFloat(deposit_money)*0.05);
				var str = '<h3 class="text-center">納期と金額を修正して提案する</h3><div class="cf">\
					<div class="headercf">\
						<span class="ttcf">予定納期</span>\
						<span>\
							<span>:'+deli_date+'</span>\
						</span>\
					</div>\
					<div class="contentcf">\
						<p><span class="ttcf">報酬金額</span>\
						<span>\
							:<span class="boldtext">'+price1+'</span><span> 円+税</span>\
						</span></p>\
						<p><span class="ttcf">受け取り金額</span>\
						<span>\
							:<span class="boldtext">'+price2+'</span><span> 円+税</span>\
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
		$(document).on('change' , 'input[name="deposit_money"]' , function(){
			$('#price1').text($(this).val());
			$('#price2').text(parseFloat($(this).val()) + ($(this).val())*0.05);
		});
		$(document).on('keyup' , 'input[name="deposit_money"]' , function(){
			$('#price1').text($(this).val());
			$('#price2').text(parseFloat($(this).val()) + ($(this).val())*0.05);
		});
		$('#datepickermodal').datepicker({
	    	language : 'ja-JP',
	        inline: true,
	        sideBySide: true,
	        todayHighlight: true,
	        format: "yyyy年mm月dd日"
	    });
	</script>
@endsection