@php
	if(!session('update_company') && !session('store_company') && !session('store_custom')){ return false;}
	$client_id = $company->id;
	$title = '顧客情報を保存しました。';
	if(session('store_company')){
		$title = '株式会SAMURAIを登録しました。';
	}
@endphp
<div class="modal fade modal-ntf modalShow">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<div class="alert alert-success">
					<h3>{{ $title }}</h3>
				</div>
			</div>
			<div class="modal-footer text-center">
				<button type="button" class="btn btn-gray" data-dismiss="modal">閉じる</button>
				@if($client_id)
				<a href="{{ route('asp_status_client_document',['id'=>$client_id]) }}" class="btn btn-success">顧客ページ</a>
				@endif
			</div>
		</div>
	</div>
</div>