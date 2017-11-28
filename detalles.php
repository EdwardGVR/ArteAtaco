	<?php session_start();

require 'functions.php';

if (isset($_SESSION['user'])) {
	$user = $_SESSION['user'];
} else {
	$user = "Invitado";
}

$id_prod = isset($_GET['id_prod']) ? $_GET['id_prod'] : false;

$conexion = conexion('login_propio', 'root', '');

if ($conexion != false) {

	$query = $conexion->prepare('SELECT * FROM productos WHERE id = :id_prod');
	$query->execute(array(':id_prod' => $id_prod));
	$detalles = $query->fetch();

	$query = $conexion->prepare("SELECT id, nombre_cat FROM categorias");
	$query->execute();
	$categorias = $query->fetchall();

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$idprod = $_POST['idprod'];
		$username = $_POST['username'];
		$cantidad = $_POST['quantity'];
		$iduser = get_user_id($conexion, $user);

		$query = $conexion->prepare("SELECT * FROM carrito WHERE id_producto = :idprod and id_user = :iduser");
		$query->execute(array(
			':idprod' => $idprod,
			':iduser' => $iduser
		));
		$consultar_carrito = $query->fetchall();

		// print_r($consultar_carrito);

		if (!empty($consultar_carrito)) {
			$cantidad = $consultar_carrito['cantidad'] + $_POST['quantity'];

			$query = $conexion->prepare("UPDATE carrito SET cantidad = :cantidad WHERE id_producto = :idprod");
			$query->execute(array(
				':cantidad' => $cantidad,
				':idprod' => $idprod
			));
		} else {
			$query = $conexion->prepare("INSERT INTO carrito values (null, :user, :idprod, :cantidad)");
			$query->execute(array(
				':user'=>$iduser,
				':idprod'=>$idprod,
				':cantidad'=>$cantidad
			));
		}	

		header('Location: carrito.php');
	}
}

require 'views/detalles_view.php';

?>