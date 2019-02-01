<!DOCTYPE html>
<html>
<head>
	<title>Arte Ataco :: Pago</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 
	<link rel="stylesheet" href="css/styleModal.css"> 
	<link rel="stylesheet" href="css/styles.css">
	<link rel="stylesheet" href="payMethods/css/styles.css">
</head>
<body>
<?php require "views/messenger_contact.php" ?>
<?php require 'views/header.php' ?>
	
<div class="contenedor_pago">
	<div class="pago">
		<h3 class="info">A continuaci&oacute;n los 	detalles de la cuenta:</h3>
		<?php foreach ($datosMetodo as $dat): ?>
			<div class="info"><?= $dat['dato'] ?> <h4><?= $dat['valor'] ?></h4></div>
		<?php endforeach ?>
	</div>

	<div class="nota">El dep&oacute;sito debe hacerse a la mayor brevedad posible.</div>
	
	<div class="hacer_pedido">
		<form class="place_order" action="" method="POST">
			<input type="hidden" name="order_code" value="<?= $codigo ?>">
			<input type="submit" name="place_order" value="Hacer pedido">
		</form>
	</div>
</div>

<?php require 'views/footer.php' ?>
<script src="script/js/functions.js"></script>
</body>
</html>