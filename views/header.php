<div class="bar">

	<a href="categorias.php"><i class="fa fa-home" style="color: #fff"></i></a>

	<div class="bar-options">
		<div class="dropmenu categorias">
			<a href="categorias.php"><h1 class="drop-btn categorias">categorias</h1></a>
			<div class="drop-content">
				<?php foreach ($categorias as $categoria): ?>
					<a href="productos.php?id=<?php echo $categoria['id'] ?>"><?php echo $categoria['nombre_cat'] ?></a>
				<?php endforeach ?>
			</div>
		</div>
			<a class="drop-btn">Opciones</a>
			<a class="drop-btn">Opcion</a>
			<a class="drop-btn">Contacto</a>
			<a class="drop-btn">A cerca</a>
	</div>

	<div class="dropmenu">
			<?php if (isset($_SESSION['user'])): ?>
				<h1 class="user"><?php echo $user ?></h1>
				<div class="drop-content">
					<a href="#">Cuenta</a>
					<a href="#">Pedidos</a>
					<a href="logout.php">Cerrar Sesi&oacute;n</a>
				</div>
			<?php else: ?>
				<h1 class="user"><?php echo $user ?> <i class="fa fa-user-plus"></i></h1>
				<div class="drop-content">
					<a href="login.php">Iniciar Sesi&oacute;n</a>
					<a href="register.php">Registrarse</a>
				</div>
			<?php endif ?>
	</div>
</div>

<div class="bar_hidden"></div>