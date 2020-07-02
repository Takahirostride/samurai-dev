<div class="modal fade" id="olGroupEditModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			{!! Form::open(['route'=>['asp_group_ajax_edit']]) !!}
			<div class="modal-body">				
				<input type="hidden" name="group_id" class="ip-group-id">
				<div class="form-group">
					<div class="control-label">グループ名</div>
					{!! Form::text('title',null,['required','class'=>'form-control']) !!}
				</div>								
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
				<button type="submit" class="ol-save btn btn-primary">登録する</button>
			</div>
			{{ Form::close() }}
		</div>
	</div>
</div>