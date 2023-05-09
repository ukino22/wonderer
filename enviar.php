<?php

include("Mailer/src/PHPMailer.php"); //Renombrar la carpeta PHPmAILER por Mailer
include("Mailer/src/Exception.php"); //https://github.com/PHPMailer/PHPMailer
include("Mailer/src/SMTP.php");

try {

    $fromemail = $_POST['email'];
    $fromname = $_POST['nombre'];
    $subject = "Correo desde web page WONDERER";
    $mensa = $_POST['mensaje'];
    $host = "smtp.gmail.com";
    $port = "587";
    $SMTPAuth = "login";
    $SMTPSecure = "tls;";
    $username = "@gmail.com";
    $password = "";

    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->isSMTP();
    $mail->SMTPDebug = 0; //Poner "0" para no ejecutar el debug
    $mail->Host = $host;
    $mail->Port = $port;
    $mail->SMTPAuth = $SMTPAuth; //para hacerse identificar por SMTP 
    $mail->SMTPSecure = $SMTPSecure; //protocolo de encriptación por el cual se va a enviar Tra
    $mail->Username = $username;
    $mail->Password = $password;
    $mail->setFrom($fromemail, $fromname);

    //DESTINATARIO
    $mail->addAddress($username);

    //ASUNTO
    $mail->isHTML(true);
    $mail->Subject = $subject;

    //CUERPO DEL EMAIL
$mensaje = nl2br("Este mesaje fue enviado por " . $fromname . "\n");
$mensaje .= nl2br("Su e-mail es: " . $fromemail . "\n");
$mensaje .= nl2br("Mensaje: " . $mensa . "\n");
$mensaje .= "Enviado el " . date('d/m/Y', time());
$mail->Body = $mensaje;

if(!$mail->send()){
    error_log("MAILER: No se pude enviar el correo");
    echo("MAILER: No se pude enviar el correo");
    die();
}
//echo("Correo enviado con éxito"); die(); //Esta línea habrá que sacar o comentar para acceder
header('Location: contacto-02.html');
}catch(Exception $e) {
    echo("Alguna instrucción de PHPMailer no se pudo llevar a cabo" + $e);

}
//Fuente : https://www.youtube.com/watch?v=EdtdUr6ENak
?>