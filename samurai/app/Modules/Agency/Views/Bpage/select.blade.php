@extends('layouts.home')
@section('style')
	<link rel="stylesheet" href="/assets/agency/css/b_select.css">
@endsection
@section('content')
<div class="mainpage">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				{{-- @includeIf('partials.breadcrumb', ['title' => '手動マッチング']) --}}
				<div class="bre">
					<a href="{{route('agency.index')}}">TOPページ</a>＞お知らせ一覧＜お知らせ詳細
				</div>
			</div>
		</div> <!-- end .row -->
		<div class="row">
			<div class="col-sm-10">
				<p class="stitle1">{!! $policy_data->name !!}</p>
				<p class="stitle2">{!! $policy_data->name !!}</p>
			</div>
			<div class="col-sm-2">
				<div class="text-right">
					{{!! Button::getBookmarkButton($policy_data) !!}}
				</div>
			</div>
		</div><!-- end .row -->
		<div class="row">
			<div class="col-sm-12">
				<p class="sdesc">登録機関:{!! $policy_data->minitry_text() !!}<span>更新日:{!! $policy_data->update_date !!}</span><span>掲載終了予定日:{!! date('Y年m月d日', strtotime($policy_data->subscript_duration_detail)) !!}</span></p>	
			</div>
			<div class="col-sm-12 mgt-20 mgbt-20">
				<ul class="tag-list">
					@if ($policy_data->tags)
					@foreach($policy_data->tags as $key => $tag)
					<li><span>{{str_limit($tag->tag,10)}}</span></li>
					@endforeach
					@endif
				</ul>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="row">
					<div class="col-sm-12 subsidydetail">
						<div class="row">
							<div class="col-xs-8 left-detail">
								<div class="sdetail">
									<div class="box-text">
										<p class="sdetail-title">目的</p>
										{!! $policy_data->target !!}
									</div>

									<div class="box-text">
										<p class="sdetail-title">支援内容</p>
										{!! $policy_data->support_content !!}
									</div>

									
									@if($policy_data->support_scale)
									<div class="box-text">
										<p class="sdetail-title">支援規模</p>
										{!! $policy_data->support_scale !!}
									</div>
									@endif
									
									
									<div class="box-text">
										<p class="sdetail-title">募集期間</p>
										{!! $policy_data->subscript_duration !!}
									</div>

									
									@if($policy_data->object_duration)
									<div class="box-text">
										<p class="sdetail-title">対象期間</p>
										{!! $policy_data->object_duration !!}
									</div>
									@endif
									

									<div class="box-text">
									<p class="sdetail-title sdetailbd">対象者の詳細</p>
									{!! $policy_data->info !!}
									</div>

									<div class="box-text">
										<p class="sdetail-title sdetailbd">対象地域</p>
										{{$policy_data->region_text()}}
									</div>

									@if($policy_data->adopt_result)
									<div class="box-text">
										<p class="sdetail-title">採択結果</p>
										{!! $policy_data->adopt_result !!}
									</div>
									@endif

									@if(@count(json_decode($policy_data->register_pdf, true)))
										<div class="box-text">
										<p class="sdetail-title">pdfデータ</p>	
									@endif
									
									@if(@count(json_decode($policy_data->register_pdf, true)))
										<p>
										@if(isset(json_decode($policy_data->register_pdf, true)['url']))
											@foreach(json_decode($policy_data->register_pdf, true) as $register_pdf)
												<a href="{{ url('/download/'.$register_pdf['url']) }}" class="aline">{{$register_pdf['name']}}</a>
											@endforeach
										@else
											<a href="{{json_decode($policy_data->register_pdf, true)[0][1]}}" class="aline">{{json_decode($policy_data->register_pdf, true)[0][0]}}</a>
										@endif
										</p>
										@if(count(json_decode($policy_data->register_pdf1, true)))
											@foreach(json_decode($policy_data->register_pdf1, true) as $key => $register_pdf1)
												<a href="{{@$register_pdf1['url']}}" class="aline">{{@$register_pdf1['name']}}</a>
											@endforeach
										@endif
										</div>
									@endif
									
									<div class="box-text">
										<p class="sdetail-title">お問い合せ</p>
										{!! nl2br($policy_data->inquiry) !!}
									</div>
								</div><!-- end .sdetail -->
							</div><!-- end left-detail -->
							<div class="col-xs-4">
								<table class="table table-bordered text-center listuserbid mgbt-0 mgt-30">
									<tbody>
										<tr>
											<td>
												<input type="checkbox" name="checkall" class="checkall" data-check="usercheck">
												{{Form::hidden('policy_id[]', $policy_data->id)}}
												</td>
											<td>
												<button type="submit" @if(count($policy_data->hire)) disabled="" @endif class="btn btn-default baskbutton submitbask">事業者に提案する</button>
											</td>
										</tr>
									</tbody>
								</table>
								@if($results)
								@foreach($results as $key => $val)
								<table class="table table-bordered listuserbid">
									<tbody>
										<tr>
											<td>
												<input type="checkbox" name="usercheck[]" class="usercheck" data-id="check_{{$val->id}}" value="{{$val->id}}">
												</td>
											<td class="create-link-box">
												<a href="{{route('agency.profile.view',[$val->id])}}"></a>
												<div class="subsidylist-item-av">
													<img src="{{url($val->image)}}" alt="">
													<div class="itemav-info">
														<p>事業者名: {{ str_limit($val->displayname, 20) }}</p>
														<div class="clearfix">
															<span class="pull-left">実績     ：</span>
															<div class="pull-left star-rating fbrtdiv-{{$key}}">
															    <select class="fbrtsl-{{$key}}" data-current-rating="{{$val->evaluate}}" name="rating" autocomplete="off">
															        <option value=""></option>
															        <option value="1">1</option>
															        <option value="2">2</option>
															        <option value="3">3</option>
															        <option value="4">4</option>
															        <option value="5">5</option>
															    </select>
															</div>
														</div>
														<p>実績：{{$val->result}}件</p>
													</div>
			                                    <div class="clearfix"></div>
												<p>{{$val->self_intro}}</p>
											</div>
											</td>
										</tr>
									</tbody>
								</table>
								@endforeach
								@endif
								
							</div><!-- end .col-xs-4 -->
						</div> <!-- end .row -->
						<div class="row">
							<div class="col-sm-12">
								<div class="text-center mgt-30 mgbt-30">
									<button  @if(count($policy_data->hire)) disabled="" @endif  type="submit" class="btn btn-default baskbutton submitbask">事業者に提案する</button>
								</div>
							</div>
						</div>
					</div> <!-- end .subsidydetail -->
				</div> <!-- end .row -->
			</div> <!-- .col-sm-12 -->
		</div> <!-- end .row -->
		<div class="modal fade" id="modal-Bask">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-body" id="modal-baskform-content">
						{{ Form::open(['url' => route('agency.bask.messbutton'), 'method' => 'POST', 'id'=>'formID', 'enctype'=>'multipart/form-data']) }}
							{{Form::hidden('searchtype', 1)}}
							{{Form::hidden('cost_agency', '0')}}
							{{Form::hidden('policy_id[]', $policy_data->id)}}
							{{Form::hidden('client_pay','', ['id'=>'client_pay'])}}
							<div id="list_user_matching">
								<div class="row">
								@if($results)
									@foreach($results as $key => $val)
									<div class="col-sm-4 itemusermodal">
										<table class="table table-bordered listuserbid">
											<tbody>
												<tr>
													<td>
														<input type="checkbox" name="usercheck[]" class="usercheckmodal" id="check_{{$val->id}}" value="{{$val->id}}">
														</td>
													<td class="create-link-box-1" data-dismiss="modal">
														<a href="{{route('agency.RequestDetails',['policy_id'=>$policy_data->id, 'user_id'=>$val->id])}}"></a>
														<div class="subsidylist-item-av">
															<img class="avatar-pp" src="{{url($val->image)}}" alt="">
															<div class="itemav-info">
																<p>事業者名{{ str_limit($val->displayname, 20) }}</p>
																<div class="clearfix">
																	<span class="pull-left">実績     ：</span>
																	<div class="pull-left star-rating fbrtdiv-{{$key}}">
																	    <select class="fbrtsl-{{$key}}" data-current-rating="{{$val->evaluate}}" name="rating" autocomplete="off">
																	        <option value=""></option>
																	        <option value="1">1</option>
																	        <option value="2">2</option>
																	        <option value="3">3</option>
																	        <option value="4">4</option>
																	        <option value="5">5</option>
																	    </select>
																	</div>
																</div>
																<p>実績：{{$val->result}}件</p>
															</div>
														</div>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								@endforeach
								@endif
								</div>
							</div>
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
															<p>※着手金が必要な場合のみご記入ください。</p>
														</td>
													</tr>
													<tr>
														<td>予算</td>
														<td>
															{{Form::number('deposit_money','', ['id'=>'deposit_money'])}}<span> 円</span>
															<p>※仕事内容によって成功報酬が変動する場合、あとから変更することが可能です。</p>
														</td>
													</tr>
													<tr>
														<td>報酬金額</td>
														<td>
															{{Form::number('agency_estimate','', ['id'=>'agency_estimate', 'min'=>0])}}<span> 円</span>
															<p>※着手金が必要な場合のみご記入ください。</p>
														</td>
													</tr>
													<tr>
														<td colspan="2">
															<p>提案内容</p>
															{{Form::textarea('mess')}}
														</td>
													</tr> 
												</tbody>
											</table>
											<table id="baskconfirmtable"></table>
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
							<p class="text-center" id="allbutbask">
								<button type="button" class="btn btn-default" data-dismiss="modal">戻る</button>
								<button type="button" id="BaskAjaxConfirm" class="btn btn-default baskbutton">内容を確認する</button>
							</p>
						{{ Form::close() }}
						
					</div>
				</div>
			</div>
		</div>
	</div> <!-- end .container -->
</div> <!-- end .mainpage -->
@endsection
@section('script')
	<script src="/assets/agency/js/b_select.js"></script>
	<script type="text/javascript">
		var count_fb = {{count($results)}};
		$(document).ready(function() {
			for( i = 0; i < count_fb; i++)
			{
				starRatingInit('.fbrtdiv-'+i, '.fbrtsl-'+i);
			}
		});
		$(document).on('click' , '.submitbask' , function(){
			if(!$('input.usercheck:checked').length) {
				alert('一つ以上の事業者を選択してください。');
				return false;
			}else{

				$('#modal-Bask').modal('show');
			}
		});
		$(document).on('click' , '#BaskAjaxSubmit' , function(){
			if(!$('input.usercheckmodal:checked').length) {
				alert('一つ以上の事業者を選択してください。');
				return false;
			}else{
				var data = new FormData($('form#formID')[0]);
				$.ajax({
				    url: '{{route('agency.bask.messbutton')}}',
				    data: data,
				    cache: false,
				    contentType: false,
				    processData: false,
				    method: 'POST',
				    type: 'json', // For jQuery < 1.9
				    success: function(data){
				    	var rs = JSON.parse(data);
				    	console.log(data);
				    	var base_url = window.location.origin;
				    	var url = base_url+'/agency/mypage/recruitment/received/'+rs['hire_id'];
			    		var str = '<div class="basksuccess text-center">\
							<h2>'+rs['count']+'社の事業者があなたからの提案を受け取とりました。</h2>\
							<p>\
								仕事管理から事業者とSAMURAI内チャットでコンタクトを取ることができます。<br>\
								SAMURAIでは事業者との直接のやりとりを禁止しております。予めご了承ください\
							</p>\
							<p>\
								着手金がある場合の支払いが完了するまで、事業者は仕事管理の内容を見ることができません。\
							</p>\
							<p >\
								<a href="'+url+'" class="btn btn-success">仕事管理を見る</a>\
							</p>\
						</div><p class="text-center"><button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button></p>';
						$('#modal-baskform-content').html(str);	
				    }
				});
				// return false;
				// $('#modal-Bask').modal('show');
			}
		});
		var savestr = '';
		$(document).on('click' , '#BaskAjaxConfirm' , function(){
			if(!$('input.usercheckmodal:checked').length || !$('input[name="deli_date"]').val() || !$('input[name="deposit_money"]').val() || !$('input[name="agency_estimate"]').val()) {
				alert('一つ以上の事業者を選択してください。');
				return false;
			}else{
				var deli_date = $('input[name="deli_date"]').val();
				var deposit_money = $('input[name="deposit_money"]').val();
				var agency_estimate = $('input[name="agency_estimate"]').val();
				var mess = $('textarea[name="mess"]').val();
				var str = '<tbody>\
					<tr>\
						<td>納期</td>\
						<td>\
							<span>'+deli_date+'</span>\
						</td>\
					</tr>\
					<tr>\
						<td>予算</td>\
						<td>\
							<span>'+deposit_money+'</span><span> 円</span>\
						</td>\
					</tr>\
					<tr>\
						<td>報酬金額</td>\
						<td>\
							<span>'+agency_estimate+'</span><span> 円</span>\
						</td>\
					</tr>\
					<tr>\
						<td colspan="2">\
							<p>提案内容</p>\
							<div class="messcontent">'+mess+'</div>\
						</td>\
					</tr> \
				</tbody>';
				var but = '<button type="button" class="btn btn-default" id="Baskformback">修正する</button>\
					<button type="button" id="BaskAjaxSubmit" class="btn btn-default baskbutton">この内容で提案する</button>';

				$('#baskconfirmtable').html(str);
				$('#baskconfirmtable').show();
				$('#baskinputtable').hide();
				$('#allbutbask').html(but);
			}
		});
		$(document).on('click' , '#Baskformback' , function(){
			var but = '<button type="button" class="btn btn-default" id="Baskformback"  data-dismiss="modal">戻る</button>\
					<button type="button" id="BaskAjaxConfirm" class="btn btn-default baskbutton">内容を確認する</button>';

				$('#baskinputtable').show();
				$('#baskconfirmtable').hide();
				$('#allbutbask').html(but);
		});
		// $(document).on('change' , 'input[name="deposit_money"]' , function(){
		// 	$('#price1').text($(this).val());
		// 	$('#price2').text($(this).val()*5);
		// });
		// $(document).on('keyup' , 'input[name="deposit_money"]' , function(){
		// 	$('#price1').text($(this).val());
		// 	$('#price2').text(parseFloat($(this).val()) + ($(this).val())*0.05);
		// });
		$(document).on('change' , '.usercheck' , function(){
			var data_id = $(this).attr('data-id');
			if($(this).is(':checked')) {
				$('input#'+data_id).prop('checked', true).trigger('change');
				$('input#'+data_id).attr('disabled', false).trigger('change');
				$('input#'+data_id).closest('.itemusermodal').show();
			}else{
				$('input#'+data_id).prop('checked', false).trigger('change');
				$('input#'+data_id).attr('disabled', true).trigger('change');
				$('input#'+data_id).closest('.itemusermodal').hide();
			}
		});
		$('#datepickermodal').datepicker({
	    	language : 'ja',
	        inline: true,
	        sideBySide: true,
	        todayHighlight: true,
	        format: "yyyy年mm月dd日"
	    });
		var sitefee = 5.5;
		var total1;
		var total2;
		var modalCalculator = function() {
			var deposit_money = $('#deposit_money').val();
			var agency_estimate = $('#agency_estimate').val();
			if(deposit_money != '' ) deposit_money = parseInt(deposit_money);
			if(agency_estimate != '' ) agency_estimate = parseInt(agency_estimate);
			total1 = agency_estimate;
			total2 = Math.ceil(total1 + ((total1*sitefee)/100));
			$('#total1').text(total1);
			$('#total2').text(total2);
			$('#client_pay').val(total2);
		}
		$('#deposit_money').change(function(event) {
			modalCalculator();
		});
		$('#agency_estimate').change(function(event) {
			modalCalculator();
		});
		$(document).ready(function() {
			modalCalculator();
		});

	</script>
@endsection