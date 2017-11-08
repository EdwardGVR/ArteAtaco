<!DOCTYPE html>
<html>
<head>
	<!-- lightbox -->
	<link href="script/css/lightbox.css" rel="stylesheet">

	<title>Detalles :: <?php echo $detalles['nombre'] ?></title>
	<link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 
	<link rel="stylesheet" href="css/styles.css">
</head>
<body>
	<header>
		<?php require 'header.php' ?>
	</header>

	<div class="contenedor_detalles">
		<?php if ($detalles != false): ?>
			<div class="detalles-prod">
				<div class="detalles-prod-img">
					<div class="mini-img">
						<a href="<?php echo $detalles['imagen'] ?>" data-lightbox="product" data-title="Producto">
							<img onmousemove="javascript:document.getElementById('imgDefault').src='<?php echo $detalles['imagen'] ?>';"
							 src="<?php echo $detalles['imagen'] ?>" alt="">
						</a>
						<a href="http://lorempixel.com/720/960/cats" data-lightbox="product" data-title="Producto">
							<img onmousemove="javascript:document.getElementById('imgDefault').src='http://lorempixel.com/720/960/cats';"
							 src="http://lorempixel.com/200/200/cats" alt="">
						</a>
						<a href="http://lorempixel.com/720/960/food" data-lightbox="product" data-title="Producto">
							<img onmousemove="javascript:document.getElementById('imgDefault').src='http://lorempixel.com/720/960/food';" src="http://lorempixel.com/200/200/food" alt="">
						</a>
						<a href="http://lorempixel.com/720/960/city" data-lightbox="product" data-title="Producto">
							<img onmousemove="javascript:document.getElementById('imgDefault').src='http://lorempixel.com/720/960/city';" src="http://lorempixel.com/200/200/city" alt="">
						</a>
					</div>
					    <a id="principal" onmousemove="cambiarEnlace()" href="<?php echo $detalles['imagen'] ?>" data-lightbox="product" data-title="Producto">
					    	<img class="img_default" id="imgDefault" src="<?php echo $detalles['imagen'] ?>" alt="">
					    </a>
					<div class="img-info">
						<p>Click sobre una imagen para ampliarla  </p>
					</div>
				</div>
				<div class="detalles-prod-info">
					<h2 class="item">Producto: <?php echo $detalles['nombre'] ?></h2>
					<hr>
					<h2 class="precio">Precio:</br> <?php echo '$'.$detalles['precio'] ?></h2>
					<a href="#" class="comprar">opci&oacute;n 1</a>
					<a href="#" class="carrito-prod">opci&oacute;n 2</a>
					<h2 class="descripcion">Descripci&oacute;n:</br> <?php echo $detalles['descripcion'] ?></h2>
					<h2 class="stock">Disponibles:</br> <?php echo $detalles['stock'] . ' unidades' ?></h2>
				</div>
			</div>
		<?php else: ?>
			<h3>No se ha encontrado el producto.</h3>
		<?php endif ?>
	</div>
	
	<div class="contenedor_detalles">
		<img src="http://lorempixel.com/300/300/food" alt="">
	</div>

<?php include 'footer.php'; ?>

	<!-- lightbox -->
	<script src="script/js/lightbox-plus-jquery.js"></script>
	<script>
    		lightbox.option({
      		'wrapAround': true,
    		})

    		function cambiarEnlace() {
    			var imgDefault = document.getElementById("imgDefault"),
    				enlaceDefault = document.getElementById("principal");

    			enlaceDefault.href = imgDefault.src;
    		}
	</script>
</body>
</html>