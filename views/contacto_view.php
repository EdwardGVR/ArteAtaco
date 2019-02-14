<!DOCTYPE html>
<html>
<head>
	<title>Arte Ataco :: Contacto</title>

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 
	<link rel="stylesheet" href="css/styles.css">
</head>
<body>
	<?php require 'header.php' ?>

	<div class="contenedor_contacto">
		<h3>Env&iacute;anos tu consulta.</h3>
		<form class="contacto_form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
			<?php if ($iduser == false): ?>
				<div class="contacto_campo">
					<span>Nombre: * <br> <span class="contacto_tip">(Este campo no es necesario al <a href="login.php">iniciar sesi&oacute;n</a>)</span></span>

					<input type="text" name="contacto_nombre" required="" placeholder="Escribe tu nombre">
				</div>
				<div class="contacto_campo">
					<span>Correo: * <br> <span class="contacto_tip">(Este campo no es necesario al <a href="login.php">iniciar sesi&oacute;n</a>)</span></span>
					<input type="text" name="contacto_correo" required="" placeholder="ejemplo@gmail.com">
				</div>
			<?php else: ?>
				<input type="hidden" name="contacto_nombre" value="<?php echo $user_nombre ?>">
				<input type="hidden" name="contacto_correo" value="<?php echo $user_mail ?>">
			<?php endif ?>
			<div class="contacto_campo">
				<span>Sobre qu&eacute; producto quieres consultar?</span>
				<select name="producto" id="contacto_producto" required="">
					<?php foreach ($categorias as $categoria): ?>
						<option value="<?php echo $categoria['nombre_cat'] ?>"><?php echo $categoria['nombre_cat'] ?></option>
					<?php endforeach ?>
					<option value="general">Otra pregunta</option>
					<option value="null" disabled="" selected="">- - Selecciona una opci&oacute;n - -</option>
				</select>
			</div>
			<div class="contacto_campo">
				<span>Mensaje:</span>
				<textarea name="contacto_mensaje" id="contacto_mensaje" placeholder="Escribe aqu&iacute; tu mensaje"></textarea>
			</div>
			<div class="contacto_campo">
				<input type="submit" name="contacto_enviar" value="Enviar">
			</div>
		</form>
	</div>
	<?php require 'footer.php' ?>
</body>
</html>