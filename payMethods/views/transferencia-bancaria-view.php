<!DOCTYPE html>
<html>
	<head>
		<title>Arte Ataco :: Pago</title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 
		<link rel="stylesheet" href="payMethods/css/styles.css">
	</head>
	<body>
		<header>
			<div class="headerCont">
				<div class="headerSection">
					<a href="checkout.php" class="iconCircle">
						<i class="fas fa-arrow-left"></i>
					</a>
					<a href="index.php" class="iconCircle">
						<i class="fa fa-home"></i>
					</a>
				</div>
				<div class="headerSection">
					<span class="methodName">
						<i class="<?= $infoMethod['icon'] ?>"></i>					
						<?= $infoMethod['nombre'] ?>
						<i class="<?= $infoMethod['icon'] ?>"></i>
					</span>
				</div>
				<div class="headerSection">
					<a href="contacto.php" class="iconCircle">
						<i class="fa fa-envelope"></i>
					</a>
					<a href="cuenta.php" class="iconCircle">
						<i class="fa fa-user"></i>
					</a>
				</div>
				<hr>
			</div>
		</header>

		<main>
			<div class="mainCont">
				<!-- <div class="error">
					<span>
						<i class="fas fa-exclamation-triangle"></i>
						Ups! sentimos los inconvenientes, ha ocurrido un error con este m&eacute;todo de pago,
						por favor intente seleccionar otro o vuelva de nuevo m&aacute;s tarde
						<i class="fas fa-exclamation-triangle"></i>
					</span>
				</div> -->

				<div class="methodData">
					<span class="title">Datos del pago</span>
					<div class="data">
						<span class="label">Info:</span>
						<hr>
						<span class="value info"><?= $infoMethod['info'] ?></span>
					</div>
					<?php if ($datosMethod != false): ?>
						<?php foreach ($datosMethod as $d): ?>
							<div class="data">
								<span class="label"><?= $d['dato'] ?>:</span>
								<hr>
								<span class="value"><?= $d['valor'] ?></span>
							</div>
						<?php endforeach ?>
					<?php endif ?>
				</div>

				<div class="payConfirm">
					<form class="placeOrder" action="" method="POST">
						<input type="hidden" name="order_code" value="<?= $codigo ?>">
						<input type="submit" name="place_order" value="Hacer pedido">
						<span class="orderCode">C&oacute;digo: #<?= $codigo ?></span>
					</form>

					<div class="totals">
						<div class="stage">
							<span class="label">Sub-total</span>
							<div class="icon"><i class="fa fa-shopping-cart"></i></div>
							<span class="mount">$<?= $subtotal ?></span>
						</div>
						<div class="stage">
							<span class="label">Transporte</span>
							<div class="icon"><i class="fa fa-truck"></i></div>
							<span class="mount"><?= $shippShown ?></span>
						</div>
						<div class="stage">
							<span class="label">Total</span>
							<div class="icon"><i class="fa fa-cash-register"></i></div>
							<span class="mount total">$<?= $total ?></span>
						</div>
						<div class="stageBar">
							<div class="barCircle"></div>
							<div class="barCircle"></div>
							<div class="barCircle"></div>
							<div class="barLine"></div>
						</div>
					</div>

					<form class="placeOrder" action="" method="POST">
						<span class="orderCode">C&oacute;digo: #<?= $codigo ?></span>
						<input type="hidden" name="order_code" value="<?= $codigo ?>">
						<input type="submit" name="place_order" value="Hacer pedido">
					</form>
				</div>
			</div>
		</main>
	</body>
</html>