function Helper(){
	return{
		render: function( data ){
			var template = Handlebars.compile(data);
			var html = template(template);
			$("#render").html(html);
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
		},
	}
}