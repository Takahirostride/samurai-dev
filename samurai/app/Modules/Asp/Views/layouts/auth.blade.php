<!doctype html>
<html lang="ja">
	<head>
		<base href="/template-html/asp/">
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="{{asset('assets/common/css/font-awesome-5.3.1/css/all.min.css')}}">
		<link rel="stylesheet" href="{{asset('assets/common/plugins/bootstrap/css/bootstrap.min.css')}}">
		<link rel="stylesheet" href="{{asset('assets/asp/css/asp.css')}}">
		<link rel="stylesheet" href="{{asset('assets/asp/css/asp-responsive.css')}}">
		<title>SAMURAI</title>
		@stack('css')
	</head>
	<body>
		<main id="main">			
			@yield('content')	
        </main>
        <script src="{{ asset('assets/common/js/jquery-3.3.1.min.js')}}"></script>
        <script src="{{ asset('assets/common/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
        <script src="{{ asset('/assets/common/js/jquery.validate.min.js') }}"></script>
        @stack('script')
    </body>
</html>