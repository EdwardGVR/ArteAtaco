<!DOCTYPE html>
<html>
<head>
	<title> Arte Ataco ::
		<?php 
			echo $categoria['nombre_cat'];
			$cat_actual = $categoria['nombre_cat'];
	 	?>
	 </title>
	<link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 
	<link rel="stylesheet" href="css/styleModal.css">
	<link rel="stylesheet" href="css/styles.css">
</head>
<body>

<?php require("messenger_contact.php") ?>

	<header>
		<?php require 'header.php' ?>
	</header>

	<div class="contenedor_prod">

	<div id="modal-container">
	    <div class="modal-background">
	      <div class="modal">
	        <h2>Para continuar por favor inicia sesi&oacute;n o registrate</h2>
	        <div class="btns">
	        	<a href="login.php" class="boton">Aceptar</a>
	        </div>
	        <svg class="modal-svg" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" preserveAspectRatio="none">
	    	<rect x="0" y="0" fill="none" width="226" height="162" rx="3" ry="3"></rect>
	        </svg>
	      </div>
	    </div>
	  </div>

		<?php if ($productos != false): ?>
			<?php foreach ($productos as $producto): ?>
				<div class="producto">

					<div class="prod-img">
						<?php $imgsPorProd = 0; $mainImg = false; ?>
						<?php foreach ($catImgs as $catImg): ?>
							<?php if ($catImg['id_prod'] == $producto['id']): ?>
								<?php ++$imgsPorProd ?>
								<?php if ($catImg['principal']): ?>
									<?php $mainImg = true; $mainImgPath = $catImg['ruta']; ?>
								<?php endif ?>
							<?php endif ?>
						<?php endforeach ?>

						<?php if ($imgsPorProd > 0): ?>	
							<?php if ($mainImg == true): ?>
								<img src="<?= $mainImgPath ?>" alt="">
							<?php else: ?>
								<?php foreach ($catImgs as $provImg): ?>
									<?php if ($provImg['id_prod'] == $producto['id']): ?>
										<img src="<?= $provImg['ruta'] ?>" alt="">
										<?php break; ?>
									<?php endif ?>
								<?php endforeach ?>
							<?php endif ?>
						<?php elseif ($imgsPorProd == 0): ?>
							<div class="noImg">
								<span>
									Actualmente no hay imagenes para este producto 
									<i class="fa fa-image"></i> 
									<i class="fa fa-exclamation-circle"></i>
								</span>
							</div>
						<?php endif ?>
					</div>

					<div class="prod-nombre">
						<?= $producto['nombre'] ?>
					</div>

					<div class="prod-precio">
						<span><?= '$' . $producto['precio'] ?> <i class="fa fa-tag"></i></span>
					</div>

					<div class="prod-options">
						<a class="opt detalles" href="detalles.php?id_prod=<?php echo $producto['id'] ?>">Detalles <i class="fa fa-info-circle"></i></a>
						<form class="opt shortcut_carrito" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
							<input type="hidden" name="id_producto" value="<?php echo $producto['id'] ?>">

							<?php if ($user != "Invitado"): ?>
								<input type="submit" class="carrito" name="shortcut_carrito" value="Carrito">
							<?php else: ?>
								<div id="two" class="button carrito">Carrito <i class="fa fa-cart-plus fa-lg"></i></div>
							<?php endif ?>	
						</form>
					</div>

				</div>
			<?php endforeach ?>
		<?php else: ?>
			<p>Actualmente no hay productos disponibles en la categoria de <?php echo $cat_actual ?>.</p>
		<?php endif ?>
	</div>

	<?php include 'footer.php'; ?>
	
	<script src="script/js/functions.js"></script>
	<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
	<script  src="script/js/modal.js"></script>

</body>
</html>