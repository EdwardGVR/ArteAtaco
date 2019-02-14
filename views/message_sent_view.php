<!DOCTYPE html>
<html>
<head>
	<title>Arte Ataco :: Mensaje enviado</title>

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 
	<link rel="stylesheet" href="css/styles.css">
</head>
<body>
	<?php require 'header.php' ?>

	<div class="contenedor_mensaje_enviado">
		<span>Su mensaje fue enviado con &eacute;xito, pronto nos pondremos en contacto <i class="fa fa-check"></i></span>
		<div class="botones">
			<a href="categorias.php">Ir a categorias</a>
			<?php if ($iduser != false): ?>
				<a href="cuenta.php">Ir a cuenta</a>
			<?php endif ?>
		</div>
	</div>

	<?php require 'footer.php' ?>
</body>
</html>