<?php

if (!isset($_SESSION['user'])) {
    session_start();
}

require '../functions.php';
require '../conexion.php';

$userData = adminValidation($conexion);
$userName = $userData['nombres'] . ' ' . $userData['apellidos'];
$userImg = $userData['imagen'];
$idPoint = isset($_GET['idPunto']) ? $_GET['idPunto'] : false;

if ($conexion != false) {

    // Obtener el punto de entrega
    if ($idPoint != false) {
        $query = $conexion->prepare("
            SELECT direcciones.*, departamentos.nombre AS dptoNombre 
            FROM direcciones
            JOIN departamentos ON direcciones.id_departamento = departamentos.id
            WHERE direcciones.id_tipo = 2 AND direcciones.id = :idPoint
        ");
        $query->execute(array(':idPoint' => $idPoint));
        $puntoPreData = $query->fetch();

        if ($puntoPreData['disponible'] == 1) {
            $puntoData = $puntoPreData;
        } else {
            $puntoData = false;
        }

    } else {
        $puntoData = false;
    }

    // Obtener los departamentos
    $query = $conexion->prepare("SELECT * FROM departamentos");
    $query->execute();
    $departamentos = $query->fetchall();

    // "Borrar" un punto de entrega
    if (isset($_POST['deletePoint'])) {
        $idPoint = $_POST['puntoId'];

        $query = $conexion->prepare("UPDATE direcciones SET disponible = 0, estado = 0 WHERE id = :idPoint");
        $query->execute(array(':idPoint' => $idPoint));

        unset($_POST['deletePoint']);
        header("Location: puntosEntrega.php");
    }

    // Activar / desactivar punto de entrega
    if (isset($_POST['togglePoint'])) {
        $idPoint = $_POST['puntoId'];    
        
        $query = $conexion->prepare("SELECT estado FROM direcciones WHERE id = :idPoint");
        $query->execute(array(':idPoint' => $idPoint));
        $result = $query->fetch();

        $currentStatus = $result['estado'];

        if ($currentStatus == 1) {
            $query = $conexion->prepare("UPDATE direcciones SET estado = 0 WHERE id = :idPoint");
            $query->execute(array(':idPoint' => $idPoint));
        } else if ($currentStatus == 0) {
            $query = $conexion->prepare("UPDATE direcciones SET estado = 1 WHERE id = :idPoint");
            $query->execute(array(':idPoint' => $idPoint));
        }

        unset($_POST['togglePoint']);
        header("Location: detallesPuntoEntrega.php?idPunto=$idPoint");
    }
}

require "views/detalles_punto_entrega_view.php";