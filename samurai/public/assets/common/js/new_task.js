var uploadForm = function(wid) {
			$('#btn-upload-'+wid).prop('disabled', true);
			var form = $('#uploadf-'+wid);
    		var formdata = new FormData(form[0]);
			$.ajax({
				url: base_url + taskViewAjax,
				data: formdata,
				type: 'POST',
				processData: false,
    			contentType: false,
    			dataType: 'json',
				success: function(json) {
					if(json.success == true)
					{
						if(json.data.update_type == 1)
						{
							var img = '<img src="'+base_url+'/assets/common/images/client.png" class="imgcircle">';
						} else {
							var img = '<img src="'+base_url+'/assets/common/images/agency.png" class="imgcircle">';
						}
						html = '<table class="table table-hover table-bordered" style="margin-bottom:0">';
						html += '<tr><td width="110">'+json.data.schedule+'</td><td width="110">'+json.data.update_date+'</td><td style="word-break:break-word;"><a href="'+base_url+'//api/download-file/'+json.data.file_path+'/'+json.data.file_name+'" target="_blank">'+json.data.file_name+'</a></td><td width="60">'+img+'</td></tr>';
						html += '</table>';
						$('#tf-'+wid).append(html);
					}
					$('#btn-upload-'+wid).prop('disabled', false);
					$('#file-'+wid).val('');
					
					
				}
			})			
			return false;
		}
		$(document).on('change', 'select[name="month"]', function() {
			var daysl = $(this).parent().parent().find('select:first-child');
			var m30 = [1,3,5,8,10];
			var selectedVal = $(this).val();
			if($.inArray( parseInt(selectedVal), m30) != -1) {
				$(daysl).find('option[value="30"]').prop('disabled', true);
			} else {
				$(daysl).find('option[value="30"]').prop('disabled', false);
			}
			
		});

		$(document).on('click', '.complete_btn', function() {
			var bid = $(this).attr('data-id');
			$.ajax({
				url: base_url + setTaskAjax,
				data: {act: 'setFinish', work_set_id: bid},
				type: 'POST',
				success: function(json) {
					if(json.success)
					{
						html = setFormEl(json.is_finish, bid);
						if(json.is_finish)
						{
							txt = '完了';
							rmclass = 'btndisabled';
							addclass = '';
						} else {
							txt = '未完了';
							rmclass = '';
							addclass = 'btndisabled';
						}
						$('.complete_btn_'+bid).text(txt);
						$('.complete_btn_'+bid).removeClass(rmclass);
						$('.complete_btn_'+bid).addClass(addclass);
						$('.tb-'+bid).html(html);
						setImage(json.is_finish, bid);
					}
				}
			});
		});
		var setImage = function(is_finish, wid) {
			var src = $('#imgt-'+wid).attr('src');
			if(is_finish)
			{
				src = src.replace('grey.png', '.png');
				//$('#divs-'+wid+' a').addClass('active');
			} else {
				src = src.replace('.png', 'grey.png');
				//$('#divs-'+wid+' a').removeClass('active');
			}
			$('#imgt-'+wid).prop('src', src);
			
		}
		var setFormEl = function(is_finish, wid) {
			if(is_finish == 1)
			{
				html = '<div class="checksuccess"><i class="fa fa-check" style="color: #0abc03"></i>完了</div>';
			} else {
				html = '<form method="POST" action="'+base_url+'/agency/mypage/jobs/matching-case/task-view/'+wid+'" accept-charset="UTF-8" class="form-inline" id="uploadf-'+wid+'" enctype="multipart/form-data">'+
							'<input type="hidden" name="hire_id" value="{{$hire_id}}">'+
							'<input type="hidden" name="work_set_id" value="'+wid+'">'+
							        		'<p class="text-center">提出期限</p>'+
							        		'<div class="text-center">'+
								        		'<div class="form-group">'+
								        			'<select class="nopdsl" name="day"><option value="0" selected="selected">1</option><option value="1">2</option><option value="2">3</option><option value="3">4</option><option value="4">5</option><option value="5">6</option><option value="6">7</option><option value="7">8</option><option value="8">9</option><option value="9">10</option><option value="10">11</option><option value="11">12</option><option value="12">13</option><option value="13">14</option><option value="14">15</option><option value="15">16</option><option value="16">17</option><option value="17">18</option><option value="18">19</option><option value="19">20</option><option value="20">21</option><option value="21">22</option><option value="22">23</option><option value="23">24</option><option value="24">25</option><option value="25">26</option><option value="26">27</option><option value="27">28</option><option value="28">29</option><option value="29">30</option><option value="30">31</option></select>'+
													'<label for="">月</label>'+
								        		'</div>'+
								        		'<div class="form-group">'+
								        			'<select class="nopdsl" name="month"><option value="0" selected="selected">1</option><option value="1">2</option><option value="2">3</option><option value="3">4</option><option value="4">5</option><option value="5">6</option><option value="6">7</option><option value="7">8</option><option value="8">9</option><option value="9">10</option><option value="10">11</option><option value="11">12</option></select>'+
													'<label for="">日</label>'+
								        		'</div>'+
								        	'</div>'+
								        	'<div class="inputfilehide">'+
								        		'<input type="file" name="image" id="file-'+wid+'">'+
								        		'<span class="glyphicon glyphicon-open-file"></span>'+
								        	'</div>'+
								        	'<p class="text-center">'+
								        		'<button type="button" id="btn-upload-'+wid+'" onclick="uploadForm('+wid+');" class="shadowbuttonprimary btn btn-primary">更新する</button>'+
								        	'</p>'
			}
			return html;
		}