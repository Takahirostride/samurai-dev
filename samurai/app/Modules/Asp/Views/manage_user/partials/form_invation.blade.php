@php
	$title = $invation ? $invation->title : null;
	$message = $invation ? $invation->message : null;
@endphp
<div class="block_invation">
	<h3 class="tit-blue">招待メール定型文を作成  ※こちらの招待メールは　info@samurai-match.jpから送信されます。</h3>
	{!! Form::open(['route'=>'asp_manage_clients_store_invation']) !!}
		<div class="inv-ct">
			<div class="row form-group">
				<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
					<p>件名</p>
				</div>
				<div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
					{!! Form::text('title',$title,['class'=>'form-control','placeholder'=>'件名を入力してください','required']) !!}
				</div>

			</div>
			<div class="row form-group">
				<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
					<p>本文</p>
				</div>
				<div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
					{!! Form::textarea('message',$message,['class'=>'form-control','placeholder'=>'メール本文を入力してください','required']) !!}
				</div>

			</div>

		</div>
		<div class="text-right">
			<button type="submit" class="btn btn-orange">保存</button>
		</div>
	{!! Form::close() !!}
</div>
@push('script')
	@include('Asp::manage_user.partials.modal_invation')
@endpush