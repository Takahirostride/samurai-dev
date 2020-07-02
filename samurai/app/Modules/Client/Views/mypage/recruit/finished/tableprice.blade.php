<table class="table table-date-policy table-bordered">
								<tbody>
									<tr>
										<td class="left-padding-job">
											<span>予定納期 ： <span class="big-text">{{ddate_string($selectedHire->deli_date)}}</span></span>
										</td>

									</tr>
									<tr>
										<td class="left-padding-job">
											<span>報酬金額 ： <span class="big-text">{{$selectedHire->deposit_money_receive()}}</span> 円+税 </span>
										</td>
									</tr>
									<tr>
										<td class="left-padding-job">
											<span>後払い金額 ： <span class="big-text">{{$selectedHire->deposit_money_fee()}}</span> 円+税</span>
											
										</td>
									</tr>
									<tr>
										<td class="left-padding-job">
											<span>終了日 : <span class="big-text">{{date_string($selectedHire->finish_date)}}</span></span>
										</td>
									</tr>
								</tbody>
							</table>