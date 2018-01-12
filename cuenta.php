<?php

if (!isset($_SESSION['user'])) {
	session_start();
}

require 'functions.php';
require 'conexion.php';

if (isset($_SESSION['user'])) {
	$user = $_SESSION['user'];
	$iduser = get_user_id($conexion, $user);
} else {
	$user = 'Invitado';
	$iduser = false;
}

$iduser = get_user_id($conexion, $user);

if (!is_null(get_user_data($conexion, $iduser)['imagen'])) {
	$imagen = get_user_data($conexion, $iduser)['imagen'];
}

$pedidos_activos = cantidad_pedidos_activos($conexion, $iduser);
$datos_user = get_user_data($conexion, $iduser);

// Comprobacion de datos para mostrar en formulario
if (!is_null($datos_user['nombres'])) {
	$nombres = $datos_user['nombres'];
} else {
	$nombres = "No hay datos";
}
if (!is_null($datos_user['apellidos'])) {
	$apellidos = $datos_user['apellidos'];
} else {
	$apellidos = "No hay datos";
}
if (!is_null($datos_user['email'])) {
	$email = $datos_user['email'];
} else {
	$email = "No hay datos";
}
if (!is_null($datos_user['telefono'])) {
	$telefono = $datos_user['telefono'];
} else {
	$telefono = "No hay datos";
}

if ($conexion != false) {
	$query = $conexion->prepare('SELECT * FROM categorias ORDER BY nombre_cat ASC');
	$query->execute();
	$categorias = $query->fetchall();

	//print_r($categorias);

	// Guardar los cambios
	if (isset($_POST['guardar'])) {
		$nombres_update = $_POST['nombres'];
		$apellidos_update = $_POST['apellidos'];
		$email_update = $_POST['email'];
		$telefono_update = $_POST['telefono'];

		if ($nombres_update != $nombres) {
			$query = $conexion->prepare("UPDATE usuarios SET nombres = :nombres_update WHERE id = :iduser");
			$query->execute(array(
				':nombres_update' => $nombres_update,
				':iduser'=>$iduser
			));
		}
		if ($apellidos_update != $apellidos) {
			$query = $conexion->prepare("UPDATE usuarios SET apellidos = :apellidos_update WHERE id = :iduser");
			$query->execute(array(
				':apellidos_update' => $apellidos_update,
				':iduser'=>$iduser
			));	
		}
		if ($email_update != $email) {
			$query = $conexion->prepare("UPDATE usuarios SET email = :email_update WHERE id = :iduser");
			$query->execute(array(
				':email_update' => $email_update,
				':iduser'=>$iduser
			));
		}
		if ($telefono_update != $telefono) {
			$query = $conexion->prepare("UPDATE usuarios SET telefono = :telefono_update WHERE id = :iduser");
			$query->execute(array(
				':telefono_update' => $telefono_update,
				':iduser'=>$iduser
			));
		}
		header('Location: cuenta.php');
	}
}

require 'views/cuenta_view.php';

?>