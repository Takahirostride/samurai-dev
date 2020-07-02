@extends('layouts.home')
@section('content')
<div class="mainpage">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				@includeIf('partials.breadcrumb', ['title' => '事業者検索'])
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">事業者検索</h1>
				<p class="page-description">この施策を必要としている事業者の検索が可能です。是非申請代行のオファーを出しましょう！</p>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="search-value-change">
					<span class="page-per-page">{{count($result)}}件/ {{$result->total()}}件</span>
					<div class="float-right">
						<form action="" method="POST" class="form-inline">
							<div class="form-group">
								<label for="">並び替え: </label>
								{!!Form::select('order-by', ['0'=>'新着順', '1'=>'取得金額が高い順', '2'=>'取得金額が低い順'], request()->order, ['class' => 'form-control order-by']) !!}
							</div>
							<div class="form-group">
								<label for="">表示件数: </label>
								{!!Form::select('per-page', config('combobox.per_page'), request()->per_page, ['class' => 'form-control per-page']) !!}
							</div>
						</form>
					</div> <!-- end float-right -->
				</div> <!-- end .search-value-change -->
			</div> <!-- end .col-sm-12 -->
		</div> <!-- end .row -->
		<div class="row">
			<div class="col-sm-2 sidebar-left">
				<h3 class="mpage-title">リスト一覧</h3>
				<p><a href="{{route('agency.dfollowlist')}}" class="btn btn-default sidebar-btn btn-grad">
						<strong>フォロー</strong>
					</a></p>
				
			</div> <!-- end .sidebar-left -->
			<div class="col-sm-10 mainpage">
				{{ Form::open(['url' => route('agency.dmatchingpolicy'), 'method' => 'GET', 'id'=>'formID', 'enctype'=>'multipart/form-data']) }}
				<div class="row subsidy-list">
					<div class="col-sm-12">	
						<div class="subsidy-list-item custompaddingflow">
							<button style="width:170px;" id="checksubmit" class="btn btn-success btn-style-shadow-green" type="vubmit" >まとめて提案をする</button>
						</div>
						@if($result)
								@foreach ($result as $key => $value)
								<div class="subsidy-list-item custompaddingflow">
									<div class="row">
										<div class="col-sm-8">
											<div class="row">
												<div class="col-sm-3">
													<label class="mgt-30 pull-left"><input type="checkbox" class="userid" name="userids[]" value="{{$value->id}}" name=""></label>
													<div class="avatar-100">
														<img class="img-thumbnail" src="{{URL::to('/')}}/{{$value->image}}" alt="">
													</div>
												</div>
												<div class="col-sm-9">
													<h3 class="text-primary mgt-0"><b>{{$value->displayname}}</b></h3>
													<div class="itemav-info-foll">
														<table class="follow-info-rating">
															<tbody>
																<tr>
																	<th>評価:</th>
																	<td>
																		<div class="star-rating">
																			{!! Button::getRating($value->evaluate) !!}
																		</div> <!-- end .itemav-info -->
																	</td>
																</tr>
																<tr>
																	<th>実績:</th>
																	<td>{{$value->result}} 件</td>
																</tr>
															</tbody>
														</table>
													</div>
												</div>
											</div>
											<div class="row">	
												<div class="col-sm-12">
													<div class="btn_follow mgl-20">
														{!! Button::getFollowButtons($value->id) !!}
													</div>
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
												                <span>{{$value->final_request_date}}</span>
												            </td>
												        </tr>
												        <tr>
												            <td class="td-cost-title">提案回数 :</td>
												            <td class="td-cost-left">
												                <span>{{$value->final_request_content}}</span>回</td>
												        </tr>
												        <tr>
												            <td class="td-cost-title">募集状況 :</td>
												            <td class="td-cost-left">
												                <span>{{$value->is_collect_flag}}</span>
												            </td>
												        </tr>
												    </tbody>
											    </table>
											    <a href="{{URL::route('agency.dmatchingpolicy')}}?userids={{$value->id}}" class="shadowbuttonsuccess btn btn-success mgt-20">依頼する施策を選ぶ</a>
											</div>
										</div>
									</div> <!-- end .row -->
								</div> <!-- end .sidylist-item -->
								@endforeach
								@endif
					</div> <!-- end .div.col-sm-12 -->
				</div> <!-- end .row -->
				{{ Form::close() }}
			</div> <!-- end .mainpage -->
		</div> <!-- end .row -->
	</div> <!-- end .container -->
</div> <!-- end .mainpage -->
<div class="clearfix"></div>
@endsection
@section('script')
	<script>
		$(document).on('change', '.userid', function(){
			if($(this).is(':checked')) {
				$(this).closest('.subsidy-list-item').addClass('active');
			}else{
				$(this).closest('.subsidy-list-item').removeClass('active');
			}
			
		});
		$(document).on('click', '#checksubmit', function(){
			if(!$('input.userid:checked').length) {
				alert('一つ以上の事業者を選択してください。');
				return false;
			}
		});


	</script>
@endsection