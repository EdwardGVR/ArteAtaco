<!DOCTYPE html>
<html>
<head>
	<title>Arte Ataco :: Inicia Sesión</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 
	<link rel="stylesheet" href="css/styles.css">
</head>
<body>

<?php require "messenger_contact.php" ?>

	<div class="contenedor">
		<form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" class="formulario" name="login">
			<input type="text" placeholder="Usuario o correo: " name="nombre">
			<input type="password" placeholder="Contraseña: " name="pass">
			<span class="remember">Mantener sesi&oacute;n iniciada? <input type="checkbox" name="remember" value="1">	</span>
			


				<?php if (!empty($errores)): ?>
					<div class="error">
						<ul>
							<?= $errores ?>
						</ul>
					</div>
				<?php endif; ?>

			<input type="submit" name="submit" class="login_btn" value="Iniciar Sesion">
		</form>

		<p class="msg_form">No tienes cuenta? <a class="login" href="register.php">Registrate</a></p>
	</div>

	<section>
		<div class="info_login">
			<p>Al iniciar sesi&oacute;n podr&aacute;s disfrutar de descuentos exculsivos en todos los productos, adem&aacute;s ser&aacute;s capaz de guardar tu informaci&oacute;n de env&iacute;o para facilitar futuras compras, recibir atenci&oacute;n personalizada con prioridad, entre otros beneficios...</p>
			<p>De lo contrario, puedes <a class="login" href="categorias.php">Entrar como invitado</a>.</p>
		</div>
	</section>

	<script src="script/js/functions.js"></script>
</body>
</html>