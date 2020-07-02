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
						<div class="col-sm-12">
							<div class="voice-detail">
								<h3 class="voicetitle">{{$detail->title}}</h3>
								@if($detail->manage_flag==0)
								<p class="voice-tag bg-color"><strong>ご利用者の声（企業）</strong></p>
								@else
								<p class="voice-tag bg-f88146"><strong>ご利用者の声（士業）</strong></p>
								@endif
								<img  class="voice-detail-img" src="{{url($detail->image_url)}}" alt="">
								<div>{!! $detail->content !!}</div>
								<a href="{{route('uservoicelist')}}" type="button" class="readmore btn btn-success btn-lg land-btn">ご利用者の声をもっと見る</a>
							</div>
							
						</div>
					</div>
					<div class="row">
					@if($result)
					@foreach($result as $val)
					<div class="col-sm-4">
						<div class="box-item">
							<img src="{{url($val->image_url)}}" alt="">
							<div class="pd-20">
								@if($val->manage_flag==0)
								<p class="voice-tag bg-color"><strong>ご利用者の声（企業）</strong></p>
								@else
								<p class="voice-tag bg-f88146"><strong>ご利用者の声（士業）</strong></p>
								@endif
								<h5 class="blog-title"><strong>{{$val->title}}</strong></h5>
								{!! str_limit($val->content, 200) !!}
							</div>
						</div>
					</div>
					@endforeach
					@endif
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