<table class="table table-bordered mgbt-0">
	<thead>
		<tr>
			<th>
				<span class="page-per-page">検索結果: {{$results->total()}}件</span>
				<div class="float-right">
					<form action="" method="POST" class="form-inline">
						<div class="form-group">
							<label for="">並び替え: </label>
							{!!Form::select('order-by', config('combobox.order_by'), request()->order, ['class' => 'form-control order-by']) !!}
						</div>
						<div class="form-group">
							<label for="">表示件数: </label>
							{!!Form::select('per-page', config('combobox.per_page'), request()->per_page, ['class' => 'form-control per-page']) !!}
						</div>
					</form>
				</div> <!-- end float-right -->
			</th>
		</tr>
	</thead>
</table>