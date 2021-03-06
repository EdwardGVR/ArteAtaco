<!DOCTYPE html>
<html>
<head>
	<title>Arte Ataco :: Registrate</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 
	<link rel="stylesheet" href="css/styles.css">
</head>
<body>

<?php require("messenger_contact.php") ?>

	<div class="contenedor_reg">
		<form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" class="formulario" name="register">
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
							<?= $errores ?>
						</ul>
					</div>
				<?php endif; ?>

			<input type="submit" name="submit" class="login_btn" value="Registrarse">
		</form>
		<p class="msg_form">Ya tienes cuenta? <a class="login" href="login.php">Inicia Sesión</a></p>

		<div class="nequiReg">
			<img src="https://lh3.googleusercontent.com/4vYmmT1fRDRF5XPI_Ny4pZf8xHE5XNavg1ZjI_L8tuZD1f8UKdNCU3DZm69s8rd56Lp7fzmr29qEF1Er6HHWQjB4W1QcRbdU9LBm1krVA3-hrBBPbQQnPgKNE9kda-cZCwUvVewj_5KuqK28-87O9jKxJr8qAAAZUnn-7wmbU3_dmpCaWHlChpLjVkeYntAWj7VVMM9bjb4RS6qN264jVvMOHWMXGVFwTyk5HYWGNCcHJConnACmGbpHMO_XZ8AEtDhYhQTlQYDN-H8wLfmYxupBZlB0YZ96G-UHdeaAmprQSZk1Skq4CFrYUcCaECgJFghzh869LVH4e38iCMsxEdZPJP0VjHtsAANj81l9YbuxUDQ_8yIJNTgK0RGu9-v8iZe0qhMrJeLHUSgyYg3glPHlg_N5Na04lCa-Qk31IgL3Ab6id7mq7h0q8p2Movm6BBe9svTYH7fGklk6xEpESpb5dcW9BguE0s_DwCGup2eaniXUGwahX6y8U3ZiTP_5uSMUPc99NMUGJTIbT1WNgVulSERKIMFuljRHPwOuq__uZN3mWylKNz4EvyTRel0fBPOFtRGU7cOMXeJv3oMgWHaJ9Bqr01G7iDECsp7-TRgTJjQoRh4xokCSR-yRVXUlH3OmZ6Ua9xauU2Dq_Qftf_9WYgYkNg=w473-h428-no" 
				alt="x"
				class="nequi">
		</div>
	</div>

	<script src="script/js/functions.js"></script>
</body>
</html>