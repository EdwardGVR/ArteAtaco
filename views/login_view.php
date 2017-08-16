<!DOCTYPE html>
<html>
<head>
	<title>Inicia Sesión</title>
	<link rel="stylesheet" href="css/styles.css">
</head>
<body>
	<div class="contenedor">
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" class="formulario" name="login">
			<input type="text" placeholder="Usuario o correo: " name="nombre">
			<input type="password" placeholder="Contraseña: " name="pass">

				<?php if (!empty($errores)): ?>
					<div class="error">
						<ul>
							<?php echo $errores ?>
						</ul>
					</div>
				<?php endif; ?>

			<input type="submit" name="submit" value="Iniciar Sesion">
		</form>

		<p class="msg_form">No tienes cuenta? <a class="login" href="register.php">Registrate</a></p>
	</div>

	<section>
		<img src="images/nequi_solo.png" alt="nequi" id="nequi_login">

		<div class="info_login">
			<p>Al iniciar sesi&oacute;n podr&aacute;s disfrutar de descuentos exculsivos en todos los productos, adem&aacute;s ser&aacute;s capaz de guardar tu informaci&oacute;n de env&iacute;o para facilitar futuras compras, recibir atenci&oacute;n personalizada con prioridad, entre otros beneficios...</p>
			<p>De lo contrario, puedes <a class="login" href="categorias.php">Entrar como invitado</a>.</p>
		</div>
	</section>
</body>
</html>