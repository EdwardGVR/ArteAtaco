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
	
	<?php require 'header.php' ?>

	<div class="contenedor_checkout">
		<div class="info_checkout">
			<div class="contenedor_address">
				<div class="step1">1</div>
				<h3 class="indication">Seleccione una direccion de envio</h3>
				<div class="select_address">
					<?php if ($direcciones != false): ?>
						<?php foreach ($direcciones as $direccion): ?>
							<form class="shipping_address" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
								<div class="info">
									<input type="hidden" name="id_address" value="<?php echo $direccion['id'] ?>">
									<input type="hidden" name="id_user" value="<?php echo $direccion['id_user'] ?>">
									<input type="hidden" name="dir_nombre" value="<?php echo $direccion['nombre'] ?>">
									<input type="hidden" name="dir_detalle" value="<?php echo $direccion['linea1'] ?>">
									<h4><?php echo $direccion['nombre'] ?></h4><br />
									<h5><?php echo $direccion['linea1'] ?></h5>
								</div>
								<div class="options">
									<a href="#" class="button">Editar</a>
									<input class="button" name="confirm_address" type="submit" value="Seleccionar">
								</div>
							</form>
						<?php endforeach ?>
					<?php else: ?>
						No tiene ninguna direcci&oacute;n registrada, puede agregar direcciones en el siguiente formulario y apareceran aqu&iacute;:
					<?php endif ?>
				</div>
			</div>
			<hr>
			<div class="new_address">
				<form class="form_new_address" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
					<h3 class="indication">O agregue una nueva</h3>
					<span class="add_address">Agregar una nueva direccion</span>
					Nombre de la direccion:
					<input type="text" name="address_name" class="new_address_field" placeholder="Nombre descriptivo ej: Casa Santa Ana, Oficina, etc..">
					Pa&iacute;s:
					<input type="text" name="pais" class="new_address_field" value="El Salvador" readonly>
					Departamento:
					<select name="departamento" id="dpto" class="new_address_field">
						<?php foreach ($departamentos as $departamento): ?>
							<option value="<?php echo $departamento['id'] ?>"><?php echo $departamento['nombre'] ?></option>
						<?php endforeach ?>
					</select>
					Direccion:
					<input type="text" name="address_line_1" class="new_address_field" placeholder="Direccion linea 1">
					<input type="text" name="address_line_2" class="new_address_field" placeholder="Direccion linea 2">
					Referencias:
					<textarea name="referencias" id="ref" class="new_address_field" placeholder="Referencias de ubicacion ej: Frente a iglesia, a la par de local X, etc..."></textarea>
					<?php if (!empty($errores)): ?>
						<div class="errores"><?php echo $errores ?></div>
					<?php else: ?>
						<?php if (isset($added)): ?>
							<div class="added"><?php echo $added ?></div>
						<?php endif ?>
					<?php endif ?>
					<input type="submit" name="add_address" value="Agregar direccion">
				</form>
			</div>
			<hr>
			<div class="payment_method">
				<div class="step1">2</div>
				<h3 class="indication">Seleccione un m&eacute;todo de pago</h3>
				<form class="form_pay_method" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
					<div class="pay_option">
						<i class="fa fa-university" aria-hidden="true"></i><input type="radio" name="payment_method" value="bank-transfer">Transferencia bancaria
					</div>	
					<div class="pay_option">
						<i class="fa fa-money" aria-hidden="true"></i><input type="radio" name="payment_method" value="method">Metodo de pago 2
					</div>
					<div class="pay_option">
						<i class="fa fa-money" aria-hidden="true"></i><input type="radio" name="payment_method" value="method">Metodo de pago 3
					</div>
					<input type="submit" name="confirm_pay" value="Aceptar" class="button">
				</form>
			</div>
			<hr>
			<div class="confirm_info">
				<div class="step1">3</div>
				<h3 class="indication">Revisar informaci&oacute;n</h3>
				<form class="form_confirm_info" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
					<div class="selecciones">
						<?php if ($dir_select): ?>
							<div class="direccion_seleccionada">
								<h3>Se entregar&aacute; en:</h3>
								<div class="shipping_address">
									<div class="info">
										<h4><?php echo $dir_nombre ?></h4><br />
										<h5><?php echo $dir_detalle ?></h5>
									</div>
									<div class="options">
										<a href="#" class="button">Editar</a>
										<input class="button" name="confirm_address" type="submit" value="Seleccionar">
									</div>
								</div>						
							</div>
						<?php else: ?>
							<div class="direccion_seleccionada">
								<h3>No se han seleccionado una direcci&oacute;n.</h3>
							</div>
						<?php endif ?>
						<?php if ($pay_select): ?>
							<div class="pago_seleccionado">
								<h3>Se pagar&aacute; con:</h3>
								<div class="shipping_address">
									<div class="info">
										<h4><?php echo $payment_method ?></h4><br />
									</div>
									<div class="options">
										<a href="#" class="button">Editar</a>
										<input class="button" name="confirm_address" type="submit" value="Seleccionar">
									</div>
								</div>						
							</div>
						<?php else: ?>
							<div class="direccion_seleccionada">
								<h3>No se ha seleccionado un m&eacute;todo de pago.</h3>
							</div>
						<?php endif ?>
					</div>
					<input class="send_info" type="submit" name="confirm_info" value="La informaci&oacute;n es correcta">
				</form>
			</div>
		</div>

		<div class="carrito_checkout">
			<h2>Articulos en el carrito:</h2>

			<?php foreach ($carrito as $item): ?>
				<div class="item_checkout">
					<h3><?php echo $item['nombre'] ?></h3>
					<h3>Cantidad: <?php echo $item['cantidad'] ?></h3>
					<h3>Precio unitario: <?php echo $item['precio'] ?></h3>
				</div>

				<?php $subtotal += $item['precio'] * $item['cantidad'] ?>

			<?php endforeach ?>
			<div class="editar">
				<a href="carrito.php">Editar</a>
			</div>
			<div class="subtotal_checkout">
				<span>El subtotal es de: $ <?php echo $subtotal ?></span>
			</div>
		</div>
	</div>

	<?php require 'footer.php' ?>

</body>
</html>