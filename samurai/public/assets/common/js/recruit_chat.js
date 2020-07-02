
function formatAMPM(date) {
    var hours = date.getHours();
    var minutes = date.getMinutes();
    var ampm = hours >= 12 ? 'PM' : 'AM';
    hours = hours % 12;
    hours = hours ? hours : 12; // the hour '0' should be '12'
    minutes = minutes < 10 ? '0'+minutes : minutes;
    var strTime = hours + ':' + minutes + ' ' + ampm;
    return strTime;
}   
function formatDates(date) {
    var hours = date.getHours();
    var minutes = date.getMinutes();
    var year = date.getFullYear();
    var month = date.getMonth();
    var day = date.getDate();
    var strTime = year + '年' + (parseInt(month)+1) + '月' + day + '日 ' + hours + ':' + minutes + '';
    return strTime;
}      

//-- No use time. It is a javaScript effect.
function insertChat(who, text, json) {
    time = 0;
    var control = "";
    var date = formatDates(new Date());
    
    if (who == "me"){
        control = '<li style="width:100%">'+
                        '<div class="msj-rta macro">'+
                            '<div class="avatar">'+
                                '<img class="img-circle" src="'+me.avatar+'">'+
                                '<span>'+me.name+'</span>'+
                            '</div>'+
                            '<div class="text text-l">'+
                                '<p>'+text+'</p>';
        if(json.message.file.length) {
            control += '<p class="msg-files">';
            for(i=0; i < json.message.files.length;i++) {
                control += '<a target="_blank" href="'+json.message.files[i][0]+'">'+json.message.files[i][1]+'</a>';
            }
            control += '</p>';
        }
                        control +='<p><small>'+date+'</small></p>'+
                            '</div>'+
                        '</div>'+
                    '</li>';
    }else{
        control = '<li style="width:100%">' +
                        '<div class="msj macro">' +
                        '<div class="avatar">'+
                            '<img class="img-circle" src="'+ you.avatar +'" />'+
                            '<span>'+you.name+'</span>'+
                        '</div>' +
                            '<div class="text text-l">' +
                                '<p>'+ text +'</p>' +
                                '<p><small>'+date+'</small></p>' +
                            '</div>' +
                        '</div>' +
                    '</li>'; 
        
    }
    $('#submit-msg').val('');
    $('#files').val('');
    $('#file-select-list').html('');
    $(".dmessage-list ul").removeAttr('style');
    setTimeout(
        function(){                        
            $(".dmessage-list ul").append(control).scrollTop($(".dmessage-list ul").prop('scrollHeight'));
        }, time);
    
}
var scrollBottomS = function()
{
    $(".dmessage-list ul").scrollTop($(".dmessage-list ul").prop('scrollHeight'));
}
function resetChat(){
    $(".dmessage-list ul").empty();
}
function sendMsg() {
    var text = $(".mytext").val();
        if (text !== ""){
            
            var form = $('#sendmsg-form');
            var formdata = new FormData(form[0]);
            $(".mytext").val('');
            $.ajax({
                url: base_url + messageAjax,
                data: formdata,
                type: 'POST',
                processData: false,
                contentType: false,
                success: function(json) {
                    insertChat("me", text, json);
                    scrollBottomS();
                },
                error: function() {
                    scrollBottomS();
                }
            })
        }
}
scrollBottomS();


$('.input-msg-area span').click(function(){
    sendMsg();
})

var readNotify = function() {
    $('.dleft-item').each(function(index, el) {
        if($(el).hasClass('active'))
        {
            var thisSpan = $(el).find('.dleft-uinfo span');
            setTimeout(function() {thisSpan.remove();}, 2000);
        }
    });
    $.ajax({
        url: base_url + '/agency/mypage/message/readMessage',
        data: {act: 'readMessage', hire_id: hireId},
        type: 'GET',
        success: function(json) {
            
        }
    });
    
}
readNotify();


$('.btn-dcollapse').click(function(event) {
    var ii = $(this).find('i');
    var id = $(this).data('id');
    var plist = $('.dleft-policylist-' + id);
    if(plist.hasClass('dhide'))
    {
        plist.removeClass('dhide');
        ii.removeClass('fa-sort-down');
        ii.addClass('fa-sort-up');
        
    } else {
        plist.addClass('dhide');
        ii.removeClass('fa-sort-up');
        ii.addClass('fa-sort-down');
    }
    
});