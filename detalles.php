<?php session_start();

require 'functions.php';

if (isset($_SESSION['user'])) {
	$user = $_SESSION['user'];
} else {
	$user = "Invitado";
}

$conexion = conexion('login_propio', 'root', '');

require 'views/detalles_view.php';

?>