@php
	$c_company = isset($companies)&&$companies ? count($companies) : null;
@endphp
<div class="modal fade modal-ntf" id="modal-csv-register">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<div class="alert alert-success">
					<h3>{{ $c_company }}件の顧客を登録しますよろしいですか？</h3>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-gray" data-dismiss="modal">戻る</button>
				<button type="button" class="btn btn-orange" id="submit-register">登録する</button>
			</div>
		</div>
	</div>
</div>
