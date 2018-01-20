<?php session_start();

require 'functions.php';

if (isset($_SESSION['user'])) {
	$user = $_SESSION['user'];
} else {
	header("Location: categorias.php");
	$user = "Invitado";
}

//CODE...
require 'conexion.php';
$iduser = get_user_id($conexion, $user);

if ($conexion != false) {
	$query = $conexion->prepare("SELECT id, nombre_cat FROM categorias ORDER BY nombre_cat ASC");
	$query->execute();
	$categorias = $query->fetchall();

	$query = $conexion->prepare("
		SELECT pedidos.*, direcciones_persistence.nombre AS dir_name, direcciones_persistence.activa
		FROM pedidos, direcciones_persistence
		WHERE pedidos.id_user = :id_user AND pedidos.id_direccion = direcciones_persistence.id
		GROUP BY codigo 
		ORDER BY fecha DESC");
	$query->execute(array(':id_user'=>$iduser));
	$pedidos = $query->fetchall();

	// print_r($pedidos);	

	$query = $conexion->prepare("
		SELECT pedidos.codigo, pedidos.cantidad, pedidos.estado, productos.id, productos.nombre, productos.precio, productos.imagen 
		FROM pedidos, productos 
		WHERE pedidos.id_user = :id_user AND pedidos.id_producto = productos.id
		ORDER BY fecha ASC
	");
	$query->execute(array(':id_user'=>$iduser));
	$productos_pedidos = $query->fetchall();

	// print_r($productos_pedidos);
}

require 'views/pedidos_view.php';

?>