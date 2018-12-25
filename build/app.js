(function(){

function dashboard(){
	return{
		renderAddCategory:function(){
			var template = $('#addCategoryView').html();
			Finch.navigate('addCategory');
			$( "#hide" ).hide();
			$( ".dashboard" ).hide();
			Helper().render( template );
		},
		rendercategoryData:function(){
			var cookie      = JSON.parse(Helper().getCookie());
			var category_id = cookie.categoryData_id;
			if(category_id == null){
				Finch.navigate('dashboard');
			}else{
				$( "#hide" ).hide();
				$( ".editDataView" ).hide();
				$( ".editCategoryDiv" ).hide();				
				$( ".addDataView" ).hide();				
				var url = Config().apiUrl+Routes().datas+category_id;
				var idRender = 'categoryView';
				var navigate = 'categoryData';
				$http().get( url , idRender ,navigate );
			}
		},
		renderaddCategoryData: function(){
			var template = $('#addDataView').html();
			Finch.navigate('addCategoryData');
			$( "#hide" ).hide();
			$( ".categoryView" ).hide();
			Helper().render( template );
		}
	}
}
//<-------------------- AddCategory form-------------------->
$( document ).on( 'submit', '#addCategory-form', function(e){
	e.preventDefault();
	var data = Helper().getCookie();
	data = JSON.parse(data);
	var user_id              = data.user_id;
	var data_category        = {};
	data_category['title']   = document.forms["addform"]["title"].value;
	var json = JSON.stringify(data_category);

	var onAdd = function( response ){
		Finch.navigate('dashboard');
	}
	
	var onError = function( err ){
	 	Helper().log( err );
	}
	$dashboard().addCategory( json , user_id ).then( onAdd, onError );
});

//<----------- Delete Category---------------->
$(document).on('click','.delete',function(e){
	e.preventDefault();
	var id = $(this).data('route');

	$dashboard().deleteCategory( id );
});

//<-------------------- Add Data form-------------------->
$( document ).on( 'submit', '#addData', function(e){
	e.preventDefault();
	var category_id     = Helper().getCookie();
	var data_id         = JSON.parse(category_id);
	var id              = data_id.categoryData_id;
	var data            = {};
	data['field_name']  = $("#fieldName").val();
	data['description'] = $("#description").val();
	var json = JSON.stringify(data);

	var onaddData = function( response ){
		Finch.navigate('categoryData');
		// location.reload();
	}
	
	var onError = function( err ){
	 	Helper().log( err );
	}
	$dashboard().addData( json , id ).then( onaddData, onError );

});
//<----------- Delete Category Data---------------->
$(document).on('click','.deleteData',function(e){
	e.preventDefault();
	var id = $(this).data('route');

	$dashboard().deleteData( id );
});

//<---------------- Dashboard redirect ---------------->
$(document).on('click','#dashboard',function(e){
	e.preventDefault();
	Finch.navigate('dashboard');
	// location.reload();
});

//<---------------- Edit Data -------------------->
//event on edit categoty click
$(document).on('click','#btnEdit',function(e){
	e.preventDefault();
	var id = $(e.target).data('id');
	$(".title-"+id).hide();
	$("#editCategoryField-"+id).show();
	$("#editTitle-"+id).focus();
});

//<------event on save categoty click --------->
$(document).on('click','#btnSave',function(e){
	e.preventDefault();
	var id =  $(e.target).data('id');

	var data = {};
	data['title'] = $("[name=titleName-"+id+"]").val();

	$dashboard().editCategory( id,data );
});

//<---------------- Edit Data -------------------->

$(document).on('click','#btnEditData',function(e){
	e.preventDefault();
	var id = $(e.target).data('id');
	$(".fieldName-"+id).hide();
	$(".description-"+id).hide();
	$("#editDataField-"+id).show();
	$("#editTitleField-"+id).show();
	$("#editFieldName-"+id).focus();
});

$(document).on('click','#btnSaveData',function(e){
	e.preventDefault();
	var id =  $(e.target).data('id');

	var data = {};
	data['field_name']  = $("[name=fieldName-"+id+"]").val();
	data['description'] = $("[name=description-"+id+"]").val();

	$dashboard().editData( id,data );
});
function $dashboard(){
	return {
		addCategory: function( payload, user_id ){
			return $http().post({
				url     : Routes().category+user_id,
				payload : payload,
			});
		},
		deleteCategory: function( id ){
			return $http().delete({
				url     : Routes().category+id,
				id      : id,
			});
		},
		editCategory: function( id,title ){
			return $http().put({
				url      : Routes().category+id,
				id       : id,    
				title    : title,
			});
		},
		addData: function( payload , id ){
			return $http().post({
				url     : Routes().datas+id,
				payload : payload,
			});
		},
		deleteData: function( id ){
			return $http().delete({
				url     : Routes().datas+id,
				id      : id,
			});
		},
		editData: function( id, title ){
			return $http().put({
				url      : Routes().datas+id,
				id       : id,
				title    : title,
			});
		},
	}
}
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
function $user(){
	return {
		login: function( payload ){
			return $http().post({
				url     : Routes().login,
				payload : payload,
			});
		},

		register: function( payload ){
			return $http().post({
				url     : Routes().register,
				payload : payload,
			});
		},

		forgot: function( payload ){
			return $http().post({
				url     : Routes().forgot,
				payload : payload,
			});
		},

		recover: function( payload ){
			return $http().post({
				url     : Routes().recover,
				payload : payload,
			});
		},
		resendToken: function( payload ){
			return $http().post({
				url     : Routes().resendToken,
				payload : payload,
			});
		}
	}
}
function Config(){
	return{
		mode             : 'production',
		apiUrl           : 'http://localhost/eWallet/server/',
		cookieVar        : 'ewallet',
		categoryIDCookie : 'categoryIDCookie',
	}
}
function Helper(){
	return{
		render: function( data ){
			var template = Handlebars.compile(data);
			var html     = template(template);
			$("#render").html(html);
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
		},
	}
}
function $http(){
	return{
		post: function( param ){
			return $.ajax({
			    type        : 'post',
			    data        : param.payload,
			    url         :  Config().apiUrl + param.url,
			    dataType    : 'json',
	  		});
		},
		delete: function( param ){
			$.ajax({
			    type    : 'delete',
			    url     : Config().apiUrl + param.url,
			    success : function(response) {
			    	var category = $("#deleteCategory-"+param.id).closest('tr');
			    	$(category).remove();
			    },
			    error   : function(response){
			        alert('Error!');
			    }
		  	});
		},
		put: function( param ){
			$.ajax({
			    type        : 'put',
			    data        : JSON.stringify(param.title),
			    url         : Config().apiUrl + param.url,
			    dataType    : 'json',
			    success     : function(response) {
			    	var title = response.data.title;
			    	$(".title-"+param.id).text(title);
			    	$(".title-"+param.id).show();
			    	$("#editCategoryField-"+param.id).hide();

			    	var fieldName = response.data.field_name;
			    	var des = response.data.description;
			    	$(".fieldName-"+param.id).text(fieldName);
			    	$(".description-"+param.id).text(des);
			    	$(".fieldName-"+param.id).show();
			    	$(".description-"+param.id).show();
			    	$("#editTitleField-"+param.id).hide();
			    	$("#editDataField-"+param.id).hide();
			    },
			    error: function(response){
			        alert('Error!');
			    }
		  	});
		},
		get: function( url , idRender , navigate ){
				var cookie = JSON.parse(Helper().getCookie());
				var token  = cookie.token;
			$.ajax({
				method   : 'GET',
				dataType : 'json',
				headers  :  {
						        "token":token,
						    },
				url      :  url,
				success :function( response ){
					$(".dashboard").hide();
					var html = $("#"+idRender).html();
					Finch.navigate(navigate);

					var template = Handlebars.compile(html);

					$('body').append(template({item: response}));
				},
				error : function( response ){
					alert('Error!');
				}
			});
		},
	}
}
function Routes(){
	return{
		category        :'category/',
		addCategory    :'addCategory/',
		login           :'login',
		user            :'user/',
		register        :'register',
		forgot          :'forgot',
		dashboard       :'dashboard',
		recover         :'recover',
		resendToken     :'resendToken',
		edit            :'edit',
		categoryData    :'categoryData/',
		datas           :'data/',
		first           :'/',
		addCategoryData :'addCategoryData',
		addCategoryData :'addCategoryData',
		editData       :'editData',
	}
}
//<----------- dashboard -------------->
Finch.route(Routes().addCategory,function(){
	dashboard().renderAddCategory();
});

Finch.route(Routes().categoryData,function(){
	dashboard().rendercategoryData();
});

Finch.route(Routes().addCategoryData,function(){
	dashboard().renderaddCategoryData();
});
//<----------- user -------------->
Finch.route(Routes().login,function(){
	user().renderLogin();
});

Finch.route(Routes().first,function(){
	user().renderLogin();
});

Finch.route(Routes().dashboard,function(){
	user().renderDashboard();
});

Finch.route(Routes().forgot,function(){
	user().renderForgot();
});

Finch.route(Routes().register,function(){
	user().renderRegister();
});

$(document).ready(function(){
	Finch.listen();
});

$(document).on('click','.navigator',function(e){
	e.preventDefault();
	var route = $(this).data('route');
	Finch.call( route );
});

$(document).on('click','.categoryData',function(e){
	e.preventDefault();
	var route = $(this).data('route');
	appendLocalStorage( 'categoryData_id', $(this).data('id') );
	Finch.call( route );
});

function appendLocalStorage( storage_name, value ){
	var cookie_arr       = {};
	var cookie           = JSON.parse(Helper().getCookie());
	cookie[storage_name] =  value;	
	var json             = JSON.stringify(cookie);
	Helper().setCookie(json);
}
})();