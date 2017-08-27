<!DOCTYPE html>
<html>
<head>
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
						<img src="http://lorempixel.com/25/25" alt="">
						<img src="http://lorempixel.com/25/25/cats" alt="">
						<img src="http://lorempixel.com/25/25/sports" alt="">
						<img src="http://lorempixel.com/25/25/city" alt="">
					</div>
					<img src="<?php echo $detalles['imagen'] ?>" alt="">
					<div class="img-info">
						<p>Lorem ipsum dolor sit amet.</p>
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
</body>
</html>