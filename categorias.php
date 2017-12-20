<?php

if (!isset($_SESSION['user'])) {
	session_start();
}

require 'functions.php';

if (isset($_SESSION['user'])) {
	$user = $_SESSION['user'];
} else {
	$user = 'Invitado';
}

$conexion = conexion('heroku_33996c8507d92de', 'bd1afaf8a26c4e', 'aeb413f5');

if ($conexion != false) {
	$query = $conexion->prepare('SELECT * FROM categorias');
	$query->execute();
	$categorias = $query->fetchall();

	//print_r($categorias);
}

require 'views/categorias_view.php';

?>