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
		<?php foreach ($carrito as $item): ?>
			<div class="prod_carrito">
				<div class="img_carrito">
					<img src="<?php echo $item['imagen'] ?>" alt="No se pudo cargar la imagen">
				</div>
				<div class="info_carrito">
					<div class="eliminar">Eliminar (x)</div>
					<form class="form_carrito_confirm" action="carrito.php" method="POST">
						<input type="hidden" value="<?php echo $item['id'] ?>" name="idcarrito">
						<input type="hidden" value="<?php echo $item['id_producto'] ?>" name="idprod">
						<input type="hidden" value="<?php echo $item['id_user'] ?>" name="iduser">
						<span class="item_carrito">Producto: <?php echo $item['nombre'] ?></span>
						Cantidad: <input type="number" class="confirm_cantidad" name="quantity" min="1" max="10" value="<?php echo $item['cantidad'] ?>">
					</form>
				</div>
			</div>
		<?php endforeach ?>
	</div>

	<?php require 'footer.php' ?>
</body>
</html>