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
		$query = $conexion->prepare("SELECT * FROM usuarios WHERE user = :user OR email = :user AND password = :password");
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

 ?>