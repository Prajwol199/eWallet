function $user(){
	return {
		login: function( payload ){
			return $http().post({
				url     : Routes().user+Routes().login,
				payload : payload,
			});
		},

		register: function( payload ){
			return $http().post({
				url     : Routes().user+Routes().register,
				payload : payload,
			});
		},

		forgot: function( payload ){
			return $http().post({
				url     : Routes().user+Routes().forgot,
				payload : payload,
			});
		},

		recover: function( payload ){
			return $http().post({
				url     : Routes().user+Routes().recover,
				payload : payload,
			});
		},
		resendToken: function( payload ){
			return $http().post({
				url     : Routes().user+Routes().resendToken,
				payload : payload,
			});
		}
	}
}