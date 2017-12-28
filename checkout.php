<?php session_start();

require 'functions.php';

if (isset($_SESSION['user'])) {
	$user = $_SESSION['user'];
} else {
	$user = "Invitado";
}

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
		$address_line_2 = "";
	}

	if (!empty($_POST['referencias'])) {
		$referencias = $_POST['referencias'];
	} else {
		$referencias = "";
	}

	if ($conexion != false && empty($errores)) {
		$query = $conexion->prepare("INSERT INTO direcciones VALUES(null, :id_user, :id_departamento, :nombre, :pais, :linea1, :linea2, :referencias)");
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
}

if (isset($_POST['confirm_address'])) {
	$id_address = $_POST['id_address'];

	if ($conexion != false) {
		$query = $conexion->prepare("SELECT * FROM direcciones WHERE id = :id_address");
		$query->execute(array(':id_address'=>$id_address));
		$direccion_selected = $query->fetch();
	}
}

if (isset($_POST['confirm_pay'])) {
	$pay_select = true;
	if (!empty($_POST['payment_method'])) {
		$payment_method = $_POST['payment_method'];	
	} else {
		$payment_method = "No se seleccion&oacute; ning&uacute;n m&eacute;todo";
	}
} else {
	$pay_select = false;
}

if (isset($_POST['confirm_info'])) {
	print_r($_POST);
}

if ($conexion != false) {
	$query = $conexion->prepare("SELECT id, nombre_cat FROM categorias");
	$query->execute();
	$categorias = $query->fetchall();

	$query = $conexion->prepare("
		SELECT carrito.*, productos.id_categoria, productos.nombre, productos.precio, productos.stock, productos.imagen 
		FROM carrito, productos 
		WHERE carrito.id_user = :iduser AND carrito.id_producto = productos.id 
		GROUP BY carrito.id_producto");
	$query->execute(array(':iduser'=>$iduser));
	$carrito = $query->fetchall();

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
}

require 'views/checkout_view.php';

?>