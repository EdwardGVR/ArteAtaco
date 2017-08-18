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

$conexion = conexion('login_propio', 'root', '');

if ($conexion != false) {
	$query = $conexion->prepare('SELECT * FROM categorias');
	$query->execute();
	$categorias = $query->fetchall();

	//print_r($categorias);
}

require 'views/categorias_view.php';

?>