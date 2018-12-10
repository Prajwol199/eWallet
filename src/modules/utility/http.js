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