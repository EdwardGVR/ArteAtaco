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


if ($conexion != false) {
	// Agregar una direccion
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
				VALUES(null, :id_user, :id_departamento, :nombre, :pais, :linea1, :linea2, :referencias, 1, 0, 1, 1)
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
	
	// Obtener las categorias
	$query = $conexion->prepare("
		SELECT id, nombre_cat 
		FROM categorias 
		WHERE status = 1
		ORDER BY nombre_cat ASC");
	$query->execute();
	$categorias = $query->fetchall();

	// Obtener y comprobar cantidad de direcciones del usuario
	$query = $conexion->prepare("SELECT * FROM direcciones WHERE id_user = :iduser AND id_tipo = 1 AND disponible = 1");
	$query->execute(array(':iduser' => $iduser));
	$dirs = $query->fetchall();
	$cant_direcciones = count($dirs);
	
	if ($cant_direcciones <= 2) {
		$permitir_direccion = true;
		$restantes = 3 - $cant_direcciones;
	} else {
		$permitir_direccion = false;
	}

	// Obtener los productos en el carrito
	$query = $conexion->prepare("
		SELECT carrito.*, productos.id_categoria, productos.nombre, productos.precio, productos.stock 
		FROM carrito, productos 
		WHERE carrito.id_user = :iduser AND carrito.id_producto = productos.id 
		GROUP BY carrito.id_producto");
	$query->execute(array(':iduser'=>$iduser));
	$carrito = $query->fetchall();

	if (!$carrito) {
		header("Location:carrito.php");
	}

	// Obtener los departamentos
	$query = $conexion->prepare("SELECT * FROM departamentos");
	$query->execute(array());
	$departamentos = $query->fetchall();

	// Obtener los puntos de entrega activos
	$query = $conexion->prepare("
		SELECT direcciones.*, departamentos.nombre AS nombreDpto  
		FROM direcciones 
		JOIN departamentos ON direcciones.id_departamento = departamentos.id
		WHERE direcciones.id_tipo = 2 AND direcciones.estado = 1");
	$query->execute();
	$puntosEntrega = $query->fetchall();

	// Obtener las direcciones del cliente
	$query = $conexion->prepare("
		SELECT direcciones.*, departamentos.nombre AS nombreDpto
		FROM direcciones 
		JOIN departamentos ON direcciones.id_departamento = departamentos.id
		WHERE id_user = :id_user AND id_tipo = 1 AND disponible = 1");
	$query->execute(array(':id_user'=>$iduser));
	$direcciones = $query->fetchall();

	// Obtener los metodos de pago
	$query = $conexion->prepare("SELECT * FROM metodos_pago WHERE status = 1");
	$query->execute(array());
	$metodos = $query->fetchall();
	
	// Comprobar que se ha seleccionado una direccion
	if (isset($_COOKIE["dirSelected"]) && $_COOKIE["dirSelected"] != 0) {
		$idAddress = $_COOKIE['dirSelected'];

		// Consultar el tipo de direccion seleccionada
		$query = $conexion->prepare("SELECT id_tipo, estado FROM direcciones WHERE id = :idAddress");
		$query->execute(array(':idAddress' => $idAddress));
		$datosDireccion = $query->fetch();
		$tipoDireccion = $datosDireccion[0];
		$estadoDireccion = $datosDireccion[1];

		if ($estadoDireccion == 1) {
			if ($tipoDireccion == 1) {
				// Si es una direccion personalizada
				$query = $conexion->prepare(
					"SELECT direcciones.*, departamentos.nombre AS nombreDpto, departamentos.costo_envio AS costo
					 FROM direcciones 
					 JOIN departamentos ON direcciones.id_departamento = departamentos.id
					 WHERE direcciones.id = :idAddress 
				");
				$query->execute(array(':idAddress' => $idAddress));
				$dir_sel = $query->fetch();
			} elseif ($tipoDireccion == 2) {
				// Si es un punto de entrega
				$query = $conexion->prepare(
					"SELECT direcciones.*, departamentos.nombre AS nombreDpto
					 FROM direcciones 
					 JOIN departamentos ON direcciones.id_departamento = departamentos.id
					 WHERE direcciones.id = :idAddress
				");
				$query->execute(array(':idAddress' => $idAddress));
				$dir_sel = $query->fetch();
			}
		} elseif ($estadoDireccion == 0) {
			unset($_COOKIE['dirSelected']);
			setcookie("dirSelected", "", time()-3600);
			header('Loacation: checkout.php');
		}
	}

	// Comprobar que se ha seleccionado un metodo de pago
	if (isset($_COOKIE["pagoSelected"]) && $_COOKIE["pagoSelected"] != 0) {
		$query = $conexion->prepare("SELECT * FROM metodos_pago WHERE id = :id");
		$query->execute(array(':id' => $_COOKIE["pagoSelected"]));
		$pay_sel = $query->fetch();
		$payStatus = $pay_sel['status'];

		if ($payStatus == 0) {
			setcookie('pagoSelected', '0', -1000);
			unset($_COOKIE['pagoSelected']);
			$pay_sel = false;
			header("location: checkout.php");
		}
	}
}

if (isset($dir_sel)) {
	$costoEnvio = $dir_sel['costo'];
} else {
	$costoEnvio = 0;
}

if (isset($dir_sel) && isset($pay_sel)) {
	if ($estadoDireccion == 1 && $payStatus == 1) {
		$allowPass = true;
	} else {
		$allowPass = false;
	}
} else {
	$allowPass = false;
}

require 'views/checkout_view.php';
?>