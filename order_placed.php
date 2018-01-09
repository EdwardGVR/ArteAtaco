<?php session_start();

require 'functions.php';

if (isset($_SESSION['user'])) {
	$user = $_SESSION['user'];
} else {
	$user = "Invitado";
}

//CODE...

require 'conexion.php';
$iduser = get_user_id($conexion, $user);

if ($conexion != false) {
	$query = $conexion->prepare("SELECT id, nombre_cat FROM categorias ORDER BY nombre_cat ASC");
	$query->execute();
	$categorias = $query->fetchall();

	$query = $conexion->prepare("SELECT codigo FROM pedidos WHERE id_user = :id_user ORDER BY fecha DESC");
	$query->execute(array(':id_user'=>$iduser));
	$recent_code = $query->fetch();
	// print_r($recent_code['codigo']);
}

require 'views/order_placed_view.php';

?>