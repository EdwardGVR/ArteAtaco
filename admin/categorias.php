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
    $query = $conexion->prepare("SELECT * FROM categorias WHERE deleted = 0");
    $query->execute();
    $cats = $query->fetchAll();

    //Guardar nueva categoria
    if (isset($_POST['saveCat'])) {
        $catName = $_POST['catName'];
        $catInfo = $_POST['catInfo'];

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
                $catNameFiltered = str_replace($accents, "", $catNameFiltered);
                $catNameFiltered = strtolower($catNameFiltered);

                $catImg['name'] = $catNameFiltered . "_img.jpg";

                $uploadedFile = "../images/categorias/" . $catImg['name'];
                move_uploaded_file($_FILES['catImg']['tmp_name'], $uploadedFile);
                $successUpload = true;
            }
        }
        
        if ($successUpload) {
            $query = $conexion->prepare("INSERT INTO categorias (nombre_cat, descripcion, imagen) VALUES (:catName, :catInfo, :catImg)");
            $query->execute(array(
                ":catName" => $catName, 
                ":catInfo" => $catInfo,
                ":catImg" => substr($uploadedFile, 3)
            ));
            header("Location: categorias.php");
        } else {
            echo "Error en la imagen";
        }

    }
}

require "views/categorias_view.php";;