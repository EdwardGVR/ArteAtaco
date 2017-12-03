<!DOCTYPE html>
<html>
<head>
	<title>Arte Ataco :: Carrito</title>

	<link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 
	<!-- <link rel="stylesheet" href="css/styleModal.css">  -->
	<link rel="stylesheet" href="css/styles.css">
</head>
<body>
	<?php require 'header.php' ?>

	<div class="contenedor_carrito">
		<?php if ($carrito != false): ?>
			<?php foreach ($carrito as $item): ?>
				<div class="prod_carrito">
					<div class="img_carrito">
						<img src="<?php echo $item['imagen'] ?>" alt="No se pudo cargar la imagen">
					</div>
					<div class="info_carrito">
						<div class="eliminar">Eliminar (x)</div>
						<form class="form_carrito_confirm" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
							<input type="hidden" value="<?php echo $item['id'] ?>" name="idcarrito">
							<input type="hidden" value="<?php echo $item['id_producto'] ?>" name="idprod">
							<input type="hidden" value="<?php echo $item['id_user'] ?>" name="iduser">
							<span class="item_carrito">Producto: <?php echo $item['nombre'] ?></span>
							<span class="item_cantidad">Cantidad: <?php echo $item['cantidad'] ?></span>
							<span class="item_mod_cantidad">Modificar cantidad: <input type="number" class="confirm_cantidad" name="quantity" min="1" max="10" value="<?php echo $item['cantidad'] ?>"></span>
							<input id="two" type="submit" class="actualizar_cantidad button" name="actualizar_cantidad" value="Actualizar">
						</form>
					</div>
				</div>
				<?php $subtotal += ($item['precio']*$item['cantidad']) ?>
			<?php endforeach ?>
			<div class="carrito_subtotal">
				<span>Subtotal: $ <?php echo  $subtotal ?></span>
				<a href="#" class="checkout">Ir a caja</a>
			</div>
		<?php else: ?>
			<p>El carrito est&aacute; vac&iacute;o</p>
		<?php endif ?>
	</div>

	<?php require 'footer.php' ?>

	<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

	<script  src="script/js/modal.js"></script>

</body>
</html>