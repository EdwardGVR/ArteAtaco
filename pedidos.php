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
	// Obtener categorias
	$query = $conexion->prepare("SELECT id, nombre_cat FROM categorias ORDER BY nombre_cat ASC");
	$query->execute();
	$categorias = $query->fetchall();

	// Obtener pedidos del cliente
	$query = $conexion->prepare("
		SELECT pedidos.*, direcciones.nombre AS dir_name, direcciones.disponible 
		FROM pedidos
		JOIN direcciones ON pedidos.id_direccion = direcciones.id
		WHERE pedidos.id_user = :id_user
		GROUP BY pedidos.codigo
		ORDER BY pedidos.fecha DESC");
	$query->execute(array(':id_user'=>$iduser));
	$pedidos = $query->fetchall();

	// print_r($pedidos);	

	// Obtener productos de pedidos del cliente
	$query = $conexion->prepare("
		SELECT pedidos.*, productos.id AS idProd, productos.nombre AS nombreProd, productos.disponible
		FROM pedidos 
		JOIN productos ON pedidos.id_producto = productos.id
		WHERE pedidos.id_user = :id_user
		ORDER BY pedidos.fecha ASC
	");
	$query->execute(array(':id_user'=>$iduser));
	$productos_pedidos = $query->fetchall();

	// print_r($productos_pedidos);

	// Obtener imagenes de productos
	$query = $conexion->prepare("SELECT * FROM imgs_prods");
	$query->execute();
	$imgs = $query->fetchall();
}

require 'views/pedidos_view.php';

?>