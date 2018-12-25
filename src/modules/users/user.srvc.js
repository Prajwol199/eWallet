function $user(){
	return {
		login: function( payload ){
			return $http().post({
				url     : Routes().login,
				payload : payload,
			});
		},

		register: function( payload ){
			return $http().post({
				url     : Routes().register,
				payload : payload,
			});
		},

		forgot: function( payload ){
			return $http().post({
				url     : Routes().forgot,
				payload : payload,
			});
		},

		recover: function( payload ){
			return $http().post({
				url     : Routes().recover,
				payload : payload,
			});
		},
		resendToken: function( payload ){
			return $http().post({
				url     : Routes().resendToken,
				payload : payload,
			});
		}
	}
}