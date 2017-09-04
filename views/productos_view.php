<!DOCTYPE html>
<html>
<head>
	<title><?php echo $categoria['nombre_cat'] ?></title>
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 
	<link rel="stylesheet" href="css/styles.css">
</head>
<body>
	<header>
		<div class="bar">
			<a href="categorias.php"><img src="images/home.png" alt=""></a>
				<div class="dropmenu">
					<h1 class="user"><?php echo $user ?></h1>
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
			<p>Actualmente no hay productos disponibles en la categoria de <?php echo $categoria['nombre_cat'] ?>.</p>
		<?php endif ?>
	</div>
</body>
</html>