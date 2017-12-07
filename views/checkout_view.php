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
				<form class="form_new_address" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
					<span class="add_address">Agregar una nueva direccion</span>
					Pa&iacute;s:
					<input type="text" name="pais" class="new_address_field" value="El Salvador" readonly>
					Departamento:
					<select name="departamento" id="dpto" class="new_address_field">
						<option value="San Salvador">San Salvador</option>
						<option value="San Salvador">San Salvador</option>
						<option value="San Salvador">San Salvador</option>
						<option value="San Salvador">San Salvador</option>
						<option value="San Salvador">San Salvador</option>
						<option value="San Salvador">San Salvador</option>
						<option value="San Salvador">San Salvador</option>
						<option value="San Salvador">San Salvador</option>
						<option value="San Salvador">San Salvador</option>
						<option value="San Salvador">San Salvador</option>
						<option value="San Salvador">San Salvador</option>
						<option value="San Salvador">San Salvador</option>
					</select>
					Direccion:
					<input type="text" name="address_line_1" class="new_address_field" placeholder="Direccion linea 1">
					<input type="text" name="address_line_2" class="new_address_field" placeholder="Direccion linea 2">
					Referencias:
					<textarea name="referencias" id="ref" class="new_address_field" placeholder="referencias de ubicacion"></textarea>
					<input type="submit" name="add_address" value="Agregar direccion">
				</form>
			</div>
		</div>

		<div class="carrito_checkout">
			
		</div>
	</div>

	<?php require 'footer.php' ?>

</body>
</html>