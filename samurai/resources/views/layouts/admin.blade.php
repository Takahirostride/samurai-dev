<!doctype html>
<html lang="ja">
	<head>
        <title>管理画面</title>
        <!-- <base href="/template-html/"> -->
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="/assets/common/css/font-awesome-4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="/assets/common/plugins/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="/assets/common/plugins/datepicker/css/bootstrap-datepicker.min.css">
		<link rel="stylesheet" href="/assets/admin/css/jquery-confirm.min.css">
        <link rel="stylesheet" href="/assets/common/css/admin.css">
        <link rel="stylesheet" href="/assets/admin/css/admin-dy.css?v={{ time() }}">
        <script src="/assets/common/js/jquery-3.3.1.min.js"></script>
        <script src="/assets/common/plugins/bootstrap/js/validator.min.js"></script>
        <script src="/assets/admin/js/jquery-confirm.min.js"></script>
        
        @yield('style')
	</head>
	<body>
        <div class="site">
            <header class="ng-scope">
                <div class="ng-scope" style="">
                    <div class="header ng-scope">
                        @includeIf('partials.admin.header')
                        @yield('header_bottom')
                        @yield('breadcrumb')
                        @includeIf('partials.admin.notify')
                    </div>
                </div>
            </header>
            @yield('content')
        </div>
        <script src="/assets/common/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="/assets/common/plugins/datepicker/js/bootstrap-datepicker.min.js"></script>
        <script src="/assets/common/plugins/bar-rating/dist/jquery.barrating.min.js"></script>
        <script src="/assets/common/plugins/tinymce/tinymce.min.js"></script>
        <script src="/assets/common/js/setup.js"></script>
        <script src="/assets/common/js/common.js"></script>
        <script src="/assets/common/js/luu.js"></script>
        <script src="/assets/admin/js/admin-dy.js"></script>
        <script>
            $.fn.datepicker.dates['ja'] = {
                days: ["日", "月", "火", "水", "木", "金", "土"],
                daysShort: ["日", "月", "火", "水", "木", "金", "土"],
                daysMin: ["日", "月", "火", "水", "木", "金", "土"],
                months: ['1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月'],
                monthsShort: ['1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月'],
                today: "Today",
                clear: "Clear",
                format: "mm/dd/yyyy",
                titleFormat: "MM yyyy",
                weekStart: 0
            };
            $('.datepickertoday').datepicker({
                language : 'ja',
                inline: true,
                sideBySide: true,
                todayHighlight: true
            });

            $(document).ready(function(){
                var url = window.location.href;
                console.log(url);
            });

        </script>
        @yield('script')
    </body>
</html>