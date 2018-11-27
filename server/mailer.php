<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __dir__.'/../static/phpmailer/src/Exception.php';
require_once __dir__.'/../static/phpmailer/src/PHPMailer.php';
require_once __dir__.'/../static/phpmailer/src/SMTP.php';

require_once('Database.php');
 class Mailer extends Database{

 	protected $table_user='user';

 	public function sendmail(){
 		$data = json_decode(file_get_contents('php://input'), true);
		$email = $data['email'];
		if(!empty($email)){
			$check_email = $this->select($this->table_user,['email'],['email'=>$email]);
			if(mysqli_num_rows($check_email)==1){
				$token = $this->randomString();
				$this->randPassword($token,$email);
			}else{
				$this->response(400);
			}
		}
 	}

 	public function randPassword($token,$email){
    	$mail = new PHPMailer;
		try {
		    //Server settings
		    $mail->isSMTP();                                      // Set mailer to use SMTP
		    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
		    $mail->SMTPAuth = true;                               // Enable SMTP authentication
		    $mail->Username = 'cloudprazol@gmail.com';                 // SMTP username
		    $mail->Password = 'cloud_prajwol';                           // SMTP password
		    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
		    $mail->Port = 465;                                    // TCP port to connect to
		    $mail->SMTPOptions = array(
			    'ssl' => array(
			        'verify_peer' => false,
			        'verify_peer_name' => false,
			        'allow_self_signed' => true
			    	)
				);
	 		//Recipients
		    $mail->setFrom('cloudprazol@gmail.com', '');
		    $mail->addAddress($email);
		    //Content
		    $mail->isHTML(true);                                  // Set email format to HTML
		    $mail->Subject = 'Password Recovery';
		    $mail->Body    = 'Enter the token <b>'. $token.'</b> on web browser and change your password';
		    if($mail->send()) {
		    	$update = $this->update($this->table_user,['token'=>$token],['email'=>$email]);
		    	$data = array(
		    		'email'=>$email,
		    		'token'=>$token,
		    		'message'=>'Token send successfully'
		    	);
		    	$this->response(200,$data);
			}
		} catch (Exception $e) {
		    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
		}	
    }


 	public function randomString($length = 6) {
		$str = "";
		$characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
		$max = count($characters) - 1;
		for ($i = 0; $i < $length; $i++) {
			$rand = mt_rand(0, $max);
			$str .= $characters[$rand];
		}
		return $str;
	}

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

 $mail = new Mailer();
 $mail->sendmail();