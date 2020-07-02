@extends('layouts.home')
@section('style')
	<link rel="stylesheet" href="/assets/home/css/companyabout.css">
@endsection
@section('content')
<div class="mainpage">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				@includeIf('partials.breadcrumb', ['title' => 'ページが表示できません'])
				<h1 class="page-title">ページが表示できません</h1>
				<div class="clearfix"></div>
				<h4>ページが表示できません</h4>
					
<h4>このページは3秒後にSAMURAIトップページに移動します</h4>

<h4>※切替わらない場合は、<a href="{{URL::to('/')}}">ここをクリックしてください。</a></h4>
			</div> <!-- .col-sm-12 -->
		</div><!-- .row -->
	</div> <!-- end .container -->
</div> <!-- end .mainpage -->
<div class="clearfix"></div>

@endsection

@section('script')
<script>
	setTimeout(function() {window.location.href='/';}, 3000);
</script>
@endsection
