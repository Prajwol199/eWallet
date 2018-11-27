<?php

abstract class Wrapper{
	protected $method;

	// abstract public function get($method);
	abstract public function register($method);
	abstract public function login();
	abstract public function recover();
	// abstract public function put($method);
	// abstract public function delete($method);


	public function response($status,$data=''){
		if($status == 400){
			$response = [
				'status'=>'400',
				'message'=>'Error'
			];
			$json_response = json_encode($response);
			echo $json_response;
		}elseif($status == 200 ){
			$response = [
				'status'=>'200',
				'message'=>'successful',
				'data'=>$data
			];
			$json_response = json_encode($response);
			echo $json_response;
		}else{
			$response = [
				'message'=>'Response error'
			];
		}
	}
}