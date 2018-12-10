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
		renderEdit:function(){
			var cookie = JSON.parse(Helper().getCookie());
			var category_id = cookie.category_id;
			if(category_id == null){
				Finch.navigate('login');
			}else{
				$( "#hide" ).hide();
				var url = Config().apiUrl+Routes().category+Routes().categoryEdit+category_id;
				var idRender = 'editView';
				var navigate = 'edit';
				$http().get( url , idRender ,navigate );
			}
		},
		rendercategoryData:function(){
			var cookie = JSON.parse(Helper().getCookie());
			var category_id = cookie.categoryData_id;
			if(category_id == null){
				Finch.navigate('dashboard');
			}else{
				$( "#hide" ).hide();
				var url = Config().apiUrl+Routes().datas+Routes().show+category_id;
				var idRender = 'categoryView';
				var navigate = 'categoryData';
				$http().get( url , idRender ,navigate );
			}
		},
		rendereditData:function(){
			var cookie = JSON.parse(Helper().getCookie());
			var id = cookie.editData_id;
			if(id == null){
				Finch.navigate('categoryData');
			}else{
				$( "#hide" ).hide();
				$(".categoryView").hide();
				var url = Config().apiUrl+Routes().datas+Routes().showData+id;
				var idRender = 'editDataView';
				var navigate = 'editData';
				$http().get( url , idRender ,navigate )
			}
		},
	}
}
//<-------------------- AddCategory form-------------------->
$( document ).on( 'submit', '#addCategory-form', function(e){
	e.preventDefault();
	var data = Helper().getCookie();
	data = JSON.parse(data);
	var data_category = {};
	data_category['title'] = document.forms["addform"]["title"].value;
	data_category['user_id'] = data.user_id;
	var json = JSON.stringify(data_category);

	var onAdd = function( response ){
		Finch.navigate('dashboard');
		location.reload();
	}
	
	var onError = function( err ){
	 	Helper().log( err );
	}
	$dashboard().addCategory( json ).then( onAdd, onError );
});

//<----------- Delete Category---------------->
$(document).on('click','.delete',function(e){
	e.preventDefault();
	var id = $(this).data('route');

	$dashboard().deleteCategory( id );
});

//<---------------- Edit Category ---------------->
$( document ).on( 'submit', '#editCategory-form', function(e){
	e.preventDefault();
	var cookie = JSON.parse(Helper().getCookie());
	var id = cookie.category_id;
	var data = {};
	data['title'] = $("#title").val();

	$dashboard().editCategory( id,data );
});
//<-------------------- Add Data form-------------------->
$( document ).on( 'submit', '#addData', function(e){
	e.preventDefault();
	var category_id = Helper().getCookie();
	var data_id = JSON.parse(category_id);
	var id = data_id.categoryData_id;
	var data = {};
	data['field_name'] = $("#fieldName").val();
	data['description'] = $("#description").val();
	var json = JSON.stringify(data);

	var onaddData = function( response ){
		Finch.navigate('categoryData');
		location.reload();
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
//<---------------- Edit Data ---------------->
$( document ).on( 'submit', '#editData', function(e){
	e.preventDefault();
	var cookie = JSON.parse(Helper().getCookie());
	var id = cookie.editData_id;
	var data = {};

	data['field_name'] = $("[name=fieldName]").val();
	data['description'] = $("[name=description]").val();

	$dashboard().editData( id,data );
});
//<---------------- Dashboard redirect ---------------->
$(document).on('click','#dashboard',function(e){
	e.preventDefault();
	Finch.navigate('dashboard');
	location.reload();
});
function $dashboard(){
	return {
		addCategory: function( payload ){
			return $http().post({
				url: Routes().category+Routes().addCategory,
				payload: payload,
			});
		},
		deleteCategory: function( payload ){
			return $http().delete({
				url: Routes().category+Routes().deleteCategory,
				payload: payload,
			});
		},
		editCategory: function( id,title ){
			return $http().put({
				url: Routes().category+Routes().editCategory,
				id: id,
				title: title,
				navigate: 'dashboard',
			});
		},
		addData: function( payload , id ){
			return $http().post({
				url: Routes().datas+Routes().addData+'/'+id,
				payload: payload,
			});
		},
		deleteData: function( payload ){
			return $http().delete({
				url: Routes().datas+Routes().deleteData,
				payload: payload,
			});
		},
		editData: function( id, title ){
			return $http().put({
				url: Routes().datas+Routes().edit+'/',
				id: id,
				title: title,
				navigate: 'categoryData',
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
			var template = $('#dashboardView').html();
			var data_token = JSON.parse(Helper().getCookie());
			var token = data_token.token;
			var id = data_token.user_id;
			if(token == null){
				Finch.navigate('login');
			}else{
				$( "#hide" ).hide();
				$(".addCategoryView").hide();
				var url = Config().apiUrl+Routes().category+Routes().user+id;
				var idRender = 'dashboardView';
				var navigate = 'dashboard';
				$http().get( url , idRender ,navigate );
				 // $.ajax({
				 //    type: 'get',
				 //    url: 'http://localhost/eWallet/server/category/user/'+id,
				 //    success: function(response) {
				 //    	var html = $("#dashboardView").html();
					// 	var template = Handlebars.compile(html);

					// 	$('body').append(template({item: response}));
				 //    },
				 //    error: function(response){
				 //        alert('Error!');
				 //    }
			  // 	});
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
	var json = JSON.stringify(data);
	
	var onLogin = function( response ){
		Helper().log( response );
    	var access_token = response.token;
    	var user_id = response.user_id;
    	var data = JSON.stringify({"token":access_token,"user_id":user_id});
    	Helper().setCookie(data);
    	var data_token = JSON.parse(Helper().getCookie());   	
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
	data['name']    = document.forms["register-form"]["name"].value;
	data['email']    = document.forms["register-form"]["email"].value;
	data['password'] = document.forms["register-form"]["password"].value;
	var json = JSON.stringify(data);

	var onRegister = function( response ){
		var access_token = response.token;
    	Helper().setCookie('access_token='+access_token);
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
	data['email'] = Helper().getCookie();
	data['token'] = document.forms["recover-form"]["token"].value;
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
				url: Routes().user+Routes().login,
				payload: payload,
			});
		},

		register: function( payload ){
			return $http().post({
				url: Routes().user+Routes().register,
				payload: payload,
			});
		},

		forgot: function( payload ){
			return $http().post({
				url: Routes().user+Routes().forgot,
				payload: payload,
			});
		},

		recover: function( payload ){
			return $http().post({
				url: Routes().user+Routes().recover,
				payload: payload,
			});
		},
		resendToken: function( payload ){
			return $http().post({
				url: Routes().user+Routes().resendToken,
				payload: payload,
			});
		}
	}
}
function Config(){
	return{
		mode      : 'production',
		apiUrl    : 'localhost/eWallet/server/',
		cookieVar : 'ewallet',
		categoryIDCookie : 'categoryIDCookie',
	}
}
function Helper(){
	return{
		render: function( data ){
			var template = Handlebars.compile(data);
			var html = template(template);
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
			return $.post( Config().apiUrl + param.url, param.payload );
		},
		delete: function( param ){
			$.ajax({
			    type: 'delete',
			    url: Config().apiUrl + param.url+param.payload,
			    success: function(response) {
			        location.reload();
			    },
			    error: function(response){
			        alert('Error!');
			    }
		  	});
		},
		put: function( param ){
			$.ajax({
			    type: 'put',
			    url: Config().apiUrl + param.url+param.id,
			    data: JSON.stringify(param.title),
			    contentType: 'application/json',
			    dataType: 'json',
			    success: function(response) {
			    	$(".editView").hide();
			    	$(".editDataView").hide();
			        Finch.navigate(param.navigate);
			    },
			    error: function(response){
			        alert('Error!');
			    }
		  	});
		},
		get: function( url , idRender , navigate ){
			$.ajax({
				type:'get',
				url: url,
				success :function( response ){
					$(".dashboard").hide();
					var html = $("#"+idRender).html();
					Finch.navigate(navigate);

					var template = Handlebars.compile(html);

					$('body').append(template({item: response}));
				},
				error : function( response ){
					// alert('Error!');
				}
			});
		},
	}
}
function Routes(){
	return{
		category       :'category/',
		addCategory    :'addCategory/',
		deleteCategory :'deleteCategory/',
		editCategory   :'editCategory/',
		categoryEdit   :'editCategoryData/',
		login          :'login',
		user           :'user/',
		register       :'register',
		forgot         :'forgot',
		dashboard      :'dashboard',
		recover        :'recover',
		resendToken    :'resendToken',
		edit           :'edit',
		categoryData   :'categoryData',
		datas          :'data/',
		addData        :'add',
		deleteData     :'delete/',
		show           :'show/',
		editData       :'editData',
		showData       :'showEditData/',
		first          :'/',
	}
}
//<----------- dashboard -------------->
Finch.route(Routes().addCategory,function(){
	dashboard().renderAddCategory();
});
Finch.route(Routes().edit,function(){
	dashboard().renderEdit();
});
Finch.route(Routes().categoryData,function(){
	dashboard().rendercategoryData();
});

Finch.route(Routes().editData,function(){
	dashboard().rendereditData();
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

$(document).on('click','.edit',function(e){
	e.preventDefault();
	var route = $(this).data('route');
	appendLocalStorage( 'category_id', $(this).data('id') );
	Finch.call( route );
});

$(document).on('click','.categoryData',function(e){
	e.preventDefault();
	var route = $(this).data('route');
	appendLocalStorage( 'categoryData_id', $(this).data('id') );
	Finch.call( route );
});

$(document).on('click','.editData',function(e){
	e.preventDefault();
	var route = $(this).data('route');
	appendLocalStorage( 'editData_id', $(this).data('id') );
	Finch.call( route );
});

function appendLocalStorage( storage_name, value ){
	var cookie_arr = {};
	var cookie = JSON.parse(Helper().getCookie());	
	cookie[storage_name] =  value;
	
	var json = JSON.stringify(cookie);
	Helper().setCookie(json);
}

// $( document ).ready(function() {
// 	var token = Helper().getCookie();
//     if(token == null){
// 		Finch.navigate('login');
// 	}else{
// 		Finch.navigate('dashboard');
// 	}
// });

})();