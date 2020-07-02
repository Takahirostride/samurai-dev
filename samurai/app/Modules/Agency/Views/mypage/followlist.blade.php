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
						    <li class="active">
						        <a href="{{URL::route('agency.followlist')}}">提案を検討</a>
						    </li>
						    <li>
						        <a href="{{URL::route('agency.followlist.interest')}}">興味あり</a>
						    </li>
						    <li class="mgr-15">
						        <a href="{{URL::route('agency.followlist.hide')}}">非表示</a>
						    </li>
						    <li>
						        <a href="{{URL::route('agency.followlist.follow')}}">フォロー</a>
						    </li>
						    <li>
						        <a href="{{URL::route('agency.followlist.followers')}}">フォロワー</a>
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
									@if(getifmosaicsubsidy($value['acquire_budget'],$payroll) == 0)
									<div class="row" style="margin-left: 15px;background-image: url(./resources/img/mosaic.png);height:200px;background-size: contain;background-repeat: no-repeat;">
                                        <div class="row" style="margin-top: 5px;margin-bottom: 25px;">
                                            <div class="col-sm-12">
                                            	@if($value['acquire_budget_display'] != "" && $value['acquire_budget_display'] != "0")
                                                <div class="btn-cost">
                                                    <label class="label-cost">{{$value['acquire_budget_display']}}</label>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if(getifmosaicsubsidy($value['acquire_budget'],$payroll) == 1)
									<div class="row">
										<div class="subsidy-list-col1">
											<div class="index-boxcol2-sub-ct">
												<div class="middle-boxcol2">
													<ul>
														
														@for ($k = 0 ; $k < count($value['tags']); $k++)
														<li><span class="tag-cost4">{{$value['tags'][$k]}}</span></li>
														@endfor
													</ul>
												</div> <!-- end .middle-boxcol2 -->
												<div class="create-link-box">
													
													<div class="left-boxcol2">
														<a href="{{URL::route('agency.bselect',$value['id'])}}/?searchtype=0">
														<img src="{{URL::to('/')}}/{{$value['image_id']}}" alt="">
														</a>
													</div>

													<div class="right-boxcol2">

														<p>
															<a href="{{URL::route('agency.bselect',$value['id'])}}/?searchtype=0" class="boxcol2-a-2"><span class="sidy-tbig">{{str_limit($value['name'], $limit = 24, $end = '...')}}</span><br>
															<strong>登録期関:</strong>{{str_limit($value['register_insti_detail'], $limit = 18, $end = '...')}}/   <strong>募集時期:</strong>{{str_limit($value['subscript_duration'], $limit = 40, $end = '...')}}</a>
															<span>{{str_limit($value['subscript_duration'], $limit = 124, $end = '...')}}</span>
														</p>
													</div>
													
												</div> <!-- end .create-link-box -->
												
												<div class="middle-boxcol2">
													<ul>
														<li>
														{!! Button::getFavourButtons($value['id']) !!}
														</li>
													</ul>
													@if($value['acquire_budget_display'] != "" && $value['acquire_budget_display'] != "0")
													<p class="jprice">{{ $value['acquire_budget_display']}}</p>
													@endif
												</div> <!-- end .middle-boxcol2 -->
											</div> <!-- end item index-boxcol2 -->
										</div>	<!-- end col-sm-8 -->
										 @if(getifmosaicsubsidy($value['acquire_budget'],$payroll) == 1)
										<div class="subsidy-list-col2">
											@if($value['count_general'] > 0)
											<div class="subsidylist-item-av div-style-grey">
												<img src="{{URL::to('/')}}/{{$value['paid_user']->image}}" alt="">
												<div class="itemav-info">
													<p>実績：{{$value['paid_user']->result}}件</p>
													<p>評価：なし</p>
													<div class="star-rating">
														{!! Button::getRating($value['paid_user']->evaluate) !!}
												</div> <!-- end .itemav-info -->
												{!! Button::getFollowButtons($value['id']) !!}
												</div>
											</div>
											@endif
											@if($value['count_general'] == 0)
											<div style="margin-bottom:13px;margin-top:0px;height:120px;">
                                            </div>
                                            @endif
                                            @if($value['seller_exist_flag'] == 'success')
                                            <div class="div-style-grey" style="margin-bottom:0;margin-top: 2px;" >
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div style="width:200px;height:105px;" class="imagecenter" >
                                                            <img src="{{URL::to('/')}}/{{$value['seller']->image_url}}"
                                                            style="max-width:200px;max-height:105px;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
										</div><!-- end col-sm-3 -->
										@endif
										@if(getifmosaicsubsidy($value['acquire_budget'],$payroll) == 1)
										<div class="subsidy-list-col3">
											<p>対応可能士業</p>
											<a class="imagecenter" href="{{URL::route('agency.bselect',$value['id'])}}/?searchtype=0">
                                                <img src="{{URL::to('/')}}/assets/common/images/avatar.png" style="max-width:50px;max-height:70px;">
                                            </a>
                                            <a>{{$value['count_general']}}人</a>
											@if($value['seller_exist_flag']=='success')
											<p>申請希望企業</p>
											<a style="width:70px;height:70px;" class="imagecenter" href="/lpage/adversellers/?seller_id=&policy_id=" >
                                                <img src="{{URL::to('/')}}/assets/common/images/clientgrey.png" style="max-width:70px;max-height:70px;">
                                            </a>
                                             <a>{{$value['seller_count']}}社</a>
											@endif
										</div><!-- end col-sm-1 -->
										@endif
									</div> <!-- end .row -->
									@endif
								</div> <!-- end .sidylist-item -->
								@endforeach
								@endif
								<div class="clearfix"></div>
								<div class="text-center">
									{!! $policy_data->links() !!}
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
			var url = 'followlist?order='+option+'&per_page='+num_page;
                window.location=url;     
		}
	</script>
@endsection