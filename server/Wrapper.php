<?php
class Wrapper{
	protected $routes;
	public function __construct(){

		$url = $_GET[ 'url' ];

		$method = strtolower( $_SERVER['REQUEST_METHOD'] );
		$id = isset( $_GET[ 'id' ] ) && !empty( $_GET[ 'id' ] ) ? true: false;		
		$key = false;
		foreach( $this->routes as $i => $r ){
			// method // id // url
			if( $r[ 'method' ] == $method && $r[ 'url' ] == $url && $id === $r[ 'id' ] ){
				$key = $i;
			}
		}
		if( $key !== false && isset($this->routes[$key] )){
			$route = $this->routes[ $key ];
			if( $route['id'] ){
				call_user_func_array( $route['callback'], array($_GET['id']) );
			}else{
				call_user_func( $route['callback'] );
			}
		}else{
			$this->invalid_route();
		}
	}

	public function register_route( $url, $payload ){

		$route = explode( '/:', $url );
		if( count( $route ) == 1 ){
			$id = false;
		}else{
			$id = true;
			$url = $route[ 0 ];
		}
		
		$this->routes[] = array(
			'id'       => $id,
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

	public function invalid_access(){
		$this->response( 404, array(
			'message' => 'Invalid Access',
		));
	}

	public function fetch($data){
        $rows=[];
        while($row=mysqli_fetch_assoc($data)){
            $rows[]=$row;
        }
        return $rows;
    }
}