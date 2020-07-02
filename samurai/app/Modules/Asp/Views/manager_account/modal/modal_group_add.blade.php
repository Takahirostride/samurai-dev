<div class="modal fade modal-ntf" id="olGroupAddModal">
	<div class="modal-dialog">
		<div class="modal-content">
			{!! Form::open(['route'=>['asp_manager_account_group_store']]) !!}
			<div class="modal-body">				
				<div class="form-group">
					<h3 class="modal-tit text-center">グループを追加する</h3>
					<div class="box-green">
						{!! Form::text('title',null,['required','class'=>'form-control','placeholder'=>'グループ名を入力してください。']) !!}
					</div>					
				</div>								
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-gray" data-dismiss="modal">キャンセル</button>
				<button type="submit" class="ol-save btn btn-orange">登録する</button>
			</div>
			{{ Form::close() }}
		</div>
	</div>
</div>