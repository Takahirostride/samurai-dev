
			<div class="text-center">
				<!-- <div class="div-style-yellow no-mrg-top">
				<p class="text-demo">
					広告枠
				</p>
				</div>
				<div class="div-style-yellow">
				<p class="text-demo">
					広告枠
				</p>
				</div> -->
				<!-- <div class="div-style-grey text-center">
				<h4 class="text-color font14">プロフィール充実度</h4>
				<div class="progress">
					<div role="progressbar" aria-valuenow="{{$profile_completed['loyalty']}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$profile_completed['loyalty']}}%" class="progress-bar"> 
					</div>
				</div>
				<p><span >{{$profile_completed['loyalty']}}<span>%</span></span></p>
				<p class="font11">プロフィールを充実させるほど、マッチング率が上がります。</p>
				@foreach(config('site_config.client_profile_complete') as $key=>$val)
					@if(in_array($key, $profile_completed['require']))
				<div class="dprofile-complete">
					<div class="div-style-blue">
						<h6 class="font12"><b class="float-left">{{$val[0]}}</b><span class="float-right">＋{{$val[1]}}%</span></h6>
					</div>
				</div>
					@endif
				@endforeach
				
				</div> -->
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