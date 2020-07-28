<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

function sendEmail($correo,$titulo,$mensaje){

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

$enviado=false;

try {
    //Server settings
   // $mail->SMTPDebug = 2;                   // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'aberbelbuendia@gmail.com';                     // SMTP username
    $mail->Password   = 'mtgiqmzbbjvdtqoy';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('aberbelbuendia@gmail.com', 'A.Berbel');
    $mail->addAddress("$correo", "$correo");     // Add a recipient
    

    // Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = "$titulo";
    $mail->Body    = "$mensaje";
   

    $mail->send();

    $enviado=true;

    echo 'Message has been sent<br>';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
return $enviado;
}

if(sendEmail("salvagi280996@gmail.com","Prueba","Esto es un simulacro")){

    echo "Ha solicitado la recuperación de su contraseña";
}else{
    echo "Ha habido un error en el envio del mensaje. Problamente la direccion de correo enviada es incorrecta";
}




?>