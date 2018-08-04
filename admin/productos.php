<?php

    require '../functions.php';
    require '../conexion.php';

    if ($conexion != false) {
        // Obtener los productos
        $query = $conexion->prepare(
            "SELECT productos.*, categorias.nombre_cat
             FROM productos 
             JOIN categorias ON productos.id_categoria = categorias.id
             WHERE productos.deleted = 0
             ORDER BY productos.id DESC
        ");
        $query -> execute();
        $productos = $query->fetchall();
        
        // Obtener las categorias
        $query = $conexion->prepare("SELECT * FROM categorias");
        $query->execute();
        $categorias = $query->fetchall();
        
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

                // Preparar nombre de la categoria para la carpeta
                $query = $conexion->prepare("SELECT nombre_cat FROM categorias WHERE id = :idCat");
                $query->execute(array(':idCat'=>$idCat));
                $catName = $query->fetch();
                
                // Formar nombre de la imagen
                if ($catName != false) {
                    $catName = $catName['nombre_cat'];
                    $accent = array("&", "acute;", " ", "tilde");
                    $catName = str_replace($accent, "", $catName);
                    $catName = strtolower($catName);

                    if (substr($catName, -1, 1) == 's') {
                        $newImg['name'] = substr($catName, 0, -1) . $idProd  . "_img" . $numImg . ".jpg";
                    } else {
                        $newImg['name'] = $catName . $idProd  . "_img" . $numImg . ".jpg";
                    }

                    // Comprobar que existe la carpeta de la categoria
                    $dir_path = "../images/productos/" . $catName;
                    if (!file_exists($dir_path)) {
                        mkdir($dir_path);
                    }

                    $uploadedFile = "../images/productos/" . $catName . "/" . $newImg['name'];
                    move_uploaded_file($_FILES['newImg']['tmp_name'], $uploadedFile);
                    $successUpload = TRUE;
                }

                if ($successUpload) {
                    $query = $conexion->prepare("INSERT INTO imgs_prods (id, id_prod, ruta, principal) VALUES (null, :id_prod, :ruta, 0)");
                    $query->execute(array(
                        ":id_prod" => $idProd, 
                        ":ruta" => substr($uploadedFile, 3)
                    ));

                    header('Location: productos.php');
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

        if (isset($_POST['deleteProd'])) {
            $idProd = $_POST['idProd'];

            $query = $conexion->prepare("SELECT * FROM imgs_prods WHERE id_prod = :idProd");
            $query->execute(array(':idProd'=>$idProd));
            $imgsProd = $query->fetchall();

            if ($imgsProd != false) {
                foreach ($imgsProd as $imgProdDel) {
                    unlink('../' . $imgProdDel['ruta']);
                }
                
                $query = $conexion->prepare("DELETE FROM imgs_prods WHERE id_prod = :idProd");
                $query->execute(array(':idProd'=>$idProd));
            }

            $query = $conexion->prepare("
                UPDATE productos 
                SET deleted = 1, disponible = 0
                WHERE id = :idProd
            ");
            $query->execute(array(':idProd' => $idProd));

            header('Location: productos.php');
        }

        if (isset($_POST['saveChangesProd'])) {
            $idProd = $_POST['idProd'];
            $nombreProd = $_POST['nombreProd'];
            $catProd = $_POST['catProd'];
            $precioProd = $_POST['precioProd'];
            $descProd = $_POST['descProd'];

            $query = $conexion->prepare(
                "UPDATE productos 
                 SET id_categoria = :catProd, nombre = :nombreProd, precio = :precioProd, descripcion = :descProd
                 WHERE id = :idProd"
            );
            $query->execute(array(
                ':catProd' => $catProd,
                ':nombreProd' => $nombreProd,
                ':precioProd' => $precioProd,
                ':descProd' => $descProd,
                ':idProd' => $idProd
            ));

            header('Location: productos.php');
        }

        if (isset($_POST['saveNewProduct'])) {
            $idCat = $_POST['newProdCat'];
            $nombre = $_POST['newProdName'];
            $precio = $_POST['newProdPrice'];
            $descripcion = $_POST['newProdDesc'];

            $query = $conexion->prepare("
                INSERT INTO productos (id, id_categoria, nombre, precio, descripcion, fecha_registro) 
                VALUES (null, :idCat, :nombre, :precio, :descripcion, CURRENT_TIMESTAMP)
            ");
            $query->execute(array(
                ':idCat' => $idCat,
                ':nombre' => $nombre,
                ':precio' => $precio,
                ':descripcion' => $descripcion
            ));

            header('Location: productos.php');
        }

        // Obtener las imagenes
        $query = $conexion->prepare("SELECT * FROM imgs_prods");
        $query->execute();
        $imgsProds = $query->fetchall();
    }

    require "views/productos_view.php";