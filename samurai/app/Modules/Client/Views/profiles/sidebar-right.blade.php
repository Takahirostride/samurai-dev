<p class="text-center">
	<a class="btn btn-report" data-toggle="modal" href='#modal-report'>違反者報告する</a>
</p>
<div class="text-center">
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

<div class="modal fade" id="modal-report">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body" id="modal-report-content">
				{{ Form::open(array('route' => 'agency.postbreport', 'id'=>'form_report')) }}
				{{Form::hidden('url_post',route('agency.postbreport'))}}
				{{Form::hidden('report_id',request()->agency_id)}}
				<div class="row">
				    <div class="col-sm-offset-2 col-sm-8">
				        <div class="div-style-yellow-1">
				            <div class="pd40-20">
				                <p><b>利用規約に違反の恐れがある場合は「違反申告」にご協力をお願いします。</br>
				                申告内容は、SAMURAI事業部において必ず確認し、利用規約に照らして個別に慎重に判断を行い、必要に応じて適切な処置を実施致します。</br>
				                依頼をしたユーザーにはSAMURAI事業部が利用規約違反と判断をするまで、違反申告があったことは告知されません。場合により調査にお時間が掛かる場合もありますが、必ずチェックを実施させて頂いております。</br>
				                SAMURAI事業部が健全で、快適なサービスであり続けるよう、皆様のご協力に感謝いたします。</br>
				                違反するかどうかの判断や結果、違反理由への回答や返信は行なっておりませんのでご了承ください。</b></p>
				            </div>                         
				        </div>                    
				        <h3 class="page-title">違反者報告をする</h3>
				        <div class="pd-30">
				            <label><input class="control-label" type="radio" value="0" name="reportway">        直接取引や勧誘     </label>
				            <br>
				            <label><input class="control-label" type="radio" value="1" name="reportway">        助成金・補助金の偽装投稿・虚偽申請の恐れ    </label>
				            <br>
				            <label><input class="control-label" type="radio" value="2" name="reportway">        記載内容と明らかに異なる内容、金額の提案</label>
				            <br>
				            <label><input class="control-label" type="radio" value="3" name="reportway">        その他の利用規約違反の恐れ        </label>                  
				        </div>
				        <div class="">
				            <table class="table table-hover none-over-table table-bordered" style="margin-bottom: 10px; border: 1px solid #d6d6d6;min-height:200px"> 
				                <tbody> 
				                    <tr> 
				                        <td rowspan="1" class="div-style-blue2 text-primary" style="font-size: 12px;width: 20%">
				                            <button type="button" class="btn-primary" style="width: 100%;margin-bottom:10px;">違反内容</button>
				                        </td>                                     
				                        <td style="font-size: 12px">
				                            <textarea class="form-control" rows="7" name="message" placeholder="ここに文字を入力してください"></textarea>
				                        </td>
				                    </tr>                                 
				                </tbody>
				            </table>
				        </div>
				        <div class="row text-center mgbt-50 mgt-30">
				            <button data-dismiss="modal" class="btn btn-default" style="margin-right:20px;width:150px;">閉じる</button>
				            <button type="button" class="btn btn-default baskbutton" id="report_sm" style="width:150px;">報告する</button>
				        </div>
				    </div>
				</div>
				{{ Form::close() }}
			</div>
		</div>
	</div>
</div>