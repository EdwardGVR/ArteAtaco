<?php session_start();

require 'functions.php';
require 'conexion.php';
if (!$conexion) {
	header('Location: error.php');
}

$errores = '';

// Comprobamos que se haya enviado el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// Comprobamos que se haya ingresado un usuario
	if (!empty($_POST['nombre'])) {
		$user = filter_var(strtolower($_POST['nombre']), FILTER_SANITIZE_STRING);
	} else {
		$errores .= '<li>No se ingreso el usuario o correo</li>';
	}
	// Comprobamos que se haya ingresado la contrasena
	if (!empty($_POST['pass'])) {
		$password = $_POST['pass'];
	} else {
		$errores .= '<li>No se ingreso la contraseña</li>';
	}

	if (empty($errores)) {
		$login = login_verification($conexion, $user, $password);

		if ($login) {
			$query = $conexion->prepare("SELECT user FROM usuarios WHERE user = :user OR email = :user");
			$query->execute(array(':user' => $user));
			$logged = $query->fetch();

			$_SESSION['user'] = $logged['user'];	
			header('Location: categorias.php');
			//print_r($logged);
		} else {
			$errores .= '<li>Datos Incorrectos</li>';
		}
	}
}

require 'views/login_view.php';

 ?>