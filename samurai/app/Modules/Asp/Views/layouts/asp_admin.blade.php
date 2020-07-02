<!doctype html>
<html lang="ja">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>SAMURAI</title>
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="{{asset('assets/common/css/font-awesome-5.3.1/css/all.min.css')}}">
		<link rel="stylesheet" href="{{asset('assets/common/plugins/bootstrap/css/bootstrap.min.css')}}">
		<link rel="stylesheet" href="{{asset('assets/common/plugins/bootstrap-toggle/css/bootstrap-toggle.min.css')}}">
		<link rel="stylesheet" href="{{asset('assets/asp/css/asp.css')}}">
		{{HTML::style('assets/asp/css/asp-responsive.css')}}
		<link rel="stylesheet" href="{{asset('assets/common/css/animate.css')}}">
		<link rel="stylesheet" href="{{asset('assets/common/plugins/bar-rating/dist/themes/fontawesome-stars.css')}}">
		@stack('css')
	</head>
	<body>
		<header id="header">
			<div class="container">
				@include('Asp::layouts.partial_file.header')
			</div> <!-- end .container -->				
		</header><!-- end header -->
		<main id="main" class="pdtb70">				
			@include('Asp::layouts.partials.breadcrumb')
			@include('Asp::layouts.partials.notify')
			@yield('content')
		</main>	
        <script src="{{asset('assets/common/js/jquery-3.3.1.min.js')}}"></script>
        <script src="{{asset('assets/common/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('assets/common/plugins/datepicker/js/bootstrap-datepicker.min.js')}}"></script>
        <script src="{{asset('assets/common/plugins/bootstrap-toggle/js/bootstrap-toggle.min.js')}}"></script>
        <script src="{{asset('assets/asp/js/asp.js')}}"></script>
        @stack('script')
    </body>
</html>			
		