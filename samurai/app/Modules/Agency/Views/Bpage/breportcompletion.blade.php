@extends('layouts.home')
@section('style')
	<link rel="stylesheet" href="/assets/agency/css/b_ask.css">
@endsection
@section('content')
<div class="mainpage">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				@includeIf('partials.breadcrumb', ['title' => '提案する'])
			</div>
		</div> <!-- end .row -->
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">違反者として申告する</h1>
			</div>
		</div> <!-- end .row -->
		<div class="row">
		    <div class="col-sm-offset-2 col-sm-8">
		        <div class="breportcompletion">
		            <div class="pd40-20">
		                <p>違反者情報の送信が完了しました。<br>
							ご協力ありがとうございます。<br>
							皆さまにご提供いただきました情報を元に、より良いサービスの提供を行ってまいります。</p>
		            </div>                         
		        </div>
		        <div class="row text-center mgbt-50 mgt-30">
		            <a href="{{route('agency.RequestDetails',['policy_id'=>request()->policy_id, 'user_id'=>request()->report_id])}}" class="btn btn-style-shadow-grey" style="width:150px;">戻る</a>
		        </div>
		    </div>
		</div>
	</div> <!-- end .container -->
</div> <!-- end .mainpage -->

@endsection

