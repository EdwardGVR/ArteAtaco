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

 <?php //require 'header.php' ?>

<div class="contenedor_placed">
	<h3>Hemos tomado su pedido</h3>
	<h4>C&oacute;digo: #<?php echo $recent_code['codigo'] ?></h4>
	<a href="pedidos.php" class="btn_placed">Ir a pedidos</a>
	<a href="categorias.php" class="btn_placed">Ir a categor&iacute;as</a>
</div>

<?php require 'footer.php' ?>

</body>
</html>