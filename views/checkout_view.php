<!DOCTYPE html>
<html>
<head>
	<title>Arte Ataco :: Datos del pedido</title>

	<link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 
	<link rel="stylesheet" href="css/styleModal.css"> 
	<link rel="stylesheet" href="css/styles.css">
</head>
<body>

<?php require("messenger_contact.php") ?>	
<?php require 'header.php' ?>

	<a name="dirs" id="dirs"></a>
	<div class="contenedor_checkout">
		<div class="info_checkout">
			<div class="contenedor_address">
				<div class="step1">1</div>
				<h3 class="indication"><i class="fa fa-truck"></i> Seleccione una direccion de env&iacute;o</h3>
				<div class="select_address">
					<?php if ($direcciones != false): ?>
						<?php foreach ($direcciones as $direccion): ?>
							<form class="shipping_address" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
								<div class="info">
									<input type="hidden" name="id_address" value="<?= $direccion['id'] ?>">
									<input type="hidden" name="id_user" value="<?= $direccion['id_user'] ?>">
									<input type="hidden" name="dir_nombre" value="<?= $direccion['nombre'] ?>">
									<input type="hidden" name="dir_detalle" value="<?= $direccion['linea1'] ?>">
									<h4><?= $direccion['nombre'] ?></h4><br />
									<h5><?= $direccion['linea1'] ?></h5>
								</div>
								<div class="options">
									<a href="cuenta.php" class="button">Editar</a>
									<input class="button" name="confirm_address" type="submit" value="Seleccionar">
								</div>
							</form>
						<?php endforeach ?>
					<?php else: ?>
						No tiene ninguna direcci&oacute;n registrada, puede agregar direcciones en el siguiente formulario y aparecer&aacute;n aqu&iacute;:
					<?php endif ?>
				</div>
			</div>

			<?php if ($permitir_direccion): ?>
				<div class="new_address">
					<div class="show-form">
						<span class="add_address" id="showNewAddressForm">
							Agregar una nueva direccion 
							&nbsp;<i class="fa fa-truck"></i>
							&nbsp;<i class="fa fa-plus"></i>
						</span>
					</div>
					<form id="newAddressForm" class="form_new_address closed" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
						Nombre de la direcci&oacute;n: *
						<input type="text" name="address_name" class="new_address_field" placeholder="Nombre descriptivo ej: Casa Santa Ana, Oficina, etc..">
						Pa&iacute;s: *
						<input type="text" name="pais" class="new_address_field" value="El Salvador" readonly disabled>
						Departamento: *
						<select name="departamento" id="dpto" class="new_address_field">
							<?php foreach ($departamentos as $departamento): ?>
								<?php if($departamento['id'] == 1 || $departamento['id'] == 2 || $departamento['id'] == 3 || $departamento['id'] == 7): ?>
									<option value="<?= $departamento['id'] ?>"><?php echo $departamento['nombre'] ?></option>
								<?php else: ?>
									<option value="<?= $departamento['id'] ?>" disabled><?php echo $departamento['nombre'] . "(No disponible)" ?></option>
								<?php endif ?>
							<?php endforeach ?>
						</select>
						Direccion:
						<input type="text" name="address_line_1" class="new_address_field" placeholder="Direccion linea 1 *">
						<input type="text" name="address_line_2" class="new_address_field" placeholder="Direccion linea 2">
						Referencias:
						<textarea name="referencias" id="ref" class="new_address_field" placeholder="Referencias de ubicacion ej: Frente a iglesia, a la par de local X, etc..."></textarea>
						<?php if (!empty($errores)): ?>
							<div class="errores"><?= $errores ?></div>
						<?php else: ?>
							<?php if (isset($added)): ?>
								<div class="added"><?= $added ?></div>
							<?php endif ?>
						<?php endif ?>
						<div class="options">
							<input type="submit" name="add_address" value="Agregar direcci&oacute;n">
							<div class="cancel" id="cancelNewAddressChkt">
								<i class="fa fa-times-circle"></i>
							</div>
						</div>
					</form>
				</div>	
			<hr>
			<?php endif ?>
			
			<a name="pays" id="pays"></a>
			<div class="payment_method">
				<div class="step1">2</div>
				<h3 class="indication">Seleccione un m&eacute;todo de pago</h3>
				<form class="form_pay_method" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
					<?php foreach ($metodos as $metodo): ?>
						<div class="pay_option">
							<i class="<?php echo $metodo['icon'] ?>" aria-hidden="true"></i><input type="radio" name="payment_method" value="<?php echo $metodo['id'] ?>"><?php echo $metodo['nombre'] ?>
						</div>		
					<?php endforeach ?>
					<input type="submit" name="confirm_pay" value="Aceptar" class="button">
				</form>
			</div>
			<hr>
			<div class="confirm_info">
				<div class="step1">3</div>
				<h3 class="indication">Revisar informaci&oacute;n</h3>
				<form class="form_confirm_info" action="pago.php" method="POST">
					<div class="selecciones">
						<?php if (isset($dir_sel) && $dir_sel != false): ?>
							<div class="direccion_seleccionada">
								<h3>Se entregar&aacute; en:</h3>
								<div class="shipping_address">
									<div class="info">
										<input type="hidden" name="dir_id" value="<?= $dir_sel['id'] ?>">
										<input type="hidden" name="us_id" value="<?= $dir_sel['id_user'] ?>">
										<h4><?= $dir_sel['nombre'] ?></h4><br />
										<h5><?= $dir_sel['linea1'] ?></h5>
									</div>
									<div class="options">
										<a href="#dirs" class="button">Cambiar</a>
									</div>
								</div>						
							</div>
						<?php else: ?>
							<div class="direccion_seleccionada">
								<h3 class="noSel">
									No se han seleccionado una direcci&oacute;n.
									<i class="fa fa-truck"></i>
									<i class="fa fa-question"></i>
								</h3>
							</div>
						<?php endif ?>
						<?php if (isset($pay_sel) && $pay_sel != false): ?>
							<div class="pago_seleccionado">
								<h3>Se pagar&aacute; con:</h3>
								<div class="shipping_address">
									<div class="info">
										<input type="hidden" name="pm_id" value="<?= $pay_sel['id'] ?>">
										<h4><i class="<?= $pay_sel['icon'] ?>" aria-hidden="true"></i><?= " ". $pay_sel['nombre'] ?></h4><br />
									</div>
									<div class="options">
										<a href="#pays" class="button">Cambiar</a>
									</div>
								</div>						
							</div>
						<?php else: ?>
							<div class="direccion_seleccionada">
								<h3 class="noSel">
									No se ha seleccionado un m&eacute;todo de pago.
									<i class="fa fa-money"></i>
									<i class="fa fa-question"></i>
								</h3>
							</div>
						<?php endif ?>
					</div>
					<?php if ($allowPass): ?>
						<input class="send_info" type="submit" name="confirm_info" value="La informaci&oacute;n es correcta">
						<input type="hidden" name="checkout_checkpoint">
					<?php else: ?>
						<div class="noInfo">Completar informaci&oacute;n para continuar</div>
					<?php endif ?>
				</form>
			</div>
		</div>

		<div class="carrito_checkout">
			<h2><i class="fa fa-shopping-cart"></i> Articulos en el carrito:</h2>

			<?php foreach ($carrito as $item): ?>
				<div class="item_checkout">
					<div class="item-info">
						<h3><?= $item['nombre'] ?></h3>
					</div>
					<div class="item-info">
						<h4>Cantidad: <?= $item['cantidad'] ?></h4>
					</div>
					<div class="item-info">
						<h4>Precio unitario: $<?= $item['precio'] ?></h4>
					</div>
				</div>
				<?php $subtotal += $item['precio'] * $item['cantidad'] ?>
			<?php endforeach ?>

			<div class="editar">
				<a href="carrito.php">Editar</a>
			</div>
			<div class="subtotal_checkout">
				<span>Subtotal: $ <?= $subtotal ?></span>
			</div>
		</div>
	</div>

	<?php require 'footer.php' ?>

	<script src="script/js/functions.js"></script>
</body>
</html>