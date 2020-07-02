@extends('layouts.home')
@section('style')
	<style type="text/css">

	</style>
@endsection
@section('content')
<div class="mainpage clientprofile-1">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<ol class="breadcrumb">
					<li><a class="bg-color" href="#">TOPページ</a></li>
					<li class="active">会員情報管理</li>
				</ol>	
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">会員情報管理</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-2 sidebar-left">
				@if($user->image)
					@php ($profile_image = $user->image) @endphp
				@else
					@php ($profile_image = 'assets/common/images/img-user1.png') @endphp
				@endif
				@include('Agency::includes.sidebar-left')
			</div>
			<div class="col-sm-10 mainpage">
				 <div class="col-sm-12"> 
					<div class="row">
						<div class="tab-memberinfo">
							<ul class="nav profile-tab-new nav-tabs">
								<li class=""><a href="{{URL::route('agency.memberinfo')}}">ログイン情報設定</a></li>
								<li class="active"><a href="{{ URL::route('agency.memberinfo.mail') }}">メール通知設定</a></li>
								<li><a href="{{ URL::route('agency.memberinfo.block') }}">ブロック</a></li>
								<li><a href="{{ URL::route('agency.memberinfo.regmem') }}">会員登録・退会</a></li>
							</ul>
						</div>
						
						<div class="col-sm-12 form-memberinfo memberinfo-2">
							{{Form::open(['method'=>'POST'])}} 
							@include('partials.user.notifications')
								<div class="form-group mgtb-20">
									<div class="col-sm-3">
										<p>通知メール</p>
									</div>
									<div class="col-sm-9">
										<div class="checkbox">
											<label class="lb-mem">
												{{ Form::checkbox('jobs_requested', 1, ($user->jobs_requested)?true:false , ['class'=>'control-label'] ) }} 依頼した仕事に関するメールを受け取る
											</label>
										</div>
									</div> <!-- end .col-sm-9 -->
									<div class="col-sm-3">
										<p></p>
									</div>
									<div class="col-sm-9">
										<div class="checkbox">
											<label class="lb-mem">
												{{ Form::checkbox('proposed_work', 1, ($user->proposed_work)?true:false , ['class'=>'control-label'] ) }} 提案した仕事に関するメールを受け取る 
											</label>
										</div>
									</div><!-- end .col-sm-9 -->
									<div class="col-sm-3">
										<p></p>
									</div>
									<div class="col-sm-9">
										<div class="checkbox">
											<label class="lb-mem">
												{{ Form::checkbox('project_progress', 1, ($user->project_progress)?true:false , ['class'=>'control-label'] ) }} プロジェクト進行に関するメールを受け取る 
											</label>
										</div>
									</div><!-- end .col-sm-9 -->
									<div class="col-sm-3">
										<p></p>
									</div><!-- end .col-sm-9 -->
									<div class="col-sm-9">
										<div class="checkbox">
											<label class="lb-mem">
												{{ Form::checkbox('receive_message', 1, ($user->receive_message)?true:false , ['class'=>'control-label'] ) }} メッセージ受信の関するメールを受け取る 
											</label>
										</div>
									</div><!-- end .col-sm-9 -->
									<div class="col-sm-3">
										<p></p>
									</div>
									<div class="col-sm-9">
										<div class="checkbox">
										<label class="lb-mem">
											{{ Form::checkbox('favourite_proposal', 1, ($user->favourite_proposal)?true:false , ['class'=>'control-label'] ) }} 提案にお気に入りがあったらメールを受け取る 
										</label>
										</div>
									</div><!-- end .col-sm-9 -->
									<div class="col-sm-3">
										<p></p>
									</div>
									<div class="col-sm-9">
										<div class="checkbox">
											<label class="lb-mem">
												{{ Form::checkbox('create_withdraw_proposal', 1, ($user->create_withdraw_proposal)?true:false , ['class'=>'control-label'] ) }} 提案の作成や撤回をした時にメールを受け取る
											</label>
										</div>
									</div><!-- end .col-sm-9 -->
									<div class="col-sm-3">
										<p></p>
									</div>
									<div class="col-sm-9">
										<div class="checkbox">
											<label class="lb-mem">
												{{ Form::checkbox('consultation', 1, ($user->consultation)?true:false , ['class'=>'control-label'] ) }} 相談に関するメールを受け取る 
											</label>
										</div>
									</div><!-- end .col-sm-9 -->
									<div class="col-sm-12 break-div"></div>
										<div class="col-sm-3">
											<p>お知らせ</p>
										</div>
									<div class="col-sm-9"> 
										<label class="lb-mem">
											 提案の当選率を向上するコツや活用ガイドなどのお知らせ・情報を発信しています。
										</label> 
									</div><!-- end .col-sm-9 -->
									<div class="col-sm-3">
										<p></p>
									</div>
									<div class="col-sm-9">
										<label class="lb-mem control-label col-sm-3" style="padding-left:0px;">
											{{Form::radio('proposal_usage', 0, (($user->proposal_usage===0)?true:false) )}} 受け取らない
										</label> 
										<label class="lb-mem control-label col-sm-3" style="padding-left:0px;">
											{{Form::radio('proposal_usage', 1, (($user->proposal_usage==1)?true:false) )}} 受け取る
										</label> 
									</div>	<!-- end .col-sm-9 -->
									<div class="col-sm-12 break-div"></div>
									<div class="col-sm-3">
										<p>新着メール</p>
									</div>
									<div class="col-sm-9"> 
										<label class="lb-mem">
											「新着案件メール」は、選択したカテゴリの新しい案件を通知します。
										</label> 
									</div><!-- end .col-sm-9 -->
									<div class="col-sm-3">
										<p></p>
									</div>
									<div class="col-sm-9">
										<div class="checkbox">
										<label class="lb-mem">
											{{ Form::checkbox('new_item_category', 1, ($user->new_item_category)?true:false , ['class'=>'control-label'] ) }}新着案件メール 
										</label>
										</div>
									</div>

								</div>
									<div class="col-sm-12 box center btn-member">
									<button type="submit" class="boxshadowbuttonblue btn btn-primary btn-lg land-btn">変更する</button>
								</div> 
							{{Form::close()}}
						</div> 
					</div> <!-- end .row -->
				</div> <!-- end .col-sm-12 -->
			</div> <!-- end .mainpage -->
		</div>
	</div>
</div>

@endsection

@section('script')
	<script>
		var base_url = '{{URL::to('/')}}';
		
	</script>

@endsection