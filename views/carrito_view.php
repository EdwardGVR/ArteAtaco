<!DOCTYPE html>
<html>
<head>
	<title>Arte Ataco :: Carrito</title>

	<link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 
	<link rel="stylesheet" href="css/styleModal.css"> 
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
						<div class="content">
							<div class="buttons">
								<!-- Eliminar item -->
								<div onclick="javascript:document.getElementById('idCarritoDelete').value='<?php echo $item['id'] ?>';" id="two" class="button">X</div>
							</div>
						</div>
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

	<div id="modal-container">
    	<div class="modal-background">
      		<div class="modal">
        			<form class="eliminar_item" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
        				<input type="hidden" id="idCarritoDelete" name="idDelete" value="0">
        				<input type="hidden" name="formDelete" value="delete_item">
        				<span>Esta a punto de eliminar este producto del carrito</span>
        				<span>Confirme que desea</span><br />
        				<input type="submit" name="delete" value="Eliminar">
        			</form>
        			<svg class="modal-svg" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" preserveAspectRatio="none">
  				<rect x="0" y="0" fill="none" width="226" height="162" rx="3" ry="3"></rect>
  			</svg>
      		</div>
    	</div>
  	</div>

	<?php require 'footer.php' ?>

	<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
	<script  src="script/js/modal.js"></script>

</body>
</html>