(function(){

 
 /*** New File ***/
$(document).on( 'click', '#login', function(e){
	e.preventDefault();
	var template = $('#loginView').html();
	Helper().render( template );
});

$(document).on( 'click', '#register', function(e){
	e.preventDefault();
	var template = $('#registerVIew').html();
	Helper().render( template );
});

$(document).on( 'click', '#forgot', function(e){
	e.preventDefault();
	var template = $('#forgotView').html();
	Helper().render( template );
});

$( document ).on( 'submit', '#login-form', function(e){
	e.preventDefault();
	var data = {};
	data['email']    = document.forms["form"]["email"].value;
	data['password'] = document.forms["form"]["password"].value;
	var json = JSON.stringify(data);
	
	var onLogin = function( response ){
		Helper().log( response );
    	var access_token = response.token;

    	Helper().setCookie('access_token='+access_token);
    	
    	if(Helper().getCookie() == 'access_token=undefined'){
    		alert('Invalid one');
    	}else{
    		var template = $('#dashboardView').html();
    		Finch.navigate('dashboard');
			Helper().render( template );
    	}
	}

	var onError = function( err ){
	 	Helper().log( err );
	}

	$user().login( json ).then( onLogin, onError );
});

$( document ).on( 'submit', '#register-form', function(e){
	e.preventDefault();
	var data = {};
	data['name']    = document.forms["register-form"]["name"].value;
	data['email']    = document.forms["register-form"]["email"].value;
	data['password'] = document.forms["register-form"]["password"].value;
	var json = JSON.stringify(data);

	var onRegister = function( response ){
		alert('success');
	}	

	var onError = function( err ){
	 	Helper().log( err );
	}

	$user().register( json ).then( onRegister, onError );
});

$( document ).on( 'submit', '#forgot-form', function(e){
	e.preventDefault();
	var data = {};
	data['email']    = document.forms["forgot-form"]["email"].value;
	var json = JSON.stringify(data);

	var onForgot = function( response ){
		var template = $('#token-verify').html();
		Helper().render( template );
	}	

	var onError = function( err ){
	 	Helper().log( err );
	}

	$user().forgot( json ).then( onForgot, onError );
});
 
 /*** New File ***/
function $user(){
	return {
		login: function( payload ){
			return $http().post({
				url: Routes().login,
				payload: payload,
			});
		},

		register: function( payload ){
			return $http().post({
				url: Routes().register,
				payload: payload,
			});
		},

		forgot: function( payload ){
			return $http().post({
				url: Routes().forgot,
				payload: payload,
			});
		}
	}
}
 
 /*** New File ***/
function Config(){
	return{
		mode      : 'production',
		apiUrl    : window.location.href + 'server/',
		cookieVar : 'ewallet'
	}
}
 
 /*** New File ***/
function Helper(){
	return{
		render: function( data ){
			$( '#render' ).html( data );
		},
		log: function( data ){
			if( 'production' == Config().mode ){
				console.log( data );
			}
		},
		setCookie: function( data ){
			localStorage.setItem( Config().cookieVar, data );
		},
		getCookie: function(){
			return localStorage.getItem( Config().cookieVar );
		}
	}
}
 
 /*** New File ***/
function $http(){
	return{
		post: function( param ){
			return $.post( Config().apiUrl + param.url, param.payload );
		}
	}
}
 
 /*** New File ***/
function Routes(){
	return{
		login     : 'login',
		register  : 'register',
		forgot  : 'forgot',
		dashboard : 'dashboard',
	}
}
 
 /*** New File ***/
})();