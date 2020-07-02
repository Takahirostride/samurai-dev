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
						<li class="active">
							<a href="javascript:void()">自動検索</a>
						</li>
						<li>
							<a href="{{ route('client.fsearch') }}">手動検索</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="col-sm-12">	
				<div class="category_list">
					<ul class="nav nav-tabs nav-cat">
						<li class=" @if(request()->cate == 'all' ) active @endif ">
							<a href="{{ $request->url().'?'.http_build_query(['cate'=>'all']) }}">すべて</a>
						</li>
						<li class="@if(request()->cate == '' ) active @endif ">
							<a href="{{ $request->url() }}">おすすめ</a>
						</li>
					    @foreach ($categories as $c_id=>$cate)
					    	<li class="{{ ($request->query('cate',null)==$c_id) ? 'active':'' }}">
					    		<a href="{{ $request->url().'?'.http_build_query(['cate'=>$c_id]) }}">{{ $cate }}</a>
					    	</li>
					    @endforeach
					    
					</ul>
				</div>						
				<div class="row subsidy-list">					
					<div class="col-sm-12">
						@if(!empty($results))
							@include('Client::Fpage.subsidy_order')
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