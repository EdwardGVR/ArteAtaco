<?php 
		
	$user_img = get_user_img($conexion, $iduser);
	$qtyItems = getShpCarQty($iduser);
	$userLevel = get_user_data($conexion, $iduser);
	$userLevel = $userLevel['level'];

 ?>

<div class="bar">

	<div class="home">
		<a href="categorias.php"><i class="fa fa-home" style="color: #fff"></i></a>
	</div>

	<div class="bar-options">
		<div class="dropmenu bar-btn">
			<a href="categorias.php"><h1 class="drop-btn categorias">Categorias</h1></a>
			<div class="drop-content">
				<?php foreach ($categorias as $categoria): ?>
					<a href="productos.php?id=<?= $categoria['id'] ?>"><?= $categoria['nombre_cat'] ?></a>
				<?php endforeach ?>
			</div>
		</div>
			<a class="bar-btn">Opciones</a>
			<a class="bar-btn">Opcion</a>
			<a href="contacto.php" class="bar-btn">Contacto</a>
			<a class="bar-btn">A cerca</a>
	</div>

	<div class="user">		
		<div class="dropmenu">
				<?php if (isset($_SESSION['user'])): ?>
					<h1 class="user-btn"><?= $user ?> <i class="fa fa-chevron-circle-down" aria-hidden="true"></i>
</h1>
					<div class="drop-content">
						<a href="cuenta.php"><span>Cuenta</span> <i class="fa fa-user"></i> </a>
						<a href="pedidos.php"><span>Pedidos</span> <i class="fa fa-shopping-bag"></i> </a>
						<a href="carrito.php"><span>Carrito (<?= $qtyItems ?>)</span> <i class="fa fa-shopping-cart"></i> </a>
						<?php if ($userLevel == 2): ?>
							<a class="admin" href="admin"><span>Administrar</span> <i class="fa fa-sliders"></i> </a>
						<?php endif ?>
						<a href="logout.php">Cerrar Sesi&oacute;n <i class="fa fa-sign-out"></i> </a>
					</div>
				<?php else: ?>
					<h1 class="user-btn"><?= $user ?> <i class="fa fa-user-plus"></i></h1>
					<div class="drop-content">
						<a href="login.php">Iniciar Sesi&oacute;n</a>
						<a href="register.php">Registrarse</a>
					</div>
				<?php endif ?>
		</div>
		<!-- Condicion imagen -->
		<?php if (isset($user_img)): ?>
			<?php if ($user_img != false): ?>
				<a href="cuenta.php"><img class="user_img" src="<?= $user_img ?>" alt="N/A"></a>
			<?php else: ?>
				<div class="user_img"><a href="cuenta.php"><i class="fa fa-user-circle"></i></a></div>
			<?php endif ?>
		<?php endif ?>
	</div>
</div>

<div class="bar_hidden"></div>