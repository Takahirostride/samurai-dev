@extends('layouts.home')
@section('style')
	<link rel="stylesheet" href="/assets/home/css/seminarinfo.css">
@endsection
@section('content')
<div class="mainpage">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
			@includeIf('partials.breadcrumb', ['title' => '説明会'])
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">SAMURAI　助成金・補助金サポート</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<img src="/assets/photo/comingsoon.png" alt="" style="width: 100%; margin-bottom: 10px;">
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
	<script src="/assets/home/js/seminarinfo.js"></script>
@endsection