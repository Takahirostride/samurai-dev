@php
	if(!session('store_invation')){ return false;}
@endphp
<div class="modal fade modal-ntf modalShow" id="modal-invation">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<div class="box-green">
					<h3 class="modal-tit">招待メールを保存しました。</h3>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-gray" data-dismiss="modal">閉じる</button>
			</div>
		</div>
	</div>
</div>