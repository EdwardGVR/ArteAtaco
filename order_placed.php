<?php session_start();

require 'functions.php';

if (isset($_SESSION['user'])) {
	$user = $_SESSION['user'];
} else {
	header("Location: categorias.php");
	$user = "Invitado";
}

if (isset($_COOKIE['order_placed_ckp'])) {
	unset($_COOKIE['order_placed_ckp']);
	setcookie("order_placed_ckp", "", time()-3600);
} else {
	header("Location: categorias.php");
}

require 'conexion.php';
$iduser = get_user_id($conexion, $user);

if ($conexion != false) {
	$query = $conexion->prepare("
		SELECT id, nombre_cat 
		FROM categorias 
		WHERE status = 1
		ORDER BY nombre_cat ASC");
	$query->execute();
	$categorias = $query->fetchall();

	$query = $conexion->prepare("SELECT codigo FROM pedidos WHERE id_user = :id_user ORDER BY fecha DESC");
	$query->execute(array(':id_user'=>$iduser));
	$recent_code = $query->fetch();
	// print_r($recent_code['codigo']);
}

require 'views/order_placed_view.php';

?>