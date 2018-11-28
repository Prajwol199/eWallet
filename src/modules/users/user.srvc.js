function $user(){
	return {
		login: function( payload ){
			return $http().post({
				url: Routes().login,
				payload: payload,
			});
		},

		register: function( payload ){
			return $http().post({
				url: Routes().register,
				payload: payload,
			});
		},

		forgot: function( payload ){
			return $http().post({
				url: Routes().forgot,
				payload: payload,
			});
		}
	}
}