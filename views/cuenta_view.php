<!DOCTYPE html>
<html>
<head>
	<title>Arte Ataco :: <?= $user ?></title>

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 
	<link rel="stylesheet" href="css/styleModal.css">
	<link rel="stylesheet" href="css/styles.css">
</head>
<body>

<script>var pagId = "cuenta";</script>

<?php require("messenger_contact.php") ?>

<?php require 'header.php' ?>
	
<div class="contenedor_cuenta">
	<div class="imagen_cuenta">
		<?php if (isset($img_upload_error)): ?>
			<div class="error_upload_img">
				<span>Error al subir la imagen</span><br />
				<span>Intente con un archivo m&aacute;s peque&ntilde;o</span>
			</div>
		<?php endif ?>
		<div class="imagen_usuario">
			<?php if (isset($imagen)): ?>
				<img class="imagen_usuario" src="<?= $imagen_user ?>" alt="*">
				<form class="upload" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" enctype="multipart/form-data" method="POST">
					<input type="hidden" name="userImage" value="<?= $imagen_user ?>">
					<input onchange="this.form.submit()" class="file" id="file" name="user_img" type="file" accept="image/*"/>
					<input type="submit" id="rotateImg" name="rotateImg" value="wer" class="file">
					<label for="file" title="Subir imagen"><i class="fa fa-camera"></i></label>
				</form>
				<label class="rotate" title="Rotar imagen" for="rotateImg"><i class="fas fa-redo"></i></label>  
			<?php else: ?>
				<i class="fa fa-user"></i>	
				<form class="upload" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" enctype="multipart/form-data" method="POST">
  					<input onchange="this.form.submit()" class="file" id="file" name="user_img" type="file" accept="image/*"/>
  					<label for="file" title="Subir imagen"><i class="fa fa-camera"></i></label>
				</form>
			<?php endif ?>
			
		</div>
		<div class="datos_usuario">
			<span><i class="fas fa-user"></i> <?= $nombre ?></span>
			<a href="pedidos.php"><span><i class="fas fa-shopping-bag"></i> Pedidos activos: <?= $pedidos_activos ?></span></a>
		</div>
	</div>
	<div class="informacion_cuenta">
		<div class="info_usuario">
			<form class="edit_info" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method='POST'>
				<h3>Informaci&oacute;n</h3>
				<hr>
				
				<span id="user_label" class="user_label_hidden"> Nombre de usuario:</span>
				<input id="user_user" class="field_user"  type="hidden" name="user" value="<?= $user ?>" disabled="true" readonly="">

				<span>Nombres:</span>
				<input id="nombre_user" class="field_user"  type="text" name="nombres" value="<?= $nombres ?>" disabled="true" readonly="">
				<span>Apellidos:</span>
				<input id="apellido_user" class="field_user"  type="text" name="apellidos" value="<?= $apellidos ?>" disabled="true" readonly="">
				<span>E-mail:</span>
				<input id="email_user" class="field_user"  type="email" name="email" value="<?= $email ?>" disabled="true" readonly="">
				<span>Tel&eacute;fono:</span>
				<input id="telefono_user" class="field_user"  type="text" name="telefono" value="<?= $telefono ?>" disabled="true" readonly="">
				<?php if (isset($errores_usuario) && !empty($errores_usuario)): ?>
					<div class="errores_usuario">
						<?= $errores_usuario ?>
					</div>
				<?php endif ?>
				<div id="btnEditar" class="editar"><span onclick="editInfoUser()" class="editar_boton">Editar</span></div>
				
				<div id="btnsOpciones" class="opciones_hidden">
					<input class="editar_submit" type="submit" name="guardar" value="Guardar">
					<div onclick="cancelEditInfoUser()" class="cancelar_submit">Cancelar</div>
				</div>
			</form>
		</div>
		<div class="detalles_usuario">
			<div class="contenedor_address">
				<h3>Direcciones</h3>
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
						<form class="address" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
							<input id="cant_direcciones" type="hidden" name="cant_direcciones" value="<?= $cant_direcciones ?>">
							<input type="hidden" name="id_address" value="<?= $direccion['id'] ?>">
							<input type="hidden" name="id_user" value="<?= $direccion['id_user'] ?>">
							<span>Nombre:</span>
							<input id="nombre_dir<?= $direccion_numero ?>" type="text" name="nombre_dir" value="<?= $direccion['nombre'] ?>" disabled="true" readonly="">
							<span>Linea 1:</span>
							<input id="linea1_dir<?= $direccion_numero ?>" type="text" name="linea1_dir" value="<?= $direccion['linea1'] ?>" disabled="true" readonly="">
							<span>Linea 2:</span>
							<input id="linea2_dir<?= $direccion_numero ?>" type="text" name="linea2_dir" value="<?= $linea2 ?>" disabled="true" readonly="">
							<span>Referencias:</span>
							<input id="ref_dir<?= $direccion_numero ?>" type="text" name="ref_dir" value="<?= $referencias ?>" disabled="true" readonly="">
							<?php if (isset($errores_direccion) && !empty($errores_direccion && $dir_id == $direccion['id'])): ?>
								<div class="errores_direccion">
									<?= $errores_direccion ?>
								</div>
							<?php endif ?>
							<div id="btnEditarDir<?= $direccion_numero ?>" class="editar"><span onclick="addressChange(this)" class="editar_boton">Editar</span></div>
							<div id="opcionesDir<?= $direccion_numero ?>" class="editar_hidden">
								<input class="eliminar_direccion" type="submit" name="eliminar_direccion" value="Borrar">
								<div>
									<input class="editar_submit" type="submit" name="cambiar_direccion" value="Guardar">
									<div onclick="cancelEditInfoUser()" class="cancelar_submit">Cancelar</div>
								</div>
							</div>
						</form>
					<?php endforeach ?>

					<?php if ($permitir_direccion): ?>
						<form id="new_address" class="address_hidden" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
							<div class="new_address_title">
								Agregar una nueva direccion
							</div>
							<span>Nombre:</span>
							<input id="nombre_new_dir" type="text" name="nombre_new_dir" placeholder="Nombre descriptivo para la direcci&oacute;n">
							<span>Departamento:</span>
							<select name="departamento_new_dir" id="dpto" class="new_address_dpto">
								<?php foreach ($departamentos as $departamento): ?>
									<?php if($departamento['id'] == 1 || $departamento['id'] == 2 || $departamento['id'] == 3 || $departamento['id'] == 7): ?>
										<option value="<?= $departamento['id'] ?>"><?= $departamento['nombre'] ?></option>
									<?php else: ?>
										<option value="<?= $departamento['id'] ?>" disabled><?= $departamento['nombre'] . "(No disponible)" ?></option>
									<?php endif ?>
								<?php endforeach ?>
							</select>
							<span>Linea 1:</span>
							<input id="linea1_new_dir" type="text" name="linea1_new_dir" placeholder="Municipio, calle, colonia, etc">
							<span>Linea 2:</span>
							<input id="linea2_new_dir" class="linea2_new_dir" type="text" name="linea2_new_dir" placeholder="Pasaje, block, # de casa, etc">
							<span>Referencias:</span>
							<textarea id="ref_new_dir" class="ref_new_dir" type="text" name="ref_new_dir" placeholder="Sitios de referencia que ayuden a la ubicaci&oacute;n"></textarea>
							<div class="opciones_new_address">
								<input class="guardar_direccion" type="submit" name="guardar_direccion" value="Guardar">
								<div onclick="cancelEditInfoUser()" class="cancelar_submit">Cancelar</div>
							</div>
						</form>
						<div id="add_address" class="add_address">
							<span onclick="newAddress()">Agregar nueva</span>
							<?php if (isset($errores_new_direccion) && !empty($errores_new_direccion)): ?>
								<div class="errores_direccion">
									<?= $errores_new_direccion ?>
								</div>
							<?php endif ?>
						</div>
					<?php endif ?>

				<?php else: ?>
					<div class="address">
						<span class="no-address">
							<i class="fa fa-info-circle"></i> 
							No tiene ninguna direcci&oacute;n personalizada, puede empezar guardando una direcci&oacute;n en el siguiente formulario.
						</span>
						<form id="new_address" class="address" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
							<div class="new_address_title">
								Formulario para agregar una nueva direccion (Puede guardar hasta 3 direcciones)
							</div>
							<span>Nombre:</span>
							<input id="nombre_new_dir" type="text" name="nombre_new_dir" placeholder="Nombre descriptivo de la direcci&oacute;n ej: Casa, Oficina, etc">
							<span>Departamento:</span>
							<select name="departamento_new_dir" id="dpto" class="new_address_dpto">
								<?php foreach ($departamentos as $departamento): ?>
									<?php if($departamento['id'] == 1 || $departamento['id'] == 2 || $departamento['id'] == 3 || $departamento['id'] == 7): ?>
										<option value="<?= $departamento['id'] ?>"><?= $departamento['nombre'] ?></option>
									<?php else: ?>
										<option value="<?= $departamento['id'] ?>" disabled><?= $departamento['nombre'] . "(No disponible)" ?></option>
									<?php endif ?>
								<?php endforeach ?>
							</select>
							<span>Linea 1:</span>
							<input id="linea1_new_dir" type="text" name="linea1_new_dir" placeholder="Municipio, calle, colonia, etc">
							<span>Linea 2:</span>
							<input id="linea2_new_dir" class="linea2_new_dir" type="text" name="linea2_new_dir" placeholder="Pasaje, block, # de casa, etc">
							<span>Referencias:</span>
							<textarea id="ref_new_dir" class="ref_new_dir" type="text" name="ref_new_dir" placeholder="Lugares cercanos que sirvan para ubicarse"></textarea>
							<div class="opciones_new_address" id="newAddressOptions">
								<input class="guardar_direccion" type="submit" name="guardar_direccion" value="Guardar">
								<div onclick="cancelEditInfoUser()" class="cancelar_submit">Cancelar</div>
							</div>
							<?php if (isset($errores_new_direccion) && !empty($errores_new_direccion)): ?>
								<div class="errores_direccion">
									<?= $errores_new_direccion ?>
								</div>
							<?php endif ?>
						</form>
					</div>
				<?php endif ?>
			</div>
		</div>
	</div>
</div>

<?php require 'footer.php' ?>

<script src="script/js/functions.js"></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script  src="script/js/modal.js"></script>

</body>
</html>