<div class="modal fade" id="modal-reset-password">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">パスワードの再設定</h4>
				<span class="clr-gray">会員登録時に入力したメールアドレスを入力してください。新しいパスワードをお送りいたします。</span>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				<div class="reset-send">
					{!! Form::open(['route'=>['asp_password_email'],'class'=>'form-reset']) !!}
					<div class="row">
						<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
							<p>メールアドレス</p>
						</div>
						<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
							<div class="form-group">
								<input type="email" name="email" placeholder="メールアドレス" class="form-control" required>
							</div>
							<div class="text-center">
								<button type="submit" class="btn btn-orange">送信する</button>
							</div>
						</div>
					</div>
					{!! Form::close() !!}					
				</div>
				<div class="bl-success" style="display:none">
					<div class="box-green">
						<h3>登録メールアドレスにパスワードを送信しました</h3>
					</div>					
				</div>
			</div>
		</div>
	</div>
</div>
<script>
(function($){
	$(function(){
		var resetForm = (function(){
			var exp = {}
			var $element,$form;	
			exp.init = function(){
				$element = $('#modal-reset-password');
				$form = $element.find('form:first');
				listend();
			}
			var listend = function(){
				$form.on('submit',handleSubmit);
			}
			var handleSubmit = function(ev){
				ev.preventDefault();
				$('body').css('cursor','wait');
				$.ajax({
					url: $form.attr('action'),
					type: 'POST',
					data: $form.serialize(),
				})
				.done(function(res) {
					if(typeof res !== 'object'){
						res = JSON.parse(res);
					}
					if(res.error){
						alert(res.message);
						return false;
					}
					$element.find('.reset-send').hide();
					$element.find('.bl-success').show();
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					$('body').css('cursor','default');
				});
				
				return true;
			}
			return exp;
		})();
		resetForm.init();
	});
})(jQuery);	
</script>
