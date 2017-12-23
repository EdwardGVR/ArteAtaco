<?php session_start();

require 'functions.php';

if (isset($_SESSION['user'])) {
	$user = $_SESSION['user'];
} else {
	$user = "Invitado";
}

$idprod = isset($_POST['idprod']) ? $_POST['idprod'] : false ;
require 'conexion.php';
$iduser = get_user_id($conexion, $user);
$subtotal = 0;

if ($conexion != false) {

	$query = $conexion->prepare("SELECT id, nombre_cat FROM categorias");
	$query->execute();
	$categorias = $query->fetchall();

	$query = $conexion->prepare("
		SELECT carrito.*, productos.id_categoria, productos.nombre, productos.precio, productos.stock, productos.imagen 
		FROM carrito, productos 
		WHERE carrito.id_user = :iduser AND carrito.id_producto = productos.id 
		GROUP BY carrito.id_producto");
	$query->execute(array(':iduser'=>$iduser));
	$carrito = $query->fetchall();

	// print_r($carrito);

	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['actualizar_cantidad'])) {
		$cantidad_actualizada = $_POST['quantity'];

		$query = $conexion->prepare("SELECT * FROM carrito WHERE id = :idcarrito");
		$query->execute(array(':idcarrito'=>$_POST['idcarrito']));
		$item_update = $query->fetch();

		if ($item_update['cantidad'] != $cantidad_actualizada) {
			$query = $conexion->prepare("UPDATE carrito SET cantidad = :cantidad_actualizada WHERE id = :idcarrito");
			$query->execute(array(
				':cantidad_actualizada'=>$cantidad_actualizada,
				':idcarrito'=>$_POST['idcarrito']
			));

			header('Location: carrito.php');
		}
	}

	if (isset($_POST['delete_item'])) {
		$id_eliminar = $_POST['idCarritoDelete'];
		$item_nombre = $_POST['itemName'];
		$query = $conexion->prepare("DELETE FROM carrito WHERE id = :id_delete");
		$query->execute(array(':id_delete' => $id_eliminar));

		header('Location: carrito.php');
	}

}

require 'views/carrito_view.php';

?>