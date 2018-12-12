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
				var url      = Config().apiUrl+Routes().category+Routes().categoryEdit+category_id;
				var idRender = 'editView';
				var navigate = 'edit';
				$http().get( url , idRender ,navigate );
			}
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
	var data_category        = {};
	data_category['title']   = document.forms["addform"]["title"].value;
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
	var category_id     = Helper().getCookie();
	var data_id         = JSON.parse(category_id);
	var id              = data_id.categoryData_id;
	var data            = {};
	data['field_name']  = $("#fieldName").val();
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
	var cookie          = JSON.parse(Helper().getCookie());
	var id              = cookie.editData_id;
	var data            = {};
	data['field_name']  = $("[name=fieldName]").val();
	data['description'] = $("[name=description]").val();

	$dashboard().editData( id,data );
});
//<---------------- Dashboard redirect ---------------->
$(document).on('click','#dashboard',function(e){
	e.preventDefault();
	Finch.navigate('dashboard');
	// location.reload();
});