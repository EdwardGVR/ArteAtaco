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
			<i class="fa fa-user"></i>
		</div>
		<div class="datos_usuario">
			<span>Nombre usuario	</span>
			<span>Pedidos activos: 0</span>
		</div>
	</div>
	<div class="informacion_cuenta">
		<div class="info_usuario">
			<form class="edit_info" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method='POST'>
				<h3>Informaci&oacute;n</h3>
				<hr>
				
				<span>Nombres:</span>
				<input id="field_user" class="field" type="text" name="nombres" value="Nombres Usuario" readonly="">
				<span>Apellidos:</span>
				<input id="field_user" class="field" type="text" name="apellidos" value="Apellidos Usuario" readonly="">
				<span>E-mail:</span>
				<input id="field_user" class="field" type="text" name="email" value="email@usuario.com" readonly="">
				<span>Tel&eacute;fono:</span>
				<input id="field_user" class="field" type="text" name="telefono" value="55555555" readonly="">
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