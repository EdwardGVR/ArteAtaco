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
	</div>

	<p>No tienes cuenta? <a href="register.php">Registrate</a></p>
</body>
</html>