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
                echo 'error';
            } else {
                // Si ya hay o no imagenes para el producto actual
                if ($numImgs['numImgs'] == 0) {
                    $numImg = 1;
                } else {
                    $numImg = ++$numImgs['numImgs'];
                }

                $newImg['name'] = "prod" . $idProd . "_cat" . $idCat . "_img" . $numImg . ".jpg";
            }
        }
    }


    require "views/productos_view.php";