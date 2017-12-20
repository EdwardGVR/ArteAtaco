<?php session_start();

require 'functions.php';

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

	$conexion = conexion('heroku_33996c8507d92de', 'bd1afaf8a26c4e', 'aeb413f5');
	if (!$conexion) {
		header('Location: error.php');
	}

	if (empty($errores)) {
		$login = login_verification($conexion, $user, $password);

		print_r($login);

		if ($login != false) {
			$query = $conexion->prepare("SELECT user FROM usuarios WHERE user = :user OR email = :user");
			$query->execute(array(':user' => $user));
			$logged = $query->fetch();
			$_SESSION['user'] = $logged['user'];
			//print_r($logged);
			header('Location: categorias.php');
		} else {
			$errores .= '<li>Datos Incorrectos</li>';
		}
	}
}

// Enlazamos con el archivo de la vista
// (DEBE IR AL FINAL)
require 'views/login_view.php';

 ?>