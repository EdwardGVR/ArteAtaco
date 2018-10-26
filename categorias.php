<?php

if (!isset($_SESSION['user'])) {
	session_start();
}

require 'functions.php';
require 'conexion.php';

if (isset($_SESSION['user'])) {
	$user = $_SESSION['user'];
	$iduser = get_user_id($conexion, $user);
} else {
	$user = 'Invitado';
	$iduser = false;
}

if ($conexion != false) {
	$query = $conexion->prepare('SELECT * FROM categorias WHERE status = 1 ORDER BY nombre_cat ASC');
	$query->execute();
	$categorias = $query->fetchall();

	$query = $conexion->prepare("SELECT * FROM productos WHERE disponible = 1 AND (to_others = 0 OR id_categoria != 1)");
	$query->execute();
	$productos = $query->fetchall();

	$query = $conexion->prepare("SELECT * FROM productos WHERE disponible = 1 AND (to_others = 1 OR id_categoria = 1)");
	$query->execute();
	$prodsOther = $query->fetchall();

	$query = $conexion->prepare("SELECT * FROM imgs_prods");
	$query->execute();
	$imgs = $query->fetchall();
}

require 'views/categorias_view.php';

?>