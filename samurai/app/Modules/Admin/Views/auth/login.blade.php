<!doctype html>
<html lang="ja">
	<head>
		<base href="/template-html/">
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- Bootstrap CSS -->
		{{HTML::style('assets/common/css/font-awesome-4.7.0/css/font-awesome.min.css')}}
		{{HTML::style('assets/common/plugins/bootstrap/css/bootstrap.min.css')}}
		{{HTML::style('assets/common/plugins/datepicker/css/bootstrap-datepicker.min.css')}}
		{{HTML::style('assets/common/css/admin.css')}}
		<title>管理画面</title>
	</head>
	<body>
		<div class="site">
		    <header ng-controller="HeaderCtrl">
		        <!-- ngInclude: header_path -->
		        <div ng-include="header_path" >
		            <div class="header ng-scope">
		                <div class="header-top">
		                    <div class="pull-left">
		                        <ul>
		                            <li class="active"><a href="{{URL::to('/admin/')}}">ログイン</a>
		                            </li>
		                        </ul>
		                    </div>
		                </div>
		                <div class="header-bottom">
		                    <ul class="navbar" style="margin-bottom:0px;">
		                        {{-- <li><a href="{{URL::to('/admin/')}}">助成金・補助金マッチングサイトへ</a>
		                        </li>
		                        <li><a href="{{URL::to('/admin/')}}">ver1.0 &nbsp; </a>
		                        </li> --}}
		                    </ul>
		                </div>
		            </div>
		        </div>
		    </header>


		    <!-- ngView: -->
		    <div ng-view="" >
		        <div class="container ng-scope">
		            <div class="row" style="margin-top:150px">
		                <strong>管理者メニュー：ログイン</strong>
		            </div>
		            <div class="row" style="margin-top:50px">
		                <div class="col-sm-2"></div>
		                <div class="col-sm-8">
		                    <p style="margin-left:0px;">ＩＤ・パスワードを入力してください</p>
		                    {{ Form::open(['url' => '/admin/doLogin', 'method' => 'POST', 'class' => 'form-horizontal', 'data-toggle'=>'validator', 'id'=>'profile_validate'])}}
		                    	@csrf
		                        <div class="form-group" style="margin-top:30px;">
		                            <p class="col-sm-2">ID</p>
		                            <div class="col-sm-5">
		                                {{Form::text('login_id', '', ['class'=>'form-control', 'required'=>'required'])}}
		                            </div>
		                        </div>
		                        <div class="form-group" style="margin-top:30px;">
		                            <p class="col-sm-2">パスワード</p>
		                            <div class="col-sm-5">
		                                {{Form::password('password', ['class'=>'form-control', 'required'=>'required'])}}
		                            </div>
		                        </div>
		                        <div class="form-group" style="margin-top:30px;">
		                            <div class="col-sm-2"></div>
		                            <div class="col-sm-5">
		                                {{Form::submit('ログイン', ['class'=>'submit-blue-btn'])}}
		                            </div>
		                        </div>
		                    {{ Form::close() }}
		                </div>
		            </div>
		        </div>
		    </div>

		</div>
	{{HTML::script('assets/common/js/jquery-3.3.1.min.js')}}
	{{HTML::script('assets/common/plugins/bootstrap/js/bootstrap.min.js')}}
	{{HTML::script('assets/common/plugins/datepicker/js/bootstrap-datepicker.min.js')}}
	{{HTML::script('assets/common/plugins/bar-rating/dist/jquery.barrating.min.js')}}
	{{HTML::script('assets/common/plugins/bootstrap/js/validator.min.js')}}
	{{HTML::script('assets/common/js/common.js')}}
	{{HTML::script('assets/common/js/luu.js')}}

	<!-- <script>
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
	</script> -->
  </body>
</html>