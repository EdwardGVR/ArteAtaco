<?php

    if (!isset($_SESSION['user'])) {
        session_start();
    }

    require '../functions.php';
    require '../conexion.php';

    adminValidation($conexion);

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
                    direcciones.disponible AS dir_disponible,
                    order_status.status AS status
            FROM pedidos
            JOIN direcciones ON pedidos.id_direccion = direcciones.id
            JOIN usuarios ON pedidos.id_user = usuarios.id
            JOIN departamentos ON direcciones.id_departamento = departamentos.id
            JOIN tipo_direccion ON direcciones.id_tipo = tipo_direccion.id
            JOIN order_status ON pedidos.estado = order_status.id
            GROUP BY pedidos.codigo
            ORDER BY pedidos.fecha DESC");
        $query->execute();
        $pedidos = $query->fetchall();

        // print_r($pedidos);

        // Obtener estados de pedido disponibles
        $query = $conexion->prepare("SELECT * FROM order_status");
        $query->execute();
        $orderStatus = $query->fetchall();
        
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

       	// Obtener imagenes de productos
        $query = $conexion->prepare("SELECT * FROM imgs_prods");
        $query->execute();
        $imgs = $query->fetchall();

        // Cambiar estado del pedido
        if (isset($_POST['changeStatus'])) {
            $orderCode = $_POST['orderCode'];
            $newStatus = $_POST['newStatus'];

            $query = $conexion->prepare("UPDATE pedidos SET estado = :newStatus WHERE codigo = :orderCode");
            $query->execute(array(
                ':newStatus' => $newStatus,
                ':orderCode' => $orderCode
            ));
            header("Location: pedidos.php");
        }


    }

    require "views/pedidos_view.php";