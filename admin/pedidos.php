<?php

    require '../functions.php';
    require '../conexion.php';

    if ($conexion != false) {
        // Obtener pedidos del cliente
        $query = $conexion->prepare("
            SELECT  pedidos.*,
                    usuarios.id AS cos_id,
                    usuarios.nombres AS cos_names,
                    usuarios.apellidos AS cos_apellidos, 
                    usuarios.email AS cos_email,
                    usuarios.imagen AS cos_img,
                    usuarios.telefono AS cos_tel,
                    departamentos.nombre AS dir_dpto, 
                    direcciones.nombre AS dir_name,
                    direcciones.linea1 AS dir_linea1,
                    direcciones.linea2 AS dir_linea2,
                    direcciones.referencias AS dir_refs,
                    tipo_direccion.tipo AS dir_tipo, 
                    direcciones.disponible AS dir_disponible 
            FROM pedidos
            JOIN direcciones ON pedidos.id_direccion = direcciones.id
            JOIN usuarios ON pedidos.id_user = usuarios.id
            JOIN departamentos ON direcciones.id_departamento = departamentos.id
            JOIN tipo_direccion ON direcciones.id_tipo = tipo_direccion.id
            GROUP BY pedidos.codigo
            ORDER BY pedidos.fecha DESC");
        $query->execute();
        $pedidos = $query->fetchall();

        // print_r($pedidos);
        
        // Obtener productos de pedidos del cliente
        $query = $conexion->prepare("
            SELECT  pedidos.*, 
                    productos.id AS prod_id, 
                    productos.nombre AS prod_name,
                    productos.imagen AS prod_img,
                    categorias.nombre_cat AS prod_cat
            FROM pedidos 
            JOIN productos ON pedidos.id_producto = productos.id
            JOIN categorias ON productos.id_categoria = categorias.id
            ORDER BY pedidos.fecha ASC
        ");
        $query->execute();
        $prods_pedidos = $query->fetchall();
    }

    require "views/pedidos_view.php";