<?php

if (!isset($_SESSION['user'])) {
    session_start();
}

require '../functions.php';
require '../conexion.php';

$userData = adminValidation($conexion);
$userName = $userData['nombres'] . ' ' . $userData['apellidos'];
$userImg = $userData['imagen'];

if ($conexion != false) {

    // Obtener los metodos de pago
    $query = $conexion->prepare("SELECT * FROM metodos_pago WHERE deleted = 0");
    $query->execute();
    $methods = $query->fetchall();
}

require "views/pay_methods_view.php";