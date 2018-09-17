<?php

if (!isset($_SESSION['user'])) {
    session_start();
}

require '../functions.php';
require '../conexion.php';

$userData = adminValidation($conexion);
$userName = $userData['nombres'] . ' ' . $userData['apellidos'];
$userImg = $userData['imagen'];
$payMethodId = (isset($_GET['payMethod'])) ? $_GET['payMethod'] : false;

if ($conexion != false) {
    if ($payMethodId != false) {
        // Obtener detalles del metodo de pago
        $query = $conexion->prepare("SELECT * FROM metodos_pago WHERE id = :idPay");
        $query->execute(array('idPay' => $payMethodId));
        $methodDet = $query->fetch();
    } else {
        $methodDet = false;
    }

}

require "views/detalles_metodo_pago_view.php";