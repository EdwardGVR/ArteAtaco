<!DOCTYPE html>
<html>
<head>
	<title>Arte Ataco :: Datos del pedido</title>

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 
	<link rel="stylesheet" href="css/styleModal.css"> 
	<link rel="stylesheet" href="css/styles.css">
</head>
<body>

 <?php //require 'header.php' ?>

<div class="contenedor_placed">
	<h3>Hemos tomado su pedido</h3>
	<h4>C&oacute;digo: #<?= $recent_code['codigo'] ?></h4>
	<a href="pedidos.php" class="btn_placed">Ir a pedidos</a>
	<a href="categorias.php" class="btn_placed">Ir a categor&iacute;as</a>
</div>

<?php require 'footer.php' ?>

</body>
</html>