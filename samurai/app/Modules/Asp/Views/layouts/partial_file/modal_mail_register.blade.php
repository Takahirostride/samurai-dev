<div class="modal fade modal-ntf" id="sendmail-modal">
	<div class="modal-dialog">
		<div class="modal-content">
			{!! Form::open(['route'=>['asp_register_send_mail']]) !!}
			<input type="hidden" name="client_list" value="">
			<div class="modal-body">
				<div class="alert alert-success alert-confirm">
					<h3>招待メールを送信しますか？</h3>
				</div>
				<div class="alert alert-success alert-complete">
					<h3>招待メールを送信しました。</h3>
				</div>				
				<div class="alert alert-warning alert-error"></div>
			</div>
			<div class="modal-footer alert-confirm">
				<button type="button" class="btn btn-gray" data-dismiss="modal">キャンセル</button>
				<button type="submit" class="btn btn-orange">送信する</button>
			</div>
			<div class="modal-footer alert-complete">
				<button type="button" class="btn btn-gray" data-dismiss="modal">キャンセル</button>
			</div>
			<div class="modal-footer alert-error">
				<button type="button" class="btn btn-gray" data-dismiss="modal">キャンセル</button>
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
<div class="modal fade modal-ntf" id="sendmail-modal-notify">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
            	<div class="alert alert-success">
	                <h3>メールアドレスを追加してから招待<br/>メールを送ってください</h3>
	            </div>    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-gray" data-dismiss="modal">キャンセル</button>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('assets/asp/js/asp-register-sendmail.js') }}"></script>