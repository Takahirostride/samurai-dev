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
					<li class="active">お気に入り</li>
				</ol>	
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">お気に入り</h1>
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
				 <div class="col-sm-12"> 
					<div class="row">
						
						<div class="col-sm-12">
							<div class="dpolicy-item-list">
								@foreach ($checkList as $key => $item)
									{!! Button::showPolicyList($item->policy, 'agency.bselect') !!}
								@endforeach
							</div>
							
						</div> <!-- end .col-sm-12 -->

					</div> <!-- end .row -->
					<div class="text-center">
						{{$checkList->links()}}
					</div>
				</div> <!-- end .col-sm-12 -->
			</div> <!-- end .mainpage -->
		</div>
	</div>
</div>

@endsection

@section('script')
	<script>
		var base_url = '{{URL::to('/')}}';
		
	</script>

@endsection