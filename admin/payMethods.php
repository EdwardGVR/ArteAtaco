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

    // Obtener los metodos de pago previamente
    $query = $conexion->prepare("SELECT * FROM metodos_pago WHERE deleted = 0");
    $query->execute();
    $methodsPrev = $query->fetchall();

    foreach ($methodsPrev as $meth) {
        if ($meth['dev_status'] == 1) {
            $query = $conexion->prepare("UPDATE metodos_pago SET status = 0 WHERE id = :id");
            $query->execute(array(':id' => $meth['id']));
        }
    }

    // Obtener los metodos de pago definitivos
    $query = $conexion->prepare("SELECT * FROM metodos_pago WHERE deleted = 0");
    $query->execute();
    $methods = $query->fetchall();

    // Guardar un metodo de pago
    if (isset($_POST['saveMethod'])) {
        $methodName = $_POST['methodName'];
        $methodIcon = $_POST['methodIcon'];
        $methdoInfo = $_POST['methodInfo'];

        $startClassPos = strpos($methodIcon, "class=");
        $endClassPos = strpos($methodIcon, "></i>");
        $methodIcon = substr($methodIcon, $startClassPos+7);
        $methodIcon = substr($methodIcon, 0, $endClassPos-11);

        $query = $conexion->prepare("INSERT INTO metodos_pago (nombre, icon, info) VALUES (:nombre, :icon, :info)");
        $query->execute(array(
            ':nombre'=>$methodName,
            ':icon'=>$methodIcon,
            ':info'=>$methdoInfo
        ));

        $methodNameSlug = str_replace(" ", "-", $methodName);
        $methodNameSlug = strtolower($methodNameSlug);
        
        createPayMethodFiles($methodNameSlug);

        header("Location: payMethods.php");
    }
}

require "views/pay_methods_view.php";