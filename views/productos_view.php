<!DOCTYPE html>
<html>
<head>
	<title>
		<?php 
			echo $categoria['nombre_cat'];
			$cat_actual = $categoria['nombre_cat'];
	 	?>
	 </title>
	<link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 
	<link rel="stylesheet" href="css/styles.css">
</head>
<body>
	<header>
		<?php require 'header.php' ?>
	</header>

	<div class="contenedor_prod">
		<?php if ($productos != false): ?>
			<?php foreach ($productos as $producto): ?>
				<div class="producto">
					<img src="<?php echo $producto['imagen'] ?>" alt="">
					<h2><?php echo $producto['nombre'] ?></h2>
					<div class="prod_options">
						<a class="detalles" href="detalles.php?id_prod=<?php echo $producto['id'] ?>">Detalles</a>
						<a class="carrito" href="#">Carrito</a>
					</div>
				</div>
			<?php endforeach ?>
		<?php else: ?>
			<p>Actualmente no hay productos disponibles en la categoria de <?php echo $cat_actual ?>.</p>
		<?php endif ?>
	</div>

	<?php include 'footer.php'; ?>

</body>
</html>