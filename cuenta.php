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
$direccion_numero = 0;

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

	$query = $conexion->prepare("SELECT * FROM direcciones WHERE id_user = :iduser");
	$query->execute(array(':iduser' => $iduser));
	$dirs = $query->fetchall();
	// Obtener cantidad de direcciones del usuario
	$cant_direcciones = count($dirs);

	if ($cant_direcciones < 5) {
		$permitir_direccion = true;
	} else {
		$permitir_direccion = false;
	}

	// Guardar los cambios de usuario
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

	// Guardar los cambios de direccion
	if (isset($_POST['cambiar_direccion'])) {
		$dir_id = $_POST['id_address'];
		$errores_direccion = "";
		if (!empty($_POST['nombre_dir'])) {
			$nombre_dir_update = $_POST['nombre_dir'];		
		} else{
			$errores_direccion .= "El nombre es requerido <br />";
		}
		if (!empty($_POST['linea1_dir'])) {
			$linea1_update = $_POST['linea1_dir'];	
		} else {
			$errores_direccion .= "La linea 1 es requerida <br />";
		}
		if (!empty($_POST['linea2_dir'])) {
			$linea2_update = $_POST['linea2_dir'];	
		} else {
			$linea2_update = NULL;
		}
		if ( !empty($_POST['ref_dir'])) {
			$referencias_update = $_POST['ref_dir'];	
		} else {
			$referencias_update = NULL;
		}
		
		if (empty($errores_direccion)) {
			$query = $conexion->prepare("SELECT * FROM direcciones WHERE id = :id");
			$query->execute(array(':id' => $_POST['id_address']));
			$direccion = $query->fetch();

			if ($direccion['nombre'] != $nombre_dir_update) {
				$query = $conexion->prepare("UPDATE direcciones SET nombre = :nombre_dir_update WHERE id = :id");
				$query->execute(array(
					':nombre_dir_update' => $nombre_dir_update,
					':id' => $_POST['id_address']
				));
			}
			if ($direccion['linea1'] != $linea1_update) {
				$query = $conexion->prepare("UPDATE direcciones SET linea1 = :linea1_update WHERE id = :id");
				$query->execute(array(
					':linea1_update' => $linea1_update,
					':id' => $_POST['id_address']
				));	
			}
			if ($direccion['linea2'] != $linea2_update) {
				$query = $conexion->prepare("UPDATE direcciones SET linea2 = :linea2_update WHERE id = :id");
				$query->execute(array(
					':linea2_update' => $linea2_update,
					':id' => $_POST['id_address']
				));
			}
			if ($direccion['referencias'] != $referencias_update) {
				$query = $conexion->prepare("UPDATE direcciones SET referencias = :referencias_update WHERE id = :id");
				$query->execute(array(
					':referencias_update' => $referencias_update,
					':id' => $_POST['id_address']
				));
			}

			header('Location: cuenta.php');	
		}
	}

	$query = $conexion->prepare("SELECT * FROM direcciones WHERE id_user = :iduser");
	$query->execute(array(':iduser' => $iduser));
	$direcciones = $query->fetchall();
}

require 'views/cuenta_view.php';

?>