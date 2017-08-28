<!DOCTYPE html>
<html>
<head>
	<!-- lightbox -->
	<link href="script/css/lightbox.css" rel="stylesheet">

	<title>Detalles :: <?php echo $detalles['nombre'] ?></title>
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 
	<link rel="stylesheet" href="css/styles.css">
</head>
<body>
	<header>
		<div class="bar">
			<a href="categorias.php"><img src="images/home.png" alt=""></a>
				<div class="dropmenu">
					<h1 class="drop-btn"><?php echo $user ?></h1>
						<?php if (isset($_SESSION['user'])): ?>
							<div class="drop-content">
								<a href="#">Cuenta</a>
								<a href="#">Pedidos</a>
								<a href="logout.php">Cerrar Sesi&oacute;n</a>
							</div>
						<?php else: ?>
							<div class="drop-content">
								<a href="login.php">Iniciar Sesi&oacute;n</a>
								<a href="register.php">Registrarse</a>
							</div>
						<?php endif ?>
				</div>
		</div>
		<div class="bar_hidden"></div>
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
							<img onmousemove="javascript:document.getElementById('imgDefault').src='http://lorempixel.com/200/200/cats';" src="http://lorempixel.com/200/200/cats" alt="">
						</a>
						<a href="http://lorempixel.com/720/960/sports" data-lightbox="product" data-title="Producto">
							<img onmousemove="javascript:document.getElementById('imgDefault').src='http://lorempixel.com/200/200/sports';" src="http://lorempixel.com/200/200/sports" alt="">
						</a>
						<a href="http://lorempixel.com/720/960/city" data-lightbox="product" data-title="Producto">
							<img onmousemove="javascript:document.getElementById('imgDefault').src='http://lorempixel.com/200/200/city';" src="http://lorempixel.com/200/200/city" alt="">
						</a>
					</div>
					    <a href="<?php echo $detalles['imagen'] ?>" data-lightbox="product" data-title="Producto">
					    	<img id="imgDefault" src="<?php echo $detalles['imagen'] ?>" alt="">
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
	<!-- lightbox -->
	<script src="script/js/lightbox-plus-jquery.js"></script>
	<script>
    lightbox.option({
      'wrapAround': true,
    })
	</script>
</body>
</html>