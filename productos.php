<?php session_start();

require 'functions.php';

if (isset($_SESSION['user'])) {
	$user = $_SESSION['user'];
} else {
	$user = "Invitado";
}

require 'conexion.php';
$iduser = get_user_id($conexion, $user);

$id_cat = isset($_GET['id']) ? $_GET['id'] : false;

if (!$id_cat) {
	header('Location: categorias.php');
}

if ($conexion != false) {
	// Obtener categorias para el menu
	$query = $conexion->prepare('SELECT * FROM categorias ORDER BY nombre_cat ASC');
	$query->execute();
	$categorias = $query->fetchall();

	// Obtener datos de los productos de la categoria
	if ($id_cat == "otros") {
		$query = $conexion->prepare('
			SELECT * FROM productos 
			WHERE to_others = 1 
			AND disponible = 1
		');
		$query->execute();
		$productos = $query->fetchall();
	} else {
		$query = $conexion->prepare('
			SELECT * FROM productos 
			WHERE id_categoria = :id_cat
			AND to_others = 0 
			AND disponible = 1
		');
		$query->execute(array(':id_cat' => $id_cat));
		$productos = $query->fetchall();
	}

	//Otener todas las imagenes de los productos de la categoria
	if ($id_cat == "otros") {
		$query = $conexion->prepare(
			"SELECT imgs_prods.*, productos.id_categoria FROM imgs_prods
				JOIN productos ON imgs_prods.id_prod = productos.id
				WHERE to_others = 1"
		);
		$query->execute();
		$catImgs = $query->fetchall();
	} else {
		$query = $conexion->prepare(
			"SELECT imgs_prods.*, productos.id_categoria FROM imgs_prods
				JOIN productos ON imgs_prods.id_prod = productos.id
				WHERE id_categoria = :id_cat"
		);
		$query->execute(array(':id_cat' => $id_cat));
		$catImgs = $query->fetchall();
	}

	//Otener imagenes principales de los productos de la categoria
	$query = $conexion->prepare(
		"SELECT imgs_prods.*, productos.id_categoria FROM imgs_prods
		 JOIN productos ON imgs_prods.id_prod = productos.id
		 WHERE imgs_prods.principal = 1 AND id_categoria = :id_cat"
	);
	$query->execute(array(':id_cat' => $id_cat));
	$mainImgs = $query->fetchall();

	//Otener imagenes no principales de los productos de la categoria
	$query = $conexion->prepare(
		"SELECT imgs_prods.*, productos.id_categoria FROM imgs_prods
		 JOIN productos ON imgs_prods.id_prod = productos.id
		 WHERE imgs_prods.principal = 0 AND id_categoria = :id_cat"
	);
	$query->execute(array(':id_cat' => $id_cat));
	$notMainImgs = $query->fetchall();

	// Obtener categorias para el title de la tab
	if ($id_cat == "otros") {
		$categoria = "Otros";
	} else {
		$query = $conexion->prepare('SELECT nombre_cat FROM categorias WHERE id = :id_cat');
		$query->execute(array(':id_cat' => $id_cat));
		$categoria = $query->fetch();
		$categoria = $categoria['nombre_cat'];
	}

	// AGREGAR AL CARRITO
	if (isset($_POST['shortcut_carrito'])) {

		$id_producto = $_POST['id_producto'];
		$cantidad = 1;
		// Consultar si el usuario ya tiene el producto en el carrito
		$query = $conexion->prepare("
				SELECT * 
				FROM carrito 
				WHERE id_producto = :idprod AND id_user = :iduser
			");
		$query->execute(array(
				':idprod' => $id_producto,
				':iduser' => $iduser
			));
		$consultar_carrito = $query->fetch();

		if ($consultar_carrito != false) {
			// echo "El usuario ya tiene agregado el producto";
			$cantidad_uptaded = $consultar_carrito['cantidad'] + $cantidad;
			// echo "Se ha actualizado la cantidad";
			$query = $conexion->prepare("UPDATE carrito SET cantidad = :cantidad_uptaded WHERE id_producto = :idprod AND id_user = :iduser");
			$query->execute(array(
				':cantidad_uptaded' => $cantidad_uptaded,
				':idprod' => $id_producto,
				':iduser' => $iduser
			));
		} else {
			// echo "El usuario NO tiene agregado el producto";
			$query = $conexion->prepare("INSERT INTO carrito VALUES (null, :iduser, :idprod, :cantidad)");
			$query->execute(array(
				':iduser' => $iduser,
				':idprod' => $id_producto,
				':cantidad' => $cantidad
			));
			// echo "Se ha ingresado el producto al carrito";
		}
		header('Location: carrito.php');

	}
}

require 'views/productos_view.php';

 ?>