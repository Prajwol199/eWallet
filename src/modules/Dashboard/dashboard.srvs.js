function $dashboard(){
	return {
		addCategory: function( payload ){
			return $http().post({
				url     : Routes().category+Routes().addCategory,
				payload : payload,
			});
		},
		deleteCategory: function( payload ){
			return $http().delete({
				url     : Routes().category+Routes().deleteCategory,
				payload : payload,
			});
		},
		editCategory: function( id,title ){
			return $http().put({
				url      : Routes().category+Routes().editCategory,
				id       : id,
				title    : title,
				navigate : 'dashboard',
			});
		},
		addData: function( payload , id ){
			return $http().post({
				url     : Routes().datas+Routes().addData+'/'+id,
				payload : payload,
			});
		},
		deleteData: function( payload ){
			return $http().delete({
				url     : Routes().datas+Routes().deleteData,
				payload : payload,
			});
		},
		editData: function( id, title ){
			return $http().put({
				url      : Routes().datas+Routes().edit+'/',
				id       : id,
				title    : title,
				navigate : 'categoryData',
			});
		},
	}
}