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

<?php require("messenger_contact.php") ?>
<?php require 'header.php' ?>
	
<div class="contenedor_pago">
	<div class="pago">
		<?php if ($id_metodo_pago == 1): ?>
			<h3 class="info">A continuaci&oacute;n los 	detalles de la cuenta:</h3>
			<div class="info">N&uacute;mero: <h4>xxxx-xxxx-xxxx-xxxx</h4></div>
			<div class="info">Banco: <h4>Nombre banco</h4></div>
			<div class="info">Titular: <h4>Nombre del titular</h4></div>
		<?php elseif($id_metodo_pago == 2): ?>
			3
		<?php elseif($id_metodo_pago == 3): ?>
			4
		<?php endif ?>
	</div>
	<div class="nota">El dep&oacute;sito debe hacerse a la mayor brevedad posible.</div>
	<div class="hacer_pedido">
		<form class="place_order" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
			<input type="hidden" name="order_code" value="<?php echo $codigo ?>">
			<input type="submit" name="place_order" value="Hacer pedido">
		</form>
	</div>
</div>

<?php require 'footer.php' ?>

<script src="script/js/functions.js"></script>

</body>
</html>