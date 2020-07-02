$('#file').bind('change', function(event) {
			fileFullName = $('#file').val();
			if(this.files[0].size >= 8388608)//
			{
				alert("アップロードするファイルサイズが大きいです。");
				return false;
			}
			var sep = '\\';
			if(fileFullName.indexOf('/')!=-1)
			{
				//linux
				sep = '/';
			}
			fileName = fileFullName.split(sep);
			fileName = fileName[fileName.length-1];
			$('#fileval').val(fileName);
		});

		var setMType = function(policy_id, type_id)
		{
			$.ajax({
				url: base_url + '/agency/mypage/homeAjax',
				data: {act: 'setType', policy_id: policy_id, type_id: type_id},
				type: 'POST',
				success: function(json) {
					if(json.is_insert == true)
					{
						if(type_id == 0) {
							$('#recom1-' + policy_id).removeClass('btn-default btn-style-grey');
							$('#recom1-' + policy_id).addClass('btn-warning');
						}
						if(type_id == 1) {
							$('#recom2-' + policy_id).removeClass('btn-default btn-style-grey');
							$('#recom2-' + policy_id).addClass('btn-success');
						}
						if(type_id == 2) {
							$('#recom3-' + policy_id).removeClass('btn-style-grey');
							$('#recom3-' + policy_id).addClass('btn-default-select');
						}
						
					} else {
						if(type_id == 0) {
							$('#recom1-' + policy_id).addClass('btn-default btn-style-grey');
							$('#recom1-' + policy_id).removeClass('btn-warning');
						}
						if(type_id == 1) {
							$('#recom2-' + policy_id).addClass('btn-default btn-style-grey');
							$('#recom2-' + policy_id).removeClass('btn-success');
						}
						if(type_id == 2) {
							$('#recom3-' + policy_id).addClass('btn-style-grey');
							$('#recom3-' + policy_id).removeClass('btn-default-select');
						}
						
					}
				},
				error: function() {
					alert('エラー');
				}
			})
		}
		var setFollow = function(follower_id) {
			$.ajax({
				url: base_url + '/agency/mypage/homeAjax',
				data: {act: 'setFollow', follower_id: follower_id},
				type: 'POST',
				success: function(json) {
					if(json.success)
					{
						if(json.is_insert) {
							$('.bfollow-' + follower_id).addClass('btn-primary');
							$('.bfollow-' + follower_id).removeClass('btn-default btn-style-grey');
						} else {
							$('.bfollow-' + follower_id).addClass('btn-default btn-style-grey');
							$('.bfollow-' + follower_id).removeClass('btn-primary');
						}
					} else {
						alert('エラー');
					}
				},
				error: function() {
					alert('エラー');
				}
			})
		}