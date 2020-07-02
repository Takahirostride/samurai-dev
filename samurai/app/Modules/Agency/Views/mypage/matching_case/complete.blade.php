@extends('layouts.home')
@section('style')
	<style type="text/css">

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
					    <div class="col-sm-8">
					    	
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
					{{Form::open(['method'=>'POST', 'name'=>'completeForm'])}}
					<div class="col-sm-12">
						@include('partials.user.notifications')
						@if(@$mData['ioflag'] == 0)
						<h3 class="page-title">完了・キャンセル通知</h3>
						@endif
						<div class="row boxcacular">
							<div class="col-sm-9">
								<h5><b>すべての業務が完了した場合、下記の項目にチェックを入れて、終了報告を行なってください。</b></h5>
								@if(@$mData['ioflag'] == 0)
								<div class="radio">
									<label class="font12">
									    <input type="radio" name="finishtype" @if($mData['result']['accept_flag']!=2) disabled="disabled" @endif id="optionsRadios1" value="1">取得して終了する
									</label>
								</div>
								<div class="radio">
									<label class="font12">
									    <input type="radio" name="finishtype" @if($mData['result']['accept_flag']!=2) disabled="disabled" @endif id="optionsRadios2" value="0">取得できずに終了する
									</label>
								</div>
								<div class="radio">
									<label class="font12">
									    <input type="radio" name="finishtype" @if($mData['result']['accept_flag']!=2) disabled="disabled" @endif id="optionsRadios3" value="1">キャンセル
									</label>
								</div>
								@endif
							</div>
							@if(@$mData['ioflag'] == 0)
							@if($mData['result']['accept_flag'] != 2)
							<div class="col-sm-3">
								<div class="cacular-desc">
									<p class="text-center mgbt-30">
										<span class="boxred">@if($mData['result']['accept_flag']==0) 通知中 @else 承諾済 @endif</span>
									</p>
								</div>
							</div>
							@endif
							@endif
						</div>
					</div><!-- end .col-sm-12 -->	
					<div class="col-sm-12">
						@if(@$mData['ioflag'] == 0 && $mData['result']['accept_flag'] == 2)
						<h3 class="page-title">評価</h3>

						<div class="row boxcacular1">
							
								<div class="col-sm-12">
									<h6>士業の評価を行ってください。<br>
									★をクリックすることで星の数を設定して、士業を評価してください。数字を入力して設定することもできます。<br>
									入力欄には詳細な評価を記入してください。</h6>
								</div>
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
									<textarea name="content" id="message" class="form-control" rows="4"></textarea>
									<div class="checkbox">
					        			<label class="font12"><input type="checkbox" name="no_display" value="1"><strong>今後、この施策を検索結果に表示させない。</strong></label>
					        		</div>
					        		<div class="text-center">
					        			<button type="button" id="submit-btn" onclick="checkForm();" class="shadowbuttonprimary btn btn-primary">終了報告する</button>
					        		</div>
								</div>
							
							<!-- end form -->
						</div>
						@endif
					</div><!-- end .col-sm-12 -->	
					{{Form::close()}}
				</div> <!-- end .row -->
			</div> <!-- end .mainpage -->
		</div>
	</div>
</div>

<div class="modal fade" id="modalConfirm">
	<div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content"> 
            <div class="modal-header">
                <h3>終了報告しますか？</h3>
            </div>                     
          <div class="modal-body">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <button type="button" class="btn btn-success btn-style-shadow-green" onclick="document.completeForm.submit();" data-dismiss="modal">確定する</button>
                    <button type="button" class="btn btn-danger btn-style-shadow-red" data-dismiss="modal" style="margin-left: 15px;">キャンセル</button>        
                </div>
            </div>
          </div>
        </div>
      </div>
</div>

@endsection

@section('script')
	<script>
		var currentEl = $(this);
		$('.datrating1').barrating({
			//index page jubotron
		    theme: 'fontawesome-stars',
		    showSelectedRating: false,
		    onSelect: function(value, text, event) {
			    if (typeof(event) !== 'undefined') {
			      // rating was selected by a user
			      $('#'+currentEl).text(value);
			    } else {
			      
			    }
			  }
		});
		$('.datrating1').change(function(event) {
				var ids = $(this).attr('data-ids');
				currentEl = ids;
			});
		var checkForm = function() {
			if($('input[name="finishtype"]:checked').val() == undefined)
			{
				alert('すべての項目を正確に入力してください。');
				return false;
			}
			if($('#message').val() == '')
			{
				alert('メッセージを入力してください。');
				return false;
			}
			$('#modalConfirm').modal();
		}

	</script>

@endsection