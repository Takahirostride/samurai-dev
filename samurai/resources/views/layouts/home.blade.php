<!doctype html>
<html lang="ja">
	<head>
        <title>@yield('title', 'SAMURAI: 助成金・補助金自動マッチングシステム')</title>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<!-- Bootstrap CSS -->
		{{HTML::style('assets/common/plugins/bootstrap/css/bootstrap.min.css')}}
		{{HTML::style('assets/common/plugins/datepicker/css/bootstrap-datepicker.min.css')}}
		{{HTML::style('assets/admin/css/jquery-confirm.min.css')}}
		{{HTML::style('assets/common/css/font-awesome-4.7.0/css/font-awesome.min.css')}}
		{{HTML::style('assets/common/css/reset.css')}}
		
		{{HTML::style('assets/common/css/dat.css')}}
		{{HTML::style('assets/common/css/thang.css')}}
		{{HTML::style('assets/common/css/luu.css')}}
		{{HTML::style('assets/common/css/trieu.css')}}

		{{HTML::style('assets/common/css/common.css')}}
		{{HTML::style('assets/common/css/style.css')}}

		{{HTML::style('assets/common/css/animate.css')}}
		{{HTML::style('assets/common/plugins/bar-rating/dist/themes/fontawesome-stars.css')}}
		{{ HTML::style('assets/common/plugins/bar-rating/dist/themes/fontawesome-stars-o.css') }}
    	{{ HTML::style('assets/common/plugins/bar-rating/yellow.css') }}


        @yield('style')
	</head>
	<body>
	<div id="wrapper">
		<div class="container">
			@if(AuthSam::isLogin() || AuthSam::permission_lock())
				@if(AuthSam::permission())
					@includeIf('partials.user.header_agency')
				@else
					@includeIf('partials.user.header_client')
				@endif
            @else
				@includeIf('partials.home.header')
           	@endif
		</div> <!-- end .container -->
        @yield('content')
        @includeIf('partials.home.footer')
	</div>
  	{{HTML::script('assets/common/js/jquery-3.3.1.min.js')}}
  	{{HTML::script('assets/common/plugins/bootstrap/js/bootstrap.min.js')}}
  	{{HTML::script('assets/admin/js/jquery-confirm.min.js')}}
  	{{HTML::script('assets/common/plugins/datepicker/js/bootstrap-datepicker.min.js')}}
  	{{HTML::script('assets/common/plugins/datepicker/locales/bootstrap-datepicker.ja.min.js')}}
  	{{HTML::script('assets/common/plugins/bar-rating/dist/jquery.barrating.min.js')}}
  	{{HTML::script('assets/common/js/setup.js')}}
  	{{HTML::script('assets/common/js/home.js')}}
  	{{HTML::script('assets/common/js/luu.js')}}
	{{HTML::script('assets/common/js/common.js')}}
    @yield('script')
  </body>
</html>