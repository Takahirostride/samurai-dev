<div class="modal fade modal-ntf" id="company-destroy">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<div class="alert alert-success">
					<h3><span class="company-name"></span>を削除しますか？</h3>
				</div>
			</div>
			<div class="modal-footer text-center">
				<button type="button" class="btn btn-gray" data-dismiss="modal">キャンセル</button>
				<a href="#" class="btn btn-red" id="btn-company-destroy">削除する</a>
			</div>
		</div>
	</div>
</div>
<script>
(function($){
$(function(){
var $company_modal = $('#company-destroy');
$company_modal.modal({show:false});
$('.destroy-company').on('click',function(ev){
	ev.preventDefault();
	var $ele = $(this);
	$company_modal.find('#btn-company-destroy').attr({
		href : $ele.attr('href')
	});
	$company_modal.find('.company-name:first').text($ele.data('name'));	
	$company_modal.modal('show');
	return false;
});	
})	
})(jQuery)	
</script>