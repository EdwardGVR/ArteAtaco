<?php session_start();

if (isset($_SESSION['user'])) {
	$user = $_SESSION['user'];
} else {
	header("Location: categorias.php");
	$user = "Invitado";
}

// if (!isset($_COOKIE["checkoutCheckpoint"])) {
// 	header("Location: checkout.php");
// } else {
// 	setcookie("checkoutCheckpoint", "", time()-3600);
// }

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'script/PHPMailer/src/Exception.php';
require 'script/PHPMailer/src/PHPMailer.php';
require 'script/PHPMailer/src/SMTP.php';
require 'functions.php';
require 'conexion.php';

$iduser = get_user_id($conexion, $user);
$user_data = get_user_data($conexion, $iduser);
$email_user = $user_data['email'];
$nombre_user = $user_data['nombres'];
$codigo = $iduser;	

if ($conexion != false) {
	// Obtener las categorias
	$query = $conexion->prepare("
		SELECT id, nombre_cat 
		FROM categorias 
		WHERE status = 1
		ORDER BY nombre_cat ASC");
	$query->execute();
	$categorias = $query->fetchall();

	// Iniciar generacion de codigo
	$id_direccion = $_COOKIE["dirSelected"];
	$codigo .= $id_direccion;
	$id_metodo_pago = $_COOKIE["pagoSelected"];
	$codigo .= $id_metodo_pago;
	$random_code = rand(0,9);
	$codigo .= $random_code;

	// Comprobar estado de direccion y metodo de pago
	$query = $conexion->prepare("SELECT estado FROM direcciones WHERE id = :id");
	$query->execute(array(':id' => $_COOKIE["dirSelected"]));
	$dirStat = $query->fetch();
	$dirStat = $dirStat[0];

	$query = $conexion->prepare("SELECT status FROM metodos_pago WHERE id = :id");
	$query->execute(array(':id' => $_COOKIE["pagoSelected"]));
	$payStat = $query->fetch();
	$payStat = $payStat[0];

	// Obtener datos del metodo de pago
	$query = $conexion->prepare("
		SELECT 	datos_metodos_pago.dato,
				datos_metodos_pago.valor
		FROM datos_metodos_pago 
		WHERE datos_metodos_pago.id_metodo_pago = :id
	");
	$query->execute(array(':id' => $_COOKIE['pagoSelected']));
	$datosMethod = $query->fetchall();

	$query = $conexion->prepare("SELECT * FROM metodos_pago WHERE id = :id");
	$query->execute(array(':id' => $_COOKIE["pagoSelected"]));
	$infoMethod = $query->fetch();

	if ($dirStat == 0 || $payStat == 0) {
		header("Location: checkout.php");
	}

	// Comprobar tipo de direccion
	$query = $conexion->prepare("SELECT id_tipo FROM direcciones WHERE id = :idDireccion");
	$query->execute(array(':idDireccion'=>$id_direccion));
	$tipoDireccion = $query->fetch();
	$tipoDireccion = $tipoDireccion['id_tipo'];

	if ($tipoDireccion == 1) {
		$query = $conexion->prepare("
			SELECT departamentos.costo_envio FROM direcciones
			JOIN departamentos ON direcciones.id_departamento = departamentos.id
			WHERE direcciones.id = :idDireccion
		");
		$query->execute(array(':idDireccion'=>$id_direccion));
		$costoEnvio = $query->fetch();
		$costoEnvio = $costoEnvio[0];
	} elseif ($tipoDireccion == 2) {
		$query = $conexion->prepare("SELECT costo FROM direcciones WHERE id = :idDireccion");
		$query->execute(array(':idDireccion'=>$id_direccion));
		$costoEnvio = $query->fetch();
		$costoEnvio = $costoEnvio[0];
	}

	if ($costoEnvio == 0) {
		$shippShown = "Gratis";
	} else {
		$shippShown = "$" . number_format($costoEnvio, 2);
	}

	$unique_code = auto_inc_code();
	$codigo .= $unique_code;

	// Obtener productos del carrito
	$query = $conexion->prepare("
		SELECT carrito.*, productos.precio FROM carrito 
		JOIN productos ON carrito.id_producto = productos.id
		WHERE carrito.id_user = :id_user
	");
	$query->execute(array(':id_user'=>$iduser));
	$productos_carrito = $query->fetchall();

	// Generar sub-total
	$subtotal = 0;
	foreach ($productos_carrito as $pc) {
		$subtotal += $pc['precio'] * $pc['cantidad'];
	}

	$subtotal = number_format($subtotal, 2);

	$total = number_format($subtotal + $costoEnvio, 2);

	if (isset($_POST['place_order'])) {
		// $unique_code = auto_inc_code();
		// $codigo .= $unique_code;

		// foreach ($productos_carrito as $producto) {
		// 	$query = $conexion->prepare("
		// 		INSERT INTO pedidos 
		// 		VALUES (null, :codigo, :id_user, :id_direccion, :id_pago, :id_producto, :cantidad, :precioCompra, :costoEnvioCompra, 1, CURRENT_TIMESTAMP)
		// 	");
		// 	$query->execute(array(
		// 		':codigo'=>$codigo,
		// 		':id_user'=>$iduser,
		// 		':id_direccion'=>$id_direccion,
		// 		':id_pago'=>$id_metodo_pago,
		// 		':id_producto'=>$producto['id_producto'],
		// 		':cantidad'=>$producto['cantidad'],
		// 		':precioCompra'=>$producto['precio'],
		// 		':costoEnvioCompra'=>$costoEnvio
		// 	));	
		// }
		
		// $query = $conexion->prepare("SELECT * FROM pedidos WHERE codigo = :codigo");
		// $query->execute(array(':codigo'=>$codigo));
		// $check_pedido = $query->fetch();

		// if ($check_pedido != false) {
		// 	$query = $conexion->prepare("DELETE FROM carrito WHERE id_user = :id_user");
		// 	$query->execute(array(':id_user'=>$iduser));

		// 	setcookie("checkoutCheckpoint", "", time()-3600);
		// 	unset($_COOKIE['checkoutCheckpoint']);
		// }

		/*
		//Enviar email de confirmacion de pedido
		$mail = new PHPMailer(true);                              		// Passing `true` enables exceptions
		
		try {
		    //Server settings
		    $mail->SMTPDebug = 2;										// Enable verbose debug output
		    // $mail->isSMTP();											// Set mailer to use SMTP
		    $mail->Host = 'mail.arteataco.dx.am';  						// Specify main and backup SMTP servers
		    $mail->SMTPAuth = true;                               		// Enable SMTP authentication
		    $mail->Username = 'consultas@arteataco.dx.am';          	// SMTP username
		    $mail->Password = 'arteataco10';                        	// SMTP password
		    $mail->SMTPSecure = 'ssl';                            		// Enable TLS encryption, `ssl` also accepted
		    $mail->Port = 465;                                    		// TCP port to connect to

		    //Recipients
		    $mail->setFrom('arte.ataco@gmail.com', 'Arte Ataco');
		    // $mail->addAddress('joe@example.net', 'Joe User');     	// Add a recipient
		    $mail->addAddress($email_user, $nombre_user);            	// Name is optional
		    $mail->addReplyTo('arte.ataco@gmail.com', 'Nuevo pedido');
		    // $mail->addCC('cc@example.com');
		    // $mail->addBCC('bcc@example.com');

		    //Attachments
		    // $mail->addAttachment('/var/tmp/file.tar.gz');         	// Add attachments
		    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    	// Optional name

		    //Content
		    $mail->isHTML(true);                                  		// Set email format to HTML
		    $mail->Subject = 'Su pedido ' . '#' . $codigo . 'ha sido tomado';
		    $mail->Body    = "Puede visitar la sección <Pedidos> en <arteataco.onlinewebshop.net> para ver los detalles";
		    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		    $mail->send();
		    // echo 'Message has been sent';
		    // header("Location: mensaje_sent.php");
		} catch (Exception $e) {
		    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
		}
		*/
		
		// setcookie("order_placed_ckp", true);
		
		// header('Location: order_placed.php');

		$to = $email_user;

		$subject = "Confirmaci&oacute;n de pedido #$codigo";

		$headers = "From: Arte Ataco<arteataco@gmail.com>" . "\r\n";
		$headers .= "Reply-To: arteataco@gmail.com" . "\r\n";
		$headers .= "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
		$headers .= "Bcc: arteataco@gmail.com" . "\r\n";

		$message = "
		<!DOCTYPE HTML PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional //EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\"><html xmlns=\"http://www.w3.org/1999/xhtml\" xmlns:v=\"urn:schemas-microsoft-com:vml\" xmlns:o=\"urn:schemas-microsoft-com:office:office\"><head>
		<!--[if gte mso 9]><xml>
		 <o:OfficeDocumentSettings>
		  <o:AllowPNG/>
		  <o:PixelsPerInch>96</o:PixelsPerInch>
		 </o:OfficeDocumentSettings>
		</xml><![endif]-->
		<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
		<meta name=\"viewport\" content=\"width=device-width\">
		<!--[if !mso]><!--><meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\"><!--<![endif]-->
		<title></title>
		
		
		<style type=\"text/css\" id=\"media-query\">
		  body {
	  margin: 0;
	  padding: 0; }
	
	table, tr, td {
	  vertical-align: top;
	  border-collapse: collapse; }
	
	.ie-browser table, .mso-container table {
	  table-layout: fixed; }
	
	* {
	  line-height: inherit; }
	
	a[x-apple-data-detectors=true] {
	  color: inherit !important;
	  text-decoration: none !important; }
	
	[owa] .img-container div, [owa] .img-container button {
	  display: block !important; }
	
	[owa] .fullwidth button {
	  width: 100% !important; }
	
	[owa] .block-grid .col {
	  display: table-cell;
	  float: none !important;
	  vertical-align: top; }
	
	.ie-browser .num12, .ie-browser .block-grid, [owa] .num12, [owa] .block-grid {
	  width: 600px !important; }
	
	.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {
	  line-height: 100%; }
	
	.ie-browser .mixed-two-up .num4, [owa] .mixed-two-up .num4 {
	  width: 200px !important; }
	
	.ie-browser .mixed-two-up .num8, [owa] .mixed-two-up .num8 {
	  width: 400px !important; }
	
	.ie-browser .block-grid.two-up .col, [owa] .block-grid.two-up .col {
	  width: 300px !important; }
	
	.ie-browser .block-grid.three-up .col, [owa] .block-grid.three-up .col {
	  width: 200px !important; }
	
	.ie-browser .block-grid.four-up .col, [owa] .block-grid.four-up .col {
	  width: 150px !important; }
	
	.ie-browser .block-grid.five-up .col, [owa] .block-grid.five-up .col {
	  width: 120px !important; }
	
	.ie-browser .block-grid.six-up .col, [owa] .block-grid.six-up .col {
	  width: 100px !important; }
	
	.ie-browser .block-grid.seven-up .col, [owa] .block-grid.seven-up .col {
	  width: 85px !important; }
	
	.ie-browser .block-grid.eight-up .col, [owa] .block-grid.eight-up .col {
	  width: 75px !important; }
	
	.ie-browser .block-grid.nine-up .col, [owa] .block-grid.nine-up .col {
	  width: 66px !important; }
	
	.ie-browser .block-grid.ten-up .col, [owa] .block-grid.ten-up .col {
	  width: 60px !important; }
	
	.ie-browser .block-grid.eleven-up .col, [owa] .block-grid.eleven-up .col {
	  width: 54px !important; }
	
	.ie-browser .block-grid.twelve-up .col, [owa] .block-grid.twelve-up .col {
	  width: 50px !important; }
	
	@media only screen and (min-width: 620px) {
	  .block-grid {
		width: 600px !important; }
	  .block-grid .col {
		vertical-align: top; }
		.block-grid .col.num12 {
		  width: 600px !important; }
	  .block-grid.mixed-two-up .col.num4 {
		width: 200px !important; }
	  .block-grid.mixed-two-up .col.num8 {
		width: 400px !important; }
	  .block-grid.two-up .col {
		width: 300px !important; }
	  .block-grid.three-up .col {
		width: 200px !important; }
	  .block-grid.four-up .col {
		width: 150px !important; }
	  .block-grid.five-up .col {
		width: 120px !important; }
	  .block-grid.six-up .col {
		width: 100px !important; }
	  .block-grid.seven-up .col {
		width: 85px !important; }
	  .block-grid.eight-up .col {
		width: 75px !important; }
	  .block-grid.nine-up .col {
		width: 66px !important; }
	  .block-grid.ten-up .col {
		width: 60px !important; }
	  .block-grid.eleven-up .col {
		width: 54px !important; }
	  .block-grid.twelve-up .col {
		width: 50px !important; } }
	
	@media (max-width: 620px) {
	  .block-grid, .col {
		min-width: 320px !important;
		max-width: 100% !important;
		display: block !important; }
	  .block-grid {
		width: calc(100% - 40px) !important; }
	  .col {
		width: 100% !important; }
		.col > div {
		  margin: 0 auto; }
	  img.fullwidth, img.fullwidthOnMobile {
		max-width: 100% !important; }
	  .no-stack .col {
		min-width: 0 !important;
		display: table-cell !important; }
	  .no-stack.two-up .col {
		width: 50% !important; }
	  .no-stack.mixed-two-up .col.num4 {
		width: 33% !important; }
	  .no-stack.mixed-two-up .col.num8 {
		width: 66% !important; }
	  .no-stack.three-up .col.num4 {
		width: 33% !important; }
	  .no-stack.four-up .col.num3 {
		width: 25% !important; }
	  .mobile_hide {
		min-height: 0px;
		max-height: 0px;
		max-width: 0px;
		display: none;
		overflow: hidden;
		font-size: 0px; } }
	
		</style>
	</head>
	<body class=\"clean-body\" style=\"margin: 0;padding: 0;-webkit-text-size-adjust: 100%;background-color: #303A61\">
	  <style type=\"text/css\" id=\"media-query-bodytag\">
		@media (max-width: 520px) {
		  .block-grid {
			min-width: 320px!important;
			max-width: 100%!important;
			width: 100%!important;
			display: block!important;
		  }
	
		  .col {
			min-width: 320px!important;
			max-width: 100%!important;
			width: 100%!important;
			display: block!important;
		  }
	
			.col > div {
			  margin: 0 auto;
			}
	
		  img.fullwidth {
			max-width: 100%!important;
		  }
				img.fullwidthOnMobile {
			max-width: 100%!important;
		  }
		  .no-stack .col {
					min-width: 0!important;
					display: table-cell!important;
				}
				.no-stack.two-up .col {
					width: 50%!important;
				}
				.no-stack.mixed-two-up .col.num4 {
					width: 33%!important;
				}
				.no-stack.mixed-two-up .col.num8 {
					width: 66%!important;
				}
				.no-stack.three-up .col.num4 {
					width: 33%!important;
				}
				.no-stack.four-up .col.num3 {
					width: 25%!important;
				}
		  .mobile_hide {
			min-height: 0px!important;
			max-height: 0px!important;
			max-width: 0px!important;
			display: none!important;
			overflow: hidden!important;
			font-size: 0px!important;
		  }
		}
	  </style>
	  <!--[if IE]><div class=\"ie-browser\"><![endif]-->
	  <!--[if mso]><div class=\"mso-container\"><![endif]-->
	  <table class=\"nl-container\" style=\"border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 320px;Margin: 0 auto;background-color: #303A61;width: 100%\" cellpadding=\"0\" cellspacing=\"0\">
		<tbody>
		<tr style=\"vertical-align: top\">
			<td style=\"word-break: break-word;border-collapse: collapse !important;vertical-align: top\">
		<!--[if (mso)|(IE)]><table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr><td align=\"center\" style=\"background-color: #303A61;\"><![endif]-->
	
		<div style=\"background-color:transparent;\">
		  <div style=\"Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #303A61;\" class=\"block-grid \">
			<div style=\"border-collapse: collapse;display: table;width: 100%;background-color:#303A61;\">
			  <!--[if (mso)|(IE)]><table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr><td style=\"background-color:transparent;\" align=\"center\"><table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"width: 600px;\"><tr class=\"layout-full-width\" style=\"background-color:#303A61;\"><![endif]-->
	
				  <!--[if (mso)|(IE)]><td align=\"center\" width=\"600\" style=\" width:600px; padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;\" valign=\"top\"><![endif]-->
				<div class=\"col num12\" style=\"min-width: 320px;max-width: 600px;display: table-cell;vertical-align: top;\">
				  <div style=\"background-color: transparent; width: 100% !important;\">
				  <!--[if (!mso)&(!IE)]><!--><div style=\"border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;\"><!--<![endif]-->
	
					  
						<div align=\"center\" class=\"img-container center  autowidth  fullwidth \" style=\"padding-right: 20px;  padding-left: 20px;\">
	<!--[if mso]><table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr style=\"line-height:0px;line-height:0px;\"><td style=\"padding-right: 20px; padding-left: 20px;\" align=\"center\"><![endif]-->
	<div style=\"line-height:20px;font-size:1px\">&#160;</div>  <a href=\"https://arteataco.000webhostapp.com\" target=\"_blank\">
		<img class=\"center  autowidth  fullwidth\" align=\"center\" border=\"0\" src=\"https://arteataco.000webhostapp.com/images/b44e80da-e66c-4341-9d06-1fd88d680109.png\" alt=\"Arte Ataco\" title=\"Arte Ataco\" style=\"outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: none;height: auto;float: none;width: 100%;max-width: 560px\" width=\"560\">
	  </a>
	<div style=\"line-height:20px;font-size:1px\">&#160;</div><!--[if mso]></td></tr></table><![endif]-->
	</div>
	
					  
				  <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
				  </div>
				</div>
			  <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
			</div>
		  </div>
		</div>
		<div style=\"background-color:#303A61;\">
		  <div style=\"Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #303A61;\" class=\"block-grid \">
			<div style=\"border-collapse: collapse;display: table;width: 100%;background-color:#303A61;\">
			  <!--[if (mso)|(IE)]><table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr><td style=\"background-color:#303A61;\" align=\"center\"><table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"width: 600px;\"><tr class=\"layout-full-width\" style=\"background-color:#303A61;\"><![endif]-->
	
				  <!--[if (mso)|(IE)]><td align=\"center\" width=\"600\" style=\" width:600px; padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;\" valign=\"top\"><![endif]-->
				<div class=\"col num12\" style=\"min-width: 320px;max-width: 600px;display: table-cell;vertical-align: top;\">
				  <div style=\"background-color: transparent; width: 100% !important;\">
				  <!--[if (!mso)&(!IE)]><!--><div style=\"border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;\"><!--<![endif]-->
	
					  
						<div class=\"\">
		<!--[if mso]><table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr><td style=\"padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px;\"><![endif]-->
		<div style=\"color:#555555;line-height:120%;font-family:Arial, 'Helvetica Neue', Helvetica, sans-serif; padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px;\">	
			<div style=\"font-size:12px;line-height:14px;color:#555555;font-family:Arial, 'Helvetica Neue', Helvetica, sans-serif;text-align:left;\"><p style=\"margin: 0;font-size: 14px;line-height: 17px;text-align: center\"><span style=\"font-size: 38px; line-height: 45px; color: rgb(255, 255, 255);\"><strong><span style=\"line-height: 45px; font-size: 38px;\">Gracias por hacer su pedido!</span></strong></span></p></div>	
		</div>
		<!--[if mso]></td></tr></table><![endif]-->
	</div>
					  
				  <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
				  </div>
				</div>
			  <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
			</div>
		  </div>
		</div>
		<div style=\"background-color:#303A61;\">
		  <div style=\"Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #303A61;\" class=\"block-grid \">
			<div style=\"border-collapse: collapse;display: table;width: 100%;background-color:#303A61;\">
			  <!--[if (mso)|(IE)]><table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr><td style=\"background-color:#303A61;\" align=\"center\"><table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"width: 600px;\"><tr class=\"layout-full-width\" style=\"background-color:#303A61;\"><![endif]-->
	
				  <!--[if (mso)|(IE)]><td align=\"center\" width=\"600\" style=\" width:600px; padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;\" valign=\"top\"><![endif]-->
				<div class=\"col num12\" style=\"min-width: 320px;max-width: 600px;display: table-cell;vertical-align: top;\">
				  <div style=\"background-color: transparent; width: 100% !important;\">
				  <!--[if (!mso)&(!IE)]><!--><div style=\"border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;\"><!--<![endif]-->
	
					  
						<div class=\"\">
		<!--[if mso]><table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr><td style=\"padding-right: 20px; padding-left: 20px; padding-top: 20px; padding-bottom: 10px;\"><![endif]-->
		<div style=\"color:#FFFFFF;font-family:Arial, 'Helvetica Neue', Helvetica, sans-serif;line-height:150%; padding-right: 20px; padding-left: 20px; padding-top: 20px; padding-bottom: 10px;\">	
			<div style=\"font-size:12px;line-height:18px;color:#FFFFFF;font-family:Arial, 'Helvetica Neue', Helvetica, sans-serif;text-align:left;\"><p style=\"margin: 0;font-size: 14px;line-height: 21px;text-align: center\"><span style=\"font-size: 24px; line-height: 36px;\"><span style=\"line-height: 36px; font-size: 24px;\">Estamos preparando su orden </span></span><span style=\"font-size: 24px; line-height: 36px;\"><span style=\"line-height: 36px; font-size: 24px;\"><strong>#$codigo</strong><br></span></span></p></div>
		</div>
		<!--[if mso]></td></tr></table><![endif]-->
	</div>
					  
				  <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
				  </div>
				</div>
			  <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
			</div>
		  </div>
		</div>
		<div style=\"background-color:transparent;\">
		  <div style=\"Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #303A61;\" class=\"block-grid \">
			<div style=\"border-collapse: collapse;display: table;width: 100%;background-color:#303A61;\">
			  <!--[if (mso)|(IE)]><table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr><td style=\"background-color:transparent;\" align=\"center\"><table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"width: 600px;\"><tr class=\"layout-full-width\" style=\"background-color:#303A61;\"><![endif]-->
	
				  <!--[if (mso)|(IE)]><td align=\"center\" width=\"600\" style=\" width:600px; padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;\" valign=\"top\"><![endif]-->
				<div class=\"col num12\" style=\"min-width: 320px;max-width: 600px;display: table-cell;vertical-align: top;\">
				  <div style=\"background-color: transparent; width: 100% !important;\">
				  <!--[if (!mso)&(!IE)]><!--><div style=\"border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;\"><!--<![endif]-->
	
					  
						<div class=\"\">
		<!--[if mso]><table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr><td style=\"padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px;\"><![endif]-->
		<div style=\"color:#555555;line-height:120%;font-family:Arial, 'Helvetica Neue', Helvetica, sans-serif; padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px;\">	
			<div style=\"font-size:12px;line-height:14px;color:#555555;font-family:Arial, 'Helvetica Neue', Helvetica, sans-serif;text-align:left;\"><p style=\"margin: 0;font-size: 14px;line-height: 17px;text-align: center\"><span style=\"color: rgb(255, 255, 255); font-size: 14px; line-height: 16px;\"><em><span style=\"font-size: 20px; line-height: 24px;\"><span style=\"font-size: 16px; line-height: 19px;\">Puede revisar el estado del pedido en el siguiente enlace:</span><br></span></em></span></p></div>	
		</div>
		<!--[if mso]></td></tr></table><![endif]-->
	</div>
					  
				  <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
				  </div>
				</div>
			  <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
			</div>
		  </div>
		</div>
		<div style=\"background-color:#303A61;\">
		  <div style=\"Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #303A61;\" class=\"block-grid \">
			<div style=\"border-collapse: collapse;display: table;width: 100%;background-color:#303A61;\">
			  <!--[if (mso)|(IE)]><table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr><td style=\"background-color:#303A61;\" align=\"center\"><table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"width: 600px;\"><tr class=\"layout-full-width\" style=\"background-color:#303A61;\"><![endif]-->
	
				  <!--[if (mso)|(IE)]><td align=\"center\" width=\"600\" style=\" width:600px; padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;\" valign=\"top\"><![endif]-->
				<div class=\"col num12\" style=\"min-width: 320px;max-width: 600px;display: table-cell;vertical-align: top;\">
				  <div style=\"background-color: transparent; width: 100% !important;\">
				  <!--[if (!mso)&(!IE)]><!--><div style=\"border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;\"><!--<![endif]-->
	
					  
						
	<div align=\"center\" class=\"button-container center \" style=\"padding-right: 20px; padding-left: 20px; padding-top:10px; padding-bottom:25px;\">
	  <!--[if mso]><table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"border-spacing: 0; border-collapse: collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;\"><tr><td style=\"padding-right: 20px; padding-left: 20px; padding-top:10px; padding-bottom:25px;\" align=\"center\"><v:roundrect xmlns:v=\"urn:schemas-microsoft-com:vml\" xmlns:w=\"urn:schemas-microsoft-com:office:word\" href=\"https://arteataco.000webhostapp.com/pedidos.php\" style=\"height:51pt; v-text-anchor:middle; width:117pt;\" arcsize=\"6%\" strokecolor=\"#FFFFFF\" fillcolor=\"#FFFFFF\"><w:anchorlock/><v:textbox inset=\"0,0,0,0\"><center style=\"color:#27294A; font-family:Arial, 'Helvetica Neue', Helvetica, sans-serif; font-size:24px;\"><![endif]-->
		<a href=\"https://arteataco.000webhostapp.com/pedidos.php\" target=\"_blank\" style=\"display: block;text-decoration: none;-webkit-text-size-adjust: none;text-align: center;color: #27294A; background-color: #FFFFFF; border-radius: 4px; -webkit-border-radius: 4px; -moz-border-radius: 4px; max-width: 157px; width: 107px;width: auto; border-top: 0px solid transparent; border-right: 0px solid transparent; border-bottom: 0px solid transparent; border-left: 0px solid transparent; padding-top: 10px; padding-right: 25px; padding-bottom: 10px; padding-left: 25px; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;mso-border-alt: none\">
		  <span style=\"font-size:12px;line-height:24px;\"><span style=\"font-size: 24px; line-height: 48px;\"><strong>Ver estado</strong></span></span>
		</a>
	  <!--[if mso]></center></v:textbox></v:roundrect></td></tr></table><![endif]-->
	</div>
	
					  
				  <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
				  </div>
				</div>
			  <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
			</div>
		  </div>
		</div>
		<div style=\"background-color:#303A61;\">
		  <div style=\"Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #303A61;\" class=\"block-grid \">
			<div style=\"border-collapse: collapse;display: table;width: 100%;background-color:#303A61;\">
			  <!--[if (mso)|(IE)]><table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr><td style=\"background-color:#303A61;\" align=\"center\"><table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"width: 600px;\"><tr class=\"layout-full-width\" style=\"background-color:#303A61;\"><![endif]-->
	
				  <!--[if (mso)|(IE)]><td align=\"center\" width=\"600\" style=\" width:600px; padding-right: 15px; padding-left: 15px; padding-top:15px; padding-bottom:15px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;\" valign=\"top\"><![endif]-->
				<div class=\"col num12\" style=\"min-width: 320px;max-width: 600px;display: table-cell;vertical-align: top;\">
				  <div style=\"background-color: transparent; width: 100% !important;\">
				  <!--[if (!mso)&(!IE)]><!--><div style=\"border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:15px; padding-bottom:15px; padding-right: 15px; padding-left: 15px;\"><!--<![endif]-->
	
					  
						
	<div align=\"center\" style=\"padding-right: 0px; padding-left: 0px; padding-bottom: 0px;\" class=\"\">
	  <div style=\"display: table; max-width:99px;\">
	  <!--[if (mso)|(IE)]><table width=\"99\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr><td style=\"border-collapse:collapse; padding-right: 0px; padding-left: 0px; padding-bottom: 0px;\"  align=\"center\"><table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"border-collapse:collapse; mso-table-lspace: 0pt;mso-table-rspace: 0pt; width:99px;\"><tr><td width=\"32\" style=\"width:32px; padding-right: 10px;\" valign=\"top\"><![endif]-->
		<table align=\"left\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"32\" height=\"32\" style=\"border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;Margin-right: 10px\">
		  <tbody><tr style=\"vertical-align: top\"><td align=\"left\" valign=\"middle\" style=\"word-break: break-word;border-collapse: collapse !important;vertical-align: top\">
			<a href=\"https://www.facebook.com/arteataco\" title=\"Facebook\" target=\"_blank\">
			  <img src=\"https://arteataco.000webhostapp.com/images/facebook.png\" alt=\"Facebook\" title=\"Facebook\" width=\"32\" style=\"outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: none;height: auto;float: none;max-width: 32px !important\">
			</a>
		  <div style=\"line-height:5px;font-size:1px\">&#160;</div>
		  </td></tr>
		</tbody></table>
		  <!--[if (mso)|(IE)]></td><td width=\"32\" style=\"width:32px; padding-right: 0;\" valign=\"top\"><![endif]-->
		<table align=\"left\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"32\" height=\"32\" style=\"border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;Margin-right: 0\">
		  <tbody><tr style=\"vertical-align: top\"><td align=\"left\" valign=\"middle\" style=\"word-break: break-word;border-collapse: collapse !important;vertical-align: top\">
			<a href=\"https://arteataco.000webhostapp.com\" title=\"Web Site\" target=\"_blank\">
			  <img src=\"https://arteataco.000webhostapp.com/images/website@2x.png\" alt=\"Web Site\" title=\"Web Site\" width=\"32\" style=\"outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: none;height: auto;float: none;max-width: 32px !important\">
			</a>
		  <div style=\"line-height:5px;font-size:1px\">&#160;</div>
		  </td></tr>
		</tbody></table>
		<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
	  </div>
	</div>
					  
				  <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
				  </div>
				</div>
			  <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
			</div>
		  </div>
		</div>
		<div style=\"background-color:transparent;\">
		  <div style=\"Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #303A61;\" class=\"block-grid \">
			<div style=\"border-collapse: collapse;display: table;width: 100%;background-color:#303A61;\">
			  <!--[if (mso)|(IE)]><table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr><td style=\"background-color:transparent;\" align=\"center\"><table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"width: 600px;\"><tr class=\"layout-full-width\" style=\"background-color:#303A61;\"><![endif]-->
	
				  <!--[if (mso)|(IE)]><td align=\"center\" width=\"600\" style=\" width:600px; padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;\" valign=\"top\"><![endif]-->
				<div class=\"col num12\" style=\"min-width: 320px;max-width: 600px;display: table-cell;vertical-align: top;\">
				  <div style=\"background-color: transparent; width: 100% !important;\">
				  <!--[if (!mso)&(!IE)]><!--><div style=\"border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;\"><!--<![endif]-->
	
					  
						
	<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"divider \" style=\"border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 100%;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%\">
		<tbody>
			<tr style=\"vertical-align: top\">
				<td class=\"divider_inner\" style=\"word-break: break-word;border-collapse: collapse !important;vertical-align: top;padding-right: 15px;padding-left: 15px;padding-top: 15px;padding-bottom: 15px;min-width: 100%;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%\">
					<table class=\"divider_content\" align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 0px solid transparent;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%\">
						<tbody>
							<tr style=\"vertical-align: top\">
								<td style=\"word-break: break-word;border-collapse: collapse !important;vertical-align: top;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%\">
									<span></span>
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
		</tbody>
	</table>
					  
				  <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
				  </div>
				</div>
			  <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
			</div>
		  </div>
		</div>
	   <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
			</td>
	  </tr>
	  </tbody>
	  </table>
	  <!--[if (mso)|(IE)]></div><![endif]-->
	
	
	</body></html>
		";

		mail($to, $subject, $message, $headers);
	}
}

$methodSlug = $_GET['method'];

if (file_exists("payMethods/" . $methodSlug . ".php")) {
	require "payMethods/" . $methodSlug . ".php";
} else {
	require "payMethods/error-view.php";
}



?>