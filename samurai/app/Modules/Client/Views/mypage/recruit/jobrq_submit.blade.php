@extends('layouts.home')

@section('style')
	{{HTML::style('assets/common/plugins/datepicker/css/bootstrap-datepicker3.min.css')}}
	{{HTML::style('assets/common/css/recruit_chat.css')}}
@endsection
@section('content')
<div class="mainpage chat-page-area">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 mainpage chat-page">
				<div class="row">
					<div class="col-sm-1">
						<div class="diconleft">
							<ul class="diconleft-ul">
								<li><a title="マイページトップ" href="{{URL::route('client.home')}}"><i class="fa fa-home"></i></a></li>
								<li><a title="プロフィール管理" href="{{URL::route('client.profile')}}"><i class="fa fa-id-card"></i></a></li>
								<li><a title="会員情報管理" href="{{URL::route('client.memberinfo')}}"><i class="fa fa-cog"></i></a></li>
								<li><a title="仕事管理" href="{{URL::route('client.recruitment')}}"><i class="fa fa-tasks"></i></a></li>
								<li><a title="お気に入り" href="{{URL::route('client.checklist')}}"><i class="fa fa-star-o"></i></a></li>
								<li><a title="各種認証管理" href="{{URL::route('client.authentication')}}"><i class="fa fa-check-square-o"></i></a></li>
								<li><a title="支払い管理" href="{{URL::route('client.payment')}}"><i class="fa fa-money"></i></a></li>
								<li><a title="アフィリエイト管理" href="{{URL::route('client.affiliate')}}"><i class="fa fa-group"></i></a></li>
							</ul>
						</div>
					</div> <!-- end .col-sm-3 -->
					<div class="col-sm-11">
						<div class="js-head col-sm-8">
							<p>助成金・補助金以外で士業の方に相談したい仕事を依頼しましょう。<br>契約書の作成、リーガルチェック、就業規則の作成、労基対応、決算のお手伝いetc....</p>
						</div>
						{{Form::open(['method'=>'POST', 'class'=>'form-horizontal js-form step1Form'])}}
						<div class="form-group">
							<label class="col-sm-12 control-label">タイトル:</label>
							<div class="col-sm-8">
								{{Form::text('title', @$hire->job_title, ['class'=>'form-control', 'required', 'id'=>'title1', 'placeholder'=>'依頼のタイトルを書いてください'])}}
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-12 control-label">依頼詳細:</label>
							<div class="col-sm-8">
								{{Form::textarea('content', @$hire->job_content, ['class'=>'form-control', 'rows'=>7, 'required', 'id'=>'content1', 'placeholder'=>'依頼の内容を細かく書いてください'])}}
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-12 control-label">募集の締め切り:</label>
							<div class="col-sm-4">
								{{Form::text('schedule', ( isset($hire->deli_date)?ddate_string($hire->deli_date):date('Y年m月d日') ) , ['class'=>'form-control datepicker', 'required', 'id'=>'schedule1'])}}
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-12 control-label">予算:</label>
							<div class="col-sm-4">
								{{Form::select('budget', config('site_config.client_budget_list'), @$hire->budget, ['class'=>'form-control', 'required', 'id'=>'budget1'])}}
							</div>
						</div>
						<div class="text-center">
							<button type="submit" id="step1-button" class="btn btn-warning btn-samurai">内容を確認する</button>
						</div>

						{{Form::close()}}
					</div> <!-- end col-sm-9 -->
				</div>	<!-- end .row -->
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="confirmModal">
	<div class="modal-dialog" style="width: 900px">
		<div class="modal-content">
			<div class="modal-body">
				{{Form::open(['method'=>'POST', 'class'=>'form-horizontal js-form step2Form'])}}
					<div class="form-group">
						<label for="input" class="col-sm-12 control-label">タイトル:</label>
						<div class="col-sm-12">
							<input type="text" name="inputTitle" disabled="disabled" id="inputTitle" class="form-control" value="">
						</div>
					</div>
					<div class="form-group">
						<label for="input" class="col-sm-12 control-label">依頼詳細:</label>
						<div class="col-sm-12">
							<textarea name="inputContent" disabled="disabled" id="inputContent" class="form-control" rows="7"></textarea>
						</div>
					</div>
					<div class="form-group">
						<label for="input" class="col-sm-12 control-label">募集の締め切り:</label>
						<div class="col-sm-12">
							<input type="text" name="inputSchedule" disabled="disabled" id="inputSchedule" class="form-control" value="">
						</div>
					</div>
					<div class="form-group">
						<label for="input" class="col-sm-12 control-label">予算を設定する:</label>
						<div class="col-sm-12">
							<input type="text" name="inputBudget" disabled="disabled" id="inputBudget" class="form-control" value="">
						</div>
					</div>
					<div class="text-center">
						<button type="button" data-dismiss="modal" class="btn btn-samurai btn-default">修正する</button>
						<button type="submit" class="btn btn-samurai btn-warning">この内容で仕事依頼する</button>
					</div>
				{{Form::close()}}
			</div>
		</div>
	</div>
</div>

<div class="modal fade com-modal" id="completeModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<div class="com-list">
					<p class="com-head">仕事依頼が完了いたしました。</p>
					<p class="com-p">仕事管理から提案者とSAMURAI内チャットでコンタクトを取ることができます。<br>SAMURAIでは直接のやりとりを禁止しております。予めご了承ください<br>下記の仕事管理画面から見積もりの状況が確認できます。</p>
					
				</div>
				<div class="text-center">
					<a href="{{URL::route('client.recruitment.submitrq')}}" class="btn btn-default btn-lg btn-samurai">閉じる</a>
				</div>
			</div>
		</div>
	</div>
</div>


@endsection

@section('script')
	{{HTML::script('assets/common/plugins/datepicker/js/bootstrap-datepicker.min.js')}}
	{{HTML::script('assets/common/plugins/datepicker/locales/bootstrap-datepicker.ja.min.js')}}
	<script>
		var ajaxUrl = '{{URL::route('client.recruitment.submitrq')}}';
		console.log(ajaxUrl);
	</script>
	{{HTML::script('assets/client/js/jobrq.js')}}
@endsection
