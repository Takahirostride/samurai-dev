<!doctype html>
<html lang="ja">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<title>SAMURAI</title>
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="{{asset('assets/common/css/font-awesome-5.3.1/css/all.min.css')}}">
		<link rel="stylesheet" href="{{asset('assets/common/plugins/bootstrap/css/bootstrap.min.css')}}">
		<link rel="stylesheet" href="{{asset('assets/common/plugins/bootstrap-toggle/css/bootstrap-toggle.min.css')}}">
		{{HTML::style('assets/common/css/animate.css')}}
		{{HTML::style('assets/common/plugins/bar-rating/dist/themes/fontawesome-stars.css')}}
		{{ HTML::style('assets/common/plugins/bar-rating/dist/themes/fontawesome-stars-o.css') }}
    	{{ HTML::style('assets/common/plugins/bar-rating/yellow.css') }}
		{{HTML::style('assets/common/css/reset.css')}}
		{{HTML::style('assets/common/css/common.css')}}
		{{HTML::style('assets/common/css/style.css')}}		
		{{HTML::style('assets/asp/css/asp.css')}}
		@stack('style')		
	</head>
	<body class="asp-noheader">
		<main id="main">
		@include('Asp::layouts.asp_partials.notify')	
		@yield('content')	
		</main>
        <script src="{{asset('assets/common/js/jquery-3.3.1.min.js')}}"></script>
        <script src="{{asset('assets/common/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('assets/common/plugins/datepicker/js/bootstrap-datepicker.min.js')}}"></script>
        <script src="{{asset('assets/common/plugins/bootstrap-toggle/js/bootstrap-toggle.min.js')}}"></script>
        {{HTML::script('assets/common/plugins/bar-rating/dist/jquery.barrating.min.js')}}
        {{HTML::script('assets/common/js/luu.js')}}
        {{HTML::script('assets/common/js/common.js')}}
        <script src="{{asset('assets/asp/js/asp.js')}}"></script>
        @stack('script')
    </body>
</html>			
		