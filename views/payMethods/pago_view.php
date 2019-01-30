<!DOCTYPE html>
<html>
<head>
	<title>Arte Ataco :: Pago</title>
	<link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 
	<link rel="stylesheet" href="css/styleModal.css"> 
	<link rel="stylesheet" href="css/styles.css">
</head>
<body>
<?php require "views/messenger_contact.php" ?>
<?php require 'views/header.php' ?>
	
<div class="contenedor_pago">
	<div class="pago">
		Pagina para realizar pago
	</div>
	
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