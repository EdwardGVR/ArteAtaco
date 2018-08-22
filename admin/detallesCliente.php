<?php

if (!isset($_SESSION['user'])) {
	session_start();
}

require '../functions.php';
require '../conexion.php';

$userData = adminValidation($conexion);
$userName = $userData['nombres'] . ' ' . $userData['apellidos'];
$userImg = $userData['imagen'];
$userId = $userData['id'];
$costumerId = isset($_GET['cosId']) ? $_GET['cosId'] : false;

if ($conexion != false) {

	if ($costumerId != false) {
		$query = $conexion->prepare("SELECT usuarios.* FROM usuarios WHERE usuarios.id = :cosId");
		$query->execute(array(':cosId' => $costumerId));
		$datosClienteResult = $query->fetch();

		if ($datosClienteResult != false) {
			$datosCliente = $datosClienteResult;
		} else {
			$datosCliente = false;
		}

		$query = $conexion->prepare("
			SELECT direcciones.*, departamentos.nombre AS nombreDpto, departamentos.costo_envio AS costoDpto
			FROM direcciones
			JOIN departamentos ON direcciones.id_departamento = departamentos.id
			WHERE id_user = :cosId AND id_tipo = 1
		");
		$query->execute(array(':cosId' => $costumerId));
		$direccionesCliente = $query->fetchall();

		$query = $conexion->prepare("
			SELECT pedidos.codigo, pedidos.estado, pedidos.costoEnvioCompra, order_status.status FROM pedidos 
			JOIN order_status ON pedidos.estado = order_status.id
			WHERE id_user = :cosId 
			GROUP BY pedidos.codigo
			ORDER BY pedidos.estado DESC
		");
		$query->execute(array(':cosId' => $costumerId));
		$pedidosCliente = $query->fetchall();

		$query = $conexion->prepare("SELECT codigo, precioCompra FROM pedidos");
		$query->execute();
		$prodsOrders = $query->fetchall();
	} else {
		$datosCliente = false;
	}

	// print_r($costumerId);

}

require "views/detalles_cliente_view.php";