	<!DOCTYPE html>
<html>
<head>
	<title>Categorias</title>
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 
	<link rel="stylesheet" href="css/styles.css">
</head>
<body>
	<header>
		<?php require 'header.php' ?>
	</header>
	
	<div class="contenedor_cat">
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
</body>
</html>