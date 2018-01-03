<?php session_start();

//if (isset($_COOKIE["auto_inc_code"])) {
//	$auto_inc_code = $_COOKIE["auto_inc_code"];
//	$auto_inc_code++;
//	setcookie("auto_inc_code", $auto_inc_code);
//	$unique_code = $_COOKIE["auto_inc_code"]; 
	// echo $_COOKIE["auto_inc_code"];
//} else {
//	$auto_inc_code = 1;
	//setcookie("auto_inc_code", $auto_inc_code);
	// echo $_COOKIE["auto_inc_code"];
//}

require 'functions.php';

$unique_code = auto_inc_code();
// echo $unique_code;

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
	$random_code = rand(0,9);
	$codigo .= $random_code;
	$codigo .= $unique_code;
	// echo $codigo;

	if (isset($_POST['place_order'])) {
		$query = $conexion->prepare("SELECT  * FROM carrito WHERE id_user = :id_user");
		$query->execute(array(':id_user'=>$iduser));
		$productos_carrito = $query->fetchall();

		foreach ($productos_carrito as $producto) {
			$query = $conexion->prepare("INSERT INTO pedidos VALUES (null, :codigo, :id_user, :id_direccion, :id_pago, :id_producto, :cantidad, 0, CURRENT_TIMESTAMP)");
			$query->execute(array(
				':codigo'=>$codigo,
				':id_user'=>$iduser,
				':id_direccion'=>$id_direccion,
				':id_pago'=>$id_metodo_pago,
				':id_producto'=>$producto['id_producto'],
				':cantidad'=>$producto['cantidad']
			));	
		}

		$query = $conexion->prepare("SELECT * FROM pedidos WHERE codigo = :codigo");
		$query->execute(array(':codigo'=>$codigo));
		$check_pedido = $query->fetch();

		if ($check_pedido != false) {
			$query = $conexion->prepare("DELETE FROM carrito WHERE id_user = :id_user");
			$query->execute(array(':id_user'=>$iduser));
		}

		header('Location: order_placed.php');
	}
}

require 'views/pago.view.php';

?>