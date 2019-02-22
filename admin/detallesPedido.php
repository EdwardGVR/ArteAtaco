<?php

    if (!isset($_SESSION['user'])) {
        session_start();
    }

    require '../functions.php';
    require '../conexion.php';

    $orderNumber = isset($_GET['order']) ? $_GET['order'] : false;
    $userData = adminValidation($conexion);
    $userName = $userData['nombres'] . ' ' . $userData['apellidos'];
    $userImg = $userData['imagen'];

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
                    direcciones.disponible AS dir_status,
                    tipo_direccion.tipo AS dir_tipo, 
                    direcciones.disponible AS dir_disponible,
                    order_status.status AS status,
                    metodos_pago.id AS pay_method_id,
                    metodos_pago.nombre AS pay_method,
                    metodos_pago.deleted AS method_del
            FROM pedidos
            JOIN direcciones ON pedidos.id_direccion = direcciones.id
            JOIN usuarios ON pedidos.id_user = usuarios.id
            JOIN departamentos ON direcciones.id_departamento = departamentos.id
            JOIN tipo_direccion ON direcciones.id_tipo = tipo_direccion.id
            JOIN order_status ON pedidos.estado = order_status.id
            JOIN metodos_pago ON pedidos.id_pago = metodos_pago.id
            WHERE pedidos.codigo = :order
            GROUP BY pedidos.codigo
            ORDER BY pedidos.fecha DESC
        ");
        $query->execute(array(':order'=>$orderNumber));
        $pedidos = $query->fetchall();

        // print_r($pedidos);

        $query = $conexion->prepare("SELECT comprobante FROM comprobantes_pago WHERE orderCode = :orderCode");
        $query->execute(array(':orderCode' => $orderNumber));
        $comprobante = $query->fetch();
        $comprobante = $comprobante['comprobante'];

        // Obtener estados de pedido disponibles
        $query = $conexion->prepare("SELECT * FROM order_status");
        $query->execute();
        $orderStatus = $query->fetchall();
        
        // Obtener productos de pedidos del cliente
        $query = $conexion->prepare("
            SELECT  pedidos.*, 
                    productos.id AS prod_id, 
                    productos.nombre AS prod_name,
                    productos.deleted AS prod_del,
                    categorias.nombre_cat AS prod_cat
            FROM pedidos 
            JOIN productos ON pedidos.id_producto = productos.id
            JOIN categorias ON productos.id_categoria = categorias.id
            ORDER BY pedidos.fecha ASC
        ");
        $query->execute();
        $prods_pedidos = $query->fetchall();

        // print_r($prods_pedidos);

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
            header("Location: detallesPedido.php?order=$orderNumber");
        }


    }

    require "views/detalles_pedido_view.php";