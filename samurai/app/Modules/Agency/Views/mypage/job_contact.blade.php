@extends('layouts.home')
@section('style')
	<style type="text/css">
		.hide {
			display: none;
		}
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
						    <li class="@if($jobType===0) active @endif">
						        <a href="{{ URL::route('agency.jobs') }}">提案中 @if($suggestionCount) <span class="badge"> {{$suggestionCount}}</span> @endif </a>
						    </li>
						    <li class="@if($jobType===1) active @endif">
						        <a href="{{ URL::route('agency.jobs.requests') }}">受けた依頼 @if($requestCount) <span class="badge"> {{$requestCount}}</span> @endif </a>
						    </li><!-- 
						    <li>
						        <a href="mypage/agencyjob-1-3.php">募集案件</a>
						    </li> -->
						</ul>
					</div>	<!-- end middle page -->
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
								@foreach($hireList as $key=>$msg)
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
							{{ $hireList->appends(request()->all())->links() }}
						</div>
					</div> <!-- end col-sm-12 -->
				</div>	 <!-- end .row -->
				{{Form::close()}}
				<div class="row job-contact-page">
					<div class="col-sm-8">
						{{Form::open(['method'=>'POST', 'files'=>true, 'id'=>'sendmsg-form'])}}
						<h4 class="pagerow-title">
							<span>提案内容を入力する</span>
							<button id="submit_btn_msg" class="shadowbuttonsuccess btn btn-success">送信する</button>
						</h4>
						<table class="table table-bordered mgbt-0">
								<tbody>
									<tr>
										<td class="paddingnone">
											<div class="showmesscontent" id="table-msg">
												<table class="full-width">
												    <tbody id="msg_table">
												    	@php $userMsgCount = 0 @endphp
												    	@if(count($messageList))
												    	@foreach($messageList as $message)
												    		@if($message->from_id == session('user_id')) @php $userMsgCount += 1 @endphp @endif
												        <tr style="">
												            <td>
												                <div class="row">
												                    <div class="col-sm-4">
												                        <hr>
												                    </div>
												                    <h5 class="text-center col-sm-4">
												                        <b>{{ date_string($message->update_date) }}</b>
												                    </h5>
												                    <div class="col-sm-4">
												                        <hr>
												                    </div>
												                </div>
												                <h5>@if($message->from_id==session('user_id')){{$user->displayname}}@else {{$message->displayname}}@endif :</h5>
												                <p>{{$message->message}}</p>
												                @if($message->file)
												                	@foreach(json_decode($message->file) as $file)
													                <div class="col-sm-12">
							                                            <span>&bull;</span><a style="margin-top:8px;cursor:pointer;" target="_blank" href="{{URL::route('agency.jobs.matching.download-file', [$file[1], $file[0]] )}}">{{$file[0]}}</a>
							                                        </div>
							                                       @endforeach
							                                    @endif
												            </td>
												        </tr>
												        @endforeach
												        @endif
												        
												    </tbody>
												</table><!-- end table -->
											</div><!-- end .showmesscontent -->
										</td>
									</tr>
									<tr>
										<td>
											<div class="row">
							                    <div class="col-sm-4">
							                        <hr>
							                    </div>
							                    <h5 class="text-center col-sm-4">
							                        <b>{{date_string(date('Y-m-d'))}}</b>
							                    </h5>
							                    <div class="col-sm-4">
							                        <hr>
							                    </div>
							                </div>
							                <input type="hidden" id="total_user_msg" value="{{$userMsgCount}}">
							                
							                <input type="hidden" name="hire_id" value="{{$hire_id}}">
							                <div class="subjectmes">
							                	<label class="control-label">
	                                                <img src="{{URL::to('assets/common/images/messagesend.png')}}">
	                                            </label>
	                                            <b>{{$hireList->first()->displayname}}</b>
	                                            <div class="pull-right">
	                                            	<label for="files"> <span for="files" class="glyphicon glyphicon-paperclip"></span></label>
	                                            	<input class="sr-only" type="file" multiple="multiple" name="file[]" id="files">
	                                            </div>
	                                            <div class="pull-right" id="file-select-list">
	                                            </div>
							                </div>
	                                        <textarea name="message" id = "submit_msg" class="form-control messtextinput" rows="6" required="required"></textarea>
	                                        
										</td>
									</tr>
								</tbody>
							</table><!-- end table -->
						{{Form::close()}}
						<div class="clearfix"></div>
						<h4 class="pagerow-title">
							@if(AuthSam::permission()==1)
								<span>依頼された費用</span>
								@if($budgetPrice->cost_client == 1 && AuthSam::permission() == 1)
								<button id="agree-matching" class="shadowbuttonsuccess btn btn-success">マッチングする</button>
								@endif
							@else
								<span>依頼した費用</span>
							@endif
						</h4>
						<table class="table table-hover table-bordered">
							<tbody>
								<tr>
									<td class="tdhead " rowspan="7"><span class="fake-button">費用内容</span></td>
								</tr>
								<tr>
									<td>書類代行費用</td>
									<td class="text-center">{{$budgetPrice->document_business_price1}}   円</td>
								</tr>
								<tr class="info">
									<td>成功報酬</td>
									<td class="text-center">（取得助成金・補助金総額の） {{$budgetPrice->request_business_price1}}   %</td>
								</tr>
								<tr>
									<td>着手金</td>
									<td class="text-center">{{$budgetPrice->deposit_money1}} 円</td>
								</tr>
								<tr class="info">
									<td>報酬支払額</td>
									<td class="text-center">{{(int)($budgetPrice->document_business_price1+$budgetPrice->deposit_money1)}} 円 + （取得助成金・補助金総額の）{{$budgetPrice->request_business_price1}} %</td>
								</tr>
								<tr>
									<td>その他費用</td>
									<td class="text-center">{{$budgetPrice->other_money1}} 円 <button type="button" class="btn btn-sm btn-primary sub-table-btn pull-right">内訳</button>
										<div class="sub-table hide">
											<table class="table table-hover">
												<tbody>
													@foreach(json_decode($budgetPrice->other_money_sub1) as $val)
													<tr>
														<td>{{$val->moneyname}}</td>
														<td>{{$val->moneyvalue}} 円</td>
													</tr>
													@endforeach
												</tbody>
											</table>
										</div>
									</td>
								</tr>
								<tr class="info">
									<td>報酬支払総額</td>
									<td class="text-center">{{(int)($budgetPrice->document_business_price1+$budgetPrice->deposit_money1+$budgetPrice->other_money1)}} 円 + （取得助成金・補助金総額の）{{$budgetPrice->request_business_price1}} %</td>
								</tr>
							</tbody>
						</table>
						@if($budgetPrice->cost_client == 1 && AuthSam::permission() == 1)
							<p>・事業者の方から送信された費用です。</p>
				            <br>
				            <p>・条件を事業者の方と決め、
				                <button type="button" class="btn-primary btn btn-style-shadow-green btn-success" style="width:120px; padding: 5px ;font-size: 12px">マッチングする</button>&nbsp;を押すことでマッチングが完了し、業務が開始されます。</p>
				            <br>
				            <p>・別の費用を提案する場合は、下記より費用を入力してください。。</p>
			            @endif
						<h4 class="pagerow-title">
							@if(AuthSam::permission()==1)
								<span>提案した費用</span>
							@else
								<span>提案された費用</span>
								@if($budgetPrice->cost_client == 1 && AuthSam::permission() == 1)
								<button id="agree-matching" class="shadowbuttonsuccess btn btn-success">マッチングする</button>
								@endif
							@endif
						</h4>
						<table class="table table-hover table-bordered">
							<tbody>
								<tr>
									<td class="tdhead" rowspan="7"><span class="fake-button">費用内容</span></td>
								</tr>
								<tr>
									<td>書類代行費用</td>
									<td class="text-center">{{$budgetPrice->document_business_price}}   円</td>
								</tr>
								<tr class="info">
									<td>成功報酬</td>
									<td class="text-center">（取得助成金・補助金総額の） {{$budgetPrice->request_business_price}}   %</td>
								</tr>
								<tr>
									<td>着手金</td>
									<td class="text-center">{{$budgetPrice->deposit_money}} 円</td>
								</tr>
								<tr class="info">
									<td>報酬支払額</td>
									<td class="text-center">{{($budgetPrice->document_business_price+$budgetPrice->deposit_money)}} 円 + （取得助成金・補助金総額の）{{$budgetPrice->request_business_price}} %</td>
								</tr>
								<tr>
									<td>その他費用</td>
									<td class="text-center">{{$budgetPrice->other_money}} 円 <button type="button" class="btn btn-sm btn-primary sub-table-btn pull-right">内訳</button>
									<div class="sub-table hide">
											<table class="table table-hover">
												<tbody>
													@foreach(json_decode($budgetPrice->other_money_sub) as $val)
													<tr>
														<td>{{$val->moneyname}}</td>
														<td>{{$val->moneyvalue}} 円</td>
													</tr>
													@endforeach
												</tbody>
											</table>
										</div>
									</td>
								</tr>
								<tr class="info">
									<td>報酬支払総額</td>
									<td class="text-center">{{($budgetPrice->document_business_price+$budgetPrice->other_money)}} 円 + （取得助成金・補助金総額の）{{$budgetPrice->request_business_price}} %</td>
								</tr>
							</tbody>
						</table>
						<h4 class="pagerow-title">
								<span>費用を入力する</span>
								<button id="ask-matching" class="shadowbuttonsuccess btn btn-success">費用を提案する</button>
						</h4>
						<input type="hidden" name="current-select" id="current-select" value="0">
						<table class="table table-hover table-bordered">
							<tbody>
								<tr>
									<td colspan="5">

										<div class="checkbox dborder-check pull-right inline-cb">
											<label>
												{{Form::hidden('check_matching', 0)}}
												<input type="checkbox" name="check_matching" value="1">マッチング条件を提案
												
											</label>
										</div>
									</td>
								</tr>
								<tr>
									<td class="tdhead" rowspan="{{(AuthSam::permission()==1)?8:7}}">
										<select name="index_budget" id="current-cost-select" class="form-control">
											@foreach($savedBudget as $k=>$v)
											<option value="{{$k}}">登録内容{{$k+1}}</option>
											@endforeach
										</select>
									</td>
								</tr>
								<tr>
									<td width="15%">業務内容</td>
									<td width="20%">
										<div class="checkbox">
											<label>
												{{Form::checkbox('document_business_flag', 1, 0, ['id'=>'document_business_flag'] )}} 書類代行費用
											</label>
										</div>
									</td>
									<td width="25%">
										<div class="form-group has-feedback">
											{{Form::number('document_business_price', 0, ['class'=>'form-control', 'placeholder'=>'金額', 'id'=>'document_business_price'] )}}
                                            <span class="form-control-feedback">円</span>
                                        </div>
									</td>
									<td width="20%"></td>
								</tr>
								<tr>
									<td></td>
									<td>
										<div class="checkbox">
											<label>
												{{Form::checkbox('request_price_flag', 1, 0, ['id'=>'request_price_flag'] )}} 成功報酬
											</label>
										</div>
									</td>
									<td>
										<div class="form-group has-feedback">
											{{Form::number('request_business_price', 0, ['class'=>'form-control', 'placeholder'=>'金額', 'id'=>'request_business_price'] )}}
                                            <span class="form-control-feedback">%</span>
                                        </div>
									</td>
									<td></td>
								</tr>
								<tr>
									<td>着手金</td>
									<td>着手金</td>
									<td>
										<div class="form-group has-feedback">
											{{Form::number('deposit_money', 0, ['class'=>'form-control', 'placeholder'=>'金額', 'id'=>'deposit_money'] )}}
                                            <span class="form-control-feedback">円</span>
                                        </div>
									</td>
									<td></td>
								</tr>
								<tr>
									<td>その他費用</td>
									<td></td>
									<td colspan="2">
										<div class="sub-table">
											<table class="table table-hover">
												<tbody>
												@foreach(range(0,4) as $key=>$val)
													<tr>
														<td>
															{{Form::text('othermoneyarray[$val][moneyname]', '', ['class'=>'form-control', 'id'=>'moneyname-'.$val, 'placeholder'=>'費用名'] )}}
														</td>
														<td>
															<div class="form-group has-feedback">
																{{Form::number('othermoneyarray[$val][moneyvalue]', 0, ['class'=>'form-control sum', 'placeholder'=>'金額', 'id'=>'moneyvalue-'.$val, 'min'=>0] )}}
					                                            <span class="form-control-feedback">円</span>
					                                        </div>
														</td>
													</tr>
												@endforeach
												</tbody>
											</table>
										</div>
									</td>
								</tr>

								<tr>
									<td></td>
									<td><b>合計</b></td>
									<td></td>
									<td><span id="show-total">0 円</span><input type="hidden" name="total" id="total"></td>
								</tr>
								@if(AuthSam::permission() == 1)
								<tr>
									<td colspan="4"><span class="text-danger">※クライアント支払金額から事務手数料5.5％が差し引かれます</span></td>
								</tr>
								@endif
								<tr class="success">
									<td>支払総額</td>
									<td class="text-center" colspan="3">
										<span id="total-received"></span>  円 + (取得助成金・補助金総額の）<span id="percent-select">0</span>%
									</td>
								</tr>
							</tbody>
						</table>
						<div class="bottom-content">
							<p>・予算目安を送信することで、補助金・助成金取得費用を士業の方に伝えることができます。</p>
							<p>・郵送費、交付手数料等の実費のみ、その他の費用とすることができます。</p>
							<p>・最終条件を提示する場合（マッチング成立）は、  <label><input type="checkbox" name="" id="bottom-content-cb">マッチング条件を提案</label> にチェックをいれて提案してください。士業の方が、<button class="btn btn-success btn-sm">マッチングする</button>をクリックすると、 業務開始されます。	</p>
						</div>
					</div> <!-- end col-sm-8 -->
					<div class="col-xs-4">
				<div class="detail-right-mbox">
					<div class="checkbox">
						<label>
							<input type="checkbox" name="checkall" class="checkall" disabled="disabled" data-check="usercheck" checked="checked">チェックした事業者に提案をする 
						</label>
					</div> 
				</div> <!-- end .detail-right-mbox -->
				<div class="dagency-list-right">
					<div class="dagency-list-item">
						<table class="table table-bordered">
							<tbody>
								<tr>
									<td>
										<div class="checkbox">
											<label>
												<input type="checkbox" disabled="disabled" name="usercheck[]" class="usercheck" value="270" checked="checked">
											</label>
										</div> <!-- end .checkbox -->
									</td>
									<td>
										<img src="{{URL::to($hireList->first()->image)}}" alt="">
										<div class="clearfix"></div>
										{!! Button::getFollowButtons($hireList->first()->policy_id) !!}
										
									</td>
									<td class="">
										<p>士業名：{{$hireList->first()->displayname}}</p>
										<p>
											<div class="star-rating fbrtdiv">
												<select class="fbrtsl" data-current-rating="{{$hireList->first()->evaluate}}" name="rating" autocomplete="off">
													<option value=""></option>
													<option value="1">1</option>
													<option value="2">2</option>
													<option value="3">3</option>
													<option value="4">4</option>
													<option value="5">5</option>
												</select>
											</div>
										</p>
										<p>評価     ：{{$hireList->first()->result}}</p>
									</td>
								</tr>
							</tbody>
						</table>
					</div> <!-- end .dagency-list-item -->
					
														</div> <!-- end .dagency-list-right -->
			</div>
				</div>	 <!-- end .row -->
			</div> <!-- end .mainpage -->
		</div>
	</div>
</div>

<div class="modal fade bask-modal" id="matchingModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">依頼費用</h4>
			</div>
			<div class="modal-body">
				<div class="dagency-list-right-modal">
						<div class="row">
							<div class="col-xs-4">
								<div class="dagency-list-item">
									<table class="table table-bordered">
										<tbody>
											<tr>
												<td class="vertical-top">
													<div class="checkbox">
														<label>
															<input type="checkbox" class="dask-check" checked="checked">
														</label>
													</div> <!-- end .checkbox -->
												</td>
												<td>
													<img src="{{URL::to($hireList->first()->image)}}" alt="">
													{!! Button::getFollowButtons($hireList->first()->policy_id) !!}
												</td>
												<td>
													<p>士業名：{{$hireList->first()->displayname}}</p>
													<p>
														<span>実績     ：</span>
														<div class="star-rating fbrtdiv">
															<select class="fbrtsl" data-current-rating="{{$hireList->first()->evaluate}}" name="rating" autocomplete="off">
																<option value=""></option>
																<option value="1">1</option>
																<option value="2">2</option>
																<option value="3">3</option>
																<option value="4">4</option>
																<option value="5">5</option>
															</select>
														</div>
													</p>
													<p>評価     ：{{$hireList->first()->result}}件</p>
												</td>
											</tr>
										</tbody>
									</table>
								</div> <!-- end .dagency-list-item -->
							</div> <!-- end .col-xs-4 -->

						</div> <!-- end .row -->
					</div>
						<form type="POST" id="submit-ask-form">
									<table class="table table-bordered bask-page">
										<tbody>
											<tr>
												<td width="20%">
													<div class="miview">
														<p class="text-center">見積もり内容</p>
													</div>
												</td>
												<td>
													<table class="table table-hover table-bordered">
														<tbody>
															<tr>
																<td colspan="4">
																	
																	<div class="checkbox dborder-check pull-right inline-cb">
																		<label>
																			{{Form::hidden('check_matching', 0)}}
																			<input type="checkbox" name="check_matching" value="1">マッチング条件を提案
																			
																		</label>
																	</div>
																</td>
															</tr>
															<tr>
																<td width="15%">業務内容</td>
																<td width="20%">書類代行費用</td>
																<td width="25%">
																	<span id="document_business_price_m">0</span> 円
																</td>
																<td width="20%"></td>
															</tr>
															<tr>
																<td></td>
																<td>成功報酬</td>
																<td>
																	<span id="request_business_price_m">0</span> %
																</td>
																<td></td>
															</tr>
															<tr>
																<td>着手金</td>
																<td>着手金</td>
																<td>
																	<span id="deposit_money_m">0</span> 円
																</td>
																<td></td>
															</tr>
															<tr>
																<td>その他費用</td>
																<td></td>
																<td colspan="2">
																	<div class="sub-table">
																		<table class="table table-hover">
																			<tbody>
																				<tr>
																					<td>
																						<span id="moneyname_m-0"></span>
																					</td>
																					<td>
																						<span id="moneyvalue_m-0"></span> 円
																					</td>
																				</tr>
																				<tr>
																					<td>
																						<span id="moneyname_m-1"></span>
																					</td>
																					<td>
																						<span id="moneyvalue_m-1"></span> 円
																					</td>
																				</tr>
																				<tr>
																					<td>
																						<span id="moneyname_m-2"></span>
																					</td>
																					<td>
																						<span id="moneyvalue_m-2"></span> 円
																					</td>
																				</tr>
																				<tr>
																					<td>
																						<span id="moneyname_m-3"></span>
																					</td>
																					<td>
																						<span id="moneyvalue_m-3"></span> 円
																					</td>
																				</tr>
																				<tr>
																					<td>
																						<span id="moneyname_m-4"></span>
																					</td>
																					<td>
																						<span id="moneyvalue_m-4"></span> 円
																					</td>
																				</tr>
																			</tbody>
																		</table>
																	</div>
																</td>
															</tr>

															<tr>
																<td></td>
																<td><b>合計</b></td>
																<td></td>
																<td><span id="show-total_m">0 円</span><input type="hidden" name="total" id="total_m"></td>
															</tr>
															@if(AuthSam::permission() == 1)
															<tr>
																<td colspan="4"><span class="text-danger">※クライアント支払金額から事務手数料5.5％が差し引かれます</span></td>
															</tr>
															@endif
															<tr class="success">
																<td>支払総額</td>
																<td class="text-center" colspan="3">
																	<span id="total-received_m"></span>  円 + (取得助成金・補助金総額の）<span id="percent-select_m">0</span>%
																</td>
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
					<button type="button" onclick="submitHireForm();" data-dismiss="modal" class="btn-primary btn btn-style-shadow-green btn-success">提案する</button>
					<button type="button" data-dismiss="modal" class="btn btn-style-shadow-grey">戻る</button>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="completedAllModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">提案する費用</h4>
			</div>
			<div class="modal-body">
				<div class="dagency-list-right-modal">
						<div class="row">
							<div class="col-xs-4 col-xs-offset-4">
								<div class="dagency-list-item">
									<table class="table table-bordered">
										<tbody>
											<tr>
												<td class="vertical-top">
													<div class="checkbox">
														<label>
															<input type="checkbox" class="dask-check" checked="checked">
														</label>
													</div> <!-- end .checkbox -->
												</td>
												<td>
													<img src="{{URL::to($hireList->first()->image)}}" alt="">
													{!! Button::getFollowButtons($hireList->first()->policy_id) !!}
												</td>
												<td>
													<p>士業名：{{$hireList->first()->displayname}}</p>
													<p>
														<span>実績     ：</span>
														<div class="star-rating fbrtdiv">
															<select class="fbrtsl" data-current-rating="{{$hireList->first()->evaluate}}" name="rating" autocomplete="off">
																<option value=""></option>
																<option value="1">1</option>
																<option value="2">2</option>
																<option value="3">3</option>
																<option value="4">4</option>
																<option value="5">5</option>
															</select>
														</div>
													</p>
													<p>評価     ：{{$hireList->first()->result}}件</p>
												</td>
											</tr>
										</tbody>
									</table>
								</div> <!-- end .dagency-list-item -->
							</div> <!-- end .col-xs-4 -->
							<div class="col-xs-4"></div>
							<div class="col-xs-12">
								<h2 class="text-center">事業者への提案が完了しました。</h2>
							</div>

						</div> <!-- end .row -->
					</div> <!-- end .dagency-list-right-modal -->
				</div> <!-- modal-body -->
				<div class="modal-footer">
				<div class="text-center">
					<button type="button" data-dismiss="modal" class="btn btn-style-shadow-grey">閉じる</button>
				</div>
			</div>
		</div>
	</div>
</div>

{{Form::open(['url'=>URL::to('agency/mypage/jobs/submit-hire'), 'method'=>'POST', 'id'=>'hireForm', 'style'=>'display:none'])}}
	<input type="hidden" name="document_business_price" value="0" id="document_business_price_f">
	<input type="hidden" name="document_business_type" value="0" id="document_business_type_f">
	<input type="hidden" name="request_business_price" value="0" id="request_business_price_f">
	<input type="hidden" name="request_business_type" value="0" id="request_business_type_f">
	<input type="hidden" name="deposit_money" value="0" id="deposit_money_f">
	<input type="hidden" name="other_money_sub[0][moneyname]" value="" id="moneyname_f-0">
	<input type="hidden" name="other_money_sub[0][moneyvalue]" value="0" id="moneyvalue_f-0">
	<input type="hidden" name="other_money_sub[1][moneyname]" value="" id="moneyname_f-1">
	<input type="hidden" name="other_money_sub[1][moneyvalue]" value="0" id="moneyvalue_1-0">
	<input type="hidden" name="other_money_sub[2][moneyname]" value="" id="moneyname_f-2">
	<input type="hidden" name="other_money_sub[2][moneyvalue]" value="0" id="moneyvalue_f-2">
	<input type="hidden" name="other_money_sub[3][moneyname]" value="" id="moneyname_f-3">
	<input type="hidden" name="other_money_sub[3][moneyvalue]" value="0" id="moneyvalue_f-3">
	<input type="hidden" name="other_money_sub[4][moneyname]" value="" id="moneyname_f-4">
	<input type="hidden" name="other_money_sub[4][moneyvalue]" value="0" id="moneyvalue_f-4">
	<input type="hidden" name="other_money" value="0" id="other_money_f">
	<input type="hidden" name="policy_ids[]" value="{{$hireList->first()->policy_id}}">
	<input type="hidden" name="to_ids[]" value="{{$hireList->first()->to_id}}">
	<input type="hidden" name="from_id" value="{{$hireList->first()->from_id}}">
	<input type="hidden" name="message" value="">
{{Form::close()}}

@endsection

@section('script')
	<script>
		var base_url = '{{URL::to('/')}}';
		var totalMsg = {{$messageList->count()}};
		var user_displayname = '{{$user->displayname}}';

	</script>
	{{HTML::script('assets/agency/js/job_contact.js')}}
@endsection