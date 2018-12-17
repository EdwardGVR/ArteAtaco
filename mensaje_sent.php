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
	$query = $conexion->prepare('
		SELECT * 
		FROM categorias 
		WHERE status = 1
		ORDER BY nombre_cat ASC');
	$query->execute();
	$categorias = $query->fetchall();
}

require 'views/message_sent_view.php';

?>