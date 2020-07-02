@php
	$csv_count = session('csv_register');
	if(!isset($csv_count) || $csv_count === false){ return false;}
@endphp
<div class="modal fade modalShow">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<div class="alert alert-success">
					<h3>{{ session('csv_register') }}件の顧客を登録しました。</h3>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-gray" data-dismiss="modal">閉じる</button>
				<a href="{{ route('asp_manage_clients') }}" class="btn btn-green">顧客一覧</a>
			</div>
		</div>
	</div>
</div>