<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $name    = $_POST['name'];
    $email   = $_POST['email'];   
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'gmailhere';     
        $mail->Password   = 'app password here';       
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        $mail->setFrom($email, $name); 
        $mail->addAddress('gmail here', 'Eman');      
        $mail->addReplyTo($email, $name);                     
        $mail->isHTML(true);
        $mail->Subject = "New Contact Form Submission: $subject";
        $mail->Body    = "
            <h3>You received a new message from your website contact form</h3>
            <p><b>Name:</b> $name</p> 
            <p><b>Email:</b> $email</p>
            <p><b>Subject:</b> $subject</p>
            <p><b>Message:</b><br>$message</p>    
        ";
$mail->send();
        echo "OK"; 
        exit();
    } catch (Exception $e) {
        echo "Mailer Error: " . $mail->ErrorInfo;  
    }
} else {
    echo "Invalid request!";
}

?>
