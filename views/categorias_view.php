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
					<?php foreach ($productos as $prod): ?>
						<?php if ($prod['id_categoria'] == $categoria['id'] && $prodCount <3): ?>
							<?php $prodCount++; ?>
							<?php if ($prodCount > 0): ?>
								<!-- Validacion de imagenes -->
								<?php $imgsCounter = 0; $mainImg = false; 
								foreach ($imgs as $img) {
									if ($img['id_prod'] == $prod['id']) {
										$imgsCounter++;
										if ($imgsCounter > 0 && $img['principal'] == 1) {
											$mainImg = true; $imgPath = $img['ruta'];
										}
										if ($imgsCounter > 0 && !$mainImg) {
											$imgPath = $img['ruta'];
								}	}	}
								?>
								<div class="randProd" 
									 data-aos="fade-left"
									 data-aos-offset="250"
									 data-aos-easing="linear">
									<a class="randImgLink" href="detalles.php?id_prod=<?= $prod['id'] ?>">
									<?php if ($imgsCounter > 0): ?>
										<img src="<?= $imgPath ?>" alt="...">
									<?php else: ?>
										<span><?= $prod['nombre'] ?></span>
									<?php endif ?>
									</a>
								</div>
							<?php endif ?>
						<?php endif ?>
					<?php endforeach ?>
					<?php if ($prodCount == 0): ?>
						<div class="noProds">
							<span>Actualmente no hay productos en esta categor&iacute;a</span>
						</div>
					<?php else: ?>
						<a class="seeAll" href="productos.php?id=<?= $categoria['id'] ?>">
							<span>Ver todo en <?= $categoria['nombre_cat'] ?></span>
						</a>
					<?php endif ?>
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