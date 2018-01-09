<?php session_start();

require 'functions.php';

if (isset($_SESSION['user'])) {
	$user = $_SESSION['user'];
} else {
	$user = "Invitado";
}

require 'conexion.php';
$iduser = get_user_id($conexion, $user);

$id_cat = isset($_GET['id']) ? (int)$_GET['id'] : false;

if (!$id_cat) {
	header('Location: categorias.php');
}

if ($conexion != false) {
	$query = $conexion->prepare('SELECT * FROM categorias ORDER BY nombre_cat ASC');
	$query->execute();
	$categorias = $query->fetchall();

	$query = $conexion->prepare('SELECT * FROM productos WHERE id_categoria = :id_cat');
	$query->execute(array(':id_cat' => $id_cat));
	$productos = $query->fetchall();

	$query = $conexion->prepare('SELECT nombre_cat FROM categorias WHERE id = :id_cat');
	$query->execute(array(':id_cat' => $id_cat));
	$categoria = $query->fetch();

	// AGREGAR AL CARRITO

	if (isset($_POST['shortcut_carrito'])) {

		$id_producto = $_POST['id_producto'];
		$cantidad = 1;
		// Consultar si el usuario ya tiene el producto en el carrito
		$query = $conexion->prepare("
				SELECT * 
				FROM carrito 
				WHERE id_producto = :idprod AND id_user = :iduser
			");
		$query->execute(array(
				':idprod' => $id_producto,
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
				':idprod' => $id_producto,
				':iduser' => $iduser
			));
		} else {
			// El usuario NO tiene agregado el producto
			// echo "El usuario NO tiene agregado el producto";
			$query = $conexion->prepare("INSERT INTO carrito VALUES (null, :iduser, :idprod, :cantidad)");
			$query->execute(array(
				':iduser' => $iduser,
				':idprod' => $id_producto,
				':cantidad' => $cantidad
			));
			// echo "Se ha ingresado el producto al carrito";
		}
		header('Location: carrito.php');

	}

}



require 'views/productos_view.php';

 ?>