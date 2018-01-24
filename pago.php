<?php session_start();

require 'functions.php';

if (isset($_SESSION['user'])) {
	$user = $_SESSION['user'];
} else {
	header("Location: categorias.php");
	$user = "Invitado";
}

if (!isset($_POST['checkout_checkpoint'])) {
	header("Location: carrito.php");
}

require 'conexion.php';
$iduser = get_user_id($conexion, $user);

//CODE...

$codigo = $iduser;

if ($conexion != false) {
	$query = $conexion->prepare("SELECT id, nombre_cat FROM categorias ORDER BY nombre_cat ASC");
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
	// echo $codigo;

	if (isset($_POST['place_order'])) {
		$unique_code = auto_inc_code();
		$codigo .= $unique_code;
		// echo $unique_code;

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

		$query = $conexion->prepare("DELETE FROM temporal WHERE id_user = :iduser");
		$query->execute(array(':iduser' => $iduser));

		setcookie("order_placed_ckp", true);

		header('Location: order_placed.php');
	}
}

require 'views/pago.view.php';

?>