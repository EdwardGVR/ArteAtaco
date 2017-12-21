<?php session_start();

require 'functions.php';

if (isset($_SESSION['user'])) {
	$user = $_SESSION['user'];
} else {
	$user = "Invitado";
}

$subtotal = 0;

$conexion = conexion('login_propio', 'root', '');
$iduser = get_user_id($conexion, $user);

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

	$query = $conexion->prepare("SELECT * FROM departamentos");
	$query->execute(array());
	$departamentos = $query->fetchall();

	// print_r($departamentos[6][2]);
}

require 'views/checkout_view.php';

?>