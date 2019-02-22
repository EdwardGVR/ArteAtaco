<?php session_start();

require 'functions.php';

if (isset($_SESSION['user'])) {
	$user = $_SESSION['user'];
} else {
	header("Location: categorias.php");
	$user = "Invitado";
}

//CODE...
require 'conexion.php';
$iduser = get_user_id($conexion, $user);

$orderCode = (isset($_GET['orderCode'])) ? $_GET['orderCode'] : false;

if ($conexion != false) {
	// Obtener categorias
	$query = $conexion->prepare("
		SELECT id, nombre_cat 
		FROM categorias 
		WHERE status = 1
		ORDER BY nombre_cat ASC");
	$query->execute();
	$categorias = $query->fetchall();


	if ($orderCode != false) {
		// Obtener pedido
		$query = $conexion->prepare("
			SELECT pedidos.*,
				direcciones.nombre AS dir_name,
				direcciones.disponible,
				direcciones.estado AS dir_status,
				direcciones.linea1 AS dir_ln1,
				direcciones.linea2 AS dir_ln2,
				direcciones.referencias AS dir_refs,
				direcciones.pais AS dir_pais,
				departamentos.nombre AS dir_dpt,
				metodos_pago.nombre AS pay_name,
				metodos_pago.icon AS pay_icon,
				order_status.status AS order_status
			FROM pedidos
			JOIN direcciones ON pedidos.id_direccion = direcciones.id
			JOIN departamentos ON direcciones.id_departamento = departamentos.id
			JOIN metodos_pago ON pedidos.id_pago = metodos_pago.id
			JOIN order_status ON pedidos.estado = order_status.id
			WHERE pedidos.codigo = :orderCode
			GROUP BY pedidos.codigo");
		$query->execute(array(':orderCode'=>$orderCode));
		$pedido = $query->fetch();

		$statusClass = str_replace(" ", "_", $pedido['order_status']);
		$statusClass = strtolower($statusClass);

		$query = $conexion->prepare("SELECT comprobante FROM comprobantes_pago WHERE orderCode = :orderCode");
		$query->execute(array(':orderCode' => $orderCode));
		$comprobante = $query->fetch();
		$comprobante = $comprobante['comprobante'];

		// Obtener productos del pedido
		$query = $conexion->prepare("
			SELECT 	pedidos.*, 
					productos.id AS idProd, 
					productos.nombre AS nombreProd, 
					productos.disponible, 
					productos.deleted AS prodDeleted
			FROM pedidos 
			JOIN productos ON pedidos.id_producto = productos.id
			WHERE pedidos.codigo = :orderCode
		");
		$query->execute(array(':orderCode' => $orderCode));
		$prodsPed = $query->fetchall();

		$subtotal = 0;
		foreach ($prodsPed as $p) {
			$subtotal += ($p['precioCompra'] * $p['cantidad']);
		}
		$subtotal = number_format($subtotal, 2);
		$total = number_format($subtotal + $pedido['costoEnvioCompra'], 2);

		if (isset($_FILES['payCompImg'])) {
			$compImg = $_FILES['payCompImg'];
			$compImg['name'] = $orderCode . "CDP.jpg";

			$uploadedFile = "payMethods/comprobantes/" . $compImg['name'];
			move_uploaded_file($compImg['tmp_name'], $uploadedFile);

			compressImgs(["$uploadedFile"], 50);

			$query = $conexion->prepare("INSERT INTO comprobantes_pago (id, orderCode, comprobante) VALUES (null, :orderCode, :comp)");
			$query->execute(array(
				':orderCode' => $orderCode,
				':comp' => $uploadedFile
			));

			$query = $conexion->prepare("UPDATE pedidos SET estado = 2 WHERE codigo = :orderCode");
			$query->execute(array(':orderCode' => $orderCode));
			
			header("location: det_pedido.php?orderCode=$orderCode");
		}
	}

	// Obtener imagenes de productos
	$query = $conexion->prepare("SELECT * FROM imgs_prods");
	$query->execute();
	$imgs = $query->fetchall();
}

require 'views/det_pedido_view.php';

?>