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
					<img src="<?php echo $producto['imagen'] ?>" alt="">
					<h2><?php echo $producto['nombre'] ?></h2>
					<div class="prod_options">
						<a class="detalles" href="detalles.php?id_prod=<?php echo $producto['id'] ?>">Detalles</a>
						<form class="shortcut_carrito" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
							<input type="hidden" name="id_producto" value="<?php echo $producto['id'] ?>">

							<?php if ($user != "Invitado"): ?>
								<input type="submit" class="carrito" name="shortcut_carrito" value="Carrito">
							<?php else: ?>
								<div id="two" class="button carrito">Carrito</div>
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