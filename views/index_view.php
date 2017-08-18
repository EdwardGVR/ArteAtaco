<!DOCTYPE html>
<html>
<head>
	<title>Bienvenido</title>
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 
	<link rel="stylesheet" href="css/styles.css">
</head>
<body>
	<div class="contenedor">
		<h1>Sesión Iniciada</h1>
		<h2>Bienvenido: <?php echo $_SESSION['user'] ?></h2>
	</div>

	<p><a href="logout.php">Cerrar sesión</a></p>
</body>
</html>