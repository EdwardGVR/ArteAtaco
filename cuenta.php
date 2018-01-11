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

$iduser = get_user_id($conexion, $user);

if (!is_null(get_user_data($conexion, $iduser)['imagen'])) {
	$imagen = get_user_data($conexion, $iduser)['imagen'];
}

$pedidos_activos = cantidad_pedidos_activos($conexion, $iduser);

if ($conexion != false) {
	$query = $conexion->prepare('SELECT * FROM categorias ORDER BY nombre_cat ASC');
	$query->execute();
	$categorias = $query->fetchall();

	//print_r($categorias);
}

require 'views/cuenta_view.php';

?>