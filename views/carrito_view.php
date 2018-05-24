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

<?php require("messenger_contact.php") ?>
<?php require 'header.php' ?>

	<div class="contenedor_carrito">
		<?php if ($carrito != false): ?>
			<?php $cantItems = 0 ?>
			<?php foreach ($carrito as $item): ?>
				<?php $subtotalProd = $item['precio'] * $item['cantidad'] ?>
				<div class="prod_carrito">
					<div class="img-opts">
						<div class="img_carrito">
							<?php $mainImg = false; $imgsForProd = false; ?>
							<?php foreach ($imagenes as $img): ?>
								<?php if ($img['id_prod'] == $item['id_producto']): ?>
									<?php $imgsForProd = true ?>
									<?php if ($img['principal'] == 1): ?>
										<?php 
											$mainImg = true;
											$rutaMainImg = $img['ruta'];
										?>
									<?php endif ?>
								<?php endif ?>
							<?php endforeach ?>
	
							<?php if ($imgsForProd == true): ?>
								<?php if ($mainImg == true): ?>
									<img src="<?= $rutaMainImg ?>" alt="No se pudo cargar la imagen">
								<?php else: ?>
									<?php foreach ($imagenes as $noMainImg): ?>
										<?php if ($noMainImg['id_prod'] == $item['id_producto']): ?>
											<img src="<?= $noMainImg['ruta'] ?>" alt="No se pudo cargar">
										<?php endif ?>
									<?php endforeach ?>
								<?php endif ?>
							<?php else: ?>
								<span class="noImgs">No hay imagenes para este producto <i class="fa fa-exclamation-circle"></i></span>
							<?php endif ?>
						</div>
						<div class="options">
							<div class="opt">
								<span class="editarCant" idProd="<?= $item['id_producto'] ?>">
									<i class="fa fa-edit" idProd="<?= $item['id_producto'] ?>"></i> 
									<pre idProd="<?= $item['id_producto'] ?>"> Editar cantidad</pre>
								</span>
							</div>
							<div class="opt">
								<form class="form_eliminar" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
									<input type="hidden" name="idCarritoDelete" value="<?php echo $item['id'] ?>">
									<input type="hidden" name="itemName" value="<?php echo $item['nombre'] ?>">
									<input type="submit" id="eliminar<?= $item['id_producto'] ?>" name="delete_item" value="X">
									<label for="eliminar<?= $item['id_producto'] ?>" class="btn_eliminar">
										<i class="fa fa-trash"></i><pre> Eliminar</pre>
									</label>
								</form>
							</div>
						</div>
					</div>
					<div class="info_carrito">
						<div class="header">
							<div class="art">
								<span><?= $item['nombre'] ?></span>
							</div>
						</div>
						<div class="info">
							<div class="field">	
								<span class="title">Precio:</span>
								<span class="value precio" idProd="<?= $item['id_producto'] ?>">$<?= $item['precio'] ?></span>
							</div>
							<div class="field">	
								<span class="title">Cantidad:</span>
								<form class="hidden cantidad" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
									<input type="hidden" value="<?php echo $item['id'] ?>" name="idcarrito">
									<input type="hidden" value="<?php echo $item['id_producto'] ?>" name="idprod">
									<input type="hidden" value="<?php echo $item['id_user'] ?>" name="iduser">
									
									<select name="quantity" idProd="<?= $item['id_producto'] ?>">
										<?php for ($i = 1; $i <= 10; $i++): ?>
											<?php if ($i == $item['cantidad']): ?>
												<option value="<?= $i ?>" selected><?= $i ?></option>
											<?php else: ?>
												<option value="<?= $i ?>"><?= $i ?></option>
											<?php endif ?>
										<?php endfor ?>
									</select>
									<input 	type="submit" 
											class="updateQuantity" 
											id="updateQuantity<?= $item['id_producto'] ?>"
											name="actualizar_cantidad"
									>
								</form>
								<span class="value cantidad"  idProd="<?= $item['id_producto'] ?>">
									<?= $item['cantidad'] ?>
								</span>	
								<label for="updateQuantity<?= $item['id_producto'] ?>" class="hidden" title="Aceptar">
									<i class="fa fa-check-circle"></i>
								</label>
								<!-- cancelEditQuantity -->
								<div class="hidden cancelEQ" idProd="<?= $item['id_producto'] ?>">
									<i class="fa fa-times-circle" title="Cancelar"></i>
								</div>
							</div>
							<div class="field">	
								<span class="title">Subtotal (producto):</span>
								<span class="value subtotalProd" idProd="<?= $item['id_producto'] ?>">$<?= $subtotalProd ?></span>
							</div>
						</div>
					</div>
				</div>
				<?php $subtotal += ($item['precio']*$item['cantidad']) ?>
				<?php $cantItems += $item['cantidad'] ?>
			<?php endforeach ?>
			<div class="carrito_subtotal">
				<div class="subtotal">Subtotal (<?= $cantItems ?> items): <span>$<?php echo  $subtotal ?></span></div>
				<div class="goToCheckout">
					<form action="checkout.php" method="POST">
						<input type="submit" name="carrito_checkpoint" class="checkout" value="Ir a caja">
					</form>
				</div>
			</div>
		<?php else: ?>
			<p>El carrito est&aacute; vac&iacute;o</p>
		<?php endif ?>
	</div>

	<!-- <div id="modal-container">
    	<div class="modal-background">
      		<div class="modal">
        			<form class="eliminar_item" action="<?php //echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
        				<input type="hidden" id="id_delete" name="idDelete" value="<?php //echo $id_eliminar ?>">
        				<span>Esta a punto de eliminar <?php //echo $item_nombre ?> del carrito</span><br />
        				<span>Confirme que desea</span><br />
        				<input type="submit" name="delete" value="Eliminar">
        			</form>
        			<svg class="modal-svg" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" preserveAspectRatio="none">
  				<rect x="0" y="0" fill="none" width="226" height="162" rx="3" ry="3"></rect>
  			</svg>
      		</div>
    	</div>
    	
  	</div> -->

	<?php require 'footer.php' ?>
	
	<script src="script/js/functions.js"></script>
	<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
	<script  src="script/js/modal.js"></script>

</body>
</html>