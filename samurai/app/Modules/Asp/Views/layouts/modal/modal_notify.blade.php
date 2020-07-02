@php
	if(!session('modal_notify')){ return false;}
@endphp
<div class="modal fade modal-ntf modalShow">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<div class="box-green">
					{!! session('modal_notify') !!}
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-gray" data-dismiss="modal">閉じる</button>
			</div>
		</div>
	</div>
</div>