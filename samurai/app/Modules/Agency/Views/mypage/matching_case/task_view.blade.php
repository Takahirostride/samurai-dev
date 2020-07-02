@extends('layouts.home')
@section('style')
	{{HTML::style('assets/common/plugins/datepicker/css/bootstrap-datepicker.min.css')}}
	{{HTML::style('assets/common/plugins/ajaxtable/css/ajaxtable.css')}}
	{{HTML::style('assets/agency/css/task.css')}}
	
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
						<h3 class="page-title">進歩状況</h3>
						<ul class="tallList">
							@foreach($work_set as $work)
								@php 
									$class = 'client-status-buttons';
									if($work->performer2 == 1) $class = 'agency-status-buttons';
									if($work->performer3 == 1) $class = 'country-status-buttons';
								@endphp
							<li>
								<div id="divs-{{$work->id}}" class="text-center {{$class}}">
									<a href="{{URL::route('agency.jobs.matching.edit_task', [$work->hire_id, $work->id] )}}" class="@if($work->complete_flag)active @endif ">
									{{year_date_string($work->schedule)}}
								        <span></span>
								        {{WorkSetString($work->work_content, $work->work_content_other_value, $work->work_content_other)}}<br>
								    </a>
								    @if($work->complete_flag)
								    <button type="button" data-id="{{$work->id}}" class="shadowbuttonprimary status-buttons btn btn-primary complete_btn complete_btn_{{$work->id}}">完了</button>
								    @else
									<button type="button" data-id="{{$work->id}}" class="shadowbuttonprimary status-buttons btndisabled btn btn-primary complete_btn complete_btn_{{$work->id}}">未完了</button>
								    @endif
								</div>
							</li>
							@endforeach
							
							<li>
								<div class="text-center country-status-buttons">
								    <a href="{{URL::route('agency.jobs.matching.setting_task', [$hire_id] )}}" class="shadowbuttonsuccess btn btn-success tallListend" style="color: #FFF">未完了</a>
								</div>
							</li>
						</ul>
					</div>
					<div class="col-sm-12">
						<h3 class="page-title">申請状況</h3>
						@if(count($work_set))
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
						
					</div><!-- end .col-sm-12 -->
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

		var uploadForm = function(wid) {
			$('#btn-upload-'+wid).prop('disabled', true);
			var form = $('#uploadf-'+wid);
    		var formdata = new FormData(form[0]);
			$.ajax({
				url: base_url + '/agency/mypage/jobs/matching-case/task-view-ajax',
				data: formdata,
				type: 'POST',
				processData: false,
    			contentType: false,
				success: function(json) {
					if(json.success == true)
					{
						if(json.data.update_type == 1)
						{
							var img = '<img src="'+base_url+'/assets/common/images/client.png" class="imgcircle">';
						} else {
							var img = '<img src="'+base_url+'/assets/common/images/agency.png" class="imgcircle">';
						}
						html = '<table class="table table-hover table-bordered" style="margin-bottom:0">';
						html += '<tr><td>'+json.data.schedule+'</td><td>'+json.data.update_date+'</td><td><a href="'+base_url+'//api/download-file/'+json.data.file_path+'/'+json.data.file_name+'" target="_blank">'+json.data.file_name+'</a></td><td>'+img+'</td></tr>';
						html += '</table>';
						$('#tf-'+wid).append(html);
					}
					$('#btn-upload-'+wid).prop('disabled', false);
					$('#file-'+wid).val('');
					
					
				}
			})			
			return false;
		}
		$(document).on('change', 'select[name="month"]', function() {
			var daysl = $(this).parent().parent().find('select:first-child');
			var m30 = [1,3,5,8,10];
			var selectedVal = $(this).val();
			if($.inArray( parseInt(selectedVal), m30) != -1) {
				$(daysl).find('option[value="30"]').prop('disabled', true);
			} else {
				$(daysl).find('option[value="30"]').prop('disabled', false);
			}
			
		});

		$(document).on('click', '.complete_btn', function() {
			var bid = $(this).attr('data-id');
			$.ajax({
				url: base_url + '/agency/mypage/jobs/matching-case/set_task-ajax',
				data: {act: 'setFinish', work_set_id: bid},
				type: 'POST',
				success: function(json) {
					if(json.success)
					{
						html = setFormEl(json.is_finish, bid);
						if(json.is_finish)
						{
							txt = '完了';
							rmclass = 'btndisabled';
							addclass = '';
						} else {
							txt = '未完了';
							rmclass = '';
							addclass = 'btndisabled';
						}
						$('.complete_btn_'+bid).text(txt);
						$('.complete_btn_'+bid).removeClass(rmclass);
						$('.complete_btn_'+bid).addClass(addclass);
						$('.tb-'+bid).html(html);
						setImage(json.is_finish, bid);
					}
				}
			});
		});
		var setImage = function(is_finish, wid) {
			if(is_finish == 1)
			{
				$('#divs-'+wid+' a').addClass('active');
			} else {
				$('#divs-'+wid+' a').removeClass('active');
			}
			
		}
		var setFormEl = function(is_finish, wid) {
			if(is_finish == 1)
			{
				html = '<div class="checksuccess"><i class="fa fa-check" style="color: #0abc03"></i>完了</div>';
			} else {
				html = '<form method="POST" action="'+base_url+'/agency/mypage/jobs/matching-case/task-view/'+wid+'" accept-charset="UTF-8" class="form-inline" id="uploadf-'+wid+'" enctype="multipart/form-data">'+
							'<input type="hidden" name="hire_id" value="{{$hire_id}}">'+
							'<input type="hidden" name="work_set_id" value="'+wid+'">'+
							        		'<p class="text-center">提出期限</p>'+
							        		'<div class="text-center">'+
								        		'<div class="form-group">'+
								        			'<select class="nopdsl" name="day"><option value="0" selected="selected">1</option><option value="1">2</option><option value="2">3</option><option value="3">4</option><option value="4">5</option><option value="5">6</option><option value="6">7</option><option value="7">8</option><option value="8">9</option><option value="9">10</option><option value="10">11</option><option value="11">12</option><option value="12">13</option><option value="13">14</option><option value="14">15</option><option value="15">16</option><option value="16">17</option><option value="17">18</option><option value="18">19</option><option value="19">20</option><option value="20">21</option><option value="21">22</option><option value="22">23</option><option value="23">24</option><option value="24">25</option><option value="25">26</option><option value="26">27</option><option value="27">28</option><option value="28">29</option><option value="29">30</option><option value="30">31</option></select>'+
													'<label for="">月</label>'+
								        		'</div>'+
								        		'<div class="form-group">'+
								        			'<select class="nopdsl" name="month"><option value="0" selected="selected">1</option><option value="1">2</option><option value="2">3</option><option value="3">4</option><option value="4">5</option><option value="5">6</option><option value="6">7</option><option value="7">8</option><option value="8">9</option><option value="9">10</option><option value="10">11</option><option value="11">12</option></select>'+
													'<label for="">日</label>'+
								        		'</div>'+
								        	'</div>'+
								        	'<div class="inputfilehide">'+
								        		'<input type="file" name="image" id="file-'+wid+'">'+
								        		'<span class="glyphicon glyphicon-open-file"></span>'+
								        	'</div>'+
								        	'<p class="text-center">'+
								        		'<button type="button" id="btn-upload-'+wid+'" onclick="uploadForm('+wid+');" class="shadowbuttonprimary btn btn-primary">更新する</button>'+
								        	'</p>'
			}
			return html;
		}
	</script>
@endsection