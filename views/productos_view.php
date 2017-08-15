<!DOCTYPE html>
<html>
<head>
	<title>Productos</title>
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
	</header>

	<div class="contenedor_prod">
		<?php if ($productos != false): ?>
			<?php foreach ($productos as $producto): ?>
				<div class="producto">
					<img src="<?php echo $producto['imagen'] ?>" alt="">
					<a href="#"><h2><?php echo $producto['nombre'] ?></h2></a>
				</div>
			<?php endforeach ?>
		<?php else: ?>
			<p>Actualmente no hay productos disponibles en esta categoria.</p>
		<?php endif ?>
	</div>

</body>
</html>