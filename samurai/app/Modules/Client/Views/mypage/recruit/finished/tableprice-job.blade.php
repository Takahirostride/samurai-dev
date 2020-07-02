<table class="table table-date-policy table-bordered">
								<tbody>
									<tr>
										<td class="text-center">予定納期 ：<span class="big-text">{{ddate_string($selectedHire->deli_date )}}</span>
										<td class="text-center" style="vertical-align: middle"><button onclick="window.location.href='{{URL::route('client.recruitment.submitrq', ['hire_id'=>$selectedHire->id])}}';" type="button" class="btn btn-samurai btn-success">再投稿する</button></td>
										</td>
									</tr>
									<tr>
										<td class="text-center" colspan="2">
											<span>着手金支払い金額 ： <span class="big-text">{{$selectedHire->deposit_money_format()}}円</span>+税 </span>
										</td>
									</tr>
									<tr>
										<td class="text-center" colspan="2">
											<span>後払い金額 ： <span class="big-text">{{$selectedHire->deposit_money_fee()}}円</span>+税</span>
										</td>
									</tr>
									<tr>
										<td class="text-center" colspan="2">
											<span>終了日 ： <span class="big-text">{{ ddate_string($selectedHire->finish_date) }}</span></span>
										</td>
									</tr>
								</tbody>
							</table>