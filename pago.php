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

$codigo = $iduser;

if ($conexion != false) {
	$query = $conexion->prepare("SELECT id, nombre_cat FROM categorias");
	$query->execute();
	$categorias = $query->fetchall();

	$query = $conexion->prepare("SELECT * FROM temporal WHERE id_user = :id_user");
	$query->execute(array(':id_user'=>$iduser));
	$datos_cliente = $query->fetch();

	$id_direccion = $datos_cliente['id_direccion'];
	$codigo .= $id_direccion;
	$id_metodo_pago = $datos_cliente['id_pago'];
	$codigo .= $id_metodo_pago;

	echo $codigo;
}

require 'views/pago.view.php';

?>