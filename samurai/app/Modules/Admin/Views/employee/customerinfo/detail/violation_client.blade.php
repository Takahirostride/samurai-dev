<div class="fr-violate">
	{!! Form::open(['route'=>['admin.customerinfo.storeviolation',$user]]) !!}
		<div class="row">
			<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
				<p>メモ</p>
			</div>
			<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
				{!! Form::textarea('message',null,['class'=>'form-control','required']) !!}
			</div>

		</div>
		<div class="text-right mt30">
			<button type="submit" value="1" class="btn btn-orange">保存</button>
		</div>
	{!! Form::close(); !!}	
</div> 
<div class="act-violate">
	<h4 class="pagerow-title"><span>アカウント情報</span></h4>
	<div class="row">
		<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
			<p>アカウント停止</p>
		</div>
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
			@if($user->permission != 0)
			<button type="button" class="btn btn-red" data-toggle="modal" href='#modal-report-disable'>アカウントを停止する</button>
			@else
			<button type="button" class="btn btn-gray">アカウントを停止する</button>
			<button type="button" class="btn btn-green" data-toggle="modal" href='#modal-report-active'>停止を解除する</button>
			@endif
		</div>

	</div>
</div>
<div class="lst-violate">
	<h4 class="pagerow-title"><span>アカウント停止履歴</span></h4>
	<ul class="lst-posts">
		@foreach ($reports as $rp)
			<li>
				<span class="date">{{ $rp->created_at->format('Y年m月d日　H:i') }}</span>
				<span class="ct">{!! nl2br($rp->message) !!}</span>
			</li>
		@endforeach		
	</ul>
	{!! $reports->appends(request()->query())->links() !!}
</div>
<div class="modal fade modal-ntf" id="modal-report-disable">
	<div class="modal-dialog">
		<div class="modal-content">
			{!! Form::open(['route'=>['admin.customerinfo.changepermission',$user]]) !!}
			<input type="hidden" name="permission" value="0">
			<div class="modal-body">
				<h3>アカウントを停止しますか？</h3>
			</div>
			<div class="modal-footer text-center">
				<button type="button" class="btn btn-gray" data-dismiss="modal">キャンセル</button>
				<button type="submit" class="btn btn-red">停止する</button>
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
<div class="modal fade modal-ntf" id="modal-report-active">
	<div class="modal-dialog">
		<div class="modal-content">
			{!! Form::open(['route'=>['admin.customerinfo.changepermission',$user]]) !!}
			<input type="hidden" name="permission" value="1">
			<div class="modal-body">
				<h3>アカウントを停止しますか？</h3>
			</div>
			<div class="modal-footer text-center">
				<button type="button" class="btn btn-gray" data-dismiss="modal">キャンセル</button>
				<button type="submit" class="btn btn-green">解除する</button>
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
