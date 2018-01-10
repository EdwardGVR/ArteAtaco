<?php 

require 'functions.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

	require 'conexion.php';

	if (!$conexion) {
		header('Location: error.php');
	}

	$errores = "";
	
	if (!empty($_POST['nombre'])) {
		$nombre = filter_var(strtolower($_POST['nombre']), FILTER_SANITIZE_STRING);

		$query = $conexion->prepare ("SELECT * FROM usuarios WHERE user = :user LIMIT 1");
		$query->execute(array(':user' => $nombre));
		$result = $query->fetch();

		if ($result != false) {
			$errores .= "<li>El usuario ya existe</li>";
		} else {
			$user = $nombre;
		}
	} else {
		$errores .= "<li>No se ingreso un nombre</li>";
	}

	if (!empty($_POST['nombres'])) {
		$nombres = filter_var(strtolower($_POST['nombres']), FILTER_SANITIZE_STRING);
	} else {
		$nombre = null;
	}

	if (!empty($_POST['apellidos'])) {
		$apellidos = filter_var(strtolower($_POST['apellidos']), FILTER_SANITIZE_STRING);
	} else {
		$apellidos = null;
	}

	if (!empty($_POST['correo'])) {
		$correo = filter_var($_POST['correo'], FILTER_SANITIZE_EMAIL);

		$query = $conexion->prepare ("SELECT * FROM usuarios WHERE email = :email LIMIT 1");
		$query->execute(array(':email' => $correo));
		$result = $query->fetch();

		if ($result != false) {
			$errores .= "<li>El correo ya esta registrado</li>";
		} else {
			$email = $correo;
		}


	} else {
		$errores .= "<li>No se ingreso un correo</li>";
	}

	if (!empty($_POST['pass'])) {
		$contra1 = $_POST['pass'];

		if (!empty($_POST['pass2'])) {
			$contra2 = $_POST['pass2'];

			if ($contra1 != $contra2) {
				$errores .= "<li>Las contraseñas no coinciden</li>";
			} else {
				$password = $contra2;
			}

		} else {
			$errores .= "<li>Repetir la contraseña</li>";
		}

	} else {
		$errores .= "<li>No se ingreso una contraseña</li>";
	}

	if (empty($errores)) {
		// Ingresar Datos
		//echo "Correcto";

		$query = $conexion->prepare ("INSERT INTO usuarios (id, user, nombres, apellidos, email, password) VALUES (null, :user, :nombres, :apellidos, :email, :pass)");
		$query->execute(array(
			":user" => $user,
			":nombres" => $nombres,
			":apellidos" => $apellidos,
			":email" => $email,
			":pass" => $password
		));

		header('Location: login.php');
	}

}

require 'views/register_view.php';

 ?>