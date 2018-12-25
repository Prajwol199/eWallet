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