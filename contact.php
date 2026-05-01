<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CJED-Coopérative Jeunes Entrepreneurs Dynamiques</title>
    <link rel="icon" href="Images/Logo1.jpg">
</head>

<?php

$name=$_POST['Nom'];
$surname=$_POST['Prenom'];
$object=$_POST['Objet'];
$mail=$_POST['Email'];
$message=$_POST['Message'];

$content = "
    <html>
    <head>
        <title>Nouveau formulaire</title>
    </head>
    <body>
        <h2>Informations de contact :</h2>
        <p><strong>Nom :</strong> $name</p>
        <p><strong>Prenom :</strong> $surname</p>
        <p><strong>Mail :</strong> $mail</p>
        <p><strong>Objet :</strong> $object</p>
        <p><strong>Message :</strong></p>
        <p>$message</p>
    </body>
    </html>
";

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();                                            //Send using SM
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'ngalenal1004@gmail.com';                     //SMTP username
    $mail->Password   = 'kgpkmzmrkwqifduf';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('from@example.com', 'Contact');
    $mail->addAddress('contact@cjed-gabon.com');     

    //Content
    $mail->isHTML(true);                                  
    $mail->Subject = 'Nouveau formulaire';
    $mail->Body    = $content;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Votre message a bien été envoyé, vous pouvez retournez sur la page précédente';
} catch (Exception $e) {
    echo "Votre message n'a pu être envoyé. Revoyez les informations saisies: {$mail->ErrorInfo}";
}