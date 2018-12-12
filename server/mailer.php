<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __dir__.'/../static/phpmailer/src/Exception.php';
require_once __dir__.'/../static/phpmailer/src/PHPMailer.php';
require_once __dir__.'/../static/phpmailer/src/SMTP.php';

require_once('Database.php');
 class Mailer extends Database{

 	protected $table_user = 'user';

	public function send_mail($token,$email){
    	$mail = new PHPMailer;
		try {
		    //Server settings
		    $mail->isSMTP();                                      // Set mailer to use SMTP
		    $mail->Host        = 'smtp.gmail.com';  // Specify main and backup SMTP servers
		    $mail->SMTPAuth    = true;                               // Enable SMTP authentication
		    $mail->Username    = 'cloudprazol@gmail.com';                 // SMTP username
		    $mail->Password    = 'cloud_prajwol';                           // SMTP password
		    $mail->SMTPSecure  = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
		    $mail->Port        = 465;                                    // TCP port to connect to
		    $mail->SMTPOptions = array(
			    'ssl' => array(
			        'verify_peer'       => false,
			        'verify_peer_name'  => false,
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
		    	return $update;
			}
		} catch (Exception $e) {
		    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
		}	
    }
 }