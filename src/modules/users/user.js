$(document).on( 'click', '#login', function(e){
	e.preventDefault();
	var template = $('#loginView').html();
	Helper().render( template );
});


$( document ).on( 'submit', '#login-form', function(e){
	e.preventDefault();
	var data = {};
	data['email']    = document.forms["form"]["email"].value;
	data['password'] = document.forms["form"]["password"].value;
	
	var onLogin = function( response ){
		Helper().log( response );
    	var access_token = response.data.token;

    	Helper().setCookie({
    		token: access_token,
    	});
    	
    	if(result == "access_token=undefined"){
    		alert('Invalid access');
    	}else{

    		Finch.navigate( Routes().dashboard );
    		var template = $('#dashboardView').html();
    		Helper.render(template);
    	}
	}

	var onError = function( err ){
		Helper().log( err );
	}

	$user().login( data ).then( onLogin, onError );

	// $.ajax({
	//     type: 'POST',
	//     url: 'http://localhost/eWallet/server/api/User.php?action=login',
	//     data: JSON.stringify(data),
	//     contentType: 'application/json',
	//     dataType: 'json',
	//     success: function(response) {
	//     	var access_token = response.data.token;
	//     	document.cookie = "access_token="+access_token;
	//     	var result = document.cookie;
	//     	if(result == "access_token=undefined"){
	//     		alert('Invalid access');
	//     	}else{
	//     		Finch.call('dashboard');
	//     	}
	//     },
	//     error: function(response){
	//     }
 //  	});
});
