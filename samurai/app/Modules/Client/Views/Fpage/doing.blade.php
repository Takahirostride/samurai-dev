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
				@includeIf('partials.breadcrumb', ['title' => '現在進んでいる案件一覧'])
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">	
				<div class="row subsidy-list">					
					<div class="col-sm-12">
						@if(!empty($results))
							@include('Client::Fpage.subsidy_order')
						@endif						
						@foreach($results as $k => $v_val)
							@php
								$data = (class_basename($v_val)=='Hire') ? $v_val->policy : $v_val;
							@endphp						
							@include('Client::Fpage.detail_policy',['val'=>$data])
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