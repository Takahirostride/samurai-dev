@extends('layouts.home')
@section('style')
	<link rel="stylesheet" href="/assets/agency/css/b_ask.css">
@endsection
@section('content')
<div class="mainpage">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				@includeIf('partials.breadcrumb', ['title' => '提案する'])
			</div>
		</div> <!-- end .row -->
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">提案する助成金の報酬体系/提案する企業の選択</h1>
			</div>
		</div> <!-- end .row -->
		<div class="row">
			<div class="col-sm-12">
				<ul class="dtabprofile tab-profile nav nav-tabs">
					<li class="tab-style-grey"><a  href="#bselecttab" aria-controls="bselecttab" role="tab" data-toggle="tab"> 施策詳細</a></li>
					<li class="tab-style-grey active"><a href="#basktab" aria-controls="basktab" role="tab" data-toggle="tab"> 依頼詳細</a></li>
				</ul>
				<div class="row">
					<div class="col-sm-12 ">
						<div class="row">
							<div class="col-xs-8 left-detail">
								<div class="tab-content">
									<div role="tabpanel" class="tab-pane active" id="basktab">
										<p class="stitle1-only">渋谷区の中小企業事業資金融資あっせん制度（運転資金）
										<a href="#myModal" data-toggle="modal" data-target="#myModal"><img src="/assets/common/images/manual.png" style="cursor:pointer;" height="20px"></a>
										</p>
										{{ Form::open(['url' => route('agency.bask.messbutton'), 'method' => 'POST', 'id'=>'formID', 'enctype'=>'multipart/form-data']) }}
											{{Form::hidden('searchtype', 1)}}
											{{Form::hidden('cost_agency', '0')}}
											{{Form::hidden('flag', '0')}}
											@if(is_array($policy_id))
												@foreach($policy_id as $poli_id)
													{{Form::hidden('policy_id[]', $poli_id)}}
												@endforeach
											@else
												{{Form::hidden('policy_id[]', $policy_id)}}
											@endif
											<h4 class="pagerow-title">
												<span>依頼内容を入力する</span>
												<button type="submit" id="dmsgsubmit" class="btn-primary btn btn-style-shadow-green btn-success right-title">メッセージを送る</button>
												<input id="to_id" type="hidden" name="to_ids" value='{{$datato['to_id']}}'>
											</h4>
											<div class="messscroll" id="messscroll">
												<table class="table table-bordered mgbt-0">
			                                        <tbody id="messageslist">
			                                            
			                                        </tbody>
			                                    </table>
											</div>
											<div class="dmsgbox">
												<div class="row">
													<div class="col-sm-12">
					                                    <div class="col-sm-4">
					                                        <hr>
					                                    </div>
					                                    <h5 class="text-center col-sm-3">{{date('Y年m月d日')}}</h5>
					                                    <div class="col-sm-5">
					                                        <hr>
					                                    </div>
					                                </div>
				                                </div>
												<div class="dmsg-to" id="dmsg-to">
													<p>{{$datato['to']}}</p>
												</div>
												<div class="dmsg-files">
													<button type="button" class="msg-files-button"><i class="glyphicon glyphicon-paperclip"></i></button>
													<input type="file" id="msg-files" name="attachment[]" multiple>
													<p class="dfile-list"></p>
												</div>
												<div class="dmsg-mess">
													<textarea class="form-control" name="contentmess" id="contentmess" rows="3" placeholder="ここにメッセージを入力してください"></textarea>
												</div>
											</div> <!-- end .dmsgbox -->
									
											<h4 class="pagerow-title">
												<span>予算目安を入力する</span>
												<button type="button" id="submit-ask1" class="submit-ask btn-primary btn btn-style-shadow-green btn-success right-title">費用を提案する</button>
											</h4>
											<table class="table table-bordered bask-page">
												<tbody>
													<tr>
														<td width="20%" class="div-style-blue2 text-primary">
															<select class="form-control" id="selecttab">
																@if($saved_budgets)
																@foreach($saved_budgets as $index => $saved_budget)
																	<option value="tab_{{$index+1}}" @if($index==0) selected="" @endif >登録内容{{$index+1}}</option>
																@endforeach
																@endif
															</select>
														</td>
														<td>

															<div class="text-right">
																<div class="checkbox dborder-check">
																	<label>
																		<input type="checkbox" value="1" class="cost_agency" name="cost_agency">マッチング条件を提案
																	</label>
																</div>
															</div>
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
																				<input type="number" min="0" value="{{$saved_budget['deposit_money']}}" class="form-control dother-cost" name="deposit_money" placeholder="金額">
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
										{{ Form::close() }} <!-- end 2nd-form -->
										<div class="dintr">
											<p>・予算目安を送信することで、補助金・助成金取得費用を士業の方に伝えることができます。</p>
											<p>・郵送費、交付手数料等の実費のみ、その他の費用とすることができます。</p>
											<p>・最終条件を提示する場合（マッチング成立）は、 
												<span class="checkbox dinline-el dborder-check">
													<label>
														<input type="checkbox" disabled="disabled">マッチング条件を提案
													</label>
												</span>
												にチェックをいれて提案してください。士業の方が、
												<button type="button" class="btn-primary btn btn-xs btn-style-shadow-green btn-success dsm-button">マッチングする</button>
												をクリックすると、 業務開始されます。
											</p>
										</div>
									</div><!-- end left-detail -->
									<div role="tabpanel" class="subsidydetail  tab-pane" id="bselecttab">
										<p class="stitle1">{!! $policy_data->name !!}</p>
										<p class="stitle2">{!! $policy_data->name !!}</p>
										<p class="sdesc">登録機関:{!! $policy_data->minitry_text() !!}<span>更新日:{!! $policy_data->update_date !!}</span></p>
										<div class="middle-boxcol2">
											{!! Button::getFavourButtons($policy_data->id) !!}
										</div> <!-- end .middle-boxcol2 -->
										<div class="sdetail">
											<p class="sdetail-title">目的</p>
											{!! $policy_data->target !!}
											<p class="sdetail-title">対象者の詳細</p>
											{!! $policy_data->info !!}
											<p class="sdetail-title">支援内容</p>
											{!! $policy_data->support_content !!}
											<p class="sdetail-title">支援規模</p>
											<table class="table table-bordered support-scale text-center">
												<tbody>
													<tr>
														<td width="33%">下限</td>
														<td width="33%">上限</td>
														<td width="33%">助成率</td>
													</tr>
													<tr>
														<td class="text-center std"><span class="fake-input">{!! $policy_data->support_scale_lower_limit !!}</span></td>
														<td class="text-center std"><span class="fake-input">{!! $policy_data->support_scale_upper_limit !!}</span></td>
														<td class="text-center std"><span class="fake-input">{!! $policy_data->support_scale_subsidy_duration !!}</span></td>
													</tr>
												</tbody>
											</table>
											{!! $policy_data->support_scale !!}
											@if($policy_data->subscript_duration)
											<p class="sdetail-title">募集期間</p>
											{!! $policy_data->subscript_duration !!}
											@endif
											@if($policy_data->object_duration)
											<p class="sdetail-title">対象期間</p>
											{!! $policy_data->object_duration !!}
											@endif
											<p class="sdetail-title">対象地域</p>
											{!! $policy_data->region !!}
											@if($policy_data->adopt_result)
											<p class="sdetail-title">採択結果</p>
											{!! $policy_data->adopt_result !!}
											@endif

											<p class="sdetail-title">掲載終了日</p>
											@if(!$policy_data->subscript_duration_option)
											{!! $policy_data->subscript_duration_detail !!}
											@endif
											@if(!$policy_data->subscript_duration_option)
											<p>随時</p>
											@endif
											@if(count(json_decode($policy_data->register_pdf, true)) || count(json_decode($policy_data->register_pdf1, true)))
											<p class="sdetail-title">pdfデータ</p>
											@endif
											@if(count(json_decode($policy_data->register_pdf, true)))
											<a href="{{url($policy_data->register_pdf[1])}}" class="aline">{{url($policy_data->register_pdf[0])}}</a>
											@endif

											<p>
											@if(count(json_decode($policy_data->register_pdf1, true)))
												@foreach(json_decode($policy_data->register_pdf1, true) as $key => $register_pdf1)
													<a href="{{$register_pdf1['url']}}" class="aline">{{$register_pdf1['name']}}</a>
												@endforeach
											@endif
											</p>
											<p class="sdetail-title">お問い合せ</p>
											{!! nl2br($policy_data->inquiry) !!}
										</div><!-- end .sdetail -->
										<div class="text-center mgt-30">
								            <button type="button" class="submit-ask btn-primary btn btn-style-shadow-green btn-success" style="margin-right:10px;width:150px;">確認する</button>
								            <a href="{{route('agency.index')}}" class="btn btn-style-shadow-grey" style="width:150px;">戻る</a>
								        </div>
									</div>
								</div>
							</div>
							{{ Form::open(['url' => route('agency.getbask'), 'method' => 'GET', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data']) }}
			<div class="col-xs-4">
				<div class="detail-right-mbox">
					<div class="checkbox">
						<label>
							<input type="checkbox" name="checkall" class="checkall" data-check="usercheck" checked="checked">チェックした事業者に提案をする 
						</label>
					</div> 
					@if(is_array($policy_id))
					@foreach($policy_id as $poli_id)
					{{Form::hidden('policy_id[]', $poli_id)}}
					@endforeach
					@endif			
				</div> <!-- end .detail-right-mbox -->
				<div class="dagency-list-right">
					@if($results)
					@foreach($results as $key => $val)
					<div class="dagency-list-item">
						<table class="table table-bordered">
							<tbody>
								<tr>
									<td>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="usercheck[]" class="usercheck" value="{{$val->id}}"  checked="checked">
											</label>
										</div> <!-- end .checkbox -->
									</td>
									<td>
										<img src="{{ url( $val->image ) }}" alt="">
										<div class="clearfix"></div>
										{!! Button::getFollowButtons($val->id) !!}
									</td>
									<td class="linktr" data-href="{{route('agency.RequestDetails', ['policy_id' => $policy_id[0], 'user_id' => $val->id])}}">
										<p>士業名：{{$val->displayname}}</p>
										<p>
											<span>実績     ：</span>
											{!! Button::getRating($val->evaluate) !!}
										</p>
										<p>評価     ：{{$val->result}}件</p>
									</td>
								</tr>
							</tbody>
						</table>
					</div> <!-- end .dagency-list-item -->
					
					@endforeach
					@endif
				</div> <!-- end .dagency-list-right -->
			</div><!-- end .col-xs-4 -->
			{{ Form::close() }}
						</div> <!-- end .row -->
					</div> <!-- end .subsidydetail -->
				</div> <!-- end .row -->
			</div> <!-- .col-sm-12 -->
		</div> <!-- end .row -->
		</div> <!-- end .container -->
</div> <!-- end .mainpage -->
<div class="clearfix"></div>
<div class="modal fade bask-modal" id="submit-ask-modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">依頼費用</h4>
			</div>
			<div class="modal-body">
				<div class="dagency-list-right-modal">
						<div class="row">
							@if($results)
							@foreach($results as $key => $val)
							<div class="col-xs-4">
								<div class="dagency-list-item">
									<table class="table table-bordered">
										<tbody>
											<tr>
												<td class="vertical-top">
													<div class="checkbox">
														<label>
															<input type="checkbox" name="usercheckmodal[]" class="usercheckmodal" value="{{$val->id}}"  checked="checked">
														</label>
													</div> <!-- end .checkbox -->
												</td>
												<td>
													<img src="{{ url( $val->image ) }}" alt="">
													{!! Button::getFollowButtons($val->id) !!}
												</td>
												<td>
													<p>士業名：{{$val->displayname}}</p>
													<p>
														<span>実績     ：</span>
														{!! Button::getRating($val->evaluate) !!}
													</p>
													<p>評価     ：{{$val->result}}件</p>
												</td>
											</tr>
										</tbody>
									</table>
								</div> <!-- end .dagency-list-item -->
							</div> <!-- end .col-xs-4 -->
							@endforeach
							@endif
						</div> <!-- end .row -->
					</div>
						<form type="POST" id="submit-ask-form">
									<table class="table table-bordered bask-page">
										<tbody>
											<tr>
												<td width="20%" class="div-style-blue2 text-primary">
													<div class="miview" >
														<p class="text-center">見積もり内容</p>
													</div>
												</td>
												<td>
													<table class="table dsubtable table-borderless">
														<tbody class="list-rows">
															<tr>
																<td class="text-right" colspan="4">
																	<div class="checkbox dborder-check">
																		<label>
																			<input type="checkbox" value="1" class="cost_agency" name="cost_agency">マッチング条件を提案
																		</label>
																	</div>
																</td>
															</tr>
															<tr>
																<td>業務内容</td>
																<td>書類代行費用</td>
																<td id="document_business_price_m"></td>
																<td>&nbsp;</td>
															</tr>
															<tr>
																<td></td>
																<td>報酬</td>
																<td id="request_business_price_m"></td>
																<td>&nbsp;</td>
															</tr>
															<tr>
																<td>着手金</td>
																<td>着手金</td>
																<td id="deposit_money_m"></td>
																<td>&nbsp;</td>
															</tr>
															<tr style="border-top: 1px solid #ddd">
																<td>その他費用</td>
																<td></td>
																<td id="dother_cost_t1_m"></td>
																<td id="dother_cost_i1_m"></td>
															</tr>
															<tr>
																<td></td>
																<td></td>
																<td id="dother_cost_t2_m"></td>
																<td id="dother_cost_i2_m"></td>
															</tr>
															<tr>
																<td></td>
																<td></td>
																<td id="dother_cost_t3_m"></td>
																<td id="dother_cost_i3_m"></td>
															</tr>
															<tr>
																<td></td>
																<td></td>
																<td id="dother_cost_t4_m"></td>
																<td id="dother_cost_i4_m"></td>
															</tr>
															<tr>
																<td></td>
																<td></td>
																<td id="dother_cost_t5_m"></td>
																<td id="dother_cost_i5_m"></td>
															</tr>
															<tr>
																<td></td>
																<td><strong>合計</strong></td>
																<td></td>
																<td class="text-right" id="total-value_m">0 円</td>
															</tr>
															<tr class="tr-bg-pink">
																<td>クライアント支払金額</td>
																<td colspan="3" class="text-center"><span id="total_val_page_m">0</span> 円 + (取得助成金・補助金総額の）  <span id="total_pc_page_m">0</span>％</td>
															</tr>
														</tbody>
													</table>
												</td>
											</tr>
										</tbody>
									</table> <!-- end table bid price -->
								</form> <!-- end 2nd-form -->
			</div> <!-- end .modal-body -->
			<div class="modal-footer">
				<div class="text-center">
					<button type="button" id="dmsgbuttonsubmit" class="btn-primary btn btn-style-shadow-green btn-success">提案する</button>
					<button type="button" data-dismiss="modal" class="btn btn-style-shadow-grey">戻る</button>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="display: none;">
	<div class="modal-dialog modal-lg modal-dialog-centered text-center" role="document">
		<div class="modal-content" style="height: 676.8px;">
			<div class="modal-header text-center">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
				<h5 class="modal-title">マニュアル</h5>
			</div>
			<div class="modal-body">
				<iframe width="100%" height="100%" src="{{URL::to('/manuals/auto_search3/operationlecture.html')}}" frameborder="0"></iframe>
			</div>
		</div>
	</div>
</div>
<input type="hidden" id="loginid" value="{{AuthSam::getUser()->id}}">
<input type="hidden" id="loginame" value="{{AuthSam::getUser()->displayname}}">
@endsection
@section('script')
	<script>
		function getmessagesendername(id, uname){
			var loginid = $('#loginid').val();
			var loginame = $('#loginame').val();
			if(loginid == id) return loginame
			else return uname
		}
		$('#example-fontawesome,.datrating').barrating({
			//index page jubotron
            theme: 'fontawesome-stars',
            showSelectedRating: false,
            onSelect: function(value, text, event) {
			    if (typeof(event) !== 'undefined') {
			      // rating was selected by a user
			      console.log(value);
			    } else {
			      // rating was selected programmatically
			      // by calling `set` method
			    }
			  }
        });
        $('.rating-disable').barrating({
			//index page jubotron
            theme: 'fontawesome-stars',
            showSelectedRating: false,
            readonly: true,
            onSelect: function(value, text, event) {
			    if (typeof(event) !== 'undefined') {
			      // rating was selected by a user
			      console.log(value);
			    } else {
			      // rating was selected programmatically
			      // by calling `set` method
			    }
			  }
        });

		//agency/home tooltip
		$(function () {
		  $('[data-toggle="tooltip"]').tooltip()
		});

		var msg_files = [];
		var msg_files_l = 0;
		$('.msg-files-button').click(function() {
			$('#msg-files').trigger('click');
		});
		$(document).on('change', '#msg-files', function() {
			files = $('#msg-files')[0].files;
			html = '';
			st = msg_files.length + 1;
			for(i = 0; i < files.length; i++)
			{
				
				html += '<span class="dmsgfile-item">' + files[i].name + '<button type="button" id="ff_'+msg_files_l+'" class="dmsgfile-item-remove"><i class="fa fa-trash"></i></button></span>';
				msg_files[msg_files_l] = {name: files[i].name, file: files[i]};
				msg_files_l += 1;
				
			}
			$('.dfile-list').append(html);
			console.log(msg_files);
		});
		$(document).on('click', '.dmsgfile-item-remove', function(e) {
			var thisId = $(this).attr('id');
			thisId = thisId.split('_');
			thisId = thisId[1];
			delete msg_files[thisId];
			$(this).parent().remove();
			console.log(msg_files);
		});
		$(document).ready(function(){
			$('.tabtable').find('input').attr('disabled', true);
			$('.tabtable').hide();
			$('#tab_1').show();
			$('#tab_1').find('input').attr('disabled', false);
		});
		
		$('.dcheck-dis').change(function() {
			var input_parent = $(this).parents('td').next().find('input[type="text"],input[type="number"]');
			if($(this).is(':checked')) {
				input_parent.attr('readonly', false);
			} else {
				input_parent.attr('readonly', true);
			}
			if(input_parent.prop('type') == 'number') input_parent.val('0');
			else input_parent.val('');
			all_cal();
		});
		$('.dask-check').change(function() {
			//check checkall button
			if($(this).hasClass('checkall-btn'))
			{
				s_status = false;
				if($(this).is(':checked')) {
					s_status = true;
				}
				$('.dask-check').each(function(index, el) {
					if(!$(el).hasClass('checkall-btn')) $(el).prop('checked', s_status);
				});
			} else {
				var count_e = 0;
				var count_checked = 0;
				$('.dask-check').each(function(index, el) {
					if(!$(el).hasClass('checkall-btn')) {
						if($(el).is(':checked')) {
							count_checked += 1;
						}
						count_e += 1;
						
					}
				});
				if(count_checked == count_e) {
					$('.checkall-btn').prop('checked', true);
				} else {
					$('.checkall-btn').prop('checked', false);
				}
			}

			//set name
			sss = '&nbsp;';
			$('.dask-check').each(function(index, el) {
				if(!$(el).is(':checked')) return;
				if(!$(el).hasClass('checkall-btn')) {
					name = $(el).parents('td').next().next().find('p').first().text();
					name = name.replace('士業名：', '');
					sss += name + ', ';
				}
				
			});
			$('.dmsg-to p').html(sss);

		});
		$('.dother-cost').keyup(function() {
			all_cal();
		});
		var all_cal = function() {
			var total_val = 0;
			var total_pc = 0;
			$('.dother-cost').each(function(index, el)
			{
				if($(el).val() == '') return;
				total_val += parseInt($(el).val());
			});
			$('#total-value').text(total_val + ' 円');
			if($('#document_business_price').val() != '') {
				total_val += parseInt($('#document_business_price').val());
			}
			if($('#deposit_money').val() != '') {
				total_val += parseInt($('#deposit_money').val());
			}
			$('#total_val_page').text(total_val);
			if($('#request_business_price').val() != '') {
				total_pc = parseInt($('#request_business_price').val());
			}
			$('#total_pc_page').text(total_pc);
			
		}
		$('#document_business_price').keyup(function() {
			all_cal();
		});
		$('#request_business_price').keyup(function() {
			if($(this).val() < 0) $(this).val(0);
			if($(this).val() > 99) $(this).val(100);
			$(this).val(parseInt($(this).val()));
			all_cal();
		});
		$('#deposit_money').keyup(function() {
			all_cal();
		});
		var document_business_type = 1;
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
			set_modal_value(id);
			$('#submit-ask-modal').modal();
		});
		var set_modal_value = function(id) {
			var to_id = $('#to_id').val();

			$('#document_business_price_m').text( $('#'+id+' input[name="document_business_price"]').val() );
			$('#request_business_price_m').text( $('#'+id+' input[name="request_business_price').val() );
			$('#deposit_money_m').text( $('#'+id+' input[name="deposit_money"]').val() );
			$('#dother_cost_t1_m').text( $('#'+id+' input[name="dother_cost_t1"]').val() );
			$('#dother_cost_t2_m').text( $('#'+id+' input[name="dother_cost_t2"]').val() );
			$('#dother_cost_t3_m').text( $('#'+id+' input[name="dother_cost_t3"]').val() );
			$('#dother_cost_t4_m').text( $('#'+id+' input[name="dother_cost_t4"]').val() );
			$('#dother_cost_t5_m').text( $('#'+id+' input[name="dother_cost_t5"]').val() );
			$('#dother_cost_i1_m').text( $('#'+id+' input[name="dother_cost_i1"]').val() + ' 円' );
			$('#dother_cost_i2_m').text( $('#'+id+' input[name="dother_cost_i2"]').val() + ' 円' );
			$('#dother_cost_i3_m').text( $('#'+id+' input[name="dother_cost_i3"]').val() + ' 円' );
			$('#dother_cost_i4_m').text( $('#'+id+' input[name="dother_cost_i4"]').val() + ' 円' );
			$('#dother_cost_i5_m').text( $('#'+id+' input[name="dother_cost_i5"]').val() + ' 円' );
			$('#total-value_m').text( $('#total-value').text() );
			$('#total_val_page_m').text( $('#total_val_page').text() );
			$('#total_pc_page_m').text( $('#total_pc_page').text() );
		}

		$(document).on('change', 'input.usercheck', function(){
			var obj = $(this);
			let val  = $('input.usercheck:checkbox:checked').map(function() {return this.value;}).get().join('_');
			$('#to_id').val(val);

	        var url = "{{URL::to("/agency/ajaxGetToName")}}"+'/'+val+'/'+$('input[name="searchtype"]').val();
	
	        $.get(url, function(result){
		        $('#dmsg-to p').text(result);
		        if(obj.is(':checked')) {
				$('input.usercheckmodal[value="'+obj.val()+'"]').prop('checked', true).trigger('change');
			}else{
				$('input.usercheckmodal[value="'+obj.val()+'"]').prop('checked', false).trigger('change');
			}
		    });

			
		});

		$(document).on('change', 'input.usercheckmodal', function(){
			if($(this).is(':checked')) {
				$('input.usercheck[value="'+$(this).val()+'"]').prop('checked', true).trigger('change');
			}else{
				$('input.usercheck[value="'+$(this).val()+'"]').prop('checked', false).trigger('change');
			}
			
		});

		$(document).on('change', 'input.cost_agency', function(){
			if($(this).is(':checked')) {
				$('input.cost_agency').prop('checked', true).trigger('change');
			}else{
				$('input.cost_agency').prop('checked', false).trigger('change');
			}
			
		});
		
		$(document).on('click', '#dmsgsubmit', function(){
			if(!$('#to_id').val()) {
				alert("一つ以上の士業を選択してください。");
				return false;
			}
			if(!$('#contentmess').val()) {
				alert("メッセージを入力してください。");
				return false;
			}
			var data = new FormData($('form#formID')[0]);
			$.ajax({
			    url: '{{route('agency.bask.mess')}}',
			    data: data,
			    cache: false,
			    contentType: false,
			    processData: false,
			    method: 'POST',
			    type: 'json', // For jQuery < 1.9
			    success: function(data){
			    	console.log(data);
			    	var str = '';
			        var rss = JSON.parse(data);
			        for (var i = 0; i < rss.length; i++) {
			        	str +='<tr>\
	                        <td>\
	                            <div class="row">\
	                                <div class="col-sm-4">\
	                                    <hr>\
	                                </div>\
	                                <h5 class="text-center col-sm-3">'+datejapan(rss[i]['update_date'])+'</h5>\
	                                <div class="col-sm-5">\
	                                    <hr>\
	                                </div>\
	                            </div>\
	                            <h5>'+getmessagesendername(rss[i]['from_id'], rss[i]['displayname'])+'</h5>\
	                            <p>'+rss[i]['message']+'</p>\
	                        </td>\
	                    </tr>';
			        }
			        $('#messageslist').html(str);
			        $("#messscroll").scrollTop($("#messscroll")[0].scrollHeight);
			    }
			});
			return false;
		});

		$(document).on('click', '#dmsgbuttonsubmit', function(){
			var tab = $('#selecttab').val();
			if(!$('#to_id').val()) {
				alert("一つ以上の士業を選択してください。");
				return false;
			}
			if($('#'+tab+' input[name="deposit_money"]').val()<0) {
                alert("すべての項目を正確に入力してください!");
                return false;
            }
			// if(!$('#contentmess').val()) {
			// 	alert("メッセージを入力してください。");
			// 	return false;
			// }
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
			    	var str = '';
			        var rss = JSON.parse(data);
			        for (var i = 0; i < rss.length; i++) {
			        	str +='<tr>\
	                        <td>\
	                            <div class="row">\
	                                <div class="col-sm-4">\
	                                    <hr>\
	                                </div>\
	                                <h5 class="text-center col-sm-3">'+datejapan(rss[i]['update_date'])+'</h5>\
	                                <div class="col-sm-5">\
	                                    <hr>\
	                                </div>\
	                            </div>\
	                            <h5>'+getmessagesendername(rss[i]['from_id'], rss[i]['displayname'])+'</h5>\
	                            <p>'+rss[i]['message']+'</p>\
	                        </td>\
	                    </tr>';
			        }
			        $('#messageslist').html(str);
			        $("#messscroll").scrollTop($("#messscroll")[0].scrollHeight);

			        var succ = '<div class="text-center">\
						<p class="completed-ask-submit">\
							事業者への提案が完了しました。\
						</p>\
					</div>';
					$('#submit-ask-form').html(succ);
					$('#dmsgbuttonsubmit').remove();

			    }
			});
			return false;
		});

		$(document).on('change', '#selecttab', function(){
			var id = $(this).val();
			$('.tabtable').find('input').attr('disabled', true);
			$('.tabtable').hide();
			$('#'+id).show();
			$('#'+id).find('input').attr('disabled', false);
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
		
	</script>
@endsection
