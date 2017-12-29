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

// if (isset($_POST['confirm_info'])) {
// 	print_r($_POST);
// }

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

	if (isset($_POST['confirm_address'])) {
		$id_address = $_POST['id_address'];
		$id_user = $_POST['id_user'];

		$query = $conexion->prepare("SELECT * FROM temporal WHERE id_user = :id_user");
		$query->execute(array(':id_user'=>$id_user));
		$check_table = $query->fetchall();

		if ($check_table =! false) {
			$query = $conexion->prepare("UPDATE temporal SET id_direccion = :id_direccion WHERE id_user = :id_user");
			$query->execute(array(
				':id_direccion'=>$id_address,
				':id_user'=>$id_user
			));
		} else {
			$query = $conexion->prepare("INSERT INTO temporal VALUES (null, :id_user, :id_direccion, null)");
			$query->execute(array(
				':id_user'=>$id_user,
				':id_direccion'=>$id_address
			));
		}
	}

	$query = $conexion->prepare("SELECT * FROM temporal WHERE id_user = :id_user");
	$query->execute(array(':id_user'=>$iduser));
	$check_table2 = $query->fetch();
	// print_r($check_table2);
	
	$idaddress = $check_table2['id_direccion'];

	$query = $conexion->prepare("SELECT temporal.*, direcciones.nombre, direcciones.linea1 FROM temporal, direcciones WHERE temporal.id_user = :id_user AND direcciones.id = :id_address");
	$query->execute(array(':id_user'=>$iduser, ':id_address'=>$idaddress));
	$dir_sel = $query->fetch();
	// print_r($dir_sel);

	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirm_pay'])) {
		$id_pago = $_POST['id_pay_method'];

		$query = $conexion->prepare("UPDATE temporal SET id_pago = :id_pago WHERE id_user = :id_user");
		$query->execute(array(
			':id_pago'=>$id_pago,
			':id_user'=>$iduser
		));

		$query = $conexion->prepare("SELECT metodos_pago.* FROM temporal, metodos_pago WHERE temporal.id_user = :id_user AND metodos_pago.id = :id_pago");
		$query->execute(array(':id_user'=>$iduser, ':id_pago'=>$id_pago));
		$pay_sel = $query->fetch();

		print_r($pay_sel);
	}
}

require 'views/checkout_view.php';

?>