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
				<a href="#" class="iconCircle">
					<i class="fa fa-home"></i>
				</a>
				<a href="#" class="iconCircle">
					<i class="fa fa-envelope"></i>
				</a>
			</div>
			<div class="headerSection">
				<span class="methodName">Metodo de pago</span>
			</div>
			<div class="headerSection">
				<a href="#" class="iconCircle">
					<i class="fa fa-user"></i>
				</a>
			</div>
			<hr>
		</div>
	</header>

	<main>
		<div class="mainCont">
			<div class="methodData">
				<span class="title">Datos del pago</span>
				<div class="data">
					<span class="label">Nombre del dato:</span>
					<hr>
					<span class="value">- - - - - Valor del dato - - - - -</span>
				</div>
				<div class="data">
					<span class="label">Nombre del dato:</span>
					<hr>
					<span class="value">- - - - - Valor del dato - - - - -</span>
				</div>
				<div class="data">
					<span class="label">Nombre del dato:</span>
					<hr>
					<span class="value">- - - - - Valor del dato - - - - -</span>
				</div>
				<div class="data">
					<span class="label">Nombre del dato:</span>
					<hr>
					<span class="value">- - - - - Valor del dato - - - - -</span>
				</div>
			</div>
			<div class="payConfirm">
				<form class="placeOrder" action="" method="POST">
					<input type="hidden" name="order_code" value="<?= $codigo ?>">
					<input type="submit" name="place_order" value="Hacer pedido">
					<span class="orderCode">C&oacute;digo: #00000</span>
				</form>

				<div class="totals">
					<div class="stage">
						<span class="label">Sub-total</span>
						<div class="icon"><i class="fa fa-shopping-cart"></i></div>
						<span class="mount">$00.00</span>
					</div>
					<div class="stage">
						<span class="label">Transporte</span>
						<div class="icon"><i class="fa fa-truck"></i></div>
						<span class="mount">$00.00</span>
					</div>
					<div class="stage">
						<span class="label">Total</span>
						<div class="icon"><i class="fa fa-cash-register"></i></div>
						<span class="mount total">$00.00</span>
					</div>
				</div>

				<form class="placeOrder" action="" method="POST">
					<span class="orderCode">C&oacute;digo: #00000</span>
					<input type="hidden" name="order_code" value="<?= $codigo ?>">
					<input type="submit" name="place_order" value="Hacer pedido">
				</form>
			</div>
		</div>
	</main>
		

	<script src="script/js/functions.js"></script>
	</body>
</html>