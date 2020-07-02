@extends('layouts.home')
@section('style')
	<link rel="stylesheet" href="/assets/user/agency/css/b_subsidylist.css">
@endsection
@section('content')
<div class="mainpage">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				@includeIf('partials.breadcrumb', ['title' => '施策登録'])
			</div>
		</div>
		<div class="row">
	        <div class="col-sm-12">
	            <p class="text-step "><b>対応可能施策の登録</b>
	            </p>
	        </div>
	    </div>
	    <div class="col-sm-12">
	    	<div class="row">
	    		<ul class="nav nav-tabs tab-1"> 
                    <li class="tab-style-grey">
                        <a href="{{route('agency.csetbalance')}}?{{$param}}">対応可能施策の登録</a>
                    </li>                                     
                    <li class="tab-style-grey active">
                        <a href="">対応可能施策一覧</a>
                    </li> 
                </ul>
	    	</div>
	    </div>
        {{ Form::open(['url' => route('agency.editmatching'), 'method' => 'POST', 'id'=>'formID', 'enctype'=>'multipart/form-data']) }}
		<div class="row subsidy-list mgt-20">
			<div class="col-sm-12">
				@foreach($results as $val)
				<div class="subsidy-list-item">
					<div class="row">
						<div class="col-sm-10">
							<div class="row">
								<div class="col-sm-1 mgt-20">
									<label><input type="radio" class="subsidyid" name="subsidyid" value="{{$val->policy->id}}" name=""></label>
									<input type="hidden" value="{{$val->policy->id}}" name="policy_id">
								</div>
								<div class="col-sm-2 mgt-20">
									<img src="{{ url($val->policy->image_id) }}" alt="">
								</div>
								<div class="col-sm-9">
									<div class="index-boxcol2-sub">
											<div class="boxlinkout">
												<p>
													<span class="sidy-tbig">{{str_limit($val->policy->name,46)}}</span><br>
													<strong>発行機関:</strong><span>{{str_limit($val->policy->register_insti_detail,20)}}</span>/
													<strong>対象地域:</strong><span>{{str_limit($val->policy->subscript_duration , 20)}}</span><br>
												</p>
												<span>{{str_limit($val->policy->target, 160)}}</span>
											</div> <!-- end .create-link-box -->
											
											<div class="middle-boxcol2">
												{!! Button::getFavourButtons($val->policy->id) !!}
											</div> <!-- end .middle-boxcol2 -->
									</div> <!-- end item index-boxcol2 -->
								</div>	<!-- end col-sm-10 -->
							</div> <!-- end .row -->
						</div>	<!-- end col-sm-10 -->
						<div class="col-sm-2 text-center">
							@if($val)
							<div class="box-yelow3 mgt-20 mgbt-20">
								<p>書類代行　<strong>{{$val->document_business_price}}円</strong></p>
								<p>成功報酬 <strong>{{$val->request_business_price}}円</strong></p>
								<p>着手金　　　<strong>{{$val->deposit_money}}円</strong></p>
								<p>その他　　　<strong>{{$val->other_money}}円</strong></p>
							</div>
                            @endif
						</div>
					</div> <!-- end .row -->
				</div> <!-- end .sidylist-item -->
				@endforeach
				<div class="clearfix"></div>
				 <div class="text-center bsearch-btn-s">
                    <button type="button" id="submit_edit" class="submit-ask btn btn-success btn-style-shadow-green" style="margin-right :10px;">編集する</button>
			    	<button id="delete_matching" class="btn btn-default btn-style-shadow-grey" type="button">削除する</button>
                </div>
			</div> <!-- end .div.col-sm-12 -->

		</div> <!-- end .row -->
		<div id="form_edit">
		<div class="row">
	        <div class="col-sm-12">
	            <p class="text-step "><b>施策対応費用の設定</b></p>
	        </div>
	    </div>
	    <div class="row">
            <div class="col-sm-8">
                <table class="table table-bordered bask-page">
					<tbody>
						<tr>
							<td width="20%" class="div-style-blue2 text-primary">
								<select class="form-control" id="selecttab">
									@if($saved_budgets)
									@foreach($saved_budgets as $index => $saved_budget)
										<option value="tab_{{$index+1}}" @if($index==0) selected="" @endif>登録内容{{$index+1}}</option>
									@endforeach
									@endif
								</select>

							</td>
							<td>
								@if($saved_budgets)
								@foreach($saved_budgets as $index => $saved_budget)
								<table id="tab_{{$index+1}}" class="table dsubtable table-borderless tabtable @if($index > 0) tabhide @endif">
									{{Form::hidden('document_business_type', $saved_budget['document_business_type'])}}
									{{Form::hidden('request_business_type', $saved_budget['request_business_type'])}}
									<tbody class="list-rows">
										<tr>
											<td>業務内容</td>
											<td>
												<div class="checkbox">
													<label>
														<input type="checkbox" name="document_business_flag" value="1" class="dcheck-dis dother-cost" @if(@$saved_budget['document_business_flag']) checked="checked" @endif >書類代行費用
													</label>
												</div> <!-- end .checkbox -->
											</td>
											<td>
												<div class="input-group">
													<input type="number" min="0" value="{{@$saved_budget['document_business_price']}}" class="form-control dother-cost" placeholder="金額" name="document_business_price" @if(!@$saved_budget['document_business_flag']) readonly="" @endif >
													<span class="input-group-addon">円</span>
												</div>
											</td>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td></td>
											<td>
												<div class="checkbox">
													<label>
														<input type="checkbox"  @if(@$saved_budget['request_business_flag']) checked="checked" @endif  value="1" name="request_business_flag" class="dcheck-dis dother-cost">報酬
													</label>
												</div>
											</td>
											<td>
												<div class="input-group">
													<input type="number" value="{{@$saved_budget['request_business_price']}}"" name="request_business_price" min="0" max="100" value="0" class="form-control dother-cost" placeholder="金額"  @if(!@$saved_budget['request_business_flag']) readonly="" @endif >
													<span class="input-group-addon">%</span>
												</div>
											</td>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td>着手金</td>
											<td>着手金</td>
											<td>
												<div class="input-group">
													<input  type="number" min="0" value="{{$saved_budget['deposit_money']}}" class="form-control dother-cost" name="deposit_money" placeholder="金額">
													<span class="input-group-addon">円</span>
												</div>
											</td>
											<td>&nbsp;</td>
										</tr>
										@php
											$othertt = 0;
										@endphp
										@for($i=0; $i<5; $i++)
										<tr style="border-top: 1px solid #ddd">
											<td>@if($i==0) その他費用 @endif</td>
											<td></td>
											<td>
												<input type="text" value="{{$saved_budget['content_type'][$i]['moneyname']}}" name="dother_cost_t{{$i+1}}" class="form-control" placeholder="費用名">
											</td>
											<td>
												<div class="input-group">
													<input type="number" value="{{$saved_budget['content_type'][$i]['moneyvalue']}}" class="form-control dother-cost" name="dother_cost_i{{$i+1}}" placeholder="金額">
													<span class="input-group-addon">円</span>
												</div>
											</td>
										</tr>
											@php
												$othertt += (int)$saved_budget['content_type'][$i]['moneyvalue'];
											@endphp
										@endfor
										<tr>
											@php

												$totals = (int)@$saved_budget['document_business_price'] + (int)@$saved_budget['deposit_money'] + (int)@$$othertt;
											@endphp
											<td></td>
											<td><strong>合計</strong></td>
											<td></td>
											<td class="text-right">
											<input type="hidden" name="other_money" id="other_money" value="0">
											<span class="total-value">{{$othertt}}</span> 円</td>
										</tr>
										<tr>
											<td colspan="4">
												<div align="right">
			                                        <font color="#ff0000" font="" size="2px">※クライアント支払金額から事務手数料5.5％が差し引かれます</font>
			                                    </div>
											</td>
										</tr>
										<tr class="tr-bg-pink">
											<td>クライアント支払金額</td>
											<td colspan="3" class="text-center"><span class="total_val_page">{{$totals}}</span> 円 + (取得助成金・補助金総額の）  <span class="total_pc_page">{{@$saved_budget['request_business_price']}}</span>％</td>
										</tr>
									</tbody>
								</table>
								@endforeach
								@endif
							</td>
						</tr>
					</tbody>
				</table> <!-- end table bid price -->
            </div>
        </div>
        <div class="row text-center mgt-30 mgbt-50">
        	<div class="col-sm-12">
			    <button type="submit" id="submit_csetbalance" class="submit-ask btn btn-success btn-style-shadow-green" style="margin-right :10px;">適用する</button>
		    </div>
		</div>
		</div>
		{{ Form::close() }}
	</div> <!-- end .container -->
</div> <!-- end .mainpage -->
<div class="clearfix"></div>
<div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg modal-dialog-centered text-center" role="document">
	    <div class="modal-content" style="height: 491.4px;">
	        <div class="modal-header text-center">
	            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                <span aria-hidden="true">×</span>
	            </button>
	            <h5 class="modal-title">マニュアル</h5>
	        </div>
	        <div class="modal-body">
	            <iframe width="100%" height="100%" src="{{URL::to('/manuals/registration_policy3/operationlecture.html')}}" frameborder="0"></iframe>
	        </div>
	    </div>
	</div>
</div>
@endsection
@section('script')
	<script>
		$(document).ready(function(){
			$('.checkboxcpart').each(function(){
				if($(this).find('input').is(':checked')) {
					$(this).find('label').removeClass('btn-success');
					$(this).find('label').removeClass('btn-style-shadow-green');
					$(this).find('label').addClass('btn-default');
					$(this).find('label').addClass('btn-style-shadow-grey1');
					$(this).find('label').text('選択中');
				}else{
					$(this).find('label').removeClass('btn-default');
					$(this).find('label').removeClass('btn-style-shadow-grey1');
					$(this).find('label').addClass('btn-success');
					$(this).find('label').addClass('btn-style-shadow-green');
					$(this).find('label').text('選択する');
				}
			});
			$('.tabtable').find('input').attr('disabled', true);
			$('.tabtable').hide();
			$('#tab_1').show();
			$('#tab_1').find('input').attr('disabled', false);
		});
		$(document).on('change', '.checkboxcpart', function(){
			if($(this).find('input').is(':checked')) {
				$(this).find('label').removeClass('btn-success');
				$(this).find('label').removeClass('btn-style-shadow-green');
				$(this).find('label').addClass('btn-default');
				$(this).find('label').addClass('btn-style-shadow-grey1');
				$(this).find('label').text('選択中');
			}else{
				$(this).find('label').removeClass('btn-default');
				$(this).find('label').removeClass('btn-style-shadow-grey1');
				$(this).find('label').addClass('btn-success');
				$(this).find('label').addClass('btn-style-shadow-green');
				$(this).find('label').text('選択する');
			}
		});
		$('.submit-ask').click(function() {
			var id = $('#selecttab').val();
			// if(!$('#'+id+' input[name="document_business_flag"]').is(":checked") && !$('#'+id+' input[name="request_business_flag"]').is(':checked'))
			// {
			// 	alert("費用を正確に入力してください。");
			// 	return;
			// }
			if($('#'+id+' input[name="deposit_money"]').val()<0) {
                alert("すべての項目を正確に入力してください!");
                return false;
            }
			if($('#'+id+' input[name="document_business_flag"]').is(":checked"))
			{
				if($('#'+id+' input[name="document_business_price"]').val())
				{
					if($('#'+id+' input[name="document_business_price"]').val() < 0)
					{
						alert("すべての項目を正確に入力してください!");
						return;
					}
					if($('#'+id+' input[name="document_business_price"]').val() > 100 && document_business_type == 1)
					{
						alert("すべての項目を正確に入力してください!");
						return;
					}
				} else {
					alert("すべての項目を正確に入力してください!");
					return;
				}
			} else {
				request_business_price = 0;
			}
			if($('#'+id+' input[name="deposit_money"]').val()) {
				if($('#'+id+' input[name="deposit_money"]').val() == 0) {
					alert("すべての項目を正確に入力してください!");
					return;
				}
			}
		});
		$(document).on('click', '#removeitemcheck', function() {
			$('input.subsidyid:checked').each(function(){
				$(this).closest('.subsidy-list-item').remove();
			})
		});
		$(document).on('click', '#removeitemall', function() {
			$('.subsidy-list-item').remove();
		});
		$(document).on('change', '#selecttab', function(){
			var id = $(this).val();
			$('.tabtable').find('input').attr('disabled', true);
			$('.tabtable').hide();
			$('#'+id).show();
			$('#'+id).find('input').attr('disabled', false);
		});
		$(document).on('change', '.subsidyid', function(){
			$('.subsidy-list-item').removeClass('active');
			if($(this).is(':checked')) {
				$(this).closest('.subsidy-list-item').addClass('active');
			}else{
				$(this).closest('.subsidy-list-item').removeClass('active');
			}
			
		});
		$(document).on('click', '.hiddenitem', function(){
			$(this).closest('.subsidy-list-item').remove();
			
		});


		$('.dcheck-dis').change(function() {
			var input_parent = $(this).parents('td').next().find('input[type="text"],input[type="number"]');
			if($(this).is(':checked')) {
				input_parent.attr('readonly', false).trigger('change');
			} else {
				input_parent.attr('readonly', true).trigger('change');
			}
			if(input_parent.prop('type') == 'number') input_parent.val('0');
			else input_parent.val('');
			all_cal();
		});
		$(document).on('keyup', '.dother-cost', function(){
			var obj = $(this);
			var total = 0;
			for (var i = 1; i <= 5; i++) {
				total += parseInt(obj.closest('table').find('input[name="dother_cost_i'+i+'"]').val());
			}
			var percen = parseInt(obj.closest('table').find('input[name="request_business_price"]').val());
			obj.closest('table').find('.total-value').text(total);
			obj.closest('table').find('#other_money').val(total);
			obj.closest('table').find('.total_pc_page').text(percen);
			var business_price = parseInt(obj.closest('table').find('input[name="document_business_price"]').val());
			isNaN(business_price)? 0: business_price;
			var deposit_money = parseInt(obj.closest('table').find('input[name="deposit_money"]').val());
			obj.closest('table').find('.total_val_page').text(business_price+total+deposit_money);

		});
		$(document).on('change', '.dother-cost', function(){
			var obj = $(this);
			var total = 0;
			for (var i = 1; i <= 5; i++) {
				total += parseInt(obj.closest('table').find('input[name="dother_cost_i'+i+'"]').val());
			}
			var percen = parseInt(obj.closest('table').find('input[name="request_business_price"]').val());
			obj.closest('table').find('.total-value').text(total);
			obj.closest('table').find('#other_money').val(total);
			obj.closest('table').find('.total_pc_page').text(percen);
			var business_price = parseInt(obj.closest('table').find('input[name="document_business_price"]').val());
			if(isNaN(business_price)) business_price = 0;
			var deposit_money = parseInt(obj.closest('table').find('input[name="deposit_money"]').val());
			obj.closest('table').find('.total_val_page').text(business_price+total+deposit_money);
		});
		$(document).on('click', '.dother-cost', function(){
			var obj = $(this);
			var total = 0;
			for (var i = 1; i <= 5; i++) {
				total += parseInt(obj.closest('table').find('input[name="dother_cost_i'+i+'"]').val());
			}
			var percen = parseInt(obj.closest('table').find('input[name="request_business_price"]').val());
			obj.closest('table').find('.total-value').text(total);
			obj.closest('table').find('#other_money').val(total);
			obj.closest('table').find('.total_pc_page').text(percen);
			var business_price = parseInt(obj.closest('table').find('input[name="document_business_price"]').val());
			isNaN(business_price)? 0: business_price;
			var deposit_money = parseInt(obj.closest('table').find('input[name="deposit_money"]').val());
			obj.closest('table').find('.total_val_page').text(business_price+total+deposit_money);
		});
		$(document).on('click', '#submit_edit', function(){
			if(!$('input.subsidyid:checked').length) {
                alert("一つ以上の施策を選択してください。");
            }else{
            	$('#form_edit').show();
            }
		});

		$(document).on('click', '#delete_matching', function(){
			if(!$('input.subsidyid:checked').length) {
                alert("一つ以上の施策を選択してください。");
            }else{
            	var url = "{{route('agency.deletematching')}}";
            	var id = $('input.subsidyid:checked').val();
            	url += '/'+id;
            	$.confirm({
				    title: '対応可能施策一覧からも削除されますがよろしいですか？',
				    content: "",
				    typeAnimated: true,
				    boxWidth: '700px',
				    useBootstrap: false,
				    buttons: {
				        tryAgain: {
				            text: 'いいえ',
				            action: function(){
				            	window.location.href = url;
				            }
				        },
				        close: {
				            text: 'はい',
				            action: function(){
				            	this.close();
				            }
				        },
			    	}
				});
            }
		});
		
	</script>
@endsection