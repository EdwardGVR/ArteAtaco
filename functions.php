<?php 

function conexion($DB, $user, $pass){
	try {
		$conexion = new PDO("mysql:host=localhost;dbname=$DB", $user, $pass);
		return $conexion;
	} catch (PDOException $e) {
		echo "Error en la conexion". $e;
	}
}

function login_verification($conexion, $user, $password){
	$query = $conexion->prepare("SELECT * FROM usuarios WHERE (user = :user OR email = :user) AND password = :password");
	$query->execute(array(
		':user' => $user,
		':password' => $password
	));

	$query_result = $query->fetch();

	if ($query_result != false) {
		return true;
	} else {
		return false;
	}
}

function get_user_id($conexion, $user){
	$query = $conexion->prepare("SELECT id, user FROM usuarios WHERE user = :user");
	$query->execute(array(':user'=>$user));
	$result = $query->fetch();

	if ($result != false) {
		return $result['id'];
	} else {
		return false;
	}
}

function get_user_data($conexion, $iduser){
	$query = $conexion->prepare("SELECT * FROM usuarios WHERE id = :iduser");
	$query->execute(array(':iduser'=>$iduser));
	$result = $query->fetch();

	if ($result != false) {
		return $result;
	} else {
		return false;
	}
}

function get_user_img($conexion, $iduser) {
	$query = $conexion->prepare("SELECT imagen FROM usuarios WHERE id = :iduser");
	$query->execute(array(':iduser'=>$iduser));
	$result = $query->fetch();

	if ($result != false) {
		if (!is_null($result['imagen'])) {
			return $result['imagen'];
		} else {
			return false;
		}	
	}
}

function cantidad_pedidos_activos($conexion, $iduser) {
	$query = $conexion->prepare("SELECT * FROM pedidos WHERE id_user = :iduser AND estado != 3 GROUP BY codigo");
	$query->execute(array(':iduser' => $iduser));
	$pe_act = $query->fetchall();

	$cantidad = count($pe_act);

	return $cantidad;
}

function auto_inc_code(){
	$archivo = 'script/aiucode/corr.txt';

	if (file_exists($archivo)) {
		$code = file_get_contents($archivo);
		$code++;
		file_put_contents($archivo, $code);
		return $code;
	} else {
		file_put_contents($archivo, 1);	//Si el archivo no existe, crea uno nuevo con el valor 1
		return 1;
	}
}

function getShpCarQty ($id_user) {
	require 'conexion.php';
	if ($conexion != false) {
		$query = $conexion->prepare("SELECT cantidad FROM carrito WHERE id_user = :id_user");
		$query->execute(array(":id_user"=>$id_user));
		$qtysResult = $query->fetchall();
		$items = 0;
		foreach($qtysResult as $qty){
			$items += $qty['cantidad'];
		}
		return $items;
	}
}

function adminValidation ($conexion) {
	if (isset($_SESSION['user'])) {
		$user = $_SESSION['user'];
		$iduser = get_user_id($conexion, $user);
		
		$userData = get_user_data($conexion, $iduser);
		$userLevel = $userData['level'];

		if ($userLevel > 1) {
			return $userData;
		} else {
			header('Location: ../categorias.php');
		}
	} else {
		header('Location: ../categorias.php');
	}
}

function compressImgs ($imgs, $q) {
	require 'vendor/autoload.php';
	$imagine = new Imagine\Gd\Imagine();

	if (is_array($imgs) && is_integer($q)) {
		foreach ($imgs as $img) {
			$image = $imagine->open($img);	
			$image->save($img, array('quality' => $q));
		}
	}
}

function rotateImg ($img) {
	require 'vendor/autoload.php';
	
	$imagine = new Imagine\Gd\Imagine();

	$image = $imagine->open($img);
	$image->rotate(90);
	$image->save($img);
}

function createPayMethodFiles ($payMethodName) {
	$viewFile = "../payMethods/views/" . $payMethodName . "-view.php";
	$backendFile = "../payMethods/" . $payMethodName . ".php";

	if (!file_exists($viewFile)) {
		file_put_contents($viewFile,
"<!DOCTYPE html>
<html>
	<head>
	<title>Arte Ataco :: Pago</title>
		<link rel=\"stylesheet\" href=\"https://use.fontawesome.com/releases/v5.6.3/css/all.css\" integrity=\"sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/\" crossorigin=\"anonymous\">    <link href=\"https://fonts.googleapis.com/css?family=Roboto\" rel=\"stylesheet\">
		<link href=\"https://fonts.googleapis.com/css?family=Roboto\" rel=\"stylesheet\"> 
		<link rel=\"stylesheet\" href=\"payMethods/css/styles.css\">
	</head>
	<body>
		<span>Ocurri&oacute; un error, puede seleccionar otro m&eacute;todo de pago o intentar de nuevo m&aacute;s tarde.</span>

		<!-- <form class=\"placeOrder\" action=\"\" method=\"POST\">
			<input type=\"hidden\" name=\"order_code\" value=\"<?= \$codigo ?>\">
			<input type=\"submit\" name=\"place_order\" value=\"Hacer pedido\">
		</form> -->
	</body>
</html>");
	}

	if (!file_exists($backendFile)) {
		file_put_contents($backendFile,
"<?php
	// -- Method data available through \$datosMetodo --
	//CODE...

	require \"views/$payMethodName-view.php\";
?>");
	}
}

function deletePayMethodFiles ($payMethodName) {
	$viewFile = "../payMethods/views/" . $payMethodName . "-view.php";
	$backendFile = "../payMethods/" . $payMethodName . ".php";

	if (file_exists($viewFile)) {
		unlink($viewFile);
	}

	if (file_exists($backendFile)) {
		unlink($backendFile);
	}

}

 ?>