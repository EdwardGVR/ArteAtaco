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
			<?php if ($categoria['id'] != 1): ?>
				<?php $name = html_entity_decode($categoria['nombre_cat']) ?>
				<?php $desc = html_entity_decode($categoria['descripcion']) ?>
				<div class="contCat" data-aos="zoom-out-up">
					<div class="contenedor_tarjeta">
						<figure>
							<img src="<?= $categoria['imagen'] ?>" class="frontal" alt="">
							<a href="productos.php?id=<?= $categoria['id'] ?>">
								<span class="nombre-front"><?= $name ?></span>
							</a>
							<figcaption class="trasera">
								<h2 class="titulo"><?= $name ?></h2>
								<hr>
								<p><?= $desc ?></p>
								<a href="productos.php?id=<?= $categoria['id'] ?>">
									<span class="link-cat">Ver <?= $name ?></span>
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
											<div class="detailsHover">
												<span>Ver detalles <i class="fa fa-info-circle"></i></span>
											</div>
										<?php if ($imgsCounter > 0): ?>
											<img src="<?= $imgPath ?>" alt="...">
										<?php else: ?>
											<span class="randProdName"><?= $prod['nombre'] ?></span>
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
								<span>Ver todo en <?= $name ?></span>
							</a>
						<?php endif ?>
					</div>
				</div>
			<?php else: ?>
				<?php $imgOthers = $categoria['imagen'];
					  $descOthers = $categoria['descripcion']; ?>
			<?php endif ?>
		<?php endforeach ?>

		<?php if ($prodsOther != false): ?>
			<div class="contCat" data-aos="zoom-out-up">
				<div class="contenedor_tarjeta">
					<figure>
						<img src="<?= $imgOthers ?>" class="frontal" alt="No se pudo mostrar">
						<a href="productos.php?id=others">
							<span class="nombre-front">Otros</span>
						</a>
						<figcaption class="trasera">
							<h2 class="titulo">Otros</h2>
							<hr>
							<p>
								<?= $descOthers ?>
							</p>
							<a href="productos.php?id=otros">
								<span class="link-cat">Ver Otros</span>
							</a>
						</figcaption>
					</figure>
				</div>
				<div class="randomProds">
					<?php $prodOthersCount = 0; ?>
					<?php foreach ($prodsOther as $prod): ?>
						<?php if ($prod['to_others'] == 1 && $prodOthersCount <3): ?>
							<?php $prodOthersCount++; ?>
							<?php if ($prodOthersCount > 0): ?>
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
										<div class="detailsHover">
											<span>Ver detalles <i class="fa fa-info-circle"></i></span>
										</div>
									<?php if ($imgsCounter > 0): ?>
										<img src="<?= $imgPath ?>" alt="...">
									<?php else: ?>
										<span class="randProdName"><?= $prod['nombre'] ?></span>
									<?php endif ?>
									</a>
								</div>
							<?php endif ?>
						<?php endif ?>
					<?php endforeach ?>
					<?php if ($prodOthersCount == 0): ?>
						<div class="noProds">
							<span>Actualmente no hay productos en esta categor&iacute;a</span>
						</div>
					<?php else: ?>
						<a class="seeAll" href="productos.php?id=otros">
							<span>Ver todo en Otros</span>
						</a>
					<?php endif ?>
				</div>
			</div>
		<?php endif ?>

		<?php if ($categorias == false): ?>
			<span class="noCats">No hay categor&iacute;as disponibles actualmente</span>
		<?php endif ?>
	</div>

	<?php include 'footer.php'; ?>
	
	<script src="script/js/functions.js"></script>
	<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  	<script>
    	AOS.init();
  	</script>
</body>
</html>