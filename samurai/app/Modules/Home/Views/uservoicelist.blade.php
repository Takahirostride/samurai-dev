@extends('layouts.home')
@section('style')
	<link rel="stylesheet" href="/assets/home/css/uservoicelist.css">
@endsection
@section('content')
<div class="mainpage">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h3 class="index-box-title">
					ご利用者様の声
					<small>SAMURAIを活用頂いたお客様の声を一部紹介します。</small>
				</h3>
				<div class="row">
					@if($result)
					@foreach($result as $index => $val)
					<div class="col-sm-4">
						<div class="box-item">
							<img src="{{$val->image_url}}" alt="">
							<div class="pd-20">
								@if($val->manage_flag==0)
								<p class="voice-tag bg-color"><strong>ご利用者の声（企業）</strong></p>
								@else
								<p class="voice-tag bg-f88146"><strong>ご利用者の声（士業）</strong></p>
								@endif
								<h5 class="blog-title"><a href="{{route('uservoicelistdetail', ['id'=>$val->id])}}"><strong>{{$val->title}}</strong></a></h5>
								{!! str_limit($val->content, 200) !!}
							</div>
						</div>
					</div>
					@php $num = $index+1 @endphp
					@if($num % 3 == 0)
					</div>
					<div class="row">
					@endif
					@endforeach
					@endif
				</div>
				<div class="text-center">
					{{ $result->appends(request()->query())->links() }}
				</div>
			</div>
		</div><!-- end .row -->
	</div> <!-- end .container -->
</div> <!-- end .mainpage -->
<div class="clearfix"></div>
@endsection
@section('script')
	<script src="/assets/home/js/uservoicelist.js"></script>
@endsection