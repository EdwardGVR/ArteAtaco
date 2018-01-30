	<!DOCTYPE html>
<html>
<head>
	<title>Arte Ataco :: Categorias</title>
	<link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 
	<link rel="stylesheet" href="css/styles.css">
</head>
<body>

<?php require("messenger_contact.php") ?>

	<header>
		<?php require 'header.php' ?>
	</header>
	
	<div class="contenedor_cat">
		<div class="titulo_cat">
			<h2>Selecciona una categor&iacute;a</h2>
		</div>
		<?php foreach ($categorias as $categoria): ?>
			<div class="contenedor_tarjeta">
				<figure>
					<img src="<?php echo $categoria['imagen'] ?>" class="frontal" alt="">
					<a href="productos.php?id=<?php echo $categoria['id'] ?>"><span class="nombre-front"><?php echo $categoria['nombre_cat'] ?></span></a>
					<figcaption class="trasera">
						<h2 class="titulo"><?php echo $categoria['nombre_cat'] ?></h2>
						<hr>
						<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur amet minus facilis ratione, delectus distinctio eius upiditate nesciunt recusandae rerum quasi cum blanditiis, placeat, saepe!
						</p>
						<a href="productos.php?id=<?php echo $categoria['id'] ?>"><span class="link-cat">Ver <?php echo $categoria['nombre_cat'] ?></span></a>
					</figcaption>
				</figure>
			</div>
		<?php endforeach ?>
	</div>

	<?php include 'footer.php'; ?>
	
	<script src="script/js/functions.js"></script>
</body>
</html>