$('#files').change(function(event) {
	var fileInput = document.getElementById('files');   
	html = '';
	var wheight = 115;
	for(i = 0; i < fileInput.files.length; i++)
	{
		html += '<span class="file_select_name">' + fileInput.files[i].name + '</span>';
		wheight += 18;
	}
	$('.dmessage-list ul').css({bottom: wheight});
	scrollBottomS();
	var filename = fileInput.files[0].name;
	$('#file-select-list').html(html);
});