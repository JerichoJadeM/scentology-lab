<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
 
session_start();
 
if(isset($_POST['send'])){
 
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
 
 
    require '../libraries/PHPMailer/PHPMailer.php'; 
    require '../libraries/PHPMailer/SMTP.php'; 
    require '../libraries/PHPMailer/Exception.php';
 
    $mail = new PHPMailer(true);                            
    try {
        //Server settings
        $mail->isSMTP();                                     
        $mail->Host = 'smtp.gmail.com';                      
        $mail->SMTPAuth = true;                             
        $mail->Username = 'stevenskie9090@gmail.com';
        $mail->Password = 'mcsoingviamkbnel';             
        $mail->SMTPOptions = array(
            'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
            )
        );                         
        $mail->SMTPSecure = 'ssl';          
        $mail->Port = 465;                                   
 
        //Send Email
        $mail->setFrom('stevenskie9090@gmail.com');
 
        //Recipients
        $mail->addAddress('wizardojericho@gmail.com');        
        $mail->addReplyTo('stevenskie9090@gmail.com');
 
        //Content
        $mail->isHTML(true);                                  
        $mail->Subject = $subject . " FROM > " . " Name: " . $name . " Email: " . $email;
        $mail->Body    = $message;
 
        $mail->send();
 
        $_SESSION['message'] = "Hi " . $name . " Your message was successfully sent thank you!";
        $_SESSION['msg_type'] = "danger";
    } catch (Exception $e) {
	    $_SESSION['message'] = "Your message was not sent, please try again.";
        $_SESSION['msg_type'] = "warning";
    }

    header("location: ../contact.php");
}
?>