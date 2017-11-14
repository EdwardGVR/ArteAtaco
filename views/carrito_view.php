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
		Se han agregado <?php echo $cantidad ?> del producto: <?php echo $producto['nombre'] ?> al carrito, lo que hace un total de $<?php echo $subtotal ?>
	</div>

	<?php require 'footer.php' ?>
</body>
</html>