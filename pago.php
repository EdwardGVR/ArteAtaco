<?php session_start();

require 'functions.php';

if (isset($_SESSION['user'])) {
	$user = $_SESSION['user'];
} else {
	$user = "Invitado";
}

require 'conexion.php';
$iduser = get_user_id($conexion, $user);

//CODE...
if (isset($_POST['confirm_info'])) {
	$id_metodo_pago = $_POST['pm_id'];
	// print_r($_POST);
}

if ($conexion != false) {
	$query = $conexion->prepare("SELECT id, nombre_cat FROM categorias");
	$query->execute();
	$categorias = $query->fetchall();
}

require 'views/pago.view.php';

?>