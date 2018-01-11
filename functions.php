<?php 

function conexion($DB, $user, $pass){
	try {
		$conexion = new PDO("mysql:host=localhost;dbname=$DB", $user, $pass);
		return $conexion;
	} catch (PDOException $e) {
		return false;
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
	$query = $conexion->prepare("SELECT COUNT(*) FROM pedidos WHERE id_user = :iduser AND estado != 3");
	$query->execute(array(':iduser' => $iduser));
	$pe_act = $query->fetch();

	return $pe_act[0];
}

function auto_inc_code(){
	$archivo = 'script/aiucode/corr.txt';

	if (file_exists($archivo)) {
		$code = file_get_contents($archivo) ;
		$code++;
		file_put_contents($archivo, $code);
		return $code;
	} else {
		file_put_contents($archivo, 1);	//Si el archivo no existe, crea uno nuevo con el valor 1
		return 1;
	}
}

 ?>