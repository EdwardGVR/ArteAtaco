<?php session_start();

require 'functions.php';

if (isset($_SESSION['user'])) {
	$user = $_SESSION['user'];
} else {
	$user = "Invitado";
}

$conexion = conexion('heroku_33996c8507d92de', 'bd1afaf8a26c4e', 'aeb413f5');

if ($conexion != false) {
	$query = $conexion->prepare("SELECT id, nombre_cat FROM categorias");
	$query->execute();
	$categorias = $query->fetchall();
}

require 'views/checkout_view.php';

?>