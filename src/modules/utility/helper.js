function Helper(){
	return{
		render: function( data ){
			$( '#render' ).html( data );
		},
		log: function( data ){
			if( 'production' == Config().mode ){
				console.log( data );
			}
		},
		setCookie: function( data ){
			localStorage.setItem( Config().cookieVar, data );
		},
		getCookie: function(){
			return localStorage.getItem( Config().cookieVar );
		}
	}
}