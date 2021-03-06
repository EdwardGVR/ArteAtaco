<?php session_start();
require 'functions.php';

if (isset($_SESSION['user'])) {
	$user = $_SESSION['user'];
} else {
	$user = "Invitado";
}

$id_prod = isset($_GET['id_prod']) ? $_GET['id_prod'] : false;
require 'conexion.php';
$iduser = get_user_id($conexion, $user);

if ($conexion != false) {
	// Obtener los detalles del producto
	$query = $conexion->prepare('SELECT * FROM productos WHERE id = :id_prod AND disponible = 1');
	$query->execute(array(':id_prod' => $id_prod));
	$detalles = $query->fetch();

	$idCatActual = $detalles['id_categoria'];

	$query = $conexion->prepare("SELECT nombre_cat FROM categorias WHERE id = :id");
	$query->execute(array(':id' => $idCatActual));
	$nombreCat = $query->fetch();
	$nombreCat = $nombreCat['nombre_cat'];

	//Obtener las imagenes del producto
	$query = $conexion->prepare("SELECT * FROM imgs_prods WHERE id_prod = :id_prod");
	$query->execute(array(':id_prod' => $id_prod));
	$imagenes = $query->fetchall();

	// Obtener las categorias
	$query = $conexion->prepare("
		SELECT id, nombre_cat 
		FROM categorias 
		WHERE status = 1
		ORDER BY nombre_cat ASC");
	$query->execute();
	$categorias = $query->fetchall();
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$idprod = $_POST['idprod'];
		$cantidad = $_POST['quantity'];
		// Consultar si el usuario ya tiene el producto en el carrito
		$query = $conexion->prepare("
				SELECT * 
				FROM carrito 
				WHERE id_producto = :idprod AND id_user = :iduser
			");
		$query->execute(array(
				':idprod' => $idprod,
				':iduser' => $iduser
			));
		$consultar_carrito = $query->fetch();

		if ($consultar_carrito != false) {
			// El usuario ya tiene agregado el producto
			// echo "El usuario ya tiene agregado el producto";
			$cantidad_uptaded = $consultar_carrito['cantidad'] + $cantidad;
			// echo "Se ha actualizado la cantidad";
			$query = $conexion->prepare("UPDATE carrito SET cantidad = :cantidad_uptaded WHERE id_producto = :idprod AND id_user = :iduser");
			$query->execute(array(
				':cantidad_uptaded' => $cantidad_uptaded,
				':idprod' => $idprod,
				':iduser' => $iduser
			));
		} else {
			// El usuario NO tiene agregado el producto
			// echo "El usuario NO tiene agregado el producto";
			$query = $conexion->prepare("INSERT INTO carrito VALUES (null, :iduser, :idprod, :cantidad)");
			$query->execute(array(
				':iduser' => $iduser,
				':idprod' => $idprod,
				':cantidad' => $cantidad
			));
			// echo "Se ha ingresado el producto al carrito";
		}
		header('Location: carrito.php');
	}
}
require 'views/detalles_view.php';
?>