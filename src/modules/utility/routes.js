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
