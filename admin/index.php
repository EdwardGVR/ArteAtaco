<?php

if (!isset($_SESSION['user'])) {
	session_start();
}

require '../functions.php';
require '../conexion.php';

adminValidation($conexion);

require "views/index_view.php";