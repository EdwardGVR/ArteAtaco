<!DOCTYPE html>
<html>
<head>
	<title>Arte Ataco :: Carrito</title>

	<link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 
	<link rel="stylesheet" href="css/styles.css">
</head>
<body>
	<?php require 'header.php' ?>

	<div class="contenedor_carrito">
		<div class="prod_carrito">
			<div class="img_carrito">
				<img src="<?php echo $producto['imagen'] ?>" alt="">
			</div>
			<div class="info_carrito">
				<form class="form_carrito" action="carrito.php" method="POST">
					<input type="hidden" value="<?php echo $id_prod ?>" name="idprod">
					<input type="hidden" value="<?php echo $user ?>">
					Se han agregado <input type="number" class="confirm_cantidad" name="quantity" min="1" max="10" value="<?php echo $cantidad ?>"> 
					del producto: <?php echo $producto['nombre'] ?> 
				 	al carrito, lo que hace un total de $<?php echo $subtotal?> 
				 	por el usuario <?php echo $user ?>
				</form>
			</div>
		</div>
	</div>

	<?php require 'footer.php' ?>
</body>
</html>