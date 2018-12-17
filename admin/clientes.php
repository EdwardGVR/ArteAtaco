<?php

if (!isset($_SESSION['user'])) {
	session_start();
}

require '../functions.php';
require '../conexion.php';

$userData = adminValidation($conexion);
$userName = $userData['nombres'] . ' ' . $userData['apellidos'];
$userImg = $userData['imagen'];
$userId = $userData['id'];

if ($conexion != false) {
	$query = $conexion->prepare("SELECT usuarios.* FROM usuarios WHERE usuarios.id != :userId");
	$query->execute(array(':userId' => $userId));
	$clientes = $query->fetchall();
}

require "views/clientes_view.php";