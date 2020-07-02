@php
	if(!session('company_delete')){ return false;}
@endphp
<div class="modal fade modal-ntf modalShow" id="company-destroy-success">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<div class="alert alert-success">
					<h3 class="text-center"><span class="company-name">{{ session('company_delete') }}</span>を削除しました。</h3>
				</div>
			</div>
			<div class="modal-footer text-center">
				<button type="button" class="btn btn-gray" data-dismiss="modal">閉じる</button>
			</div>
		</div>
	</div>
</div>