<?php session_start();

require 'functions.php';

if (isset($_SESSION['user'])) {
	$user = $_SESSION['user'];
} else {
	header("Location: categorias.php");
	$user = "Invitado";
}

// print_r($_POST['carrito_checkpoint']);

$subtotal = 0;
$errores = "";
require 'conexion.php';
$iduser = get_user_id($conexion, $user);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_address'])) {

	if (!empty($_POST['address_name'])) {
		$address_name = $_POST['address_name'];
	} else {
		$errores .= "Por favor ingrese un nombre descriptivo <br />";
	}

	$pais = "El Salvador";

	$departamento = $_POST['departamento'];

	if (!empty($_POST['address_line_1'])) {
		$address_line_1 = $_POST['address_line_1'];
	} else {
		$errores .= "Por favor ingrese la linea 1 de la direccion <br />";
	}

	if (!empty($_POST['address_line_2'])) {
		$address_line_2 = $_POST['address_line_2'];
	} else {
		$address_line_2 = NULL;
	}

	if (!empty($_POST['referencias'])) {
		$referencias = $_POST['referencias'];
	} else {
		$referencias = NULL;
	}

	if ($conexion != false && empty($errores)) {
		$query = $conexion->prepare("
			INSERT INTO direcciones 
			VALUES(null, :id_user, :id_departamento, :nombre, :pais, :linea1, :linea2, :referencias, 1)
		");
		$query->execute(array(
			':id_user'=>$iduser,
			':id_departamento'=>$departamento,
			':nombre'=>$address_name,
			':pais'=>$pais,
			':linea1'=>$address_line_1,
			':linea2'=>$address_line_2,
			':referencias'=>$referencias
		));

		$query = $conexion->prepare("
			INSERT INTO direcciones_persistence
			VALUES(null, :id_user, :id_departamento, :nombre, :pais, :linea1, :linea2, :referencias, 1, 1)
		");
		$query->execute(array(
			':id_user'=>$iduser,
			':id_departamento'=>$departamento,
			':nombre'=>$address_name,
			':pais'=>$pais,
			':linea1'=>$address_line_1,
			':linea2'=>$address_line_2,
			':referencias'=>$referencias
		));

		$added = "Se agreg&oacute; la direcci&oacute;n!";
	}

	if (isset($added)) {
		header("Location: checkout.php");
	}
}

if ($conexion != false) {

	$query = $conexion->prepare("SELECT id, nombre_cat FROM categorias ORDER BY nombre_cat ASC");
	$query->execute();
	$categorias = $query->fetchall();

	$query = $conexion->prepare("SELECT * FROM direcciones WHERE id_user = :iduser");
	$query->execute(array(':iduser' => $iduser));
	$dirs = $query->fetchall();
	// Obtener cantidad de direcciones del usuario
	$cant_direcciones = count($dirs);
	// print_r($cant_direcciones);

	if ($cant_direcciones <= 2) {
		$permitir_direccion = true;
		$restantes = 3 - $cant_direcciones;
	} else {
		$permitir_direccion = false;
	}

	$query = $conexion->prepare("
		SELECT carrito.*, productos.id_categoria, productos.nombre, productos.precio, productos.stock, productos.imagen 
		FROM carrito, productos 
		WHERE carrito.id_user = :iduser AND carrito.id_producto = productos.id 
		GROUP BY carrito.id_producto");
	$query->execute(array(':iduser'=>$iduser));
	$carrito = $query->fetchall();

	if (!$carrito) {
		header("Location:carrito.php");
	}

	$query = $conexion->prepare("SELECT * FROM departamentos");
	$query->execute(array());
	$departamentos = $query->fetchall();

	// print_r($departamentos[6][2]);

	$query = $conexion->prepare("SELECT * FROM direcciones WHERE id_user = :id_user");
	$query->execute(array(':id_user'=>$iduser));
	$direcciones = $query->fetchall();

	$query = $conexion->prepare("SELECT * FROM metodos_pago");
	$query->execute(array());
	$metodos = $query->fetchall();
	// print_r($metodos);
	
	if (isset($_COOKIE["dirSelected"]) && $_COOKIE["dirSelected"] != 0) {
		$query = $conexion->prepare(
			"SELECT direcciones.*, departamentos.nombre AS nombreDpto
			 FROM direcciones 
			 JOIN departamentos ON direcciones.id_departamento = departamentos.id
			 WHERE direcciones.id = :idAddress 
		");
		$query->execute(array(':idAddress' => $_COOKIE['dirSelected']));
		$dir_sel = $query->fetch();
	}

	if (isset($_COOKIE["pagoSelected"]) && $_COOKIE["pagoSelected"] != 0) {
		$query = $conexion->prepare("SELECT * FROM metodos_pago WHERE id = :id");
		$query->execute(array(':id' => $_COOKIE["pagoSelected"]));
		$pay_sel = $query->fetch();
	}

}

// print_r($_COOKIE["dirSelected"]);

if (isset($dir_sel) && isset($pay_sel)) {
	$allowPass = true;
} else {
	$allowPass = false;
}

require 'views/checkout_view.php';

?>