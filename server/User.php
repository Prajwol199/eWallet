<?php

require_once('Wrapper.php');
require_once('Database.php');
require_once('mailer.php');

class User extends Wrapper{

	protected $table_user='user'; 

	public function __construct(){
        $this->db = Database::instantiate();

        $this->register_route( 'register', array(
            'method'   => 'post',
            'callback' => array( $this, 'register' )
        ));

        $this->register_route( 'login', array(
            'method'   => 'post',
            'callback' => array( $this, 'login' )
        ));

        $this->register_route( 'forgot', array(
            'method'   => 'post',
            'callback' => array( $this, 'forgot' )
        ));

        parent::__construct();
    }

    public function register(){
        $data = json_decode(file_get_contents('php://input'), true);
        $name = $data['name'];
        $email = $data['email'];
        $password = md5($data['password']);
        if( !empty($name) && !empty($email) && !empty($password)){
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
                    $this->response( 200, array(
                        'data' => $data
                    ));
                }else{
                    $this->response(200,array(
                        'message'=>'Some field are empty',
                    ));
                }
            }
        }else{
            $this->response(200,array(
                'message'=>'Some field are empty',
            ));
        }
    }

    public function login(){
        $data = json_decode(file_get_contents('php://input'),true);
        $email = $data['email'];
        $password = md5($data['password']);
        if( !empty($email) && !empty($password)){
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
                $this->response(200,array(
                'message'=>'email and password not matched',
                ));
            }
        }else{
            $this->response(200,array(
                'message'=>'Some field are empty',
            ));
        }
    }

    public function forgot(){
        $data = json_decode(file_get_contents('php://input'), true);
        $email = $data['email'];
        if(!empty($email)){
            $check_email = $this->db->select($this->table_user,['email'],['email'=>$email]);
            if(mysqli_num_rows($check_email)==1){
                $str = ""; $length=6;
                $characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
                $max = count($characters) - 1;
                for ($i = 0; $i < $length; $i++) {
                    $rand = mt_rand(0, $max);
                    $str .= $characters[$rand];
                }
                // str is token
                $mail = new Mailer();
                if($mail->send_mail($str,$email)){
                    $data = array(
                    'email'=>$email,
                    'token'=>$str,
                    'message'=>'Token send successfully'
                    );
                $this->response(200,$data);
                }
            }else{
               $this->response(200,array(
                    'message'=>'Email not found',
                ));
            }
        }else{
        $this->response(200,array(
                'message'=>'Some field are empty',
            ));
        }
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