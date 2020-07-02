@extends('layouts.home')

@section('content')
<div class="mainpage clientprofile-1">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<ol class="breadcrumb">
					<li><a class="bg-color" href="#">TOPページ</a></li>
					<li class="active">保存リスト</li>
				</ol>	
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">保存リスト</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-2 sidebar-left">
				@if($user->image)
            		@php ($profile_image = $user->image)
            	@else
            		@php ($profile_image = 'assets/common/images/img-user1.png')
            	@endif
				@include('Agency::includes.sidebar-left')
			</div>
			<div class="col-sm-10 mainpage">
				<div class="row">
					<div class="col-sm-12">
						<ul class="nav nav-tabs tablinksub bordernone">
						    <li >
						        <a href="{{URL::route('agency.followlist')}}">提案を検討</a>
						    </li>
						    <li >
						        <a href="{{URL::route('agency.followlist.interest')}}">興味あり</a>
						    </li>
						    <li class="mgr-15">
						        <a href="{{URL::route('agency.followlist.hide')}}">非表示</a>
						    </li>
						    <li class="active">
						        <a href="{{URL::route('agency.followlist.follow')}}">フォロー</a>
						    </li>
						    <li>
						        <a href="{{URL::route('agency.followlist.followers')}}">フォロワー</a>
						    </li>
						</ul><!-- end .tablinksub -->
						
						<div class="row subsidy-list">
							<div class="col-sm-10">
								@if($result)
								@foreach ($result as $key => $value)
								<div class="subsidy-list-item custompadding">
									<div class="row">
										<div class="col-sm-8">
											<div class="row">
												<div class="col-sm-3">
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
													{!! Button::getFollowButtons($value->id) !!}
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
											    <a href="{{URL::route('agency.followlist.choose_the_measures', array('follow_id'=>$value->id))}}" class="shadowbuttonsuccess btn btn-success mgt-20">依頼する施策を選ぶ</a>
											</div>
										</div>
									</div> <!-- end .row -->
								</div> <!-- end .sidylist-item -->
								@endforeach
								@endif
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="text-center">
							{!! $result->links() !!}
						</div>

					</div><!-- end .col-sm-12 -->
				</div>	<!-- end .row -->
			</div>
		</div>
	</div>
</div>
@endsection
