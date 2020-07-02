@extends('layouts.home')
@section('content')
<div class="mainpage">
	<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<h3 class="index-box-title">
						お知らせ
					</h3>
					<div class="row">
						<div class="col-sm-12">
							<div class="voice-detail">
								<h3 class="voicetitle">{{$notify->title}}</h3>
								<div>{!! $notify->content !!}</div>
							</div>
							
						</div>
					</div>
				</div>
			</div><!-- end .row -->
		</div> <!-- end .container -->
</div> <!-- end .mainpage -->
<div class="clearfix" style="margin-bottom: 50px;"></div>
@endsection