@extends('layouts.home')
@section('style')
	<!-- <link rel="stylesheet" href="/assets/client/css/h_select.css"> -->
@endsection
@section('content')
<div class="mainpage">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
			@includeIf('partials.breadcrumb', ['title' => '士業検索'])
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">士業検索</h1>
				<p class="page-description">御社が興味のある助成金・補助金から対応頂ける方の検索ができます。対応頂ける方を検索して、仕事の依頼をしましょう。</p>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<div class="search-value-change">
					<span class="page-per-page">{{count($result['result'])}}件/ {{$result['total_page']}}件</span>
					<div class="float-right">
						<form action="" method="POST" class="form-inline">
							<div class="form-group">
								<label for="">表示件数: </label>
								{!! Form::select('per-page', config('combobox.per_page'), request()->per_page, ['class' => 'form-control per-page']) !!}
							</div>
						</form>

					</div> <!-- end float-right -->
				</div> <!-- end .search-value-change -->
			</div> <!-- end .col-sm-12 -->
		</div> <!-- end .row -->
		
		<div class="row">
			<div class="col-sm-2 sidebar-left">
				<h3 class="mpage-title">士業リスト一覧</h3>
				<p><a href="/client/Hselect/follow-list?per_page=20&current_page=0" class="btn btn-default sidebar-btn btn-grad active">
					<strong>フォロー</strong>
				</a></p>
			</div> <!-- end .sidebar-left -->

			<div class="col-sm-10 mainpage">
				<div class="row subsidy-list">
					<div class="col-sm-12">
						@foreach($result['result'] as $val) 
						<div class="subsidy-list-item custompadding">
							<div class="row">
								<div class="col-sm-8">
									<div class="row">
										<div class="col-sm-3">
											<div class="avatar-100">
												<img class="img-thumbnail" src="{{ url($val['image']) }}" alt="">
											</div>
										</div>
										<div class="col-sm-9">
											<h3 class="text-primary mgt-0"><b>{{$val['displayname']}}</b></h3>
											<div class="itemav-info-foll">
												<table class="follow-info-rating">
													<tbody>
														<tr>
															<th>評価:</th>
															<td>
																<!-- <div class="star-rating">
																	<select class="datrating" id="example-fontawesome" name="rating" autocomplete="off">
																		<option value="1">1</option>
																		<option value="2">2</option>
																		<option value="3">3</option>
																		<option value="4">4</option>
																		<option value="5">5</option>
																	</select>
																</div> -->
																{!! Button::getRating($val['evaluate']) !!}
															</td>
														</tr>
														<tr>
															<th>実績:</th>
															<td>{{$val['result']}}件</td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
									</div>
									<div class="row">	
										<div class="col-sm-12">
											{!! Button::getFollowButtons($val['id']) !!}
										</div>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="div-style-yellow3">
									    <table class="">
									        <tbody>
										        <tr>
										            <td class="td-cost-title"><b>最終依頼日 :</b></td>
										            <td class="td-cost-left">
										                <span>{{$val['final_request_date']}}</span>
										            </td>
										        </tr>
										        <tr>
										            <td class="td-cost-title">提案回数 :</td>
										            <td class="td-cost-left">
										                <span>{{$val['final_request_content']}}</span>回</td>
										        </tr>
										        <tr>
										            <td class="td-cost-title">募集状況 :</td>
										            <td class="td-cost-left">
										                <span>{{$val['is_collect_flag']}}</span>
										            </td>
										        </tr>
										    </tbody>
									    </table>
									    <a href="/client/Hselect/matching-policy-lists/{{$val['id']}}" class="shadowbuttonsuccess btn btn-success mgt-20">依頼する施策を選ぶ</a>
									</div>
								</div>
							</div> <!-- end .row -->
						</div> <!-- end .sidylist-item -->
						@endforeach
						<div class="clearfix"></div>
						<div class="text-center">
							@if (count($result['result']) > 0) 
							{!! Paginator::show($result['limit'], $result['current_page'], $result['total_page']) !!}
							@endif
						</div>
					</div> <!-- end .div.col-sm-12 -->

				</div> <!-- end .row -->
			</div> <!-- end .mainpage -->
		</div> <!-- end .row -->
	</div> <!-- end .container -->
</div> <!-- end .mainpage -->
<div class="clearfix"></div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="display: none;">
	<div class="modal-dialog modal-lg modal-dialog-centered text-center" role="document">
		<div class="modal-content" style="height: 676.8px;">
			<div class="modal-header text-center">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
				<h5 class="modal-title">マニュアル</h5>
			</div>
			<div class="modal-body">
				<iframe width="100%" height="100%" src="static-page/operationlecture.html" frameborder="0"></iframe>
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
	<!-- <script src="/assets/client/js/h_select.js"></script> -->
@endsection