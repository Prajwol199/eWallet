<?php

require_once('Wrapper.php');
require_once('Database.php');
require_once('Mailer.php');

class User extends Wrapper{

	protected $table_user='user'; 

	public function __construct(){
        $this->db = Database::instantiate();
    }

    public function register(){
        $data     = json_decode(file_get_contents('php://input'), true);
        $name     = $data['name'];
        $email    = $data['email'];
        $password = md5($data['password']);
        if( !empty($name) && !empty($email) && !empty($password)){
            $data=[
                'name'     => $name,
                'email'    => $email,
                'password' => $password
            ];
            $email_db       = array('email');
            $email_db_fetch = $this->db->select($this->table_user,$email_db,array('email'=>"$email"));
            $fetch_email    = $this->fetch($email_db_fetch);

            if(count($fetch_email) > 0 ){
                $message = ['message'=>"alerady registred"];
                $this->response(200,$message);
            }else{              
                if($this->db->insert($this->table_user,$data)){
                    $db_user_id    = $this->db->select($this->table_user,['id'],['email'=>$email,'password'=>$password]);
                    $fetch_user_id = $this->fetch($db_user_id);
                    foreach ($fetch_user_id as $key => $value) {
                        $user_id = $value['id'];
                    }
                    $token = $this->tokenGenerate($email,$password);
                    $data = array(
                        'name'    => $name,
                        'email'   => $email,
                        'token'   => $token,
                        'user_id' => $user_id
                    );
                    $this->response( 200, $data );
                }else{
                    $this->response(200,array(
                        'message' => 'Some field are empty',
                    ));
                }
            }
        }else{
            $this->response(200,array(
                'message' => 'Some field are empty',
            ));
        }
    }

    public function login(){
        $data     = json_decode(file_get_contents('php://input'),true);
        $email    = $data['email'];
        $password = md5($data['password']);
        if( !empty($email) && !empty($password)){
            $condition = [
                'email'    => $email,
                'password' => $password
            ];
            $count = $this->db->select($this->table_user,array('*'),$condition);
            if((mysqli_num_rows($count))==1){
                    $id_db    = $this->db->select($this->table_user,['id'],$condition);
                    $fetch_id = $this->fetch($id_db);
                    foreach ($fetch_id as $key => $value) {
                        $user_id = $value['id'];
                    }
                    $token = $this->tokenGenerate($email,$password);
                $message = [
                    'email'   => $email,
                    'message' => 'Succefully login',
                    'user_id' => $user_id,
                    'token'   => $token
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
        $data  = json_decode(file_get_contents('php://input'), true);
        $email = $data['email'];
        if(!empty($email)){
            $check_email = $this->db->select($this->table_user,['email'],['email'=>$email]);
            if(mysqli_num_rows($check_email) == 1){
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
                        'email'   => $email,
                        'token'   =>$str,
                        'message' => 'Token send successfully'
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

    public function recover(){
        $data     = json_decode(file_get_contents('php://input'), true);
        $password = md5($data['password']);
        $token    = $data['token'];
        $email    = $data['email'];

        $token_db = $this->db->select($this->table_user,['token'],['token'=>$token]);
        $fetch_token = $this->fetch($token_db);
        if(count($fetch_token) == 1 ){
            if($update_password = $this->db->update($this->table_user,['password'=>$password],['email'=>$email])){
               $this->response(200,array(
                    'email'   => $email,
                    'message' => 'Password update successfully',
                )); 
            }else{
                 $this->response(200,array(
                    'message' => 'Error! Update unsuccessful',
                ));
            }
        }else{
            echo "Not found";
        }
    }

    public function tokenGenerate($email,$password){
        $header    = json_encode(['alg'=>'HS256','typ'=>'JWT']);
        $payload   = json_encode(['email'=>$email,'password'=>$password]);
        $signature = hash_hmac('sha256',base64_encode($header).'.'.base64_encode($payload), 'abc123',true);
        $base64    = base64_encode($signature);
        $token     = base64_encode($header).'.'.base64_encode($payload).'.'.$base64;
        return $token;
    }
}
$test = new User();