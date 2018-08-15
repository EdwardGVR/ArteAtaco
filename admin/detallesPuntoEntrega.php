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

    // Obtener los puntos de entrega
    $query = $conexion->prepare("
        SELECT direcciones.*, departamentos.nombre AS dptoNombre 
        FROM direcciones
        JOIN departamentos ON direcciones.id_departamento = departamentos.id
        WHERE id_tipo = 2 AND disponible = 1;
    ");
    $query->execute();
    $puntos = $query->fetchall();

    if ($puntos != false) {
        $hayPuntos = true;
    } else {
        $hayPuntos = false;
    }

    // Obtener los departamentos
    $query = $conexion->prepare("SELECT * FROM departamentos");
    $query->execute();
    $departamentos = $query->fetchall();

    // Guardar un nuevo punto de entrega
    if (isset($_POST['savePoint'])) {
        $dptoPoint = $_POST['dptoPunto'];
        $nombrePoint = $_POST['nombrePunto'];
        $paisPoint = "El Salvador";
        $linea1Point = $_POST['linea1'];
        $linea2Point = $_POST['linea2'];
        $refsPoint = $_POST['refPunto'];
        $tipoEntrega = $_POST['tipoEntrega'];

        if ($tipoEntrega == "free") {
            $costo = 0;
        } elseif ($tipoEntrega == "noFree") {
            $costo = $_POST['costoEntrega'];
        }
        
        $query = $conexion->prepare("INSERT INTO direcciones VALUES (null, 2, :dpto, :nombre, :pais, :linea1, :linea2, :referencias, 2, :costo, 1, 1)");
        $query->execute(array(
            ':dpto' => $dptoPoint,
            ':nombre' => $nombrePoint,
            ':pais' => $paisPoint,
            ':linea1' => $linea1Point,
            ':linea2' => $linea2Point,
            ':referencias' => $refsPoint,
            ':costo' => $costo
        ));

        unset($_POST['savePoint']);
        header('Location: puntosEntrega.php');
    }

    // "Borrar" un punto de entrega
    if (isset($_POST['deletePoint'])) {
        $idPoint = $_POST['puntoId'];

        $query = $conexion->prepare("UPDATE direcciones SET disponible = 0, estado = 0 WHERE id = :idPoint");
        $query->execute(array(':idPoint' => $idPoint));

        unset($_POST['deletePoint']);
        header('Location: puntosEntrega.php');
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
        header('Location: puntosEntrega.php');
    }
}

require "views/detalles_punto_entrega_view.php";