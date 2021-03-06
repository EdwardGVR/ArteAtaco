<?php 
	$user_img = get_user_img($conexion, $iduser);
	$qtyItems = getShpCarQty($iduser);
	$userLevel = get_user_data($conexion, $iduser);
	$userLevel = $userLevel['level'];
 ?>

<div class="bar">

	<div class="home">
		<a href="categorias.php"><i class="fa fa-home"></i></a>
	</div>

	<div class="bar-options">
		<div class="dropmenu bar-btn">
			<a href="categorias.php"><h1 class="drop-btn categorias">Categor&iacute;as</h1></a>
			<div class="drop-content">
				<?php foreach ($categorias as $categoria): ?>
					<?php if ($categoria['id'] != 1): ?>
						<a href="productos.php?id=<?= $categoria['id'] ?>"><?= $categoria['nombre_cat'] ?></a>
					<?php else: ?>
						<a href="productos.php?id=otros"><?= $categoria['nombre_cat'] ?></a>
					<?php endif ?>
				<?php endforeach ?>
			</div>
		</div>
			<a href="contacto.php" class="bar-btn">Contacto</a>
			<a class="bar-btn">A cerca</a>
	</div>

	<div class="user">		
		<div class="dropmenu">
			<?php if (isset($_SESSION['user'])): ?>
				<h1 class="user-btn"><?= $user ?>
					&nbsp;<i class="fa fa-chevron-circle-down" aria-hidden="true"></i>
				</h1>
				<div class="drop-content">
					<a href="cuenta.php"><span>Cuenta</span> <i class="fa fa-user"></i> </a>
					<a href="pedidos.php"><span>Pedidos</span> <i class="fa fa-shopping-bag"></i> </a>
					<a href="carrito.php"><span>Carrito (<?= $qtyItems ?>)</span> <i class="fa fa-shopping-cart"></i> </a>
					<?php if ($userLevel > 1): ?>
						<a class="admin" href="admin"><span>Administrar</span> <i class="fas fa-tools"></i> </a>
					<?php endif ?>
					<a href="logout.php"><span>Salir</span><i class="fas fa-sign-out-alt"></i></a>
				</div>
			<?php else: ?>
				<h1 class="user-btn"><?= $user ?> &nbsp; <i class="fas fa-user-circle"></i></h1>
				<div class="drop-content">
					<a href="login.php">Iniciar Sesi&oacute;n</a>
					<a href="register.php">Registrarse</a>
				</div>
			<?php endif ?>
		</div>
		
		<?php if (isset($user_img)): ?>
			<?php if ($user_img != false): ?>
				<a href="cuenta.php"><img class="user_img" src="<?= $user_img ?>" alt="N/A"></a>
			<?php else: ?>
				<div class="user_img"><a href="cuenta.php"><i class="fas fa-user-circle"></i></a></div>
			<?php endif ?>
		<?php endif ?>
	</div>
</div>

<div class="bar_hidden"></div>