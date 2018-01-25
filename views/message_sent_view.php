<!DOCTYPE html>
<html>
<head>
	<title>Arte Ataco :: Mensaje enviado</title>

	<link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 
	<link rel="stylesheet" href="css/styles.css">
</head>
<body>
	<?php require 'header.php' ?>

	<div class="contenedor_mensaje_enviado">
		<span>Su mensaje fue enviado con &eacute;xito, pronto nos pondremos en contacto <i class="fa fa-check"></i></span>
		<div class="botones">
			<a href="../categorias.php">Ir a categorias</a>
			<?php if ($iduser != false): ?>
				<a href="../cuenta.php">Ir a cuenta</a>
			<?php endif ?>
		</div>
	</div>

	<?php require 'footer.php' ?>
</body>
</html>