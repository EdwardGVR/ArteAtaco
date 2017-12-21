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
				<div class="shipping_address">
					Direccion de envio
				</div>
				<div class="shipping_address">
					Direccion de envio
				</div>
				<div class="shipping_address">
					Direccion de envio
				</div>
			</div>
			<hr>
			<div class="new_address">
				<form class="form_new_address" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
					<h3 class="indication">O agregue una nueva</h3>
					<span class="add_address">Agregar una nueva direccion</span>
					Nombre de la direccion:
					<input type="text" name="address_line_1" class="new_address_field" placeholder="Nombre descriptivo ej: Casa Santa Ana, Oficina, etc..">
					Pa&iacute;s:
					<input type="text" name="pais" class="new_address_field" value="El Salvador" readonly>
					Departamento:
					<select name="departamento" id="dpto" class="new_address_field">
						<?php foreach ($departamentos as $departamento): ?>
								<option value="<?php echo $departamento['nombre'] ?>"><?php echo $departamento['nombre'] ?></option>
						<?php endforeach ?>
					</select>
					Direccion:
					<input type="text" name="address_line_1" class="new_address_field" placeholder="Direccion linea 1">
					<input type="text" name="address_line_2" class="new_address_field" placeholder="Direccion linea 2">
					Referencias:
					<textarea name="referencias" id="ref" class="new_address_field" placeholder="Referencias de ubicacion ej: Frente a iglesia, a la par de local X, etc..."></textarea>
					<input type="submit" name="add_address" value="Agregar direccion">
				</form>
			</div>
			<hr>
			<div class="payment_method">
				<div class="step1">2</div>
				<h3 class="indication">Seleccione un metodo de pago</h3>
				<form class="form_pay_method" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
					<div class="pay_option">
						<i class="fa fa-university" aria-hidden="true"></i><input type="radio" name="payment_method" value="bank-transfer">Transferencia bancaria
					</div>	
					<div class="pay_option">
						<i class="fa fa-money" aria-hidden="true"></i><input type="radio" name="payment_method" value="method">Metodo de pago
					</div>
					<div class="pay_option">
						<i class="fa fa-money" aria-hidden="true"></i><input type="radio" name="payment_method" value="method">Metodo de pago
					</div>
				</form>
			</div>
			<hr>
			<div class="confirm_info">
				<div class="step1">3</div>
				<!-- <h3 class="indication">Confirmar informacion</h3> -->
				<form class="form_confirm_info" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
					<input class="send_info" type="submit" name="confirm_info" value="Confirmar informacion">
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