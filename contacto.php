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
	$query = $conexion->prepare('SELECT * FROM categorias ORDER BY nombre_cat ASC');
	$query->execute();
	$categorias = $query->fetchall();

	//print_r($categorias);

	$user_nombre = get_user_data($conexion, $iduser)['nombres'];
	$user_mail = get_user_data($conexion, $iduser)['email'];
}

require 'views/contacto_view.php';

?>