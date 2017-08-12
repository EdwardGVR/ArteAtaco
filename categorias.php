<?php session_start();

if (isset($_SESSION['user'])) {
	$user = $_SESSION['user'];
	require 'views/categorias_view.php';
} else {
	$user = 'Invitado';
	require 'views/categorias_view.php';
}

?>