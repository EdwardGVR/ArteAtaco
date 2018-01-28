<?php

if (!isset($_SESSION['user'])) {
	session_start();
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'script/PHPMailer/src/Exception.php';
require 'script/PHPMailer/src/PHPMailer.php';
require 'script/PHPMailer/src/SMTP.php';

require 'functions.php';
require 'conexion.php';

if (isset($_SESSION['user'])) {
	$user = $_SESSION['user'];
	$iduser = get_user_id($conexion, $user);
} else {
	$user = 'Invitado';
	$iduser = false;
}

if ($conexion != false) {
	$query = $conexion->prepare('SELECT * FROM categorias ORDER BY nombre_cat ASC');
	$query->execute();
	$categorias = $query->fetchall();

	//print_r($categorias);

	$user_nombre = get_user_data($conexion, $iduser)['nombres'];
	$user_mail = get_user_data($conexion, $iduser)['email'];

	if (isset($_POST['contacto_enviar'])) {
		$producto = $_POST['producto'];
		$mensaje = htmlspecialchars($_POST['contacto_mensaje']);
		$usuario_nombre = $_POST['contacto_nombre'];
		$usuario_correo = $_POST['contacto_correo'];

		// $to = 'edwardgvr414@gmail.com';
		// $subject = 'Consulta' .$producto .'Arte Ataco';
		// $message = $usuario_nombre ."\r" .$usuario_correo;
		$message .= $mensaje;

		// mail($to, $subject, $message);

		$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
		
		try {
		    //Server settings
		    $mail->SMTPDebug = 1;                                 // Enable verbose debug output
		    $mail->isSMTP();                                      // Set mailer to use SMTP
		    $mail->Host = 'mail.arteataco.dx.am';  // Specify main and backup SMTP servers
		    $mail->SMTPAuth = true;                               // Enable SMTP authentication
		    $mail->Username = 'consultas@arteataco.dx.am';                 // SMTP username
		    $mail->Password = 'arteataco10';                           // SMTP password
		    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
		    $mail->Port = 465;                                    // TCP port to connect to

		    //Recipients
		    $mail->setFrom($usuario_correo, $usuario_nombre);
		    // $mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
		    $mail->addAddress('arte.ataco@gmail.com', 'Consultas Arte Ataco');               // Name is optional
		    // $mail->addReplyTo('info@example.com', 'Information');
		    // $mail->addCC('cc@example.com');
		    // $mail->addBCC('bcc@example.com');

		    //Attachments
		    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

		    //Content
		    $mail->isHTML(true);                                  // Set email format to HTML
		    $mail->Subject = $usuario_nombre . ' consulta sobre: ' . $producto;
		    $mail->Body    = "<b>Mensaje:</b>" . "\r\n" . $message;
		    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		    $mail->send();
		    // echo 'Message has been sent';
		    header("Location: mensaje_sent.php");
		} catch (Exception $e) {
		    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
		}
	}
}

require 'views/contacto_view.php';

?>