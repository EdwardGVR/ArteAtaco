<?php

    require '../functions.php';
    require '../conexion.php';

    if ($conexion != false) {
        $query = $conexion->prepare("SELECT * FROM productos");
        $query -> execute();
        $productos = $query->fetchall();
    }


    require "views/productos_view.php";