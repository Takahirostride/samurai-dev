@php
	if(!session('status_client')){ return false;}
@endphp
<div class="modal fade modal-notify" id="status-client">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<h3 class="text-center">登録を完了しました。</h3>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">キャンセル</button>
			</div>
		</div>
	</div>
</div>