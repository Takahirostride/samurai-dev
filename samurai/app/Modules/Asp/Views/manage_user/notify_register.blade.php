@php
	if(!session('status_client')){ return false;}
@endphp
<div class="modal fade modal-notify" id="status-client">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<div class="alert alert-success">
					<p>株式会SAMURAIを登録しました。</p>
				</div>
			</div>
			<div class="modal-footer text-center">
				<button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
			</div>
		</div>
	</div>
</div>