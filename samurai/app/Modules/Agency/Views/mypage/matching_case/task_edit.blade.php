@extends('layouts.home')
@section('style')
	{{HTML::style('assets/common/plugins/datepicker/css/bootstrap-datepicker.min.css')}}
	{{HTML::style('assets/common/plugins/ajaxtable/css/ajaxtable.css')}}
	<style type="text/css">
		.datepicker.datepicker-inline tr td {
			padding: 5px 13px;
		}
		.cb-checkbox {
		    visibility: hidden;
		    position: absolute;
		}

		.no-hover.btn-outline-primary:hover {
		  color: #0275d8;
		  background-color: transparent;
		  border-color: #0275d8;
		}
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
<div class="mainpage clientprofile-11">
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
		                    <li class="">
		                        <a href="{{URL::route('agency.jobs')}}">依頼・提案・募集</a>
		                    </li>
		                    <li class="active">
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
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<ul class="nav nav-tabs tablinksub">
						    <li class="active">
						        <a href="{{ URL::route('agency.jobs.matchingcase') }}">案件一覧 </a>
						    </li>
						    <li class="">
						        <a href="{{ URL::route('agency.jobs.matching.book') }}">スケジュール </a>
						    </li><!-- 
						    <li>
						        <a href="mypage/agencyjob-1-3.php">募集案件</a>
						    </li> -->
						</ul>
					</div>	<!-- end middle page -->
				</div>
				{{Form::close()}}
				<div class="row">
					<div class="col-sm-12">
		                    <div class="boxpdbg mgt-20">
		                    	@foreach($hire as $key=>$item)
		                        <table class="table table-bordered table-hover pdtdbold">
		                            <thead>
		                                <tr>
		                                    <th>タイトル</th>
		                                    <th width="13%">事業者名</th>
		                                    <th width="13%">マッチング日</th>
		                                    <th width="13%">締切日</th>
		                                </tr>
		                            </thead>
		                            <tbody>
		                                <tr>
		                                    <td>{{$item->policy_name}}（施策名）</td>
		                                    <td>{{$item->user_name}}</td>
		                                    <td>{{ date_string($item->matching_date) }}</td>
		                                    <td>{{ date_string($item->finish_date) }}</td>
		                                </tr>
		                            </tbody>
		                        </table>
		                        <table class="table table-bordered table-hover pdtdbold">
		                            <tbody>
		                                <tr>
		                                    <td>
		                                        <div class="pull-left">
		                                            <a href="{{URL::route('agency.jobs.matching.setting_task', [$item->hireid] )}}" class="shadowbuttonsuccess btn btn-success mgr-8">タスク設定</a>
		                                            <a href="{{URL::route('agency.jobs.matching.view_task', [$item->hireid] )}}" class="shadowbuttonsuccess btn btn-success mgr-8">タスクを見る</a>
		                                            <a href="{{URL::route('agency.jobs.matching.view_message', [$item->hireid] )}}" class="shadowbuttonsuccess btn btn-success">メッセージを見る</a>
		                                        </div>
		                                        <div class="pull-right">
		                                            <a href="{{URL::route('agency.jobs.matching.report', [$item->hireid] )}}" class="shadowbuttonprimary btn btn-primary mgr-8">請求</a>
		                                            <a href="{{URL::route('agency.jobs.matching.complete', [$item->hireid] )}}" class="shadowbuttonprimary btn btn-primary">完了・キャンセル</a>
		                                        </div>
		                                    </td>
		                                </tr>
		                            </tbody>
		                        </table>
		                        @endforeach
		                    </div> <!-- end .boxpdbg mgt-20 -->
                	</div><!-- end col-sm-12 -->
                	<div class="col-sm-12">
                		<h2 class="page-title">お知らせ</h2>
                		<div class="alert alert-success @if(!session('success')) no-hidden @endif ">
                			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                			タスクを保存しました。
                		</div>
                		{{Form::open(['method'=>'POST', 'files'=>true, 'onsubmit'=>'return submitForm();', 'id'=>'settingForm'])}}
                		{{Form::hidden('work_set_id', request()->work_set_id )}}
                		<div class="row">
                			<div class="col-xs-4">
                				<div id="update_date_pick" data-date="{{$cwork->schedule}}" class="datepickertoday"></div>
                                {{Form::input('hidden', 'update_date', $cwork->schedule, ['class'=>'form-control', 'id'=>'update_date', 'data-date-format'=>'YYYY/MM/DD'] )}}
                                <div class="help-block with-errors"></div>
	                		</div>
	                		<div class="col-xs-8">
	                			<div class="row">
	                				<div class="col-sm-3"><span class="shead">日程</span></div>
		                			<div class="col-sm-9">
		                				<span id="current-select-date"></span>
		                			</div>
	                			</div>
	                			<div class="row">
		                			<div class="col-sm-3"><span class="shead">タスク</span></div>
		                				<div class="col-sm-9 checkbox-btn">
		                					<div class="row">
		                						<div class="col-sm-3">
		                							<span class="button-checkbox">
												        <button type="button" class="btn btn-ncheckbox" data-color="success">書類完成日</button>
												        {{Form::checkbox('work_set_task[]', 0, @in_array(0, json_decode($cwork->work_content) ), ['class'=>'hidden work_task'] )}}
												    </span>
		                						</div>
		                						<div class="col-sm-3">
		                							<span class="button-checkbox">
												        <button type="button" class="btn btn-ncheckbox" data-color="success">提出書類</button>
												        {{Form::checkbox('work_set_task[]', 1, @in_array(1, json_decode($cwork->work_content) ), ['class'=>'hidden work_task'] )}}
												    </span>
												</div>
		                						<div class="col-sm-3">
		                							<span class="button-checkbox">
												        <button type="button" class="btn btn-ncheckbox" data-color="success">本申請</button>
												        {{Form::checkbox('work_set_task[]', 2, @in_array(2, json_decode($cwork->work_content) ), ['class'=>'hidden work_task'] )}}
												    </span>
												</div>
		                						<div class="col-sm-3">
		                							<span class="button-checkbox">
												        <button type="button" class="btn btn-ncheckbox" data-color="success">採択日</button>
												        {{Form::checkbox('work_set_task[]', 3, @in_array(3, json_decode($cwork->work_content) ), ['class'=>'hidden work_task'] )}}
												    </span>
												</div>
		                					</div> <!-- end .row -->
		                					<div class="row">
		                						<div class="col-sm-3">
		                							<span class="button-checkbox">
												        <button type="button" class="btn btn-ncheckbox" data-color="success">受給申請</button>
												        {{Form::checkbox('work_set_task[]', 4, @in_array(4, json_decode($cwork->work_content) ), ['class'=>'hidden work_task'] )}}
												    </span>
												</div>
		                						<div class="col-sm-3">
		                							<span class="button-checkbox">
												        <button type="button" class="btn btn-ncheckbox" data-color="success">受給</button>
												        {{Form::checkbox('work_set_task[]', 5, @in_array(5, json_decode($cwork->work_content) ), ['class'=>'hidden work_task'] )}}
												    </span>
												</div>
		                						<div class="col-sm-3">
		                							<span class="button-checkbox">
												        <button type="button" class="btn btn-ncheckbox" data-color="success">確定通知書</button>
												        {{Form::checkbox('work_set_task[]', 6, @in_array(6, json_decode($cwork->work_content) ), ['class'=>'hidden work_task'] )}}
												    </span>
												</div>
		                						<div class="col-sm-3">
		                							<span class="button-checkbox">
												        <button type="button" class="btn btn-ncheckbox" data-color="success">支払</button>
												        {{Form::checkbox('work_set_task[]', 7, @in_array(7, json_decode($cwork->work_content) ), ['class'=>'hidden work_task'] )}}
												    </span>
												</div>
		                					</div> <!-- end .row -->
		                					<div class="row">
		                						<div class="col-sm-3">
		                							<span class="button-checkbox">
												        <button type="button" class="btn btn-ncheckbox" data-color="success">その他</button>
												        {{Form::checkbox('is_checked', 1, $cwork->work_content_other_value, ['class'=>'hidden', 'id'=>'is_checked'] )}}
												    </span>
												</div>
		                						<div class="col-sm-9">
		                							{{Form::text('other_cb', $cwork->work_content_other, ['class'=>'form-control', 'placeholder'=>'上記以外'] )}}
		                						</div>
		                					</div> <!-- end .row -->
		                				</div> <!-- end .col-sm-10 -->
		                		</div> <!-- end .row -->
		                		<div class="row">
		                			<div class="col-sm-3"></div>
		                			<div class="col-sm-9">
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
		                				</div>
		                			</div> <!-- end .col-sm-9 -->
		                		</div> <!-- end .row -->
		                		<div class="row">
		                			<div class="col-sm-3"><span class="shead">表示設定</span></div>
		                			<div class="col-sm-9 checkbox-btn">
		                				<div class="row">
		                					<div class="col-sm-3">
	                							<span class="button-radio">
											        <button type="button" class="btn btn-ncheckbox" value="1" data-id="display_setting" data-color="success">企業</button>
											        {{Form::radio('display_setting', 1, ( ($cwork->display_setting==1)?true:false ) , ['class'=>'hidden'] )}}
											    </span>
											</div>
											<div class="col-sm-3">
	                							<span class="button-radio">
											        <button type="button" class="btn btn-ncheckbox" value="2" data-id="display_setting" data-color="success">士業</button>
											        {{Form::radio('display_setting', 2, ( ($cwork->display_setting==2)?true:false ), ['class'=>'hidden'] )}}
											    </span>
											</div>
											<div class="col-sm-3"> </div>
											<div class="col-sm-3"> </div>
		                				</div> <!-- end .row -->
		                			</div><!-- end .col-sm-9 -->
		                		</div><!-- end .row -->
		                		<div class="row">
		                			<div class="col-sm-3"><span class="shead">実行者</span></div>
		                			<div class="col-sm-9 checkbox-btn">
		                				<div class="row">
		                					<div class="col-sm-3">
	                							<span class="button-radio">
											        <button type="button" class="btn btn-ncheckbox" value="1" data-id="performer" data-color="success">企業</button>
											        {{Form::radio('performer', 1, $cwork->performer1, ['class'=>'hidden cbperformer'] )}}
											    </span>
											</div>
											<div class="col-sm-3">
	                							<span class="button-radio">
											        <button type="button" class="btn btn-ncheckbox" value="2" data-id="performer" data-color="success">企業</button>
											        {{Form::radio('performer', 2, $cwork->performer2, ['class'=>'hidden cbperformer'] )}}
											    </span>
											</div>
											<div class="col-sm-3">
												<span class="button-radio">
											        <button type="button" class="btn btn-ncheckbox" value="3" data-id="performer" data-color="success">省庁・自治体</button>
											        {{Form::radio('performer', 3, $cwork->performer3, ['class'=>'hidden cbperformer'] )}}
											    </span>
											</div>
											<div class="col-sm-3"> </div>
		                				</div> <!-- end .row -->
		                			</div><!-- end .col-sm-9 -->
		                		</div><!-- end .row -->
		                		<div class="row">
		                			<div class="col-sm-3"><span class="shead">通知日</span></div>
		                			<div class="col-sm-9 checkbox-btn">
		                				<div class="row">
		                					<div class="col-sm-3">
	                							<span class="button-checkbox">
											        <button type="button" class="btn btn-ncheckbox" data-color="success">当日</button>
											        {{Form::checkbox('notify_day[]', 1, $cwork->notify_day1, ['class'=>'hidden cbnotify_day'] )}}
											    </span>
											</div>
											<div class="col-sm-3">
	                							<span class="button-checkbox">
											        <button type="button" class="btn btn-ncheckbox" data-color="success">1日前</button>
											        {{Form::checkbox('notify_day[]', 2, $cwork->notify_day2, ['class'=>'hidden cbnotify_day'] )}}
											    </span>
											</div>
											<div class="col-sm-3">
												<span class="button-checkbox">
											        <button type="button" class="btn btn-ncheckbox" data-color="success">2日前</button>
											        {{Form::checkbox('notify_day[]', 3, $cwork->notify_day3, ['class'=>'hidden cbnotify_day'] )}}
											    </span>
											</div>
											<div class="col-sm-3">
												<span class="button-checkbox">
											        <button type="button" class="btn btn-ncheckbox" data-color="success">なし</button>
											        {{Form::checkbox('notify_day[]', 4, $cwork->notify_day4, ['class'=>'hidden cbnotify_day'] )}}
											    </span>
											</div>
		                				</div> <!-- end .row -->
		                			</div><!-- end .col-sm-9 -->
		                		</div><!-- end .row -->
	                		</div><!-- end .col-xs-8 -->
                		</div> <!-- end .row -->
                		<div class="row">
                			<div class="text-center">
                				<button type="submit" class="btn btn-style-shadow-green btn-success" style="margin:40px 0">追加する</button>
                			</div>
                		</div>
                		
						{{Form::close()}}

						<h2 class="page-title">タスク一覧</h2>
						<table class="table table-bordered table-hover pdtdbold work-table table-striped">
							<thead>
								<tr>
									<th style="width: 20%">日付</th>
									<th style="width: 30%">タスク</th>
									<th style="width: 30%">ファイル</th>
									<th style="width: 20%">編集・削除</th>
								</tr>
							</thead>
							<tbody>
								@foreach($work_set as $w)
								<tr id="wtri-{{$w->id}}">
									<td class="text-center">{{date_string($w->schedule)}}</td>
									<td class="text-center">{{WorkSetString($w->work_content, $w->work_content_other_value, $w->work_content_other)}}</td>
									<td class="text-center">{{$w->file_name}}</td>
									<td class="text-center">
										<a href="{{URL::route('agency.jobs.matching.edit_task', [request()->id, $w->id] ) }}" class="btn btn-sm btn-default"><i class="fa fa-edit"></i></a>
										<button type="button" onclick="deleteTask({{$w->id}});" class="btn btn-sm btn-default"><i class="fa fa-remove"></i></button>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
						
						<div class="text-center" id="paginationWrapper">
							{{ $work_set->links() }}
						</div>
                	</div>
				</div>	 <!-- end .row -->
			</div> <!-- end .mainpage -->
		</div>
	</div>
</div>

@endsection

@section('script')
{{HTML::script('assets/common/plugins/datepicker/js/bootstrap-datepicker.min.js')}}
{{HTML::script('assets/common/plugins/ajaxtable/js/plugins.js')}}

	<script>
		var base_url = '{{URL::to('/')}}';
		var tfile;
		var hireId = {{request()->id}};
	</script>
{{HTML::script('assets/agency/js/task_setting.js')}}
@endsection