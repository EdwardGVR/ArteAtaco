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
    if ($idCat != 1) {
        $query = $conexion->prepare("
            SELECT * 
            FROM productos 
            WHERE id_categoria = :idCat AND to_others = 0 AND deleted = 0
        ");
        $query->execute(array(':idCat' => $idCat));
        $prods = $query->fetchall();
    } else {
        $query = $conexion->prepare("
            SELECT * 
            FROM productos 
            WHERE (id_categoria = 1 OR to_others = 1) AND deleted = 0");
        $query->execute();
        $prodsOther = $query->fetchall();
    }


    // Obtener las imagenes de los productos de la categoria
    if ($idCat != 1) {
        $query = $conexion->prepare("
            SELECT imgs_prods.* FROM imgs_prods
            JOIN productos ON imgs_prods.id_prod = productos.id
            WHERE productos.id_categoria = :idCat AND productos.to_others = 0 AND productos.deleted = 0
        ");
        $query->execute(array(':idCat' => $idCat));
        $imgsProds = $query->fetchall();
    } else {
        $query = $conexion->prepare("
            SELECT imgs_prods.* FROM imgs_prods
            JOIN productos ON imgs_prods.id_prod = productos.id
            WHERE (productos.id_categoria = :idCat OR productos.to_others = 1) AND productos.deleted = 0
        ");
        $query->execute(array(':idCat' => $idCat));
        $imgsProds = $query->fetchall();
    }

    // Desactivar categoria y ocultar productos
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

    // Cambiar imagen de categoria
    if (isset($_POST['setImg'])) {
        $catName = $_POST['catName'];

        print_r($_FILES);

        if (isset($_FILES['catImg'])) {
            $catImg = $_FILES['catImg'];

            if ($catImg['error'] == 1) {
                $imgError = true;
                echo $catImg['error'];
            } else {
                $imgError = false;
                $accents = array("&", "acute;", " ", "tilde;");
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
            $query = $conexion->prepare("UPDATE categorias SET imagen = :catImg WHERE id = :idCat");
            $query->execute(array(
                ":catImg" => substr($uploadedFile, 3),
                ":idCat" => $idCat
            ));
            
            header("Location: detallesCategoria.php?cat=$idCat");
        } else {
            echo "Error en la imagen";
        }
    }

    if (isset($_POST['deleteCat'])) {
        $query = $conexion->prepare("
            UPDATE categorias
            SET descripcion = '', imagen = '', status = '0', deleted = '1'
            WHERE id = :idCat
        ");
        $query->execute(array(':idCat' => $idCat));
        unlink('../' . $cat['imagen']);

        $prodsAction = $_POST['prodsAction'];

        switch ($prodsAction) {
            case 'setProdsNoDisp':
                $query = $conexion->prepare("UPDATE productos SET disponible = 0 WHERE id_categoria = :idCat");
                $query->execute(array(':idCat' => $idCat));
                break;

            case 'setProdsToOthers':
                $query = $conexion->prepare("UPDATE productos SET to_others = 1 WHERE id_categoria = :idCat");
                $query->execute(array(':idCat' => $idCat));
                break;

            case 'deleteProds':
                $query = $conexion->prepare("UPDATE productos SET deleted = 1, disponible = 0 WHERE id_categoria = :idCat");
                $query->execute(array(':idCat' => $idCat));

                $query = $conexion->prepare("
                    SELECT imgs_prods.* 
                    FROM imgs_prods 
                    JOIN productos ON imgs_prods.id_prod = productos.id 
                    WHERE productos.id_categoria = :idCat
                ");
                $query->execute(array(':idCat' => $idCat));
                $imgsCatProds = $query->fetchall();

                foreach ($imgsCatProds as $img) {
                    $imgPath = $img['ruta'];

                    unlink('../' . $imgPath);

                    $query = $conexion->prepare("DELETE FROM imgs_prods WHERE id = :idImg");
                    $query->execute(array(':idImg' => $img['id']));
                }
                break;
            
            case 'unknown':
                $deleteError = true;
                break;
            
            default:
                # code...
                break;
        }

        header("Location: categorias.php");
    }
}

require "views/detalles_cat_view.php";