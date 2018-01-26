<?php session_start();

require 'functions.php';

if (isset($_SESSION['user'])) {
	$user = $_SESSION['user'];
} else {
	header("Location: categorias.php");
	$user = "Invitado";
}

if (!isset($_POST['checkout_checkpoint'])) {
	header("Location: carrito.php");
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'script/PHPMailer/src/Exception.php';
require 'script/PHPMailer/src/PHPMailer.php';
require 'script/PHPMailer/src/SMTP.php';

require 'conexion.php';
$iduser = get_user_id($conexion, $user);
$user_data = get_user_data($conexion, $iduser);
$email_user = $user_data['email'];
$nombre_user = $user_data['nombres'];

//CODE...

$codigo = $iduser;

if ($conexion != false) {
	$query = $conexion->prepare("SELECT id, nombre_cat FROM categorias ORDER BY nombre_cat ASC");
	$query->execute();
	$categorias = $query->fetchall();

	$query = $conexion->prepare("SELECT * FROM temporal WHERE id_user = :id_user");
	$query->execute(array(':id_user'=>$iduser));
	$datos_cliente = $query->fetch();

	$id_direccion = $datos_cliente['id_direccion'];
	$codigo .= $id_direccion;
	$id_metodo_pago = $datos_cliente['id_pago'];
	$codigo .= $id_metodo_pago;
	$random_code = rand(0,9);
	$codigo .= $random_code;
	// echo $codigo;

	if (isset($_POST['place_order'])) {
		$unique_code = auto_inc_code();
		$codigo .= $unique_code;
		// echo $unique_code;

		$query = $conexion->prepare("SELECT  * FROM carrito WHERE id_user = :id_user");
		$query->execute(array(':id_user'=>$iduser));
		$productos_carrito = $query->fetchall();

		foreach ($productos_carrito as $producto) {
			$query = $conexion->prepare("INSERT INTO pedidos VALUES (null, :codigo, :id_user, :id_direccion, :id_pago, :id_producto, :cantidad, 0, CURRENT_TIMESTAMP)");
			$query->execute(array(
				':codigo'=>$codigo,
				':id_user'=>$iduser,
				':id_direccion'=>$id_direccion,
				':id_pago'=>$id_metodo_pago,
				':id_producto'=>$producto['id_producto'],
				':cantidad'=>$producto['cantidad']
			));	
		}

		$query = $conexion->prepare("SELECT * FROM pedidos WHERE codigo = :codigo");
		$query->execute(array(':codigo'=>$codigo));
		$check_pedido = $query->fetch();

		if ($check_pedido != false) {
			$query = $conexion->prepare("DELETE FROM carrito WHERE id_user = :id_user");
			$query->execute(array(':id_user'=>$iduser));
		}

		$query = $conexion->prepare("DELETE FROM temporal WHERE id_user = :iduser");
		$query->execute(array(':iduser' => $iduser));

		//Enviar email de confirmacion de pedido
		$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
		
		try {
		    //Server settings
		    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
		    // $mail->isSMTP();                                      // Set mailer to use SMTP
		    $mail->Host = 'mail.arteataco.dx.am';  // Specify main and backup SMTP servers
		    $mail->SMTPAuth = true;                               // Enable SMTP authentication
		    $mail->Username = 'consultas@arteataco.dx.am';                 // SMTP username
		    $mail->Password = 'arteataco10';                           // SMTP password
		    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
		    $mail->Port = 465;                                    // TCP port to connect to

		    //Recipients
		    $mail->setFrom('arte.ataco@gmail.com', 'Arte Ataco');
		    // $mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
		    $mail->addAddress($email_user, $nombre_user);               // Name is optional
		    $mail->addReplyTo('arte.ataco@gmail.com', 'Nuevo pedido');
		    // $mail->addCC('cc@example.com');
		    // $mail->addBCC('bcc@example.com');

		    //Attachments
		    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

		    //Content
		    $mail->isHTML(true);                                  // Set email format to HTML
		    $mail->Subject = 'Su pedido ' . '#' . $codigo . 'ha sido tomado';
		    $mail->Body    = "Puede visitar la sección <Pedidos> en <arteataco.onlinewebshop.net> para ver los detalles";
		    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		    $mail->send();
		    // echo 'Message has been sent';
		    header("Location: mensaje_sent.php");
		} catch (Exception $e) {
		    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
		}

		setcookie("order_placed_ckp", true);

		header('Location: order_placed.php');
	}
}

require 'views/pago.view.php';

?>