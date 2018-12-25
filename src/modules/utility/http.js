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