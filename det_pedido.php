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

$orderCode = (isset($_GET['orderCode'])) ? $_GET['orderCode'] : false;

if ($conexion != false) {
	// Obtener categorias
	$query = $conexion->prepare("
		SELECT id, nombre_cat 
		FROM categorias 
		WHERE status = 1
		ORDER BY nombre_cat ASC");
	$query->execute();
	$categorias = $query->fetchall();


	if ($orderCode != false) {
		// Obtener pedido
		$query = $conexion->prepare("
			SELECT pedidos.*, direcciones.nombre AS dir_name, direcciones.disponible 
			FROM pedidos
			JOIN direcciones ON pedidos.id_direccion = direcciones.id
			WHERE pedidos.codigo = :orderCode
			GROUP BY pedidos.codigo");
		$query->execute(array(':orderCode'=>$orderCode));
		$pedido = $query->fetch();

		// Obtener productos del pedido
		$query = $conexion->prepare("
			SELECT 	pedidos.*, 
					productos.id AS idProd, 
					productos.nombre AS nombreProd, 
					productos.disponible, 
					productos.deleted AS prodDeleted
			FROM pedidos 
			JOIN productos ON pedidos.id_producto = productos.id
			WHERE pedidos.codigo = :orderCode
		");
		$query->execute(array(':orderCode' => $orderCode));
		$prodsPed = $query->fetchall();
	}


	// Obtener imagenes de productos
	$query = $conexion->prepare("SELECT * FROM imgs_prods");
	$query->execute();
	$imgs = $query->fetchall();
}

require 'views/det_pedido_view.php';

?>