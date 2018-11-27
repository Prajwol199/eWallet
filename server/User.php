<?php

require_once('Wrapper.php');
require_once('Database.php');
// require_once('mailer');

class User extends Wrapper{

	protected $table_user='user'; 

	public function __construct(){
        $this->db = Database::instantiate();
        $this->check();
    }
	public function check(){
		$method = $_SERVER['REQUEST_METHOD'];

		switch ($method) {
		  case 'GET':
		    $this->get($method);
		    break;
		  case 'POST':
		  	$action = $_GET['action'];
		  	if($action == 'register'){
		    	$this->register($method);
			}elseif($action == 'login'){
				$this->login();
			}elseif($action == 'forgot'){
				$this->forgot();
			}elseif($action == 'recover'){
				$this->recover();
			}
		    break;
		  case 'PUT':
		    $this->put($method);
		    break;
		  case 'DELETE':
		    $this->delete($method);
		    break;
		  Default:
    		echo 'No Action for '.$method.' Method';
  			break;
		}
	}

	public function login(){
		$data = json_decode(file_get_contents('php://input'),true);
		$email = $data['email'];
		$password = md5($data['password']);
		header("Content-Type:application/json");
		if(!empty($email) && !empty($password)){
			$condition = [
				'email'=>$email,
				'password'=>$password
			];
			$count = $this->db->select($this->table_user,array('*'),$condition);
			if((mysqli_num_rows($count))==1){
					$header = json_encode(['alg'=>'HS256','typ'=>'JWT']);
					$payload = json_encode(['email'=>$email,'password'=>$password]);
					$signature =hash_hmac('sha256',base64_encode($header).'.'.base64_encode($payload), 'abc123',true);
					$base64 = base64_encode($signature);
					$token = base64_encode($header).'.'.base64_encode($payload).'.'.$base64;
				$message = [
					'email'=>$email,
					'message'=>'Succefully login',
					'token'=>$token
				];
				$this->response(200,$message);
			}else{
				$this->response(400);
			}
		}else{
			$this->response(400);
		}
	}

	public function register($method){
		$data = json_decode(file_get_contents('php://input'), true);
		$name = $data['name'];
		$email = $data['email'];
		$password = md5($data['password']);
		header("Content-Type:application/json");
		if(!empty($method) && !empty($name) && !empty($email) && !empty($password)){
			$data=[
				'name'=>$name,
				'email'=>$email,
				'password'=>$password
			];
			$email_db = array('email');
			$email_db_fetch = $this->db->select($this->table_user,$email_db,array('email'=>"$email"));
			$fetch_email = $this->fetch($email_db_fetch);

			if(count($fetch_email) > 0 ){
				$message = ['message'=>"alerady registred"];
				$this->response(200,$message);
			}else{				
				if($this->db->insert($this->table_user,$data)){

					$header = json_encode(['alg'=>'HS256','typ'=>'JWT']);
					$payload = json_encode(['email'=>$email,'password'=>$password]);
					$signature =hash_hmac('sha256',base64_encode($header).'.'.base64_encode($payload), 'abc123',true);
					$base64 = base64_encode($signature);
					$token = base64_encode($header).'.'.base64_encode($payload).'.'.$base64;
					$data = array(
						'name'=>$name,
						'email'=>$email,
						'token'=>$token
					);
					$this->response(200,$data);
				}else{
					$this->response(400);
				}
			}
		}else{
			$this->response(400);
		}
	}

	public function recover(){
		$data = json_decode(file_get_contents('php://input'), true);
		$email = $data['token'];
		echo $email;
	}

	public function fetch($data){
    	$rows=[];
		while($row=mysqli_fetch_assoc($data)){
			$rows[]=$row;
		}
		return $rows;
    }
}
$test = new User();