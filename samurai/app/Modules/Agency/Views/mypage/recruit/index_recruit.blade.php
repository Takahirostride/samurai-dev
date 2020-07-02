@extends('layouts.home')

@section('style')
	{{HTML::style('assets/common/css/recruit_chat.css')}}
	<style type="text/css">
		.btn-ncheckbox {
			background: #FFF;
			border: 1px solid #8ccef5;
			width: 100%;
		}
		.checkbox-btn .row {
			margin-bottom: 10px;
		}
		table.pdtdbold.work-table tr td {
			padding-top: 5px;
			padding-bottom: 5px;
		}
		form .col-sm-3>span.shead {
			display: block;
			padding: 7px 0;
		}
		.no-hidden {
			display: none;
		}
	</style>
@endsection
@section('content')
<div class="mainpage chat-page-area">
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
			<div class="col-sm-12 mainpage chat-page">
				<div class="row">
					<div class="col-sm-3">
						<div class="diconleft">
							<ul class="diconleft-ul">
								<li><a title="マイページトップ" href="{{URL::route('agency.home')}}"><i class="fa fa-home"></i></a></li>
								<li><a title="プロフィール管理" href="{{URL::route('agency.profile')}}"><i class="fa fa-id-card"></i></a></li>
								<li><a title="会員情報管理" href="{{URL::route('agency.memberinfo')}}"><i class="fa fa-cog"></i></a></li>
								<li><a title="仕事管理" href="{{URL::route('agency.recruitment')}}"><i class="fa fa-tasks"></i></a></li>
								<li><a title="お気に入り" href="{{URL::route('agency.checklist')}}"><i class="fa fa-star-o"></i></a></li>
								<li><a title="各種認証管理" href="{{URL::route('agency.authentication')}}"><i class="fa fa-check-square-o"></i></a></li>
								<li><a title="支払い管理" href="{{URL::route('agency.payment')}}"><i class="fa fa-money"></i></a></li>
								<li><a title="アフィリエイト管理" href="{{URL::route('agency.affiliate')}}"><i class="fa fa-group"></i></a></li>
							</ul>
						</div>
						<div class="dleft-list-user">
							@include('Agency::mypage.recruit.include.dleft-user-list')
							@if ($selectedHire->from_id == session('user_id'))
								@php
									$shiff_user = $selectedHire->to;
								@endphp
							@else
								@php
									$shiff_user = $selectedHire->from;
								@endphp
							@endif
						</div> <!-- end .dleft-list-user -->
					</div> <!-- end .col-sm-3 -->
					<div class="col-sm-9">
						<div class="detail-hire">
							@include('Agency::includes.dnavbar')
							<div class="djob-info">
								<p>案件名：{{$selectedHire->hire_title()}}</p>
								<p>士業名：{{$shiff_user->displayname}} </p>
								<button class="btn btn-primary dcollapse-btn" type="button" data-target="collapse1">
								  <i class="fa fa-chevron-down"></i>
								</button>
							</div>
							<div class="dcollapse" id="collapse1">
							<div class="dpolicy-item-list">
								<div class="dpolicy-item">
									@if($selectedHire->hire_type == 1)
										@include('Agency::mypage.recruit.index_recruit.policyitem')
									@else
										@include('Agency::mypage.recruit.index_recruit.jobitem')
									@endif
									
								</div> <!-- end .dpolicy-item -->
								
							</div> <!-- end .dpolicy-item-list -->
							<h4>予算と納期</h4>
							{{ Form::open(array('url' => 'pay/'.$selectedHire->id, 'method' => 'GET')) }}
							@include('Agency::mypage.recruit.index_recruit.payment_table')
							{{ Form::close() }}
							</div>
							<h2 class="taskpage-title">タスク進歩状況 <button class="btn btn-primary dcollapse-btn" type="button" data-target="collapse2">
								  <i class="fa fa-chevron-down"></i>
								</button></h2>
							<div class="dcollapse" id="collapse2">
							
							<div class="table-responsive new-task-table">
								<table class="table table-bordered">
									<tbody>
										<tr>
											<td></td>
											@if(count($work_set))
											@foreach($work_set as $work)
											@php 
												$imgName = 'grey';
												if($work->complete_flag) $imgName = '';
												$imgSrc = URL::to('/assets/common/images/client'.$imgName.'.png');
												if($work->performer2 == 1) $imgSrc = URL::to('/assets/common/images/agency'.$imgName.'.png');
												if($work->performer3 == 1) URL::to('/assets/common/images/money'.$imgName.'.png');
												
											@endphp
											<td>
												<span></span><a href="#" class="edit-task" onclick="return false;" data-id="{{$work->id}}"><img id="imgt-{{$work->id}}" src="{{$imgSrc}}" alt=""></a>
											</td>
											@endforeach
											@endif
											<td>
												<button type="button" class="btn btn-samurai use-padding addtask-btn btn-success">タスクを追加する</button>
											</td>
										</tr>
										<tr>
											<td>対応者</td>
											@if(count($work_set))
											@foreach($work_set as $work)
											<td class="text-center">{{$work->user->user_name()}}</td>
											@endforeach
											@endif
											<td></td>
										</tr>
										<tr>
											<td>作業内容</td>
											@if(count($work_set))
											@foreach($work_set as $work)
											<td>{{WorkSetString($work->work_content, $work->work_content_other_value, $work->work_content_other)}}</td>
											@endforeach
											@endif
											<td></td>
										</tr>
										<tr>
											<td>提出期限</td>
											@if(count($work_set))
											@foreach($work_set as $work)
											<td class="text-center">{{date_string($work->schedule)}}</td>
											@endforeach
											@endif
											<td></td>
										</tr>
									</tbody>
								</table>
							</div> <!-- end table -->
							<h2 class="page-title">書類アップロード状況</h2>
							@if($work_set)
							@foreach($work_set as $work)
						<table class="table table-bordered table-hover table-tallpro">
						    <thead>
							    <tr>
							        <th>ファイル名</th>
							        <th>更新日</th>
							        <th>返信期日</th>
							        <th>更新ファイル名</th>
							        <th>更新者</th>
							        <th>更新ファイル</th>
							    </tr>
						    </thead>
						    <tbody>
							    <tr>
							        <td class="text-center">
							        	<p class="mgt-20">@if($work->file_name) {{HTML::linkRoute('agency.jobs.matching.download-file', $work->file_name, [$work->file_path, $work->file_name], ['target'=>'_blank'] ) }} @endif</p>
							        	@if($work->complete_flag)
									    <button type="button" data-id="{{$work->id}}" class="shadowbuttonprimary btn btn-primary complete_btn complete_btn_{{$work->id}}">完了</button>
									    @else
										<button type="button" data-id="{{$work->id}}" class="shadowbuttonprimary btndisabled btn btn-primary complete_btn complete_btn_{{$work->id}}">未完了</button>
									    @endif
							        </td>
							        <td colspan="4" id="tf-{{$work->id}}"> @if(!$work->file_name) アップされたファイルはありません。 @endif 
									@foreach($work->work_set_sub as $sub)
										<table class="table table-hover table-bordered" style="margin-bottom:0">
											<tr>
												<td width="110">{{$sub->schedule}}</td>
												<td width="110">{{$sub->update_date}}</td>
												<td style="word-break:break-word;"><a href="{{URL::route('agency.jobs.matching.download-file', [$sub->file_path, $sub->file_name])}}" target="_blank">{{$sub->file_name}}</a></td>
												<td width="60">@if($sub->update_type == 0) {{HTML::image('assets/common/images/agency.png', '', ['class'=>'imgcircle'])}} @else {{HTML::image('assets/common/images/client.png', '', ['class'=>'imgcircle'])}} @endif </td>
											</tr>
										</table>
									@endforeach
							        </td>

							        <td class="tb-{{$work->id}}">
							        	@if($work->complete_flag)
							        	<div class="checksuccess">
							        		<i class="fa fa-check" style="color: #0abc03"></i>完了
							        	</div>
							        	@else
							        	{{Form::open(['method'=>'POST', 'files'=>true, 'class'=>'form-inline', 'id'=>'uploadf-' . $work->id])}}
							        		<input type="hidden" name="hire_id" value="{{$hire_id}}">
							        		<input type="hidden" name="work_set_id" value="{{$work->id}}">
							        		<p class="text-center">提出期限</p>
							        		<div class="text-center">
								        		<div class="form-group">
								        			{{Form::select('day', range(1, 31), 0, ['class'=>'nopdsl'] )}}
													<label for="">月</label>
													
								        		</div>
								        		<div class="form-group">
								        			{{Form::select('month', range(1, 12), 0, ['class'=>'nopdsl'] )}}
													<label for="">日</label>
								        		</div>
								        	</div>
								        	<div class="inputfilehide">
								        		<input type="file" name="image" id="file-{{$work->id}}">
								        		<span class="glyphicon glyphicon-open-file"></span>
								        	</div>
								        	<p class="text-center">
								        		<button type="button" id="btn-upload-{{$work->id}}" onclick="uploadForm({{$work->id}});" class="shadowbuttonprimary btn btn-primary">更新する</button>
								        	</p>
								        	
							        	{{Form::close()}}
										@endif
							        </td>
							    </tr>

						    </tbody>
						</table>
						@endforeach
						@endif
						</div>
							<div class="ddetail-msg dmessage-list">
								<ul id="dmsg-result">
									@foreach($messageList as $key=>$msg)
									<li style="width:100%">
										<div class="@if($msg->from_id==session('user_id')) msj-rta @else msj @endif macro">
											<div class="avatar">
												<img class="img-circle" src="{{URL::to($msg->chat_with_user->image)}}">
												<span>{{$msg->chat_with_user->user_name()}}</span>
											</div>
											<div class="text text-l">
												<p>{{$msg->message}}</p>
												@if($msg->file)
												<p class="msg-files">
												@foreach(json_decode($msg->file) as $file)
													<a target="_blank" href="{{URL::route('agency.jobs.matching.download-file', [$file[1], $file[0]] )}}">{{$file[0]}}</a>
												@endforeach
												</p>
												@endif
												<p><small>{{ol_get_datetime_string($msg->created_at)}}</small></p>
											</div>
										</div>
									</li>
									
									@endforeach
								</ul>
								<div class="bottom-input-msg">
								{{Form::open(['method'=>'POST', 'id'=>'sendmsg-form'])}}
									<div class="msg-input">
										<textarea class="form-control mytext" name="message" id="submit-msg" cols="30" rows="3"></textarea>
					                </div>
					                <input type="hidden" name="hire_id" value="{{$hire_id}}">
					                <div class="input-msg-area">
					                    <span class="glyphicon glyphicon-share-alt"></span>
					                </div>
					                <div class="clearfix"></div>
					                <div class="file-sl">
                                    	<label for="files"> <span for="files" class="glyphicon glyphicon-paperclip"></span></label>
                                    	<input class="sr-only" type="file" multiple="multiple" name="file[]" id="files">
                                    	<div id="file-select-list">
                                    	</div>
                                    </div>
                                {{Form::close()}}
								</div>
							</div>
						</div> <!-- end .detail-hire -->
					</div> <!-- end col-sm-9 -->
				</div>	<!-- end .row -->
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="completeModal">
	<div class="modal-dialog" style="width: 900px">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title text-center">評価を設定して終了報告を行って下さい</h4>
			</div>
			<div class="modal-body">
				{{Form::open(['method'=>'POST', 'name'=>'completeForm', 'id'=>'completeForm'])}}
				
				<input type="hidden" name="content", value="0">
				<!-- 
				<p>すべての業務が完了した場合、下記の項目にチェックを入れて、終了報告を行なってください。</p>
				<div class="radio">
					<label>
						<input type="radio" name="content" id="input-content-2" value="2" checked="checked">
						<b>取得して終了する</b>
					</label>
				</div>
				<div class="radio">
					<label>
						<input type="radio" name="content" id="input-content-0" value="0">
						<b>取得できずに終了する</b>
					</label>
				</div>
				<div class="radio">
					<label>
						<input type="radio" name="content" id="input-content-1" value="1">
						<b>キャンセル</b>
					</label>
				</div> -->
				<p>事業者の評価を行なってください。<br>
★をクリックすることで星の数を設定して、事業者を評価してください。数字を入力して星の数を設定することもできます。<br>
入力欄には詳細な評価を記入してください。</p>
				
				<input type="hidden" name="hire_id", value="{{$selectedHire->id}}">
				<div class="row">
					<div class="col-sm-12">
						<div class="row">
							<div class="col-sm-6">
								<div class="div-style-blue1 agencyjob-box-star">
									<table class="full-width">
										<tbody>
											<tr>
												<td><b>総合評価</b></td>
												<td><span class="font18" id="rating1">5</span></td>
												<td>
													<div class="star-rating bigstar">
														<select class="datrating1" data-ids="rating1" name="rating1" autocomplete="off">
															<option value="1">1</option>
															<option value="2">2</option>
															<option value="3">3</option>
															<option value="4">4</option>
															<option value="5" selected>5</option>
														</select>
													</div> <!-- end .star-rating -->
												</td>
											</tr>
											<tr>
												<td><b>総合評価</b></td>
												<td><span class="font18" id="rating2">5</span></td>
												<td>
													<div class="star-rating bigstar">
														<select class="datrating1" data-ids="rating2" name="rating2" autocomplete="off">
															<option value="1">1</option>
															<option value="2">2</option>
															<option value="3">3</option>
															<option value="4">4</option>
															<option value="5" selected>5</option>
														</select>
													</div> <!-- end .star-rating -->
												</td>
											</tr>
											<tr>
												<td><b>総合評価</b></td>
												<td><span class="font18" id="rating3">5</span></td>
												<td>
													<div class="star-rating bigstar">
														<select class="datrating1" data-ids="rating3" name="rating3" autocomplete="off">
															<option value="1">1</option>
															<option value="2">2</option>
															<option value="3">3</option>
															<option value="4">4</option>
															<option value="5" selected>5</option>
														</select>
													</div> <!-- end .star-rating -->
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="div-style-blue1 agencyjob-box-star">
									<table class="full-width">
										<tbody>
											<tr>
												<td><b>総合評価</b></td>
												<td><span class="font18" id="rating4">5</span></td>
												<td>
													<div class="star-rating bigstar">
														<select class="datrating1" data-ids="rating4" name="rating4" autocomplete="off">
															<option value="1">1</option>
															<option value="2">2</option>
															<option value="3">3</option>
															<option value="4">4</option>
															<option value="5" selected>5</option>
														</select>
													</div> <!-- end .star-rating -->
												</td>
											</tr>
											<tr>
												<td><b>総合評価</b></td>
												<td><span class="font18" id="rating5">5</span></td>
												<td>
													<div class="star-rating bigstar">
														<select class="datrating1" data-ids="rating5" name="rating5" autocomplete="off">
															<option value="1">1</option>
															<option value="2">2</option>
															<option value="3">3</option>
															<option value="4">4</option>
															<option value="5" selected>5</option>
														</select>
													</div> <!-- end .star-rating -->
												</td>
											</tr>
											<tr>
												<td><b>総合評価</b></td>
												<td><span class="font18" id="rating6">5</span></td>
												<td>
													<div class="star-rating bigstar">
														<select class="datrating1" data-ids="rating6" name="rating6" autocomplete="off">
															<option value="1">1</option>
															<option value="2">2</option>
															<option value="3">3</option>
															<option value="4">4</option>
															<option value="5" selected>5</option>
														</select>
													</div> <!-- end .star-rating -->
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-12">
						<textarea name="report_message" id="report_message" class="form-control" rows="4"></textarea>
						<div class="checkbox">
		        			<label class="font12"><input type="checkbox" name="no_display" value="1"><strong>今後、この施策を検索結果に表示させない。</strong></label>
		        		</div>
		        		<div class="text-center">
		        			<button type="button" data-dismiss="modal" class="btn btn-default btn-samurai">閉じる</button>
		        			<button type="button" id="submit-btn"  onclick="return checkForm();" class="btn btn-samurai btn-success">終了報告する</button>
		        		</div>
					</div>
				</div>
				{{Form::close()}}
			</div>
			<!-- <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div> -->
		</div>
	</div>
</div>

<div class="modal fade" id="modalConfirm">
	<div class="modal-dialog">
		<!-- Modal content-->
        <div class="modal-content">                     
          <div class="modal-body">
          	<h3>終了報告が完了いたしました。</h3>
            <p>評価を頂きましてありがとうございました。</p>
            <p>下記の仕事管理画面から他の案件の確認ができます。</p>
            <div class="row">
                <div class="col-sm-12 text-center">
                    <button type="button" class="btn btn-default btn-samurai" id="reload_page" data-dismiss="modal">閉じる</button>
                    <button type="button" class="btn btn-success btn-samurai btn-style-shadow-green" id="go_to_finish" data-dismiss="modal">確定する</button>
                </div>
            </div>
          </div>
        </div>
      </div>
</div>

<div class="modal fade" id="taskSettingModal">
	<div class="modal-dialog" style="width: 900px;">
		<div class="modal-content">
			<div class="modal-body">
				<h4 class="modal-title text-center" id="task-header"></h4>
				{{Form::open(['method'=>'POST', 'id'=>'taskSettingForm', 'files'=>true, 'onsubmit'=>'return submitForm();', 'name'=>'taskSettingForm'])}}
				<input type="hidden" name="hire_id" id="f_hire_id" value="{{$hire_id}}">
				<input type="hidden" name="work_set_id" id="f_work_id" value="0">
					<table class="table table-bordered">
						<tbody>
							<tr>
								<td class="tdhead">作業者</td>
								<td>
									<div class="row task-performer">
										<div class="col-sm-3">
											<span class="button-radio">
												<button type="button" class="btn btn-ncheckbox" value="1" data-id="performer" data-color="success"><img src="{{URL::to('assets/common/images/agency.png')}}"> あなた</button>
												<input type="radio" class="hidden cbperformer" value="1" name="performer" id="performer1">
										    </span>
										</div>
										<div class="col-sm-3">
											<span class="button-radio">
												<button type="button" class="btn btn-ncheckbox" value="2" data-id="performer" data-color="success"><img src="{{URL::to('assets/common/images/client.png')}}">クライアント</button>
												<input type="radio" class="hidden cbperformer" value="2" name="performer" id="performer2">
										    </span>
										</div>
										<div class="col-sm-3">
											<span class="button-radio">
												<button type="button" class="btn btn-ncheckbox" value="3" data-id="performer" data-color="success"><img src="{{URL::to('assets/common/images/country.png')}}">自治・省庁</button>
												<input type="radio" class="hidden cbperformer" value="3" name="performer" id="performer3">
										    </span>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td class="tdhead">日付を設定</td>
								<td>
									<div class="row">
										<div class="col-xs-3">
											<input type="text" name="update_date" id="update_date" class="form-control datepickertoday" value="{{date('Y年m月d日')}}">
										</div>
									</div>
									
								</td>
							</tr>
							<tr>
								<td class="tdhead">
									　書類を<br>アップロード
								</td>
								<td>
									<div class="box-file">
	                					<p>企業より提出してもらう書類がある場合は、書類名、ファイルを設定してください。</p>
	                					<div class="checkbox">
	                						<label>
	                							{{Form::checkbox('no_file', 1, false, ['id'=>'no_file'] )}}
	                							ファイルを設定しない
	                						</label>
	                					</div>
	                					<input type="text" id="fileName" name="fileName" class="form-control" value="" placeholder="書類名">
	                				
	                					<div id="file-drag">アップロードする場合は、<br>ここにドラッグ＆ドロップしてください。</div>
										<input type="file" style="display: none" name="taskfile" id="taskfile">
										
	                					<div class="bottom-box-file">
	                						<div class="dbottom-text">
	                							<span class="text-bottom">提出期限</span>
	                						</div>
	                						<div class="dbottom-input">
	                							<input type="text" name="term_content" id="term_content" class="form-control" value="" placeholder="提出期限を設定できます">
	                						</div>
	                						<div class="dbottom-cb">
	                							<div class="checkbox">
			                						<label>
			                							<input type="checkbox" value="" id="term_flag">
			                							期限を設定しない
			                						</label>
			                					</div>
	                						</div>
	                					</div>
	                				</div> <!-- end .box-file -->
								</td>
							</tr>
							<tr>
								<td class="tdhead">タスク</td>
								<td class="task-setting-list">
									<div class="row">
										<div class="col-sm-2">
											<span class="button-checkbox">
										        <button type="button" class="btn btn-ncheckbox" data-color="success">書類完成日</button>
										        <input type="checkbox" name="work_set_task[]" value="0" class="hidden work_task">
										    </span>
										</div>
										<div class="col-sm-2">
											<span class="button-checkbox">
										        <button type="button" class="btn btn-ncheckbox" data-color="success">提出書類</button>
										        <input type="checkbox" name="work_set_task[]" value="1" class="hidden work_task">
										    </span>
										</div>
										<div class="col-sm-2">
											<span class="button-checkbox">
										        <button type="button" class="btn btn-ncheckbox" data-color="success">本申請</button>
										        <input type="checkbox" name="work_set_task[]" value="2" class="hidden work_task">
										    </span>
										</div>
										<div class="col-sm-2">
											<span class="button-checkbox">
										        <button type="button" class="btn btn-ncheckbox" data-color="success">採択日</button>
										        <input type="checkbox" name="work_set_task[]" value="3" class="hidden work_task">
										    </span>
										</div>
										<div class="col-sm-2">
											<span class="button-checkbox">
										        <button type="button" class="btn btn-ncheckbox" data-color="success">受給申請</button>
										        <input type="checkbox" name="work_set_task[]" value="4" class="hidden work_task">
										    </span>
										</div>
										<div class="col-sm-2">
											<span class="button-checkbox">
										        <button type="button" class="btn btn-ncheckbox" data-color="success">受給</button>
										        <input type="checkbox" name="work_set_task[]" value="5" class="hidden work_task">
										    </span>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-2">
											<span class="button-checkbox">
										        <button type="button" class="btn btn-ncheckbox" data-color="success">確定通知書</button>
										        <input type="checkbox" name="work_set_task[]" value="6" class="hidden work_task">
										    </span>
										</div>
										<div class="col-sm-2">
											<span class="button-checkbox">
										        <button type="button" class="btn btn-ncheckbox" data-color="success">支払</button>
										        <input type="checkbox" name="work_set_task[]" value="7" class="hidden work_task">
										    </span>
										</div>
										<div class="col-sm-2">
											<span class="button-checkbox">
										        <button type="button" class="btn btn-ncheckbox" data-color="success">その他</button>
										        <input type="checkbox" name="is_checked" value="1" class="hidden work_task_check" id="is_checked">
										    </span>
										</div>
										<div class="col-sm-6">
											<input type="text" class="form-control" name="other_cb" id="other_cb" placeholder="上記以外">
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td class="tdhead">表示設定</td>
								<td class="task-setting-list">
									<div class="row">
										<div class="col-sm-2">
											<span class="button-radio">
												<button type="button" class="btn btn-ncheckbox" value="1" data-id="display_setting" data-color="success">企業</button>
												<input type="radio" class="hidden" value="1" name="display_setting" id="display_setting1">
										    </span>
										</div>
										<div class="col-sm-2">
											<span class="button-radio">
												<button type="button" class="btn btn-ncheckbox" value="2" data-id="display_setting" data-color="success">士業</button>
												<input type="radio" class="hidden" value="2" name="display_setting" id="display_setting2">
										    </span>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td class="tdhead">レコメンド<br>を設定する</td>
								<td class="task-setting-list">
									<div class="row">
										<div class="col-sm-2">
											<span class="button-checkbox">
										        <button type="button" class="btn btn-ncheckbox" data-color="success">当日</button>
										        <input type="checkbox" name="notify_day[]" value="1" class="hidden cbnotify_day">
										    </span>
										</div>
										<div class="col-sm-2">
											<span class="button-checkbox">
										        <button type="button" class="btn btn-ncheckbox" data-color="success">1日前</button>
										        <input type="checkbox" name="notify_day[]" value="2" class="hidden cbnotify_day">
										    </span>
										</div>
										<div class="col-sm-2">
											<span class="button-checkbox">
										        <button type="button" class="btn btn-ncheckbox" data-color="success">2日前</button>
										        <input type="checkbox" name="notify_day[]" value="3" class="hidden cbnotify_day">
										    </span>
										</div>
										<div class="col-sm-2">
											<span class="button-checkbox">
										        <button type="button" class="btn btn-ncheckbox" data-color="success">なし</button>
										        <input type="checkbox" name="notify_day[]" value="4" class="hidden cbnotify_day">
										    </span>
										</div>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
					<div class="text-center">
						<button type="button" class="btn btn-default btn-samurai" id="reload_page" data-dismiss="modal">戻る</button>
                    	<button type="submit" class="btn btn-success btn-samurai btn-style-shadow-green" id="go_to_finish">設定する</button>
					</div>
				{{Form::close()}}
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="cancelModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body text-center">
				<h4>キャンセルすると案件を元に戻せません</h4>
				<h4>本当にキャンセルしますか？</h4>
				<div class="text-center" style="margin-top: 50px;">
					<button type="button" class="btn btn-default btn-samurai" data-dismiss="modal">戻る</button>
                	<button type="submit" class="btn btn-danger btn-samurai btn-style-shadow-green" id="go_to_cancel">キャンセルする</button>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal com-modal fade" id="cancelModal2">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<div class="com-list">
					<p class="com-head">案件をキャンセルいたしました。</p>
					<p class="com-p">評価を頂きましてありがとうございました。</p>
					<p class="com-p">案件をキャンセルしました。キャンセルした案件を見る</p>
					<button type="button" data-dismiss="modal" class="btn btn-success btn-samurai cancel2_modal_btn" style="width: 220px">キャンセルした案件を見る</button>
				</div>
				<div class="text-center">
					<button type="button" data-dismiss="modal" class="btn btn-samurai btn-lg btn-default cancel2_modal_btn">閉じる</button>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('script')
	<script>
		var base_url = '{{URL::to('/')}}';
		var tfile;
		var hireId = {{$hire_id}};
		var me = {};
		me.avatar = '{{URL::to($user->image)}}';
		me.name = '{{$user->user_name()}}';

		var you = {};
		you.avatar = '{{URL::to($shiff_user->image)}}';
		you.name = '{{$shiff_user->user_name()}}';
		var currentVal = 0;
		var currentEl;
		var work_set = [];
		var targetReload = '/agency/mypage/recruitment';
		var finishRoute = '/agency/mypage/recruitment/finished/';
		var recruitAjax = '/agency/mypage/recruitment-ajax';

		var taskAjax = '/agency/mypage/jobs/matching-case/task-setting-ajax';
		var workSetAjax = '/agency/mypage/recruitment-workset-ajax';

		var messageAjax = '/agency/mypage/jobs/matching-case/message-ajax';

		var taskViewAjax = '/agency/mypage/jobs/matching-case/task-view-ajax';
		var setTaskAjax = '/agency/mypage/jobs/matching-case/set_task-ajax';

		var cancelMatchingAjax = '/agency/recruitment/cancel-matching';
		
	</script>
	{{HTML::script('assets/common/js/finish_func.js')}}
	{{HTML::script('assets/common/js/task-manager.js')}}
	{{HTML::script('assets/common/js/recruit_chat.js')}}
	{{HTML::script('assets/common/js/new_task.js')}}
	{{HTML::script('assets/common/js/send_message.js')}}
@endsection
