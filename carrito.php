<?php session_start();

require 'functions.php';

if (isset($_SESSION['user'])) {
	$user = $_SESSION['user'];
} else {
	$user = "Invitado";
}

$idprod = isset($_POST['idprod']) ? $_POST['idprod'] : false ;
$cantidad = isset($_POST['quantity']) ? $_POST['quantity'] : false ;

$conexion = conexion('login_propio', 'root', '');

$iduser = get_user_id($conexion, $user);

if ($conexion != false) {

	if ($idprod != 0 && $iduser != 0) {
		$query = $conexion->prepare("INSERT INTO carrito values (null, :user, :idprod, :cantidad)");
		$query->execute(array(
			':user'=>$iduser,
			':idprod'=>$idprod,
			':cantidad'=>$cantidad
	));	
	}

	$query = $conexion->prepare("SELECT id, nombre_cat FROM categorias");
	$query->execute();
	$categorias = $query->fetchall();

	$query = $conexion->prepare("SELECT * FROM productos WHERE id = :idprod");
	$query->execute(array(':idprod' => $idprod));
	$producto = $query->fetch();
}

$subtotal = $cantidad * $producto['precio'];

require 'views/carrito_view.php';

?>