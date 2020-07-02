<table class="table table-date-policy table-bordered">
								<tbody>
									<tr>
										<td colspan="2" class="text-center">予定納期 ：<span class="big-text">{{ddate_string($selectedHire->deli_date )}}</span></td>
									</tr>
									<tr>
										<td class="text-center">
											<span>報酬金額 ： <span class="big-text">{{$selectedHire->deposit_money_format()}}円</span>+税 </span>
											@if(!$selectedHire->is_payment())
											<button type="submit" class="btn btn-samurai btn-warning pull-right big-button">支払いを行う</button>
											@else
											<button type="button" class="btn btn-samurai btn-default pull-right big-button">支払い済み</button>
											@endif
										</td>
										<td class="text-center" style="vertical-align: middle" width="200px">
											@if($selectedHire->is_payment())
											<button data-toggle="modal" data-target="#cancelModal" type="button" class="btn btn-samurai btn-danger">キャンセルする</button>
											@endif
										</td>
									</tr>
									<tr>
										<td class="text-center">
											<span>後払い金額 ： <span class="big-text">{{$selectedHire->agency_estimate()}}円</span>+税</span>
											@if(!$selectedHire->is_payment())
											<button type="submit" class="btn btn-samurai btn-warning pull-right big-button">支払いを行う</button>
											@else
											<button type="button" class="btn btn-samurai btn-default pull-right big-button">支払い済み</button>
											@endif
										</td>
										<td class="text-center" style="vertical-align: middle" width="200px">
											@if($selectedHire->is_payment())
											<button id="complete_recruit"  data-toggle="modal" data-target="#completeModal" type="button" class="btn btn-samurai btn-success">終了報告・キャンセル</button>
											@endif
										</td>
									</tr>
								</tbody>
							</table>