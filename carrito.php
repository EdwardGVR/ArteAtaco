<?php session_start();

require 'functions.php';

if (isset($_SESSION['user'])) {
	$user = $_SESSION['user'];
} else {
	$user = "Invitado";
}

$idprod = isset($_POST['idprod']) ? $_POST['idprod'] : false ;
$conexion = conexion('login_propio', 'root', '');
$iduser = get_user_id($conexion, $user);

if ($conexion != false) {

	$query = $conexion->prepare("SELECT id, nombre_cat FROM categorias");
	$query->execute();
	$categorias = $query->fetchall();

	$query = $conexion->prepare("SELECT * FROM productos WHERE id = :idprod");
	$query->execute(array(':idprod' => $idprod));
	$producto = $query->fetch();

	$query = $conexion->prepare("SELECT carrito.*, productos.* FROM carrito, productos WHERE carrito.id_user = :iduser GROUP BY carrito.id_producto");
	$query->execute(array(':iduser'=>$iduser));
	$carrito = $query->fetchall();

	// print_r($carrito);
}

require 'views/carrito_view.php';

?>