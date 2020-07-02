@extends('layouts.home')
@section('style')
	<style type="text/css">
		.glyphicon:hover {
			cursor: pointer;
		}
		.file_select_name {
			display: block;
		}
		.subjectmes {
			display: inline-block;
			width: 100%;
		}
		#file-select-list {
			padding-right: 10px;
			text-align: right;
		}
	</style>
@endsection
@section('content')
<div class="mainpage clientprofile-1">
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
		                    <li class="">
		                        <a href="{{URL::route('agency.jobs.matchingcase')}}">マッチング案件</a>
		                    </li>
		                    <li class="active">
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
					    <div class="col-sm-8">
					    	
					    </div>
					</div>
				</div>
				{{Form::close()}}
				<div class="row">
					<div class="col-sm-12">
		                    <div class="">
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
		                                        	<a href="{{URL::route('agency.jobs.finished.rq_view_task', [$item->hireid] )}}" class="btn btn-success btn-style-shadow-green" style="margin-right: 20px">タスクを見る</a>
							    					<a href="{{URL::route('agency.jobs.finished.rq_msg_task', [$item->hireid] )}}" class="btn btn-success btn-style-shadow-green">メッセージを見る</a>
		                                        </div>
		                                        <div class="pull-right">
		                                            <button type="button" onclick="cancelFinish({{$item->hireid}});" class="btn-primary btn btn-style-shadow-blue">終了を取り消す</button>
		                                        </div>
		                                    </td>
		                                </tr>
		                            </tbody>
		                        </table>
		                        @endforeach
		                    </div> <!-- end .boxpdbg mgt-20 -->
                	</div><!-- end col-sm-12 -->

					<div class="col-sm-12">
						
							<table class="table table-bordered mgbt-0">
								<tbody>
									<tr>
										<td class="paddingnone">
											<div class="showmesscontent" id="table-msg">
												<table class="full-width">
												    <tbody id="msg_table">
												    	@php $userMsgCount = 0 @endphp
												    	@if(count($messageList))
												    	@foreach($messageList as $message)
												    		@if($message->from_id == session('user_id')) @php $userMsgCount += 1 @endphp @endif
												        <tr style="">
												            <td>
												                <div class="row">
												                    <div class="col-sm-4">
												                        <hr>
												                    </div>
												                    <h5 class="text-center col-sm-4">
												                        <b>{{ date_string($message->update_date) }}</b>
												                    </h5>
												                    <div class="col-sm-4">
												                        <hr>
												                    </div>
												                </div>
												                <h5>@if($message->from_id==session('user_id')){{$user->displayname}}@else {{$message->displayname}}@endif :</h5>
												                <p>{{$message->message}}</p>
												                @if($message->file)
												                	@foreach(json_decode($message->file) as $file)
													                <div class="col-sm-12">
							                                            <span>&bull;</span><a style="margin-top:8px;cursor:pointer;" target="_blank" href="{{URL::route('agency.jobs.matching.download-file', [$file[1], $file[0]] )}}">{{$file[0]}}</a>
							                                        </div>
							                                       @endforeach
							                                    @endif
												            </td>
												        </tr>
												        @endforeach
												        @endif
												        
												    </tbody>
												</table><!-- end table -->
											</div><!-- end .showmesscontent -->
										</td>
									</tr>
									<tr>
										<td>
											<div class="row">
							                    <div class="col-sm-4">
							                        <hr>
							                    </div>
							                    <h5 class="text-center col-sm-4">
							                        <b>{{date_string(date('Y-m-d'))}}</b>
							                    </h5>
							                    <div class="col-sm-4">
							                        <hr>
							                    </div>
							                </div>
							                <input type="hidden" id="total_user_msg" value="{{$userMsgCount}}">
							                {{Form::open(['method'=>'POST', 'files'=>true, 'id'=>'sendmsg-form'])}}
							                <input type="hidden" name="hire_id" value="{{$hire_id}}">
							                <div class="subjectmes">
							                	<label class="control-label">
	                                                <img src="{{URL::to('assets/common/images/messagesend.png')}}">
	                                            </label>
	                                            <b>{{$hire->first()->user_name}}</b>
	                                            <div class="pull-right">
	                                            	<label for="files"> <span for="files" class="glyphicon glyphicon-paperclip"></span></label>
	                                            	<input class="sr-only" type="file" multiple="multiple" name="file[]" id="files">
	                                            </div>
	                                            <div class="pull-right" id="file-select-list">
	                                            </div>
							                </div>
	                                        <textarea name="message" id = "submit_msg" class="form-control messtextinput" rows="6" required="required"></textarea>
	                                        {{Form::close()}}
										</td>
									</tr>
								</tbody>
							</table><!-- end table -->
							<!-- <ul class="nav nav-tabs tablinksub marginnone bordernone">
							    <li class="active">
							        <a href="#">添付ファイル</a>
							    </li>
							</ul>
							<table class="table table-bordered">
								<tbody>
									<tr>
										<td>
											<input type="file" name="file">
										</td>
									</tr>
									<tr>
										<td>
											<button class="shadowbuttondanger btn btn-danger">削除する</button>
										</td>
									</tr>
								</tbody>
							</table> -->
							<div class="text-center mgt-30 mgbt-50">
								
								<button id="submit_btn_msg" class="shadowbuttonsuccess btn btn-success">送信する</button>
							</div>
					</div><!-- end .col-sm-9 -->
				</div> <!-- end .row -->
			</div> <!-- end .mainpage -->
		</div>
	</div>
</div>

@endsection

@section('script')
	<script>
		var base_url = '{{URL::to('/')}}';
		var totalMsg = {{$messageList->count()}};
		var user_displayname = '{{$user->displayname}}';
		$(document).ready(function() {
			$('#table-msg').scrollTop($('#table-msg table').height());
			
		});
		$('#files').change(function(event) {
			var fileInput = document.getElementById('files');   
			html = '';
			for(i = 0; i < fileInput.files.length; i++)
			{
				html += '<span class="file_select_name">' + fileInput.files[i].name + '</span>';
			}
			var filename = fileInput.files[0].name;
			$('#file-select-list').html(html);
		});
		$('#submit_btn_msg').click(function(event) {
			$(this).prop('disabled', true);
			if( $('#submit_msg').val().length < 15)
			{
				alert('メッセージを入力してください');
				$('#submit_btn_msg').prop('disabled', false);
				return false;
			}
			var form = $('#sendmsg-form');
    		var formdata = new FormData(form[0]);
			$.ajax({
				url: base_url + '/agency/mypage/jobs/matching-case/message-ajax',
				data: formdata,
				type: 'POST',
				processData: false,
    			contentType: false,
				success: function(json) {console.log(json);
					if(json.success) {
						$('#submit_msg').val('');
						$('#files').val('');
						$('#file-select-list').html('');
						html = '<tr style=""><td><div class="row"><div class="col-sm-4"><hr></div>'+
												                    '<h5 class="text-center col-sm-4">'+
												                        '<b>'+json.message.update_date+'</b>'+
												                    '</h5>'+
												                    '<div class="col-sm-4">'+
												                        '<hr>'+
												                    '</div>'+
												                '</div>'+
												                '<h5>'+user_displayname+' :</h5>'+
												                '<p>'+json.message.message+'</p>';
							for(i=0; i < json.message.files.length;i++) {
								html += '<div class="col-sm-12">'+
								    '<span>&bull;</span><a style="margin-top:8px;cursor:pointer;" target="_blank" href="'+json.message.files[i][0]+'">'+json.message.files[i][1]+'</a></div>';
							}
								html += '</td></tr>';

						$('#msg_table').append(html);
					}
					$('#submit_btn_msg').prop('disabled', false);
					$('#table-msg').scrollTop($('#table-msg table').height());
				},
				error: function() {
					$('#submit_btn_msg').prop('disabled', false);
				}
			})
		});
	</script>

@endsection