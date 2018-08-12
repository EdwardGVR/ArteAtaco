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
	$query = $conexion->prepare("
		SELECT  pedidos.*,
		usuarios.id AS cos_id,
		usuarios.nombres AS cos_names,
		usuarios.apellidos AS cos_apellidos, 
		usuarios.email AS cos_email,
		usuarios.imagen AS cos_img,
		departamentos.nombre AS dir_dpto, 
		direcciones.nombre AS dir_name,
		direcciones.linea1 AS dir_linea1,
		direcciones.linea2 AS dir_linea2,
		tipo_direccion.tipo AS dir_tipo,
		order_status.status AS status
		FROM pedidos
		JOIN direcciones ON pedidos.id_direccion = direcciones.id
		JOIN usuarios ON pedidos.id_user = usuarios.id
		JOIN departamentos ON direcciones.id_departamento = departamentos.id
		JOIN tipo_direccion ON direcciones.id_tipo = tipo_direccion.id
		JOIN order_status ON pedidos.estado = order_status.id
		GROUP BY pedidos.codigo 
		ORDER BY pedidos.fecha DESC
		LIMIT 3
	");

	$query->execute();
	$lastOrders = $query->fetchall();

	// Obtener productos de pedidos del cliente
	$query = $conexion->prepare("
		SELECT  pedidos.*, 
				productos.id AS prod_id, 
				productos.nombre AS prod_name,
				categorias.nombre_cat AS prod_cat
		FROM pedidos 
		JOIN productos ON pedidos.id_producto = productos.id
		JOIN categorias ON productos.id_categoria = categorias.id
		ORDER BY pedidos.fecha DESC
	");
    $query->execute();
    $orderProds = $query->fetchall();

	$query = $conexion->prepare("
		SELECT productos.*, categorias.nombre_cat AS catName 
		FROM productos 
		JOIN categorias ON productos.id_categoria = categorias.id
		ORDER BY fecha_registro DESC 
		LIMIT 3
	");
	$query->execute();
	$lastProducts = $query->fetchall();

	// Obtener imagenes de productos
	$query = $conexion->prepare("SELECT * FROM imgs_prods");
	$query->execute();
	$imgs = $query->fetchall();
}

require "views/index_view.php";