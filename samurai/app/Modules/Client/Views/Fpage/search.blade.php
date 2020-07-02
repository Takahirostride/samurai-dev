@extends('layouts.home')
@section('style')
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/client/css/f_search.css?v='.time()) }}">
@endsection
@section('content')
@php
	$request = request();
@endphp
<div class="mainpage client-page">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				@includeIf('partials.breadcrumb', ['title' => '手動マッチング'])
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="navi-content">
					<ul class="nav">
						<li>
							<a href="{{route('client.Fsubsidylist')}}">自動検索</a>
						</li>
						<li class="active">
							<a href="javascript:void()">手動検索</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="col-sm-12">
				<div class="row subsidy-list">
					<div class="col-sm-12">
					{{ Form::open(['url' => route('client.fsearch'), 'method' => 'GET', 'enctype'=>'multipart/form-data']) }}
						<table class="table table-bordered form-table">
							<!-- <tr>
								<th>支援内容</th>
								<td>
									@php
										$contents = $request->query('contents',[]);
									@endphp
									<div class="row">
										<div class="col-sm-4">
											<div class="checkbox"><label><input type="checkbox" name="contents[]" value="1" {{ in_array(1,$contents)?'checked':'' }}>補助金・助成金</label></div>
										</div>
										<div class="col-sm-4">
											<div class="checkbox"><label><input type="checkbox" name="contents[]" value="2" {{ in_array(2,$contents)?'checked':'' }}>金融・税制</label></div>
										</div>
										<div class="col-sm-4">
											<div class="checkbox"><label><input type="checkbox" name="contents[]" value="3" {{ in_array(3,$contents)?'checked':'' }}>その他</label></div>
										</div>
									</div>
								</td>
							</tr> -->
							<tr>
								<th>カテゴリー</th>
								<td>
									@include('Client::Fpage.form.categories',compact('categorys'))
								</td>
							</tr>
							<tr>
								<th>対象地域</th>
								<td>
									@php
										$sl_region = $request->query('region',0);
										$sl_cities = $request->query('cities',[]);
									@endphp
									<select class="form-control max-w5 selectregion" name="region" data-cities="{{ implode(',',$sl_cities) }}">
										<option value="" disabled selected hidden>都道府県を選択してください</option>
										@if($regions) 
										@foreach($regions as $k_reg=>$region)
											<option value="{{$k_reg}}" {{ $k_reg==$sl_region ? 'selected':'' }}>{{$region}}</option>
										@endforeach
										@endif
									</select>

									<div class="row mgt-20" id="cities_checkbox">
										
									</div>
									<div class="pro-checkbox">
										<div class="checkbox"><label><input type="checkbox" class="" name="location[]" value="0"  {{ in_array(0,$request->query('location',[]))?'checked':'' }}>全国を対象にした施策を含む</label></div>
										<div class="checkbox"><label><input type="checkbox" class="" name="location[]" value="1"  {{ in_array(1,$request->query('location',[]))?'checked':'' }}>誘致関連施策を含む</label></div>

									</div>
								</td>
							</tr>
							<tr>
								<th>キーワード</th>
								<td>
									<input type="text" name="keyword" class="form-control" value="{{ $request->query('keyword') }}">
									<p>※ものづくり、補助金</p>
								</td>
							</tr>
							<tr>
								<th>対象者</th>
								<td>
									@php
										$sl_tags = $request->query('tags',[]);
										$tags=['中小企業','小規模事業者','その他']
									@endphp
									@foreach ($tags as $tag)
										<div class="col-sm-4">
											<div class="checkbox"><label><input type="checkbox" class="address_ministry" name="tags[]" value="{{ $tag }}"  {{ in_array($tag,$sl_tags)?'checked':'' }}>{{$tag}}</label></div>
										</div>									
									@endforeach
									<div class="text-right mgbt-20">
										<button type="button" data-check="address_ministry" class="check_all btn btn-default btn-lg mgr-20">全選択</button>
										<button type="button" data-check="address_ministry" class="un_check_all btn btn-default btn-lg mgr-20">全解除</button>
									</div>
								</td>
							</tr>
							<tr>
								<th>業種</th>
								<td>
									@if(@$trades)
									@php
										$sl_trades = $request->query('trades',[]);
									@endphp
									@foreach($trades as $k_trade => $trade)
									<div class="col-sm-4">
										<div class="checkbox"><label><input type="checkbox" class="trades" name="trades[]" value="{{$k_trade}}" id="check_list_bigcat-1" {{ in_array($k_trade,$sl_trades)?'checked':'' }}>{{$trade}}</label></div>
									</div>
									@endforeach
									@endif
									<div class="text-right mgbt-20">
										<button type="button" data-check="trades" class="check_all btn btn-default btn-lg mgr-20">全選択</button>
										<button type="button" data-check="trades" class="un_check_all btn btn-default btn-lg mgr-20">全解除</button>
									</div>
								</td>
							</tr>
						</table>
						<div class="text-center bsearch-btn-s">
							<button id="checksearch" name="searchtype" value="1" type="submit" class="btn btn-success btn-style-shadow-green">検索</button>
						</div>
					{{ Form::close() }}
					</div> <!-- end .div.col-sm-12 -->
				</div> <!-- end .row -->
			</div> <!-- end .mainpage -->
			<div class="col-sm-12">
				<div class="row subsidy-list">
					<div class="col-sm-12">
						@if(!empty($results))
						<table class="table table-bordered mgbt-0">
							<thead>
								<tr>
									<th>
										<span class="page-per-page">検索結果: {{$results->total()}}件</span>
										<div class="float-right">
											<form action="" method="POST" class="form-inline">
												<div class="form-group">
													<label for="">並び替え: </label>
													{!!Form::select('order-by', config('combobox.order_by'), request()->order, ['class' => 'form-control order-by']) !!}
												</div>
												<div class="form-group">
													<label for="">表示件数: </label>
													{!!Form::select('per-page', config('combobox.per_page'), request()->per_page, ['class' => 'form-control per-page']) !!}
												</div>
											</form>
										</div> <!-- end float-right -->
									</th>
								</tr>
							</thead>
						</table>
						@endif						
						@foreach($results as $k => $val)
							@include('Client::Fpage.content_policy',['val'=>$val,'val_index'=>$loop->index])
						@endforeach
						<div class="clearfix"></div>
						<div class="text-center">
							@if($results)
							{{ $results->appends(request()->query())->links() }}
							@endif
						</div>
					</div> <!-- end .div.col-sm-12 -->

				</div> <!-- end .row -->
			</div> <!-- end .mainpage -->
		</div> <!-- end .row -->
	</div> <!-- end .container -->
</div> <!-- end .mainpage -->
<div class="clearfix"></div>
@endsection
@section('script')
	@include('Client::Fpage.search_script')
@endsection