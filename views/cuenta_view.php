<!DOCTYPE html>
<html>
<head>
	<title>Arte Ataco :: <?php echo $user ?></title>

	<link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 
	<link rel="stylesheet" href="css/styles.css">
</head>
<body>

<?php require 'header.php' ?>
	
<div class="contenedor_cuenta">
	<div class="imagen_cuenta">
		<div class="imagen_usuario">
			<?php if (isset($imagen)): ?>
				<img class="imagen_usuario" src="<?php echo $imagen ?>" alt="No se pudo mostrar">
			<?php else: ?>
				<i class="fa fa-user"></i>	
			<?php endif ?>
			
		</div>
		<div class="datos_usuario">
			<span><?php echo $user ?></span>
			<span>Pedidos activos: <?php echo $pedidos_activos ?></span>
		</div>
	</div>
	<div class="informacion_cuenta">
		<div class="info_usuario">
			<form class="edit_info" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method='POST'>
				<h3>Informaci&oacute;n</h3>
				<hr>
				
				<span>Nombres:</span>
				<input id="nombre_user" class="field_user" type="text" name="nombres" value="<?php echo $nombres ?>" disabled="true" readonly="">
				<span>Apellidos:</span>
				<input id="apellido_user" class="field_user" type="text" name="apellidos" value="<?php echo $apellidos ?>" disabled="true" readonly="">
				<span>E-mail:</span>
				<input id="email_user" class="field_user" type="email" name="email" value="<?php echo $email ?>" disabled="true" readonly="">
				<span>Tel&eacute;fono:</span>
				<input id="telefono_user" class="field_user" type="text" name="telefono" value="<?php echo $telefono ?>" disabled="true" readonly="">
				<div id="btnEditar" class="editar"><span onclick="editInfoUser()" class="editar_boton">Editar</span></div>
				
				<div id="btnsOpciones" class="opciones_hidden">
					<input class="editar_submit" type="submit" name="guardar" value="Guardar">
					<span onclick="cancelEditInfoUser()" class="cancelar_submit">Cancelar</span>
				</div>
			</form>
		</div>
		<div class="detalles_usuario">
			
		</div>
	</div>
</div>

<?php require 'footer.php' ?>
<script src="script/js/functions.js"></script>

</body>
</html>