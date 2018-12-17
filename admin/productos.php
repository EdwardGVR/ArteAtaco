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
        // Obtener todos los productos
        $query = $conexion->prepare("
            SELECT productos.*, categorias.nombre_cat AS catName, categorias.imagen AS catImg 
            FROM productos 
            JOIN categorias ON productos.id_categoria = categorias.id
            WHERE productos.deleted = 0
            ORDER BY fecha_registro DESC 
        ");
        $query->execute();
        $products = $query->fetchall();

        // Obtener imagenes de productos
        $query = $conexion->prepare("SELECT * FROM imgs_prods");
        $query->execute();
        $imgs = $query->fetchall();

        // Obtener las categorias
        $query = $conexion->prepare("SELECT * FROM categorias WHERE deleted = 0");
        $query->execute();
        $categorias = $query->fetchall();

        // Guardar un nuevo producto
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
    }

    require "views/productos_view.php";