<!DOCTYPE html>
<html>
<head>
	<title>Arte Ataco :: Registrate</title>
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 
	<link rel="stylesheet" href="css/styles.css">
</head>
<body>

<?php require("messenger_contact.php") ?>

	<div class="contenedor_reg">
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" class="formulario" name="register">
			<h4 class="label">Usuario: </h4>
			<input type="text" placeholder="Nombre de usuario:" name="nombre">
			<h4 class="label">Nombre completo: </h4>
			<input type="text" placeholder="Nombres" name="nombres" class="nombre nombres">
			<input type="text" placeholder="Apellidos" name="apellidos" class="nombre apellidos">
			<h4 class="label">Email: </h4>
			<input type="email" placeholder="Correo:" name="correo">
			<h4 class="label">Contrase&ntilde;a: </h4>
			<input type="password" placeholder="Contraseña:" name="pass">
			<h4 class="label">Repetir contrase&ntilde;a: </h4>
			<input type="password" placeholder="Repetir contraseña:" name="pass2">

				<?php if (!empty($errores)): ?>
					<div class="error">
						<ul>
							<?php echo $errores ?>
						</ul>
					</div>
				<?php endif; ?>

			<input type="submit" name="submit" class="login_btn" value="Registrarse">
		</form>
		<p class="msg_form">Ya tienes cuenta? <a class="reg" href="login.php">Inicia Sesión</a></p>
	</div>

	<script src="script/js/functions.js"></script>
</body>
</html>