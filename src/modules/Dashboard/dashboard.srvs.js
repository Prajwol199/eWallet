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