<?php

if (!isset($_SESSION['user'])) {
    session_start();
}

require '../functions.php';
require '../conexion.php';

$userData = adminValidation($conexion);
$userName = $userData['nombres'] . ' ' . $userData['apellidos'];
$userImg = $userData['imagen'];
$idCat = isset($_GET['cat']) ? $_GET['cat'] : false;

if ($conexion != false) {

    // Obtener la categoria
    if ($idCat != false) {
        $query = $conexion->prepare("SELECT * FROM categorias WHERE id = :idCat");
        $query->execute(array(':idCat' => $idCat));
        $catPreData = $query->fetch();

        if ($catPreData['deleted'] == 0) {
            $cat = $catPreData;
        } else {
            $cat = false;
        }
    } else {
        $cat = false;
    }

    // Obtener los productos de la categoria
    $query = $conexion->prepare("SELECT * FROM productos WHERE id_categoria = :idCat");
    $query->execute(array(':idCat' => $idCat));
    $prods = $query->fetchall();

    // Activar / desactivar punto de entrega
    if (isset($_POST['toggleStatus'])) {    
        $currentStatus = $_POST['toggleStatus'];

        if ($currentStatus == 1) {
            $query = $conexion->prepare("UPDATE categorias SET status = 0 WHERE id = :idCat");
            $query->execute(array(':idCat' => $idCat));
        } else if ($currentStatus == 0) {
            $query = $conexion->prepare("UPDATE categorias SET status = 1 WHERE id = :idCat");
            $query->execute(array(':idCat' => $idCat));
        }

        header("Location: detallesCategoria.php?cat=$idCat");
    }
    
    // "Borrar" un punto de entrega
    if (isset($_POST['deletePoint'])) {
        $idPoint = $_POST['puntoId'];

        $query = $conexion->prepare("UPDATE direcciones SET disponible = 0, estado = 0 WHERE id = :idPoint");
        $query->execute(array(':idPoint' => $idPoint));

        unset($_POST['deletePoint']);
        header("Location: puntosEntrega.php");
    }

    
}

require "views/detalles_cat_view.php";