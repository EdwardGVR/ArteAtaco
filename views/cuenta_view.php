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
			<a href="pedidos.php"><span>Pedidos activos: <?php echo $pedidos_activos ?></span></a>
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
					<div onclick="cancelEditInfoUser()" class="cancelar_submit">Cancelar</div>
				</div>
			</form>
		</div>
		<div class="detalles_usuario">
			<div class="contenedor_address">
				<span class="titulo">Direcciones</span>
					<?php if ($direcciones != false): ?>
						<?php foreach ($direcciones as $direccion): ?>
							<?php $direccion_numero++ ?>

							<?php if (!is_null($direccion['linea2'])): ?>
								<?php $linea2 = $direccion['linea2'] ?>
							<?php else: ?>
								<?php $linea2 = "No hay datos" ?>
							<?php endif ?>

							<?php if (!is_null($direccion['referencias'])): ?>
								<?php $referencias = $direccion['referencias'] ?>
							<?php else: ?>
								<?php $referencias = "No hay datos" ?>
							<?php endif ?>
							<form class="address" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
									<input id="cant_direcciones" type="hidden" name="cant_direcciones" value="<?php echo $cant_direcciones ?>">
									<input type="hidden" name="id_address" value="<?php echo $direccion['id'] ?>">
									<input type="hidden" name="id_user" value="<?php echo $direccion['id_user'] ?>">
									<span>Nombre:</span>
									<input id="nombre_dir" type="text" name="nombre_dir" value="<?php echo $direccion['nombre'] ?>" disabled="true" readonly="">
									<span>Linea 1:</span>
									<input id="linea1_dir" type="text" name="nombre_dir" value="<?php echo $direccion['linea1'] ?>" disabled="true" readonly="">
									<span>Linea 2:</span>
									<input id="linea2_dir" type="text" name="nombre_dir" value="<?php echo $linea2 ?>" disabled="true" readonly="">
									<span>Referencias:</span>
									<input id="ref_dir" type="text" name="nombre_dir" value="<?php echo $referencias ?>" disabled="true" readonly="">
									<div id="btnEditarDir<?php echo $direccion_numero ?>" class="editar"><span onclick="addressChange(this)" class="editar_boton">Editar</span></div>
									<div id="opcionesDir<?php echo $direccion_numero ?>" class="editar_hidden">
										<input class="editar_submit" type="submit" name="guardar" value="Guardar">
										<div onclick="cancelEditInfoUser()" class="cancelar_submit">Cancelar</div>
									</div>
							</form>
						<?php endforeach ?>
					<?php else: ?>
						<div class="address">
							No tiene ninguna direcci&oacute;n registrada, puede agregar direcciones en el siguiente formulario y apareceran aqu&iacute;:
						</div>
					<?php endif ?>
			</div>
		</div>
	</div>
</div>

<?php require 'footer.php' ?>
<script src="script/js/functions.js"></script>

</body>
</html>