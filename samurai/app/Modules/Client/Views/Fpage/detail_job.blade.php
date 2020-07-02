<div class="create-link-box-x">
							<table class="table table-bordered subsidylist subsidylist-2 index-subsidylist">
								<tbody>
									<tr>
										<td width="20%">タイトル</td>
										<td>{{str_limit($val->hire_title(), 100)}}</td>
									</tr>
									<tr>
										<td>依頼詳細</td>
										<td>{{ str_limit($val->job_content, 200) }}</td>
									</tr>
									
								</tbody>
							</table>
						</div>