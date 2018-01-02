<div class="bar">

	<div class="home">
		<a href="categorias.php"><i class="fa fa-home" style="color: #fff"></i></a>
	</div>

	<div class="bar-options">
		<div class="dropmenu bar-btn">
			<a href="categorias.php"><h1 class="drop-btn categorias">Categorias</h1></a>
			<div class="drop-content">
				<?php foreach ($categorias as $categoria): ?>
					<a href="productos.php?id=<?php echo $categoria['id'] ?>"><?php echo $categoria['nombre_cat'] ?></a>
				<?php endforeach ?>
			</div>
		</div>
			<a class="bar-btn">Opciones</a>
			<a class="bar-btn">Opcion</a>
			<a class="bar-btn">Contacto</a>
			<a class="bar-btn">A cerca</a>
	</div>

	<div class="user">
		<div class="dropmenu">
				<?php if (isset($_SESSION['user'])): ?>
					<h1 class="user-btn"><?php echo $user ?></h1>
					<div class="drop-content">
						<a href="#">Cuenta</a>
						<a href="pedidos.php">Pedidos</a>
						<a href="carrito.php">Carrito</a>
						<a href="logout.php">Cerrar Sesi&oacute;n</a>
					</div>
				<?php else: ?>
					<h1 class="user-btn"><?php echo $user ?> <i class="fa fa-user-plus"></i></h1>
					<div class="drop-content">
						<a href="login.php">Iniciar Sesi&oacute;n</a>
						<a href="register.php">Registrarse</a>
					</div>
				<?php endif ?>
		</div>
	</div>
</div>

<div class="bar_hidden"></div>