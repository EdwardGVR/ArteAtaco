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

    // Desactivar categoria y ocultar / mostrar productos
    if (isset($_POST['toggleAndHide'])) {    
        $query = $conexion->prepare("UPDATE categorias SET status = 0 WHERE id = :idCat");
        $query->execute(array(':idCat' => $idCat));

        $query = $conexion->prepare("UPDATE productos SET disponible = 0 WHERE id_categoria = :idCat");
        $query->execute(array(':idCat' => $idCat));

        header("Location: detallesCategoria.php?cat=$idCat");
    }

    // Desactivar categoria y enviar productos a "otros"
    if (isset($_POST['toggleAndToOthers'])) {    
        $query = $conexion->prepare("UPDATE categorias SET status = 0 WHERE id = :idCat");
        $query->execute(array(':idCat' => $idCat));

        $query = $conexion->prepare("UPDATE productos SET to_others = 1 WHERE id_categoria = :idCat");
        $query->execute(array(':idCat' => $idCat));

        header("Location: detallesCategoria.php?cat=$idCat");
    }

    // Activar categoria y restablecer productos
    if (isset($_POST['setActive'])) {    
        $query = $conexion->prepare("UPDATE categorias SET status = 1 WHERE id = :idCat");
        $query->execute(array(':idCat' => $idCat));

        $query = $conexion->prepare("UPDATE productos SET to_others = 0 WHERE id_categoria = :idCat");
        $query->execute(array(':idCat' => $idCat));

        $query = $conexion->prepare("UPDATE productos SET disponible = 1 WHERE id_categoria = :idCat");
        $query->execute(array(':idCat' => $idCat));

        header("Location: detallesCategoria.php?cat=$idCat");
    }

    // Editar nombre de categoria
    if (isset($_POST['editName'])) {
        $catName = $_POST['catName'];
        $catName = htmlentities($catName);

        $query = $conexion->prepare("UPDATE categorias SET nombre_cat = :catName WHERE id = :idCat");
        $query->execute(array(
            ':catName' => $catName,
            ':idCat' => $idCat
        ));

        header("Location: detallesCategoria.php?cat=$idCat");
    }

    // Editar descripcion de categoria
    if (isset($_POST['editDesc'])) {
        $catDesc = $_POST['catDesc'];
        $catDesc = htmlentities($catDesc);

        $query = $conexion->prepare("UPDATE categorias SET descripcion = :catDesc WHERE id = :idCat");
        $query->execute(array(
            ':catDesc' => $catDesc,
            ':idCat' => $idCat
        ));

        header("Location: detallesCategoria.php?cat=$idCat");
    }
}

require "views/detalles_cat_view.php";