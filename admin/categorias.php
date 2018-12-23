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
    // Obtener categorias
    $query = $conexion->prepare("
        SELECT * 
        FROM categorias 
        WHERE deleted = 0
        ORDER BY nombre_cat ASC");
    $query->execute();
    $cats = $query->fetchAll();

    $query = $conexion->prepare("SELECT COUNT(*) FROM productos WHERE id_categoria = 1 OR to_others = 1");
    $query->execute();
    $qtyProdsOther = $query->fetch();
    $qtyProdsOther = $qtyProdsOther['COUNT(*)'];

    //Guardar nueva categoria
    if (isset($_POST['saveCat'])) {
        $catName = $_POST['catName'];
        $catInfo = $_POST['catInfo'];
        $catInfoDB = htmlentities($catInfo);

        //Comprobar que se recibe la imagen
        if (isset($_FILES['catImg'])) {
            $catImg = $_FILES['catImg'];

            if ($catImg['error'] == 1) {
                $imgError = true;
                echo $catImg['error'];
            } else {
                $imgError = false;
                $accents = array("&", "acute;", " ", "tilde");
                $catNameFiltered = htmlentities($catName);
                $catNameDB = $catNameFiltered;
                $catNameFiltered = str_replace($accents, "", $catNameFiltered);
                $catNameFiltered = strtolower($catNameFiltered);

                $catImg['name'] = $catNameFiltered . "_img.jpg";

                $uploadedFile = "../images/categorias/" . $catImg['name'];
                move_uploaded_file($_FILES['catImg']['tmp_name'], $uploadedFile);

                compressImgs([$uploadedFile], 20);

                $successUpload = true;
            }
        }
        
        if ($successUpload) {
            $query = $conexion->prepare("INSERT INTO categorias (nombre_cat, descripcion, imagen) VALUES (:catName, :catInfo, :catImg)");
            $query->execute(array(
                ":catName" => $catNameDB, 
                ":catInfo" => $catInfoDB,
                ":catImg" => substr($uploadedFile, 3)
            ));
            header("Location: categorias.php");
        } else {
            echo "Error en la imagen";
        }

    }
}

require "views/categorias_view.php";;