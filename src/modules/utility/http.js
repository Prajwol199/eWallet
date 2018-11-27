function $http(){
	return{
		post: function( param ){
			return $.post( Config().apiUrl + param.url, param.payload );
		}
	}
}