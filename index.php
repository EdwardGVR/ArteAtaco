<?php session_start();

if (isset($_SESSION['user'])) {
	require 'categorias.php';
} else {
	header('Location: login.php');
}

?>