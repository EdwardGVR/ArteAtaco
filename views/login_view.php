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

		<p class="msg_form">No tienes cuenta? <a href="register.php">Registrate</a></p>
	</div>

	<section>
		<img src="images/nequi_solo.png" alt="nequi" id="nequi_login">

		<div class="info_login">
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam minus praesentium ad deleniti, delectus, quod nemo corporis officia cupiditate, porro, pariatur. Enim ducimus recusandae ad neque mollitia dicta, esse aliquam laboriosam molestiae, libero consequuntur, consequatur pariatur aut delectus, placeat sit!</p>
		</div>
	</section>
</body>
</html>