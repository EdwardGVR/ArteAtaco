<!DOCTYPE html>
<html>
<head>
	<title>Arte Ataco :: Categorias</title>
	<link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 
	<link rel="stylesheet" href="css/styles.css">
</head>
<body>

<?php require("messenger_contact.php") ?>

	<header>
		<?php require 'header.php' ?>
	</header>
	
	<div class="contenedor_cat">
		<!-- <div class="titulo_cat">
			<h2>Selecciona una categor&iacute;a</h2>
		</div> -->
		<?php foreach ($categorias as $categoria): ?>
			<div class="contCat" data-aos="zoom-out-up">
				<div class="contenedor_tarjeta">
					<figure>
						<img src="<?= $categoria['imagen'] ?>" class="frontal" alt="">
						<a href="productos.php?id=<?= $categoria['id'] ?>">
							<span class="nombre-front"><?= $categoria['nombre_cat'] ?></span>
						</a>
						<figcaption class="trasera">
							<h2 class="titulo"><?= $categoria['nombre_cat'] ?></h2>
							<hr>
							<p>
								Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur amet minus facilis ratione, delectus distinctio eius upiditate nesciunt recusandae rerum quasi cum blanditiis, placeat, saepe!
							</p>
							<a href="productos.php?id=<?= $categoria['id'] ?>">
								<span class="link-cat">Ver <?= $categoria['nombre_cat'] ?></span>
							</a>
						</figcaption>
					</figure>
				</div>
				<div class="randomProds">
					<?php $prodCount = 0; ?>
					<?php foreach ($productos AS $prod): ?>
						<?php if ($prod['id_categoria'] == $categoria['id'] && $prodCount <3): ?>
							<?php $prodCount++; ?>
						<?php endif ?>
					<?php endforeach ?>
					<div class="randProd">
						<?= $prodCount ?>
					</div>
					<div class="randProd">

					</div>
					<div class="randProd">

					</div>
					<a class="seeAll" href="productos.php?id=<?= $categoria['id'] ?>">
						<span>Ver todo en <?= $categoria['nombre_cat'] ?></span>
					</a>
				</div>
			</div>
		<?php endforeach ?>
	</div>

	<?php include 'footer.php'; ?>
	
	<script src="script/js/functions.js"></script>
	<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  	<script>
    	AOS.init();
  	</script>
</body>
</html>