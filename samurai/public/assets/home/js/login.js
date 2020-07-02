/*
*	Name 	: 	Login
*	Author 	: 	Common
*	Created : 	10/10/2018
*	Updated: 	 
*/
$(document).ready(function(){
	//cal function here
	init();
	login();
});
/*
*	Name 	: 	Initialization Function
*	Author 	: 	Trieunb
*	Created : 	22/09/2018
*	Modify 	: 	
*	Updated : 	 
*/
function init() {
	try {
		//handle init
	} catch(err) {
		console.log(err);
	}
}
/*
*	Name 	: 	Login Function
*	Author 	: 	Trieunb
*	Created : 	22/09/2018
*	Modify 	: 	
*	Updated : 	 
*/
function login() {
	try {
		$(document).on('click', '.btn-login', function() {
			var data = {
				email 	 : $('.email').val(),
				password : $('.password').val()
			}
			$.ajax({
	            url: '/doLogin',
	            type: 'POST',
	            dataType: 'json',
	            data: data,
	            success: function (res) {   // success callback function
			        if (res.status) {
			        	if (res.permission == '1') {
			        		window.location.href = '/agency/home';
			        	} else {
			        		window.location.href = '/client/F0';
			        	}
			        }
			    }
	        });
		});
	} catch(err) {
		console.log(err);
	}
}