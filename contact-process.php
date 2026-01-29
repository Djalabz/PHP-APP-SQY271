<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader (created by composer, not included with PHPMailer)
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'Votre mail';                     //SMTP username
    $mail->Password   = 'Votre mdp';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('email du user', 'nom du user');
    $mail->addAddress('Votre mail ici', 'Romain Jalabert');     //Add a recipient


    //Content
    $mail->Subject = 'Sujet récuperé via le form de contact';
    $mail->Body    = 'Meme chose pour le body';

    $mail->send();

    echo 'Le mail a bien été envoyé !';

} catch (Exception $e) {

    echo "Le message n'a pas pu etre envoyé : {$mail->ErrorInfo}";

}