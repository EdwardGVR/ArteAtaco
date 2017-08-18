<!DOCTYPE html>
<html>
<head>
	<title>Registrate</title>
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 
	<link rel="stylesheet" href="css/styles.css">
</head>
<body>
	<div class="contenedor_reg">
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" class="formulario" name="register">
			<input type="text" placeholder="Nombre:" name="nombre">
			<input type="email" placeholder="Correo:" name="correo">
			<input type="password" placeholder="Contraseña:" name="pass">
			<input type="password" placeholder="Repetir contraseña:" name="pass2">

				<?php if (!empty($errores)): ?>
					<div class="error">
						<ul>
							<?php echo $errores ?>
						</ul>
					</div>
				<?php endif; ?>

			<input type="submit" name="submit" value="Registrarse">
		</form>
		<p class="msg_form">Ya tienes cuenta? <a class="reg" href="login.php">Inicia Sesión</a></p>
	</div>
</body>
</html>