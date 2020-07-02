@extends('layouts.home')

@section('content')
<div class="mainpage clientprofile-1">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<ol class="breadcrumb">
					<li><a class="bg-color" href="#">TOPページ</a></li>
					<li class="active">メッセージ</li>
				</ol>	
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">メッセージ</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-2 sidebar-left">
				@if($user->image)
            		@php ($profile_image = $user->image)
            	@else
            		@php ($profile_image = 'assets/common/images/img-user1.png')
            	@endif
				@include('Client::include.sidebar-left')
			</div>
			<div class="col-sm-10 mainpage">
				<div class="row">
					<div class="col-sm-12">
						<ul class="nav nav-tabs tablinksub bordernone">
						    <li >
						        <a href="{{URL::route('client.followlist')}}">提案を検討</a>
						    </li>
						    <li>
						        <a href="{{URL::route('client.followlist.interest')}}">興味あり</a>
						    </li>
						    <li class="mgr-15">
						        <a href="{{URL::route('client.followlist.hide')}}">非表示</a>
						    </li>
						    <li class="active">
						        <a href="{{URL::route('client.followlist.follow')}}">フォロー</a>
						    </li>
						    <li>
						        <a href="{{URL::route('client.followlist.followers')}}">フォロワー</a>
						    </li>
						</ul><!-- end .tablinksub -->
						<div class="search-value-change">
							<div class="float-right">
								<form action="" method="POST" class="form-inline">
									<div class="form-group">
										<label for="">並び替え: </label>
										<select name="option" class="form-control" id="option">
											<option value="0" @if($order == 0) selected="" @endif>新着順</option>
											<option value="1" @if($order == 1) selected="" @endif>取得金額が高い順</option>
											<option value="2" @if($order == 2) selected="" @endif>取得金額が低い順</option>
											<option value="3" @if($order == 3) selected="" @endif>マッチングが多い順（対応可能士業者数）</option>
										</select>
									</div>
									<div class="form-group">
										<label for="">表示件数: </label>
										<select name="row" class="form-control" id="row">
											<option value="10" @if($per_page == 10) selected="" @endif>10</option>
											<option value="20" @if($per_page == 20) selected="" @endif>20</option>
											<option value="50" @if($per_page == 50) selected="" @endif>50</option>
										</select>
									</div>
								</form>
							</div> <!-- end float-right -->
						</div> <!-- end .search-value-change -->
						<div class="row subsidy-list">
							<div class="col-sm-12">
								@if($result)
								@foreach ($result as $key => $value)
								<div class="subsidy-list-item">
									<div class="row">
										<div class="col-sm-9">
											<div class="index-boxcol2-sub-ct">
												<div class="create-link-box">
													
													<div class="left-boxcol2">
														<a href="{{URL::route('client.fselect',$value->id)}}/?searchtype=0">
														<img src="{{URL::to('/')}}/{{$value->image_id}}" alt="">
														</a>
													</div>

													<div class="right-boxcol2">

														<p>
															<a href="{{URL::route('client.fselect',$value->id)}}/?searchtype=0" class="boxcol2-a-2"><span class="sidy-tbig">{{str_limit($value->name, $limit = 24, $end = '...')}}</span><br>
															<strong>登録期関:</strong>{{str_limit($value->register_insti_detail, $limit = 18, $end = '...')}}/   <strong>募集時期:</strong>{{str_limit($value->subscript_duration, $limit = 40, $end = '...')}}</a>
															<span>{{str_limit($value->subscript_duration, $limit = 124, $end = '...')}}</span>
														</p>
													</div>
													
												</div> <!-- end .create-link-box -->
												
												<div class="middle-boxcol2">
													<ul>
														<li>
														{!! Button::getFavourButtons($value->id) !!}
														</li>
													</ul>
													@if($value->acquire_budget_display != "" && $value->acquire_budget_display != "0")
													<p class="jprice">{{ $value->acquire_budget_display}}</p>
													@endif
												</div> <!-- end .middle-boxcol2 -->
											</div> <!-- end item index-boxcol2 -->
										</div>	<!-- end col-sm-8 -->
										<div class="col-sm-3">
				                        <div class="div-style-yellow3 text-center" style="float:right;padding: 12px 18px;width:250px;margin-top: 20px;">
				                            <table style="width:100%;">
				                                <tr>
				                                    <td class="td-cost-title">書類代行 : </td>
				                                    <td class="td-cost"><span></span>{{ $value->document_business_price}}円</td>
				                                </tr>
				                                <tr>
				                                    <td class="td-cost-title">成功報酬</td>
				                                    <td class="td-cost"><span>{{ $value->request_business_price}}</span>%</td>
				                                </tr>
				                                <tr>
				                                    <td class="td-cost-title">着手金 : </td>
				                                    <td class="td-cost"><span>{{ $value->deposit_money}}</span>円</td>
				                                </tr>
				                                <tr>
				                                    <td class="td-cost-title">その他 : </td>
				                                    <td class="td-cost"><span>{{ $value->other_money}}</span>円</td>
				                                </tr>
				                            </table>
				                            <a class="btn btn-success btn-style-shadow-green" style="width:200px; margin-top: 20px;" href="{{URL::to('/')}}/client/Fask/{{$value->id}}/{{$user_id}}">提案する</a>
				                        </div>
				                    </div>
									</div> <!-- end .row -->
								</div> <!-- end .sidylist-item -->
								@endforeach
								@endif
								<div class="clearfix"></div>
								<div class="text-center">
									{!! $result->links() !!}
								</div>
							</div> <!-- end .div.col-sm-12 -->
						</div> <!-- end .row -->
					</div><!-- end .col-sm-12 -->
				</div>	<!-- end .row -->
			</div>
		</div>
	</div>
</div>

@endsection
@section('style')
<style type="text/css">
 .td-cost-title{
 	text-align: left;
 }
</style>
@endsection
@section('script')
	<script>
		$('#option').on('change',function(){
			search();
		});
		$('#row').on('change',function(){
			search();
		});
		function search(){
			var option = $('#option').val();
			var num_page = $('#row').val();
			var url = 'choose_the_measures?order='+option+'&per_page='+num_page;
                window.location=url;     
		}
	</script>
@endsection