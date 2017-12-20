<?php session_start();

require 'functions.php';

if (isset($_SESSION['user'])) {
	$user = $_SESSION['user'];
} else {
	$user = "Invitado";
}

$conexion = conexion('heroku_33996c8507d92de', 'bd1afaf8a26c4e', 'aeb413f5');

$id_cat = isset($_GET['id']) ? (int)$_GET['id'] : false;

if (!$id_cat) {
	header('Location: categorias.php');
}

if ($conexion != false) {
	$query = $conexion->prepare('SELECT * FROM categorias');
	$query->execute();
	$categorias = $query->fetchall();

	$query = $conexion->prepare('SELECT * FROM productos WHERE id_categoria = :id_cat');
	$query->execute(array(':id_cat' => $id_cat));
	$productos = $query->fetchall();

	$query = $conexion->prepare('SELECT nombre_cat FROM categorias WHERE id = :id_cat');
	$query->execute(array(':id_cat' => $id_cat));
	$categoria = $query->fetch();
}



require 'views/productos_view.php';

 ?>