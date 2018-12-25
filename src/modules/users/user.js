function user(){
	return{
		renderForgot:function(){
			var template = $('#forgotView').html();
			Finch.navigate('forgot');
			Helper().render( template );
		},
		renderLogin:function(){
			var token_data = JSON.parse(Helper().getCookie());
			if(!token_data){
				var template = $('#loginView').html();
				Finch.navigate('login');
				Helper().render( template );
			}else{			
				Finch.navigate('dashboard');
			}
		},
		renderRegister:function(){
			var template = $('#registerView').html();
			Finch.navigate('register');
			Helper().render( template );
		},
		renderDashboard:function(){
			var template   = $('#dashboardView').html();
			var data_token = JSON.parse(Helper().getCookie());
			var token      = data_token.token;
			var id         = data_token.user_id;
			if(token == null){
				Finch.navigate('login');
			}else{
				$("#hide" ).hide();
				$(".addCategoryView").hide();
				$(".small_content").hide();
				$(".categoryView").hide();	
				$(".editView").hide();
				$(".editDataView").hide();
				$(".addDataView").hide();						
				// var url = Config().apiUrl+Routes().category+Routes().user+id;
				var url = Config().apiUrl+Routes().category+id;
				var idRender = 'dashboardView';
				var navigate = 'dashboard';
				$http().get( url , idRender ,navigate );
			}
		},
	}
}

//<---------------  login form ------------------> 
$( document ).on( 'submit', '#login-form', function(e){
	e.preventDefault();
	var data = {};
	data['email']    = document.forms["form"]["email"].value;
	data['password'] = document.forms["form"]["password"].value;
	var json         = JSON.stringify(data);
	
	var onLogin = function( response ){
		Helper().log( response );
		var access_token = response.token;
		var user_id      = response.user_id;
		var data         = JSON.stringify({"token":access_token,"user_id":user_id});
		Helper().setCookie(data);
		var data_token   = JSON.parse(Helper().getCookie());   	
		if(data_token.token == null ){
			alert('Invalid one');
		}else{
			$(".login").hide();
			Finch.navigate('dashboard');
		}
	}

	var onError = function( err ){
		Helper().log( err );
	}

	$user().login( json ).then( onLogin, onError );
});

//<=------------------------ user register form----------------->
$( document ).on( 'submit', '#register-form', function(e){
	e.preventDefault();
	var data = {};
	data['name']     = document.forms["register-form"]["name"].value;
	data['email']    = document.forms["register-form"]["email"].value;
	data['password'] = document.forms["register-form"]["password"].value;
	var json = JSON.stringify(data);

	var onRegister = function( response ){
		Helper().log( response );
		var access_token = response.token;
		var user_id      = response.user_id;
		var data         = JSON.stringify({"token":access_token,"user_id":user_id});
		Helper().setCookie(data);
		Finch.navigate('dashboard');
	}	

	var onError = function( err ){
		Helper().log( err );
	}

	$user().register( json ).then( onRegister, onError );
});
//<---------------- forgot password form ---------------->
$( document ).on( 'submit', '#forgot-form', function(e){
	e.preventDefault();
	var data = {};
	data['email']    = document.forms["forgot-form"]["email"].value;
	localStore_email = document.forms["forgot-form"]["email"].value;
	var json = JSON.stringify(data);

	var onForgot = function( response ){
		Helper().setCookie( localStore_email );
		var template = $('#token-verify').html();
		Helper().render( template );
	}	

	var onError = function( err ){
		Helper().log( err );
	}

	$user().forgot( json ).then( onForgot, onError );
});

//<----------------- recover form ----------------->
$( document ).on( 'submit', '#recover-form', function(e){
	e.preventDefault();
	var data = {};
	data['email']    = Helper().getCookie();
	data['token']    = document.forms["recover-form"]["token"].value;
	data['password'] = document.forms["recover-form"]["password"].value;
	var json = JSON.stringify(data);

	var onRecover = function( response ){
		window.localStorage.clear();
		Finch.navigate('login');
	}

	var onError = function( err ){
		alert('Error');
	}
	$user().recover( json ).then( onRecover, onError );	
});


//<----------------  token resend form --------------->
$( document ).on( 'click','#resend-token',function(e){
	e.preventDefault();
	var data = {};
	data['email'] = Helper().getCookie();
	var json = JSON.stringify(data);

	var onResendToken = function( response ){
		alert('Token send successfulluy');
	}

	var onError = function( err ){
		alert('Error');
	}

	$user().resendToken( json ).then( onResendToken, onError );	
});
//<------------------- logout ---------------------->
$( document ).on( 'click','#logout',function(e){
	e.preventDefault();
	window.localStorage.clear();
	Finch.navigate('login');
	location.reload();
});