<!DOCTYPE html>
<html>
<head>
	<title>Arte Ataco :: <?php echo $user ?></title>

	<link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 
	<link rel="stylesheet" href="css/styleModal.css">
	<link rel="stylesheet" href="css/styles.css">
</head>
<body>

	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = 'https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.11&appId=151665368959274&autoLogAppEvents=1';
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>

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
				<img class="imagen_usuario" src="<?php echo $imagen_user ?>" alt="*">
				<form class="upload" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" enctype="multipart/form-data" method="POST">
  					<input onchange="this.form.submit()" class="file" id="file" name="user_img" type="file" accept="image/*"/>
  					<label for="file"><i class="fa fa-camera"></i></label>
				</form>
			<?php else: ?>
				<i class="fa fa-user"></i>	
				<form class="upload" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" enctype="multipart/form-data" method="POST">
  					<input onchange="this.form.submit()" class="file" id="file" name="user_img" type="file" accept="image/*"/>
  					<label for="file"><i class="fa fa-camera"></i></label>
				</form>
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
				
				<span id="user_label" class="user_label_hidden"> Nombre de usuario:</span>
				<input id="user_user" class="field_user"  type="hidden" name="user" value="<?php echo $user ?>" disabled="true" readonly="">

				<span>Nombres:</span>
				<input id="nombre_user" class="field_user"  type="text" name="nombres" value="<?php echo $nombres ?>" disabled="true" readonly="">
				<span>Apellidos:</span>
				<input id="apellido_user" class="field_user"  type="text" name="apellidos" value="<?php echo $apellidos ?>" disabled="true" readonly="">
				<span>E-mail:</span>
				<input id="email_user" class="field_user"  type="email" name="email" value="<?php echo $email ?>" disabled="true" readonly="">
				<span>Tel&eacute;fono:</span>
				<input id="telefono_user" class="field_user"  type="text" name="telefono" value="<?php echo $telefono ?>" disabled="true" readonly="">
				<?php if (isset($errores_usuario) && !empty($errores_usuario)): ?>
					<div class="errores_usuario">
						<?php echo $errores_usuario ?>
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
				<span class="titulo">Direcciones</span>
				<?php if ($direcciones != false): ?>
					<?php foreach ($direcciones as $direccion): ?>
						<?php //echo $direccion['id'] ?>
						<?php //echo $direccion['id_user'] ?>

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
							<input id="nombre_dir<?php echo $direccion_numero ?>" type="text" name="nombre_dir" value="<?php echo $direccion['nombre'] ?>" disabled="true" readonly="">
							<span>Linea 1:</span>
							<input id="linea1_dir<?php echo $direccion_numero ?>" type="text" name="linea1_dir" value="<?php echo $direccion['linea1'] ?>" disabled="true" readonly="">
							<span>Linea 2:</span>
							<input id="linea2_dir<?php echo $direccion_numero ?>" type="text" name="linea2_dir" value="<?php echo $linea2 ?>" disabled="true" readonly="">
							<span>Referencias:</span>
							<input id="ref_dir<?php echo $direccion_numero ?>" type="text" name="ref_dir" value="<?php echo $referencias ?>" disabled="true" readonly="">
							<?php if (isset($errores_direccion) && !empty($errores_direccion && $dir_id == $direccion['id'])): ?>
								<div class="errores_direccion">
									<?php echo $errores_direccion ?>
								</div>
							<?php endif ?>
							<div id="btnEditarDir<?php echo $direccion_numero ?>" class="editar"><span onclick="addressChange(this)" class="editar_boton">Editar</span></div>
							<div id="opcionesDir<?php echo $direccion_numero ?>" class="editar_hidden">
								<input class="eliminar_direccion" type="submit" name="eliminar_direccion" value="Borrar">
								<div>
									<input class="editar_submit" type="submit" name="cambiar_direccion" value="Guardar">
									<div onclick="cancelEditInfoUser()" class="cancelar_submit">Cancelar</div>
								</div>
							</div>
						</form>
					<?php endforeach ?>

					<?php if ($permitir_direccion): ?>
						<form id="new_address" class="address_hidden" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
							<div class="new_address_title">
								Agregar una nueva direccion
							</div>
							<span>Nombre:</span>
							<input id="nombre_new_dir" type="text" name="nombre_new_dir">
							<span>Departamento:</span>
							<select name="departamento_new_dir" id="dpto" class="new_address_dpto">
								<?php foreach ($departamentos as $departamento): ?>
									<option value="<?php echo $departamento['id'] ?>"><?php echo $departamento['nombre'] ?></option>
								<?php endforeach ?>
							</select>
							<span>Linea 1:</span>
							<input id="linea1_new_dir" type="text" name="linea1_new_dir">
							<span>Linea 2:</span>
							<input id="linea2_new_dir" class="linea2_new_dir" type="text" name="linea2_new_dir">
							<span>Referencias:</span>
							<textarea id="ref_new_dir" class="ref_new_dir" type="text" name="ref_new_dir"></textarea>
							<div class="opciones_new_address">
								<input class="guardar_direccion" type="submit" name="guardar_direccion" value="Guardar">
								<div onclick="cancelEditInfoUser()" class="cancelar_submit">Cancelar</div>
							</div>
						</form>
						<div id="add_address" class="add_address">
							<span onclick="newAddress()">Agregar nueva</span>
							<?php if (isset($errores_new_direccion) && !empty($errores_new_direccion)): ?>
								<div class="errores_direccion">
									<?php echo $errores_new_direccion ?>
								</div>
							<?php endif ?>
						</div>
					<?php endif ?>

				<?php else: ?>
					<div class="address">
						No tiene ninguna direcci&oacute;n registrada, puede agregar direcciones en el siguiente formulario y apareceran aqu&iacute;.

						<form id="new_address" class="address" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
							<div class="new_address_title">
								Agregar una nueva direccion (Hasta 3)
							</div>
							<span>Nombre:</span>
							<input id="nombre_new_dir" type="text" name="nombre_new_dir">
							<span>Departamento:</span>
							<select name="departamento_new_dir" id="dpto" class="new_address_dpto">
								<?php foreach ($departamentos as $departamento): ?>
									<option value="<?php echo $departamento['id'] ?>"><?php echo $departamento['nombre'] ?></option>
								<?php endforeach ?>
							</select>
							<span>Linea 1:</span>
							<input id="linea1_new_dir" type="text" name="linea1_new_dir">
							<span>Linea 2:</span>
							<input id="linea2_new_dir" class="linea2_new_dir" type="text" name="linea2_new_dir">
							<span>Referencias:</span>
							<textarea id="ref_new_dir" class="ref_new_dir" type="text" name="ref_new_dir"></textarea>
							<div class="opciones_new_address">
								<input class="guardar_direccion" type="submit" name="guardar_direccion" value="Guardar">
								<div onclick="cancelEditInfoUser()" class="cancelar_submit">Cancelar</div>
							</div>
							<?php if (isset($errores_new_direccion) && !empty($errores_new_direccion)): ?>
								<div class="errores_direccion">
									<?php echo $errores_new_direccion ?>
								</div>
							<?php endif ?>
						</form>
					</div>
				<?php endif ?>
			</div>
		</div>
	</div>
</div>
	<div id="chatBox" class="fb_chat">
		<div onclick="showChat()" id="chatBtn" class="boton_chat">
			<span>Escr&iacute;benos en Messenger</span>
		</div>
		<div onclick="hideChat()" id="close_chat">X</div>
		<div class="fb-page" data-href="https://www.facebook.com/ArteAtaco/" data-tabs="messages" data-width="500" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/ArteAtaco/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/ArteAtaco/">Arte Ataco</a></blockquote></div>
	</div>

<?php require 'footer.php' ?>

<script src="script/js/functions.js"></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script  src="script/js/modal.js"></script>

</body>
</html>