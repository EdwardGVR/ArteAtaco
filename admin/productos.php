<?php

    require '../functions.php';
    require '../conexion.php';

    if ($conexion != false) {
        // Obtener los productos
        $query = $conexion->prepare(
            "SELECT productos.*, categorias.nombre_cat
             FROM productos 
             JOIN categorias ON productos.id_categoria = categorias.id"
        );
        $query -> execute();
        $productos = $query->fetchall();

        $cantImgsPorProducto = 0;

        // Comprobar que se recibe la imagen
        if (isset($_FILES['newImg'])) {
            $newImg = $_FILES['newImg'];
            $idCat = $_POST['idCat'];
            $idProd = $_POST['idProd'];
            
            $query = $conexion->prepare("SELECT COUNT(*) AS numImgs FROM imgs_prods WHERE id_prod = :id_prod");
            $query->execute(array(':id_prod' => $idProd));
            $numImgs = $query->fetch();

            // print_r($numImgs['numImgs']);

            if ($newImg['error']  == 1) {
                $newImg_error = true;
            } else {
                // comprobar si ya hay o no imagenes para el producto actual
                if ($numImgs['numImgs'] == 0) {
                    $numImg = 1;
                } else {
                    $numImg = ++$numImgs['numImgs'];
                }

                switch ($idCat) {
                    case 1:
                        $categoria = 'lamparas';
                        break;
                    case 2:
                        $categoria = 'dreamcatchers';
                        break;
                    case 3:
                        $categoria = 'banquetas';
                        break;
                    case 4:
                        $categoria = 'llamadores';
                        break;
                    case 5:
                        $categoria = 'bisuteria';
                        break;
                    case 6:
                        $categoria = 'nequis';
                        break;
                    case 7:
                        $categoria = 'instrumentos';
                        break;
                    case 8:
                        $categoria = 'farolitos';
                        break;
                    default:
                        $categoria = FALSE;
                        $errCat = "Categoria no valida";
                        break;
                }

                if ($categoria != FALSE) {
                    if (substr($categoria, -1, 1) == 's') {
                        $newImg['name'] = substr($categoria, 0, -1) . $idProd  . "_img" . $numImg . ".jpg";
                    } else {
                        $newImg['name'] = $categoria . $idProd  . "_img" . $numImg . ".jpg";
                    }

                    $uploadedFile = "../images/productos/" . $categoria . "/" . $newImg['name'];
                    move_uploaded_file($_FILES['newImg']['tmp_name'], $uploadedFile);
                    $successUpload = TRUE;
                }

                if ($successUpload) {
                    $query = $conexion->prepare("INSERT INTO imgs_prods (id, id_prod, ruta, principal) VALUES (null, :id_prod, :ruta, 0)");
                    $query->execute(array(
                        ":id_prod" => $idProd, 
                        ":ruta" => substr($uploadedFile, 3)
                    ));
                }

            }
        }

        if (isset($_POST['deleteImg'])) {
            $imgId = $_POST['imgId'];
            $query = $conexion->prepare("DELETE FROM imgs_prods WHERE id = :idImg");
            $query->execute(array(':idImg' => $imgId));
            
            unlink('../' . $_POST['imgPath']);
        }

        if (isset($_POST['setMainImg'])) {
            $imgId = $_POST['imgId'];
            $prodId = $_POST['prodId'];
            $query = $conexion->prepare("UPDATE imgs_prods SET principal = 1 WHERE id = :idImg");
            $query->execute(array(':idImg' => $imgId));

            $query = $conexion->prepare("UPDATE imgs_prods SET principal = 0 WHERE id != :idImg AND id_prod = :id_prod");
            $query->execute(array(
                ':idImg' => $imgId,
                ':id_prod' => $prodId
            ));
        }

        if (isset($_POST['setDisp'])) {
            $idProd = $_POST['idProd'];
            $currentDisp = $_POST['currentDisp'];

            if ($currentDisp == 1) {
                $query = $conexion->prepare("UPDATE productos SET disponible = 0 WHERE id = :idProd");
                $query->execute(array(':idProd' => $idProd));
            } elseif ($currentDisp == 0) {
                $query = $conexion->prepare("UPDATE productos SET disponible = 1 WHERE id = :idProd");
                $query->execute(array(':idProd' => $idProd));
            }

            header('Location: productos.php');
        }

        // Obtener las imagenes
        $query = $conexion->prepare("SELECT * FROM imgs_prods");
        $query->execute();
        $imgsProds = $query->fetchall();
    }

    require "views/productos_view.php";