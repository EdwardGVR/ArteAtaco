<!DOCTYPE html>
<html>
<head>
	<title>Categorias</title>
	<link rel="stylesheet" href="css/styles.css">
</head>
<body>
	<header>
		<div class="bar">
			<img src="images/home.png" alt="">
			<a href="#"><h1><?php echo $user ?></h1></a>
		</div>
	</header>

	<div class="contenedor_cat">

			<?php foreach ($categorias as $categoria): ?>
					<!-- <div class="categoria">
						<img src="<?php //echo $categoria['imagen'] ?>" alt="">
						<a href="#"><h2><?php //echo $categoria['nombre_cat'] ?></h2></a>
					</div> -->
				<div class="contenedor_tarjeta">
						<figure>
							<img src="<?php echo $categoria['imagen'] ?>" class="frontal" alt="">
							<figcaption class="trasera">
								<h2 class="titulo"><?php echo $categoria['nombre_cat'] ?></h2>
								<hr>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur amet minus facilis ratione, delectus distinctio eius cupiditate nesciunt recusandae rerum quasi cum blanditiis, placeat, saepe!</p>
							</figcaption>
						</figure>
				</div>
			<?php endforeach ?>

	</div>

</body>
</html>