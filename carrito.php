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
}

require 'views/carrito_view.php';

?>