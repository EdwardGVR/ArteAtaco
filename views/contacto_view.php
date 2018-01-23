<!DOCTYPE html>
<html>
<head>
	<title>Arte Ataco :: Contacto</title>

	<link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 
	<link rel="stylesheet" href="css/styles.css">
</head>
<body>
	<?php require 'header.php' ?>

	<div class="contenedor_contacto">
		<h3>Lorem ipsum dolor sit amet.</h3>
		<form class="contacto_form" action="<?php echo $_SERVE['PHP_SELF'] ?>" method="POST">
			<?php if ($iduser == false): ?>
				<span>Nombre:</span>
			<?php endif ?>
		</form>
	</div>

	<?php require 'footer.php' ?>
</body>
</html>