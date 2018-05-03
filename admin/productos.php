<?php

    require '../functions.php';
    require '../conexion.php';

    if ($conexion != false) {
        $query = $conexion->prepare(
            "SELECT productos.*, categorias.nombre_cat
             FROM productos 
             JOIN categorias ON productos.id_categoria = categorias.id"
        );
        $query -> execute();
        $productos = $query->fetchall();
    }


    require "views/productos_view.php";