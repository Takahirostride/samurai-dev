<div>
	<p>
		<button type="button" data-uid="{{$user->id}}" data-pid="{{$policy_data->id}}" class="btn-primary btn btn-style-shadow-green btn-success sidebar-btn submitbask">
	        <strong style="color:white;">依頼する</strong>

	    </button>
	</p>
	
	<p>
		<a href="#" disabled class="btn btn-default btn-grad sidebar-btn ">
			<strong> ビデオチャット</strong>
		</a>
	</p>
	<p>
		<a href="" class="btn btn-default btn-grad sidebar-btn ">
			<strong> メッセージを送る</strong>
		</a>
	</p>
	<p>
		<a href="" class="btn btn-default btn-grad sidebar-btn ">
			<strong> 別の案件を提案</strong>
		</a>
	</p>
	<p>
		<a href="{{route('agency.breport',['policy_id'=>request()->policy_id, 'report_id'=>request()->user_id])}}" class="btn btn-default btn-grad sidebar-btn ">
			<strong> 違反申告する</strong>
		</a>
	</p>
	<h4 class="left-border text-color font16">実績サマリー</h4>
		<div class="sidebar-item div-style-grey text-center">
			
			<div>
				<h6 class="sidebar-subitem-left" role="button" tabindex="0">
					<b>評価
						<span class="sidebar-subitem-right">{{$profile_completed['feedback']['count']}}</span>
					</b>
				</h6>
				<h6 class="sidebar-subitem-left" role="button" tabindex="0">
					<b>評価数
						<span class="sidebar-subitem-right">{{$profile_completed['feedback']['result']}}
							<span>件</span>
						</span>
					</b>
				</h6>
				<h6 class="sidebar-subitem-left" role="button" tabindex="0">
					<b>良い評価率
						<span class="sidebar-subitem-right">{{$profile_completed['feedback']['good_result_rate']}}
							<span>%</span>
						</span>
					</b>
				</h6>
			</div>
		</div>
		<h4 class="left-border text-color font16">認証状況</h4>
		<div class="div-style-grey mypage-profile-update">
			<p class="left-img-icon @if($profile_completed['auth_state'][0]!=1) pdisable @endif "><i class="fa fa-user"></i> <b>本人確認</b></p>
			<p class="left-img-icon @if($profile_completed['auth_state'][1]!=1) pdisable @endif "><i class="fa fa-file"></i> <b>機密保持確認</b></p>
			<p class="left-img-icon @if($profile_completed['auth_state'][2]!=1) pdisable @endif "><i class="fa fa-phone"></i> <b>電話確認</b></p>
			<p class="left-img-icon @if($profile_completed['auth_state'][3]!=1) pdisable @endif "><i class="fa fa-check"></i> <b>SAMURAIチェック</b></p>
		</div>
		<h4 class="left-border text-color font16">仕事状況</h4>
		<div class="div-style-grey">
			<h6 class="sidebar-subitem-left"><b>仕事状況<span class="sidebar-subitem-right"> @if($profile_completed['work_state']['work_state'] == 1) 対応可能 @else 対応不可能` @endif </span></b></h6>
			<h6 class="sidebar-subitem-left"><b>最終ログイン<span class="sidebar-subitem-right">{{$profile_completed['work_state']['last']}}日前</span></b></h6>
		</div>
		<!-- end div.sidebar-item -->
</div> 


<div class="modal fade" id="modal-Bask">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body" id="modal-baskform-content">
				{{ Form::open(['url' => route('agency.dmatching'), 'method' => 'POST', 'id'=>'formID', 'enctype'=>'multipart/form-data']) }}
					{{Form::hidden('policy_id[]')}}
					{{Form::hidden('usercheck[]')}}
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
													<td>成功報酬</td>
													<td>
														{{Form::number('deposit_setting','', ['id'=>'deposit_setting', 'min'=>0, 'max'=>100])}}<span> %</span>
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