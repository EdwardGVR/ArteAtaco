<!DOCTYPE html>
<html>
<head>
	<title>Arte Ataco :: Datos del pedido</title>

	<link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 
	<link rel="stylesheet" href="css/styleModal.css"> 
	<link rel="stylesheet" href="css/styles.css">
</head>
<body>

<?php require 'header.php' ?>
	
<? switch($id_metodo_pago) : case 1 : ?>

  <div>One</div>

<? break; case 2 : ?>

  <div>Two</div>

<? break; case 3 : ?>

  <div>Three</div>

<? break; endswitch; ?>

<?php require 'footer.php' ?>

</body>
</html>