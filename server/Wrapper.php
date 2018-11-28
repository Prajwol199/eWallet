<?php

class Wrapper{
	protected $routes;
	public function __construct(){
		$key = array_search( $_GET['url'], array_column($this->routes, 'url'));
		if( $key !== false && isset($this->routes[$key] )){
			$route = $this->routes[ $key ];
			if( strtolower( $_SERVER['REQUEST_METHOD'] ) == strtolower( $route['method'] ) ){
					call_user_func( $route['callback'] );
			}else{
				$this->invalid_route();
			}
		}else{
			$this->invalid_route();
		}
	}

	public function register_route( $url, $payload ){
		$this->routes[] = array(
			'url'      => $url,
			'method'   => $payload[ 'method' ],
			'callback' => $payload[ 'callback' ]
		);
	}

	public function invalid_route(){
		$this->response( 404, array(
			'message' => 'Invalid Route',
		));
	}

	public function response( $status = 200, $data ){
		header('Content-Type: application/json');
		http_response_code( $status );
		echo json_encode($data);
		die;
	}
}