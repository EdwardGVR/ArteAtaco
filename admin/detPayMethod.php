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
        $query = $conexion->prepare("SELECT * FROM metodos_pago WHERE id = :idPay AND deleted = 0");
        $query->execute(array('idPay' => $payMethodId));
        $methodDet = $query->fetch();
    } else {
        $methodDet = false;
    }

    if (isset($_POST['setNewIcon'])) {
        $newIcon = $_POST['iconCode'];        
        $startClassPos = strpos($newIcon, "class=");
        $endClassPos = strpos($newIcon, "></i>");

        $newIcon = substr($newIcon, $startClassPos+7);
        $newIcon = substr($newIcon, 0, $endClassPos-11);

        $query = $conexion->prepare("UPDATE metodos_pago SET icon = :newIcon WHERE id = :idPay");
        $query->execute(array(
            ':newIcon' => $newIcon,
            ':idPay' => $payMethodId
        ));

        header("Location: detPayMethod.php?payMethod=$payMethodId");
    }

    if (isset($_POST['saveNewName'])) {
        $newName = $_POST['newName'];
        $newName = trim($newName);
        $newName = htmlspecialchars($newName);

        $query = $conexion->prepare("UPDATE metodos_pago SET nombre = :newMethodName WHERE id = :idPay");
        $query->execute(array(
            ':newMethodName' => $newName,
            ':idPay' => $payMethodId
        ));

        header("Location: detPayMethod.php?payMethod=$payMethodId");
    }

    if (isset($_POST['toggleStatus'])) {
        $currentStatus = $_POST['currentStatus'];
        
        if ($currentStatus == 1) {
            $query = $conexion->prepare("UPDATE metodos_pago SET status = 0 WHERE id = :idPay");
            $query->execute(array(':idPay' => $payMethodId));
        } else if ($currentStatus == 0) {
            $query = $conexion->prepare("UPDATE metodos_pago SET status = 1 WHERE id = :idPay");
            $query->execute(array(':idPay' => $payMethodId));
        }

        header("Location: detPayMethod.php?payMethod=$payMethodId");
    }

    if (isset($_POST['deleteMethod'])) {
        $query = $conexion->prepare("UPDATE metodos_pago SET deleted = 1 WHERE id = :idPay");
        $query->execute(array(':idPay' => $payMethodId));

        header("Location: payMethods.php");
    }
}

require "views/detalles_metodo_pago_view.php";